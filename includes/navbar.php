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
        <li class="nav-item">
          <a class="nav-link<?php echo ($cp === 'ecosystem') ? ' active' : ''; ?>" href="<?= $b ?>/ecosystem">Ecosystem</a>
        </li>
        <!-- MOBILE ONLY -->
        <li class="nav-item d-lg-none">
          <a class="nav-link<?php echo ($cp === 'contact') ? ' active' : ''; ?>" href="<?= $b ?>/contact">Let's Talk</a>
        </li>
        <li class="nav-item d-lg-none">
          <a class="nav-link<?php echo ($cp === 'faq') ? ' active' : ''; ?>" href="<?= $b ?>/faq">FAQ</a>
        </li>
      </ul>
      <section class="hero11 d-lg-none text-center mt-3">
        <h1>Start your UI/UX Journey</h1>
        <p>with creativity, innovation, and modern design.</p>
      </section>
      <div class="d-flex">
        <a href="<?= $b ?>/contact" class="cta-button nav-cta-btn">
          Let's Talk <span class="arrow"></span>
        </a>
      </div>
    </div>
  </div>
</nav>
