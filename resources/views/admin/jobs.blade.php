@extends('layouts.admin.master')
@section('ribbon')
    <script src="{{ asset('js/modal.js') }}"></script>

    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            {{-- <div class="page-header">
                <div class="header-left">
                    <h2>Job Listings</h2>
                    <p>Manage and monitor all job postings</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary" onclick="window.location.href='#'">
                        <span class="btn-icon">+</span>
                        Add New Job
                    </button>
                </div>
            </div> --}}
            <div class="content-header">

                <h1>Job Listings</h1>
                <button class="dashboard-btn" onclick="openModal('add-job')">CREATE JOB</button>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->

    <nav class="tab-nav">
        <div class="tab-container">

            <!-- Filters and Search -->
            <div class="filters-section">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search jobs, companies, locations..."
                        class="search-input">
                    <button class="search-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                </div>

                <div class="filter-controls">
                    <select id="typeFilter" class="filter-select">
                        <option value="">All Types</option>
                        <option value="full-time">Full-time</option>
                        <option value="part-time">Part-time</option>
                        <option value="contract">Contract</option>
                        <option value="freelance">Freelance</option>
                    </select>

                    <select id="featuredFilter" class="filter-select">
                        <option value="">All Jobs</option>
                        <option value="featured">Featured Only</option>
                        <option value="regular">Regular Only</option>
                    </select>

                    <button class="filter-btn" onclick="clearFilters()">Clear Filters</button>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <style>
        /* Reset and Base Styles */

        /* Main Content */
        .admin-main {
            flex: 1;
            padding: 2rem;
            position: relative;
        }

        .admin-main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }


        /* Filters Section */
        .filters-section {
            padding: 1.5rem;
            display: flex;
            gap: 1.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid #e2e8f0;
            font-size: 1rem;
            transition: all 0.3s;
            background: white;
        }

        .search-input:focus {
            outline: none;
            border-color: #032639;
            box-shadow: 0 0 0 4px rgba(3, 38, 57, 0.1);
        }

        .search-btn {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 0.5rem;
        }

        .filter-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .filter-select {
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            background: white;
            cursor: pointer;
            font-size: 0.875rem;
            min-width: 140px;
        }

        .filter-btn {
            padding: 0.75rem 1rem;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            transition: all 0.2s;
        }

        .filter-btn:hover {
            background: #f1f5f9;
            border-color: #cbd5e0;
        }

        /* Stats Grid */
        .stats-grid {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #032639, #064663);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #032639, #064663);

        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #032639, #064663);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #032639, #064663);
        }

        .stat-content h3 {
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #1a202c;
            margin: 0;
        }

        /* Table Container */
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .table-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
        }

        .table-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-secondary {
            padding: 0.5rem 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
        }

        /* Table Styles */
        .table-wrapper {
            overflow-x: auto;
        }

        .jobs-table {
            width: 100%;
            border-collapse: collapse;
        }

        .jobs-table th {
            background: #f8fafc;
            padding: 1rem 1.5rem;
            text-align: left;
            font-weight: 700;
            font-size: 0.875rem;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
        }

        .jobs-table td {
            padding: 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }

        .job-row {
            transition: background-color 0.2s;
        }

        .job-row:hover {
            background-color: rgba(102, 126, 234, 0.02);
        }

        /* Job Details */
        .job-details {
            max-width: 300px;
        }

        .job-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.25rem;
        }

        .job-location {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .job-description {
            font-size: 0.8125rem;
            color: #718096;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Company Info */
        .company-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .company-logo {
            background: linear-gradient(135deg, #032639, #064663);
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.875rem;
        }

        .company-name {
            font-weight: 600;
            color: #1a202c;
        }

        /* Job Type Badges */
        .job-type {
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .job-type.full-time {
            background: #dcfce7;
            color: #166534;
        }

        .job-type.part-time {
            background: #fef3c7;
            color: #92400e;
        }

        .job-type.contract {
            background: #dbeafe;
            color: #1e40af;
        }

        .job-type.freelance {
            background: #fce7f3;
            color: #be185d;
        }

        /* Salary Info */
        .salary-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .salary-range {
            font-weight: 700;
            color: #1a202c;
        }

        .salary-unit {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .status-badge.active {
            background: #dcfce7;
            color: #166534;
        }

        .status-badge.featured {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
            box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
        }

        /* Date Info */
        .date-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .date {
            font-weight: 600;
            color: #1a202c;
            font-size: 0.875rem;
        }

        .time-ago {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            width: 2rem;
            height: 2rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .action-btn.view {
            background: rgba(3, 38, 57, 0.1);
            color: #032639;
        }

        .action-btn.view:hover {
            background: rgba(3, 38, 57, 0.2);
            transform: scale(1.1);
        }

        .action-btn.edit {
            background: #f0fdf4;
            color: #166534;
        }

        .action-btn.edit:hover {
            background: #dcfce7;
            transform: scale(1.1);
        }

        .action-btn.delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .action-btn.delete:hover {
            background: #fee2e2;
            transform: scale(1.1);
        }

        /* Checkbox Styles */
        .checkbox {
            width: 1.125rem;
            height: 1.125rem;
            border: 2px solid #cbd5e0;
            border-radius: 4px;
            cursor: pointer;
            appearance: none;
            background: white;
            position: relative;
            transition: all 0.2s;
        }

        .checkbox:checked {
            background: linear-gradient(135deg, #032639, #064663);
            border-color: #032639;
        }

        .checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .pagination-info {
            color: #64748b;
            font-size: 0.875rem;
        }

        .pagination {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .pagination-btn {
            padding: 0.5rem 0.75rem;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .pagination-btn:hover:not(:disabled) {
            background: #f8fafc;
            border-color: #cbd5e0;
        }

        .pagination-btn.active {
            background: linear-gradient(135deg, #032639, #064663);
            color: white;
            border-color: #032639;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-dots {
            color: #cbd5e0;
            font-weight: bold;
            padding: 0 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .content-wrapper {
                max-width: 100%;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .admin-main {
                padding: 1rem;
            }

            .header-content {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .filters-section {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-controls {
                flex-wrap: wrap;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table-header {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .jobs-table th,
            .jobs-table td {
                padding: 0.75rem;
            }

            .job-details {
                max-width: none;
            }

            .pagination-container {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card,
        .table-container,
        .filters-section {
            animation: fadeInUp 0.6s ease-out;
        }

        .job-row {
            animation: fadeInUp 0.4s ease-out;
            animation-fill-mode: both;
        }

        .job-row:nth-child(1) {
            animation-delay: 0.1s;
        }

        .job-row:nth-child(2) {
            animation-delay: 0.2s;
        }

        .job-row:nth-child(3) {
            animation-delay: 0.3s;
        }

        .job-row:nth-child(4) {
            animation-delay: 0.4s;
        }

        .job-row:nth-child(5) {
            animation-delay: 0.5s;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: white;
            color: #4a5568;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #032639;
            background: white;
            box-shadow:
                0 0 0 4px rgba(3, 38, 57, 0.1),
                0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Radio Button Styles */
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            font-size: 0.875rem;
            color: #4a5568;
        }

        .radio-label input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-custom {
            width: 1rem;
            height: 1rem;
            border: 2px solid #cbd5e0;
            border-radius: 50%;
            background: white;
            transition: all 0.3s;
        }

        .radio-label input[type="radio"]:checked+.radio-custom {
            border-color: #032639;
            background: linear-gradient(135deg, #032639, #064663);
            box-shadow: 0 4px 12px rgba(3, 38, 57, 0.4);
            transform: scale(1.1);
        }

        /* Checkbox Styles */
        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            font-size: 0.875rem;
            color: #4a5568;
        }

        .checkbox-label input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checkbox-custom {
            width: 1rem;
            height: 1rem;
            border: 2px solid #cbd5e0;
            border-radius: 4px;
            background: white;
            transition: all 0.3s;
        }

        .checkbox-label input[type="checkbox"]:checked+.checkbox-custom {
            background: linear-gradient(135deg, #032639, #064663);
            border-color: #032639;
            box-shadow: 0 4px 12px rgba(3, 38, 57, 0.4);
            transform: scale(1.05);
        }
    </style>
    @include('components/admin/job-modal')
    <div class="admin-container">
        <!-- Header -->
        {{-- <header class="admin-header">
            <div class="header-content">
                <h1>Job Listing Admin</h1>
                <nav class="admin-nav">
                    <a href="#" class="nav-link">Create Job</a>
                    <a href="#" class="nav-link active">All Jobs</a>
                    <a href="#" class="nav-link">Settings</a>
                </nav>
            </div>
        </header> --}}

        <!-- Main Content -->
        <main class="admin-main">
            <div class="content-wrapper">
                <!-- Page Header -->


                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                <line x1="8" y1="21" x2="16" y2="21"></line>
                                <line x1="12" y1="17" x2="12" y2="21"></line>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3>Total Jobs</h3>
                            <p class="stat-number">247</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon green">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"></polyline>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3>Active Jobs</h3>
                            <p class="stat-number">189</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polygon
                                    points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26">
                                </polygon>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3>Featured Jobs</h3>
                            <p class="stat-number">23</p>
                        </div>
                    </div>

                    {{-- <div class="stat-card">
                        <div class="stat-icon orange">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3>Applications</h3>
                            <p class="stat-number">1,429</p>
                        </div>
                    </div> --}}
                </div>

                <!-- Jobs Table -->
                <div class="table-container">
                    <div class="table-header">
                        <h3>All Job Listings</h3>
                        {{-- <div class="table-actions">
                            <button class="btn btn-secondary btn-sm">Export CSV</button>
                            <button class="btn btn-secondary btn-sm">Bulk Actions</button>
                        </div> --}}
                    </div>

                    <div class="table-wrapper">
                        <table class="jobs-table" id="jobsTable">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAll" class="checkbox">
                                    </th>
                                    <th>Job Details</th>
                                    <th>Company</th>
                                    <th>Type</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Posted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Job Row 1 -->
                                {{-- <tr class="job-row" data-type="full-time" data-featured="true">
                                    <td>
                                        <input type="checkbox" class="checkbox row-checkbox">
                                    </td>
                                    <td>
                                        <div class="job-details">
                                            <h4 class="job-title">Senior Frontend Developer</h4>
                                            <p class="job-location">San Francisco, CA</p>
                                            <p class="job-description">Build scalable web applications using React and
                                                TypeScript...</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="company-info">
                                            <div class="company-logo">TC</div>
                                            <span class="company-name">TechCorp Inc.</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="job-type full-time">Full-time</span>
                                    </td>
                                    <td>
                                        <div class="salary-info">
                                            <span class="salary-range">$120K - $160K</span>
                                            <span class="salary-unit">annual</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge featured">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                                <polygon
                                                    points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26">
                                                </polygon>
                                            </svg>
                                            Featured
                                        </span>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <span class="date">Dec 15, 2024</span>
                                            <span class="time-ago">2 days ago</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" title="View">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </button>
                                            <button class="action-btn edit" title="Edit">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button class="action-btn delete" title="Delete">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <polyline points="3,6 5,6 21,6"></polyline>
                                                    <path
                                                        d="M19,6v14a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6m3,0V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr> --}}
                                @foreach ($jobs as $job)
                                    <tr class="job-row" data-type="{{ $job->type }}"
                                        data-featured="{{ $job->is_featured ? 'true' : 'false' }}">
                                        <td>
                                            <input type="checkbox" class="checkbox row-checkbox">
                                        </td>
                                        <td>
                                            <div class="job-details">
                                                <h4 class="job-title">{{ $job->title }}</h4>
                                                <p class="job-location">{{ $job->location }}</p>
                                                <p class="job-description">{{ Str::limit($job->description, 80) }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="company-info">
                                                <div class="company-logo">
                                                    {{ strtoupper(substr($job->company_name, 0, 2)) }}</div>
                                                <span class="company-name">{{ $job->company_name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="job-type {{ strtolower($job->type) }}">{{ ucfirst($job->type) }}</span>
                                        </td>
                                        <td>
                                            <div class="salary-info">
                                                <span class="salary-range">₱{{ $job->salary_min }} -
                                                    ₱{{ $job->salary_min }}</span>
                                                <span class="salary-unit">{{ $job->salary_unit }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($job->is_featured)
                                                <span class="status-badge featured">
                                                    <svg width="12" height="12" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <polygon
                                                            points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26">
                                                        </polygon>
                                                    </svg>
                                                    Featured
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="date-info">
                                                <span
                                                    class="date">{{ \Carbon\Carbon::parse($job->posted_at)->format('M d, Y') }}</span>
                                                <span
                                                    class="time-ago">{{ \Carbon\Carbon::parse($job->posted_at)->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn view" title="View">
                                                    <!-- View SVG -->
                                                </button>
                                                <button class="action-btn edit" title="Edit">
                                                    <!-- Edit SVG -->
                                                </button>
                                                <button class="action-btn delete" title="Delete">
                                                    <!-- Delete SVG -->
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <script src="https://cdn.tailwindcss.com"></script>
                    {{ $jobs->links('pagination::tailwind') }}
                </div>
                
            </div>
        </main>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.job-row');

            rows.forEach(row => {
                const jobTitle = row.querySelector('.job-title').textContent.toLowerCase();
                const companyName = row.querySelector('.company-name').textContent.toLowerCase();
                const location = row.querySelector('.job-location').textContent.toLowerCase();
                const description = row.querySelector('.job-description').textContent.toLowerCase();

                if (jobTitle.includes(searchTerm) ||
                    companyName.includes(searchTerm) ||
                    location.includes(searchTerm) ||
                    description.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filter functionality
        document.getElementById('typeFilter').addEventListener('change', filterJobs);
        document.getElementById('featuredFilter').addEventListener('change', filterJobs);

        function filterJobs() {
            const typeFilter = document.getElementById('typeFilter').value;
            const featuredFilter = document.getElementById('featuredFilter').value;
            const rows = document.querySelectorAll('.job-row');

            rows.forEach(row => {
                let showRow = true;

                if (typeFilter && row.dataset.type !== typeFilter) {
                    showRow = false;
                }

                if (featuredFilter === 'featured' && row.dataset.featured !== 'true') {
                    showRow = false;
                } else if (featuredFilter === 'regular' && row.dataset.featured === 'true') {
                    showRow = false;
                }

                row.style.display = showRow ? '' : 'none';
            });
        }

        function clearFilters() {
            document.getElementById('typeFilter').value = '';
            document.getElementById('featuredFilter').value = '';
            document.getElementById('searchInput').value = '';

            const rows = document.querySelectorAll('.job-row');
            rows.forEach(row => {
                row.style.display = '';
            });
        }

        // Select all functionality
        document.getElementById('selectAll').addEventListener('change', function(e) {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });

        // Action button handlers
        document.querySelectorAll('.action-btn.view').forEach(btn => {
            btn.addEventListener('click', function() {
                alert('View job details');
            });
        });

        document.querySelectorAll('.action-btn.edit').forEach(btn => {
            btn.addEventListener('click', function() {
                alert('Edit job');
            });
        });

        document.querySelectorAll('.action-btn.delete').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this job?')) {
                    this.closest('.job-row').remove();
                }
            });
        });
    </script>
@endsection
