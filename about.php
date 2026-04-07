<?php
$pageTitle    = 'About Us | UX Pacific';
$pageDesc     = 'Learn about UX Pacific  our mission, team, and design philosophy. We craft purposeful digital experiences that connect people with technology.';
$canonicalUrl = 'https://www.uxpacific.com/about.php';
$ogTitle      = 'About Us | UX Pacific';
$ogDesc       = 'Meet the team behind UX Pacific. We are a passionate UX design studio committed to building human-centred digital products.';
$ogUrl        = 'https://www.uxpacific.com/about.php';
$currentPage  = 'about';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <style>
      /* ── Our Story ── */
      .ab-story-section { padding: 64px 0; max-width: 1200px; margin: 0 auto; padding-left: 16px; padding-right: 16px; }
      .ab-story-grid { display: grid; grid-template-columns: 1fr 1fr; gap: clamp(2rem, 5vw, 6rem); align-items: center; }
      .ab-story-image { position: relative; border-radius: 32px; overflow: hidden; aspect-ratio: 4/3; }
      .ab-story-image img { width: 100%; height: 100%; object-fit: cover; display: block; }
      .ab-story-image::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(124,95,230,0.15) 0%, transparent 100%); pointer-events: none; }
      .ab-story-content { display: flex; flex-direction: column; gap: 24px; }
      .ab-label { display: inline-block; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.16em; text-transform: uppercase; color: #a78bfa; }
      .ab-title { font-family: 'Inter', sans-serif; font-size: clamp(1.75rem, 4vw, 2.75rem); font-weight: 700; letter-spacing: -0.02em; line-height: 1.25; color: #ffffff; margin: 0; }
      .ab-title em { font-style: normal; background: linear-gradient(135deg, #6147bd 0%, #a78bfa 50%, #c084fc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
      .ab-story-text { color: #8888b0; line-height: 1.7; font-size: 1rem; margin: 0; }
      .ab-cta-btn { display: inline-flex; align-items: center; gap: 8px; font-size: 0.9375rem; font-weight: 600; color: #ffffff !important; background: linear-gradient(90deg, #6147bd, #a78bfa); padding: 14px 28px; border-radius: 9999px; text-decoration: none !important; width: fit-content; transition: box-shadow 0.3s ease, transform 0.3s ease; }
      .ab-cta-btn:hover { box-shadow: 0 4px 24px rgba(124,95,230,0.45); transform: translateY(-2px); }
      /* ── Mission / Vision ── */
      .ab-mv-section { padding: 80px 16px; }
      .ab-mv-inner { max-width: 1200px; margin: 0 auto; }
      .ab-mv-header { text-align: center; max-width: 680px; margin: 0 auto clamp(2.5rem, 5vw, 4.5rem); }
      .ab-mv-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
      .ab-mv-card { position: relative; border-radius: 32px; overflow: hidden; aspect-ratio: 4/3; }
      .ab-mv-card img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.35); transition: filter 400ms ease, transform 400ms ease; display: block; }
      .ab-mv-card:hover img { filter: brightness(0.45); transform: scale(1.03); }
      .ab-mv-card__body { position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: clamp(1.5rem, 3vw, 2.5rem); background: linear-gradient(to top, rgba(7,7,26,0.9) 0%, transparent 60%); }
      .ab-mv-card__label { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.16em; text-transform: uppercase; color: #a78bfa; margin-bottom: 12px; }
      .ab-mv-card__title { font-family: 'Inter', sans-serif; font-size: clamp(1.75rem, 3.5vw, 2.5rem); font-weight: 800; color: #ffffff; margin-bottom: 12px; line-height: 1.1; }
      .ab-mv-card__text { font-size: 0.875rem; color: rgba(255,255,255,0.7); line-height: 1.7; margin: 0; }
      .ab-mv-card__chips { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 16px; }
      .ab-mv-chip { font-size: 0.75rem; font-weight: 500; color: #a78bfa; background: rgba(124,95,230,0.2); border: 1px solid rgba(124,95,230,0.3); padding: 4px 12px; border-radius: 9999px; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
      /* ── Core Values ── */
      .ab-values-section { background: #0b0b1e; padding: 80px 16px; }
      .ab-values-inner { max-width: 1200px; margin: 0 auto; }
      .ab-section-header-center { text-align: center; max-width: 680px; margin: 0 auto clamp(2.5rem, 5vw, 4.5rem); }
      /* ── Process Steps ── */
      .ab-process-section { padding: 80px 16px; }
      .ab-process-inner { max-width: 1200px; margin: 0 auto; }
      .ab-process-steps { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; position: relative; margin-top: 48px; }
      .ab-process-steps::before { content: ''; position: absolute; top: 28px; left: 10%; right: 10%; height: 1px; background: linear-gradient(90deg, #6147bd, #a78bfa); opacity: 0.3; pointer-events: none; }
      .ab-process-step { display: flex; flex-direction: column; align-items: center; gap: 16px; text-align: center; }
      .ab-process-step__num { width: 56px; height: 56px; border-radius: 50%; background: #14143a; border: 2px solid rgba(124,95,230,0.35); display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; font-size: 0.875rem; font-weight: 800; color: #a78bfa; position: relative; z-index: 1; transition: all 250ms ease; flex-shrink: 0; }
      .ab-process-step:hover .ab-process-step__num { background: linear-gradient(90deg, #6147bd, #a78bfa); border-color: transparent; color: #ffffff; box-shadow: 0 0 30px rgba(124,95,230,0.25); }
      .ab-process-step__title { font-family: 'Inter', sans-serif; font-size: 0.875rem; font-weight: 600; color: #ffffff; }
      .ab-process-step__desc { font-size: 0.75rem; color: #8888b0; line-height: 1.7; }
      @media (max-width: 900px) {
        .ab-story-grid { grid-template-columns: 1fr; }
        .ab-mv-grid { grid-template-columns: 1fr; }
        .ab-process-steps { grid-template-columns: repeat(2, 1fr); }
        .ab-process-steps::before { display: none; }
      }
      @media (max-width: 720px) { .ab-story-section { padding: 40px 16px; } .ab-mv-section { padding: 48px 16px; } }
      @media (max-width: 580px) { .ab-process-steps { grid-template-columns: 1fr; } .ab-process-section { padding: 48px 16px; } }

      /* ── Mobile: vertical timeline layout ── */
      @media (max-width: 580px) {
        .ab-process-steps {
          display: flex;
          flex-direction: column;
          gap: 0;
          padding-left: 0;
          margin-top: 36px;
          position: relative;
          align-items: center;
        }
        /* hide horizontal desktop line */
        .ab-process-steps::before { display: none; }

        /* each step: row with circle on left, title on right */
        .ab-process-step {
          display: flex;
          flex-direction: row;
          align-items: center;
          gap: 20px;
          text-align: left;
          position: relative;
          padding-bottom: 0;
          width: 240px;
          /* scroll-in animation */
          opacity: 0;
          transform: translateY(24px);
          transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .ab-process-step.ab-step-visible {
          opacity: 1;
          transform: translateY(0);
        }

        /* left column: circle + connector line */
        .ab-process-step__num {
          flex-shrink: 0;
          width: 48px;
          height: 48px;
          font-size: 0.8rem;
          position: relative;
          z-index: 2;
          margin-top: 0;
        }

        /* vertical connector line drawn downward via scaleY */
        .ab-process-step:not(:last-child) .ab-process-step__num::after {
          content: '';
          position: absolute;
          left: 50%;
          top: 100%;
          transform: translateX(-50%) scaleY(0);
          transform-origin: top center;
          width: 2px;
          height: 56px;
          background: linear-gradient(180deg, #a78bfa, rgba(97,71,189,0.2));
          transition: transform 0.45s ease 0.3s;
        }
        .ab-process-step.ab-step-visible:not(:last-child) .ab-process-step__num::after {
          transform: translateX(-50%) scaleY(1);
        }

        /* right column: title only, no desc */
        .ab-process-step__title {
          font-size: 1rem;
          font-weight: 700;
          padding-top: 0;
          line-height: 1.3;
        }
        .ab-process-step__desc {
          display: none;
        }

        /* spacing between steps = line height */
        .ab-process-step {
          min-height: 100px;
        }
      }
    </style>
  </head>
  <body class="about-page">
    <?php include 'includes/navbar.php'; ?>

    <section class="about-header">
      <video class="header-bg-video" autoplay muted loop playsinline>
        <source src="img/test.mp4" type="video/mp4">
      </video>
      <div class="header-bg-overlay"></div>
      <h1>About Us</h1>
      <div class="innovation-badge-exact">
        <span class="badge-desktop">We are a strategic design partner focused on creating meaningful digital experiences.<br>Driven by purpose and empathy, we craft solutions that deliver real impact.</span>
        <span class="badge-mobile">Design with <span>Purpose</span> &amp; <span>Empathy</span></span>
      </div>
    </section>

    <!-- <h2 class="ux-title" style="margin-top: 50px;">Where Strategy Meets <span class="highlight"> Stunning </span> Design</h2> -->


    <!-- <h3 class="ux-subtitle" style="margin-top: 50px">Our Story <span class="ux-line"> </span></h3> -->
    <div class="ab-story-section">
      <div class="ab-story-grid">
        <div class="ab-story-image">
          <img src="img/aboutus.webp" alt="Our Story  UX Pacific team at work" loading="lazy" />
        </div>
        <div class="ab-story-content">
          <h2 class="ab-title">Born from a Belief<br />in <em>Better Design</em></h2>
          <p class="ab-story-text">UX Pacific was established on 1st May, 2025 with a clear vision  to create meaningful and impactful digital experiences. What started as a passion for design and strategy has grown into a mission to help brands build user-focused solutions that truly make a difference.</p>
          <p class="ab-story-text">From day one, our goal has been simple: combine creativity, research, and empathy to design experiences that not only look beautiful but also solve real problems. We are known for delivering reliable work with unmatched precision, backed by robust design thinking and professional execution.</p>
        </div>
      </div>
    </div>

    <section class="ab-mv-section">
      <div class="ab-mv-inner">
        <div class="ab-mv-header">
          <!-- <h3 class="ux-subtitle" style="margin-top: 50px">Our Purpose <span class="ux-line"> </span></h3> -->
          <h2 class="ab-title" style="margin-top: 12px;">Our<em> Purpose</em></h2>
        </div>
        <div class="ab-mv-grid">
          <div class="ab-mv-card">
            <img src="img/Rectangle 5208.webp" alt="Our Mission" loading="lazy" />
            <div class="ab-mv-card__body">
              <div class="ab-mv-card__label">Mission</div>
              <h3 class="ab-mv-card__title">What We Do</h3>
              <p class="ab-mv-card__text">To bridge the gap between learning and real-world design practice by building an ecosystem where designers can learn, collaborate, and create meaningful digital products.</p>
              <div class="ab-mv-card__chips"><span class="ab-mv-chip">Trust-building</span><span class="ab-mv-chip">High Performance</span><span class="ab-mv-chip">Research-driven</span></div>
            </div>
          </div>
          <div class="ab-mv-card">
            <img src="img/Rectangle 5208 (1).webp" alt="Our Vision" loading="lazy" />
            <div class="ab-mv-card__body">
              <div class="ab-mv-card__label">Vision</div>
              <h3 class="ab-mv-card__title">Where We're Headed</h3>
              <p class="ab-mv-card__text">To create the world’s most empowering design ecosystem, where knowledge, community, and opportunity come together to shape the next generation of designers.</p>
              <div class="ab-mv-card__chips"><span class="ab-mv-chip">Inclusive Design</span><span class="ab-mv-chip">Accessibility</span><span class="ab-mv-chip">Global Scale</span></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ab-process-section">
      <div class="ab-values-inner">
        <div class="ab-section-header-center">
          <!-- <h3 class="ux-subtitle" style="margin-top: 50px">What Drives Us <span class="ux-line"> </span></h3> -->
          <h2 class="ab-title" style="margin-top: 12px;">What Drives Our <em>Design</em></h2>
          <p class="ab-story-text" style="max-width:560px;margin:16px auto 0;">The principles that guide every decision we make and every experience we design.</p>
        </div>
        <div class="ab-process-steps">
          <div class="ab-process-step"><div class="ab-process-step__num">01</div><h4 class="ab-process-step__title">Purpose-First</h4><p class="ab-process-step__desc">Every design decision starts with a clear reason. We never design for decoration  we design for outcomes.</p></div>
          <div class="ab-process-step"><div class="ab-process-step__num">02</div><h4 class="ab-process-step__title">Empathy Always</h4><p class="ab-process-step__desc">We put people at the centre of everything. Understanding users deeply is our most important design tool.</p></div>
          <div class="ab-process-step"><div class="ab-process-step__num">03</div><h4 class="ab-process-step__title">Research-Driven</h4><p class="ab-process-step__desc">Intuition is great. Data is better. We combine both to build experiences grounded in real-world insight.</p></div>
          <div class="ab-process-step"><div class="ab-process-step__num">04</div><h4 class="ab-process-step__title">Craft Obsessed</h4><p class="ab-process-step__desc">We sweat the details so our clients don't have to. Quality and precision are non-negotiable at every stage.</p></div>
          <div class="ab-process-step"><div class="ab-process-step__num">05</div><h4 class="ab-process-step__title">Deliver Impact</h4><p class="ab-process-step__desc">We launch with confidence and measure what matters. Every solution is built to create measurable results  not just visual appeal.</p></div>
        </div>
      </div>
    </section>

    <div class="container">
      <div class="process-section">
        <div class="process-card"><img src="img/process.gif" alt="Process Illustration" class="process-img"></div>
        <div class="process-content">
          <div class="process-title">Our Proven Process</div>
          <ul class="process-list">
            <li>Gain deep insight into user behavior, motivations, and pain points.</li>
            <li>Analyze insights and clearly define the core problem.</li>
            <li>Brainstorm and explore a wide range of creative solutions.</li>
            <li>Create low to high-fidelity versions of solutions to test ideas quickly.</li>
            <li>Validate prototypes with real users, gather feedback, and refine.</li>
          </ul>
        </div>
      </div>
    </div>

    <section class="cta-section">
      <div class="dots-bg desktop-only"><canvas id="dots-canvas"></canvas></div>
      <div class="cta-container">
        <div class="cta-text">
          <h1>Start your <span>UI/UX</span> journey with <br><span class="highlight">UX Pacific Team</span></h1>
          <p class="mt-4 mb-4">Build your site effortlessly and showcase your work with confidence.<br> Ready to stand out? Get started today!</p>
          <a href="/contact" class="cta-button">Get in touch <span class="arrow"></span></a>
        </div>
        <div class="cta-blur-overlay"></div>
        <div class="cta-image"><img src="img/Rectangle 5192.webp" alt="UX Design" /></div>
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <script>
      (function () {
        var steps = document.querySelectorAll('.ab-process-step');
        if (!steps.length || !window.IntersectionObserver) return;
        var obs = new IntersectionObserver(function (entries) {
          entries.forEach(function (e, i) {
            if (e.isIntersecting) {
              e.target.classList.add('ab-step-visible');
              obs.unobserve(e.target);
            }
          });
        }, { threshold: 0.35 });
        steps.forEach(function (s) { obs.observe(s); });
      })();
    </script>
  </body>
</html>
