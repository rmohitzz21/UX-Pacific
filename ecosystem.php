<?php
$pageTitle    = 'Ecosystem | UX Pacific';
$pageDesc     = 'Discover the UX Pacific ecosystem — a community-driven network of designers, mentors, collaborators, and tools shaping the future of UX design.';
$canonicalUrl = 'https://www.uxpacific.com/ecosystem.php';
$ogTitle      = 'Ecosystem | UX Pacific';
$ogDesc       = 'Join the UX Pacific ecosystem. Connect with a thriving community of UX professionals, access resources, and grow your design career.';
$ogUrl        = 'https://www.uxpacific.com/ecosystem.php';
$currentPage  = 'ecosystem';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <style>
      .eco-accordion-container { display:flex; flex-direction:column; gap:16px; max-width:1000px; margin:4rem auto; padding:0 1rem; }
      .eco-acc-item { background:#141416; border:1px solid #1c1c1f; border-radius:8px; overflow:hidden; transition:border-color 0.3s ease,box-shadow 0.3s ease; }
      .eco-acc-item:hover { border-color:#3f3f46; background:#18181b; }
      .eco-acc-header { width:100%; display:flex; justify-content:space-between; align-items:center; padding:24px; background:transparent; border:none; color:white; font-family:'DM Sans',sans-serif; font-size:1.35rem; font-weight:600; cursor:pointer; transition:background 0.3s; }
      .eco-acc-header:hover { background:rgba(255,255,255,0.02); }
      .drop-icon { transition:transform 0.3s ease; color:#fff; font-size:1.2rem; }
      .eco-acc-header[aria-expanded="true"] .drop-icon { transform:rotate(180deg); color:#a78bfa; }
      .eco-acc-body { padding:0 24px 24px; margin-top:12px; }
      .eco-btn { display:inline-flex; align-items:center; margin-top:auto; padding:0.8rem 2rem; background:linear-gradient(90deg,#6e54bb,#845ef7); border-radius:999px; color:white; font-weight:600; text-decoration:none; transition:all 0.3s; border:none; }
      .eco-btn:hover { background:linear-gradient(90deg,#845ef7,#6e54bb); box-shadow:0 4px 15px rgba(132,94,247,0.4); color:white; }
      @media (max-width:768px) {
        .services { flex-direction:column !important; padding:20px 12px !important; margin-bottom:50px !important; gap:16px !important; overflow:visible !important; display:flex !important; }
        .service-card { width:100% !important; flex:none !important; margin:0 !important; padding:20px !important; border:1px solid rgba(255,255,255,0.1) !important; border-radius:12px !important; background:transparent !important; display:flex !important; flex-direction:column !important; align-items:flex-start !important; min-height:unset !important; }
        .service-card .service-icon { display:block !important; margin-bottom:12px !important; }
        .service-card .service-icon img { width:48px !important; height:48px !important; }
        .service-card h3 { margin:0 0 8px 0 !important; font-size:18px !important; font-weight:600 !important; text-align:left !important; color:white !important; }
        .service-card p { display:block !important; font-size:13px !important; line-height:1.5 !important; color:rgba(255,255,255,0.65) !important; margin-bottom:12px !important; }
        .service-card a { display:inline-block !important; font-size:13px !important; }
        .eco-acc-header { padding:16px !important; font-size:1.1rem !important; }
        .eco-acc-body { padding:0 16px 16px !important; }
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
      <h1>Ecosystem</h1>
      <div class="innovation-badge-exact">
        Our ecosystem connects learning, resources, and community in one unified space.<br>
        From UX Shop to UX Academy and UX Community, we empower designers at every stage.
      </div>
    </section>

    <h2 class="ux-title" style="margin-top: 50px;">Expand Your Experience With <span class="highlight"> UX Pacific </span></h2>

    <div class="services">
      <div class="service-card" onclick="window.open('#','_blank')" style="cursor:pointer;">
        <div class="service-icon"><img alt="UI" src="img/shop1.png" /></div>
        <h3>UX Pacific Shop</h3>
        <p>Access premium UI kits, design systems, and templates crafted by industry experts to speed up your workflow and elevate your final products.</p>
        <a href="#" target="_blank" style="text-decoration:none;color:#6366f1;font-weight:500;">View Details &rarr;</a>
      </div>
      <div class="service-card" onclick="window.open('https://academy.uxpacific.com/','_blank')" style="cursor:pointer;">
        <div class="service-icon"><img alt="Audit" src="img/acedmy.png" /></div>
        <h3>UX Academy</h3>
        <p>Level up your skills with our hands-on workshops, courses, and mentorship programs specifically tailored and designed for future design leaders.</p>
        <a href="https://academy.uxpacific.com/" target="_blank" style="text-decoration:none;color:#6366f1;font-weight:500;">View Details &rarr;</a>
      </div>
      <div class="service-card" onclick="window.open('https://community.uxpacific.com/','_blank')" style="cursor:pointer;">
        <div class="service-icon"><img alt="Strategy" src="img/community.png" /></div>
        <h3>UX Community</h3>
        <p>Be part of a thriving network where ideas turn into reality. Join our broader UX Pacific ecosystem community to connect and grow.</p>
        <a href="https://community.uxpacific.com/" target="_blank" style="text-decoration:none;color:#6366f1;font-weight:500;">View Details &rarr;</a>
      </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
  </body>
</html>
