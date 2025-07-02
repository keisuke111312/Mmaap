@extends('layouts.pages.main')


@section('content')
    <style>
        /* Base and container */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            background: #fff;
            color: #032639;
            overflow-x: hidden;
            /* Prevent horizontal scroll */
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Team Section */
        .team-section {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 16px;
            text-align: center;
        }

        .team-section h2 {
            color: #032639;
            margin-bottom: 25px;
        }

        .team-section h4 {
            margin-bottom: 35px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
            margin-bottom: 48px;
        }

        .team-member {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .member-photo {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, #0f2f4a, #1e40af);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .member-info {
            padding: 24px;
        }

        .member-name {
            font-size: 20px;
            font-weight: 700;
            color: #032639;
            margin-bottom: 8px;
        }

        .member-position {
            font-size: 14px;
            color: #E09900;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .member-bio {
            font-size: 14px;
            color: #4b5563;
            line-height: 1.5;
        }


        /* Typography */
        h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 50px;
            font-weight: 600;
            text-align: start;
            /* Push text to start/left */
        }

        h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 35px;
            font-weight: 700;
        }

        h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 25px;
            font-weight: 700;
        }

        p {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 400;
        }

        span {
            color: #E09900;
        }

        /* Header */
        header {
            background-color: #0f2f4a;
            color: white;
        }

        .header-inner {
            max-width: 1200px;
            margin: auto;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            max-width: 140px;
            font-weight: 600;
            font-size: 12px;
            line-height: 1.2;
            font-family: 'Montserrat', sans-serif;
        }

        .logo img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        nav {
            display: none;
            gap: 24px;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.05em;
            font-family: 'Montserrat', sans-serif;
        }

        nav a {
            color: white;
            transition: text-decoration 0.3s;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
            color: #E09900;
        }

        @media (min-width: 768px) {
            nav {
                display: flex;
            }
        }

        /* Hero Section */
        .hero-fluid {
            position: relative;
            background-color: #0f2f4a;
            color: white;
            overflow: hidden;
            padding: 80px 16px 96px;
            width: 100vw;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            max-width: 1200px;
            padding: 0 16px;
            z-index: 1;
            margin-left: auto;
            margin-right: auto;
            color: white;
            text-align: start;
        }

        .hero-content p {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 24px;
            max-width: 600px;
        }

        .hero-fluid img.bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100%;
            object-fit: cover;
            object-position: center;
            opacity: 0.4;
            z-index: 0;
            display: block;
        }

        /* About Section */
        .about-section {
            display: flex;
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 16px;
            text-align: center;
            gap: 35px;
        }

        .about-section h2 {
            color: #032639;
            margin-bottom: 24px;
        }

        .about-section p {
            font-size: 18px;
            color: #4b5563;
            line-height: 1.6;
            max-width: 900px;
            margin: 0 auto 40px;
        }

        .about-content {
            text-align: start;
        }

        .about-content1 {
            width: 500px;
        }

        /* Mission Section */
        .mission-section {
            background-color: #f8fafc;
            padding: 80px 16px;
            width: 100vw;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            position: relative;
        }

        .mission-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 48px;
            align-items: center;
        }

        @media (min-width: 768px) {
            .mission-content {
                grid-template-columns: 1fr 1fr;
            }
        }

        .mission-text h2 {
            color: #032639;
            margin-bottom: 24px;
        }

        .mission-text p {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .mission-goals {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .mission-goals h3 {
            color: #032639;
            margin-bottom: 20px;
            text-align: center;
        }

        .goals-list {
            list-style: none;
            padding: 0;
        }

        .goals-list li {
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .goals-list li:last-child {
            border-bottom: none;
        }

        .goals-list i {
            color: #E09900;
            font-size: 18px;
        }

        /* Main Content */
        .main-content {
            padding: 80px 0;
            background: white;
        }

        /* Filter Tabs */
        .filterhead {
            text-align: center;
            padding-top: 35px;
            padding-bottom: 35px;
        }

        .filterhead h1 {
            text-align: center;
        }

        .filter-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 48px;
        }

        .filter-tab {
            background: white;
            border: 2px solid #E09900;
            color: #E09900;
            padding: 12px 24px;
            border-radius: 25px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .filter-tab:hover,
        .filter-tab.active {
            background: #E09900;
            color: white;
        }

        /* Members Grid */
        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
            margin-bottom: 48px;
        }

        .member-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .member-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .member-logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin: 0 auto 16px;
            border-radius: 8px;
        }

        .member-name {
            font-size: 18px;
            font-weight: 700;
            color: #032639;
            margin-bottom: 8px;
        }

        .member-type {
            font-size: 14px;
            color: #E09900;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .member-description {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        /* Loading and Empty States */
        .loading-state {
            text-align: center;
            padding: 48px 0;
            color: #666;
        }

        .empty-state {
            text-align: center;
            padding: 48px 0;
            color: #666;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #E09900;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 16px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Footer */
        footer {
            background-color: #0f2f4a;
            color: white;
            padding: 40px 16px;
            font-family: 'Montserrat', sans-serif;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 32px;
        }

        @media (min-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr 2fr;
            }
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            max-width: 140px;
            font-weight: 600;
            font-size: 12px;
            line-height: 1.2;

        }

        .footer-logo img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        .footer-desc {
            font-size: 16px;
            max-width: 280px;
            margin-bottom: 16px;
            line-height: 1.4;
        }

        .footer-phone {
            font-weight: 700;
            font-size: 16px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
            font-size: 16px;
            color: #032639;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        @media (min-width: 640px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            color: #032639;
            resize: none;
        }

        textarea {
            min-height: 72px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .social-links {
            display: flex;
            gap: 12px;
        }

        .social-links a {
            color: white;
            font-size: 20px;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: #E09900;
        }

        .btn-submit {
            background-color: #1f2937;
            color: white;
            font-weight: 700;
            font-size: 16px;
            padding: 12px 30px;
            border-radius: 4px;
            border: none;
            transition: background-color 0.3s;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
        }

        .btn-submit:hover {
            background-color: #374151;
        }
    </style>



    <!-- Hero Section -->
    <section class="hero-fluid" id="home">
        <img src="{{ asset('img/abouthero.jpg') }}" alt="People in a meeting, blurred background with dark overlay"
            class="bg-image" width="1920" height="600" aria-hidden="true" />
        <div class="hero-content">
            <h1>Join the first ever multimedia arts<br>professional organization in the <span>Philippines!</span></h1>
            <p>MMAAP, The Multimedia Arts Association of the Philippines, is the first professional organization for
                multimedia arts in the Philippines</p>
        </div>
    </section>

    <div class="container">
        <div class="filterhead">
            <h1>Members and Partners</h1>
            <p>See the list of our members here:</p>
        </div>


        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <a href="#" class="filter-tab active" data-filter="all">All Members</a>
            <a href="#" class="filter-tab" data-filter="industry">Industry Members</a>
            <a href="#" class="filter-tab" data-filter="academe">Academe Members</a>
            <a href="#" class="filter-tab" data-filter="vendor">Vendor Members</a>
            <a href="#" class="filter-tab" data-filter="affiliate">Professional Affiliates</a>
            <a href="#" class="filter-tab" data-filter="partners">Partners</a>
        </div>


        <!-- Members Grid -->
        <div class="members-grid" id="membersGrid">
            <div class="loading-state" id="loadingState">
                <div class="spinner"></div>
                <p>Loading members...</p>
            </div>

            @foreach ($partners as $member)
                <div class="member-card" data-type="{{ $member->type }}">
                    <img src="{{ $member->logo_url }}" alt="{{ $member->name }} logo" class="member-logo" />
                    <div class="member-name">{{ $member->name }}</div>
                    <div class="member-type">
                        {{ $typeLabels[$member->type] ?? ucfirst($member->type) }}
                    </div>
                    <div class="member-description">{{ $member->description }}</div>
                </div>
            @endforeach

            <div class="empty-state" id="emptyState" style="display: none;">
                <p>No members found for this category.</p>
            </div>
        </div>


        <!-- Empty State -->
        <div class="empty-state" id="emptyState" style="display: none;">
            <i class="fas fa-users" style="font-size: 48px; color: #E09900; margin-bottom: 16px;"></i>
            <h2>No members found</h2>
            <p>No members match the selected criteria.</p>
        </div>
    </div>


    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="about-content">
            <h2>About <span>MMAAP</span></h2>
            <p>Bringing together frontrunners, professionals as well as students and schools, the MMAAP hopes to
                establish itself as the cornerstone of Filipino multimedia arts, enriching its members with a strong
                network and international networks, professional support, and opportunities for capacity building
                through seminars, workshops and national conventions.</p>
            <p>MMAAP envisions itself as a foundation of world-class Filipino multimedia arts professionals and the
                motivator of interest towards excellence in multimedia arts as a field of specialization.</p>
        </div>

        <img class="about-content1" src="{{ asset('img/aboutUs.svg') }}" alt="aboutus">
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="mission-content">
            <div class="mission-text">
                <h2>Our <span>Mission</span></h2>
                <p>MMAAP envisions itself as a foundation of world-class Filipino multimedia arts professionals and the
                    motivator of interest towards excellence in multimedia arts as a field of specialization.</p>
                <p>Through research and development, MMAAP aims to evolve together with the industry through constant
                    training and exposure.</p>
                <p>We are committed to building knowledge, skills and expertise in multimedia arts through research and
                    development.</p>
            </div>
            <div class="mission-goals">
                <h3>MMAAP AIMS TO</h3>
                <ul class="goals-list">
                    <li><i class="fas fa-check-circle"></i> Build a network of professional and graduates in the
                        multimedia arts discipline in the country through constant interaction</li>
                    <li><i class="fas fa-check-circle"></i> Advance competency and awareness</li>
                    <li><i class="fas fa-check-circle"></i> Expand knowledge and specialization in multimedia arts
                        through research and development</li>
                    <li><i class="fas fa-check-circle"></i> Enhance careers and professional support</li>
                </ul>
            </div>
        </div>
    </section>

    @include('officials.index')

    <!-- Contact Section -->
    <section class="hero-fluid" id="home">
        <img src="{{ asset('img/abouthero.jpg') }}" alt="People in a meeting, blurred background with dark overlay"
            class="bg-image" width="1920" height="600" aria-hidden="true" />
        <div class="hero-content">

            <h3 style="text-align: center;">Connecting Creatives. Inspiring Innovation. <span>Shaping Multimedia
                    Futures.</span></h3>
        </div>
    </section>


    <script>
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterTabs = document.querySelectorAll('.filter-tab');
            const memberCards = document.querySelectorAll('.member-card');
            const loadingState = document.getElementById('loadingState');
            const emptyState = document.getElementById('emptyState');

            setTimeout(() => {
                if (loadingState) loadingState.style.display = 'none';
            }, 1000);

            filterTabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    filterTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');
                    let visibleCount = 0;

                    memberCards.forEach(card => {
                        const cardType = card.getAttribute('data-type');
                        const matches = filter === 'all' || cardType === filter;

                        card.style.display = matches ? 'block' : 'none';
                        if (matches) visibleCount++;
                    });

                    emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
                });
            });
        });



        function loadMembers(filter = 'all') {
            const loadingState = document.getElementById('loadingState');
            const membersGrid = document.getElementById('membersGrid');

            // Show loading state
            loadingState.style.display = 'block';

            fetch(`/api/members?filter=${filter}`)
                .then(response => response.json())
                .then(data => {
                    // Hide loading state
                    loadingState.style.display = 'none';

                    // Clear existing cards (except loading/empty states)
                    const existingCards = membersGrid.querySelectorAll('.member-card');
                    existingCards.forEach(card => card.remove());

                    // Add new cards
                    data.members.forEach(member => {
                        const card = document.createElement('div');
                        card.className = 'member-card';
                        card.setAttribute('data-type', member.type);
                        card.innerHTML = `
                <img src="${member.logo_url}" alt="${member.name} logo" class="member-logo" />
                <div class="member-name">${member.name}</div>
                <div class="member-type">${member.type}</div>
                <div class="member-description">${member.description}</div>
              `;
                        membersGrid.appendChild(card);
                    });

                    // Show empty state if no members
                    if (data.members.length === 0) {
                        document.getElementById('emptyState').style.display = 'block';
                    } else {
                        document.getElementById('emptyState').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error loading members:', error);
                    loadingState.style.display = 'none';
                });
        }
    </script>

    <!-- Footer -->
@endsection
