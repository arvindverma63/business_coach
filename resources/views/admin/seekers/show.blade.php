@php
    $profile = $seeker;
    $avatarInitials = strtoupper(substr($profile->user->name ?? 'S', 0, 2));
    $notificationPreferences = is_array($profile->notification_preferences ?? null) ? $profile->notification_preferences : [];
    $preferenceItems = [
        'Email' => data_get($notificationPreferences, 'email', false),
        'SMS' => data_get($notificationPreferences, 'sms', false),
        'Push' => data_get($notificationPreferences, 'push', false),
    ];
@endphp

<x-app-layout title="Seeker Profile | BestBusinessCoachIndia">
    @push('styles')
        <style>
            .profile-hero {
                background: linear-gradient(135deg, #f8fbff 0%, #eef4ff 100%);
                border: 1px solid rgba(85, 110, 230, 0.08);
            }

            .profile-avatar {
                width: 88px;
                height: 88px;
                display: grid;
                place-items: center;
                border-radius: 24px;
                background: linear-gradient(135deg, #556ee6, #7b8ef3);
                color: #fff;
                font-weight: 700;
                font-size: 2rem;
                box-shadow: 0 12px 30px rgba(85, 110, 230, 0.2);
            }

            .info-item {
                padding: 0.9rem 1rem;
                border: 1px solid #edf1f5;
                border-radius: 14px;
                background: #fff;
                height: 100%;
            }

            .info-label {
                font-size: 12px;
                color: #6c757d;
                text-transform: uppercase;
                letter-spacing: .04em;
                margin-bottom: .35rem;
            }

            .info-value {
                font-weight: 600;
                color: #2f3e4d;
                word-break: break-word;
            }

            .section-title {
                font-size: 12px;
                font-weight: 700;
                letter-spacing: .08em;
                color: #6c757d;
                text-transform: uppercase;
            }
        </style>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4 class="fs-18 fw-semibold m-0">Seeker Details</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.seekers.index') }}">Seekers</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </nav>
                </div>

                <a href="{{ route('admin.seekers.index') }}" class="btn btn-light">
                    <i class="mdi mdi-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <div class="card profile-hero mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-3">
                                <div class="profile-avatar">
                                    {{ $avatarInitials }}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                        <h4 class="mb-0">{{ $profile->user->name ?? 'Seeker' }}</h4>
                                    </div>
                                    <p class="text-muted mb-2">
                                        <i class="mdi mdi-email-outline me-1"></i>{{ $profile->user->email ?? 'Not provided' }}
                                    </p>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-light text-dark px-3 py-2">
                                            <i class="mdi mdi-phone-outline me-1"></i>{{ $profile->user->phone ?? 'Not provided' }}
                                        </span>
                                        <span class="badge bg-light text-dark px-3 py-2">
                                            <i class="mdi mdi-domain me-1"></i>{{ $profile->company_name ?? 'No company added' }}
                                        </span>
                                        <span class="badge bg-light text-dark px-3 py-2">
                                            <i class="mdi mdi-map-marker-outline me-1"></i>
                                            {{ trim(($profile->city ?? 'N/A') . ', ' . ($profile->state ?? 'N/A')) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="info-item text-center">
                                        <div class="info-label">Domain</div>
                                        <div class="info-value">{{ $profile->business_domain ?? 'General' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-7">
                    <div class="card mb-4">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Profile Overview</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">Full Name</div>
                                        <div class="info-value">{{ $profile->user->name ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">Email Address</div>
                                        <div class="info-value">{{ $profile->user->email ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">Phone Number</div>
                                        <div class="info-value">{{ $profile->user->phone ?? 'Not provided' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">Business Domain</div>
                                        <div class="info-value">{{ $profile->business_domain ?? 'General' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">Company</div>
                                        <div class="info-value">{{ $profile->company_name ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">Location</div>
                                        <div class="info-value">
                                            {{ $profile->city ?? 'N/A' }}{{ $profile->state ? ', ' . $profile->state : '' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">Account Created</div>
                                        <div class="info-value">
                                            {{ optional($profile->user->created_at)->format('d M Y, h:i A') ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Notification Preferences</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach ($preferenceItems as $label => $enabled)
                                    <div class="col-md-4">
                                        <div class="info-item text-center">
                                            <div class="info-label">{{ $label }}</div>
                                            <div class="info-value">
                                                <span class="badge {{ $enabled ? 'bg-success-subtle text-success' : 'bg-light text-muted' }} px-3 py-2">
                                                    {{ $enabled ? 'Enabled' : 'Disabled' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5">
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Admin Update</h5>
                            <p class="text-muted mb-0 mt-1">Update the seeker profile details from one place.</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.seekers.update', $profile->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $profile->user->name) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->user->phone) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Company</label>
                                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $profile->company_name) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Business Domain</label>
                                        <input type="text" name="business_domain" class="form-control" value="{{ old('business_domain', $profile->business_domain) }}">
                                    </div>
                                    <div class="col-12">
                                        <div class="row g-3" data-india-location-picker
                                            data-selected-state="{{ old('state', $profile->state) }}"
                                            data-selected-city="{{ old('city', $profile->city) }}"
                                            data-country-value="India">
                                            <div class="col-md-4">
                                                <label class="form-label">State <span class="text-danger">*</span></label>
                                                <select name="state" class="form-select" required>
                                                    <option value="">Select state</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">City <span class="text-danger">*</span></label>
                                                <select name="city" class="form-select" required disabled>
                                                    <option value="">Select city</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Country</label>
                                                <input type="text" name="country" class="form-control bg-light"
                                                    value="India" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('admin.seekers.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-primary px-4">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card bg-light-subtle border-light">
                        <div class="card-body">
                            <div class="section-title mb-3">Quick Notes</div>
                            <ul class="list-unstyled mb-0 text-muted small">
                                <li class="mb-2"><i class="mdi mdi-check-circle-outline me-2 text-success"></i> Use this page for a quick overview and profile corrections.</li>
                                <li><i class="mdi mdi-check-circle-outline me-2 text-success"></i> Notification preferences are currently read-only on this screen.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
