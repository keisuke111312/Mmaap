<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multimedia Art MA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/home.css')}}">

</head>
<body>
  <!-- Header -->
@include('components.nav')
  <!-- Footer -->
  <footer class="footer artistic-footer">
    <div class="footer-grid">
      <div class="footer-left">
        <div class="footer-logo">LOGO</div>
        <p>Multimedia Art MA: Where Creativity Meets Technology</p>
      </div>
      <div class="footer-middle">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="programs.html">Programs</a>
        <a href="admissions.html">Admissions</a>
        <a href="gallery.html">Gallery</a>
        <a href="faculty.html">Faculty</a>
        <a href="news.html">News</a>
        <a href="contact.html">Contact</a>
      </div>
      <div class="footer-right">
        <a href="#"><img src="assets/icon-fb.svg" alt="Facebook"></a>
        <a href="#"><img src="assets/icon-ig.svg" alt="Instagram"></a>
        <a href="#"><img src="assets/icon-li.svg" alt="LinkedIn"></a>
      </div>
    </div>
    <div class="footer-bottom">© 2025 Multimedia Art MA – All rights reserved</div>
    <svg class="footer-brush" viewBox="0 0 1440 80"><path fill="#a1c4fd" fill-opacity="0.2" d="M0,64L48,53.3C96,43,192,21,288,21.3C384,21,480,43,576,53.3C672,64,768,64,864,53.3C960,43,1056,21,1152,22.7C1248,24,1344,36,1392,42.7L1440,53.3L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
  </footer>
  <script src="js/scripts.js"></script>
</body>
</html> 