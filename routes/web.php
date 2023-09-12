<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\ApprovedFileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AwardAndCitationController;
use App\Http\Controllers\CaseRecordController;
use App\Http\Controllers\CESTraining201Controller;
use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\Competency\CompetencyController;
use App\Http\Controllers\Competency\ContactInformationController;
use App\Http\Controllers\Competency\FieldSpecializationController;
use App\Http\Controllers\Competency\CompetencyOtherTrainingManagementController;
use App\Http\Controllers\Competency\ResourceSpeakerController;
use App\Http\Controllers\Competency\TrainingCategoryController;
use App\Http\Controllers\Competency\TrainingParticipantsController;
use App\Http\Controllers\Competency\TrainingProviderManagerController;
use App\Http\Controllers\Competency\TrainingSecretariatController;
use App\Http\Controllers\Competency\TrainingVenueManagerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\DeclineFileController;
use App\Http\Controllers\EducationalAttainmentController;
use App\Http\Controllers\EligibilityAndRankTrackerController;
use App\Http\Controllers\ExaminationTakenController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\GenderByBirthController;
use App\Http\Controllers\GenderByChoiceController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\IndigenousGroupController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\OtherTrainingController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\Plantilla\AgencyLocationManagerController;
use App\Http\Controllers\Plantilla\AppointeeOccupantBrowserController;
use App\Http\Controllers\Plantilla\AppointeeOccupantManagerController;
use App\Http\Controllers\Plantilla\DepartmentAgencyManagerController;
use App\Http\Controllers\Plantilla\OfficeManagerController;
use App\Http\Controllers\Plantilla\PlantillaManagementController;
use App\Http\Controllers\Plantilla\PlantillaPositionManagerController;
use App\Http\Controllers\Plantilla\SectorManagerController;
use App\Http\Controllers\ProfileLibTblEducDegreeController;
use App\Http\Controllers\ProfileLibTblEducSchoolController;
use App\Http\Controllers\ProfileLibTblEducMajorController;
use App\Http\Controllers\PWDController;
use App\Http\Controllers\RecordStatusController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\ResearchAndStudiesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\WorkExperienceController;
use App\Mail\TempCred201;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

// email preview
Route::get('/preview-email', function () {

    $imagePath = public_path('images/branding.png');
    $loginLink = config('app.url');
    $data = [
        'email' => 'recipient@example.com',
        'password' => 'temporary_password',
        'imagePath' => $imagePath,
        'loginLink' => $loginLink,
    ];

    return new TempCred201($data);
});
// end

// login route and redirect to dashboard if authenticated
Route::get('/', function () {

    if (!Auth::check()) {
        return redirect()->route('login');
    } else {
        return Redirect::to('/dashboard');
    }
});
// end login route and redirect to dashboard if authenticated

// auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'userLogout']);
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/send-new-password', [AuthController::class, 'sendPassword'])->name('sendPassword');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// end auth

