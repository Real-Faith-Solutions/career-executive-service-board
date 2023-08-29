
// Personal Data Form Interaction

    // check password if match
    function checkPasswordMatch() {
        const passwordField = document.getElementById('password');
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const confirmPasswordError = document.getElementById('confirmPasswordError');
        var form = passwordField.closest('form');

        var submitButton = form.querySelector('button[type="submit"]');

        if(!submitButton){
            submitButton = form.querySelector('button[type="button"]');
        }

        if (password !== confirmPassword) {
            confirmPasswordError.textContent = 'Passwords do not match';
        } else {
            confirmPasswordError.textContent = '';
            submitButton.disabled = false;
            submitButton.classList.remove('cursor-not-allowed');
            submitButton.classList.add('cursor-pointer');
        }
    }
    // end check password if match

    // toggle password
    function togglePasswordVisibility(inputElement, iconElement) {
        if (inputElement.type === 'password') {
            inputElement.type = 'text';
            iconElement.classList.remove('fa-eye');
            iconElement.classList.add('fa-eye-slash');
        } else {
            inputElement.type = 'password';
            iconElement.classList.remove('fa-eye-slash');
            iconElement.classList.add('fa-eye');
        }
    }

    // Toggle password visibility for password field
    const toggleCurrentPasswordIcon = document.querySelector('.toggle-current-password');
    const currentpasswordInput = document.getElementById('currentPassword');

    toggleCurrentPasswordIcon.addEventListener('click', function() {
        togglePasswordVisibility(currentpasswordInput, toggleCurrentPasswordIcon);
    });

    // Toggle password visibility for password field
    const togglePasswordIcon = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('password');

    togglePasswordIcon.addEventListener('click', function() {
        togglePasswordVisibility(passwordInput, togglePasswordIcon);
    });

    // Toggle password visibility for confirm password field
    const toggleConfirmPasswordIcon = document.querySelector('.toggle-confirm-password');
    const confirmPasswordInput = document.getElementById('confirmPassword');

    toggleConfirmPasswordIcon.addEventListener('click', function() {
        togglePasswordVisibility(confirmPasswordInput, toggleConfirmPasswordIcon);
    });
    // end toggle password

    document.addEventListener('DOMContentLoaded', function() {
        computeAge();
    });

    function computeAge() {
        const birthdateInput = document.getElementById('birthdate');
        const ageInput = document.getElementById('age');
        
        const birthdateValue = new Date(birthdateInput.value);
        const today = new Date();
        let age = today.getFullYear() - birthdateValue.getFullYear();
        
        // Adjust age if the birthdate hasn't occurred yet this year
        if (
            today.getMonth() < birthdateValue.getMonth() ||
            (today.getMonth() === birthdateValue.getMonth() && today.getDate() < birthdateValue.getDate())
        ) {
            age--;
        }
        
        ageInput.value = age;
    }

    document.addEventListener('DOMContentLoaded', function() {
        computeAgeEdit();
    });
    
    function computeAgeEdit() {
        const birthdateInputEdit = document.getElementById('birthdateEdit');
        const ageInputEdit = document.getElementById('ageEdit');
        
        const birthdateValueEdit = new Date(birthdateInputEdit.value);
        const todayEdit = new Date();
        let ageEdit = todayEdit.getFullYear() - birthdateValueEdit.getFullYear();
        
        if (
            todayEdit.getMonth() < birthdateValueEdit.getMonth() ||
            (todayEdit.getMonth() === birthdateValueEdit.getMonth() && todayEdit.getDate() < birthdateValueEdit.getDate())
        ) {
            ageEdit--;
        }
        
        ageInputEdit.value = ageEdit;
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

        if (selectElement.value === 'Dual-Citizenship') {
            dependentField.style.display = 'block';
            dependentInput.required = true;
        } else {
            dependentField.style.display = 'none';
            dependentInput.required = false;
        }
    }

    toggleCitizenshipDependentField();

    function toggleCitizenshipEdit() {
        var citizenshipSelect = document.getElementById('editCitizenship');
        var dualCitizenshipField = document.getElementById('dualCitizenshipField');
        
        if (citizenshipSelect.value === 'Dual-Citizenship') {
            dualCitizenshipField.style.display = 'block';
        } else {
            dualCitizenshipField.style.display = 'none';
        }
    }
    
    // Call the toggle function on page load to set initial visibility
    toggleCitizenshipEdit();

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

    // names input validations letters only or type
    function validateInput(inputField, minLength, type = 'all') {

        const inputValue = inputField.value;
        let currentValue = inputField.value;
        let regexValidator = /^.*$/;
        let errorMessage = ' characters';
        if(type == 'all'){
            let regexValidator = /^.*$/;
        }else if(type == 'alphaNumeric'){
            regexValidator = /^[a-zA-Z0-9\s]*$/;
            errorMessage = ' numbers/letters without special characters.';
        }else if(type == 'letters'){
            regexValidator = /^[a-zA-Z\s]*$/;
            errorMessage = ' letters without numbers/special characters.';
        }else if(type == 'numbers'){
            regexValidator = /^\d*$/;
            errorMessage = ' digits without letters/special characters.';
        }else if(type == 'lettersWithSpecial'){
            regexValidator = /^[a-zA-Z\s!@#$%^&*()\-_=+[\]{}|\\;:'",.<>/?]*$/;
            errorMessage = ' letters without numbers.';
        }else if(type == 'numbersWithSpecial'){
            regexValidator = /^[0-9!@#$%^&*()\-_=+[\]{}|\\;:'",.<>/?]*$/;
            errorMessage = ' digits without letters.';
        }else if(type == 'email'){
            regexValidator = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            errorMessage = ' characters and has a valid email format.';
        }
    
        var form = inputField.closest('form');
        var submitButton = form.querySelector('button[type="submit"]');

        if(!submitButton){
            submitButton = form.querySelector('button[type="button"]');
        }
    
        if (inputValue.length < minLength && regexValidator.test(inputValue)) {
            inputField.nextElementSibling.textContent = `At least ${minLength} ${errorMessage}`;
            inputField.classList.remove('focus:outline-blue-600');
            inputField.classList.add('border-red-600');
            inputField.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
            this.currentValue = inputField.value;
        } else if (inputValue.length < ++minLength && !regexValidator.test(inputValue)) {
            inputField.value = this.currentValue;
            inputField.nextElementSibling.textContent = `At least ${--minLength} ${errorMessage}`;
            inputField.classList.remove('focus:outline-blue-600');
            inputField.classList.add('border-red-600');
            inputField.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
        } else if (!regexValidator.test(inputValue)) {
            inputField.value = this.currentValue;
            inputField.nextElementSibling.textContent = 'Invalid input.';
        } else {
            this.currentValue = inputField.value;
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
    // end names input validations letters only or type

    // email input validation
    function validateInputEmail(inputField) {

        const inputValue = inputField.value;
        let regexValidator = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        let errorMessage = ' characters and has a valid email format.';
    
        var form = inputField.closest('form');
        var submitButton = form.querySelector('button[type="submit"]');

        if(!submitButton){
            submitButton = form.querySelector('button[type="button"]');
        }
    
        if (inputValue.length < 6 && regexValidator.test(inputValue)) {
            inputField.nextElementSibling.textContent = `At least 6 ${errorMessage}`;
            inputField.classList.remove('focus:outline-blue-600');
            inputField.classList.add('border-red-600');
            inputField.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
        } else if (inputValue.length < 7 && !regexValidator.test(inputValue)) {
            inputField.nextElementSibling.textContent = `At least 6 ${errorMessage}`;
            inputField.classList.remove('focus:outline-blue-600');
            inputField.classList.add('border-red-600');
            inputField.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
        } else if (!regexValidator.test(inputValue)) {
            inputField.nextElementSibling.textContent = 'Invalid email.';
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
    // email input validation

    // when not focus on current input field
    function checkErrorMessage(inputField) {

        const inputValue = inputField.value;
        let errorMessage = inputField.nextElementSibling.textContent;

        if (errorMessage == 'Input must not contain numbers.' || errorMessage == 'Input must not contain letters.' || errorMessage == 'Invalid input.') {
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
    function validateDateInput(inputDate, minAge = 0, allowFuture = false){

        const inputDateByUSer = inputDate.value;

        const datePattern = /^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/;

        var form = inputDate.closest('form');
        var submitButton = form.querySelector('button[type="submit"]');

        if(!submitButton){
            submitButton = form.querySelector('button[type="button"]');
        }

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

        if((inputDateNew > currentDate) && (!allowFuture)){
            inputDate.nextElementSibling.textContent = `Invalid date.`;
            inputDate.classList.remove('focus:outline-blue-600');
            inputDate.classList.add('border-red-600');
            inputDate.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
            return
        }

        var today = new Date();
        var age = today.getFullYear() - inputDateNew.getFullYear();
        var monthDiff = today.getMonth() - inputDateNew.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < inputDateNew.getDate())) {
            age--;
        }

        if(!allowFuture){
            if(age < minAge){
                inputDate.nextElementSibling.textContent = `Invalid date.`;
                inputDate.classList.remove('focus:outline-blue-600');
                inputDate.classList.add('border-red-600');
                inputDate.classList.add('focus:outline-red-500');
                submitButton.disabled = true;
                submitButton.classList.remove('cursor-pointer');
                submitButton.classList.add('cursor-not-allowed');
                return
            }
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

    // validation of 2 dates from vs to where from should be < to
    function validateDateFromTo(fromDate, toDate){

        const currentDate = new Date();
        const inputFromDateByUSer = fromDate.value;
        const inputToDateByUSer = toDate.value;

        const inputFromDate = new Date(inputFromDateByUSer);
        const inputToDate = new Date(inputToDateByUSer);

        var form = fromDate.closest('form');
        var submitButton = form.querySelector('button[type="submit"]');

        if(!submitButton){
            submitButton = form.querySelector('button[type="button"]');
        }

        if(inputFromDate && inputToDate){
            if((inputFromDate >= inputToDate) || (inputFromDate > currentDate || inputToDate > currentDate)){
                fromDate.nextElementSibling.textContent = `Invalid date.`;
                fromDate.classList.remove('focus:outline-blue-600');
                fromDate.classList.add('border-red-600');
                fromDate.classList.add('focus:outline-red-500');
                toDate.nextElementSibling.textContent = `Invalid date.`;
                toDate.classList.remove('focus:outline-blue-600');
                toDate.classList.add('border-red-600');
                toDate.classList.add('focus:outline-red-500');
                submitButton.disabled = true;
                submitButton.classList.remove('cursor-pointer');
                submitButton.classList.add('cursor-not-allowed');
                return;
            }else{
                fromDate.nextElementSibling.textContent = '';
                fromDate.classList.remove('focus:outline-red-500');
                fromDate.classList.remove('border-red-600');
                fromDate.classList.add('focus:outline-blue-600');
                toDate.nextElementSibling.textContent = '';
                toDate.classList.remove('focus:outline-red-500');
                toDate.classList.remove('border-red-600');
                toDate.classList.add('focus:outline-blue-600');
                submitButton.disabled = false;
                submitButton.classList.remove('cursor-not-allowed');
                submitButton.classList.add('cursor-pointer');
                return;
            }
        }

        fromDate.nextElementSibling.textContent = '';
        fromDate.classList.remove('focus:outline-red-500');
        fromDate.classList.remove('border-red-600');
        fromDate.classList.add('focus:outline-blue-600');
        toDate.nextElementSibling.textContent = '';
        toDate.classList.remove('focus:outline-red-500');
        toDate.classList.remove('border-red-600');
        toDate.classList.add('focus:outline-blue-600');
        submitButton.disabled = false;
        submitButton.classList.remove('cursor-not-allowed');
        submitButton.classList.add('cursor-pointer');
        return;

    }
    // end validation of 2 dates from vs to where from should be < to

    // height input validation
    function validateHeight(inputField) {

        const inputValue = parseFloat(inputField.value);
        let currentValue1 = inputField.value;
        let regexValidator = /^\d+(\.\d{1,2})?$/;
        let errorMessage = ' characters and has a valid email format.';
    
        var form = inputField.closest('form');
        var submitButton = form.querySelector('button[type="submit"]');

        if(!submitButton){
            submitButton = form.querySelector('button[type="button"]');
        }
    
        if ((inputValue < 1.0 || inputValue > 4.0) && regexValidator.test(inputValue)) {
            inputField.nextElementSibling.textContent = `Height must be between 1.00 and 4.00 meters`;
            inputField.classList.remove('focus:outline-blue-600');
            inputField.classList.add('border-red-600');
            inputField.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
            this.currentValue1 = inputField.value;
        } else if ((inputValue < 1.0 || inputValue > 4.0) && !regexValidator.test(inputValue)) {
            inputField.nextElementSibling.textContent = `Height must be between 1.00 and 4.00 meters`;
            inputField.classList.remove('focus:outline-blue-600');
            inputField.classList.add('border-red-600');
            inputField.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
            inputField.value = this.currentValue1;
        } else if (!regexValidator.test(inputValue)) {
            inputField.value = this.currentValue1;
            inputField.nextElementSibling.textContent = 'Invalid heigth.';
        } else {
            this.currentValue1 = inputField.value;
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
    // height input validation

// end of real-time validation