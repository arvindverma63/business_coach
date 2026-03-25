<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">
        <!-- Left Badge -->
        <a class="navbar-brand brand-badge" href="{{ route('webapp.home') }}">
            BEST BUSINESS COACHES INDIA
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="offcanvas offcanvas-end" id="mobileMenu">
            <div class="offcanvas-header">
                <h5>Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('webapp.home') ? 'active' : '' }}"
                            href="{{ route('webapp.home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('webapp.about-us') ? 'active' : '' }}"
                            href="{{ route('webapp.about-us') }}">
                            About Us
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('webapp.find-coach') ? 'active' : '' }}"
                            href="{{ route('webapp.find-coach') }}">
                            Find a Coach
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('webapp.rank') ? 'active' : '' }}"
                            href="{{ route('webapp.rank') }}">
                            Rank
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('webapp.contact') ? 'active' : '' }}"
                            href="{{ route('webapp.contact') }}">
                            Contact Us
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('webapp.blogs') ? 'active' : '' }}"
                            href="{{ route('webapp.blogs') }}">
                            Blogs
                        </a>
                    </li>
                </ul>

                <div class="d-lg-flex gap-2">
                    <button class="btn-login me-2" data-bs-toggle="modal" data-bs-target="#profileModal1">
                        Login As Seeker
                    </button>
                    <button class="btn-coach" data-bs-toggle="modal" data-bs-target="#profileModal">
                        Be a Coach
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>
