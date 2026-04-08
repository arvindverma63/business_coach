<x-seeker-layout title="Find Coaches | BestBusinessCoach">
    <style>
    /* ==================== Page Container ==================== */
    .coaches-container {
        padding: 2rem;
        background-color: #ffffff;
        min-height: 100vh;
        border-radius: 20px;
    }

    /* ==================== Page Header ==================== */
    .page-header {
        margin-bottom: 2.5rem;
    }

    .page-header__title {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .page-header__subtitle {
        font-size: 14px;
        color: #6b7280;
    }

    /* ==================== Search Section ==================== */
    .search-section {
        margin-bottom: 2rem;
    }

    .search-form {
        max-width: 450px;
        margin-left: auto;
    }

    .search-input-group {
        display: flex;
        align-items: center;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 0.5rem;
        gap: 0.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: all 250ms ease-in-out;
    }

    .search-input-group:focus-within {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px #e0e7ff;
    }

    .search-input-group i {
        color: #6b7280;
        font-size: 18px;
        margin-left: 0.5rem;
    }

    .search-input {
        flex: 1;
        border: none;
        background: transparent;
        font-size: 13px;
        color: #1f2937;
        padding: 0.5rem;
    }

    .search-input:focus {
        outline: none;
    }

    .search-input::placeholder {
        color: #9ca3af;
    }

    .btn-search {
        padding: 0.6rem 1.5rem;
        background-color: #6366f1;
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 250ms ease-in-out;
        flex-shrink: 0;
    }

    .btn-search:hover {
        background-color: #4f46e5;
    }

    /* ==================== Coaches Grid ==================== */
    .coaches-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    /* ==================== Coach Card ==================== */
    .coach-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-top: 4px solid #6366f1;
        border-radius: 1rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 250ms ease-in-out;
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 23%;
    }

    .coach-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        transform: translateY(-4px);
        border-top-color: #4f46e5;
    }

    .coach-card__body {
        padding: 1.5rem;
        text-align: center;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .coach-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e0e7ff;
        margin: 0 auto 1rem;
        cursor: pointer;
        transition: all 250ms ease-in-out;
        position: relative;
    }

    .coach-avatar:hover {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px #e0e7ff;
    }

    .coach-avatar-badge {
        position: absolute;
        bottom: 16px;
        right: -5px;
        width: 28px;
        height: 28px;
        background-color: #10b981;
        border-radius: 50%;
        border: 3px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: white;
    }

    .coach-name {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.25rem;
        cursor: pointer;
        transition: color 250ms ease-in-out;
    }

    .coach-name:hover {
        color: #6366f1;
    }

    .coach-designation {
        font-size: 13px;
        color: #6366f1;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .coach-expertise {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 3px;
        margin-bottom: 1.5rem;
    }

    .expertise-badge {
        display: inline-block;
        padding: 3px 6px;
        background-color: #cffafe;
        color: #0ea5e9;
        border: 1px solid #a5f3fc;
        border-radius: 0.375rem;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 140px;
        border-radius:30px;
    }

    /* ==================== Coach Actions ==================== */
    .coach-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: auto;
    }

    .btn-action {
        padding: 7px 10px;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 250ms ease-in-out;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
    }

    .btn-action--view {
        background-color: #f3f4f6;
        color: #1f2937;
        border-color: #d1d5db;
    }

    .btn-action--view:hover {
        background-color: #e5e7eb;
    }

    .btn-action--content {
        background-color: transparent;
        color: #6366f1;
        border-color: #6366f1;
    }

    .btn-action--content:hover {
        background-color: #e0e7ff;
    }

    .btn-action--connect {
        background-color: #6366f1;
        color: white;
        border-color: #6366f1;
    }

    .btn-action--connect:hover {
        background-color: #4f46e5;
    }

    .btn-action--pending {
        background-color: #fef3c7;
        color: #f59e0b;
        border-color: #fcd34d;
        cursor: not-allowed;
    }

    .btn-action--success {
        background-color: #d1fae5;
        color: #10b981;
        border-color: #a7f3d0;
    }

    .btn-action--success:hover {
        background-color: #a7f3d0;
    }

    /* ==================== Modal Styles ==================== */
    .modal-modern .modal-content {
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .modal-modern .modal-header {
        padding: 1.5rem;
        background-color: #ffffff;
        border-bottom: 1px solid #e5e7eb;
    }

    .modal-modern .modal-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
    }

    .modal-modern .modal-body {
        padding: 1.5rem;
    }

    .modal-modern .modal-footer {
        padding: 1rem 1.5rem;
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
    }

    /* Profile Modal */
    .profile-section-left {
        background-color: #f3f4f6;
        padding: 2rem;
        text-align: center;
        border-right: 1px solid #e5e7eb;
    }

    .profile-avatar-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        margin: 0 auto 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .profile-name {
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .profile-designation {
        font-size: 14px;
        color: #6366f1;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .profile-categories {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .profile-category-badge {
        padding: 0.5rem 1rem;
        background-color: #e0e7ff;
        color: #6366f1;
        border: 1px solid #c7d2fe;
        border-radius: 0.375rem;
        font-size: 12px;
        font-weight: 600;
    }

    .profile-info-section {
        text-align: left;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #d1d5db;
    }

    .profile-info-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }

    .profile-info-item {
        margin-bottom: 1rem;
    }

    .profile-info-item small {
        display: block;
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }

    .profile-info-item span {
        font-weight: 600;
        color: #1f2937;
    }

    .profile-social-links {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1.5rem;
    }

    .profile-social-btn {
        width: 36px;
        height: 36px;
        border-radius: 0.5rem;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        transition: all 250ms ease-in-out;
    }

    .profile-section-right {
        padding: 2rem;
        overflow-y: auto;
        max-height: 600px;
    }

    .profile-section-title {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6366f1;
        margin-bottom: 0.75rem;
    }

    .profile-bio {
        font-size: 13px;
        color: #1f2937;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .profile-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1rem;
        background-color: #f9fafb;
        border-radius: 0.75rem;
    }

    .profile-stat {
        text-align: center;
    }

    .profile-stat-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .profile-stat-value {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
    }

    .profile-expertise {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .profile-expertise-badge {
        padding: 0.5rem 1rem;
        background-color: #e0e7ff;
        color: #6366f1;
        border: 1px solid #c7d2fe;
        border-radius: 0.375rem;
        font-size: 12px;
        font-weight: 600;
    }

    .profile-content-box {
        padding: 1rem;
        background-color: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        margin-top:10px;
    }

    .profile-content-title {
        font-size: 13px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .profile-content-subtitle {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    /* Content Modal */
    .content-filters {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .content-filter-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .content-filter-input,
    .content-filter-select {
        padding: 0.6rem 0.8rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 13px;
        background-color: #ffffff;
        color: #1f2937;
        transition: all 250ms ease-in-out;
    }

    .content-filter-input:focus,
    .content-filter-select:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px #e0e7ff;
    }

    .content-count {
        background-color: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 1rem;
        text-align: center;
    }

    .content-count-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .content-count-value {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
    }

    .content-grid {
       display:flex;
       flex-wrap:wrap;
        gap: 1rem;
    }

    .content-item {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1rem;
        transition: all 250ms ease-in-out;
        width: 31%;
    }

    .content-item:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .content-item-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .content-item-badges {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        flex-wrap: wrap;
    }

    .content-item-badge {
        padding: 0.25rem 0.6rem;
        background-color: #e0e7ff;
        color: #6366f1;
        border: 1px solid #c7d2fe;
        border-radius: 0.375rem;
        font-size: 10px;
        font-weight: 600;
    }

    .content-item-title {
        font-size: 13px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .content-item-text {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .content-item-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .content-item-date {
        font-size: 11px;
        color: #9ca3af;
    }

    .content-item-link {
        padding: 0.4rem 0.8rem;
        background-color: transparent;
        color: #6366f1;
        border: 1px solid #6366f1;
        border-radius: 0.375rem;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 250ms ease-in-out;
    }

    .content-item-link:hover {
        background-color: #e0e7ff;
    }

    .content-empty {
        text-align: center;
        padding: 2rem;
        background-color: #f9fafb;
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        color: #6b7280;
    }

    /* Connect Modal */
    .connect-alert {
        background-color: #dbeafe;
        border: 1px solid #93c5fd;
        color: #1e40af;
        border-radius: 0.5rem;
        padding: 0.75rem;
        font-size: 12px;
        margin-bottom: 1rem;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .form-control {
        padding: 0.6rem 0.8rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 13px;
        color: #1f2937;
        transition: all 250ms ease-in-out;
    }

    .form-control:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px #e0e7ff;
    }

    /* Buttons */
    .btn-primary {
        padding: 0.6rem 1.5rem;
        background-color: #6366f1;
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 250ms ease-in-out;
    }

    .btn-primary:hover {
        background-color: #4f46e5;
    }

    .btn-light {
        padding: 0.6rem 1.5rem;
        background-color: #f3f4f6;
        color: #1f2937;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 250ms ease-in-out;
    }

    .btn-light:hover {
        background-color: #e5e7eb;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state__icon {
        font-size: 64px;
        color: #d1d5db;
        margin-bottom: 1rem;
        opacity: 0.6;
    }

    .empty-state__title {
        font-size: 16px;
        font-weight: 600;
        color: #6b7280;
    }

    /* Pagination */
    .pagination-modern {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
/* 
    .pagination-modern a,
    .pagination-modern span {
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        border: 1px solid #e5e7eb;
        text-decoration: none;
        color: #1f2937;
        font-size: 13px;
        font-weight: 600;
        transition: all 250ms ease-in-out;
    } */

    .pagination-modern a:hover {
        background-color: #6366f1;
        color: white;
        border-color: #6366f1;
    }

    .pagination-modern .active span {
        background-color: #6366f1;
        color: white;
        border-color: #6366f1;
    }
.coach-avatar-container {
    height: 225px;
}
    /* Responsive Design */
    @media (max-width: 1200px) {
        .coaches-grid {
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .coaches-container {
            padding: 1rem;
        }

        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-header__title {
            font-size: 24px;
        }

        .search-form {
            max-width: 100%;
            margin-left: 0;
        }

        .coaches-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
        }

        .coach-card__body {
            padding: 1rem;
        }

        .content-filters {
            grid-template-columns: 1fr;
        }

        .profile-section-left {
            border-right: none;
            border-bottom: 1px solid #e5e7eb;
        }

        .profile-section-right {
            max-height: 500px;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
        .content{
            padding:0px;
            margin-top:10px;
        }
        .coach-card{
            width:47%;
        }
    }

    @media (max-width: 576px) {
         .coach-card{
            width:100%;
        }
        .coach-avatar-container {
    height: auto;
}
        .coaches-container {
            padding: 0.5rem;
        }

        .page-header__title {
            font-size: 20px;
        }

        .coaches-grid {
            grid-template-columns: 1fr;
        }

        .coach-avatar {
            width: 70px;
            height: 70px;
        }

     .search-input-group{
        gap:3px;
     }
      

        .coach-actions {
            gap: 0.5rem;
        }

        .btn-action {
            padding: 0.5rem 0.75rem;
            font-size: 11px;
        }

        .profile-stats {
            grid-template-columns: 1fr;
        }
    }


    @media (max-width: 768px) {
        .modal-modern{
            button.btn-close.float-end{
                    position: absolute!important;
    top: 15px!important;
    right: 15px!important;
            }
            .modaljdj{
                display:flex!important;
                flex-direction:column;
            }
            .profile-section-right{
                max-height:fit-content!important;
            }
            .profile-category-badge {
    padding: 3px 8px;
    background-color: #e0e7ff;
    color: #6366f1;
    border: 1px solid #c7d2fe;
    border-radius: 0.375rem;
    font-size: 10px;
    font-weight: 600;
}
.profile-designation{
    margin-bottom:5px;
}
.profile-avatar-large{
    margin-bottom:10px;
}
.profile-section-left{
    padding:15px;
}
.profile-section-right{
    padding:15px;
}
.profile-expertise-badge {
    padding: 4px 10px;
    background-color: #e0e7ff;
    color: #6366f1;
    border: 1px solid #c7d2fe;
    border-radius: 0.375rem;
    font-size: 10px;
    font-weight: 600;
}

        }
        .content-filter-input, .content-filter-select{
            width:100%;
        }
        
    }
    </style>

    <div class="coaches-container">
        <!-- Page Header -->
        <div class="page-header">
            <h4 class="page-header__title">Discover Coaches</h4>
            <p class="page-header__subtitle">Browse through our verified business coaches to start your journey.</p>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <form action="{{ route('seeker.coaches.index') }}" method="GET" class="search-form">
                <div class="search-input-group">
                    <i class="mdi mdi-magnify"></i>
                    <input type="text" name="search" class="search-input" placeholder="Search name or expertise..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn-search">Search</button>
                </div>
            </form>
        </div>

        <!-- Coaches Grid -->
        <div class="coaches-grid">
            @forelse($coaches as $coach)
            @php
            $existingReq = \App\Models\MessageRequest::where('sender_id', auth()->id())
            ->where('receiver_id', $coach->id)
            ->whereIn('status', ['pending', 'accepted'])
            ->first();
            $expertiseCategories = $coach->coachProfile?->categories ?? collect();
            $coachContents = $coach->blogs->concat($coach->mediaGallery ?? collect());
            $contentCategories = $coachContents->pluck('category')->filter()->unique('id')->sortBy('name')->values();
            @endphp

            <!-- Coach Card -->
            <div class="coach-card">
                <div class="coach-card__body">
                    <!-- Avatar -->
                    <div class="coach-avatar-container">
                        <div style="position: relative; display: inline-block; margin: 0 auto; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#profileModal{{ $coach->id }}">
                            <img src="{{ asset($coach->profile_image) ?? asset('assets/images/users/user.avif') }}"
                                class="coach-avatar" alt="{{ $coach->name }}">
                            <div class="coach-avatar-badge">
                                <i class="mdi mdi-check-decagram"></i>
                            </div>
                        </div>

                        <!-- Name & Designation -->
                        <h5 class="coach-name" data-bs-toggle="modal" data-bs-target="#profileModal{{ $coach->id }}">
                            {{ $coach->name }}
                        </h5>
                        <p class="coach-designation">
                            {{ $coach->coachProfile->designation ?? 'Business Coach' }}
                        </p>

                        <!-- Expertise -->
                        <div class="coach-expertise">
                            @if ($expertiseCategories->isNotEmpty())
                            @foreach ($expertiseCategories->take(2) as $cat)
                            <span class="expertise-badge">{{ $cat->name }}</span>
                            @endforeach
                            @else
                            <span class="expertise-badge">General Coaching</span>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="coach-actions">
                        <button type="button" class="btn-action btn-action--view" data-bs-toggle="modal"
                            data-bs-target="#profileModal{{ $coach->id }}">
                            View Full Profile
                        </button>

                        <button type="button" class="btn-action btn-action--content" data-bs-toggle="modal"
                            data-bs-target="#coachContentModal{{ $coach->id }}">
                            View Content
                        </button>

                        @if (!$existingReq)
                        <button type="button" class="btn-action btn-action--connect" data-bs-toggle="modal"
                            data-bs-target="#connectModal{{ $coach->id }}">
                            Connect Now
                        </button>
                        @elseif($existingReq->status == 'pending')
                        <button class="btn-action btn-action--pending" disabled>
                            <i class="mdi mdi-clock-outline"></i>
                            Pending
                        </button>
                        @elseif($existingReq->status == 'accepted')
                        <a href="{{ route('seeker.messaging.chat', $coach->id) }}"
                            class="btn-action btn-action--success">
                            <i class="mdi mdi-message-text-outline"></i>
                            Chat Now
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile Modal -->
            <div class="modal fade modal-modern" id="profileModal{{ $coach->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div style="display: grid; grid-template-columns: 300px 1fr;" class="modaljdj">
                                <!-- Left Section -->
                                <div class="profile-section-left">
                                    <img src="{{ $coach->profile_image ? asset($coach->profile_image) : asset('assets/images/users/user.avif') }}"
                                        class="profile-avatar-large" alt="{{ $coach->name }}">

                                    <h4 class="profile-name">{{ $coach->name }}</h4>
                                    <p class="profile-designation">
                                        {{ $coach->coachProfile->designation ?? 'Business Coach' }}
                                    </p>

                                    <div class="profile-categories">
                                        @forelse ($expertiseCategories->take(4) as $category)
                                        <span class="profile-category-badge">{{ $category->name }}</span>
                                        @empty
                                        <span class="profile-category-badge">General Coaching</span>
                                        @endforelse
                                    </div>

                                    <div class="profile-info-section">
                                        <div class="profile-info-label">Contact Information</div>

                                        @if ($coach->coachProfile && $coach->coachProfile->gender === 'female')
                                        <div
                                            style="background: #f3f4f6; padding: 0.75rem; border-radius: 0.5rem; margin-top: 1rem;">
                                            <p style="font-size: 12px; color: #6b7280; margin: 0;">
                                                <i class="mdi mdi-lock-outline me-1"></i>
                                                Contact details are hidden for privacy. Please connect to communicate.
                                            </p>
                                        </div>
                                        @else
                                        <div class="profile-info-item">
                                            <small>Email Address</small>
                                            <span>{{ $coach->email }}</span>
                                        </div>
                                        <div class="profile-info-item">
                                            <small>Phone Number</small>
                                            <span>{{ $coach->phone ?? 'Not Provided' }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="profile-social-links">
                                        @if ($coach->coachProfile && $coach->coachProfile->linkedin_url)
                                        <a href="{{ $coach->coachProfile->linkedin_url }}" target="_blank"
                                            class="profile-social-btn" style="background: #0a66c2; color: white;">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                        @endif
                                        @if ($coach->coachProfile && $coach->coachProfile->website_url)
                                        <a href="{{ $coach->coachProfile->website_url }}" target="_blank"
                                            class="profile-social-btn" style="background: #1f2937; color: white;">
                                            <i class="mdi mdi-earth"></i>
                                        </a>
                                        @endif
                                    </div>
                                </div>

                                <!-- Right Section -->
                                <div class="profile-section-right">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>

                                    <h6 class="profile-section-title">About</h6>
                                    <p class="profile-bio">
                                        {{ $coach->coachProfile->bio ?? 'No professional bio provided yet.' }}
                                    </p>

                                    <div class="profile-stats">
                                        <div class="profile-stat">
                                            <div class="profile-stat-label">Experience</div>
                                            <div class="profile-stat-value">
                                                {{ $coach->coachProfile->experience_years ?? 0 }}+</div>
                                        </div>
                                        <div class="profile-stat">
                                            <div class="profile-stat-label">Location</div>
                                            <div class="profile-stat-value" style="font-size: 14px;">
                                                {{ $coach->coachProfile->city ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>

                                    <h6 class="profile-section-title">Specializations</h6>
                                    <div class="profile-expertise">
                                        @forelse ($expertiseCategories as $category)
                                        <span class="profile-expertise-badge">{{ $category->name }}</span>
                                        @empty
                                        <span style="font-size: 12px; color: #6b7280;">General Coaching</span>
                                        @endforelse
                                    </div>

                                    <div class="profile-content-box">
                                        <div class="profile-content-title">Coach Content</div>
                                        <div class="profile-content-subtitle">Browse published blogs and insights</div>
                                        <button type="button" class="btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#coachContentModal{{ $coach->id }}" data-bs-dismiss="modal">
                                            View Content
                                        </button>
                                    </div>

                                    <div style="margin-top: 2rem;">
                                        @if (!$existingReq)
                                        <button class="btn-primary w-100" data-bs-toggle="modal"
                                            data-bs-target="#connectModal{{ $coach->id }}" data-bs-dismiss="modal">
                                            <i class="mdi mdi-account-plus-outline me-1"></i>
                                            Request Connection
                                        </button>
                                        @elseif($existingReq->status == 'accepted')
                                        <a href="{{ route('seeker.messaging.chat', $coach->id) }}"
                                            class="btn-primary w-100"
                                            style="display: inline-block; text-align: center;">
                                            <i class="mdi mdi-message-text-outline me-1"></i>
                                            Send Message
                                        </a>
                                        @else
                                        <button class="btn-light w-100" disabled>
                                            Connection {{ ucfirst($existingReq->status) }}
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Modal -->
            <div class="modal fade modal-modern" id="coachContentModal{{ $coach->id }}" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>
                                <h4 class="modal-title">{{ $coach->name }}'s Content</h4>
                                <p style="font-size: 12px; color: #6b7280; margin-bottom: 0;">
                                    Filter published content by keyword or category.
                                </p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Filters -->
                            <div class="content-filters">
                                <div>
                                    <div class="content-filter-label">Search</div>
                                    <input type="text" id="contentSearch{{ $coach->id }}" class="content-filter-input"
                                        placeholder="Search title or content...">
                                </div>
                                <div>
                                    <div class="content-filter-label">Category</div>
                                    <select id="contentCategory{{ $coach->id }}" class="content-filter-select">
                                        <option value="">All Categories</option>
                                        @foreach ($contentCategories as $category)
                                        <option value="{{ \Illuminate\Support\Str::lower($category->name) }}">
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <div class="content-count">
                                        <div class="content-count-label">Items</div>
                                        <div class="content-count-value" id="contentCount{{ $coach->id }}">
                                            {{ $coachContents->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Grid -->
                            <div class="content-grid" id="coachContentList{{ $coach->id }}">
                                @forelse ($coachContents as $content)
                                @php
                                $isBlog = $content instanceof \App\Models\Blog;
                                @endphp
                                <div class="content-item coach-content-item-{{ $coach->id }}"
                                    data-title="{{ \Illuminate\Support\Str::lower($content->title) }}"
                                    data-body="{{ \Illuminate\Support\Str::lower($isBlog ? strip_tags($content->content) : $content->title) }}"
                                    data-category="{{ \Illuminate\Support\Str::lower($content->category->name ?? 'uncategorized') }}">

                                    @if ($isBlog && $content->featured_image)
                                    <img src="{{ asset('storage/' . $content->featured_image) }}"
                                        class="content-item-image" alt="{{ $content->title }}">
                                    @elseif (!$isBlog && $content->file_type === 'image')
                                    <img src="{{ asset($content->url) }}" class="content-item-image"
                                        alt="{{ $content->title }}">
                                    @else
                                    <div class="content-item-image"
                                        style="background-color: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                                        <i
                                            class="mdi {{ $isBlog ? 'mdi-file-document-outline' : $content->icon }} fs-3 text-muted"></i>
                                    </div>
                                    @endif

                                    <div class="content-item-badges">
                                        <span class="content-item-badge">
                                            {{ $isBlog ? 'Blog' : ucfirst($content->file_type) }}
                                        </span>
                                        <span class="content-item-badge">
                                            {{ $content->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </div>

                                    <h5 class="content-item-title">{{ $content->title }}</h5>
                                    <p class="content-item-text">
                                        {{ \Illuminate\Support\Str::limit($isBlog ? strip_tags($content->content) : $content->title, 100) }}
                                    </p>

                                    <div class="content-item-footer">
                                        <span
                                            class="content-item-date">{{ $content->created_at?->format('d M Y') }}</span>
                                        @if ($isBlog)
                                        <a href="{{ route('blog-detail', $content->slug) }}" class="content-item-link"
                                            target="_blank">
                                            Read More
                                        </a>
                                        @else
                                        <a href="{{ asset($content->url) }}" class="content-item-link" target="_blank">
                                            View File
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="content-empty">
                                        No published content is available for this coach yet.
                                    </div>
                                </div>
                                @endforelse
                            </div>

                            <div class="content-empty d-none" id="coachContentEmpty{{ $coach->id }}">
                                No content matches the selected filters.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connect Modal -->
            <div class="modal fade modal-modern" id="connectModal{{ $coach->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('seeker.coaches.connect', $coach->id) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Connect with {{ $coach->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="connect-alert">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Introduce yourself briefly to increase your chances of acceptance.
                                </div>

                                <div>
                                    <label class="form-label">Your Message</label>
                                    <textarea name="message" class="form-control" rows="4"
                                        placeholder="Hi {{ $coach->name }}, I'm looking for guidance on..."
                                        required></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn-primary">Send Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1;">
                <div class="empty-state">
                    <div class="empty-state__icon">
                        <i class="mdi mdi-folder-open-outline"></i>
                    </div>
                    <h5 class="empty-state__title">No coaches match your search criteria.</h5>
                    <a href="{{ route('seeker.coaches.index') }}"
                        style="color: #6366f1; text-decoration: none; font-weight: 600;">
                        Reset Filters
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination-modern">
            {{ $coaches->appends(request()->input())->links() }}
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    // Modal switching
    $(document).on('click', '[data-bs-target^="#connectModal"]', function() {
        $('.modal').modal('hide');
    });

    @foreach($coaches as $coach)
    $('#contentSearch{{ $coach->id }}, #contentCategory{{ $coach->id }}').on('input change', function() {
        const searchValue = $('#contentSearch{{ $coach->id }}').val().toLowerCase().trim();
        const categoryValue = $('#contentCategory{{ $coach->id }}').val();
        let visibleCount = 0;

        $('.coach-content-item-{{ $coach->id }}').each(function() {
            const item = $(this);
            const matchesSearch = !searchValue ||
                item.data('title').includes(searchValue) ||
                item.data('body').includes(searchValue);
            const matchesCategory = !categoryValue || item.data('category') === categoryValue;
            const isVisible = matchesSearch && matchesCategory;

            item.toggleClass('d-none', !isVisible);

            if (isVisible) {
                visibleCount++;
            }
        });

        $('#contentCount{{ $coach->id }}').text(visibleCount);
        $('#coachContentEmpty{{ $coach->id }}').toggleClass('d-none', visibleCount !== 0);
    });
    @endforeach
    </script>
    @endpush
</x-seeker-layout>