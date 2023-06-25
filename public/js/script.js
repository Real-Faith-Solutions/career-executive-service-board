// Set rootURL for resource link
var rootURL = location.origin+'/';

// Set rootURL for resource link when server hosted on a folder
function changeRootURL(url){
    rootURL = url;
}

// Populate CESno to hidden input field

if($('#cesno').val()){

    var cesno = $('#cesno').val();

    $('#cesno_spouse_records').val(cesno);
    $('#cesno_family_profile').val(cesno);
    $('#cesno_children_record').val(cesno);
    $('#cesno_educational_attainment').val(cesno);
    $('#cesno_examinations_taken_historical_records').val(cesno);
    $('#cesno_examinations_taken_license_details').val(cesno);
    $('#cesno_languages_dialects').val(cesno);
    $('#cesno_ceswe_hr').val(cesno);
    $('#cesno_assessment_center_hr').val(cesno);
    $('#cesno_validation_hr').val(cesno);
    $('#cesno_board_interview_hr').val(cesno);
    $('#cesno_ces_status_hr').val(cesno);
    $('#cesno_record_of_cespes_rating_hr').val(cesno);
    $('#cesno_work_experience').val(cesno);
    $('#cesno_field_expertise').val(cesno);
    $('#cesno_ces_trainings').val(cesno);
    $('#cesno_other_management_trainings').val(cesno);
    $('#cesno_research_and_studies').val(cesno);
    $('#cesno_scholarships').val(cesno);
    $('#cesno_major_civic_and_professional_affiliations').val(cesno);
    $('#cesno_award_and_citations').val(cesno);
    $('#cesno_case_records').val(cesno);
    $('#cesno_health_records_magna_carta_for_disabled_persons').val(cesno);
    $('#cesno_health_records_historical_record_of_medical_condition').val(cesno);
    $('#cesno_pdf_files').val(cesno);

}

// Set page view title
function setPageTitle(pageTitle, pageSubTitle = "CES function page...") {
    $('#page-title-h').text(pageTitle);
    $('#page-sub-title-h').text(pageSubTitle);
}

$(document).ready(function(){
    
    // Put checked on If (Magna Carta for Disabled Persons RA 7277) if there was selected item
    if($('#dhdTxtB option:selected').val() != ''){
        $('#dhdCheckB').attr('checked', 'checked');
    }

    // Put checked on is PWD? if there was selected item
    if($('#pwd_TxtB option:selected').val() != ''){
        $('#pwd_CheckB').attr('checked', 'checked');
    }

    // Set or remove "Disabled" attribute in "is PWD?" dropdown list
    $('#pwd_CheckB').click(function(){
                
        if($('#pwd_CheckB').is(':checked')){

            $('#pwd_TxtB').removeAttr('disabled');
        }
        else{

            $('#pwd_TxtB').attr('disabled','disabled');
        }

    });

    // Disable and Enable "If Holder Dual Citizenship By Birth, By Naturalization" if Citizenship is selected as Dual Citizenship
    $('.citizenShip').change(function(e) {
        var selected_type = $(this).val();

        if (selected_type == 'Dual Citizenship') {

            $('#inputcitizenShip').removeAttr('disabled');
        }
        else if (selected_type) {
            $('#inputcitizenShip').attr('disabled', 'disabled');
        }
    });

});

// Eventlistener and run update function for Middle Name input
$(".Mn").keyup(function(){
    update();
});

// Function to get the middle initial of provided middle name
function update() {
    $(".Mi").val($('.Mn').val()[0]);
}

// Function to allow letters only as accepted input character for middle name
$('.noNotallow').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z- ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});

// Function to allow letters only as accepted input character for middle name
$('#username').keypress(function (e) {
    var regex = new RegExp("^[a-z0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});

// Set username for user

function setUsername(){

    if($('#last_name').val() != '' && $('#role option:selected').val() != '' && $('#role_name_no').val() != ''){

        var user_name = $('#last_name').val() + $('#role option:selected').val() + $('#role_name_no').val();
        var trim_space_in_user_name = user_name.replace(' ','');
    
        $('#username').val(trim_space_in_user_name.toLowerCase());
    }
}

// Resetting birthday and age field if changing birthday
$('#birthdate').click(function(){
    
    if($('#birthdate').val() != ''){

        Swal.fire({
            icon: 'question',
            title: 'Do you want to change the birthday?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: `No`,
        }).then((result) => {

            if (result.isConfirmed){

                Swal.fire({
                    icon: 'info',
                    title: 'Resetting..',
                    text: 'The input field will be reset',
                    showConfirmButton: false,
                    timer: 2000
                })
                
                // Resetting birthday and age field
                $('#birthdate').val('');
                $('#age').val('');
            }
        });
    }
});

function submitDataForms(urls, formName, modalName){
    const url = urls;
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById(formName)),
    }).then(
        response => response.text() // .json(), etc.
        // same as function(response) {return response.text();}
    ).then(
        html => console.log(html)
    );

    $('#'+modalName).modal('hide');
    // location.reload();
}

$(document).ready(function(){

    // Auto count age in Personal Data if Birhtday is not empty
    if($("input.mydob").val() != ''){
        $('.age').val(getAge($("input.mydob").val()));
    }

    // Auto count age in Personal Data
    function getAge(dob) { return ~~((new Date()-new Date(dob))/(31556952000)) }
        $("dob").val()
        $("input.mydob").change(function(){
        $('.age').val(getAge($(this).val()));
    });

    // Auto count age in Family Profile Spouse Name if Birhtday is not empty
    if($("input.mydobs").val() != ''){
        $('.ages').val(getAge($("input.mydobs").val()));
    }

    // Auto count age in Family Profile Spouse Name
    function getAge(dob) { return ~~((new Date()-new Date(dob))/(31556952000)) }
        $("dob").val()
        $("input.mydobs").change(function(){
        $('.ages').val(getAge($(this).val()));
    });

});

// Start of submit form

function submitForm(action_url, form_id, action_type, update_table_js_function_name, reset_form_js_function_name, submit_button_id, reload_page_enable, assign_redirect_page_url){

    Swal.fire({
        icon: 'question',
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Don't save`,
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: 'Processing...',
                text: 'Waiting for server response',
                imageUrl: rootURL + 'images/preloader.gif',
                showConfirmButton: false,
                allowOutsideClick: false
            });

            const formElement = document.querySelector('#'+ form_id);
            const formData = new FormData(formElement);

            $.ajax({
                type: "POST",
                url: action_url,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',           
                success: function(response) {

                    if (response === 'Successfully added'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Saved!', 
                            html: `<center>Successfully added.</center>`
                        });

                        if(reset_form_js_function_name != 'None'){
                            resetFormFunction(reset_form_js_function_name);
                        }

                        if(update_table_js_function_name != 'None'){
                            updateTableFunction(update_table_js_function_name);
                        }

                        if(reload_page_enable == 'Yes'){
                            location.reload();
                        }

                        if(assign_redirect_page_url =! 'None'){
                            location.assign(assign_redirect_page_url);
                        }
                    }
                    else if (response === 'Successfully updated'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Saved!', 
                            html: `<center>Successfully updated.</center>`
                        });

                        if(reset_form_js_function_name != 'None'){
                            resetFormFunction(reset_form_js_function_name);
                        }

                        if(update_table_js_function_name != 'None'){
                            updateTableFunction(update_table_js_function_name);
                        }

                        if(reload_page_enable == 'Yes'){
                            location.reload();
                        }

                        if(assign_redirect_page_url != 'None'){
                            location.assign(assign_redirect_page_url);
                        }
                    }
                    else if(response == 'Restricted'){
    
                        Swal.fire({
                            icon: 'error',
                            title: 'Stop',
                            text: 'Sorry you are restricted to do this action please contact the administrator.',
                        });
                        
                    }
                    else{

                        html = '<div class="text-center mb-2">See details of error below.</div>';
                        $.each(response, function( index, value ) {
                            html += '<div class="text-center text-danger mb-1">'+ value +'</div>';
                        });

                        if(action_type == 'Add'){
                            Swal.fire({
                                title: 'Add Record Unsuccessful!',
                                html: html,
                                icon: 'error',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            })
                        }
                        else if(action_type == 'Update'){
                            Swal.fire({
                                title: 'Update Unsuccessful!',
                                html: html,
                                icon: 'error',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            })
                        }
                        
                    }
                }
            });
        } else if (result.isDenied) {

            Swal.fire('Changes are not saved', '', 'info')
        }
    });

}

// End of submit form

// Start of reset form js function name

function resetFormFunction(function_name){

    if(function_name == 'resetPdfFilesForm'){
        resetPdfFilesForm();
    }
    else if(function_name == 'resetPersonalDataForm'){
        resetPersonalDataForm();
    }
    else if(function_name == 'resetSpouseRecordsForm'){
        resetSpouseRecordsForm();
    }
    else if(function_name == 'resetFamilyProfileForm'){
        resetFamilyProfileForm();
    }
    else if(function_name == 'resetChildrenRecordsForm'){
        resetChildrenRecordsForm();
    }
    else if(function_name == 'resetEducationalAttainmentForm'){
        resetEducationalAttainmentForm();
    }
    else if(function_name == 'resetExaminationsTakenForm'){
        resetExaminationsTakenForm();
    }
    else if(function_name == 'resetLicenseDetailsForm'){
        resetLicenseDetailsForm();
    }
    else if(function_name == 'resetLanguagesDialectsForm'){
        resetLanguagesDialectsForm();
    }
    else if(function_name == 'resetCesWeForm'){
        resetCesWeForm();
    }
    else if(function_name == 'resetAssessmentCenterForm'){
        resetAssessmentCenterForm();
    }
    else if(function_name == 'resetValidationHrForm'){
        resetValidationHrForm();
    }
    else if(function_name == 'resetBoardInterviewForm'){
        resetBoardInterviewForm();
    }
    else if(function_name == 'resetCesStatusForm'){
        resetCesStatusForm();
    }
    else if(function_name == 'resetRecordOfCespesRatingsForm'){
        resetRecordOfCespesRatingsForm();
    }
    else if(function_name == 'resetWorkExperienceForm'){
        resetWorkExperienceForm();
    }
    else if(function_name == 'resetFieldExpertiseForm'){
        resetFieldExpertiseForm();
    }
    else if(function_name == 'resetCesTrainingsForm'){
        resetCesTrainingsForm();
    }
    else if(function_name == 'resetOtherManagementTrainingsForm'){
        resetOtherManagementTrainingsForm();
    }
    else if(function_name == 'resetResearchAndStudiesForm'){
        resetResearchAndStudiesForm();
    }
    else if(function_name == 'resetScholarshipsForm'){
        resetScholarshipsForm();
    }
    else if(function_name == 'resetAffiliationsForm'){
        resetAffiliationsForm();
    }
    else if(function_name == 'resetAwardAndCitationsForm'){
        resetAwardAndCitationsForm();
    }
    else if(function_name == 'resetCaseRecordsForm'){
        resetCaseRecordsForm();
    }
    else if(function_name == 'resetHealthRecordsForm'){
        resetHealthRecordsForm();
    }
    else if(function_name == 'resetHistoricalRecordOfMedicalConditionForm'){
        resetHistoricalRecordOfMedicalConditionForm();
    }
    else if(function_name == 'resetCesWebAppGeneralPageAccessForm'){
        resetCesWebAppGeneralPageAccessForm();
    }
    else if(function_name == 'resetExecutive201RoleAccessForm'){
        resetExecutive201RoleAccessForm();
    }
    else if(function_name == 'resetPlantillaManangementAccessForm'){
        resetPlantillaManangementAccessForm();
    }
    else if(function_name == 'resetReportGenerationAccessForm'){
        resetReportGenerationAccessForm();
    }

}

// End of reset form js function name

// Start of update table js function name

function updateTableFunction(function_name){

    if(function_name == 'updatePdfFilesTable'){
        updatePdfFilesTable();
    }
    else if(function_name == 'updatePersonalDataTable'){
        updatePersonalDataTable();
    }
    else if(function_name == 'updateSpouseRecordsTable'){
        updateSpouseRecordsTable();
    }
    else if(function_name == 'updateFamilyProfileTable'){
        updateFamilyProfileTable();
    }
    else if(function_name == 'updateChildrenRecordsTable'){
        updateChildrenRecordsTable();
    }
    else if(function_name == 'updateEducationalAttainmentTable'){
        updateEducationalAttainmentTable();
    }
    else if(function_name == 'updateExaminationsTakenTable'){
        updateExaminationsTakenTable();
    }
    else if(function_name == 'updateLicenseDetailsTable'){
        updateLicenseDetailsTable();
    }
    else if(function_name == 'updateLanguagesDialectsTable'){
        updateLanguagesDialectsTable();
    }
    else if(function_name == 'updateCesWeTable'){
        updateCesWeTable();
    }
    else if(function_name == 'updateAssessmentCenterTable'){
        updateAssessmentCenterTable();
    }
    else if(function_name == 'updateValidationHrTable'){
        updateValidationHrTable();
    }
    else if(function_name == 'updateBoardInterviewTable'){
        updateBoardInterviewTable();
    }
    else if(function_name == 'updateCesStatusTable'){
        updateCesStatusTable();
    }
    else if(function_name == 'updateRecordOfCespesRatingsTable'){
        updateRecordOfCespesRatingsTable();
    }
    else if(function_name == 'updateWorkExperienceTable'){
        updateWorkExperienceTable();
    }
    else if(function_name == 'updateFieldExpertiseTable'){
        updateFieldExpertiseTable();
    }
    else if(function_name == 'updateCesTrainingsTable'){
        updateCesTrainingsTable();
    }
    else if(function_name == 'updateOtherManagementTrainingsTable'){
        updateOtherManagementTrainingsTable();
    }
    else if(function_name == 'updateResearchAndStudiesTable'){
        updateResearchAndStudiesTable();
    }
    else if(function_name == 'updateScholarshipsTable'){
        updateScholarshipsTable();
    }
    else if(function_name == 'updateAffiliationsTable'){
        updateAffiliationsTable();
    }
    else if(function_name == 'updateAwardAndCitationsTable'){
        updateAwardAndCitationsTable();
    }
    else if(function_name == 'updateCaseRecordsTable'){
        updateCaseRecordsTable();
    }
    else if(function_name == 'updateHealthRecordsTable'){
        updateHealthRecordsTable();
    }
    else if(function_name == 'updateHistoricalRecordOfMedicalConditionTable'){
        updateHistoricalRecordOfMedicalConditionTable();
    }
    else if(function_name == 'updateCesWebAppGeneralPageAccessTable'){
        updateCesWebAppGeneralPageAccessTable();
    }
    else if(function_name == 'updateExecutive201RoleAccessTable'){
        updateExecutive201RoleAccessTable();
    }
    else if(function_name == 'updatePlantillaManangementAccessTable'){
        updatePlantillaManangementAccessTable();
    }
    else if(function_name == 'updateReportGenerationAccessTable'){
        updateReportGenerationAccessTable();
    }

}

// End of update table js function name

// Start of updating Personal Data Table

function updatePersonalDataTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Personal Data Table
            $("#PersonalData_tbody").empty();

            if(result.PersonalData == ''){

                $('#PersonalData_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.PersonalData.forEach(element => {
                    $('#PersonalData_tbody').append('<tr>'+
                    '<td>'+
                        ((result.PersonalDataEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetPersonalDataForm(`Edit`)">Edit</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['cesno'] == null) ? '-' : element['cesno']) +'</td>'+
                    '<td>'+ ((element['sp'] == null) ? '-' : element['sp']) +'</td>'+
                    '<td>'+ ((element['moig'] == null) ? '-' : element['moig']) +'</td>'+
                    '<td>'+ ((element['pwd'] == null) ? '-' : element['pwd']) +'</td>'+
                    '<td>'+ ((element['title'] == null) ? '-' : element['title']) +'</td>'+
                    '<td>'+ ((element['gsis'] == null) ? '-' : element['gsis']) +'</td>'+
                    '<td>'+ ((element['pagibig'] == null) ? '-' : element['pagibig']) +'</td>'+
                    '<td>'+ ((element['philhealt'] == null) ? '-' : element['philhealt']) +'</td>'+
                    '<td>'+ ((element['sss_no'] == null) ? '-' : element['sss_no']) +'</td>'+
                    '<td>'+ ((element['tin'] == null) ? '-' : element['tin']) +'</td>'+
                    '<td>'+ ((element['status'] == null) ? '-' : element['status']) +'</td>'+
                    '<td>'+ ((element['citizenship'] == null) ? '-' : element['citizenship']) +'</td>'+
                    '<td>'+ ((element['d_citizenship'] == null) ? '-' : element['d_citizenship']) +'</td>'+
                    '<td>'+ ((element['lastname'] == null) ? '-' : element['lastname']) +'</td>'+
                    '<td>'+ ((element['firstname'] == null) ? '-' : element['firstname']) +'</td>'+
                    '<td>'+ ((element['middlename'] == null) ? '-' : element['middlename']) +'</td>'+
                    '<td>'+ ((element['mi'] == null) ? '-' : element['mi']) +'</td>'+
                    '<td>'+ ((element['ne'] == null) ? '-' : element['ne']) +'</td>'+
                    '<td>'+ ((element['nickname'] == null) ? '-' : element['nickname']) +'</td>'+
                    '<td>'+ ((element['birthdate'] == null) ? '-' : element['birthdate']) +'</td>'+
                    '<td>'+ ((element['age'] == null) ? '-' : element['age']) +'</td>'+
                    '<td>'+ ((element['birth_place'] == null) ? '-' : element['birth_place']) +'</td>'+
                    '<td>'+ ((element['gender'] == null) ? '-' : element['gender']) +'</td>'+
                    '<td>'+ ((element['civil_status'] == null) ? '-' : element['civil_status']) +'</td>'+
                    '<td>'+ ((element['religion'] == null) ? '-' : element['religion']) +'</td>'+
                    '<td>'+ ((element['height'] == null) ? '-' : element['height']) +'</td>'+
                    '<td>'+ ((element['weight'] == null) ? '-' : element['weight']) +'</td>'+
                    '<td>'+ ((element['fb_pa'] == null) ? '-' : element['fb_pa']) +'</td>'+
                    '<td>'+ ((element['ns_pa'] == null) ? '-' : element['ns_pa']) +'</td>'+
                    '<td>'+ ((element['bd_pa'] == null) ? '-' : element['bd_pa']) +'</td>'+
                    '<td>'+ ((element['cm_pa'] == null) ? '-' : element['cm_pa']) +'</td>'+
                    '<td>'+ ((element['zc_pa'] == null) ? '-' : element['zc_pa']) +'</td>'+
                    '<td>'+ ((element['fb_ma'] == null) ? '-' : element['fb_ma']) +'</td>'+
                    '<td>'+ ((element['ns_ma'] == null) ? '-' : element['ns_ma']) +'</td>'+
                    '<td>'+ ((element['bd_ma'] == null) ? '-' : element['bd_ma']) +'</td>'+
                    '<td>'+ ((element['cm_ma'] == null) ? '-' : element['cm_ma']) +'</td>'+
                    '<td>'+ ((element['zc_ma'] == null) ? '-' : element['zc_ma']) +'</td>'+
                    '<td>'+ ((element['oea_ma'] == null) ? '-' : element['oea_ma']) +'</td>'+
                    '<td>'+ ((element['telno1_ma'] == null) ? '-' : element['telno1_ma']) +'</td>'+
                    '<td>'+ ((element['mobileno1_ma'] == null) ? '-' : element['mobileno1_ma']) +'</td>'+
                    '<td>'+ ((element['mobileno2_ma'] == null) ? '-' : element['mobileno2_ma']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );

                    // Update Profile Name and Picture in profile details
                    $('#profile_lastname').text(element['lastname']);
                    $('#profile_firstname').text(element['firstname']);
                    $('#profile_middlename').text(element['middlename']);
                    $('#profile_picture').attr('src', rootURL + 'external-storage/Photos/201 Photos/' + element['picture']);

                    if(result.UserRoleName = 'User'){
                        $('#menu_profile_picture').attr('src', rootURL + 'external-storage/Photos/201 Photos/' + element['picture']);
                    }
                    
                }); 
            }
        }
    });

}

// End of updating Personal Data Table

// Start of reseting Personal Data Form

