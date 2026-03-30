<x-web-app-layout>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-box">
                        <a href="#">Home</a>
                        <span><i class="bi bi-chevron-right"></i></span>
                        <a href="#">Find a Coach</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="hero-contact">
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
        <section class="find-caoch-section">
            <div class="container">
                <form action="{{ route('webapp.searchCoaches') }}" method="GET">
                <div class="row">
                    <div class="col">
                        <section class="hero">

                            <div class="hero-bg" id="heroBg">
                                <img src="{{ asset('website/assets/img/findcoachbanner.webp') }}" alt="" />
                            </div>
                            <!-- <div class="hero-overlay"></div> -->
                            <!-- <div class="blob-left"></div> -->
                            <!-- <div class="blob-right"></div> -->

                            <div class="search-bar-wrap">

                                    <div class="search-bar">
                                        <div class="name-field">
                                            <input type="text" name="name" placeholder="Name"
                                                value="{{ request('name') }}" />
                                            <button type="submit" class="search-icon"
                                                style="background: none; border: none; padding: 0;">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.7)"
                                                    stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="11" cy="11" r="8" />
                                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="divider"></div>

                                        <div class="select-wrap">
                                            <select name="category">
                                                <option value="" disabled selected>Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="divider"></div>

                                        <div class="select-wrap">
                                            <select name="city">
                                                <option value="" disabled selected>Area</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city }}">{{ ucwords($city) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                            </div>

                        </section>
                    </div>
                </div>
               <div class="row mt-4">
                                        <button type="submit" class="findcoach-btn border-0">Find a Business
                                            Coach</button>
                                    </div>
