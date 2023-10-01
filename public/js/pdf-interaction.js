  // Show the modal
  function openConfirmationDialogApprovePendingPdf(ctrlno, personal_data_cesno) {
    const confirmationDialogApprovePendingPdf = document.getElementById('approve_pending_pdf_modal');
    const approve_file_ctrlno = document.getElementById('approve_file_ctrlno');
    const approve_file_personal_data_cesno = document.getElementById('approve_file_personal_data_cesno');

    approve_file_ctrlno.value = ctrlno;
    approve_file_personal_data_cesno.value = personal_data_cesno;
    
    confirmationDialogApprovePendingPdf.classList.remove('hidden');
  }
  
  // Close the modal when the close button is clicked
  document.getElementsByClassName('close-md')[0].addEventListener('click', function() {
    closeConfirmationDialogApprovePendingPdf();
  });
  
  // Close the modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('approve_pending_pdf_modal')) {
      closeConfirmationDialogApprovePendingPdf();
    }
  });
  
  // Close the modal
  function closeConfirmationDialogApprovePendingPdf() {
    document.getElementById('approve_pending_pdf_modal').classList.add('hidden');
  }