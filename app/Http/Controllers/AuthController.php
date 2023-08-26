<?php

namespace App\Http\Controllers;

use App\Mail\TempCred201;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

    public function sendPassword(Request $request)
    {

        $customMessages = [
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'The provided email does not exist in our records.',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], $customMessages);

        // Find the user by email
        $user = User::where('email', $request->email)->first();
        
        if ($user) {

            // sending email to added user
            $recipientEmail = $request->email;
            $password = Str::password(8);
            $hashedPassword = Hash::make($password);
            $imagePath = public_path('images/branding.png');
            $loginLink= config('app.url');

            $data = [
                'email' => $recipientEmail,
                'password' => $password,
                'imagePath' => $imagePath,
                'loginLink' => $loginLink,
            ];
            // end sending email to added user

            Mail::to($recipientEmail)->send(new TempCred201($data));

            // Update the user's password with the hashed temporary password
            $user->update([
                'password' => $hashedPassword,
            ]);

            // Send an email or notification to the user with the new temporary password

            return back()->with('message','New temporary password sent!');
        }

        return back()->with('error','User not found!');
    }

}