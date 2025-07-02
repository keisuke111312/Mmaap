@extends('layouts.member.master')

@section('ribbon')
    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-header">
                <h1 class="page-title">SETTING</h1>
                <button class="dashboard-btn">GO TO DASHBOARD</button>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <nav class="tab-nav">
        <div class="tab-container">

        </div>
    </nav>
@endsection

@section('content')
    <style>
       

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            /* min-height: 100vh; */
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

        .change-cover-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .change-cover-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .change-cover-btn::before {
            content: '📷';
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

        /* Avatar Upload Section */
        .avatar-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .avatar-upload-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            color: white;
            font-size: 24px;
        }

        .profile-avatar:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-input {
            display: none;
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

        .avatar-upload-text {
            color: #666;
            font-size: 14px;
            margin-top: 10px;
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

        .profile-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-value.applied { color: #ffa500; }
        .stat-value.won { color: #28a745; }
        .stat-value.current { color: #007bff; }
        .stat-value.total { color: #6f42c1; }

        .stat-label {
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .public-profile-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e9ecef;
        }

        .public-profile-link {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 15px;
            display: block;
        }

        .public-profile-link:hover {
            text-decoration: underline;
        }

        .profile-url {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
            font-size: 12px;
            color: #666;
        }

        .copy-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 11px;
            transition: background 0.3s ease;
        }

        .copy-btn:hover {
            background: #0056b3;
        }

        /* Main Content */
        .profile-main {
            flex: 1;
            padding-top: 20px;
        }

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



        /* Form Styles */
        .profile-form {
            max-width: 700px;
        }

        .form-section {
            margin-bottom: 35px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f3f4;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .form-row.single {
            grid-template-columns: 1fr;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label.required::after {
            content: '*';
            color: #dc3545;
            margin-left: 4px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
            transform: translateY(-1px);
        }

        .form-input:invalid {
            border-color: #dc3545;
        }


        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 16px;
            padding: 5px;
        }

        .password-toggle:hover {
            color: #007bff;
        }

        .form-help {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        /* Action Buttons */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f1f3f4;
        }

        .btn {
            padding: 14px 30px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #021e2c 0%, #032639 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background: #6c757d;
            color: white;
            transform: translateY(-2px);
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

            .form-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .tabs {
                margin-bottom: 30px;
            }

            .tab {
                padding: 12px 20px;
                font-size: 13px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        /* Loading Animation */
        .loading {
            opacity: 0.7;
            pointer-events: none;
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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

        .document-actions {
            display: flex;
            gap: 10px;
        }

        .btn-sm {
            padding: 8px 15px;
            font-size: 12px;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
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
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .remove-skill {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            padding: 0 5px;
            font-size: 16px;
            line-height: 1;
        }

        .remove-skill:hover {
            color: #dc3545;
        }

        textarea.form-input {
            resize: vertical;
            min-height: 100px;
        }

        /* Form Dropdown Styles */
        .form-dropdown {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 15px;
            border: 1px solid #e9ecef;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .experience-header, .education-header {
            margin-bottom: 10px;
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

        .skill-tag {
            background: #e9ecef;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            margin: 5px;
        }
    </style>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <!-- Cover Section -->
        <div class="cover-section">
            <button class="change-cover-btn" onclick="changeCover()">Change Cover</button>
        </div>

        <!-- Profile Section -->
        <div class="profile-section">
            <!-- Left Sidebar -->
            <div class="profile-left">
                <!-- Avatar Upload Section -->
                <div class="avatar-section">
                    <div class="avatar-upload-container">
                        <div class="profile-avatar" onclick="document.getElementById('avatarInput').click()">
                            <img id="avatarPreview" src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.png') }}" alt="Avatar">
                            <div class="avatar-overlay">
                                <span>📷</span>
                            </div>
                            <div class="verification-badge">✓</div>
                        </div>
                    </div>
                    <div class="avatar-upload-text">Click to upload new avatar</div>
                </div>

                <!-- Profile Info -->
                <div class="profile-info">
                    <div class="profile-name" id="displayName">{{$user->username}}</div>
                    <div class="profile-username" id="displayUsername">{{$user->email}}</div>
                    
                    <div class="profile-stats">
                        {{-- <div class="stat-item">
                            <div class="stat-value applied">12</div>
                            <div class="stat-label">Applied</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value won">24</div>
                            <div class="stat-label">Won</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value current">6</div>
                            <div class="stat-label">Current</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value total">42</div>
                            <div class="stat-label">Total</div>
                        </div> --}}
                    </div>
                </div>

                <!-- Public Profile Section -->
                <div class="public-profile-section">
                    <a href="#" class="public-profile-link">View Public Profile</a>
                    <div class="profile-url">
                        <span id="profileUrl">https://app.example.com/johndoe</span>
                        <button class="copy-btn" onclick="copyProfileUrl()">Copy</button>
                    </div>
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

                <!-- Tab Content Containers -->
                <div id="account-settings" class="tab-content active">
                    <!-- Profile Form -->
                    <form action="{{ route('update.user-profile', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Personal Information Section -->
                        <div class="form-section">
                            <h3 class="section-title">Personal Information</h3>
                            <input type="file" id="avatarInput" name="avatar_url" class="avatar-input" accept="image/*" onchange="previewAvatar(this)">

                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label required">First Name</label>                               
                                     <input type="text" id="name" class="form-input" name="fname" value="{{ $user->fname }}">

                                </div>
                                <div class="form-group">
                                    <label class="form-label required">Last Name</label>
                                    <input type="text" id="name" class="form-input" name="lname" value="{{ $user->lname }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label required">Username</label>
                                     <input type="text" id="name" class="form-input" name="username" value="{{ $user->username }}">
                                    <div class="form-help">This will be your unique identifier</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label required">Email</label>
                                    <input type="email" id="email" class="form-input" name="email" value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label required">Contact</label>
                                    <input type="tel" id="email" class="form-input" name="contact" value="{{ $user->contact }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input type="url" class="form-input" id="website" name="website" value="https://johndoe.com" placeholder="https://example.com">
                                </div>
                            </div>
                        </div>

                        <!-- Security Section -->
                        <div class="form-section">
                            <h3 class="section-title">Security</h3>
                            
                            <div class="form-row single">
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <div class="password-container">
                                        <input type="password" class="form-input" id="password" name="password" placeholder="Leave blank to keep current password">
                                        <button type="button" class="password-toggle" onclick="togglePassword('password')">👁️</button>
                                    </div>
                                    <div class="form-help">Leave blank if you don't want to change your password</div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">Cancel</button>
                        </div>
                    </form>
                </div>

                <div id="career-overview" class="tab-content">
                    <div class="form-section">
                        <h3 class="section-title">Career Information</h3>
                        
                        <!-- Professional Summary -->
                        <div class="form-row single">
                            <div class="form-group">
                                <label class="form-label">Professional Summary</label>
                                <textarea class="form-input" rows="4" placeholder="Write a brief summary of your professional background and career goals"></textarea>
                            </div>
                        </div>

                        <!-- Work Experience -->
                        <div class="form-section">
                            <h3 class="section-title">Work Experience</h3>
                            <div class="experience-list">
                                @foreach($user->experiences as $experience)
                                <div class="experience-item">
                                    <div class="experience-header">
                                        <h4>{{ $experience->title }} at {{ $experience->company }}</h4>
                                        <span class="date-range">{{ date('M Y', strtotime($experience->start_date)) }} - {{ $experience->end_date ? date('M Y', strtotime($experience->end_date)) : 'Present' }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="toggleForm('experienceForm')" style="margin-top: 15px;">Add Experience</button>
                            
                            <!-- Experience Form Dropdown -->
                            <div id="experienceForm" class="form-dropdown" style="display: none;">
                                <form action="{{ route('store.experience') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Job Title</label>
                                            <input type="text" name="title" class="form-input" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Company</label>
                                            <input type="text" name="company" class="form-input" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Start Date</label>
                                            <input type="month" name="start_date" class="form-input" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">End Date</label>
                                            <input type="month" name="end_date" class="form-input">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save Experience</button>
                                        <button type="button" class="btn btn-secondary" onclick="toggleForm('experienceForm')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="form-section">
                            <h3 class="section-title">Education</h3>
                            <div class="education-list">
                                @foreach($user_education->education as $education)
                                <div class="education-item">
                                    <div class="education-header">
                                        <h4>{{ $education->degree }} in {{ $education->field_of_study }}</h4>
                                        <span class="school-name">{{ $education->school }}</span>
                                        <span class="date-range">{{ date('M Y', strtotime($education->start_date)) }} - {{ $education->end_date ? date('M Y', strtotime($education->end_date)) : 'Present' }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="toggleForm('educationForm')" style="margin-top: 15px;">Add Education</button>
                            
                            <!-- Education Form Dropdown -->
                            <div id="educationForm" class="form-dropdown" style="display: none;">
                                <form action="{{ route('store.education') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">School</label>
                                            <input type="text" name="school" class="form-input" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Degree</label>
                                            <input type="text" name="degree" class="form-input" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Field of Study</label>
                                            <input type="text" name="field_of_study" class="form-input" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Grade</label>
                                            <input type="text" name="grade" class="form-input">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Start Date</label>
                                            <input type="month" name="start_date" class="form-input" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">End Date</label>
                                            <input type="month" name="end_date" class="form-input">
                                        </div>
                                    </div>
                                    <div class="form-row single">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-input" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save Education</button>
                                        <button type="button" class="btn btn-secondary" onclick="toggleForm('educationForm')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="form-section">
                            <h3 class="section-title">Skills</h3>
                            <div class="skills-container">
                                @foreach($user->skill as $skill)
                                <span class="skill-tag">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="toggleForm('skillForm')" style="margin-top: 15px;">Add Skill</button>
                            
                            <!-- Skill Form Dropdown -->
                            <div id="skillForm" class="form-dropdown" style="display: none;">
                                <form action="{{ route('store.skill') }}" method="POST">
                                    @csrf
                                    <div class="form-row single">
                                        <div class="form-group">
                                            <label class="form-label">Skill Name</label>
                                            <input type="text" name="name" class="form-input" required>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save Skill</button>
                                        <button type="button" class="btn btn-secondary" onclick="toggleForm('skillForm')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save Career Information</button>
                            <button type="button" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>

                <div id="documents" class="tab-content">
                    <div class="form-section">
                        <h3 class="section-title">My Documents</h3>
                        <div class="documents-container">
                            <!-- Document upload section -->
                            <div class="form-row single">
                                <div class="form-group">
                                    <label class="form-label">Upload New Document</label>
                                    <input type="file" class="form-input" accept=".pdf,.doc,.docx">
                                    <div class="form-help">Supported formats: PDF, DOC, DOCX (Max size: 5MB)</div>
                                </div>
                            </div>

                            <!-- Documents list -->
                            <div class="documents-list">
                                <div class="document-item">
                                    <div class="document-info">
                                        <span class="document-icon">📄</span>
                                        <span class="document-name">Resume.pdf</span>
                                    </div>
                                    <div class="document-actions">
                                        <button class="btn btn-secondary btn-sm">Download</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                                <!-- Add more document items as needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Avatar preview functionality
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Password toggle functionality
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = field.nextElementSibling;
            
            if (field.type === 'password') {
                field.type = 'text';
                toggle.textContent = '🙈';
            } else {
                field.type = 'password';
                toggle.textContent = '👁️';
            }
        }

        // Copy profile URL
        function copyProfileUrl() {
            const url = document.getElementById('profileUrl').textContent;
            navigator.clipboard.writeText(url).then(() => {
                const btn = event.target;
                const originalText = btn.textContent;
                btn.textContent = 'Copied!';
                btn.style.background = '#28a745';
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.style.background = '#007bff';
                }, 2000);
            });
        }

    
        // Reset form
        function resetForm() {
            if (confirm('Are you sure you want to discard all changes?')) {
                document.getElementById('profileForm').reset();
                updateDisplayName();
                updateDisplayUsername();
            }
        }

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

        // Change cover functionality
        function changeCover() {
            alert('This functionality is not yet implemented here');
        }

        // Form submission handling
        document.querySelector('form').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('avatarInput');
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                if (file.size > 2 * 1024 * 1024) { // 2MB limit
                    e.preventDefault();
                    alert('File size must be less than 2MB');
                    return;
                }
                const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    e.preventDefault();
                    alert('Only JPG, PNG and WebP images are allowed');
                    return;
                }
            }
        });

        // Toggle form dropdowns
        function toggleForm(formId) {
            const form = document.getElementById(formId);
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }

        // Close form when clicking outside
        document.addEventListener('click', function(e) {
            const forms = document.querySelectorAll('.form-dropdown');
            const addButtons = document.querySelectorAll('.btn-secondary');
            
            forms.forEach(form => {
                if (!form.contains(e.target) && !Array.from(addButtons).some(btn => btn.contains(e.target))) {
                    form.style.display = 'none';
                }
            });
        });

    </script>
    
@endsection
