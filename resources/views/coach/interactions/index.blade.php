<x-coach-layout title="My Messages | BestBusinessCoach">
    <style>
        /* ==================== Page Container ==================== */
        .messages-container {
            padding: 2rem;
            background-color: #ffffff;
            min-height: 100vh;
            border-radius: 15px;
        }

        /* ==================== Page Header ==================== */
        .messages-header {
            margin-bottom: 2.5rem;
        }

        .messages-header__title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .messages-header__subtitle {
            font-size: 14px;
            color: #6b7280;
        }

        /* ==================== Card Styles ==================== */
        .card-modern {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 250ms ease-in-out;
        }

        .card-modern:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .card-modern__body {
            padding: 0;
        }

        /* ==================== Table Styles ==================== */
        .table-conversations {
            width: 100%;
            border-collapse: collapse;
        }

        .table-conversations thead {
            background-color: #f3f4f6;
        }

        .table-conversations th {
            padding: 12px 10px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-conversations td {
            padding: 5px 10px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .table-conversations tbody tr {
            transition: background-color 250ms ease-in-out;
        }

        .table-conversations tbody tr:hover {
            background-color: #f9fafb;
        }

        /* ==================== Seeker Info ==================== */
        .seeker-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .seeker-avatar {
            position: relative;
            flex-shrink: 0;
        }

        .seeker-avatar img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e7eb;
            transition: all 250ms ease-in-out;
        }

        .seeker-item:hover .seeker-avatar img {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px #e0e7ff;
        }

        .seeker-content h6 {
            font-size: 14px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .seeker-content small {
            display: block;
            font-size: 12px;
            color: #9ca3af;
        }

        /* ==================== Message Preview ==================== */
        .message-preview {
            font-size: 13px;
            color: #6b7280;
            max-width: 280px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ==================== Status Badge ==================== */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.75rem;
            font-size: 11px;
            font-weight: 600;
            border-radius: 0.375rem;
            white-space: nowrap;
        }

        .badge-status--new {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .badge-status--read {
            background-color: #f3f4f6;
            color: #6b7280;
        }

        .badge-status i {
            font-size: 12px;
        }

        /* ==================== Last Activity ==================== */
        .last-activity {
            font-size: 12px;
            color: #9ca3af;
            white-space: nowrap;
        }

        /* ==================== Action Button ==================== */
        .btn-view-chat {
            display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 10px;
    background-color: #6366f1;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 250ms ease-in-out;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-view-chat:hover {
            background-color: #4f46e5;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .btn-view-chat i {
            font-size: 14px;
        }

        /* ==================== Empty State ==================== */
        .empty-state-container {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state__icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #9ca3af;
        }

        .empty-state__title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .empty-state__text {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 1.5rem;
        }

        .btn-check-requests {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border: 2px solid #6366f1;
            background-color: transparent;
            color: #6366f1;
            border-radius: 0.75rem;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 250ms ease-in-out;
        }

        .btn-check-requests:hover {
            background-color: #e0e7ff;
            border-color: #4f46e5;
        }

        /* ==================== Pagination ==================== */
        .pagination-modern {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

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
        }

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

        .pagination-modern .disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* ==================== Text Utilities ==================== */
        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .ps-4 {
            padding-left: 1.5rem;
        }

        .pe-4 {
            padding-right: 1.5rem;
        }

        .mb-0 {
            margin-bottom: 0;
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

        .ms-3 {
            margin-left: 1rem;
        }

        .me-1 {
            margin-right: 0.25rem;
        }

        /* ==================== Responsive Design ==================== */
        @media (max-width: 1024px) {
            .message-preview {
                max-width: 150px;
            }
        }

        @media (max-width: 768px) {
            .messages-container {
                padding: 1rem;
            }

            .messages-header__title {
                font-size: 24px;
            }

            .table-conversations th,
            .table-conversations td {
                padding: 0.75rem;
                font-size: 12px;
            }

            .seeker-avatar img {
                width: 40px;
                height: 40px;
            }

            .seeker-content h6 {
                font-size: 13px;
            }

            .message-preview {
                max-width: 100px;
                font-size: 11px;
            }

            .btn-view-chat {
                padding: 0.4rem 0.8rem;
                font-size: 11px;
            }

            .last-activity {
                font-size: 11px;
            }
            .content-page{
                width:100%;
                    
            }
            .content{
                padding:0px;
                margin-top: 10px;
            }
                .btn-view-chat {
        padding: 3px 10px;
        font-size: 10px;
        width: max-content;
    }
        .table-conversations {
        font-size: 11px;
        width: max-content;
    }

        }

        @media (max-width: 576px) {
            .messages-header {
                margin-bottom: 1.5rem;
            }

            .messages-header__title {
                font-size: 20px;
            }

            .messages-header__subtitle {
                font-size: 12px;
            }

            .table-conversations {
                font-size: 11px;
            }

            .table-conversations th {
                padding: 0.75rem 0.5rem;
            }

            .table-conversations td {
                padding: 0.75rem 0.5rem;
            }

            .seeker-item {
                gap: 0.5rem;
            }

            .seeker-avatar img {
                width: 36px;
                height: 36px;
            }

            .seeker-content h6 {
                font-size: 12px;
            }

            .seeker-content small {
                font-size: 10px;
            }

            .message-preview {
                max-width: 80px;
            }

            .btn-view-chat {
                padding: 0.35rem 0.6rem;
                font-size: 10px;
            }

        }
    </style>

    <div class="messages-container">
        <!-- Page Header -->
        <div class="messages-header">
            <h4 class="messages-header__title">Active Conversations</h4>
            <p class="messages-header__subtitle">Manage your communication with connected seekers.</p>
        </div>

        <!-- Main Card -->
        <div class="card-modern">
            <div class="card-modern__body">
                <div class="table-responsive">
                    <table class="table-conversations">
                        <thead>
                            <tr>
                                <th  >Seeker</th>
                                <th>Last Message</th>
                                <th>Status</th>
                                <th>Last Activity</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($interactions as $interaction)
                                <tr>
                                    <!-- Seeker Info -->
                                    <td  >
                                        <div class="seeker-item">
                                            <div class="seeker-avatar">
                                                <img src="{{ asset($interaction->seeker->profile_image) ?? asset('assets/images/users/user.avif') }}"
                                                    alt="{{ $interaction->seeker->name }}">
                                            </div>
                                            <div class="seeker-content">
                                                <h6>{{ $interaction->seeker->name }}</h6>
                                                <small>{{ $interaction->seeker->email }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Last Message -->
                                    <td>
                                        <span class="message-preview"
                                            title="{{ $interaction->message }}">
                                            {{ Str::limit($interaction->message, 45) }}
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        @if ($interaction->status === 'sent')
                                            <span class="badge-status badge-status--new">
                                                <i class="mdi mdi-email-outline"></i>
                                                <span>New Message</span>
                                            </span>
                                        @else
                                            <span class="badge-status badge-status--read">
                                                <i class="mdi mdi-email-open-outline"></i>
                                                <span>Read</span>
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Last Activity -->
                                    <td>
                                        <span class="last-activity">
                                            {{ $interaction->created_at->diffForHumans() }}
                                        </span>
                                    </td>

                                    <!-- Action -->
                                    <td class="text-end pe-4">
                                        <a href="{{ route('coach.interactions.chat', $interaction->seeker_id) }}"
                                            class="btn-view-chat">
                                            <i class="mdi mdi-message-text-outline"></i>
                                            <span>View Chat</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state-container">
                                            <div class="empty-state__icon">
                                                <i class="mdi mdi-message-off"></i>
                                            </div>
                                            <h5 class="empty-state__title">No active conversations yet.</h5>
                                            <p class="empty-state__text">
                                                Once you accept a connection request, you can start messaging here.
                                            </p>
                                            <a href="{{ route('coach.requests.index') }}"
                                                class="btn-check-requests">
                                                <i class="mdi mdi-inbox-multiple"></i>
                                                <span>Check Requests</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if ($interactions->hasPages())
            <div class="pagination-modern">
                {{ $interactions->links() }}
            </div>
        @endif
    </div>
</x-coach-layout>