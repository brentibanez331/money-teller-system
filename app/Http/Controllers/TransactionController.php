<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionFees;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $trans = Transaction::all();

        return view('admin.transactions', compact('trans'));
    }


    public function proceed(Request $request): View
    {
        try {
            // Your code that may throw an exception
            $teller = User::findOrFail($request->id);
            $user = Auth::user();
            return view('teller.sendproceed', compact('teller', 'user'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function request(Request $request): View
    {
        try {
            // Your code that may throw an exception
            $teller = User::findOrFail($request->id);
            $user = Auth::user();
            return view('teller.requestproceed', compact('teller', 'user'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function transact(Request $request): View
    {
        $teller = User::findOrFail($request->id);
        $user = Auth::user();
        $fees = new TransactionFees();
        $rate = 0;
        $rateID = 0;
        $newRate = 0;
        $newAmount = 0;
        $process = $request->input('process');

        // This is the original amount in local currency: SGD
        $amount = $request->input('amount');
        $transaction = new Transaction();

        if ($user->branch->currency != $teller->branch->currency) {
            // New amount converted to recepient's currency: SGD -> JPY
            $newAmount = $transaction->convertCurrency($amount, $user->branch->currency, $teller->branch->currency);
        } else {
            $newAmount = $amount;
        }

        if ($user->branch->currency != "USD") {
            // Amount In USD just for checking rates inside transaction fees
            $amountInUSD = $transaction->convertCurrency($amount, $user->branch->currency, "USD");
            $feeData = $fees->getFees($amountInUSD);
            $rate = $feeData['rate'];
            $rateID = $feeData['id'];
            $newRate = $transaction->convertCurrency($rate, "USD", $user->branch->currency);
        } else {
            $feeData = $fees->getFees($amount);
            $rate = $feeData['rate'];
            $rateID = $feeData['id'];
            $newRate = $rate;
        }


        $totalAmount = $amount + $newRate;

        if ($request->input('process') == "request") {
            return view('teller.requesttransaction', compact('teller', 'user', 'amount', 'newAmount', 'rateID', 'newRate', 'totalAmount'));
        } else {
            return view('teller.transaction', compact('teller', 'user', 'amount', 'newAmount', 'rateID', 'newRate', 'totalAmount'));
        }
    }

    public function update(Request $request)
    {
        try {
            if ($request->input('status') == "COMPLETED") {
                $receiver = User::findOrFail($request->id);
                $sender = Auth::user();

                
                $newSenderBalance = $sender->balance - $request->input('receiverAmount');
                $newReceiverBalance = $receiver->balance + $request->input('senderAmount');

                $sender->update([
                    'balance' => $newSenderBalance
                ]);

                $receiver->update([
                    'balance' => $newReceiverBalance
                ]);
            }


            $trans = Transaction::findOrFail($request->input('transID'));
            $trans->update([
                'transaction_status' => $request->input('status'),
            ]);

            return redirect()->back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request): View|RedirectResponse|JsonResponse
    {
        $process = $request->input('process');
        if ($process == "send") {
            $receiver = User::findOrFail($request->id);
            $sender = Auth::user();
        } else {
            $sender = User::findOrFail($request->id);
            $receiver = Auth::user();
        }

        try {
            $systemCode = $receiver->branch->branch_code;
            $date = Carbon::now()->format('Ymd');
            $time = Carbon::now()->format('His');
            $transactionId = Transaction::max('id') + 1;
            $randomValue = Str::random(5);

            $referenceCode = "{$systemCode}-{$date}-{$time}-{$transactionId}-{$randomValue}";

            // Your code that may throw an exception
            $transaction = new Transaction;
            $transaction->reference_number = $referenceCode;
            $transaction->sender_name = $sender->first_name;
            $transaction->sender_contact = $sender->email;
            $transaction->recipient_name = $receiver->first_name;
            $transaction->recipient_contact = $receiver->email;

            if ($sender->branch->country_iso_code == $receiver->branch->country_iso_code) {
                $transaction->transaction_type = "Local";
            } else {
                $transaction->transaction_type = "International";
            }

            if($process == "send"){
                $transaction->original_currency = $sender->branch->currency;
                $transaction->currency_conversion_code = $receiver->branch->currency;
            }else{
                $transaction->original_currency = $receiver->branch->currency;
                $transaction->currency_conversion_code = $sender->branch->currency;
            }
            
            $transaction->branch_sent = $sender->branch_assigned;
            $transaction->branch_received = $receiver->branch_assigned;

            $transaction->amount_local_currency = $request->input('amount');
            $transaction->amount_converted = $request->input('newAmount');
            if ($process == "send") {
                $transaction->transaction_status = "COMPLETED";
            }

            $transaction->transfer_fee_id = $request->input('rateID');
            $transaction->datetime_transaction = now();

            if ($process == "send") {
                $newSenderBalance = $sender->balance - $request->input('totalAmount');
                // $amountToAddReceiver = $transaction->getCurrency()
                if ($sender->branch->currency != $receiver->branch->currency) {
                    $newReceiverBalance = $receiver->balance + $transaction->convertCurrency($request->input('amount'), $sender->branch->currency, $receiver->branch->currency);
                } else {
                    $newReceiverBalance = $receiver->balance + $request->input('amount');
                }

                $sender->update([
                    'balance' => $newSenderBalance,
                ]);
                $receiver->update([
                    'balance' => $newReceiverBalance,
                ]);
            }


            $transaction->saveOrFail();
            $user = Auth::user();
            return $this->getTransactions();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        try {
            // Your code that may throw an exception
            $trans = Transaction::findOrFail($request->id);
            $trans->delete();
            return redirect()->back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getTransactions()
    {
        $user = Auth::user();

        $transactions = Transaction::where('sender_contact', $user->email)
            ->orWhere('recipient_contact', $user->email)
            ->orderBy('dateTime_transaction', 'desc')
            ->get();
        return view('teller.activity', compact('user', 'transactions'));
    }
}
