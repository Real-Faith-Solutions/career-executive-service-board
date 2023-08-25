<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    // my new auth func

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // end my new auth func

    public function getLoginHomePage(Request $request){

        // Valdate if user already login or not

        if (Auth::check() === true) {

            return Redirect::to('/dashboard');
        }
        else{
            return view('login');
        }
    }

    public function userLogout(Request $request){

        // Logout user, invalidate, and regenerate token session

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }

    public function forgotPassword()
    {
        return view('forgotPassword');
    }

}