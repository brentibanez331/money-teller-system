<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserType;
use App\Models\BranchType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Models\BranchProfile;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $user = Auth::user();
        $noOfTellers = User::where('user_type_id', 2)->count();
        $noOfAdmins = User::where('user_type_id', 1)->count();
        $noOfTransactions = Transaction::count();
        $topBranches = User::selectRaw('branch_assigned, count(*) as branch_count')->groupBy('branch_assigned')
                                    ->orderByDesc('branch_count')
                                    ->take(3)
                                    ->get();
        $transactions = Transaction::all()->where('transaction_status', 'COMPLETED')->sortByDesc('datetime_transaction')->take(3);

        if ($user->user_type_id == 1) {
            return view('admin.index', compact('users', 'user', 'noOfTellers', 'noOfAdmins', 'noOfTransactions', 'topBranches', 'transactions'))->with('admin.users', $users);
        } else if ($user->user_type_id == 2) {
            $transactions = Transaction::where('sender_contact', $user->email)
                                        ->orWhere('recipient_contact', $user->email)
                                        ->orderBy('dateTime_transaction', 'desc')
                                        ->get();
            return view('teller.index', compact('user', 'transactions'));
        }
    }

    

    public function adminusers(){
        $users = User::all();

        $user = Auth::user();

        return view('admin.users', compact('users', 'user'));
    }

    public function getTellers(){
        $user = Auth::user();
        $tellers = User::where('user_type_id', 2)->whereNotIn('id', [$user->id])->get();  // Get all users with user_type_id = 2

        return view('teller.contacts', compact('tellers', 'user'));
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'required',
            'password' => 'required',
            'birthdate' => 'nullable',
            'full_address' => 'nullable',
            'user_type_id'=>'required|numeric',
            'branch_assigned'=>'nullable|numeric'
        ]);

        try {
            // Your code that may throw an exception
            $user = new User;
            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;
            $user->birthdate = $request->birthdate;
            $user->full_address = $request->full_address;
            $user->user_type_id = $request->user_type_id;
            $user->branch_assigned = $request->branch_assigned;

            if ($request->user_type_id == 1) {
                $user->balance = null;
            }
            
            $user->email = $request->email;
            $user->password = $request->password;
    
            $user->saveOrFail();

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

    public function delete(Request $request) : RedirectResponse
    {
        try {
            // Your code that may throw an exception
            $branch = User::findOrFail($request->id);
            $branch->delete();
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

    public function edit(Request $request) : View
    {
        try {
            // Your code that may throw an exception
            $user = User::findOrFail($request->id);
            $branch = BranchProfile::all();
            return view('admin.edituser', compact('user', 'branch'));
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

    public function update(Request $request, User $user) : RedirectResponse
    {

        try {
            // Your code that may throw an exception
            $user = User::findOrFail($request->id);
            $user->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'birthdate' => $request->birthdate,
                'full_address' => $request->full_address,
                'email' => $request->email,
                'user_type_id' => $request->user_type_id,
                'branch_assigned' => $request->branch_assigned,
                'password' => Hash::make($request->password),
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

