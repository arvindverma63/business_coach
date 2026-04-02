<x-seeker-layout title="Edit Profile | BestBusinessCoach">
    <div class="container-fluid">
        <div class="py-3">
            <h4 class="fs-20 fw-bold m-0 text-dark">My Profile Settings</h4>
            <p class="text-muted font-size-13">Update your personal information and business preferences.</p>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('seeker.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom-0 pt-3">
                            <h5 class="card-title mb-0">Personal Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div class="position-relative">
                                    <img id="imagePreview"
                                        src="{{ $user->profile_image ? asset($user->profile_image) : asset('assets/images/users/user-dummy-img.jpg') }}"
                                        class="rounded-circle border p-1"
                                        style="width: 100px; height: 100px; object-fit: cover;">

                                    <label for="profile_image"
                                        class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 32px; height: 32px; cursor: pointer; border: 3px solid #fff;">
                                        <i class="mdi mdi-camera font-size-16"></i>
                                    </label>
                                    <input type="file" name="profile_image" id="profile_image" class="d-none"
                                        accept="image/*">
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-1 fs-16">Profile Photo</h5>
                                    <p class="text-muted font-size-13 mb-0">Update your avatar. Recommended size:
                                        256x256.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Email Address</label>
                                    <input type="email" class="form-control bg-light" value="{{ $user->email }}"
                                        readonly>
                                    <small class="text-muted">Email cannot be changed.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+91</span>
                                        <input type="text" name="phone" class="form-control phone-input"
                                            value="{{ old('phone', str_replace('+91', '', $user->phone ?? '')) }}"
                                            placeholder="9999999999"
                                            maxlength="10"
                                            inputmode="numeric"
                                            @error('phone') is-invalid @enderror>
                                    </div>
                                    @error('phone')
                                        <span class="text-danger font-size-12">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom-0 pt-3">
                            <h5 class="card-title mb-0">Business & Professional Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Business Domain / Industry</label>
                                    <input type="text" name="business_domain" class="form-control"
                                        value="{{ old('business_domain', $profile->business_domain ?? '') }}"
                                        placeholder="Enter your business domain or industry">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Company Name</label>
                                    <input type="text" name="company_name" class="form-control"
                                        value="{{ old('company_name', $profile->company_name ?? '') }}"
                                        placeholder="e.g. Verma Solutions">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">City</label>
                                    <input type="text" name="city" class="form-control"
                                        value="{{ old('city', $profile->city ?? '') }}" placeholder="e.g. Kanpur">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">State</label>
                                    <input type="text" name="state" class="form-control"
                                        value="{{ old('state', $profile->state ?? '') }}"
                                        placeholder="e.g. Uttar Pradesh">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mb-5">
                        <a href="{{ route('seeker.dashboard') }}" class="btn btn-light px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Profile Changes</button>
                    </div>
                </form>
            </div>


        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('profile_image').onchange = function(evt) {
                const [file] = this.files;
                if (file) {
                    document.getElementById('imagePreview').src = URL.createObjectURL(file);
                }
            }

            // Phone number input - only numeric values
            const phoneInput = document.querySelector('.phone-input');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    // Remove all non-numeric characters
                    this.value = this.value.replace(/[^0-9]/g, '');

                    // Limit to 10 digits
                    if (this.value.length > 10) {
                        this.value = this.value.slice(0, 10);
                    }
                });

                // Prevent non-numeric paste
                phoneInput.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pastedText = (e.clipboardData || window.clipboardData).getData('text');
                    const numericOnly = pastedText.replace(/[^0-9]/g, '').slice(0, 10);
                    this.value = numericOnly;
                });
            }
        </script>
    @endpush
</x-seeker-layout>
