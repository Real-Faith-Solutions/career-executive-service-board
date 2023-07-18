
// Personal Data Form Interaction
    function computeAge() {
        var birthDate = document.getElementById('birthdate').value;
        var today = new Date();
        var age = today.getFullYear() - new Date(birthDate).getFullYear();
        var monthDiff = today.getMonth() - new Date(birthDate).getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < new Date(birthDate).getDate())) {
            age--;
        }
        document.getElementById('age').value = age;
        return age;
    }

    function generateMiddleInitial() {
        var middleName = document.getElementById('middlename').value;
        var middleInitial = '';
        if (middleName.trim() !== '') {
            middleInitial = middleName.trim().charAt(0).toUpperCase() + '.';
        }
        document.getElementById('mi').value = middleInitial;
    }

    function toggleIndigenousDependentField() {
        var selectElement = document.getElementById('member_of_indigenous_group');
        var dependentField = document.getElementById('dependent-indigenous-field');
        var dependentInput = document.getElementById('dependent-indigenous-input');

        if (selectElement.value === 'Others') {
            dependentField.style.display = 'block';
            dependentInput.required = true;
        } else {
            dependentField.style.display = 'none';
            dependentInput.required = false;
        }
    }

    function toggleCitizenshipDependentField() {
        var selectElement = document.getElementById('citizenship');
        var dependentField = document.getElementById('dependent-dual-citizenship-field');
        var dependentInput = document.getElementById('dependent-dual-citizenship-input');

        if (selectElement.value === 'Dual Citizenship') {
            dependentField.style.display = 'block';
            dependentInput.required = true;
        } else {
            dependentField.style.display = 'none';
            dependentInput.required = false;
        }
    }

    function toggleDisabilityDependentField() {
        var selectElement = document.getElementById('person_with_disability');
        var dependentField = document.getElementById('dependent-pwd-field');
        var dependentInput = document.getElementById('dependent_pwd_input');

        if (selectElement.value === 'Yes') {
            dependentField.style.display = 'block';
            dependentInput.required = true;
        } else {
            dependentField.style.display = 'none';
            dependentInput.required = false;
        }
    }
// end Personal Data Form Interaction

// real-time validation

    // names input validations
    function validateInput(inputField, minLength, alphaNumeric) {
        const inputValue = inputField.value;
        const charCode = event.which ? event.which : event.keyCode;
    
        var form = inputField.closest('form');
        var submitButton = form.querySelector('button[type="submit"]');
    
        if (inputValue.length < minLength && !(charCode >= 48 && charCode <= 57)) {
            inputField.nextElementSibling.textContent = `At least ${minLength} characters without numbers.`;
            inputField.classList.remove('focus:outline-blue-600');
            inputField.classList.add('border-red-600');
            inputField.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
        } else if (inputValue.length < minLength && ((charCode >= 48 && charCode <= 57) && !alphaNumeric)) {
            event.preventDefault();
            inputField.nextElementSibling.textContent = `At least ${minLength} characters without numbers.`;
            inputField.classList.remove('focus:outline-blue-600');
            inputField.classList.add('border-red-600');
            inputField.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
        } else if ((charCode >= 48 && charCode <= 57) && !alphaNumeric) {
            event.preventDefault();
            inputField.nextElementSibling.textContent = 'Input must not contain numbers.';
        } else {
            inputField.nextElementSibling.textContent = '';
            inputField.classList.remove('focus:outline-red-500');
            inputField.classList.remove('border-red-600');
            inputField.classList.add('focus:outline-blue-600');

            const errorClass = form.querySelectorAll('.input_error');

            for (const error of errorClass) {
                if (error.textContent != "") {
                    submitButton.disabled = true;
                    submitButton.classList.remove('cursor-pointer');
                    submitButton.classList.add('cursor-not-allowed');
                    break;
                }else{
                    submitButton.disabled = false;
                    submitButton.classList.remove('cursor-not-allowed');
                    submitButton.classList.add('cursor-pointer');
                }
            }
            
        }
    }
    // end names input validations

    // when not focus on current input field
    function checkErrorMessage(inputField) {

        const inputValue = inputField.value;
        let errorMessage = inputField.nextElementSibling.textContent;

        if (errorMessage == 'Input must not contain numbers.') {
            inputField.nextElementSibling.textContent = '';
        } 

    }
    // end when not focus on current input field

    // prevent submission of form if there is an error
    function checkErrorsBeforeSubmit(currentForm){

        const errorClass = currentForm.querySelectorAll('.input_error');
        
        for (const error of errorClass) {
            if (error.textContent != "") {
                return false;
            }
        }

        return true;

    }
    // end prevent submission of form if there is an error

    // validate date
    function validateDateInput(inputDate, minAge = 0){

        const inputDateByUSer = inputDate.value;

        const datePattern = /^\d{4}-\d{2}-\d{2}$/;

        var form = inputDate.closest('form');
        var submitButton = form.querySelector('button[type="submit"]');

        if (!datePattern.test(inputDateByUSer)) {
            inputDate.nextElementSibling.textContent = `Invalid date.`;
            inputDate.classList.remove('focus:outline-blue-600');
            inputDate.classList.add('border-red-600');
            inputDate.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
            return;
        }

        const inputDateNew = new Date(inputDateByUSer);
        const currentDate = new Date();

        if(inputDateNew > currentDate){
            inputDate.nextElementSibling.textContent = `Invalid date.`;
            inputDate.classList.remove('focus:outline-blue-600');
            inputDate.classList.add('border-red-600');
            inputDate.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
            return
        }

        let userAge = computeAge();

        if(userAge < minAge){
            inputDate.nextElementSibling.textContent = `Invalid date.`;
            inputDate.classList.remove('focus:outline-blue-600');
            inputDate.classList.add('border-red-600');
            inputDate.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
            return
        }

        inputDate.nextElementSibling.textContent = '';
        inputDate.classList.remove('focus:outline-red-500');
        inputDate.classList.remove('border-red-600');
        inputDate.classList.add('focus:outline-blue-600');
        submitButton.disabled = false;
        submitButton.classList.remove('cursor-not-allowed');
        submitButton.classList.add('cursor-pointer');

    }
    // end validate date

// end of real-time validation