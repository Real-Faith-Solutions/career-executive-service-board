<?php

use App\Http\Controllers\AddAddress201;
use App\Http\Controllers\AddProfile201;
use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AwardAndCitationController;
use App\Http\Controllers\CaseRecordController;
use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\CompetencyController;
use App\Http\Controllers\DepartmentAgencyController;
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
use App\Http\Controllers\OtherTrainingController;
use App\Http\Controllers\Plantilla\AgencyLocationManagerController;
use App\Http\Controllers\Plantilla\AppointeeOccupantBrowserController;
use App\Http\Controllers\Plantilla\AppointeeOccupantManagerController;
use App\Http\Controllers\Plantilla\DepartmentAgencyManagerController;
use App\Http\Controllers\Plantilla\OfficeManagerController;
use App\Http\Controllers\Plantilla\PlantillaManagementController;
use App\Http\Controllers\Plantilla\PlantillaPositionManagerController;
use App\Http\Controllers\Plantilla\SectorManagerController;
use App\Http\Controllers\PWDController;
use App\Http\Controllers\RecordStatusController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\ResearchAndStudiesController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SectorManagerController as ControllersSectorManagerController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\WorkExperienceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Homepage, login, logout and forgot password route

Route::get('/', function () {

    if(!Auth::check()){
        return view('login');
    }else{
        return Redirect::to('/admin/dashboard');
    }
});

