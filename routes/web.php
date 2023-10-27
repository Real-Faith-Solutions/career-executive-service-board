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
use App\Http\Controllers\Competency\CompetencyCesTrainingController;
use App\Http\Controllers\Competency\CompetencyController;
use App\Http\Controllers\Competency\ContactInformationController;
use App\Http\Controllers\Competency\FieldSpecializationController;
use App\Http\Controllers\Competency\CompetencyOtherTrainingManagementController;
use App\Http\Controllers\Competency\GeneralReportController;
use App\Http\Controllers\Competency\ResourceSpeakerController;
use App\Http\Controllers\Competency\ResourceSpeakerManagerReportController;
use App\Http\Controllers\Competency\TrainingCategoryController;
use App\Http\Controllers\Competency\TrainingParticipantsController;
use App\Http\Controllers\Competency\TrainingProviderManagerController;
use App\Http\Controllers\Competency\TrainingProviderManagerReportController;
use App\Http\Controllers\Competency\TrainingSecretariatController;
use App\Http\Controllers\Competency\TrainingVenueManagerController;
use App\Http\Controllers\Competency\TrainingVenueManagerReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\DeclineFileController;
use App\Http\Controllers\EducationalAttainmentController;
use App\Http\Controllers\EligibilityAndRankTrackerController;
use App\Http\Controllers\ERIS\AssessmentCenterController;
use App\Http\Controllers\ERIS\BoardInterviewController;
use App\Http\Controllers\ERIS\ErisProfileController;
use App\Http\Controllers\ERIS\InDepthValidationController;
use App\Http\Controllers\ERIS\PanelBoardInterviewController;
use App\Http\Controllers\ERIS\RankTrackerController;
use App\Http\Controllers\ERIS\RapidValidationController;
use App\Http\Controllers\Eris\WrittenExamController;
use App\Http\Controllers\ExaminationTakenController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\GenderByBirthController;
use App\Http\Controllers\GenderByChoiceController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\IndigenousGroupController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Library201\ProfileLibTblAppAuthorityController;
use App\Http\Controllers\Library201\ProfileLibTblCaseNatureController;
use App\Http\Controllers\Library201\ProfileLibTblCaseStatusController;
use App\Http\Controllers\Library201\ProfileLibTblCesStatusAcquiredThruController;
use App\Http\Controllers\Library201\ProfileLibTblCesStatusController;
use App\Http\Controllers\Library201\ProfileLibTblCesStatusTypeController;
use App\Http\Controllers\Library201\ProfileLibTblExpertiseGenController;
use App\Http\Controllers\Library201\ProfileLibTblExpertiseSpecController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\NonCesTrainingController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\Plantilla\AgencyLocationManagerController;
use App\Http\Controllers\Plantilla\AppointeeOccupantBrowserController;
use App\Http\Controllers\Plantilla\AppointeeOccupantManagerController;
use App\Http\Controllers\Plantilla\DepartmentAgencyManagerController;
use App\Http\Controllers\Plantilla\Library\AgencyLocationManagerController as LibraryAgencyLocationManagerController;
use App\Http\Controllers\Plantilla\Library\ClassBasisController;
use App\Http\Controllers\Plantilla\Library\DBMPositionTitleController;
use App\Http\Controllers\Plantilla\Library\DepartmentAgencyManagerController as LibraryDepartmentAgencyManagerController;
use App\Http\Controllers\Plantilla\Library\LocationTypeController;
use App\Http\Controllers\Plantilla\Library\MotherDeptController;
use App\Http\Controllers\Plantilla\Library\OccupantBrowserController;
use App\Http\Controllers\Plantilla\Library\OccupantManagerController;
use App\Http\Controllers\Plantilla\Library\OfficeManagerController as LibraryOfficeManagerController;
use App\Http\Controllers\Plantilla\Library\OfficeTypeController;
use App\Http\Controllers\Plantilla\Library\OtherAssignmentController as LibraryOtherAssignmentController;
use App\Http\Controllers\Plantilla\Library\PersonnelMovementController;
use App\Http\Controllers\Plantilla\Library\PositionManagerController;
use App\Http\Controllers\Plantilla\Library\SectorManagerController as LibrarySectorManagerController;
use App\Http\Controllers\Plantilla\OfficeManagerController;
use App\Http\Controllers\Plantilla\OtherAssignmentController;
use App\Http\Controllers\Plantilla\PlantillaManagementController;
use App\Http\Controllers\Plantilla\PlantillaPositionManagerController;
use App\Http\Controllers\Plantilla\Reports\StatisticsController;
use App\Http\Controllers\Plantilla\SectorManagerController;
use App\Http\Controllers\ProfileLibTblEducDegreeController;
use App\Http\Controllers\ProfileLibTblEducSchoolController;
use App\Http\Controllers\ProfileLibTblEducMajorController;
use App\Http\Controllers\ProfileLibTblExamRefController;
use App\Http\Controllers\ProfileLibTblLanguageRefController;
use App\Http\Controllers\PWDController;
use App\Http\Controllers\RecordStatusController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\Reports201Controller;
use App\Http\Controllers\ResearchAndStudiesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\WorkExperienceController;
use App\Mail\TempCred201;
use App\Models\ProfileLibTblExamRef;
use App\Models\ProfileLibTblLanguageRef;
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

// two factor authentication
Route::middleware('auth')->group(function () {
    Route::get('/two-factor-authentication', [AuthController::class, 'confirmEmail'])->name('reconfirm.email');
    Route::post('/submit-confirmation-code', [AuthController::class, 'submitConfirmationEmail'])->name('reconfirm.submit');
    Route::get('/resend-confirmation-code', [AuthController::class, 'resendConfirmationEmail'])->name('resend.code');
});

