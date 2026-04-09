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
          <a class="nav-link<?php echo ($cp === 'work') ? ' active' : ''; ?>" href="<?= $b ?>/work">WORK</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'service') ? ' active' : ''; ?>" href="<?= $b ?>/service">SERVICES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'about') ? ' active' : ''; ?>" href="<?= $b ?>/about">ABOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'contact') ? ' active' : ''; ?>" href="<?= $b ?>/contact">CONTACT</a>
        </li>
        <!-- MOBILE ONLY -->
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
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
          </svg>
        </a>
        <!-- Academy Icon -->
        <a href="https://academy.uxpacific.com/" target="_blank" rel="noopener noreferrer" class="nav-icon-link" aria-label="UXP Academy">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6m0 0l-8.5 4.75a2 2 0 0 1-1 .25H3a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9.5a2 2 0 0 1 1 .25L22 6m0 4v0"></path>
            <path d="M2 12h20"></path>
          </svg>
        </a>
        <!-- Community Icon -->
        <a href="https://community.uxpacific.com/" target="_blank" rel="noopener noreferrer" class="nav-icon-link" aria-label="UXP Community">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
        </a>
        <!-- Let's Talk CTA Button -->
        <a href="<?= $b ?>/contact" class="cta-button nav-cta-btn" style="margin-left: 8px;">
          LET'S TALK <span class="arrow"></span>
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