Route::prefix('plantilla')->group(function () {

    Route::prefix('plantilla-management')->group(function () {
        Route::get('/', [PlantillaManagementController::class, 'index'])->name('plantilla-management.index');
    });

    Route::prefix('sector-manager')->group(function () {
        Route::get('/', [SectorManagerController::class, 'index'])->name('sector-manager.index');

        Route::get('create', [SectorManagerController::class, 'create'])->name('sector-manager.create');
        Route::post('store', [SectorManagerController::class, 'store'])->name('sector-manager.store');
        Route::get('{sectorid}/edit', [SectorManagerController::class, 'edit'])->name('sector-manager.edit');
        Route::post('{sectorid}/update', [SectorManagerController::class, 'update'])->name('sector-manager.update');
        Route::delete('{sectorid}/destroy', [SectorManagerController::class, 'destroy'])->name('sector-manager.destroy');
        Route::get('recently_deleted', [SectorManagerController::class, 'recentlyDeleted'])->name('sector-manager.recentlyDeleted');
        Route::post('{sectorid}/restore', [SectorManagerController::class, 'restore'])->name('sector-manager.restore');
        Route::post('{sectorid}/force-delete', [SectorManagerController::class, 'forceDelete'])->name('sector-manager.forceDelete');
    });

    Route::prefix('department-agency-manager')->group(function () {
        Route::get('/', [DepartmentAgencyManagerController::class, 'index'])->name('department-agency-manager.index');
        Route::get('{sectorid}/show', [SectorManagerController::class, 'show'])->name('sector-manager.show');
    });

    Route::prefix('agency-location-manager')->group(function () {
        Route::get('/', [AgencyLocationManagerController::class, 'index'])->name('agency-location-manager.index');
    });

    Route::prefix('office-manager')->group(function () {
        Route::get('/', [OfficeManagerController::class, 'index'])->name('office-manager.index');
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
});


Route::prefix('family-profile')->group(function () {
    Route::prefix('spouse')->group(function () {
        Route::get('{ctrlno}', [FamilyController::class, 'editSpouse'])->name('family-profile.editSpouse');
        Route::post('{cesno}', [FamilyController::class, 'storeSpouse'])->name('family-profile.store');
        Route::put('{ctrlno}', [FamilyController::class, 'updateSpouseRecord'])->name('family-profile.updateSpouseRecord');
        Route::delete('{ctrlno}', [FamilyController::class, 'destroySpouse'])->name('family-profile-spouse.delete');
    });

    Route::prefix('children')->group(function () {
        Route::get('{ctrlno}', [FamilyController::class, 'editChildren'])->name('family-profile.editChildren');
        Route::post('{cesno}', [FamilyController::class, 'storeChildren'])->name('family-profile-children.store');
        Route::put('{ctrlno}', [FamilyController::class, 'updateChildrenRecord'])->name('family-profile.updateChildren');
        Route::delete('{ctrlno}', [FamilyController::class, 'destroyChildren'])->name('family-profile-children.delete');
    });

    Route::prefix('father')->group(function () {
        Route::get('{ctrlno}', [FamilyController::class, 'editFather'])->name('family-profile-father.editFather');
        Route::post('store/{cesno}', [FamilyController::class, 'storeFather'])->name('family-profile-father.store');
        Route::put('{ctrlno}', [FamilyController::class, 'updateFatherRecord'])->name('family-profile-father.updateFatherRecord');
        Route::delete('delete/{ctrlno}', [FamilyController::class, 'destroyFather'])->name('family-profile-father.destroy');
    });

    Route::prefix('mother')->group(function () {
        Route::get('{ctrlno}', [FamilyController::class, 'editMother'])->name('family-profile-mother.editMother');
        Route::post('{cesno}', [FamilyController::class, 'storeMother'])->name('family-profile-mother.store');
        Route::put('{ctrlno}', [FamilyController::class, 'updateMotherRecord'])->name('family-profile-mother.updateMotherRecord');
        Route::delete('{ctrlno}', [FamilyController::class, 'destroyMother'])->name('family-profile-mother.destroy');
    });
});

Route::prefix('identification/card')->group(function () {
    Route::get('edit/{ctrlno}', [IdentificationController::class, 'edit'])->name('personal-data-identification.edit');
    Route::post('store/{cesno}', [IdentificationController::class, 'store'])->name('personal-data-identification.store');
    Route::put('update/{ctrlno}', [IdentificationController::class, 'update'])->name('personal-data-identification.update');
    Route::delete('destroy/{ctrlno}', [IdentificationController::class, 'destroyIdentification'])->name('personal-data-identification.destroy');
});

Route::prefix('educational-attainment')->group(function () {
    Route::get('edit/{ctrlno}', [EducationalAttainmentController::class, 'edit'])->name('educational-attainment.edit');
    Route::post('store/{cesno}', [EducationalAttainmentController::class, 'storeEducationAttainment'])->name('educational-attainment.store');
    Route::put('updated/{ctrlno}', [EducationalAttainmentController::class, 'update'])->name('educational-attainment.update');
    Route::delete('destroy/{ctrlno}', [EducationalAttainmentController::class, 'destroyEducationalAttainment'])->name('educational-attainment.destroy');
    Route::get('recently-deleted/{cesno}', [EducationalAttainmentController::class, 'recycleBin'])->name('educational-attainment.recycleBin');
    Route::post('recently-deleted/restore/{ctrlno}', [EducationalAttainmentController::class, 'restore'])->name('educational-attainment.restore');
    Route::delete('recently-deleted/force-delete/{ctrlno}', [EducationalAttainmentController::class, 'forceDelete'])->name('educational-attainment.forceDelete');
});

Route::prefix('examination-taken')->group(function () {
    Route::get('edit/{ctrlno}', [ExaminationTakenController::class, 'edit'])->name('examination-taken.edit');
    Route::post('store/{cesno}', [ExaminationTakenController::class, 'store'])->name('examination-taken.store');
    Route::put('update/{ctrlno}', [ExaminationTakenController::class, 'update'])->name('examination-taken.update');
    Route::delete('taken/delete/{ctrlno}', [ExaminationTakenController::class, 'destroy'])->name('examination-taken.destroy');
});

Route::prefix('scholarship-taken')->group(function () {
    Route::get('edit/{ctrlno}', [ScholarshipController::class, 'edit'])->name('scholarship.edit');
    Route::post('store/{cesno}', [ScholarshipController::class, 'store'])->name('scholarship.store');
    Route::put('update/{ctrlno}', [ScholarshipController::class, 'update'])->name('scholarship.update');
    Route::delete('destroy/{ctrlno}', [ScholarshipController::class, 'destroy'])->name('scholarship.destroy');
    Route::get('recently-deleted/{cesno}', [ScholarshipController::class, 'recycleBin'])->name('scholarship.recycleBin');
    Route::post('recently-deleted/restore/{ctrlno}', [ScholarshipController::class, 'restore'])->name('scholarship.restore');
    Route::delete('recently-deleted/force-delete/{ctrlno}', [ScholarshipController::class, 'forceDelete'])->name('scholarship.forceDelete');
});

Route::prefix('research-studies')->group(function () {
    Route::get('edit/{ctrlno}', [ResearchAndStudiesController::class, 'edit'])->name('research-studies.edit');
    Route::post('store/{cesno}', [ResearchAndStudiesController::class, 'store'])->name('research-studies.store');
    Route::put('update/{ctrlno}', [ResearchAndStudiesController::class, 'update'])->name('research-studies.update');
    Route::delete('destroy/{ctrlno}', [ResearchAndStudiesController::class, 'destroy'])->name('research-studies.destroy');
    Route::get('recently-deleted/{cesno}', [ResearchAndStudiesController::class, 'recycleBin'])->name('research-studies.recycleBin');
    Route::post('recently-deleted/restore/{ctrlno}', [ResearchAndStudiesController::class, 'restore'])->name('research-studies.restore');
    Route::delete('recently-deleted/force-delete/{ctrlno}', [ResearchAndStudiesController::class, 'forceDelete'])->name('research-studies.forceDelete');
});

Route::prefix('work-experience')->group(function () {
    Route::get('edit/{ctrlno}', [WorkExperienceController::class, 'edit'])->name('work-experience.edit');
    Route::post('store/{cesno}', [WorkExperienceController::class, 'store'])->name('work-experience.store');
    Route::put('update/{ctrlno}', [WorkExperienceController::class, 'update'])->name('work-experience.update');
    Route::delete('destroy/{ctrlno}', [WorkExperienceController::class, 'destroy'])->name('work-experience.destroy');
    Route::get('recently-deleted/{cesno}', [WorkExperienceController::class, 'recycleBin'])->name('work-experience.recycleBin');
    Route::post('recently-deleted/restore/{ctrlno}', [WorkExperienceController::class, 'restore'])->name('work-experience.restore');
    Route::delete('recently-deleted/force-delete/{ctrlno}', [WorkExperienceController::class, 'forceDelete'])->name('work-experience.forceDelete');
});

Route::prefix('award-citation')->group(function () {
    Route::get('edit/{ctrlno}', [AwardAndCitationController::class, 'edit'])->name('award-citation.edit');
    Route::post('store/{cesno}', [AwardAndCitationController::class, 'store'])->name('award-citation.store');
    Route::put('update/{ctrlno}', [AwardAndCitationController::class, 'update'])->name('award-citation.update');
    Route::delete('delete/{ctrlno}', [AwardAndCitationController::class, 'destroy'])->name('award-citation.destroy');
    Route::get('recently-deleted/{cesno}', [AwardAndCitationController::class, 'recentlyDeleted'])->name('award-citation.recentlyDeleted');
    Route::post('recently-deleted/restore/{ctrlno}', [AwardAndCitationController::class, 'restore'])->name('award-citation.restore');
    Route::delete('recently-deleted/force-delete/{ctrlno}', [AwardAndCitationController::class, 'forceDelete'])->name('award-citation.forceDelete');
});

Route::prefix('affiliation')->group(function () {
    Route::get('edit/{ctrlno}', [AffiliationController::class, 'edits'])->name('affiliation.edit');
    Route::post('save/{cesno}', [AffiliationController::class, 'store'])->name('affiliation.store');
    Route::put('update/{ctrlno}', [AffiliationController::class, 'update'])->name('affiliation.update');
    Route::delete('destroy/{ctrlno}', [AffiliationController::class, 'destroy'])->name('affiliation.destroy');
    Route::get('recently-deleted/{cesno}', [AffiliationController::class, 'recycleBin'])->name('affiliations.recycleBin');
    Route::post('restore/{ctrlno}', [AffiliationController::class, 'restore'])->name('affiliation.restore');
    Route::delete('recently-deleted/force-delete/{ctrlno}', [AffiliationController::class, 'forceDelete'])->name('affiliation.forceDelete');
});

Route::prefix('case-record')->group(function () {
    Route::get('edit/{ctrlno}', [CaseRecordController::class, 'edit'])->name('case-record.edit');
    Route::post('store/{cesno}', [CaseRecordController::class, 'store'])->name('case-record.store');
    Route::put('update/{ctrlno}', [CaseRecordController::class, 'update'])->name('case-record.update');
    Route::delete('destroy/{ctrlno}', [CaseRecordController::class, 'destroy'])->name('case-record.destroy');
    Route::get('recently-deleted/{cesno}', [CaseRecordController::class, 'recentlyDeleted'])->name('case-record.recentlyDeleted');
    Route::post('recently-deleted/restore/{ctrlno}', [CaseRecordController::class, 'restore'])->name('case-record.restore');
    Route::delete('recently-deleted/force-deleted/{ctrlno}', [CaseRecordController::class, 'forceDelete'])->name('case-record.forceDelete');
});

Route::prefix('health-record')->group(function () {
    Route::post('{cesno}', [HealthRecordController::class, 'store'])->name('health-record.store');
    Route::delete('{ctrlno}', [HealthRecordController::class, 'destroy'])->name('health-record.destroy');
});

Route::prefix('expertise')->group(function () {
    Route::get('edit/{cesno}/{speXpCode}', [ExpertiseController::class, 'edit'])->name('expertise.edit');
    Route::post('store/{cesno}', [ExpertiseController::class, 'store'])->name('expertise.store');
    Route::put('update/{cesno}/{speXpCodes}', [ExpertiseController::class, 'update'])->name('expertise.update');
    Route::delete('destroy/{cesno}/{speXpCode}', [ExpertiseController::class, 'destroy'])->name('expertise.destroy');
});

Route::prefix('language')->group(function () {
    Route::get('{cesno}/{languageCode}', [LanguageController::class, 'edit'])->name('language.edit');
    Route::post('{cesno}', [LanguageController::class, 'store'])->name('language.store');
    Route::put('{cesno}/{languageCode}', [LanguageController::class, 'update'])->name('language.update');
    Route::delete('{cesno}/{languageCode}', [LanguageController::class, 'destroy'])->name('language.destroy');
});

Route::prefix('non-accredited-ces-training')->group(function () {
    Route::get('edit/{ctrlno}', [OtherTrainingController::class, 'edit'])->name('other-training.edit');
    Route::post('{cesno}', [OtherTrainingController::class, 'store'])->name('other-training.store');
    Route::put('{ctrlno}', [OtherTrainingController::class, 'update'])->name('other-training.update');
    Route::delete('{ctrlno}', [OtherTrainingController::class, 'destroy'])->name('other-training.destroy');
});

Route::prefix('eligibility-rank-tracker')->group(function () {
    Route::get('edit/{ctrlno}', [EligibilityAndRankTrackerController::class, 'edit'])->name('eligibility-rank-tracker.edit');
    Route::post('store/{cesno}', [EligibilityAndRankTrackerController::class, 'store'])->name('eligibility-rank-tracker.store');
    Route::put('update/{ctrlno}', [EligibilityAndRankTrackerController::class, 'update'])->name('eligibility-rank-tracker.update');
    Route::delete('destroy/{ctrlno}', [EligibilityAndRankTrackerController::class, 'destroy'])->name('eligibility-rank-tracker.destroy'); 
    Route::get('recently-deleted/{cesno}', [EligibilityAndRankTrackerController::class, 'recentlyDeleted'])->name('eligibility-rank-tracker.recentlyDeleted');
    Route::post('recently-deleted/restore/{ctrlno}', [EligibilityAndRankTrackerController::class, 'restore'])->name('eligibility-rank-tracker.restore');
    Route::delete('recently-deleted/force-delete/{ctrlno}', [EligibilityAndRankTrackerController::class, 'forceDelete'])->name('eligibility-rank-tracker.forceDelete'); 
});


// 201 profiling routes
Route::post('/add-profile-201', [AddProfile201::class, 'store'])->name('add-profile-201');
Route::post('/upload-avatar-profile-201/{cesno}', [AddProfile201::class, 'uploadAvatar'])->name('/upload-avatar-profile-201');
Route::post('/add-address-permanent-201/{cesno}', [AddAddress201::class, 'addAddressPermanent'])->name('/add-address-permanent-201');
Route::post('/add-address-mailing-201/{cesno}', [AddAddress201::class, 'addAddressMailing'])->name('/add-address-mailing-201');
Route::post('/add-address-temporary-201/{cesno}', [AddAddress201::class, 'addAddressTemporary'])->name('/add-address-temporary-201');
// end 201 profiling

Route::post('/login', [AuthController::class, 'userLogin'])->name('login');
Route::get('/login', [AuthController::class, 'getLoginHomePage']);
Route::get('/logout', [AuthController::class, 'userLogout']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordHomePage'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordHomePage'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'getPasswordResetPage'])->name('password.reset');


// API route

Route::group([
    'prefix'     => 'api/v1',
], function () {

    Route::group([
        'prefix'     => '201-profile',
    ], function () {
        Route::get('record/{cesno}', [ProfileController::class, 'getCesnoID'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'role-access',
    ], function () {
        Route::get('record', [RolesController::class, 'getRolesAccess'])->middleware('userauth');
        Route::get('validate-user-ces-web-app-general-page-access/{value}', [RolesController::class, 'validateUserCesWebAppGeneralPageAccess'])->middleware('userauth');
        Route::get('validate-user-rep-gen-executive-201-profile-accesss/{value}', [RolesController::class, 'validateUserRepGenExecutive201ProfileAccess'])->middleware('userauth');
        Route::get('validate-user-rep-gen-competency-training-management-sub-module-access/{value}', [RolesController::class, 'validateUserRepGenCompetencyTrainingManagementSubModuleAccess'])->middleware('userauth');
        Route::get('validate-user-rep-gen-eligibility-and-rank-tracking-access/{value}', [RolesController::class, 'validateUserRepGenEligibilityAndRankTrackingAccess'])->middleware('userauth');
        Route::get('validate-user-rep-gen-plantilla-management-reports-access/{value}', [RolesController::class, 'validateUserRepGenPlantillaManagementReportsAccess'])->middleware('userauth');
        Route::get('validate-user-plantilla-manangement-access/{category}/{rights}', [RolesController::class, 'validateUserPlantillaManangementAccess'])->middleware('userauth');
        Route::get('validate-user-executive-201-role-access/{category}/{rights}', [RolesController::class, 'validateUserExecutive201RoleAccess'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'personal-data',
    ], function () {
        Route::post('add', [ProfileController::class, 'addPersonalData'])->middleware('userauth');
        Route::get('record/{cesno}', [ProfileController::class, 'getPersonalData'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editPersonalData'])->middleware('userauth');
        // Route::get('delete/{id}', [ProfileController::class, 'deletePersonalData'])->middleware('userauth');
        Route::get('validate-data/{type}/{value}', [ProfileController::class, 'validateData'])->middleware('userauth');
        Route::get('validate-201-profile/{lastname}/{firstname}/{middlename}/{birthdate}', [ProfileController::class, 'validate201Profile'])->middleware('userauth');
        // Route::get('get-all-record', [ProfileController::class, 'getAllPersonalData'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'spouse-records',
    ], function () {
        Route::post('add', [ProfileController::class, 'addSpouseRecords'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getSpouseRecords'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editSpouseRecords'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteSpouseRecords'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'family-profile',
    ], function () {
        Route::post('add', [ProfileController::class, 'addFamilyProfile'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getFamilyProfile'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editFamilyProfile'])->middleware('userauth');
        // Route::delete('delete/{id}', [ProfileController::class, 'deleteFamilyProfile'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'children-records',
    ], function () {
        Route::post('add', [ProfileController::class, 'addChildrenRecords'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getChildrenRecords'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editChildrenRecords'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteChildrenRecords'])->middleware('userauth');
    });

    // Disabled route
    // Route::group([
    //     'prefix'     => 'father-name',
    // ], function () {
    //     Route::post('add', [ProfileController::class, 'addFatherName'])->middleware('userauth');
    //     Route::get('record', [ProfileController::class, 'getFatherName'])->middleware('userauth');
    // });

    // Route::group([
    //     'prefix'     => 'mother-name',
    // ], function () {
    //     Route::post('add', [ProfileController::class, 'addMotherName'])->middleware('userauth');
    //     Route::get('record', [ProfileController::class, 'getMotherName'])->middleware('userauth');
    // });

    // Route::group([
    //     'prefix'     => 'home-permanent-address',
    // ], function () {
    //     Route::post('add', [ProfileController::class, 'addHomePermanentAddress'])->middleware('userauth');
    //     Route::get('record', [ProfileController::class, 'getHomePermanentAddress'])->middleware('userauth');
    // });

    // Route::group([
    //     'prefix'     => 'mailing-address',
    // ], function () {
    //     Route::post('add', [ProfileController::class, 'addMailingAddress'])->middleware('userauth');
    //     Route::get('record', [ProfileController::class, 'getMailingAddress'])->middleware('userauth');
    // });

    Route::group([
        'prefix'     => 'license-details',
    ], function () {
        Route::post('add', [ProfileController::class, 'addLicenseDetails'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getLicenseDetails'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editLicenseDetails'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteLicenseDetails'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'educational-attainment',
    ], function () {
        Route::post('add', [ProfileController::class, 'addEducationalAttainment'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getEducationalAttainment'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editEducationalAttainment'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteEducationalAttainment'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'examination-taken',
    ], function () {
        Route::post('add', [ProfileController::class, 'addExaminationTaken'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getExaminationTaken'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editExaminationTaken'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteExaminationTaken'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'languages-dialects',
    ], function () {
        Route::post('add', [ProfileController::class, 'addLanguagesDialects'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getLanguagesDialects'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editLanguagesDialects'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteLanguagesDialects'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'ces-we',
    ], function () {
        Route::post('add', [ProfileController::class, 'addCesWe'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getCesWe'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editCesWe'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteCesWe'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'assessment-center',
    ], function () {
        Route::post('add', [ProfileController::class, 'addAssessmentCenter'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getAssessmentCenter'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editAssessmentCenter'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteAssessmentCenter'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'validation-hr',
    ], function () {
        Route::post('add', [ProfileController::class, 'addValidationHr'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getValidationHr'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editValidationHr'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteValidationHr'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'board-interview',
    ], function () {
        Route::post('add', [ProfileController::class, 'addBoardInterview'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getBoardInterview'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editBoardInterview'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteBoardInterview'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'ces-status',
    ], function () {
        Route::post('add', [ProfileController::class, 'addCesStatus'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getCesStatus'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editCesStatus'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteCesStatus'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'record-of-cespes-ratings',
    ], function () {
        Route::post('add', [ProfileController::class, 'addRecordOfCespesRatings'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getRecordOfCespesRatings'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editRecordOfCespesRatings'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteRecordOfCespesRatings'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'work-experience',
    ], function () {
        Route::post('add', [ProfileController::class, 'addWorkExperience'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getWorkExperience'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editWorkExperience'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteWorkExperience'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'field-expertise',
    ], function () {
        Route::post('add', [ProfileController::class, 'addFieldExpertise'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getFieldExpertise'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editFieldExpertise'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteFieldExpertise'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'ces-trainings',
    ], function () {
        Route::post('add', [ProfileController::class, 'addCesTrainings'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getCesTrainings'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editCesTrainings'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteCesTrainings'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'other-management-trainings',
    ], function () {
        Route::post('add', [ProfileController::class, 'addOtherManagementTrainings'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getOtherManagementTrainings'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editOtherManagementTrainings'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteOtherManagementTrainings'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'research-and-studies',
    ], function () {
        Route::post('add', [ProfileController::class, 'addResearchAndStudies'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getResearchAndStudies'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editResearchAndStudies'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteResearchAndStudies'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'scholarships',
    ], function () {
        Route::post('add', [ProfileController::class, 'addScholarships'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getScholarships'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editScholarships'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteScholarships'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'major-civic-and-professional-affiliations',
    ], function () {
        Route::post('add', [ProfileController::class, 'addAffiliations'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getAffiliations'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editAffiliations'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteAffiliations'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'award-and-citations',
    ], function () {
        Route::post('add', [ProfileController::class, 'addAwardAndCitations'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getAwardAndCitations'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editAwardAndCitations'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteAwardAndCitations'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'case-records',
    ], function () {
        Route::post('add', [ProfileController::class, 'addCaseRecords'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getCaseRecords'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editCaseRecords'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteCaseRecords'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'health-records',
    ], function () {
        Route::post('add', [ProfileController::class, 'addHealthRecords'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getHealthRecords'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editHealthRecords'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteHealthRecords'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'historical-record-of-medical-condition',
    ], function () {
        Route::post('add', [ProfileController::class, 'addHistoricalRecordOfMedicalCondition'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getHistoricalRecordOfMedicalCondition'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editHistoricalRecordOfMedicalCondition'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deleteHistoricalRecordOfMedicalCondition'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'pdf-files',
    ], function () {
        Route::post('add', [ProfileController::class, 'addPdfFiles'])->middleware('userauth');
        Route::get('record/{id}', [ProfileController::class, 'getPdfFiles'])->middleware('userauth');
        Route::post('edit', [ProfileController::class, 'editPdfFiles'])->middleware('userauth');
        Route::delete('delete/{id}', [ProfileController::class, 'deletePdfFiles'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'executive-201-access',
    ], function () {
        Route::post('add', [RolesController::class, 'addExecutive201RoleAccess'])->middleware('userauth');
        Route::post('update/{id}', [RolesController::class, 'updateExecutive201RoleAccess'])->middleware('userauth');
        Route::delete('delete/{id}', [RolesController::class, 'deleteExecutive201RoleAccess'])->middleware('userauth');
        Route::get('record/{id}', [RolesController::class, 'getExecutive201RoleAccess'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'user',
    ], function () {
        Route::post('add', [UserController::class, 'addUser'])->middleware('userauth');
        Route::post('update/{id}', [UserController::class, 'updateUser'])->middleware('userauth');
        // Route::delete('delete/{id}', [UserController::class, 'deleteUser'])->middleware('userauth'); // Uncomment if client want to enable delete user
        Route::get('validate-data/{type}/{value}', [UserController::class, 'validateData'])->middleware('userauth');
        Route::get('get-role-name-no/{role_name}', [UserController::class, 'getRoleNameNo'])->middleware('userauth');
        Route::post('change-default-password', [AuthController::class, 'userChangeDefaultPasswordPage']);
    });

    Route::group([
        'prefix'     => 'password',
    ], function () {
        Route::post('reset-password', [ForgotPasswordController::class, 'getPasswordUpdatePage'])->name('password.update');
    });

    Route::group([
        'prefix'     => 'ces-web-app-general-page-access',
    ], function () {
        Route::post('add', [RolesController::class, 'addCesWebAppGeneralPageAccess'])->middleware('userauth');
        Route::post('update/{id}', [RolesController::class, 'updateCesWebAppGeneralPageAccess'])->middleware('userauth');
        Route::delete('delete/{id}', [RolesController::class, 'deleteCesWebAppGeneralPageAccess'])->middleware('userauth');
        Route::get('record/{id}', [RolesController::class, 'getCesWebAppGeneralPageAccess'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'plantilla-manangement-access',
    ], function () {
        Route::post('add', [RolesController::class, 'addPlantillaManangementAccess'])->middleware('userauth');
        Route::post('update/{id}', [RolesController::class, 'updatePlantillaManangementAccess'])->middleware('userauth');
        Route::delete('delete/{id}', [RolesController::class, 'deletePlantillaManangementAccess'])->middleware('userauth');
        Route::get('record/{id}', [RolesController::class, 'getPlantillaManangementAccess'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'report-generation-access',
    ], function () {
        Route::post('add', [RolesController::class, 'addReportGenerationAccess'])->middleware('userauth');
        Route::post('update/{id}', [RolesController::class, 'updateReportGenerationAccess'])->middleware('userauth');
        Route::delete('delete/{id}', [RolesController::class, 'deleteReportGenerationAccess'])->middleware('userauth');
        Route::get('record/{id}', [RolesController::class, 'getReportGenerationAccess'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'migration',
    ], function () {
        Route::get('recheck-updated-category/{updated_category}', [MigrationController::class, 'getDatabaseMigrations'])->middleware('userauth');
        Route::get('personal-data', [MigrationController::class, 'migratePersonalData'])->middleware('userauth');
        Route::get('family-profile-spouse', [MigrationController::class, 'migrateFamilyProfileSpouse'])->middleware('userauth');
        Route::get('family-profile-children', [MigrationController::class, 'migrateFamilyProfileChildren'])->middleware('userauth');
        Route::get('educational-background-or-attainment', [MigrationController::class, 'migrateEducationalBackgroundOrAttainment'])->middleware('userauth');
        Route::get('examinations-taken', [MigrationController::class, 'migrateExaminationsTaken'])->middleware('userauth');
        Route::get('language-dialects', [MigrationController::class, 'migrateLanguageDialects'])->middleware('userauth');
        Route::get('eris-ces-we', [MigrationController::class, 'migrateERISCESWE'])->middleware('userauth');
        Route::get('eris-assessment-center', [MigrationController::class, 'migrateERISAssessmentCenter'])->middleware('userauth');
        Route::get('eris-validation-in-depth-and-rapid', [MigrationController::class, 'migrateERISValidationInDepthAndRapid'])->middleware('userauth');
        Route::get('eris-board-interview', [MigrationController::class, 'migrateERISBoardInterview'])->middleware('userauth');
        Route::get('ces-status', [MigrationController::class, 'migrateCESStatus'])->middleware('userauth');
        Route::get('record-of-cespes-ratings', [MigrationController::class, 'migrateRecordOfCespesRatings'])->middleware('userauth');
        Route::get('work-experience', [MigrationController::class, 'migrateWorkExperience'])->middleware('userauth');
        Route::get('field-expertise', [MigrationController::class, 'migrateFieldExpertise'])->middleware('userauth');
        Route::get('cecms-training-session-and-participant-for-ces-trainings', [MigrationController::class, 'migrateCESTrainings'])->middleware('userauth');
        Route::get('other-non-ces-accredited-trainings', [MigrationController::class, 'migrateOtherNonCESAccreditedTrainings'])->middleware('userauth');
        Route::get('research-and-studies', [MigrationController::class, 'migrateResearchAndStudies'])->middleware('userauth');
        Route::get('scholarships-received', [MigrationController::class, 'migrateScholarshipsReceived'])->middleware('userauth');
        Route::get('major-civic-and-professional-affiliations', [MigrationController::class, 'migrateMajorCivicAndProfessionalAffiliations'])->middleware('userauth');
        Route::get('awards-and-citations-received', [MigrationController::class, 'migrateAwardsAndCitationsReceived'])->middleware('userauth');
        Route::get('case-records', [MigrationController::class, 'migrateCaseRecords'])->middleware('userauth');
        Route::get('health-record', [MigrationController::class, 'migrateHealthRecord'])->middleware('userauth');
        Route::get('attached-pdf-files', [MigrationController::class, 'migrateAttachedPDFFiles'])->middleware('userauth');
        Route::get('201-library-address-city-municipality', [MigrationController::class, 'migrate201LibraryAddressCityMunicipality'])->middleware('userauth');
        Route::get('201-library-education-degree', [MigrationController::class, 'migrate201LibraryEducationDegree'])->middleware('userauth');
        Route::get('201-library-education-course-major', [MigrationController::class, 'migrate201LibraryEducationCourseMajor'])->middleware('userauth');
        Route::get('201-library-education-school', [MigrationController::class, 'migrate201LibraryEducationSchool'])->middleware('userauth');
    });


});


// Page content route

Route::group([
    'prefix'     => 'admin',
], function () {
    Route::get('/', [DashboardController::class, 'getDashboardPage'])->middleware('userauth');

    Route::group([
        'prefix'     => 'dashboard',
    ], function () {
        Route::get('/', [DashboardController::class, 'getDashboardPage'])->middleware('userauth');
    });

    Route::group(['prefix'=> 'profile',], function () {

        Route::get('add', [ProfileController::class, 'addProfile'])->middleware('userauth');
        // Route::store('store', [ProfileController::class, 'store'])->middleware('userauth');
        // Route::post('addProfile201', [AddProfile201::class, 'store'])->middleware('userauth');
        // Route::get('add', [ProfileController::class, 'add201ProfilePage'])->middleware('userauth');
        Route::get('view', [ProfileController::class, 'postSearch'])->middleware('userauth');
        Route::post('view', [ProfileController::class, 'postSearch'])->middleware('userauth');

        // Route::get('views/{cesno}', [ProfileController::class, 'view201ProfilePage'])->middleware('userauth');
        Route::get('view/{cesno}', [ProfileController::class, 'viewProfile'])->name('viewProfile')->middleware('userauth');

    });

    Route::group([
        'prefix'     => 'report',
    ], function () {
        Route::get('general-reports', [ReportController::class, 'getGeneralReportsPage'])->middleware('userauth');
        Route::get('birthday-cards-reports', [ReportController::class, 'getBirthdayCardsReportsPage'])->middleware('userauth');
        Route::get('statistical-reports', [ReportController::class, 'getStatisticalReportsPage'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'personal-data',
    ], function () {
        Route::get('add', [ProfileController::class, 'addPersonalDataPage'])->middleware('userauth');
        Route::get('edit', [ProfileController::class, 'editPersonalData'])->middleware('userauth');
        Route::get('view', [ProfileController::class, 'addPersonalDataPage'])->middleware('userauth');
    });

    // Route::group([
    // 'prefix' => '201-library',
    // ], function () {
    // Route::get('/', [LibraryController::class, 'index'])->middleware('userauth');
    // Route::post('/city-municipality/add', [LibraryController::class, 'addCityMunicipality'])->middleware('userauth');
    // Route::get('/city-municipality/record', [LibraryController::class, 'getCityMunicipality'])->middleware('userauth');
    // Route::post('/degree/add', [LibraryController::class, 'addDegree'])->middleware('userauth');
    // Route::get('/degree/record', [LibraryController::class, 'getDegree'])->middleware('userauth');
    // Route::post('/course-major/add', [LibraryController::class, 'addCourseMajor'])->middleware('userauth');
    // Route::get('/course-major/record', [LibraryController::class, 'getCourseMajor'])->middleware('userauth');
    // Route::post('/school/add', [LibraryController::class, 'addSchool'])->middleware('userauth');
    // Route::get('/school/record', [LibraryController::class, 'getSchool'])->middleware('userauth');
    // Route::post('/examination-reference/add', [LibraryController::class, 'addExaminationReference'])->middleware('userauth');
    // Route::get('/examination-reference/record', [LibraryController::class, 'getExaminationReference'])->middleware('userauth');
    // Route::post('/language-dialects/add', [LibraryController::class, 'addLanguageDialects'])->middleware('userauth');
    // Route::get('/language-dialects/record', [LibraryController::class, 'getLanguageDialects'])->middleware('userauth');
    // Route::post('/ces-status-reference/add', [LibraryController::class, 'addCesStatusReference'])->middleware('userauth');
    // Route::get('/ces-status-reference/record', [LibraryController::class, 'getCesStatusReference'])->middleware('userauth');
    // Route::post('/acquired-thru/add', [LibraryController::class, 'addAcquiredThru'])->middleware('userauth');
    // Route::get('/acquired-thru/record', [LibraryController::class, 'getAcquiredThru'])->middleware('userauth');
    // Route::post('/ces-status-type/add', [LibraryController::class, 'addStatusType'])->middleware('userauth');
    // Route::get('/ces-status-type/record', [LibraryController::class, 'getStatusType'])->middleware('userauth');
    // Route::post('/appointing-authority/add', [LibraryController::class, 'addAppointingAuthority'])->middleware('userauth');
    // Route::get('/appointing-authority/record', [LibraryController::class, 'getAppointingAuthority'])->middleware('userauth');
    // Route::post('/expertise-category/add', [LibraryController::class, 'addExpertiseCategory'])->middleware('userauth');
    // Route::get('/expertise-category/record', [LibraryController::class, 'getExpertiseCategory'])->middleware('userauth');
    // Route::post('/special-skill/add', [LibraryController::class, 'addSpecialSkill'])->middleware('userauth');
    // Route::get('/special-skill/record', [LibraryController::class, 'getSpecialSkill'])->middleware('userauth');
    // Route::post('/case-nature/add', [LibraryController::class, 'addCaseNature'])->middleware('userauth');
    // Route::get('/case-nature/record', [LibraryController::class, 'getCaseNature'])->middleware('userauth');
    // Route::post('/case-status/add', [LibraryController::class, 'addCaseStatus'])->middleware('userauth');
    // Route::get('/case-status/record', [LibraryController::class, 'getCaseStatus'])->middleware('userauth');
    // Route::post('/location-city/add', [LibraryController::class, 'addLocationCity'])->middleware('userauth');
    // Route::get('/location-city/record', [LibraryController::class, 'getLocationCity'])->middleware('userauth');
    // Route::post('/location-province/add', [LibraryController::class, 'addLocationProvince'])->middleware('userauth');
    // Route::get('/location-province/record', [LibraryController::class, 'getLocationProvince'])->middleware('userauth');
    // Route::post('/location-region/add', [LibraryController::class, 'addLocationRegion'])->middleware('userauth');
    // Route::get('/location-region/record', [LibraryController::class, 'getLocationRegion'])->middleware('userauth');
    // });


    Route::group([
        'prefix'     => 'rights-management',
    ], function () {
        Route::get('/roles', [RolesController::class, 'addRolesPage'])->middleware('userauth');
        Route::get('/user', [UserController::class, 'addUsersPage'])->middleware('userauth');
        Route::get('/edit-user/{id}', [UserController::class, 'editUsersPage'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'online-ces-plantilla-management-system',
    ], function () {
        Route::post('department-Agency/add', [DepartmentAgencyController::class, 'addPlantillaTblDeptAgency'])->middleware('userauth');
        Route::get('department-Agency/record', [DepartmentAgencyController::class, 'getPlantillaTblDeptAgency'])->middleware('userauth');
        Route::post('sector-manager/add', [SectorManager::class, 'addSectorManager'])->middleware('userauth');
        Route::get('sector-manager/record', [SectorManager::class, 'getSectorManager'])->middleware('userauth');
        Route::post('agency-location/add', [SectorManager::class, 'addPlantillaTblAgencyLocation'])->middleware('userauth');
        Route::get('agency-location/record', [SectorManager::class, 'getPlantillaTblAgencyLocation'])->middleware('userauth');
        Route::post('office-manager/add', [SectorManager::class, 'addPlantillaTblOffice'])->middleware('userauth');
        Route::get('office-manager/record', [SectorManager::class, 'getPlantillaTblOffice'])->middleware('userauth');
        Route::get('/view', [PlantillaController::class, 'viewPlantillaManagement'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'competency-management-system',
    ], function () {
        Route::get('/view', [CompetencyController::class, 'viewCompetency'])->middleware('userauth');
        Route::post('/view', [CompetencyController::class, 'viewCompetency'])->middleware('userauth');
        Route::get('views/{cesno}', [CompetencyController::class, 'viewCompetency'])->middleware('userauth');
    });

    Route::group([
        'prefix'     => 'system-utility',
    ], function () {
        Route::get('database-migration', [MigrationController::class, 'getMigrationSystemPage'])->middleware('userauth');
    });
});
