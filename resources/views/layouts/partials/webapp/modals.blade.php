{{-- coach modal form --}}

<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    Professional Profile
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Progress Bar -->
                <div id="coachFormProgress" style="display: none; margin-bottom: 15px;">
                    <div class="progress" style="height: 6px;">
                        <div id="coachFormProgressBar" class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted d-block mt-2" id="coachFormProgressText">Uploading...</small>
                </div>

                <form id="coachRegistrationForm" action="{{ route('webapp.coach-registration') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-inner">
                        <!-- ── LEFT SIDEBAR ── -->
                        <div class="profile-sidebar">
                            <!-- Avatar -->
                            <div class="avatar-wrap">
                                <div class="avatar-circle" onclick="document.getElementById('avatarInput').click()"
                                    style="cursor: pointer" title="Click to change photo">
                                    <img id="avatarImg"
                                        src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                        alt="Coach Avatar" />
                                    <div class="cam-btn">
                                        <i class="bi bi-camera"></i>
                                    </div>
                                </div>
                                <input type="file" id="avatarInput" name="profile_picture" accept="image/*"
                                    style="display: none" />
                                {{-- <div class="avatar-name" id="avatarName">Coach Name</div> --}}
                            </div>

                            @php
                                $categories = App\Models\Category::where('is_active', true)->get();
                            @endphp
                            <!-- Expertise Categories -->
                            <div class="sidebar-section">
                                <div class="sidebar-section-title">Expertise Categories <span class="text-danger">*</span></div>
                                @forelse($categories ?? [] as $category)
                                    <label class="category-check">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" />
                                        {{ $category->name }}
                                    </label>
                                @empty
                                    <p class="text-muted small">No categories available</p>
                                @endforelse
                            </div>

                            <!-- Social Links -->
                            <div class="sidebar-section">
                                <div class="sidebar-section-title">Social Links</div>
                                <div class="social-input">
                                    <label>LinkedIn URL</label>
                                    <input type="url" name="linkedin_url"
                                        placeholder="https://linkedin.com/in/..." />
                                </div>
                                <div class="social-input">
                                    <label>Website URL</label>
                                    <input type="url" name="website_url" placeholder="https://yourwebsite.com" />
                                </div>
                            </div>
                        </div>
                        <!-- /sidebar -->

                        <!-- ── RIGHT FORM ── -->
                        <div class="profile-form">
                            <div class="form-section-title">Personal Information</div>

                            <!-- Row 1: Full Name + Email -->
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value=""
                                        placeholder="Enter full name" required />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" value=""
                                        placeholder="Enter email" required />
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" name="phone" id="coach_phone_input" class="form-control"
                                        value="+91" placeholder="+919876543210" maxlength="13"
                                        oninput="validatePhone(this)" />
                                </div>
                            </div>


                            <!-- Row 2: Company + Designation -->
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" value=""
                                        placeholder="Enter company name" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Designation</label>
                                    <input type="text" name="designation" class="form-control" value=""
                                        placeholder="Enter designation" />
                                </div>
                            </div>

                            <!-- Row 3: Gender + Experience + Toggle -->
                            <div class="row g-3 mb-3 align-items-end">
                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Experience (Years)</label>
                                    <input type="number" name="experience_years" class="form-control"
                                        value="" placeholder="Years" />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="toggle-row pb-1">
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox"
                                                name="show_personal_details" id="showPersonal" checked />
                                        </div>
                                        <label for="showPersonal"
                                            style="
                              font-size: 0.78rem;
                              color: var(--text);
                              font-weight: 600;
                              cursor: pointer;
                            ">Show
                                            Personal Details</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Row 4: Bio -->
                            <div class="mb-3">
                                <label class="form-label">Professional Bio</label>
                                <textarea name="bio" class="form-control" placeholder="Write a short professional bio..." rows="4"></textarea>
                            </div>

                            <!-- Row 5: City + State + Country -->
                            <div class="form-section-title mt-2">Location</div>
                            <div class="row g-3">
                                <div class="col-12 col-sm-4">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" value=""
                                        placeholder="City" />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" class="form-control" placeholder="State" />
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" value=""
                                        placeholder="Country" />
                                </div>
                            </div>
                        </div>
                        <!-- /form -->
                    </div>
                    <!-- /modal-inner -->
                </form>
            </div>
            <!-- /modal-body -->

            <!-- Footer -->
            <div class="modal-footer">
                <div class="w-100 text-center mb-2">
                    <span class="text-muted">Already have any account? </span>
                    <a href="{{ route('user.login', ['role' => 'coach']) }}" class="text-decoration-none">Login</a>
                </div>
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="coachRegistrationForm" class="btn-update">Create Profile</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div id="toastContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

