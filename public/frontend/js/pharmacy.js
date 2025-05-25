// Modal Popup Functionality for Pharmacy Page
function setupModal() {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("modalImage");
    var closeBtn = document.getElementsByClassName("close")[0];

    // Function to open the modal with the clicked image
    window.openModal = function(imageSrc) {
        modal.style.display = "block";
        modalImg.src = imageSrc;
        setTimeout(function() {
            modal.classList.add("show");
        }, 10); // Small delay for smooth fade-in
    };

    // Close the modal when the close button is clicked
    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.classList.remove("show");
            setTimeout(function() {
                modal.style.display = "none";
            }, 300); // Matches CSS transition duration
        };
    }

    // Close the modal when clicking outside the image
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.classList.remove("show");
            setTimeout(function() {
                modal.style.display = "none";
            }, 300);
        }
    };

    // Close the modal with the Escape key
    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape" && modal.style.display === "block") {
            modal.classList.remove("show");
            setTimeout(function() {
                modal.style.display = "none";
            }, 300);
        }
    });
}

// Execute on page load
window.onload = function() {
    setupModal();
};