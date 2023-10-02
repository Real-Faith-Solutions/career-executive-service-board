  // Show the approve modal
  function openConfirmationDialogApprovePendingPdf(ctrlno, personal_data_cesno) {
    const confirmationDialogApprovePendingPdf = document.getElementById('approve_pending_pdf_modal');
    const approve_file_ctrlno = document.getElementById('approve_file_ctrlno');
    const approve_file_personal_data_cesno = document.getElementById('approve_file_personal_data_cesno');

    approve_file_ctrlno.value = ctrlno;
    approve_file_personal_data_cesno.value = personal_data_cesno;
    
    confirmationDialogApprovePendingPdf.classList.remove('hidden');
  }
  
  // Close the approve modal when the close button is clicked
  document.getElementsByClassName('close-md')[0].addEventListener('click', function() {
    closeConfirmationDialogApprovePendingPdf();
  });
  
  // Close the approve modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('approve_pending_pdf_modal')) {
      closeConfirmationDialogApprovePendingPdf();
    }
  });
  
  // Close the approve modal
  function closeConfirmationDialogApprovePendingPdf() {
    document.getElementById('approve_pending_pdf_modal').classList.add('hidden');
  }
  
  // Show the decline modal
  function openConfirmationDialogDeclinePendingPdf(ctrlno, personal_data_cesno) {
    const ConfirmationDialogDeclinePendingPdf = document.getElementById('decline_pending_pdf_modal');
    const decline_file_ctrlno = document.getElementById('decline_file_ctrlno');
    const decline_file_personal_data_cesno = document.getElementById('decline_file_personal_data_cesno');

    decline_file_ctrlno.value = ctrlno;
    decline_file_personal_data_cesno.value = personal_data_cesno;
    
    ConfirmationDialogDeclinePendingPdf.classList.remove('hidden');
  }
  
  // Close the decline modal when the close button is clicked
  document.getElementsByClassName('close-md')[0].addEventListener('click', function() {
    closeConfirmationDialogDeclinePendingPdf();
  });
  
  // Close the decline modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('decline_pending_pdf_modal')) {
      closeConfirmationDialogDeclinePendingPdf();
    }
  });
  
  // Close the decline modal
  function closeConfirmationDialogDeclinePendingPdf() {
    document.getElementById('decline_pending_pdf_modal').classList.add('hidden');
  }