@push('scripts')
    <style>
        /* Loading animation styles */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes dots {

            0%,
            20% {
                content: '.';
            }

            40% {
                content: '..';
            }

            60%,
            100% {
                content: '...';
            }
        }

        .btn-loading {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        .btn-loading-text {
            display: inline-block;
        }
    </style>

    <script>
        // Toast Notification Function
        function showToast(message, type = 'info', duration = 5000) {
            const toastId = 'toast-' + Date.now();
            const bgColor = {
                'success': '#198754',
                'error': '#dc3545',
                'warning': '#ffc107',
                'info': '#0d6efd'
            } [type] || '#0d6efd';

            const toastHTML = `
                    <div id="${toastId}" class="toast align-items-center text-white border-0" role="alert" style="margin-bottom: 10px; background-color: ${bgColor};">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                `;

            $('#toastContainer').append(toastHTML);
            const $toast = $(`#${toastId}`);
            const toast = new bootstrap.Toast($toast[0]);
            toast.show();

            $toast.on('hidden.bs.toast', function() {
                $toast.remove();
            });

            if (duration > 0) {
                setTimeout(() => {
                    toast.hide();
                }, duration);
            }
        }

        function validateCoachForm() {
            let isValid = true;
            const errors = [];

            // Select the form specifically
            const $form = $('#coachRegistrationForm');

            // 1. Full Name validation (Scoped to $form)
            const nameInput = $form.find('input[name="name"]');
            const name = nameInput.val().trim();

            if (!name) {
                isValid = false;
                errors.push('Full Name is required');
                nameInput.addClass('is-invalid');
            } else {
                nameInput.removeClass('is-invalid');
            }

            // 2. Email validation (Scoped to $form)
            const emailInput = $form.find('input[name="email"]');
            const email = emailInput.val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!email) {
                isValid = false;
                errors.push('Email is required');
                emailInput.addClass('is-invalid');
            } else if (!emailRegex.test(email)) {
                isValid = false;
                errors.push('Please enter a valid email');
                emailInput.addClass('is-invalid');
            } else {
                emailInput.removeClass('is-invalid');
            }

            const phoneInput = $form.find('input[name="phone"]');
            const phone = phoneInput.val().trim();
            if (phone && !/^\+[0-9]{12}$/.test(phone)) {
                isValid = false;
                errors.push('Phone number must be in +91XXXXXXXXXX format');
                phoneInput.addClass('is-invalid');
            } else {
                phoneInput.removeClass('is-invalid');
            }

            const selectedCategories = $form.find('input[name="categories[]"]:checked').length;
            if (selectedCategories === 0) {
                isValid = false;
                errors.push('Please select at least one expertise category');
                $form.find('input[name="categories[]"]').addClass('is-invalid');
            } else {
                $form.find('input[name="categories[]"]').removeClass('is-invalid');
            }

            if (!isValid && errors.length > 0) {
                // Only show the first error to avoid toast spam
                showToast(errors[0], 'error', 4000);
            }

            return isValid;
        }

        // Update avatar name when full name is entered
        document.addEventListener('DOMContentLoaded', function() {
            const fullNameInput = document.querySelector('input[name="name"]');
            const avatarName = document.getElementById('avatarName');
            if (fullNameInput) {
                fullNameInput.addEventListener('change', function() {
                    avatarName.textContent = this.value || 'Coach Name';
                });
            }

            // Handle avatar upload preview
            const avatarInput = document.getElementById('avatarInput');
            const avatarImg = document.getElementById('avatarImg');
            if (avatarInput) {
                avatarInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            avatarImg.src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Handle coach registration form submission with AJAX
            $('#coachRegistrationForm').on('submit', function(e) {
                e.preventDefault();

                // Validate form
                if (!validateCoachForm()) {
                    return;
                }

                const $form = $(this);
                const $submitBtn = $form.find('button[type="submit"]');
                const originalBtnText = $submitBtn.text();
                const $progressContainer = $('#coachFormProgress');
                const $progressBar = $('#coachFormProgressBar');
                const $progressText = $('#coachFormProgressText');

                // Create FormData to handle file uploads
                const formData = new FormData(this);

                // Show loading state and progress bar
                $submitBtn.prop('disabled', true).html(`
                    <span class="btn-loading">
                        <span class="btn-loading-spinner"></span>
                        <span class="btn-loading-text">Sending data<span class="dots">.</span></span>
                    </span>
                `);
                $progressContainer.show();
                $progressBar.css('width', '0%');
                $progressText.text('Starting upload...');

                // Animate dots in button
                let dotCount = 1;
                const dotInterval = setInterval(() => {
                    dotCount = (dotCount % 3) + 1;
                    $submitBtn.find('.dots').text('.'.repeat(dotCount));
                }, 400);

                // Simulate progress
                let progress = 0;
                const progressInterval = setInterval(() => {
                    if (progress < 90) {
                        progress += Math.random() * 30;
                        if (progress > 90) progress = 90;
                        $progressBar.css('width', progress + '%');
                    }
                }, 300);

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                const percentComplete = (e.loaded / e.total) * 100;
                                $progressBar.css('width', percentComplete + '%');
                                $progressText.text('Uploading... ' + Math.round(
                                    percentComplete) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        clearInterval(progressInterval);
                        clearInterval(dotInterval);
                        $progressBar.css('width', '100%');
                        $progressText.text('Completed!');

                        // Show success toast
                        showToast(response.message || 'Profile created successfully!',
                            'success', 3000);

                        // Reset form
                        $form[0].reset();

                        // Close modal after short delay
                        setTimeout(() => {
                            $('#profileModal').modal('hide');
                            $progressContainer.hide();

                            // Redirect or refresh if needed
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        }, 1500);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                        clearInterval(progressInterval);
                        clearInterval(dotInterval);
                        $progressContainer.hide();
                        let errorMessage = 'An error occurred. Please try again.';

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            // Handle validation errors from server
                            const errors = xhr.responseJSON.errors;

                            for (const field in errors) {
                                const errorText = errors[field].join(', ');
                                showToast(field + ': ' + errorText, 'error', 5000);
                                $('[name="' + field + '"]').addClass('is-invalid');
                            }
                            errorMessage = 'Please check the highlighted fields';
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        // Show main error toast
                        showToast(errorMessage, 'error', 5000);
                    },
                    complete: function() {
                        // Restore button state
                        clearInterval(dotInterval);
                        $submitBtn.prop('disabled', false).html(originalBtnText);
                    }
                });
            });

            // Clear validation errors on input
            $('#coachRegistrationForm').find('input, select, textarea').on('change', function() {
                $(this).removeClass('is-invalid');
            });

            // ================================================================
            // SEEKER FORM VALIDATION AND SUBMISSION
            // ================================================================

            // Form Validation for Seeker
            function validateSeekerForm() {
                let isValid = true;
                const errors = [];

                // Full Name validation
                const name = $('#seekerRegistrationForm input[name="name"]').val().trim();
                if (!name) {
                    isValid = false;
                    errors.push('Full Name is required');
                    $('#seekerRegistrationForm input[name="name"]').addClass('is-invalid');
                } else {
                    $('#seekerRegistrationForm input[name="name"]').removeClass('is-invalid');
                }

                // Email validation
                const email = $('#seekerRegistrationForm input[name="email"]').val().trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email) {
                    isValid = false;
                    errors.push('Email is required');
                    $('#seekerRegistrationForm input[name="email"]').addClass('is-invalid');
                } else if (!emailRegex.test(email)) {
                    isValid = false;
                    errors.push('Please enter a valid email');
                    $('#seekerRegistrationForm input[name="email"]').addClass('is-invalid');
                } else {
                    $('#seekerRegistrationForm input[name="email"]').removeClass('is-invalid');
                }

                if (!isValid && errors.length > 0) {
                    errors.forEach(error => {
                        showToast(error, 'error', 4000);
                    });
                }

                return isValid;
            }

            // Handle seeker registration form submission with AJAX
            $('#seekerRegistrationForm').on('submit', function(e) {
                e.preventDefault();

                // Validate form
                if (!validateSeekerForm()) {
                    return;
                }

                const $form = $(this);
                const $submitBtn = $form.find('button[type="submit"]');
                const originalBtnText = $submitBtn.text();
                const $progressContainer = $('#seekerFormProgress');
                const $progressBar = $('#seekerFormProgressBar');
                const $progressText = $('#seekerFormProgressText');

                // Create FormData to handle file uploads
                const formData = new FormData(this);

                // Show loading state and progress bar
                $submitBtn.prop('disabled', true).html(`
                    <span class="btn-loading">
                        <span class="btn-loading-spinner"></span>
                        <span class="btn-loading-text">Sending data<span class="dots">.</span></span>
                    </span>
                `);
                $progressContainer.show();
                $progressBar.css('width', '0%');
                $progressText.text('Starting registration...');

                // Animate dots in button
                let dotCount = 1;
                const dotInterval = setInterval(() => {
                    dotCount = (dotCount % 3) + 1;
                    $submitBtn.find('.dots').text('.'.repeat(dotCount));
                }, 400);

                // Simulate progress
                let progress = 0;
                const progressInterval = setInterval(() => {
                    if (progress < 90) {
                        progress += Math.random() * 30;
                        if (progress > 90) progress = 90;
                        $progressBar.css('width', progress + '%');
                    }
                }, 300);

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                const percentComplete = (e.loaded / e.total) * 100;
                                $progressBar.css('width', percentComplete + '%');
                                $progressText.text('Processing... ' + Math.round(
                                    percentComplete) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        clearInterval(progressInterval);
                        clearInterval(dotInterval);
                        $progressBar.css('width', '100%');
                        $progressText.text('Completed!');

                        // Show success toast
                        showToast(response.message || 'Registration successful!', 'success',
                            3000);

                        // Reset form
                        $form[0].reset();

                        // Close modal after short delay
                        setTimeout(() => {
                            $('#profileModal1').modal('hide');
                            $progressContainer.hide();

                            // Redirect or refresh if needed
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        }, 1500);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                        clearInterval(progressInterval);
                        clearInterval(dotInterval);
                        $progressContainer.hide();
                        let errorMessage = 'An error occurred. Please try again.';

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            // Handle validation errors from server
                            const errors = xhr.responseJSON.errors;

                            for (const field in errors) {
                                const errorText = errors[field].join(', ');
                                showToast(field + ': ' + errorText, 'error', 5000);
                                $('#seekerRegistrationForm').find('[name="' + field + '"]')
                                    .addClass('is-invalid');
                            }
                            errorMessage = 'Please check the highlighted fields';
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        // Show main error toast
                        showToast(errorMessage, 'error', 5000);
                    },
                    complete: function() {
                        // Restore button state
                        clearInterval(dotInterval);
                        $submitBtn.prop('disabled', false).html(originalBtnText);
                    }
                });
            });

            // Clear validation errors on input for seeker form
            $('#seekerRegistrationForm').find('input, select, textarea').on('change', function() {
                $(this).removeClass('is-invalid');
            });

            // Handle seeker profile image preview
            const seekerProfileImage = document.getElementById('seekerProfileImage');
            const seekerProfilePreview = document.getElementById('seekerProfilePreview');
            if (seekerProfileImage) {
                seekerProfileImage.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            seekerProfilePreview.src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endpush
{{-- Seeker Modal --}}
<div class="modal fade" id="profileModal1" tabindex="-1" aria-labelledby="seekerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="seekerModalLabel">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    Seeker Registration
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Progress Bar -->
                <div id="seekerFormProgress" style="display: none; margin-bottom: 15px;">
                    <div class="progress" style="height: 6px;">
                        <div id="seekerFormProgressBar"
                            class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted d-block mt-2" id="seekerFormProgressText">Uploading...</small>
                </div>

                <form id="seekerRegistrationForm" action="{{ route('webapp.seeker-registration') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-section-title">Personal Information</div>

                    <!-- Row 1: Full Name + Email -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value=""
                                placeholder="Enter full name" required />
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value=""
                                placeholder="Enter email" required />
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" id="phone_input" class="form-control"
                                value="+91" placeholder="+919876543210" maxlength="13"
                                oninput="validatePhone(this)" required />
                            <div id="phone-help" class="form-text small text-muted">
                                Format: +91 followed by 10 digits (Total max 13 characters).
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="form-label">Profile Image</label>
                            <div class="profile-image-upload">
                                <div class="profile-image-preview mb-3">
                                    <img id="seekerProfilePreview"
                                        src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                        alt="Profile Preview"
                                        style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;" />
                                </div>

                                <input type="file" id="seekerProfileImage" name="profile_image"
                                    class="form-control" accept=".jpg, .jpeg, .png" />

                                <small class="text-muted d-block mt-2">
                                    Recommended size: 256x256px (JPG, PNG - Max 2MB)
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="form-section-title mt-4">Business & Professional Details</div>

                    <!-- Row 3: Business Domain + Company Name -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Business Domain / Industry</label>
                            <input type="text" name="business_domain" class="form-control" value=""
                                placeholder="e.g., IT, Marketing, Finance" />
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control" value=""
                                placeholder="Enter company name" />
                        </div>
                    </div>

                    <div class="form-section-title mt-2">Location</div>

                    <!-- Row 4: City + State -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value=""
                                placeholder="City" />
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" value=""
                                placeholder="State" />
                        </div>
                    </div>
                </form>
            </div>
            <!-- /modal-body -->

            <!-- Footer -->
            <div class="modal-footer">
                <div class="w-100 text-center mb-2">
                    <span class="text-muted">Already have any account? </span>
                    <a href="{{ route('user.login', ['role' => 'seeker']) }}" class="text-decoration-none">Login</a>
                </div>
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="seekerRegistrationForm" class="btn-update">Register</button>
            </div>
        </div>
    </div>
</div>
<script>
    function validatePhone(input) {
        let value = input.value;

        // 1. Force the string to start with '+'
        if (!value.startsWith('+')) {
            // If they deleted the +, put it back at the start
            value = '+' + value.replace(/\D/g, '');
        }

        // 2. Remove any character that is NOT a digit (except the leading +)
        // We slice from index 1 to keep the '+' and clean the rest
        const plusSign = value.charAt(0);
        const digits = value.slice(1).replace(/\D/g, '');

        value = plusSign + digits;

        // 3. Enforce Max Length of 13
        if (value.length > 13) {
            value = value.slice(0, 13);
        }

        input.value = value;
    }

    // Optional: Prevent the user from deleting the +91 prefix entirely
    ['phone_input', 'coach_phone_input'].forEach(function(inputId) {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('keydown', function(e) {
                if (this.selectionStart <= 3 && e.key === 'Backspace') {
                    if (this.value.length <= 3) {
                        e.preventDefault();
                    }
                }
            });
        }
    });
</script>
@push('scripts')
    <script>
        $('#seekerProfileImage').change(function() {
            const file = this.files[0];
            if (file) {
                const fileType = file.type;
                if (fileType === "image/gif") {
                    toastr.error("GIF files are not allowed. Please upload a JPG or PNG.");
                    $(this).val(''); // Clear the input
                    return false;
                }
            }
        });
    </script>
@endpush
