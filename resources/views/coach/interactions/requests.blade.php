<x-coach-layout title="Connection Requests | CoffeePass">
    <style>
        /* ==================== CSS Variables ==================== */
        :root {
            --primary: #6366f1;
            --primary-light: #e0e7ff;
            --primary-dark: #4f46e5;
            
            --success: #10b981;
            --success-light: #d1fae5;
            --success-dark: #059669;
            
            --danger: #ef4444;
            --danger-light: #fee2e2;
            --danger-dark: #dc2626;
            
            --info: #0ea5e9;
            --info-light: #cffafe;
            --info-dark: #0284c7;
            
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;
            
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --bg-tertiary: #f3f4f6;
            
            --border-color: #e5e7eb;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            
            --radius-sm: 0.375rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            
            --transition: 250ms ease-in-out;
        }

        /* ==================== Page Container ==================== */
        .requests-container {
            padding: 2rem;
            background-color: #fff;
            min-height: 100vh;
            border-radius:15px;
        }

        /* ==================== Page Header ==================== */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .page-header__content h4 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            list-style: none;
            display: flex;
            gap: 0.5rem;
            font-size: 13px;
        }

        .breadcrumb-item {
            color: var(--text-secondary);
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
            transition: color var(--transition);
        }

        .breadcrumb-item a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb-item.active {
            color: var(--text-muted);
        }

        /* ==================== Main Grid ==================== */
        .requests-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 2rem;
        }

        @media (max-width: 1200px) {
            .requests-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ==================== Card Styles ==================== */
        .card-modern {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: box-shadow var(--transition);
        }

        .card-modern:hover {
            box-shadow: var(--shadow-md);
        }

        .card-modern__header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background-color: var(--bg-secondary);
        }

        .card-modern__title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .card-modern__body {
            padding: 0;
        }

        /* ==================== Table Styles ==================== */
        .table-requests {
            width: 100%;
            border-collapse: collapse;
        }

        .table-requests thead {
            background-color: var(--bg-tertiary);
        }

        .table-requests th {
            padding: 12px 10px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table-requests td {
            padding: 5px 10px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-requests tbody tr {
            transition: background-color var(--transition);
        }

        .table-requests tbody tr:hover {
            background-color: var(--bg-secondary);
        }

        /* ==================== Seeker Info ==================== */
        .seeker-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .seeker-avatar {
            position: relative;
            flex-shrink: 0;
        }

        .seeker-avatar img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-color);
        }

        .seeker-avatar__initial {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            border: 2px solid var(--primary-light);
        }

        .seeker-details h6 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .seeker-details small {
            display: block;
            font-size: 12px;
            color: var(--text-muted);
        }

        /* ==================== Message Cell ==================== */
        .message-cell {
            max-width: 250px;
        }

        .message-text {
            display: inline-block;
            color: var(--text-secondary);
            font-size: 13px;
            word-break: break-word;
            margin-bottom: 0.5rem;
        }

        .message-link {
            display: inline-block;
            color: var(--primary);
            font-size: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: color var(--transition);
        }

        .message-link:hover {
            color: var(--primary-dark);
        }

        /* ==================== Date Cell ==================== */
        .date-cell {
            font-size: 13px;
            color: var(--text-secondary);
            white-space: nowrap;
        }

        /* ==================== Actions Cell ==================== */
        .actions-cell {
            text-align: right;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        /* ==================== Modern Buttons ==================== */
        .btn-modern {
               display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 600;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all var(--transition);
    white-space: nowrap;
        }

        .btn-modern i {
            font-size: 14px;
        }

        /* Details Button */
        .btn-details {
            background-color: var(--info-light);
            color: var(--info);
            border: 1px solid var(--info-light);
        }

        .btn-details:hover {
            background-color: var(--info);
            color: white;
            border-color: var(--info);
        }

        /* Accept Button */
        .btn-accept {
            background-color: var(--success-light);
            color: var(--success);
            border: 1px solid var(--success-light);
        }

        .btn-accept:hover {
            background-color: var(--success);
            color: white;
            border-color: var(--success);
        }

        /* Decline Button */
        .btn-decline {
            background-color: var(--danger-light);
            color: var(--danger);
            border: 1px solid var(--danger-light);
        }

        .btn-decline:hover {
            background-color: var(--danger);
            color: white;
            border-color: var(--danger);
        }

        /* ==================== Empty State ==================== */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state__icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background-color: var(--bg-tertiary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: var(--text-muted);
        }

        .empty-state__title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-secondary);
            margin: 0;
        }

        /* ==================== Sidebar Stats Card ==================== */
        .stats-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: transform var(--transition);
            color: white;
                margin-bottom: 20px;
        }

        /* .stats-card:hover {
            transform: translateY(-4px);
        } */

        .stats-card__body {
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .stats-card__content {
            flex: 1;
        }

        .stats-card__label {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .stats-card__value {
            font-size: 36px;
            font-weight: 700;
            margin: 0;
            line-height: 1;
        }

        .stats-card__icon {
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }

        /* ==================== Modal Styles ==================== */
        .modal-modern .modal-content {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
        }

        .modal-modern .modal-header {
            background-color: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
        }

        .modal-modern .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .modal-modern .modal-body {
            padding: 2rem;
        }

        .modal-modern .modal-footer {
            background-color: var(--bg-secondary);
            border-top: 1px solid var(--border-color);
            padding: 1rem 1.5rem;
        }

        /* ==================== Seeker Details Modal ==================== */
        .seeker-profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1.5rem;
            display: block;
            border: 4px solid var(--primary-light);
        }

        .seeker-profile-initial {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 700;
            border: 4px solid var(--primary-light);
        }

        .seeker-profile-name {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .seeker-profile-info {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .seeker-profile-section-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-primary);
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .seeker-profile-text {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* ==================== Pagination ==================== */
        .pagination-modern {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .pagination-modern a,
        .pagination-modern span {
            padding: 0.5rem 0.75rem;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            text-decoration: none;
            color: var(--text-primary);
            font-size: 13px;
            font-weight: 600;
            transition: all var(--transition);
        }

        .pagination-modern a:hover {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-modern .active span {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* ==================== Responsive ==================== */
        @media (max-width: 768px) {
            .requests-container {
                padding: 1rem;
            }

            .requests-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .table-requests th,
            .table-requests td {
                padding: 0.75rem;
                font-size: 12px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: flex-end;
            }

            .btn-modern {
                padding: 0.4rem 0.8rem;
                font-size: 11px;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* ==================== Utility Classes ==================== */
        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-1 {
            margin-bottom: 0.5rem;
        }

        .mb-2 {
            margin-bottom: 1rem;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .mt-3 {
            margin-top: 1.5rem;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .justify-content-center {
            justify-content: center;
        }

        .justify-content-end {
            justify-content: flex-end;
        }

        .gap-2 {
            gap: 1rem;
        }
        @media (max-width: 768px) {
            .page-header__content h4{}
            .content-page{
                    width: 100%;
            }
            .content{
                padding:0px;
                margin-top:10px
            }
                .requests-container {
        padding: 12px;
    }
        .page-header__content h4 {
        font-size: 20px;
    }
    .stats-card__body{
        padding:13px;
    }
    .stats-card__value{
        font-size:30px;
    }
    .card-modern__header{
            padding: 13px;
}
.card-modern__title{
    font-size:15px;
}
.page-header{
        margin-bottom: 10px;
    padding-bottom: 0px;
}
.action-buttons{
        display: flex;
    flex-wrap: nowrap;
    /* width: 200px; */
    flex-direction: row;
}
    .btn-modern {
        padding: 3px 8px;
        font-size: 10px;
    }
    .table-requests {
    width: max-content;
    border-collapse: collapse;
}
        }
    </style>

    <div class="requests-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header__content">
                <h4>Connection Requests</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Coach</a></li>
                        <li class="breadcrumb-item active">Requests</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="requests-gridd">
              <!-- Right Column - Stats Card -->
            <div>
                <div class="stats-card">
                    <div class="stats-card__body">
                        <div class="stats-card__content">
                            <div class="stats-card__label">Total Connections</div>
                            <p class="stats-card__value">{{ $acceptedCount ?? 0 }}</p>
                        </div>
                        <div class="stats-card__icon">
                            <i class="mdi mdi-account-group"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Left Column - Requests Table -->
            <div>
                <div class="card-modern">
                    <div class="card-modern__header">
                        <h5 class="card-modern__title">
                            <i class="mdi mdi-inbox-multiple me-2"></i>
                            Pending Connections
                        </h5>
                    </div>

                    <div class="card-modern__body">
                        <div class="table-responsive">
                            <table class="table-requests">
                                <thead>
                                    <tr>
                                        <th>Seeker</th>
                                        <th>Message</th>
                                        <th>Date Received</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($requests as $request)
                                        <tr>
                                            <!-- Seeker Info -->
                                            <td>
                                                <div class="seeker-info">
                                                    <div class="seeker-avatar">
                                                        @if ($request->sender->profile_image)
                                                            <img src="{{ asset($request->sender->profile_image) }}"
                                                                alt="{{ $request->sender->name }}">
                                                        @else
                                                            <div class="seeker-avatar__initial">
                                                                {{ substr($request->sender->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="seeker-details">
                                                        <h6>{{ $request->sender->name }}</h6>
                                                        <small>{{ $request->sender->email }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Message -->
                                            <td>
                                                <div class="message-cell">
                                                    <span class="message-text"
                                                        title="{{ $request->message }}">
                                                        {{ \Illuminate\Support\Str::limit($request->message ?? 'No introductory message.', 60) }}
                                                    </span>
                                                    @if($request->message)
                                                        <div>
                                                            <a href="#" class="message-link"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#requestDetailsModal{{ $request->id }}">
                                                                View full message
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Date -->
                                            <td>
                                                <span class="date-cell">{{ $request->created_at->format('d M, Y') }}</span>
                                            </td>

                                            <!-- Actions -->
                                            <td class="actions-cell">
                                                <div class="action-buttons">
                                                    <button type="button" class="btn-modern btn-details"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#requestDetailsModal{{ $request->id }}">
                                                        <i class="mdi mdi-eye-outline"></i> Details
                                                    </button>

                                                    <form
                                                        action="{{ route('coach.requests.update', [$request->id, 'accepted']) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf @method('PATCH')
                                                        <button type="submit" class="btn-modern btn-accept">
                                                            <i class="mdi mdi-check-bold"></i> Accept
                                                        </button>
                                                    </form>

                                                    <form
                                                        action="{{ route('coach.requests.update', [$request->id, 'rejected']) }}"
                                                        method="POST" class="delete-form" style="display: inline;">
                                                        @csrf @method('PATCH')
                                                        <button type="button"
                                                            class="btn-modern btn-decline confirm-reject">
                                                            <i class="mdi mdi-close-thick"></i> Decline
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">
                                                <div class="empty-state">
                                                    <div class="empty-state__icon">
                                                        <i class="mdi mdi-inbox-multiple-outline"></i>
                                                    </div>
                                                    <h5 class="empty-state__title">No pending connection requests.</h5>
                                                    <p style="color: var(--text-muted); font-size: 13px; margin-top: 0.5rem;">
                                                        Start exploring and connecting with seekers
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($requests->hasPages())
                            <div class="pagination-modern">
                                {{ $requests->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

          
        </div>
    </div>

    <!-- Modals -->
    @foreach($requests as $request)
        <div class="modal fade modal-modern" id="requestDetailsModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seeker Request Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-4">
                            <!-- Left Side - Profile -->
                            <div class="col-md-4 text-center">
                                @if ($request->sender->profile_image)
                                    <img src="{{ asset($request->sender->profile_image) }}"
                                        class="seeker-profile-img"
                                        alt="{{ $request->sender->name }}">
                                @else
                                    <div class="seeker-profile-initial">
                                        {{ substr($request->sender->name, 0, 1) }}
                                    </div>
                                @endif

                                <h5 class="seeker-profile-name">{{ $request->sender->name }}</h5>
                                <p class="seeker-profile-info mb-0">{{ $request->sender->email }}</p>
                                <p class="seeker-profile-info">
                                    Phone: {{ $request->sender->phone ?? 'N/A' }}
                                </p>

                                @if ($request->sender->seekerProfile)
                                    <p class="seeker-profile-info">
                                        City: {{ $request->sender->seekerProfile->city ?? 'N/A' }}
                                    </p>
                                    <p class="seeker-profile-info">
                                        State: {{ $request->sender->seekerProfile->state ?? 'N/A' }}
                                    </p>
                                    <p class="seeker-profile-info">
                                        Industry: {{ $request->sender->seekerProfile->business_domain ?? 'N/A' }}
                                    </p>
                                @endif
                            </div>

                            <!-- Right Side - Message & Bio -->
                            <div class="col-md-8">
                                <div class="seeker-profile-section-title">Full Message</div>
                                <p class="seeker-profile-text">
                                    {{ $request->message ?? 'No introductory message provided.' }}
                                </p>

                                @if ($request->sender->seekerProfile && $request->sender->seekerProfile->bio)
                                    <hr style="border-color: var(--border-color); margin: 1.5rem 0;">
                                    <div class="seeker-profile-section-title">Seeker Bio</div>
                                    <p class="seeker-profile-text">
                                        {{ $request->sender->seekerProfile->bio }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-modern" style="background-color: var(--bg-tertiary); color: var(--text-primary);"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const rejectBtns = document.querySelectorAll('.confirm-reject');
                rejectBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const form = this.closest('form');
                        Swal.fire({
                            title: 'Decline Request?',
                            text: "This action cannot be undone.",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, decline',
                            confirmButtonColor: '#ef4444',
                            reverseButtons: true,
                            customClass: {
                                confirmButton: 'btn btn-danger',
                                cancelButton: 'btn btn-secondary'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) form.submit();
                        });
                    });
                });
            });
        </script>
    @endpush
</x-coach-layout>