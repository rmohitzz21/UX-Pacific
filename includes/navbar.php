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
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M7 4V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v1h2a1 1 0 0 1 1 1v2h1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V5a1 1 0 0 1 1-1h2zM9 4h6V3H9v1zm-2 5v1h14V9H7z"/>
          </svg>
        </a>
        <!-- Academy Icon (Graduation Cap) -->
        <a href="https://academy.uxpacific.com/" target="_blank" rel="noopener noreferrer" class="nav-icon-link" aria-label="UXP Academy">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 1l11 6v2h-1v11a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V9H1V7l11-6zm0 3.34L3.74 8.5h16.52L12 4.34zM4 10v8h16v-8H4z"/>
          </svg>
        </a>
        <!-- Community Icon (People) -->
        <a href="https://community.uxpacific.com/" target="_blank" rel="noopener noreferrer" class="nav-icon-link" aria-label="UXP Community">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1c2.67 0 8 1.34 8 4v3H4v-3c0-2.66 5.33-4 8-4zm-6-3a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm12 0a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM3 20v-2.5c0-1.93 3.36-3.5 7-3.5s7 1.57 7 3.5V20H3z"/>
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
