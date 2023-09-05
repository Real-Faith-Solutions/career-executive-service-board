  // Open the modal when the add button is clicked
  // document.getElementById('changeRoleBtn').addEventListener('click', function() {
  //   showModalChangeRole();
  // });
  
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
  function showModalChangeRole(user_name, user_email, user_cesno) {
    document.getElementById('change_role_modal').classList.remove('hidden');
    const change_role_name = document.getElementById('change_role_name');
    const change_role_email = document.getElementById('change_role_email');
    const change_role_cesno = document.getElementById('change_role_cesno');
    change_role_name.value = user_name;
    change_role_email.value = user_email;
    change_role_cesno.value = user_cesno;
  }
  
  // Close the modal
  function closeModalChangeRole() {
    document.getElementById('change_role_modal').classList.add('hidden');
  }