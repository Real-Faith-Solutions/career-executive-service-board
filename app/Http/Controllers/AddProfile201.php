<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProfile201Req;
use App\Mail\TempCred201;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AddProfile201 extends Controller
{
    //
    public function store(AddProfile201Req $request)
    {

        $newProfile = PersonalData::create([
            
            'status' => $request->status,
            'title' => $request->title,
            'email' => $request->email,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'name_extension' => $request->name_extension,
            'middlename' => $request->middlename,
            'middleinitial' => $request->mi,
            'nickname' => $request->nickname,
            'birth_date' => $request->birthdate,
            // 'age' => $request->age,
            'birth_place' => $request->birth_place,
            'gender' => $request->gender,
            'gender_by_choice' => $request->gender_by_choice,
            'civil_status' => $request->civil_status,
            'religion' => $request->religion,
            'height' => $request->height,
            'weight' => $request->weight,
            'member_of_indigenous_group' => $request->member_of_indigenous_group,
            'single_parent' => $request->single_parent,
            'citizenship' => $request->citizenship,
            'dual_citizenship' => $request->dual_citizenship,
            'person_with_disability' => $request->person_with_disability,
            // 'gsis' => $request->gsis,
            // 'pagibig' => $request->pagibig,
            // 'philhealth' => $request->philhealth,
            // 'sss_no' => $request->sss_no,
            // 'tin' => $request->tin,

        ]);

        $recipientEmail = $request->email;

        // generating random password
        $length = 8;
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*()-_';

        $password = Str::random(1, $lowercase) .    // Include at least one lowercase
                    Str::random(1, $uppercase) .    // Include at least one uppercase
                    Str::random(1, $numbers) .      // Include at least one number
                    Str::random(1, $specialChars) . // Include at least one special character
                    Str::random($length - 4);       // Fill the rest with random characters

        // Shuffle the password to ensure randomness
        $password = str_shuffle($password);
        // end

        $data = [
            'email' => $recipientEmail,
            'password' => $password,
        ];

        Mail::to($recipientEmail)->send(new TempCred201($data));

        return back()->with('message','New profile added!');

    }

    public function uploadAvatar(Request $request, $cesno)
    {
        $existingPerson = PersonalData::where('cesno', $cesno)->first();

        $validator = Validator::make($request->all(), [
            'imageInput' => 'required|image|mimes:jpeg,png,jpg',
        ]);
    
        if ($validator->fails()) {
            return back()->with('error','Invalid file type!');
        }

        // Check if a file was uploaded
        if ($request->hasFile('imageInput')) {

            // Find the user's existing image, if any
            $existingImage = $existingPerson->picture;

            // Delete the existing image file from the storage folder
            if ($existingImage) {
                $imagePath = public_path('images/' . $existingImage);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Get the uploaded image file
            $imageFile = $request->file('imageInput');

            // Generate a unique filename for the image
            $filename = time() . '_' . $imageFile->getClientOriginalName();

            // Save the image to the root folder
            $imageFile->move(public_path('images/avatar/'), $filename);

            $pathName = 'avatar/'.$filename;

            // Save the image path to the database
            $existingPerson->picture = $pathName;
            $existingPerson->save();

            return back()->with('message','Profile Picture Changed!');
        }

        // Handle the case when no file was uploaded
        return back()->with('error','No file was uploaded!');

    }

}
