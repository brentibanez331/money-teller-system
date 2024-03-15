<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $user = Auth::user();

        if ($user->user_type_id == 1) {
            return view('admin.index', compact('users'))->with('admin.users', $users);
        } else if ($user->user_type_id == 2) {
            return view('teller.index');
        }
        
    }
}
