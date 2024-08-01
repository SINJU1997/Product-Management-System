<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('user', $user);

            switch ($user->role) {
                case 'admin':
                    return redirect('/admin-dashboard');
                case 'vendor':
                    return redirect('/vendor-dashboard');
                default:
                    return redirect('/dashboard');
            }
        }

        return redirect('/')->with('error', 'Invalid credentials.');
    }
    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->forget('user'); 
        return redirect('/');
    }
}