Route::get('competency-data', [CompetencyController::class, 'index'])->name('competency-data.index');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'getAllData'])->name('dashboard');

    // Profile routes (201)
    Route::prefix('201-profile')->group(function () {

        Route::prefix('personal-data')->group(function () {

            Route::get('create', [ProfileController::class, 'addProfile'])->name('profile.add')->middleware('checkPermission:personal_data_add');
            Route::post('create/{cesno}', [ProfileController::class, 'store'])->name('add-profile-201')->middleware('checkPermission:personal_data_add');
            Route::get('list', [ProfileController::class, 'index'])->name('view-profile-201.index')->middleware('checkPermission:personal_data_view');
            Route::get('show/{cesno}', [ProfileController::class, 'show'])->name('personal-data.show');
            Route::post('upload-avatar-profile-201/{cesno}', [ProfileController::class, 'uploadAvatar'])->name('/upload-avatar-profile-201')->middleware('checkPermission:personal_data_edit');
            Route::get('edit/{cesno}', [ProfileController::class, 'editProfile'])->name('profile.edit')->middleware('checkPermission:personal_data_edit');
            Route::post('update/{cesno}', [ProfileController::class, 'update'])->name('edit-profile-201')->middleware('checkPermission:personal_data_edit');
            Route::get('settings/{cesno}', [ProfileController::class, 'settings'])->name('profile.settings');
            Route::post('change-password/{cesno}', [ProfileController::class, 'changePassword'])->name('change.password');
            Route::post('resend-email/{cesno}', [ProfileController::class, 'resendEmail'])->name('resend-email');
        });

        Route::prefix('family-profile')->group(function () {
            Route::get('show/{cesno}', [FamilyController::class, 'show'])->name('family-profile.show')->middleware('checkPermission:family_profile_view');
            Route::get('recently-deleted/{cesno}', [FamilyController::class, 'familyProfileRecentlyDeleted'])->name('family-profile.recently-deleted')->middleware('checkPermission:family_profile_delete');

            Route::prefix('spouse')->group(function () {
                Route::get('edit/{ctrlno}/{cesno}', [FamilyController::class, 'editSpouse'])->name('family-profile.editSpouse')->middleware('checkPermission:family_profile_edit');
                Route::post('store/{cesno}', [FamilyController::class, 'storeSpouse'])->name('family-profile.store')->middleware('checkPermission:family_profile_add');
                Route::put('update/{ctrlno}', [FamilyController::class, 'updateSpouseRecord'])->name('family-profile.updateSpouseRecord')->middleware('checkPermission:family_profile_edit');
                Route::delete('destroy/{ctrlno}', [FamilyController::class, 'destroySpouse'])->name('family-profile-spouse.delete')->middleware('checkPermission:family_profile_delete');
                Route::post('recently-deleted/restore/{ctrlno}', [FamilyController::class, 'spouseRestore'])->name('family-profile-spouse.restore')->middleware('checkPermission:family_profile_delete');
                Route::delete('recently-deleted/force-delete/{ctrlno}', [FamilyController::class, 'spouseForceDelete'])->name('family-profile-spouse.forceDelete')->middleware('checkPermission:family_profile_delete');
            });

            Route::prefix('children')->group(function () {
                Route::get('edit/{ctrlno}/{cesno}', [FamilyController::class, 'editChildren'])->name('family-profile.editChildren')->middleware('checkPermission:family_profile_edit');
                Route::post('{cesno}', [FamilyController::class, 'storeChildren'])->name('family-profile-children.store')->middleware('checkPermission:family_profile_add');
                Route::put('{ctrlno}', [FamilyController::class, 'updateChildrenRecord'])->name('family-profile.updateChildren')->middleware('checkPermission:family_profile_edit');
                Route::delete('{ctrlno}', [FamilyController::class, 'destroyChildren'])->name('family-profile-children.delete')->middleware('checkPermission:family_profile_delete');
                Route::post('recently-deleted/restore/{ctrlno}', [FamilyController::class, 'childrenRestore'])->name('family-profile-children.restore')->middleware('checkPermission:family_profile_delete');
                Route::delete('recently-deleted/force-delete/{ctrlno}', [FamilyController::class, 'childrenForceDelete'])->name('family-profile-children.forceDelete')->middleware('checkPermission:family_profile_delete');
            });

            Route::prefix('father')->group(function () {
                Route::get('edit/{ctrlno}/{cesno}', [FamilyController::class, 'editFather'])->name('family-profile-father.editFather')->middleware('checkPermission:family_profile_edit');
                Route::post('store/{cesno}', [FamilyController::class, 'storeFather'])->name('family-profile-father.store')->middleware('checkPermission:family_profile_add');
                Route::put('{ctrlno}', [FamilyController::class, 'updateFatherRecord'])->name('family-profile-father.updateFatherRecord')->middleware('checkPermission:family_profile_edit');
                Route::delete('delete/{ctrlno}', [FamilyController::class, 'destroyFather'])->name('family-profile-father.destroy')->middleware('checkPermission:family_profile_delete');
                Route::post('recently-deleted/father-restore/{ctrlno}', [FamilyController::class, 'fatherRestore'])->name('family-profile-father.fatherRestore')->middleware('checkPermission:family_profile_delete');
                Route::delete('recently-deleted/force-delete/{ctrlno}', [FamilyController::class, 'fatherForceDelete'])->name('family-profile-father.fatherForceDelete')->middleware('checkPermission:family_profile_delete');
            });

            Route::prefix('mother')->group(function () {
                Route::get('edit/{ctrlno}/{cesno}', [FamilyController::class, 'editMother'])->name('family-profile-mother.editMother')->middleware('checkPermission:family_profile_edit');
                Route::post('{cesno}', [FamilyController::class, 'storeMother'])->name('family-profile-mother.store')->middleware('checkPermission:family_profile_add');
                Route::put('{ctrlno}', [FamilyController::class, 'updateMotherRecord'])->name('family-profile-mother.updateMotherRecord')->middleware('checkPermission:family_profile_edit');
                Route::delete('{ctrlno}', [FamilyController::class, 'destroyMother'])->name('family-profile-mother.destroy')->middleware('checkPermission:family_profile_delete');
            });
        });

        Route::prefix('address')->group(function () {
            Route::get('show/{cesno}', [AddressController::class, 'show'])->name('personal-data-address.show')->middleware('checkPermission:personal_data_view');
            Route::post('/add-address-permanent-201/{cesno}', [AddressController::class, 'addAddressPermanent'])->name('add-address-permanent-201')->middleware('checkPermission:personal_data_add');
            Route::post('/add-address-mailing-201/{cesno}', [AddressController::class, 'addAddressMailing'])->name('add-address-mailing-201')->middleware('checkPermission:personal_data_add');
            Route::post('/add-address-temporary-201/{cesno}', [AddressController::class, 'addAddressTemporary'])->name('add-address-temporary-201')->middleware('checkPermission:personal_data_add');
            Route::delete('destroy/{ctrlno}', [AddressController::class, 'destroy'])->name('personal-data-address.delete')->middleware('checkPermission:personal_data_delete');

            // Route::post('store/{cesno}', [AddressController::class, 'store'])->name('personal-data-address.store');
            // Route::post('update/{ctrlno}/{cesno}', [AddressController::class, 'update'])->name('personal-data-address.update');
            // Route::get('edit/{ctrlno}', [AddressController::class, 'edit'])->name('personal-data-address.edit');
            // Route::delete('destroy/{ctrlno}', [AddressController::class, 'destroy'])->name('personal-data-address.destroy');
        });

        Route::prefix('identification/card')->group(function () {
            Route::get('show/{cesno}', [IdentificationController::class, 'show'])->name('personal-data-identification.show')->middleware('checkPermission:personal_data_view');
            Route::post('store/{cesno}', [IdentificationController::class, 'store'])->name('personal-data-identification.store')->middleware('checkPermission:personal_data_add');
            Route::post('update/{ctrlno}/{cesno}', [IdentificationController::class, 'update'])->name('personal-data-identification.update')->middleware('checkPermission:personal_data_edit');
            Route::get('edit/{ctrlno}', [IdentificationController::class, 'edit'])->name('personal-data-identification.edit')->middleware('checkPermission:personal_data_edit');
            Route::delete('destroy/{ctrlno}', [IdentificationController::class, 'destroyIdentification'])->name('personal-data-identification.destroy')->middleware('checkPermission:personal_data_delete');
        });

        Route::prefix('contact-information')->group(function () {
            Route::get('show/{cesno}', [ContactInfoController::class, 'show'])->name('contact-info.show')->middleware('checkPermission:personal_data_view');
            Route::post('store/{cesno}', [ContactInfoController::class, 'store'])->name('contact-info.store')->middleware('checkPermission:personal_data_add');
            Route::post('update/{ctrlno}/{cesno}', [ContactInfoController::class, 'update'])->name('contact-info.update')->middleware('checkPermission:personal_data_edit');
        });

        Route::prefix('educational-attainment')->group(function () {
            Route::get('show/{cesno}', [EducationalAttainmentController::class, 'showForm'])->name('educational-attainment.form')->middleware('checkPermission:educational_attainment_view');
            Route::get('index/{cesno}', [EducationalAttainmentController::class, 'index'])->name('educational-attainment.index')->middleware('checkPermission:educational_attainment_view');
            Route::get('edit/{ctrlno}/{cesno}', [EducationalAttainmentController::class, 'edit'])->name('educational-attainment.edit')->middleware('checkPermission:educational_attainment_edit');
            Route::post('store/{cesno}', [EducationalAttainmentController::class, 'storeEducationAttainment'])->name('educational-attainment.store')->middleware('checkPermission:educational_attainment_add');
            Route::put('updated/{ctrlno}', [EducationalAttainmentController::class, 'update'])->name('educational-attainment.update')->middleware('checkPermission:educational_attainment_edit');
            Route::delete('destroy/{ctrlno}', [EducationalAttainmentController::class, 'destroyEducationalAttainment'])->name('educational-attainment.destroy')->middleware('checkPermission:educational_attainment_delete');
            Route::get('recently-deleted/{cesno}', [EducationalAttainmentController::class, 'recycleBin'])->name('educational-attainment.recycleBin')->middleware('checkPermission:educational_attainment_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [EducationalAttainmentController::class, 'restore'])->name('educational-attainment.restore')->middleware('checkPermission:educational_attainment_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [EducationalAttainmentController::class, 'forceDelete'])->name('educational-attainment.forceDelete')->middleware('checkPermission:educational_attainment_delete');
        });

        Route::prefix('examination-taken')->group(function () {
            Route::get('create/{cesno}', [ExaminationTakenController::class, 'create'])->name('examination-taken.create')->middleware('checkPermission:examinations_taken_add');
            Route::get('index/{cesno}', [ExaminationTakenController::class, 'index'])->name('examination-taken.index')->middleware('checkPermission:examinations_taken_view');
            Route::get('edit/{ctrlno}/{cesno}', [ExaminationTakenController::class, 'edit'])->name('examination-taken.edit')->middleware('checkPermission:examinations_taken_edit');
            Route::post('store/{cesno}', [ExaminationTakenController::class, 'store'])->name('examination-taken.store')->middleware('checkPermission:examinations_taken_add');
            Route::put('update/{ctrlno}/{cesno}', [ExaminationTakenController::class, 'update'])->name('examination-taken.update')->middleware('checkPermission:examinations_taken_edit');
            Route::delete('taken/delete/{ctrlno}', [ExaminationTakenController::class, 'destroy'])->name('examination-taken.destroy')->middleware('checkPermission:examinations_taken_delete');
            Route::get('recently-deleted/{cesno}', [ExaminationTakenController::class, 'recentlyDeleted'])->name('examination-taken.recentlyDeleted')->middleware('checkPermission:examinations_taken_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [ExaminationTakenController::class, 'restore'])->name('examination-taken.restore')->middleware('checkPermission:examinations_taken_delete');
            Route::delete('recently-deleted/force-deleted/{ctrlno}', [ExaminationTakenController::class, 'forceDelete'])->name('examination-taken.forceDelete')->middleware('checkPermission:examinations_taken_delete');
        });

        Route::prefix('scholarship-taken')->group(function () {
            Route::get('create/{cesno}', [ScholarshipController::class, 'create'])->name('scholarship.create');
            Route::get('index/{cesno}', [ScholarshipController::class, 'index'])->name('scholarship.index');
            Route::get('edit/{ctrlno}/{cesno}', [ScholarshipController::class, 'edit'])->name('scholarship.edit');
            Route::post('store/{cesno}', [ScholarshipController::class, 'store'])->name('scholarship.store');
            Route::put('update/{ctrlno}/{cesno}', [ScholarshipController::class, 'update'])->name('scholarship.update');
            Route::delete('destroy/{ctrlno}', [ScholarshipController::class, 'destroy'])->name('scholarship.destroy');
            Route::get('recently-deleted/{cesno}', [ScholarshipController::class, 'recycleBin'])->name('scholarship.recycleBin');
            Route::post('recently-deleted/restore/{ctrlno}', [ScholarshipController::class, 'restore'])->name('scholarship.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [ScholarshipController::class, 'forceDelete'])->name('scholarship.forceDelete');
        });

        Route::prefix('research-studies')->group(function () {
            Route::get('index/{cesno}', [ResearchAndStudiesController::class, 'index'])->name('research-studies.index');
            Route::get('create/{cesno}', [ResearchAndStudiesController::class, 'create'])->name('research-studies.create');
            Route::get('edit/{ctrlno}/{cesno}', [ResearchAndStudiesController::class, 'edit'])->name('research-studies.edit');
            Route::post('store/{cesno}', [ResearchAndStudiesController::class, 'store'])->name('research-studies.store');
            Route::put('update/{ctrlno}/{cesno}', [ResearchAndStudiesController::class, 'update'])->name('research-studies.update');
            Route::delete('destroy/{ctrlno}', [ResearchAndStudiesController::class, 'destroy'])->name('research-studies.destroy');
            Route::get('recently-deleted/{cesno}', [ResearchAndStudiesController::class, 'recycleBin'])->name('research-studies.recycleBin');
            Route::post('recently-deleted/restore/{ctrlno}', [ResearchAndStudiesController::class, 'restore'])->name('research-studies.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [ResearchAndStudiesController::class, 'forceDelete'])->name('research-studies.forceDelete');
        });

        Route::prefix('work-experience')->group(function () {
            Route::get('create/{cesno}', [WorkExperienceController::class, 'create'])->name('work-experience.create');
            Route::get('index/{cesno}', [WorkExperienceController::class, 'index'])->name('work-experience.index');
            Route::get('edit/{ctrlno}/{cesno}', [WorkExperienceController::class, 'edit'])->name('work-experience.edit');
            Route::post('store/{cesno}', [WorkExperienceController::class, 'store'])->name('work-experience.store');
            Route::put('update/{ctrlno}/{cesno}', [WorkExperienceController::class, 'update'])->name('work-experience.update');
            Route::delete('destroy/{ctrlno}', [WorkExperienceController::class, 'destroy'])->name('work-experience.destroy');
            Route::get('recently-deleted/{cesno}', [WorkExperienceController::class, 'recycleBin'])->name('work-experience.recycleBin');
            Route::post('recently-deleted/restore/{ctrlno}', [WorkExperienceController::class, 'restore'])->name('work-experience.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [WorkExperienceController::class, 'forceDelete'])->name('work-experience.forceDelete');
        });

        Route::prefix('award-citation')->group(function () {
            Route::get('index/{cesno}', [AwardAndCitationController::class, 'index'])->name('award-citation.index');
            Route::get('create/{cesno}', [AwardAndCitationController::class, 'create'])->name('award-citation.create');
            Route::get('edit/{ctrlno}/{cesno}', [AwardAndCitationController::class, 'edit'])->name('award-citation.edit');
            Route::post('store/{cesno}', [AwardAndCitationController::class, 'store'])->name('award-citation.store');
            Route::put('update/{ctrlno}/{cesno}', [AwardAndCitationController::class, 'update'])->name('award-citation.update');
            Route::delete('delete/{ctrlno}', [AwardAndCitationController::class, 'destroy'])->name('award-citation.destroy');
            Route::get('recently-deleted/{cesno}', [AwardAndCitationController::class, 'recentlyDeleted'])->name('award-citation.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [AwardAndCitationController::class, 'restore'])->name('award-citation.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [AwardAndCitationController::class, 'forceDelete'])->name('award-citation.forceDelete');
        });

        Route::prefix('affiliation')->group(function () {
            Route::get('index/{cesno}', [AffiliationController::class, 'index'])->name('affiliation.index');
            Route::get('create/{cesno}', [AffiliationController::class, 'create'])->name('affiliation.create');
            Route::get('edit/{ctrlno}/{cesno}', [AffiliationController::class, 'edit'])->name('affiliation.edit');
            Route::post('save/{cesno}', [AffiliationController::class, 'store'])->name('affiliation.store');
            Route::put('update/{ctrlno}/{cesno}', [AffiliationController::class, 'update'])->name('affiliation.update');
            Route::delete('destroy/{ctrlno}', [AffiliationController::class, 'destroy'])->name('affiliation.destroy');
            Route::get('recently-deleted/{cesno}', [AffiliationController::class, 'recycleBin'])->name('affiliations.recycleBin');
            Route::post('restore/{ctrlno}', [AffiliationController::class, 'restore'])->name('affiliation.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [AffiliationController::class, 'forceDelete'])->name('affiliation.forceDelete');
        });

        Route::prefix('case-record')->group(function () {
            Route::get('index/{cesno}', [CaseRecordController::class, 'index'])->name('case-record.index');
            Route::get('create/{cesno}', [CaseRecordController::class, 'create'])->name('case-record.create');
            Route::get('edit/{ctrlno}/{cesno}', [CaseRecordController::class, 'edit'])->name('case-record.edit');
            Route::post('store/{cesno}', [CaseRecordController::class, 'store'])->name('case-record.store');
            Route::put('update/{ctrlno}/{cesno}', [CaseRecordController::class, 'update'])->name('case-record.update');
            Route::delete('destroy/{ctrlno}', [CaseRecordController::class, 'destroy'])->name('case-record.destroy');
            Route::get('recently-deleted/{cesno}', [CaseRecordController::class, 'recentlyDeleted'])->name('case-record.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [CaseRecordController::class, 'restore'])->name('case-record.restore');
            Route::delete('recently-deleted/force-deleted/{ctrlno}', [CaseRecordController::class, 'forceDelete'])->name('case-record.forceDelete');
        });

        Route::prefix('health-record')->group(function () {
            Route::get('index/{cesno}', [HealthRecordController::class, 'index'])->name('health-record.index');
            Route::post('{cesno}', [HealthRecordController::class, 'store'])->name('health-record.store');
            Route::delete('{ctrlno}', [HealthRecordController::class, 'destroy'])->name('health-record.destroy');
        });

        Route::prefix('medical-history')->group(function () {
            Route::post('{cesno}', [MedicalHistoryController::class, 'store'])->name('medical-history.store');
            Route::delete('{ctrlno}', [MedicalHistoryController::class, 'destroy'])->name('medical-history.destroy');
        });

        Route::prefix('expertise')->group(function () {
            Route::get('create/{cesno}', [ExpertiseController::class, 'create'])->name('expertise.create');
            Route::get('index/{cesno}', [ExpertiseController::class, 'index'])->name('expertise.index');
            Route::get('edit/{cesno}/{ctrlno}', [ExpertiseController::class, 'edit'])->name('expertise.edit');
            Route::post('store/{cesno}', [ExpertiseController::class, 'store'])->name('expertise.store');
            Route::put('update/{cesno}/{ctrlno}', [ExpertiseController::class, 'update'])->name('expertise.update');
            Route::delete('destroy/{ctrlno}', [ExpertiseController::class, 'destroy'])->name('expertise.destroy');
            Route::get('recently-deleted/{cesno}', [ExpertiseController::class, 'recentlyDeleted'])->name('expertise.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [ExpertiseController::class, 'restore'])->name('expertise.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [ExpertiseController::class, 'forceDelete'])->name('expertise.forceDelete');
        });

        Route::prefix('language')->group(function () {
            Route::get('index/{cesno}', [LanguageController::class, 'index'])->name('language.index');
            Route::get('edit/{ctrlno}/{cesno}', [LanguageController::class, 'edit'])->name('language.edit');
            Route::post('store/{cesno}', [LanguageController::class, 'store'])->name('language.store');
            Route::put('update/{cesno}/{ctrlno}', [LanguageController::class, 'update'])->name('language.update');
            Route::delete('destroy/{ctrlno}', [LanguageController::class, 'destroy'])->name('language.destroy');
            Route::get('recently-deleted/{cesno}', [LanguageController::class, 'recentlyDeleted'])->name('language.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [LanguageController::class, 'restore'])->name('language.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [LanguageController::class, 'forceDelete'])->name('language.forceDelete');
        });

        Route::prefix('ces-training-201')->group(function () {
            Route::get('index/{cesno}', [CESTraining201Controller::class, 'index'])->name('ces-training-201.index');
            Route::get('create/{cesno}', [CESTraining201Controller::class, 'create'])->name('ces-training-201.create');
            Route::post('store/{cesno}', [CESTraining201Controller::class, 'store'])->name('ces-training-201.store');
            Route::get('edit/{cesno}/{ctrlno}', [CESTraining201Controller::class, 'edit'])->name('ces-training-201.edit');
            Route::put('update/{cesno}/{ctrlno}', [CESTraining201Controller::class, 'update'])->name('ces-training-201.update');
            Route::delete('destroy/{ctrlno}', [CESTraining201Controller::class, 'destroy'])->name('ces-training-201.destroy');
            Route::get('recently-deleted/{cesno}', [CESTraining201Controller::class, 'recentlyDeleted'])->name('ces-training-201.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [CESTraining201Controller::class, 'restore'])->name('ces-training-201.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [CESTraining201Controller::class, 'forceDelete'])->name('ces-training-201.forceDelete');
        });

        Route::prefix('non-accredited-ces-training')->group(function () {
            Route::get('create/{cesno}', [OtherTrainingController::class, 'create'])->name('other-training.create');
            Route::get('index/{cesno}', [OtherTrainingController::class, 'index'])->name('other-training.index');
            Route::get('edit/{ctrlno}/{cesno}', [OtherTrainingController::class, 'edit'])->name('other-training.edit');
            Route::post('store/{cesno}', [OtherTrainingController::class, 'store'])->name('other-training.store');
            Route::put('update/{ctrlno}/{cesno}', [OtherTrainingController::class, 'update'])->name('other-training.update');
            Route::delete('destroy/{ctrlno}', [OtherTrainingController::class, 'destroy'])->name('other-training.destroy');
            Route::get('recently-deleted/{cesno}', [OtherTrainingController::class, 'recentlyDeleted'])->name('other-training.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [OtherTrainingController::class, 'restore'])->name('other-training.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [OtherTrainingController::class, 'forceDelete'])->name('other-training.forceDelete');
            Route::get('edit-competency-non-ces-training/{ctrlno}/{cesno}', [OtherTrainingController::class, 'editCompetencyNonCesTraining'])->name('other-training.editCompetencyNonCesTraining');
            Route::put('update-competency-non-ces-training/{ctrlno}/{cesno}', [OtherTrainingController::class, 'updateCompetencyNonCesTraining'])->name('other-training.updateCompetencyNonCesTraining');
            Route::delete('destroy-competency-non-ces-training{ctrlno}', [OtherTrainingController::class, 'destroyCompetencyNonCesTraining'])->name('other-training.destroyCompetencyNonCesTraining');
            Route::post('recently-deleted/restore-competency-non-ces-training/{ctrlno}', [OtherTrainingController::class, 'restoreCompetencyNonCesTraining'])->name('other-training.restoreCompetencyNonCesTraining');
            Route::delete('recently-deleted/force-delete-competency-non-ces-training{ctrlno}', [OtherTrainingController::class, 'forceDeleteCompetencyNonCesTraining'])->name('other-training.forceDeleteCompetencyNonCesTraining');
        });

        Route::prefix('eligibility-rank-tracker')->group(function () {
            Route::get('written-exam/{cesno}', [EligibilityAndRankTrackerController::class, 'cesWeIndex'])->name('eligibility-rank-tracker.cesWeIndex');
            Route::get('index/{cesno}', [EligibilityAndRankTrackerController::class, 'index'])->name('eligibility-rank-tracker.index');
            Route::get('create/{cesno}', [EligibilityAndRankTrackerController::class, 'create'])->name('eligibility-rank-tracker.create');
            Route::get('edit/{ctrlno}/{cesno}', [EligibilityAndRankTrackerController::class, 'edit'])->name('eligibility-rank-tracker.edit');
            Route::post('store/{cesno}', [EligibilityAndRankTrackerController::class, 'store'])->name('eligibility-rank-tracker.store');
            Route::put('update/{ctrlno}/{cesno}', [EligibilityAndRankTrackerController::class, 'update'])->name('eligibility-rank-tracker.update');
            Route::delete('destroy/{ctrlno}', [EligibilityAndRankTrackerController::class, 'destroy'])->name('eligibility-rank-tracker.destroy');
            Route::get('recently-deleted/{cesno}', [EligibilityAndRankTrackerController::class, 'recentlyDeleted'])->name('eligibility-rank-tracker.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [EligibilityAndRankTrackerController::class, 'restore'])->name('eligibility-rank-tracker.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [EligibilityAndRankTrackerController::class, 'forceDelete'])->name('eligibility-rank-tracker.forceDelete');
        });

        Route::prefix('pdf-file')->group(function () {
            Route::get('pending-files', [PDFController::class, 'pendingFiles'])->name('show-pending-pdf-files.pendingFiles');
            Route::post('accepted-file/{ctrlno}/{cesno}', [PDFController::class, 'acceptedFiles'])->name('show-pdf-files.acceptedFiles');
            Route::post('download-pending-file/{ctrlno}/{fileName}', [PDFController::class, 'downloadPendingFile'])->name('downloadPendingFile');
            Route::delete('decline-file/{ctrlno}', [DeclineFileController::class, 'declineFile'])->name('declineFile');
            Route::delete('declined-file-force-delete/{ctrlno}', [DeclineFileController::class, 'declineFileForceDelete'])->name('show-pdf-files.declineFileForceDelete');
            Route::get('recently-decline-file', [DeclineFileController::class, 'recentlyDeclineFile'])->name('show-pdf-files.recentlyDeclineFiles');
            Route::get('index/{cesno}', [PDFController::class, 'index'])->name('show-pdf-files.index');
            Route::get('create/{cesno}', [PDFController::class, 'create'])->name('show-pdf-files.create');
            Route::post('store/{cesno}', [PDFController::class, 'store'])->name('show-pdf-files.store');
            Route::post('download-approved-file/{ctrlno}/{fileName}', [PDFController::class, 'download'])->name('downloadApprovedFile');
            Route::delete('destroy/{ctrlno}', [PDFController::class, 'destroy'])->name('show-pdf-files.destroy');
            Route::get('recently-deleted/{cesno}', [PDFController::class, 'recentlyDeleted'])->name('show-pdf-files.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [PDFController::class, 'restore'])->name('show-pdf-files.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [PDFController::class, 'forceDelete'])->name('show-pdf-files.forceDelete');
            Route::get('approved-files', [ApprovedFileController::class, 'approvedFile'])->name('show-approved-pdf-files.approvedFile');
            Route::post('stream-approved-file/{ctrlno}/{fileName}', [ApprovedFileController::class, 'streamApprovedFile'])->name('streamApprovedFile');
        });
    });
    // End of profile routes

    // Plantilla routes
    Route::prefix('plantilla')->group(function () {

        Route::prefix('plantilla-management')->group(function () {
            Route::get('/', [PlantillaManagementController::class, 'index'])->name('plantilla-management.index');
        });

        Route::prefix('sector-manager')->group(function () {
            Route::get('/', [SectorManagerController::class, 'index'])->name('sector-manager.index');

            Route::get('recently_deleted', [SectorManagerController::class, 'recentlyDeleted'])->name('sector-manager.recentlyDeleted');
            Route::get('create', [SectorManagerController::class, 'create'])->name('sector-manager.create');
            Route::post('store', [SectorManagerController::class, 'store'])->name('sector-manager.store');
            Route::get('{sectorid}', [SectorManagerController::class, 'edit'])->name('sector-manager.edit');
            Route::post('{sectorid}/update', [SectorManagerController::class, 'update'])->name('sector-manager.update');
            Route::delete('{sectorid}/destroy', [SectorManagerController::class, 'destroy'])->name('sector-manager.destroy');
            Route::post('{sectorid}/restore', [SectorManagerController::class, 'restore'])->name('sector-manager.restore');
            Route::post('{sectorid}/force-delete', [SectorManagerController::class, 'forceDelete'])->name('sector-manager.forceDelete');
        });

        Route::prefix('department-agency-manager')->group(function () {
            Route::get('/', [DepartmentAgencyManagerController::class, 'index'])->name('department-agency-manager.index');
            Route::get('{sectorid}/show', [SectorManagerController::class, 'show'])->name('sector-manager.show');
            Route::post('store', [DepartmentAgencyManagerController::class, 'store'])->name('department-agency-manager.store');
            Route::get('{sectorid}/{deptid}', [DepartmentAgencyManagerController::class, 'showAgency'])->name('department-agency-manager.showAgency');
            Route::post('show/{sectorid}/agency/{deptid}/update', [DepartmentAgencyManagerController::class, 'updateAgency'])->name('department-agency-manager.updateAgency');
            Route::delete('{deptid}/destroy', [DepartmentAgencyManagerController::class, 'destroy'])->name('department-agency-manager.destroy');
            // Route::get('recently_deleted', [SectorManagerController::class, 'recentlyDeleted'])->name('sector-manager.recentlyDeleted');
            // Route::post('{sectorid}/restore', [SectorManagerController::class, 'restore'])->name('sector-manager.restore');
            // Route::post('{sectorid}/force-delete', [SectorManagerController::class, 'forceDelete'])->name('sector-manager.forceDelete');
        });

        Route::prefix('agency-location-manager')->group(function () {
            Route::get('/', [AgencyLocationManagerController::class, 'index'])->name('agency-location-manager.index');
            Route::get('{sectorid}/{deptid}/{officelocid}', [AgencyLocationManagerController::class, 'show'])->name('agency-location-manager.show');
            Route::post('{officelocid}/update', [AgencyLocationManagerController::class, 'update'])->name('agency-location-manager.update');
            Route::delete('/{officelocid}/destroy', [AgencyLocationManagerController::class, 'destroy'])->name('agency-location-manager.destroy');
            Route::post('store', [AgencyLocationManagerController::class, 'store'])->name('agency-location-manager.store');
        });

        Route::prefix('office-manager')->group(function () {
            Route::get('/', [OfficeManagerController::class, 'index'])->name('office-manager.index');
            Route::get('{sectorid}/{deptid}/{officelocid}/{officeid}', [OfficeManagerController::class, 'show'])->name('office-manager.show');
            Route::post('store', [OfficeManagerController::class, 'store'])->name('office-manager.store');
            Route::post('{officeid}/update', [OfficeManagerController::class, 'update'])->name('office-manager.update');
            Route::delete('/{officeid}/destroy', [OfficeManagerController::class, 'destroy'])->name('office-manager.destroy');
        });

        Route::prefix('plantilla-position-manager')->group(function () {
            Route::get('/', [PlantillaPositionManagerController::class, 'index'])->name('plantilla-position-manager.index');
        });

        Route::prefix('appointee-occupant-manager')->group(function () {
            Route::get('/', [AppointeeOccupantManagerController::class, 'index'])->name('appointee-occupant-manager.index');
        });
        Route::prefix('appointee-occupant-browser')->group(function () {
            Route::get('/', [AppointeeOccupantBrowserController::class, 'index'])->name('appointee-occupant-browser.index');
        });
    });
    // End of plantilla routes

    // Competency routes
    Route::prefix('competency')->group(function () {
        Route::prefix('personal-data')->group(function () {
            Route::get('competency-data', [CompetencyController::class, 'index'])->name('competency-data.index');
            Route::get('view-profile/{cesno}', [ContactInformationController::class, 'updateOrCreate'])->name('competency-view-profile.updateOrCreate');
            Route::post('store/{cesno}', [ContactInformationController::class, 'store'])->name('competency-view-profile-contact-info.store');
            Route::post('update/{ctrlno}/{cesno}', [ContactInformationController::class, 'update'])->name('competency-view-profile-contact-info.update');
            Route::put('update/{cesno}', [ContactInformationController::class, 'updateEmail'])->name('competency-contact-email.update');
        });

        Route::prefix('competency-non-ces-training-accredited')->group(function () {
            Route::get('index/{cesno}', [CompetencyOtherTrainingManagementController::class, 'index'])->name('non-ces-training-management.index');
            Route::get('create/{cesno}', [CompetencyOtherTrainingManagementController::class, 'create'])->name('non-ces-training-management.create');
            Route::post('store/{cesno}', [CompetencyOtherTrainingManagementController::class, 'store'])->name('non-ces-training-management.store');
            Route::get('edit/{ctrlno}/{cesno}', [CompetencyOtherTrainingManagementController::class, 'edit'])->name('non-ces-training-management.edit');
            Route::put('update/{ctrlno}/{cesno}', [CompetencyOtherTrainingManagementController::class, 'update'])->name('non-ces-training-management.update');
            Route::delete('destroy/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'destroy'])->name('non-ces-training-management.destroy');
            Route::get('recently-deleted/{cesno}', [CompetencyOtherTrainingManagementController::class, 'recentlyDeleted'])->name('non-ces-training-management.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'restore'])->name('non-ces-training-management.restore');
            Route::delete('forceDelete/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'forceDelete'])->name('non-ces-training-management.forceDelete');
            Route::get('edit-non-ces-training-201/{ctrlno}/{cesno}', [CompetencyOtherTrainingManagementController::class, 'editNonCesTraining201'])->name('non-ces-training-management.editNonCesTraining201');
            Route::put('update-non-ces-training-201/{ctrlno}/{cesno}', [CompetencyOtherTrainingManagementController::class, 'updateNonCesTraining201'])->name('non-ces-training-management.updateNonCesTraining201');
            Route::delete('destroy-non-ces-training-201/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'destroyNonCesTraining201'])->name('non-ces-training-management.destroyNonCesTraining201');
            Route::post('recently-deleted/restore-non-ces-training-201/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'restoreNonCesTraining201'])->name('non-ces-training-management.restoreNonCesTraining201');
            Route::delete('recently-deleted/force-delete-non-ces-training-201/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'forceDeleteNonCesTraining201'])->name('non-ces-training-management.forceDeleteNonCesTraining201');
        });

        Route::prefix('training-provider-manager')->group(function () {
            Route::get('index', [TrainingProviderManagerController::class, 'index'])->name('training-provider-manager.index');
            Route::get('create', [TrainingProviderManagerController::class, 'create'])->name('training-provider-manager.create');
            Route::post('store', [TrainingProviderManagerController::class, 'store'])->name('training-provider-manager.store');
            Route::get('edit/{ctrlno}', [TrainingProviderManagerController::class, 'edit'])->name('training-provider-manager.edit');
            Route::put('update/{ctrlno}', [TrainingProviderManagerController::class, 'update'])->name('training-provider-manager.update');
            Route::delete('destroy/{ctrlno}', [TrainingProviderManagerController::class, 'destroy'])->name('training-provider-manager.destroy');
            Route::get('recently-deleted', [TrainingProviderManagerController::class, 'recentlyDeleted'])->name('training-provider-manager.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [TrainingProviderManagerController::class, 'restore'])->name('training-provider-manager.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [TrainingProviderManagerController::class, 'forceDelete'])->name('training-provider-manager.forceDelete');
        });

        Route::prefix('training-venue-manager')->group(function () {
            Route::get('index', [TrainingVenueManagerController::class, 'index'])->name('training-venue-manager.index');
            Route::get('create', [TrainingVenueManagerController::class, 'create'])->name('training-venue-manager.create');
            Route::post('store', [TrainingVenueManagerController::class, 'store'])->name('training-venue-manager.store');
            Route::get('edit/{ctrlno}', [TrainingVenueManagerController::class, 'edit'])->name('training-venue-manager.edit');
            Route::put('update/{ctrlno}', [TrainingVenueManagerController::class, 'update'])->name('training-venue-manager.update');
            Route::delete('destroy/{ctrlno}', [TrainingVenueManagerController::class, 'destroy'])->name('training-venue-manager.destroy');
            Route::get('recently-deleted', [TrainingVenueManagerController::class, 'recentlyDeleted'])->name('training-venue-manager.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [TrainingVenueManagerController::class, 'restore'])->name('training-venue-manager.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [TrainingVenueManagerController::class, 'forceDelete'])->name('training-venue-manager.forceDelete');
        });

        Route::prefix('training-category')->group(function () {
            Route::get('index', [TrainingCategoryController::class, 'index'])->name('training-category.index');
            Route::get('create', [TrainingCategoryController::class, 'create'])->name('training-category.create');
            Route::post('store', [TrainingCategoryController::class, 'store'])->name('training-category.store');
            Route::get('edit/{ctrlno}', [TrainingCategoryController::class, 'edit'])->name('training-category.edit');
            Route::put('update/{ctrlno}', [TrainingCategoryController::class, 'update'])->name('training-category.update');
            Route::delete('destroy/{ctrlno}', [TrainingCategoryController::class, 'destroy'])->name('training-category.destroy');
            Route::get('recentlyDeleted', [TrainingCategoryController::class, 'recentlyDeleted'])->name('training-category.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [TrainingCategoryController::class, 'restore'])->name('training-category.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [TrainingCategoryController::class, 'forceDelete'])->name('training-category.forceDelete');
        });

        Route::prefix('training-secretariat')->group(function () {
            Route::get('index', [TrainingSecretariatController::class, 'index'])->name('training-secretariat.index');
            Route::get('create', [TrainingSecretariatController::class, 'create'])->name('training-secretariat.create');
            Route::post('store', [TrainingSecretariatController::class, 'store'])->name('training-secretariat.store');
            Route::get('edit/{ctrlno}', [TrainingSecretariatController::class, 'edit'])->name('training-secretariat.edit');
            Route::put('update/{ctrlno}', [TrainingSecretariatController::class, 'update'])->name('training-secretariat.update');
            Route::delete('destroy/{ctrlno}', [TrainingSecretariatController::class, 'destroy'])->name('training-secretariat.destroy');
            Route::get('recentlyDeleted', [TrainingSecretariatController::class, 'recentlyDeleted'])->name('training-secretariat.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [TrainingSecretariatController::class, 'restore'])->name('training-secretariat.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [TrainingSecretariatController::class, 'forceDelete'])->name('training-secretariat.forceDelete');
        });

        Route::prefix('field-specialization')->group(function () {
            Route::get('index', [FieldSpecializationController::class, 'index'])->name('field-specialization.index');
            Route::get('create', [FieldSpecializationController::class, 'create'])->name('field-specialization.create');
            Route::post('store', [FieldSpecializationController::class, 'store'])->name('field-specialization.store');
            Route::get('edit/{ctrlno}', [FieldSpecializationController::class, 'edit'])->name('field-specialization.edit');
            Route::put('update/{ctrlno}', [FieldSpecializationController::class, 'update'])->name('field-specialization.update');
            Route::delete('destroy/{ctrlno}', [FieldSpecializationController::class, 'destroy'])->name('field-specialization.destroy');
            Route::get('recentlyDeleted', [FieldSpecializationController::class, 'recentlyDeleted'])->name('field-specialization.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [FieldSpecializationController::class, 'restore'])->name('field-specialization.restore');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [FieldSpecializationController::class, 'forceDelete'])->name('field-specialization.forceDelete');
        });

        Route::prefix('resource-speaker')->group(function () {
            Route::get('index', [ResourceSpeakerController::class, 'index'])->name('resource-speaker.index');
            Route::get('create', [ResourceSpeakerController::class, 'create'])->name('resource-speaker.create');
            Route::post('store', [ResourceSpeakerController::class, 'store'])->name('resource-speaker.store');
            Route::get('edit/{ctrlno}', [ResourceSpeakerController::class, 'edit'])->name('resource-speaker.edit');
            Route::put('update/{ctrlno}', [ResourceSpeakerController::class, 'update'])->name('resource-speaker.update');
            Route::delete('destroy/{ctrlno}', [ResourceSpeakerController::class, 'destroy'])->name('resource-speaker.destroy');
            Route::get('recently-deleted', [ResourceSpeakerController::class, 'recentlyDeleted'])->name('resource-speaker.recentlyDeleted');
            Route::post('recently-deleted/restore/{ctrlno}', [ResourceSpeakerController::class, 'restore'])->name('resource-speaker.restore');
            Route::delete('recently-deleted/forceDelete/{ctrlno}', [ResourceSpeakerController::class, 'forceDelete'])->name('resource-speaker.forceDelete');
            Route::get('training-enagagement/{ctrlno}', [ResourceSpeakerController::class, 'trainingEnagagement'])->name('resource-speaker.trainingEnagagement');
        });

        Route::prefix('training-session')->group(function () {
            Route::get('index', [TrainingSessionController::class, 'index'])->name('training-session.index');
            Route::get('participant-list/{sessionId}', [TrainingSessionController::class, 'participantList'])->name('training-session.participantList');
            Route::delete('participant-destroy/{pid}', [TrainingSessionController::class, 'destroyParticipant'])->name('training-participant.destroy');
            Route::get('recently-deleted-participant-list', [TrainingSessionController::class, 'recentlyDeletedParticipant'])->name('training-session.recentlyDeletedParticipant');
            Route::post('restore-participant-list/{pid}', [TrainingSessionController::class, 'restoreParticipantList'])->name('training-session.restoreParticipantList');
            Route::delete('force-delete-participant-list/{pid}', [TrainingSessionController::class, 'forceDeleteParticipantList'])->name('training-participant.forceDeleteParticipantList');
            Route::get('create', [TrainingSessionController::class, 'create'])->name('training-session.create');
            Route::post('store', [TrainingSessionController::class, 'store'])->name('training-session.store');
            Route::get('edit/{ctrlno}', [TrainingSessionController::class, 'edit'])->name('training-session.edit');
            Route::put('update/{ctrlno}', [TrainingSessionController::class, 'update'])->name('training-session.update');
            Route::delete('destroy/{ctrlno}', [TrainingSessionController::class, 'destroy'])->name('training-session.destroy');
            Route::get('recently-deleted', [TrainingSessionController::class, 'recentlyDeleted'])->name('training-session.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [TrainingSessionController::class, 'restore'])->name('training-session.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [TrainingSessionController::class, 'forceDelete'])->name('training-session.forceDelete');
        });

        Route::prefix('competency-ces-training')->group(function () {
            Route::get('index/{cesno}', [TrainingParticipantsController::class, 'index'])->name('ces-training.index');
            Route::get('create/{cesno}', [TrainingParticipantsController::class, 'create'])->name('ces-training.create');
            Route::post('store/{cesno}', [TrainingParticipantsController::class, 'store'])->name('ces-training.store');
            Route::get('edit/{ctrlno}/{cesno}', [TrainingParticipantsController::class, 'edit'])->name('ces-training.edit');
            Route::put('update/{ctrlno}/{cesno}', [TrainingParticipantsController::class, 'update'])->name('ces-training.update');
            Route::delete('destroy/{ctrlno}', [TrainingParticipantsController::class, 'destroy'])->name('ces-training.destroy');
            Route::get('recently-deleted/{cesno}', [TrainingParticipantsController::class, 'recentlyDeleted'])->name('ces-training.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [TrainingParticipantsController::class, 'restore'])->name('ces-training.restore');
            Route::delete('force-delete//recently-deleted/{ctrlno}', [TrainingParticipantsController::class, 'forceDelete'])->name('ces-training.forceDelete');
        });
    });
    // End of competency routes

    // Rights management routes
    Route::prefix('rights-management')->group(function () {

        Route::get('roles', [RolesController::class, 'index'])->name('roles.index');
        Route::get('roles/show/{role_name}/{role_title}', [RolesController::class, 'show'])->name('roles.show');
        Route::post('change', [RolesController::class, 'change'])->name('roles.change');
        Route::get('permissions/show/{role_name}/{role_title}', [RolesController::class, 'showPermissions'])->name('permissions.show');
        Route::get('permissions/profiling/{role_name}/{role_title}', [RolesController::class, 'showPermissionsProfiling'])->name('permissions.profiling');
        Route::get('permissions/plantilla/{role_name}/{role_title}', [RolesController::class, 'showPermissionsPlantilla'])->name('permissions.plantilla');
        Route::get('permissions/competency/{role_name}/{role_title}', [RolesController::class, 'showPermissionsCompetency'])->name('permissions.competency');
        Route::get('permissions/reports/{role_name}/{role_title}', [RolesController::class, 'showPermissionsReports'])->name('permissions.reports');

        Route::post('permissions/profiling/update/{role_name}/{role_title}', [PermissionsController::class, 'updatePersonalEducationalPermissions'])->name('personalEducationalPermissions.update');
        Route::post('permissions/profiling/update/experience_trainings/{role_name}/{role_title}', [PermissionsController::class, 'updateExperienceTrainingsPermissions'])->name('experienceTrainingsPermissions.update');
        Route::post('permissions/profiling/update/personal_others/{role_name}/{role_title}', [PermissionsController::class, 'updatePersonalOthersPermissions'])->name('personalOthersPermissions.update');

        // Route::post('create/{cesno}', [ProfileController::class, 'store'])->name('add-profile-201');
        // Route::get('list', [ProfileController::class, 'index'])->name('view-profile-201.index');
        // Route::get('show/{cesno}', [ProfileController::class, 'show'])->name('personal-data.show');
        // Route::post('upload-avatar-profile-201/{cesno}', [ProfileController::class, 'uploadAvatar'])->name('/upload-avatar-profile-201');
        // Route::get('edit/{cesno}', [ProfileController::class, 'editProfile'])->name('profile.edit');
        // Route::post('update/{cesno}', [ProfileController::class, 'update'])->name('edit-profile-201');
        // Route::get('settings/{cesno}', [ProfileController::class, 'settings'])->name('profile.settings');
        // Route::post('change-password/{cesno}', [ProfileController::class, 'changePassword'])->name('change.password');
        // Route::post('resend-email/{cesno}', [ProfileController::class, 'resendEmail'])->name('resend-email');

    });
    // End of Rights management routes

    // Library routes (201)
    Route::prefix('201-library')->group(function () {

        Route::prefix('gender-by-birth')->group(function () {
            Route::get('recently-deleted', [GenderByBirthController::class, 'recentlyDeleted'])->name('gender-by-birth.recently-deleted');
            Route::post('recently-deleted/force-delete/{ctrlno}', [GenderByBirthController::class, 'forceDelete'])->name('gender-by-birth.forceDelete');
            Route::post('recently-deleted/restore/{ctrlno}', [GenderByBirthController::class, 'restore'])->name('gender-by-birth.restore');
            Route::resource('gender-by-birth', GenderByBirthController::class);
        });

        Route::prefix('gender-by-choice')->group(function () {
            Route::get('recently-deleted', [GenderByChoiceController::class, 'recentlyDeleted'])->name('gender-by-choice.recently-deleted');
            Route::post('recently-deleted/force-delete/{ctrlno}', [GenderByChoiceController::class, 'forceDelete'])->name('gender-by-choice.forceDelete');
            Route::post('recently-deleted/restore/{ctrlno}', [GenderByChoiceController::class, 'restore'])->name('gender-by-choice.restore');
            Route::resource('gender-by-choice', GenderByChoiceController::class);
        });

        Route::prefix('civil-status')->group(function () {
            Route::get('recently-deleted', [CivilStatusController::class, 'recentlyDeleted'])->name('civil-status.recently-deleted');
            Route::post('recently-deleted/force-delete/{ctrlno}', [CivilStatusController::class, 'forceDelete'])->name('civil-status.forceDelete');
            Route::post('recently-deleted/restore/{ctrlno}', [CivilStatusController::class, 'restore'])->name('civil-status.restore');
            Route::resource('civil-status', CivilStatusController::class);
        });

        Route::prefix('title')->group(function () {
            Route::get('recently-deleted', [TitleController::class, 'recentlyDeleted'])->name('title.recently-deleted');
            Route::post('recently-deleted/force-delete/{ctrlno}', [TitleController::class, 'forceDelete'])->name('title.forceDelete');
            Route::post('recently-deleted/restore/{ctrlno}', [TitleController::class, 'restore'])->name('title.restore');
            Route::resource('title', TitleController::class);
        });

        Route::prefix('record-status')->group(function () {
            Route::get('recently-deleted', [RecordStatusController::class, 'recentlyDeleted'])->name('record-status.recently-deleted');
            Route::post('recently-deleted/force-delete/{ctrlno}', [RecordStatusController::class, 'forceDelete'])->name('record-status.forceDelete');
            Route::post('recently-deleted/restore/{ctrlno}', [RecordStatusController::class, 'restore'])->name('record-status.restore');
            Route::resource('record-status', RecordStatusController::class);
        });

        Route::prefix('religion')->group(function () {
            Route::get('recently-deleted', [ReligionController::class, 'recentlyDeleted'])->name('religion.recently-deleted');
            Route::post('recently-deleted/force-delete/{ctrlno}', [ReligionController::class, 'forceDelete'])->name('religion.forceDelete');
            Route::post('recently-deleted/restore/{ctrlno}', [ReligionController::class, 'restore'])->name('religion.restore');
            Route::resource('religion', ReligionController::class);
        });

        Route::prefix('indigeneous-group')->group(function () {
            Route::get('recently-deleted', [IndigenousGroupController::class, 'recentlyDeleted'])->name('indigeneous-group-recently-deleted');
            Route::post('recently-deleted/force-delete/{ctrlno}', [IndigenousGroupController::class, 'forceDelete'])->name('indigeneous-group-forceDelete');
            Route::post('recently-deleted/restore/{ctrlno}', [IndigenousGroupController::class, 'restore'])->name('indigeneous-group-restore');
            Route::resource('indigeneous-group', IndigenousGroupController::class);
        });

        Route::prefix('pwd')->group(function () {
            Route::get('recently-deleted', [PWDController::class, 'recentlyDeleted'])->name('pwd.recently-deleted');
            Route::post('recently-deleted/force-delete/{ctrlno}', [PWDController::class, 'forceDelete'])->name('pwd.forceDelete');
            Route::post('recently-deleted/restore/{ctrlno}', [PWDController::class, 'restore'])->name('pwd.restore');
            Route::resource('pwd', PWDController::class);
        });

        Route::prefix('educational-schools')->group(function () {
            Route::get('recently-deleted', [ProfileLibTblEducSchoolController::class, 'recentlyDeleted'])->name('educational-schools.recently-deleted');
            Route::post('recently-deleted/force-delete/{CODE}', [ProfileLibTblEducSchoolController::class, 'forceDelete'])->name('educational-schools.forceDelete');
            Route::post('recently-deleted/restore/{CODE}', [ProfileLibTblEducSchoolController::class, 'restore'])->name('educational-schools.restore');
            Route::resource('educational-schools', ProfileLibTblEducSchoolController::class);
        });

        Route::prefix('educational-major')->group(function () {
            Route::get('recently-deleted', [ProfileLibTblEducMajorController::class, 'recentlyDeleted'])->name('educational-major.recently-deleted');
            Route::post('recently-deleted/force-delete/{CODE}', [ProfileLibTblEducMajorController::class, 'forceDelete'])->name('educational-major.forceDelete');
            Route::post('recently-deleted/restore/{CODE}', [ProfileLibTblEducMajorController::class, 'restore'])->name('educational-major.restore');
            Route::resource('educational-major', ProfileLibTblEducMajorController::class);
        });

        Route::prefix('educational-degree')->group(function () {
            Route::get('recently-deleted', [ProfileLibTblEducDegreeController::class, 'recentlyDeleted'])->name('educational-degree.recently-deleted');
            Route::post('recently-deleted/force-delete/{CODE}', [ProfileLibTblEducDegreeController::class, 'forceDelete'])->name('educational-degree.forceDelete');
            Route::post('recently-deleted/restore/{CODE}', [ProfileLibTblEducDegreeController::class, 'restore'])->name('educational-degree.restore');
            Route::resource('educational-degree', ProfileLibTblEducDegreeController::class);
        });
    });
    // End of Library routes

});
