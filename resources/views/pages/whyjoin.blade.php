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
         display: flex;

      justify-content: center;
      align-items: stretch;
      flex-wrap: wrap;
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
        <h1>Why Join <span>MMAAP?</span></h1>
        <p>Unlock your potential in multimedia arts through professional networking, skill development, and career advancement opportunities with the Philippines' premier multimedia arts organization.</p>
      </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
      <h2>What your membership <span>means to you:</span></h2>
      <div class="benefits-grid">
        <div class="benefit-card">
          <img src="{{ asset('img/undraw_learning-sketchingsh.svg') }}" alt="Professional collaboration" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 24px;" />
          <h3 style="color: #E09900; margin-bottom: 16px;">Are you a professional?</h3>
          <h4 style="color: #032639; margin-bottom: 16px;">What your membership means to you:</h4>
          <p>Be part of the bigger landscape of multimedia arts in the country. </p>
          <a href="#" class="btn-primary" style="margin-top: 24px; display: inline-block;">Know More</a>
        </div>
        
        <div class="benefit-card">
          <img src="{{ asset('img/undraw_learning-sketchingsh.svg') }}" alt="Students collaborating" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 24px;" />
          <h3 style="color: #E09900; margin-bottom: 16px;">Are you a student?</h3>
          <h4 style="color: #032639; margin-bottom: 16px;">What's in it for you? LOTS!</h4>
          <p>Upgrade yourself through exclusive workshops, seminars, trainings, and materials. Share your talent and skill with others and help us all grow together.</p>
          <a href="#" class="btn-primary" style="margin-top: 24px; display: inline-block;">Know More</a>
        </div>
        
        <div class="benefit-card">
          <img src="{{ asset('img/undraw_learning-sketchingsh.svg') }}"alt="Business professionals meeting" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 24px;" />
          <h3 style="color: #E09900; margin-bottom: 16px;">Institutions and Companies</h3>
          <p style="color: #032639; margin-bottom: 16px; font-size: 16px;">We seek partners in government and industry, partners that will help us grow as an institution and organization to benefit the greatest number of Creatives in the most sustainable manner possible</p>
          <a href="#" class="btn-primary" style="margin-top: 24px; display: inline-block;">Know More</a>
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
              <li><i class="fas fa-check"></i> Upskill</li>
              <li><i class="fas fa-check"></i> Portfolio development support</li>
              <li><i class="fas fa-check"></i> Career guidance sessions</li>
               <li><i class="fas fa-check"></i>Network</li>
            </ul>
          </div>
          
          <div class="membership-card">
            <h3>Professional Membership</h3>
            <ul class="membership-features">
              <li><i class="fas fa-check"></i> Representation</li>
              <li><i class="fas fa-check"></i> Support</li>
              <li><i class="fas fa-check"></i> Networking opportunities</li>
              <li><i class="fas fa-check"></i> Upskill</li>
              <li><i class="fas fa-check"></i> Research collaboration</li>
              <li><i class="fas fa-check"></i> Sustainability</li>
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