<?php

use App\Http\Controllers\AddProfile201;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AwardAndCitationController;
use App\Http\Controllers\CaseRecordController;
use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\Competency\CompetencyController;
use App\Http\Controllers\Competency\ContactInformationController;
use App\Http\Controllers\Competency\OtherTrainingManagementController;
use App\Http\Controllers\Competency\TrainingProviderManagerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ContactInfoController;
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
use App\Http\Controllers\PersonalDataController;
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
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\ViewProfile201Controller;
use App\Http\Controllers\WorkExperienceController;
use App\Mail\TempCred201;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// email preview
Route::get('/preview-email', function () {

    $imagePath = public_path('images/branding.png');
    $data = [
        'email' => 'recipient@example.com',
        'password' => 'temporary_password',
        'imagePath' => $imagePath,
    ];

    return new TempCred201($data);
});
// end

Route::get('/', function () {

    if (!Auth::check()) {
        return view('login');
    } else {
        return Redirect::route('dashboard');
    }
});

Route::prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'getAllData'])->name('dashboard');

    Route::middleware('userauth')->group(function () {

        // Profile routes (201)
        Route::prefix('201-profile')->group(function () {

            Route::get('create', [ProfileController::class, 'addProfile'])->name('profile.add');
            Route::post('create/{cesno}', [AddProfile201::class, 'store'])->name('add-profile-201');
            Route::get('list', [ViewProfile201Controller::class, 'index'])->name('view-profile-201.index');

            Route::prefix('personal-data')->group(function () {
                Route::get('show/{cesno}', [PersonalDataController::class, 'show'])->name('personal-data.show');
                Route::post('upload-avatar-profile-201/{cesno}', [AddProfile201::class, 'uploadAvatar'])->name('/upload-avatar-profile-201');
            });


            Route::prefix('family-profile')->group(function () {
                Route::get('show/{cesno}', [FamilyController::class, 'show'])->name('family-profile.show');
                Route::get('recently-deleted/{cesno}', [FamilyController::class, 'familyProfileRecentlyDeleted'])->name('family-profile.recently-deleted');

                Route::prefix('spouse')->group(function () {
                    Route::get('edit/{ctrlno}/{cesno}', [FamilyController::class, 'editSpouse'])->name('family-profile.editSpouse');
                    Route::post('store/{cesno}', [FamilyController::class, 'storeSpouse'])->name('family-profile.store');
                    Route::put('update/{ctrlno}', [FamilyController::class, 'updateSpouseRecord'])->name('family-profile.updateSpouseRecord');
                    Route::delete('destroy/{ctrlno}', [FamilyController::class, 'destroySpouse'])->name('family-profile-spouse.delete');
                    Route::post('recently-deleted/restore/{ctrlno}', [FamilyController::class, 'spouseRestore'])->name('family-profile-spouse.restore');
                    Route::delete('recently-deleted/force-delete/{ctrlno}', [FamilyController::class, 'spouseForceDelete'])->name('family-profile-spouse.forceDelete');
                });

                Route::prefix('children')->group(function () {
                    Route::get('edit/{ctrlno}/{cesno}', [FamilyController::class, 'editChildren'])->name('family-profile.editChildren');
                    Route::post('{cesno}', [FamilyController::class, 'storeChildren'])->name('family-profile-children.store');
                    Route::put('{ctrlno}', [FamilyController::class, 'updateChildrenRecord'])->name('family-profile.updateChildren');
                    Route::delete('{ctrlno}', [FamilyController::class, 'destroyChildren'])->name('family-profile-children.delete');
                    Route::post('recently-deleted/restore/{ctrlno}', [FamilyController::class, 'childrenRestore'])->name('family-profile-children.restore');
                    Route::delete('recently-deleted/force-delete/{ctrlno}', [FamilyController::class, 'childrenForceDelete'])->name('family-profile-children.forceDelete');
                });

                Route::prefix('father')->group(function () {
                    Route::get('edit/{ctrlno}/{cesno}', [FamilyController::class, 'editFather'])->name('family-profile-father.editFather');
                    Route::post('store/{cesno}', [FamilyController::class, 'storeFather'])->name('family-profile-father.store');
                    Route::put('{ctrlno}', [FamilyController::class, 'updateFatherRecord'])->name('family-profile-father.updateFatherRecord');
                    Route::delete('delete/{ctrlno}', [FamilyController::class, 'destroyFather'])->name('family-profile-father.destroy');
                    Route::post('recently-deleted/father-restore/{ctrlno}', [FamilyController::class, 'fatherRestore'])->name('family-profile-father.fatherRestore');
                    Route::delete('recently-deleted/force-delete/{ctrlno}', [FamilyController::class, 'fatherForceDelete'])->name('family-profile-father.fatherForceDelete');
                });

                Route::prefix('mother')->group(function () {
                    Route::get('edit/{ctrlno}/{cesno}', [FamilyController::class, 'editMother'])->name('family-profile-mother.editMother');
                    Route::post('{cesno}', [FamilyController::class, 'storeMother'])->name('family-profile-mother.store');
                    Route::put('{ctrlno}', [FamilyController::class, 'updateMotherRecord'])->name('family-profile-mother.updateMotherRecord');
                    Route::delete('{ctrlno}', [FamilyController::class, 'destroyMother'])->name('family-profile-mother.destroy');
                });
            });

            Route::prefix('address')->group(function () {
                Route::get('show/{cesno}', [AddressController::class, 'show'])->name('personal-data-address.show');
                Route::post('/add-address-permanent-201/{cesno}', [AddressController::class, 'addAddressPermanent'])->name('add-address-permanent-201');
                Route::post('/add-address-mailing-201/{cesno}', [AddressController::class, 'addAddressMailing'])->name('add-address-mailing-201');
                Route::post('/add-address-temporary-201/{cesno}', [AddressController::class, 'addAddressTemporary'])->name('add-address-temporary-201');
                Route::delete('destroy/{ctrlno}', [AddressController::class, 'destroy'])->name('personal-data-address.delete');

                // Route::post('store/{cesno}', [AddressController::class, 'store'])->name('personal-data-address.store');
                // Route::post('update/{ctrlno}/{cesno}', [AddressController::class, 'update'])->name('personal-data-address.update');
                // Route::get('edit/{ctrlno}', [AddressController::class, 'edit'])->name('personal-data-address.edit');
                // Route::delete('destroy/{ctrlno}', [AddressController::class, 'destroy'])->name('personal-data-address.destroy');
            });

            Route::prefix('identification/card')->group(function () {
                Route::get('show/{cesno}', [IdentificationController::class, 'show'])->name('personal-data-identification.show');
                Route::post('store/{cesno}', [IdentificationController::class, 'store'])->name('personal-data-identification.store');
                Route::post('update/{ctrlno}/{cesno}', [IdentificationController::class, 'update'])->name('personal-data-identification.update');
                Route::get('edit/{ctrlno}', [IdentificationController::class, 'edit'])->name('personal-data-identification.edit');
                Route::delete('destroy/{ctrlno}', [IdentificationController::class, 'destroyIdentification'])->name('personal-data-identification.destroy');
            });

            Route::prefix('contact-information')->group(function () {
                Route::get('show/{cesno}', [ContactInfoController::class, 'show'])->name('contact-info.show');
                Route::post('store/{cesno}', [ContactInfoController::class, 'store'])->name('contact-info.store');
                Route::post('update/{ctrlno}/{cesno}', [ContactInfoController::class, 'update'])->name('contact-info.update');
            });

            Route::prefix('educational-attainment')->group(function () {
                Route::get('show/{cesno}', [EducationalAttainmentController::class, 'showForm'])->name('educational-attainment.form');
                Route::get('index/{cesno}', [EducationalAttainmentController::class, 'index'])->name('educational-attainment.index');
                Route::get('edit/{ctrlno}/{cesno}', [EducationalAttainmentController::class, 'edit'])->name('educational-attainment.edit');
                Route::post('store/{cesno}', [EducationalAttainmentController::class, 'storeEducationAttainment'])->name('educational-attainment.store');
                Route::put('updated/{ctrlno}', [EducationalAttainmentController::class, 'update'])->name('educational-attainment.update');
                Route::delete('destroy/{ctrlno}', [EducationalAttainmentController::class, 'destroyEducationalAttainment'])->name('educational-attainment.destroy');
                Route::get('recently-deleted/{cesno}', [EducationalAttainmentController::class, 'recycleBin'])->name('educational-attainment.recycleBin');
                Route::post('recently-deleted/restore/{ctrlno}', [EducationalAttainmentController::class, 'restore'])->name('educational-attainment.restore');
                Route::delete('recently-deleted/force-delete/{ctrlno}', [EducationalAttainmentController::class, 'forceDelete'])->name('educational-attainment.forceDelete');
            });

            Route::prefix('examination-taken')->group(function () {
                Route::get('create/{cesno}', [ExaminationTakenController::class, 'create'])->name('examination-taken.create');
                Route::get('index/{cesno}', [ExaminationTakenController::class, 'index'])->name('examination-taken.index');
                Route::get('edit/{ctrlno}/{cesno}', [ExaminationTakenController::class, 'edit'])->name('examination-taken.edit');
                Route::post('store/{cesno}', [ExaminationTakenController::class, 'store'])->name('examination-taken.store');
                Route::put('update/{ctrlno}/{cesno}', [ExaminationTakenController::class, 'update'])->name('examination-taken.update');
                Route::delete('taken/delete/{ctrlno}', [ExaminationTakenController::class, 'destroy'])->name('examination-taken.destroy');
                Route::get('recently-deleted/{cesno}', [ExaminationTakenController::class, 'recentlyDeleted'])->name('examination-taken.recentlyDeleted');
                Route::post('recently-deleted/restore/{ctrlno}', [ExaminationTakenController::class, 'restore'])->name('examination-taken.restore');
                Route::delete('recently-deleted/force-deleted/{ctrlno}', [ExaminationTakenController::class, 'forceDelete'])->name('examination-taken.forceDelete');
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
                Route::get('edit/{cesno}/{speXpCode}/{ctrlno}', [ExpertiseController::class, 'edit'])->name('expertise.edit');
                Route::post('store/{cesno}', [ExpertiseController::class, 'store'])->name('expertise.store');
                Route::put('update/{cesno}/{speXpCodes}/{ctrlno}', [ExpertiseController::class, 'update'])->name('expertise.update');
                Route::delete('destroy/{cesno}/{ctrlno}/{speXpCode}', [ExpertiseController::class, 'destroy'])->name('expertise.destroy');
            });

            Route::prefix('language')->group(function () {
                Route::get('index/{cesno}', [LanguageController::class, 'index'])->name('language.index');
                Route::get('edit/{cesno}/{languageCode}/{ctrlno}', [LanguageController::class, 'edit'])->name('language.edit');
                Route::post('store/{cesno}', [LanguageController::class, 'store'])->name('language.store');
                Route::put('update/{cesno}/{languageCode}/{ctrlno}', [LanguageController::class, 'update'])->name('language.update');
                Route::delete('destroy/{cesno}/{languageCode}', [LanguageController::class, 'destroy'])->name('language.destroy');
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
                Route::post('decline-file/{ctrlno}', [PDFController::class, 'declineFile'])->name('declineFile');
                Route::delete('declined-file-force-delete/{ctrlno}', [PDFController::class, 'declineFileForceDelete'])->name('show-pdf-files.declineFileForceDelete');
                Route::get('recently-decline-file', [PDFController::class, 'recentlyDeclineFile'])->name('show-pdf-files.recentlyDeclineFiles');
                Route::get('index/{cesno}', [PDFController::class, 'index'])->name('show-pdf-files.index');
                Route::get('create/{cesno}', [PDFController::class, 'create'])->name('show-pdf-files.create');
                Route::post('store/{cesno}', [PDFController::class, 'store'])->name('show-pdf-files.store');
                Route::post('download-approved-file/{ctrlno}/{fileName}', [PDFController::class, 'download'])->name('downloadApprovedFile');
                Route::delete('destroy/{ctrlno}', [PDFController::class, 'destroy'])->name('show-pdf-files.destroy');
                Route::get('recently-deleted/{cesno}', [PDFController::class, 'recentlyDeleted'])->name('show-pdf-files.recentlyDeleted');
                Route::post('recently-deleted/restore/{ctrlno}', [PDFController::class, 'restore'])->name('show-pdf-files.restore');
                Route::delete('recently-deleted/force-delete/{ctrlno}', [PDFController::class, 'forceDelete'])->name('show-pdf-files.forceDelete');
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
        // End of plantilla routes

        // Competency routes
        Route::prefix('competency')->group(function () {
            Route::get('competency-data', [CompetencyController::class, 'index'])->name('competency-data.index');
            Route::get('index', [CompetencyController::class, 'index'])->name('competency-data.index');
            Route::get('view-profile/{cesno}', [ContactInformationController::class, 'updateOrCreate'])->name('competency-view-profile.updateOrCreate');
            Route::post('store/{cesno}', [ContactInformationController::class, 'store'])->name('competency-view-profile-contact-info.store');
            Route::post('update/{ctrlno}/{cesno}', [ContactInformationController::class, 'update'])->name('competency-view-profile-contact-info.update');
            Route::get('index/{cesno}', [OtherTrainingManagementController::class, 'index'])->name('competency-data-other-training-management.index');
            Route::put('update/{cesno}', [ContactInformationController::class, 'updateEmail'])->name('competency-contact-email.update');

            Route::prefix('non-ces-training-accredited')->group(function () {
                Route::get('create/{cesno}', [OtherTrainingManagementController::class, 'create'])->name('non-ces-training-management.create');
            });

            Route::prefix('training-provider-manager')->group(function () {
                Route::get('index/{cesno}', [TrainingProviderManagerController::class, 'index'])->name('training-provider-manager.index');
                Route::get('create/{cesno}', [TrainingProviderManagerController::class, 'create'])->name('training-provider-manager.create');
                Route::post('store/{cesno}', [TrainingProviderManagerController::class, 'store'])->name('training-provider-manager.store');
                Route::get('edit/{ctrlno}/{cesno}', [TrainingProviderManagerController::class, 'edit'])->name('training-provider-manager.edit');
                Route::put('update/{ctrlno}/{cesno}', [TrainingProviderManagerController::class, 'update'])->name('training-provider-manager.update');
                Route::delete('destroy/{ctrlno}', [TrainingProviderManagerController::class, 'destroy'])->name('training-provider-manager.destroy');
            });
        });
        // End of competency routes

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

});


// auth routes
Route::post('/login', [AuthController::class, 'userLogin'])->name('login');
Route::get('/login', [AuthController::class, 'getLoginHomePage']);
Route::get('/logout', [AuthController::class, 'userLogout']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordHomePage'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordHomePage'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'getPasswordResetPage'])->name('password.reset');
