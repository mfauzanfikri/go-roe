<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-end">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <h1 class="sitename">College</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li class="dropdown"><a href="#"><span>About</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Admissions</a></li>
                        <li><a href="#">Academics</a></li>
                        <li><a href="#">Faculty &amp; Staff</a></li>
                        <li><a href="#">Campus &amp; Facilities</a></li>
                    </ul>
                </li>
                <li><a href="#">Students Life</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Alumni</a></li>
                <li class="dropdown"><a href="#"><span>More Pages</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">News Details</a></li>
                        <li><a href="#">Event Details</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Error 404</a></li>
                        <li><a href="#">Starter Page</a></li>
                    </ul>
                </li>
                <li><a href="#">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
