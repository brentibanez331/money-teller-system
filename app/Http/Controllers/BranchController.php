<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BranchProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

class BranchController extends Controller
{
    public function index()
    {
        $branch = BranchProfile::all();

        return view('admin.branches', compact('branch'))->with('admin.users', $branch);
    }

    public function getData()
    {
        $branch = BranchProfile::all();

        return view('admin.adduser', compact('branch'));
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {

        $validated = $request->validate([
            'branch_name' => 'required',
            'branch_code' => 'required',
            'country_iso_code' => 'required',
            'currency' => 'required'
        ]);

        try {
            // Your code that may throw an exception
            $branch = new BranchProfile;
            $branch->branch_name = $request->branch_name;
            $branch->branch_code = $request->branch_code;
            $branch->country_iso_code = $request->country_iso_code;
            $branch->currency = $request->currency;
    
            $branch->saveOrFail();
            Log::info('Branch profile created successfully: '.$branch->branch_name);
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
            $branch = BranchProfile::findOrFail($request->id);
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
            $branch = BranchProfile::findOrFail($request->id);
            return view('admin.editbranch', compact('branch'));
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

    public function update(Request $request, BranchProfile $branch) : RedirectResponse
    {

        try {
            // Your code that may throw an exception
            $branch = BranchProfile::findOrFail($request->id);
            $branch->update([
                'branch_name' => $request->branch_name,
                'branch_code' => $request->branch_code,
                'country_iso_code' => $request->country_iso_code,
                'currency' => $request->currency,
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
