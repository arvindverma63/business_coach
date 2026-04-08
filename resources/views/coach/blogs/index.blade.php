<x-coach-layout title="My Blogs">
    <style>
        /* ==================== Page Container ==================== */
        .blogs-container {
            padding: 2rem;
            background-color: #ffffff;
            min-height: 100vh;
            border-radius:20px;
        }

        /* ==================== Page Header ==================== */
        .blogs-header {
            margin-bottom: 2rem;
        }

        .blogs-header__title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .blogs-header__subtitle {
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

        .card-modern__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            background-color: #ffffff;
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

        /* ==================== Button Styles ==================== */
        .btn-create {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 250ms ease-in-out;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-create:hover {
            background-color: #4f46e5;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
            color: white;
        }

        .btn-create i {
            font-size: 16px;
        }

        /* ==================== Table Styles ==================== */
        .table-blogs {
            width: 100%;
            border-collapse: collapse;
        }

        .table-blogs thead {
            background-color: #f3f4f6;
        }

        .table-blogs th {
            padding: 12px 10px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-blogs td {
            padding: 12px 10px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .table-blogs tbody tr {
            transition: background-color 250ms ease-in-out;
        }

        .table-blogs tbody tr:hover {
            background-color: #f9fafb;
        }

        /* ==================== Blog Info ==================== */
        .blog-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .blog-thumbnail {
            width: 44px;
            height: 44px;
            border-radius: 0.5rem;
            object-fit: cover;
            border: 1px solid #e5e7eb;
            flex-shrink: 0;
            transition: all 250ms ease-in-out;
        }

        .blog-item:hover .blog-thumbnail {
            border-color: #6366f1;
            box-shadow: 0 0 0 2px #e0e7ff;
        }

        .blog-title {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        /* ==================== Category Badge ==================== */
        .badge-category {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background-color: #f3f4f6;
            color: #1f2937;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* ==================== Status Badge ==================== */
        .badge-status {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 0.75rem;
            font-size: 12px;
            font-weight: 600;
            border-radius: 0.375rem;
            white-space: nowrap;
        }

        .badge-status--published {
            background-color: #d1fae5;
            color: #10b981;
        }

        .badge-status--pending {
            background-color: #fef3c7;
            color: #f59e0b;
        }

        /* ==================== Views Count ==================== */
        .views-count {
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
        }

        /* ==================== Date ==================== */
        .date-created {
            font-size: 13px;
            color: #6b7280;
            white-space: nowrap;
        }

        /* ==================== Action Buttons ==================== */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 0.5rem;
            font-size: 16px;
            cursor: pointer;
            transition: all 250ms ease-in-out;
            text-decoration: none;
            color: inherit;
        }

        .btn-action--edit {
            background-color: #cffafe;
            color: #0ea5e9;
        }

        .btn-action--edit:hover {
            background-color: #0ea5e9;
            color: white;
            transform: translateY(-2px);
        }

        .btn-action--delete {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .btn-action--delete:hover {
            background-color: #ef4444;
            color: white;
            transform: translateY(-2px);
        }

        /* ==================== Empty State ==================== */
        .empty-state {
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

        .empty-state__text {
            font-size: 16px;
            color: #6b7280;
        }

        /* ==================== Pagination ==================== */
        .pagination-modern {
            padding: 1.5rem;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
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

        .me-1 {
            margin-right: 0.25rem;
        }

        .me-2 {
            margin-right: 0.5rem;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        /* ==================== Responsive Design ==================== */
        @media (max-width: 1024px) {
            .table-blogs th:nth-child(3),
            .table-blogs td:nth-child(3) {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .blogs-container {
                padding: 1rem;
            }

            .blogs-header__title {
                font-size: 24px;
            }

            .card-modern__header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .btn-create {
                width: 100%;
                justify-content: center;
            }

            .table-blogs th,
            .table-blogs td {
                padding: 0.75rem;
                font-size: 12px;
            }

            .blog-thumbnail {
                width: 36px;
                height: 36px;
            }

            .blog-title {
                font-size: 12px;
            }

            .table-blogs th:nth-child(2),
            .table-blogs td:nth-child(2),
            .table-blogs th:nth-child(4),
            .table-blogs td:nth-child(4),
            .table-blogs th:nth-child(5),
            .table-blogs td:nth-child(5) {
                display: none;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 28px;
                height: 28px;
            }
            .content{
                padding:0px;
                margin-top:10px;    
            }
            .btn-create{
                    width: fit-content;
    padding: 4px 10px;
    border-radius: 4px;
    margin-left: auto;
            }
            .card-modern__header{
                padding:12px;
            }
            .table-blogs{
                    width: max-content;
            }
            .content-page{
                width:100%;
            }
        }

        @media (max-width: 576px) {
            .blogs-header__title {
                font-size: 20px;
            }

            .table-blogs th,
            .table-blogs td {
                padding: 0.6rem;
                font-size: 11px;
            }

            .blog-thumbnail {
                width: 32px;
                height: 32px;
            }

            .blog-title {
                font-size: 11px;
            }

            .action-buttons {
                gap: 0.25rem;
            }

            .btn-action {
                width: 26px;
                height: 26px;
                font-size: 14px;
            }
            .action-buttons{
                flex-direction: row!important;
            }
        }
    </style>

    <div class="blogs-container">
        <!-- Page Header -->
        <div class="blogs-header">
            <h4 class="blogs-header__title">Manage Blogs</h4>
            <p class="blogs-header__subtitle">Create, edit, and manage your blog posts</p>
        </div>

        <!-- Main Card -->
        <div class="card-modern">
            <!-- Card Header -->
            <div class="card-modern__header">
                <h5 class="card-modern__title">
                    <i class="mdi mdi-file-document-multiple me-2"></i>
                    All Blogs
                </h5>
                <a href="{{ route('coach.blogs.create') }}" class="btn-create">
                    <i class="mdi mdi-plus"></i>
                    <span>Create New</span>
                </a>
            </div>

            <!-- Card Body -->
            <div class="card-modern__body">
                <div class="table-responsive">
                    <table class="table-blogs">
                        <thead>
                            <tr>
                                <th class="ps-4">Blog</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Created At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogs as $blog)
                                <tr>
                                    <!-- Blog Info -->
                                    <td class="ps-4">
                                        <div class="blog-item">
                                            @php
                                                $displayImage = asset('assets/images/default-blog.png');

                                                if (
                                                    $blog->featured_image &&
                                                    Illuminate\Support\Facades\Storage::disk('public')->exists(
                                                        $blog->featured_image,
                                                    )
                                                ) {
                                                    $displayImage = asset('storage/' . $blog->featured_image);
                                                }
                                            @endphp

                                            <img src="{{ $displayImage }}"
                                                class="blog-thumbnail"
                                                alt="Blog Thumbnail">

                                            <span class="blog-title">
                                                {{ Str::limit($blog->title, 40) }}
                                            </span>
                                        </div>
                                    </td>

                                    <!-- Category -->
                                    <td>
                                        <span class="badge-category">
                                            {{ $blog->category?->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        @if ((bool) $blog->is_published)
                                            <span class="badge-status badge-status--published">
                                                <i class="mdi mdi-check-circle me-1"></i>
                                                Published
                                            </span>
                                        @else
                                            <span class="badge-status badge-status--pending">
                                                <i class="mdi mdi-clock-outline me-1"></i>
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Views -->
                                    <td>
                                        <span class="views-count">
                                            <i class="mdi mdi-eye-outline me-1"></i>
                                            {{ number_format($blog->view_count ?? 0) }}
                                        </span>
                                    </td>

                                    <!-- Created Date -->
                                    <td>
                                        <span class="date-created">
                                            {{ $blog->created_at->format('M d, Y') }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-end pe-4">
                                        <div class="action-buttons">
                                            <a href="{{ route('coach.blogs.edit', $blog->id) }}"
                                                class="btn-action btn-action--edit"
                                                title="Edit Blog">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('coach.blogs.destroy', $blog->id) }}"
                                                method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="btn-action btn-action--delete"
                                                    title="Delete Blog">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <div class="empty-state__icon">
                                                <i class="mdi mdi-file-document-outline"></i>
                                            </div>
                                            <p class="empty-state__text">No blogs found yet.</p>
                                            <p style="font-size: 13px; color: #9ca3af; margin-top: 0.5rem;">
                                                Start creating your first blog post
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if ($blogs->hasPages())
                <div class="pagination-modern">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-coach-layout>