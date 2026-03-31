<x-web-app-layout>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-box">
                        <a href="{{ route('webapp.home') }}">Home</a>
                        <span><i class="bi bi-chevron-right"></i></span>
                        <a href="#">Rank</a>
                    </div>
                </div>
            </div>
        </div>

        <section class="hero-contact">
            <div class="container">
                <div class="row">
                    <div class="col-12 contact-h">
                        <h1>Rank <img src="{{ asset('website/assets/img/arrow.png') }}" alt="" /></h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="sectionarc-sences">
            <div class="arc-scene" id="arcScene"></div>
        </section>

        <section class="section-hsu">
            <img src="{{ asset('website/assets/img/777772147239271.png') }}" alt="" class="section-isusimage" />

            <div class="container">
                <h1 class="main-heading">
                    Leading Business Coaches In India For
                    <span class="highlight">2026</span><br />
                    Inspiring Entrepreneurs To Reach New
                    <span class="highlight-purple">Heights Of Success</span>
                </h1>
                <p class="main-desc">
                    We provide an all-in-one platform designed to provide you with
                    everything you need – the tools, training, and tribe – to build and
                    sustain a successful coaching practice.
                </p>

                <div class="row g-4">
                    <div class="col-12 col-md-4">
                        <div class="sidebar">
                            <h5>Filter</h5>
                            <form action="{{ route('webapp.rank') }}" method="GET" id="filterForm">
                                <div class="sidebar-wrraper">
                                    <img src="{{ asset('website/assets/img/67334h1171275312.png') }}" alt="" class="sidebar-img" />

                                <div class="wrrperfilter1">
                                    <div class="filter-group-title">Select City</div>
                                    <div class="filter-cols" id="cityFilter">
                                        @if(isset($filterCities) && $filterCities->count() > 0)
                                            @foreach($filterCities as $city)
                                                <label>
                                                    <input type="checkbox" name="city[]" value="{{ strtolower($city) }}"
                                                        {{ in_array(strtolower($city), (array)request('city')) ? 'checked' : '' }}
                                                        onchange="this.form.submit()" /> {{ ucwords($city) }}
                                                </label>
                                            @endforeach
                                        @else
                                            <small class="text-muted">No cities available</small>
                                        @endif
                                    </div>
                                </div>

                                    <div class="wrrperfilter1">
                                        <div class="filter-group-title">Select Year</div>
                                        <div class="filter-cols" id="yearFilter">
                                            <label><input type="checkbox" value="2026" checked disabled /> 2026</label>
                                            <label><input type="checkbox" value="2025" disabled /> 2025</label>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <a href="{{ route('webapp.rank') }}" class="btn btn-sm w-100 mt-2" style="
                                background: #5b21b6;
                                color: #fff;
                                border-radius: 8px;
                                font-size: 0.8rem;
                                text-decoration: none;
                                display: block;
                                text-align: center;
                                padding: 8px;
                                z-index:1;
                                position:relative;
                            ">
                                Reset Filters
                            </a>
                        </div>
                    </div>
