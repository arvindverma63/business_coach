<x-web-app-layout>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-box">
                        <a href="{{ route('webapp.home') }}">Home</a>
                        <span><i class="bi bi-chevron-right"></i></span>
                        <a href="#">Find a Coach</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="hero-contact hero-serach-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 contact-h">
                        <h1>Find a Coach <img src="{{ asset('website/assets/img/arrow.png') }}" alt="" /></h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="div-fincoach-c">
                            <h2>
                                Find the Right Business Coach in India for Your Next
                                <span>Level of Growth</span>
                            </h2>
                            <p>
                                Discover India’s most trusted business coaches specializing in
                                leadership, family business, corporate growth, CEO excellence,
                                and peak performance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-hsu section-hsu-seracg">
            <!-- <img src="{{ asset('website/assets/img/777772147239271.png') }}" alt="" class="section-isusimage" /> -->

            <div class="container">
                <div class="row g-4">
                    <div class="col-12 col-md-4">
                 <div class="sidebar sidebar--serchcoach">
                            <h5>Filter</h5>
                            <form action="{{ route('webapp.searchCoaches') }}" method="GET" id="filterForm">
                                {{-- Preserve the Name search if it exists --}}
                                @if(request('name'))
                                    <input type="hidden" name="name" value="{{ request('name') }}">
                                @endif

                                <div class="sidebar-wrraper">
                                    <!-- <img src="{{ asset('website/assets/img/67334h1171275312.png') }}" alt="" class="sidebar-img" /> -->

                                    <div class="wrrperfilter1">
                                        <div class="filter-group-title">Select City</div>
                                        <div class="filter-cols" id="cityFilter">
                                            {{-- "All Cities" option --}}
                                            <label>
                                                <input type="radio" name="city" value=""
                                                    {{ !request('city') ? 'checked' : '' }}
                                                    onchange="this.form.submit()" /> All Cities
                                            </label>

                                            @foreach($cities as $city)
                                                <label>
                                                    <input type="radio" name="city" value="{{ $city }}"
                                                        {{ request('city') == $city ? 'checked' : '' }}
                                                        onchange="this.form.submit()" /> {{ ucwords($city) }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="wrrperfilter1">
                                        <div class="filter-group-title">Category</div>
                                        <div class="filter-cols" id="filtercategory">
                                            {{-- "All Categories" option --}}
                                            <label>
                                                <input type="radio" name="category" value=""
                                                    {{ !request('category') ? 'checked' : '' }}
                                                    onchange="this.form.submit()" /> All Categories
                                            </label>

                                            @foreach($categories as $cat)
                                                <label>
                                                    <input type="radio" name="category" value="{{ $cat->slug }}"
                                                        {{ request('category') == $cat->slug ? 'checked' : '' }}
                                                        onchange="this.form.submit()" />
                                                    {{ $cat->name }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <a href="{{ route('webapp.searchCoaches') }}" class="btn btn-sm w-100 mt-3"
                            style="background: #5b21b6; color: #fff; border-radius: 8px; text-decoration: none; text-align: center; display: block; padding: 8px;">
                                Clear All Filters
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="row g-3" id="cardsGrid">
                            @forelse($results as $coach)
                                <div class="col-12 col-md-6">
                                    <div class="coach-card">
                                        <div class="coach-card-img-wrap" style="overflow: hidden; background-color: #5b21b6; height: 300px; position: relative;">
                                            <a href="{{ route('view-profile', $coach->id) }}" style="display: block; width: 100%; height: 100%;">
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
                                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} {{ $coach->user->name }}
                                                </a>
                                            </div>
                                            <p class="coach-desc">
                                                {{ Str::limit(strip_tags($coach->bio), 140) }}
                                            </p>
                                            <div class="coach-footer">
                                                <a href="{{ route('view-profile', $coach->id) }}" class="vote-btn" style="text-decoration: none;">
                                                    View Profile
                                                    <img src="{{ asset('website/assets/img/svgicon1.svg') }}" alt="" />
                                                </a>
                                                @if($coach->website_url)
                                                    <a href="{{ $coach->website_url }}" target="_blank" class="globe-btn" title="Website">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                            {{ $results->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Existing static sections follow --}}
        <section class="section-aboutcoach">
            {{-- Content remains same --}}
        </section>

        {{-- Testimonials, CTA, etc. --}}
    </main>
</x-web-app-layout>
