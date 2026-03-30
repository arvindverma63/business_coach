<x-app-layout title="Add Coach | BestBusinessCoachIndia">
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2-container .select2-selection--single {
                height: 38px;
                line-height: 38px;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #556ee6;
                border: none;
                color: white;
            }

            .is-invalid+.select2-container--default .select2-selection--multiple {
                border-color: #dc3545;
            }
        </style>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Onboard New Coach</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.coaches.index') }}">Coaches</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="coachForm" action="{{ route('admin.coaches.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i>
                                    1. Account Details</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter full name">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Email Address <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" name="phone" id="phone_input" class="form-control"
                                            value="{{ old('phone', '+91') }}" maxlength="13" placeholder="+919876543210"
                                            oninput="validatePhoneNumber(this)">
                                        <small class="text-muted">Default country code is +91. Enter 10 digits only.</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Profile Image</label>
                                        <input type="file" name="profile_image" id="profile_image"
                                            class="form-control" accept="image/png, image/jpeg">
                                        <div class="mt-2">
                                            <img id="image_preview" src="" alt="Preview"
                                                style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; display: none; border: 1px solid #ddd;">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label d-block">Account Status</label>
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="status"
                                                value="1" id="accStatus" checked>
                                            <label class="form-check-label" for="accStatus">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-briefcase me-1"></i>
                                    2. Professional Profile</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Designation / Title</label>
                                        <input type="text" name="designation" class="form-control"
                                            placeholder="e.g. Senior Business Consultant">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" name="company_name" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Total Experience (Years)</label>
                                        <input type="number" name="experience_years" class="form-control"
                                            value="0">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">LinkedIn URL</label>
                                        <input type="url" name="linkedin_url" class="form-control"
                                            placeholder="https://linkedin.com/in/...">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Website URL</label>
                                        <input type="url" name="website_url" class="form-control"
                                            placeholder="https://...">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Expertise Categories</label>
                                        <select name="categories[]" class="form-control select2" multiple="multiple">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Bio / Achievements</label>
                                        <textarea name="bio" class="form-control" rows="4" placeholder="Tell us why this coach is famous..."></textarea>
                                    </div>
                                </div>

                                <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-star me-1"></i> 3.
                                    Visibility & Ranking</h5>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Ranking Score</label>
                                        <input type="number" name="ranking_score" class="form-control"
                                            value="0">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Current Rank</label>
                                        <input type="number" name="current_rank" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Approval Status</label>
                                        <select name="approval_status" class="form-select">
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="mt-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="is_visible"
                                                    value="1" id="isVisible" checked>
                                                <label class="form-check-label" for="isVisible">Publicly
                                                    Visible</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="is_featured"
                                                    value="1" id="isFeatured">
                                                <label class="form-check-label" for="isFeatured">Featured</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="submit" id="btnSubmit" class="btn btn-primary px-5">
                                        <span class="spinner-border spinner-border-sm d-none me-1" role="status"
                                            aria-hidden="true"></span>
                                        Create Coach Account
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    width: '100%'
                });

                function validatePhoneNumber(input) {
                    let value = input.value;

                    // Keep only digits and force Indian prefix
                    let digits = value.replace(/\D/g, '');

                    if (digits.startsWith('91')) {
                        digits = digits.slice(2);
                    }

                    digits = digits.slice(0, 10);
                    input.value = '+91' + digits;
                }

                // Attach the function to the global window scope so the oninput attribute can find it
                window.validatePhoneNumber = validatePhoneNumber;
                validatePhoneNumber(document.getElementById('phone_input'));

                // Prevent backspacing into the +91 prefix
                $('#phone_input').on('keydown', function(e) {
                    if (this.selectionStart <= 3 && e.key === 'Backspace') {
                        if (this.value.length <= 3) {
                            e.preventDefault();
                        }
                    }
                });

                // Image Preview
                $('#profile_image').change(function() {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = (e) => $('#image_preview').attr('src', e.target.result).show();
                        reader.readAsDataURL(file);
                    }
                });

                // AJAX Form Submission
                $('#coachForm').on('submit', function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let url = form.attr('action');
                    let formData = new FormData(this);
                    let btn = $('#btnSubmit');

                    // Reset errors
                    $('.error-text').remove();
                    $('.form-control, .form-select').removeClass('is-invalid');

                    // Show loading
                    btn.prop('disabled', true).find('.spinner-border').removeClass('d-none');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: res.message || 'Coach onboarded successfully.',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = "{{ route('admin.coaches.index') }}";
                            });
                        },
                        error: function(xhr) {
                            btn.prop('disabled', false).find('.spinner-border').addClass('d-none');

                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    // Handle array fields like categories[]
                                    let fieldName = key.replace(/\./g, '_');
                                    let input = $(`[name="${key}"], [name="${key}[]"]`);

                                    input.addClass('is-invalid');
                                    input.after(
                                        `<span class="text-danger error-text small mt-1 d-block">${value[0]}</span>`
                                    );
                                });

                                // Scroll to first error
                                $('html, body').animate({
                                    scrollTop: $(".is-invalid").first().offset().top - 120
                                }, 500);
                            } else {
                                Swal.fire('Error', 'Something went wrong. Please try again.',
                                    'error');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
