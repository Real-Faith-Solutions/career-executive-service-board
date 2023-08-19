let errorMessageAvatar = document.getElementById('ErrorMessageAvatar');
let imageInputAvatar = document.getElementById('imageInputAvatar');
let uploadButtonAvatar = document.getElementById('uploadButtonAvatar');

  // Open the modal when the image is clicked
  document.getElementById('profile-avatar').addEventListener('click', function() {
    showModalAvatar();
  });
  
  // Close the modal when the close button is clicked
  document.getElementsByClassName('close-avatar')[0].addEventListener('click', function() {
    closeModalAvatar();
  });
  
  // Close the modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('profile-avatar-modal')) {
      closeModalAvatar();
    }
  });
  
  // Show the modal
  function showModalAvatar() {
    document.getElementById('profile-avatar-modal').classList.remove('hidden');
    if (errorMessageAvatar.textContent != '' || imageInputAvatar.value == '') {
      uploadButtonAvatar.classList.add('cursor-not-allowed');
      uploadButtonAvatar.classList.remove('cursor-pointer');
    }
  }
  
  // Close the modal
  function closeModalAvatar() {
    document.getElementById('profile-avatar-modal').classList.add('hidden');
  }

  // Submit the form when the upload button is clicked
    document.getElementById('uploadButtonAvatar').addEventListener('click', function(event) {
        
      if (errorMessageAvatar.textContent != '' || imageInputAvatar.value == '') {
          event.preventDefault();
          return;
      }
      
      document.getElementById('uploadFormAvatar').submit();
    });

 // Image Preview on Avatar 
    document.getElementById('imageInputAvatar').addEventListener('change', function(event) {

      let file = imageInputAvatar.files[0];
      let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
      let imagePreview = document.getElementById('imagePreviewAvatar');

      if (!allowedExtensions.test(file.name)) {
          // alert('Please upload a valid image file with the extensions .jpg, .jpeg, or .png.');
          this.value = '';
          imagePreview.src = '';
          imagePreview.classList.add('hidden');
          errorMessageAvatar.textContent = "Please upload a valid image file with the extensions .jpg, .jpeg, or .png.";
          uploadButtonAvatar.classList.add('cursor-not-allowed');
          uploadButtonAvatar.classList.remove('cursor-pointer');
          return;
      }

      let input = event.target;
      let reader = new FileReader();
    
      reader.onload = function(){
        imagePreview.src = reader.result;
        imagePreview.classList.remove('hidden');
      };

      if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
        errorMessageAvatar.textContent = "";
        uploadButtonAvatar.classList.remove('cursor-not-allowed');
        uploadButtonAvatar.classList.add('cursor-pointer');
      }

    });