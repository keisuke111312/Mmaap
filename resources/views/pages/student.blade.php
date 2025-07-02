@extends('layouts.pages.main')

@section('content')

    <style>
      /* Base and container */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body {
        font-family: 'Montserrat', sans-serif;
        line-height: 1.6;
        background: #fff;
        color: #032639;
        overflow-x: hidden;
      }
      .container {
        width: 100%;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
      }

      /* Typography */
      h1 {
        font-family: 'Montserrat', sans-serif;
        font-size: 50px;
        font-weight: 600;
        text-align: start;
      }
      h2 {
        font-family: 'Montserrat', sans-serif;
        font-size: 35px;
        font-weight: 700;
      }
      h3 {
        font-family: 'Montserrat', sans-serif;
        font-size: 25px;
        font-weight: 700;
      }
      h4 {
        font-family: 'Montserrat', sans-serif;
        font-size: 20px;
        font-weight: 700;
      }
      p {
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
        font-weight: 400;
      }
      span {
        color: #E09900;
      }

      /* Header */
      header {
        background-color: #0f2f4a;
        color: white;
      }
      .header-inner {
        max-width: 1200px;
        margin: auto;
        padding: 12px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .logo {
        display: flex;
        align-items: center;
        gap: 8px;
        max-width: 140px;
        font-weight: 600;
        font-size: 12px;
        line-height: 1.2;
        font-family: 'Montserrat', sans-serif;
      }
      .logo img {
        width: 120px;
        height: 120px;
        object-fit: contain;
      }
      nav {
        display: none;
        gap: 24px;
        font-weight: 600;
        font-size: 12px;
        letter-spacing: 0.05em;
        font-family: 'Montserrat', sans-serif;
      }
      nav a {
        color: white;
        transition: text-decoration 0.3s;
        text-decoration: none;
      }
      nav a:hover {
        text-decoration: underline;
        color: #E09900;
      }
      @media (min-width: 768px) {
        nav {
          display: flex;
        }
      }

      /* Hero Section */
      .hero-fluid {
        position: relative;
        background-color: #0f2f4a;
        color: white;
        overflow: hidden;
        padding: 80px 16px 96px;
        width: 100vw;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        z-index: 0;
      }
      .hero-content {
        position: relative;
        max-width: 1200px;
        padding: 0 16px;
        z-index: 1;
        margin-left: auto;
        margin-right: auto;
        color: white;
        text-align: center;
      }
      .hero-content h1 {
        text-align: center;
        margin-bottom: 16px;
      }
      .hero-content p {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 24px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
      }
      .hero-fluid img.bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100%;
        object-fit: cover;
        object-position: center;
        opacity: 0.4;
        z-index: 0;
        display: block;
      }

      /* Benefits Section */
      .benefits-section {
        max-width: 1200px;
        margin: 80px auto;
        padding: 0 16px;
        text-align: center;
      }
      .benefits-section h2 {
        color: #032639;
        margin-bottom: 48px;
      }
      .benefits-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
        margin-bottom: 60px;
      }
      .benefit-card {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
      }
      .benefit-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
      }
      .benefit-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #0f2f4a, #1e40af);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        color: white;
        font-size: 32px;
      }
      .benefit-card h3 {
        color: #032639;
        margin-bottom: 16px;
      }
      .benefit-card p {
        color: #4b5563;
        line-height: 1.6;
      }

      /* Membership Types Section */
      .membership-section {
        background-color: #f8fafc;
        padding: 80px 16px;
        width: 100vw;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        position: relative;
      }
      .membership-content {
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
      }
      .membership-content h2 {
        color: #032639;
        margin-bottom: 24px;
      }
      .membership-content p {
        font-size: 18px;
        color: #4b5563;
        margin-bottom: 48px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
      }
      .membership-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 32px;
      }
      .membership-card {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
      }
      .membership-card:hover {
        transform: translateY(-5px);
      }
      .membership-card h3 {
        color: #E09900;
        margin-bottom: 16px;
        font-size: 24px;
      }
      .membership-features {
        list-style: none;
        padding: 0;
        text-align: left;
      }
      .membership-features li {
        padding: 8px 0;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #4b5563;
      }
      .membership-features i {
        color: #E09900;
        font-size: 16px;
      }

      /* CTA Section */
      .cta-section {
        background-color: #032639;
        color: white;
        padding: 80px 16px;
        width: 100vw;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        position: relative;
        text-align: center;
      }
      .cta-content {
        max-width: 800px;
        margin: 0 auto;
      }
      .cta-content h2 {
        color: white;
        margin-bottom: 24px;
      }
      .cta-content p {
        font-size: 18px;
        margin-bottom: 32px;
        line-height: 1.6;
      }
      .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
      }
      .btn-primary {
        background-color: #E09900;
        color: white;
        font-weight: 700;
        font-size: 16px;
        padding: 16px 32px;
        border-radius: 8px;
        border: none;
        transition: background-color 0.3s;
        cursor: pointer;
        font-family: 'Montserrat', sans-serif;
        text-decoration: none;
        display: inline-block;
      }
      .btn-primary:hover {
        background-color: #b37700;
      }
      .btn-secondary {
        background-color: transparent;
        color: white;
        font-weight: 700;
        font-size: 16px;
        padding: 16px 32px;
        border-radius: 8px;
        border: 2px solid white;
        transition: all 0.3s;
        cursor: pointer;
        font-family: 'Montserrat', sans-serif;
        text-decoration: none;
        display: inline-block;
      }
      .btn-secondary:hover {
        background-color: white;
        color: #032639;
      }

      /* Footer */
      footer {
        background-color: #0f2f4a;
        color: white;
        padding: 40px 16px;
        font-family: 'Montserrat', sans-serif;
      }
      .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr;
        gap: 32px;
      }
      @media (min-width: 768px) {
        .footer-container {
          grid-template-columns: 1fr 2fr;
        }
      }
      .footer-logo {
        display: flex;
        align-items: center;
        gap: 8px;
        max-width: 140px;
        font-weight: 600;
        font-size: 12px;
        line-height: 1.2;
      }
      .footer-logo img {
        width: 120px;
        height: 120px;
        object-fit: contain;
      }
      .footer-desc {
        font-size: 16px;
        max-width: 280px;
        margin-bottom: 16px;
        line-height: 1.4;
      }
      .footer-phone {
        font-weight: 700;
        font-size: 16px;
      }
      form {
        display: flex;
        flex-direction: column;
        gap: 12px;
        font-size: 16px;
        color: #032639;
      }
      .form-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
      }
      @media (min-width: 640px) {
        .form-row {
          grid-template-columns: 1fr 1fr;
        }
      }
      input[type="text"],
      input[type="email"],
      textarea {
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
        color: #032639;
        resize: none;
      }
      textarea {
        min-height: 72px;
      }
      .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
      }
      .social-links {
        display: flex;
        gap: 12px;
      }
      .social-links a {
        color: white;
        font-size: 20px;
        transition: color 0.3s;
      }
      .social-links a:hover {
        color: #E09900;
      }
      .btn-submit {
        background-color: #1f2937;
        color: white;
        font-weight: 700;
        font-size: 16px;
        padding: 12px 30px;
        border-radius: 4px;
        border: none;
        transition: background-color 0.3s;
        cursor: pointer;
        font-family: 'Montserrat', sans-serif;
      }
      .btn-submit:hover {
        background-color: #374151;
      }

      /* Responsive adjustments */
      @media (max-width: 768px) {
        h1 {
          font-size: 36px;
        }
        h2 {
          font-size: 28px;
        }
        h3 {
          font-size: 20px;
        }
        .hero-content p {
          font-size: 16px;
        }
        .cta-buttons {
          flex-direction: column;
          align-items: center;
        }
        .btn-primary,
        .btn-secondary {
          width: 100%;
          max-width: 300px;
        }
      }
    </style>


    <!-- Hero Section -->
    <section class="hero-fluid" id="home">
      <img
  src="{{ asset('img/abouthero.jpg') }}"
        alt="People in a meeting, blurred background with dark overlay"
        class="bg-image"
        width="1920"
        height="600"
        aria-hidden="true"
      />
      <div class="hero-content">
        <h1>Representation. Empowerment.<span>Connectivity.</span></h1>
        <p>Be part of the bigger landscape of multimedia arts in the country</p>
      </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
      <h2>Benefits of Student <span>Membership</span></h2>
      <h3 style="color: #E09900; font-size: 28px; margin-bottom: 16px;">Professional Membership Fee: P250</h3>
      <p style=" margin-bottom: 36px;">your school and your generation on a national level. Be represented as young Creatives as we work towards a sustainable, productive, and professional industry. Fill out the form below to join TODAY!
      <div class="benefits-grid">
        <div class="benefit-card"></p> 
          <div class="benefit-icon">
            <i class="fas fa-flag"></i>
          </div>
          <h3>Represent</h3>
          
          <p>Be part of the bigger landscape of multimedia arts in the country. Represent your school and your generation on a national level. Be represented as young Creatives as we work towards a sustainable, productive, and professional industry.</p>
        
        </div>
        
        <div class="benefit-card">
          <div class="benefit-icon">
            <i class="fas fa-arrow-up"></i>
          </div>
          <h3>Upskill</h3>
          <p>Upgrade yourself through exclusive workshops, seminars, trainings, and materials. Share your talent and skill with others and help us all grow together.</p>
        </div>
        
        <div class="benefit-card">
          <div class="benefit-icon">
            <i class="fas fa-network-wired"></i>
          </div>
          <h3>Network</h3>
          <p>Tap into a national network of emerging and veteran professionals, gain insights, lessons, and advice from people who have been where you're headed.</p>
        </div>
        
        <div class="benefit-card">
          <div class="benefit-icon">
            <i class="fas fa-handshake"></i>
          </div>
          <h3>Engage</h3>
          <p>Collaborate with others on projects and activities; link up with professionals and students to fill in the gaps in your personal skill set.</p>
        </div>
        
        <div class="benefit-card">
          <div class="benefit-icon">
            <i class="fas fa-key"></i>
          </div>
          <h3>Access</h3>
          <p>Gain first-dibs on the newest and latest innovations and developments in the field. Find out before the rest of the internet does.</p>
        </div>
        
        <div class="benefit-card">
          <div class="benefit-icon">
            <i class="fas fa-heart"></i>
          </div>
          <h3>Support</h3>
          <p>We know it's not easy to be a Creative in the Philippines. We got your back. Training in sustainable business practices, professional wellness, and government compliance are just a taste of things to come.</p>
        </div>
        
        <div class="benefit-card">
          <div class="benefit-icon">
            <i class="fas fa-infinity"></i>
          </div>
          <h3>Continuity</h3>
          <p>Move from "student" to "professional" seamlessly. Why change organization just because you graduated? The community you build stays with you from classroom to studio and beyond. Yes, meron forever.</p>
        </div>
      </div>
    </section>

    <!-- Membership Types Section -->
    <section class="membership-section">
      <div class="membership-content">
        <h2>Membership <span>Categories</span></h2>
        <p>Choose the membership type that best fits your current status and career goals in multimedia arts.</p>
        
        <div class="membership-grid">
          <div class="membership-card">
            <h3>Student Membership</h3>
            <ul class="membership-features">
              <li><i class="fas fa-check"></i> Access to educational resources</li>
              <li><i class="fas fa-check"></i> Student-focused workshops</li>
              <li><i class="fas fa-check"></i> Mentorship programs</li>
              <li><i class="fas fa-check"></i> Internship opportunities</li>
              <li><i class="fas fa-check"></i> Portfolio development support</li>
              <li><i class="fas fa-check"></i> Career guidance sessions</li>
            </ul>
          </div>
          
          <div class="membership-card">
            <h3>Professional Membership</h3>
            <ul class="membership-features">
              <li><i class="fas fa-check"></i> Full access to all events</li>
              <li><i class="fas fa-check"></i> Professional certification</li>
              <li><i class="fas fa-check"></i> Networking opportunities</li>
              <li><i class="fas fa-check"></i> Industry recognition</li>
              <li><i class="fas fa-check"></i> Research collaboration</li>
              <li><i class="fas fa-check"></i> Speaking opportunities</li>
            </ul>
          </div>
          
          <div class="membership-card">
            <h3>Institutional Membership</h3>
            <ul class="membership-features">
              <li><i class="fas fa-check"></i> Multiple member benefits</li>
              <li><i class="fas fa-check"></i> Curriculum development support</li>
              <li><i class="fas fa-check"></i> Faculty training programs</li>
              <li><i class="fas fa-check"></i> Research partnerships</li>
              <li><i class="fas fa-check"></i> Student exchange programs</li>
              <li><i class="fas fa-check"></i> Industry partnerships</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
      <div class="cta-content">
        <h2>Ready to Take Your Multimedia Arts Career to the Next Level?</h2>
        <p>Join MMAAP today and become part of a thriving community of multimedia arts professionals who are shaping the future of the industry in the Philippines and beyond.</p>
        <div class="cta-buttons">
          <a href="#" class="btn-primary">Become a Member</a>
          <a href="#" class="btn-secondary">Learn More</a>
        </div>
      </div>
    </section>

   
    
@endsection