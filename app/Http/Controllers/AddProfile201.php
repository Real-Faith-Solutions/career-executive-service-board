<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProfile201Req;
use App\Mail\TempCred201;
use App\Models\PersonalData;
use App\Models\User;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class AddProfile201 extends Controller
{
    //
    public function store(AddProfile201Req $request, $cesno)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

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
            'encoder' => $encoder,

        ]);

        $recipientEmail = $request->email;
        $password = Str::password(8, true, true, true, false);
        $hashedPassword = Hash::make($password);
        $imagePath = public_path('assets/branding.png');

        $data = [
            'email' => $recipientEmail,
            'password' => $password,
            'imagePath' => $imagePath,
        ];

        Mail::to($recipientEmail)->send(new TempCred201($data));

        $user = $newProfile->users()->Create([
            'email' => $newProfile->email,
            'password' => $hashedPassword,
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => $encoder,
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('user');

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
