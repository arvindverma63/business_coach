<x-coach-layout title="Dashboard Overview">
    <style>
        /* ==================== CSS Variables & Root Styles ==================== */
        :root {
            --primary-color: #6366f1;
            --primary-light: #e0e7ff;
            --primary-dark: #4f46e5;
            
            --info-color: #0ea5e9;
            --info-light: #cffafe;
            --info-dark: #0284c7;
            
            --success-color: #10b981;
            --success-light: #d1fae5;
            --success-dark: #059669;
            
            --danger-color: #ef4444;
            --danger-light: #fee2e2;
            --danger-dark: #dc2626;
            
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
            --radius-base: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            
            --transition-fast: 150ms ease-in-out;
            --transition-base: 250ms ease-in-out;
        }

        /* ==================== Dashboard Container ==================== */
        .dashboard-container {
            padding: 2rem;
            background-color: var(--bg-secondary);
        }

        /* ==================== Stats Cards Grid ==================== */
        .stats-cards-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* ==================== Stat Card ==================== */
        .stat-card {
            position: relative;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: all var(--transition-base);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
            border-color: var(--primary-color);
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

        .stat-card.stat-card--primary::before {
            background-color: var(--primary-color);
        }

        .stat-card.stat-card--info::before {
            background-color: var(--info-color);
        }

        .stat-card.stat-card--success::before {
            background-color: var(--success-color);
        }

        /* Icon Container */
        .stat-card__icon {
            position: relative;
            z-index: 1;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-md);
            font-size: 24px;
            flex-shrink: 0;
        }

        .stat-card.stat-card--primary .stat-card__icon {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }

        .stat-card.stat-card--info .stat-card__icon {
            background-color: var(--info-light);
            color: var(--info-color);
        }

        .stat-card.stat-card--success .stat-card__icon {
            background-color: var(--success-light);
            color: var(--success-color);
        }

        /* Content Container */
        .stat-card__content {
            position: relative;
            z-index: 1;
            flex: 1;
        }

        .stat-card__label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            margin-bottom: 0.25rem;
        }

        .stat-card__value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1;
            margin: 0;
        }

        /* ==================== Content Grid ==================== */
        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        /* ==================== Card Base Styles ==================== */
        .card-modern {
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: box-shadow var(--transition-base);
        }

        .card-modern:hover {
            box-shadow: var(--shadow-md);
        }

        .card-modern__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        .table-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-modern thead {
            background-color: var(--bg-tertiary);
        }

        .table-modern th {
            padding: 1rem 1.5rem;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table-modern td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-modern tbody tr {
            transition: background-color var(--transition-fast);
        }

        .table-modern tbody tr:hover {
            background-color: var(--bg-secondary);
        }

        /* ==================== Table Cell Variants ==================== */
        .table-cell__title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .table-cell__icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-md);
            background-color: var(--primary-light);
            color: var(--primary-color);
            flex-shrink: 0;
            font-size: 18px;
        }

        .table-cell__name {
            font-weight: 600;
            color: var(--text-primary);
        }

        /* ==================== Badge Styles ==================== */
        .badge-modern {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 600;
            border-radius: var(--radius-sm);
            white-space: nowrap;
        }

        .badge-modern--info {
            background-color: var(--info-light);
            color: var(--info-color);
        }

        .badge-modern--success {
            background-color: var(--success-light);
            color: var(--success-color);
        }

        /* ==================== Empty State ==================== */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
        }

        .empty-state__icon {
            font-size: 48px;
            color: var(--text-secondary);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state__text {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .empty-state__subtext {
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* ==================== Utility Classes ==================== */
        .text-end {
            text-align: right;
        }

        .ps-3 {
            padding-left: 1rem;
        }

        .pe-3 {
            padding-right: 1rem;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .fw-medium {
            font-weight: 500;
        }

        .fw-bold {
            font-weight: 700;
        }

        /* ==================== Responsive Design ==================== */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }

            .stats-cards-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .card-modern__header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .table-modern th,
            .table-modern td {
                padding: 0.75rem;
                font-size: 12px;
            }

            .card-modern__title {
                font-size: 16px;
            }
            .content{
                padding:0px;
            }
        }
          @media (max-width: 575px) {
            .table-modern{
                    width: 510px;
            }
                .card-modern__title {
        font-size: 14px;
    }
    .card-modern__header {
    padding: 12px;
}
    .dashboard-container {
        padding: 10px;
    }
          }
    </style>

    <div class="dashboard-container">
        <!-- Stats Cards Section -->
        <div class="stats-cards-row">
            <!-- Total Blogs Card -->
            <div class="stat-card stat-card--primary">
                <div class="stat-card__icon">
                    <iconify-icon icon="tabler:news" class="fs-24"></iconify-icon>
                </div>
                <div class="stat-card__content">
                    <span class="stat-card__label">Total Blogs</span>
                    <p class="stat-card__value">{{ $stats['total_blogs'] }}</p>
                </div>
            </div>

            <!-- All Requests Card -->
            <div class="stat-card stat-card--info">
                <div class="stat-card__icon">
                    <iconify-icon icon="tabler:message-dots" class="fs-24"></iconify-icon>
                </div>
                <div class="stat-card__content">
                    <span class="stat-card__label">All Requests</span>
                    <p class="stat-card__value">{{ $stats['requests'] }}</p>
                </div>
            </div>

            <!-- Published Posts Card -->
            <div class="stat-card stat-card--success">
                <div class="stat-card__icon">
                    <iconify-icon icon="tabler:circle-check" class="fs-24"></iconify-icon>
                </div>
                <div class="stat-card__content">
                    <span class="stat-card__label">Published</span>
                    <p class="stat-card__value">{{ $stats['published_posts'] }}</p>
                </div>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="content-wrapper">
            <!-- Top Performing Articles Card -->
            <div class="card-modern">
                <div class="card-modern__header">
                    <h5 class="card-modern__title">Top Performing Articles</h5>
                </div>

                <div class="card-modern__body">
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th class="ps-3">Article Title</th>
                                    <th class="text-end pe-3">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topBlogs as $blog)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="table-cell__title">
                                                <div class="table-cell__icon">
                                                    <iconify-icon icon="tabler:file-text"></iconify-icon>
                                                </div>
                                                <span class="table-cell__name fw-medium">{{ Str::limit($blog->title, 50) }}</span>
                                            </div>
                                        </td>
                                        <td class="text-end pe-3">
                                            <span class="badge-modern badge-modern--info">
                                                {{ number_format($blog->view_count) }}
                                                <iconify-icon icon="tabler:eye"></iconify-icon>
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">
                                            <div class="empty-state">
                                                <div class="empty-state__icon">
                                                    <iconify-icon icon="tabler:inbox"></iconify-icon>
                                                </div>
                                                <p class="empty-state__text">No data available.</p>
                                                <p class="empty-state__subtext">Start publishing your first article</p>
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
    </div>
</x-coach-layout>