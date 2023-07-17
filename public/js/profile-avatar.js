// Open the modal when the image is clicked
document.getElementById('profile-avatar').addEventListener('click', function() {
    showModal();
  });
  
  // Close the modal when the close button is clicked
  document.getElementsByClassName('close-avatar')[0].addEventListener('click', function() {
    closeModal();
  });
  
  // Close the modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('profile-avatar-modal')) {
      closeModal();
    }
  });
  
  // Show the modal
  function showModal() {
    document.getElementById('profile-avatar-modal').classList.remove('hidden');
  }
  
  // Close the modal
  function closeModal() {
    document.getElementById('profile-avatar-modal').classList.add('hidden');
  }

  // Submit the form when the upload button is clicked
    document.getElementById('uploadButtonAvatar').addEventListener('click', function() {
        document.getElementById('uploadFormAvatar').submit();
    });

 // Image Preview on Avatar 
    document.getElementById('imageInputAvatar').addEventListener('change', function(event) {
      var input = event.target;
      var reader = new FileReader();
    
      reader.onload = function(){
        var imagePreview = document.getElementById('imagePreviewAvatar');
        imagePreview.src = reader.result;
        imagePreview.classList.remove('hidden');
      };
    
      if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
      }
    });