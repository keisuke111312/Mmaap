@extends('layouts.member.main')
@section('content')
<style>
    .profile-banner {
        width: 100%;
        height: 220px;
        background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
        border-radius: 8px 8px 0 0;
        position: relative;
    }
    .profile-main {
        background: #fff;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        margin-top: -60px;
        padding: 0 32px 32px 32px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        background: #fff;
    }
    .profile-header {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-left: 180px;
        padding-top: 32px;
    }
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
        background: #0a66c2;
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
        color: #0a66c2;
        border: 1.5px solid #0a66c2;
    }
    .profile-section {
        margin-top: 32px;
    }
    .profile-section h3 {
        font-size: 1.2rem;
        color: #0a66c2;
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
    @media (max-width: 600px) {
        .profile-main { padding: 0 8px 24px 8px; }
        .profile-header { margin-left: 0; padding-top: 80px; align-items: center; }
        .profile-pic { left: 50%; transform: translateX(-50%); top: 140px; }
    }
</style>
<div class="profile-banner">
    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="profile-pic" alt="Profile Picture">
</div>
<div class="profile-main">
    <div class="profile-header">
        <h2>Muhammad Bin Jameel</h2>
        <p>UI/UX Designer | Web & App Specialist</p>
        <p>Lahore, Pakistan &middot; <a href="#" style="color:#0a66c2; text-decoration:none;">Contact info</a></p>
        <div class="profile-actions">
            <button>Connect</button>
            <button class="secondary">Message</button>
        </div>
    </div>
    <div class="profile-section">
        <h3>About</h3>
        <p>Creative and detail-oriented UI/UX Designer with 5+ years of experience in designing engaging, user-friendly interfaces for web and mobile applications. Passionate about solving problems through design and collaborating with cross-functional teams.</p>
    </div>
    <div class="profile-section">
        <h3>Experience</h3>
        <ul>
            <li>
                <span class="exp-title">Senior UI/UX Designer</span> <span class="exp-company">at Tech Solutions</span><br>
                <span class="exp-date">Jan 2021 - Present</span>
            </li>
            <li>
                <span class="exp-title">Web Designer</span> <span class="exp-company">at Creative Studio</span><br>
                <span class="exp-date">Jul 2018 - Dec 2020</span>
            </li>
        </ul>
    </div>
    <div class="profile-section">
        <h3>Education</h3>
        <ul>
            <li>
                <span class="exp-title">BS Computer Science</span> <span class="exp-company">- University of Lahore</span><br>
                <span class="exp-date">2014 - 2018</span>
            </li>
        </ul>
    </div>
    <div class="profile-section">
        <h3>Skills</h3>
        <ul>
            <li>UI/UX Design</li>
            <li>Web Design</li>
            <li>App Design</li>
            <li>Figma, Adobe XD, Photoshop</li>
        </ul>
    </div>
</div>
@endsection 