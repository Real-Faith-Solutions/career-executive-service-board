<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProfile201Req;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddProfile201 extends Controller
{
    //
    public function store(AddProfile201Req $request)
    {
        $indigenous = $request->member_of_indigenous_group;

        $pwd = $request->person_with_disability;

        if($request->member_of_indigenous_group == "Others"){
            $indigenous = $request->moig_others;
        }

        if($request->person_with_disability == "Yes"){
            $pwd = $request->dependent_pwd_input;
        }

        $newProfile = PersonalData::create([
            
            'status' => $request->status,
            'title' => $request->title,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'name_extension' => $request->name_extension,
            'middlename' => $request->middlename,
            'mi' => $request->mi,
            'nickname' => $request->nickname,
            'birthdate' => $request->birthdate,
            'age' => $request->age,
            'birth_place' => $request->birth_place,
            'gender' => $request->gender,
            'gender_by_choice' => $request->gender_by_choice,
            'civil_status' => $request->civil_status,
            'religion' => $request->religion,
            'height' => $request->height,
            'weight' => $request->weight,
            'member_of_indigenous_group' => $indigenous,
            'single_parent' => $request->single_parent,
            'citizenship' => $request->citizenship,
            'dual_citizenship' => $request->dual_citizenship,
            'person_with_disability' => $pwd,
            'gsis' => $request->gsis,
            'pagibig' => $request->pagibig,
            'philhealth' => $request->philhealth,
            'sss_no' => $request->sss_no,
            'tin' => $request->tin,

        ]);

        return back()->with('message','New profile added!');

    }

    public function uploadAvatar(Request $request, $cesno)
    {
        $existingPerson = PersonalData::where('cesno', $cesno)->first();

        // Validate the uploaded image
        $request->validate([
            'imageInput' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // Check if a file was uploaded
        if ($request->hasFile('imageInput')) {

            // Find the user's existing image, if any
            $existingImage = $existingPerson->avatar;

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
            $existingPerson->avatar = $pathName;
            $existingPerson->save();

            return back()->with('message','Profile Picture Changed!');
        }

        // Handle the case when no file was uploaded
        return back()->with('error','No file was uploaded!');

    }

}
