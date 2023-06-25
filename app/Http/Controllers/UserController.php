<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PersonalData;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreatedNewAccountMail;
use App\Mail\AccountHasBeenChange;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    
    public function getRoleNameNo($role_name){

        $get_role_name_no = User::where('role','=',$role_name)->select('role_name_no')->get()->max();

        if($get_role_name_no === null){
            
            $role_name_no = 1;
        }
        else{

            $role_name_no = ($get_role_name_no->role_name_no + 1);
        }

        return $role_name_no;
    }

    public function addUsersPage(){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            $user_data = User::all();
            
            return view('admin.rights_management.users', compact('user_data'))->render();
        }
        else{

            return view('restricted');
        }
    }

    public function editUsersPage($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            $user_data = User::all();
            $user_id_data = User::where('id','=',$id)->get();
            
            return view('admin.rights_management.users', compact('user_data', 'user_id_data'))->render();
        }
        else{

            return view('restricted');
        }
    }

    public function validateData($type, $value){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            if($type == 'email'){

                // Validate value

                $validator = Validator::make(
                        
                    array(
                        'email' => $value,
                    ),
                    array(
                        'email' => 'email|max:255',
                    )
                );

                if ($validator->fails()){

                    $errors = $validator->errors();

                    return $errors;

                }else{

                    $search_email = User::where('email','=',$value)->get();

                    if($search_email == '[]'){
                        $validation_result = 'false';
                    }
                    else{
                        $validation_result = 'true';
                    }

                    return $validation_result;

                }

            }
            elseif($type == 'username'){

                // Validate value

                $validator = Validator::make(
                        
                    array(
                        'username' => $value,
                    ),
                    array(
                        'username' => 'max:255',
                    )
                );

                if ($validator->fails()){

                    $errors = $validator->errors();

                    return $errors;

                }else{

                    $search_username = User::where('username','=',$value)->get();

                    if($search_username == '[]'){
                        $validation_result = 'false';
                    }
                    else{
                        $validation_result = 'true';
                    }

                    return $validation_result;

                }

            }
            elseif($type == 'mobile no. 1'){

                // Validate value

                $validator = Validator::make(
                        
                    array(
                        'contact_no' => $value,
                    ),
                    array(
                        'contact_no' => 'regex:/^([+][63])[\d]{11}$/',
                    )
                );

                if ($validator->fails()){

                    $errors = $validator->errors();

                    return $errors;

                }else{

                    $search_contact_no = User::where('contact_no','=',$value)->get();

                    if($search_contact_no == '[]'){
                        $validation_result = 'false';
                    }
                    else{
                        $validation_result = 'true';
                    }

                    return $validation_result;

                }

            }
        }
        else{

            return 'Restricted';
        }
    }

    public function addUser(Request $request){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'last_name' => $request->last_name,
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'contact_no' => $request->contact_no,
                    'email' => $request->email,
                    'employee_id' => $request->employee_id,
                    'username' => $request->username,
                    'role' => $request->role,
                    'role_name_no' => $request->role_name_no,
                    'password' => $request->password,
                    'password_confirmation' => $request->password_confirmation,
                    'is_active' => $request->is_active,
                    'picture' => $request->picture,
                ),
                array(
                    'last_name' => 'required',
                    'first_name' => 'required',
                    'middle_name' => 'required',
                    'contact_no' => ['required','regex:/^([+][63])[\d]{11}$/'],
                    'email' => 'required|email|unique:users',
                    'employee_id' => 'required',
                    'username' => 'required|unique:users|alpha_num',
                    'role' => 'required',
                    'role_name_no' => 'required',
                    'password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols(),'confirmed'],
                    'password_confirmation' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
                    'is_active' => 'required',
                    'picture' => (($request->picture == null) ? '' : 'mimes:jpeg,png|file|max:2048|dimensions:min_width=300,min_height=300'),
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                if($request->hasFile('picture')){

                    // Get file details

                    $filename_with_ext = $request->file('picture')->getClientOriginalName();
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                    $extension = $request->file('picture')->getClientOriginalExtension();

                    if($request->role == 'User'){

                        Storage::disk('f-drive')->putFileAs('Photos/201 Photos/', $request->file('picture'), $request->cesno.'-'.$request->last_name.', '.$request->first_name.' '.$request->middle_name.'.'.$extension);

                        $picture_file_name = $request->cesno.'-'.$request->last_name.', '.$request->first_name.' '.$request->middle_name.'.'.$extension;
                    }
                    else{

                        Storage::disk('f-drive')->putFileAs('Photos/Staff Photos/', $request->file('picture'), $request->role.' ('.$request->role_name_no.')'.'-'.$request->last_name.', '.$request->first_name.' '.$request->middle_name.'.'.$extension);

                        $picture_file_name = $request->role.' ('.$request->role_name_no.')'.'-'.$request->last_name.', '.$request->first_name.' '.$request->middle_name.'.'.$extension;

                    }

                }
                else{
                
                    $picture_file_name = '';  
                }   

                User::create([
                    'last_name' => $request->last_name,
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'contact_no' => $request->contact_no,
                    'email' => $request->email,
                    'employee_id' => $request->employee_id,
                    'username' => $request->username,
                    'role' => $request->role,
                    'role_name_no' => $request->role_name_no,
                    'password' => Hash::make($request->password),
                    'is_active' => $request->is_active,
                    'picture' => $picture_file_name,
                    'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    'encoder' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                ]);

                // Try and catch error on sending emails
        
                try{ 
        
                    Mail::to($request->email)->send(new CreatedNewAccountMail($request->password, $request->username));
                }
                catch (\exception $e){
                    
                    // Report an exception via the exception handler without rendering an error page to the user
                    
                    report($e);
                }

                return 'Successfully added';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function updateUser(Request $request, $id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            // Validate form

            $validator = Validator::make(
                array(
                    'last_name' => $request->last_name,
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'contact_no' => $request->contact_no,
                    'email' => $request->email,
                    'employee_id' => $request->employee_id,
                    'username' => $request->username,
                    'role' => $request->role,
                    'role_name_no' => $request->role_name_no,
                    'password' => $request->password,
                    'password_confirmation' => $request->password_confirmation,
                    'is_active' => $request->is_active,
                    'picture' => $request->picture,
                ),
                array(
                    'last_name' => 'required',
                    'first_name' => 'required',
                    'middle_name' => 'required',
                    'contact_no' => ['required','regex:/^([+][63])[\d]{11}$/'],
                    'email' => 'required|email',
                    'employee_id' => 'required',
                    'username' => 'required|alpha_num',
                    'role' => 'required',
                    'role_name_no' => 'required',
                    'password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols(),'confirmed'],
                    'password_confirmation' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
                    'is_active' => 'required',
                    'picture' => (($request->picture == null) ? '' : 'mimes:jpeg,png|file|max:2048|dimensions:min_width=300,min_height=300'),
                )
            );

            if ($validator->fails()){

                $errors = $validator->errors();

                return $errors;

            }else{

                // Get User current 2x2 Photo file name

                $User = User::where('id','=',$id)->get();
                $User_picture_file_name = $User[0]->picture;
                $User_role_name = $User[0]->role;
                $User_cesno = $User[0]->cesno;
                $User_email = $User[0]->email;
                $User_username = $User[0]->username;
                $User_password = $User[0]->password;

                if($request->hasFile('picture')){

                    // Get file details

                    $filename_with_ext = $request->file('picture')->getClientOriginalName();
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                    $extension = $request->file('picture')->getClientOriginalExtension();

                    
                    if($User_role_name == 'User'){

                        // Delete User current 2x2 Photo

                        if(Storage::disk('f-drive')->exists('Photos/201 Photos/'.$User_picture_file_name)){

                            Storage::disk('f-drive')->delete('Photos/201 Photos/'.$User_picture_file_name);
                        }
        
                        // Save User new 2x2 Photo
        
                        Storage::disk('f-drive')->putFileAs('Photos/201 Photos/', $request->file('picture'), $request->cesno.'-'.$request->last_name.', '.$request->first_name.' '.$request->middle_name.'.'.$extension);

                        $picture_file_name = $request->cesno.'-'.$request->last_name.', '.$request->first_name.' '.$request->middle_name.'.'.$extension;

                    }
                    else{

                        if(Storage::disk('f-drive')->exists('Photos/Staff Photos/'.$User_picture_file_name)){

                            Storage::disk('f-drive')->delete('Photos/Staff Photos/'.$User_picture_file_name);
                        }
        
                        // Save User new 2x2 Photo
        
                        Storage::disk('f-drive')->putFileAs('Photos/Staff Photos/', $request->file('picture'),  $request->role.' ('.$request->role_name_no.')'.'-'.$request->last_name.', '.$request->first_name.' '.$request->middle_name.'.'.$extension);

                        $picture_file_name = $request->role.' ('.$request->role_name_no.')'.'-'.$request->last_name.', '.$request->first_name.' '.$request->middle_name.'.'.$extension;

                    }


                }
                else{
                
                    $picture_file_name = $User_picture_file_name;  
                }   

                 // Send email notification to user if email, username or password has been change

                 if($User_email != $request->email || $User_username != $request->username || Hash::check($request->password, $User_password) != true){

                    // Try and catch error on sending emails
        
                    try{ 
            
                        Mail::to($request->email)->send(new AccountHasBeenChange($request->password, $request->username));

                    }
                    catch (\exception $e){
                        
                        // Report an exception via the exception handler without rendering an error page to the user
                        
                        report($e);
                    }

                    User::where('id','=',$id)->update(

                        array(
                            'default_password_change' => '',
                        )
                    );

                }

                User::where('id','=',$id)->update(

                    array(
                        'last_name' => $request->last_name,
                        'first_name' => $request->first_name,
                        'middle_name' => $request->middle_name,
                        'contact_no' => $request->contact_no,
                        'email' => $request->email,
                        'employee_id' => $request->employee_id,
                        'username' => $request->username,
                        'role' => $request->role,
                        'role_name_no' => $request->role_name_no,
                        'password' => Hash::make($request->password),
                        'is_active' => $request->is_active,
                        'picture' => $picture_file_name,
                        'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    )
                );

                if($request->role == 'User'){

                    PersonalData::where('cesno', $User_cesno)->update([
                        'status' => $request->is_active,
                        'picture' => $picture_file_name,
                        'lastname' => Str::ucfirst($request->last_name),
                        'firstname' => Str::ucfirst($request->first_name),
                        'middlename' => Str::ucfirst($request->middle_name),
                        'oea_ma' => $request->email,
                        'mobileno1_ma' => $request->contact_no,
                        'last_updated_by' => Auth::user()->role.' - '.Auth::user()->role_name_no,
                    ]);

                }

                return 'Successfully updated';
            }
        }
        else{

            return 'Restricted';
        }
    }

    public function deleteUser($id){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Rights Management') == 'true'){

            User::where('id','=',$id)->delete();

            return 'Successfully deleted';
        }
        else{

            return 'Restricted';
        }

    }
}
