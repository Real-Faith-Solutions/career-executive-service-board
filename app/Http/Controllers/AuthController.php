<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationCodeMail;
use App\Mail\TempCred201;
use App\Models\DeviceVerification;
use App\Models\FailedAttempt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
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

        $customMessages = [
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'Invalid credentials',
        ];

        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], $customMessages);

        $email = $request->email;
        $ip_address = $request->ip();

        // Find the user by email and ip address on failed attempts
        $user = FailedAttempt::where('email', $email)->where('ip_address', $ip_address)->first();

        // Check if the user has suspension
        $user_suspension = $user->suspension ?? 0; // Adjust as needed
        if ($user && $user->updated_at->addMinutes($user_suspension)->isFuture()) {

            $currentDateTime = Carbon::now();
            $targetDateTime = $user->updated_at->addMinutes($user_suspension);
            $diffInMinutes = $currentDateTime->diffInMinutes($targetDateTime);
            $diffInSeconds = $currentDateTime->diffInSeconds($targetDateTime);
            // Format the difference in minutes and seconds
            $formattedDifference = sprintf('%02d:%02d', $diffInMinutes, $diffInSeconds % 60);

            return back()->with('error','Too many failed attempts. You can try again after '.$formattedDifference);
        }

        if (Auth::attempt($credentials, $request->remember)) {
            Cookie::queue(Cookie::make('email', $request->email, 120));
            Cookie::queue(Cookie::make('remember', $request->remember, 120));

            FailedAttempt::clearFailedAttempts($email, $ip_address);

            return redirect()->intended('/dashboard');
        }

        // counting failed attemps
        // the user will get a suspension if he failed to login 3 consecutive times.
        // 1st suspension = 5mins, 2nd = 30mins, 3rd = 1hour, then another 1hour suspension if failed again.
        // suspension will only take effect on the ip address of the device where the failed attemp occured.
        // when loggedin successfully, failed attemps record on user's ip address will be cleared.

        FailedAttempt::addOrUpdateFailedAttempts($email, $ip_address);

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

        // Check if the user has reset their password within the last 1 minute
        $cooldownMinutes = 1; // Adjust as needed
        if ($user && $user->updated_at->addMinutes($cooldownMinutes)->isFuture()) {
            return back()->with('error','New password already sent. Please check your email');
        }
        
        if ($user) {

            // sending email to added user
            $recipientEmail = $request->email;
            $password = Str::password(8);
            $hashedPassword = Hash::make($password);
            $imagePath = public_path('images/branding.png');
            $loginLink= config('app.url');
            $type = "forgotPassword";

            $data = [
                'type' => $type,
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

    public function confirmEmail(Request $request)
    {
        $allCookies = $request->header('cookie');
        return view('admin.confirm_email', compact('allCookies',));
    }

    public function submitConfirmationEmail(Request $request)
    {
        // Retrieve device associations from the cookie
        $associations = json_decode(Cookie::get('user_device_associations'), true) ?: [];

        // getting deviceIdentifiers for this user
        $ctrlno = auth()->user()->ctrlno;
        $deviceIdentifiers = DeviceVerification::where('user_ctrlno', $ctrlno)
                            ->where('verified', false)
                            ->get();

        // 
        foreach ($deviceIdentifiers as $deviceIdentifier) {
            foreach ($associations as $association) { 
                if (
                    $association['device_id'] == $deviceIdentifier->device_id &&
                    $association['user_id'] == $ctrlno
                ) {

                    $deviceVerification = DeviceVerification::where('user_ctrlno', $ctrlno)->where('device_id', $association['device_id'])->first();
                    $cooldownMinutes = 4; // Adjust to your preferred code expiration
                    if (!$deviceIdentifier->updated_at->addMinutes($cooldownMinutes)->isFuture()) {
                        
                        $confirmation_code = mt_rand(10000, 99999);
                        $hashed_confirmation_code = Hash::make($confirmation_code);
                        $recipientEmail = auth()->user()->email;
                        $imagePath = public_path('images/branding.png');

                        // Update the confirmation code in the database
                        $deviceVerification->update(['confirmation_code' => $hashed_confirmation_code]);

                        // sending confirmation_code email to user
                        $data = [
                            'email' => $recipientEmail,
                            'confirmation_code' => $confirmation_code,
                            'imagePath' => $imagePath,
                        ];
                
                        Mail::to($recipientEmail)->send(new ConfirmationCodeMail($data));

                        return redirect()->route('reconfirm.email')->with('error','Expired Code. Please check your new confirmation code');

                    }

                    if (Hash::check($request->code, $deviceIdentifier->confirmation_code)) {
                        $association['verified'] = true;
                        $cookieValue = json_encode($associations);
                        Cookie::queue('user_device_associations', $cookieValue, 30 * 24 * 60);
                        $deviceIdentifier->update(['verified' => true]);
                        return Redirect::to('/dashboard')->with('message', 'Account Verified!');
                    }
                }
            }
        }
        
        return redirect()->route('reconfirm.email')->with('error','Invalid Code. Please check your email');

    }

    public function resendConfirmationEmail()
    {
        // Retrieve device associations from the cookie
        $associations = json_decode(Cookie::get('user_device_associations'), true) ?: [];

        // getting deviceIdentifiers for this user
        $ctrlno = auth()->user()->ctrlno;
        $deviceIdentifiers = DeviceVerification::where('user_ctrlno', $ctrlno)
                            ->where('verified', false)
                            ->get();

        // 
        foreach ($deviceIdentifiers as $deviceIdentifier) {
            foreach ($associations as &$association) { 
                if (
                    $association['device_id'] == $deviceIdentifier->device_id &&
                    $association['user_id'] == $ctrlno &&
                    !$association['verified']
                ) {

                    $deviceVerification = DeviceVerification::where('user_ctrlno', $ctrlno)->where('device_id', $association['device_id'])->first();
                    $cooldownMinutes = 1; // Adjust as needed
                    if ($deviceVerification && $deviceVerification->updated_at->addMinutes($cooldownMinutes)->isFuture()) {
                        return redirect()->route('reconfirm.email')->with('info','Confirmation Code Already Sent. Please check your email and spam');
                    }

                    $confirmation_code = mt_rand(10000, 99999);
                    $hashed_confirmation_code = Hash::make($confirmation_code);
                    $recipientEmail = auth()->user()->email;
                    $imagePath = public_path('images/branding.png');

                    // Update the confirmation code in the database
                    $deviceVerification->update(['confirmation_code' => $hashed_confirmation_code]);

                    // sending confirmation_code email to user
                    $data = [
                        'email' => $recipientEmail,
                        'confirmation_code' => $confirmation_code,
                        'imagePath' => $imagePath,
                    ];
            
                    Mail::to($recipientEmail)->send(new ConfirmationCodeMail($data));

                    return redirect()->route('reconfirm.email')->with('info','New Confirmation Code Sent. Please check your email and spam');

                }
            }
        }
        
        return redirect()->route('reconfirm.email')->with('error','Something went wrong. Please check confirmation code sent to your email');

    }

}