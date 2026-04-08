<x-seeker-layout title="Seeker Dashboard | BestBusinessCoach">
    <style>
        /* ==================== Page Container ==================== */
        .dashboard-container {
            padding: 2rem;
            background-color: #ffffff;
            min-height: 100vh;
            border-radius:20px;
        }

        /* ==================== Page Header ==================== */
        .page-header {
            margin-bottom: 2.5rem;
        }

        .page-header__subtitle {
            font-size: 14px;
            color: #6b7280;
        }

        /* ==================== Stats Grid ==================== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        /* ==================== Stat Card ==================== */
        .stat-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 250ms ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            opacity: 0.08;
            z-index: 0;
        }

        .stat-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-4px);
        }

        .stat-card--primary {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border: none;
            color: white;
        }

        .stat-card--primary::before {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .stat-card--primary .stat-card__label {
            color: rgba(255, 255, 255, 0.8);
        }

        .stat-card--primary .stat-card__value {
            color: white;
        }

        .stat-card__content {
            position: relative;
            z-index: 1;
            flex: 1;
        }

        .stat-card__label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .stat-card__value {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            line-height: 1;
            margin: 0;
        }

        .stat-card__icon {
            position: relative;
            z-index: 1;
            font-size: 48px;
            flex-shrink: 0;
            opacity: 0.2;
        }

        .stat-card--primary .stat-card__icon {
            opacity: 0.3;
            color: white;
        }

        /* ==================== Table Card ==================== */
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

        .card-modern__header {
            padding: 1.5rem;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-modern__title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
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
            background-color: #f3f4f6;
        }

        .table-requests th {
            padding: 1rem 1.5rem;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-requests td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .table-requests tbody tr {
            transition: background-color 250ms ease-in-out;
        }

        .table-requests tbody tr:hover {
            background-color: #f9fafb;
        }

        /* ==================== Coach Name ==================== */
        .coach-name {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        /* ==================== Status Badge ==================== */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.75rem;
            font-size: 11px;
            font-weight: 600;
            border-radius: 0.375rem;
            white-space: nowrap;
        }

        .badge-status--accepted {
            background-color: #d1fae5;
            color: #10b981;
        }

        .badge-status--pending {
            background-color: #fef3c7;
            color: #f59e0b;
        }

        .badge-status--declined {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .badge-status i {
            font-size: 10px;
        }

        /* ==================== Date Cell ==================== */
        .date-cell {
            font-size: 13px;
            color: #6b7280;
        }

        /* ==================== Action Button ==================== */
        .action-cell {
            text-align: right;
        }

        .btn-message {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 250ms ease-in-out;
        }

        .btn-message:hover {
            background-color: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn-message i {
            font-size: 14px;
        }

        .btn-disabled {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            background-color: #f3f4f6;
            color: #9ca3af;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: not-allowed;
        }

        /* ==================== Empty State ==================== */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
        }

        .empty-state__icon {
            font-size: 48px;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .empty-state__text {
            font-size: 14px;
            color: #6b7280;
        }

        /* ==================== Responsive Design ==================== */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
                margin-bottom: 2rem;
            }

            .stat-card {
                padding: 1rem;
                gap: 1rem;
            }

            .stat-card__value {
                font-size: 28px;
            }

            .stat-card__icon {
                font-size: 40px;
            }

            .card-modern__header {
                padding: 1rem;
            }

            .card-modern__title {
                font-size: 16px;
            }

            .table-requests th,
            .table-requests td {
                padding: 0.75rem;
                font-size: 12px;
            }

            .table-requests th:nth-child(2),
            .table-requests td:nth-child(2) {
                display: none;
            }

            .btn-message,
            .btn-disabled {
                padding: 0.5rem 0.8rem;
                font-size: 11px;
            }
            .content{
                padding:0px;
                margin-top:10px;
            }
        }

        @media (max-width: 576px) {
            .dashboard-container {
                padding: 0.75rem;
            }

            .page-header__subtitle {
                font-size: 12px;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-card__label {
                font-size: 11px;
            }

            .stat-card__value {
                font-size: 24px;
            }

            .stat-card__icon {
                font-size: 32px;
            }

            .table-requests th,
            .table-requests td {
                padding: 0.6rem;
                font-size: 11px;
            }

            .table-requests th:nth-child(2),
            .table-requests td:nth-child(2),
            .table-requests th:nth-child(3),
            .table-requests td:nth-child(3) {
                display: none;
            }

            .coach-name {
                font-size: 12px;
            }

            .btn-message,
            .btn-disabled {
                padding: 0.4rem 0.6rem;
                font-size: 10px;
            }
        }
    </style>

    <div class="dashboard-container">
        <!-- Page Header -->
        <div class="page-header">
            <p class="page-header__subtitle">
                <i class="mdi mdi-information-outline me-1"></i>
                Manage your coaching requests and communications here.
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <!-- Active Connections Card -->
            <div class="stat-card stat-card--primary">
                <div class="stat-card__content">
                    <span class="stat-card__label">Active Connections</span>
                    <p class="stat-card__value">{{ $stats['active_connections'] }}</p>
                </div>
                <div class="stat-card__icon">
                    <i class="mdi mdi-link"></i>
                </div>
            </div>

            <!-- Total Requests Sent Card -->
            <div class="stat-card">
                <div class="stat-card__content">
                    <span class="stat-card__label">Total Requests Sent</span>
                    <p class="stat-card__value">{{ $stats['sent_requests'] }}</p>
                </div>
                <div class="stat-card__icon" style="color: #0ea5e9; opacity: 0.15;">
                    <i class="mdi mdi-send"></i>
                </div>
            </div>

            <!-- Unread Messages Card -->
            <div class="stat-card">
                <div class="stat-card__content">
                    <span class="stat-card__label">Unread Messages</span>
                    <p class="stat-card__value">{{ $stats['unread_messages'] }}</p>
                </div>
                <div class="stat-card__icon" style="color: #f59e0b; opacity: 0.15;">
                    <i class="mdi mdi-message-dots"></i>
                </div>
            </div>
        </div>

        <!-- Recent Requests Table -->
        <div class="card-modern">
            <div class="card-modern__header">
                <h5 class="card-modern__title">
                    <i class="mdi mdi-history me-2"></i>
                    Recent Connection Requests
                </h5>
            </div>

            <div class="card-modern__body">
                <div class="table-responsive">
                    <table class="table-requests">
                        <thead>
                            <tr>
                                <th>Coach Name</th>
                                <th>Status</th>
                                <th>Sent On</th>
                                <th class="text-end" style="padding-right: 1.5rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRequests as $req)
                                <tr>
                                    <!-- Coach Name -->
                                    <td>
                                        <span class="coach-name">{{ $req->receiver->name }}</span>
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        @if ($req->status == 'accepted')
                                            <span class="badge-status badge-status--accepted">
                                                <i class="mdi mdi-check-circle"></i>
                                                <span>Accepted</span>
                                            </span>
                                        @elseif($req->status == 'pending')
                                            <span class="badge-status badge-status--pending">
                                                <i class="mdi mdi-clock-outline"></i>
                                                <span>Pending</span>
                                            </span>
                                        @else
                                            <span class="badge-status badge-status--declined">
                                                <i class="mdi mdi-close-circle"></i>
                                                <span>Declined</span>
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Date -->
                                    <td>
                                        <span class="date-cell">{{ $req->created_at->format('d M, Y') }}</span>
                                    </td>

                                    <!-- Action -->
                                    <td class="action-cell">
                                        @if ($req->status == 'accepted')
                                            <a href="{{ route('seeker.messaging.chat', $req->receiver->id) }}"
                                                class="btn-message">
                                                <i class="mdi mdi-message-text-outline"></i>
                                                <span>Message</span>
                                            </a>
                                        @else
                                            <button class="btn-disabled" disabled>
                                                <i class="mdi mdi-eye-outline"></i>
                                                <span>View Profile</span>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <div class="empty-state__icon">
                                                <i class="mdi mdi-send-outline"></i>
                                            </div>
                                            <p class="empty-state__text">
                                                You haven't sent any requests yet.
                                            </p>
                                            <p style="font-size: 12px; color: #9ca3af; margin-top: 0.5rem;">
                                                Start by connecting with coaches you're interested in
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-seeker-layout>