<div class="col-12 col-md-8">
    <div class="row g-3" id="cardsGrid">
        @forelse($topCoaches as $coach)
            @php
                $rankPosition = $topCoaches->firstItem() ? $topCoaches->firstItem() + $loop->index : $loop->iteration;
            @endphp
            <div class="col-12 col-md-6">
                <div class="coach-card">
                    {{-- Added overflow-hidden and a background color to the wrap --}}
                    <div class="coach-card-img-wrap" style="overflow: hidden; background-color: #5b21b6; height: 300px; position: relative;">
                        <a href="{{ route('view-profile', $coach->id) }}" style="display: block; width: 100%; height: 100%;">
                            {{-- Added object-fit: cover and absolute positioning to fill every corner --}}
                            <img class="coach-card-img"
                                src="{{ $coach->user->profile_image ? asset($coach->user->profile_image) : asset('website/assets/img/Rectangle5339.png') }}"
                                alt="{{ $coach->user->name }}"
                                loading="lazy"
                                style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;" />
                        </a>
                    </div>
                    <div class="coach-card-body">
                        <div class="coach-name">
                            <a href="{{ route('view-profile', $coach->id) }}" style="text-decoration: none; color: inherit;">
                                {{ str_pad($rankPosition, 2, '0', STR_PAD_LEFT) }} {{ $coach->user->name }}
                            </a>
                        </div>
                        <div class="text-muted small mb-2">
                            {{ $coach->connection_requests_count ?? 0 }} connection requests
                        </div>
                        <p class="coach-desc">
                            {{ Str::limit($coach->bio, 140) }}
                        </p>
                        <div class="coach-footer">
                            <a href="{{ route('view-profile', $coach->id) }}" class="vote-btn" style="text-decoration: none;">
                                View Profile
                                <img src="{{ asset('website/assets/img/svgicon1.svg') }}" alt="" />
                            </a>
                            @if($coach->website_url)
                                <a href="{{ $coach->website_url }}" target="_blank" class="globe-btn" title="Website">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="no-results" id="noResults">
                    No coaches found matching your criteria.
                </div>
            </div>
        @endforelse
    </div>

    <div class="pagination-wrap mt-4" id="paginationWrap">
        {{ $topCoaches->appends(request()->query())->links() }}
    </div>
</div>
                </div>
            </div>
        </section>

        <section class="section-bloggrid">
            <div class="blog-grid">
                @if($blogs && $blogs->count() > 0)
                    @php $featured = $blogs->first(); @endphp
                    <div class="blog-card card-featured">
                        <img class="card-img"
                             src="{{ $featured->featured_image ? asset('storage/' . $featured->featured_image) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=700&q=80' }}"
                             alt="{{ $featured->title }}" />

                        <div class="card-content">
                            <div class="card-meta">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" /></svg>
                                    {{ $featured->created_at ? $featured->created_at->format('F d, Y') : 'Oct 19, 2022' }}
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /></svg>
                                    By {{ $featured->user->name ?? 'Admin' }}
                                </span>
                            </div>
                            <div class="card-title">{{ $featured->title }}</div>
                            <p class="card-desc">{{ Str::limit(strip_tags($featured->content), 150) }}</p>
                            <a href="{{ route('blog-detail', $featured->slug) }}" class="read-btn">Read More
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12" /><polyline points="12 5 19 12 12 19" /></svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-right">
                        @foreach($blogs->slice(1, 2) as $post)
                            <div class="blog-card card-small">
                                <img class="card-img"
                                     src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80' }}"
                                     alt="{{ $post->title }}" />
                                <div class="card-content">
                                    <div class="card-meta">
                                        <span>{{ $post->created_at ? $post->created_at->format('M d, Y') : 'Oct 19, 2022' }}</span>
                                    </div>
                                    <div class="card-title">{{ Str::limit($post->title, 50) }}</div>
                                    <p class="card-desc">{{ Str::limit(strip_tags($post->content), 80) }}</p>
                                    <a href="{{ route('blog-detail', $post->slug) }}" class="read-btn">Read More
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12" /><polyline points="12 5 19 12 12 19" /></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row-bottom">
                        @foreach($blogs->slice(3, 4) as $post)
                            <div class="blog-card card-small">
                                <img class="card-img"
                                     src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&q=80' }}"
                                     alt="{{ $post->title }}" />
                                <div class="card-content">
                                    <div class="card-meta">
                                        <span>{{ $post->created_at ? $post->created_at->format('M d, Y') : 'Oct 19, 2022' }}</span>
                                    </div>
                                    <div class="card-title">{{ Str::limit($post->title, 40) }}</div>
                                    <a href="{{ route('blog-detail', $post->slug) }}" class="read-btn">Read More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center w-100 py-5">No blog posts available.</p>
                @endif
            </div>
        </section>

        <div class="section-wrap">
            <div class="container">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <div class="top-label">Explore Our Premier Coaching Services</div>
                        <h2 class="big-heading">Why<br />Chose<br />Us</h2>
                    </div>
                </div>
            </div>
        </div>

        <section class="section-cta">
            <div class="container">
                <div class="cta-banner">
                    <div class="container-fluid p-0">
                        <div class="row align-items-center g-0">
                            <div class="col-12 col-md-7">
                                <h2 class="cta-heading">Are you ready to start ?</h2>
                                <p class="cta-sub">Custom Software Development Tailored Solutions for Your Business.</p>
                                <div class="row g-2 align-items-center">
                                    <div class="col-12 col-sm-8 col-lg-7">
                                        <input type="email" class="cta-input w-100" placeholder="Enter Email" />
                                    </div>
                                    <div class="col-auto">
                                        <button class="cta-btn">Contact us</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <img src="{{ asset('website/assets/img/grilready.png') }}" alt="" class="readybg1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@push('scripts')
