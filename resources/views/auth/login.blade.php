<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>MMAAP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #032639 0%, #0a4d5c 30%, #1a6b7a 70%, #2a8a9a 100%);
            overflow: hidden;
            position: relative;
        }

        /* Animated Background Elements */
        .bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s ease-in-out infinite;
        }

        .shape-1 {
            top: 10%;
            right: 15%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation-delay: 0s;
        }

        .shape-2 {
            top: 60%;
            right: 5%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 30%;
            animation-delay: 5s;
        }

        .shape-3 {
            bottom: 20%;
            right: 25%;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.12);
            transform: rotate(45deg);
            animation-delay: 10s;
        }

        .shape-4 {
            top: 30%;
            left: 10%;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 20%;
            animation-delay: 15s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg) scale(1);
                opacity: 0.1;
            }

            25% {
                transform: translateY(-20px) rotate(90deg) scale(1.1);
                opacity: 0.15;
            }

            50% {
                transform: translateY(-40px) rotate(180deg) scale(0.9);
                opacity: 0.08;
            }

            75% {
                transform: translateY(-20px) rotate(270deg) scale(1.05);
                opacity: 0.12;
            }
        }

        /* Floating particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: particleFloat 25s infinite linear;
        }

        .particle:nth-child(1) {
            left: 5%;
            width: 3px;
            height: 3px;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            left: 15%;
            width: 4px;
            height: 4px;
            animation-delay: 3s;
        }

        .particle:nth-child(3) {
            left: 25%;
            width: 2px;
            height: 2px;
            animation-delay: 6s;
        }

        .particle:nth-child(4) {
            left: 35%;
            width: 5px;
            height: 5px;
            animation-delay: 9s;
        }

        .particle:nth-child(5) {
            left: 45%;
            width: 3px;
            height: 3px;
            animation-delay: 12s;
        }

        .particle:nth-child(6) {
            left: 55%;
            width: 4px;
            height: 4px;
            animation-delay: 15s;
        }

        .particle:nth-child(7) {
            left: 65%;
            width: 2px;
            height: 2px;
            animation-delay: 18s;
        }

        .particle:nth-child(8) {
            left: 75%;
            width: 3px;
            height: 3px;
            animation-delay: 21s;
        }

        .particle:nth-child(9) {
            left: 85%;
            width: 4px;
            height: 4px;
            animation-delay: 24s;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            position: relative;
            z-index: 10;
        }

        /* Main Content */
        .main-content {
            display: flex;
            align-items: center;
            gap: 4rem;
            max-width: 1200px;
            width: 100%;
        }

        /* Login Card */
        .login-card {
            background: rgba(3, 38, 57, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            width: 400px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: slideInLeft 1s ease-out;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #20b2aa, transparent);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Header */
        .card-header {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInDown 1.2s ease-out 0.3s both;
        }

        @keyframes fadeInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .back-btn {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(-3px);
        }

        .card-title {
            color: white;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .form-toggle {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .toggle-link {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .toggle-link.active {
            color: #20b2aa;
        }

        .toggle-link:hover {
            color: white;
        }

        .toggle-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 2px;
            background: #20b2aa;
            border-radius: 1px;
        }

        /* Form Styles */
        .form-container {
            position: relative;
            overflow: hidden;
        }

        .form {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeInUp 1.4s ease-out 0.5s both;
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form.slide-out {
            transform: translateX(-100%);
            opacity: 0;
        }

        .form.slide-in {
            transform: translateX(0);
            opacity: 1;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .form-group input:focus {
            outline: none;
            border-color: #20b2aa;
            background: rgba(255, 255, 255, 0.12);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(32, 178, 170, 0.2);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #20b2aa, #17a2b8);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(32, 178, 170, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Social Login */
        .divider {
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            margin: 1.5rem 0;
            position: relative;
            font-size: 0.9rem;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(255, 255, 255, 0.15);
        }

        .divider span {
            background: rgba(3, 38, 57, 0.9);
            padding: 0 1rem;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.3rem;
        }

        .social-btn:hover {
            transform: translateY(-3px) scale(1.1);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .social-btn.facebook {
            color: #4267B2;
        }

        .social-btn.google {
            color: #DB4437;
        }

        .social-btn.github {
            color: #333;
            background: white;
        }

        .sign-in-link {
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .sign-in-link a {
            color: #20b2aa;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .sign-in-link a:hover {
            color: #17a2b8;
            text-decoration: underline;
        }

        /* Right Content */
        .right-content {
            flex: 1;
            text-align: center;
            color: white;
            animation: slideInRight 1s ease-out 0.7s both;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .right-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #ffffff, #20b2aa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            from {
                filter: drop-shadow(0 0 10px rgba(32, 178, 170, 0.3));
            }

            to {
                filter: drop-shadow(0 0 20px rgba(32, 178, 170, 0.6));
            }
        }

        .right-subtitle {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .right-description {
            font-size: 1.1rem;
            opacity: 0.7;
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-content {
                flex-direction: column;
                gap: 2rem;
            }

            .right-title {
                font-size: 3rem;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .login-card {
                width: 100%;
                max-width: 400px;
                padding: 2rem;
            }

            .right-title {
                font-size: 2.5rem;
            }

            .right-subtitle {
                font-size: 1.2rem;
            }
        }

        /* Loading Animation */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #032639;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .page-loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.1);
            border-top: 3px solid #20b2aa;
            border-radius: 50%;
            animation: spin 1s linear infinite;
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
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Background Elements -->
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>

    <!-- Floating Particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container">
        <div class="main-content">
            <!-- Login Card -->
            <div class="login-card">
                <button class="back-btn" onclick="goBack()">←</button>

                <div class="card-header">
                    <h1 class="card-title">Create Account</h1>
                    <div class="form-toggle">
                        <a href="#" class="toggle-link" id="loginToggle">Login</a>
                        <span style="color: rgba(255,255,255,0.3);">or</span>
                        <a href="#" class="toggle-link active" id="signupToggle">Sign up</a>
                    </div>
                </div>

                <div class="form-container text-white">
                    <!-- Sign Up Form -->
                    <form class="form" id="signupForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="fullName">First Name</label>
                            <input type="text" name="fname" id="fullName" placeholder="Enter your first name"
                                value="{{ old('fname') }}" required class="w-full p-2 rounded bg-gray-800 text-white">
                            @error('fname')
                                <small class="text-white">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lname" id="lastName" placeholder="Enter your last name"
                                value="{{ old('lname') }}" required class="w-full p-2 rounded bg-gray-800 text-white">
                            @error('lname')
                                <small class="text-white">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">UserName</label>
                            <input type="text" name="username" id="username" placeholder="Username"
                                value="{{ old('username') }}" required
                                class="w-full p-2 rounded bg-gray-800 text-white">
                            @error('username')
                                <small class="text-white">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" name="contact" id="contact" placeholder="Contact"
                                value="{{ old('contact') }}" required class="w-full p-2 rounded bg-gray-800 text-white">
                            @error('contact')
                                <small class="text-white">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="example@email.com"
                                value="{{ old('email') }}" required class="w-full p-2 rounded bg-gray-800 text-white">
                            @error('email')
                                <small class="text-white">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="password-field flex">
                                <input type="password" name="password" id="password" placeholder="••••••••••••"
                                    required class="w-full p-2 rounded bg-gray-800 text-white">
                                <button type="button" class="ml-2 text-white"
                                    onclick="togglePassword('password')">👁</button>
                            </div>
                            @error('password')
                                <small class="text-white">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <div class="password-field flex">
                                <input type="password" name="password_confirmation" id="confirmPassword"
                                    placeholder="••••••••••••" required
                                    class="w-full p-2 rounded bg-gray-800 text-white">
                                <button type="button" class="ml-2 text-white"
                                    onclick="togglePassword('confirmPassword')">👁</button>
                            </div>
                        </div>

                        <button type="submit"
                            class="submit-btn bg-blue-600 text-white px-4 py-2 mt-4 rounded hover:bg-blue-700">
                            Create Account
                        </button>
                    </form>

                    <!-- Login Form (Hidden by default) -->
                    <form class="form mt-10" id="loginForm" style="display: none;" method="POST"
                        action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="loginEmail">Email/Username</label>
                            <input name="login" id="loginEmail" placeholder="example@email.com"
                                value="{{ old('login') }}" required
                                class="w-full p-2 rounded bg-gray-800 text-white">
                            @error('login')
                                <small class="text-white">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <div class="password-field flex">
                                <input type="password" name="password" id="loginPassword" placeholder="••••••••••••"
                                    required class="w-full p-2 rounded bg-gray-800 text-white">
                                <button type="button" class="ml-2 text-white"
                                    onclick="togglePassword('loginPassword')">👁</button>
                            </div>
                            @error('password')
                                <small class="text-white">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit"
                            class="submit-btn bg-green-600 text-white px-4 py-2 mt-4 rounded hover:bg-green-700">
                            Sign In
                        </button>
                    </form>
                </div>



                <div class="divider">
                    <span>OR</span>
                </div>

                <div class="sign-in-link">
                    <span id="toggleText">Already have an account?</span>
                    <a href="#" id="toggleLink">Sign in</a>
                </div>
            </div>

            <!-- Right Content -->
            <div class="right-content">
                <h1 class="right-title">MMAAP</h1>
                <h2 class="right-subtitle">The Multimedia Arts Association of the Philippines</h2>
                <p class="right-description">
                    is the first ever professional organization for multimedia arts in the Philippines.
                </p>
            </div>
        </div>
    </div>

    <script>
        // Page Loading Animation
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('pageLoader').classList.add('hidden');
            }, 1000);
        });

        // Form Toggle Functionality
        const loginToggle = document.getElementById('loginToggle');
        const signupToggle = document.getElementById('signupToggle');
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');
        const toggleText = document.getElementById('toggleText');
        const toggleLink = document.getElementById('toggleLink');

        let isSignupMode = true;

        function switchToLogin() {
            isSignupMode = false;

            // Update toggle buttons
            loginToggle.classList.add('active');
            signupToggle.classList.remove('active');

            // Switch forms with animation
            signupForm.style.display = 'none';
            loginForm.style.display = 'block';
            loginForm.classList.add('slide-in');

            // Update bottom text
            toggleText.textContent = "Don't have an account?";
            toggleLink.textContent = "Sign up";

            // Update card title
            document.querySelector('.card-title').textContent = 'Welcome Back';
        }

        function switchToSignup() {
            isSignupMode = true;

            // Update toggle buttons
            signupToggle.classList.add('active');
            loginToggle.classList.remove('active');

            // Switch forms with animation
            loginForm.style.display = 'none';
            signupForm.style.display = 'block';
            signupForm.classList.add('slide-in');

            // Update bottom text
            toggleText.textContent = "Already have an account?";
            toggleLink.textContent = "Sign in";

            // Update card title
            document.querySelector('.card-title').textContent = 'Create Account';
        }

        loginToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (isSignupMode) switchToLogin();
        });

        signupToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (!isSignupMode) switchToSignup();
        });

        toggleLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (isSignupMode) {
                switchToLogin();
            } else {
                switchToSignup();
            }
        });

        // Password Toggle
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = field.nextElementSibling;

            if (field.type === 'password') {
                field.type = 'text';
                button.textContent = '🙈';
            } else {
                field.type = 'password';
                button.textContent = '👁';
            }
        }

        // Form Submissions
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }

            // Animate button
            submitBtn.textContent = 'Creating Account...';
            submitBtn.style.background = 'linear-gradient(135deg, #17a2b8, #20b2aa)';

        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');

            submitBtn.textContent = 'Signing In...';
            submitBtn.style.background = 'linear-gradient(135deg, #17a2b8, #20b2aa)';

        });

        // Social Login
        function socialLogin(platform) {
            const btn = event.target;
            btn.style.transform = 'translateY(-3px) scale(1.2)';

            setTimeout(() => {
                btn.style.transform = 'translateY(-3px) scale(1.1)';
                alert(`Connecting to ${platform.charAt(0).toUpperCase() + platform.slice(1)}...`);
            }, 150);
        }

        // Back Button
        function goBack() {
            const backBtn = document.querySelector('.back-btn');
            backBtn.style.transform = 'translateX(-10px) scale(0.9)';

            setTimeout(() => {
                backBtn.style.transform = 'translateX(-3px)';
                // You can add navigation logic here
                console.log('Going back...');
            }, 150);
        }

        // Input Focus Animations
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Add typing animation to inputs
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.style.borderColor = '#20b2aa';
                setTimeout(() => {
                    if (!this.matches(':focus')) {
                        this.style.borderColor = 'rgba(255, 255, 255, 0.15)';
                    }
                }, 300);
            });
        });
    </script>
</body>

</html>
