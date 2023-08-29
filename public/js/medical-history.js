// Open the modal when the add button is clicked
document.getElementById('add_medical_history').addEventListener('click', function() {
    showModalMH();
  });
  
  // Close the modal when the close button is clicked
  document.getElementsByClassName('close-md')[0].addEventListener('click', function() {
    closeModalMH();
  });
  
  // Close the modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('add-medical-history-modal')) {
      closeModalMH();
    }
  });
  
  // Show the modal
  function showModalMH() {
    document.getElementById('add-medical-history-modal').classList.remove('hidden');
  }
  
  // Close the modal
  function closeModalMH() {
    document.getElementById('add-medical-history-modal').classList.add('hidden');
  }