<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionFees;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

class TransactionFeeController extends Controller
{
    public function index()
    {
        $fees = TransactionFees::all();

        return view('admin.fees', compact('fees'))->with('admin.users', $fees);
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {

        $validated = $request->validate([
            'min_amt' => 'required|numeric',
            'max_amt' => 'required|numeric',
            'rates' => 'required|numeric',
        ]);

        try {
            // Your code that may throw an exception
            $fees = new TransactionFees;
            $fees->min_amt = $request->min_amt;
            $fees->max_amt = $request->max_amt;
            $fees->rates = $request->rates;
    
            $fees->saveOrFail();
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

    public function delete(Request $request) : RedirectResponse
    {
        try {
            // Your code that may throw an exception
            $phonebook = TransactionFees::findOrFail($request->id);
            $phonebook->delete();
            return redirect()->back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function edit(Request $request) : View
    {
        try {
            // Your code that may throw an exception
            $fees = TransactionFees::findOrFail($request->id);
            return view('admin.editfees', compact('fees'));
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

    public function update(Request $request, TransactionFees $fees) : RedirectResponse
    {

        try {
            // Your code that may throw an exception
            $fees = TransactionFees::findOrFail($request->id);
            $fees->update([
                'min_amt' => $request->min_amt,
                'max_amt' => $request->max_amt,
                'rates' => $request->rates,
            ]);
            return redirect()->back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
