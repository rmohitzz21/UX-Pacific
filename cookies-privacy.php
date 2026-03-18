<?php
$pageTitle    = 'Cookie Policy | UX Pacific';
$pageDesc     = 'Learn how UX Pacific uses cookies and similar technologies to improve your browsing experience on our website.';
$canonicalUrl = 'https://www.uxpacific.com/cookies-privacy.php';
$ogTitle      = 'Cookie Policy | UX Pacific';
$ogDesc       = 'Understand how UX Pacific uses cookies what types we use, why, and how you can manage your cookie preferences.';
$ogUrl        = 'https://www.uxpacific.com/cookies-privacy.php';
$currentPage  = 'cookies-privacy';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <style>
      .cookies-page main { max-width: 1240px;
            max-width: 1240px;
    width: 100%;
    margin: 10px auto;
    padding: 20px 40px;
    background: #1111;
    border-radius: 8px;
       }
      .cookie-section h2 { font-size:1.75rem; margin-bottom:16px; }
      .cookie-section p, .cookie-section ul { font-size:15px; line-height:1.3; }
      @media (max-width:600px) {
        /* .cookies-page main { padding:32px 12px 16px 12px; } */
        .cookie-section h2 { font-size:1.5rem; }
        .about-header h1 { font-size:2rem; margin-top:110px; }
        .section-divider { margin:24px 0; }
        .about-header p { font-size:0.9rem; }
      }
    </style>
  </head>
  <body class="cookies-page">
    <?php include 'includes/navbar.php'; ?>

    <section class="about-header">
      <h1 class="dm-sans">Cookie Policy</h1>
      <p class="lastup">Last Updated: May 22, 2025</p>
    </section>

    <main>
      <div class="cookie-section mb-4 mt50">
        <p>This Cookie Policy explains how UX Pacific uses cookies and similar technologies to improve your browsing experience.</p>
      </div>
      <hr class="section-divider" />

      <div class="cookie-section mt-5 mb-5">
        <h2>1. What Are Cookies?</h2>
        <p>Cookies are small text files stored on your device when you visit a website. They help us remember user preferences and understand site usage.</p>
      </div>
      <hr class="section-divider" />

      <div class="cookie-section mt-3 mb-3">
        <h2>2. Why We Use Cookies</h2>
        <p>We use cookies to:</p>
        <ul>
          <li>Enable essential site functionality (e.g. contact form performance)</li>
          <li>Improve website speed and user experience</li>
          <li>Analyze how users interact with the site (via tools like Google Analytics)</li>
          <li>Remember visitor preferences (e.g. dark mode toggle or session status)</li>
        </ul>
      </div>
      <hr class="section-divider" />

      <div class="cookie-section mt-5 mb-5">
        <h2>3. Types of Cookies We Use</h2>
        <ul>
          <li><b>Essential Cookies</b>: Necessary for core functionality.</li>
          <li><b>Analytics Cookies</b>: Help us understand user behavior to improve our services.</li>
          <li><b>Performance Cookies</b>: Improve the speed and responsiveness of our site.</li>
        </ul>
      </div>
      <hr class="section-divider" />

      <div class="cookie-section mt-5 mb-5">
        <h2>4. Managing Cookies</h2>
        <p>You can control or disable cookies in your browser settings. However, disabling essential cookies may impact your user experience on our website.</p>
      </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
  </body>
</html>
