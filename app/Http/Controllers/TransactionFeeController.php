<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionFees;

class TransactionFeeController extends Controller
{
    public function index()
    {
        $fees = TransactionFees::all();

        return view('admin.fees', compact('fees'))->with('admin.users', $fees);
    }
}
