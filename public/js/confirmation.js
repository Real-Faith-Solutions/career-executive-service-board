function openConfirmationDialog(buttonElement) {
    const confirmationBackdrop = document.getElementById('confirmationBackdrop');
    const confirmationDialog = document.getElementById('confirmationDialog');

    // Get the form associated with the delete button using its ID
    const form = buttonElement.closest('form');

    // Set the form ID as data attribute on the dialog
    confirmationDialog.setAttribute('data-form-id', form.id);

    confirmationBackdrop.classList.remove('hidden');
    confirmationDialog.classList.remove('hidden');
}

function closeConfirmationDialog() {
    const confirmationBackdrop = document.getElementById('confirmationBackdrop');
    const confirmationDialog = document.querySelector('[data-form-id]');

    confirmationBackdrop.classList.add('hidden');
    confirmationDialog.classList.add('hidden');
}

function deleteItem() {
    const confirmationDialog = document.querySelector('[data-form-id]');
    const formId = confirmationDialog.getAttribute('data-form-id');

    const form = document.getElementById(formId);
    form.submit();
}

// Close the modal when the user clicks outside the modal content
window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('confirmationBackdrop')) {
        closeConfirmationDialog();
    }
  });
