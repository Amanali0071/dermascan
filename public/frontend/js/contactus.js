document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    // Get form values
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();
    const formMessage = document.getElementById('formMessage');

    // Basic validation
    if (name && email && message) {
        // Simulate successful submission
        formMessage.textContent = 'Thank you for your message! We’ll get back to you soon.';
        formMessage.style.color = '#08afb4'; // Teal for success
        this.reset(); // Clear the form
    } else {
        formMessage.textContent = 'Please fill out all fields.';
        formMessage.style.color = '#e53e3e'; // Red for error
    }
});