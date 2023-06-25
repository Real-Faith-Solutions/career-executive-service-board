// Set rootURL for resource link
var rootURL = location.origin+'/';

// Set rootURL for resource link when server hosted on a folder
function changeRootURL(url){
    rootURL = url;
}

// Start of starting of initializing migration

function migrateDatabase(option){

    if(option == 'rerun'){

        Swal.fire({
            icon: 'info',
            title: 'All destination tables will be reset',
            showDenyButton: true,
            confirmButtonText: 'Proceed',
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
    
                // Start rerun migration
                migratePersonalData();
            }
            else if (result.isDenied) {
    
                Swal.fire('Re-run migration has been cancelled', '', 'info')
            }
        });
    }
    else if(option == 'recheck'){

        Swal.fire({
            icon: 'info',
            title: 'Destination table of unmigrated database will be reset',
            showDenyButton: true,
            confirmButtonText: 'Proceed',
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
    
                Swal.fire({
                    title: 'Re-checking',
                    text: 'Re-checking for another database to migrate',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
            
                Swal.showLoading();
        
                // Start recheck migration
                recheckMigration('Personal Data');
            }
            else if (result.isDenied) {
    
                Swal.fire('Re-check migration has been cancelled', '', 'info')
            }
        });
    }
    else{

        Swal.fire({
            icon: 'info',
            title: 'Destination table of unmigrated database will be reset',
            showDenyButton: true,
            confirmButtonText: 'Proceed',
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
    
                // Start migration
                migratePersonalData();
            }
            else if (result.isDenied) {
    
                Swal.fire('Migration has been cancelled', '', 'info')
            }
        });
    }

}

// End of starting of initializing migration


// Start of recheck migration in order manner

function recheckMigration(updated_category){

    $.ajax({
        url: rootURL + 'api/v1/migration/recheck-updated-category/' + updated_category,
        success: function (response) {

            if(response == 'true'){

                if(updated_category == 'Personal Data'){

                    recheckPersonalData();
                }
                else if(updated_category == 'Family Profile Spouse'){

                    recheckFamilyProfileSpouse();
                }
                else if(updated_category == 'Family Profile Children'){

                    recheckFamilyProfileChildren();
                }
                else if(updated_category == 'Educational Background or Attainment'){

                    recheckEducationalBackgroundOrAttainment();
                }
                else if(updated_category == 'Examinations Taken'){

                    recheckExaminationsTaken();
                }
                else if(updated_category == 'Language Dialects'){

                    recheckLanguageDialects();
                }
                else if(updated_category == 'ERIS CES WE'){

                    recheckERISCESWE();
                }
                else if(updated_category == 'ERIS Assessment Center'){

                    recheckERISAssessmentCenter();
                }
                else if(updated_category == 'ERIS Validation In-depth and Rapid'){

                    recheckERISValidationInDepthAndRapid();
                }
                else if(updated_category == 'ERIS Board Interview'){

                    recheckERISBoardInterview();
                }
                else if(updated_category == 'CES Status'){

                    recheckCESStatus();
                }
                else if(updated_category == 'Record of Cespes Ratings'){

                    recheckRecordOfCespesRatings();
                }
                else if(updated_category == 'Work Experience'){

                    recheckWorkExperience();
                }
            }
            else if(response == 'false'){

                if(updated_category == 'Personal Data'){

                    migratePersonalData();
                }
                else if(updated_category == 'Family Profile Spouse'){

                    migrateFamilyProfileSpouse();
                }
                else if(updated_category == 'Family Profile Children'){

                    migrateFamilyProfileChildren();
                }
                else if(updated_category == 'Educational Background or Attainment'){

                    migrateEducationalBackgroundOrAttainment();
                }
                else if(updated_category == 'Examinations Taken'){

                    migrateExaminationsTaken();
                }
                else if(updated_category == 'Language Dialects'){

                    migrateLanguageDialects();
                }
                else if(updated_category == 'ERIS CES WE'){

                    migrateERISCESWE();
                }
                else if(updated_category == 'ERIS Assessment Center'){

                    migrateERISAssessmentCenter();
                }
                else if(updated_category == 'ERIS Validation In-depth and Rapid'){

                    migrateERISValidationInDepthAndRapid();
                }
                else if(updated_category == 'ERIS Board Interview'){

                    migrateERISBoardInterview();
                }
                else if(updated_category == 'CES Status'){

                    migrateCESStatus();
                }
                else if(updated_category == 'Record of Cespes Ratings'){

                    migrateRecordOfCespesRatings();
                }
                else if(updated_category == 'Work Experience'){

                    migrateWorkExperience();
                }

            }
        }
    });
 
}

// Start of recheck migration in order manner


// Start of migration script in order manner

// Start of migrating Personal Data

