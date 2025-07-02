<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-2.ico') }}">
    <title>{{ config('app.name') }}</title>


    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .sidebar {
            width: 250px;
            background: #23272f;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            transition: width 0.3s;
            box-shadow: 2px 0 8px rgba(0,0,0,0.04);
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .profile-section {
            display: flex;
            padding: 24px 24px 24px 24px;
            border-bottom: 1px solid #31343b;
            min-height: 90px;
        }

        .sidebar .profile-section img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            margin-right: 16px;
        }

        .sidebar.collapsed .profile-section img {
            margin-right: 0;
        }

        .sidebar .profile-section .profile-info {
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed .profile-section .profile-info {
            display: none;
        }

        .sidebar .nav-links {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-top: 24px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            color: #bfc9d4;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.2s, color 0.2s;
            border-left: 4px solid transparent;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #31343b;
            color: #ff9800;
            border-left: 4px solid #ff9800;
        }

        .sidebar .nav-link i {
            font-size: 20px;
            margin-right: 18px;
            min-width: 20px;
            text-align: center;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 14px 0;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .sidebar .logout {
            margin-top: auto;
            margin-bottom: 24px;
        }

        .top-bar {
            background: #fff;
            height: 64px;
            position: fixed;
            left: 250px;
            top: 0;
            width: calc(100% - 250px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.06);
            transition: left 0.3s, width 0.3s;
            z-index: 90;
        }

        .top-bar.expanded {
            left: 70px;
            width: calc(100% - 70px);
        }

        .main-content {
            margin-left: 250px;
            padding: 90px 32px 32px 32px;
            transition: margin-left 0.3s;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .hamburger {
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 22px;
            color: #23272f;
            margin-right: 16px;
        }

        #datetime-display {
            min-width: 250px;
            text-align: right;
            width: 100%;
            margin-right: 100px;
            font-size: 16px;
        }


        @media (max-width: 900px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            .top-bar {
                left: 0;
                width: 100%;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <nav class="sidebar" id="sidebar">
        <div class="profile-section">
            <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" alt="Profile">
            <div class="profile-info">
                <h3 style="color:#fff; font-weight:600; margin:0;">John</h3>
                <span style="color:#8ecae6; font-size:13px;">Administrator</span>
            </div>
        </div>
        <div class="nav-links">
            <a href="admin_dashboard.html" class="nav-link active">
                <i class="far fa-calendar-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="admin_report.html" class="nav-link">
                <i class="far fa-calendar-check"></i>
                <span>Events</span>
            </a>
            <a href="admin_analytics.html" class="nav-link">
                <i class="far fa-clock"></i>
                <span>Analytics</span>
            </a>
            <a href="user_management.html" class="nav-link">
                <i class="fas fa-user"></i>
                <span>Users</span>
            </a>
            <a href="faculty_load.html" class="nav-link">
                <i class="fas fa-clipboard-list"></i>
                <span>Faculty Load</span>
            </a>
        </div>
        <div class="logout">
            <a href="logout.html" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>

    <header class="top-bar">
        <button id="menu-toggle" class="hamburger"><i class="fas fa-bars"></i></button>
        {{-- <img src="img/mmaaplogo.png" style="height:40px;"> --}}
        <div id="datetime-display"></div>
        <div style="display:flex; align-items:center; gap:18px;">
            <div style="position:relative;">

            </div>
        </div>
    </header>

    <main class="main-content" id="app">
        @yield('content')
    </main>

    <form id="logout-form" action="logout.html" method="POST" style="display:none;"></form>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            var sidebar = document.getElementById('sidebar');
            var topbar = document.querySelector('.top-bar');
            var main = document.querySelector('.main-content');
            sidebar.classList.toggle('collapsed');
            topbar.classList.toggle('expanded');
            main.classList.toggle('expanded');
        });

        document.addEventListener('click', function (e) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menu-toggle');
            if (window.innerWidth <= 900 &&
                !sidebar.contains(e.target) &&
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>

    <script>
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            const formatted = now.toLocaleString('en-US', options);
            document.getElementById('datetime-display').textContent = formatted;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
</body>

</html>
