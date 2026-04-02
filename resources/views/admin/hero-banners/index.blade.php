<x-app-layout title="Hero Banners Management">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Administration</div>
                    <h2 class="page-title">Hero Banners Management</h2>
                </div>

                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.hero-banners.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="fas fa-plus me-2"></i> Create New Banner
                        </a>
                        <a href="{{ route('admin.hero-banners.create') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new banner">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @if($banners->isNotEmpty())
                <div class="row row-cards">
                    @foreach($banners as $banner)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card h-100 shadow-sm">
                                <div class="position-relative">
                                    @if($banner->image_url)
                                        <img src="{{ $banner->image_url }}" class="card-img-top" alt="{{ $banner->title }}" style="height: 220px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="height: 220px;">
                                            <i class="fas fa-image fa-3x"></i>
                                        </div>
                                    @endif

                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-light text-dark border">
                                            Sort Order: {{ $banner->sort_order }}
                                        </span>
                                    </div>
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-start justify-content-between gap-3">
                                        <div>
                                            <h3 class="card-title mb-1">{{ $banner->title }}</h3>
                                            @if($banner->subtitle)
                                                <p class="text-muted mb-0">{{ $banner->subtitle }}</p>
                                            @endif
                                        </div>

                                        @if($banner->is_active)
                                            <span class="badge bg-success-lt">Active</span>
                                        @else
                                            <span class="badge bg-secondary-lt">Inactive</span>
                                        @endif
                                    </div>

                                    @if($banner->description)
                                        <p class="text-muted mt-3 mb-0">
                                            {{ Str::limit($banner->description, 120) }}
                                        </p>
                                    @endif

                                    <div class="mt-auto pt-3">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <a href="{{ route('admin.hero-banners.edit', $banner->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>

                                            <form action="{{ route('admin.hero-banners.destroy', $banner->id) }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($banners->hasPages())
                    <div class="card mt-3">
                        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <p class="m-0 text-muted d-none d-md-block">
                                Showing <span>{{ $banners->firstItem() }}</span> to <span>{{ $banners->lastItem() }}</span> of <span>{{ $banners->total() }}</span> entries
                            </p>
                            <div class="ms-auto">
                                {{ $banners->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="card card-md">
                    <div class="card-body">
                        <div class="empty">
                            <div class="empty-icon">
                                <i class="fas fa-images fa-3x text-muted"></i>
                            </div>
                            <p class="empty-title">No banners found</p>
                            <p class="empty-subtitle text-muted">
                                There are currently no banners to display.
                            </p>
                            <div class="empty-action">
                                <a href="{{ route('admin.hero-banners.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i> Add your first banner
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
