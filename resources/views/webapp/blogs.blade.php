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

                        <section class="blog-catergoryt">

                            <div class="container-lg">
                                <div class="row g-4">

                                    <!-- ── Col 1: Popular integrations ── -->
                                    <div class="col-12 col-sm-6 col-md-4 col-lg col-section">
                                        <h6 class="col-heading">Popular integrations</h6>
                                        <ul class="link-list" id="list-1">
                                            <li><a href="#">Google Sheets</a></li>
                                            <li><a href="#">Telegram</a></li>
                                            <li><a href="#">MySQL</a></li>
                                            <li><a href="#">Slack</a></li>
                                            <li><a href="#">Discord</a></li>
                                            <li class="extra"><a href="#">Postgres</a></li>
                                            <li class="extra"><a href="#">Airtable</a></li>
                                            <li class="extra"><a href="#">Notion</a></li>
                                            <li class="extra"><a href="#">Zapier</a></li>
                                        </ul>
                                        <button class="toggle-btn" onclick="toggleList('list-1', this)">Show
                                            more</button>
                                    </div>

                                    <!-- ── Col 2: Trending combinations ── -->
                                    <div class="col-12 col-sm-6 col-md-4 col-lg col-section">
                                        <h6 class="col-heading">Trending combinations</h6>
                                        <ul class="link-list" id="list-2">
                                            <li><a href="#">HubSpot and Salesforce</a></li>
                                            <li><a href="#">Twilio and WhatsApp</a></li>
                                            <li><a href="#">GitHub and Jira</a></li>
                                            <li><a href="#">Asana and Slack</a></li>
                                            <li><a href="#">Asana and Salesforce</a></li>
                                            <li class="extra"><a href="#">Jira and Slack</a></li>
                                            <li class="extra"><a href="#">Notion and Slack</a></li>
                                            <li class="extra"><a href="#">Trello and GitHub</a></li>
                                            <li class="extra"><a href="#">Stripe and Shopify</a></li>
                                        </ul>
                                        <button class="toggle-btn" onclick="toggleList('list-2', this)">Show
                                            more</button>
                                    </div>

                                    <!-- ── Col 3: Top integration categories ── -->
                                    <div class="col-12 col-sm-6 col-md-4 col-lg col-section">
                                        <h6 class="col-heading">Top integration categories</h6>
                                        <ul class="link-list" id="list-3">
                                            <li><a href="#">Development</a></li>
                                            <li><a href="#">Communication</a></li>
                                            <li><a href="#">Langchain</a></li>
                                            <li><a href="#">AI</a></li>
                                            <li><a href="#">Data &amp; Storage</a></li>
                                            <li class="extra"><a href="#">Marketing</a></li>
                                            <li class="extra"><a href="#">Finance</a></li>
                                            <li class="extra"><a href="#">Analytics</a></li>
                                            <li class="extra"><a href="#">Security</a></li>
                                        </ul>
                                        <button class="toggle-btn" onclick="toggleList('list-3', this)">Show
                                            more</button>
                                    </div>

                                    <!-- ── Col 4: Trending templates ── -->
                                    <div class="col-12 col-sm-6 col-md-4 col-lg col-section">
                                        <h6 class="col-heading">Trending templates</h6>
                                        <ul class="link-list" id="list-4">
                                            <li><a href="#">Creating an API endpoint</a></li>
                                            <li><a href="#">AI agent chat</a></li>
                                            <li><a href="#">Scrape and summarize webpage</a></li>
                                            <li><a href="#">Very quick quickstart</a></li>
                                            <li><a href="#">Pulling data from services that n…</a></li>
                                            <li class="extra"><a href="#">Joining different datasets</a></li>
                                            <li class="extra"><a href="#">Auto email responder</a></li>
                                            <li class="extra"><a href="#">Webhook trigger workflow</a></li>
                                            <li class="extra"><a href="#">Slack daily digest</a></li>
                                        </ul>
                                        <button class="toggle-btn" onclick="toggleList('list-4', this)">Show
                                            more</button>
                                    </div>

                                    <!-- ── Col 5: Top guides ── -->
                                    <div class="col-12 col-sm-6 col-md-4 col-lg col-section">
                                        <h6 class="col-heading">Top guides</h6>
                                        <ul class="link-list" id="list-5">
                                            <li><a href="#">Telegram bots</a></li>
                                            <li><a href="#">Open-source chatbot</a></li>
                                            <li><a href="#">Open-source LLM</a></li>
                                            <li><a href="#">Open-source low-code platforms</a></li>
                                            <li><a href="#">Zapier alternatives</a></li>
                                            <li class="extra"><a href="#">Make vs Zapier</a></li>
                                            <li class="extra"><a href="#">n8n vs Zapier</a></li>
                                            <li class="extra"><a href="#">Best workflow tools 2025</a></li>
                                            <li class="extra"><a href="#">No-code automation guide</a></li>
                                        </ul>
                                        <button class="toggle-btn" onclick="toggleList('list-5', this)">Show
                                            more</button>
                                    </div>

                                </div><!-- /row -->
                            </div><!-- /container -->
                        </section>
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
