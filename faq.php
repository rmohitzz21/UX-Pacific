<?php
$pageTitle    = 'FAQ | UX Pacific';
$pageDesc     = 'Find answers to frequently asked questions about UX Pacific  our services, process, tools, pricing, and more.';
$canonicalUrl = 'https://www.uxpacific.com/faq.php';
$ogTitle      = 'FAQ | UX Pacific';
$ogDesc       = 'Got questions? We have answers. Explore the UX Pacific FAQ to learn about our UX design services, process, and how to get started.';
$ogUrl        = 'https://www.uxpacific.com/faq.php';
$currentPage  = 'faq';
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

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24 faq_desc" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
              What services does UXPacific offer?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse p-20" data-bs-parent="#faqAccordion">
            <div class="accortext-secondary f18">
              We specialize in UI/UX design, UX audits, design systems, landing pages, and strategy consulting. Whether you're launching an MVP or scaling an enterprise platform, we craft human-first digital experiences that perform.
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
              Can I pay you in pizza and good vibes?
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              Tempting. But we prefer clean invoices and coffee. Good vibes are always welcome though.
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
              What tools do you use?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              At UXPacific, we use Figma, Sketch, and Framer for designing and prototyping, Notion for organisation, Slack for communication, and Google Workspace for files and presentations.
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
              Do you offer a Free UX Audit?
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              Yes! We provide a Free UX Audit for selected projects. It includes a UX score, heuristic analysis, annotated screens, and actionable recommendations. It's a great starting point to understand how your current experience is performing.
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
              Will my website get 1 million users if you design it?
            </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              Only if your content is as good as our design. (We'll help make it look like a million bucks, though.)
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
              Do you offer ongoing support after a project ends?
            </button>
          </h2>
          <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              Yes. We offer monthly design retainers for continuous improvements, design iterations, and support across your sprints.
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven">
              Do you do dark mode... for real life?
            </button>
          </h2>
          <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              We wish. For now, just your interfaces  sleek and easy on the eyes.
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight">
              How can I get started?
            </button>
          </h2>
          <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              Just reach out via our <a href="/contact" style="color:#a78bfa;">Contact Page</a>. We'll schedule a quick call, understand your goals, and tailor a plan that fits.
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine">
              What is your typical design process?
            </button>
          </h2>
          <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              We follow a 6-step human-centered process:<br />
              Empathize &rarr; Define &rarr; Ideate &rarr; Prototype &rarr; Implement &rarr; Test<br />
              This ensures clarity, scalability, and user satisfaction from concept to delivery.
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen">
              Do you work with startups or just big companies?
            </button>
          </h2>
          <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              We work with clients of all sizes, from ambitious startups looking to make a big splash to established enterprises in need of a design refresh.
            </div>
          </div>
        </div>

        <div class="accordion-item my-3 rounded-3" style="background-color:#111">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-light f24" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven">
              What industries do you work with?
            </button>
          </h2>
          <div id="collapseEleven" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body f18">
              We're currently working with early-stage startups, NGOs, and digital platforms in need of design transformation. While we're building experience across industries, our adaptable design process allows us to quickly understand new domains and deliver user-centered, scalable solutions tailored to any product or audience.
            </div>
          </div>
        </div>

      </div>
    </main>

    <section class="cta-section">
      <div class="dots-bg desktop-only"><canvas id="dots-canvas"></canvas></div>
      <div class="cta-container">
        <div class="cta-text">
          <h1>Start your <span>UI/UX</span> journey with <br><span class="highlight">UXPacific Team</span></h1>
          <p class="mt-4 mb-4">Build your site effortlessly and showcase your work with confidence.<br>Ready to stand out? Get started today!</p>
          <a href="/contact" class="cta-button">Get in touch <span class="arrow"></span></a>
        </div>
        <div class="cta-blur-overlay"></div>
        <div class="cta-image"><img src="img/Rectangle 5192.webp" alt="UX Design" /></div>
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
  </body>
</html>
