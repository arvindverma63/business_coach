<x-app-layout title="Edit Hero Banner">
    <div class="page-content">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Edit Hero Banner
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.hero-banners.update', $heroBanner->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Hero Image (Main Image)</label>
                                    @if($heroBanner->image)
                                    <div class="mb-2">
                                        <img src="{{ $heroBanner->image_url }}" alt="{{ $heroBanner->title }}" style="max-height: 150px;">
                                    </div>
                                    @endif
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    <small class="form-text text-muted">Recommended size: 600x600px (JPG, PNG, WebP - Max 2MB)</small>
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                                        value="{{ old('sort_order', $heroBanner->sort_order) }}" min="0">
                                    @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                                            value="1" {{ old('is_active', $heroBanner->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <a href="{{ route('admin.hero-banners.index') }}" class="btn btn-link">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update Banner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
