<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>MMAAP</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
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
      overflow-x: hidden; /* Prevent horizontal scroll */
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
      text-align: start; /* Push text to start/left */
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
      color:#E09900
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
    .hero-content {
      position: relative;
       max-width: 1200px;
       padding: 0 16px;
      z-index: 1;
      margin-left: auto;
      margin-right: auto;
      color: white;
      text-align: start;
    }
    .hero-content p {
      font-weight: 600;
      font-size: 16px;
      margin-bottom: 24px;
    }
    .hero-buttons {
      display: flex;
      gap: 12px;
      justify-content: flex-start;
    }
    .btn-primary {
      background-color: #E09900;
      color: #ffffff;
      font-weight: 600;
      font-size: 16px;
      padding: 12px 30px;
      border-radius: 4px;
      border: none;
      transition: background-color 0.3s;
      cursor: pointer;
      font-family: 'Montserrat', sans-serif;
    }
    .btn-primary:hover {
      background-color: #b37700;
    }
    .btn-secondary {
      background-color: transparent;
      color: white;
      font-weight: 600;
      font-size: 16px;
      padding: 12px 30px;
      border-radius: 4px;
      border: 1px solid white;
      transition: background-color 0.3s, color 0.3s;
      cursor: pointer;
      font-family: 'Montserrat', sans-serif;
    }
    .btn-secondary:hover {
      background-color: white;
      color: #0f2f4a;
    }

    /* Features Section */
    .features {
      max-width: 1200px;
      margin: 48px auto 56px;
      padding: 0 16px;
      display: grid;
      grid-template-columns: 1fr;
      gap: 24px;
      font-family: 'Montserrat', sans-serif;
    }
    @media (min-width: 640px) {
      .features {
        grid-template-columns: repeat(3, 1fr);
      }
    }
    .feature-item {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      box-shadow: 0 1px 2px rgb(0 0 0 / 0.7);
      display: flex;
      gap: 12px;
      padding: 16px;
      align-items: center;
    }
    .feature-item img {
      width: 40px;
      height: 40px;
      flex-shrink: 0;
    }
    .feature-text h3 {
      margin: 0 0 4px 0;
      font-weight: 700;
      font-size: 16px;
      color: #032639;
    }
    .feature-text p {
      margin: 0;
      font-size: 14px;
      color: #4b5563;
    }

    /* Info Section */
    .info-section {
      max-width: 1200px;
      margin: 0 auto 56px;
     padding: 40px 16px;
      display: grid;
      grid-template-columns: 1fr;
      gap: 32px;
      align-items: center;
      background: white;
      font-family: 'Montserrat', sans-serif;
    }
    @media (min-width: 768px) {
      .info-section {
        grid-template-columns: 1fr 1fr;
      }
    }
    .info-image {
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
    }
    .info-text h2 {
      font-weight: 700;
      font-size: 25px;
      margin-bottom: 12px;
      color: #032639;
    }
    .info-text p {
      font-size: 16px;
      color: #4b5563;
      margin-bottom: 24px;
      line-height: 1.4;
    }
    .btn-info {
      background-color: #E09900;
      color: #ffffff;
      font-weight: 600;
      font-size: 16px;
      padding: 12px 30px;
      border-radius: 4px;
      border: none;
      transition: background-color 0.3s;
      cursor: pointer;
      font-family: 'Montserrat', sans-serif;
    }
    .btn-info:hover {
      background-color: #b37700;
    }

    /* News & Article Section */
    .news-section {
      max-width: 1200px;
      margin: 0 auto 48px;
      padding: 40px 16px;
      
      font-family: 'Montserrat', sans-serif;
    }
    .news-title {
      text-align: center;
      font-weight: 700;
      font-size: 25px;
      color: #1e40af;
      margin: 32px 0 24px 0;
    }
    /* Use flex for cards container */
    .news-grid {
      display: flex;
      gap: 24px;
      justify-content: center;
      flex-wrap: wrap;
    }
    .news-item {
      background: white;
      border-radius: 6px;
      box-shadow: 0 1px 2px rgb(0 0 0 / 0.7);
      overflow: hidden;
      font-size: 14px;
      color: #4b5563;
      width: 320px;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      font-family: 'Montserrat', sans-serif;
    }
    .news-item img {
      width: 100%;
      height: 176px;
      object-fit: cover;
      object-position: center;
      flex-shrink: 0;
    }
    .news-content {
      padding: 12px 16px;
      flex-grow: 1;
    }
    .news-meta {
      color: #6b7280;
      margin-bottom: 4px;
      font-size: 14px;
    }
    .news-title-item {
      font-weight: 700;
      color: #032639;
      margin: 0 0 4px 0;
      font-size: 16px;
    }
    .news-desc {
      margin: 0;
      font-size: 14px;
    }

    /* Newsletter Section */
    .newsletter {
      max-width: 1200px;
      margin: 0 auto 48px;
      padding: 32px 16px;
      border-top: 1px solid #e5e7eb;
      background: white;
      text-align: center;
      font-family: 'Montserrat', sans-serif;
    }
    .newsletter h3 {
      font-weight: 700;
      font-size: 25px;
      color: #1e40af;
      margin-bottom: 12px;
    }
    .newsletter p {
      font-size: 16px;
      color: #4b5563;
      max-width: 600px;
      margin: 0 auto 16px auto;
      line-height: 1.4;
    }
    .btn-newsletter {
      background-color: #E09900;
      color: #ffffff;
      font-weight: 600;
      font-size: 16px;
      padding: 12px 40px;
      border-radius: 4px;
      border: none;
      transition: background-color 0.3s;
      cursor: pointer;
      font-family: 'Montserrat', sans-serif;
    }
    .btn-newsletter:hover {
      background-color: #b37700;
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
  </style>
</head>
<body>
  <header>
    <div class="header-inner container">
      <div class="logo" aria-label="Multimedia Arts Association of the Philippines logo">
        <img src="http://www.mmaap.com.ph/wp-content/uploads/2020/02/mmaaplogo.png" alt="MMAAP logo white text on dark blue background" width="40" height="40" />
        <div></div>
      </div>
       <nav aria-label="Primary navigation">
          <a href="index.html">Home</a>
          <a href="about.html">About</a>
          <a href="whyjoin.html">Why join</a>
          <a href="student.html">Students</a>
          <a href="professional.html">Professionals</a>
          <a href="partnership.html">Partnership</a>
          <a href="#">Be a member</a>
        </nav>
    </div>
  </header>

  <section class="hero-fluid" aria-label="Hero section with background image and text">
    <img
      src="https://storage.googleapis.com/a1aa/image/87793c18-15e2-47fe-7d7d-4e05712dc167.jpg"
      alt="People in a meeting, blurred background with dark overlay"
      class="bg-image"
      width="1920"
      height="600"
      aria-hidden="true"
    />
    <div class="hero-content container">
      <h1>
        Representation. Empowerment.<br />
        <span>Connectivity.</span>
      </h1>
      <p>Be part of the bigger landscape of multimedia arts in the country</p>
      <div class="hero-buttons">
        <button type="button" class="btn-primary">BE A MEMBER</button>
        <button type="button" class="btn-secondary">CONTACT US</button>
      </div>
    </div>
  </section>

  <section class="features container" aria-label="Features section">
    <article class="feature-item">
      <img src="https://storage.googleapis.com/a1aa/image/553ca1b9-e424-4a1e-d3b8-5f6756ed3ce4.jpg" alt="Icon representing Life Time Access with blue accent" width="40" height="40" />
      <div class="feature-text">
        <h3>Life Time Access</h3>
        <p>Immediate access to lifetime university process resources students.</p>
      </div>
    </article>
    <article class="feature-item">
      <img src="https://storage.googleapis.com/a1aa/image/6249d9d8-0b5d-4974-87c0-889705468f3f.jpg" alt="Icon representing Free Course Materials with blue accent" width="40" height="40" />
      <div class="feature-text">
        <h3>Free Course Materials</h3>
        <p>Immediate access to lifetime university process empowered students.</p>
      </div>
    </article>
    <article class="feature-item">
      <img src="https://storage.googleapis.com/a1aa/image/c87019ce-5eec-416e-d126-806c89a95078.jpg" alt="Icon representing Dedicated Support with blue accent" width="40" height="40" />
      <div class="feature-text">
        <h3>Dedicated Support</h3>
        <p>Immediate access to lifetime university process responsive students.</p>
      </div>
    </article>
  </section>

  <section class="info-section container" aria-label="Information about the organization">
    <img
      src="https://storage.googleapis.com/a1aa/image/485a1d45-8898-4bab-5974-549aeed660e4.jpg"
      alt="Illustration of a person working on a laptop with papers and a plant on the side"
      class="info-image"
      width="400"
      height="300"
    />
    <div class="info-text">
      <h2>Join the first ever multimedia arts professional organization in the Philippines!</h2>
      <p>
        Bringing together the leaders, professional and multi-media platforms, agencies and schools, the MMAAP hopes to establish itself as the cornerstone of Philippine multimedia arts uniting its members with a strong national and international network, professional support, and opportunities for capacity building through seminars, workshops, and national conventions.
      </p>
      <button type="button" class="btn-info">ABOUT US</button>
    </div>
  </section>

  <section class="news-section container" aria-label="News and articles">
    <h3 class="news-title">Get From Our News &amp; Article</h3>
    <div class="news-grid">
      <article class="news-item">
        <img src="https://storage.googleapis.com/a1aa/image/cd2087d7-ff38-48e6-f68f-62987263be16.jpg" alt="People in a meeting with blue overlay" width="400" height="220" />
        <div class="news-content">
          <div class="news-meta">3.2k Views &bull; 0 Comments</div>
          <h4 class="news-title-item">We Are Changing The Way The World Learns</h4>
          <p class="news-desc">Lorem ipsum dolor consectetur nulla amet elit tempor dolor sit amet.</p>
        </div>
      </article>
      <article class="news-item">
        <img src="https://storage.googleapis.com/a1aa/image/3926aa45-cb94-49ce-de42-a51e3cd2598c.jpg" alt="Group of children smiling with blue overlay" width="400" height="220" />
        <div class="news-content">
          <div class="news-meta">3.2k Views &bull; 0 Comments</div>
          <h4 class="news-title-item">Thoughts for Educators On School Reopening</h4>
          <p class="news-desc">Lorem ipsum dolor consectetur nulla amet elit tempor dolor sit amet.</p>
        </div>
      </article>
      <article class="news-item">
        <img src="https://storage.googleapis.com/a1aa/image/cd2087d7-ff38-48e6-f68f-62987263be16.jpg" alt="People in a meeting with blue overlay" width="400" height="220" />
        <div class="news-content">
          <div class="news-meta">3.2k Views &bull; 0 Comments</div>
          <h4 class="news-title-item">We Are Changing The Way The World Learns</h4>
          <p class="news-desc">Lorem ipsum dolor consectetur nulla amet elit tempor dolor sit amet.</p>
        </div>
      </article>
    </div>
  </section>

  <section class="newsletter container" aria-label="Newsletter subscription">
    <h3>Get From Our News &amp; Article</h3>
    <p>Quis quam gravida accumsan lacus facilisis do magna et laudantium magna aliquam lacus dolor education sit amet.</p>
    <button type="button" class="btn-newsletter">GET MORE UPDATE</button>
  </section>

  <footer>
    <div class="footer-container container">
      <div>
        <div class="footer-logo" aria-label="Multimedia Arts Association of the Philippines logo">
          <img src="http://www.mmaap.com.ph/wp-content/uploads/2020/02/mmaaplogo.png" alt="MMAAP logo white text on dark blue background" width="40" height="40" />
          <div></div>
        </div>
        <p class="footer-desc">
          MMAAP serves as a foundation of multimedia professionals and the excellence of modern Filipino multimedia multimedia arts as a field of specialization.
        </p>
        <p class="footer-phone">+63 1236 234 2328</p>
      </div>
      <div>
        <h4 style="color:white; font-weight:700; font-size:16px; margin-bottom:12px;">Get In Touch!</h4>
        <form>
          <div class="form-row">
            <input type="text" placeholder="Full Name" aria-label="Full Name" />
            <input type="email" placeholder="Email Address" aria-label="Email Address" />
          </div>
          <input type="text" placeholder="Subject or Company" aria-label="Subject or Company" />
          <textarea placeholder="Message" aria-label="Message" rows="3"></textarea>
          <div class="form-footer">
            <div class="social-links" aria-label="Social media links">
              <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
              <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
            <button type="submit" class="btn-submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </footer>
</body>
</html>