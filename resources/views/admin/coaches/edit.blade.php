<x-app-layout title="Edit Coach | BestBusinessCoachIndia">

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2-container .select2-selection--single { height: 38px; line-height: 38px; }
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #556ee6; border: none; color: white;
            }
            .select2-container--default .select2-results__option[aria-selected=true] { display: none !important; }
            .preview-container { position: relative; width: 120px; height: 120px; }
            .remove-img-btn {
                position: absolute; top: -5px; right: -5px; background: #ef4444; color: white;
                border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center;
                justify-content: center; cursor: pointer; border: 2px solid white; font-size: 12px;
            }
        </style>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fs-18 fw-semibold m-0">Edit Coach Profile</h4>
                    <p class="mb-0 text-muted">User: {{ $coach->user->name }}</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    @php
                        $statusClasses = [ 'pending' => 'bg-warning text-dark', 'approved' => 'bg-success', 'rejected' => 'bg-danger' ];
                        $statusLabels = [ 'pending' => 'Pending Approval', 'approved' => 'Verified & Approved', 'rejected' => 'Rejected' ];
                    @endphp
                    <span class="badge {{ $statusClasses[$coach->approval_status] }} fs-14 px-3 py-2">
                        {{ $statusLabels[$coach->approval_status] }}
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form id="editCoachForm" action="{{ route('admin.coaches.update', $coach->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <h5 class="mb-3 text-uppercase bg-light p-2">1. Account Details</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $coach->user->name) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $coach->user->email) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $coach->user->phone) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender', $coach->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', $coach->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', $coach->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Profile Image</label>
                                        <input type="file" name="profile_image" id="profile_image" class="form-control mb-2" accept="image/*">
                                        <div class="preview-container {{ $coach->user->profile_image ? '' : 'd-none' }}" id="preview_wrap">
                                            <img id="image_preview"
                                                 src="{{ $coach->user->profile_image ? asset($coach->user->profile_image) : '#' }}"
                                                 style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                                            <div class="remove-img-btn" id="remove_preview" title="Remove selection">×</div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mb-3 text-uppercase bg-light p-2 mt-4">2. Professional Details</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Designation</label>
                                        <input type="text" name="designation" class="form-control" value="{{ old('designation', $coach->designation) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Company</label>
                                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $coach->company_name) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" class="form-control" value="{{ old('city', $coach->city) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" class="form-control" value="{{ old('state', $coach->state) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Experience (Years)</label>
                                        <input type="number" name="experience_years" class="form-control" value="{{ old('experience_years', $coach->experience_years) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">LinkedIn URL</label>
                                        <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $coach->linkedin_url) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Website URL</label>
                                        <input type="url" name="website_url" class="form-control" value="{{ old('website_url', $coach->website_url) }}">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Expertise Categories</label>
                                        <select name="categories[]" class="form-control select2" multiple="multiple">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $coach->categories->contains($category->id) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Bio / Achievements</label>
                                        <textarea name="bio" class="form-control" rows="5">{{ old('bio', $coach->bio) }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="show_personal_details" value="1" id="showDetails" {{ $coach->show_personal_details ? 'checked' : '' }}>
                                            <label class="form-check-label" for="showDetails">Show Personal Details</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featSwitch" {{ $coach->is_featured ? 'checked' : '' }}>
                                            <label class="form-check-label" for="featSwitch">Featured on Homepage</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-primary px-4">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card bg-light-subtle border-light">
                        <div class="card-header bg-light"><h5 class="card-title text-dark mb-0">Approval Actions</h5></div>
                        <div class="card-body">
                            <form action="{{ route('admin.coaches.update-status', $coach->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <div class="d-grid gap-2">
                                    @if ($coach->approval_status !== 'approved')
                                        <button name="status" value="approved" class="btn btn-success"><i class="mdi mdi-check-circle-outline me-1"></i> Approve Coach</button>
                                    @endif
                                    @if ($coach->approval_status !== 'rejected')
                                        <button name="status" value="rejected" class="btn btn-outline-danger"><i class="mdi mdi-close-circle-outline me-1"></i> Reject Application</button>
                                    @endif
                                    @if ($coach->approval_status !== 'pending')
                                        <button name="status" value="pending" class="btn btn-link text-muted">Mark as Pending</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><h5 class="card-title mb-0">Platform Stats</h5></div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3"><span class="text-muted">Current Rank</span><span class="fw-bold">#{{ $coach->current_rank ?? 'N/A' }}</span></div>
                            <div class="d-flex justify-content-between mb-3"><span class="text-muted">Ranking Score</span><span class="fw-bold">{{ $coach->ranking_score }}</span></div>
                            <div class="d-flex justify-content-between mb-3"><span class="text-muted">Total Views</span><span class="fw-bold">{{ $coach->profile_views }}</span></div>
                            <div class="d-flex justify-content-between"><span class="text-muted">Interactions</span><span class="fw-bold">{{ $coach->total_interactions }}</span></div>
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
            $(document).ready(function() {
                $('.select2').select2({ width: '100%' });

                $('#profile_image').change(function() {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('#image_preview').attr('src', e.target.result);
                            $('#preview_wrap').removeClass('d-none');
                        }
                        reader.readAsDataURL(file);
                    }
                });

                $('#remove_preview').click(function() {
                    $('#profile_image').val('');
                    @if(!$coach->user->profile_image)
                        $('#preview_wrap').addClass('d-none');
                    @else
                        $('#image_preview').attr('src', "{{ asset($coach->user->profile_image) }}");
                    @endif
                });

                $('#editCoachForm').on('submit', function(e) {
                    let isValid = true;
                    $('.error-text').remove();
                    $('.form-control').removeClass('is-invalid');
                    if ($('input[name="name"]').val().trim() === '') { showError($('input[name="name"]'), 'Name is required'); isValid = false; }
                    if ($('input[name="city"]').val().trim() === '') { showError($('input[name="city"]'), 'City is required'); isValid = false; }
                    if (!isValid) { e.preventDefault(); $('html, body').animate({ scrollTop: $(".is-invalid").first().offset().top - 100 }, 500); }
                });

                function showError(el, msg) { el.addClass('is-invalid').after('<span class="text-danger error-text small mt-1 d-block">'+msg+'</span>'); }
            });
        </script>
    @endpush
</x-app-layout>
