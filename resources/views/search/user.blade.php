<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users - Find Professionals</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Section */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .header-subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 16px;
        }

        /* Search Section */
        .search-section {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .search-container {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 16px 50px 16px 20px;
            border: 2px solid #e9ecef;
            border-radius: 50px;
            font-size: 16px;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .search-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1), 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }

        /* Filters */
        .filters {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            background: white;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 120px;
        }

        .filter-select:focus {
            outline: none;
            border-color: #007bff;
        }

        /* Results Section */
        .results-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .results-count {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .view-toggle {
            display: flex;
            background: #f8f9fa;
            border-radius: 25px;
            padding: 4px;
        }

        .view-btn {
            padding: 8px 16px;
            border: none;
            background: transparent;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .view-btn.active {
            background: #007bff;
            color: white;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        }

        /* User Grid */
        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .user-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .user-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #007bff, #28a745, #ffc107, #dc3545);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .user-card:hover::before {
            transform: scaleX(1);
        }

        .user-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
            position: relative;
            border: 3px solid #f8f9fa;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .status-dot {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .status-dot.online { background: #28a745; }
        .status-dot.away { background: #ffc107; }
        .status-dot.offline { background: #6c757d; }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .verification-badge {
            width: 18px;
            height: 18px;
            background: #1da1f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            font-weight: bold;
        }

        .user-title {
            color: #666;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .user-company {
            color: #007bff;
            font-size: 13px;
            font-weight: 500;
        }

        .user-stats {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat {
            text-align: center;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .stat-value {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .stat-value.projects { color: #007bff; }
        .stat-value.rating { color: #ffc107; }
        .stat-value.reviews { color: #28a745; }

        .stat-label {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .user-skills {
            margin-bottom: 20px;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .skill-tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .user-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            color: #007bff;
            border: 1px solid #007bff;
        }

        .btn-outline:hover {
            background: #007bff;
            color: white;
        }

        /* List View */
        .users-list {
            display: none;
        }

        .users-list.active {
            display: block;
        }

        .user-list-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
        }

        .user-list-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transform: translateX(5px);
        }

        .list-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            position: relative;
        }

        .list-info {
            flex: 1;
        }

        .list-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .list-details {
            color: #666;
            font-size: 14px;
        }

        .list-stats {
            display: flex;
            gap: 20px;
            margin-right: 20px;
        }

        .list-stat {
            text-align: center;
        }

        .list-stat-value {
            font-weight: 600;
            font-size: 14px;
        }

        .list-stat-label {
            font-size: 11px;
            color: #666;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
        }

        .page-btn {
            padding: 8px 12px;
            border: 1px solid #e9ecef;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .page-btn:hover,
        .page-btn.active {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        /* Loading State */
        .loading {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .search-section {
                flex-direction: column;
            }

            .filters {
                justify-content: center;
            }

            .users-grid {
                grid-template-columns: 1fr;
            }

            .results-header {
                flex-direction: column;
                align-items: stretch;
            }

            .user-list-item {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .list-stats {
                justify-content: center;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="header-title">Find Professionals</h1>
            <p class="header-subtitle">Discover talented professionals and connect with the right people for your projects</p>
            
            <!-- Search Section -->
            <div class="search-section">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search by name, skills, or company..." id="searchInput">
                    <button class="search-btn" onclick="searchUsers()">🔍</button>
                </div>
                
                <div class="filters">
                    <select class="filter-select" id="locationFilter">
                        <option value="">All Locations</option>
                        <option value="remote">Remote</option>
                        <option value="new-york">New York</option>
                        <option value="san-francisco">San Francisco</option>
                        <option value="london">London</option>
                    </select>
                    
                    <select class="filter-select" id="skillFilter">
                        <option value="">All Skills</option>
                        <option value="javascript">JavaScript</option>
                        <option value="python">Python</option>
                        <option value="design">Design</option>
                        <option value="marketing">Marketing</option>
                    </select>
                    
                    <select class="filter-select" id="experienceFilter">
                        <option value="">Experience</option>
                        <option value="junior">Junior (0-2 years)</option>
                        <option value="mid">Mid (3-5 years)</option>
                        <option value="senior">Senior (5+ years)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="results-section">
            <div class="results-header">
                <div class="results-count" id="resultsCount">Found 24 professionals</div>
                
                <div class="view-toggle">
                    <button class="view-btn active" onclick="switchView('grid')">Grid</button>
                    <button class="view-btn" onclick="switchView('list')">List</button>
                </div>
            </div>

            <!-- Loading State -->
            <div class="loading" id="loadingState" style="display: none;">
                <div class="loading-spinner"></div>
                <p>Searching for professionals...</p>
            </div>

            <!-- Grid View -->
            <div class="users-grid" id="gridView">
                <!-- User Card 1 -->
                <div class="user-card" onclick="viewProfile('sarah-johnson')">
                    <div class="user-header">
                        <div class="user-avatar">
                            <img src="/placeholder.svg?height=60&width=60" alt="Sarah Johnson">
                            <div class="status-dot online"></div>
                        </div>
                        <div class="user-info">
                            <div class="user-name">
                                Sarah Johnson
                                <div class="verification-badge">✓</div>
                            </div>
                            <div class="user-title">Senior UI/UX Designer</div>
                            <div class="user-company">Google Inc.</div>
                        </div>
                    </div>
                    
                    <div class="user-stats">
                        <div class="stat">
                            <div class="stat-value projects">47</div>
                            <div class="stat-label">Projects</div>
                        </div>
                        <div class="stat">
                            <div class="stat-value rating">4.9</div>
                            <div class="stat-label">Rating</div>
                        </div>
                        <div class="stat">
                            <div class="stat-value reviews">156</div>
                            <div class="stat-label">Reviews</div>
                        </div>
                    </div>
                    
                    <div class="user-skills">
                        <div class="skills-list">
                            <span class="skill-tag">UI Design</span>
                            <span class="skill-tag">Figma</span>
                            <span class="skill-tag">Prototyping</span>
                            <span class="skill-tag">User Research</span>
                        </div>
                    </div>
                    
                    <div class="user-actions">
                        <button class="action-btn btn-primary" onclick="event.stopPropagation(); contactUser('sarah-johnson')">Contact</button>
                        <button class="action-btn btn-outline" onclick="event.stopPropagation(); viewProfile('sarah-johnson')">View Profile</button>
                    </div>
                </div>

                <!-- User Card 2 -->
                <div class="user-card" onclick="viewProfile('mike-chen')">
                    <div class="user-header">
                        <div class="user-avatar">
                            <img src="/placeholder.svg?height=60&width=60" alt="Mike Chen">
                            <div class="status-dot away"></div>
                        </div>
                        <div class="user-info">
                            <div class="user-name">
                                Mike Chen
                                <div class="verification-badge">✓</div>
                            </div>
                            <div class="user-title">Full Stack Developer</div>
                            <div class="user-company">Microsoft</div>
                        </div>
                    </div>
                    
                    <div class="user-stats">
                        <div class="stat">
                            <div class="stat-value projects">32</div>
                            <div class="stat-label">Projects</div>
                        </div>
                        <div class="stat">
                            <div class="stat-value rating">4.8</div>
                            <div class="stat-label">Rating</div>
                        </div>
                        <div class="stat">
                            <div class="stat-value reviews">89</div>
                            <div class="stat-label">Reviews</div>
                        </div>
                    </div>
                    
                    <div class="user-skills">
                        <div class="skills-list">
                            <span class="skill-tag">React</span>
                            <span class="skill-tag">Node.js</span>
                            <span class="skill-tag">Python</span>
                            <span class="skill-tag">AWS</span>
                        </div>
                    </div>
                    
                    <div class="user-actions">
                        <button class="action-btn btn-primary" onclick="event.stopPropagation(); contactUser('mike-chen')">Contact</button>
                        <button class="action-btn btn-outline" onclick="event.stopPropagation(); viewProfile('mike-chen')">View Profile</button>
                    </div>
                </div>

                <!-- User Card 3 -->
                <div class="user-card" onclick="viewProfile('emily-davis')">
                    <div class="user-header">
                        <div class="user-avatar">
                            <img src="/placeholder.svg?height=60&width=60" alt="Emily Davis">
                            <div class="status-dot online"></div>
                        </div>
                        <div class="user-info">
                            <div class="user-name">Emily Davis</div>
                            <div class="user-title">Marketing Specialist</div>
                            <div class="user-company">Freelancer</div>
                        </div>
                    </div>
                    
                    <div class="user-stats">
                        <div class="stat">
                            <div class="stat-value projects">28</div>
                            <div class="stat-label">Projects</div>
                        </div>
                        <div class="stat">
                            <div class="stat-value rating">4.7</div>
                            <div class="stat-label">Rating</div>
                        </div>
                        <div class="stat">
                            <div class="stat-value reviews">67</div>
                            <div class="stat-label">Reviews</div>
                        </div>
                    </div>
                    
                    <div class="user-skills">
                        <div class="skills-list">
                            <span class="skill-tag">SEO</span>
                            <span class="skill-tag">Content Marketing</span>
                            <span class="skill-tag">Analytics</span>
                        </div>
                    </div>
                    
                    <div class="user-actions">
                        <button class="action-btn btn-primary" onclick="event.stopPropagation(); contactUser('emily-davis')">Contact</button>
                        <button class="action-btn btn-outline" onclick="event.stopPropagation(); viewProfile('emily-davis')">View Profile</button>
                    </div>
                </div>

                <!-- User Card 4 -->
                <div class="user-card" onclick="viewProfile('alex-rodriguez')">
                    <div class="user-header">
                        <div class="user-avatar">
                            <img src="/placeholder.svg?height=60&width=60" alt="Alex Rodriguez">
                            <div class="status-dot offline"></div>
                        </div>
                        <div class="user-info">
                            <div class="user-name">
                                Alex Rodriguez
                                <div class="verification-badge">✓</div>
                            </div>
                            <div class="user-title">Data Scientist</div>
                            <div class="user-company">Tesla</div>
                        </div>
                    </div>
                    
                    <div class="user-stats">
                        <div class="stat">
                            <div class="stat-value projects">19</div>
                            <div class="stat-label">Projects</div>
                        </div>
                        <div class="stat">
                            <div class="stat-value rating">4.9</div>
                            <div class="stat-label">Rating</div>
                        </div>
                        <div class="stat">
                            <div class="stat-value reviews">43</div>
                            <div class="stat-label">Reviews</div>
                        </div>
                    </div>
                    
                    <div class="user-skills">
                        <div class="skills-list">
                            <span class="skill-tag">Machine Learning</span>
                            <span class="skill-tag">Python</span>
                            <span class="skill-tag">TensorFlow</span>
                        </div>
                    </div>
                    
                    <div class="user-actions">
                        <button class="action-btn btn-primary" onclick="event.stopPropagation(); contactUser('alex-rodriguez')">Contact</button>
                        <button class="action-btn btn-outline" onclick="event.stopPropagation(); viewProfile('alex-rodriguez')">View Profile</button>
                    </div>
                </div>
            </div>

            <!-- List View -->
            <div class="users-list" id="listView">
                <div class="user-list-item" onclick="viewProfile('sarah-johnson')">
                    <div class="list-avatar">
                        <img src="/placeholder.svg?height=50&width=50" alt="Sarah Johnson">
                        <div class="status-dot online"></div>
                    </div>
                    <div class="list-info">
                        <div class="list-name">Sarah Johnson ✓</div>
                        <div class="list-details">Senior UI/UX Designer at Google Inc.</div>
                    </div>
                    <div class="list-stats">
                        <div class="list-stat">
                            <div class="list-stat-value">47</div>
                            <div class="list-stat-label">Projects</div>
                        </div>
                        <div class="list-stat">
                            <div class="list-stat-value">4.9</div>
                            <div class="list-stat-label">Rating</div>
                        </div>
                        <div class="list-stat">
                            <div class="list-stat-value">156</div>
                            <div class="list-stat-label">Reviews</div>
                        </div>
                    </div>
                    <div class="user-actions">
                        <button class="action-btn btn-primary" onclick="event.stopPropagation(); contactUser('sarah-johnson')">Contact</button>
                    </div>
                </div>

                <div class="user-list-item" onclick="viewProfile('mike-chen')">
                    <div class="list-avatar">
                        <img src="/placeholder.svg?height=50&width=50" alt="Mike Chen">
                        <div class="status-dot away"></div>
                    </div>
                    <div class="list-info">
                        <div class="list-name">Mike Chen ✓</div>
                        <div class="list-details">Full Stack Developer at Microsoft</div>
                    </div>
                    <div class="list-stats">
                        <div class="list-stat">
                            <div class="list-stat-value">32</div>
                            <div class="list-stat-label">Projects</div>
                        </div>
                        <div class="list-stat">
                            <div class="list-stat-value">4.8</div>
                            <div class="list-stat-label">Rating</div>
                        </div>
                        <div class="list-stat">
                            <div class="list-stat-value">89</div>
                            <div class="list-stat-label">Reviews</div>
                        </div>
                    </div>
                    <div class="user-actions">
                        <button class="action-btn btn-primary" onclick="event.stopPropagation(); contactUser('mike-chen')">Contact</button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="page-btn">← Previous</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">Next →</button>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        function searchUsers() {
            const searchTerm = document.getElementById('searchInput').value;
            const location = document.getElementById('locationFilter').value;
            const skill = document.getElementById('skillFilter').value;
            const experience = document.getElementById('experienceFilter').value;

            // Show loading state
            document.getElementById('loadingState').style.display = 'block';
            document.getElementById('gridView').style.display = 'none';
            document.getElementById('listView').style.display = 'none';

            // Simulate API call
            setTimeout(() => {
                document.getElementById('loadingState').style.display = 'none';
                const currentView = document.querySelector('.view-btn.active').textContent.toLowerCase();
                if (currentView === 'grid') {
                    document.getElementById('gridView').style.display = 'grid';
                } else {
                    document.getElementById('listView').style.display = 'block';
                }

                // Update results count
                const count = Math.floor(Math.random() * 50) + 10;
                document.getElementById('resultsCount').textContent = `Found ${count} professionals`;
            }, 1500);
        }

        // View switching
        function switchView(view) {
            const buttons = document.querySelectorAll('.view-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            const gridView = document.getElementById('gridView');
            const listView = document.getElementById('listView');

            if (view === 'grid') {
                gridView.style.display = 'grid';
                listView.style.display = 'none';
                listView.classList.remove('active');
            } else {
                gridView.style.display = 'none';
                listView.style.display = 'block';
                listView.classList.add('active');
            }
        }

        // User interactions
        function viewProfile(userId) {
            alert(`Viewing profile for: ${userId}`);
        }

        function contactUser(userId) {
            alert(`Contacting user: ${userId}`);
        }

        // Search on Enter key
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchUsers();
            }
        });

        // Filter change handlers
        document.getElementById('locationFilter').addEventListener('change', searchUsers);
        document.getElementById('skillFilter').addEventListener('change', searchUsers);
        document.getElementById('experienceFilter').addEventListener('change', searchUsers);

        // Auto-search as user types (debounced)
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(searchUsers, 500);
        });
    </script>
</body>
</html>