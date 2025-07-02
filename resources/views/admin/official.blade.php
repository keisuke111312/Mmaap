@extends('layouts.admin.master')

@section('ribbon')
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <script src="{{ asset('js/modal.js') }}"></script>

    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">USER MANAGEMENT</h1>
                <button onclick="openModal('add-official')" class="dashboard-btn" style="text-decoration: none;">ADD OFFICIAL</button>
            </div>
        </div>
    </section>

    <nav class="tab-nav">
        <div class="tab-container">
            <ul class="tab-items">
                <li class="tab-item">
                    <button class="tab-link" onclick="switchTab('manage')" data-tab="calendar"
                        style="background: none; border: none;">
                        <span class="tab-indicator"></span>
                        OFFICIALS
                    </button>
                </li>
                <li class="tab-item">
                    <button class="tab-link" onclick="switchTab('history')" data-tab="event"
                        style="background: none; border: none;  #ef4444 1px solid;">
                        <span class="tab-indicator"></span>
                        HISTORY
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Tab Navigation -->
    {{-- <nav class="tab-nav">
        <div class="tab-container">
            <div class="tabs">
                <button class="tab-link active" onclick="switchTab('manage')">MANAGE OFFICIALS</button>
                <button cclass="tab-link" onclick="switchTab('history')">HISTORY</button>
            </div>
        </div>
    </nav> --}}
@endsection

