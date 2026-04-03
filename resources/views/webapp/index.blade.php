<x-web-app-layout>

    <div class="hero-main">
        <div class="wrraper-baner-c">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <h1 class="hero-title">
                            Unlock Clarity, Direction, and Growth With Expert Business Coaching
                        </h1>

                        <form action="{{ route('webapp.searchCoaches') }}" method="GET">
                            <div class="search-box">
                                {{-- Search by Name --}}
                                <input type="text" name="name" placeholder="Search name...." minlength="3"
                                    value="{{ request('name') }}" />

                                {{-- Dynamic Categories --}}
                                <select name="category">
                                    <option value="" selected>Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                {{-- Dynamic Locations (Cities) --}}
                                <select name="city">
                                    <option value="" selected>Location</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city }}">{{ ucwords($city) }}</option>
                                    @endforeach
                                </select>

                                <button type="submit" class="search-btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="owl-carousel owl-carousel-hero owl-theme">
            @forelse($heroBanners as $banner)
            <div class="item">
                <section class="hero-section">
                    <div class="container">
                       @if($banner->image_url)
                                <img src="{{ $banner->image_url }}" class="hero-img" alt="Expert Business Coaching" />
                                @else
                                <img src="{{ asset('website/assets/img/women-hero.webp') }}" class="hero-img"
                                    alt="Expert Business Coaching" />
                                @endif
                        <div class="row align-items-center">

                            <!-- <div class="col-lg-7">

                            </div>
                            <div class="col-lg-5 text-center">
                                @if($banner->image_url)
                                <img src="{{ $banner->image_url }}" class="hero-img" alt="Expert Business Coaching" />
                                @else
                                <img src="{{ asset('website/assets/img/women-hero.webp') }}" class="hero-img"
                                    alt="Expert Business Coaching" />
                                @endif
                            </div> -->
                        </div>
                    </div>
                </section>
            </div>
            @empty
            {{-- Fallback if no banners exist --}}
            <div class="item">
                <section class="hero-section">
                    <div class="container">
                        <img src="{{ asset('website/assets/img/hero-bg1.webp') }}" alt="" class="hero-bg1" />
                        <img src="{{ asset('website/assets/img/hero-bg2.webp') }}" alt="" class="hero-bg2" />
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <h1 class="hero-title">
                                    Unlock Clarity, Direction, and Growth With Expert Business Coaching
                                </h1>

                                <form action="{{ route('webapp.searchCoaches') }}" method="GET">
                                    <div class="search-box">
                                        {{-- Search by Name --}}
                                        <input type="text" name="name" placeholder="Search name...." minlength="3"
                                            value="{{ request('name') }}" />

                                        {{-- Dynamic Categories --}}
                                        <select name="category">
                                            <option value="" selected>Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        {{-- Dynamic Locations (Cities) --}}
                                        <select name="city">
                                            <option value="" selected>Location</option>
                                            @foreach ($cities as $city)
                                            <option value="{{ $city }}">{{ ucwords($city) }}</option>
                                            @endforeach
                                        </select>

                                        <button type="submit" class="search-btn">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-5 text-center">
                                <img src="{{ asset('website/assets/img/women-hero.webp') }}" class="hero-img"
                                    alt="Expert Business Coaching" />
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @endforelse
        </div>
    </div>

    <section class="coaching-s">
        <div class="container">
            <div class="row">
                <div class="col-12 coachingsection-h">
                    <h2>The World Is Changing - <span>Coaching Must Too</span></h2>
                    <p>
                        The complexity of business owners’ has changed.
                    </p>
                    <p>Today’s business owners and decision-makers are not looking for motivation or generic advice.
                        They seek clarity under pressure, perspective during uncertainty, and judgment when the
                        cost of error is high.</p>
                    <p>In this environment, coaching has evolved from a support function into a strategic necessity.</p>
                    <p>This platform exists to reflect that evolution—by making business coaching credible,
                        structured, and outcome-driven, rather than personality-led or promotional.</p>
                    <img src="{{ asset('website/assets/img/coachingsection.webp') }}" alt="" class="coachingsection" />
                </div>
            </div>
        </div>
    </section>


    <section class="coaching-section">
        <img src="{{ asset('website/assets/img/section-coachingbg1.webp') }}" alt="" class="section-coachingbg1" />
        <img src="{{ asset('website/assets/img/section-coachingbg2.webp') }}" alt="" class="section-coachingbg2" />
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10">
                    <h2>
                        Best Busniess Coach Is Where Coaches Come <br />
                        To Find Their People – <span>And Their Power.</span>
                    </h2>

                    <p>
                        We provide an all-in-one platform designed to provide you with
                        everything you need – the tools, training, and tribe – to build
                        and sustain a successful coaching practice.
                    </p>

                    <a href="#" class="community-btn"> Join Our Global Community → </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-hshsh">
        <section class="explore-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 explore-section-h">
                        <h2>explore coaches in India <span class="span1">20</span><span class="span2">26</span></h2>
                    </div>
                    <div class="col-12">
                        <div class="owl-carousel owl-theme owl-carousel-explore">
                            @forelse($featuredCoaches as $coach)
                            <div class="item">
                                <a href="{{ route('view-profile', $coach->id) }}"
                                    class="card-explore-link text-decoration-none text-reset d-block">
                                    <div class="card-explore">
                                        <img src="{{ asset('website/assets/img/explorecard-bg.png') }}" alt=""
                                            class="explorecard-bg" />
                                        <img src="{{ $coach->user?->profile_image ?? asset('website/assets/img/person-explore.webp') }}"
                                            alt="{{ $coach->user->name }}" class="person-explore" />
                                        <div class="card-explore-c">
                                            <div class="card-expore-desc">
                                                <h4>{{ $coach->user->name }}</h4>
                                                <p>{{ $coach->bio ? Str::limit($coach->bio, 150) : 'Experienced business coach dedicated to helping you succeed.' }}
                                                </p>
                                            </div>
                                            <div class="card-explore-content">
                                                <span class="card-explore-c-span">Coach</span>
                                                <h4>{{ $coach->user->name }}</h4>
                                                <p>{{ $coach->designation ?? 'Business Coach' }}</p>
                                                <span class="linkedin-a" aria-hidden="true"><i
                                                        class="bi bi-arrow-right-short"></i></span>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            @empty
                            <div class="item">
                                <div class="card-explore text-center p-4">
                                    <p>No featured coaches available at the moment.</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-community">
            <div class="container">
                <div class="row">
                    <div class="col community-heading">
                        <h2>Community</h2>
                        <p>Engage with a dynamic network that fuels your development, and reminds you that you’re never
                            doing this work alone.</p>
                        <a href="">Learn More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 BestBusinessCoachindia">
                        <img src="{{ asset('website/assets/img/BestBusinessCoachindia.gif') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <img src="{{ asset('website/assets/img/Frame2147239271777.png') }}" alt="" class="frame636">
    </section>
    <section class="testimonial-section" style="background-image:url({{ asset('website/assets/img/wehavebg.png') }})">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset('website/assets/img/testimonail-per.webp') }}" alt="" class="testimonailimg" />
                </div>
                <div class="col-md-7">
                    <div class="t">
                        <div class="owl-carousel owl-theme owl-carousel-testimonial">
                            <div class="item">
                                <div class="testimonail-card">
                                    <p>
                                        We have been operating for over an providin top-notch
                                        services to our clients and build strong track record in
                                        the industry.We have been operating for over a decad
                                        providi ina top-notch We have been operating
                                    </p>
                                    <div class="person-t">
                                        <img src="{{ asset('website/assets/img/test-pr.webp') }}" alt="" />
                                        <div class="person-c">
                                            <h5>Albert Flores</h5>
                                            <p>Web Designer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonail-card">
                                    <p>
                                        We have been operating for over an providin top-notch
                                        services to our clients and build strong track record in
                                        the industry.We have been operating for over a decad
                                        providi ina top-notch We have been operating
                                    </p>
                                    <div class="person-t">
                                        <img src="{{ asset('website/assets/img/test-pr.webp') }}" alt="" />
                                        <div class="person-c">
                                            <h5>Albert Flores</h5>
                                            <p>Web Designer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonail-card">
                                    <p>
                                        We have been operating for over an providin top-notch
                                        services to our clients and build strong track record in
                                        the industry.We have been operating for over a decad
                                        providi ina top-notch We have been operating
                                    </p>
                                    <div class="person-t">
                                        <img src="{{ asset('website/assets/img/test-pr.webp') }}" alt="" />
                                        <div class="person-c">
                                            <h5>Albert Flores</h5>
                                            <p>Web Designer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h2>Trending <span>Blogs.</span></h2>
                    <a href="{{ route('webapp.blogs') }}" class="btn btn-primary text-white">View All</a>
                </div>
            </div>
            <div class="row">
                @forelse($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="blog-card">
                        {{-- Handle dynamic image with fallback --}}
                        <img src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('website/assets/img/blog-imag.png') }}"
                            alt="{{ $blog->title }}" style="width: 100%; height: 250px; object-fit: cover;" />

                        <div class="blog-content">
                            <h3>{{ $blog->title }}</h3>
                            <p>
                                {{ Str::limit(strip_tags($blog->content), 120) }}
                            </p>
                        </div>

                        {{-- Dynamic Link --}}
                        <a href="{{ route('blog-detail', $blog->slug) }}" class="button-blog">
                            <i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center">No blogs available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @push('scripts')
    <style>
    .hero-sort-order {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.85);
        color: #1f2937;
        letter-spacing: 0.08em;
        font-size: 12px;
    }

    .card-explore-link {
        display: block;
        cursor: pointer;
    }

    .card-expore-desc {
        display: none;
    }

    .card-expore-desc p {
        font-size: 16px !important;
        width: 100%;
    }

    .card-explore:hover .person-explore {
        display: none;
    }

    .card-explore:hover .card-explore-c .card-explore-content {
        display: none;
    }

    .card-explore:hover .card-explore-c .card-expore-desc {
        display: block;
    }
    </style>
    <script>
    $(".owl-carousel.owl-carousel-explore").owlCarousel({
        loop: true,
        center: true,
        margin: 10,
        nav: false,

        autoplay: false,
        autoplayTimeout: 3000, // 3 second
        autoplayHoverPause: true,

        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            1000: {
                stagePadding: 400,
                items: 1,
            },
        },
    });

    $(".owl-carousel.owl-carousel-testimonial").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: [
            "<i class='bi bi-arrow-left-short'></i>",
            "<i class='bi bi-arrow-right-short'></i>",
        ],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });

    $(".owl-carousel.owl-carousel-hero").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true, // autoplay ON
        autoplayTimeout: 1000, // 3 sec delay
        autoplayHoverPause: true, // hover pe pause
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });
    </script>
    <script>
    // Image upload preview
    document
        .getElementById("avatarInput")
        .addEventListener("change", function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById("avatarImg").src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    </script>
    <script>
    /* image preview */

    document
        .getElementById("profileInput")
        .addEventListener("change", function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById("profilePreview").src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
    @endpush

    @push('scripts')
    <script>
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.get('register') === 'seeker') {
            var seekerModal = new bootstrap.Modal(document.getElementById('profileModal1'));
            seekerModal.show();
        } else if (urlParams.get('register') === 'coach') {
            var coachModal = new bootstrap.Modal(document.getElementById('profileModal'));
            coachModal.show();
        }

        if (urlParams.get('register') === 'seeker' || urlParams.get('register') === 'coach') {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
    </script>
    @endpush

</x-web-app-layout>