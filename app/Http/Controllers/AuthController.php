<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // direct login page
    public function loginPage()
    {
        return view("login");
    }

    // register page
    public function registerPage()
    {
        return view("register");
    }
    public function deshboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }
}
