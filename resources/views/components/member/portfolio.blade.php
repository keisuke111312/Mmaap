


    <div class="profile-container">
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

        <!-- Banner -->
        <div class="profile-banner">
            <div style="height: 200px">
            {{-- <img src="https://randomuser.me/api/portraits/men/32.jpg" class="profile-pic" alt="Profile Picture"> --}}

             <img id="avatarPreview" class="profile-pic" src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/default-avatar.png') }}" alt="Avatar">
            </div>
            <div class="profile-header">
                <h2>{{ $user->fname }} {{ $user->lname }}</h2>
                <p>UI/UX Designer | Web & App Specialist</p>
                <p>Lahore, Pakistan &middot;
                    <a href="#" id="openModalBtn" class="contact-info">Contact info</button>

                </p>
                <div class="profile-actions">
                    <button>Connect</button>
                    <button class="secondary">Message</button>
                </div>
            </div>
        </div>



        <!-- Main Profile Content -->
        <div class="profile-main">

            <!-- Experience -->
            <div class="profile-section-card">
                <h3>Experience</h3>

                <div style="display: flex; justify-content:space-between;">

                    <div class="timeline">
                        @foreach ($auth_user->experiences as $experience)
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <span class="exp-title">{{ $experience->title }}</span> at <span
                                        class="exp-company">{{ $experience->company }}</span><br>
                                    <span class="exp-date">{{ $experience->start_date }} -
                                        {{ $experience->end_date ?? 'Present' }}</span>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="flex gap-2">
                        <!-- Add Experience Button -->
                        <button id="addExperienceBtn" class="e-btn">
                            <i class="fas fa-plus"></i>
                        </button>

                        <!-- Edit Experience Button -->
                        <button id="editExperienceBtn" class="e-btn">
                            <i class="fas fa-pen"></i>
                        </button>
                    </div>
                </div>

            </div>


            @include('components.member.experience-modal')






            @php
                use Carbon\Carbon;
            @endphp
            <!-- Education -->
            <div class="profile-section-card">
                <h3>Education</h3>
                <div style="display: flex; justify-content:space-between;">
                    <div>
                        @foreach ($user_education->education as $education)
                            @php

                                $start = Carbon::parse($education->start_date)->format('M Y');
                                $end = $education->end_date
                                    ? Carbon::parse($education->end_date)->format('M Y')
                                    : 'Present';
                            @endphp

                            <ul>
                                <li>
                                    <span class="exp-title">{{ $education->degree }} {{ $education->field_of_study }}</span>
                                    <span class="exp-company">- {{ $education->school }}</span><br>
                                    <span class="exp-date">{{ $start }} - {{ $end }}</span>
                                </li>
                            </ul>
                        @endforeach

                    </div>
                    <div class="flex gap-2">
                        <!-- Add Experience Button -->
                        <button id="addEducationBtn" class="e-btn">
                            <i class="fas fa-plus"></i>
                        </button>

                        <!-- Edit Experience Button -->
                        <button id="editEducationBtn" class="e-btn">
                            <i class="fas fa-pen"></i>
                        </button>

                    </div>
                </div>
            </div>




            <!-- Skills -->
            <div class="profile-section-card">
                <h3>Skills</h3>
                <div style="display: flex; justify-content:space-between;">

                <ul>
                    @foreach ($user_skill->skill as $skill)
                    <li>{{$skill->name}}</li>
                    @endforeach
                </ul>

                <div class="flex gap-2">
                    <!-- Add Experience Button -->
                    <button id="addSkillBtn" class="e-btn">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

            </div>

            <!-- About at the Bottom -->
            <div class="profile-section-card">
                <h3>About</h3>
                <p>
                    Creative and detail-oriented UI/UX Designer with 5+ years of experience in designing engaging,
                    user-friendly interfaces for web and mobile applications. Passionate about solving problems through
                    design and collaborating with cross-functional teams.
                </p>
            </div>

        </div>
    </div>
    @include('components.member.contact-modal')
    @include('components.member.education-modal')
    @include('components.member.skill-modal')





    <style>
        .profile-container {
            display: flex;
            /* align-items: center; */
            flex-direction: column;
            padding: 40px;

        }

        h2 {
            color: #232323;

        }

        label {
            color: #232323;

        }

        span {
            color: #232323;
        }

        .profile-banner {
            width: 100%;
            max-width: 1000px;
            height: 160px;
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
            border-radius: 8px 8px 0 0;
            position: relative;
            align-self: center;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            padding-bottom: 70px;
            /* Ensures content below doesn't overlap */

        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #fff;
            object-fit: cover;
            position: absolute;
            left: 40px;
            bottom: -60px;
            /* Pushes below banner edge */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
        }

        .profile-header {
            bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* color: white; */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
            padding: 28px 28px 0 28px;
        }

        .profile-main {
            max-width: 1000px;
            margin: 80px auto 0 auto;
            margin-top: 240px;


            /* Adjusted for profile picture height */
        }


        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #fff;
            object-fit: cover;
            position: absolute;
            left: 40px;
            top: 140px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
            /* background: #fff; */
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* margin-left: 180px; */
            padding-top: 80px;
            position: relative;
            height: 180px;
        }

        /* .contact-info {
                                                color: #0f2f4a;
                                                text-decoration: none;
                                            } */

        .profile-header h2 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .profile-header p {
            margin: 4px 0 0 0;
            color: #555;
            font-size: 1.1rem;
        }

        .profile-actions {
            margin-top: 16px;
            display: flex;
            gap: 12px;
        }

        .profile-actions button {
            background: #0f2f4a;
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 24px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.18s;
        }

        .profile-actions button.secondary {
            background: #fff;
            color: #0f2f4a;
            border: 1.5px solid #0f2f4a;
        }

        .profile-section {
            margin-top: 32px;
            height: 200px;

        }

        .profile-section h3 {
            font-size: 1.2rem;
            color: #0f2f4a;
            margin-bottom: 10px;
        }

        .profile-section ul {
            list-style: none;
            padding: 0;
        }

        .profile-section li {
            margin-bottom: 12px;
        }

        .profile-section .exp-title {
            font-weight: 600;
            color: #232323;
        }

        .profile-section .exp-company {
            color: #555;
            font-size: 1rem;
        }

        .profile-section .exp-date {
            color: #888;
            font-size: 0.98rem;
        }

        .profile-section-card {
            color: #232323;
            background: #fff;
            padding: 24px;
            margin: 24px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
        }

        .profile-section-card h3 {
            font-size: 1.2rem;
            color: #0f2f4a;
            margin-bottom: 12px;
        }

        .profile-section-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .profile-section-card li {
            margin-bottom: 12px;
        }

        /* Timeline for Experience */
        .timeline {
            position: relative;
            margin-left: 18px;
            padding-left: 24px;
            border-left: 0.5px solid #464646;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 32px;
            display: flex;
            align-items: flex-start;
        }

        .timeline-dot {
            position: absolute;
            left: -35px;
            width: 16px;
            height: 16px;
            background: #fff;
            border: 3px solid #4646462d;
            border-radius: 50%;
            z-index: 1;
            box-shadow: 0 2px 6px rgba(237, 28, 36, 0.08);
        }

        .timeline-content {
            background: none;
            padding-left: 8px;
        }

        .timeline-content .exp-title {
            font-weight: 600;
            color: #232323;
        }

        .timeline-content .exp-company {
            color: #555;
            font-size: 1rem;
        }

        .timeline-content .exp-date {
            color: #888;
            font-size: 0.98rem;
        }

        .e-btn {
            border: none;
            background: none;
            font-size: 16px;
        }

        @media (max-width: 600px) {
            .profile-main {
                padding: 0 8px 24px 8px;
            }

            .profile-header {
                margin-left: 0;
                padding-top: 80px;
                align-items: center;
            }

            .profile-pic {
                left: 50%;
                transform: translateX(-50%);
                top: 140px;
            }
        }
    </style>
