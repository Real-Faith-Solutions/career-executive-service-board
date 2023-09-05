  // Open the modal when the add button is clicked
  document.getElementById('changeRoleBtn').addEventListener('click', function() {
    showModalChangeRole();
  });
  
  // Close the modal when the close button is clicked
  document.getElementsByClassName('close-md')[0].addEventListener('click', function() {
    closeModalChangeRole();
  });
  
  // Close the modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('change_role_modal')) {
      closeModalChangeRole();
    }
  });
  
  // Show the modal
  function showModalChangeRole() {
    document.getElementById('change_role_modal').classList.remove('hidden');
  }
  
  // Close the modal
  function closeModalChangeRole() {
    document.getElementById('change_role_modal').classList.add('hidden');
  }