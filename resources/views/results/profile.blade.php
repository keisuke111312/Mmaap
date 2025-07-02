@extends('layouts.member.master')

@section('content')
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding-bottom: 30px;
        }

        /* Header/Cover Section */
        .cover-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 220px;
            position: relative;
            overflow: hidden;
        }

        .cover-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><polygon fill="rgba(255,255,255,0.1)" points="0,0 100,0 80,100 0,100"/><polygon fill="rgba(255,255,255,0.05)" points="20,0 100,0 100,80 40,100"/><polygon fill="rgba(255,255,255,0.08)" points="40,20 80,0 100,40 60,60"/></svg>');
            background-size: 150px 150px;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateX(0px) translateY(0px); }
            50% { transform: translateX(20px) translateY(-10px); }
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            padding: 0 40px;
            position: relative;
            margin-top: -60px;
            gap: 40px;
        }

        .profile-left {
            flex: 0 0 320px;
        }

        /* Avatar Section */
        .avatar-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            margin: 0 auto;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .verification-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 28px;
            height: 28px;
            background: #1da1f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: bold;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Profile Info */
        .profile-info {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .profile-name {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            text-align: center;
        }

        .profile-username {
            color: #666;
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Main Content */
        .profile-main {
            flex: 1;
            padding-top: 20px;
        }

        /* Career Overview Styles */
        .experience-list, .education-list {
            margin-bottom: 20px;
        }

        .experience-item, .education-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            border: 1px solid #e9ecef;
        }

        .experience-header h4, .education-header h4 {
            margin: 0;
            color: #333;
            font-size: 16px;
        }

        .school-name {
            color: #666;
            font-size: 14px;
            display: block;
            margin: 5px 0;
        }

        .date-range {
            color: #888;
            font-size: 13px;
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .skill-tag {
            background: #e9ecef;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            margin: 5px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f3f4;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-section {
                flex-direction: column;
                padding: 0 20px;
                gap: 30px;
            }

            .profile-left {
                flex: none;
            }
        }

        /* Tab Navigation Styles */
        .tabs {
            display: flex;
            border-bottom: 2px solid #e9ecef;
            margin-bottom: 40px;
            overflow-x: auto;
        }

        .tab {
            padding: 15px 25px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            white-space: nowrap;
            position: relative;
        }

        .tab.active {
            color: #032639;
            border-bottom-color: #032639;
            background: rgba(0, 123, 255, 0.05);
        }

        /* Tab Content Styles */
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Documents Section Styles */
        .documents-container {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
        }

        .documents-list {
            margin-top: 20px;
        }

        .document-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: white;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .document-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .document-icon {
            font-size: 24px;
        }

        .document-name {
            font-size: 14px;
            color: #333;
        }

        /* Account Settings Styles */
        .account-info {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .info-label {
            flex: 0 0 150px;
            font-weight: 600;
            color: #666;
        }

        .info-value {
            flex: 1;
            color: #333;
        }
    </style>

    <div class="container">
        <!-- Cover Section -->
        <div class="cover-section"></div>

        <!-- Profile Section -->
        <div class="profile-section">
            <!-- Left Sidebar -->
            <div class="profile-left">
                <!-- Avatar Section -->
                <div class="avatar-section">
                    <div class="profile-avatar">
                        <img src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.png') }}" alt="Avatar">
                        <div class="verification-badge">✓</div>
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="profile-info">
                    <div class="profile-name">{{ $user->fname }} {{ $user->lname }}</div>
                    <div class="profile-username">{{ $user->email }}</div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="profile-main">
                <!-- Tabs -->
                <div class="tabs">
                    <a href="#account-settings" class="tab active" data-tab="account-settings">Account Settings</a>
                    <a href="#career-overview" class="tab" data-tab="career-overview">Career Overview</a>
                    <a href="#documents" class="tab" data-tab="documents">Documents</a>
                </div>

                <!-- Account Settings Tab -->
                <div id="account-settings" class="tab-content active">
                    <!-- Profile Form -->
                    <form>
                        <!-- Personal Information Section -->
                        <div class="form-section">
                            <h3 class="section-title">Personal Information</h3>
                            <input type="file" id="avatarInput" name="avatar_url" class="avatar-input" accept="image/*" disabled style="display: none;">
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label required">First Name</label>                               
                                    <input type="text" id="name" class="form-input" name="fname" value="{{ $user->fname }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-label required">Last Name</label>
                                    <input type="text" id="name" class="form-input" name="lname" value="{{ $user->lname }}" disabled>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label required">Username</label>
                                    <input type="text" id="name" class="form-input" name="username" value="{{ $user->username }}" disabled>
                                    <div class="form-help">This will be your unique identifier</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label required">Email</label>
                                    <input type="email" id="email" class="form-input" name="email" value="{{ $user->email }}" disabled>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label required">Contact</label>
                                    <input type="tel" id="email" class="form-input" name="contact" value="{{ $user->contact }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input type="url" class="form-input" id="website" name="website" value="{{ $user->website ?? '' }}" placeholder="https://example.com" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Career Overview Tab -->
                <div id="career-overview" class="tab-content">
                    <div class="form-section">
                        <h3 class="section-title">Career Information</h3>
                        
                        <!-- Professional Summary -->
                        <div class="form-row single">
                            <div class="form-group">
                                <p>{{ $user->professional_summary ?? 'No professional summary available.' }}</p>
                            </div>
                        </div>

                        <!-- Work Experience -->
                        <div class="form-section">
                            <h3 class="section-title">Work Experience</h3>
                            <div class="experience-list">
                                @forelse($user->experiences as $experience)
                                <div class="experience-item">
                                    <div class="experience-header">
                                        <h4>{{ $experience->title }} at {{ $experience->company }}</h4>
                                        <span class="date-range">{{ date('M Y', strtotime($experience->start_date)) }} - {{ $experience->end_date ? date('M Y', strtotime($experience->end_date)) : 'Present' }}</span>
                                    </div>
                                </div>
                                @empty
                                <p>No work experience added yet.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="form-section">
                            <h3 class="section-title">Education</h3>
                            <div class="education-list">
                                @forelse($user_education->education as $education)
                                <div class="education-item">
                                    <div class="education-header">
                                        <h4>{{ $education->degree }} in {{ $education->field_of_study }}</h4>
                                        <span class="school-name">{{ $education->school }}</span>
                                        <span class="date-range">{{ date('M Y', strtotime($education->start_date)) }} - {{ $education->end_date ? date('M Y', strtotime($education->end_date)) : 'Present' }}</span>
                                    </div>
                                </div>
                                @empty
                                <p>No education history added yet.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="form-section">
                            <h3 class="section-title">Skills</h3>
                            <div class="skills-container">
                                @forelse($user->skill as $skill)
                                <span class="skill-tag">{{ $skill->name }}</span>
                                @empty
                                <p>No skills added yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents Tab -->
                <div id="documents" class="tab-content">
                    <div class="form-section">
                        <h3 class="section-title">My Documents</h3>
                        <div class="documents-container">
                            <div class="documents-list">
                                {{-- @forelse($user->documents as $document)
                                <div class="document-item">
                                    <div class="document-info">
                                        <span class="document-icon">📄</span>
                                        <span class="document-name">{{ $document->name }}</span>
                                    </div>
                                    <div class="document-actions">
                                        <a href="{{ route('document.download', $document->id) }}" class="btn btn-secondary btn-sm">Download</a>
                                    </div>
                                </div>
                                @empty
                                <p>No documents uploaded yet.</p>
                                @endforelse --}}
                                <p>No documents uploaded yet.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs and contents
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Show corresponding content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>
@endsection 