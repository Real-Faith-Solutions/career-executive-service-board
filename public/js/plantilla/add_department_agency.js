

// Open the modal when the add button is clicked
document.getElementById('agencyCreateBtn').addEventListener('click', function() {
    showModal();
  });

  // Close the modal when the close button is clicked
  document.getElementsByClassName('close-md')[0].addEventListener('click', function() {
    closeModal();
  });

  // Close the modal when the user clicks outside the modal content
  window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('agencyCreateModal')) {
      closeModal();
    }
  });

  // Show the modal
  function showModal() {
    document.getElementById('agencyCreateModal').classList.remove('hidden');

  }

  // Close the modal
  function closeModal() {
    document.getElementById('agencyCreateModal').classList.add('hidden');
  }