@section('content')
    <style>
        body {
            font-family: "Montserrat", "Segoe UI", Arial, sans-serif;
        }

        .container {
            max-width: 1500px;
            margin: 0 auto;
            margin-top: 30px;
            /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); */
            overflow: hidden;
            height: 65vh;
        }

        .tabs {
            display: flex;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }


        .tab-content {
            display: none;
            padding: 40px;
        }

        .tab-content.active {
            display: block;
        }

        .form-section {
            background: #f8fafc;
            padding: 30px;
            /* border-radius: 12px; */
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
        }

        .form-section h3 {
            color: #1e293b;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 600;
            width: 1200px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #032639;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .image-upload {
            position: relative;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: white;
        }

        .image-upload:hover {
            border-color: #032639;
            background: #f8fafc;
        }

        .image-upload.has-image {
            border-style: solid;
            border-color: #032639;
        }

        .image-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .image-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 10px;
            display: none;
        }

        .image-upload-text {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #032639;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .officials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .official-card {
            background: white;
            /* border-radius: 16px; */
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .official-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .official-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #032639;
        }

        .official-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            display: block;
            border: 3px solid #e2e8f0;
            background: #f1f5f9;
        }

        .official-avatar.placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #9ca3af;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }

        .official-info {
            text-align: center;
        }

        .official-info h4 {
            color: #1e293b;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .official-position {
            color: #032639;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .official-department {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .official-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
        }

        .official-date {
            color: #64748b;
            font-size: 0.85rem;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-active {
            background: #032639;
            color: #FFF;
        }

        .status-inactive {
            background: #fef2f2;
            color: #991b1b;
        }

        .status-completed {
            background: #e0e7ff;
            color: #3730a3;
        }

        .contact-info {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 5px;
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .filter-section {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-left: 40px;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
            grid-column: 1 / -1;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            color: #1e293b;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .officials-count {
            background: #032639;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 8px;
            }

            .header {
                padding: 20px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .tab-content {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .officials-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .official-meta {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }
    </style>

    <div class="container">
        {{-- <div class="header">
            <h1>Officials Administration</h1>
            <p>Academic Year 2025-2026</p>
        </div> --}}


        <div id="manage" class="tab-content active">
            <div id="add-official" class="modal-overlay hidden">
                <div class="form-section">
                    <h3>Add New Official</h3>
                    <form action="{{ route('officials.store') }}" method="POST" id="officialForm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="position">Title *</label>
                                <select name="title_abbreviation" id="title" class="w-full border rounded px-3 py-2">
                                    <option value="">-- Select Title --</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Engr.">Engr.</option>
                                    <option value="Prof.">Prof.</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="firstName">Full Name *</label>
                                <input type="text" id="firstName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="position">Position *</label>
                                <select name="position_id" id="position_id" class="w-full border rounded px-3 py-2"
                                    required>
                                    <option value="">-- Select Position --</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Affiliation / School </label>
                                <input type="text" name="bio" placeholder="ex. Gordon College">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="term_id" class="block font-semibold">Term</label>

                                <select name="term_id" id="term_id" class="w-full border rounded px-3 py-2" required>
                                    <option value="">-- Select Term --</option>
                                    @foreach ($terms as $term)
                                        <option value="{{ $term->id }}">
                                            {{ $term->year_start }}–{{ $term->year_end }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="photo">Profile Photo</label>
                            <div class="image-upload" id="imageUpload">
                                <input type="file" id="photo" name="photo_url" accept="image/*"
                                    onchange="previewImage(this)">
                                <img class="image-preview" id="imagePreview" alt="Preview">
                                <div class="image-upload-text" id="uploadText">
                                    📷 Click to upload profile photo<br>
                                    <small>JPG, PNG or GIF (Max 5MB)</small>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea id="notes" name="notes" placeholder="Additional information about the official..."></textarea>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">
                            <span>➕</span> Add Official
                        </button>
                    </form>
                </div>
            </div>


            <div class="section-header">
                <h3 class="section-title">Current Officials</h3>
                <span class="officials-count" id="currentCount">4 Officials</span>
            </div>

            <div class="officials-grid" id="officialsList">

                @if ($currentTerm)
                    @foreach ($officials as $official)
                        <div class="official-card">
                            @if ($official->photo_url)
                                <img src="{{ $official->photo_url }}" alt="{{ $official->name }}"
                                    class="official-avatar">
                            @else
                                <div class="official-avatar">
                                    <i class="fas fa-user"></i>

                                </div>
                            @endif
                            <div class="official-info">
                                <h4>{{ $official->name }}</h4>
                                <div class="official-position">{{ $official->position->title }}</div>
                                <div class="official-department">{{ $official->bio }}</div>
                                <div class="contact-info">
                                    <div class="contact-item">
                                        <span>📧</span> john.smith@university.edu
                                    </div>
                                    <div class="contact-item">
                                        <span>📱</span> (555) 123-4567
                                    </div>
                                </div>
                            </div>
                            <div class="official-meta">
                                <div class="official-date">Started: Jan 15, 2025</div>
                                <span class="status-badge status-active">Active</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No current term officials found.</p>
                @endif
            </div>
        </div>

        <div id="history" class="tab-content">
            <div class="filter-section">
                <div class="filter-grid">
                    <div class="form-group">
                        <label for="termFilter">Academic Term</label>
                        <select id="termFilter" onchange="filterHistory()">
                            <option value="">All Terms</option>
                            <option value="2025-2026" selected>2025-2026</option>
                            <option value="2024-2025">2024-2025</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2022-2023">2022-2023</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="positionFilter">Position</label>
                        <select id="positionFilter" onchange="filterHistory()">
                            <option value="">All Positions</option>
                            <option value="President">President</option>
                            <option value="Vice President">Vice President</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Treasurer">Treasurer</option>
                            <option value="Auditor">Auditor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statusFilter">Status</label>
                        <select id="statusFilter" onchange="filterHistory()">
                            <option value="">All Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Completed">Term Completed</option>
                        </select>
                    </div>
                    <div class="form-group search-box">
                        <label for="searchFilter">Search</label>
                        <input type="text" id="searchFilter" placeholder="Search by name..."
                            oninput="filterHistory()">
                        <span class="search-icon">🔍</span>
                    </div>
                </div>
            </div>

            <div class="section-header">
                <h3 class="section-title">Officials History</h3>
                <span class="officials-count" id="historyCount">6 Records</span>
            </div>

            <div class="officials-grid" id="historyList">
                <div class="official-card" data-term="2025-2026" data-position="President" data-status="Active"
                    data-name="john smith">
                    <img src="/placeholder.svg?height=80&width=80" alt="John Smith" class="official-avatar">
                    <div class="official-info">
                        <h4>John Smith</h4>
                        <div class="official-position">President</div>
                        <div class="official-department">Computer Science • 2025-2026</div>
                    </div>
                    <div class="official-meta">
                        <div class="official-date">Jan 15, 2025 - Present</div>
                        <span class="status-badge status-active">Active</span>
                    </div>
                </div>

                <div class="official-card" data-term="2025-2026" data-position="Vice President" data-status="Active"
                    data-name="sarah johnson">
                    <img src="/placeholder.svg?height=80&width=80" alt="Sarah Johnson" class="official-avatar">
                    <div class="official-info">
                        <h4>Sarah Johnson</h4>
                        <div class="official-position">Vice President</div>
                        <div class="official-department">Business Administration • 2025-2026</div>
                    </div>
                    <div class="official-meta">
                        <div class="official-date">Jan 15, 2025 - Present</div>
                        <span class="status-badge status-active">Active</span>
                    </div>
                </div>

                <div class="official-card" data-term="2024-2025" data-position="President" data-status="Completed"
                    data-name="david wilson">
                    <img src="/placeholder.svg?height=80&width=80" alt="David Wilson" class="official-avatar">
                    <div class="official-info">
                        <h4>David Wilson</h4>
                        <div class="official-position">President</div>
                        <div class="official-department">Engineering • 2024-2025</div>
                    </div>
                    <div class="official-meta">
                        <div class="official-date">Aug 15, 2024 - Dec 31, 2024</div>
                        <span class="status-badge status-completed">Term Completed</span>
                    </div>
                </div>

                <div class="official-card" data-term="2024-2025" data-position="Secretary" data-status="Completed"
                    data-name="lisa garcia">
                    <div class="official-avatar placeholder">👤</div>
                    <div class="official-info">
                        <h4>Lisa Garcia</h4>
                        <div class="official-position">Secretary</div>
                        <div class="official-department">Liberal Arts • 2024-2025</div>
                    </div>
                    <div class="official-meta">
                        <div class="official-date">Aug 15, 2024 - Dec 31, 2024</div>
                        <span class="status-badge status-completed">Term Completed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.remove('active'));

            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));

            // Show selected tab content
            document.getElementById(tabName).classList.add('active');

            // Add active class to clicked tab
            event.target.classList.add('active');
        }

        function previewImage(input) {
            const file = input.files[0];
            const preview = document.getElementById('imagePreview');
            const uploadText = document.getElementById('uploadText');
            const uploadContainer = document.getElementById('imageUpload');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    uploadText.style.display = 'none';
                    uploadContainer.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                uploadText.style.display = 'block';
                uploadContainer.classList.remove('has-image');
            }
        }

        function filterHistory() {
            const termFilter = document.getElementById('termFilter').value.toLowerCase();
            const positionFilter = document.getElementById('positionFilter').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const searchFilter = document.getElementById('searchFilter').value.toLowerCase();

            const cards = document.querySelectorAll('#historyList .official-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const term = card.dataset.term.toLowerCase();
                const position = card.dataset.position.toLowerCase();
                const status = card.dataset.status.toLowerCase();
                const name = card.dataset.name.toLowerCase();

                const matchesTerm = !termFilter || term.includes(termFilter);
                const matchesPosition = !positionFilter || position.includes(positionFilter);
                const matchesStatus = !statusFilter || status.includes(statusFilter);
                const matchesSearch = !searchFilter || name.includes(searchFilter);

                if (matchesTerm && matchesPosition && matchesStatus && matchesSearch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update count
            document.getElementById('historyCount').textContent = `${visibleCount} Records`;

            // Show empty state if no results
            const historyList = document.getElementById('historyList');
            const existingEmptyState = historyList.querySelector('.empty-state');

            if (visibleCount === 0 && !existingEmptyState) {
                const emptyState = document.createElement('div');
                emptyState.className = 'empty-state';
                emptyState.innerHTML = `
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <h3>No officials found</h3>
                    <p>Try adjusting your filters to see more results.</p>
                `;
                historyList.appendChild(emptyState);
            } else if (visibleCount > 0 && existingEmptyState) {
                existingEmptyState.remove();
            }
        }

        // Handle form submission


        // Initialize with current term filter
        document.addEventListener('DOMContentLoaded', function() {
            filterHistory();
        });
    </script>

    <script>
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background: ${type === 'success' ? '#28a745' : '#dc3545'};
            color: white;
            border-radius: 4px;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        `;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>

    <script>
        @if (session('success'))
            showNotification("{{ session('success') }}", 'success');
        @endif

        @if (session('error'))
            showNotification("{{ session('error') }}", 'error');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showNotification("{{ $error }}", 'error');
            @endforeach
        @endif
    </script>
@endsection
