<?php
$pageTitle    = "Let's Talk | UX Pacific";
$pageDesc     = "Get in touch with UX Pacific. Share your project idea, ask about our UX design services, or request a collaboration  we'd love to hear from you.";
$canonicalUrl = 'https://www.uxpacific.com/contact.php';
$ogTitle      = "Let's Talk | UX Pacific";
$ogDesc       = 'Reach out to UX Pacific for design services, collaborations, or any queries. Our team is ready to help.';
$ogUrl        = 'https://www.uxpacific.com/contact.php';
$currentPage  = 'contact';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <style>
      .contact-section { max-width:1200px; margin:0 auto; padding:48px 16px 80px; }
      .contact-grid { display:flex; flex-direction:column; gap:32px; }
      .contact-info-section { flex:1; display:flex; flex-direction:column; gap:25px; }
      .contact-info-title { font-size:clamp(1.75rem,5vw,45px); font-weight:700; color:#fff; margin-bottom:0px; line-height:1.1; letter-spacing:-0.02em; }
      .contact-info-title span { color:#a78bfa; }
      .contact-info-desc { font-size:14px; color:rgba(148,163,184,0.85); line-height:1.6; }
      .contact-info-list { display:flex; flex-direction:column; gap:24px; margin-top:10px; }
      .contact-info-item { display:flex; align-items:flex-start; gap:16px; }
      .contact-info-item .icon-box { width:44px; height:44px; background:#17153a; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#a78bfa; font-size:1.1rem; }
      .contact-info-item .item-text { display:flex; flex-direction:column; gap:4px; }
      .contact-info-item .item-label { font-size:0.70rem; font-weight:700; letter-spacing:0.08em; color:rgba(148,163,184,0.6); text-transform:uppercase; }
      .contact-info-item strong { font-size:1rem; color:#e8e8f4; font-weight:600; line-height:1.4; }
      .contact-info-features { margin-top:8px; background:#101028; border:1px solid rgba(255,255,255,0.06); border-radius:20px; padding:24px; }
      .contact-info-features ul { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:16px; }
      .contact-info-features li { display:flex; align-items:center; gap:12px; color:rgba(148,163,184,0.85); font-size:0.95rem; }
      .contact-info-features li i { color:#00d084; font-size:1.2rem; }
      .contact-form-card { flex:1.15; border:1px solid rgba(255,255,255,0.06); border-radius:28px; padding:clamp(1.25rem,4vw,2.5rem); display:flex; flex-direction:column; gap:20px; }
      .contact-row { display:flex; flex-direction:column; gap:16px; }
      .contact-field { display:flex; flex-direction:column; gap:8px; }
      .contact-field label { font-size:0.875rem; font-weight:500; color:rgba(148,163,184,0.85); }
      .contact-field input, .contact-field textarea { width:100%; background:#111111; border:1px solid rgba(255,255,255,0.1); border-radius:10px; color:#e8e8f4; padding:14px 18px; font-size:1rem; font-family:inherit; outline:none; appearance:none; -webkit-appearance:none; transition:border-color 0.25s ease,box-shadow 0.25s ease; box-sizing:border-box; }
      .contact-field input::placeholder, .contact-field textarea::placeholder { color:rgba(148,163,184,0.4); }
      .contact-field input:focus, .contact-field textarea:focus { border-color:#6147bd; box-shadow:0 0 0 3px rgba(97,71,189,0.15); }
      .contact-field textarea { min-height:150px; resize:vertical; }
      .custom-dropdown { position:relative; width:100%; }
      .custom-dropdown-btn { height:52px; width:100%; background:#111111; border:1px solid rgba(255,255,255,0.1); border-radius:10px; color:rgba(148,163,184,0.5); padding:0 18px; font-size:1rem; font-family:inherit; text-align:left; cursor:pointer; display:flex; justify-content:space-between; align-items:center; transition:border-color 0.25s ease,box-shadow 0.25s ease; box-sizing:border-box; }
      .custom-dropdown-btn.selected { color:#e8e8f4; }
      .custom-dropdown-btn:focus, .custom-dropdown.open .custom-dropdown-btn { border-color:#6147bd; box-shadow:0 0 0 3px rgba(97,71,189,0.15); outline:none; }
      .custom-dropdown-list { position:absolute; top:calc(100% + 6px); left:0; right:0; background:#111111; border:1px solid rgba(97,71,189,0.3); border-radius:10px; max-height:220px; overflow-y:auto; z-index:1000; display:none; box-shadow:0 16px 48px rgba(0,0,0,0.8); }
      .custom-dropdown.open .custom-dropdown-list { display:block; }
      .custom-dropdown-option { padding:12px 18px; color:rgba(148,163,184,0.85); cursor:pointer; font-size:0.9rem; transition:background 0.2s,color 0.2s; }
      .custom-dropdown-option:hover { background:rgba(97,71,189,0.15); color:#a78bfa; }
      .contact-footer { display:flex; align-items:flex-start; }
      .contact-checkbox { display:inline-flex; align-items:flex-start; gap:10px; font-size:0.875rem; color:rgba(148,163,184,0.85); cursor:pointer; }
      .contact-checkbox input { width:18px; height:18px; min-width:18px; accent-color:#6147bd; cursor:pointer; margin-top:2px; }
      .contact-link { color:#a78bfa; text-decoration:underline; }
      .contact-link:hover { color:#c084fc; }
      .contact-submit-btn { width:100%; padding:16px 28px; border-radius:999px; border:none; background:linear-gradient(90deg,#6147bd,#a78bfa); color:#fff; font-size:1rem; font-weight:600; font-family:inherit; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; transition:box-shadow 0.3s ease,transform 0.3s ease; margin-top:4px; }
      .contact-submit-btn:hover { box-shadow:0 4px 24px rgba(97,71,189,0.55); transform:translateY(-2px); }
      .contact-submit-btn:active { transform:translateY(0); }
      .contact-header-label { display:inline-block; font-size:0.72rem; font-weight:600; letter-spacing:0.12em; text-transform:uppercase; color:#a78bfa; background:rgba(97,71,189,0.12); border:1px solid rgba(97,71,189,0.3); padding:6px 16px; border-radius:999px; margin-bottom:1rem; }
      /* Desktop: side-by-side layout */
      @media (min-width:900px) {
        .contact-grid { flex-direction:row; align-items:flex-start; gap:40px; }
        .contact-row { flex-direction:row; }
        .contact-field { flex:1; }
        .contact-info-features { margin-top:auto; }
      }
      /* Tablet */
      @media (max-width:768px) {
        .contact-section { padding:40px 24px 64px; }
        .contact-grid { gap:40px; }
        .contact-info-section { gap:24px; }
        .contact-info-list { gap:20px; }
        .contact-info-features li { font-size:0.95rem; }
      }
      /* Mobile */
      @media (max-width:480px) {
        .contact-section { padding:32px 20px 64px; }
        .contact-grid { gap:32px; }
        .contact-info-section { gap:20px; padding: 14px; }
        .contact-info-title { font-size: 36px; letter-spacing:-0.01em; }
        .contact-info-features { padding:24px 20px; border-radius:16px; margin-top: 10px; }
        .contact-info-features ul { gap:16px; }
        .contact-info-features li { font-size:0.9rem; }
        .contact-form-card { padding: 24px 20px; border-radius:24px; gap:20px; }
        .contact-field input, .contact-field textarea { padding:14px 16px; font-size:0.95rem; }
        .custom-dropdown-btn { padding:0 16px; font-size:0.95rem; }
        .contact-field textarea { min-height:120px; }
        .contact-submit-btn { font-size:0.95rem; padding:16px 20px; margin-top: 10px; }
        .contact-checkbox { font-size:0.85rem; }
        .contact-info-item strong { font-size:0.95rem; }
        .contact-info-item .icon-box { width:42px; height:42px; font-size:1.05rem; }
      }
    </style>
  </head>
  <body class="contact-page">
    <?php include 'includes/navbar.php'; ?>

    <section class="about-header">
      <video class="header-bg-video" autoplay muted loop playsinline>
        <source src="img/test.mp4" type="video/mp4">
      </video>
      <div class="header-bg-overlay"></div>
      <h1>Let's Talk</h1>
      <div class="innovation-badge-exact">
        <span class="badge-desktop">Connect with <span>Us</span> for a <span>Better Future</span></span>
        <span class="badge-mobile">Let's <span>Build</span> Together</span>
      </div>
    </section>

    <main>
      <div class="modal-overlay" id="modal-overlay">
        <div class="modal-box">
          <button class="close-modal" title="Close">&times;</button>
          <div class="modal-icon-wrapper"><i class="fas fa-check-circle"></i></div>
          <h2>Success!</h2>
          <p class="modal-desc">Your message has been sent successfully.<br />Our team will get back to you shortly.</p>
        </div>
      </div>

      <section id="contact" class="contact-section">
        <div class="contact-grid">
          <div class="contact-info-section">
            <h2 class="contact-info-title">Connect <span>With Us</span></h2>
            <p class="contact-info-desc">Whether you're a startup with a big idea, an enterprise looking to level up your UX, or a designer wanting to collaborate  we're here for all of it.</p>
            <div class="contact-info-list">
              <div class="contact-info-item"><div class="icon-box"><i class="fas fa-map-marker-alt"></i></div><div class="item-text"><span class="item-label">LOCATION</span><strong> 512, D&C Majestic, Near Law Garden BRTS, <br>Ahmedabad</strong></div></div>
              <div class="contact-info-item"><div class="icon-box"><i class="fas fa-phone-alt"></i></div><div class="item-text"><span class="item-label">PHONE</span><strong>+91 92740-61063</strong></div></div>
              <div class="contact-info-item"><div class="icon-box"><i class="fas fa-envelope"></i></div><div class="item-text"><span class="item-label">EMAIL</span><strong>hello@uxpacific.com</strong></div></div>
            </div>
            <div class="contact-info-features">
              <ul>
                <li><i class="fas fa-check-circle"></i> We respond within 24 hours</li>
                <li><i class="fas fa-check-circle"></i> Free initial consultation call</li>
                <li><i class="fas fa-check-circle"></i> No commitment required</li>
                <li><i class="fas fa-check-circle"></i> Your data is always private</li>
              </ul>
            </div>
          </div>

          <form class="contact-form-card" id="contactForm" novalidate>
            <div class="contact-row">
              <div class="contact-field"><label for="name">Name</label><input id="name" name="name" type="text" placeholder="Enter your name here" required minlength="2" maxlength="50" autocomplete="name"></div>
              <div class="contact-field"><label for="email">Email</label><input id="email" name="email" type="email" placeholder="Enter your email address" required autocomplete="email"></div>
            </div>
            <div class="contact-row">
              <div class="contact-field"><label for="phone">Phone Number</label><input id="phone" name="phone" type="tel" placeholder="+91 xxxxx-xxxxx" autocomplete="tel"></div>
              <div class="contact-field">
                <label for="industry">Industry</label>
                <div class="custom-dropdown" id="customDropdown">
                  <button type="button" class="custom-dropdown-btn" id="dropdownBtn">
                    <span>Select your Industry</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
                  </button>
                  <div class="custom-dropdown-list">
                    <div class="custom-dropdown-option" data-value="E-commerce">E-commerce</div>
                    <div class="custom-dropdown-option" data-value="Healthcare services">Healthcare services</div>
                    <div class="custom-dropdown-option" data-value="Financial Service">Financial services</div>
                    <div class="custom-dropdown-option" data-value="SaaS">SaaS</div>
                    <div class="custom-dropdown-option" data-value="Education & Elearning">Education &amp; E-learning</div>
                    <div class="custom-dropdown-option" data-value="Media & Entertainment">Media &amp; Entertainment</div>
                    <div class="custom-dropdown-option" data-value="Travel & Hospitality">Travel &amp; Hospitality</div>
                    <div class="custom-dropdown-option" data-value="Real estate">Real estate</div>
                    <div class="custom-dropdown-option" data-value="Government services">Government services</div>
                    <div class="custom-dropdown-option" data-value="Telecommunication">Telecommunication</div>
                    <div class="custom-dropdown-option" data-value="IT Services">IT Services</div>
                    <div class="custom-dropdown-option" data-value="Design & Communication">Design &amp; Communication</div>
                    <div class="custom-dropdown-option" data-value="Automotive">Automotive</div>
                    <div class="custom-dropdown-option" data-value="Other">Other</div>
                  </div>
                  <input type="hidden" name="industry" id="industry" required>
                </div>
              </div>
            </div>
            <div class="contact-field"><label for="message">Message</label><textarea id="message" name="message" rows="5" placeholder="Enter your message here…" required minlength="10"></textarea></div>
            <div class="contact-footer">
              <label class="contact-checkbox">
                <input type="checkbox" id="terms" name="terms" required>
                <span>I Agree to <a href="/term-condition" class="contact-link">Terms &amp; Conditions</a> of UX Pacific</span>
              </label>
            </div>
            <button type="submit" class="contact-submit-btn submit-btn">Send Message</button>
          </form>
        </div>
      </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>
    <?php include 'includes/scripts.php'; ?>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const dropdown = document.getElementById('customDropdown');
        const dropdownBtn = document.getElementById('dropdownBtn');
        const btnText = dropdownBtn.querySelector('span');
        const hiddenInput = document.getElementById('industry');
        const options = document.querySelectorAll('.custom-dropdown-option');
        dropdownBtn.addEventListener('click', () => { dropdown.classList.toggle('open'); });
        options.forEach(option => {
          option.addEventListener('click', () => {
            btnText.textContent = option.textContent;
            hiddenInput.value = option.getAttribute('data-value');
            dropdownBtn.classList.add('selected');
            dropdown.classList.remove('open');
          });
        });
        document.addEventListener('click', (e) => { if (!dropdown.contains(e.target)) { dropdown.classList.remove('open'); } });
      });
    </script>
  </body>
</html>
