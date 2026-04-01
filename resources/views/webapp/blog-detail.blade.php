<x-web-app-layout>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-box">
                        <a href="{{ route('webapp.home') }}">Home</a>
                        <span><i class="bi bi-chevron-right"></i></span>
                        <a href="{{ route('webapp.blogs') }}">Blogs</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="hero-contact">
            <div class="container">
                <div class="row">
                    <div class="col-12 contact-h">
                        <h1>{{ $blog->title }} <img src="{{ asset('website/assets/img/arrow.png') }}" alt="" /></h1>
                    </div>
                    <div class="col-12">
                        <div class="contact-banner">
                            <img src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('website/assets/img/blog-detail.png') }}"
                                alt="{{ $blog->title }}" class="blogdetailimg" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="page-wrap">
            <div class="row g-4">
                <!-- ══════════════ MAIN CONTENT ══════════════ -->
                <div class="col-12 col-md-8">
                    <div class="post-meta" style="margin-bottom: 20px;">
                        <span class="post-date"><i class="bi bi-calendar4"></i>
                            {{ $blog->created_at->format('F d, Y') }}</span>
                        @if($blog->author)
                            <span class="post-author" style="margin-left: 15px;"><i class="bi bi-person"></i>
                                {{ $blog->author->name }}</span>
                        @endif
                        @if($blog->category)
                            <span class="post-category" style="margin-left: 15px;"><i class="bi bi-tag"></i>
                                {{ $blog->category->name }}</span>
                        @endif
                    </div>
                    <div class="post-body">
                        {!! $blog->content !!}
                    </div>
                    <!-- /post-body -->

                    <!-- Share Bar -->
                    {{-- <div class="share-bar">
                        <div class="shares-count"><strong>{{ $blog->view_count ?? 0 }}</strong> Views</div>
                        <a href="#" class="share-btn fb">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="#1877f2">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                            </svg>
                            SHARE <span class="share-count-badge">{{ rand(1, 50) }}</span>
                        </a>
                        <a href="#" class="share-btn tw">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="#1da1f2">
                                <path
                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                            </svg>
                            TWEET <span class="share-count-badge">{{ rand(1, 30) }}</span>
                        </a>
                        <a href="#" class="share-btn pi">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="#e60023">
                                <path
                                    d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z" />
                            </svg>
                            PIN <span class="share-count-badge">{{ rand(1, 25) }}</span>
                        </a>
                    </div> --}}

                    <!-- View Comments -->
                    @php
                        $commentCount = $blog->comments()->count();
                    @endphp
                    {{-- <a href="#comments-section" class="view-comments-btn">VIEW COMMENTS ({{ $commentCount }})</a>
                    --}}

                    <div class="newsletter-section">
                        <h3>Sign up for our newsletters</h3>
                        <p>Get notified of the best deals and coaching insights.</p>

                        <form id="newsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <div class="newsletter-form">
                                {{-- Name is optional based on your current SQL table --}}
                                <input type="text" name="name" placeholder="Enter your name" />

                                {{-- Email is required --}}
                                <input type="email" name="email" placeholder="Enter your email" required />

                                <button type="submit">SUBSCRIBE</button>
                            </div>

                            <label class="newsletter-check">
                                <input type="checkbox" name="terms" required />
                                <span>By checking this box, you confirm that you have read and are
                                    agreeing to our <a href="{{ route('terms-and-conditions') }}" target="_blank">Terms & Conditions</a>
                                    regarding the storage of the data submitted through this form.</span>
                            </label>
                        </form>

                        {{-- Success/Error Message Container for AJAX --}}
                        <div id="newsletter-message" class="mt-2 small"></div>
                    </div>

                    <!-- You May Also Like -->

                </div>
                <!-- /col main -->

                <!-- ══════════════ SIDEBAR ══════════════ -->
                <div class="col-12 col-md-4">
                    <div class="sidebar">
                        <!-- Popular Posts -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-widget-title">Popular Post</h4>

                            @php
                                $popularBlogs = \App\Models\Blog::where('is_published', true)
                                    ->where('id', '!=', $blog->id)
                                    ->orderBy('view_count', 'desc')
                                    ->limit(3)
                                    ->get();
                            @endphp

                            @forelse($popularBlogs as $popularBlog)
                                <div class="popular-post">
                                    <div class="popular-post-thumb">
                                        <img src="{{ $popularBlog->featured_image ? asset('storage/' . $popularBlog->featured_image) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&q=80' }}"
                                            alt="{{ $popularBlog->title }}" />
                                    </div>
                                    <div class="popular-post-info">
                                        <div class="popular-post-date"><i class="bi bi-calendar4"></i>
                                            {{ $popularBlog->created_at->format('M d, Y') }}</div>
                                        <a href="{{ route('blog-detail', $popularBlog->slug) }}"
                                            class="popular-post-title">{{ $popularBlog->title }}</a>
                                    </div>
                                </div>
                            @empty
                                <p>No popular posts available.</p>
                            @endforelse
                        </div>

                        <!-- Filter -->
                        {{-- <div class="sidebar-widget">
                            <h4 class="sidebar-widget-title">Filter</h4>
                            <ul class="filter-list">
                                <li class="active">
                                    <input type="radio" name="filter" id="f1" checked />
                                    <label for="f1">1 Core Business Coaching</label>
                                </li>
                                <li>
                                    <input type="radio" name="filter" id="f2" />
                                    <label for="f2">2 Growth &amp; Performance Coaching</label>
                                </li>
                                <li>
                                    <input type="radio" name="filter" id="f3" />
                                    <label for="f3">3 Legacy &amp; High-Stakes Coaching</label>
                                </li>
                                <li>
                                    <input type="radio" name="filter" id="f4" />
                                    <label for="f4">4 Leadership Coaching</label>
                                </li>
                                <li>
                                    <input type="radio" name="filter" id="f5" />
                                    <label for="f5">5 Personal Effectiveness Coaching</label>
                                </li>
                                <li>
                                    <input type="radio" name="filter" id="f6" />
                                    <label for="f6">6 Future-Ready Coaching</label>
                                </li>
                            </ul>
                        </div> --}}

                        {{-- <div class="sidebar-widget">
                            <h4 class="sidebar-widget-title">Popular Tags</h4>
                            <div class="tag-cloud">
                                <a href="#" class="tag">Travel Planning</a>
                                <a href="#" class="tag">Safety Guides</a>
                                <a href="#" class="tag">Spa Retreats</a>
                                <a href="#" class="tag">Wine Tours</a>
                                <a href="#" class="tag">Travel Pack</a>
                                <a href="#" class="tag">Solo Travel</a>
                                <a href="#" class="tag">Travel Programs</a>
                            </div>
                        </div> --}}
                    </div>
                    <!-- /sidebar -->
                </div>
                <!-- /col sidebar -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="also-like-section">
                        <h2>You May Also Like</h2>
                        <div class="row g-3">
                            @php
                                $relatedBlogs = \App\Models\Blog::where('is_published', true)
                                    ->where('id', '!=', $blog->id)
                                    ->when($blog->category_id, function ($q) use ($blog) {
                                        return $q->orWhere('category_id', $blog->category_id);
                                    })
                                    ->limit(8)
                                    ->get();
                            @endphp

                            @forelse($relatedBlogs as $index => $relatedBlog)
                                @php
                                    $cardClasses = ['also-card'];
                                    if (($index + 1) % 4 == 2)
                                        $cardClasses[] = 'teal';
                                    elseif (($index + 1) % 4 == 3)
                                        $cardClasses[] = 'green';
                                    elseif (($index + 1) % 4 == 0)
                                        $cardClasses[] = 'dark';
                                @endphp
                                <div class="col-6 col-sm-3">
                                    <a href="{{ route('blog-detail', $relatedBlog->slug) }}"
                                        title="{{ $relatedBlog->title }}">
                                        <div class="{{ implode(' ', $cardClasses) }}">
                                            <img src="{{ $relatedBlog->featured_image ? asset('storage/' . $relatedBlog->featured_image) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80' }}"
                                                alt="{{ $relatedBlog->title }}" />
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center">No related blogs available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /page-wrap -->
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#newsletterForm').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const messageDiv = $('#newsletter-message');
                const submitBtn = form.find('button');

                // Basic UI reset
                messageDiv.html('').removeClass('text-success text-danger');
                submitBtn.prop('disabled', true).text('PROCESSING...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        messageDiv.addClass('text-success').html(response.message);
                        form.trigger('reset'); // Clear form
                        submitBtn.prop('disabled', false).text('SUBSCRIBE');
                    },
                    error: function (xhr) {
                        let errorMsg = 'Something went wrong. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        messageDiv.addClass('text-danger').html(errorMsg);
                        submitBtn.prop('disabled', false).text('SUBSCRIBE');
                    }
                });
            });
        });
    </script>
</x-web-app-layout>
