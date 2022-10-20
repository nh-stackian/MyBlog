<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login()
    {
        try
        {
            return view('auth.login');
        }
        catch (\Throwable $th)
        {
            Log::error("Failed to show login form");
            return response()->json(['error' => 'Failed to show login form']);
        }
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function loginPost(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password], $request->input('remember')))
        {
            $request->session()->regenerate();

            if (Auth::user()->role == 'admin')
            {
                return redirect()->route('dashboard');
            }

            return redirect()->route('index');
        }

        return redirect()->back()
                        ->withErrors(['invalid' => 'Invalid email or Password'])
                        ->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
