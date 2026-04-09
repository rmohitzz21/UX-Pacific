<?php $cp = $currentPage ?? ''; $b = BASE_URL; ?>
<nav class="navbar navbar-expand-lg<?php echo ($cp === 'home') ? ' navbar--dark' : ''; ?>">
  <div class="container">
    <a href="<?= $b ?>/">
      <img src="<?= $b ?>/img/LOGO.png" class="nav-logo" id="myImage" alt="UX Pacific Logo" />
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
          <a class="nav-link<?php echo ($cp === 'home') ? ' active' : ''; ?>" href="<?= $b ?>/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'about') ? ' active' : ''; ?>" href="<?= $b ?>/about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'service') ? ' active' : ''; ?>" href="<?= $b ?>/service">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'work') ? ' active' : ''; ?>" href="<?= $b ?>/work">Work</a>
        </li>
        <!-- MOBILE ONLY -->
        <li class="nav-item d-lg-none">
          <a class="nav-link<?php echo ($cp === 'contact') ? ' active' : ''; ?>" href="<?= $b ?>/contact">Contact</a>
        </li>
        <li class="nav-item d-lg-none">
          <a class="nav-link<?php echo ($cp === 'faq') ? ' active' : ''; ?>" href="<?= $b ?>/faq">FAQ</a>
        </li>
      </ul>
      <section class="hero11 d-lg-none text-center mt-3">
        <h1>Start your UI/UX Journey</h1>
        <p>with creativity, innovation, and modern design.</p>
      </section>
      <!-- Desktop Nav Icons & CTA -->
      <div class="navbar-icons-cta d-none d-lg-flex align-items-center gap-3">
        <!-- Shop Icon -->
        <a href="https://club.uxpacific.com/" target="_blank" rel="noopener noreferrer" class="nav-icon-link" aria-label="UXP Shop">
          <img src="img/maki_shop.png" alt="" srcset="">
        </a>
        <!-- Academy Icon (Graduation Cap) -->
        <a href="https://academy.uxpacific.com/" target="_blank" rel="noopener noreferrer" class="nav-icon-link" aria-label="UXP Academy">
          <img src="img/dashicons_welcome-learn-more.png" alt="UXP Academy">
        </a>
        <!-- Community Icon (People) -->
        <a href="https://community.uxpacific.com/" target="_blank" rel="noopener noreferrer" class="nav-icon-link" aria-label="UXP Community">
          <img src="img/boxicons_community-filled.png" alt="">
        </a>
        <!-- Let's Talk CTA Button -->
        <a href="<?= $b ?>/contact" class="cta-button nav-cta-btn" style="margin-left: 8px;">
          Let's talk <span class="arrow"></span>
        </a>
      </div>
      <!-- Mobile CTA -->
      <div class="d-flex d-lg-none">
        <a href="<?= $b ?>/contact" class="cta-button nav-cta-btn">
          Let's Talk <span class="arrow"></span>
        </a>
      </div>
    </div>
  </div>
</nav>
