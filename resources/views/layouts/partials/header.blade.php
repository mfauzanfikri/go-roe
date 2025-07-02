<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-end">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <h1 class="sitename">Go-Roe</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#program">Program</a></li>
                <li><a href="{{ route('tutors.index') }}">Tutor Kami</a></li>
                @if(auth()->user())
                    <li><a href="{{ route('orders.index') }}">History</a></li>
                    <li class="dropdown"><a href="" onclick="event.preventDefault()"><span>{{ auth()->user()->name }}</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            @if(auth()->user()->role === 'tutor')
                                <li>
                                    Balance: {{ auth()->user()->balance }}
                                </li>
                            @endif

                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf

                                    <button class="btn">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
