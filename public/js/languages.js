  // Open the modal when the add button is clicked
  document.getElementById('add-edit-languages-btn').addEventListener('click', function() {
    showModalLanguage();
  });
  
  // Close the modal when the close button is clicked
  document.getElementsByClassName('close-md')[0].addEventListener('click', function() {
    closeModalLanguage();
  });
  
  // Close the modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('add-edit-languages-modal')) {
      closeModalLanguage();
    }
  });
  
  // Show the modal
  function showModalLanguage() {
    document.getElementById('add-edit-languages-modal').classList.remove('hidden');
  }
  
  // Close the modal
  function closeModalLanguage() {
    document.getElementById('add-edit-languages-modal').classList.add('hidden');
  }