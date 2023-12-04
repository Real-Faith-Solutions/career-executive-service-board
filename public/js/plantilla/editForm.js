const btnSubmit = document.querySelector("#btnSubmit");
const btnEdit = document.querySelector("#btnEdit");
const btnCancelEdit = document.querySelector("#btnCancelEdit");
const form = document.querySelector("#updateForm");

let isEditing = false;
const originalFormValues = {}; // Store original form values

function updateUI() {
    if (isEditing) {
        // Update the button appearance
        // btnEdit.classList.remove("btn-primary");
        // btnEdit.classList.add("btn-secondary");
        // btnEdit.textContent = "Cancel Edit";

        btnEdit.classList.add("hidden");
        btnCancelEdit.classList.remove("hidden");

        // Enable all input, select, and textarea elements within the form
        const formElements = form.querySelectorAll("input, select, textarea");
        formElements.forEach((element) => {
            element.disabled = false;
        });

        // Show the "Save Changes" button
        btnSubmit.classList.remove("hidden");
    } else {
        // Update the button appearance
        // btnEdit.classList.remove("btn-secondary");
        // btnEdit.classList.add("btn-primary");
        // btnEdit.textContent = "Edit Record";

        btnEdit.classList.remove("hidden");
        btnCancelEdit.classList.add("hidden");

        // Disable all input, select, and textarea elements within the form
        const formElements = form.querySelectorAll("input, select, textarea");
        formElements.forEach((element) => {
            element.disabled = true;

            // Restore original values to the form fields
            if (originalFormValues[element.id]) {
                element.value = originalFormValues[element.id];
            }
        });

        // Hide the "Save Changes" button
        btnSubmit.classList.add("hidden");
    }
}

// Initialize the UI
updateUI();

btnEdit.addEventListener("click", function () {
    if (!isEditing) {
        // Store the original values of form fields when entering edit mode
        const formElements = form.querySelectorAll("input, select, textarea");
        formElements.forEach((element) => {
            originalFormValues[element.id] = element.value;
        });
    }

    isEditing = !isEditing; // Toggle the editing state
    updateUI(); // Update the UI based on the editing state
});

btnCancelEdit.addEventListener("click", function (event) {
    // Reset the form to its original values
    // const formElements = form.querySelectorAll("input, select, textarea");
    // formElements.forEach((element) => {
    //     if (originalFormValues[element.id]) {
    //         element.value = originalFormValues[element.id];
    //     }
    // });

    // isEditing = false;
    // updateUI();
    // event.preventDefault();

    // reload nalang para iwas error
    location.reload();
});
