<?php
$pageTitle    = 'Services | UX Pacific';
$pageDesc     = 'Explore UX Pacific\'s full range of design services — UI/UX design, UX audits, product design, user research, and more for startups and enterprises.';
$canonicalUrl = 'https://www.uxpacific.com/services.php';
$ogTitle      = 'Services | UX Pacific';
$ogDesc       = 'From UX audits to full product design, UX Pacific offers tailored design services for every stage of your digital product journey.';
$ogUrl        = 'https://www.uxpacific.com/services.php';
$currentPage  = 'services';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
  </head>
  <body class="services-page">
    <?php include 'includes/navbar.php'; ?>

    <section class="about-header">
      <div class="gallery-container"><img src="img/bg_ani.gif" class="img1" alt="Abstract background animation" /></div>
      <h1>Services</h1>
      <div class="innovation-badge-exact">
        We design user-focused digital solutions that combine strategy, creativity, and research.<br>
        From UI to brand strategy, every service is built to deliver real results.
      </div>
    </section>

    <h2 class="title" style="margin-top: 50px;">Design that simply <em>makes sense</em></h2>

    <main>
      <section class="services-grid-section mb-5 mt-5">
        <div class="container text-center">
          <div class="row g-4 justify-content-center" id="services-grid-container" style="max-width:1200px;margin:0 auto;">
            <!-- Cards populated dynamically by JS -->
          </div>
        </div>
      </section>
    </main>

    <section class="cta-section">
      <div class="dots-bg desktop-only"><canvas id="dots-canvas"></canvas></div>
      <div class="cta-container">
        <div class="cta-text">
          <h1>Start your <span> UI/UX </span> journey with <br /><span class="highlight"> UXPacific Team </span></h1>
          <p class="mt-4 mb-4">Build your site effortlessly and showcase your work with confidence.<br />Ready to stand out? Get started today!</p>
          <a class="cta-button" href="contact.php">Get in touch <span class="arrow"> </span></a>
        </div>
        <div class="cta-blur-overlay"></div>
        <div class="cta-image"><img alt="UX Design" src="img/Rectangle 5192.webp" /></div>
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <!-- Offcanvas for Service Details -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="serviceOffcanvas" aria-labelledby="serviceOffcanvasLabel" style="width:650px;background-color:#111111;color:#fff;max-width:100vw;border-left:1px solid #2e2e3e;">
      <div class="offcanvas-header pb-0 border-0" style="padding:24px 32px;">
        <div class="d-flex w-100 justify-content-between align-items-start">
          <div id="oc-icon" style="width:48px;height:48px;background:rgba(255,255,255,0.05);border:1px solid #2e2e3e;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#fff;"><i class="fas fa-palette"></i></div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" style="font-size:12px;opacity:0.5;"></button>
        </div>
      </div>
      <div class="offcanvas-body" style="padding:16px 32px 32px 32px;">
        <h3 id="oc-title" style="font-size:24px;font-weight:700;margin-bottom:24px;color:#fff;">UI Design &amp; Prototyping</h3>
        <p id="oc-desc" style="color:#b2bad6;font-size:15px;margin-bottom:32px;line-height:1.6;">We craft pixel-perfect interfaces that look beautiful and feel effortless. Every interaction is intentional.</p>
        <h6 style="font-size:12px;font-weight:700;color:#a78bfa;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">What This Solves</h6>
        <div class="row g-2 mb-4" id="oc-solves" style="color:#e0e0e0;font-size:14px;"></div>
        <h6 style="font-size:12px;font-weight:700;color:#a78bfa;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">How We Work</h6>
        <div id="oc-steps" class="mb-4"></div>
        <h6 style="font-size:12px;font-weight:700;color:#a78bfa;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">What Changes After This</h6>
        <div class="row g-2 mb-4" id="oc-changes" style="color:#e0e0e0;font-size:14px;"></div>
        <div class="accordion mb-4 border-0" id="deliverablesAccordion" style="--bs-accordion-border-width:0;--bs-accordion-bg:transparent;">
          <div class="accordion-item border-0" style="background:rgba(255,255,255,0.05);border:1px solid #2e2e3e;border-radius:8px;overflow:hidden;">
            <h2 class="accordion-header" id="headingDeliverables">
              <button class="accordion-button collapsed shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDeliverables" aria-expanded="false" style="background:transparent;color:#fff;font-weight:600;font-size:14px;padding:16px;">See Deliverables</button>
            </h2>
            <div id="collapseDeliverables" class="accordion-collapse collapse" aria-labelledby="headingDeliverables">
              <div class="accordion-body" style="padding:0 16px 16px 16px;">
                <ul id="oc-deliverables" style="list-style:none;padding:0;margin:0;color:#b2bad6;font-size:14px;line-height:2;"></ul>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-auto pt-3 pb-4">
          <div class="text-center">
            <a href="contact.php" class="custom-discuss-btn" style="background-color:#6147bd;color:#ffffff;padding:14px 40px;border-radius:50px;text-decoration:none;font-weight:500;font-size:18px;display:inline-block;box-shadow:0 10px 30px rgba(97,71,189,0.5);min-width:250px;">Discuss This Service</a>
          </div>
        </div>
      </div>
    </div>

    <style>
      .ux-card { background:#111111; border-radius:12px; padding:32px 24px; text-align:left; color:#fff; box-shadow:0 4px 6px -1px rgba(0,0,0,0.3),0 2px 4px -1px rgba(0,0,0,0.2); height:100%; display:flex; flex-direction:column; cursor:pointer; transition:transform 0.2s ease,box-shadow 0.2s ease,border-color 0.2s ease; border:1px solid #2e2e3e; text-decoration:none !important; }
      .ux-card:hover { transform:translateY(-4px); box-shadow:0 10px 15px -3px rgba(0,0,0,0.5),0 4px 6px -2px rgba(0,0,0,0.3); border-color:#a78bfa; }
      .ux-card-icon { width:48px; height:48px; background:rgba(255,255,255,0.05); border:1px solid #2e2e3e; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:20px; color:#fff; margin-bottom:24px; }
      .ux-card-title { font-size:18px; font-weight:600; margin-bottom:12px; color:#fff; }
      .ux-card-desc { font-size:14px; color:#b2bad6; margin-bottom:24px; flex-grow:1; line-height:1.5; }
      .ux-card-link { font-size:14px; color:#a78bfa; font-weight:500; }
      .ux-card:hover .ux-card-link { color:#d8b4fe; }
      .oc-step { background:rgba(255,255,255,0.05); border:1px solid #2e2e3e; border-radius:8px; padding:12px 16px; margin-bottom:8px; display:flex; align-items:center; font-size:14px; color:#e0e0e0; }
      .oc-step-num { color:#a78bfa; margin-right:16px; font-size:13px; font-weight:600; }
      .accordion-button::after { filter:invert(1) grayscale(100%) brightness(200%); }
    </style>

   <script>
const servicesData = [

{ id:1, title:"UX Research & Testing", desc:"Turning user insights into exceptional digital experiences", icon:"fa-search", fullDesc:"At UXPACIFIC, our UX Research & Testing services help organizations make confident, data-driven design decisions by uncovering real user behaviors, motivations, and expectations.", solves:["Unclear understanding of user needs","High product failure risk","Low usability and poor engagement","Inefficient user journeys","Low conversion rates","Design decisions based on assumptions","Difficulty achieving product-market fit"], steps:["Research Planning & Objectives Definition","Participant Recruitment & Screening","Data Collection (Interviews, Surveys, Testing)","Behavior Analysis & Insight Synthesis","Reporting & Strategic Recommendations","Design Validation & Optimization"], changes:["Data-driven product decisions","Improved usability and accessibility","Higher customer satisfaction","Faster product-market fit","Reduced development risks","Increased conversions and engagement","Clear understanding of user behavior"], deliverables:["Research Strategy Plan","User Personas","Usability Testing Reports","UX Insight Dashboards","Design Recommendations","Recorded Testing Sessions","Stakeholder Presentation Decks"] },

{ id:2, title:"UI Design & Prototyping", desc:"Designing beautiful, intuitive & high-performance digital interfaces", icon:"fa-palette", fullDesc:"At UXPACIFIC, we create visually compelling and highly intuitive UI Design & Prototyping solutions that blend creativity with usability and conversion optimization.", solves:["Poor visual consistency across platforms","Low user engagement and retention","Unclear navigation and interface confusion","Slow product validation cycles","Design-development communication gaps","Lack of scalable UI systems","Weak brand experience in digital products"], steps:["Understanding Business Goals & Users","UX Flow & Wireframe Creation","Visual Style Exploration","High-Fidelity UI Design","Interactive Prototyping","Client Feedback & Iteration","Developer Handoff & Support"], changes:["Stronger first impressions","Improved usability and engagement","Higher conversion rates","Faster product validation","Better collaboration between design and development","Consistent and scalable visual systems","Enhanced brand credibility"], deliverables:["High-Fidelity UI Screens","Interactive Clickable Prototypes","Responsive UI Layouts","UI Style Guide","Design System Components","Developer Handoff Files","Animations & Micro-interaction Assets"] },

{ id:3, title:"Design Systems & Accessibility", desc:"Building scalable, consistent & inclusive digital experiences", icon:"fa-layer-group", fullDesc:"At UXPACIFIC, we create robust Design Systems and Accessibility frameworks that help organizations scale digital products with consistency and inclusivity.", solves:["Inconsistent UI across products and platforms","Slow design and development workflows","Lack of reusable components and standards","Accessibility compliance challenges","Poor cross-team collaboration","Scaling issues in growing digital ecosystems","High maintenance cost of fragmented UI systems"], steps:["Audit & Accessibility Assessment","Design System Architecture Definition","Component & Token Creation","Figma Component System Development","Accessibility Integration (WCAG Standards)","Documentation & Usage Guidelines","Team Training & Enablement","Governance Setup & Version Control","Continuous Improvement & Compliance Monitoring"], changes:["Faster product development cycles","Consistent user experiences across platforms","Reduced design and development costs","Improved collaboration between design and engineering teams","Accessible and inclusive digital products","Scalable UI systems for long-term growth","Stronger brand consistency","Simplified maintenance and updates"], deliverables:["Full Design System Library","Reusable UI Component Framework","Design Tokens & Variables","Accessibility Compliance Report","Documentation Portal & Usage Guidelines","Figma Component System","Governance & Version Control Model","Design QA Reports","Training Sessions & Adoption Support"] },

{ id:4, title:"UX Content & Microinteractions", desc:"Enhancing digital experiences through meaningful words and delightful interactions", icon:"fa-comment-dots", fullDesc:"At UXPACIFIC, we craft impactful UX content and microinteractions that transform digital products into intuitive and emotionally connected experiences.", solves:["Confusing interface messaging","Poor onboarding and user guidance","Low engagement and retention","Lack of feedback during user actions","Inconsistent product tone and voice","Weak emotional connection with users"], steps:["Content Audit & UX Evaluation","User Flow & Communication Analysis","UX Writing Strategy Development","Microinteraction Design Planning","Implementation & Interactive Prototyping","Testing & Refinement","Engagement Optimization"], changes:["Improved user comprehension","Reduced friction and confusion","Higher engagement and retention","Stronger brand personality","Better task completion rates","Increased conversions through clear messaging"], deliverables:["UX Content Guidelines","Interface Copywriting","Onboarding Content Flows","Microinteraction Prototypes","Motion UX Elements","Content Optimization Reports"] },

{ id:5, title:"UX Analytics & Optimization", desc:"Turning user data into high-performance digital experiences", icon:"fa-chart-line", fullDesc:"At UXPACIFIC, we provide advanced UX Analytics & Optimization services that help organizations continuously improve digital products using real user data.", solves:["Low conversion rates and engagement","High user drop-offs in funnels","Limited visibility into user behavior","Inefficient user journeys","Unclear UX performance metrics","Design decisions based on assumptions","Difficulty measuring ROI of UX improvements"], steps:["UX Data Collection & Analytics Setup","User Behavior & Funnel Analysis","Friction Point Identification","Optimization Strategy Creation","A/B Testing & Experimentation","Continuous Monitoring & Performance Tracking","Iteration & Improvement Implementation"], changes:["Higher conversion rates","Reduced user friction and drop-offs","Improved engagement and satisfaction","Data-driven decision making","Better ROI from digital products","Continuous experience improvement","Clear performance visibility"], deliverables:["UX Analytics Dashboard","Conversion Optimization Reports","Heatmap Insights","UX Improvement Roadmap","A/B Testing Results","Performance Monitoring Reports"] },

{ id:6, title:"Software Development", desc:"Building scalable, secure & high-performance digital solutions", icon:"fa-code", fullDesc:"At UXPACIFIC, we provide end-to-end Software Development services that transform ideas into reliable, scalable, and high-performing digital products.", solves:["Outdated software systems","Scalability and performance challenges","Disconnected platforms","Slow development cycles","Security issues","Weak technical architecture"], steps:["Requirement Analysis","System Architecture Design","Frontend & Backend Development","API Integrations","Testing & QA","Deployment","Maintenance"], changes:["Improved performance","Secure applications","Scalable infrastructure","Faster operations","Reduced inefficiencies","Future-ready systems"], deliverables:["Custom Applications","SaaS Solutions","API Development","Database Architecture","DevOps Setup","QA Reports","Technical Documentation"] },

{ id:7, title:"Mobile, SaaS & eCommerce UX", desc:"Designing high-performance digital experiences that drive growth across platforms", icon:"fa-mobile-screen", fullDesc:"At UXPACIFIC, we design scalable and conversion-focused UX solutions tailored for mobile applications, SaaS platforms, and eCommerce products.", solves:["Low user adoption","High churn","Cart abandonment","Poor navigation","Complex workflows","Inconsistent cross-platform UX"], steps:["User Research","Journey Mapping","IA & User Flows","Wireframing","UI Design","Prototyping","Optimization"], changes:["Improved adoption","Higher retention","Reduced churn","Better conversions","Faster task completion","Consistent experiences"], deliverables:["UX Strategy","User Flow Diagrams","Wireframes","High-Fidelity Designs","Prototypes","Usability Reports"] },

{ id:8, title:"UX Design & Strategy", desc:"Driving digital success through human-centered experiences", icon:"fa-lightbulb", fullDesc:"We align user behavior, business goals, and technology to create seamless and scalable digital strategies.", solves:["Unclear product vision","Low adoption","Disconnected journeys","Poor IA","Business misalignment","Product-market fit issues"], steps:["Discovery","UX Audit","Strategy Definition","Journey Mapping","Wireframes","Validation","Optimization"], changes:["Clear roadmap","Higher satisfaction","Better retention","Stronger alignment","Faster growth","Scalable foundation"], deliverables:["UX Strategy Roadmap","UX Audit Report","Journey Maps","IA Diagrams","Workshop Outputs","UX Deck","Wireframes"] },

{ id:9, title:"Branding & Graphics", desc:"Creating impactful visual identities and compelling brand experiences", icon:"fa-pen-nib", fullDesc:"We craft strategic branding solutions that build strong, consistent, and memorable identities.", solves:["Inconsistent branding","Weak recognition","Unclear messaging","Poor marketing visuals","Disconnected design language"], steps:["Brand Discovery","Strategy","Concept Development","Logo Design","Style System","Guidelines","Implementation"], changes:["Stronger recognition","Consistent identity","Better engagement","Professional presence","Higher trust"], deliverables:["Logo System","Color & Typography","Brand Guide","Marketing Assets","Presentation Templates","Iconography"] },

{ id:10, title:"Emerging Tech UX", desc:"Designing the future of digital experiences through innovation", icon:"fa-robot", fullDesc:"We design intuitive UX solutions for AI, AR/VR, IoT, and Web3 technologies.", solves:["Low tech adoption","Complex interfaces","Lack of trust in AI","High learning curve","Disconnected smart systems"], steps:["Tech Research","Behavior Analysis","UX Mapping","Prototype","Testing","Iteration","Optimization"], changes:["Higher adoption","Reduced complexity","Improved trust","Future-ready products","Competitive advantage"], deliverables:["Emerging Tech UX Strategy","AI Interface Design","AR/VR Prototypes","Voice UX Flows","IoT Dashboards","Web3 Frameworks"] },

{ id:11, title:"Live Design Sessions & Events", desc:"Real-time collaboration, learning, and design innovation", icon:"fa-users", fullDesc:"Interactive UX workshops and live design problem-solving sessions.", solves:["Slow UX cycles","Low collaboration","Unclear direction","Delayed decisions"], steps:["Planning","Onboarding","Live Collaboration","Prototyping","Feedback","Documentation"], changes:["Immediate insights","Faster innovation","Better teamwork","Actionable results"], deliverables:["Workshop Reports","Prototypes","UX Outputs","Session Recordings","Learning Materials"] },

{ id:12, title:"Full-Service UX Retainers", desc:"Your dedicated UX partner for continuous product growth", icon:"fa-handshake", fullDesc:"Ongoing access to a multidisciplinary UX team for continuous optimization.", solves:["Fragmented workflows","Slow releases","Lack of in-house UX","Scaling challenges"], steps:["Assessment","Team Allocation","Monthly Planning","Sprints","Testing","Reporting"], changes:["Consistent improvement","Faster iterations","Lower costs","Scalable support"], deliverables:["Monthly UX Roadmap","Continuous Design Updates","Prototypes","UX Dashboards","Growth Recommendations"] }

];

function renderServiceCards() {
  const container = document.getElementById('services-grid-container');
  container.innerHTML = servicesData.map(s => `
    <div class="col-12 col-md-6 col-lg-4">
      <div class="ux-card" onclick="openService(${s.id})" data-bs-toggle="offcanvas" data-bs-target="#serviceOffcanvas">
        <div class="ux-card-icon"><i class="fas ${s.icon}"></i></div>
        <div class="ux-card-title">${s.title}</div>
        <div class="ux-card-desc">${s.desc}</div>
        <div class="ux-card-link">Explore Service →</div>
      </div>
    </div>
  `).join('');
}

function openService(id) {
  const s = servicesData.find(x => x.id === id);
  if (!s) return;
  document.getElementById('oc-icon').innerHTML = `<i class="fas ${s.icon}"></i>`;
  document.getElementById('oc-title').textContent = s.title;
  document.getElementById('oc-desc').textContent = s.fullDesc;
  document.getElementById('oc-solves').innerHTML = s.solves.map(x => `<div class="col-6"><div style="background:rgba(255,255,255,0.05);border-radius:6px;padding:8px 12px;font-size:13px;">✓ ${x}</div></div>`).join('');
  document.getElementById('oc-steps').innerHTML = s.steps.map((x,i)=>`<div class="oc-step"><span class="oc-step-num">${String(i+1).padStart(2,'0')}</span>${x}</div>`).join('');
  document.getElementById('oc-changes').innerHTML = s.changes.map(x => `<div class="col-6"><div style="background:rgba(167,139,250,0.1);border-radius:6px;padding:8px 12px;font-size:13px;color:#c4b5fd;">→ ${x}</div></div>`).join('');
  document.getElementById('oc-deliverables').innerHTML = s.deliverables.map(x => `<li>• ${x}</li>`).join('');
}

document.addEventListener('DOMContentLoaded', renderServiceCards);
</script>  </body>
</html>