</form>
            </div>
        </section>

        <section class="section-aboutcoach">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="about-section">
                            <p class="about-text">
                                Behind every successful entrepreneur, CEO, and business family
                                is a coach who provides clarity, strategy, and perspective.
                                Our platform helps you discover and connect with India's most
                                respected and proven business coaches — professionals who have
                                helped founders scale companies, leaders build world-class
                                organizations, and business families sustain
                                multi-generational success. Whether you are a business owner,
                                corporate leader, next-generation family business member, or
                                senior executive, the right business coach can unlock new
                                levels of performance, decision-making, and growth. This
                                platform is exclusively focused on India and features only
                                verified business coaches who understand the Indian business
                                landscape, culture, and growth challenges.
                            </p>

                            <div class="btn-wrap">
                                {{-- <a href="serach-coach.html" class="explore-btn">
                                    Explore Coaching Specializations
                                    <span class="arrow">→</span>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-pricing">
            <img src="{{ asset('website/assets/img/sound-audio-wave-isolated-white-background-1.png') }}" alt=""
                class="section-pricing-bg" />
            <div class="container">
                <div class="row">
                    <div class="col section-pricing-h">
                        <h2>How It Works</h2>
                        <p>Finding the Right Business Coach in India is Simple</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="pricing-cardmain pricing-cardmain0">
                            <div class="pricing-sn">
                                <div class="pricing-sn-inner">
                                    <h5>Step</h5>
                                    <p>01</p>
                                </div>
                            </div>
                            <div class="pricing-card">
                                <h4>Explore Coaching Specializations</h4>
                                <p>Browse business coaches across key domains including:</p>
                                <div class="pricing-cardt">
                                    <ol>
                                        <li>Leadership Coaching</li>
                                        <li>Family Business Coaching</li>
                                        <li>CEO & Founder Coaching</li>
                                        <li>Corporate & Executive Coaching</li>
                                        <li>Peak Performance Coaching</li>
                                        <li>Entrepreneur & Business Growth Coaching</li>
                                    </ol>
                                </div>
                                <p>
                                    Each coach specializes in helping leaders and organizations
                                    achieve measurable business outcomes.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pricing-cardmain pricing-cardmain1">
                            <div class="pricing-card">
                                <h4>Review Verified Coach Profiles</h4>
                                <p>Explore detailed profiles including:</p>
                                <div class="pricing-cardt">
                                    <ol>
                                        <li>Coaching expertise and specialization  </li>
                                        <li>Experience working with founders, CEOs, and organizations  </li>
                                        <li>Industry exposure and leadership background   </li>
                                        <li>Coaching philosophy and approach</li>

                                    </ol>
                                </div>
                                <p>
                                  Every coach listed is carefully vetted for credibility, experience, and professional integrity.
                                </p>
                            </div>
                            <div class="pricing-sn">
                                <div class="pricing-sn-inner">
                                    <h5>Step</h5>
                                    <p>02</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pricing-cardmain pricing-cardmain2">
                            <div class="pricing-sn">
                                <div class="pricing-sn-inner">
                                    <h5>Step</h5>
                                    <p>03</p>
                                </div>
                            </div>
                            <div class="pricing-card">
                                <h4>Connect and Begin Your Growth Journey</h4>
                                <p>Connect directly with your selected coach to:</p>
                                <div class="pricing-cardt">
                                    <ol>
                                        <li>Request an introductory conversation  </li>
                                        <li>Discuss your business goals and challenges  </li>
                                        <li> Begin your personalized business coaching journey</li>

                                    </ol>
                                </div>
                                <p>
                                    The right business coach brings clarity, accelerates growth, and strengthens leadership.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-choose">
            <div class="container">
                <!-- Heading row -->
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-title">Why Choose Our Platform</h2>
                        <p class="section-sub">
                            India's Trusted Platform for Finding Business Coaches
                        </p>
                    </div>
                </div>

                <!-- Main content row -->
                <div class="row align-items-stretch">
                    <!-- LEFT — image column -->
                    <div class="col-12 col-lg-5 img-col">
                        <!-- purple arch background -->
                        <!-- Person photo (using placeholder silhouette) -->
                        <img src="{{ asset('website/assets/img/choose-image.webp') }}" alt="Business Coach"
                            class="person-img" />
                    </div>

                    <!-- RIGHT — content column -->
                    <div class="col-12 col-lg-7 content-col d-flex flex-column justify-content-center">
                        <p class="content-para">
                            We are dedicated exclusively to business coaching in India.
                        </p>
                        <p class="content-para">
                            Our platform connects business owners, CEOs, corporate leaders,
                            and business families with coaches who have real-world
                            experience and a proven track record in leadership and business
                            growth.
                        </p>
                        <p class="content-para">
                            We do not list general life coaches or unrelated coaching
                            categories. Our focus is clear — business leadership, business
                            growth, and organizational excellence.
                        </p>
                        <p class="content-para">
                            Every coach featured here brings deep understanding of Indian
                            businesses, market realities, and leadership challenges.
                        </p>

                        <div class="trust-heading">Trust Indicators</div>

                        <ul class="trust-list">
                            <li>
                                <div class="trust-bullet">
                                    <svg viewBox="0 0 10 10" fill="none">
                                        <circle cx="5" cy="5" r="4" fill="white" />
                                    </svg>
                                </div>
                                Verified Business Coaches Only
                            </li>
                            <li>
                                <div class="trust-bullet">
                                    <svg viewBox="0 0 10 10" fill="none">
                                        <circle cx="5" cy="5" r="4" fill="white" />
                                    </svg>
                                </div>
                                Expertise in Leadership, Corporate, and Family Business
                            </li>
                            <li>
                                <div class="trust-bullet">
                                    <svg viewBox="0 0 10 10" fill="none">
                                        <circle cx="5" cy="5" r="4" fill="white" />
                                    </svg>
                                </div>
                                Trusted by Founders, CEOs, and Business Leaders
                            </li>
                            <li>
                                <div class="trust-bullet">
                                    <svg viewBox="0 0 10 10" fill="none">
                                        <circle cx="5" cy="5" r="4" fill="white" />
                                    </svg>
                                </div>
                                India-Focused Coaching Expertise
                            </li>
                            <li>
                                <div class="trust-bullet">
                                    <svg viewBox="0 0 10 10" fill="none">
                                        <circle cx="5" cy="5" r="4" fill="white" />
                                    </svg>
                                </div>
                                Strict Privacy and Confidentiality Standards
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </section>

        <section class="section-testimonial">
            <div class="container">
                <!-- Heading + intro row -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="section-title">Testimonials</h2>
                        <p class="section-sub">
                            Business Leaders Who Found the Right Coach
                        </p>

                        <div class="intro-text">
                            <p>
                                Business owners and leaders across India have accelerated
                                their growth with the right coaching support.
                            </p>
                            <p>
                                "Working with a business coach helped me scale my company
                                faster and build a stronger leadership team."
                            </p>
                            <p>
                                "Our family business gained clarity on succession, structure,
                                and long-term growth."
                            </p>
                            <p>
                                "The coaching helped me become a more confident and effective
                                CEO."
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Cards row -->
                <div class="row g-4 mt-2">
                    <!-- Card 1 -->
                    <div class="col-12 col-md-4">
                        <div class="testi-card">
                            <div class="stars">
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star empty" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <p class="testi-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore magna aliqua
                                quis nostrud exercitation ullamco.Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit, sed do
                            </p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">MW</div>
                                <div>
                                    <div class="reviewer-name">Maxin Will</div>
                                    <div class="reviewer-role">Product Manager</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-12 col-md-4">
                        <div class="testi-card">
                            <div class="stars">
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star empty" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <p class="testi-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore magna aliqua
                                quis nostrud exercitation ullamco.Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit, sed do
                            </p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">MW</div>
                                <div>
                                    <div class="reviewer-name">Maxin Will</div>
                                    <div class="reviewer-role">Product Manager</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-12 col-md-4">
                        <div class="testi-card">
                            <div class="stars">
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star filled" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="star empty" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <p class="testi-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore magna aliqua
                                quis nostrud exercitation ullamco.Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit, sed do
                            </p>
                            <div class="reviewer">
                                <div class="reviewer-avatar">MW</div>
                                <div>
                                    <div class="reviewer-name">Maxin Will</div>
                                    <div class="reviewer-role">Product Manager</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /cards row -->

                <!-- CTA row -->
                <div class="row">
                    <div class="col-12 cta-wrap">
                        <a href="#" class="cta-btn"> Find Your Business Coach &nbsp;→ </a>
                    </div>
                </div>
            </div>
            <!-- /container -->
        </section>
        <section class="section-right">
            <div class="container">
                <!-- Heading row -->
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-title">
                            Importance Of Choosing The Best Business<br />Coach In India
                        </h2>
                        <p class="section-sub">
                            Why the Right Business Coach Can Define Your Next Phase of
                            Growth
                        </p>
                    </div>
                </div>

                <!-- Main row -->
                <div class="row align-items-center">
                    <!-- LEFT — image col -->
                    <div class="col-12 col-md-5 img-col">
                        <!-- Person image -->
                        <img src="{{ asset('website/assets/img/rightsection.webp') }}" alt="Business Coach"
                            class="person-img" />
                    </div>

                    <!-- RIGHT — text col -->
                    <div class="col-12 col-md-7 content-col">
                        <p class="content-para">
                            The right business coach can significantly influence your
                            leadership effectiveness, business growth, and long-term
                            success. India's business landscape is complex and
                            fast-evolving. A qualified business coach provides strategic
                            clarity, strengthens decision-making, enhances leadership
                            capability, and helps business owners, CEOs, and corporate
                            leaders navigate challenges with confidence. Whether you are
                            scaling your company, leading a corporate team, or managing a
                            family business, the right coach helps you improve performance,
                            maintain focus, and achieve sustainable growth. Choosing an
                            experienced business coach in India ensures guidance that is
                            practical, relevant, and aligned with the realities of Indian
                            businesses.
                        </p>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </section>

        <section class="pricancy-ready">
            <div class="container">
                <!-- ══════════════════════════════
       SECTION 1 — Privacy
  ══════════════════════════════ -->
                <div class="privacy-wrap">
                    <!-- decorative dots -->
                    <div class="deco-squares">
                        <span></span><span></span><span></span> <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h2 class="privacy-title">Privacy &amp; Confidentiality</h2>
                            <p class="privacy-sub">Confidential. Professional. Trusted.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 privacy-text">
                            <p>
                                Business coaching involves strategic conversations, leadership
                                decisions, and organizational direction.
                            </p>
                            <p>
                                We ensure complete confidentiality and privacy in every
                                interaction.
                            </p>
                            <p>
                                Your business information, discussions, and coaching
                                engagements remain fully secure and protected.
                            </p>
                            <p>
                                This platform is built on trust, professionalism, and
                                discretion.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ══════════════════════════════
       SECTION 2 — CTA Banner
  ══════════════════════════════ -->
                <div class="row">
                    <div class="col-12">
                        <div class="cta-banner">
                            <div class="row g-0 h-100">
                                <!-- LEFT — text + buttons -->
                                <div class="col-12 col-md-6 cta-left">
                                    <div class="success-tag">
                                        SUCCESS STORY
                                        <!-- wavy arrow -->
                                        <svg viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 7 C6 2, 10 12, 14 7 S22 2, 26 7 S30 12, 34 7" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" fill="none" />
                                            <path d="M30 4 L34 7 L30 10" stroke="white" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                        </svg>
                                    </div>

                                    <h3 class="cta-heading">
                                        Find the Business Coach<br />
                                        Who Can Transform Your<br />
                                        Leadership and Business
                                    </h3>

                                    <p class="cta-desc">
                                        The right business coach helps you think clearly, lead
                                        confidently, and grow sustainably.
                                    </p>

                                    <div class="cta-buttons">
                                        <a href="#" class="btn-find">
                                            Find a Business Coach in India &nbsp;→
                                        </a>
                                        <a href="#" class="btn-join">
                                            Join as a Business Coach
                                        </a>
                                    </div>
                                </div>

                                <!-- RIGHT — team image -->
                                <div class="col-12 col-md-6 cta-right">
                                    <img src="{{ asset('website/assets/img/group-business-people-standing-room-with-wall-windows-1.webp') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /container -->
        </section>
    </main>

</x-web-app-layout>
