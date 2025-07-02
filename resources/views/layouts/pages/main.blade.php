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

</head>
<body>
  <header>
    <div class="header-inner container">
      <div class="logo" aria-label="Multimedia Arts Association of the Philippines logo">
        <img src="http://www.mmaap.com.ph/wp-content/uploads/2020/02/mmaaplogo.png" alt="MMAAP logo white text on dark blue background" width="40" height="40" />
        <div></div>
      </div>
       <nav aria-label="Primary navigation">
          <a href="{{ route('welcome') }}">Home</a>
          <a href="{{ route('about') }}">About</a>
          <a href="{{ route('whyjoin') }}">Why join</a>
          <a href="{{ route('student') }}">Students</a>
          <a href="{{ route('professional') }}">Professionals</a>
          <a href="{{ route('partnership') }}">Partnership</a>
          <a href="#">Be a member</a>
        </nav>
    </div>
  </header>


  <section>
    @yield('content')
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