<x-web-app-layout>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-box">
                        <a href="{{ route('webapp.home') }}">Home</a>
                        <span><i class="bi bi-chevron-right"></i></span>
                        <a href="#">{{ $coach->user->name }}</a>
                    </div>
                </div>
            </div>
        </div>

        <section class="section-newprofile-h">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-12">

                        <div class="profile-card">

                            <div class="profile-top">

                                <div class="deco-lines-tr">
                                    <span style="width:60px"></span>
                                    <span style="width:46px"></span>
                                    <span style="width:34px"></span>
                                    <span style="width:22px"></span>
                                </div>

                                <div class="row align-items-center g-0">

                                    <div class="col-auto me-3">
                                        <div class="avatar-wrap">
                                            <img src="{{ $coach->user->profile_image ? asset($coach->user->profile_image) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&q=80' }}"
                                                alt="{{ $coach->user->name }}" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        @php
                                            $gender = strtolower($coach->gender ?? '');
                                            $showPersonalDetails = (bool) $coach->show_personal_details;
                                            $canShowPersonalDetails = $gender !== 'female' && $showPersonalDetails;
                                            $canShowEmail = $canShowPersonalDetails && filled($coach->user->email);
                                            $canShowPhone = $canShowPersonalDetails && filled($coach->user->phone);
                                        @endphp
                                        <div class="coach-name">{{ $coach->user->name }}</div>
                                        <div class="coach-title">{{ $coach->designation ?? 'Business Coach' }}</div>
                                        <p class="coach-desc">
                                            {{ $coach->company_name }}<br>
                                            {{ $coach->city }}, {{ $coach->state }}, {{ $coach->country }}
                                        </p>
                                        <div class="mb-2">
                                            <span class="badge {{ $showPersonalDetails ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                                Show Personal Details: {{ $showPersonalDetails ? 'On' : 'Off' }}
                                            </span>
                                        </div>
                                        <div class="contact-row">
                                            @if($canShowEmail)
                                                <a href="mailto:{{ $coach->user->email }}" class="contact-item">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <rect x="2" y="4" width="20" height="16" rx="2" />
                                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                                    </svg>
                                                    {{ $coach->user->email }}
                                                </a>
                                            @endif
                                            @if($canShowPhone)
                                                <a href="tel:{{ $coach->user->phone }}" class="contact-item">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.7 12.3 19.79 19.79 0 0 1 1.62 3.68 2 2 0 0 1 3.6 1.5h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.1a16 16 0 0 0 6 6l.91-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.5 16.5z" />
                                                    </svg>
                                                    {{ $coach->user->phone }}
                                                </a>
                                            @endif
                                            @if(!$canShowEmail && !$canShowPhone)
                                                <span class="contact-item">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 1v22" />
                                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6" />
                                                    </svg>
                                                    Personal details are hidden
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-auto ms-auto d-flex align-items-start pt-1">
                                        @if($coach->linkedin_url)
                                            <a href="{{ $coach->linkedin_url }}" target="_blank" class="linkedin-btn"
                                                title="LinkedIn">
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="journey-section">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="journey-header">
                                            <span class="journey-title">My Journey</span>
                                            <a href="#" class="chat-btn">Chat With Us</a>
                                        </div>

                                        <div class="journey-text">
                                            {!! $coach->bio !!}
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section-harnessing - can remain static or dynamic --}}
        <section class="section-harnessing">
            <div class="container">
                <div class="banner-wrap">
                    <svg class="banner-deco" viewBox="0 0 220 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="180" cy="30" rx="120" ry="120" stroke="white" stroke-width="40" />
                        <ellipse cx="200" cy="160" rx="80" ry="80" stroke="white" stroke-width="30" />
                    </svg>

                    <div class="banner-content">
                        <div class="row align-items-start">
                            <div class="col-12 col-md-6">
                                <h2 class="banner-heading">Harnessing Your Strengths:<br>The Benefits of a Business
                                    Coach</h2>
                            </div>
                            <div class="col-12 col-md-6">
                                <p class="banner-desc">
                                    Discover the benefits of having a business coach. They provide tailored guidance,
                                    accountability, and strategies to help you achieve your goals.
                                </p>
                            </div>
                        </div>

                        <div class="row g-3 mini-cards-row">
                            <div class="col-12 col-md-4">
                                <div class="mini-card">
                                    <div class="mini-card-top">
                                        <div class="mini-icon">
                                            <img src="{{ asset('website/assets/img/OET-Coaching-Benefits.svg') }}"
                                                alt="">
                                        </div>
                                        <span class="mini-num">01</span>
                                    </div>
                                    <div class="mini-g">
                                        <div class="mini-title">GET Coaching Benefits</div>
                                        <p class="mini-desc">Explore engineering tools to enhance competencies.</p>
                                    </div>
                                </div>
                            </div>
                            {{-- Other mini-cards... --}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h2 class="resource-title">Coach Blogs</h2>
                    </div>
                </div>

                <div class="row g-3">
                    @forelse($coachBlogs as $coachBlog)
                        <div class="col-12 col-md-6">
                            <a href="{{ route('blog-detail', $coachBlog->slug) }}" class="text-decoration-none text-reset">
                                <div class="resource-item h-100">
                                    <div class="resource-icon">
                                        @if($coachBlog->featured_image)
                                            <img src="{{ asset('storage/' . $coachBlog->featured_image) }}"
                                                alt="{{ $coachBlog->title }}"
                                                style="width: 56px; height: 56px; object-fit: cover; border-radius: 12px;">
                                        @else
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14 2 14 8 20 8" />
                                                <line x1="9" y1="13" x2="15" y2="13" />
                                                <line x1="9" y1="17" x2="15" y2="17" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="resource-label">Blog</div>
                                        <div class="resource-name">{{ \Illuminate\Support\Str::limit($coachBlog->title, 60) }}</div>
                                        <div class="resource-sub">{{ \Illuminate\Support\Str::limit(strip_tags($coachBlog->content), 90) }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-muted">No blogs published by this coach yet.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="blog-section blog-section1">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Trending <span>Blogs.</span></h2>
                    </div>
                </div>
                <div class="row">
                    @isset($blogs)
                        @foreach($blogs->take(3) as $post)
                            <div class="col-md-4">
                                <div class="blog-card">
                                    <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('website/assets/img/blog-imag.png') }}"
                                        alt="{{ $post->title }}">
                                    <div class="blog-content">
                                        <h3>{{ Str::limit($post->title, 45) }}</h3>
                                        <p>{{ Str::limit(strip_tags($post->content), 120) }}</p>
                                    </div>
                                    <a href="{{ route('blog-detail', $post->slug) }}" class="button-blog">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </section>
    </main>
</x-web-app-layout>
