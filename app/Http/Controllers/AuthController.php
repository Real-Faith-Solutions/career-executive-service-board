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
    public function getLoginHomePage(Request $request){
       
        // Valdate if user already login or not

        if (Auth::check() === true) {
            
            return Redirect::to('/admin/dashboard');
        }
        else{

            return view('login');
        }
    }

    public function userChangeDefaultPasswordPage(Request $request){
       
        // Login User once for changing default password

        if (Auth::once(['email' => $request->email, 'password' => $request->input_old_password])) {
            
            if(Auth::user()->default_password_change != 'true'){

                // Validate form

                $validator = Validator::make(
                        
                    array(
                        'email' => $request->email,
                        'old_password' =>  Hash::check($request->input_old_password, Auth::user()->password),
                        'input_old_password' => true,
                        'validate_old_and_new_password' => (Hash::check($request->new_password, Auth::user()->password) ? 'Same password' : 'Not Equal'),
                        'input_new_password' => (Hash::check($request->new_password, Auth::user()->password) ? '' : 'false'),
                        'new_password' => $request->new_password,
                        'new_password_confirmation' => $request->new_password_confirmation,
                        'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    ),
                    array(
                        'email' => 'required|email',
                        'old_password' =>  'required',
                        'input_old_password' => 'same:old_password',
                        'validate_old_and_new_password' => 'required',
                        'input_new_password' => 'required_if:validate_old_and_new_password,Same password',
                        'new_password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols(),'confirmed'],
                        'new_password_confirmation' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
                        'last_updated_by' => '',
                    )
                );

                if ($validator->fails()){

                    $errors = $validator->errors();

                    return $errors;

                }else{
                    
                    User::where('email', Auth::user()->email)
                        ->update([
                        'default_password_change' => 'true',
                        'password' => Hash::make($request->new_password),
                        'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    ]);

                    if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->new_password])){

                        $request->session()->regenerate();

                        return 'Successfully updated';
                    }

                }
            }
            else{

                if(Auth::user()->role == 'User'){

                    return Redirect::to('/admin/profile/views/'.Auth::user()->cesno);
                }
                else{

                    return Redirect::to('/admin');
                }
            }
        }
        else{

            return view('login');
        }
    }

    public function userLogin(Request $request){

        // Attempt to log user once to changed default password and regenerate session to user that already changed their password

        if (Auth::once(['email' => $request->email, 'password' => $request->password])) {
 
            if(Auth::user()->default_password_change != 'true'){
             
                $email = $request->email;

                return view('change_default_password', compact('email'))->render();
            }
            else{

                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
                    $request->session()->regenerate();
        
                    if(Auth::user()->role == 'User'){

                        return Redirect::to('/admin/profile/views/'.Auth::user()->cesno);
                    }
                    else{

                        return Redirect::to('/admin');
                    }
                    
                }
            }
        }
        else{

            // Return response if invalid login credentials

            $response = [];
            $response['message'] = 'Login failed! Info mismatched.';
            $response['link'] = 'login';

            return view('message', compact('response'))->render();
        }
    }

    public function userLogout(Request $request){

        // Logout user, invalidate, and regenerate token session
        
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function userRegister(Request $request){
        User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return "Success Registration!";
    }
}
