<?php $cp = $currentPage ?? ''; ?>
<nav class="navbar navbar-expand-lg<?php echo ($cp === 'home') ? ' navbar--dark' : ''; ?>">
  <div class="container">
    <a href="index.php">
      <img src="img/LOGO.png" class="nav-logo" id="myImage" alt="UX Pacific Logo" />
    </a>
    <button
      class="navbar-toggler collapsed"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="toggler-icon top-bar"></span>
      <span class="toggler-icon middle-bar"></span>
      <span class="toggler-icon bottom-bar"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'home') ? ' active' : ''; ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'about') ? ' active' : ''; ?>" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'services') ? ' active' : ''; ?>" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'work') ? ' active' : ''; ?>" href="work.php">Work</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'ecosystem') ? ' active' : ''; ?>" href="ecosystem.php">Ecosystem</a>
        </li>
        <!-- MOBILE ONLY -->
        <li class="nav-item d-lg-none">
          <a class="nav-link<?php echo ($cp === 'contact') ? ' active' : ''; ?>" href="contact.php">Let's Talk</a>
        </li>
        <li class="nav-item d-lg-none">
          <a class="nav-link<?php echo ($cp === 'faq') ? ' active' : ''; ?>" href="faq.php">FAQ</a>
        </li>
      </ul>
      <section class="hero11 d-lg-none text-center mt-3">
        <h1>Start your UI/UX Journey</h1>
        <p>with creativity, innovation, and modern design.</p>
      </section>
      <div class="d-flex">
        <a href="contact.php" class="cta-button nav-cta-btn">
          Let's Talk <span class="arrow"></span>
        </a>
      </div>
    </div>
  </div>
</nav>
