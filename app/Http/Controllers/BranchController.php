<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BranchProfile;

class BranchController extends Controller
{
    public function index()
    {
        $branch = BranchProfile::all();

        return view('admin.branches', compact('branch'))->with('admin.users', $branch);
    }
}
