    
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      myimage.src = URL.createObjectURL(file)
    }
  }

  // JavaScript code to update the label text
const fileInput = document.getElementById('imgInp');
const uploadLabel = document.getElementById('uploadLabel');

fileInput.addEventListener('change', function() {
  const fileName = this.value.split('\\').pop();
  uploadLabel.textContent = fileName ? fileName : 'Upload Image';
});
