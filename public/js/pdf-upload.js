let ErrorMessagePDF = document.getElementById('ErrorMessagePDF');
let pdfFile = document.getElementById('pdfFile');
let uploadButtonPDF = document.getElementById('uploadButtonPDF');

    // Submit the form when the upload button is clicked
    document.getElementById('uploadButtonPDF').addEventListener('click', function(event) {
        
      if (pdfFile.value == '') {
          event.preventDefault();
          return;
      }
      
      document.getElementById('uploadFormPDF').submit();
    });

    // validate pdf 
    document.getElementById('pdfFile').addEventListener('change', function(event) {

      let file = pdfFile.files[0];
      let allowedExtensions = /(\.pdf)$/i;

      if (!allowedExtensions.test(file.name)) {
          // alert('Please upload a valid image file with the extensions .jpg, .jpeg, or .png.');
          this.value = '';
          ErrorMessagePDF.textContent = "Please upload a valid pdf file with the extension .pdf";
          ErrorMessagePDF.classList.remove('text-green-600');
          ErrorMessagePDF.classList.add('text-red-600');
          uploadButtonPDF.classList.add('cursor-not-allowed');
          uploadButtonPDF.classList.remove('cursor-pointer');
          return;
      }

      let input = event.target;

      if (input.files && input.files[0]) {
        ErrorMessagePDF.textContent = "";
        ErrorMessagePDF.classList.remove('text-red-600');
        ErrorMessagePDF.classList.add('text-green-600');
        // Display file size
        let fileSizeInMB = file.size / (1024 * 1024); // Convert bytes to megabytes
        ErrorMessagePDF.textContent = `File size: ${fileSizeInMB.toFixed(2)} MB`;
        uploadButtonPDF.classList.remove('cursor-not-allowed');
        uploadButtonPDF.classList.add('cursor-pointer');
      }

    });