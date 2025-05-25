<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Checked - DermaScan</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/getcheck.css') }}">
</head>

<body>
    <header>
        <a href="{{url('/')}}" style="text-decoration: none;">
            <div class="logo">DERMASCAN</div>
        </a>
        <nav>
            <ul>
                <li><a href="{{route('getcheck')}}">Get checked</a></li>
                <li><a href="{{route('aboutus')}}">About us</a></li>
                <li><a href="{{route('skinguide')}}">Skin Guide</a></li>
                <li><a href="{{route('research')}}">Research</a></li>
                <li><a href="{{route('contactus')}}">contact us</a></li>
                <li><a href="{{route('pharmacy')}}"><i class="fas fa-capsules" style="margin-right: 7px;"></i>Pharmacy</a></li>
                <li>
                    <a href="javascript:void(0);" id="cart-icon" class="button2" style="position:relative;">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-count" style="position:absolute;top:-8px;right:-8px;background:#08afb4;color:#fff;border-radius:50%;padding:2px 7px;font-size:12px;display:none;">0</span>
                    </a>
                </li>
                <li><a href="{{route('login')}}" class="button2"><i class="fas fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    
    <!-- Cart Sidebar -->
    <div id="cart-sidebar" style="position:fixed;top:0;right:-400px;width:350px;height:100vh;background:#fff;box-shadow:-2px 0 10px rgba(0,0,0,0.15);z-index:9999;transition:right 0.3s;padding:30px 20px 20px 20px;overflow-y:auto;">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h3 style="margin:0;font-size:22px;">Your Cart</h3>
            <button id="close-cart" style="background:none;border:none;font-size:22px;cursor:pointer;">&times;</button>
        </div>
        <div id="cart-items" style="margin-top:20px;"></div>
        <div id="cart-footer" style="margin-top:20px;display:none;">
            <hr>
            <div style="display:flex;justify-content:space-between;font-weight:bold;">
                <span>Total:</span>
                <span id="cart-total"></span>
            </div>
            <a href="{{ route('checkoutpharmacy') }}" class="button" style="width:85%;margin-top:15px;display:block;text-align:center;">Checkout</a>
        </div>
        <div id="cart-empty" style="margin-top:30px;text-align:center;color:#888;display:none;">
            <i class="fas fa-shopping-basket" style="font-size:40px;margin-bottom:10px;"></i>
            <div>Your cart is empty.</div>
        </div>
    </div>
    <script>
        // Show cart count if items exist
        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let count = cart.reduce((sum, item) => sum + item.qty, 0);
            let cartCount = document.getElementById('cart-count');
            if (count > 0) {
                cartCount.style.display = 'inline-block';
                cartCount.textContent = count;
            } else {
                cartCount.style.display = 'none';
            }
        }

        // Populate cart sidebar
        function populateCartSidebar() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let cartItems = document.getElementById('cart-items');
            let cartFooter = document.getElementById('cart-footer');
            let cartEmpty = document.getElementById('cart-empty');
            let cartTotal = document.getElementById('cart-total');
            cartItems.innerHTML = '';
            if (cart.length === 0) {
                cartFooter.style.display = 'none';
                cartEmpty.style.display = 'block';
                return;
            }
            cartFooter.style.display = 'block';
            cartEmpty.style.display = 'none';
            let total = 0;
            cart.forEach((item, idx) => {
                let itemTotal = parseFloat(item.price) * item.qty;
                total += itemTotal;
                cartItems.innerHTML += `
                    <div style="display:flex;align-items:center;margin-bottom:18px;" data-idx="${idx}">
                        <img src="${item.image}" alt="${item.name}" style="width:55px;height:55px;border-radius:8px;object-fit:cover;margin-right:12px;">
                        <div style="flex:1;">
                            <div style="font-weight:600;">${item.name}</div>
                            <div style="font-size:13px;color:#666;">
                                <button class="qty-btn" data-action="decrement" data-idx="${idx}" style="border:none;background:#eee;padding:2px 8px;border-radius:3px;font-size:16px;cursor:pointer;">-</button>
                                <span style="margin:0 7px;" id="qty-${idx}">${item.qty}</span>
                                <button class="qty-btn" data-action="increment" data-idx="${idx}" style="border:none;background:#eee;padding:2px 8px;border-radius:3px;font-size:16px;cursor:pointer;">+</button>
                                × Rs.${item.price}
                            </div>
                        </div>
                        <div style="font-weight:bold;margin-right:10px;">Rs.${itemTotal.toFixed(2)}</div>
                        <button class="delete-cart-item" data-idx="${idx}" style="background:none;border:none;color:#d00;font-size:18px;cursor:pointer;" title="Remove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
            });
            cartTotal.textContent = 'Rs.' + total.toFixed(2);

            // Add event listeners for quantity buttons and delete
            document.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    let idx = parseInt(this.getAttribute('data-idx'));
                    let action = this.getAttribute('data-action');
                    updateCartItemQty(idx, action);
                });
            });
            document.querySelectorAll('.delete-cart-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    let idx = parseInt(this.getAttribute('data-idx'));
                    removeCartItem(idx);
                });
            });
        }

        // Update quantity in cart
        function updateCartItemQty(idx, action) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            if (cart[idx]) {
                if (action === 'increment') {
                    cart[idx].qty += 1;
                } else if (action === 'decrement') {
                    cart[idx].qty -= 1;
                    if (cart[idx].qty < 1) cart[idx].qty = 1;
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                populateCartSidebar();
                updateCartCount();
            }
        }

        // Remove item from cart
        function removeCartItem(idx) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(idx, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            populateCartSidebar();
            updateCartCount();
        }

        // Open/close sidebar
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            // Show sidebar on cart icon click
            document.getElementById('cart-icon').addEventListener('click', function() {
                populateCartSidebar();
                document.getElementById('cart-sidebar').style.right = '0';
            });
            // Close sidebar
            document.getElementById('close-cart').addEventListener('click', function() {
                document.getElementById('cart-sidebar').style.right = '-400px';
            });
            // Update cart count on storage change (for multi-tab)
            window.addEventListener('storage', function(e) {
                if (e.key === 'cart') updateCartCount();
            });
        });

        // Also update cart count after addToCart is called
        function updateCartAfterAdd() {
            updateCartCount();
        }
        // If you use addToCart elsewhere, call updateCartAfterAdd() after localStorage.setItem
    </script>

    <!-- Main Content -->
    <main>
        <!-- How It Works Section -->
        <section class="how-it-works">
            <h1>How It Works</h1>
            <p>Learn how to upload your skin images and get expert dermatological advice in just a few steps.</p>

            <!-- Steps -->
            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <h2>Upload Your Images</h2>
                    <p>Click the upload area or drag and drop clear photos of your affected skin. Ensure they are
                        well-lit and unfiltered for accurate analysis.</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h2>Add a Description (Optional)</h2>
                    <p>Provide a brief description of your skin condition, including symptoms or history, to help our
                        dermatologists understand your case better.</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h2>Submit for Review</h2>
                    <p>Click "Submit for Analysis" to send your images and description securely to our board-certified
                        dermatologists for a professional review.</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h2>Get Your Results</h2>
                    <p>Receive a detailed response within hours, including a likely diagnosis and treatment options, all
                        from the comfort of your home.</p>
                </div>
            </div>
        </section>

        <!-- Upload Section -->
        <section class="upload-section">
            <h1>Upload Your Skin Images</h1>
            <p>Upload clear images of your skin condition for analysis by board-certified dermatologists.</p>
            <form id="uploadForm" action="{{ route('model-api') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Selection Mechanism -->
                <div class="upload-option">
                    <label><input type="radio" name="method" value="upload" checked> Upload Images</label>
                    <label><input type="radio" name="method" value="camera"> Live Camera Scan</label>
                </div>

                <!-- Upload Container -->
                <div id="uploadContainer">
                    <div class="form-group">
                        <label for="imageUpload">Choose Images</label>
                        <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple>
                        <p class="upload-hint">Or drag and drop images here (Maximum 2 images, 5MB each)</p>
                    </div>
                </div>

                <!-- Camera Container -->
                <div id="cameraContainer">
                    <video id="video" width="320" height="240" autoplay></video><br>
                    <button type="button" id="capture">Capture Image</button>
                    <p class="camera-hint">Position your skin condition in the frame and click capture</p>
                </div>

                <!-- Description -->
                <div class="form-group1">
                    <label for="description">Description (Optional)</label>
                    <textarea id="description" name="description"
                        placeholder="Describe your skin condition, including when it started, any pain or itching, and if you've tried any treatments"></textarea>
                </div>

                <!-- Submit Button -->
                @php
                    $isPremium = auth()->check() && auth()->user()->is_premium;
                @endphp

                @if (!$isPremium)
                    <a href="{{ route('show.payment.form') }}" target="_blank" type="button" id="getPremiumBtn"
                        class="button2" style="margin-bottom: 10px;">
                        Get a Premium Check Up
                    </a>
                @endif
                @if (!auth()->check())
                    <a href="{{ route('login') }}" target="_blank" type="button" id="loginBtn" class="button2"
                        style="margin-bottom: 10px;">
                        Get a Premium Check Up
                    </a>
                @else
                    {{-- User is logged in --}}
                    <button type="button" id="proceedLink" {{ $isPremium ? '' : 'disabled' }}>
                        {{ $isPremium ? 'Proceed to Next' : 'Proceed to Basic Check Up' }}
                    </button>
                @endif

                {{-- <button type="button" id="proceedLink" disabled>Proceed to Next</button> --}}
            </form>

            <!-- Image Preview Section -->
            <div class="image-preview">
                <h2>Selected Images</h2>
                <div id="imageCounter">0/2 images</div>
                <div id="previewContainer"></div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <div class="column">
                <h3>The Company</h3>
                <ul>
                    <li><a href="#">Send a Case</a></li>
                    <li><a href="#">Review Your Case</a></li>
                    <li><a href="#">The Team</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Get Involved</h3>
                <ul>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Partnerships</a></li>
                    <li><a href="#">Spot Cancer</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Skin Image Search</a></li>
                    <li><a href="#">Partner Program</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-info">
            <p>DermaScan Ai</p>
            <p></p>
            <p>
                <a href="#">Terms & Conditions</a> -
                <a href="#">Website Terms of Use</a>
            </p>
            <p>
                <a href="#">Privacy Notice</a> -
                <a href="#">Privacy Shield</a> -
                <a href="#">Terms & Conditions Autoderm</a>
            </p>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/twitter?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <!-- JavaScript for Image Upload, Camera, and Form Handling -->
    <script>
        // Get all necessary DOM elements
        // Accept only 2 images (for both upload and capture)
        const maxImages = 2; // Maximum allowed images
        const minImages = 2; // Minimum required images
        const uploadForm = document.getElementById('uploadForm');
        const uploadRadio = document.querySelector('input[name="method"][value="upload"]');
        const cameraRadio = document.querySelector('input[name="method"][value="camera"]');
        const uploadContainer = document.getElementById('uploadContainer');
        const cameraContainer = document.getElementById('cameraContainer');
        const video = document.getElementById('video');
        const captureButton = document.getElementById('capture');
        const fileInput = document.getElementById('imageUpload');
        const description = document.getElementById('description');
        const previewContainer = document.getElementById('previewContainer');
        const proceedLink = document.getElementById('proceedLink');
        const imageCounter = document.getElementById('imageCounter');

        // Variables to store captured images and manage state
        let capturedImages = [];
        let cameraStream = null;
        let isProcessing = false; // Flag to prevent multiple submissions

        // Initialize the UI
        function initUI() {
            // Set default view
            uploadContainer.style.display = 'block';
            cameraContainer.style.display = 'none';

            // Setup drag and drop functionality
            setupDragAndDrop();

            // Clear any existing previews
            previewContainer.innerHTML = '';

            // Add event listeners
            uploadRadio.addEventListener('change', handleMethodChange);
            cameraRadio.addEventListener('change', handleMethodChange);
            captureButton.addEventListener('click', captureImage);
            fileInput.addEventListener('change', handleFileSelect);
            proceedLink.addEventListener('click', handleSubmission);

            // Prevent default form submission
            uploadForm.addEventListener('submit', (e) => e.preventDefault());
        }

        // Handle switching between upload and camera methods
        function handleMethodChange() {
            if (uploadRadio.checked) {
                switchToUploadMode();
            } else if (cameraRadio.checked) {
                switchToCameraMode();
            }
        }

        // Switch to image upload mode
        function switchToUploadMode() {
            uploadContainer.style.display = 'block';
            cameraContainer.style.display = 'none';
            previewContainer.innerHTML = '';
            capturedImages = [];

            // Stop camera if active
            stopCamera();

            // Show uploaded images if any
            if (fileInput.files.length > 0) {
                displayUploadedFiles();
            }

            updateImageCounter();
        }

        // Switch to camera capture mode
        function switchToCameraMode() {
            uploadContainer.style.display = 'none';
            cameraContainer.style.display = 'block';
            previewContainer.innerHTML = '';
            capturedImages = [];
            fileInput.value = ''; // Clear file input

            // Start camera
            startCamera();

            updateImageCounter();
        }

        // Start camera with error handling
        function startCamera() {
            const constraints = {
                video: {
                    width: {
                        ideal: 1280
                    },
                    height: {
                        ideal: 720
                    },
                    facingMode: 'environment' // Prefer rear camera on mobile
                }
            };

            navigator.mediaDevices.getUserMedia(constraints)
                .then(stream => {
                    video.srcObject = stream;
                    cameraStream = stream;
                    video.play();
                    captureButton.disabled = false;
                })
                .catch(error => {
                    console.error('Error accessing camera:', error);
                    showNotification(
                        'Could not access the camera. Please check permissions or try a different browser.', 'error'
                    );
                    // Fall back to upload mode
                    uploadRadio.checked = true;
                    switchToUploadMode();
                });
        }

        // Stop camera stream
        function stopCamera() {
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }

            if (video.srcObject) {
                const tracks = video.srcObject.getTracks();
                tracks.forEach(track => track.stop());
                video.srcObject = null;
            }
        }

        // Capture image from video feed
        function captureImage() {
            if (!video.srcObject) {
                showNotification('Camera is not active. Please allow camera access.', 'error');
                return;
            }

            if (capturedImages.length >= maxImages) {
                showNotification(`Maximum of ${maxImages} images allowed. Delete some to capture more.`, 'warning');
                return;
            }

            // Create canvas to capture the frame
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');

            // Draw video frame to canvas
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Get image data as JPEG
            const dataUrl = canvas.toDataURL('image/jpeg', 0.85);

            // Add to captured images array
            capturedImages.push(dataUrl);

            // Display in preview
            addImageToPreview(dataUrl, true);

            // Provide feedback
            showNotification('Image captured successfully!', 'success');

            // Update UI state based on number of images
            updateButtonState();
            updateImageCounter();
        }

        // Handle file selection
        function handleFileSelect() {
            previewContainer.innerHTML = '';
            capturedImages = [];

            const files = fileInput.files;
            let validFiles = 0;
            let invalidFiles = 0;

            if (files.length > maxImages) {
                showNotification(`Please select maximum ${maxImages} images.`, 'warning');
                fileInput.value = '';
                return;
            }

            // Process each file
            Array.from(files).forEach(file => {
                // Check file type
                if (!file.type.match('image.*')) {
                    invalidFiles++;
                    return;
                }

                // Check file size (5MB max)
                const maxSize = 5 * 1024 * 1024;
                if (file.size > maxSize) {
                    invalidFiles++;
                    showNotification(`File "${file.name}" is too large. Maximum size is 5MB.`, 'error');
                    return;
                }

                validFiles++;
                const reader = new FileReader();
                reader.onload = (e) => addImageToPreview(e.target.result, false);
                reader.readAsDataURL(file);
            });

            if (invalidFiles > 0) {
                showNotification(
                    `${invalidFiles} files were skipped because they were not valid images or exceeded size limit.`,
                    'warning');
            }

            if (validFiles === 0) {
                fileInput.value = '';
            }

            // Update UI state
            updateButtonState();
            updateImageCounter();
        }

        // Display uploaded files in preview
        function displayUploadedFiles() {
            previewContainer.innerHTML = '';

            for (const file of fileInput.files) {
                const reader = new FileReader();
                reader.onload = (e) => addImageToPreview(e.target.result, false);
                reader.readAsDataURL(file);
            }
        }

        // Add image to preview with delete functionality
        // Add image to preview with delete functionality
        function addImageToPreview(imageSrc, isCamera) {
            const imageContainer = document.createElement('div');
            imageContainer.className = 'preview-image-container';

            const img = document.createElement('img');
            img.src = imageSrc;
            img.className = 'preview-image';
            img.alt = 'Skin image preview';

            const deleteBtn = document.createElement('button');
            deleteBtn.className = 'delete-image-btn';
            deleteBtn.innerHTML = '<i class="fas fa-times"></i>';
            deleteBtn.title = 'Remove image';

            // Set up delete functionality
            deleteBtn.addEventListener('click', () => {
                if (isCamera) {
                    // Remove from captured images array
                    const index = capturedImages.indexOf(imageSrc);
                    if (index > -1) {
                        capturedImages.splice(index, 1);
                    }
                } else {
                    // For uploaded files, we need to create a new FileList
                    // Since FileList objects are immutable, we need to create a new one without the deleted image
                    const currentFiles = fileInput.files;
                    const dataTransfer = new DataTransfer();

                    // Find which image was deleted by comparing to current preview images
                    const previewImages = previewContainer.querySelectorAll('.preview-image-container');
                    const index = Array.from(previewImages).indexOf(imageContainer);

                    // Add all files except the one at the found index
                    for (let i = 0; i < currentFiles.length; i++) {
                        if (i !== index) {
                            dataTransfer.items.add(currentFiles[i]);
                        }
                    }

                    // Set the new FileList to the file input
                    fileInput.files = dataTransfer.files;
                }

                // Remove from preview
                previewContainer.removeChild(imageContainer);
                updateButtonState();
                updateImageCounter();
            });

            imageContainer.appendChild(img);
            imageContainer.appendChild(deleteBtn);
            previewContainer.appendChild(imageContainer);
        }
        // Set up drag and drop functionality
        function setupDragAndDrop() {
            const dropArea = uploadContainer;

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropArea.classList.add('highlight');
            }

            function unhighlight() {
                dropArea.classList.remove('highlight');
            }

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0) {
                    // Create a new FileList-like object
                    const dataTransfer = new DataTransfer();

                    // Add all dropped files
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type.match('image.*')) {
                            dataTransfer.items.add(files[i]);
                        }
                    }

                    // Set to file input
                    fileInput.files = dataTransfer.files;

                    // Trigger change event
                    const event = new Event('change');
                    fileInput.dispatchEvent(event);
                }
            }
        }

        // Update image counter
        function updateImageCounter() {
            let imageCount = 0;

            if (uploadRadio.checked) {
                imageCount = fileInput.files.length;
            } else if (cameraRadio.checked) {
                imageCount = capturedImages.length;
            }

            imageCounter.textContent = `${imageCount}/${maxImages} images`;
        }

        // Update button state based on number of images
        function updateButtonState() {
            let imageCount = 0;

            if (uploadRadio.checked) {
                imageCount = fileInput.files.length;
            } else if (cameraRadio.checked) {
                imageCount = capturedImages.length;
            }

            if (imageCount >= minImages) {
                proceedLink.disabled = false;
                proceedLink.classList.add('active');
            } else {
                proceedLink.disabled = true;
                proceedLink.classList.remove('active');
            }
        }

        // Handle form submission
        async function handleSubmission(e) {
            e.preventDefault();

            if (isProcessing) return;
            // Validate number of images
            let imageCount = 0;
            if (uploadRadio.checked) {
                imageCount = fileInput.files.length;
            } else if (cameraRadio.checked) {
                imageCount = capturedImages.length;
            }

            if (imageCount < minImages) {
                showNotification(`Please select at least ${minImages} images to proceed.`, 'error');
                return;
            }

            isProcessing = true;
            showNotification('Processing your images...', 'info');

            try {
                // Prepare form data
                const formData = new FormData();
                formData.append('description', description.value);
                formData.append('_token', document.querySelector('input[name="_token"]').value);

                if (uploadRadio.checked) {
                    // For uploaded files
                    for (const file of fileInput.files) {
                        formData.append('images[]', file);
                    }
                } else if (cameraRadio.checked) {
                    // For captured images
                    for (let i = 0; i < capturedImages.length; i++) {
                        // Convert data URL to blob
                        const blob = await dataURLtoBlob(capturedImages[i]);
                        formData.append('images[]', blob, `captured_${i}.jpg`);
                    }
                }

                // Store data for next page if needed
                storeDataForNextPage();

                // Submit the form
                fetch(uploadForm.action, {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin'
                    })
                    .then(response => response.blob())
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        window.open(url); // Stream the PDF in a new tab
                    })
                    // .then(data => {
                    //     showNotification('Images uploaded successfully!', 'success');
                    //     console.log(data);

                        // Redirect to the next page
                        // setTimeout(() => {
                        //     window.location.href = data.redirect || '/paymentplan';
                        // }, 1000);
                    // })?
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('There was a problem with your submission. Please try again.', 'error');
                        isProcessing = false;
                    });
            } catch (error) {
                console.error('Error:', error);
                showNotification('There was a problem with your submission. Please try again.', 'error');
                isProcessing = false;
            }
        }

        // Store data for next page if needed
        function storeDataForNextPage() {
            if (uploadRadio.checked && fileInput.files.length > 0) {
                const imagesData = [];
                let processed = 0;

                for (const file of fileInput.files) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        imagesData.push(reader.result);
                        processed++;

                        if (processed === fileInput.files.length) {
                            localStorage.setItem('uploadedImages', JSON.stringify(imagesData));
                            localStorage.setItem('description', description.value);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            } else if (cameraRadio.checked && capturedImages.length > 0) {
                localStorage.setItem('uploadedImages', JSON.stringify(capturedImages));
                localStorage.setItem('description', description.value);
            }
        }

        // Convert data URL to Blob
        function dataURLtoBlob(dataURL) {
            const parts = dataURL.split(';base64,');
            const contentType = parts[0].split(':')[1];
            const raw = window.atob(parts[1]);
            const rawLength = raw.length;
            const uInt8Array = new Uint8Array(rawLength);

            for (let i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }

            return new Blob([uInt8Array], {
                type: contentType
            });
        }

        // Show notification
        function showNotification(message, type = 'info') {
            // Check if notification container exists
            let notificationContainer = document.getElementById('notification-container');

            if (!notificationContainer) {
                // Create notification container if it doesn't exist
                notificationContainer = document.createElement('div');
                notificationContainer.id = 'notification-container';
                document.body.appendChild(notificationContainer);

                // Add styles for the notification container
                notificationContainer.style.position = 'fixed';
                notificationContainer.style.top = '20px';
                notificationContainer.style.right = '20px';
                notificationContainer.style.zIndex = '9999';
                notificationContainer.style.maxWidth = '350px';
            }

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <span class="notification-message">${message}</span>
                    <button class="notification-close">&times;</button>
                </div>
            `;

            // Add styles based on type
            switch (type) {
                case 'success':
                    notification.style.backgroundColor = '#d4edda';
                    notification.style.color = '#155724';
                    notification.style.borderColor = '#c3e6cb';
                    break;
                case 'error':
                    notification.style.backgroundColor = '#f8d7da';
                    notification.style.color = '#721c24';
                    notification.style.borderColor = '#f5c6cb';
                    break;
                case 'warning':
                    notification.style.backgroundColor = '#fff3cd';
                    notification.style.color = '#856404';
                    notification.style.borderColor = '#ffeeba';
                    break;
                default:
                    notification.style.backgroundColor = '#d1ecf1';
                    notification.style.color = '#0c5460';
                    notification.style.borderColor = '#bee5eb';
            }

            // Add general styles
            notification.style.padding = '12px 15px';
            notification.style.marginBottom = '10px';
            notification.style.borderRadius = '6px';
            notification.style.border = '1px solid transparent';
            notification.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)';

            // Add close button functionality
            const closeBtn = notification.querySelector('.notification-close');
            closeBtn.style.background = 'none';
            closeBtn.style.border = 'none';
            closeBtn.style.float = 'right';
            closeBtn.style.fontSize = '20px';
            closeBtn.style.cursor = 'pointer';
            closeBtn.style.marginLeft = '10px';

            closeBtn.addEventListener('click', () => {
                notificationContainer.removeChild(notification);
            });

            // Add notification to container
            notificationContainer.appendChild(notification);

            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode === notificationContainer) {
                    notificationContainer.removeChild(notification);
                }
            }, 5000);
        }

        // Clean up when leaving the page
        function cleanup() {
            stopCamera();
        }

        // Initialize when the DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            initUI();
            updateButtonState();

            // Add cleanup on page unload
            window.addEventListener('beforeunload', cleanup);
        });
    </script>
</body>

</html>
