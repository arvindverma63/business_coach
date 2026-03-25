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
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Email Address <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Profile Image</label>
                                        <input type="file" name="profile_image" id="profile_image" class="form-control"
                                            accept="image/*">
                                        {{-- Image Preview Container --}}
                                        <div class="mt-2">
                                            <img id="image_preview"
                                                src="{{ asset('website/assets/img/Rectangle5339.png') }}" alt="Preview"
                                                style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; display: none; border: 1px solid #ddd;">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label d-block">Account Status</label>
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="status" value="1"
                                                id="accStatus" checked>
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
                                            placeholder="e.g. Senior Business Consultant"
                                            value="{{ old('designation') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" name="company_name" class="form-control"
                                            value="{{ old('company_name') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" class="form-control" value="{{ old('state') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Total Experience (Years)</label>
                                        <input type="number" name="experience_years" class="form-control"
                                            value="{{ old('experience_years', 0) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">LinkedIn URL</label>
                                        <input type="url" name="linkedin_url" class="form-control"
                                            placeholder="https://linkedin.com/in/..." value="{{ old('linkedin_url') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Website URL</label>
                                        <input type="url" name="website_url" class="form-control"
                                            placeholder="https://..." value="{{ old('website_url') }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Expertise Categories</label>
                                        <select name="categories[]" class="form-control select2" multiple="multiple"
                                            data-placeholder="Select Categories...">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Bio / Achievements</label>
                                        <textarea name="bio" class="form-control" rows="4"
                                            placeholder="Tell us why this coach is famous...">{{ old('bio') }}</textarea>
                                    </div>
                                </div>

                                <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-star me-1"></i> 3.
                                    Visibility & Ranking</h5>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Ranking Score</label>
                                        <input type="number" name="ranking_score" class="form-control"
                                            value="{{ old('ranking_score', 0) }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Current Rank</label>
                                        <input type="number" name="current_rank" class="form-control"
                                            value="{{ old('current_rank') }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Approval Status</label>
                                        <select name="approval_status" class="form-select">
                                            <option value="pending" {{ old('approval_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ old('approval_status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ old('approval_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="mt-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="is_visible"
                                                    value="1" id="isVisible" checked>
                                                <label class="form-check-label" for="isVisible">Publicly Visible</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="is_featured"
                                                    value="1" id="isFeatured">
                                                <label class="form-check-label" for="isFeatured">Featured Coach</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-primary px-5">Create Coach Account</button>
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
        <script>
            $(document).ready(function () {
                $('.select2').select2({ width: '100%', hideSelected: true });

                $('#profile_image').change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            // Update the src of the preview image and make it visible
                            $('#image_preview').attr('src', event.target.result).show();
                        }
                        reader.readAsDataURL(file);
                    } else {
                        // Hide preview if no file is selected
                        $('#image_preview').hide();
                    }
                });

                $('#coachForm').on('submit', function (e) {
                    let isValid = true;
                    $('.error-text').remove();
                    $('.form-control').removeClass('is-invalid');

                    const requiredFields = {
                        'name': 'Full Name is required.',
                        'email': 'Email Address is required.',
                        'city': 'City is required.'
                    };

                    for (let field in requiredFields) {
                        let el = $(`[name="${field}"]`);
                        if (el.val().trim() === '') {
                            showError(el, requiredFields[field]);
                            isValid = false;
                        }
                    }

                    if (!isValid) {
                        e.preventDefault();
                        $('html, body').animate({ scrollTop: $(".is-invalid").first().offset().top - 100 }, 500);
                    }
                });

                function showError(element, message) {
                    element.addClass('is-invalid');
                    element.after('<span class="text-danger error-text small mt-1 d-block">' + message + '</span>');
                }
            });
        </script>
    @endpush
</x-app-layout>
