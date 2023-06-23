<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function showLoginForm()
    {
        return view('auth.login');
    }

    function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials = $request->only([
            'email', 'password'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('frontend.feeds.index');
        } else {
            return back()->withMessage("Invalid username or password");
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.feeds.index');
    }
}
