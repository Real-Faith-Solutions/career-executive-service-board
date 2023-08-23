<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProfile201Req;
use App\Models\PersonalData;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\IndigenousGroup;
use App\Models\PWD;
use App\Models\GenderByChoice;
use App\Models\GenderByBirth;
use App\Models\NameExtension;
use App\Models\CivilStatus;
use App\Models\Title;
use App\Models\RecordStatus;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\TempCred201;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;


class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $personalData = PersonalData::query()
            ->where('lastname', "LIKE" ,"%$query%")
            ->orWhere('firstname',  "LIKE","%$query%")
            ->orWhere('middleinitial',  "LIKE","%$query%")
            ->orWhere('name_extension',  "LIKE","%$query%")
            ->paginate(25);

       return view('admin\201_profiling\view_profile\table', compact('personalData', 'query'));
    }

    public function show($cesno)
    {
        $mainProfile = PersonalData::find($cesno);
        $birthdate = $mainProfile->birth_date;

        $birthDate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
        $age = $currentDate->diffInYears($birthDate);

        return view('admin.201_profiling.view_profile.partials.personal_data.form', 
        compact('mainProfile', 'cesno', 'age'));
    }

    public function addProfile()
    {
        if (DB::table('profile_tblMain')->count() === 0) 
        {
            $cesNumber = 0;
        } else {
            $cesNumber = PersonalData::latest()->first()->cesno;
        }

        $countries = Country::all();
        $indigenousGroups = IndigenousGroup::all();
        $pwds = PWD::all();
        $genderByChoices = GenderByChoice::all();
        $genderByBirths = GenderByBirth::all();
        $nameExtensions = NameExtension::all();
        $civilStatus = CivilStatus::all();
        $title = Title::all();
        $recordStatus = RecordStatus::all();
        $religion = Religion::all();

        return view('admin.201_profiling.create_profile.form',[
            'cesNumber' => ++$cesNumber,
            'countries' => $countries,
            'indigenousGroups' => $indigenousGroups,
            'pwds' => $pwds,
            'genderByChoices' => $genderByChoices,
            'genderByBirths' => $genderByBirths,
            'nameExtensions' => $nameExtensions,
            'civilStatus' => $civilStatus,
            'title' => $title,
            'recordStatus' => $recordStatus,
            'religion' => $religion,

        ]);
    }

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
        $password = Str::password(8);
        $hashedPassword = Hash::make($password);
        $imagePath = public_path('images/branding.png');

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
    
        if ($validator->fails()) 
        {
            return back()->with('error','Invalid file type!');
        }

        // Check if a file was uploaded
        if ($request->hasFile('imageInput')) 
        {
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

    public function editProfile($cesno)
    {
        $mainProfile = PersonalData::find($cesno);
        $countries = Country::all();
        $indigenousGroups = IndigenousGroup::all();
        $pwds = PWD::all();
        $genderByChoices = GenderByChoice::all();
        $genderByBirths = GenderByBirth::all();
        $nameExtensions = NameExtension::all();
        $civilStatus = CivilStatus::all();
        $title = Title::all();
        $recordStatus = RecordStatus::all();
        $religion = Religion::all();

        return view('admin.201_profiling.view_profile.partials.personal_data.edit',[
            'cesNumber' => $cesno,
            'mainProfile' => $mainProfile,
            'countries' => $countries,
            'indigenousGroups' => $indigenousGroups,
            'pwds' => $pwds,
            'genderByChoices' => $genderByChoices,
            'genderByBirths' => $genderByBirths,
            'nameExtensions' => $nameExtensions,
            'civilStatus' => $civilStatus,
            'title' => $title,
            'recordStatus' => $recordStatus,
            'religion' => $religion,

        ]);
    }

    public function update(AddProfile201Req $request, $cesno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $middleName = $request->middlename;
        $middleInitial = $this->extractMiddleInitial($middleName);

        $personalData = PersonalData::find($cesno);
        $personalData->status = $request->status;
        $personalData->title = $request->title;
        $personalData->lastname = $request->lastname;
        $personalData->firstname = $request->firstname;
        $personalData->name_extension = $request->name_extension;
        $personalData->middlename = $request->middlename;
        $personalData->middleinitial = $middleInitial;
        $personalData->nickname = $request->nickname;
        $personalData->birth_date = $request->birthdate;
        $personalData->birth_place = $request->birth_place;
        $personalData->gender = $request->gender;
        $personalData->gender_by_choice = $request->gender_by_choice;
        $personalData->civil_status = $request->civil_status;
        $personalData->religion = $request->religion;
        $personalData->height = $request->height;
        $personalData->weight = $request->weight;
        $personalData->member_of_indigenous_group = $request->member_of_indigenous_group;
        $personalData->single_parent = $request->single_parent;
        $personalData->citizenship = $request->citizenship;
        $personalData->dual_citizenship = $request->dual_citizenship;
        $personalData->person_with_disability = $request->person_with_disability;
        $personalData->encoder = $encoder;
        $personalData->save();

        return back()->with('info','Profile Updated!');
    }

    public function extractMiddleInitial($middleName)
    {
        $middleNameParts = explode(' ', $middleName);
        
        $middleInitial = '';
        
        foreach ($middleNameParts as $part) {
            // Extract the first character of each part as the initial
            $middleInitial .= strtoupper(substr($part, 0, 1));
        }
        
        return $middleInitial;
    }

    public function settings($cesno)
    {
        $mainProfile = PersonalData::find($cesno);
        $birthdate = $mainProfile->birth_date;

        $birthDate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
        $age = $currentDate->diffInYears($birthDate);

        return view('admin.201_profiling.view_profile.partials.personal_data.settings', 
        compact('mainProfile', 'cesno', 'age'));
    }

    public function changePassword(Request $request)
    {

        echo "nice";

    }

}