<x-web-app-layout>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-box">
                        <a href="#">Home</a>
                        <span><i class="bi bi-chevron-right"></i></span>
                        <a href="#">Blogs </a>
                    </div>
                </div>
            </div>
        </div>
        <section class="hero-contact hero-contact-blog">
            <div class="container">
                <div class="row">
                    <div class="col-12 contact-h">
                        <h1>Blogs <img src="{{ asset('website/assets/img/arrow.png') }}" alt="" /></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 blog-c">
                        <h1>Visa Immigration for a Brighter You Future</h1>
                        <a href="">Learn More <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="col-md-5">
                        <img src="{{ asset('website/assets/img/User.png') }}" alt="" class="User-blog" />
                    </div>
                </div>
            </div>
        </section>
        <section class="section-explore-bloh">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Explore by use case</h2>
                        <div class="filter-row" id="filterRow">
                            <button class="filter-btn active" data-filter="all">All</button>
                            @foreach($categories as $category)
                                <button class="filter-btn" data-filter="{{ $category->slug }}">
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </div>
                        <!-- Cards -->
                        <div class="row cards-grid" id="cardsGrid">
                            @forelse($blogs as $blog)
                                <div class="col-md-4 use-card" data-category="{{ $blog->category?->slug ?? 'all' }}">
                                    <div class="blog-card">
                                        <img src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('website/assets/img/blog-imag.png') }}"
                                            alt="{{ $blog->title }}" />
                                        <div class="blog-content">
                                            <h3>{{ $blog->title }}</h3>
                                            <p>
                                                {{ Str::limit(strip_tags($blog->content), 120) }}
                                            </p>
                                        </div>
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

                        <!-- Pagination -->
                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-center">
                                {{ $blogs->links() }}
                            </div>
                        </div>


    </main>

    @push('scripts')
        <script>
            const filterBtns = document.querySelectorAll(".filter-btn");
            const cards = document.querySelectorAll(".use-card");
            const noResults = document.getElementById("noResults");

            filterBtns.forEach((btn) => {
                btn.addEventListener("click", () => {
                    // Active state
                    filterBtns.forEach((b) => b.classList.remove("active"));
                    btn.classList.add("active");

                    const filter = btn.dataset.filter;
                    let visible = 0;

                    cards.forEach((card) => {
                        const match = filter === "all" || card.dataset.category === filter;
                        card.classList.toggle("hidden", !match);
                        if (match) visible++;
                    });

                    noResults.style.display = visible === 0 ? "block" : "none";
                });
            });
        </script>
        <script>
            function toggleList(listId, btn) {
                const list = document.getElementById(listId);
                const extras = list.querySelectorAll('li.extra');
                const isOpen = btn.textContent.trim() === 'Show less';

                extras.forEach(li => li.classList.toggle('show', !isOpen));
                btn.textContent = isOpen ? 'Show more' : 'Show less';
            }
        </script>
    @endpush

</x-web-app-layout>
