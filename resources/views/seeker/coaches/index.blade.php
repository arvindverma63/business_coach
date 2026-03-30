<x-seeker-layout title="Find Coaches | BestBusinessCoach">
    <div class="container-fluid">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h4 class="fs-20 fw-bold m-0 text-dark">Discover Coaches</h4>
                <p class="text-muted font-size-13 mb-0">Browse through our verified business coaches to start your
                    journey.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <form action="{{ route('seeker.coaches.index') }}" method="GET" class="mt-3 mt-md-0 d-inline-block w-100"
                    style="max-width: 400px;">
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="mdi mdi-magnify"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0"
                            placeholder="Search name or expertise..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary px-4">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse($coaches as $coach)
                @php
                    $existingReq = \App\Models\MessageRequest::where('sender_id', auth()->id())
                        ->where('receiver_id', $coach->id)
                        ->first();
                    $expertiseCategories = $coach->coachProfile?->categories ?? collect();
                    $coachContents = $coach->blogs ?? collect();
                    $contentCategories = $coachContents->pluck('category')->filter()->unique('id')->sortBy('name')->values();
                @endphp

                <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100 transition-hover border-top border-4 border-primary">
                        <div class="card-body text-center p-3">
                            <div class="mb-2 position-relative d-inline-block" role="button" data-bs-toggle="modal"
                                data-bs-target="#profileModal{{ $coach->id }}">
                                <img src="{{ asset($coach->profile_image) ?? asset('assets/images/users/user.avif') }}"
                                    class="rounded-circle border p-1"
                                    style="width: 72px; height: 72px; object-fit: cover;" alt="{{ $coach->name }}">
                                <span
                                    class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1">
                                    <i class="mdi mdi-check-decagram text-white font-size-12"></i>
                                </span>
                            </div>

                            <h5 class="fs-17 fw-bold mb-1" role="button" data-bs-toggle="modal"
                                data-bs-target="#profileModal{{ $coach->id }}">
                                {{ $coach->name }}
                            </h5>
                            <p class="text-primary font-size-13 mb-2 fw-medium">
                                {{ $coach->coachProfile->designation ?? 'Business Coach' }}</p>

                            <div class="d-flex flex-wrap justify-content-center gap-1 mb-3">
                                @if ($expertiseCategories->isNotEmpty())
                                    @foreach ($expertiseCategories->take(2) as $cat)
                                        <span
                                            class="badge bg-soft-info text-info border border-info-subtle text-truncate"
                                            style="max-width: 130px;">{{ $cat->name }}</span>
                                    @endforeach
                                @elseif ($coach->categories && $coach->categories->isNotEmpty())
                                    @foreach ($coach->categories->take(2) as $cat)
                                        <span
                                            class="badge bg-soft-info text-info border border-info-subtle text-truncate"
                                            style="max-width: 130px;">{{ $cat->name }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-soft-secondary text-muted border">General Coaching</span>
                                @endif
                            </div>

                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-light btn-sm border py-1" data-bs-toggle="modal"
                                    data-bs-target="#profileModal{{ $coach->id }}">
                                    View Full Profile
                                </button>

                                <button type="button" class="btn btn-outline-primary btn-sm py-1" data-bs-toggle="modal"
                                    data-bs-target="#coachContentModal{{ $coach->id }}">
                                    View Content
                                </button>

                                @if (!$existingReq)
                                    <button type="button" class="btn btn-primary btn-sm py-1" data-bs-toggle="modal"
                                        data-bs-target="#connectModal{{ $coach->id }}">
                                        Connect Now
                                    </button>
                                @elseif($existingReq->status == 'pending')
                                    <button class="btn btn-soft-warning btn-sm py-1" disabled><i
                                            class="mdi mdi-clock-outline me-1"></i>Pending</button>
                                @elseif($existingReq->status == 'accepted')
                                    <a href="{{ route('seeker.messaging.chat', $coach->id) }}" class="btn btn-success btn-sm py-1">
                                        <i class="mdi mdi-message-text-outline me-1"></i>Chat Now
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="profileModal{{ $coach->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg">
                            <div class="modal-body p-0">
                                <div class="row g-0">
                                    <div class="col-md-5 bg-light p-5 text-center border-end">
                                        <img src="{{ $coach->profile_image ? asset($coach->profile_image) : asset('assets/images/users/user.avif') }}"
                                            class="rounded-circle shadow-sm mb-3 border border-4 border-white"
                                            style="width: 150px; height: 150px; object-fit: cover;">

                                        <h4 class="fw-bold mb-1">{{ $coach->name }}</h4>
                                        <p class="text-primary fw-medium mb-3">
                                            {{ $coach->designation ?? 'Business Coach' }}</p>

                                        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                                            @forelse ($expertiseCategories->take(4) as $category)
                                                <span class="badge bg-soft-primary text-primary border border-primary-subtle px-3 py-2">
                                                    {{ $category->name }}
                                                </span>
                                            @empty
                                                <span class="badge bg-soft-secondary text-muted border px-3 py-2">General Business Coaching</span>
                                            @endforelse
                                        </div>

                                        <div class="mt-4 pt-3 border-top text-start">
                                            <h6 class="font-size-12 text-uppercase fw-bold text-muted mb-3">Contact
                                                Information</h6>

                                            @if ($coach->coachProfile && $coach->coachProfile->gender === 'female')
                                                <div class="alert alert-soft-secondary p-2 mb-0">
                                                    <p class="small mb-0 text-muted">
                                                        <i class="mdi mdi-lock-outline me-1"></i>
                                                        Contact details are hidden for privacy. Please connect to
                                                        communicate.
                                                    </p>
                                                </div>
                                            @else
                                                <div class="mb-2">
                                                    <small class="text-muted d-block">Email Address</small>
                                                    <span class="fw-medium">{{ $coach->email }}</span>
                                                </div>
                                                <div class="mb-0">
                                                    <small class="text-muted d-block">Phone Number</small>
                                                    <span
                                                        class="fw-medium">{{ $coach->phone ?? 'Not Provided' }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-center gap-2 mt-4">
                                            @if ($coach->coachProfile && $coach->coachProfile->linkedin_url)
                                                <a href="{{ $coach->coachProfile->linkedin_url }}" target="_blank"
                                                    class="btn btn-sm btn-info shadow-sm"><i
                                                        class="mdi mdi-linkedin"></i></a>
                                            @endif
                                            @if ($coach->coachProfile && $coach->coachProfile->website_url)
                                                <a href="{{ $coach->coachProfile->website_url }}" target="_blank"
                                                    class="btn btn-sm btn-dark shadow-sm"><i
                                                        class="mdi mdi-earth"></i></a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-7 p-4">
                                        <button type="button" class="btn-close float-end"
                                            data-bs-dismiss="modal"></button>

                                        <h6 class="text-primary text-uppercase fw-bold mb-2">About Me</h6>
                                        <p class="text-dark mb-4" style="line-height: 1.6;">
                                            {{ $coach->coachProfile->bio ?? 'No professional bio provided yet.' }}</p>

                                        <div class="row mb-4 bg-soft-light p-3 rounded">
                                            <div class="col-6">
                                                <h6 class="fw-bold mb-1 small text-muted text-uppercase">Experience</h6>
                                                <p class="text-dark fw-semibold mb-0">
                                                    {{ $coach->coachProfile->experience_years ?? 0 }}+ Years</p>
                                            </div>
                                            <div class="col-6 border-start">
                                                <h6 class="fw-bold mb-1 small text-muted text-uppercase">Location</h6>
                                                <p class="text-dark fw-semibold mb-0">
                                                    {{ $coach->coachProfile->city ?? 'N/A' }},
                                                    {{ $coach->coachProfile->state ?? '' }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h6 class="fw-bold mb-0 small text-muted text-uppercase">Specializations</h6>
                                                <span class="badge bg-light text-dark border">{{ $expertiseCategories->count() }} Areas</span>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                @forelse ($expertiseCategories as $category)
                                                    <span
                                                        class="badge bg-soft-primary text-primary border border-primary-subtle px-3 py-2">
                                                        {{ $category->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-muted small">General Business Coaching</span>
                                                @endforelse
                                            </div>
                                        </div>

                                        <div class="rounded-3 border bg-light-subtle p-3 mb-4">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <div>
                                                    <h6 class="fw-bold mb-1">Coach Content</h6>
                                                    <p class="text-muted small mb-0">Browse published blogs and insights from this coach.</p>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#coachContentModal{{ $coach->id }}"
                                                    data-bs-dismiss="modal">
                                                    View Content
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mt-auto">
                                            @if (!$existingReq)
                                                <button class="btn btn-primary btn-lg w-100 shadow-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#connectModal{{ $coach->id }}"
                                                    data-bs-dismiss="modal">
                                                    <i class="mdi mdi-account-plus-outline me-1"></i> Request
                                                    Connection
                                                </button>
                                            @elseif($existingReq->status == 'accepted')
                                                <a href="{{ route('seeker.messaging.chat', $coach->id) }}"
                                                    class="btn btn-success btn-lg w-100 shadow-sm">
                                                    <i class="mdi mdi-message-text-outline me-1"></i> Send Message
                                                </a>
                                            @else
                                                <button class="btn btn-secondary btn-lg w-100" disabled>
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

                <div class="modal fade" id="coachContentModal{{ $coach->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                        <div class="modal-content border-0 shadow-lg">
                            <div class="modal-header border-0 pb-0">
                                <div>
                                    <h4 class="modal-title fw-bold mb-1">{{ $coach->name }}'s Content</h4>
                                    <p class="text-muted mb-0">Filter published content by keyword or category.</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body pt-4">
                                <div class="row g-3 align-items-end mb-4">
                                    <div class="col-md-6">
                                        <label for="contentSearch{{ $coach->id }}" class="form-label small text-muted text-uppercase fw-bold">Search</label>
                                        <input type="text" id="contentSearch{{ $coach->id }}"
                                            class="form-control"
                                            placeholder="Search title or content...">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="contentCategory{{ $coach->id }}" class="form-label small text-muted text-uppercase fw-bold">Category</label>
                                        <select id="contentCategory{{ $coach->id }}" class="form-select">
                                            <option value="">All Categories</option>
                                            @foreach ($contentCategories as $category)
                                                <option value="{{ \Illuminate\Support\Str::lower($category->name) }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="rounded-3 border bg-light-subtle p-3 text-center">
                                            <div class="small text-muted text-uppercase fw-bold">Items</div>
                                            <div class="fw-bold fs-18" id="contentCount{{ $coach->id }}">{{ $coachContents->count() }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3" id="coachContentList{{ $coach->id }}">
                                    @forelse ($coachContents as $content)
                                        <div class="col-md-6 coach-content-item-{{ $coach->id }}"
                                            data-title="{{ \Illuminate\Support\Str::lower($content->title) }}"
                                            data-body="{{ \Illuminate\Support\Str::lower(strip_tags($content->content)) }}"
                                            data-category="{{ \Illuminate\Support\Str::lower($content->category->name ?? 'uncategorized') }}">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <div class="flex-shrink-0">
                                                            @if ($content->featured_image)
                                                                <img src="{{ asset('storage/' . $content->featured_image) }}"
                                                                    alt="{{ $content->title }}"
                                                                    class="rounded"
                                                                    style="width: 72px; height: 72px; object-fit: cover;">
                                                            @else
                                                                <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                                                    style="width: 72px; height: 72px;">
                                                                    <i class="mdi mdi-file-document-outline fs-28 text-muted"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                                <span class="badge bg-soft-primary text-primary border border-primary-subtle">Blog</span>
                                                                <span class="badge bg-light text-dark border">{{ $content->category->name ?? 'Uncategorized' }}</span>
                                                            </div>
                                                            <h5 class="fw-bold fs-16 mb-2">{{ $content->title }}</h5>
                                                            <p class="text-muted small mb-3">
                                                                {{ \Illuminate\Support\Str::limit(strip_tags($content->content), 130) }}
                                                            </p>
                                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                                <small class="text-muted">{{ $content->created_at?->format('d M Y') }}</small>
                                                                <a href="{{ route('blog-detail', $content->slug) }}"
                                                                    class="btn btn-outline-primary btn-sm" target="_blank">
                                                                    Read More
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="text-center py-5 text-muted border rounded-3 bg-light-subtle">
                                                No published content is available for this coach yet.
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                                <div class="text-center py-4 text-muted d-none" id="coachContentEmpty{{ $coach->id }}">
                                    No content matches the selected filters.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="connectModal{{ $coach->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('seeker.coaches.connect', $coach->id) }}" method="POST">
                                @csrf
                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold">Connect with {{ $coach->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body py-0">
                                    <div class="alert alert-info py-2 small">
                                        Introduce yourself briefly to increase your chances of acceptance.
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Your Message</label>
                                        <textarea name="message" class="form-control" rows="4"
                                            placeholder="Hi {{ $coach->name }}, I'm looking for guidance on..."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary px-4">Send Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center py-5">
                    <img src="{{ asset('assets/images/no-results.png') }}" class="mb-3"
                        style="width: 100px; opacity: 0.5;">
                    <h5 class="text-muted">No coaches match your search criteria.</h5>
                    <a href="{{ route('seeker.coaches.index') }}" class="btn btn-link">Reset Filters</a>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $coaches->appends(request()->input())->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            // Smoothly handle switching between Profile Modal and Connect Modal
            // This prevents the "frozen background" issue in Bootstrap
            $(document).on('click', '[data-bs-target^="#connectModal"]', function() {
                $('.modal').modal('hide');
            });

            @foreach ($coaches as $coach)
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