function resetPersonalDataForm(option){

    if(option == null){

        // Reset form
        $('#personal_data').trigger('reset');

        // Disabled all elements in form
        var personal_data_form = document.forms['personal_data'];

        for(var i=0, personal_data_formLen = personal_data_form.length; i<personal_data_formLen; i++){
            personal_data_form.elements[i].disabled = true;
        }

        // Hide and disabled Add or Edit Record button
        $('#personal_data_submit').attr({hidden: 'hidden', disabled: 'disabled'});
        
    }

    Swal.fire({
        title: 'Populating Data...',
        text: 'Please wait for server response',
        imageUrl: rootURL + 'images/preloader.gif',
        showConfirmButton: false,
        allowOutsideClick: false
    });

    if(option == 'Edit'){

        // Disable "is PWD?" drop down list if not checked
        $('#pwd_TxtB').attr('disabled','disabled');

        // Put checked on is PWD? if there was selected item
        if($('#pwd_TxtB option:selected').val() != ''){
            $('#pwd_CheckB').attr('checked', 'checked');
            $('#pwd_TxtB').removeAttr('disabled');
        }

        // Enable "If Holder Dual Citizenship By Birth, By Naturalization" input field if not empty
        if ($('#inputcitizenShip').val() != '') {

            $('#inputcitizenShip').removeAttr('disabled');
        }

        // Reset form
        $('#personal_data').trigger('reset');

        // Removed disabled attribute in all elements from form
        var personal_data_form = document.forms['personal_data'];

        for(var i=0, personal_data_formLen = personal_data_form.length; i<personal_data_formLen; i++){
            personal_data_form.elements[i].disabled = false;
        }

        // Set submit button name to Edit Record and remove hidden and disabled attribute
        $('#personal_data_submit').val('Edit Record').removeAttr('hidden disabled');

    }
    
    $.ajax({
        url: rootURL + 'api/v1/personal-data/record/' + cesno,
        success: function (result) {

            result.forEach(element => {

                document.getElementsByName('cesno')[0].value = element['cesno'];
                document.getElementsByName('sp')[0].value = element['sp'];
                document.getElementsByName('moig')[0].value = element['moig'];
                document.getElementsByName('pwd')[0].value = element['pwd'];
                document.getElementsByName('title')[0].value = element['title'];
                document.getElementsByName('gsis')[0].value = element['gsis'];
                document.getElementsByName('pagibig')[0].value = element['pagibig'];
                document.getElementsByName('philhealt')[0].value = element['philhealt'];
                document.getElementsByName('sss_no')[0].value = element['sss_no'];
                document.getElementsByName('tin')[0].value = element['tin'];
                document.getElementsByName('status')[0].value = element['status'];
                document.getElementsByName('citizenship')[0].value = element['citizenship'];
                document.getElementsByName('d_citizenship')[0].value = element['d_citizenship'];
                document.getElementsByName('lastname')[0].value = element['lastname'];
                document.getElementsByName('firstname')[0].value = element['firstname'];
                document.getElementsByName('middlename')[0].value = element['middlename'];
                document.getElementsByName('mi')[0].value = element['mi'];
                document.getElementsByName('ne')[0].value = element['ne'];
                document.getElementsByName('nickname')[0].value = element['nickname'];
                document.getElementsByName('birthdate')[0].value = element['birthdate'];
                document.getElementsByName('age')[0].value = element['age'];
                document.getElementsByName('birth_place')[0].value = element['birth_place'];
                document.getElementsByName('gender')[0].value = element['gender'];
                document.getElementsByName('civil_status')[0].value = element['civil_status'];
                document.getElementsByName('religion')[0].value = element['religion'];
                document.getElementsByName('height')[0].value = element['height'];
                document.getElementsByName('weight')[0].value = element['weight'];
                document.getElementsByName('fb_pa')[0].value = element['fb_pa'];
                document.getElementsByName('ns_pa')[0].value = element['ns_pa'];
                document.getElementsByName('bd_pa')[0].value = element['bd_pa'];
                document.getElementsByName('cm_pa')[0].value = element['cm_pa'];
                document.getElementsByName('zc_pa')[0].value = element['zc_pa'];
                document.getElementsByName('fb_ma')[0].value = element['fb_ma'];
                document.getElementsByName('ns_ma')[0].value = element['ns_ma'];
                document.getElementsByName('bd_ma')[0].value = element['bd_ma'];
                document.getElementsByName('cm_ma')[0].value = element['cm_ma'];
                document.getElementsByName('zc_ma')[0].value = element['zc_ma'];
                document.getElementsByName('oea_ma')[0].value = element['oea_ma'];
                document.getElementsByName('telno1_ma')[0].value = element['telno1_ma'];
                document.getElementsByName('mobileno1_ma')[0].value = element['mobileno1_ma'];
                document.getElementsByName('mobileno2_ma')[0].value = element['mobileno2_ma'];
            });  

            Swal.close();    
        }
    });
}

// End of reseting Personal Data Form

// Start of updating Family Profile Spouse name Table

function updateSpouseRecordsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Family Profile Spouse name Table
            $("#SpouseRecords_tbody").empty();

            if(result.SpouseRecords == ''){

                $('#SpouseRecords_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.SpouseRecords.forEach(element => {
                    $('#SpouseRecords_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetSpouseRecordsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.FamilyProfileEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetSpouseRecordsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.FamilyProfileDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/spouse-records/delete/'+ element['id'] +'`, `updateSpouseRecordsTable`, `resetSpouseRecordsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['lastname_sn_fp'] == null) ? '-' : element['lastname_sn_fp']) +'</td>'+
                    '<td>'+ ((element['first_sn_fp'] == null) ? '-' : element['first_sn_fp']) +'</td>'+
                    '<td>'+ ((element['middlename_sn_fp'] == null) ? '-' : element['middlename_sn_fp']) +'</td>'+
                    '<td>'+ ((element['ne_sn_fp'] == null) ? '-' : element['ne_sn_fp']) +'</td>'+
                    '<td>'+ ((element['occu_sn_fp'] == null) ? '-' : element['occu_sn_fp']) +'</td>'+
                    '<td>'+ ((element['ebn_sn_fp'] == null) ? '-' : element['ebn_sn_fp']) +'</td>'+
                    '<td>'+ ((element['eba_sn_fp'] == null) ? '-' : element['eba_sn_fp']) +'</td>'+
                    '<td>'+ ((element['etn_sn_fp'] == null) ? '-' : element['etn_sn_fp']) +'</td>'+
                    '<td>'+ ((element['civil_status_sn_fp'] == null) ? '-' : element['civil_status_sn_fp']) +'</td>'+
                    '<td>'+ ((element['gender_sn_fp'] == null) ? '-' : element['gender_sn_fp']) +'</td>'+
                    '<td>'+ ((element['birthdate_sn_fp'] == null) ? '-' : element['birthdate_sn_fp']) +'</td>'+
                    '<td>'+ ((element['age_sn_fp'] == null) ? '-' : element['age_sn_fp']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Family Profile Spouse name Table

// Start of reseting Family Profile Spouse name Form

function resetSpouseRecordsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Family Background Profile/Add',
        success: function (validation) {

            if(id == null){
                
                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var spouse_records_form = document.forms['spouse_records_form'];

                    for(var i=0, spouse_records_formLen = spouse_records_form.length; i<spouse_records_formLen; i++){
                        spouse_records_form.elements[i].disabled = false;
                    }

                    // Reset form
                    $('#spouse_records_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#spouse_records_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#spouse_records_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#spouse_records_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/spouse-records/add`, `spouse_records_form`, `Add`, `updateSpouseRecordsTable`, `resetSpouseRecordsForm`, `spouse_records_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#spouse_records_form_submit').attr('class', 'btn btn-primary mb-1');

                }
                
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var spouse_records_form = document.forms['spouse_records_form'];

                    for(var i=0, spouse_records_formLen = spouse_records_form.length; i<spouse_records_formLen; i++){
                        spouse_records_form.elements[i].disabled = false;
                    }

                    // Set id number for hidden input id
                    $('#cesno_spouse_records_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#spouse_records_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#spouse_records_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#spouse_records_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#spouse_records_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/spouse-records/edit`, `spouse_records_form`, `Update`, `updateSpouseRecordsTable`, `resetSpouseRecordsForm`, `spouse_records_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var spouse_records_form = document.forms['spouse_records_form'];

                    for(var i=0, spouse_records_formLen = spouse_records_form.length; i<spouse_records_formLen; i++){
                        spouse_records_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('spouse_records_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#spouse_records_form').trigger('reset');

                    // Set id number for hidden input id
                    $('#cesno_spouse_records_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#spouse_records_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#spouse_records_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/spouse-records/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('lastname_sn_fp')[0].value = element['lastname_sn_fp'];
                            document.getElementsByName('first_sn_fp')[0].value = element['first_sn_fp'];
                            document.getElementsByName('middlename_sn_fp')[0].value = element['middlename_sn_fp'];
                            document.getElementsByName('ne_sn_fp')[0].value = element['ne_sn_fp'];
                            document.getElementsByName('occu_sn_fp')[0].value = element['occu_sn_fp'];
                            document.getElementsByName('ebn_sn_fp')[0].value = element['ebn_sn_fp'];
                            document.getElementsByName('eba_sn_fp')[0].value = element['eba_sn_fp'];
                            document.getElementsByName('etn_sn_fp')[0].value = element['etn_sn_fp'];
                            document.getElementsByName('civil_status_sn_fp')[0].value = element['civil_status_sn_fp'];
                            document.getElementsByName('gender_sn_fp')[0].value = element['gender_sn_fp'];
                            document.getElementsByName('birthdate_sn_fp')[0].value = element['birthdate_sn_fp'];
                            document.getElementsByName('age_sn_fp')[0].value = element['age_sn_fp'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Family Profile Spouse name Form

// Start of updating Family Profile Father, Mother name Table

function updateFamilyProfileTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Family Profile Father, Mother name Table
            $("#FamilyProfile_tbody").empty();

            if(result.FamilyProfile == ''){

                $('#FamilyProfile_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.FamilyProfile.forEach(element => {
                    $('#FamilyProfile_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetFamilyProfileForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.FamilyProfileEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetFamilyProfileForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['fn_lastname_fp'] == null) ? '-' : element['fn_lastname_fp']) +'</td>'+
                    '<td>'+ ((element['fn_first_fp'] == null) ? '-' : element['fn_first_fp']) +'</td>'+
                    '<td>'+ ((element['fn_middlename_fp'] == null) ? '-' : element['fn_middlename_fp']) +'</td>'+
                    '<td>'+ ((element['fn_ne_fp'] == null) ? '-' : element['fn_ne_fp']) +'</td>'+
                    '<td>'+ ((element['mn_lastname_fp'] == null) ? '-' : element['mn_lastname_fp']) +'</td>'+
                    '<td>'+ ((element['mn_first_fp'] == null) ? '-' : element['mn_first_fp']) +'</td>'+
                    '<td>'+ ((element['mn_middlename_fp'] == null) ? '-' : element['mn_middlename_fp']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Family Profile Father, Mother name Table

// Start of reseting Family Profile Father, Mother name Form

function resetFamilyProfileForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Family Background Profile/Add',
        success: function (validation) {
    
            if(id == null){
                
                if(validation == 'true'){

                    // Remove disabled in all elements from form
                    var family_profile_form = document.forms['family_profile_form'];

                    for(var i=0, family_profile_formLen = family_profile_form.length; i<family_profile_formLen; i++){
                        family_profile_form.elements[i].disabled = false;
                    }

                    // Reset form
                    $('#family_profile_form').trigger('reset');

                    // Set submit button name to Edit Record
                    $('#family_profile_form_submit').val('Edit Record');

                    // Hide submit button name
                    $('#family_profile_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Set submit button button color to secondary
                    $('#family_profile_form_submit').attr('class', 'btn btn-secondary mb-1');

                }
                
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled in all elements from form
                    var family_profile_form = document.forms['family_profile_form'];

                    for(var i=0, family_profile_formLen = family_profile_form.length; i<family_profile_formLen; i++){
                        family_profile_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_family_profile_id').val(id);

                    // // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#family_profile_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#family_profile_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#family_profile_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#family_profile_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/family-profile/edit`, `family_profile_form`, `Update`, `updateFamilyProfileTable`, `resetFamilyProfileForm`, `family_profile_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var family_profile_form = document.forms['family_profile_form'];

                    for(var i=0, family_profile_formLen = family_profile_form.length; i<family_profile_formLen; i++){
                        family_profile_form.elements[i].disabled = true;
                    }

                    // Reset form
                    $('#family_profile_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_family_profile_id').val(id);

                    // Hide and disabled Edit Record button
                    $('#family_profile_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#family_profile_form_go_back_to_add_record_button').removeAttr('hidden');
                    
                }

                $.ajax({
                    url: rootURL + 'api/v1/family-profile/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('fn_lastname_fp')[0].value = element['fn_lastname_fp'];
                            document.getElementsByName('fn_first_fp')[0].value = element['fn_first_fp'];
                            document.getElementsByName('fn_middlename_fp')[0].value = element['fn_middlename_fp'];
                            document.getElementsByName('fn_ne_fp')[0].value = element['fn_ne_fp'];
                            document.getElementsByName('mn_lastname_fp')[0].value = element['mn_lastname_fp'];
                            document.getElementsByName('mn_first_fp')[0].value = element['mn_first_fp'];
                            document.getElementsByName('mn_middlename_fp')[0].value = element['mn_middlename_fp'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Family Profile Father, Mother name Form

// Start of updating Family Profile Childrens Record Table

function updateChildrenRecordsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Family Profile Childrens Record Table
            $("#ChildrenRecords_tbody").empty();

            if(result.ChildrenRecords == ''){

                $('#ChildrenRecords_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.ChildrenRecords.forEach(element => {
                    $('#ChildrenRecords_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetChildrenRecordsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.FamilyProfileEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetChildrenRecordsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.FamilyProfileDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/children-records/delete/'+ element['id'] +'`, `updateChildrenRecordsTable`, `resetChildrenRecordsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['ch_lastname_fp'] == null) ? '-' : element['ch_lastname_fp']) +'</td>'+
                    '<td>'+ ((element['ch_first_fp'] == null) ? '-' : element['ch_first_fp']) +'</td>'+
                    '<td>'+ ((element['ch_middlename_fp'] == null) ? '-' : element['ch_middlename_fp']) +'</td>'+
                    '<td>'+ ((element['ch_ne_fp'] == null) ? '-' : element['ch_ne_fp']) +'</td>'+
                    '<td>'+ ((element['ch_gender_fp'] == null) ? '-' : element['ch_gender_fp']) +'</td>'+
                    '<td>'+ ((element['ch_birthdate_fp'] == null) ? '-' : element['ch_birthdate_fp']) +'</td>'+
                    '<td>'+ ((element['ch_birthplace_fp'] == null) ? '-' : element['ch_birthplace_fp']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Family Profile Childrens Record Table

// Start of reseting Family Profile Childrens Record Form

function resetChildrenRecordsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Family Background Profile/Add',
        success: function (validation) {

            if(id == null){
                
                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var children_record_form = document.forms['children_record_form'];

                    for(var i=0, children_record_formLen = children_record_form.length; i<children_record_formLen; i++){
                        children_record_form.elements[i].disabled = false;
                    }

                    // Reset form
                    $('#children_record_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#children_record_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#children_record_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#children_record_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/children-records/add`, `children_record_form`, `Add`, `updateChildrenRecordsTable`, `resetChildrenRecordsForm`, `children_record_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#children_record_form_submit').attr('class', 'btn btn-primary mb-1');

                }
                
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var children_record_form = document.forms['children_record_form'];

                    for(var i=0, children_record_formLen = children_record_form.length; i<children_record_formLen; i++){
                        children_record_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_children_record_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#children_record_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#children_record_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#children_record_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#children_record_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/children-records/edit`, `children_record_form`, `Update`, `updateChildrenRecordsTable`, `resetChildrenRecordsForm`, `children_record_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var children_record_form = document.forms['children_record_form'];

                    for(var i=0, children_record_formLen = children_record_form.length; i<children_record_formLen; i++){
                        children_record_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('children_record_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#children_record_form').trigger('reset');

                    // Set id number for hidden input id
                    $('#cesno_children_record_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#children_record_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#children_record_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/children-records/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('ch_lastname_fp')[0].value = element['ch_lastname_fp'];
                            document.getElementsByName('ch_first_fp')[0].value = element['ch_first_fp'];
                            document.getElementsByName('ch_middlename_fp')[0].value = element['ch_middlename_fp'];
                            document.getElementsByName('ch_ne_fp')[0].value = element['ch_ne_fp'];
                            document.getElementsByName('ch_gender_fp')[0].value = element['ch_gender_fp'];
                            document.getElementsByName('ch_birthdate_fp')[0].value = element['ch_birthdate_fp'];
                            document.getElementsByName('ch_birthplace_fp')[0].value = element['ch_birthplace_fp'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Family Profile Childrens Record Form

// Start of updating Educational Background or Attainment Table

function updateEducationalAttainmentTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Educational Background or Attainment Table
            $("#EducationalAttainment_tbody").empty();

            if(result.EducationalAttainment == ''){

                $('#EducationalAttainment_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.EducationalAttainment.forEach(element => {
                    $('#EducationalAttainment_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetEducationalAttainmentForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.EducationalAttainmentEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetEducationalAttainmentForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.EducationalAttainmentDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/educational-attainment/delete/'+ element['id'] +'`, `updateEducationalAttainmentTable`, `resetEducationalAttainmentForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['level_ea'] == null) ? '-' : element['level_ea']) +'</td>'+
                    '<td>'+ ((element['school_ea'] == null) ? '-' : element['school_ea']) +'</td>'+
                    '<td>'+ ((element['degree_ea'] == null) ? '-' : element['degree_ea']) +'</td>'+
                    '<td>'+ ((element['date_grad_ea'] == null) ? '-' : element['date_grad_ea']) +'</td>'+
                    '<td>'+ ((element['ms_ea'] == null) ? '-' : element['ms_ea']) +'</td>'+
                    '<td>'+ ((element['school_type_ea'] == null) ? '-' : element['school_type_ea']) +'</td>'+
                    '<td>'+ ((element['date_f_ea'] == null) ? '-' : element['date_f_ea']) +'</td>'+
                    '<td>'+ ((element['date_t_ea'] == null) ? '-' : element['date_t_ea']) +'</td>'+
                    '<td>'+ ((element['hlu_ea'] == null) ? '-' : element['hlu_ea']) +'</td>'+
                    '<td>'+ ((element['ahr_ea'] == null) ? '-' : element['ahr_ea']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Educational Background or Attainment Table

// Start of reseting Educational Background or Attainment Form

function resetEducationalAttainmentForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Educational Background or Attainment/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var educational_attainment_form = document.forms['educational_attainment_form'];

                    for(var i=0, educational_attainment_formLen = educational_attainment_form.length; i<educational_attainment_formLen; i++){
                        educational_attainment_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#educational_attainment_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#educational_attainment_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#educational_attainment_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#educational_attainment_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/educational-attainment/add`, `educational_attainment_form`, `Add`, `updateEducationalAttainmentTable`, `resetEducationalAttainmentForm`, `educational_attainment_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#educational_attainment_form_submit').attr('class', 'btn btn-primary mb-1');
                
                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var educational_attainment_form = document.forms['educational_attainment_form'];

                    for(var i=0, educational_attainment_formLen = educational_attainment_form.length; i<educational_attainment_formLen; i++){
                        educational_attainment_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_educational_attainment_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#educational_attainment_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#educational_attainment_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#educational_attainment_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#educational_attainment_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/educational-attainment/edit`, `educational_attainment_form`, `Update`, `updateEducationalAttainmentTable`, `resetEducationalAttainmentForm`, `educational_attainment_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var educational_attainment_form = document.forms['educational_attainment_form'];

                    for(var i=0, educational_attainment_formLen = educational_attainment_form.length; i<educational_attainment_formLen; i++){
                        educational_attainment_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('educational_attainment_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#educational_attainment_form').trigger('reset');

                    // Set id number for hidden input id
                    $('#cesno_educational_attainment_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#educational_attainment_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#educational_attainment_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/educational-attainment/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('level_ea')[0].value = element['level_ea'];
                            document.getElementsByName('school_ea')[0].value = element['school_ea'];
                            document.getElementsByName('degree_ea')[0].value = element['degree_ea'];
                            document.getElementsByName('date_grad_ea')[0].value = element['date_grad_ea'];
                            document.getElementsByName('ms_ea')[0].value = element['ms_ea'];
                            document.getElementsByName('school_type_ea')[0].value = element['school_type_ea'];
                            document.getElementsByName('date_f_ea')[0].value = element['date_f_ea'];
                            document.getElementsByName('date_t_ea')[0].value = element['date_t_ea'];
                            document.getElementsByName('hlu_ea')[0].value = element['hlu_ea'];
                            document.getElementsByName('ahr_ea')[0].value = element['ahr_ea'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Educational Background or Attainment Form

// Start of updating Examinations Taken - Historical Records of Examinations taken Table

function updateExaminationsTakenTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Examinations Taken - Historical Records of Examinations taken Table
            $("#ExaminationsTaken_tbody").empty();

            if(result.ExaminationsTaken == ''){

                $('#ExaminationsTaken_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.ExaminationsTaken.forEach(element => {
                    $('#ExaminationsTaken_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetExaminationsTakenForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.ExaminationsTakenEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetExaminationsTakenForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.ExaminationsTakenDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/examination-taken/delete/'+ element['id'] +'`, `updateExaminationsTakenTable`, `resetExaminationsTakenForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['tox_et'] == null) ? '-' : element['tox_et']) +'</td>'+
                    '<td>'+ ((element['rating_et'] == null) ? '-' : element['rating_et']) +'</td>'+
                    '<td>'+ ((element['doe_et'] == null) ? '-' : element['doe_et']) +'</td>'+
                    '<td>'+ ((element['poe_et'] == null) ? '-' : element['poe_et']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Examinations Taken - Historical Records of Examinations taken Table

// Start of reseting Examinations Taken - Historical Records of Examinations taken Form

function resetExaminationsTakenForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Examinations Taken/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var examinations_taken_historical_record_of_examinations_taken_form = document.forms['examinations_taken_historical_record_of_examinations_taken_form'];

                    for(var i=0, examinations_taken_historical_record_of_examinations_taken_formLen = examinations_taken_historical_record_of_examinations_taken_form.length; i<examinations_taken_historical_record_of_examinations_taken_formLen; i++){
                        examinations_taken_historical_record_of_examinations_taken_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#examinations_taken_historical_record_of_examinations_taken_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#examinations_taken_historical_record_of_examinations_taken_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#examinations_taken_historical_record_of_examinations_taken_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#examinations_taken_historical_record_of_examinations_taken_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/examination-taken/add`, `examinations_taken_historical_record_of_examinations_taken_form`, `Add`, `updateExaminationsTakenTable`, `resetExaminationsTakenForm`, `examinations_taken_historical_record_of_examinations_taken_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#examinations_taken_historical_record_of_examinations_taken_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                
                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var examinations_taken_historical_record_of_examinations_taken_form = document.forms['examinations_taken_historical_record_of_examinations_taken_form'];

                    for(var i=0, examinations_taken_historical_record_of_examinations_taken_formLen = examinations_taken_historical_record_of_examinations_taken_form.length; i<examinations_taken_historical_record_of_examinations_taken_formLen; i++){
                        examinations_taken_historical_record_of_examinations_taken_form.elements[i].disabled = false;
                    }

                    // Set id number for hidden input id
                    $('#cesno_examinations_taken_historical_records_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#examinations_taken_historical_record_of_examinations_taken_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#examinations_taken_historical_record_of_examinations_taken_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#examinations_taken_historical_record_of_examinations_taken_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#examinations_taken_historical_record_of_examinations_taken_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/examination-taken/edit`, `examinations_taken_historical_record_of_examinations_taken_form`, `Update`, `updateExaminationsTakenTable`, `resetExaminationsTakenForm`, `examinations_taken_historical_record_of_examinations_taken_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var examinations_taken_historical_record_of_examinations_taken_form = document.forms['examinations_taken_historical_record_of_examinations_taken_form'];

                    for(var i=0, examinations_taken_historical_record_of_examinations_taken_formLen = examinations_taken_historical_record_of_examinations_taken_form.length; i<examinations_taken_historical_record_of_examinations_taken_formLen; i++){
                        examinations_taken_historical_record_of_examinations_taken_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('examinations_taken_historical_record_of_examinations_taken_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#examinations_taken_historical_record_of_examinations_taken_form').trigger('reset');

                    // Set id number for hidden input id
                    $('#cesno_examinations_taken_historical_records_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#examinations_taken_historical_record_of_examinations_taken_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#examinations_taken_historical_record_of_examinations_taken_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/examination-taken/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('tox_et')[0].value = element['tox_et'];
                            document.getElementsByName('rating_et')[0].value = element['rating_et'];
                            document.getElementsByName('doe_et')[0].value = element['doe_et'];
                            document.getElementsByName('poe_et')[0].value = element['poe_et'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Examinations Taken - Historical Records of Examinations taken Form

// Start of updating Examinations Taken - License Details Table

function updateLicenseDetailsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Examinations Taken - License Details Table
            $("#LicenseDetails_tbody").empty();

            if(result.LicenseDetails == ''){

                $('#LicenseDetails_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.LicenseDetails.forEach(element => {
                    $('#LicenseDetails_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetLicenseDetailsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.ExaminationsTakenEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetLicenseDetailsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.ExaminationsTakenDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/license-details/delete/'+ element['id'] +'`, `updateLicenseDetailsTable`, `resetLicenseDetailsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['ld_ln_et'] == null) ? '-' : element['ld_ln_et']) +'</td>'+
                    '<td>'+ ((element['ld_da_et'] == null) ? '-' : element['ld_da_et']) +'</td>'+
                    '<td>'+ ((element['ld_dov_et'] == null) ? '-' : element['ld_dov_et']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Examinations Taken - License Details Table

// Start of reseting Examinations Taken - License Details Form

function resetLicenseDetailsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Examinations Taken/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var examinations_taken_license_details_form = document.forms['examinations_taken_license_details_form'];

                    for(var i=0, examinations_taken_license_details_formLen = examinations_taken_license_details_form.length; i<examinations_taken_license_details_formLen; i++){
                        examinations_taken_license_details_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#examinations_taken_license_details_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#examinations_taken_license_details_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#examinations_taken_license_details_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#examinations_taken_license_details_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/license-details/add`, `examinations_taken_license_details_form`, `Add`, `updateLicenseDetailsTable`, `resetLicenseDetailsForm`, `examinations_taken_license_details_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#examinations_taken_license_details_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                
                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var examinations_taken_license_details_form = document.forms['examinations_taken_license_details_form'];

                    for(var i=0, examinations_taken_license_details_formLen = examinations_taken_license_details_form.length; i<examinations_taken_license_details_formLen; i++){
                        examinations_taken_license_details_form.elements[i].disabled = false;
                    }
                    
                    // Set id number for hidden input id
                    $('#cesno_examinations_taken_license_details_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#examinations_taken_license_details_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#examinations_taken_license_details_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#examinations_taken_license_details_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#examinations_taken_license_details_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/license-details/edit`, `examinations_taken_license_details_form`, `Update`, `updateLicenseDetailsTable`, `resetLicenseDetailsForm`, `examinations_taken_license_details_form_submit`, `None`, `None`)');
                
                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var examinations_taken_license_details_form = document.forms['examinations_taken_license_details_form'];

                    for(var i=0, examinations_taken_license_details_formLen = examinations_taken_license_details_form.length; i<examinations_taken_license_details_formLen; i++){
                        examinations_taken_license_details_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('examinations_taken_license_details_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#examinations_taken_license_details_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_examinations_taken_license_details_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#examinations_taken_license_details_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#examinations_taken_license_details_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/license-details/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('ld_ln_et')[0].value = element['ld_ln_et'];
                            document.getElementsByName('ld_da_et')[0].value = element['ld_da_et'];
                            document.getElementsByName('ld_dov_et')[0].value = element['ld_dov_et'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Examinations Taken - License Details Form

// Start of updating Languages Dialects Table

function updateLanguagesDialectsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Languages Dialects Table
            $("#LanguagesDialects_tbody").empty();

            if(result.LanguagesDialects == ''){

                $('#LanguagesDialects_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.LanguagesDialects.forEach(element => {
                    $('#LanguagesDialects_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetLanguagesDialectsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.LanguagesDialectsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetLanguagesDialectsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.LanguagesDialectsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/languages-dialects/delete/'+ element['id'] +'`, `updateLanguagesDialectsTable`, `resetLanguagesDialectsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['lang_languages_dialects'] == null) ? '-' : element['lang_languages_dialects']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Languages Dialects Table

// Start of reseting Languages Dialects Form

function resetLanguagesDialectsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Language Dialects/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var languages_dialects_form = document.forms['languages_dialects_form'];

                    for(var i=0, languages_dialects_formLen = languages_dialects_form.length; i<languages_dialects_formLen; i++){
                        languages_dialects_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#languages_dialects_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#languages_dialects_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#languages_dialects_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#languages_dialects_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/languages-dialects/add`, `languages_dialects_form`, `Add`, `updateLanguagesDialectsTable`, `resetLanguagesDialectsForm`, `languages_dialects_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#languages_dialects_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var languages_dialects_form = document.forms['languages_dialects_form'];

                    for(var i=0, languages_dialects_formLen = languages_dialects_form.length; i<languages_dialects_formLen; i++){
                        languages_dialects_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_languages_dialects_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#languages_dialects_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#languages_dialects_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#languages_dialects_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#languages_dialects_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/languages-dialects/edit`, `languages_dialects_form`, `Update`, `updateLanguagesDialectsTable`, `resetLanguagesDialectsForm`, `languages_dialects_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var languages_dialects_form = document.forms['languages_dialects_form'];

                    for(var i=0, languages_dialects_formLen = languages_dialects_form.length; i<languages_dialects_formLen; i++){
                        languages_dialects_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('languages_dialects_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#languages_dialects_form').trigger('reset');

                    // Set id number for hidden input id
                    $('#cesno_languages_dialects_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#languages_dialects_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#languages_dialects_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/languages-dialects/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('lang_languages_dialects')[0].value = element['lang_languages_dialects'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Languages Dialects Form

// Start of updating Ces We Table

function updateCesWeTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Ces We Table
            $("#CesWe_tbody").empty();

            if(result.CesWe == ''){

                $('#CesWe_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.CesWe.forEach(element => {
                    $('#CesWe_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCesWeForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.EligibilityAndRankTrackerEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesWeForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.EligibilityAndRankTrackerDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/ces-we/delete/'+ element['id'] +'`, `updateCesWeTable`, `resetCesWeForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['ed_ces_we'] == null) ? '-' : element['ed_ces_we']) +'</td>'+
                    '<td>'+ ((element['r_ces_we'] == null) ? '-' : element['r_ces_we']) +'</td>'+
                    '<td>'+ ((element['rd_ces_we'] == null) ? '-' : element['rd_ces_we']) +'</td>'+
                    '<td>'+ ((element['poe_ces_we'] == null) ? '-' : element['poe_ces_we']) +'</td>'+
                    '<td>'+ ((element['tn_ces_we'] == null) ? '-' : element['tn_ces_we']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Ces We Table

// Start of reseting Ces We Form

function resetCesWeForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Eligibility and Rank Tracker/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var ceswe_hr_form = document.forms['ceswe_hr_form'];

                    for(var i=0, ceswe_hr_formLen = ceswe_hr_form.length; i<ceswe_hr_formLen; i++){
                        ceswe_hr_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#ceswe_hr_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#ceswe_hr_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#ceswe_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#ceswe_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/ces-we/add`, `ceswe_hr_form`, `Add`, `updateCesWeTable`, `resetCesWeForm`, `ceswe_hr_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#ceswe_hr_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var ceswe_hr_form = document.forms['ceswe_hr_form'];

                    for(var i=0, ceswe_hr_formLen = ceswe_hr_form.length; i<ceswe_hr_formLen; i++){
                        ceswe_hr_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_ceswe_hr_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#ceswe_hr_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#ceswe_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#ceswe_hr_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#ceswe_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/ces-we/edit`, `ceswe_hr_form`, `Update`, `updateCesWeTable`, `resetCesWeForm`, `ceswe_hr_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var ceswe_hr_form = document.forms['ceswe_hr_form'];

                    for(var i=0, ceswe_hr_formLen = ceswe_hr_form.length; i<ceswe_hr_formLen; i++){
                        ceswe_hr_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('ceswe_hr_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#ceswe_hr_form').trigger('reset');

                    // Set id number for hidden input id
                    $('#cesno_ceswe_hr_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#ceswe_hr_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#ceswe_hr_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/ces-we/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('ed_ces_we')[0].value = element['ed_ces_we'];
                            document.getElementsByName('r_ces_we')[0].value = element['r_ces_we'];
                            document.getElementsByName('rd_ces_we')[0].value = element['rd_ces_we'];
                            document.getElementsByName('poe_ces_we')[0].value = element['poe_ces_we'];
                            document.getElementsByName('tn_ces_we')[0].value = element['tn_ces_we'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Ces We Form

// Start of updating Assessment Center Table

function updateAssessmentCenterTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Assessment Center Table
            $("#AssessmentCenter_tbody").empty();

            if(result.AssessmentCenter == ''){

                $('#AssessmentCenter_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );

                // Update AC no. on profile details
                $('#profile_ac_no').text('---');
            }
            else{

                result.AssessmentCenter.forEach(element => {
                    $('#AssessmentCenter_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetAssessmentCenterForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.EligibilityAndRankTrackerEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetAssessmentCenterForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.EligibilityAndRankTrackerDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/assessment-center/delete/'+ element['id'] +'`, `updateAssessmentCenterTable`, `resetAssessmentCenterForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['an_achr_ces_we'] == null) ? '-' : element['an_achr_ces_we']) +'</td>'+
                    '<td>'+ ((element['ad_achr_ces_we'] == null) ? '-' : element['ad_achr_ces_we']) +'</td>'+
                    '<td>'+ ((element['r_achr_ces_we'] == null) ? '-' : element['r_achr_ces_we']) +'</td>'+
                    '<td>'+ ((element['cfd_achr_ces_we'] == null) ? '-' : element['cfd_achr_ces_we']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );

                    // Update AC no. on profile details
                    $('#profile_ac_no').text(element['an_achr_ces_we']);
                }); 
            }
        }
    });

}

// End of updating Assessment Center Table

// Start of reseting Assessment Center Form

function resetAssessmentCenterForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Eligibility and Rank Tracker/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var assessment_center_hr_form = document.forms['assessment_center_hr_form'];

                    for(var i=0, assessment_center_hr_formLen = assessment_center_hr_form.length; i<assessment_center_hr_formLen; i++){
                        assessment_center_hr_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#assessment_center_hr_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#assessment_center_hr_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#assessment_center_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#assessment_center_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/assessment-center/add`, `assessment_center_hr_form`, `Add`, `updateAssessmentCenterTable`, `resetAssessmentCenterForm`, `assessment_center_hr_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#assessment_center_hr_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var assessment_center_hr_form = document.forms['assessment_center_hr_form'];

                    for(var i=0, assessment_center_hr_formLen = assessment_center_hr_form.length; i<assessment_center_hr_formLen; i++){
                        assessment_center_hr_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_assessment_center_hr_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#assessment_center_hr_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#assessment_center_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#assessment_center_hr_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#assessment_center_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/assessment-center/edit`, `assessment_center_hr_form`, `Update`, `updateAssessmentCenterTable`, `resetAssessmentCenterForm`, `assessment_center_hr_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var assessment_center_hr_form = document.forms['assessment_center_hr_form'];

                    for(var i=0, assessment_center_hr_formLen = assessment_center_hr_form.length; i<assessment_center_hr_formLen; i++){
                        assessment_center_hr_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('assessment_center_hr_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#assessment_center_hr_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_assessment_center_hr_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#assessment_center_hr_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#assessment_center_hr_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/assessment-center/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('an_achr_ces_we')[0].value = element['an_achr_ces_we'];
                            document.getElementsByName('ad_achr_ces_we')[0].value = element['ad_achr_ces_we'];
                            document.getElementsByName('r_achr_ces_we')[0].value = element['r_achr_ces_we'];
                            document.getElementsByName('cfd_achr_ces_we')[0].value = element['cfd_achr_ces_we'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Assessment Center Form

// Start of updating Validation Table

function updateValidationHrTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Validation Table
            $("#ValidationHr_tbody").empty();

            if(result.ValidationHr == ''){

                $('#ValidationHr_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.ValidationHr.forEach(element => {
                    $('#ValidationHr_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetValidationHrForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.EligibilityAndRankTrackerEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetValidationHrForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.EligibilityAndRankTrackerDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/validation-hr/delete/'+ element['id'] +'`, `updateValidationHrTable`, `resetValidationHrForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['vd_vhr_ces_we'] == null) ? '-' : element['vd_vhr_ces_we']) +'</td>'+
                    '<td>'+ ((element['tov_vhr_ces_we'] == null) ? '-' : element['tov_vhr_ces_we']) +'</td>'+
                    '<td>'+ ((element['r_vhr_ces_we'] == null) ? '-' : element['r_vhr_ces_we']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Validation Table

// Start of reseting Validation Form

function resetValidationHrForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Eligibility and Rank Tracker/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var validation_hr_form = document.forms['validation_hr_form'];

                    for(var i=0, validation_hr_formLen = validation_hr_form.length; i<validation_hr_formLen; i++){
                        validation_hr_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#validation_hr_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#validation_hr_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#validation_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#validation_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/validation-hr/add`, `validation_hr_form`, `Add`, `updateValidationHrTable`, `resetValidationHrForm`, `validation_hr_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#validation_hr_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var validation_hr_form = document.forms['validation_hr_form'];

                    for(var i=0, validation_hr_formLen = validation_hr_form.length; i<validation_hr_formLen; i++){
                        validation_hr_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_validation_hr_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#validation_hr_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#validation_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#validation_hr_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#validation_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/validation-hr/edit`, `validation_hr_form`, `Update`, `updateValidationHrTable`, `resetValidationHrForm`, `validation_hr_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var validation_hr_form = document.forms['validation_hr_form'];

                    for(var i=0, validation_hr_formLen = validation_hr_form.length; i<validation_hr_formLen; i++){
                        validation_hr_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('validation_hr_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#validation_hr_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_validation_hr_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#validation_hr_form_submit').val('Edit Record').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#validation_hr_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/validation-hr/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('vd_vhr_ces_we')[0].value = element['vd_vhr_ces_we'];
                            document.getElementsByName('tov_vhr_ces_we')[0].value = element['tov_vhr_ces_we'];
                            document.getElementsByName('r_vhr_ces_we')[0].value = element['r_vhr_ces_we'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Validation Form

// Start of updating Board Interview Table

function updateBoardInterviewTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Board Interview Table
            $("#BoardInterview_tbody").empty();

            if(result.BoardInterview == ''){

                $('#BoardInterview_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.BoardInterview.forEach(element => {
                    $('#BoardInterview_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetBoardInterviewForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.EligibilityAndRankTrackerEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetBoardInterviewForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.EligibilityAndRankTrackerDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/board-interview/delete/'+ element['id'] +'`, `updateBoardInterviewTable`, `resetBoardInterviewForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['bid_bi_ces_we'] == null) ? '-' : element['bid_bi_ces_we']) +'</td>'+
                    '<td>'+ ((element['r_bi_ces_we'] == null) ? '-' : element['r_bi_ces_we']) +'</td>'+                    
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Board Interview Table

// Start of reseting Board Interview Form

function resetBoardInterviewForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Eligibility and Rank Tracker/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var board_interview_hr_form = document.forms['board_interview_hr_form'];

                    for(var i=0, board_interview_hr_formLen = board_interview_hr_form.length; i<board_interview_hr_formLen; i++){
                        board_interview_hr_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#board_interview_hr_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#board_interview_hr_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#board_interview_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#board_interview_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/board-interview/add`, `board_interview_hr_form`, `Add`, `updateBoardInterviewTable`, `resetBoardInterviewForm`, `board_interview_hr_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#board_interview_hr_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var board_interview_hr_form = document.forms['board_interview_hr_form'];

                    for(var i=0, board_interview_hr_formLen = board_interview_hr_form.length; i<board_interview_hr_formLen; i++){
                        board_interview_hr_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_board_interview_hr_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#board_interview_hr_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#board_interview_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#board_interview_hr_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#board_interview_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/board-interview/edit`, `board_interview_hr_form`, `Update`, `updateBoardInterviewTable`, `resetBoardInterviewForm`, `board_interview_hr_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var board_interview_hr_form = document.forms['board_interview_hr_form'];

                    for(var i=0, board_interview_hr_formLen = board_interview_hr_form.length; i<board_interview_hr_formLen; i++){
                        board_interview_hr_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('board_interview_hr_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#board_interview_hr_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_board_interview_hr_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#board_interview_hr_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#board_interview_hr_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/board-interview/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('bid_bi_ces_we')[0].value = element['bid_bi_ces_we'];
                            document.getElementsByName('r_bi_ces_we')[0].value = element['r_bi_ces_we'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Board Interview Form

// Start of updating Ces Status Table

function updateCesStatusTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Ces Status Table
            $("#CesStatus_tbody").empty();

            if(result.CesStatus == ''){

                $('#CesStatus_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );

                // Update CES Status on profile details
                $('#profile_ces_status').text('---');
            }
            else{

                result.CesStatus.forEach(element => {
                    $('#CesStatus_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCesStatusForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.EligibilityAndRankTrackerEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesStatusForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.EligibilityAndRankTrackerDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/ces-status/delete/'+ element['id'] +'`, `updateCesStatusTable`, `resetCesStatusForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['cs_cs_ces_we'] == null) ? '-' : element['cs_cs_ces_we']) +'</td>'+
                    '<td>'+ ((element['at_cs_ces_we'] == null) ? '-' : element['at_cs_ces_we']) +'</td>'+
                    '<td>'+ ((element['st_cs_ces_we'] == null) ? '-' : element['st_cs_ces_we']) +'</td>'+
                    '<td>'+ ((element['aa_cs_ces_we'] == null) ? '-' : element['aa_cs_ces_we']) +'</td>'+
                    '<td>'+ ((element['rn_cs_ces_we'] == null) ? '-' : element['rn_cs_ces_we']) +'</td>'+
                    '<td>'+ ((element['da_cs_ces_we'] == null) ? '-' : element['da_cs_ces_we']) +'</td>'+                  
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );

                    // Update CES Status on profile details
                    $('#profile_ces_status').text(element['cs_cs_ces_we']);
                }); 
            }
        }
    });

}

// End of updating Ces Status Table

// Start of reseting Ces Status Form

function resetCesStatusForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Eligibility and Rank Tracker/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var ces_status_hr_form = document.forms['ces_status_hr_form'];

                    for(var i=0, ces_status_hr_formLen = ces_status_hr_form.length; i<ces_status_hr_formLen; i++){
                        ces_status_hr_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#ces_status_hr_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#ces_status_hr_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#ces_status_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#ces_status_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/ces-status/add`, `ces_status_hr_form`, `Add`, `updateCesStatusTable`, `resetCesStatusForm`, `ces_status_hr_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#ces_status_hr_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var ces_status_hr_form = document.forms['ces_status_hr_form'];

                    for(var i=0, ces_status_hr_formLen = ces_status_hr_form.length; i<ces_status_hr_formLen; i++){
                        ces_status_hr_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_ces_status_hr_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#ces_status_hr_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#ces_status_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#ces_status_hr_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#ces_status_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/ces-status/edit`, `ces_status_hr_form`, `Update`, `updateCesStatusTable`, `resetCesStatusForm`, `ces_status_hr_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var ces_status_hr_form = document.forms['ces_status_hr_form'];

                    for(var i=0, ces_status_hr_formLen = ces_status_hr_form.length; i<ces_status_hr_formLen; i++){
                        ces_status_hr_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('ces_status_hr_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#ces_status_hr_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_ces_status_hr_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#ces_status_hr_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#ces_status_hr_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/ces-status/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('cs_cs_ces_we')[0].value = element['cs_cs_ces_we'];
                            document.getElementsByName('at_cs_ces_we')[0].value = element['at_cs_ces_we'];
                            document.getElementsByName('st_cs_ces_we')[0].value = element['st_cs_ces_we'];
                            document.getElementsByName('aa_cs_ces_we')[0].value = element['aa_cs_ces_we'];
                            document.getElementsByName('rn_cs_ces_we')[0].value = element['rn_cs_ces_we'];
                            document.getElementsByName('da_cs_ces_we')[0].value = element['da_cs_ces_we'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Ces Status Form

// Start of updating Record of Cespes Ratings Table

function updateRecordOfCespesRatingsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Record of Cespes Ratings Table
            $("#RecordOfCespesRatings_tbody").empty();

            if(result.RecordOfCespesRatings == ''){

                $('#RecordOfCespesRatings_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.RecordOfCespesRatings.forEach(element => {
                    $('#RecordOfCespesRatings_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetRecordOfCespesRatingsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.RecordOfCespesRatingsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetRecordOfCespesRatingsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.RecordOfCespesRatingsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/record-of-cespes-ratings/delete/'+ element['id'] +'`, `updateRecordOfCespesRatingsTable`, `resetRecordOfCespesRatingsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['date_from_rocr'] == null) ? '-' : element['date_from_rocr']) +'</td>'+
                    '<td>'+ ((element['date_to_rocr'] == null) ? '-' : element['date_to_rocr']) +'</td>'+
                    '<td>'+ ((element['rating_rocr'] == null) ? '-' : element['rating_rocr']) +'</td>'+
                    '<td>'+ ((element['status_rocr'] == null) ? '-' : element['status_rocr']) +'</td>'+
                    '<td>'+ ((element['remarks_rocr'] == null) ? '-' : element['remarks_rocr']) +'</td>'+  
                    '<td>'+ '<a href="'+ rootURL +'external-storage/PDF Documents/201 Folder/CESPES Certificate of Rating/'+ element['pdf_rating_certificate_rocr'] +'">'+ element['pdf_rating_certificate_rocr'] +'</a>' +'</td>'+             
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Record of Cespes Ratings Table

// Start of reseting Record of Cespes Ratings Form

function resetRecordOfCespesRatingsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Record of CESPES Ratings/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var record_of_cespes_rating_hr_form = document.forms['record_of_cespes_rating_hr_form'];

                    for(var i=0, record_of_cespes_rating_hr_formLen = record_of_cespes_rating_hr_form.length; i<record_of_cespes_rating_hr_formLen; i++){
                        record_of_cespes_rating_hr_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#record_of_cespes_rating_hr_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#record_of_cespes_rating_hr_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#record_of_cespes_rating_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#record_of_cespes_rating_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/record-of-cespes-ratings/add`, `record_of_cespes_rating_hr_form`, `Add`, `updateRecordOfCespesRatingsTable`, `resetRecordOfCespesRatingsForm`, `record_of_cespes_rating_hr_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#record_of_cespes_rating_hr_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var record_of_cespes_rating_hr_form = document.forms['record_of_cespes_rating_hr_form'];

                    for(var i=0, record_of_cespes_rating_hr_formLen = record_of_cespes_rating_hr_form.length; i<record_of_cespes_rating_hr_formLen; i++){
                        record_of_cespes_rating_hr_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_record_of_cespes_rating_hr_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#record_of_cespes_rating_hr_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#record_of_cespes_rating_hr_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#record_of_cespes_rating_hr_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#record_of_cespes_rating_hr_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/record-of-cespes-ratings/edit`, `record_of_cespes_rating_hr_form`, `Update`, `updateRecordOfCespesRatingsTable`, `resetRecordOfCespesRatingsForm`, `record_of_cespes_rating_hr_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var record_of_cespes_rating_hr_form = document.forms['record_of_cespes_rating_hr_form'];

                    for(var i=0, record_of_cespes_rating_hr_formLen = record_of_cespes_rating_hr_form.length; i<record_of_cespes_rating_hr_formLen; i++){
                        record_of_cespes_rating_hr_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('record_of_cespes_rating_hr_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#record_of_cespes_rating_hr_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_record_of_cespes_rating_hr_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#record_of_cespes_rating_hr_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#record_of_cespes_rating_hr_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/record-of-cespes-ratings/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('date_from_rocr')[0].value = element['date_from_rocr'];
                            document.getElementsByName('date_to_rocr')[0].value = element['date_to_rocr'];
                            document.getElementsByName('rating_rocr')[0].value = element['rating_rocr'];
                            document.getElementsByName('status_rocr')[0].value = element['status_rocr'];
                            document.getElementsByName('remarks_rocr')[0].value = element['remarks_rocr'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Record of Cespes Ratings Form

// Start of updating Work Experience Table

function updateWorkExperienceTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Work Experience Table
            $("#WorkExperience_tbody").empty();

            if(result.WorkExperience == ''){

                $('#WorkExperience_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.WorkExperience.forEach(element => {
                    $('#WorkExperience_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetWorkExperienceForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.WorkExperienceEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetWorkExperienceForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.WorkExperienceDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/work-experience/delete/'+ element['id'] +'`, `updateWorkExperienceTable`, `resetWorkExperienceForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['date_from_work_experience'] == null) ? '-' : element['date_from_work_experience']) +'</td>'+
                    '<td>'+ ((element['date_to_work_experience'] == null) ? '-' : element['date_to_work_experience']) +'</td>'+
                    '<td>'+ ((element['destination_from_work_experience'] == null) ? '-' : element['destination_from_work_experience']) +'</td>'+
                    '<td>'+ ((element['status_from_work_experience'] == null) ? '-' : element['status_from_work_experience']) +'</td>'+
                    '<td>'+ ((element['salary_from_work_experience'] == null) ? '-' : element['salary_from_work_experience']) +'</td>'+
                    '<td>'+ ((element['salary_job_pay_grade_work_experience'] == null) ? '-' : element['salary_job_pay_grade_work_experience']) +'</td>'+
                    '<td>'+ ((element['status_of_appointment_work_experience'] == null) ? '-' : element['status_of_appointment_work_experience']) +'</td>'+
                    '<td>'+ ((element['government_service_work_experience'] == null) ? '-' : element['government_service_work_experience']) +'</td>'+
                    '<td>'+ ((element['department_from_work_experience'] == null) ? '-' : element['department_from_work_experience']) +'</td>'+
                    '<td>'+ ((element['remarks_from_work_experience'] == null) ? '-' : element['remarks_from_work_experience']) +'</td>'+             
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Work Experience Table

// Start of reseting Work Experience Form

function resetWorkExperienceForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Work Experience/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var work_experience_form = document.forms['work_experience_form'];

                    for(var i=0, work_experience_formLen = work_experience_form.length; i<work_experience_formLen; i++){
                        work_experience_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#work_experience_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#work_experience_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#work_experience_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#work_experience_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/work-experience/add`, `work_experience_form`, `Add`, `updateWorkExperienceTable`, `resetWorkExperienceForm`, `work_experience_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#work_experience_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var work_experience_form = document.forms['work_experience_form'];

                    for(var i=0, work_experience_formLen = work_experience_form.length; i<work_experience_formLen; i++){
                        work_experience_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_work_experience_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#work_experience_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#work_experience_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#work_experience_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#work_experience_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/work-experience/edit`, `work_experience_form`, `Update`, `updateWorkExperienceTable`, `resetWorkExperienceForm`, `work_experience_form_submit`, `None`, `None`)');
                
                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var work_experience_form = document.forms['work_experience_form'];

                    for(var i=0, work_experience_formLen = work_experience_form.length; i<work_experience_formLen; i++){
                        work_experience_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('work_experience_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#work_experience_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_work_experience_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#work_experience_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#work_experience_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/work-experience/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('date_from_work_experience')[0].value = element['date_from_work_experience'];
                            document.getElementsByName('date_to_work_experience')[0].value = element['date_to_work_experience'];
                            document.getElementsByName('destination_from_work_experience')[0].value = element['destination_from_work_experience'];
                            document.getElementsByName('status_from_work_experience')[0].value = element['status_from_work_experience'];
                            document.getElementsByName('salary_from_work_experience')[0].value = element['salary_from_work_experience'];
                            document.getElementsByName('salary_job_pay_grade_work_experience')[0].value = element['salary_job_pay_grade_work_experience'];
                            document.getElementsByName('status_of_appointment_work_experience')[0].value = element['status_of_appointment_work_experience'];
                            document.getElementsByName('government_service_work_experience')[0].value = element['government_service_work_experience'];
                            document.getElementsByName('department_from_work_experience')[0].value = element['department_from_work_experience'];
                            document.getElementsByName('remarks_from_work_experience')[0].value = element['remarks_from_work_experience'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Work Experience Form

// Start of updating Field Expertise Table

function updateFieldExpertiseTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Field Expertise Table
            $("#FieldExpertise_tbody").empty();

            if(result.FieldExpertise == ''){

                $('#FieldExpertise_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.FieldExpertise.forEach(element => {
                    $('#FieldExpertise_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetFieldExpertiseForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.FieldExpertiseEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetFieldExpertiseForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.FieldExpertiseDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/field-expertise/delete/'+ element['id'] +'`, `updateFieldExpertiseTable`, `resetFieldExpertiseForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['ec_field_expertise'] == null) ? '-' : element['ec_field_expertise']) +'</td>'+
                    '<td>'+ ((element['ss_field_expertise'] == null) ? '-' : element['ss_field_expertise']) +'</td>'+           
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Field Expertise Table

// Start of reseting Field Expertise Form

function resetFieldExpertiseForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Records of Field of Expertise or Specialization/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var field_expertise_form = document.forms['field_expertise_form'];

                    for(var i=0, field_expertise_formLen = field_expertise_form.length; i<field_expertise_formLen; i++){
                        field_expertise_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#field_expertise_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#field_expertise_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#field_expertise_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#field_expertise_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/field-expertise/add`, `field_expertise_form`, `Add`, `updateFieldExpertiseTable`, `resetFieldExpertiseForm`, `field_expertise_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#field_expertise_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var field_expertise_form = document.forms['field_expertise_form'];

                    for(var i=0, field_expertise_formLen = field_expertise_form.length; i<field_expertise_formLen; i++){
                        field_expertise_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_field_expertise_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#field_expertise_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#field_expertise_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#field_expertise_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#field_expertise_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/field-expertise/edit`, `field_expertise_form`, `Update`, `updateFieldExpertiseTable`, `resetFieldExpertiseForm`, `field_expertise_form_submit`, `None`, `None`)');
                
                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var field_expertise_form = document.forms['field_expertise_form'];

                    for(var i=0, field_expertise_formLen = field_expertise_form.length; i<field_expertise_formLen; i++){
                        field_expertise_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('field_expertise_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#field_expertise_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_field_expertise_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#field_expertise_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#field_expertise_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/field-expertise/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('ec_field_expertise')[0].value = element['ec_field_expertise'];
                            document.getElementsByName('ss_field_expertise')[0].value = element['ss_field_expertise'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Field Expertise Form

// Start of updating Ces Trainings Table

function updateCesTrainingsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Ces Trainings Table
            $("#CesTrainings_tbody").empty();

            if(result.CesTrainings == ''){

                $('#CesTrainings_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.CesTrainings.forEach(element => {
                    $('#CesTrainings_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCesTrainingsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.CesTrainingsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesTrainingsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.CesTrainingsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/ces-trainings/delete/'+ element['id'] +'`, `updateCesTrainingsTable`, `resetCesTrainingsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['s_title_ces_trainings'] == null) ? '-' : element['s_title_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['s_no_ces_trainings'] == null) ? '-' : element['s_no_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['training_category_ces_trainings'] == null) ? '-' : element['training_category_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['fos_ces_trainings'] == null) ? '-' : element['fos_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['venue_ces_trainings'] == null) ? '-' : element['venue_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['noh_ces_trainings'] == null) ? '-' : element['noh_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['barrio_ces_trainings'] == null) ? '-' : element['barrio_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['rs_ces_trainings'] == null) ? '-' : element['rs_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['sd_ces_trainings'] == null) ? '-' : element['sd_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['training_status_ces_trainings'] == null) ? '-' : element['training_status_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['remarks_ces_trainings'] == null) ? '-' : element['remarks_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['date_f_ces_trainings'] == null) ? '-' : element['date_f_ces_trainings']) +'</td>'+
                    '<td>'+ ((element['date_t_ces_trainings'] == null) ? '-' : element['date_t_ces_trainings']) +'</td>'+         
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Ces Trainings Table

// Start of reseting Ces Trainings Form

function resetCesTrainingsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/CES Trainings/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var ces_trainings_form = document.forms['ces_trainings_form'];

                    for(var i=0, ces_trainings_formLen = ces_trainings_form.length; i<ces_trainings_formLen; i++){
                        ces_trainings_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#ces_trainings_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#ces_trainings_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#ces_trainings_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#ces_trainings_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/ces-trainings/add`, `ces_trainings_form`, `Add`, `updateCesTrainingsTable`, `resetCesTrainingsForm`, `ces_trainings_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#ces_trainings_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var ces_trainings_form = document.forms['ces_trainings_form'];

                    for(var i=0, ces_trainings_formLen = ces_trainings_form.length; i<ces_trainings_formLen; i++){
                        ces_trainings_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_ces_trainings_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#ces_trainings_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#ces_trainings_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#ces_trainings_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#ces_trainings_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/ces-trainings/edit`, `ces_trainings_form`, `Update`, `updateCesTrainingsTable`, `resetCesTrainingsForm`, `ces_trainings_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var ces_trainings_form = document.forms['ces_trainings_form'];

                    for(var i=0, ces_trainings_formLen = ces_trainings_form.length; i<ces_trainings_formLen; i++){
                        ces_trainings_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('ces_trainings_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#ces_trainings_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_ces_trainings_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#ces_trainings_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#ces_trainings_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/ces-trainings/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('date_f_ces_trainings')[0].value = element['date_f_ces_trainings'];
                            document.getElementsByName('date_t_ces_trainings')[0].value = element['date_t_ces_trainings'];
                            document.getElementsByName('s_title_ces_trainings')[0].value = element['s_title_ces_trainings'];
                            document.getElementsByName('s_no_ces_trainings')[0].value = element['s_no_ces_trainings'];
                            document.getElementsByName('training_category_ces_trainings')[0].value = element['training_category_ces_trainings'];
                            document.getElementsByName('fos_ces_trainings')[0].value = element['fos_ces_trainings'];
                            document.getElementsByName('venue_ces_trainings')[0].value = element['venue_ces_trainings'];
                            document.getElementsByName('noh_ces_trainings')[0].value = element['noh_ces_trainings'];
                            document.getElementsByName('barrio_ces_trainings')[0].value = element['barrio_ces_trainings'];
                            document.getElementsByName('rs_ces_trainings')[0].value = element['rs_ces_trainings'];
                            document.getElementsByName('sd_ces_trainings')[0].value = element['sd_ces_trainings'];
                            document.getElementsByName('training_status_ces_trainings')[0].value = element['training_status_ces_trainings'];
                            document.getElementsByName('remarks_ces_trainings')[0].value = element['remarks_ces_trainings'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Ces Trainings Form

// Start of updating Other Trainings Table

function updateOtherManagementTrainingsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Other Trainings Table
            $("#OtherManagementTrainings_tbody").empty();

            if(result.OtherManagementTrainings == ''){

                $('#OtherManagementTrainings_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.OtherManagementTrainings.forEach(element => {
                    $('#OtherManagementTrainings_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetOtherManagementTrainingsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.OtherManagementTrainingsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetOtherManagementTrainingsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.OtherManagementTrainingsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/other-management-trainings/delete/'+ element['id'] +'`, `updateOtherManagementTrainingsTable`, `resetOtherManagementTrainingsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['date_f_onat'] == null) ? '-' : element['date_f_onat']) +'</td>'+
                    '<td>'+ ((element['date_t_onat'] == null) ? '-' : element['date_t_onat']) +'</td>'+
                    '<td>'+ ((element['title_traning_onat'] == null) ? '-' : element['title_traning_onat']) +'</td>'+
                    '<td>'+ ((element['training_category_onat'] == null) ? '-' : element['training_category_onat']) +'</td>'+
                    '<td>'+ ((element['expertise_fos_onat'] == null) ? '-' : element['expertise_fos_onat']) +'</td>'+
                    '<td>'+ ((element['sponsor_tp_onat'] == null) ? '-' : element['sponsor_tp_onat']) +'</td>'+
                    '<td>'+ ((element['vanue_onat'] == null) ? '-' : element['vanue_onat']) +'</td>'+
                    '<td>'+ ((element['no_training_hours_omt'] == null) ? '-' : element['no_training_hours_omt']) +'</td>'+       
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Other Trainings Table

// Start of reseting Other Trainings Form

function resetOtherManagementTrainingsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Other Non-CES Accredited Trainings/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var other_management_trainings_form = document.forms['other_management_trainings_form'];

                    for(var i=0, other_management_trainings_formLen = other_management_trainings_form.length; i<other_management_trainings_formLen; i++){
                        other_management_trainings_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#other_management_trainings_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#other_management_trainings_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#other_management_trainings_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#other_management_trainings_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/other-management-trainings/add`, `other_management_trainings_form`, `Add`, `updateOtherManagementTrainingsTable`, `resetOtherManagementTrainingsForm`, `other_management_trainings_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#other_management_trainings_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var other_management_trainings_form = document.forms['other_management_trainings_form'];

                    for(var i=0, other_management_trainings_formLen = other_management_trainings_form.length; i<other_management_trainings_formLen; i++){
                        other_management_trainings_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_other_management_trainings_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#other_management_trainings_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#other_management_trainings_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#other_management_trainings_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#other_management_trainings_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/other-management-trainings/edit`, `other_management_trainings_form`, `Update`, `updateOtherManagementTrainingsTable`, `resetOtherManagementTrainingsForm`, `other_management_trainings_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var other_management_trainings_form = document.forms['other_management_trainings_form'];

                    for(var i=0, other_management_trainings_formLen = other_management_trainings_form.length; i<other_management_trainings_formLen; i++){
                        other_management_trainings_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('other_management_trainings_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#other_management_trainings_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_other_management_trainings_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#other_management_trainings_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#other_management_trainings_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/other-management-trainings/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('date_f_onat')[0].value = element['date_f_onat'];
                            document.getElementsByName('date_t_onat')[0].value = element['date_t_onat'];
                            document.getElementsByName('title_traning_onat')[0].value = element['title_traning_onat'];
                            document.getElementsByName('training_category_onat')[0].value = element['training_category_onat'];
                            document.getElementsByName('expertise_fos_onat')[0].value = element['expertise_fos_onat'];
                            document.getElementsByName('sponsor_tp_onat')[0].value = element['sponsor_tp_onat'];
                            document.getElementsByName('vanue_onat')[0].value = element['vanue_onat'];
                            document.getElementsByName('no_training_hours_omt')[0].value = element['no_training_hours_omt'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Other Trainings Form

// Start of updating Research And Studies Table

function updateResearchAndStudiesTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Research And Studies Table
            $("#ResearchAndStudies_tbody").empty();

            if(result.ResearchAndStudies == ''){

                $('#ResearchAndStudies_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.ResearchAndStudies.forEach(element => {
                    $('#ResearchAndStudies_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetResearchAndStudiesForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.ResearchAndStudiesEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetResearchAndStudiesForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.ResearchAndStudiesDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/research-and-studies/delete/'+ element['id'] +'`, `updateResearchAndStudiesTable`, `resetResearchAndStudiesForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['date_f_ras'] == null) ? '-' : element['date_f_ras']) +'</td>'+
                    '<td>'+ ((element['date_t_ras'] == null) ? '-' : element['date_t_ras']) +'</td>'+
                    '<td>'+ ((element['title_ras'] == null) ? '-' : element['title_ras']) +'</td>'+
                    '<td>'+ ((element['publisher_ras'] == null) ? '-' : element['publisher_ras']) +'</td>'+   
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Research And Studies Table

// Start of reseting Research And Studies Form

function resetResearchAndStudiesForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Research and Studies/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var research_and_studies_form = document.forms['research_and_studies_form'];

                    for(var i=0, research_and_studies_formLen = research_and_studies_form.length; i<research_and_studies_formLen; i++){
                        research_and_studies_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#research_and_studies_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#research_and_studies_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#research_and_studies_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#research_and_studies_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/research-and-studies/add`, `research_and_studies_form`, `Add`, `updateResearchAndStudiesTable`, `resetResearchAndStudiesForm`, `research_and_studies_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#research_and_studies_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var research_and_studies_form = document.forms['research_and_studies_form'];

                    for(var i=0, research_and_studies_formLen = research_and_studies_form.length; i<research_and_studies_formLen; i++){
                        research_and_studies_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_research_and_studies_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#research_and_studies_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#research_and_studies_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#research_and_studies_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#research_and_studies_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/research-and-studies/edit`, `research_and_studies_form`, `Update`, `updateResearchAndStudiesTable`, `resetResearchAndStudiesForm`, `research_and_studies_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var research_and_studies_form = document.forms['research_and_studies_form'];

                    for(var i=0, research_and_studies_formLen = research_and_studies_form.length; i<research_and_studies_formLen; i++){
                        research_and_studies_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('research_and_studies_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#research_and_studies_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_research_and_studies_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#research_and_studies_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#research_and_studies_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/research-and-studies/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('date_f_ras')[0].value = element['date_f_ras'];
                            document.getElementsByName('date_t_ras')[0].value = element['date_t_ras'];
                            document.getElementsByName('title_ras')[0].value = element['title_ras'];
                            document.getElementsByName('publisher_ras')[0].value = element['publisher_ras'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Research And Studies Form

// Start of updating Scholarships Table

function updateScholarshipsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Scholarships Table
            $("#Scholarships_tbody").empty();

            if(result.Scholarships == ''){

                $('#Scholarships_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.Scholarships.forEach(element => {
                    $('#Scholarships_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetScholarshipsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.ScholarshipsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetScholarshipsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.ScholarshipsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/scholarships/delete/'+ element['id'] +'`, `updateScholarshipsTable`, `resetScholarshipsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['date_f_scholarships'] == null) ? '-' : element['date_f_scholarships']) +'</td>'+
                    '<td>'+ ((element['date_t_scholarships'] == null) ? '-' : element['date_t_scholarships']) +'</td>'+
                    '<td>'+ ((element['scholar_type_scholarships'] == null) ? '-' : element['scholar_type_scholarships']) +'</td>'+
                    '<td>'+ ((element['title_scholarships'] == null) ? '-' : element['title_scholarships']) +'</td>'+
                    '<td>'+ ((element['sponsor_scholarships'] == null) ? '-' : element['sponsor_scholarships']) +'</td>'+  
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Scholarships Table

// Start of reseting Scholarships Form

function resetScholarshipsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Scholarships Received/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var scholarships_form = document.forms['scholarships_form'];

                    for(var i=0, scholarships_formLen = scholarships_form.length; i<scholarships_formLen; i++){
                        scholarships_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#scholarships_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#scholarships_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#scholarships_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#scholarships_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/scholarships/add`, `scholarships_form`, `Add`, `updateScholarshipsTable`, `resetScholarshipsForm`, `scholarships_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#scholarships_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var scholarships_form = document.forms['scholarships_form'];

                    for(var i=0, scholarships_formLen = scholarships_form.length; i<scholarships_formLen; i++){
                        scholarships_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_scholarships_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#scholarships_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#scholarships_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#scholarships_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#scholarships_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/scholarships/edit`, `scholarships_form`, `Update`, `updateScholarshipsTable`, `resetScholarshipsForm`, `scholarships_form_submit`, `None`, `None`)');
                
                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var scholarships_form = document.forms['scholarships_form'];

                    for(var i=0, scholarships_formLen = scholarships_form.length; i<scholarships_formLen; i++){
                        scholarships_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('scholarships_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#scholarships_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_scholarships_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#scholarships_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#scholarships_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/scholarships/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('date_f_scholarships')[0].value = element['date_f_scholarships'];
                            document.getElementsByName('date_t_scholarships')[0].value = element['date_t_scholarships'];
                            document.getElementsByName('scholar_type_scholarships')[0].value = element['scholar_type_scholarships'];
                            document.getElementsByName('title_scholarships')[0].value = element['title_scholarships'];
                            document.getElementsByName('sponsor_scholarships')[0].value = element['sponsor_scholarships'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Scholarships Form

// Start of updating Major Civic and Professional Affiliations Table

function updateAffiliationsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Major Civic and Professional Affiliations Table
            $("#Affiliations_tbody").empty();

            if(result.Affiliations == ''){

                $('#Affiliations_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.Affiliations.forEach(element => {
                    $('#Affiliations_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetAffiliationsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.AffiliationsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetAffiliationsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.AffiliationsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/major-civic-and-professional-affiliations/delete/'+ element['id'] +'`, `updateAffiliationsTable`, `resetAffiliationsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['date_f_mcapa'] == null) ? '-' : element['date_f_mcapa']) +'</td>'+
                    '<td>'+ ((element['date_t_mcapa'] == null) ? '-' : element['date_t_mcapa']) +'</td>'+
                    '<td>'+ ((element['organization_mcapa'] == null) ? '-' : element['organization_mcapa']) +'</td>'+
                    '<td>'+ ((element['position_mcapa'] == null) ? '-' : element['position_mcapa']) +'</td>'+  
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Major Civic and Professional Affiliations Table

// Start of reseting Major Civic and Professional Affiliations Form

function resetAffiliationsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Major Civic and Professional Affiliations/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var major_civic_and_professional_affiliations_form = document.forms['major_civic_and_professional_affiliations_form'];

                    for(var i=0, major_civic_and_professional_affiliations_formLen = major_civic_and_professional_affiliations_form.length; i<major_civic_and_professional_affiliations_formLen; i++){
                        major_civic_and_professional_affiliations_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#major_civic_and_professional_affiliations_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#major_civic_and_professional_affiliations_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#major_civic_and_professional_affiliations_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#major_civic_and_professional_affiliations_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/major-civic-and-professional-affiliations/add`, `major_civic_and_professional_affiliations_form`, `Add`, `updateAffiliationsTable`, `resetAffiliationsForm`, `major_civic_and_professional_affiliations_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#major_civic_and_professional_affiliations_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var major_civic_and_professional_affiliations_form = document.forms['major_civic_and_professional_affiliations_form'];

                    for(var i=0, major_civic_and_professional_affiliations_formLen = major_civic_and_professional_affiliations_form.length; i<major_civic_and_professional_affiliations_formLen; i++){
                        major_civic_and_professional_affiliations_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_major_civic_and_professional_affiliations_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#major_civic_and_professional_affiliations_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#major_civic_and_professional_affiliations_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#major_civic_and_professional_affiliations_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#major_civic_and_professional_affiliations_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/major-civic-and-professional-affiliations/edit`, `major_civic_and_professional_affiliations_form`, `Update`, `updateAffiliationsTable`, `resetAffiliationsForm`, `major_civic_and_professional_affiliations_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var major_civic_and_professional_affiliations_form = document.forms['major_civic_and_professional_affiliations_form'];

                    for(var i=0, major_civic_and_professional_affiliations_formLen = major_civic_and_professional_affiliations_form.length; i<major_civic_and_professional_affiliations_formLen; i++){
                        major_civic_and_professional_affiliations_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('major_civic_and_professional_affiliations_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#major_civic_and_professional_affiliations_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_major_civic_and_professional_affiliations_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#major_civic_and_professional_affiliations_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#major_civic_and_professional_affiliations_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/major-civic-and-professional-affiliations/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('date_f_mcapa')[0].value = element['date_f_mcapa'];
                            document.getElementsByName('date_t_mcapa')[0].value = element['date_t_mcapa'];
                            document.getElementsByName('organization_mcapa')[0].value = element['organization_mcapa'];
                            document.getElementsByName('position_mcapa')[0].value = element['position_mcapa'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Major Civic and Professional Affiliations Form

// Start of updating Award And Citations Table

function updateAwardAndCitationsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Award And Citations Table
            $("#AwardAndCitations_tbody").empty();

            if(result.AwardAndCitations == ''){

                $('#AwardAndCitations_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.AwardAndCitations.forEach(element => {
                    $('#AwardAndCitations_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetAwardAndCitationsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.AwardAndCitationsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetAwardAndCitationsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.AwardAndCitationsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/award-and-citations/delete/'+ element['id'] +'`, `updateAwardAndCitationsTable`, `resetAwardAndCitationsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['date_aac'] == null) ? '-' : element['date_aac']) +'</td>'+
                    '<td>'+ ((element['title_of_award_aac'] == null) ? '-' : element['title_of_award_aac']) +'</td>'+
                    '<td>'+ ((element['sponsor_aac'] == null) ? '-' : element['sponsor_aac']) +'</td>'+  
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Award And Citations Table

// Start of reseting Award And Citations Form

function resetAwardAndCitationsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Awards and Citations Received/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var award_and_citations_form = document.forms['award_and_citations_form'];

                    for(var i=0, award_and_citations_formLen = award_and_citations_form.length; i<award_and_citations_formLen; i++){
                        award_and_citations_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#award_and_citations_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#award_and_citations_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#award_and_citations_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#award_and_citations_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/award-and-citations/add`, `award_and_citations_form`, `Add`, `updateAwardAndCitationsTable`, `resetAwardAndCitationsForm`, `award_and_citations_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#award_and_citations_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var award_and_citations_form = document.forms['award_and_citations_form'];

                    for(var i=0, award_and_citations_formLen = award_and_citations_form.length; i<award_and_citations_formLen; i++){
                        award_and_citations_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_award_and_citations_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#award_and_citations_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#award_and_citations_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#award_and_citations_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#award_and_citations_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/award-and-citations/edit`, `award_and_citations_form`, `Update`, `updateAwardAndCitationsTable`, `resetAwardAndCitationsForm`, `award_and_citations_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var award_and_citations_form = document.forms['award_and_citations_form'];

                    for(var i=0, award_and_citations_formLen = award_and_citations_form.length; i<award_and_citations_formLen; i++){
                        award_and_citations_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('award_and_citations_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#award_and_citations_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_award_and_citations_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#award_and_citations_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#award_and_citations_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/award-and-citations/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('date_aac')[0].value = element['date_aac'];
                            document.getElementsByName('title_of_award_aac')[0].value = element['title_of_award_aac'];
                            document.getElementsByName('sponsor_aac')[0].value = element['sponsor_aac'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Award And Citations Form

// Start of updating Case Records Table

function updateCaseRecordsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Case Records Table
            $("#CaseRecords_tbody").empty();

            if(result.CaseRecords == ''){

                $('#CaseRecords_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.CaseRecords.forEach(element => {
                    $('#CaseRecords_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCaseRecordsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.CaseRecordsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCaseRecordsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.CaseRecordsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/case-records/delete/'+ element['id'] +'`, `updateCaseRecordsTable`, `resetCaseRecordsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['parties_case_records'] == null) ? '-' : element['parties_case_records']) +'</td>'+
                    '<td>'+ ((element['offence_case_records'] == null) ? '-' : element['offence_case_records']) +'</td>'+
                    '<td>'+ ((element['nature_case_records'] == null) ? '-' : element['nature_case_records']) +'</td>'+
                    '<td>'+ ((element['case_no_case_records'] == null) ? '-' : element['case_no_case_records']) +'</td>'+
                    '<td>'+ ((element['date_field_case_records'] == null) ? '-' : element['date_field_case_records']) +'</td>'+
                    '<td>'+ ((element['vanue_case_records'] == null) ? '-' : element['vanue_case_records']) +'</td>'+
                    '<td>'+ ((element['status_case_records'] == null) ? '-' : element['status_case_records']) +'</td>'+
                    '<td>'+ ((element['dof_case_records'] == null) ? '-' : element['dof_case_records']) +'</td>'+
                    '<td>'+ ((element['decision_case_records'] == null) ? '-' : element['decision_case_records']) +'</td>'+
                    '<td>'+ ((element['remarks_case_records'] == null) ? '-' : element['remarks_case_records']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Case Records Table

// Start of reseting Case Records Form

function resetCaseRecordsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Case Records/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var case_records_form = document.forms['case_records_form'];

                    for(var i=0, case_records_formLen = case_records_form.length; i<case_records_formLen; i++){
                        case_records_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#case_records_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#case_records_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#case_records_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#case_records_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/case-records/add`, `case_records_form`, `Add`, `updateCaseRecordsTable`, `resetCaseRecordsForm`, `case_records_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#case_records_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var case_records_form = document.forms['case_records_form'];

                    for(var i=0, case_records_formLen = case_records_form.length; i<case_records_formLen; i++){
                        case_records_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_case_records_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#case_records_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#case_records_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#case_records_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#case_records_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/case-records/edit`, `case_records_form`, `Update`, `updateCaseRecordsTable`, `resetCaseRecordsForm`, `case_records_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var case_records_form = document.forms['case_records_form'];

                    for(var i=0, case_records_formLen = case_records_form.length; i<case_records_formLen; i++){
                        case_records_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('case_records_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#case_records_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_case_records_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#case_records_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Hide Go Back to Add Record button
                    $('#case_records_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/case-records/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('parties_case_records')[0].value = element['parties_case_records'];
                            document.getElementsByName('offence_case_records')[0].value = element['offence_case_records'];
                            document.getElementsByName('nature_case_records')[0].value = element['nature_case_records'];
                            document.getElementsByName('case_no_case_records')[0].value = element['case_no_case_records'];
                            document.getElementsByName('date_field_case_records')[0].value = element['date_field_case_records'];
                            document.getElementsByName('vanue_case_records')[0].value = element['vanue_case_records'];
                            document.getElementsByName('status_case_records')[0].value = element['status_case_records'];
                            document.getElementsByName('dof_case_records')[0].value = element['dof_case_records'];
                            document.getElementsByName('decision_case_records')[0].value = element['decision_case_records'];
                            document.getElementsByName('remarks_case_records')[0].value = element['remarks_case_records'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Case Records Form

// Start of updating Health Records - Magna Carta Table

function updateHealthRecordsTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Health Records - Magna Carta Table
            $("#HealthRecords_tbody").empty();

            if(result.HealthRecords == ''){

                $('#HealthRecords_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.HealthRecords.forEach(element => {
                    $('#HealthRecords_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetHealthRecordsForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.HealthRecordsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetHealthRecordsForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.HealthRecordsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/health-records/delete/'+ element['id'] +'`, `updateHealthRecordsTable`, `resetHealthRecordsForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td>'+ ((element['mcfdpra_hr'] == null) ? '-' : element['mcfdpra_hr']) +'</td>'+
                    '<td>'+ ((element['blood_type_hr'] == null) ? '-' : element['blood_type_hr']) +'</td>'+
                    '<td>'+ ((element['identify_marks_hr'] == null) ? '-' : element['identify_marks_hr']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Health Records - Magna Carta Table

// Start of reseting Health Records - Magna Carta Form

function resetHealthRecordsForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Health Record/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var health_records_magna_carta_for_disabled_persons_form = document.forms['health_records_magna_carta_for_disabled_persons_form'];

                    for(var i=0, health_records_magna_carta_for_disabled_persons_formLen = health_records_magna_carta_for_disabled_persons_form.length; i<health_records_magna_carta_for_disabled_persons_formLen; i++){
                        health_records_magna_carta_for_disabled_persons_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#health_records_magna_carta_for_disabled_persons_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#health_records_magna_carta_for_disabled_persons_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#health_records_magna_carta_for_disabled_persons_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#health_records_magna_carta_for_disabled_persons_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/health-records/add`, `health_records_magna_carta_for_disabled_persons_form`, `Add`, `updateHealthRecordsTable`, `resetHealthRecordsForm`, `health_records_magna_carta_for_disabled_persons_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#health_records_magna_carta_for_disabled_persons_form_submit').attr('class', 'btn btn-primary mb-1');

                    // Disable select option
                    $('#dhdTxtB').attr('disabled', 'disabled');

                    // Uncheck check box
                    $('#dhdCheckB').removeAttr('checked');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var health_records_magna_carta_for_disabled_persons_form = document.forms['health_records_magna_carta_for_disabled_persons_form'];

                    for(var i=0, health_records_magna_carta_for_disabled_persons_formLen = health_records_magna_carta_for_disabled_persons_form.length; i<health_records_magna_carta_for_disabled_persons_formLen; i++){
                        health_records_magna_carta_for_disabled_persons_form.elements[i].disabled = false;
                    }

                    // Disable "If (Magna Carta for Disabled Persons RA 7277)" drop down list if not checked
                    $('#dhdTxtB').attr('disabled','disabled');

                    // Set or remove "Disabled" attribute in "If (Magna Carta for Disabled Persons RA 7277)" dropdown list
                    $('#dhdCheckB').click(function(){
                        
                        if($('#dhdCheckB').is(':checked')){

                            $('#dhdTxtB').removeAttr('disabled');
                        }
                        else{

                            $('#dhdTxtB').attr('disabled','disabled');
                        }

                    });
                    
                    // Put checked on If (Magna Carta for Disabled Persons RA 7277) if there was selected item
                    if($('#dhdTxtB option:selected').val() != ''){
                        $('#dhdCheckB').attr('checked', 'checked');
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_health_records_magna_carta_for_disabled_persons_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#health_records_magna_carta_for_disabled_persons_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#health_records_magna_carta_for_disabled_persons_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#health_records_magna_carta_for_disabled_persons_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#health_records_magna_carta_for_disabled_persons_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/health-records/edit`, `health_records_magna_carta_for_disabled_persons_form`, `Update`, `updateHealthRecordsTable`, `resetHealthRecordsForm`, `health_records_magna_carta_for_disabled_persons_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var health_records_magna_carta_for_disabled_persons_form = document.forms['health_records_magna_carta_for_disabled_persons_form'];

                    for(var i=0, health_records_magna_carta_for_disabled_persons_formLen = health_records_magna_carta_for_disabled_persons_form.length; i<health_records_magna_carta_for_disabled_persons_formLen; i++){
                        health_records_magna_carta_for_disabled_persons_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('health_records_magna_carta_for_disabled_persons_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#health_records_magna_carta_for_disabled_persons_form').trigger('reset');

                    // Disable select option
                    $('#dhdTxtB').attr('disabled', 'disabled');

                    // Uncheck check box
                    $('#dhdCheckB').removeAttr('checked');
                
                    // Set id number for hidden input id
                    $('#cesno_health_records_magna_carta_for_disabled_persons_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#health_records_magna_carta_for_disabled_persons_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#health_records_magna_carta_for_disabled_persons_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/health-records/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('mcfdpra_hr')[0].value = element['mcfdpra_hr'];
                            document.getElementsByName('blood_type_hr')[0].value = element['blood_type_hr'];
                            document.getElementsByName('identify_marks_hr')[0].value = element['identify_marks_hr'];

                            ((element['mcfdpra_hr'] == null) ? $('#dhdTxtB').attr('disabled', 'disabled') : $('#dhdTxtB').removeAttr('disabled') + $('#dhdCheckB').attr('checked', 'checked'));
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Health Records - Magna Carta Form

// Start of updating Health Records - Historical Record of Medical Condition Table

function updateHistoricalRecordOfMedicalConditionTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty Health Records - Historical Record of Medical Condition Table
            $("#HistoricalRecordOfMedicalCondition_tbody").empty();

            if(result.HistoricalRecordOfMedicalCondition == ''){

                $('#HistoricalRecordOfMedicalCondition_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.HistoricalRecordOfMedicalCondition.forEach(element => {
                    $('#HistoricalRecordOfMedicalCondition_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetHistoricalRecordOfMedicalConditionForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.HealthRecordsEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetHistoricalRecordOfMedicalConditionForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.HealthRecordsDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/historical-record-of-medical-condition/delete/'+ element['id'] +'`, `updateHistoricalRecordOfMedicalConditionTable`, `resetHistoricalRecordOfMedicalConditionForm`, `None`, `None`)">Delete</a>' : '')+
                    '</td>'+
                    '<td>'+ ((element['date_hronc'] == null) ? '-' : element['date_hronc']) +'</td>'+
                    '<td>'+ ((element['mci_hronc'] == null) ? '-' : element['mci_hronc']) +'</td>'+
                    '<td>'+ ((element['notes_hronc'] == null) ? '-' : element['notes_hronc']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at'])).toLocaleString() +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Health Records - Historical Record of Medical Condition Table

// Start of reseting Health Records - Historical Record of Medical Condition Form

function resetHistoricalRecordOfMedicalConditionForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Health Record/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var health_records_historical_record_of_medical_condition_form = document.forms['health_records_historical_record_of_medical_condition_form'];

                    for(var i=0, health_records_historical_record_of_medical_condition_formLen = health_records_historical_record_of_medical_condition_form.length; i<health_records_historical_record_of_medical_condition_formLen; i++){
                        health_records_historical_record_of_medical_condition_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#health_records_historical_record_of_medical_condition_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#health_records_historical_record_of_medical_condition_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#health_records_historical_record_of_medical_condition_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#health_records_historical_record_of_medical_condition_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/historical-record-of-medical-condition/add`, `health_records_historical_record_of_medical_condition_form`, `Add`, `updateHistoricalRecordOfMedicalConditionTable`, `resetHistoricalRecordOfMedicalConditionForm`, `health_records_historical_record_of_medical_condition_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#health_records_historical_record_of_medical_condition_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var health_records_historical_record_of_medical_condition_form = document.forms['health_records_historical_record_of_medical_condition_form'];

                    for(var i=0, health_records_historical_record_of_medical_condition_formLen = health_records_historical_record_of_medical_condition_form.length; i<health_records_historical_record_of_medical_condition_formLen; i++){
                        health_records_historical_record_of_medical_condition_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_health_records_historical_record_of_medical_condition_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#health_records_historical_record_of_medical_condition_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#health_records_historical_record_of_medical_condition_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#health_records_historical_record_of_medical_condition_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#health_records_historical_record_of_medical_condition_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/historical-record-of-medical-condition/edit`, `health_records_historical_record_of_medical_condition_form`, `Update`, `updateHistoricalRecordOfMedicalConditionTable`, `resetHistoricalRecordOfMedicalConditionForm`, `health_records_historical_record_of_medical_condition_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var health_records_historical_record_of_medical_condition_form = document.forms['health_records_historical_record_of_medical_condition_form'];

                    for(var i=0, health_records_historical_record_of_medical_condition_formLen = health_records_historical_record_of_medical_condition_form.length; i<health_records_historical_record_of_medical_condition_formLen; i++){
                        health_records_historical_record_of_medical_condition_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('health_records_historical_record_of_medical_condition_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#health_records_historical_record_of_medical_condition_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_health_records_historical_record_of_medical_condition_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#health_records_historical_record_of_medical_condition_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#health_records_historical_record_of_medical_condition_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/historical-record-of-medical-condition/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('date_hronc')[0].value = element['date_hronc'];
                            document.getElementsByName('mci_hronc')[0].value = element['mci_hronc'];
                            document.getElementsByName('notes_hronc')[0].value = element['notes_hronc'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting Health Records - Historical Record of Medical Condition Form

// Start of updating PDF files Table

function updatePdfFilesTable(){

    $.ajax({
        url: rootURL + 'api/v1/201-profile/record/' + cesno,
        success: function (result) {

            // Empty PDF files Table
            $("#PDFFiles_tbody").empty();

            if(result.PdfLinks == ''){

                $('#PDFFiles_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.PdfLinks.forEach(element => {
                    $('#PDFFiles_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetPdfFilesForm('+ element['id'] +',`View`)">View</a>'+
                        ((result.PdfLinksEdit == 'true') ? '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetPdfFilesForm('+ element['id'] +',`Edit`)">Edit</a>' : '') +
                        ((result.PdfLinksDelete == 'true') ? '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/pdf-files/delete/'+ element['id'] +'`, `updatePdfFilesTable`, `resetPdfFilesForm`, `None`, `None`)">Delete</a>' : '') +
                    '</td>'+
                    '<td nowrap="nowrap">'+ ((element['relevant_path_pdf_files'] == null) ? '-' : element['relevant_path_pdf_files']) +'</td>'+
                    '<td>'+ '<a href="'+ rootURL +'external-storage/'+ (((element['relevant_path_pdf_files'] == null) && (element['pdflink'] != null)) ? 'PDF Documents/201 Folder/' : element['relevant_path_pdf_files']) + element['pdflink'] +'">'+ element['pdflink'] +'</a>' +'</td>'+
                    '<td>'+ ((element['validated'] == null) ? '-' : element['validated']) +'</td>'+
                    '<td>'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at']).toLocaleDateString()) +'</td>'+
                    '<td>'+ ((element['remarks_pdf_files'] == null) ? '-' : element['remarks_pdf_files']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at']).toLocaleString()) +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating PDF files Table

// Start of reseting PDF files Form

function resetPdfFilesForm(id, option){

    $.ajax({
        url: rootURL + 'api/v1/role-access/validate-user-executive-201-role-access/Attached PDF Files/Add',
        success: function (validation) {

            if(id == null){

                if(validation == 'true'){

                    // Remove disabled attribute in all elements from form
                    var pdf_files_form = document.forms['pdf_files_form'];

                    for(var i=0, pdf_files_formLen = pdf_files_form.length; i<pdf_files_formLen; i++){
                        pdf_files_form.elements[i].disabled = false;
                    }
                
                    // Reset form
                    $('#pdf_files_form').trigger('reset');

                    // Set submit button name to Add Record and remove hidden and disabled attribute
                    $('#pdf_files_form_submit').val('Add Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#pdf_files_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set onsubmit attribute on form tag to add mode
                    $('#pdf_files_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/pdf-files/add`, `pdf_files_form`, `Add`, `updatePdfFilesTable`, `resetPdfFilesForm`, `pdf_files_form_submit`, `None`, `None`)');

                    // Set submit button button color to primary
                    $('#pdf_files_form_submit').attr('class', 'btn btn-primary mb-1');

                }
            }
            else{

                Swal.fire({
                    title: 'Populating Data...',
                    text: 'Please wait for server response',
                    imageUrl: rootURL + 'images/preloader.gif',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                if(option == 'Edit'){

                    // Remove disabled attribute in all elements from form
                    var pdf_files_form = document.forms['pdf_files_form'];

                    for(var i=0, pdf_files_formLen = pdf_files_form.length; i<pdf_files_formLen; i++){
                        pdf_files_form.elements[i].disabled = false;
                    }
                
                    // Set id number for hidden input id
                    $('#cesno_pdf_files_id').val(id);

                    // Set submit button name to Edit Record and remove hidden and disabled attribute
                    $('#pdf_files_form_submit').val('Edit Record').removeAttr('hidden disabled');

                    // Hide Go Back to Add Record button
                    $('#pdf_files_form_go_back_to_add_record_button').attr('hidden','hidden');

                    // Set submit button button color to secondary
                    $('#pdf_files_form_submit').attr('class', 'btn btn-secondary mb-1');

                    // Set onsubmit attribute on form tag to edit mode
                    $('#pdf_files_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/pdf-files/edit`, `pdf_files_form`, `Update`, `updatePdfFilesTable`, `resetPdfFilesForm`, `pdf_files_form_submit`, `None`, `None`)');

                }
                else if(option == 'View'){

                    // Disabled all elements in form
                    var pdf_files_form = document.forms['pdf_files_form'];

                    for(var i=0, pdf_files_formLen = pdf_files_form.length; i<pdf_files_formLen; i++){
                        pdf_files_form.elements[i].disabled = true;
                    }

                    // Remove disabled attribute in Go Back to Add Record button
                    document.getElementById('pdf_files_form_go_back_to_add_record_button').disabled = false;

                    // Reset form
                    $('#pdf_files_form').trigger('reset');
                
                    // Set id number for hidden input id
                    $('#cesno_pdf_files_id').val(id);

                    // Hide and disabled Add or Edit Record button
                    $('#pdf_files_form_submit').attr({hidden: 'hidden', disabled: 'disabled'});

                    // Remove hidden attribute in Go Back to Add Record button
                    $('#pdf_files_form_go_back_to_add_record_button').removeAttr('hidden');

                }

                $.ajax({
                    url: rootURL + 'api/v1/pdf-files/record/' + id,
                    success: function (result) {

                        result.forEach(element => {

                            document.getElementsByName('validated')[0].value = element['validated'];
                            document.getElementsByName('remarks_pdf_files')[0].value = element['remarks_pdf_files'];
                        });  

                        Swal.close();    
                    }
                });
            }
        }
    });

}

// End of reseting PDF files Form

// Start of updating CES Web App General Page Table

function updateCesWebAppGeneralPageAccessTable(){

    $.ajax({
        url: rootURL + 'api/v1/role-access/record',
        success: function (result) {

            // Empty CES Web App General Page Table
            $("#CesWebAppGeneralPageAccess_tbody").empty();

            if(result.CesWebAppGeneralPageAccess == ''){

                $('#CesWebAppGeneralPageAccess_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.CesWebAppGeneralPageAccess.forEach(element => {

                    pages = '';
                    element['ces_web_app_general_page_access'].split(',').forEach(item => {

                        if(item != ''){
                            pages += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    $('#CesWebAppGeneralPageAccess_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesWebAppGeneralPageAccessForm('+ element['id'] +')">Edit</a>'+
                        '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/ces-web-app-general-page-access/delete/'+ element['id'] +'`, `updateCesWebAppGeneralPageAccessTable`, `resetCesWebAppGeneralPageAccessForm`, `None`, `None`)">Delete</a>'+
                    '</td>'+
                    '<td nowrap="nowrap">'+ ((element['role_name_ces_web_app_general_page'] == null) ? '-' : element['role_name_ces_web_app_general_page']) +'</td>'+
                    '<td nowrap="nowrap">'+ 
                        pages +
                    '</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at']).toLocaleString()) +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating CES Web App General Page Table

// Start of reseting CES Web App General Page Form

function resetCesWebAppGeneralPageAccessForm(id){

    if(id == null){
        
        // Reset form
        $('#ces_web_app_general_page_form').trigger('reset');

        // Remove disabled attribute in Rolename Dropdown list
        $('#role_name_ces_web_app_general_page').removeAttr('disabled');

        // Set submit button name to Add Record
        $('#ces_web_app_general_page_form_submit').val('Add Record');

        // Set onsubmit attribute on form tag to add mode
        $('#ces_web_app_general_page_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/ces-web-app-general-page-access/add`, `ces_web_app_general_page_form`, `Add`, `updateCesWebAppGeneralPageAccessTable`, `resetCesWebAppGeneralPageAccessForm`, `ces_web_app_general_page_form_submit`, `None`, `None`)');

        // Set submit button button color to primary
        $('#ces_web_app_general_page_form_submit').attr('class', 'btn btn-primary mb-1');
    }
    else{

        Swal.fire({
            title: 'Populating Data...',
            text: 'Please wait for server response',
            imageUrl: rootURL + 'images/preloader.gif',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        
        // Reset form
        $('#ces_web_app_general_page_form').trigger('reset');

        // Disabled Rolename Dropdown list
        $('#role_name_ces_web_app_general_page').attr('disabled','disabled');

        // Set submit button name to Edit Record
        $('#ces_web_app_general_page_form_submit').val('Edit Record');

        // Set submit button button color to secondary
        $('#ces_web_app_general_page_form_submit').attr('class', 'btn btn-secondary mb-1');

        // Set onsubmit attribute on form tag to edit mode
        $('#ces_web_app_general_page_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/ces-web-app-general-page-access/update/' + id + '`, `ces_web_app_general_page_form`, `Update`, `updateCesWebAppGeneralPageAccessTable`, `resetCesWebAppGeneralPageAccessForm`, `ces_web_app_general_page_form_submit`, `None`, `None`)');

        $.ajax({
            url: rootURL + 'api/v1/ces-web-app-general-page-access/record/' + id,
            success: function (result) {

                if(result == 'Restricted'){
    
                    Swal.fire({
                        icon: 'error',
                        title: 'Stop',
                        text: 'Sorry you are restricted to do this action please contact the administrator.',
                    });
                    
                }
                else{

                    result.forEach(element => {

                        document.getElementsByName('role_name_ces_web_app_general_page')[0].value = element['role_name_ces_web_app_general_page'];
    
                        element['ces_web_app_general_page_access'].split(',').forEach(item => {
    
                            if(item != ''){
                                if(item == 'Dashboard'){
                                    document.getElementsByName('general_page_dashboard')[0].checked = true;
                                }
                                else if(item == '201 Profiling'){
                                    document.getElementsByName('general_page_201_profiling')[0].checked = true;
                                }
                                else if(item == 'Plantilla'){
                                    document.getElementsByName('general_page_plantilla')[0].checked = true;
                                }
                                else if(item == 'Reports'){
                                    document.getElementsByName('general_page_reports')[0].checked = true;
                                }
                                else if(item == 'Rights Management'){
                                    document.getElementsByName('general_page_rights_management')[0].checked = true;
                                }
                                else if(item == 'System Utility'){
                                    document.getElementsByName('general_page_system_utility')[0].checked = true;
                                }
                            }
                            
                        });
                    });  
    
                    Swal.close();  
                }
                  
            }
        });
    }

}

// End of reseting CES Web App General Page Form

// Start of updating Executive 201 Access Table

function updateExecutive201RoleAccessTable(){

    $.ajax({
        url: rootURL + 'api/v1/role-access/record',
        success: function (result) {

            // Empty Executive 201 Access Table
            $("#Executive201RoleAccess_tbody").empty();

            if(result.Executive201RoleAccess == ''){

                $('#Executive201RoleAccess_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.Executive201RoleAccess.forEach(element => {

                    executive_201_page_access = '';
                    element['executive_201_page_access'].split(',').forEach(item => {

                        if(item != ''){
                            executive_201_page_access += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    personal_data_rights = '';
                    element['personal_data_rights'].split(',').forEach(item => {

                        if(item != ''){
                            personal_data_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    family_background_profile_rights = '';
                    element['family_background_profile_rights'].split(',').forEach(item => {

                        if(item != ''){
                            family_background_profile_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    educational_background_attainment_rights = '';
                    element['educational_background_attainment_rights'].split(',').forEach(item => {

                        if(item != ''){
                            educational_background_attainment_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    examinations_taken_rights = '';
                    element['examinations_taken_rights'].split(',').forEach(item => {

                        if(item != ''){
                            examinations_taken_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    language_dialects_rights = '';
                    element['language_dialects_rights'].split(',').forEach(item => {

                        if(item != ''){
                            language_dialects_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    eligibility_and_rank_tracker_rights = '';
                    element['eligibility_and_rank_tracker_rights'].split(',').forEach(item => {

                        if(item != ''){
                            eligibility_and_rank_tracker_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    record_of_cespes_ratings_rights = '';
                    element['record_of_cespes_ratings_rights'].split(',').forEach(item => {

                        if(item != ''){
                            record_of_cespes_ratings_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    work_experience_rights = '';
                    element['work_experience_rights'].split(',').forEach(item => {

                        if(item != ''){
                            work_experience_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    records_of_field_of_expertise_specialization_rights = '';
                    element['records_of_field_of_expertise_specialization_rights'].split(',').forEach(item => {

                        if(item != ''){
                            records_of_field_of_expertise_specialization_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    ces_trainings_rights = '';
                    element['ces_trainings_rights'].split(',').forEach(item => {

                        if(item != ''){
                            ces_trainings_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    other_non_ces_accredited_trainings_rights = '';
                    element['other_non_ces_accredited_trainings_rights'].split(',').forEach(item => {

                        if(item != ''){
                            other_non_ces_accredited_trainings_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    research_and_studies_rights = '';
                    element['research_and_studies_rights'].split(',').forEach(item => {

                        if(item != ''){
                            research_and_studies_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    scholarships_received_rights = '';
                    element['scholarships_received_rights'].split(',').forEach(item => {

                        if(item != ''){
                            scholarships_received_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    major_civic_and_professional_affiliations_rights = '';
                    element['major_civic_and_professional_affiliations_rights'].split(',').forEach(item => {

                        if(item != ''){
                            major_civic_and_professional_affiliations_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    awards_and_citations_received_rights = '';
                    element['awards_and_citations_received_rights'].split(',').forEach(item => {

                        if(item != ''){
                            awards_and_citations_received_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    case_records_rights = '';
                    element['case_records_rights'].split(',').forEach(item => {

                        if(item != ''){
                            case_records_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    health_record_rights = '';
                    element['health_record_rights'].split(',').forEach(item => {

                        if(item != ''){
                            health_record_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    attached_pdf_files_rights = '';
                    element['attached_pdf_files_rights'].split(',').forEach(item => {

                        if(item != ''){
                            attached_pdf_files_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    $('#Executive201RoleAccess_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetExecutive201RoleAccessForm('+ element['id'] +')">Edit</a>'+
                        '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/executive-201-access/delete/'+ element['id'] +'`, `updateExecutive201RoleAccessTable`, `resetExecutive201RoleAccessForm`, `None`, `None`)">Delete</a>'+
                    '</td>'+
                    '<td nowrap="nowrap">'+ ((element['role_name'] == null) ? '-' : element['role_name']) +'</td>'+
                    '<td nowrap="nowrap">'+ 
                        executive_201_page_access +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        personal_data_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        family_background_profile_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        educational_background_attainment_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        examinations_taken_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        language_dialects_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        eligibility_and_rank_tracker_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        record_of_cespes_ratings_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        work_experience_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        records_of_field_of_expertise_specialization_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        ces_trainings_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        other_non_ces_accredited_trainings_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        research_and_studies_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        scholarships_received_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        major_civic_and_professional_affiliations_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        awards_and_citations_received_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        case_records_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        health_record_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        attached_pdf_files_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at']).toLocaleString()) +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Executive 201 Access Table

// Start of reseting Executive 201 Access Form

function resetExecutive201RoleAccessForm(id){

    if(id == null){
        
        // Reset form
        $('#executive_201_form').trigger('reset');

        // Remove disabled attribute in Rolename Dropdown list
        $('#role_name').removeAttr('disabled');

        // Set submit button name to Add Record
        $('#executive_201_form_submit').val('Add Record');

        // Set onsubmit attribute on form tag to add mode
        $('#executive_201_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/executive-201-access/add`, `executive_201_form`, `Add`, `updateExecutive201RoleAccessTable`, `resetExecutive201RoleAccessForm`, `executive_201_form_submit`, `None`, `None`)');

        // Set submit button button color to primary
        $('#executive_201_form_submit').attr('class', 'btn btn-primary mb-1');
    }
    else{

        Swal.fire({
            title: 'Populating Data...',
            text: 'Please wait for server response',
            imageUrl: rootURL + 'images/preloader.gif',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        
        // Reset form
        $('#executive_201_form').trigger('reset');

        // Disabled Rolename Dropdown list
        $('#role_name').attr('disabled','disabled');

        // Set submit button name to Edit Record
        $('#executive_201_form_submit').val('Edit Record');

        // Set submit button button color to secondary
        $('#executive_201_form_submit').attr('class', 'btn btn-secondary mb-1');

        // Set onsubmit attribute on form tag to edit mode
        $('#executive_201_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/executive-201-access/update/' + id + '`, `executive_201_form`, `Update`, `updateExecutive201RoleAccessTable`, `resetExecutive201RoleAccessForm`, `executive_201_form_submit`, `None`, `None`)');

        $.ajax({
            url: rootURL + 'api/v1/executive-201-access/record/' + id,
            success: function (result) {

                if(result == 'Restricted'){
    
                    Swal.fire({
                        icon: 'error',
                        title: 'Stop',
                        text: 'Sorry you are restricted to do this action please contact the administrator.',
                    });
                    
                }
                else{

                    result.forEach(element => {

                        document.getElementsByName('role_name')[0].value = element['role_name'];

                        element['executive_201_page_access'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Personal Data'){
                                    document.getElementsByName('personal_data')[0].checked = true;
                                }
                                else if(item == 'Family Background Profile'){
                                    document.getElementsByName('family_background_profile')[0].checked = true;
                                }
                                else if(item == 'Educational Background or Attainment'){
                                    document.getElementsByName('educational_background_attainment')[0].checked = true;
                                }
                                else if(item == 'Examinations Taken'){
                                    document.getElementsByName('examinations_taken')[0].checked = true;
                                }
                                else if(item == 'Language Dialects'){
                                    document.getElementsByName('language_dialects')[0].checked = true;
                                }
                                else if(item == 'Eligibility and Rank Tracker'){
                                    document.getElementsByName('eligibility_and_rank_tracker')[0].checked = true;
                                }
                                else if(item == 'Record of CESPES Ratings'){
                                    document.getElementsByName('record_of_cespes_ratings')[0].checked = true;
                                }
                                else if(item == 'Work Experience'){
                                    document.getElementsByName('work_experience')[0].checked = true;
                                }
                                else if(item == 'Records of Field of Expertise or Specialization'){
                                    document.getElementsByName('records_of_field_of_expertise_specialization')[0].checked = true;
                                }
                                else if(item == 'CES Trainings'){
                                    document.getElementsByName('ces_trainings')[0].checked = true;
                                }
                                else if(item == 'Other Non-CES Accredited Trainings'){
                                    document.getElementsByName('other_non_ces_accredited_trainings')[0].checked = true;
                                }
                                else if(item == 'Research and Studies'){
                                    document.getElementsByName('research_and_studies')[0].checked = true;
                                }
                                else if(item == 'Scholarships Received'){
                                    document.getElementsByName('scholarships_received')[0].checked = true;
                                }
                                else if(item == 'Major Civic and Professional Affiliations'){
                                    document.getElementsByName('major_civic_and_professional_affiliations')[0].checked = true;
                                }
                                else if(item == 'Awards and Citations Received'){
                                    document.getElementsByName('awards_and_citations_received')[0].checked = true;
                                }
                                else if(item == 'Case Records'){
                                    document.getElementsByName('case_records')[0].checked = true;
                                }
                                else if(item == 'Health Record'){
                                    document.getElementsByName('health_record')[0].checked = true;
                                }
                                else if(item == 'Attached PDF Files'){
                                    document.getElementsByName('attached_pdf_files')[0].checked = true;
                                }
                                
                            }
                            
                        });

                        element['personal_data_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('personal_data_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('personal_data_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('personal_data_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('personal_data_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['family_background_profile_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('family_background_profile_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('family_background_profile_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('family_background_profile_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('family_background_profile_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['educational_background_attainment_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('educational_background_attainment_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('educational_background_attainment_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('educational_background_attainment_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('educational_background_attainment_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['examinations_taken_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('examinations_taken_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('examinations_taken_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('examinations_taken_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('examinations_taken_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['language_dialects_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('language_dialects_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('language_dialects_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('language_dialects_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('language_dialects_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['eligibility_and_rank_tracker_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('eligibility_and_rank_tracker_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('eligibility_and_rank_tracker_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('eligibility_and_rank_tracker_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('eligibility_and_rank_tracker_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['record_of_cespes_ratings_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('record_of_cespes_ratings_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('record_of_cespes_ratings_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('record_of_cespes_ratings_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('record_of_cespes_ratings_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['work_experience_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('work_experience_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('work_experience_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('work_experience_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('work_experience_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['records_of_field_of_expertise_specialization_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('records_of_field_of_expertise_specialization_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('records_of_field_of_expertise_specialization_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('records_of_field_of_expertise_specialization_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('records_of_field_of_expertise_specialization_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['ces_trainings_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('ces_trainings_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('ces_trainings_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('ces_trainings_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('ces_trainings_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['other_non_ces_accredited_trainings_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('other_non_ces_accredited_trainings_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('other_non_ces_accredited_trainings_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('other_non_ces_accredited_trainings_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('other_non_ces_accredited_trainings_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['research_and_studies_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('research_and_studies_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('research_and_studies_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('research_and_studies_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('research_and_studies_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['scholarships_received_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('scholarships_received_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('scholarships_received_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('scholarships_received_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('scholarships_received_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['major_civic_and_professional_affiliations_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('major_civic_and_professional_affiliations_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('major_civic_and_professional_affiliations_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('major_civic_and_professional_affiliations_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('major_civic_and_professional_affiliations_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['awards_and_citations_received_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('awards_and_citations_received_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('awards_and_citations_received_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('awards_and_citations_received_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('awards_and_citations_received_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['case_records_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('case_records_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('case_records_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('case_records_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('case_records_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['health_record_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('health_record_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('health_record_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('health_record_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('health_record_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['attached_pdf_files_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('attached_pdf_files_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('attached_pdf_files_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('attached_pdf_files_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('attached_pdf_files_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });
                    });  

                    Swal.close();  
                }  
            }
        });
    }

}

// End of reseting Executive 201 Access Form

// Start of updating Plantilla Manangement Access Table

function updatePlantillaManangementAccessTable(){

    $.ajax({
        url: rootURL + 'api/v1/role-access/record',
        success: function (result) {

            // Empty Plantilla Manangement Access Table
            $("#PlantillaManangementAccess_tbody").empty();

            if(result.PlantillaManangementAccess == ''){

                $('#PlantillaManangementAccess_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.PlantillaManangementAccess.forEach(element => {

                    plantilla_manangement_page_access = '';
                    element['plantilla_manangement_page_access'].split(',').forEach(item => {

                        if(item != ''){
                            plantilla_manangement_page_access += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    plantilla_management_main_screen_rights = '';
                    element['plantilla_management_main_screen_rights'].split(',').forEach(item => {

                        if(item != ''){
                            plantilla_management_main_screen_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    sector_manager_rights = '';
                    element['sector_manager_rights'].split(',').forEach(item => {

                        if(item != ''){
                            sector_manager_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    department_agency_manager_rights = '';
                    element['department_agency_manager_rights'].split(',').forEach(item => {

                        if(item != ''){
                            department_agency_manager_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    agency_location_manager_rights = '';
                    element['agency_location_manager_rights'].split(',').forEach(item => {

                        if(item != ''){
                            agency_location_manager_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    office_manager_rights = '';
                    element['office_manager_rights'].split(',').forEach(item => {

                        if(item != ''){
                            office_manager_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    plantilla_position_manager_rights = '';
                    element['plantilla_position_manager_rights'].split(',').forEach(item => {

                        if(item != ''){
                            plantilla_position_manager_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    plantilla_position_classification_manager_rights = '';
                    element['plantilla_position_classification_manager_rights'].split(',').forEach(item => {

                        if(item != ''){
                            plantilla_position_classification_manager_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    appointee_occupant_manager_rights = '';
                    element['appointee_occupant_manager_rights'].split(',').forEach(item => {

                        if(item != ''){
                            appointee_occupant_manager_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    plantilla_appointee_occupant_browser_rights = '';
                    element['plantilla_appointee_occupant_browser_rights'].split(',').forEach(item => {

                        if(item != ''){
                            plantilla_appointee_occupant_browser_rights += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    $('#PlantillaManangementAccess_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetPlantillaManangementAccessForm('+ element['id'] +')">Edit</a>'+
                        '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/plantilla-manangement-access/delete/'+ element['id'] +'`, `updatePlantillaManangementAccessTable`, `resetPlantillaManangementAccessForm`, `None`, `None`)">Delete</a>'+
                    '</td>'+
                    '<td nowrap="nowrap">'+ ((element['role_name_plantilla_manangement'] == null) ? '-' : element['role_name_plantilla_manangement']) +'</td>'+
                    '<td nowrap="nowrap">'+ 
                        plantilla_manangement_page_access +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        plantilla_management_main_screen_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        sector_manager_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        department_agency_manager_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        agency_location_manager_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        office_manager_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        plantilla_position_manager_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        plantilla_position_classification_manager_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        appointee_occupant_manager_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        plantilla_appointee_occupant_browser_rights +
                    '</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at']).toLocaleString()) +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Plantilla Manangement Access Table

// Start of reseting Plantilla Manangement Access Form

function resetPlantillaManangementAccessForm(id){

    if(id == null){
        
        // Reset form
        $('#plantilla_manangement_form').trigger('reset');

        // Remove disabled attribute in Rolename Dropdown list
        $('#role_name_plantilla_manangement').removeAttr('disabled');

        // Set submit button name to Add Record
        $('#plantilla_manangement_form_submit').val('Add Record');

        // Set onsubmit attribute on form tag to add mode
        $('#plantilla_manangement_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/plantilla-manangement-access/add`, `plantilla_manangement_form`, `Add`, `updatePlantillaManangementAccessTable`, `resetPlantillaManangementAccessForm`, `plantilla_manangement_form_submit`, `None`, `None`)');

        // Set submit button button color to primary
        $('#plantilla_manangement_form_submit').attr('class', 'btn btn-primary mb-1');
    }
    else{

        Swal.fire({
            title: 'Populating Data...',
            text: 'Please wait for server response',
            imageUrl: rootURL + 'images/preloader.gif',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        
        // Reset form
        $('#plantilla_manangement_form').trigger('reset');

        // Disabled Rolename Dropdown list
        $('#role_name_plantilla_manangement').attr('disabled','disabled');

        // Set submit button name to Edit Record
        $('#plantilla_manangement_form_submit').val('Edit Record');

        // Set submit button button color to secondary
        $('#plantilla_manangement_form_submit').attr('class', 'btn btn-secondary mb-1');

        // Set onsubmit attribute on form tag to edit mode
        $('#plantilla_manangement_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/plantilla-manangement-access/update/' + id + '`, `plantilla_manangement_form`, `Update`, `updatePlantillaManangementAccessTable`, `resetPlantillaManangementAccessForm`, `plantilla_manangement_form_submit`, `None`, `None`)');

        $.ajax({
            url: rootURL + 'api/v1/plantilla-manangement-access/record/' + id,
            success: function (result) {

                if(result == 'Restricted'){
    
                    Swal.fire({
                        icon: 'error',
                        title: 'Stop',
                        text: 'Sorry you are restricted to do this action please contact the administrator.',
                    });
                    
                }
                else{

                    result.forEach(element => {

                        document.getElementsByName('role_name_plantilla_manangement')[0].value = element['role_name_plantilla_manangement'];

                        element['plantilla_manangement_page_access'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Plantilla Management (Main Screen)'){
                                    document.getElementsByName('plantilla_management_main_screen')[0].checked = true;
                                }
                                else if(item == 'Sector Manager'){
                                    document.getElementsByName('sector_manager')[0].checked = true;
                                }
                                else if(item == 'Department or Agency Manager'){
                                    document.getElementsByName('department_agency_manager')[0].checked = true;
                                }
                                else if(item == 'Agency Location Manager'){
                                    document.getElementsByName('agency_location_manager')[0].checked = true;
                                }
                                else if(item == 'Office Manager'){
                                    document.getElementsByName('office_manager')[0].checked = true;
                                }
                                else if(item == 'Plantilla Position Manager'){
                                    document.getElementsByName('plantilla_position_manager')[0].checked = true;
                                }
                                else if(item == 'Plantilla Position Classification Manager'){
                                    document.getElementsByName('plantilla_position_classification_manager')[0].checked = true;
                                }
                                else if(item == 'Appointee - Occupant Manager'){
                                    document.getElementsByName('appointee_occupant_manager')[0].checked = true;
                                }
                                else if(item == 'Plantilla Appointee or Occupant Browser'){
                                    document.getElementsByName('plantilla_appointee_occupant_browser')[0].checked = true;
                                }
                                
                            }
                            
                        });

                        element['plantilla_management_main_screen_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('plantilla_management_main_screen_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('plantilla_management_main_screen_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('plantilla_management_main_screen_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('plantilla_management_main_screen_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['sector_manager_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('sector_manager_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('sector_manager_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('sector_manager_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('sector_manager_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['department_agency_manager_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('department_agency_manager_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('department_agency_manager_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('department_agency_manager_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('department_agency_manager_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['agency_location_manager_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('agency_location_manager_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('agency_location_manager_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('agency_location_manager_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('agency_location_manager_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['office_manager_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('office_manager_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('office_manager_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('office_manager_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('office_manager_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['plantilla_position_manager_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('plantilla_position_manager_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('plantilla_position_manager_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('plantilla_position_manager_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('plantilla_position_manager_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['plantilla_position_classification_manager_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('plantilla_position_classification_manager_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('plantilla_position_classification_manager_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('plantilla_position_classification_manager_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('plantilla_position_classification_manager_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['appointee_occupant_manager_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('appointee_occupant_manager_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('appointee_occupant_manager_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('appointee_occupant_manager_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('appointee_occupant_manager_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });

                        element['plantilla_appointee_occupant_browser_rights'].split(',').forEach(item => {

                            if(item != ''){
                                if(item == 'Add'){
                                    document.getElementsByName('plantilla_appointee_occupant_browser_rights_add')[0].checked = true;
                                }
                                else if(item == 'Edit'){
                                    document.getElementsByName('plantilla_appointee_occupant_browser_rights_edit')[0].checked = true;
                                }
                                else if(item == 'Delete'){
                                    document.getElementsByName('plantilla_appointee_occupant_browser_rights_delete')[0].checked = true;
                                }
                                else if(item == 'View Only'){
                                    document.getElementsByName('plantilla_appointee_occupant_browser_rights_view_only')[0].checked = true;
                                }
                            }
                            
                        });
                    });  

                    Swal.close();   
                } 
            }
        });
    }

}

// End of reseting Plantilla Manangement Access Form

// Start of updating Report Generation Access Table

function updateReportGenerationAccessTable(){

    $.ajax({
        url: rootURL + 'api/v1/role-access/record',
        success: function (result) {

            // Empty Report Generation Access Table
            $("#ReportGenerationAccess_tbody").empty();

            if(result.ReportGenerationAccess == ''){

                $('#ReportGenerationAccess_tbody').append('<tr>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>'
                );
            }
            else{

                result.ReportGenerationAccess.forEach(element => {

                    rep_gen_executive_201_profile_access = '';
                    element['rep_gen_executive_201_profile_access'].split('|').forEach(item => {

                        if(item != ''){
                            rep_gen_executive_201_profile_access += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    rep_gen_competency_training_management_sub_module_access = '';
                    element['rep_gen_competency_training_management_sub_module_access'].split('|').forEach(item => {

                        if(item != ''){
                            rep_gen_competency_training_management_sub_module_access += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    rep_gen_eligibility_and_rank_tracking_access = '';
                    element['rep_gen_eligibility_and_rank_tracking_access'].split('|').forEach(item => {

                        if(item != ''){
                            rep_gen_eligibility_and_rank_tracking_access += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    rep_gen_plantilla_management_reports_access = '';
                    element['rep_gen_plantilla_management_reports_access'].split('|').forEach(item => {

                        if(item != ''){
                            rep_gen_plantilla_management_reports_access += '<li>'+ item +'</li>'; 
                        }
                        
                    });

                    $('#ReportGenerationAccess_tbody').append('<tr>'+
                    '<td>'+
                        '<a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetReportGenerationAccessForm('+ element['id'] +')">Edit</a>'+
                        '<a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`'+ rootURL +'api/v1/report-generation-access/delete/'+ element['id'] +'`, `updateReportGenerationAccessTable`, `resetReportGenerationAccessForm`, `None`, `None`)">Delete</a>'+
                    '</td>'+
                    '<td nowrap="nowrap">'+ ((element['role_name_report_generation'] == null) ? '-' : element['role_name_report_generation']) +'</td>'+
                    '<td nowrap="nowrap">'+ 
                        rep_gen_executive_201_profile_access +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        rep_gen_competency_training_management_sub_module_access +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        rep_gen_eligibility_and_rank_tracking_access +
                    '</td>'+
                    '<td nowrap="nowrap">'+ 
                        rep_gen_plantilla_management_reports_access +
                    '</td>'+
                    '<td nowrap="nowrap">'+ ((element['encoder'] == null) ? '-' : element['encoder']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['created_at'] == null) ? '-' : new Date(element['created_at'])).toLocaleString() +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['last_updated_by'] == null) ? '-' : element['last_updated_by']) +'</td>'+
                    '<td nowrap="nowrap">'+ ((element['updated_at'] == null) ? '-' : new Date(element['updated_at']).toLocaleString()) +'</td>'+
                    '</tr>'
                    );
                }); 
            }
        }
    });

}

// End of updating Report Generation Access Table

// Start of reseting Report Generation Access Form

function resetReportGenerationAccessForm(id){

    if(id == null){
        
        // Reset form
        $('#report_generation_form').trigger('reset');

        // Remove disabled attribute in Rolename Dropdown list
        $('#role_name_report_generation').removeAttr('disabled');

        // Set submit button name to Add Record
        $('#report_generation_form_submit').val('Add Record');

        // Set onsubmit attribute on form tag to add mode
        $('#report_generation_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/report-generation-access/add`, `report_generation_form`, `Add`, `updateReportGenerationAccessTable`, `resetReportGenerationAccessForm`, `report_generation_form_submit`, `None`, `None`)');

        // Set submit button button color to primary
        $('#report_generation_form_submit').attr('class', 'btn btn-primary mb-1');
    }
    else{

        Swal.fire({
            title: 'Populating Data...',
            text: 'Please wait for server response',
            imageUrl: rootURL + 'images/preloader.gif',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        
        // Reset form
        $('#report_generation_form').trigger('reset');

        // Disabled Rolename Dropdown list
        $('#role_name_report_generation').attr('disabled','disabled');

        // Set submit button name to Edit Record
        $('#report_generation_form_submit').val('Edit Record');

        // Set submit button button color to secondary
        $('#report_generation_form_submit').attr('class', 'btn btn-secondary mb-1');

        // Set onsubmit attribute on form tag to edit mode
        $('#report_generation_form').attr(`onsubmit`, 'submitForm(`' + rootURL + 'api/v1/report-generation-access/update/' + id + '`, `report_generation_form`, `Update`, `updateReportGenerationAccessTable`, `resetReportGenerationAccessForm`, `report_generation_form_submit`, `None`, `None`)');

        $.ajax({
            url: rootURL + 'api/v1/report-generation-access/record/' + id,
            success: function (result) {

                if(result == 'Restricted'){
    
                    Swal.fire({
                        icon: 'error',
                        title: 'Stop',
                        text: 'Sorry you are restricted to do this action please contact the administrator.',
                    });
                    
                }
                else{

                    result.forEach(element => {

                        document.getElementsByName('role_name_report_generation')[0].value = element['role_name_report_generation'];

                        element['rep_gen_executive_201_profile_access'].split('|').forEach(item => {

                            if(item != ''){
                                if(item == 'List of Active and or or Retired CESOs, CES Eligibles and CSEEs'){
                                    document.getElementsByName('list_of_active_and_or_retired_cesos_ces_eligibles_and_csees')[0].checked = true;
                                }
                                else if(item == 'List of Deceased CESOs, CES Eligibles and CSEEs'){
                                    document.getElementsByName('list_of_deceased_cesos_ces_eligibles_and_csees')[0].checked = true;
                                }
                                else if(item == 'List of Active CESOs, CES Eligibles and CSEEs with and or or without Active Pending Cases'){
                                    document.getElementsByName('list_of_active_ces_w_or_wo_active_pending_cases')[0].checked = true;
                                }
                                else if(item == 'List of Active CESOs, CES Eligibles and CSEEs (defined or filtered or grouped by appointing Authority)'){
                                    document.getElementsByName('list_of_active_ces_by_appointing_authority')[0].checked = true;
                                }
                                else if(item == 'List of Active CESOs, CES Eligibles and CSEEs candidate for Retirement'){
                                    document.getElementsByName('list_of_active_ces_candidate_for_retirement')[0].checked = true;
                                }
                                else if(item == 'Age Demographics'){
                                    document.getElementsByName('age_demographics')[0].checked = true;
                                }
                                else if(item == 'Active vs Retired Demographics'){
                                    document.getElementsByName('active_vs_retired_demographics')[0].checked = true;
                                }
                                else if(item == 'Statistic Summary per Presidential Appointments'){
                                    document.getElementsByName('statistic_summary_per_presidential_appointments')[0].checked = true;
                                }
                                else if(item == 'List of Active and or or Retired CESOs, CES Eligibles and CSEEs (defined by Fields or Area of Expertise andoror Degree or Major)'){
                                    document.getElementsByName('list_of_active_and_or_retired_ces_by_area_of_expertise_or_degree')[0].checked = true;
                                }
                                else if(item == 'List of Officials per birth month'){
                                    document.getElementsByName('list_of_officials_per_birth_month')[0].checked = true;
                                }
                                else if(item == 'Personal Data Sheet based on 201 Profile Information'){
                                    document.getElementsByName('personal_data_sheet_based_on_201_profile_information')[0].checked = true;
                                }
                            }
                            
                        });

                        element['rep_gen_competency_training_management_sub_module_access'].split('|').forEach(item => {

                            if(item != ''){
                                if(item == 'Masterlist per Training Conducted'){
                                    document.getElementsByName('masterlist_per_training_conducted')[0].checked = true;
                                }
                                else if(item == 'Masterlist of Training Venues'){
                                    document.getElementsByName('masterlist_of_training_venues')[0].checked = true;
                                }
                                else if(item == 'List of Training Venues (filtered by City or Municipality)'){
                                    document.getElementsByName('list_of_training_venues_by_city')[0].checked = true;
                                }
                                else if(item == 'Masterlist of Training Providers'){
                                    document.getElementsByName('masterlist_of_training_providers')[0].checked = true;
                                }
                                else if(item == 'Masterlist of Resource Speaker or Persons'){
                                    document.getElementsByName('masterlist_of_resource_speaker_persons')[0].checked = true;
                                }
                                else if(item == 'List of Resource Speakers or Persons (defined by Expertise)'){
                                    document.getElementsByName('list_of_resource_speakers_persons_by_expertise')[0].checked = true;
                                }
                                else if(item == 'List of Resource Speakers or Persons (defined by Inclusive Date)'){
                                    document.getElementsByName('list_of_resource_speakers_persons_by_inclusive_date')[0].checked = true;
                                }
                            }
                            
                        });

                        element['rep_gen_eligibility_and_rank_tracking_access'].split('|').forEach(item => {

                            if(item != ''){
                                if(item == 'Masterlist of Officials undergoing the 4-stage Eligibility Process (on-stream)'){
                                    document.getElementsByName('masterlist_of_officials_undergoing_the_4_stage_eligibility')[0].checked = true;
                                }
                                else if(item == 'Masterlist of Examinees per examination date, location'){
                                    document.getElementsByName('masterlist_of_examinees_per_examination_date_location')[0].checked = true;
                                }
                                else if(item == 'Masterlist of Examinees per defined rating (Pass or failed), examination date and location (variable'){
                                    document.getElementsByName('masterlist_of_examinees_per_defined_rating_pass_or_failed')[0].checked = true;
                                }
                                else if(item == 'Masterlist of CES WE retakers (optional)'){
                                    document.getElementsByName('masterlist_of_ces_we_retakers')[0].checked = true;
                                }
                                else if(item == 'Masterlist of AC Takers per AC date'){
                                    document.getElementsByName('masterlist_of_ac_takers_per_ac_date')[0].checked = true;
                                }
                                else if(item == 'Masterlist of AC Passers per AC date'){
                                    document.getElementsByName('masterlist_of_ac_passers_per_ac_date')[0].checked = true;
                                }
                                else if(item == 'Masterlist of AC Retakers'){
                                    document.getElementsByName('masterlist_of_ac_retakers')[0].checked = true;
                                }
                                else if(item == 'Masterlist of Validated Officials per Validation Date and or or Validation Type'){
                                    document.getElementsByName('masterlist_of_validated_officials_per_validation_date_or_type')[0].checked = true;
                                }
                                else if(item == 'Masterlist of Officials who has taken or undergone Board or Panel Interview'){
                                    document.getElementsByName('masterlist_of_officials_who_has_taken_board_panel_interview')[0].checked = true;
                                }
                            }
                            
                        });

                        element['rep_gen_plantilla_management_reports_access'].split('|').forEach(item => {

                            if(item != ''){
                                if(item == 'Plantilla Statistics (All)'){
                                    document.getElementsByName('plantilla_statistics_all')[0].checked = true;
                                }
                                else if(item == 'Plantilla Statistics (CES Only)'){
                                    document.getElementsByName('plantilla_statistics_ces_only')[0].checked = true;
                                }
                                else if(item == 'Plantilla Statistics (Non-CES Only)'){
                                    document.getElementsByName('plantilla_statistics_non_ces_only')[0].checked = true;
                                }
                                else if(item == 'Plantilla Statistics by Gender (All, CES or Non-CES)'){
                                    document.getElementsByName('plantilla_statistics_by_gender_all_ces_or_non_ces')[0].checked = true;
                                }
                                else if(item == 'Plantilla Statistics Summary including Gender (by Agency or All)'){
                                    document.getElementsByName('plantilla_statistics_summary_including_gender_by_agency')[0].checked = true;
                                }
                                else if(item == 'Plantilla Statistics per Department, Attached Agency and CES Positions'){
                                    document.getElementsByName('plantilla_statistics_per_department_attached_agency_ces_position')[0].checked = true;
                                }
                                else if(item == 'Occupancy Report (All)'){
                                    document.getElementsByName('occupancy_report_all')[0].checked = true;
                                }
                                else if(item == 'Occupancy Report (CES Only)'){
                                    document.getElementsByName('occupancy_report_ces_only')[0].checked = true;
                                }
                                else if(item == 'Occupancy Report (Non-CES Only)'){
                                    document.getElementsByName('occupancy_report_non_ces_only')[0].checked = true;
                                }
                                else if(item == 'Plantilla Position List (per Agency, based on classification (CES, Non-CES or All)'){
                                    document.getElementsByName('plantilla_position_list_per_agency_based_on_classification')[0].checked = true;
                                }
                                else if(item == 'CES Bluebook'){
                                    document.getElementsByName('ces_bluebook')[0].checked = true;
                                }
                                else if(item == 'Mailing List per Agency (address derived from 201 Profile as stated in the mailing address and not in the office address)'){
                                    document.getElementsByName('mailing_list_per_agency')[0].checked = true;
                                }
                                else if(item == 'List of Officials by Department (filtered by CES Status and Salary Grade, option to include Occupants and attached Agencies, and sorted by Name, SG, Office and Region)'){
                                    document.getElementsByName('list_of_officials_by_department')[0].checked = true;
                                }
                                else if(item == 'List of Officials by Appointment or Assumption Dates (filtered by CES status and Department or Agency)'){
                                    document.getElementsByName('list_of_officials_by_appointment_or_assumption_dates')[0].checked = true;
                                }
                            }
                            
                        });
                    });  

                    Swal.close();  
                }  
            }
        });
    }

}

// End of reseting Report Generation Access Form

// Start of data if already in use

function validateData(type, action_url_without_type_and_value, value, field_id){

    // Detect empty input or space in first character then execute script if not

    if(value.trim() != ''){

        Swal.fire({
            icon: 'question',
            title: 'Validating...',
            text: 'Validating ' + type + ' if not in use',
            showConfirmButton: false,
            allowOutsideClick: false
        })
    
        $.ajax({
            url: action_url_without_type_and_value + '/' + type + '/' + value,
            success: function (result) {
    
                if(result == 'true'){
    
                    Swal.fire({
                        icon: 'error',
                        title: 'Stop',
                        text: 'Stop ' + type + ' already exist input field will be reset',
                    });
                    
                    $('#'+ field_id).val('');
                }
                else if(result == 'Restricted'){
    
                    Swal.fire({
                        icon: 'error',
                        title: 'Stop',
                        text: 'Sorry you are restricted to do this action please contact the administrator.',
                    });

                }
                else if(result.PersonalData || result.User){
                    
                    if(result.PersonalData.length){
    
                        personal_data = `<div class="bg-primary text-white text-center mb-1 p-2">Result from 201 Profile</div>`;
                    
                        result.PersonalData.forEach(element => { 
    
                            personal_data += `<div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success border-success text-white">CES no.</span>
                                        </div>
                                        <input type="text" class="form-control" value="` + element['cesno']+ `" readonly>
                                    </div>`;
    
                            personal_data += `<div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary border-primary text-white">Name</span>
                                        </div>
                                        <input type="text" class="form-control" value="` + element['lastname'] + `, ` + element['firstname'] + `, ` + element['middlename'] + `" readonly>
                                    </div>`;
                        });
                    }
                    else{
    
                        personal_data = '';
                    }
                    if(result.User.length){
    
                        user_account = `<div class="bg-primary text-white text-center mb-1 p-2">Result from User Account</div>`;
                    
                        result.User.forEach(element => { 
    
                            user_account += `<div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success border-success text-white">Role</span>
                                        </div>
                                        <input type="text" class="form-control" value="` + element['role']+ `" readonly>
                                    </div>`;
    
                            user_account += `<div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary border-primary text-white">Name</span>
                                        </div>
                                        <input type="text" class="form-control" value="` + element['last_name'] + `, ` + element['first_name'] + `, ` + element['middle_name'] + `" readonly>
                                    </div>`;
                        });
                    }
                    else{
    
                        user_account = '';
                    }
    
                    Swal.fire({
                        title: 'Stop ' + type + ' already exist',
                        html: personal_data + user_account,
                        icon: 'error',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
    
                        if (result.isConfirmed) {
    
                            Swal.fire({
                                icon: 'info',
                                title: 'Resetting..',
                                text: 'The input field will be reset',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            
                            $('#'+ field_id).val('');
                        }
                    });
    
                }
                else if(result == 'false'){

                    Swal.fire({
                        icon: 'success',
                        title: 'Passed',
                        text: 'You may proceed encoding',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
                else{

                    html = '<div class="text-center mb-2">See details of error below.</div>';
                    $.each(result, function( index, value ) {
                        html += '<div class="text-center text-danger mb-1">'+ value +'</div>';
                    });
                    
                    Swal.fire({
                        title: 'Validation Unsuccessful!',
                        html: html,
                        icon: 'error',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });

                }        
            }
        });
    }
    
}

// End of data if already in use

// Start of validating 201 Profile if already exist

function validate201Profile(){

    if($('#lastname').val() != '' && $('#firstname').val() != '' && $('#middlename').val() != '' && $('#birthdate').val() != ''){

        // Get Year in Birthday
        var year_on_birthday = new Date($('#birthdate').val()).getFullYear();

        // Count length of string in year from birthday and execute script validation
        if(year_on_birthday.toString().length == 4){

            Swal.fire({
                icon: 'question',
                title: 'Validating...',
                text: 'Validating 201 profile if already exist',
                showConfirmButton: false,
                allowOutsideClick: false
            })
        
            $.ajax({
                url: rootURL + 'api/v1/personal-data/validate-201-profile/' + $('#lastname').val() + '/' + $('#firstname').val() + '/' + $('#middlename').val() + '/' + $('#birthdate').val(),
                success: function (result) {
        
                    if(result.validate_by_name || result.validate_by_name_and_birthday){
                        
                        if(result.validate_by_name.length){
        
                            validate_by_name_result = `<div class="bg-primary text-white text-center mb-1 p-2">Result from Name only</div>`;
                        
                            result.validate_by_name.forEach(element => { 
        
                                validate_by_name_result += `<div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-success border-success text-white">CES no.</span>
                                            </div>
                                            <input type="text" class="form-control" value="` + element['cesno']+ `" readonly>
                                        </div>`;
        
                                validate_by_name_result += `<div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary border-primary text-white">Name</span>
                                            </div>
                                            <input type="text" class="form-control" value="` + element['lastname'] + `, ` + element['firstname'] + `, ` + element['middlename'] + `" readonly>
                                        </div>`;
                            });
                        }
                        else{
        
                            validate_by_name_result = '';
                        }
                        if(result.validate_by_name_and_birthday.length){
        
                            validate_by_name_and_birthday_result = `<div class="bg-primary text-white text-center mb-1 p-2">Result from Name and Birthday</div>`;
                        
                            result.validate_by_name_and_birthday.forEach(element => { 
        
                                validate_by_name_and_birthday_result += `<div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-success border-success text-white">CES no.</span>
                                            </div>
                                            <input type="text" class="form-control" value="` + element['cesno']+ `" readonly>
                                        </div>`;
        
                                validate_by_name_and_birthday_result += `<div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary border-primary text-white">Name</span>
                                            </div>
                                            <input type="text" class="form-control" value="` + element['lastname'] + `, ` + element['firstname'] + `, ` + element['middlename'] + `" readonly>
                                        </div>`;
                            });
                        }
                        else{
        
                            validate_by_name_and_birthday_result = '';
                        }
        
                        Swal.fire({
                            title: 'With possible duplicate below!',
                            html: validate_by_name_result + validate_by_name_and_birthday_result,
                            icon: 'error',
                            showCancelButton: true,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancel Encoding',
                            confirmButtonText: 'Proceed Encoding'
                        }).then((result) => {
        
                            if (result.isConfirmed) {
        
                                Swal.close();
                            }
                            else if (result.dismiss) {
    
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Reloading..',
                                    text: 'The page will be reload',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
    
                                location.reload();
                            }
                        });
        
                    }
                    else if(result == 'Restricted'){
    
                        Swal.fire({
                            icon: 'error',
                            title: 'Stop',
                            text: 'Sorry you are restricted to do this action please contact the administrator.',
                        });
                        
                    }
                    else{
        
                        Swal.fire({
                            icon: 'success',
                            title: 'Passed',
                            text: 'You may proceed encoding',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }        
                }
            });
        }

    }
    
}

// End of validating 201 Profile if already exist

// Start of delete function

function deleteFunction(action_url, update_table_js_function_name, reset_form_js_function_name, reload_page_enable, assign_redirect_page_url){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: action_url,
                data: {
                    _method: 'delete',
                    _token: $('[name="_token"]').val(),
                },
                success: function(response) {

                    if (response === 'Successfully deleted'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!', 
                            html: `<center>Successfully deleted.</center>`
                        });
                        
                        if(reset_form_js_function_name != 'None'){
                            resetFormFunction(reset_form_js_function_name);
                        }

                        if(update_table_js_function_name != 'None'){
                            updateTableFunction(update_table_js_function_name);
                        }

                        if(reload_page_enable == 'Yes'){
                            location.reload();
                        }

                        if(assign_redirect_page_url != 'None'){
                            location.assign(assign_redirect_page_url);
                        }
                    }
                    else if(response == 'Restricted'){
    
                        Swal.fire({
                            icon: 'error',
                            title: 'Stop',
                            text: 'Sorry you are restricted to do this action please contact the administrator.',
                        });
                        
                    }
                    else{
                        Swal.fire('Delete Unsuccessful!', '', 'error');
                    }
                }
            });

        }else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
    });
}

// End of delete function

// Start of getting Role Name no.

function getRoleNameNo(role_name){

    Swal.fire({
        icon: 'info',
        title: 'Getting...',
        text: 'Getting ' + role_name + ' role name role number',
        showConfirmButton: false,
        allowOutsideClick: false
    })

    $.ajax({
        url: rootURL + 'api/v1/user/get-role-name-no/' + role_name,
        success: function (result) {

            // Put result on Role Name No. input field
            $('#role_name_no').val(result);

            Swal.fire({
                icon: 'success',
                title: 'Done',
                text: 'You may proceed encoding',
                showConfirmButton: false,
                timer: 2000
            })

            // Run setUsername function
            setUsername();
        }
    });
}

// End of getting Role Name no.

// Start of validating required file size

function validateFileSize(input_file_id, max_file_size_in_mb) {

    $('#'+ input_file_id).on('change', function (e) {

        // Get the file
        var files = e.currentTarget.files; 

        // Set required file size in mb
        var filesize = ((files[0].size/1024)/1024).toFixed(max_file_size_in_mb); // MB
        
        // Validate if file size is maximum than required
        if (filesize > max_file_size_in_mb) { 

            Swal.fire(
            'Stop',
            'File too large maximum file allowed was ' + max_file_size_in_mb + ' mb',
            'error'
            )

            // Reset input file field value
            $('#'+ input_file_id).val('');
        }
    });
}

// End of validating required file size

// Start of submit reset password function

function submitResetPassword(){

    Swal.fire({
        icon: 'question',
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Don't save`,
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: 'Processing...',
                text: 'Waiting for server response',
                imageUrl: rootURL + 'images/preloader.gif',
                showConfirmButton: false,
                allowOutsideClick: false
            });

            $.ajax({
                type: "POST",
                url: rootURL + 'api/v1/password/reset-password',
                data: $("#reset_password").serialize(),
                success: function(response) {

                    if (response === 'Your password was successfully reset'){
                        Swal.fire('Saved!', '<center>Your password was successfully reset.</center>', 'success');
                        location.assign(rootURL + 'login');
                    }
                    else if (response === 'User not found please check provided email'){
                        Swal.fire('Error!', '<center>User not found please check the provided email.</center>', 'error');
                    }
                    else if (response === 'Token was invalid or expired, try to take another request'){
                        Swal.fire('Error!', '<center>Token was invalid or expired, try to take another request. redirecting you to forgot password page</center>', 'error');
                        location.assign(rootURL + 'forgot-password');
                    }
                    else if (response === 'Throttled reset attempt'){
                        Swal.fire('Error!', '<center>Throttled reset attempt.</center>', 'error');
                        location.assign(rootURL + 'forgot-password');
                    }
                    else{

                        html = '<div class="text-center mb-2">See details of error below.</div>';
                        $.each(response, function( index, value ) {
                            html += '<div class="text-center text-danger mb-1">'+ value +'</div>';
                        });
                        
                        Swal.fire({
                            title: 'Your password was not updated!',
                            html: html,
                            icon: 'error',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });

                    }
                }
            });
        } else if (result.isDenied) {

            Swal.fire('Changes are not saved', '', 'info')
        }
    });

}

// End of submit reset password function


//
function libTabs(evt, libraTabs) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(libraTabs).style.display = "block";
    evt.currentTarget.className += " active";
  }

  //

// Start of process alert function

function processAlert(){

    Swal.fire({
        title: 'Processing...',
        text: 'Waiting for server response',
        imageUrl: rootURL + 'images/preloader.gif',
        showConfirmButton: false,
        allowOutsideClick: false
    });
}

// End of process alert function
