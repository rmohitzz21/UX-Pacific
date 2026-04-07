<?php
$pageTitle    = 'Home | UX Pacific';
$pageDesc     = 'UX Pacific is a leading UI/UX design agency delivering intuitive digital experiences, user research, and product design for global clients.';
$canonicalUrl = 'https://www.uxpacific.com/';
$ogTitle      = 'Home | UX Pacific';
$ogDesc       = 'UX Pacific creates exceptional digital experiences through research-driven UI/UX design. Explore our services, work, and ecosystem.';
$ogUrl        = 'https://www.uxpacific.com/';
$ldJson       = '{"@context":"https://schema.org","@type":"Organization","name":"UX Pacific","url":"https://www.uxpacific.com","logo":"https://www.uxpacific.com/img/LOGO.png","contactPoint":{"@type":"ContactPoint","telephone":"+91-92740-61063","contactType":"customer service","email":"hello@uxpacific.com"},"sameAs":["https://www.linkedin.com/company/uxpacific/","https://www.behance.net/uxpacific","https://www.instagram.com/official_uxpacific/"]}';
$currentPage  = 'home';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>

    <div class="hero-wrapper" style="position: relative; overflow: hidden">
      <canvas id="interactive-canvas" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:0;"></canvas>
      <div class="custom-cursor"></div>
      <section class="hero">
        <h1 id="heading">
          WE CRAFT UX THAT MAKES THEM 
          <br />
          <span style="font-weight: 200">
            STAY, ENGAGE,
            <span style="font-weight: 800"> AND </span>
            CONVERT.
          </span>
        </h1>
        <p class="subtext">Designing Experiences, Not Just Interfaces</p>
        <br />
        <a class="cta-button" href="#" data-bs-toggle="modal" data-bs-target="#auditModal" style="width:210px;height:42px;margin-top:0px;padding-left:27px;">
          Book a UX Audit <span class="arrow"> </span>
        </a>
        <br /><br /><br /><br /><br />
        <div class="ux-header">
          <span class="ux-badg"> </span>
          <div class="scroller">
            <ul class="scroller__inner">
              <li class="scroller__item">SIMPLE</li>
              <li class="scroller__item">INTENTIONAL</li>
              <li class="scroller__item">HUMAN</li>
              <li class="scroller__item">SCALABLE</li>
              <li class="scroller__item">SMART</li>
              <li class="scroller__item">EMPATHETIC</li>
              <li class="scroller__item">MEASURED</li>
              <li class="scroller__item">IMPACTFUL</li>
              <li class="scroller__item">ACCESSIBLE</li>
            </ul>
          </div>
          <span class="ux-end"> </span>
        </div>
      </section>
    </div>

    <div class="ux-content mt-5 mb-5">
      <h3 class="ux-subtitle" style="margin-top: 50px">
        About Us <span class="ux-line"> </span>
      </h3>
      <h2 class="ux-title">
        Where Strategy Meets <span class="highlight"> Stunning </span> Design
      </h2>
      <p class="ux-description">
        We're a creative UX/UI design studio passionate about building human-centered digital products that inspire, engage, and perform.
      </p>
      <a class="view-more" href="/about"> View More &rarr; </a>
      <br />
    </div>

    <div class="ux-image-container" style="margin-top: 80px">
      <img alt="UX Strategy" class="ux-image" id="ii1" src="img/b.webp" />
      <div class="floating-tag" id="d1" style="top:15%;left:5%;width:119px;font-size:16px;transform:rotate(-13.19deg);">Accessibility</div>
      <span class="tag-image" id="d66" style="top:26%;left:14%;background-image:url('img/shruti.png')"></span>
      <div class="floating-tag" id="d3" style="top:22.5%;left:22%;width:75px;font-size:16px;transform:rotate(15.19deg);">UI/UX</div>
      <div class="floating-tag" id="d1" style="top:60%;left:15%;width:119px;font-size:16px;transform:rotate(19.19deg);">Wireframing</div>
      <span class="tag-image" id="d55" style="top:70%;left:24%;background-image:url('img/aradhya.png')"></span>
      <div class="floating-tag transform-sm rotate-90" id="d2" style="top:77%;left:3%;width:119px;font-size:16px;transform:rotate(25deg);">Navigation</div>
      <div id="fixitBtn" style="top:0%;left:52%;font-size:16px">
        <div class="main-container">
          <div class="brush-strokes" id="brush"><img alt="Brush Strokes" id="emoj" src="img/emojisad.png" /></div>
          <div class="puppet" id="puppet"><img alt="Finger Puppet" src="img/hand.png" /></div>
          <button class="fixit-btn">Fix It</button>
        </div>
      </div>
      <span class="tag-image" id="d33" style="top:20%;left:60%;background-image:url('img/you.png')"></span>
      <div class="floating-tag" id="d4" style="top:15%;left:85%;width:138px;font-size:16px;transform:rotate(-20deg);">Simplification</div>
      <span class="tag-image" id="d44" style="top:25%;left:90%;background-image:url('img/zulla.png')"></span>
      <div class="floating-tag" id="d5" style="top:30%;left:70%;width:140.96px;font-size:16px;transform:rotate(12.19deg);">Design System</div>
      <div class="floating-tag" id="d6" style="top:50%;left:87%;width:119px;font-size:16px;transform:rotate(18.19deg);">Interaction</div>
      <div class="floating-tag" id="d1" style="top:73%;left:70%;width:119px;height:40px;font-size:16px;transform:rotate(-13.19deg);">Functionality</div>
      <span class="tag-image" id="d1" style="top:80%;left:80%;background-image:url('img/vedant.png')"></span>
    </div>

    <section class="services-section1">
      <h5>Our Services</h5>
      <span class="ux-line"> </span>
      <h1>Design Solutions That <br />Put <span> Users </span> First</h1>
      <p class="ux-description">We're a creative UX/UI design studio passionate about building human-centered digital products that inspire, engage, and perform.</p>
      <div class="services-container1" id="slider" style="margin-top: 100px">
        <div class="service-card1"><img alt="Interface" src="img/f1.jpeg" /><h3>Interface</h3></div>
        <div class="service-card1"><img alt="UX Audit" src="img/f2.jpeg" /><h3>UX Audit</h3></div>
        <div class="service-card1"><img alt="User Flow" src="img/f3.jpeg" /><h3>User Flow</h3></div>
      </div>
    </section>

    <div class="section-title" style="margin-top: 50px">
      <h3 class="ux-subtitle">Our Services <span class="ux-line"> </span></h3>
      <h2>Design Solutions That Put <span> Users </span> First</h2>
      <p class="ux-description">From sleek interfaces to seamless user flows, our portfolio reflects our commitment to crafting digital experiences that work beautifully.</p>
    </div>
    <style>
      .service-pill-box { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.1); border-radius:8px; padding:16px 20px; text-align:center; color:#e0e0e0; display:flex; align-items:center; justify-content:center; height:100%; min-height:80px; transition:all 0.3s ease; font-size:15px; font-weight:500; cursor:default; }
      .service-pill-box:hover { border-color:#a78bfa; background:rgba(167,139,250,0.05); color:#fff; transform:translateY(-2px); }
      .services-pill-container { max-width:1000px; margin:0 auto; padding:0 15px; }
      @media (max-width:768px) {
        .services-pill-container .row { align-items:stretch; }
        .services-pill-container .col-6 { display:flex; }
        .service-pill-box {
          width: 100%;
          min-height: 72px;
          height: 100%;
          padding: 16px 10px;
          font-size: 12px;
          font-weight: 600;
          line-height: 1.4;
          border-radius: 14px;
          background: linear-gradient(145deg, #16113a 0%, #0d0d1f 100%);
          border: 1px solid rgba(124,95,230,0.2);
          box-shadow: 0 2px 12px rgba(97,71,189,0.1);
          color: #e8e0ff;
          transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .service-pill-box:hover {
          border-color: #a78bfa;
          box-shadow: 0 0 18px rgba(167,139,250,0.25);
          transform: none;
          background: linear-gradient(145deg, #16113a 0%, #0d0d1f 100%);
          color: #fff;
        }
        .services-pill-container .col-6 .text-center {
          width: 100%; min-height: 72px; height: 100%;
          margin-top: 0 !important; display: flex;
          align-items: center; justify-content: center;
          border-radius: 14px;
          background: linear-gradient(145deg, #16113a 0%, #0d0d1f 100%);
          border: 1px solid rgba(124,95,230,0.2);
        }
      }
    </style>
    <div class="services-pill-container mb-5">
      <div class="row g-3">
        <div class="col-6 col-md-3"><div class="service-pill-box">UX Design &amp; Strategy</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">UI Design &amp; Prototyping</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">UX Research &amp; Testing</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">Software Development</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">Mobile, SaaS &amp; eCommerce UX</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">Emerging Tech UX</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">UX Content </div></div>
        <div class="col-6 col-md-3 d-none d-md-block"><div class="text-center"><a class="view-more" href="/service"> View More &rarr; </a></div></div>
        <div class="col-6 d-md-none"><div class="service-pill-box">Brand &amp; Visual Design</div></div>
      </div>
    </div>

    <div class="section-title" style="margin-top: 120px">
      <h3 class="ux-subtitle">Our Work <span class="ux-line"> </span></h3>
      <center>
        <h2>A Glimpse Into Our <span> Design Thinking </span></h2>
        <p>From sleek interfaces to seamless user flows, our portfolio reflects our commitment to crafting digital experiences that work beautifully.</p>
      </center>
    </div>

    <!-- Desktop Work Section -->
    <div class="project-container d-none d-md-flex">
      <div class="project-text">
        <h3 id="project-title">Case Study of Survey Pacific</h3>
        <p class="mb-0" id="project-desc">We revamped the website UI/UX through deep heuristic evaluation and competitive benchmarking.</p>
        <a class="cta-button" href="/work" style="width:175px;height:42px;text-decoration:none;margin-top:25px;">View Details <span class="arrow"> </span></a>
      </div>
      <div class="project-slider">
        <div class="main-slide">
          <img alt="Project 1" class="active" height="362px" src="img/ux.webp" />
          <img alt="Project 2" height="362px" src="img/cedar.webp" />
          <img alt="Project 3" height="362px" src="img/dist.webp" />
          <div class="next-btn"></div>
        </div>
        <div class="preview-slide" style="width: 300px">
          <img alt="Preview" id="preview-img" src="img/dist.webp" />
        </div>
      </div>
    </div>

    <!-- Mobile Work Card Slider -->
    <div class="mw-slider d-md-none">
      <button class="mw-arrow mw-prev" aria-label="Previous project">&#8249;</button>
      <div class="mw-card">
        <div class="mw-image">
          <img id="mw-img" src="img/ux.webp" alt="Project" />
        </div>
        <div class="mw-info">
          <h3 id="mw-title">Case Study of<br>Survey Pacific</h3>
          <p id="mw-desc">We revamped the website UI/UX through deep heuristic evaluation and competitive benchmarking.</p>
          <div class="mw-tags" id="mw-tags">
            <span>&#8226; Case Study</span><span>&#8226; Web</span>
          </div>
        </div>
      </div>
      <button class="mw-arrow mw-next" aria-label="Next project">&#8250;</button>
    </div>

    <style>
      
      .mw-slider { display:flex; align-items:center; justify-content:center; gap:10px; padding:0 6px; margin:0 auto; max-width:420px; }
      .mw-arrow { background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:#fff; font-size:28px; width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; flex-shrink:0; transition:background 0.2s; line-height:1; padding:0; }
      .mw-arrow:hover { background:rgba(97,71,189,0.5); border-color:#6147bd; }
      .mw-card { flex:1; border-radius:16px; overflow:hidden; background:#1a1a2e; box-shadow:0 8px 32px rgba(0,0,0,0.6); min-height:400px; }
      .mw-image { width:100%; aspect-ratio:4/3; overflow:hidden; }
      .mw-image img { width:100%; height:100%; object-fit:cover; display:block; transition:opacity 0.3s ease; }
      .mw-info { background:linear-gradient(135deg,#3b2a7e,#6147bd); padding:18px 16px 16px; }
      .mw-info h3 { color:#fff; font-size:17px; font-weight:700; margin:0 0 8px; line-height:1.3; }
      .mw-info p { color:rgba(255,255,255,0.82); font-size:12.5px; line-height:1.6; margin:0 0 12px; }
      .mw-tags { display:flex; gap:12px; flex-wrap:wrap; }
      .mw-tags span { color:rgba(255,255,255,0.75); font-size:12px; font-style:italic; }
    </style>

    <script>
      (function(){
        // Preload images to prevent layout shifts
        var images = ['img/ux.webp', 'img/cedar.webp', 'img/dist.webp'];
        images.forEach(function(src){ var img = new Image(); img.src = src; });

        var mwData = [
          { img:'img/ux.webp',    title:'Case Study of' + '\n' + 'Survey Pacific',  desc:'We revamped the website UI/UX through deep heuristic evaluation and competitive benchmarking.', tags:['Case Study','Web'] },
          { img:'img/cedar.webp', title:'UX Audit of' + '\n' + 'CEDAR Himalaya',    desc:'We audited their digital experience to align with their mission of sustainable mountain development.', tags:['UX Audit','Web'] },
          { img:'img/dist.webp',  title:'UX Audit of' + '\n' + 'Distinct Buzz',     desc:'We uncovered usability gaps and friction in the user journey leading to smoother navigation.', tags:['UX Audit','Web'] }
        ];
        var idx = 0;
        function render(){
          var d = mwData[idx];
          var img = document.getElementById('mw-img');
          img.style.opacity = '0';
          setTimeout(function(){ img.src = d.img; img.style.opacity = '1'; }, 180);
          document.getElementById('mw-title').textContent = d.title;
          document.getElementById('mw-desc').textContent  = d.desc;
          document.getElementById('mw-tags').innerHTML    = d.tags.map(function(t){ return '<span>&#8226; '+t+'</span>'; }).join('');
        }
        document.addEventListener('DOMContentLoaded', function(){
          var prev = document.querySelector('.mw-prev');
          var next = document.querySelector('.mw-next');
          if(!prev) return;
          prev.addEventListener('click', function(){ idx = (idx - 1 + mwData.length) % mwData.length; render(); });
          next.addEventListener('click', function(){ idx = (idx + 1) % mwData.length; render(); });
        });
      })();
    </script>

    <section class="ecosystem" id="ecosystem" style="margin-top: 100px">
      <h3 class="ux-subtitle">Our Ecosystem <span class="ux-line"> </span></h3>
      <h2>Expand Your Experience With <span> UX Pacific </span></h2>
      <p class="description">Unlock exclusive networking and learning opportunities across our Ambassador Club and Academy. Take the next step in your UX career with a supportive community and hands-on resources.</p>
      <div class="cards">
        <a href="https://club.uxpacific.com/" style="text-decoration:none" target="_blank">
          <div class="card"><h1 class="text-white" style="font-size:1.7rem">UXP Shop</h1><span class="ux-line"> </span><p>Access premium UI kits, design systems, and templates crafted by industry experts.</p><span class="arrow"> </span></div>
        </a>
        <a href="https://academy.uxpacific.com/" style="text-decoration:none" target="_blank">
          <div class="card"><h1 class="text-white" style="font-size:1.7rem">UXP Academy</h1><span class="ux-line"> </span><p>Advance your skills through curated booklets and hands-on learning experiences through our workshops.</p><span class="arrow"> </span></div>
        </a>
        <a href="https://community.uxpacific.com/" style="text-decoration:none" target="_blank">
          <div class="card"><h1 class="text-white" style="font-size:1.7rem">UXP Community</h1><span class="ux-line"> </span><p>Be part of a thriving network where ideas turn into reality. Join our community to connect and grow.</p><span class="arrow"> </span></div>
        </a>
      </div>
    </section>

    <section class="reviews-section">
      <h3 class="ux-subtitle" style="margin-top: 50px">Our Valued Reviews <span class="ux-line"> </span></h3>
      <h2>Feedback That Fuels <span> Growth </span></h2>
      <p>Explore experiences from our clients and workshop participants. Each review offers valuable insight into how we support growth, learning, and meaningful results across every project and event.</p>
      <div class="reviews-grid-container">
        <div class="reviews-grid">
          <div class="review-card-set" id="original-cards">
            <div class="testimonial-card" style="background-color:#312e81"><div class="card-header"><div class="stars"><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg></div><div class="pill">Project Experience</div></div><div class="quote">We appreciate the professionalism and clarity UX Pacific brought to the process and would gladly collaborate again.</div><div class="author"><div class="avatar"><img alt="Andrew Ajai Singh" src="img/Oval (1).png" /></div><div class="author-info"><div class="name">Andrew Ajai Singh</div><div class="title">Distinct Buzz</div></div></div></div>
            <div class="testimonial-card" style="background-color:#4338ca"><div class="card-header"><div class="stars"><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg></div><div class="pill">Workshop Experience</div></div><div class="quote">Use engaging activities and mix up groups to boost interaction, cut distractions, and make the workshop more effective.</div><div class="author"><div class="avatar"><img alt="Dharmik Bhavsar" src="img/Oval (2).png" /></div><div class="author-info"><div class="name">Dharmik Bhavsar</div><div class="title">Student</div></div></div></div>
            <div class="testimonial-card" style="background-color:#4f46e5"><div class="card-header"><div class="stars"><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg></div><div class="pill">Workshop Experience</div></div><div class="quote">Got to explore fresh and engaging activities throughout the session. They added a fun and creative touch to the overall learning experience!</div><div class="author"><div class="avatar"><img alt="Diya Mehta" src="./img/DMDM.png" /></div><div class="author-info"><div class="name">Diya Mehta</div><div class="title">Student</div></div></div></div>
            <div class="testimonial-card" style="background-color:#312e81"><div class="card-header"><div class="stars"><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg></div><div class="pill">Project Experience</div></div><div class="quote">Working with UXPacific for the UX draft was an insightful experience. The team's approach was structured, detailed, and highly actionable.</div><div class="author"><div class="avatar"><img alt="Dr. Vishal Singh" src="img/Oval.png" /></div><div class="author-info"><div class="name">Dr. Vishal Singh</div><div class="title">CEDAR Himalaya</div></div></div></div>
            <div class="testimonial-card" style="background-color:#312e81"><div class="card-header"><div class="stars"><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg></div><div class="pill">Workshop Experience</div></div><div class="quote">Loved the hands-on activities and feedback they really clarified the concepts. Great experience connecting with the team and participants!</div><div class="author"><div class="avatar"><img alt="Yugaan Parmar" src="img/YUGAAn.png" /></div><div class="author-info"><div class="name">Yugaan Parmar</div><div class="title">UI/UX &amp; Graphic Designer</div></div></div></div>
            <div class="testimonial-card" style="background-color:#312e81"><div class="card-header"><div class="stars"><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg><svg fill="#ffd166" viewbox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"></path></svg></div><div class="pill">Workshop Experience</div></div><div class="quote">Gained deeper knowledge, especially through the process of creating the hero and i understood how structure and design come together!</div><div class="author"><div class="avatar"><img alt="Devanshi Akhja" src="img/Devanshi.png" /></div><div class="author-info"><div class="name">Devanshi Akhja</div><div class="title">Student</div></div></div></div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta-section">
      <div class="dots-bg desktop-only"><canvas id="dots-canvas"> </canvas></div>
      <div class="cta-container">
        <div class="cta-text">
          <h1>Start your <span> UI/UX </span> journey with <br /><span class="highlight"> UX Pacific Team </span></h1>
          <p class="mt-4 mb-4">Build your site effortlessly and showcase your work with confidence.<br />Ready to stand out? Get started today!</p>
          <a class="cta-button" href="/contact">Get in touch <span class="arrow"> </span></a>
        </div>
        <div class="cta-blur-overlay"></div>
        <div class="cta-image"><img alt="UX Design" src="img/Rectangle 5192.webp" /></div>
      </div>
    </section>

    <section class="faq-section">
      <div class="faq-container">
        <div class="faq-main-container">
          <div class="faq-left">
            <div class="accordion accordion-flush col-lg-12 mx-auto" id="faqAccordion">
              <div class="accordion-item" style="border-radius: 8px">
                <div class="accordion-header"><h3>What services does UXPacific offer?</h3><div class="accordion-icon"><span> </span></div></div>
                <div class="accordion-content"><p>We specialize in UI/UX design, UX audits, design systems, landing pages, and strategy consulting. Whether you're launching an MVP or scaling an enterprise platform, we craft human-first digital experiences that perform.</p></div>
              </div>
              <div class="accordion-item" style="border-radius: 8px">
                <div class="accordion-header"><h3>Can I pay you in pizza and good vibes?</h3><div class="accordion-icon"><span> </span></div></div>
                <div class="accordion-content"><p>Tempting. But we prefer clean invoices and coffee. Good vibes are always welcome though.</p></div>
              </div>
              <div class="accordion-item" style="border-radius: 8px">
                <div class="accordion-header"><h3>What tools do you use?</h3><div class="accordion-icon"><span> </span></div></div>
                <div class="accordion-content"><p>At UXPacific, we use Figma, Sketch, and Framer for designing and prototyping, Notion for organisation, Slack for communication, and Google Workspace for files and&nbsp;presentations.</p></div>
              </div>
            </div>
          </div>
          <div class="faq-right">
            <h2>Frequently Asked <span> Questions? </span></h2>
            <p>Have questions? We&rsquo;ve gathered answers to questions people ask us all the time (yes, even the weird ones!). Still stumped? Drop us a line. We love a good question!</p>
            <div><a class="faq-link" href="/faq"> View Details &rarr; </a></div>
          </div>
        </div>
      </div>
      <div class="images-row">
        <img alt="workshop" class="img1" src="img/5.webp" style="transform:rotate(-9.89deg);z-index:1" />
        <img alt="workshop" src="img/2.webp" style="transform:rotate(1.82deg)" />
        <img alt="workshop" src="img/3.webp" style="transform:rotate(14.67deg);left:-30px;z-index:1" />
        <img alt="workshop" src="img/4.webp" style="transform:rotate(-5.34deg);left:-50px" />
        <img alt="workshop" src="img/1.webp" style="transform:rotate(15.98deg);left:-100px" />
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <!-- Audit Success Popup -->
    <div id="auditSuccessPopup" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;background:rgba(0,0,0,0.7);backdrop-filter:blur(6px);">
      <div style="background:#111127;border:1px solid rgba(97,71,189,0.4);border-radius:20px;padding:48px 40px;max-width:420px;width:90%;text-align:center;box-shadow:0 24px 80px rgba(0,0,0,0.8);position:relative;">
        <div style="width:68px;height:68px;background:linear-gradient(135deg,#6147bd,#a78bfa);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <h3 style="color:#fff;font-size:22px;font-weight:700;margin:0 0 12px;">Submitted Successfully!</h3>
        <p style="color:#b2bad6;font-size:15px;line-height:1.6;margin:0 0 28px;">Thank you! Your UX Audit request has been received. We'll get back to you shortly.</p>
        <button onclick="document.getElementById('auditSuccessPopup').style.display='none';" style="background:linear-gradient(90deg,#6147bd,#a78bfa);border:none;padding:12px 36px;border-radius:50px;color:#fff;font-weight:600;font-size:15px;cursor:pointer;">Done</button>
      </div>
    </div>

    <!-- UX Audit Modal -->
    <div class="modal fade" id="auditModal" tabindex="-1" aria-hidden="true" style="backdrop-filter:blur(8px);background-color:rgba(0,0,0,0.6);" data-bs-backdrop="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">
        <div class="modal-content" style="background:rgba(17,17,17,0.95);border:1px solid #2e2e3e;border-radius:20px;overflow:hidden;box-shadow:0 24px 80px rgba(0,0,0,0.8);">
          <div class="modal-header border-0 pb-0 d-flex justify-content-between align-items-center" style="padding:24px 32px 0;">
            <h4 class="modal-title" style="color:#fff;font-weight:700;font-size:24px;">Book a UX Audit</h4>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity:0.5;"></button>
          </div>
          <div class="modal-body" style="padding:24px 32px 36px;">
            <p style="color:#b2bad6;font-size:14px;margin-bottom:24px;">Fill out the details below and we will get back to you shortly.</p>
            <form id="auditForm" class="contact-form" action="send_audit.php" method="post">
              <div class="contact-row d-flex flex-column" style="gap:16px;">
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditName" style="font-size:15px;color:#b2bad6;">Name</label><input id="auditName" name="name" type="text" placeholder="Enter your name here" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditEmail" style="font-size:15px;color:#b2bad6;">Email</label><input id="auditEmail" name="email" type="email" placeholder="Enter your email address" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditPhone" style="font-size:15px;color:#b2bad6;">Phone Number</label><input id="auditPhone" name="phone" type="tel" placeholder="+91 xxxxx- xxxxx" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditUrl" style="font-size:15px;color:#b2bad6;">Website URL</label><input id="auditUrl" name="url" type="text" placeholder="https://yourwebsite.com" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
              </div>
              <div id="auditError" style="display:none;margin-top:12px;color:#f87171;font-size:14px;text-align:center;"></div>
              <div class="contact-submit text-center mt-4 pt-2">
                <button id="auditSubmitBtn" type="submit" style="background-color:#6147bd;border:none;padding:12px 40px;border-radius:50px;color:#ffffff;font-weight:500;font-size:16px;width:100%;height:50px;cursor:pointer;box-shadow:0 6px 20px rgba(97,71,189,0.4);transition:transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">Submit Request</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <script>
    document.getElementById('auditForm').addEventListener('submit', function(e) {
      e.preventDefault();
      var btn = document.getElementById('auditSubmitBtn');
      var errBox = document.getElementById('auditError');
      btn.disabled = true;
      btn.textContent = 'Sending…';
      errBox.style.display = 'none';

      var data = {
        name:  document.getElementById('auditName').value,
        email: document.getElementById('auditEmail').value,
        phone: document.getElementById('auditPhone').value,
        url:   document.getElementById('auditUrl').value
      };

      fetch('send_audit', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
      })
      .then(function(r){ return r.json(); })
      .then(function(res) {
        if (res.success) {
          // Close audit modal
          var auditModal = bootstrap.Modal.getInstance(document.getElementById('auditModal'));
          if (auditModal) auditModal.hide();
          // Reset form
          document.getElementById('auditForm').reset();
          // Show success popup
          var popup = document.getElementById('auditSuccessPopup');
          popup.style.display = 'flex';
        } else {
          errBox.textContent = res.message || 'Something went wrong. Please try again.';
          errBox.style.display = 'block';
        }
      })
      .catch(function() {
        errBox.textContent = 'Network error. Please try again.';
        errBox.style.display = 'block';
      })
      .finally(function() {
        btn.disabled = false;
        btn.textContent = 'Submit Request';
      });
    });

    // Close success popup on backdrop click
    document.getElementById('auditSuccessPopup').addEventListener('click', function(e) {
      if (e.target === this) this.style.display = 'none';
    });
  </script>
  </body>
</html>
