@extends('layouts.member.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">Resources</h1>
                <button class="dashboard-btn">GO TO DASHBOARD</button>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            <ul class="tab-items">
                <div class="button-container">
                    <li class="tab-item">
                        <button class="filter-tab active" data-filter="all">All Resources</button>
                    </li>
                    <li class="tab-item">
                        <button class="filter-tab" data-filter="articles">Articles</button>
                    </li>
                    <li class="tab-item">
                        <button class="filter-tab" data-filter="tutorials">Tutorials</button>
                    </li>
                    <li class="tab-item">
                        <button class="filter-tab" data-filter="research">Research</button>
                    </li>
                </div>

            </ul>
            <select class="sort-dropdown">
                <option>Sort by: Most Recent</option>
                <option>Sort by: Most Popular</option>
                <option>Sort by: Highest Rated</option>
                <option>Sort by: Title A-Z</option>
            </select>
        </div>
    </nav>
@endsection



<style>
    .tab-container {
        display: flex;
        justify-content: space-evenly;
    }

    .button-container {
        box-sizing: border-box;
        display: flex;
        padding: 12px;
        justify-content: center;
    }

    .section-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title {
        font-size: 36px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 16px;
    }

    .section-subtitle {
        font-size: 18px;
        color: #6b7280;
        max-width: 600px;
        margin: 0 auto;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .category-card {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: #032639;
    }

    .category-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #032639, #1e40af);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        margin: 0 auto 20px;
        color: white;
    }

    .category-title {
        font-size: 24px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 12px;
    }

    .category-description {
        color: #6b7280;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .category-count {
        font-size: 14px;
        color: #032639;
        font-weight: 600;
    }

    /* Featured Resources */
    .featured-section {
        padding: 80px 0;
        /* background: white; */
    }

    .resource-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
    }

    .resource-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
        max-width: 450px;
    }

    .resource-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .resource-image {
        height: 200px;
        background: linear-gradient(135deg, #032639, #032639ce);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
    }

    .resource-content {
        padding: 30px;
    }

    .resource-type {
        display: inline-block;
        padding: 4px 12px;
        background: #dbeafe;
        color: #1e40af;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .resource-type.tutorial {
        background: #dcfce7;
        color: #166534;
    }

    .resource-type.research {
        background: #fef3c7;
        color: #92400e;
    }

    .resource-title {
        font-size: 20px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .resource-description {
        color: #6b7280;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .resource-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }

    .resource-author {
        font-size: 14px;
        color: #6b7280;
    }

    .resource-date {
        font-size: 14px;
        color: #9ca3af;
    }

    .resource-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }

    .resource-tag {
        padding: 4px 10px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        padding: 40px 0;
        border-bottom: 1px solid #e5e7eb;
        position: sticky;
        top: 70px;
        z-index: 50;
    }

    .filter-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .filter-tabs {
        display: flex;
        gap: 5px;
    }

    .filter-tab {
        padding: 10px 20px;
        background: none;
        border: 2px solid #e5e7eb;
        border-radius: 5px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #6b7280;
        margin-right: 5px;
    }

    .filter-tab.active {
        background: #032639;
        color: white;
        border-color: #032639;
    }

    .filter-tab:hover {
        border-color: #032639;
        color: #032639;
    }

    .filter-tab.active:hover {
        color: white;
    }

    .sort-dropdown {
        height: 45px;
        line-height: 18px;
        padding: 10px 16px;
        box-sizing: border-box;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        font-size: 14px;
        background: white;
        cursor: pointer;
        align-self: center;
    }




    .resource-download {
        margin-top: 5px;
        display: flex;
        justify-content: flex-start;
    }



    .download-icon {
        width: 25px;
        height: 25px;
        color: #333;
    }

    .download-btn {
        display: inline-flex;
        align-items: center;
        padding: 10px 16px;
        background: none;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .download-btn:hover {
        background-color: #e2e2e2;
    }



    /* Responsive Design */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 36px;
        }

        .hero p {
            font-size: 18px;
        }

        .nav-menu {
            display: none;
        }

        .search-input {
            width: 200px;
        }

        .filter-container {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-tabs {
            justify-content: center;
            flex-wrap: wrap;
        }

    }

    @media (max-width: 480px) {
        .hero h1 {
            font-size: 28px;
        }

        .section-title {
            font-size: 28px;
        }

        .category-card {
            padding: 30px 20px;
        }

        .resource-content {
            padding: 20px;
        }
    }

    /* Loading Animation */
    .loading {
        display: none;
        text-align: center;
        padding: 40px;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f4f6;
        border-top: 4px solid #032639;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 20px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>


<!-- Featured Resources -->
<section class="featured-section">
    <div class="section-container">
        <div class="section-header">
            <h2 class="section-title">Featured Resources</h2>
            <p class="section-subtitle">Hand-picked content from our editorial team</p>
        </div>
        @if ($resources->isEmpty())
            <div class="section-header">
                <h2 class="section-title">No Resources Found</h2>
            </div>
        @else
            <div class="resource-grid">
                @foreach ($resources as $resource)
                    <article class="resource-card">
                        <div class="resource-image">📱</div>
                        <div class="resource-content">
                            <span class="resource-type">{{ $resource->category }}</span>
                            <h3 class="resource-title">{{ $resource->title }}</h3>
                            <p class="resource-description">
                                {{ Str::limit($resource->description ?? 'No description provided.', 150) }}
                            </p>

                            {{-- Optional hardcoded tags (or dynamic if you add tagging later) --}}
                            <div class="resource-tags">
                                <span class="resource-tag">{{ $resource->tags }}</span>
                            </div>

                            @if ($resource->file_path)
                                <div class="resource-download">
                                    <a href="{{ asset('storage/' . $resource->file_path) }}" download
                                        title="Download Resource">
                                        <button class="download-btn">
                                            <svg class="download-icon" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                                                <path
                                                    d="M5 20h14v-2H5v2zm7-18v12.17l4.59-4.58L18 11l-6 6-6-6 1.41-1.41L11 14.17V2h2z" />
                                            </svg>
                                        </button>
                                    </a>
                                </div>
                            @endif



                            <div class="resource-meta">
                                @if ($resource->author)
                                    <span class="resource-author">By {{ $resource->author }}</span>
                                @endif
                                <span
                                    class="resource-date">{{ \Carbon\Carbon::parse($resource->created_at)->diffForHumans() }}</span>

                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif


        <!-- Loading Animation -->
        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>Loading more resources...</p>
        </div>
    </div>
</section>


<script>
    // Filter functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    const resourceCards = document.querySelectorAll('.resource-card');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            filterTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');

            const filter = this.dataset.filter;

            // Show loading
            document.getElementById('loading').style.display = 'block';

            // Simulate filtering delay
            setTimeout(() => {
                document.getElementById('loading').style.display = 'none';

                resourceCards.forEach(card => {
                    const resourceType = card.querySelector('.resource-type')
                        .textContent.toLowerCase();

                    if (filter === 'all' || resourceType === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }, 1000);
        });
    });

    // Search functionality
    const searchInputs = document.querySelectorAll('.search-input, .hero-search input');
    searchInputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch(this.value);
            }
        });
    });

    const searchButtons = document.querySelectorAll('.search-btn, .hero-search button');
    searchButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            performSearch(input.value);
        });
    });

    function performSearch(query) {
        if (query.trim()) {
            document.getElementById('loading').style.display = 'block';

            setTimeout(() => {
                document.getElementById('loading').style.display = 'none';
                alert(
                    `Searching for: "${query}"\n\nIn a real application, this would filter the resources based on your search query.`
                );
            }, 1500);
        }
    }

    // Sort functionality
    document.querySelector('.sort-dropdown').addEventListener('change', function() {
        document.getElementById('loading').style.display = 'block';

        setTimeout(() => {
            document.getElementById('loading').style.display = 'none';
            console.log(`Sorting by: ${this.value}`);
        }, 1000);
    });

    // Newsletter subscription
    document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('.newsletter-input').value;

        if (email) {
            alert(
                `Thank you for subscribing with email: ${email}\n\nYou'll receive our weekly newsletter with the latest resources!`
            );
            this.querySelector('.newsletter-input').value = '';
        }
    });

    // Category card interactions
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('click', function() {
            const categoryTitle = this.querySelector('.category-title').textContent;
            alert(
                `Exploring ${categoryTitle} resources...\n\nIn a real application, this would navigate to the category page.`
            );
        });
    });

    // Resource card interactions
    resourceCards.forEach(card => {
        card.addEventListener('click', function() {
            const title = this.querySelector('.resource-title').textContent;
            const type = this.querySelector('.resource-type').textContent;
            alert(
                `Opening ${type}: "${title}"\n\nIn a real application, this would open the full resource.`
            );
        });
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active class from all nav links
            document.querySelectorAll('.nav-menu a').forEach(l => l.classList.remove('active'));
            // Add active class to clicked link
            this.classList.add('active');

            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Infinite scroll simulation
    let isLoading = false;
    window.addEventListener('scroll', function() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 1000 && !isLoading) {
            isLoading = true;
            document.getElementById('loading').style.display = 'block';

            setTimeout(() => {
                document.getElementById('loading').style.display = 'none';
                isLoading = false;
                // In a real app, you would load more resources here
            }, 2000);
        }
    });

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        console.log('EduHub Resource Hub loaded successfully!');

        // Add hover effects to resource cards
        resourceCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>

@endsection
