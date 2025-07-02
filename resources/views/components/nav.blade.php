<header class="header">
    <div class="logo">LOGO</div>
    <div class="hamburger" id="hamburger-menu">&#9776;</div>
    <nav class="nav" id="nav-menu">
      <a href="index.html">Home</a>
      <a href="about.html">About</a>
      <a href="programs.html">Programs</a>
      <a href="admissions.html">Admissions</a>
      <a href="gallery.html">Gallery</a>
      <a href="faculty.html">Faculty</a>
      <a href="news.html">News & Events</a>
      <a href="contact.html">Contact</a>
      <li class="user-profile">
        <div class="dropdown">
            <button class="dropdown-toggle">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->fname }}&background=random" 
                     alt="Profile" 
                     class="profile-image">
                <span>{{ Auth::user()->fname }}</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
    </nav>


  </header>

  <style>
        li{
            list-style: none;
        }
        .user-profile {
            margin-left: auto;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: none;
            border: none;
            cursor: pointer;
            color: #4a5568;
            font-size: 0.95rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .dropdown-toggle:hover {
            background: #f7fafc;
        }

        .profile-image {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 120%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .dropdown-menu a:hover {
            background: #f7fafc;
            color: #2b6cb0;
        }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuIcon = document.getElementById('menu-icon');
        const navbar = document.querySelector('.navbar');

        menuIcon.addEventListener('click', function() {
            navbar.classList.toggle('active');
            menuIcon.classList.toggle('active');
        });
    });
</script>