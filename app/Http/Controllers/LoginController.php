<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect('/dashboard/posts');
        }
        
        return view('dashboard.login', [
            'title' => "Login"
        ]);
    }

    public function authenticate(Request $request) 
    {

        $credentials = $request->validate([
            'email' => 'required|email|email:dns',
            'password' => 'required'
        ]);

        $remember = $request->remember ? true : false;

        if(Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard/posts');
        }

        return back()->with('loginError', 'You have entered an invalid email or password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
