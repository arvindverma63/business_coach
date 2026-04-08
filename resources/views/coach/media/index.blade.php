<x-coach-layout title="Media Gallery | CoffeePass">
    <style>
        /* ==================== Page Container ==================== */
        .media-container {
            padding: 2rem;
            background-color: #ffffff;
            min-height: 100vh;
            border-radius: 20px;
        }

        /* ==================== Page Header ==================== */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .page-header__content h4 {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            list-style: none;
            display: flex;
            gap: 0.5rem;
            font-size: 13px;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            color: #6b7280;
        }

        .breadcrumb-item a {
            color: #6366f1;
            text-decoration: none;
            transition: color 250ms ease-in-out;
        }

        .breadcrumb-item a:hover {
            color: #4f46e5;
        }

        .breadcrumb-item.active {
            color: #9ca3af;
        }

        .btn-upload {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.5rem;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 250ms ease-in-out;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-upload:hover {
            background-color: #4f46e5;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
            color: white;
        }

        .btn-upload i {
            font-size: 16px;
        }

        /* ==================== Filter Card ==================== */
        .filter-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: center;
        }

        .search-input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-input-group i {
            position: absolute;
            left: 1rem;
            color: #6b7280;
            font-size: 18px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 13px;
            background-color: #f9fafb;
            transition: all 250ms ease-in-out;
        }

        .search-input:focus {
            outline: none;
            border-color: #6366f1;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px #e0e7ff;
        }

        .filter-select {
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 13px;
            background-color: #f9fafb;
            color: #1f2937;
            cursor: pointer;
            transition: all 250ms ease-in-out;
        }

        .filter-select:focus {
            outline: none;
            border-color: #6366f1;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px #e0e7ff;
        }

        .btn-apply {
            padding: 0.75rem 1.5rem;
            background-color: #1f2937;
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 250ms ease-in-out;
        }

        .btn-apply:hover {
            background-color: #111827;
        }

        .btn-reset {
            padding: 0.75rem 1rem;
            background-color: #f3f4f6;
            color: #1f2937;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 16px;
            cursor: pointer;
            transition: all 250ms ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-reset:hover {
            background-color: #e5e7eb;
        }

        /* ==================== Gallery Grid ==================== */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* ==================== Media Card ==================== */
        .media-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 250ms ease-in-out;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .media-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-4px);
        }

        .media-card__preview {
            height: 180px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .media-card__preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 250ms ease-in-out;
        }

        .media-card:hover .media-card__preview img {
            transform: scale(1.05);
        }

        .media-card__preview--non-image {
            flex-direction: column;
        }

        .media-card__preview i {
            font-size: 56px;
            color: #9ca3af;
            opacity: 0.6;
            margin-bottom: 0.5rem;
        }

        .media-card__extension {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            color: #6b7280;
            margin-top: -0.5rem;
        }

        .media-card__badge {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            padding: 0.4rem 0.75rem;
            background-color: #6366f1;
            color: white;
            border-radius: 0.375rem;
            font-size: 11px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .media-card__size {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            padding: 0.4rem 0.75rem;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 0.375rem;
            font-size: 11px;
            font-weight: 600;
        }

        .media-card__body {
            padding: 1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .media-card__title {
            font-size: 14px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.75rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .media-card__meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 12px;
            color: #6b7280;
        }

        .media-card__footer {
            padding: 0.75rem 1rem;
            border-top: 1px solid #e5e7eb;
            background-color: #f9fafb;
            display: flex;
            gap: 0.5rem;
        }

        .btn-view {
            flex: 1;
            padding: 0.6rem 1rem;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 250ms ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            text-decoration: none;
        }

        .btn-view:hover {
            background-color: #4f46e5;
        }

        .btn-view i {
            font-size: 14px;
        }

        .btn-delete {
            padding: 0.6rem 1rem;
            background-color: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 0.5rem;
            font-size: 14px;
            cursor: pointer;
            transition: all 250ms ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-delete:hover {
            background-color: #ef4444;
            color: white;
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

        .empty-state__title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
        }

        /* ==================== Pagination ==================== */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .pagination-modern {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
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

        /* ==================== Modal Styles ==================== */
        .modal-modern .modal-content {
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .modal-modern .modal-header {
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            padding: 1.5rem;
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
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 1rem 1.5rem;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 13px;
            background-color: #ffffff;
            color: #1f2937;
            transition: all 250ms ease-in-out;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #6366f1;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px #e0e7ff;
        }

        .form-text {
            font-size: 12px;
            color: #6b7280;
        }

        .text-danger {
            color: #ef4444;
        }

        .progress {
            background-color: #e5e7eb;
            border-radius: 0.375rem;
            height: 8px;
        }

        .progress-bar {
            background-color: #6366f1;
        }

        .btn-modal-submit {
            padding: 0.75rem 2rem;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 250ms ease-in-out;
        }

        .btn-modal-submit:hover:not(:disabled) {
            background-color: #4f46e5;
        }

        .btn-modal-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-modal-cancel {
            padding: 0.75rem 2rem;
            background-color: #f3f4f6;
            color: #1f2937;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 250ms ease-in-out;
        }

        .btn-modal-cancel:hover {
            background-color: #e5e7eb;
        }

        .d-none {
            display: none;
        }

        /* ==================== Responsive Design ==================== */
        @media (max-width: 1200px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 1rem;
            }

            .filter-form {
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .media-container {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
            }

            .page-header__content h4 {
                font-size: 24px;
            }

            .btn-upload {
                width: 100%;
                justify-content: center;
            }

            .filter-form {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .btn-apply,
            .btn-reset {
                width: 100%;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 1rem;
            }

            .media-card__preview {
                height: 140px;
            }

            .media-card__preview i {
                font-size: 40px;
            }

            .media-card__body {
                padding: 0.75rem;
            }

            .media-card__title {
                font-size: 12px;
            }

            .media-card__footer {
                padding: 0.5rem;
                gap: 0.25rem;
            }

            .btn-view {
                padding: 0.5rem 0.75rem;
                font-size: 11px;
            }

            .btn-delete {
                padding: 0.5rem 0.75rem;
                font-size: 12px;
            }
            .content-page{
                width:100%!important;
            }
            .content{
                padding:0px;
                margin-top:10px;    
            }
            .btn-upload{
                    width: fit-content;
    padding: 5px 10px;
    border-radius: 5px;
    margin-left: auto;
            }
            .page-header{
                gap:9px;
                        margin-bottom: 10px;
        padding-bottom: 11px;
            }
            .filter-card{
                padding:12px;
            }
            .search-input{
                    padding: 10px 7px 10px 36px;
            }
            .filter-select{
                padding: 10px 10px;
            }
           .btn-apply, .btn-reset{
                    padding: 10px 10px;height: fit-content;
            }
            .gallery-grid{
                    display: flex;
    flex-direction: column;
            }
                .media-card__preview {
        height: 185px;
    }
    .modal-modern .modal-header{
        padding:12px;
                font-size: 13px;
    }
        }

        @media (max-width: 576px) {
            .page-header__content h4 {
                font-size: 20px;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .media-card__preview {
                height: 120px;
            }

            .media-card__preview i {
                font-size: 32px;
            }

            .modal-modern .modal-body {
                padding: 1rem;
            }
        }
    </style>

    <div class="media-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header__content">
                <h4>Media Gallery</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Coach</a></li>
                        <li class="breadcrumb-item active">My Media</li>
                    </ol>
                </nav>
            </div>
            <button class="btn-upload" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
              <i class="mdi mdi-upload"></i>
                <span>Upload New Asset</span>
            </button>
        </div>

        <!-- Filter Card -->
        <div class="filter-card">
            <form method="GET" action="{{ route('coach.media.index') }}" class="filter-form">
                <div class="search-input-group">
                    <i class="mdi mdi-magnify"></i>
                    <input type="text" name="search" class="search-input"
                        placeholder="Search my files..." value="{{ request('search') }}">
                </div>

                <select name="category_id" class="filter-select">
                    <option value="">All Categories</option>
                    @foreach (App\Models\Category::where('is_active', 1)->get() as $cat)
                        <option value="{{ $cat->id }}"
                            {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <select name="type" class="filter-select">
                    <option value="">All Types</option>
                    <option value="image" {{ request('type') == 'image' ? 'selected' : '' }}>Images</option>
                    <option value="book" {{ request('type') == 'book' ? 'selected' : '' }}>Books/PDFs</option>
                    <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Videos</option>
                    <option value="document" {{ request('type') == 'document' ? 'selected' : '' }}>Documents</option>
                </select>

                <div style="display: flex; gap: 0.5rem;">
                    <button type="submit" class="btn-apply">Apply Filters</button>
                    <a href="{{ route('coach.media.index') }}" class="btn-reset" title="Reset">
                        <i class="mdi mdi-refresh"></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid">
            @forelse($items as $item)
                <div class="media-card">
                    <div class="media-card__preview">
                        @if ($item->file_type == 'image')
                            <img src="{{ asset($item->url) }}" alt="{{ $item->title }}">
                        @else
                            <div class="media-card__preview--non-image">
                                <i class="mdi {{ $item->icon }}"></i>
                                <span class="media-card__extension">{{ $item->extension }}</span>
                            </div>
                        @endif

                        <span class="media-card__badge">{{ $item->category->name ?? 'Uncategorized' }}</span>
                        <span class="media-card__size">{{ $item->readable_size }}</span>
                    </div>

                    <div class="media-card__body">
                        <h6 class="media-card__title" title="{{ $item->title }}">{{ $item->title }}</h6>

                        <div class="media-card__meta">
                            <i class="mdi mdi-calendar-outline"></i>
                            <span>{{ $item->created_at->format('d M, Y') }}</span>
                        </div>
                    </div>

                    <div class="media-card__footer">
                        <a href="{{ asset($item->url) }}" target="_blank" class="btn-view">
                            <i class="mdi mdi-eye-outline"></i>
                            <span>View</span>
                        </a>

                        <form action="{{ route('coach.media.destroy', $item->id) }}" method="POST"
                            style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="button" class="btn-delete confirm-delete" title="Delete">
                                <i class="mdi mdi-trash-can-outline"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                
        </div>
        <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-state__icon">
                            <i class="mdi mdi-folder-open-outline"></i>
                        </div>
                        <h5 class="empty-state__title">You haven't uploaded any media yet.</h5>
                        <p style="font-size: 13px; color: #6b7280; margin-top: 0.5rem;">
                            Start by uploading your first media file
                        </p>
                    </div>
                </div>
            @endforelse

        <!-- Pagination -->
        <div class="pagination-container">
            <div class="pagination-modern">
                {{ $items->appends(request()->all())->links() }}
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div class="modal fade modal-modern" id="uploadMediaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="mediaUploadForm" action="{{ route('coach.media.upload') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="mdi mdi-cloud-upload-outline me-2"></i>
                            Upload New Media
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Display Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control"
                                placeholder="e.g. Session Handout PDF" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select" required>
                                <option value="" disabled selected>Select a Category</option>
                                @foreach (App\Models\Category::where('is_active', 1)->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select File <span class="text-danger">*</span></label>
                            <input type="file" name="file" id="mediaFile" class="form-control" required>
                            <div class="form-text">
                                Max size: 50MB. Supported: Images, PDFs, and Documents.
                            </div>
                        </div>

                        <div class="progress mt-3 d-none" id="uploadProgressContainer">
                            <div id="uploadProgressBar" class="progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="submitBtn" class="btn-modal-submit">
                            <span id="btnText">Start Upload</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Delete Handler (Event Delegation)
                $(document).on('click', '.confirm-delete', function(e) {
                    e.preventDefault();
                    const $form = $(this).closest('form');
                    Swal.fire({
                        title: 'Delete this file?',
                        text: "This action will permanently remove the asset from your gallery.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#f3f4f6',
                        customClass: {
                            confirmButton: 'btn btn-danger px-4 me-2',
                            cancelButton: 'btn btn-light px-4'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) $form.submit();
                    });
                });

                // Upload UI Handler
                $('#mediaFile').on('change', function() {
                    if (this.files[0].size > 50 * 1024 * 1024) {
                        Swal.fire('File Too Large', 'Please select a file smaller than 50MB.', 'error');
                        $(this).val('');
                    }
                });

                $('#mediaUploadForm').on('submit', function() {
                    $('#submitBtn').prop('disabled', true);
                    $('#btnText').text('Uploading...');
                    $('#uploadProgressContainer').removeClass('d-none');
                    let p = 0;
                    const timer = setInterval(() => {
                        p += (p < 90) ? 5 : 0.2;
                        $('#uploadProgressBar').css('width', p + '%');
                        if (p >= 99) clearInterval(timer);
                    }, 250);
                });
            });
        </script>
    @endpush
</x-coach-layout>