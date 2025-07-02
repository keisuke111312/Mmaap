@extends('layouts.admin.master')
<script src="{{ asset('js/modal.js') }}"></script>

@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">Resources</h1>
                <button class="dashboard-btn"><i class="fab fa-github" style="font-size: 18px;"></i></i></button>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">
            <div class="controls-card">
                <div class="controls-content">
                    <div class="controls-left">
                        <div class="search-container">
                            <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"
                                    fill="none" />
                                <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" />
                            </svg>
                            <input type="text" id="search-input" placeholder="Search resources..." class="search-input">
                        </div>

                        <select id="category-filter" class="filter-select">
                            <option value="all">All Categories</option>
                            <option value="Article">Article</option>
                            <option value="Tutorial">Tutorial</option>
                            <option value="Research">Research</option>
                            <option value="Guide">Guide</option>
                            <option value="Case Study">Case Study</option>
                        </select>

                        <select id="status-filter" class="filter-select">
                            <option value="all">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <button class="add-btn" onclick="openModal('add-resources')">
                        Add Resource
                    </button>
                    {{-- <button onclick="openAddForm()">Open Form</button> --}}



                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <style>
        .admin-container {
            height: auto;
            min-height: 65vh;
            padding: 24px;
        }

        .admin-wrapper {

            max-width: 1480px;
            margin: 0 auto;
        }

        /* Header */
        .admin-header {
            margin-top: 50px;

            margin-bottom: 32px;
        }

        .admin-title {

            font-size: 30px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .admin-subtitle {
            color: #6b7280;
            font-size: 16px;
        }

        /* Stats Grid */
        .stats-grid {
            margin-top: 50px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .stat-content {
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-label {
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
        }

        .stat-value-green {
            color: #059669;
        }

        .stat-value-yellow {
            color: #d97706;
        }

        .stat-value-purple {
            color: #7c3aed;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon-blue {
            background: #dbeafe;
            color: #2563eb;
        }

        .stat-icon-green {
            background: #d1fae5;
            color: #059669;
        }

        .stat-icon-yellow {
            background: #fef3c7;
            color: #d97706;
        }

        .stat-icon-purple {
            background: #ede9fe;
            color: #7c3aed;
        }

        /* Controls */
        .controls-card {
            background: white;
            /* border-radius: 8px;
                                    border: 1px solid #e5e7eb; */
            padding: 24px;
        }

        .controls-content {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .controls-left {
            display: flex;
            flex-direction: column;
            gap: 16px;
            flex: 1;
        }

        .search-container {
            position: relative;
            flex: 1;
            max-width: 384px;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .search-input {
            width: 100%;
            padding: 10px 12px 10px 40px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            background: white;
        }

        .search-input:focus {
            outline: none;
            border-color: #032639;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .filter-select {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            background: white;
            width: 100%;
            max-width: 192px;
        }

        .filter-select:focus {
            outline: none;
            border-color: #032639;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .add-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: #032639;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            width: 100%;
        }

        .add-btn:hover {
            background: #032639;
        }

        /* Add Form */
        .add-form-card {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
        }

        .form-header {
            padding: 24px 24px 0;
        }

        .form-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .form-content {
            padding: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            background: white;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #032639;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-actions {
            display: flex;
            gap: 8px;
            padding-top: 16px;
        }

        .btn-primary {
            padding: 10px 16px;
            background: #032639;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background: #032639;
        }

        .btn-secondary {
            padding: 10px 16px;
            background: white;
            color: #374151;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-secondary:hover {
            background: #f9fafb;
        }

        /* Table */
        .table-card {
            background: white;
            /* border-radius: 8px; */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .table-header {
            padding: 24px 24px 0;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .table-content {
            padding: 24px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .resources-table {
            width: 100%;
            border-collapse: collapse;
        }

        .resources-table th {
            text-align: left;
            padding: 12px 16px;
            font-weight: 500;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .resources-table td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .resources-table tr:hover {
            background: #f9fafb;
        }

        .resource-title-cell {
            max-width: 300px;
        }

        .resource-title-text {
            font-weight: 500;
            color: #111827;
            margin-bottom: 4px;
        }

        .resource-description-text {
            font-size: 14px;
            color: #6b7280;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .badge-published {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-draft {
            background: #fef3c7;
            color: #92400e;
        }

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }

        .tag {
            display: inline-block;
            padding: 2px 6px;
            background: #f3f4f6;
            color: #374151;
            border-radius: 4px;
            font-size: 11px;
            border: 1px solid #e5e7eb;
        }

        .date-cell {
            color: #6b7280;
            font-size: 14px;
        }

        .actions-container {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 6px;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
            color: #6b7280;
            transition: all 0.2s;
        }

        .action-btn:hover {
            background: #f9fafb;
            color: #374151;
        }

        .action-btn-danger {
            color: #dc2626;
        }

        .action-btn-danger:hover {
            background: #fef2f2;
            border-color: #fecaca;
        }

        .no-results {
            text-align: center;
            padding: 48px 0;
        }

        .no-results-message {
            color: #6b7280;
            margin-bottom: 8px;
        }

        .no-results-subtitle {
            font-size: 14px;
            color: #9ca3af;
        }

        /* Responsive Design */
        @media (min-width: 640px) {
            .controls-content {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }

            .controls-left {
                flex-direction: row;
                max-width: none;
            }

            .add-btn {
                width: auto;
            }
        }

        @media (min-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 16px;
            }

            .admin-title {
                font-size: 24px;
            }

            .stat-content {
                padding: 16px;
            }

            .controls-card,
            .form-content,
            .table-content {
                padding: 16px;
            }

            .resources-table th,
            .resources-table td {
                padding: 8px;
                font-size: 14px;
            }

            .resource-title-cell {
                max-width: 200px;
            }

            .actions-container {
                flex-direction: column;
                gap: 4px;
            }
        }
    </style>

    <div class="admin-container">
        <div class="admin-wrapper">


            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-info">
                            <p class="stat-label">Total Resources</p>
                            <p class="stat-value" id="total-resources">3</p>
                        </div>
                        <div class="stat-icon stat-icon-blue">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 16L7 11L8.4 9.6L11 12.2V4H13V12.2L15.6 9.6L17 11L12 16Z" fill="currentColor" />
                                <path d="M5 20V18H19V20H5Z" fill="currentColor" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-info">
                            <p class="stat-label">Published</p>
                            <p class="stat-value stat-value-green" id="published-count">2</p>
                        </div>
                        <div class="stat-icon stat-icon-green">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor"
                                    stroke-width="2" fill="none" />
                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"
                                    fill="none" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-info">
                            <p class="stat-label">Drafts</p>
                            <p class="stat-value stat-value-yellow" id="draft-count">1</p>
                        </div>
                        <div class="stat-icon stat-icon-yellow">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="currentColor"
                                    stroke-width="2" fill="none" />
                                <path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2"
                                    fill="none" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-info">
                            <p class="stat-label">Categories</p>
                            <p class="stat-value stat-value-purple" id="category-count">3</p>
                        </div>
                        <div class="stat-icon stat-icon-purple">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3" stroke="currentColor"
                                    stroke-width="2" fill="none" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.admin.modal')

            <!-- Resources Table -->
            <div class="table-card">
                <div class="table-header">
                    <h3 class="table-title">Resources (<span id="resource-count">{{ $resources->total() }}</span>)</h3>

                </div>

                <div class="table-content">
                    <div class="table-wrapper">
                        <table class="resources-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="resources-tbody">
                                @foreach ($resources as $resource)
                                    <tr>
                                        <td>
                                            <div class="resource-title-cell">
                                                <div class="resource-title-text">{{ $resource->title }}</div>
                                                <div class="resource-description-text">{{ $resource->description }}</div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-secondary">{{ $resource->category }}</span></td>
                                        <td>{{ $resource->author }}</td>
                                        <td>
                                            <div class="tags-container">
                                                <span class="tag">{{ $resource->tags }}</span>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-published">published</span></td>
                                        <td class="date-cell">{{ $resource->created_at }}</td>
                                        <td>
                                            <div class="actions-container">
                                                <button class="action-btn" title="Toggle status">
                                                    <svg width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                                                            stroke="currentColor" stroke-width="2" />
                                                        <circle cx="12" cy="12" r="3" stroke="currentColor"
                                                            stroke-width="2" />
                                                    </svg>
                                                </button>
                                                <button class="action-btn" title="Edit resource">
                                                    <svg width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                                            stroke="currentColor" stroke-width="2" />
                                                        <path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"
                                                            stroke="currentColor" stroke-width="2" />
                                                    </svg>
                                                </button>
                                                <button class="action-btn action-btn-danger" onclick="deleteResource(1)"
                                                    title="Delete resource">
                                                    <svg width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none">
                                                        <polyline points="3,6 5,6 21,6" stroke="currentColor"
                                                            stroke-width="2" />
                                                        <path
                                                            d="m19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"
                                                            stroke="currentColor" stroke-width="2" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>

                        </table>
                        <script src="https://cdn.tailwindcss.com"></script>
                        <div style="display: block; margin-top:15px;">
                        {{ $resources->links('pagination::tailwind') }}


                        </div>



                        <div id="no-results" class="no-results" style="display: none;">
                            <div class="no-results-message">No resources found</div>
                            <div class="no-results-subtitle">Try adjusting your search or filters</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script>
    function triggerFileInput() {
        document.getElementById("file_path").click();
    }

    function removeFile() {
        document.querySelector(".chips").innerHTML = "";
        document.getElementById("file_path").value = "";
    }

    document.getElementById("file_path").addEventListener("change", function (event) {
        const file = event.target.files[0];
        const chipsContainer = document.querySelector(".chips");

        // Clear previous chip
        chipsContainer.innerHTML = "";

        if (file) {
            const chip = document.createElement("div");
            chip.classList.add("chip");
            chip.innerHTML = `
                <i class="fas fa-file-alt"></i> ${file.name}
                <span style="color: red; margin-left: 5px; cursor: pointer;" onclick="removeFile()">Remove</span>
            `;
            chipsContainer.appendChild(chip);
        }
    });
</script>
@endsection
