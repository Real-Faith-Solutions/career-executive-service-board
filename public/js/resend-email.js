// Open the modal when the add button is clicked
document.getElementById('resend_email').addEventListener('click', function() {
    showModalResendEmail();
  });
  
  // Close the modal when the close button is clicked
  document.getElementsByClassName('close-md')[0].addEventListener('click', function() {
    closeModalResendEmail();
  });
  
  // Close the modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('resend_email_modal')) {
      closeModalResendEmail();
    }
  });
  
  // Show the modal
  function showModalResendEmail() {
    document.getElementById('resend_email_modal').classList.remove('hidden');
  }
  
  // Close the modal
  function closeModalResendEmail() {
    document.getElementById('resend_email_modal').classList.add('hidden');
  }