function migratePersonalData(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "vw_profile_main" and "profile_tblAddress" table to "personal_data" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/personal-data',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateFamilyProfileSpouse();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating Personal Data

// Start of migrating Family Profile Spouse

function migrateFamilyProfileSpouse(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "vw_profile_main" table to "spouse_records" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/family-profile-spouse',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateFamilyProfileChildren();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating Family Profile Spouse

// Start of migrating Family Profile Children

function migrateFamilyProfileChildren(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "profile_tblChildren" table to "children_records" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/family-profile-children',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateEducationalBackgroundOrAttainment();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating Family Profile Children

// Start of migrating Educational Background or Attainment

function migrateEducationalBackgroundOrAttainment(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "profile_tblEducation" table to "educational_attainments" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/educational-background-or-attainment',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateExaminationsTaken();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating Educational Background or Attainment

// Start of migrating Examinations Taken

function migrateExaminationsTaken(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "profile_tblExaminations" table to "examinations_takens" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/examinations-taken',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateLanguageDialects();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating Examinations Taken

// Start of migrating Language Dialects

function migrateLanguageDialects(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "profile_tblLanguages" table to "languages_dialects" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/language-dialects',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateERISCESWE();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating Language Dialects

// Start of migrating ERIS CES WE

function migrateERISCESWE(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "erad_tblWExam" table to "ces_wes" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/eris-ces-we',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateERISAssessmentCenter();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating ERIS CES WE

// Start of migrating ERIS Assessment Center

function migrateERISAssessmentCenter(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "erad_tblAC" table to "assessment_centers" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/eris-assessment-center',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateERISValidationInDepthAndRapid();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating ERIS Assessment Center

// Start of migrating ERIS Validation In-depth and Rapid

function migrateERISValidationInDepthAndRapid(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "erad_tblRVP" and "erad_tblIVP" table to "validation_hrs" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/eris-validation-in-depth-and-rapid',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateERISBoardInterview();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating ERIS Validation In-depth and Rapid

// Start of migrating ERIS Board Interview

function migrateERISBoardInterview(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "erad_tblBOARD" and "erad_tblPBOARD" table to "board_interviews" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/eris-board-interview',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateCESStatus();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating ERIS Board Interview

// Start of migrating CES Status

function migrateCESStatus(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "profile_tblCESstatus" table to "ces_statuses" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/ces-status',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateRecordOfCespesRatings();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating CES Status

// Start of migrating Record of Cespes Ratings

function migrateRecordOfCespesRatings(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "cespes_tblRatingPeriod" table to "record_of_cespes_ratings" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/record-of-cespes-ratings',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.close();
                migrateWorkExperience();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating Record of Cespes Ratings

// Start of migrating Work Experience

function migrateWorkExperience(){

    Swal.fire({
        title: 'Please wait',
        text: 'Migrating "profile_tblWorkExperience" table to "work_experiences" table',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    Swal.showLoading();

    $.ajax({
        url: rootURL + 'api/v1/migration/work-experience',
        success: function (response) {

            if(response == 'Successfully Migrated'){

                Swal.fire({
                    title: 'Reloading',
                    text: 'Migration completed the page will be reload',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                Swal.showLoading();

                location.reload();

            }
            else if(response == 'Restricted'){

                Swal.fire({
                    icon: 'error',
                    title: 'Stop',
                    text: 'Sorry you are restricted to do this action please contact the administrator.',
                });

            }
            else{

                Swal.close();
                location.reload();
            }
        }
    });
}

// End of migrating Work Experience

// End of migration script in order manner


// Start of rechecking updated category database function in order manner

function recheckPersonalData(){

    recheckMigration('Family Profile Spouse');
}

function recheckFamilyProfileSpouse(){

    recheckMigration('Family Profile Children');
}

function recheckFamilyProfileChildren(){

    recheckMigration('Educational Background or Attainment');
}

function recheckEducationalBackgroundOrAttainment(){

    recheckMigration('Examinations Taken');
}

function recheckExaminationsTaken(){

    recheckMigration('Language Dialects');
}

function recheckLanguageDialects(){

    recheckMigration('ERIS CES WE');
}

function recheckERISCESWE(){

    recheckMigration('ERIS Assessment Center');
}

function recheckERISAssessmentCenter(){

    recheckMigration('ERIS Validation In-depth and Rapid');
}

function recheckERISValidationInDepthAndRapid(){

    recheckMigration('ERIS Board Interview');
}

function recheckERISBoardInterview(){

    recheckMigration('CES Status');
}

function recheckCESStatus(){

    recheckMigration('Record of Cespes Ratings');
}

function recheckRecordOfCespesRatings(){

    recheckMigration('Work Experience');
}

function recheckWorkExperience(){

    Swal.fire('Database are all migrated', '', 'success');
}

// End of rechecking updated category database function in order manner

