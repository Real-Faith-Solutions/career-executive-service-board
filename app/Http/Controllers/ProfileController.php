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
use App\Models\ProfileLibCities;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $sortBy = $request->input('sort_by', 'cesno'); // Default sorting by Ces No.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $personalData = PersonalData::query()
            ->where('lastname', "LIKE", "%$query%")
            ->orWhere('firstname',  "LIKE", "%$query%")
            ->orWhere('middlename',  "LIKE", "%$query%")
            ->orWhere('name_extension',  "LIKE", "%$query%")
            ->orWhere('cesno',  "LIKE", "%$query%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);

        return view('admin\201_profiling\view_profile\table', compact('personalData', 'query', 'sortBy', 'sortOrder'));
    }

    public function show($cesno)
    {
        $mainProfile = PersonalData::find($cesno);
        $birthdate = $mainProfile->birth_date;

        $profile_picture = $mainProfile->picture;

        if (!(Storage::disk('public')->exists('images/' . $profile_picture))) {
            $profile_picture = 'assets/placeholder.png';
        }

        $birthDate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
        $age = $currentDate->diffInYears($birthDate);

        return view(
            'admin.201_profiling.view_profile.partials.personal_data.form',
            compact('mainProfile', 'cesno', 'age', 'profile_picture')
        );
    }

    public function addProfile()
    {
        if (DB::table('profile_tblMain')->count() === 0) {
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
        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();

        return view('admin.201_profiling.create_profile.form', [
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
            'cities' => $cities,

        ]);
    }

    public function store(AddProfile201Req $request, $cesno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        DB::beginTransaction();

        try {

            $newProfile = PersonalData::create([

                'status' => $request->status,
                'title' => $request->title,
                'email' => $request->email,
                'lastname' => ucwords(strtolower($request->lastname)),
                'firstname' => ucwords(strtolower($request->firstname)),
                'name_extension' => $request->name_extension,
                'middlename' => ucwords(strtolower($request->middlename)),
                'middleinitial' => $request->mi,
                'nickname' => ucwords(strtolower($request->nickname)),
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

            // initializing infos for email to user
            $recipientEmail = $request->email;
            $password = Str::password(8, true, true, true, false);
            $hashedPassword = Hash::make($password);
            $imagePath = public_path('images/assets/branding.png');
            $loginLink = config('app.url');
            $type = "addProfile";

            $data = [
                'type' => $type,
                'email' => $recipientEmail,
                'password' => $password,
                'imagePath' => $imagePath,
                'loginLink' => $loginLink,
            ];
            // end initializing infos for email to user

            // making new account credentials for user
            $user = $newProfile->users()->Create([
                'email' => $newProfile->email,
                'password' => $hashedPassword,
                'is_active' => 'Active',
                'last_updated_by' => 'system encode',
                'encoder' => $encoder,
                'default_password_change' => 'true',
                'two_factor' => true,
            ]);

            // assigning default user role
            $user->assignRole('user');
            // end making account credentials for user

            // sending email
            Mail::to($recipientEmail)->send(new TempCred201($data));

            // Commit the transaction if all operations succeed
            DB::commit();

            return back()->with('message', 'New profile added!');
        } catch (\Exception $e) {
            // Rollback the transaction if any operation fails
            DB::rollBack();

            return back()->with('error', 'An error occurred while creating the user.');
        }

        return back()->with('message', 'New profile added!');
    }

    public function uploadAvatar(Request $request, $cesno)
    {
        $existingPerson = PersonalData::where('cesno', $cesno)->first();

        $validator = Validator::make($request->all(), [
            'imageInput' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Invalid file type!');
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
            $personalData = PersonalData::find($cesno);
            $lastName = $personalData->lastname;
            $firstName = $personalData->firstname;
            $middlename = $personalData->middlename;
            $personalDataFullName = $lastName . ", " . $firstName . " " . $middlename . "." . $imageFile->getClientOriginalExtension();
            $filename = $cesno . '-' . $personalDataFullName;

            // Save the image to the root folder
            $imageFile->move(public_path('images/'), $filename);

            $pathName = $filename;

            // Save the image path to the database
            $existingPerson->picture = $pathName;
            $existingPerson->save();

            return back()->with('message', 'Profile Picture Changed!');
        }

        // Handle the case when no file was uploaded
        return back()->with('error', 'No file was uploaded!');
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
        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();

        return view('admin.201_profiling.view_profile.partials.personal_data.edit', [
            'cesno' => $cesno,
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
            'cities' => $cities,

        ]);
    }

    public function update(AddProfile201Req $request, $cesno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $middleName = $request->middlename;
        $middleInitial = $this->extractMiddleInitial($middleName);

        DB::beginTransaction();

        try {

            $personalData = PersonalData::find($cesno);
            $personalData->status = $request->status;
            $personalData->title = $request->title;
            $personalData->email = $request->email;
            $personalData->lastname = ucwords(strtolower($request->lastname));
            $personalData->firstname = ucwords(strtolower($request->firstname));
            $personalData->name_extension = $request->name_extension;
            $personalData->middlename = ucwords(strtolower($request->middlename));
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

            // Get the user based on the $cesno
            $user = User::where('personal_data_cesno', $cesno)->first();

            if($user){
                // Update the user email
                $user->email = $request->email;
                $user->save();
            }

            // Commit the transaction if all operations succeed
            DB::commit();

            return back()->with('info', 'Profile Updated!');
        } catch (\Exception $e) {
            // Rollback the transaction if any operation fails
            DB::rollBack();

            return back()->with('error', 'An error occurred while updating.');
        }

        return back()->with('info', 'Profile Updated!');
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

        return view(
            'admin.201_profiling.view_profile.partials.personal_data.settings',
            compact('mainProfile', 'cesno', 'age')
        );
    }

    public function changePassword(Request $request, $cesno)
    {

        $credentials = $request->validate([
            'password' => ['required', Password::min(8)
                            ->letters()
                            ->mixedCase()
                            ->numbers()
                            ->symbols()
                            ->uncompromised()],
        ]);

        // Get the user based on the $cesno
        $user = User::where('personal_data_cesno', $cesno)->first();

        // Check if the current password is correct
        if (!Hash::check($request->currentPassword, $user->password)) {
            return redirect()->back()->with('error', 'Incorrect current password!');
        }

        // Check if the new password and confirmation match
        if ($request->password !== $request->confirmPassword) {
            return redirect()->back()->with('error', 'Passwords do not match!');
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('message', 'Password changed successfully');
    }

    public function resendEmail(Request $request, $cesno)
    {

        /** @var \App\Models\User $encoder */
        $encoder = Auth::user();
        $encoder = $encoder->userName();

        // Get the user based on the $cesno
        $user = User::where('personal_data_cesno', $cesno)->first();
        $cooldownMinutes = 1; // Adjust as needed
        if ($user && $user->updated_at->addMinutes($cooldownMinutes)->isFuture()) {
            return redirect()->back()->with('info','New Credentials Email Already Sent');
        }

        // initializing infos for email to user
        $recipientEmail = $request->email;
        $password = Str::password(8, true, true, true, false);
        $hashedPassword = Hash::make($password);
        $imagePath = public_path('images/assets/branding.png');
        $loginLink = config('app.url');
        $type = "forgotPassword";

        $data = [
            'type' => $type,
            'email' => $recipientEmail,
            'password' => $password,
            'imagePath' => $imagePath,
            'loginLink' => $loginLink,
        ];
        // end initializing infos for email to user

        DB::beginTransaction();

        try {

            if($user){

                // Update the user's password
                $user->password = $hashedPassword;
                $user->save();

            }else{

                $newProfile = PersonalData::find($cesno);

                // making new account credentials for user
                $user = $newProfile->users()->Create([
                    'email' => $newProfile->email,
                    'password' => $hashedPassword,
                    'is_active' => 'Active',
                    'last_updated_by' => 'system encode',
                    'encoder' => $encoder,
                    'default_password_change' => 'true',
                    'two_factor' => true,
                ]);

                // assigning default user role
                $user->assignRole('user');
                // end making account credentials for user

            }
            

            // sending email
            Mail::to($recipientEmail)->send(new TempCred201($data));

            // Commit the transaction if all operations succeed
            DB::commit();

            return redirect()->back()->with('message', 'New Credentials Email Sent');
        } catch (\Exception $e) {
            // Rollback the transaction if any operation fails
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while sending email.');
        }

        return redirect()->back()->with('message', 'New Credentials Email Sent');
    }

    public function switchTwoFactor()
    {

        $ctrlno = auth()->user()->ctrlno;

        $user = User::where('ctrlno', $ctrlno)->first();

        if ($user) {
            // Toggle the 'two_factor' column value
            $user->update([
                'two_factor' => !$user->two_factor,
            ]);

            return redirect()->back()->with('success', 'Two-Factor Authentication toggled successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }
}
