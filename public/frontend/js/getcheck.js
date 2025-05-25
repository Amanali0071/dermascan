// Image Upload and Preview Functionality
function setupImageUpload() {
    var fileInput = document.getElementById("file-upload");
    var imagePreview = document.getElementById("image-preview");
    var submitBtn = document.getElementById("submit-btn");

    fileInput.addEventListener("change", function() {
        imagePreview.innerHTML = ""; // Clear previous previews
        var files = this.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.type.match("image.*")) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement("img");
                    img.src = e.target.result;
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    // Submit Button Functionality (Placeholder)
    submitBtn.addEventListener("click", function() {
        if (fileInput.files.length > 0) {
            alert("Images submitted for review! Our dermatologists will respond soon.");
            // Here you would typically send the files to a backend server
            // Example: uploadFiles(fileInput.files);
        } else {
            alert("Please upload at least one image before submitting.");
        }
    });
}

// Execute on page load
window.onload = function() {
    setupImageUpload();
};

// Placeholder function for backend upload (to be implemented based on your server)
function uploadFiles(files) {
    var formData = new FormData();
    for (var i = 0; i < files.length; i++) {
        formData.append("images[]", files[i]);
    }
    // Example fetch request (uncomment and adjust URL/auth as needed)
    /*
    fetch('/upload', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
    */
}