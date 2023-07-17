
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

    // initializing personal_data_form and its inputs
    const personal_data_form = document.getElementById('personal_data');
    const inputFieldLastName = document.getElementById('lastname');
    const ErrorMessageLastName = document.getElementById('ErrorMessageLastName');
    const inputFieldFirstname = document.getElementById('firstname');
    const ErrorMessageFirstname = document.getElementById('ErrorMessageFirstname');
    const inputFieldMiddlename = document.getElementById('middlename');
    const ErrorMessageMiddlename = document.getElementById('ErrorMessageMiddlename');
    const inputFieldNickname = document.getElementById('nickname');
    const ErrorMessageNickname = document.getElementById('ErrorMessageNickname');

    // assigning event listeners on each input
    inputFieldLastName.addEventListener('input', function() {validateInput(inputFieldLastName, 2);});
    inputFieldLastName.addEventListener('keypress', function() {validateInput(inputFieldLastName, 2);});
    inputFieldFirstname.addEventListener('input', function() {validateInput(inputFieldFirstname, 2);});
    inputFieldFirstname.addEventListener('keypress', function() {validateInput(inputFieldFirstname, 2);});
    inputFieldMiddlename.addEventListener('input', function() {validateInput(inputFieldMiddlename, 2);});
    inputFieldMiddlename.addEventListener('keypress', function() {validateInput(inputFieldMiddlename, 2);});
    inputFieldNickname.addEventListener('input', function() {validateInput(inputFieldNickname, 0);});
    inputFieldNickname.addEventListener('keypress', function() {validateInput(inputFieldNickname, 0);});
    // personal_data_submit.addEventListener('keypress', validateInputNickname);

    // functions for disabling and enabling personal_data_form submission
    let personal_data_errors = document.querySelectorAll('.personal_data_error');

    personal_data_form.addEventListener('submit', function(event) {
        for (let i = 0; i < personal_data_errors.length; i++) {
            if (personal_data_errors[i].textContent != '') {
                event.preventDefault();
                break;
            }
        }
    });
    // end

    // Add click event listener to the document body
    document.body.addEventListener('click', function(event) {
        // Check if the clicked element is the input field
        if (event.target !== inputFieldLastName) {
            if(ErrorMessageLastName.textContent == 'Input must not contain numbers.'){
                ErrorMessageLastName.textContent = '';
            }
        }

        if (event.target !== inputFieldFirstname) {
            if(ErrorMessageFirstname.textContent == 'Input must not contain numbers.'){
                ErrorMessageFirstname.textContent = '';
            }
        }

        if (event.target !== inputFieldMiddlename) {
            if(ErrorMessageMiddlename.textContent == 'Input must not contain numbers.'){
                ErrorMessageMiddlename.textContent = '';
            }
        }

        if (event.target !== inputFieldNickname) {
            if(ErrorMessageNickname.textContent == 'Input must not contain numbers.'){
                ErrorMessageNickname.textContent = '';
            }
        }
      });
    // end of Add click event listener to the document body

    // last/first/middle/nickname validations
    function validateInput(inputField, minLength) {
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
        } else if (inputValue.length < minLength && (charCode >= 48 && charCode <= 57)) {
            event.preventDefault();
            inputField.nextElementSibling.textContent = `At least ${minLength} characters without numbers.`;
            inputField.classList.remove('focus:outline-blue-600');
            inputField.classList.add('border-red-600');
            inputField.classList.add('focus:outline-red-500');
            submitButton.disabled = true;
            submitButton.classList.remove('cursor-pointer');
            submitButton.classList.add('cursor-not-allowed');
        } else if (charCode >= 48 && charCode <= 57) {
            event.preventDefault();
            inputField.nextElementSibling.textContent = 'Input must not contain numbers.';
        } else {
            inputField.nextElementSibling.textContent = '';
            inputField.classList.remove('focus:outline-red-500');
            inputField.classList.remove('border-red-600');
            inputField.classList.add('focus:outline-blue-600');
            submitButton.disabled = false;
            submitButton.classList.remove('cursor-not-allowed');
            submitButton.classList.add('cursor-pointer');
        }
    }
    // last/first/middle/nickname validations

// end of real-time validation