<?php
$pageTitle    = 'Work | UX Pacific';
$pageDesc     = 'Browse UX Pacific\'s portfolio of case studies, UX audits, and product design projects  from Distinct Buzz to CEDAR Himalaya and Survey Pacific.';
$canonicalUrl = 'https://www.uxpacific.com/work.php';
$ogTitle      = 'Work | UX Pacific';
$ogDesc       = 'Explore our featured projects  where strategy, creativity, and research create real results. View UX Pacific\'s client work and case studies.';
$ogUrl        = 'https://www.uxpacific.com/work.php';
$currentPage  = 'work';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <style>
      .filter-bar { display:flex; align-items:center; gap:8px; background:#101028; border:1px solid rgba(255,255,255,0.06); border-radius:9999px; padding:4px; width:fit-content; margin:0 auto 48px; overflow-x:auto; -webkit-overflow-scrolling:touch; }
      .filter-btn { font-family:'Inter',sans-serif; font-size:0.875rem; font-weight:500; color:#8888b0; padding:8px 20px; border-radius:9999px; border:none; background:transparent; cursor:pointer; transition:all 250ms ease; white-space:nowrap; }
      .filter-btn:hover { color:#ffffff; }
      .filter-btn.active { background:linear-gradient(90deg,#6147bd,#a78bfa); color:#ffffff; box-shadow:0 0 30px rgba(124,95,230,0.25); }
      .work-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:24px; }
      .work-card { background:#101028; border:1px solid rgba(255,255,255,0.06); border-radius:24px; overflow:hidden; transition:transform 400ms ease,box-shadow 400ms ease,border-color 400ms ease; cursor:pointer; }
      .work-card:hover { border-color:rgba(124,95,230,0.35); transform:translateY(-6px); box-shadow:0 8px 32px rgba(0,0,0,0.7),0 0 30px rgba(124,95,230,0.25); }
      .work-card__image { position:relative; overflow:hidden; aspect-ratio:16/10; background:#14143a; }
      .work-card__image img { width:100%; height:100%; object-fit:cover; transition:transform 0.6s cubic-bezier(0.22,1,0.36,1); display:block; }
      .work-card:hover .work-card__image img { transform:scale(1.05); }
      .work-card__overlay { position:absolute; inset:0; background:rgba(7,7,26,0.7); display:flex; align-items:center; justify-content:center; opacity:0; transition:opacity 250ms ease; }
      .work-card:hover .work-card__overlay { opacity:1; }
      .work-card__view-btn { display:inline-flex; align-items:center; gap:8px; font-family:'Inter',sans-serif; font-size:0.875rem; font-weight:600; color:#ffffff; background:linear-gradient(90deg,#6147bd,#a78bfa); padding:10px 24px; border-radius:9999px; text-decoration:none; transform:translateY(8px); transition:transform 400ms cubic-bezier(0.175,0.885,0.32,1.275),box-shadow 250ms ease; }
      .work-card:hover .work-card__view-btn { transform:translateY(0); box-shadow:0 4px 24px rgba(124,95,230,0.45); }
      .work-card__body { padding:clamp(1.25rem,2.5vw,2rem); }
      .work-card__tags { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:12px; }
      .work-tag { font-size:0.75rem; font-weight:500; color:#a78bfa; background:rgba(124,95,230,0.12); border:1px solid rgba(124,95,230,0.18); padding:4px 10px; border-radius:9999px; }
      .work-card__title { font-family:'Inter',sans-serif; font-size:1.5rem; font-weight:700; color:#ffffff; margin-bottom:12px; line-height:1.25; }
      .work-card__desc { font-size:0.875rem; color:#8888b0; line-height:1.7; margin:0; }
      .work-card--featured { grid-column:span 2; }
      .work-card--featured .work-card__image { aspect-ratio:16/7; }
      @keyframes fadeInUp { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }
      .work-card { opacity:1; }
      .hidden-card { display:none !important; }
      .card-reveal { animation:fadeInUp 0.5s cubic-bezier(0.22,1,0.36,1) both; }
      .view-more-wrap { text-align:center; margin-top:48px; }
      .btn-arrow-icon { width:18px; height:18px; transition:transform 250ms ease; }
      @media (max-width:768px) {
        .work-grid { grid-template-columns:1fr; }
        .work-card--featured { grid-column:span 1; }
        .work-card--featured .work-card__image { aspect-ratio:16/10; }
        .filter-bar { max-width:360px !important; font-size:0.8rem !important; padding:4px; }
      }
    </style>
  </head>
  <body class="project-page">
    <?php include 'includes/navbar.php'; ?>

    <section class="about-header">
      <video class="header-bg-video" autoplay muted loop playsinline>
        <source src="img/test.mp4" type="video/mp4">
      </video>
      <div class="header-bg-overlay"></div>
      <h1>Work</h1>
      <div class="innovation-badge-exact">
        <span class="badge-desktop">From live projects to powerful case studies and thought-provoking blogs.<br>See how strategy, creativity, and research turn into real results.</span>
        <span class="badge-mobile">Real <span>Work</span>, Real <span>Results</span></span>
      </div>
    </section>

    <h2 class="ux-title" style="margin-top:50px;">A Glimpse Into Our <span class="highlight"> Design Thinking </span></h2>

    <section class="projects-section">
      <div class="projects-container">
        <div class="filter-bar" role="tablist" aria-label="Filter work by category">
          <button class="filter-btn active" data-filter="all"          role="tab" aria-selected="true">All</button>
          <button class="filter-btn"        data-filter="projects"     role="tab" aria-selected="false">Projects</button>
          <button class="filter-btn"        data-filter="case-studies" role="tab" aria-selected="false">Case Studies</button>
          <button class="filter-btn"        data-filter="articles"     role="tab" aria-selected="false">Articles</button>
        </div>

        <div class="work-grid" id="work-grid">
          <div class="work-card" data-category="projects">
            <div class="work-card__image"><img src="img/project3.webp" alt="UX Audit of Distinct Buzz website" loading="lazy" /><div class="work-card__overlay"><a href="https://www.behance.net/gallery/226740155/UX-Audit-Distinct-Buzz" class="work-card__view-btn" target="_blank" rel="noopener noreferrer">View Details →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">UX Audit</span><span class="work-tag">Web</span><span class="work-tag">Featured</span></div><h3 class="work-card__title">Distinct Buzz</h3><p class="work-card__desc">Audited for Impact  we uncovered usability gaps and friction points, resulting in smoother navigation and higher engagement. A comprehensive UX review that transformed the platform's core user flows.</p></div>
          </div>
          <div class="work-card" data-category="projects">
            <div class="work-card__image"><img src="img/project2.webp" alt="UX Audit of CEDAR Himalaya" loading="lazy" /><div class="work-card__overlay"><a href="https://www.behance.net/gallery/226741471/UX-Audit-CEDAR-Himalaya" class="work-card__view-btn" target="_blank" rel="noopener noreferrer">View Details →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">UI/UX</span><span class="work-tag">UX Audit</span><span class="work-tag">Web</span></div><h3 class="work-card__title">CEDAR Himalaya</h3><p class="work-card__desc">Designing for Change  aligning their digital experience with a sustainable mountain development mission, improving accessibility and user trust.</p></div>
          </div>
          <div class="work-card" data-category="case-studies">
            <div class="work-card__image"><img src="img/ikea.webp" alt="IKEA web design Case Study" loading="lazy" /><div class="work-card__overlay"><a href="https://www.behance.net/gallery/229776017/Modern-IKEA-Hero-Design-Stylish-User-Friendly" class="work-card__view-btn" target="_blank" rel="noopener noreferrer">View Case Study →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">Case Study</span><span class="work-tag">Web</span></div><h3 class="work-card__title">IKEA web design</h3><p class="work-card__desc">Reimagining IKEA's digital journey with clarity, structure, and seamless usability. Designed to enhance browsing, inspire customers, and improve conversion flow.</p></div>
          </div>
          <div class="work-card" data-category="case-studies">
            <div class="work-card__image"><img src="img/auria.webp" alt="Auria Branding Project" loading="lazy" /><div class="work-card__overlay"><a href="https://www.behance.net/gallery/231558281/Auria-Branding-Project-Elegant-Modern-Design" class="work-card__view-btn" target="_blank" rel="noopener noreferrer">View Case Study →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">Case Study</span><span class="work-tag">Web</span></div><h3 class="work-card__title">Auria Branding Project</h3><p class="work-card__desc">Creating a refined brand identity that reflects Auria's vision and values. Designed with purposeful visuals, balanced typography, and a cohesive brand system.</p></div>
          </div>
          <div class="work-card" data-category="case-studies">
            <div class="work-card__image"><img src="img/absolut.webp" alt="Absolut Website Design" loading="lazy" /><div class="work-card__overlay"><a href="https://www.behance.net/gallery/234258579/Absolut-Website-Design-Modern-UI-Inspiration" class="work-card__view-btn" target="_blank" rel="noopener noreferrer">View Case Study →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">Case Study</span><span class="work-tag">Web</span></div><h3 class="work-card__title">Absolut Website Design</h3><p class="work-card__desc">A showcase of our strategic design solutions crafted for real-world impact. Each project reflects our commitment to clarity, creativity, and measurable results.</p></div>
          </div>
          <div class="work-card" data-category="case-studies">
            <div class="work-card__image"><img src="img/lays.webp" alt="Lay's Web Redesign" loading="lazy" /><div class="work-card__overlay"><a href="https://www.behance.net/gallery/229598891/Lays-Hero-Section-Web-Redesign" class="work-card__view-btn" target="_blank" rel="noopener noreferrer">View Details →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">UX Audit</span><span class="work-tag">Web</span></div><h3 class="work-card__title">Lay's Web Redesign</h3><p class="work-card__desc">A modern website redesign crafted to enhance brand energy and user engagement. Focused on bold visuals, smooth navigation, and a fresh digital experience.</p></div>
          </div>
          <div class="work-card" data-category="projects">
            <div class="work-card__image"><img src="img/Radhe-Krishna.webp" alt="Radhe Krishna Dashboard Design" loading="lazy" /><div class="work-card__overlay"><a href="https://www.behance.net/uxpacific" class="work-card__view-btn" target="_blank" rel="noopener noreferrer">View Details →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">Dashboard</span><span class="work-tag">Web App</span></div><h3 class="work-card__title">Radhe Krishna</h3><p class="work-card__desc">Thoughtful, user-centered dashboard design that delivers complex data in a clear, actionable, and visually refined interface.</p></div>
          </div>
          <div class="work-card" data-category="projects">
            <div class="work-card__image"><img src="img/Icard.webp" alt="ICard India Mobile UX Audit" loading="lazy" /><div class="work-card__overlay"><a href="https://www.behance.net/gallery/233248725/UX-Audit-for-Icard-India" class="work-card__view-btn" target="_blank" rel="noopener noreferrer">View Details →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">Mobile</span><span class="work-tag">UI/UX</span></div><h3 class="work-card__title">ICard India</h3><p class="work-card__desc">Mobile UX audit uncovering usability barriers in the ICard experience, with a clear roadmap to improve onboarding and retention.</p></div>
          </div>
          <div class="work-card" data-category="projects">
            <div class="work-card__image"><img src="img/God-Incorporation.webp" alt="God Incorporation Mobile UI/UX Design" loading="lazy" /><div class="work-card__overlay"><a href="https://www.behance.net/uxpacific" class="work-card__view-btn" target="_blank" rel="noopener noreferrer">View Details →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">Mobile</span><span class="work-tag">UI/UX</span></div><h3 class="work-card__title">God Incorporation</h3><p class="work-card__desc">Thoughtful, user-centered mobile design delivering engaging and intuitive experiences that connect brands with their audience.</p></div>
          </div>
          <div class="work-card" data-category="articles">
            <div class="work-card__image"><img src="img/a-1.webp" alt="Canva vs Affinity Article" loading="lazy" /><div class="work-card__overlay"><a href="https://medium.com/@uxpacific/canva-affinity-a-new-era-for-creative-precision-fbccfb9aa892" class="work-card__view-btn">Read Article →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">Design Tools</span><span class="work-tag">Creative Workflow</span></div><h3 class="work-card__title">Canva vs Affinity</h3><p class="work-card__desc">How Canva and Affinity tools are redefining creative workflows by blending simplicity with powerful precision for designers.</p></div>
          </div>
          <div class="work-card" data-category="articles">
            <div class="work-card__image"><img src="img/a-2.webp" alt="AI Loyal Assistant Article" loading="lazy" /><div class="work-card__overlay"><a href="https://medium.com/@uxpacific/ai-loyal-assistant-or-silent-takeover-326f5392a085" class="work-card__view-btn">Read Article →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">AI Ethics</span><span class="work-tag">Future of Work</span></div><h3 class="work-card__title">AI: Loyal Assistant or Silent Takeover?</h3><p class="work-card__desc">Exploring whether AI acts as a supportive design partner or quietly reshapes the future of work and creativity.</p></div>
          </div>
          <div class="work-card" data-category="articles">
            <div class="work-card__image"><img src="img/a-3.webp" alt="Beyond Design Thinking Article" loading="lazy" /><div class="work-card__overlay"><a href="https://medium.com/@uxpacific/beyond-design-thinking-ea40b744470e" class="work-card__view-btn">Read Article →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">Design Thinking</span><span class="work-tag">Systems Thinking</span></div><h3 class="work-card__title">Beyond Design Thinking</h3><p class="work-card__desc">A deeper look at what lies beyond design thinking  blending empathy, systems thinking, and strategic creativity to solve complex problems.</p></div>
          </div>
          <div class="work-card" data-category="articles">
            <div class="work-card__image"><img src="img/a-4.webp" alt="How Much AI Is Too Much?" loading="lazy" /><div class="work-card__overlay"><a href="https://medium.com/@uxpacific/how-much-ai-is-too-much-294c0e9b2c61" class="work-card__view-btn">Read Article →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">AI Boundaries</span><span class="work-tag">UX Balance</span></div><h3 class="work-card__title">How Much AI Is Too Much?</h3><p class="work-card__desc">An exploration of finding the right balance with AI  maximizing benefits without losing human creativity and control.</p></div>
          </div>
          <div class="work-card" data-category="articles">
            <div class="work-card__image"><img src="img/a-5.webp" alt="Mistakes in Design Thinking" loading="lazy" /><div class="work-card__overlay"><a href="https://medium.com/@uxpacific/mistakes-in-the-design-thinking-why-design-thinking-often-fails-in-practice-14e6f47ceda4" class="work-card__view-btn">Read Article →</a></div></div>
            <div class="work-card__body"><div class="work-card__tags"><span class="work-tag">Common Pitfalls</span><span class="work-tag">Better Practice</span></div><h3 class="work-card__title">Mistakes in Design Thinking</h3><p class="work-card__desc">A critical look at why design thinking can fall short in real projects and how to avoid the most common pitfalls.</p></div>
          </div>
        </div>

        <div class="view-more-wrap">
          <button id="view-more-btn" class="view-more-btn btn-purple" style="gap:10px;">
            <span class="btn-text">View More</span>
            <svg class="btn-arrow-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
          </button>
        </div>
      </div>
    </section>

    <h2 class="ux-subtitle" style="margin-top:100px">Our Clients <span class="ux-line"></span></h2>
    <div class="logo-slider">
      <div class="logo-track">
        <img src="img/c1.png" alt="Client logo" /><img src="img/c2.png" alt="Client logo" /><img src="img/c3.png" alt="Client logo" />
        <img src="img/c4.png" alt="Client logo" /><img src="img/c5.png" alt="Client logo" /><img src="img/c6.png" alt="Client logo" />
        <img src="img/c1.png" alt="Client logo" aria-hidden="true" /><img src="img/c2.png" alt="Client logo" aria-hidden="true" />
        <img src="img/c3.png" alt="Client logo" aria-hidden="true" /><img src="img/c4.png" alt="Client logo" aria-hidden="true" />
        <img src="img/c5.png" alt="Client logo" aria-hidden="true" /><img src="img/c6.png" alt="Client logo" aria-hidden="true" />
      </div>
    </div>

    <section class="cta-section">
      <div class="dots-bg desktop-only"><canvas id="dots-canvas"></canvas></div>
      <div class="cta-container">
        <div class="cta-text cta-text--padded">
          <h2>Start your <span>UI/UX</span> journey with <br /><span class="highlight">UX Pacific Team</span></h2>
          <p class="mt-4 mb-4 cta-desc">Build your site effortlessly and showcase your work with confidence.<br />Ready to stand out? Get started today!</p>
          <a href="/contact" class="cta-button cta-button--wide">Get in touch <span class="arrow"></span></a>
        </div>
        <div class="cta-blur-overlay"></div>
        <div class="cta-image"><img src="img/Rectangle 5192.webp" alt="UX designer working on a digital product" /></div>
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const filterBtns   = document.querySelectorAll('.filter-btn');
        const workCards    = Array.from(document.querySelectorAll('.work-card[data-category]'));
        const viewMoreBtn  = document.getElementById('view-more-btn');
        const viewMoreWrap = document.querySelector('.view-more-wrap');
        let expanded = false;

        function revealCard(card, delay) {
          card.classList.remove('hidden-card', 'card-reveal');
          void card.offsetWidth;
          card.style.animationDelay = delay + 'ms';
          card.classList.add('card-reveal');
        }

        function getLimit() {
          return window.innerWidth <= 767 ? 2 : 4;
        }

        function renderCards(animateAll) {
          const activeFilter = document.querySelector('.filter-btn.active')?.dataset.filter || 'all';
          const limit = getLimit();
          const matching = [];

          workCards.forEach(card => {
            const matches = activeFilter === 'all' || (card.dataset.category || '').includes(activeFilter);
            if (matches) {
              matching.push(card);
            } else {
              card.classList.add('hidden-card');
              card.classList.remove('card-reveal');
              card.style.animationDelay = '';
            }
          });

          matching.forEach((card, i) => {
            if (i < limit || expanded) {
              const wasHidden = card.classList.contains('hidden-card');
              if (wasHidden || animateAll) revealCard(card, i * 60);
            } else {
              card.classList.add('hidden-card');
              card.classList.remove('card-reveal');
              card.style.animationDelay = '';
            }
          });

          if (viewMoreWrap && viewMoreBtn) {
            viewMoreWrap.style.display = (!expanded && matching.length > limit) ? 'block' : 'none';
          }
        }

        filterBtns.forEach(btn => {
          btn.addEventListener('click', () => {
            filterBtns.forEach(b => { b.classList.remove('active'); b.setAttribute('aria-selected','false'); });
            btn.classList.add('active');
            btn.setAttribute('aria-selected','true');
            expanded = false;
            renderCards(true);
          });
          btn.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
          });
        });

        if (viewMoreBtn) {
          viewMoreBtn.addEventListener('click', () => {
            expanded = true;
            renderCards(false);
          });
        }

        renderCards(true);
      });
    </script>
  </body>
</html>