<script>
    @php
        $arcCards = $topCoaches->take(7)->map(function($coach, $index) {
            return [
                'cls' => 'c' . $index,
                'img' => $coach->user->profile_image ? asset($coach->user->profile_image) : "https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&q=80",
                'alt' => $coach->user->name,
                'info' => [
                    'name' => $coach->user->name,
                    'role' => $coach->designation ?? 'Business Coach',
                    'btn' => 'View Profile',
                    'url' => route('view-profile', $coach->id)
                ]
            ];
        });
    @endphp

    const cards = @json($arcCards);

    const scene = document.getElementById("arcScene");
    const isMobile = window.innerWidth <= 768;
    const displayCards = isMobile ? cards.slice(2, 5) : cards;

    const W = isMobile ? window.innerWidth : 760;
    const H = isMobile ? 320 : 500;
    const cw = 16;
    const ch = isMobile ? 160 : 210;
    const R = isMobile ? 380 : 600;
    const cx = W / 2;
    const cy = isMobile ? H + 80 : H + 180;

    const startAngle = isMobile ? 235 : 225;
    const endAngle = isMobile ? 305 : 315;
    const n = displayCards.length;

    scene.style.height = H + "px";

    displayCards.forEach((card, i) => {
        const angleDeg = startAngle + ((endAngle - startAngle) * i) / (n - 1);
        const angleRad = (angleDeg * Math.PI) / 180;

        const px = cx + R * Math.cos(angleRad);
        const py = cy + R * Math.sin(angleRad);
        const left = isMobile ? px - cw / 1 - 60 : px - cw / 1;
        const top = py - ch / 2;
        const tilt = angleDeg - 270;

        const distFromCenter = Math.abs(i - (n - 1) / 2);
        const zIndex = Math.round(10 - distFromCenter * 2);

        const el = document.createElement("div");
        el.className = `arc-card ${card.cls}`;
        el.style.cssText = `
            left: ${left}px;
            top: ${top}px;
            z-index: ${zIndex};
            transform: rotate(${tilt}deg);
        `;

        el.innerHTML = `<a href="${card.info.url}"><img src="${card.img}" alt="${card.alt}" loading="lazy"/></a>`;

        const info = document.createElement("div");
        info.className = "card-info";
        info.innerHTML = `
            <div class="name">${card.info.name}</div>
            <div class="role">${card.info.role}</div>
            <a href="${card.info.url}" class="vbtn">${card.info.btn}</a>
        `;
        el.appendChild(info);

        const liftX = Math.cos(angleRad) * -18;
        const liftY = Math.sin(angleRad) * -18;

        el.addEventListener("mouseenter", () => {
            el.style.transform = `rotate(${tilt}deg) translate(${liftX}px, ${liftY}px)`;
        });
        el.addEventListener("mouseleave", () => {
            el.style.transform = `rotate(${tilt}deg)`;
        });

        scene.appendChild(el);
    });

    function resetFilter() {
        window.location.href = "{{ route('webapp.rank') }}";
    }
</script>
@endpush
</x-web-app-layout>
