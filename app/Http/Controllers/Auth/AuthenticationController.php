<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Repository\UserRepository\IUserRepository;

class AuthenticationController extends Controller
{
    public $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        try
        {
            return view('auth.login');
        }
        catch (Exception $e)
        {
            Log::error("Failed to show login form");
            return response()->json(['error' => 'Failed to show login form']);
        }
    }

    public function signup()
    {
        try
        {
            return view('auth.signup');
        }
        catch (Exception $e)
        {
            Log::error("Failed to show Register form");
            return response()->json(['error' => 'Failed to show register form']);
        }
    }

    public function loginPost(LoginRequest $request)
    {
        try
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
        catch (Exception $e)
        {
            Log::error("Failed to login User");
            return response()->json(['error' => 'Failed to login']);
        }
    }

    public function logout(Request $request)
    {
        try
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('index');
        }
        catch (Exception $e)
        {
            Log::error("Failed to logout user");
            return response()->json(['error' => 'Failed to logout user']);
        }
    }

    public function registerPost(RegisterRequest $request)
    {
        try
        {
            if ($request->password != $request->cpassword)
            {
                return redirect()->back()
                ->withErrors(['invalid' => 'Password and Confirm password mismatch'])
                ->withInput($request->only('email', 'name'));
            }

            $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            //$user = $this->userRepository->where(['email' => $request->email])->get()->first();

            return redirect()->route('login');
        }
        catch (Exception $e)
        {
            Log::error("Failed to register user");
            return response()->json(['error' => 'Failed to register user']);
        }
    }
}
