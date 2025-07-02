<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/member/user-edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">


</head>

<body>

    <!-- Top Header -->
    <header class="top-header sticky-top">
        <div class="header-container">
            <div class="logo-section">
                <div class="logo-icon">📅</div>
                <span class="logo-text">MMAAP</span>
            </div>

            <div class="search-section">
                <form action="{{ route('search') }}" method="GET" class="search-container">
                    <span class="search-icon">🔍</span>
                    <input type="text" name="query" class="search-input" placeholder="Search" value="{{ request('query') }}">
                </form>
            </div>

            <div class="header-actions">
                <button class="create-event-btn">CREATE NEW EVENT</button>
                {{-- <span class="revenue-text">REVENUE: <span class="revenue-amount">$2500.00</span></span> --}}
                <div class="user-avatar"></div>
            </div>
        </div>
    </header>

    <!-- Main Navigation -->
    <nav class="main-nav sticky-nav">
        <div class="nav-container">
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="{{ route('job-board') }}" class="nav-link {{ request()->routeIs('job-board') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-briefcase"></i> </span>
                        JOB BOARDING
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('index') }}" class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-calendar-alt"></i></span>
                        EVENTS
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('member.resource') }}"class="nav-link {{ request()->routeIs('member.resource') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fab fa-github"></i> </i></span>
                        RESOURCES
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('member.community') }}"
                        class="nav-link {{ request()->routeIs('member.community') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-comments"></i></span>
                        FORUM
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon">📆</span>
                        CALENDAR
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('member.portfolio') }}"
                        class="nav-link {{ request()->routeIs('member.portfolio') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-cog"></i></span>
                        SETTING
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('membership') }}"
                        class="nav-link {{ request()->routeIs('membership') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-id-card"></i></span>
                        MEMBERSHIP
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link {{ request()->routeIs('logout') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>


            </ul>
        </div>
    </nav>
    <div class="sticky-ribbon">
        @yield('ribbon')

    </div>



    <!-- Main Content -->
    <main class="main-content">
        <div class="content-placeholder">
            {{-- <h2>Settings Content</h2>
            <p>This is where the settings content would be displayed based on the selected tab.</p> --}}
            @yield('content')

        </div>
    </main>
    {{-- 
    <script>
        // Add basic interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Tab navigation
            const tabLinks = document.querySelectorAll('.tab-link');
            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all tabs
                    tabLinks.forEach(tab => tab.classList.remove('active'));

                    // Add active class to clicked tab
                    this.classList.add('active');

                    // Update content placeholder
                    const tabName = this.textContent.trim();
                    const contentPlaceholder = document.querySelector('.content-placeholder');
                    contentPlaceholder.innerHTML = `
                        <h2>${tabName} Settings</h2>
                        <p>Content for ${tabName} would be displayed here.</p>
                    `;
                });
            });

            // Main navigation
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all nav items
                    navLinks.forEach(nav => nav.classList.remove('active'));

                    // Add active class to clicked nav item
                    this.classList.add('active');
                });
            });

            // Button interactions
            document.querySelector('.create-event-btn').addEventListener('click', function() {
                alert('Create New Event clicked!');
            });

            document.querySelector('.dashboard-btn').addEventListener('click', function() {
                alert('Go to Dashboard clicked!');
            });
        });
    </script> --}}
</body>

</html>
