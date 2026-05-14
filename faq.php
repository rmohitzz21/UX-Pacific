<?php
require_once __DIR__ . '/includes/cms_repository.php';

$pageTitle    = 'FAQ | UX Pacific';
$pageDesc     = 'Find answers to frequently asked questions about UX Pacific  our services, process, tools, pricing, and more.';
$canonicalUrl = 'https://www.uxpacific.com/faq.php';
$ogTitle      = 'FAQ | UX Pacific';
$ogDesc       = 'Got questions? We have answers. Explore the UX Pacific FAQ to learn about our UX design services, process, and how to get started.';
$ogUrl        = 'https://www.uxpacific.com/faq.php';
$currentPage  = 'faq';

$faqs = get_visible_faqs();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
  </head>
  <body class="faq-page">
    <?php include 'includes/navbar.php'; ?>

    <section class="about-header">
      <video class="header-bg-video" autoplay muted loop playsinline>
        <source src="img/test.mp4" type="video/mp4">
      </video>
      <div class="header-bg-overlay"></div>
      <h1>FAQ</h1>
      <div class="innovation-badge-exact">
        <span class="badge-desktop">We've gathered answers to questions we're asked all the time.<br>Still stumped? Drop us a line — we love a good question!</span>
        <span class="badge-mobile">Every <span>Question</span>, Clearly <span>Answered</span></span>
      </div>
    </section>

    <main class="container py-5">
      <div class="accordion accordion-flush col-lg-12 mx-auto" id="faqAccordion">
        <?php if (!empty($faqs)): ?>
          <?php foreach ($faqs as $index => $faq): ?>
            <?php
              $itemId = 'faqCollapse' . (int) ($faq['id'] ?? ($index + 1));
              $question = trim((string) ($faq['question'] ?? ''));
              $answer = trim((string) ($faq['answer'] ?? ''));
            ?>
            <div class="accordion-item my-3 rounded-3" style="background-color:#111">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed bg-transparent text-light f24<?= $index === 0 ? ' faq_desc' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= htmlspecialchars($itemId) ?>">
                  <?= htmlspecialchars($question) ?>
                </button>
              </h2>
              <div id="<?= htmlspecialchars($itemId) ?>" class="accordion-collapse collapse<?= $index === 0 ? ' p-20' : '' ?>" data-bs-parent="#faqAccordion">
                <div class="<?= $index === 0 ? 'accortext-secondary' : 'accordion-body' ?> f18">
                  <?= nl2br(htmlspecialchars($answer)) ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="accordion-item my-3 rounded-3" style="background-color:#111">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed bg-transparent text-light f24 faq_desc" type="button" data-bs-toggle="collapse" data-bs-target="#faqFallback">
                FAQs coming soon
              </button>
            </h2>
            <div id="faqFallback" class="accordion-collapse collapse p-20" data-bs-parent="#faqAccordion">
              <div class="accortext-secondary f18">
                No visible FAQs found yet. Please add FAQs from the admin panel.
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </main>

    <section class="cta-section">
      <div class="dots-bg desktop-only"><canvas id="dots-canvas"></canvas></div>
      <div class="cta-container">
        <div class="cta-text">
          <h1>Start your <span>UI/UX</span> journey with <br><span class="highlight">UXPacific Team</span></h1>
          <p class="mt-4 mb-4">Build your site effortlessly and showcase your work with confidence.<br>Ready to stand out? Get started today!</p>
          <a href="/contact" class="btn-primary">Get in touch <span class="arrow"></span></a>
        </div>
        <div class="cta-blur-overlay"></div>
        <div class="cta-image"><img src="img/Rectangle 5192.webp" alt="UX Design" /></div>
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
  </body>
</html>
