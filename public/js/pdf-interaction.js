  // Close the modal when the close button is clicked
  document.getElementsByClassName('close-md')[0].addEventListener('click', function() {
    closeModalMH();
  });
  
  // Close the modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('approve-pending-pdf-modal')) {
      closeModalMH();
    }
  });
  
  // Show the modal
  function openConfirmationDialogApprovePendingPdf(this, ctrlno, personal_data_cesno) {
    document.getElementById('approve-pending-pdf-modal').classList.remove('hidden');
  }
  
  // Close the modal
  function closeModalMH() {
    document.getElementById('approve-pending-pdf-modal').classList.add('hidden');
  }