@extends('layouts.member.master')
@section('content')
@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">JOB BOARD</h1>
                <button class="dashboard-btn">GO TO DASHBOARD</button>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            <section class="job-search-section">
                <div class="search-container">
                    <form class="search-form" id="searchForm">
                        <div class="form-group">
                            <label for="keywords">Keywords</label>
                            <input type="text" id="keywords" class="form-control"
                                placeholder="Job title, skills, company...">
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select id="location" class="form-control">
                                <option value="">All Locations</option>
                                <option value="remote">Remote</option>
                                <option value="new-york">New York</option>
                                <option value="los-angeles">Los Angeles</option>
                                <option value="san-francisco">San Francisco</option>
                                <option value="london">London</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" class="form-control">
                                <option value="">All Categories</option>
                                <option value="graphic-design">Graphic Design</option>
                                <option value="video-production">Video Production</option>
                                <option value="animation">Animation</option>
                                <option value="web-design">Web Design</option>
                                <option value="photography">Photography</option>
                            </select>
                        </div>
                        <button type="submit" class="search-btn">Search Jobs</button>
                    </form>
                </div>
            </section>
        </div>
    </nav>
@endsection
<link rel="stylesheet" href="{{ asset('css/member/job.css') }}">

<section class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-number">{{ number_format($stats['active_jobs']) }}</div>
            <div class="stat-label">Active Job Listings</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ number_format($stats['freelance_projects']) }}</div>
            <div class="stat-label">Freelance Projects</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ number_format($stats['companies']) }}</div>
            <div class="stat-label">Creative Companies</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ number_format($stats['professionals']) }}+</div>
            <div class="stat-label">Creative Professionals</div>
        </div>
    </div>
</section>


<!-- Main Content -->
<main class="job-main-content">
    <!-- Sidebar Filters -->
    <aside class="sidebar">
        <h3>Filter Jobs</h3>
        <form id="filterForm" action="{{ route('jobs.filter') }}" method="POST">
            @foreach ($filters as $type => $items)
                <div class="filter-group">
                    <h4>{{ ucwords(str_replace('_', ' ', $type)) }}</h4>
                    <div class="filter-options">
                        @foreach ($items as $filter)
                            <div class="filter-option">
                                <input type="checkbox" class="filter-checkbox" name="{{ $type }}[]"
                                    id="{{ $type }}-{{ $filter->label }}" value="{{ $filter->label }}"
                                    {{ in_array($filter->label, request()->input($type, [])) ? 'checked' : '' }}>
                                <label for="{{ $type }}-{{ $filter->label }}">{{ $filter->label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </form>
    </aside>


    <!-- Job Listings -->
    <section class="job-listings" id="jobResults">
        @include('member.partials.job-listings', ['jobs' => $jobs])
    </section>

</main>

<!-- Loading Spinner -->
<div id="loading" style="display:none;text-align:center;padding:20px;">Loading...</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('CreativeJobs Job Board loaded successfully!');

        const filterForm = document.getElementById('filterForm');
        const jobResults = document.getElementById('jobResults');
        const loading = document.getElementById('loading');

        // 🔁 Attach change event to the whole form (any checkbox triggers it)
        filterForm.addEventListener('change', function(e) {
            e.preventDefault();
            loading.style.display = 'block';

            const filterData = {};
            const checkboxes = filterForm.querySelectorAll('input[type="checkbox"]:checked');

            checkboxes.forEach(cb => {
                const name = cb.name.replace('[]', '');
                if (!filterData[name]) filterData[name] = [];
                filterData[name].push(cb.value);
            });

            fetch(filterForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        filters: filterData
                    })
                })
                .then(response => response.text())
                .then(html => {
                    jobResults.innerHTML = html;
                    loading.style.display = 'none';
                })
                .catch(err => {
                    console.error(err);
                    alert('Failed to load jobs. Please try again.');
                    loading.style.display = 'none';
                });
        });

        // Hover effects
        function setupCardHover() {
            document.querySelectorAll('.job-card').forEach(card => {
                card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-4px)');
                card.addEventListener('mouseleave', () => card.style.transform = 'translateY(0)');
            });
        }

        setupCardHover();

        // Re-run hover effects after AJAX load
        const observer = new MutationObserver(setupCardHover);
        observer.observe(jobResults, {
            childList: true,
            subtree: true
        });
    });
</script>

{{-- <script>
    // Search functionality
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const keywords = document.getElementById('keywords').value;
        const location = document.getElementById('location').value;
        const category = document.getElementById('category').value;

        // Show loading
        document.getElementById('loading').style.display = 'block';

        // Simulate search delay
        setTimeout(() => {
            document.getElementById('loading').style.display = 'none';
            alert(
                `Searching for: ${keywords || 'All jobs'} in ${location || 'All locations'} - ${category || 'All categories'}`
            );
        }, 1500);
    });

    // Filter functionality
    const filterCheckboxes = document.querySelectorAll('input[type="checkbox"]');
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Simulate filtering
            console.log(`Filter ${this.id} is now ${this.checked ? 'enabled' : 'disabled'}`);
            updateJobCount();
        });
    });

    // Sort functionality
    document.querySelector('.sort-dropdown').addEventListener('change', function() {
        console.log(`Sorting by: ${this.value}`);
        // Simulate sorting
        document.getElementById('loading').style.display = 'block';
        setTimeout(() => {
            document.getElementById('loading').style.display = 'none';
        }, 1000);
    });

    // Apply button functionality
    const applyButtons = document.querySelectorAll('.apply-btn');
    applyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const jobCard = this.closest('.job-card');
            const jobTitle = jobCard.querySelector('.job-title').textContent;
            const company = jobCard.querySelector('.job-company').textContent;

            alert(
                `Applying for ${jobTitle} at ${company}!\n\nIn a real application, this would redirect to the application form.`
            );
        });
    });

    // Update job count based on filters
    function updateJobCount() {


        document.querySelector('.listings-count').textContent = `Showing ${count.toLocaleString()} jobs`;
    }

    // Infinite scroll simulation
    let isLoading = false;
    window.addEventListener('scroll', function() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 1000 && !isLoading) {
            isLoading = true;
            document.getElementById('loading').style.display = 'block';

            setTimeout(() => {
                document.getElementById('loading').style.display = 'none';
                isLoading = false;
                // In a real app, you would load more job cards here
            }, 2000);
        }
    });

    // Mobile menu toggle (for responsive design)
    function toggleMobileMenu() {
        const navMenu = document.querySelector('.nav-menu');
        navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        console.log('CreativeJobs Job Board loaded successfully!');

        // Add some interactive hover effects
        const jobCards = document.querySelectorAll('.job-card');
        jobCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Filter AJAX
        const filterForm = document.getElementById('filterForm');
        const jobListings = document.querySelector('.job-listings');
        const loading = document.getElementById('loading');

        filterForm.addEventListener('change', function(e) {
            e.preventDefault();
            loading.style.display = 'block';
            const formData = new FormData(filterForm);
            const params = new URLSearchParams(formData).toString();
            fetch(filterForm.action + '?' + params, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Parse the returned HTML and replace the job listings section
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newJobListings = doc.querySelector('.job-listings');
                if (newJobListings) {
                    jobListings.innerHTML = newJobListings.innerHTML;
                }
                loading.style.display = 'none';
            })
            .catch(() => {
                loading.style.display = 'none';
                alert('Failed to load jobs. Please try again.');
            });
        });
    });
</script> --}}
@endsection