Route::middleware('auth', 'verify.email.and.device')->group(function () {

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
            Route::get('switch/two-factor', [ProfileController::class, 'switchTwoFactor'])->name('two-factor.switch');
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
            Route::get('create/{cesno}', [ScholarshipController::class, 'create'])->name('scholarship.create')->middleware('checkPermission:scholarships_taken_add');
            Route::get('index/{cesno}', [ScholarshipController::class, 'index'])->name('scholarship.index')->middleware('checkPermission:scholarships_taken_view');
            Route::get('edit/{ctrlno}/{cesno}', [ScholarshipController::class, 'edit'])->name('scholarship.edit')->middleware('checkPermission:scholarships_taken_edit');
            Route::post('store/{cesno}', [ScholarshipController::class, 'store'])->name('scholarship.store')->middleware('checkPermission:scholarships_taken_add');
            Route::put('update/{ctrlno}/{cesno}', [ScholarshipController::class, 'update'])->name('scholarship.update')->middleware('checkPermission:scholarships_taken_edit');
            Route::delete('destroy/{ctrlno}', [ScholarshipController::class, 'destroy'])->name('scholarship.destroy')->middleware('checkPermission:scholarships_taken_delete');
            Route::get('recently-deleted/{cesno}', [ScholarshipController::class, 'recycleBin'])->name('scholarship.recycleBin')->middleware('checkPermission:scholarships_taken_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [ScholarshipController::class, 'restore'])->name('scholarship.restore')->middleware('checkPermission:scholarships_taken_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [ScholarshipController::class, 'forceDelete'])->name('scholarship.forceDelete')->middleware('checkPermission:scholarships_taken_delete');
        });

        Route::prefix('research-studies')->group(function () {
            Route::get('index/{cesno}', [ResearchAndStudiesController::class, 'index'])->name('research-studies.index')->middleware('checkPermission:research_and_studies_view');
            Route::get('create/{cesno}', [ResearchAndStudiesController::class, 'create'])->name('research-studies.create')->middleware('checkPermission:research_and_studies_add');
            Route::get('edit/{ctrlno}/{cesno}', [ResearchAndStudiesController::class, 'edit'])->name('research-studies.edit')->middleware('checkPermission:research_and_studies_edit');
            Route::post('store/{cesno}', [ResearchAndStudiesController::class, 'store'])->name('research-studies.store')->middleware('checkPermission:research_and_studies_add');
            Route::put('update/{ctrlno}/{cesno}', [ResearchAndStudiesController::class, 'update'])->name('research-studies.update')->middleware('checkPermission:research_and_studies_edit');
            Route::delete('destroy/{ctrlno}', [ResearchAndStudiesController::class, 'destroy'])->name('research-studies.destroy')->middleware('checkPermission:research_and_studies_delete');
            Route::get('recently-deleted/{cesno}', [ResearchAndStudiesController::class, 'recycleBin'])->name('research-studies.recycleBin')->middleware('checkPermission:research_and_studies_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [ResearchAndStudiesController::class, 'restore'])->name('research-studies.restore')->middleware('checkPermission:research_and_studies_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [ResearchAndStudiesController::class, 'forceDelete'])->name('research-studies.forceDelete')->middleware('checkPermission:research_and_studies_delete');
        });

        Route::prefix('work-experience')->group(function () {
            Route::get('create/{cesno}', [WorkExperienceController::class, 'create'])->name('work-experience.create')->middleware('checkPermission:work_experience_add');
            Route::get('index/{cesno}', [WorkExperienceController::class, 'index'])->name('work-experience.index')->middleware('checkPermission:work_experience_view');
            Route::get('edit/{ctrlno}/{cesno}', [WorkExperienceController::class, 'edit'])->name('work-experience.edit')->middleware('checkPermission:work_experience_edit');
            Route::post('store/{cesno}', [WorkExperienceController::class, 'store'])->name('work-experience.store')->middleware('checkPermission:work_experience_add');
            Route::put('update/{ctrlno}/{cesno}', [WorkExperienceController::class, 'update'])->name('work-experience.update')->middleware('checkPermission:work_experience_edit');
            Route::delete('destroy/{ctrlno}', [WorkExperienceController::class, 'destroy'])->name('work-experience.destroy')->middleware('checkPermission:work_experience_delete');
            Route::get('recently-deleted/{cesno}', [WorkExperienceController::class, 'recycleBin'])->name('work-experience.recycleBin')->middleware('checkPermission:work_experience_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [WorkExperienceController::class, 'restore'])->name('work-experience.restore')->middleware('checkPermission:work_experience_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [WorkExperienceController::class, 'forceDelete'])->name('work-experience.forceDelete')->middleware('checkPermission:work_experience_delete');
        });

        Route::prefix('award-citation')->group(function () {
            Route::get('index/{cesno}', [AwardAndCitationController::class, 'index'])->name('award-citation.index')->middleware('checkPermission:awards_and_citations_view');
            Route::get('create/{cesno}', [AwardAndCitationController::class, 'create'])->name('award-citation.create')->middleware('checkPermission:awards_and_citations_add');
            Route::get('edit/{ctrlno}/{cesno}', [AwardAndCitationController::class, 'edit'])->name('award-citation.edit')->middleware('checkPermission:awards_and_citations_edit');
            Route::post('store/{cesno}', [AwardAndCitationController::class, 'store'])->name('award-citation.store')->middleware('checkPermission:awards_and_citations_add');
            Route::put('update/{ctrlno}/{cesno}', [AwardAndCitationController::class, 'update'])->name('award-citation.update')->middleware('checkPermission:awards_and_citations_edit');
            Route::delete('delete/{ctrlno}', [AwardAndCitationController::class, 'destroy'])->name('award-citation.destroy')->middleware('checkPermission:awards_and_citations_delete');
            Route::get('recently-deleted/{cesno}', [AwardAndCitationController::class, 'recentlyDeleted'])->name('award-citation.recentlyDeleted')->middleware('checkPermission:awards_and_citations_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [AwardAndCitationController::class, 'restore'])->name('award-citation.restore')->middleware('checkPermission:awards_and_citations_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [AwardAndCitationController::class, 'forceDelete'])->name('award-citation.forceDelete')->middleware('checkPermission:awards_and_citations_delete');
        });

        Route::prefix('affiliation')->group(function () {
            Route::get('index/{cesno}', [AffiliationController::class, 'index'])->name('affiliation.index')->middleware('checkPermission:affiliations_view');
            Route::get('create/{cesno}', [AffiliationController::class, 'create'])->name('affiliation.create')->middleware('checkPermission:affiliations_add');
            Route::get('edit/{ctrlno}/{cesno}', [AffiliationController::class, 'edit'])->name('affiliation.edit')->middleware('checkPermission:affiliations_edit');
            Route::post('save/{cesno}', [AffiliationController::class, 'store'])->name('affiliation.store')->middleware('checkPermission:affiliations_add');
            Route::put('update/{ctrlno}/{cesno}', [AffiliationController::class, 'update'])->name('affiliation.update')->middleware('checkPermission:affiliations_edit');
            Route::delete('destroy/{ctrlno}', [AffiliationController::class, 'destroy'])->name('affiliation.destroy')->middleware('checkPermission:affiliations_delete');
            Route::get('recently-deleted/{cesno}', [AffiliationController::class, 'recycleBin'])->name('affiliations.recycleBin')->middleware('checkPermission:affiliations_delete');
            Route::post('restore/{ctrlno}', [AffiliationController::class, 'restore'])->name('affiliation.restore')->middleware('checkPermission:affiliations_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [AffiliationController::class, 'forceDelete'])->name('affiliation.forceDelete')->middleware('checkPermission:affiliations_delete');
        });

        Route::prefix('case-record')->group(function () {
            Route::get('index/{cesno}', [CaseRecordController::class, 'index'])->name('case-record.index')->middleware('checkPermission:case_records_view');
            Route::get('create/{cesno}', [CaseRecordController::class, 'create'])->name('case-record.create')->middleware('checkPermission:case_records_add');
            Route::get('edit/{ctrlno}/{cesno}', [CaseRecordController::class, 'edit'])->name('case-record.edit')->middleware('checkPermission:case_records_edit');
            Route::post('store/{cesno}', [CaseRecordController::class, 'store'])->name('case-record.store')->middleware('checkPermission:case_records_add');
            Route::put('update/{ctrlno}/{cesno}', [CaseRecordController::class, 'update'])->name('case-record.update')->middleware('checkPermission:case_records_edit');
            Route::delete('destroy/{ctrlno}', [CaseRecordController::class, 'destroy'])->name('case-record.destroy')->middleware('checkPermission:case_records_delete');
            Route::get('recently-deleted/{cesno}', [CaseRecordController::class, 'recentlyDeleted'])->name('case-record.recentlyDeleted')->middleware('checkPermission:case_records_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [CaseRecordController::class, 'restore'])->name('case-record.restore')->middleware('checkPermission:case_records_delete');
            Route::delete('recently-deleted/force-deleted/{ctrlno}', [CaseRecordController::class, 'forceDelete'])->name('case-record.forceDelete')->middleware('checkPermission:case_records_delete');
        });

        Route::prefix('health-record')->group(function () {
            Route::get('index/{cesno}', [HealthRecordController::class, 'index'])->name('health-record.index')->middleware('checkPermission:health_records_view');
            Route::post('{cesno}', [HealthRecordController::class, 'store'])->name('health-record.store')->middleware('checkPermission:health_records_add');
            Route::delete('{ctrlno}', [HealthRecordController::class, 'destroy'])->name('health-record.destroy')->middleware('checkPermission:health_records_delete');
        });

        Route::prefix('medical-history')->group(function () {
            Route::post('{cesno}', [MedicalHistoryController::class, 'store'])->name('medical-history.store')->middleware('checkPermission:health_records_add');
            Route::delete('{ctrlno}', [MedicalHistoryController::class, 'destroy'])->name('medical-history.destroy')->middleware('checkPermission:health_records_delete');
        });

        Route::prefix('expertise')->group(function () {
            Route::get('create/{cesno}', [ExpertiseController::class, 'create'])->name('expertise.create')->middleware('checkPermission:work_experience_add');
            Route::get('index/{cesno}', [ExpertiseController::class, 'index'])->name('expertise.index')->middleware('checkPermission:work_experience_view');
            Route::get('edit/{cesno}/{ctrlno}', [ExpertiseController::class, 'edit'])->name('expertise.edit')->middleware('checkPermission:work_experience_edit');
            Route::post('store/{cesno}', [ExpertiseController::class, 'store'])->name('expertise.store')->middleware('checkPermission:work_experience_add');
            Route::put('update/{cesno}/{ctrlno}', [ExpertiseController::class, 'update'])->name('expertise.update')->middleware('checkPermission:work_experience_edit');
            Route::delete('destroy/{ctrlno}', [ExpertiseController::class, 'destroy'])->name('expertise.destroy')->middleware('checkPermission:work_experience_delete');
            Route::get('recently-deleted/{cesno}', [ExpertiseController::class, 'recentlyDeleted'])->name('expertise.recentlyDeleted')->middleware('checkPermission:work_experience_delete');
            Route::post('restore/recently-deleted/{ctrlno}', [ExpertiseController::class, 'restore'])->name('expertise.restore')->middleware('checkPermission:work_experience_delete');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [ExpertiseController::class, 'forceDelete'])->name('expertise.forceDelete')->middleware('checkPermission:work_experience_delete');
        });

        Route::prefix('language')->group(function () {
            Route::get('index/{cesno}', [LanguageController::class, 'index'])->name('language.index')->middleware('checkPermission:language_dialects_view');
            Route::get('edit/{ctrlno}/{cesno}', [LanguageController::class, 'edit'])->name('language.edit')->middleware('checkPermission:language_dialects_edit');
            Route::post('store/{cesno}', [LanguageController::class, 'store'])->name('language.store')->middleware('checkPermission:language_dialects_add');
            Route::put('update/{cesno}/{ctrlno}', [LanguageController::class, 'update'])->name('language.update')->middleware('checkPermission:language_dialects_edit');
            Route::delete('destroy/{ctrlno}', [LanguageController::class, 'destroy'])->name('language.destroy')->middleware('checkPermission:language_dialects_delete');
            Route::get('recently-deleted/{cesno}', [LanguageController::class, 'recentlyDeleted'])->name('language.recentlyDeleted')->middleware('checkPermission:language_dialects_delete');
            Route::post('restore/recently-deleted/{ctrlno}', [LanguageController::class, 'restore'])->name('language.restore')->middleware('checkPermission:language_dialects_delete');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [LanguageController::class, 'forceDelete'])->name('language.forceDelete')->middleware('checkPermission:language_dialects_delete');
        });

        Route::prefix('ces-training-201')->group(function () {
            Route::get('index/{cesno}', [CESTraining201Controller::class, 'index'])->name('ces-training-201.index')->middleware('checkPermission:ces_trainings_view');
            Route::get('create/{cesno}', [CESTraining201Controller::class, 'create'])->name('ces-training-201.create')->middleware('checkPermission:ces_trainings_add');
            Route::post('store/{cesno}', [CESTraining201Controller::class, 'store'])->name('ces-training-201.store')->middleware('checkPermission:ces_trainings_add');
            Route::get('edit/{cesno}/{ctrlno}', [CESTraining201Controller::class, 'edit'])->name('ces-training-201.edit')->middleware('checkPermission:ces_trainings_edit');
            Route::put('update/{cesno}/{ctrlno}', [CESTraining201Controller::class, 'update'])->name('ces-training-201.update')->middleware('checkPermission:ces_trainings_edit');
            Route::delete('destroy/{ctrlno}', [CESTraining201Controller::class, 'destroy'])->name('ces-training-201.destroy')->middleware('checkPermission:ces_trainings_delete');
            Route::get('recently-deleted/{cesno}', [CESTraining201Controller::class, 'recentlyDeleted'])->name('ces-training-201.recentlyDeleted')->middleware('checkPermission:ces_trainings_delete');
            Route::post('restore/recently-deleted/{ctrlno}', [CESTraining201Controller::class, 'restore'])->name('ces-training-201.restore')->middleware('checkPermission:ces_trainings_delete');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [CESTraining201Controller::class, 'forceDelete'])->name('ces-training-201.forceDelete')->middleware('checkPermission:ces_trainings_delete');
        });

        Route::prefix('non-accredited-ces-training')->group(function () {
            Route::get('create/{cesno}', [NonCesTrainingController::class, 'create'])->name('other-training.create')->middleware('checkPermission:non_ces_trainings_add');
            Route::get('index/{cesno}', [NonCesTrainingController::class, 'index'])->name('other-training.index')->middleware('checkPermission:non_ces_trainings_view');
            Route::get('edit/{ctrlno}/{cesno}', [NonCesTrainingController::class, 'edit'])->name('other-training.edit')->middleware('checkPermission:non_ces_trainings_edit');
            Route::post('store/{cesno}', [NonCesTrainingController::class, 'store'])->name('other-training.store')->middleware('checkPermission:non_ces_trainings_add');
            Route::put('update/{ctrlno}/{cesno}', [NonCesTrainingController::class, 'update'])->name('other-training.update')->middleware('checkPermission:non_ces_trainings_edit');
            Route::delete('destroy/{ctrlno}', [NonCesTrainingController::class, 'destroy'])->name('other-training.destroy')->middleware('checkPermission:non_ces_trainings_delete');
            Route::get('recently-deleted/{cesno}', [NonCesTrainingController::class, 'recentlyDeleted'])->name('other-training.recentlyDeleted')->middleware('checkPermission:non_ces_trainings_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [NonCesTrainingController::class, 'restore'])->name('other-training.restore')->middleware('checkPermission:non_ces_trainings_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [NonCesTrainingController::class, 'forceDelete'])->name('other-training.forceDelete')->middleware('checkPermission:non_ces_trainings_delete');
            Route::get('edit-competency-non-ces-training/{ctrlno}/{cesno}', [NonCesTrainingController::class, 'editCompetencyNonCesTraining'])->name('other-training.editCompetencyNonCesTraining')->middleware('checkPermission:non_ces_trainings_edit');
            Route::put('update-competency-non-ces-training/{ctrlno}/{cesno}', [NonCesTrainingController::class, 'updateCompetencyNonCesTraining'])->name('other-training.updateCompetencyNonCesTraining')->middleware('checkPermission:non_ces_trainings_edit');
            Route::delete('destroy-competency-non-ces-training{ctrlno}', [NonCesTrainingController::class, 'destroyCompetencyNonCesTraining'])->name('other-training.destroyCompetencyNonCesTraining')->middleware('checkPermission:non_ces_trainings_delete');
            Route::post('recently-deleted/restore-competency-non-ces-training/{ctrlno}', [NonCesTrainingController::class, 'restoreCompetencyNonCesTraining'])->name('other-training.restoreCompetencyNonCesTraining')->middleware('checkPermission:non_ces_trainings_delete');
            Route::delete('recently-deleted/force-delete-competency-non-ces-training{ctrlno}', [NonCesTrainingController::class, 'forceDeleteCompetencyNonCesTraining'])->name('other-training.forceDeleteCompetencyNonCesTraining')->middleware('checkPermission:non_ces_trainings_delete');
        });

        Route::prefix('eligibility-rank-tracker')->group(function () {
            Route::get('index/{cesno}', [EligibilityAndRankTrackerController::class, 'index'])->name('eligibility-rank-tracker.index')->middleware('checkPermission:eligibility_rank_tracker_view');
            Route::get('create/{cesno}', [EligibilityAndRankTrackerController::class, 'create'])->name('eligibility-rank-tracker.create')->middleware('checkPermission:eligibility_rank_tracker_add');
            Route::get('edit/{ctrlno}/{cesno}', [EligibilityAndRankTrackerController::class, 'edit'])->name('eligibility-rank-tracker.edit')->middleware('checkPermission:eligibility_rank_tracker_edit');
            Route::post('store/{cesno}', [EligibilityAndRankTrackerController::class, 'store'])->name('eligibility-rank-tracker.store')->middleware('checkPermission:eligibility_rank_tracker_add');
            Route::put('update/{ctrlno}/{cesno}', [EligibilityAndRankTrackerController::class, 'update'])->name('eligibility-rank-tracker.update')->middleware('checkPermission:eligibility_rank_tracker_edit');
            Route::delete('destroy/{ctrlno}/{cesno}', [EligibilityAndRankTrackerController::class, 'destroy'])->name('eligibility-rank-tracker.destroy')->middleware('checkPermission:eligibility_rank_tracker_delete');
            Route::get('recently-deleted/{cesno}', [EligibilityAndRankTrackerController::class, 'recentlyDeleted'])->name('eligibility-rank-tracker.recentlyDeleted')->middleware('checkPermission:eligibility_rank_tracker_delete');
            Route::post('recently-deleted/restore/{ctrlno}/{cesno}', [EligibilityAndRankTrackerController::class, 'restore'])->name('eligibility-rank-tracker.restore')->middleware('checkPermission:eligibility_rank_tracker_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}/{cesno}', [EligibilityAndRankTrackerController::class, 'forceDelete'])->name('eligibility-rank-tracker.forceDelete')->middleware('checkPermission:eligibility_rank_tracker_delete');

            Route::prefix('eligibility-rank-tracker-erad')->group(function () {
                Route::get('navigate/{cesno}', [EligibilityAndRankTrackerController::class, 'navigate'])->name('eligibility-rank-tracker.navigate');
            });
        });


        Route::prefix('pdf-file')->group(function () {
            Route::get('pending-files', [PDFController::class, 'pendingFiles'])->name('show-pending-pdf-files.pendingFiles')->middleware('checkPermission:pdf_files_view');
            Route::post('accepted-file', [PDFController::class, 'acceptedFiles'])->name('show-pdf-files.acceptedFiles')->middleware('checkPermission:pdf_files_add');
            Route::post('download-pending-file/{ctrlno}/{fileName}', [PDFController::class, 'downloadPendingFile'])->name('downloadPendingFile')->middleware('checkPermission:pdf_files_view');
            Route::post('decline-file', [DeclineFileController::class, 'declineFile'])->name('declineFile')->middleware('checkPermission:pdf_files_delete');
            Route::delete('declined-file-force-delete/{ctrlno}', [DeclineFileController::class, 'declineFileForceDelete'])->name('show-pdf-files.declineFileForceDelete')->middleware('checkPermission:pdf_files_delete');
            Route::get('recently-decline-file', [DeclineFileController::class, 'recentlyDeclineFile'])->name('show-pdf-files.recentlyDeclineFiles')->middleware('checkPermission:pdf_files_delete');
            Route::get('index/{cesno}', [PDFController::class, 'index'])->name('show-pdf-files.index')->middleware('checkPermission:pdf_files_view');
            Route::get('create/{cesno}', [PDFController::class, 'create'])->name('show-pdf-files.create')->middleware('checkPermission:pdf_files_add');
            Route::post('store/{cesno}', [PDFController::class, 'store'])->name('show-pdf-files.store')->middleware('checkPermission:pdf_files_add');
            Route::post('download-approved-file/{ctrlno}/{fileName}', [PDFController::class, 'download'])->name('downloadApprovedFile')->middleware('checkPermission:pdf_files_view');
            Route::delete('destroy/{ctrlno}', [PDFController::class, 'destroy'])->name('show-pdf-files.destroy')->middleware('checkPermission:pdf_files_delete');
            Route::get('recently-deleted/{cesno}', [PDFController::class, 'recentlyDeleted'])->name('show-pdf-files.recentlyDeleted')->middleware('checkPermission:pdf_files_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [PDFController::class, 'restore'])->name('show-pdf-files.restore')->middleware('checkPermission:pdf_files_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [PDFController::class, 'forceDelete'])->name('show-pdf-files.forceDelete')->middleware('checkPermission:pdf_files_delete');
            Route::get('approved-files', [ApprovedFileController::class, 'approvedFile'])->name('show-approved-pdf-files.approvedFile')->middleware('checkPermission:pdf_files_view');
            Route::post('stream-approved-file/{ctrlno}/{fileName}', [ApprovedFileController::class, 'streamApprovedFile'])->name('streamApprovedFile')->middleware('checkPermission:pdf_files_view');
        });
    });
    // End of profile routes

    // Plantilla routes
    Route::prefix('plantilla')->group(function () {

        Route::prefix('plantilla-management')->group(function () {
            Route::get('/', [PlantillaManagementController::class, 'index'])->name('plantilla-management.index')->middleware('checkPermission:plantilla_management_view');
        });

        Route::prefix('sector-manager')->group(function () {
            Route::get('/', [SectorManagerController::class, 'index'])->name('sector-manager.index')->middleware('checkPermission:plantilla_sector_manager_view');
            Route::get('create', [SectorManagerController::class, 'create'])->name('sector-manager.create')->middleware('checkPermission:plantilla_sector_manager_add');
            Route::get('show{sectorid}', [SectorManagerController::class, 'show'])->name('sector-manager.show')->middleware('checkPermission:plantilla_sector_manager_add');
            Route::get('{sectorid}', [SectorManagerController::class, 'edit'])->name('sector-manager.edit')->middleware('checkPermission:plantilla_sector_manager_edit');
        });

        Route::prefix('department-agency-manager')->group(function () {
            Route::get('/', [DepartmentAgencyManagerController::class, 'index'])->name('department-agency-manager.index')->middleware('checkPermission:plantilla_department_manager_view');
            Route::get('{sectorid}/{deptid}', [DepartmentAgencyManagerController::class, 'showAgency'])->name('department-agency-manager.showAgency')->middleware('checkPermission:plantilla_department_manager_view');
            Route::get('show/{sectorid}/{deptid}', [DepartmentAgencyManagerController::class, 'show'])->name('department-agency-manager.show')->middleware('checkPermission:plantilla_department_manager_view');
        });

        Route::prefix('agency-location-manager')->group(function () {
            Route::get('/', [AgencyLocationManagerController::class, 'index'])->name('agency-location-manager.index')->middleware('checkPermission:plantilla_agency_location_manager_view');
            Route::get('{sectorid}/{deptid}/{officelocid}', [AgencyLocationManagerController::class, 'show'])->name('agency-location-manager.show')->middleware('checkPermission:plantilla_agency_location_manager_view');
            Route::get('edit/{sectorid}/{deptid}/{officelocid}', [AgencyLocationManagerController::class, 'edit'])->name('agency-location-manager.edit')->middleware('checkPermission:plantilla_agency_location_manager_view');
        });

        Route::prefix('office-manager')->group(function () {
            Route::get('/', [OfficeManagerController::class, 'index'])->name('office-manager.index');
            Route::get('{sectorid}/{deptid}/{officelocid}/{officeid}', [OfficeManagerController::class, 'show'])->name('office-manager.show');
            Route::get('edit/{sectorid}/{deptid}/{officelocid}/{officeid}', [OfficeManagerController::class, 'edit'])->name('office-manager.edit');
        });

        Route::prefix('plantilla-position-manager')->group(function () {
            Route::get('/', [PlantillaPositionManagerController::class, 'index'])->name('plantilla-position-manager.index')->middleware('checkPermission:plantilla_position_manager_view');
            // Route::post('store', [PlantillaPositionManagerController::class, 'store'])->name('plantilla-position-manager.store')->middleware('checkPermission:plantilla_position_manager_add');
            Route::get('{sectorid}/{deptid}/{officelocid}/{officeid}/{plantilla_id}', [PlantillaPositionManagerController::class, 'show'])->name('plantilla-position-manager.show')->middleware('checkPermission:plantilla_position_manager_view');
            Route::get('edit/{sectorid}/{deptid}/{officelocid}/{officeid}/{plantilla_id}', [PlantillaPositionManagerController::class, 'edit'])->name('plantilla-position-manager.edit')->middleware('checkPermission:plantilla_position_manager_view');
            Route::post('{plantilla_id}/update', [PlantillaPositionManagerController::class, 'update'])->name('plantilla-position-manager.update')->middleware('checkPermission:plantilla_position_manager_edit');
            // Route::delete('/{plantilla_id}/destroy', [PlantillaPositionManagerController::class, 'destroy'])->name('plantilla-position-manager.destroy')->middleware('checkPermission:plantilla_position_manager_delete');
        });

        Route::prefix('appointee-occupant-manager')->group(function () {
            Route::get('/', [AppointeeOccupantManagerController::class, 'index'])->name('appointee-occupant-manager.index')->middleware('checkPermission:plantilla_appointee_occupant_manager_view');
            Route::match(['get', 'post'], '/{sectorid}/{deptid}/{officelocid}/{officeid}/{plantilla_id}/{cesno?}', [AppointeeOccupantManagerController::class, 'create'])
                ->name('appointee-occupant-manager.create')
                ->where('cesno', '.*');


            Route::post('store', [AppointeeOccupantManagerController::class, 'store'])->name('appointee-occupant-manager.store')->middleware('checkPermission:plantilla_appointee_occupant_manager_add');
            Route::delete('/{appointee_id}/destroy', [AppointeeOccupantManagerController::class, 'destroy'])->name('appointee-occupant-manager.destroy')->middleware('checkPermission:plantilla_appointee_occupant_manager_delete');
        });

        Route::prefix('appointee')->group(function () {

            Route::get('{sectorid}/{deptid}/{officelocid}/{officeid}/{plantilla_id}/{appointee_id}', [AppointeeOccupantManagerController::class, 'show'])->name('appointee-occupant-manager.show')->middleware('checkPermission:plantilla_appointee_occupant_manager_view');
            Route::get('edit/{sectorid}/{deptid}/{officelocid}/{officeid}/{plantilla_id}/{appointee_id}', [AppointeeOccupantManagerController::class, 'edit'])->name('appointee-occupant-manager.edit')->middleware('checkPermission:plantilla_appointee_occupant_manager_view');
            Route::post('{appointee_id}/update', [AppointeeOccupantManagerController::class, 'update'])->name('appointee-occupant-manager.update')->middleware('checkPermission:plantilla_appointee_occupant_manager_edit');
            Route::post('store', [OtherAssignmentController::class, 'store'])->name('other-assignment.store')->middleware('checkPermission:plantilla_appointee_occupant_manager_add');
            Route::delete('/{detailed_code}/destroy', [OtherAssignmentController::class, 'destroy'])->name('other-assignment.destroy');
            Route::get('{sectorid}/{deptid}/{officelocid}/{officeid}/{plantilla_id}/{appointee_id}/{detailed_code}', [OtherAssignmentController::class, 'show'])->name('other-assignment.show');
            Route::post('/other-assignment/{detailed_code}/update', [OtherAssignmentController::class, 'update'])->name('other-assignment.update');
        });

        Route::prefix('appointee-occupant-browser')->group(function () {
            Route::get('/', [AppointeeOccupantBrowserController::class, 'index'])->name('appointee-occupant-browser.index')->middleware('checkPermission:plantilla_appointee_occupant_browser_view');
        });

        Route::get('library-sector/trash', [LibrarySectorManagerController::class, 'trash'])->name('library-sector.trash');
        Route::post('library-sector/{sectorid}/force-delete', [LibrarySectorManagerController::class, 'forceDelete'])->name('library-sector.forceDelete');
        Route::post('library-sector/{sectorid}/restore', [LibrarySectorManagerController::class, 'restore'])->name('library-sector.restore');
        Route::resource('library-sector', LibrarySectorManagerController::class);

        Route::get('library-department-manager/trash', [LibraryDepartmentAgencyManagerController::class, 'trash'])->name('library-department-manager.trash');
        Route::post('library-department-manager/{deptid}/force-delete', [LibraryDepartmentAgencyManagerController::class, 'forceDelete'])->name('library-department-manager.forceDelete');
        Route::post('library-department-manager/{deptid}/restore', [LibraryDepartmentAgencyManagerController::class, 'restore'])->name('library-department-manager.restore');
        Route::resource('library-department-manager', LibraryDepartmentAgencyManagerController::class);

        Route::get('library-agency-location-manager/trash', [LibraryAgencyLocationManagerController::class, 'trash'])->name('library-agency-location-manager.trash');
        Route::post('library-agency-location-manager/{deptid}/force-delete', [LibraryAgencyLocationManagerController::class, 'forceDelete'])->name('library-agency-location-manager.forceDelete');
        Route::post('library-agency-location-manager/{deptid}/restore', [LibraryAgencyLocationManagerController::class, 'restore'])->name('library-agency-location-manager.restore');
        Route::resource('library-agency-location-manager', LibraryAgencyLocationManagerController::class);

        Route::get('library-office-manager/trash', [LibraryOfficeManagerController::class, 'trash'])->name('library-office-manager.trash');
        Route::post('library-office-manager/{officeid}/force-delete', [LibraryOfficeManagerController::class, 'forceDelete'])->name('library-office-manager.forceDelete');
        Route::post('library-office-manager/{officeid}/restore', [LibraryOfficeManagerController::class, 'restore'])->name('library-office-manager.restore');
        Route::resource('library-office-manager', LibraryOfficeManagerController::class);

        Route::get('library-office-type/trash', [OfficeTypeController::class, 'trash'])->name('library-office-type.trash');
        Route::post('library-office-type/{officeid}/force-delete', [OfficeTypeController::class, 'forceDelete'])->name('library-office-type.forceDelete');
        Route::post('library-office-type/{officeid}/restore', [OfficeTypeController::class, 'restore'])->name('library-office-type.restore');
        Route::resource('library-office-type', OfficeTypeController::class);

        Route::get('library-dbm-position-title/trash', [DBMPositionTitleController::class, 'trash'])->name('library-dbm-position-title.trash');
        Route::post('library-dbm-position-title/{officeid}/force-delete', [DBMPositionTitleController::class, 'forceDelete'])->name('library-dbm-position-title.forceDelete');
        Route::post('library-dbm-position-title/{officeid}/restore', [DBMPositionTitleController::class, 'restore'])->name('library-dbm-position-title.restore');
        Route::resource('library-dbm-position-title', DBMPositionTitleController::class);

        Route::get('library-dbm-position-title/trash', [DBMPositionTitleController::class, 'trash'])->name('library-dbm-position-title.trash');
        Route::post('library-dbm-position-title/{officeid}/force-delete', [DBMPositionTitleController::class, 'forceDelete'])->name('library-dbm-position-title.forceDelete');
        Route::post('library-dbm-position-title/{officeid}/restore', [DBMPositionTitleController::class, 'restore'])->name('library-dbm-position-title.restore');
        Route::resource('library-dbm-position-title', DBMPositionTitleController::class);

        Route::get('library-class-basis/trash', [ClassBasisController::class, 'trash'])->name('library-class-basis.trash');
        Route::post('library-class-basis/{officeid}/force-delete', [ClassBasisController::class, 'forceDelete'])->name('library-class-basis.forceDelete');
        Route::post('library-class-basis/{officeid}/restore', [ClassBasisController::class, 'restore'])->name('library-class-basis.restore');
        Route::resource('library-class-basis', ClassBasisController::class);

        Route::get('library-personnel-movement/trash', [PersonnelMovementController::class, 'trash'])->name('library-personnel-movement.trash');
        Route::post('library-personnel-movement/{officeid}/force-delete', [PersonnelMovementController::class, 'forceDelete'])->name('library-personnel-movement.forceDelete');
        Route::post('library-personnel-movement/{officeid}/restore', [PersonnelMovementController::class, 'restore'])->name('library-personnel-movement.restore');
        Route::resource('library-personnel-movement', PersonnelMovementController::class);


        Route::get('library-location-type/trash', [LocationTypeController::class, 'trash'])->name('library-location-type.trash');
        Route::post('library-location-type/{officeid}/force-delete', [LocationTypeController::class, 'forceDelete'])->name('library-location-type.forceDelete');
        Route::post('library-location-type/{officeid}/restore', [LocationTypeController::class, 'restore'])->name('library-location-type.restore');
        Route::resource('library-location-type', LocationTypeController::class);

        Route::get('library-mother-dept/trash', [MotherDeptController::class, 'trash'])->name('library-mother-dept.trash');
        Route::post('library-mother-dept/{officeid}/force-delete', [MotherDeptController::class, 'forceDelete'])->name('library-mother-dept.forceDelete');
        Route::post('library-mother-dept/{officeid}/restore', [MotherDeptController::class, 'restore'])->name('library-mother-dept.restore');
        Route::resource('library-mother-dept', MotherDeptController::class);

        Route::get('library-position-manager/trash', [PositionManagerController::class, 'trash'])->name('library-position-manager.trash');
        Route::post('library-position-manager/{officeid}/force-delete', [PositionManagerController::class, 'forceDelete'])->name('library-position-manager.forceDelete');
        Route::post('library-position-manager/{officeid}/restore', [PositionManagerController::class, 'restore'])->name('library-position-manager.restore');
        Route::resource('library-position-manager', PositionManagerController::class);

        Route::get('library-occupant-browser/trash', [OccupantBrowserController::class, 'trash'])->name('library-occupant-browser.trash');
        Route::post('library-occupant-browser/{officeid}/force-delete', [OccupantBrowserController::class, 'forceDelete'])->name('library-occupant-browser.forceDelete');
        Route::post('library-occupant-browser/{officeid}/restore', [OccupantBrowserController::class, 'restore'])->name('library-occupant-browser.restore');
        Route::resource('library-occupant-browser', OccupantBrowserController::class);

        Route::get('library-occupant-manager/trash', [OccupantManagerController::class, 'trash'])->name('library-occupant-manager.trash');
        Route::post('library-occupant-manager/{officeid}/force-delete', [OccupantManagerController::class, 'forceDelete'])->name('library-occupant-manager.forceDelete');
        Route::post('library-occupant-manager/{officeid}/restore', [OccupantManagerController::class, 'restore'])->name('library-occupant-manager.restore');
        Route::resource('library-occupant-manager', OccupantManagerController::class);


        Route::get('library-other-assignment/{library_occupant_manager}/trash', [LibraryOtherAssignmentController::class, 'trash'])->name('library-other-assignment.trash');
        Route::post('library-other-assignment/{detailed_code}/force-delete', [LibraryOtherAssignmentController::class, 'forceDelete'])->name('library-other-assignment.forceDelete');
        Route::post('library-other-assignment/{detailed_code}/restore', [LibraryOtherAssignmentController::class, 'restore'])->name('library-other-assignment.restore');


        Route::get('library-other-assignment/{library_occupant_manager}', [LibraryOtherAssignmentController::class, 'index'])->name('library-other-assignment.index');
        Route::get('library-other-assignment/{library_occupant_manager}/{detailed_code}/edit', [LibraryOtherAssignmentController::class, 'edit'])->name('library-other-assignment.edit');
        Route::get('library-other-assignment/{library_occupant_manager}/create', [LibraryOtherAssignmentController::class, 'create'])->name('library-other-assignment.create');
        Route::post('library-other-assignment/store', [LibraryOtherAssignmentController::class, 'store'])->name('library-other-assignment.store');
        Route::post('library-other-assignment/{detailed_code}/update', [LibraryOtherAssignmentController::class, 'update'])->name('library-other-assignment.update');
        Route::get('library-other-assignment/{library_occupant_manager}/{detailed_code}/edit', [LibraryOtherAssignmentController::class, 'edit'])->name('library-other-assignment.edit');
        Route::delete('library-other-assignment/destroy/{detailed_code}', [LibraryOtherAssignmentController::class, 'destroy'])->name('library-other-assignment.destroy');

        Route::prefix('reports')->group(function () {
            Route::get('', [StatisticsController::class, 'index'])->name('statistics.index');
        });
    });
    // End of plantilla routes

    // Competency routes
    Route::prefix('competency')->group(function () {
        Route::prefix('personal-data')->group(function () {
            Route::get('competency-data', [CompetencyController::class, 'index'])->name('competency-data.index')->middleware('checkPermission:compentency_contacts_view');
            Route::get('view-profile/{cesno}', [ContactInformationController::class, 'updateOrCreate'])->name('competency-view-profile.updateOrCreate')->middleware('checkPermission:compentency_contacts_edit');
            Route::post('store/{cesno}', [ContactInformationController::class, 'store'])->name('competency-view-profile-contact-info.store')->middleware('checkPermission:compentency_contacts_add');
            Route::post('update/{ctrlno}/{cesno}', [ContactInformationController::class, 'update'])->name('competency-view-profile-contact-info.update')->middleware('checkPermission:compentency_contacts_edit');
            Route::put('update/{cesno}', [ContactInformationController::class, 'updateEmail'])->name('competency-contact-email.update')->middleware('checkPermission:compentency_contacts_edit');
        });

        Route::prefix('competency-non-ces-training-accredited')->group(function () {
            Route::get('index/{cesno}', [CompetencyOtherTrainingManagementController::class, 'index'])->name('non-ces-training-management.index')->middleware('checkPermission:compentency_non_ces_trainings_view');
            Route::get('create/{cesno}', [CompetencyOtherTrainingManagementController::class, 'create'])->name('non-ces-training-management.create')->middleware('checkPermission:compentency_non_ces_trainings_add');
            Route::post('store/{cesno}', [CompetencyOtherTrainingManagementController::class, 'store'])->name('non-ces-training-management.store')->middleware('checkPermission:compentency_non_ces_trainings_add');
            Route::get('edit/{ctrlno}/{cesno}', [CompetencyOtherTrainingManagementController::class, 'edit'])->name('non-ces-training-management.edit')->middleware('checkPermission:compentency_non_ces_trainings_edit');
            Route::put('update/{ctrlno}/{cesno}', [CompetencyOtherTrainingManagementController::class, 'update'])->name('non-ces-training-management.update')->middleware('checkPermission:compentency_non_ces_trainings_edit');
            Route::delete('destroy/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'destroy'])->name('non-ces-training-management.destroy')->middleware('checkPermission:compentency_non_ces_trainings_delete');
            Route::get('recently-deleted/{cesno}', [CompetencyOtherTrainingManagementController::class, 'recentlyDeleted'])->name('non-ces-training-management.recentlyDeleted')->middleware('checkPermission:compentency_non_ces_trainings_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'restore'])->name('non-ces-training-management.restore')->middleware('checkPermission:compentency_non_ces_trainings_delete');
            Route::delete('forceDelete/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'forceDelete'])->name('non-ces-training-management.forceDelete')->middleware('checkPermission:compentency_non_ces_trainings_delete');
            Route::get('edit-non-ces-training-201/{ctrlno}/{cesno}', [CompetencyOtherTrainingManagementController::class, 'editNonCesTraining201'])->name('non-ces-training-management.editNonCesTraining201')->middleware('checkPermission:compentency_non_ces_trainings_edit');
            Route::put('update-non-ces-training-201/{ctrlno}/{cesno}', [CompetencyOtherTrainingManagementController::class, 'updateNonCesTraining201'])->name('non-ces-training-management.updateNonCesTraining201')->middleware('checkPermission:compentency_non_ces_trainings_edit');
            Route::delete('destroy-non-ces-training-201/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'destroyNonCesTraining201'])->name('non-ces-training-management.destroyNonCesTraining201')->middleware('checkPermission:compentency_non_ces_trainings_delete');
            Route::post('recently-deleted/restore-non-ces-training-201/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'restoreNonCesTraining201'])->name('non-ces-training-management.restoreNonCesTraining201')->middleware('checkPermission:compentency_non_ces_trainings_delete');
            Route::delete('recently-deleted/force-delete-non-ces-training-201/{ctrlno}', [CompetencyOtherTrainingManagementController::class, 'forceDeleteNonCesTraining201'])->name('non-ces-training-management.forceDeleteNonCesTraining201')->middleware('checkPermission:compentency_non_ces_trainings_delete');
        });

        Route::prefix('training-provider-manager')->group(function () {
            Route::get('index', [TrainingProviderManagerController::class, 'index'])->name('training-provider-manager.index')->middleware('checkPermission:training_provider_manager_view');
            Route::get('create', [TrainingProviderManagerController::class, 'create'])->name('training-provider-manager.create')->middleware('checkPermission:training_provider_manager_add');
            Route::post('store', [TrainingProviderManagerController::class, 'store'])->name('training-provider-manager.store')->middleware('checkPermission:training_provider_manager_add');
            Route::get('edit/{ctrlno}', [TrainingProviderManagerController::class, 'edit'])->name('training-provider-manager.edit')->middleware('checkPermission:training_provider_manager_edit');
            Route::put('update/{ctrlno}', [TrainingProviderManagerController::class, 'update'])->name('training-provider-manager.update')->middleware('checkPermission:training_provider_manager_edit');
            Route::delete('destroy/{ctrlno}', [TrainingProviderManagerController::class, 'destroy'])->name('training-provider-manager.destroy')->middleware('checkPermission:training_provider_manager_delete');
            Route::get('recently-deleted', [TrainingProviderManagerController::class, 'recentlyDeleted'])->name('training-provider-manager.recentlyDeleted')->middleware('checkPermission:training_provider_manager_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [TrainingProviderManagerController::class, 'restore'])->name('training-provider-manager.restore')->middleware('checkPermission:training_provider_manager_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [TrainingProviderManagerController::class, 'forceDelete'])->name('training-provider-manager.forceDelete')->middleware('checkPermission:training_provider_manager_delete');
        });

        Route::prefix('training-venue-manager')->group(function () {
            Route::get('index', [TrainingVenueManagerController::class, 'index'])->name('training-venue-manager.index')->middleware('checkPermission:training_venue_manager_view');
            Route::get('create', [TrainingVenueManagerController::class, 'create'])->name('training-venue-manager.create')->middleware('checkPermission:training_venue_manager_add');
            Route::post('store', [TrainingVenueManagerController::class, 'store'])->name('training-venue-manager.store')->middleware('checkPermission:training_venue_manager_add');
            Route::get('edit/{ctrlno}', [TrainingVenueManagerController::class, 'edit'])->name('training-venue-manager.edit')->middleware('checkPermission:training_venue_manager_edit');
            Route::put('update/{ctrlno}', [TrainingVenueManagerController::class, 'update'])->name('training-venue-manager.update')->middleware('checkPermission:training_venue_manager_edit');
            Route::delete('destroy/{ctrlno}', [TrainingVenueManagerController::class, 'destroy'])->name('training-venue-manager.destroy')->middleware('checkPermission:training_venue_manager_delete');
            Route::get('recently-deleted', [TrainingVenueManagerController::class, 'recentlyDeleted'])->name('training-venue-manager.recentlyDeleted')->middleware('checkPermission:training_venue_manager_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [TrainingVenueManagerController::class, 'restore'])->name('training-venue-manager.restore')->middleware('checkPermission:training_venue_manager_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [TrainingVenueManagerController::class, 'forceDelete'])->name('training-venue-manager.forceDelete')->middleware('checkPermission:training_venue_manager_delete');
        });

        Route::prefix('training-category')->group(function () {
            Route::get('index', [TrainingCategoryController::class, 'index'])->name('training-category.index')->middleware('checkPermission:compentency_training_category_view');
            Route::get('create', [TrainingCategoryController::class, 'create'])->name('training-category.create')->middleware('checkPermission:compentency_training_category_add');
            Route::post('store', [TrainingCategoryController::class, 'store'])->name('training-category.store')->middleware('checkPermission:compentency_training_category_add');
            Route::get('edit/{ctrlno}', [TrainingCategoryController::class, 'edit'])->name('training-category.edit')->middleware('checkPermission:compentency_training_category_edit');
            Route::put('update/{ctrlno}', [TrainingCategoryController::class, 'update'])->name('training-category.update')->middleware('checkPermission:compentency_training_category_edit');
            Route::delete('destroy/{ctrlno}', [TrainingCategoryController::class, 'destroy'])->name('training-category.destroy')->middleware('checkPermission:compentency_training_category_delete');
            Route::get('recentlyDeleted', [TrainingCategoryController::class, 'recentlyDeleted'])->name('training-category.recentlyDeleted')->middleware('checkPermission:compentency_training_category_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [TrainingCategoryController::class, 'restore'])->name('training-category.restore')->middleware('checkPermission:compentency_training_category_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [TrainingCategoryController::class, 'forceDelete'])->name('training-category.forceDelete')->middleware('checkPermission:compentency_training_category_delete');
        });

        Route::prefix('training-secretariat')->group(function () {
            Route::get('index', [TrainingSecretariatController::class, 'index'])->name('training-secretariat.index')->middleware('checkPermission:compentency_training_secretariat_view');
            Route::get('create', [TrainingSecretariatController::class, 'create'])->name('training-secretariat.create')->middleware('checkPermission:compentency_training_secretariat_add');
            Route::post('store', [TrainingSecretariatController::class, 'store'])->name('training-secretariat.store')->middleware('checkPermission:compentency_training_secretariat_add');
            Route::get('edit/{ctrlno}', [TrainingSecretariatController::class, 'edit'])->name('training-secretariat.edit')->middleware('checkPermission:compentency_training_secretariat_edit');
            Route::put('update/{ctrlno}', [TrainingSecretariatController::class, 'update'])->name('training-secretariat.update')->middleware('checkPermission:compentency_training_secretariat_edit');
            Route::delete('destroy/{ctrlno}', [TrainingSecretariatController::class, 'destroy'])->name('training-secretariat.destroy')->middleware('checkPermission:compentency_training_secretariat_delete');
            Route::get('recentlyDeleted', [TrainingSecretariatController::class, 'recentlyDeleted'])->name('training-secretariat.recentlyDeleted')->middleware('checkPermission:compentency_training_secretariat_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [TrainingSecretariatController::class, 'restore'])->name('training-secretariat.restore')->middleware('checkPermission:compentency_training_secretariat_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [TrainingSecretariatController::class, 'forceDelete'])->name('training-secretariat.forceDelete')->middleware('checkPermission:compentency_training_secretariat_delete');
        });

        Route::prefix('field-specialization')->group(function () {
            Route::get('index', [FieldSpecializationController::class, 'index'])->name('field-specialization.index')->middleware('checkPermission:compentency_field_specialization_view');
            Route::get('create', [FieldSpecializationController::class, 'create'])->name('field-specialization.create')->middleware('checkPermission:compentency_field_specialization_add');
            Route::post('store', [FieldSpecializationController::class, 'store'])->name('field-specialization.store')->middleware('checkPermission:compentency_field_specialization_add');
            Route::get('edit/{ctrlno}', [FieldSpecializationController::class, 'edit'])->name('field-specialization.edit')->middleware('checkPermission:compentency_field_specialization_edit');
            Route::put('update/{ctrlno}', [FieldSpecializationController::class, 'update'])->name('field-specialization.update')->middleware('checkPermission:compentency_field_specialization_edit');
            Route::delete('destroy/{ctrlno}', [FieldSpecializationController::class, 'destroy'])->name('field-specialization.destroy')->middleware('checkPermission:compentency_field_specialization_delete');
            Route::get('recentlyDeleted', [FieldSpecializationController::class, 'recentlyDeleted'])->name('field-specialization.recentlyDeleted')->middleware('checkPermission:compentency_field_specialization_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [FieldSpecializationController::class, 'restore'])->name('field-specialization.restore')->middleware('checkPermission:compentency_field_specialization_delete');
            Route::delete('recently-deleted/force-delete/{ctrlno}', [FieldSpecializationController::class, 'forceDelete'])->name('field-specialization.forceDelete')->middleware('checkPermission:compentency_field_specialization_delete');
        });

        Route::prefix('resource-speaker')->group(function () {
            Route::get('index', [ResourceSpeakerController::class, 'index'])->name('resource-speaker.index')->middleware('checkPermission:compentency_resource_speaker_view');
            Route::get('create', [ResourceSpeakerController::class, 'create'])->name('resource-speaker.create')->middleware('checkPermission:compentency_resource_speaker_add');
            Route::post('store', [ResourceSpeakerController::class, 'store'])->name('resource-speaker.store')->middleware('checkPermission:compentency_resource_speaker_add');
            Route::get('edit/{ctrlno}', [ResourceSpeakerController::class, 'edit'])->name('resource-speaker.edit')->middleware('checkPermission:compentency_resource_speaker_edit');
            Route::put('update/{ctrlno}', [ResourceSpeakerController::class, 'update'])->name('resource-speaker.update')->middleware('checkPermission:compentency_resource_speaker_edit');
            Route::delete('destroy/{ctrlno}', [ResourceSpeakerController::class, 'destroy'])->name('resource-speaker.destroy')->middleware('checkPermission:compentency_resource_speaker_delete');
            Route::get('recently-deleted', [ResourceSpeakerController::class, 'recentlyDeleted'])->name('resource-speaker.recentlyDeleted')->middleware('checkPermission:compentency_resource_speaker_delete');
            Route::post('recently-deleted/restore/{ctrlno}', [ResourceSpeakerController::class, 'restore'])->name('resource-speaker.restore')->middleware('checkPermission:compentency_resource_speaker_delete');
            Route::delete('recently-deleted/forceDelete/{ctrlno}', [ResourceSpeakerController::class, 'forceDelete'])->name('resource-speaker.forceDelete')->middleware('checkPermission:compentency_resource_speaker_delete');
            Route::get('training-enagagement/{ctrlno}', [ResourceSpeakerController::class, 'trainingEnagagement'])->name('resource-speaker.trainingEnagagement')->middleware('checkPermission:compentency_resource_speaker_delete');
        });

        Route::prefix('training-session')->group(function () {
            Route::get('index', [TrainingSessionController::class, 'index'])->name('training-session.index')->middleware('checkPermission:compentency_training_session_view');
            Route::get('create', [TrainingSessionController::class, 'create'])->name('training-session.create')->middleware('checkPermission:compentency_training_session_add');
            Route::post('store', [TrainingSessionController::class, 'store'])->name('training-session.store')->middleware('checkPermission:compentency_training_session_add');
            Route::get('edit/{ctrlno}', [TrainingSessionController::class, 'edit'])->name('training-session.edit')->middleware('checkPermission:compentency_training_session_edit');
            Route::put('update/{ctrlno}', [TrainingSessionController::class, 'update'])->name('training-session.update')->middleware('checkPermission:compentency_training_session_edit');
            Route::delete('destroy/{ctrlno}', [TrainingSessionController::class, 'destroy'])->name('training-session.destroy')->middleware('checkPermission:compentency_training_session_delete');
            Route::get('recently-deleted', [TrainingSessionController::class, 'recentlyDeleted'])->name('training-session.recentlyDeleted')->middleware('checkPermission:compentency_training_session_delete');
            Route::post('restore/recently-deleted/{ctrlno}', [TrainingSessionController::class, 'restore'])->name('training-session.restore')->middleware('checkPermission:compentency_training_session_delete');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [TrainingSessionController::class, 'forceDelete'])->name('training-session.forceDelete')->middleware('checkPermission:compentency_training_session_delete');
        });

        Route::prefix('training-session-participant')->group(function () {
            Route::get('participant-list/{sessionId}', [TrainingParticipantsController::class, 'participantList'])->name('training-session.participantList')->middleware('checkPermission:compentency_training_session_view');
            Route::get('add-participant/{sessionId}', [TrainingParticipantsController::class, 'addParticipant'])->name('training-session.addParticipant');
            Route::post('store-participant/{sessionId}', [TrainingParticipantsController::class, 'storeParticipant'])->name('training-session.storeParticipant');
            Route::get('edit-participant/{pid}/{sessionId}', [TrainingParticipantsController::class, 'editParticipant'])->name('training-session.editParticipant');
            Route::put('update-participant/{pid}/{sessionId}', [TrainingParticipantsController::class, 'updateParticipant'])->name('training-session.updateParticipant');
            Route::delete('participant-destroy/{pid}', [TrainingParticipantsController::class, 'destroyParticipant'])->name('training-participant.destroy')->middleware('checkPermission:compentency_training_session_delete');
            Route::get('recently-deleted-participant-list', [TrainingParticipantsController::class, 'recentlyDeletedParticipant'])->name('training-session.recentlyDeletedParticipant')->middleware('checkPermission:compentency_training_session_delete');
            Route::post('restore-participant-list/{pid}', [TrainingParticipantsController::class, 'restoreParticipantList'])->name('training-session.restoreParticipantList')->middleware('checkPermission:compentency_training_session_delete');
            Route::delete('force-delete-participant-list/{pid}', [TrainingParticipantsController::class, 'forceDeleteParticipantList'])->name('training-participant.forceDeleteParticipantList')->middleware('checkPermission:compentency_training_session_delete');
        });


        Route::prefix('competency-ces-training')->group(function () {
            Route::get('index/{cesno}', [CompetencyCesTrainingController::class, 'index'])->name('ces-training.index')->middleware('checkPermission:compentency_ces_training_view');
            Route::get('create/{cesno}', [CompetencyCesTrainingController::class, 'create'])->name('ces-training.create')->middleware('checkPermission:compentency_ces_training_add');
            Route::post('store/{cesno}', [CompetencyCesTrainingController::class, 'store'])->name('ces-training.store')->middleware('checkPermission:compentency_ces_training_add');
            Route::get('edit/{ctrlno}/{cesno}', [CompetencyCesTrainingController::class, 'edit'])->name('ces-training.edit')->middleware('checkPermission:compentency_ces_training_edit');
            Route::put('update/{ctrlno}/{cesno}', [CompetencyCesTrainingController::class, 'update'])->name('ces-training.update')->middleware('checkPermission:compentency_ces_training_edit');
            Route::delete('destroy/{ctrlno}', [CompetencyCesTrainingController::class, 'destroy'])->name('ces-training.destroy')->middleware('checkPermission:compentency_ces_training_delete');
            Route::get('recently-deleted/{cesno}', [CompetencyCesTrainingController::class, 'recentlyDeleted'])->name('ces-training.recentlyDeleted')->middleware('checkPermission:compentency_ces_training_delete');
            Route::post('restore/recently-deleted/{ctrlno}', [CompetencyCesTrainingController::class, 'restore'])->name('ces-training.restore')->middleware('checkPermission:compentency_ces_training_delete');
            Route::delete('force-delete//recently-deleted/{ctrlno}', [CompetencyCesTrainingController::class, 'forceDelete'])->name('ces-training.forceDelete')->middleware('checkPermission:compentency_ces_training_delete');
        });
    });
    // End of competency routes

    //  competency report routes
    Route::prefix('competency-report')->group(function () {
        Route::prefix('general-report')->group(function () {
            Route::get('index', [GeneralReportController::class, 'index'])->name('competency-management-sub-modules-report.generalReportIndex')->middleware('checkPermission:competency_management_sub_modules_report_view');
            Route::post('generate-pdf/{sessionId}', [GeneralReportController::class, 'generatePdf'])->name('competency-management-sub-modules-report.generalReportGeneratePdf')->middleware('checkPermission:competency_management_sub_modules_report_view');
        });

        Route::prefix('training-provider')->group(function () {
            Route::get('index', [TrainingProviderManagerReportController::class, 'index'])->name('competency-management-sub-modules-report.trainingProviderIndexReport')->middleware('checkPermission:competency_management_sub_modules_report_view');
            Route::post('generate-pdf', [TrainingProviderManagerReportController::class, 'generatePDF'])->name('competency-management-sub-modules-report.trainingProviderGenerateReport')->middleware('checkPermission:competency_management_sub_modules_report_view');
        });

        Route::prefix('training-venue-manager')->group(function () {
            Route::get('report', [TrainingVenueManagerReportController::class, 'index'])->name('competency-management-sub-modules-report.trainingVenueManagerReportIndex')->middleware('checkPermission:competency_management_sub_modules_report_view');
            Route::post('generate-pdf-by-city', [TrainingVenueManagerReportController::class, 'generatePdf'])->name('competency-management-sub-modules-report.trainingVenueManagerReportGeneratePdf')->middleware('checkPermission:competency_management_sub_modules_report_view');
        });

        Route::prefix('resource-speaker-manager')->group(function () {
            Route::get('report', [ResourceSpeakerManagerReportController::class, 'index'])->name('competency-management-sub-modules-report.resourceSpeakerIndexReport')->middleware('checkPermission:competency_management_sub_modules_report_view');
            Route::post('report-generate-pdf', [ResourceSpeakerManagerReportController::class, 'generateReport'])->name('competency-management-sub-modules-report.resourceSpeakerGenerateReport')->middleware('checkPermission:competency_management_sub_modules_report_view');
        });
    });
    //  end of competency report routes

    //  ERIS routes
    Route::prefix('eris')->group(function () {
        Route::prefix('profile-data')->group(function () {
            Route::get('index', [ErisProfileController::class, 'index'])->name('eris-index');
            Route::get('create', [ErisProfileController::class, 'create'])->name('eris.create');
            Route::post('store', [ErisProfileController::class, 'store'])->name('eris.store');
            Route::get('edit/{acno}', [ErisProfileController::class, 'edit'])->name('eris.edit');
            Route::put('update/{acno}', [ErisProfileController::class, 'update'])->name('eris.update');
        });

        Route::prefix('written-exam')->group(function () {
            Route::get('index/{acno}', [WrittenExamController::class, 'index'])->name('eris-written-exam.index');
            Route::get('create/{acno}', [WrittenExamController::class, 'create'])->name('eris-written-exam.create');
            Route::post('store/{acno}', [WrittenExamController::class, 'store'])->name('eris-written-exam.store');
            Route::get('edit/{acno}/{ctrlno}', [WrittenExamController::class, 'edit'])->name('eris-written-exam.edit');
            Route::put('update/{acno}/{ctrlno}', [WrittenExamController::class, 'update'])->name('eris-written-exam.update');
            Route::delete('destroy/{ctrlno}', [WrittenExamController::class, 'destroy'])->name('eris-written-exam.destroy');
            Route::get('recently-deleted/{acno}', [WrittenExamController::class, 'recentlyDeleted'])->name('eris-written-exam.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [WrittenExamController::class, 'restore'])->name('eris-written-exam.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [WrittenExamController::class, 'forceDelete'])->name('eris-written-exam.forceDelete');
        });

        Route::prefix('assessment-center')->group(function () {
            Route::get('index/{acno}', [AssessmentCenterController::class, 'index'])->name('eris-assessment-center.index');
            Route::get('create/{acno}', [AssessmentCenterController::class, 'create'])->name('eris-assessment-center.create');
            Route::post('store/{acno}', [AssessmentCenterController::class, 'store'])->name('eris-assessment-center.store');
            Route::get('edit/{acno}/{ctrlno}', [AssessmentCenterController::class, 'edit'])->name('eris-assessment-center.edit');
            Route::put('update/{acno}/{ctrlno}', [AssessmentCenterController::class, 'update'])->name('eris-assessment-center.update');
            Route::delete('destroy/{ctrlno}', [AssessmentCenterController::class, 'destroy'])->name('eris-assessment-center.destroy');
            Route::get('recently-deleted/{acno}', [AssessmentCenterController::class, 'recentlyDeleted'])->name('eris-assessment-center.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [AssessmentCenterController::class, 'restore'])->name('eris-assessment-center.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [AssessmentCenterController::class, 'forceDelete'])->name('eris-assessment-center.forceDelete');
        });

        Route::prefix('rapid-validation')->group(function () {
            Route::get('index/{acno}', [RapidValidationController::class, 'index'])->name('eris-rapid-validation.index');
            Route::get('create/{acno}', [RapidValidationController::class, 'create'])->name('eris-rapid-validation.create');
            Route::post('store/{acno}', [RapidValidationController::class, 'store'])->name('eris-rapid-validation.store');
            Route::get('edit/{acno}/{ctrlno}', [RapidValidationController::class, 'edit'])->name('eris-rapid-validation.edit');
            Route::put('update/{acno}/{ctrlno}', [RapidValidationController::class, 'update'])->name('eris-rapid-validation.update');
            Route::delete('destroy/{ctrlno}', [RapidValidationController::class, 'destroy'])->name('eris-rapid-validation.destroy');
            Route::get('recently-deleted/{acno}', [RapidValidationController::class, 'recentlyDeleted'])->name('eris-rapid-validation.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [RapidValidationController::class, 'restore'])->name('eris-rapid-validation.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [RapidValidationController::class, 'forceDelete'])->name('eris-rapid-validation.forceDelete');
        });

        Route::prefix('in-depth-validation')->group(function () {
            Route::get('index/{acno}', [InDepthValidationController::class, 'index'])->name('eris-in-depth-validation.index');
            Route::get('create/{acno}', [InDepthValidationController::class, 'create'])->name('eris-in-depth-validation.create');
            Route::post('store/{acno}', [InDepthValidationController::class, 'store'])->name('eris-in-depth-validation.store');
            Route::get('edit/{acno}/{ctrlno}', [InDepthValidationController::class, 'edit'])->name('eris-in-depth-validation.edit');
            Route::put('update/{acno}/{ctrlno}', [InDepthValidationController::class, 'update'])->name('eris-in-depth-validation.update');
            Route::delete('destroy/{ctrlno}', [InDepthValidationController::class, 'destroy'])->name('eris-in-depth-validation.destroy');
            Route::get('recently-deleted/{acno}', [InDepthValidationController::class, 'recentlyDeleted'])->name('eris-in-depth-validation.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [InDepthValidationController::class, 'restore'])->name('eris-in-depth-validation.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [InDepthValidationController::class, 'forceDelete'])->name('eris-in-depth-validation.forceDelete');
        });

        Route::prefix('panel-board-interview')->group(function () {
            Route::get('index/{acno}', [PanelBoardInterviewController::class, 'index'])->name('panel-board-interview.index');
            Route::get('create/{acno}', [PanelBoardInterviewController::class, 'create'])->name('panel-board-interview.create');
            Route::post('store/{acno}', [PanelBoardInterviewController::class, 'store'])->name('panel-board-interview.store');
            Route::get('edit/{acno}/{ctrlno}', [PanelBoardInterviewController::class, 'edit'])->name('panel-board-interview.edit');
            Route::put('update/{acno}/{ctrlno}', [PanelBoardInterviewController::class, 'update'])->name('panel-board-interview.update');
            Route::delete('destroy/{ctrlno}', [PanelBoardInterviewController::class, 'destroy'])->name('panel-board-interview.destroy');
            Route::get('recently-deleted/{acno}', [PanelBoardInterviewController::class, 'recentlyDeleted'])->name('panel-board-interview.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [PanelBoardInterviewController::class, 'restore'])->name('panel-board-interview.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [PanelBoardInterviewController::class, 'forceDelete'])->name('panel-board-interview.forceDelete');
        });

        Route::prefix('board-interview')->group(function () {
            Route::get('index/{acno}', [BoardInterviewController::class, 'index'])->name('eris-board-interview.index');
            Route::get('create/{acno}', [BoardInterviewController::class, 'create'])->name('eris-board-interview.create');
            Route::post('store/{acno}', [BoardInterviewController::class, 'store'])->name('eris-board-interview.store');
            Route::get('edit/{acno}/{ctrlno}', [BoardInterviewController::class, 'edit'])->name('eris-board-interview.edit');
            Route::put('update/{acno}/{ctrlno}', [BoardInterviewController::class, 'update'])->name('eris-board-interview.update');
            Route::delete('destroy/{ctrlno}', [BoardInterviewController::class, 'destroy'])->name('eris-board-interview.destroy');
            Route::get('recently-deleted/{acno}', [BoardInterviewController::class, 'recentlyDeleted'])->name('eris-board-interview.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}', [BoardInterviewController::class, 'restore'])->name('eris-board-interview.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}', [BoardInterviewController::class, 'forceDelete'])->name('eris-board-interview.forceDelete');
        });

        Route::prefix('rank-tracker')->group(function () {
            Route::get('index/{acno}', [RankTrackerController::class, 'index'])->name('eris-rank-tracker.index');
            Route::get('create/{acno}', [RankTrackerController::class, 'create'])->name('eris-rank-tracker.create');
            Route::post('store/{acno}', [RankTrackerController::class, 'store'])->name('eris-rank-tracker.store');
            Route::get('edit/{acno}/{ctrlno}', [RankTrackerController::class, 'edit'])->name('eris-rank-tracker.edit');
            Route::put('update/{acno}/{ctrlno}', [RankTrackerController::class, 'update'])->name('eris-rank-tracker.update');
            Route::delete('destroy/{ctrlno}/{cesno}', [RankTrackerController::class, 'destroy'])->name('eris-rank-tracker.destroy');
            Route::get('recently-deleted/{acno}', [RankTrackerController::class, 'recentlyDeleted'])->name('eris-rank-tracker.recentlyDeleted');
            Route::post('restore/recently-deleted/{ctrlno}/{cesno}', [RankTrackerController::class, 'restore'])->name('eris-rank-tracker.restore');
            Route::delete('force-delete/recently-deleted/{ctrlno}/{cesno}', [RankTrackerController::class, 'forceDelete'])->name('eris-rank-tracker.forceDelete');
        });
    });
    //  end of ERIS routes

    // Reports routes
    Route::prefix('reports')->group(function () {

        Route::prefix('executive-201-profile ')->group(function () {

            Route::get('general-reports', [Reports201Controller::class, 'index'])->name('general-reports.index');
        });
    });
    // End of Reports routes

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
        Route::post('permissions/competency/update/{role_name}/{role_title}', [PermissionsController::class, 'updateCompetencyPermissions'])->name('competencyPermissions.update');
        Route::post('permissions/plantilla/update/{role_name}/{role_title}', [PermissionsController::class, 'updatePlantillaPermissions'])->name('plantillaPermissions.update');

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

        Route::prefix('examination-library')->group(function () {
            Route::get('index', [ProfileLibTblExamRefController::class, 'index'])->name('examination.index');
            Route::get('create', [ProfileLibTblExamRefController::class, 'create'])->name('examination.create');
            Route::post('store', [ProfileLibTblExamRefController::class, 'store'])->name('examination.store');
            Route::get('edit/{code}', [ProfileLibTblExamRefController::class, 'edit'])->name('examination.edit');
            Route::put('update/{code}', [ProfileLibTblExamRefController::class, 'update'])->name('examination.update');
            Route::delete('destroy/{code}', [ProfileLibTblExamRefController::class, 'destroy'])->name('examination.destroy');
            Route::get('recently-deleted', [ProfileLibTblExamRefController::class, 'recentlyDeleted'])->name('examination.recentlyDeleted');
            Route::post('restore/recently-deleted/{code}', [ProfileLibTblExamRefController::class, 'restore'])->name('examination.restore');
            Route::delete('force-delete/recently-deleted/{code}', [ProfileLibTblExamRefController::class, 'forceDelete'])->name('examination.forceDelete');
        });

        Route::prefix('language-library')->group(function () {
            Route::get('index', [ProfileLibTblLanguageRefController::class, 'index'])->name('language-library.index');
            Route::get('create', [ProfileLibTblLanguageRefController::class, 'create'])->name('language-library.create');
            Route::post('store', [ProfileLibTblLanguageRefController::class, 'store'])->name('language-library.store');
            Route::get('edit/{code}', [ProfileLibTblLanguageRefController::class, 'edit'])->name('language-library.edit');
            Route::put('update/{code}', [ProfileLibTblLanguageRefController::class, 'update'])->name('language-library.update');
            Route::delete('destroy/{code}', [ProfileLibTblLanguageRefController::class, 'destroy'])->name('language-library.destroy');
            Route::get('recently-deleted', [ProfileLibTblLanguageRefController::class, 'recentlyDeleted'])->name('language-library.recentlyDeleted');
            Route::post('restore/recently-deleted/{code}', [ProfileLibTblLanguageRefController::class, 'restore'])->name('language-library.restore');
            Route::delete('force-delete/recently-deleted/{code}', [ProfileLibTblLanguageRefController::class, 'forceDelete'])->name('language-library.forceDelete');
        });

        Route::prefix('ces-status-library')->group(function () {
            Route::get('index', [ProfileLibTblCesStatusController::class, 'index'])->name('ces-status-library.index');
            Route::get('create', [ProfileLibTblCesStatusController::class, 'create'])->name('ces-status-library.create');
            Route::post('store', [ProfileLibTblCesStatusController::class, 'store'])->name('ces-status-library.store');
            Route::get('edit/{code}', [ProfileLibTblCesStatusController::class, 'edit'])->name('ces-status-library.edit');
            Route::put('update/{code}', [ProfileLibTblCesStatusController::class, 'update'])->name('ces-status-library.update');
            Route::delete('destroy/{code}', [ProfileLibTblCesStatusController::class, 'destroy'])->name('ces-status-library.destroy');
            Route::get('recently-deleted', [ProfileLibTblCesStatusController::class, 'recentlyDeleted'])->name('ces-status-library.recentlyDeleted');
            Route::post('restore/recently-deleted/{code}', [ProfileLibTblCesStatusController::class, 'restore'])->name('ces-status-library.restore');
            Route::delete('force-delete/recently-deleted/{code}', [ProfileLibTblCesStatusController::class, 'forceDelete'])->name('ces-status-library.forceDelete');
        });

        Route::prefix('appointing-authority-library')->group(function () {
            Route::get('index', [ProfileLibTblAppAuthorityController::class, 'index'])->name('appointing-authority-library.index');
            Route::get('create', [ProfileLibTblAppAuthorityController::class, 'create'])->name('appointing-authority-library.create');
            Route::post('store', [ProfileLibTblAppAuthorityController::class, 'store'])->name('appointing-authority-library.store');
            Route::get('edit/{code}', [ProfileLibTblAppAuthorityController::class, 'edit'])->name('appointing-authority-library.edit');
            Route::put('update/{code}', [ProfileLibTblAppAuthorityController::class, 'update'])->name('appointing-authority-library.update');
            Route::delete('destroy/{code}', [ProfileLibTblAppAuthorityController::class, 'destroy'])->name('appointing-authority-library.destroy');
            Route::get('recently-deleted', [ProfileLibTblAppAuthorityController::class, 'recentlyDeleted'])->name('appointing-authority-library.recentlyDeleted');
            Route::post('restore/recently-deleted/{code}', [ProfileLibTblAppAuthorityController::class, 'restore'])->name('appointing-authority-library.restore');
            Route::delete('force-delete/recently-deleted/{code}', [ProfileLibTblAppAuthorityController::class, 'forceDelete'])->name('appointing-authority-library.forceDelete');
        });

        Route::prefix('ces-status-type-library')->group(function () {
            Route::get('index', [ProfileLibTblCesStatusTypeController::class, 'index'])->name('ces-status-type-library.index');
            Route::get('create', [ProfileLibTblCesStatusTypeController::class, 'create'])->name('ces-status-type-library.create');
            Route::post('store', [ProfileLibTblCesStatusTypeController::class, 'store'])->name('ces-status-type-library.store');
            Route::get('edit/{code}', [ProfileLibTblCesStatusTypeController::class, 'edit'])->name('ces-status-type-library.edit');
            Route::put('update/{code}', [ProfileLibTblCesStatusTypeController::class, 'update'])->name('ces-status-type-library.update');
            Route::delete('destroy/{code}', [ProfileLibTblCesStatusTypeController::class, 'destroy'])->name('ces-status-type-library.destroy');
            Route::get('recently-deleted', [ProfileLibTblCesStatusTypeController::class, 'recentlyDeleted'])->name('ces-status-type-library.recentlyDeleted');
            Route::post('restore/recently-deleted/{code}', [ProfileLibTblCesStatusTypeController::class, 'restore'])->name('ces-status-type-library.restore');
            Route::delete('force-delete/recently-deleted/{code}', [ProfileLibTblCesStatusTypeController::class, 'forceDelete'])->name('ces-status-type-library.forceDelete');
        });

        Route::prefix('ces-status-acquired-thru-library')->group(function () {
            Route::get('index', [ProfileLibTblCesStatusAcquiredThruController::class, 'index'])->name('ces-status-acquired-thru-library.index');
            Route::get('create', [ProfileLibTblCesStatusAcquiredThruController::class, 'create'])->name('ces-status-acquired-thru-library.create');
            Route::post('store', [ProfileLibTblCesStatusAcquiredThruController::class, 'store'])->name('ces-status-acquired-thru-library.store');
            Route::get('edit/{code}', [ProfileLibTblCesStatusAcquiredThruController::class, 'edit'])->name('ces-status-acquired-thru-library.edit');
            Route::put('update/{code}', [ProfileLibTblCesStatusAcquiredThruController::class, 'update'])->name('ces-status-acquired-thru-library.update');
            Route::delete('destroy/{code}', [ProfileLibTblCesStatusAcquiredThruController::class, 'destroy'])->name('ces-status-acquired-thru-library.destroy');
            Route::get('recently-deleted', [ProfileLibTblCesStatusAcquiredThruController::class, 'recentlyDeleted'])->name('ces-status-acquired-thru-library.recentlyDeleted');
            Route::post('restore/recently-deleted/{code}', [ProfileLibTblCesStatusAcquiredThruController::class, 'restore'])->name('ces-status-acquired-thru-library.restore');
        });

        Route::prefix('case-nature-library')->group(function () {
            Route::get('index', [ProfileLibTblCaseNatureController::class, 'index'])->name('case-nature-library.index');
            Route::get('create', [ProfileLibTblCaseNatureController::class, 'create'])->name('case-nature-library.create');
            Route::post('store', [ProfileLibTblCaseNatureController::class, 'store'])->name('case-nature-library.store');
            Route::get('edit/{code}', [ProfileLibTblCaseNatureController::class, 'edit'])->name('case-nature-library.edit');
            Route::put('update/{code}', [ProfileLibTblCaseNatureController::class, 'update'])->name('case-nature-library.update');
            Route::delete('destroy/{code}', [ProfileLibTblCaseNatureController::class, 'destroy'])->name('case-nature-library.destroy');
        });

        Route::prefix('case-status-library')->group(function () {
            Route::get('index', [ProfileLibTblCaseStatusController::class, 'index'])->name('case-status-library.index');
            Route::get('create', [ProfileLibTblCaseStatusController::class, 'create'])->name('case-status-library.create');
            Route::post('store', [ProfileLibTblCaseStatusController::class, 'store'])->name('case-status-library.store');
            Route::get('edit/{code}', [ProfileLibTblCaseStatusController::class, 'edit'])->name('case-status-library.edit');
            Route::put('update/{code}', [ProfileLibTblCaseStatusController::class, 'update'])->name('case-status-library.update');
            Route::delete('destroy/{code}', [ProfileLibTblCaseStatusController::class, 'destroy'])->name('case-status-library.destroy');
        });

        Route::prefix('expertise-specialization-library')->group(function () {
            Route::get('index', [ProfileLibTblExpertiseSpecController::class, 'index'])->name('expertise-specialization.index');
            Route::get('create', [ProfileLibTblExpertiseSpecController::class, 'create'])->name('expertise-specialization.create');
            Route::post('store', [ProfileLibTblExpertiseSpecController::class, 'store'])->name('expertise-specialization.store');
            Route::get('edit/{code}', [ProfileLibTblExpertiseSpecController::class, 'edit'])->name('expertise-specialization.edit');
            Route::put('update/{code}', [ProfileLibTblExpertiseSpecController::class, 'update'])->name('expertise-specialization.update');
            Route::delete('destroy/{code}', [ProfileLibTblExpertiseSpecController::class, 'destroy'])->name('expertise-specialization.destroy');
        });

        Route::prefix('expertise-general-library')->group(function () {
            Route::get('index', [ProfileLibTblExpertiseGenController::class, 'index'])->name('expertise-general.index');
            Route::get('create', [ProfileLibTblExpertiseGenController::class, 'create'])->name('expertise-general.create');
            Route::post('store', [ProfileLibTblExpertiseGenController::class, 'store'])->name('expertise-general.store');
            Route::get('edit/{code}', [ProfileLibTblExpertiseGenController::class, 'edit'])->name('expertise-general.edit');
            Route::put('update/{code}', [ProfileLibTblExpertiseGenController::class, 'update'])->name('expertise-general.update');
            Route::delete('destroy/{code}', [ProfileLibTblExpertiseGenController::class, 'destroy'])->name('expertise-general.destroy');
        });
    });
    // End of Library routes

});