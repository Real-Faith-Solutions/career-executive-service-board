
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

    // initializing form and its inputs
    const form = document.getElementById('personal_data');
    const inputFieldLastName = document.getElementById('lastname');
    const ErrorMessageLastName = document.getElementById('ErrorMessageLastName');
    const inputFieldFirstname = document.getElementById('firstname');
    const ErrorMessageFirstname = document.getElementById('ErrorMessageFirstname');
    const inputFieldMiddlename = document.getElementById('middlename');
    const ErrorMessageMiddlename = document.getElementById('ErrorMessageMiddlename');
    const inputFieldNickname = document.getElementById('nickname');
    const ErrorMessageNickname = document.getElementById('ErrorMessageNickname');

    // assigning event listeners on each input
    inputFieldLastName.addEventListener('input', validateInputLastName);
    inputFieldLastName.addEventListener('keypress', validateInputLastName);
    inputFieldFirstname.addEventListener('input', validateInputFirstname);
    inputFieldFirstname.addEventListener('keypress', validateInputFirstname);
    inputFieldMiddlename.addEventListener('input', validateInputMiddlename);
    inputFieldMiddlename.addEventListener('keypress', validateInputMiddlename);
    inputFieldNickname.addEventListener('input', validateInputNickname);
    inputFieldNickname.addEventListener('keypress', validateInputNickname);

    // functions for disabling and enabling form submission
        // To disable form submission
        function preventFormSubmission(event) {
            event.preventDefault();
        }

        // To re-enable form submission
        function enableFormSubmission() {
            form.removeEventListener('submit', preventFormSubmission);
        }
    // end

    // lastname validations
    function validateInputLastName() {

        const inputValueLastName = inputFieldLastName.value;
        const charCode = event.which ? event.which : event.keyCode;

        if (inputValueLastName.length < 2 && !(charCode >= 48 && charCode <= 57)) {
            ErrorMessageLastName.textContent = 'Lastname must be at least 2 characters long.';
        }else if (charCode >= 48 && charCode <= 57) {
            event.preventDefault();
            ErrorMessageLastName.textContent = 'Input must not contain numbers.';
        }else {
            ErrorMessageLastName.textContent = '';
        }

    }
    // end of lastname validations

    // firstname validations
    function validateInputFirstname() {

        const inputValueFirstname = inputFieldFirstname.value;
        const charCode = event.which ? event.which : event.keyCode;

        if (inputValueFirstname.length < 2 && !(charCode >= 48 && charCode <= 57)) {
            ErrorMessageFirstname.textContent = 'Firstname must be at least 2 characters long.';
        }else if (charCode >= 48 && charCode <= 57) {
            event.preventDefault();
            ErrorMessageFirstname.textContent = 'Input must not contain numbers.';
        }else {
            ErrorMessageFirstname.textContent = '';
        }

    }
    // end of firstname validations

    // middlename validations
    function validateInputMiddlename() {

        const inputValueMiddlename = inputFieldMiddlename.value;
        const charCode = event.which ? event.which : event.keyCode;

        if (inputValueMiddlename.length < 2 && !(charCode >= 48 && charCode <= 57)) {
            ErrorMessageMiddlename.textContent = 'Middlename must be at least 2 characters long.';
        }else if (charCode >= 48 && charCode <= 57) {
            event.preventDefault();
            ErrorMessageMiddlename.textContent = 'Input must not contain numbers.';
        }else {
            ErrorMessageMiddlename.textContent = '';
        }

    }
    // end of middlename validations

        // nickname validations
        function validateInputNickname() {

            const inputValueNickname = inputFieldNickname.value;
            const charCode = event.which ? event.which : event.keyCode;
    
            if (charCode >= 48 && charCode <= 57) {
                event.preventDefault();
                ErrorMessageNickname.textContent = 'Input must not contain numbers.';
            }else {
                ErrorMessageNickname.textContent = '';
            }
    
        }
        // end of nickname validations


// end of real-time validation