<x-seeker-layout title="Chat with {{ $coach->name }} | BestBusinessCoach">
    @php
        $coachProfile = $coach->coachProfile;
        $expertiseCategories = $coachProfile?->categories ?? collect();
        $contentCategories = $coachContents->pluck('category')->filter()->unique('id')->sortBy('name')->values();
    @endphp

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="card border-0 shadow-sm mb-0"
                    style="height: calc(100vh - 150px); display: flex; flex-direction: column; overflow: hidden;">

                    <div class="card-header bg-white border-bottom p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center" role="button" data-bs-toggle="modal"
                                data-bs-target="#profileModal{{ $coach->id }}">
                                <div class="position-relative">
                                    <img src="{{ $coach->profile_image ?? asset('assets/images/users/user.avif') }}"
                                        class="rounded-circle border"
                                        style="width: 48px; height: 48px; object-fit: cover;">
                                </div>
                                <div class="ms-3">
                                    <h5 class="m-0 fs-16 fw-bold text-dark">{{ $coach->name }}</h5>
                                    <p class="text-muted mb-0 font-size-12">
                                        {{ $coach->coachProfile->designation ?? 'Verified Business Coach' }}</p>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"
                                            data-bs-toggle="modal" data-bs-target="#profileModal{{ $coach->id }}">
                                            <i class="mdi mdi-account-circle-outline me-2 fs-18 text-primary"></i> View
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"
                                            data-bs-toggle="modal" data-bs-target="#coachContentModal{{ $coach->id }}">
                                            <i class="mdi mdi-file-document-multiple-outline me-2 fs-18 text-primary"></i>
                                            View Content
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="chat-conversation" class="card-body bg-light-subtle p-4"
                        style="flex: 1 1 auto; overflow-y: auto;">
                        <div id="message-container">
                            @include('seeker.messaging._messages')
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top p-3">
                        <form action="{{ route('seeker.messaging.send', $coach->id) }}" method="POST" id="chat-form">
                            @csrf
                            <div class="row g-2">
                                <div class="col">
                                    <input type="text" name="message" id="chat-input"
                                        class="form-control form-control-lg border-0 bg-light fs-14"
                                        placeholder="Type your message here..." required autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" id="send-btn" class="btn btn-primary btn-lg px-4">
                                        <i class="mdi mdi-send"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                            <img src="{{ $coach->profile_image ?? asset('assets/images/users/user.avif') }}"
                                class="rounded-circle shadow-sm mb-3 border border-4 border-white"
                                style="width: 150px; height: 150px; object-fit: cover;">

                            <h4 class="fw-bold mb-1">{{ $coach->name }}</h4>
                            <p class="text-primary fw-medium mb-3">
                                {{ $coach->coachProfile->designation ?? 'Business Coach' }}</p>

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
                                <h6 class="font-size-12 text-uppercase fw-bold text-muted mb-3">Contact Information</h6>
                                @if ($coach->coachProfile && $coach->coachProfile->gender === 'female')
                                    <div class="alert alert-soft-secondary p-2 mb-0 border-0">
                                        <p class="small mb-0 text-muted">
                                            <i class="mdi mdi-lock-outline me-1"></i> Contact details are hidden for
                                            privacy.
                                        </p>
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <small class="text-muted d-block">Email Address</small>
                                        <span class="fw-medium">{{ $coach->email }}</span>
                                    </div>
                                    <div class="mb-0">
                                        <small class="text-muted d-block">Phone Number</small>
                                        <span class="fw-medium">{{ $coach->phone ?? 'Not Provided' }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-7 p-4">
                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                            <h6 class="text-primary text-uppercase fw-bold mb-2">About Me</h6>
                            <p class="text-dark mb-4">
                                {{ $coach->coachProfile->bio ?? 'No professional bio provided yet.' }}</p>

                            <div class="row mb-4 bg-soft-light p-3 rounded mx-0">
                                <div class="col-6">
                                    <h6 class="fw-bold mb-1 small text-muted text-uppercase">Experience</h6>
                                    <p class="text-dark fw-semibold mb-0">
                                        {{ $coach->coachProfile->experience_years ?? 0 }}+ Years</p>
                                </div>
                                <div class="col-6 border-start">
                                    <h6 class="fw-bold mb-1 small text-muted text-uppercase">Location</h6>
                                    <p class="text-dark fw-semibold mb-0">
                                        {{ collect([$coach->coachProfile->city, $coach->coachProfile->state])->filter()->implode(', ') ?: 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="fw-bold mb-0 small text-muted text-uppercase">Expertise</h6>
                                    <span class="badge bg-light text-dark border">{{ $expertiseCategories->count() }} Areas</span>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    @forelse ($expertiseCategories as $category)
                                        <span class="badge bg-soft-info text-info border border-info-subtle px-3 py-2">
                                            {{ $category->name }}
                                        </span>
                                    @empty
                                        <span class="text-muted small">General Business Coaching</span>
                                    @endforelse
                                </div>
                            </div>

                            <div class="rounded-3 border bg-light-subtle p-3">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div>
                                        <h6 class="fw-bold mb-1">Coach Content</h6>
                                        <p class="text-muted small mb-0">Browse blogs and published insights from this coach.</p>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#coachContentModal{{ $coach->id }}"
                                        data-bs-dismiss="modal">
                                        View Content
                                    </button>
                                </div>
                            </div>

                            <div class="text-end mt-5">
                                <button type="button" class="btn btn-secondary px-4"
                                    data-bs-dismiss="modal">Close</button>
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
                                class="form-control coach-content-search"
                                data-coach-content-target="#coachContentList{{ $coach->id }}"
                                placeholder="Search title or content...">
                        </div>
                        <div class="col-md-4">
                            <label for="contentCategory{{ $coach->id }}" class="form-label small text-muted text-uppercase fw-bold">Category</label>
                            <select id="contentCategory{{ $coach->id }}"
                                class="form-select coach-content-category"
                                data-coach-content-target="#coachContentList{{ $coach->id }}">
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
                            <div class="col-md-6 coach-content-item"
                                data-title="{{ \Illuminate\Support\Str::lower($content->title) }}"
                                data-body="{{ \Illuminate\Support\Str::lower(strip_tags($content->content)) }}"
                                data-category="{{ \Illuminate\Support\Str::lower($content->category->name ?? 'uncategorized') }}">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="flex-shrink-0">
                                                @if ($content->featured_image_url)
                                                    <img src="{{ $content->featured_image_url }}"
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

                    <div class="mt-5">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h6 class="fw-bold mb-1">Uploaded Media</h6>
                                <p class="text-muted small mb-0">Photos and videos uploaded by this coach.</p>
                            </div>
                            <span class="badge bg-light text-dark border">{{ $coachMedia->count() }} Items</span>
                        </div>

                        @if($coachMedia->isNotEmpty())
                            <div class="row g-3">
                                @foreach($coachMedia as $item)
                                    @php
                                        $mediaUrl = $item->url;
                                        $mediaType = $item->file_type ?? 'file';
                                    @endphp
                                    <div class="col-md-4 col-lg-3">
                                        @if($mediaType === 'image')
                                            <div style="overflow: hidden; border-radius: 8px; aspect-ratio: 1; background: #f5f5f5;">
                                                <img src="{{ $mediaUrl }}"
                                                    alt="{{ $item->title }}"
                                                    style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#mediaModal{{ $coach->id }}"
                                                    data-image-url="{{ $mediaUrl }}"
                                                    onclick="openCoachMediaModal(this, '{{ $coach->id }}')" />
                                            </div>
                                        @elseif($mediaType === 'video')
                                            <div style="overflow: hidden; border-radius: 8px; aspect-ratio: 1; background: #000;">
                                                <video style="width: 100%; height: 100%; object-fit: cover;" controls>
                                                    <source src="{{ $mediaUrl }}" type="{{ $item->mime_type }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @else
                                            <a href="{{ $mediaUrl }}" target="_blank"
                                                class="d-flex align-items-center justify-content-center border rounded bg-light text-decoration-none text-dark"
                                                style="aspect-ratio: 1;">
                                                <div class="text-center p-3">
                                                    <i class="mdi mdi-file-outline fs-28 d-block mb-2"></i>
                                                    <small>{{ $item->title }}</small>
                                                </div>
                                            </a>
                                        @endif
                                        <div class="mt-2 small text-muted text-truncate">
                                            {{ $item->category->name ?? 'Uncategorized' }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 text-muted border rounded-3 bg-light-subtle">
                                No uploaded media is available for this coach yet.
                            </div>
                        @endif
                    </div>

                    <div class="text-center py-4 text-muted d-none" id="coachContentEmpty{{ $coach->id }}">
                        No content matches the selected filters.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mediaModal{{ $coach->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img id="mediaModalImage{{ $coach->id }}" src="" alt="Gallery Image"
                        style="width: 100%; height: auto; border-radius: 8px;">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                const viewport = document.getElementById('chat-conversation');
                const fetchUrl = "{{ route('seeker.messaging.fetch', $coach->id) }}";

                function scrollToBottom() {
                    viewport.scrollTop = viewport.scrollHeight;
                }

                scrollToBottom();

                // Polling for new messages every 3 seconds
                function refreshChat() {
                    $.ajax({
                        url: fetchUrl,
                        type: 'GET',
                        success: function(html) {
                            const isAtBottom = viewport.scrollTop + viewport.clientHeight >= viewport
                                .scrollHeight - 50;
                            $('#message-container').html(html);
                            if (isAtBottom) scrollToBottom();
                        }
                    });
                }

                setInterval(refreshChat, 3000);

                // AJAX Send Message logic
                $('#chat-form').on('submit', function(e) {
                    e.preventDefault();
                    const form = $(this);
                    const input = $('#chat-input');
                    const btn = $('#send-btn');

                    if (input.val().trim() === '') return false;

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        beforeSend: function() {
                            btn.prop('disabled', true);
                        },
                        success: function() {
                            input.val('');
                            refreshChat();
                            btn.prop('disabled', false);
                            scrollToBottom();
                        },
                        error: function() {
                            btn.prop('disabled', false);
                            alert('Message could not be sent. Please try again.');
                        }
                    });
                });

                function filterCoachContent() {
                    const searchValue = $('#contentSearch{{ $coach->id }}').val().toLowerCase().trim();
                    const categoryValue = $('#contentCategory{{ $coach->id }}').val();
                    let visibleCount = 0;

                    $('#coachContentList{{ $coach->id }} .coach-content-item').each(function() {
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
                }

                $('#contentSearch{{ $coach->id }}, #contentCategory{{ $coach->id }}').on('input change', filterCoachContent);
            });

            function openCoachMediaModal(element, coachId) {
                const imageUrl = element.dataset.imageUrl;
                document.getElementById(`mediaModalImage${coachId}`).src = imageUrl;
            }
        </script>
    @endpush
</x-seeker-layout>
