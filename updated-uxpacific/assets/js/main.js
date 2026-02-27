/* ============================================================
   UX PACIFIC — MAIN.JS v2.0
   Premium interaction layer: cursor, scroll, counters,
   parallax, form handling, FAQ, filter, nav.
   ============================================================ */

'use strict';

/* ============================================================
   1. CURSOR GLOW
   ============================================================ */
function initCursorGlow() {
  if (window.matchMedia('(pointer: coarse)').matches) return; // skip touch devices

  const glow = document.createElement('div');
  glow.className = 'cursor-glow';
  document.body.appendChild(glow);

  let mouseX = 0, mouseY = 0;
  let glowX = 0, glowY = 0;

  document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
  });

  function animateGlow() {
    glowX += (mouseX - glowX) * 0.12;
    glowY += (mouseY - glowY) * 0.12;
    glow.style.transform = `translate(${glowX}px, ${glowY}px) translate(-50%, -50%)`;
    requestAnimationFrame(animateGlow);
  }
  animateGlow();
}

/* ============================================================
   2. NAVBAR
   ============================================================ */
function initNavbar() {
  const nav = document.querySelector('.nav');
  const hamburger = document.querySelector('.nav__hamburger');
  const drawer = document.querySelector('.nav__drawer');
  const drawerLinks = document.querySelectorAll('.nav__drawer .nav__link, .nav__drawer .nav__cta');

  if (!nav) return;

  // Scrolled class
  const onScroll = () => {
    nav.classList.toggle('scrolled', window.scrollY > 40);
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Hamburger toggle
  if (hamburger && drawer) {
    hamburger.addEventListener('click', () => {
      const isOpen = drawer.classList.toggle('open');
      hamburger.classList.toggle('open', isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    drawerLinks.forEach(link => {
      link.addEventListener('click', () => {
        drawer.classList.remove('open');
        hamburger.classList.remove('open');
        document.body.style.overflow = '';
      });
    });
  }
}

/* ============================================================
   3. SCROLL REVEAL (IntersectionObserver)
   ============================================================ */
function initScrollReveal() {
  const elements = document.querySelectorAll('.reveal');
  if (!elements.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target); // animate once
      }
    });
  }, {
    threshold: 0.12,
    rootMargin: '0px 0px -40px 0px'
  });

  elements.forEach(el => observer.observe(el));
}

/* ============================================================
   4. COUNTER ANIMATION
   ============================================================ */
function initCounters() {
  const counters = document.querySelectorAll('[data-counter]');
  if (!counters.length) return;

  const easeOut = (t) => 1 - Math.pow(1 - t, 3);

  const animateCounter = (el) => {
    const target = parseFloat(el.dataset.counter);
    const suffix = el.dataset.suffix || '';
    const duration = 1800;
    const start = performance.now();

    const tick = (now) => {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const value = easeOut(progress) * target;

      // Format intelligently
      let displayed;
      if (target % 1 !== 0) {
        displayed = value.toFixed(1);
      } else {
        displayed = Math.round(value).toString();
      }
      el.textContent = displayed + suffix;

      if (progress < 1) requestAnimationFrame(tick);
    };

    requestAnimationFrame(tick);
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(el => observer.observe(el));
}

/* ============================================================
   5. FILTER TABS (Work Page)
   ============================================================ */
function initWorkFilter() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const workCards  = document.querySelectorAll('.work-card[data-category]');
  if (!filterBtns.length || !workCards.length) return;

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
      });
      btn.classList.add('active');
      btn.setAttribute('aria-selected', 'true');

      const filter = btn.dataset.filter;

      workCards.forEach(card => {
        const cats = card.dataset.category || '';
        const show = filter === 'all' || cats.includes(filter);

        if (show) {
          card.style.display = '';
          // Re-trigger reveal
          setTimeout(() => card.classList.add('is-visible'), 30);
        } else {
          card.style.display = 'none';
          card.classList.remove('is-visible');
        }
      });
    });

    btn.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        btn.click();
      }
    });
  });
}

/* ============================================================
   6. VIEW MORE TOGGLE (Work Page)
   ============================================================ */
function initViewMore() {
  const btn   = document.getElementById('view-more-btn');
  const extras = document.querySelectorAll('.work-card--extra');
  if (!btn || !extras.length) return;

  let expanded = false;

  btn.addEventListener('click', () => {
    expanded = !expanded;
    extras.forEach(card => {
      card.style.display = expanded ? '' : 'none';
      if (expanded) {
        setTimeout(() => card.classList.add('is-visible'), 30);
      } else {
        card.classList.remove('is-visible');
      }
    });

    const textEl = btn.querySelector('.btn-text');
    const arrowEl = btn.querySelector('.btn-arrow-icon');
    if (textEl) textEl.textContent = expanded ? 'View Less' : 'View More';
    if (arrowEl) arrowEl.style.transform = expanded ? 'rotate(180deg)' : 'rotate(0deg)';
  });
}

/* ============================================================
   7. FAQ ACCORDION
   ============================================================ */
function initFAQ() {
  const faqItems = document.querySelectorAll('.faq-item');
  if (!faqItems.length) return;

  faqItems.forEach(item => {
    const trigger = item.querySelector('.faq-trigger');
    if (!trigger) return;

    trigger.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');

      // Close all others
      faqItems.forEach(other => {
        if (other !== item) {
          other.classList.remove('open');
          other.querySelector('.faq-trigger')?.setAttribute('aria-expanded', 'false');
        }
      });

      item.classList.toggle('open', !isOpen);
      trigger.setAttribute('aria-expanded', String(!isOpen));
    });
  });
}

/* ============================================================
   8. CONTACT FORM
   ============================================================ */
function initContactForm() {
  const form    = document.getElementById('contactForm');
  const modal   = document.getElementById('successModal');
  const modalClose = document.getElementById('modalClose');

  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (!validateForm(form)) return;

    const submitBtn = form.querySelector('[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Sending…';
    submitBtn.disabled = true;

    try {
      const response = await fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { Accept: 'application/json' }
      });

      if (response.ok) {
        form.reset();
        if (modal) {
          modal.classList.add('active');
          // Confetti
          if (typeof confetti !== 'undefined') {
            confetti({ particleCount: 80, spread: 60, origin: { y: 0.6 }, colors: ['#7c5fe6', '#a78bfa', '#c084fc'] });
          }
        }
      } else {
        alert('Something went wrong. Please try again or email us at hello@uxpacific.com');
      }
    } catch (err) {
      alert('Network error. Please check your connection.');
    } finally {
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }
  });

  if (modal && modalClose) {
    modalClose.addEventListener('click', () => modal.classList.remove('active'));
    modal.addEventListener('click', (e) => {
      if (e.target === modal) modal.classList.remove('active');
    });
  }

  // Custom dropdown
  initCustomDropdown();
}

function validateForm(form) {
  let valid = true;
  const required = form.querySelectorAll('[required]');

  required.forEach(field => {
    const group = field.closest('.form-group');
    if (!field.value.trim()) {
      valid = false;
      group?.classList.add('has-error');
    } else {
      group?.classList.remove('has-error');
    }
  });

  // Email validation
  const email = form.querySelector('[type="email"]');
  if (email && email.value && !isValidEmail(email.value)) {
    email.closest('.form-group')?.classList.add('has-error');
    valid = false;
  }

  return valid;
}

function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function initCustomDropdown() {
  const dropdown = document.getElementById('customDropdown');
  if (!dropdown) return;

  const btn     = dropdown.querySelector('.custom-dropdown-btn');
  const list    = dropdown.querySelector('.custom-dropdown-list');
  const hidden  = document.getElementById('industry-hidden');
  const options = dropdown.querySelectorAll('.custom-dropdown-option');

  btn?.addEventListener('click', () => dropdown.classList.toggle('open'));

  options.forEach(opt => {
    opt.addEventListener('click', () => {
      const val  = opt.dataset.value;
      const text = opt.textContent.trim();
      if (btn) btn.querySelector('span').textContent = text;
      if (btn) btn.classList.add('selected');
      if (hidden) hidden.value = val;
      dropdown.classList.remove('open');
    });
  });

  document.addEventListener('click', e => {
    if (!dropdown.contains(e.target)) dropdown.classList.remove('open');
  });
}

/* ============================================================
   9. SUBTLE PARALLAX (Hero orbs on mouse)
   ============================================================ */
function initParallax() {
  const orbDefs = [
    { id: 'orbMain',  depth: 0.018 },
    { id: 'orbLeft',  depth: 0.028 },
    { id: 'orbRight', depth: 0.022 },
  ];
  const orbs = orbDefs.map(o => ({ el: document.getElementById(o.id), depth: o.depth }))
                      .filter(o => o.el);

  if (!orbs.length || window.matchMedia('(pointer: coarse)').matches) return;

  let mx = window.innerWidth / 2;
  let my = window.innerHeight / 2;
  const targX = orbs.map(() => 0);
  const targY = orbs.map(() => 0);
  const curX  = orbs.map(() => 0);
  const curY  = orbs.map(() => 0);

  document.addEventListener('mousemove', (e) => { mx = e.clientX; my = e.clientY; }, { passive: true });

  function tick() {
    const cx = window.innerWidth  / 2;
    const cy = window.innerHeight / 2;
    orbs.forEach((o, i) => {
      targX[i] = (mx - cx) * o.depth;
      targY[i] = (my - cy) * o.depth;
      curX[i] += (targX[i] - curX[i]) * 0.06;
      curY[i] += (targY[i] - curY[i]) * 0.06;
      o.el.style.transform = `translate(${curX[i]}px, ${curY[i]}px)`;
    });
    requestAnimationFrame(tick);
  }
  tick();
}

/* ============================================================
   10. ACTIVE NAV LINK (current page)
   ============================================================ */
function initActiveNav() {
  const path = window.location.pathname.split('/').pop() || 'index.html';
  const links = document.querySelectorAll('.nav__link, .nav__drawer .nav__link');

  links.forEach(link => {
    const href = link.getAttribute('href') || '';
    if (href === path || (path === '' && href === 'index.html')) {
      link.classList.add('active');
    }
  });
}

/* ============================================================
   11. IMAGE LAZY LOADING
   ============================================================ */
function initLazyImages() {
  const imgs = document.querySelectorAll('img[data-src]');
  if (!imgs.length) return;

  const obs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
        obs.unobserve(img);
      }
    });
  }, { rootMargin: '200px' });

  imgs.forEach(img => obs.observe(img));
}

/* ============================================================
   12. SMOOTH SCROLL FOR ANCHOR LINKS
   ============================================================ */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
}

/* ============================================================
   13. MAGNETIC BUTTON EFFECT (subtle, desktop only)
   ============================================================ */
function initMagneticBtns() {
  if (window.matchMedia('(pointer: coarse)').matches) return;

  const btns = document.querySelectorAll('.btn--primary');
  btns.forEach(btn => {
    btn.addEventListener('mousemove', (e) => {
      const rect = btn.getBoundingClientRect();
      const cx   = rect.left + rect.width / 2;
      const cy   = rect.top  + rect.height / 2;
      const dx   = (e.clientX - cx) * 0.18;
      const dy   = (e.clientY - cy) * 0.18;
      btn.style.transform = `translate(${dx}px, ${dy}px)`;
    });

    btn.addEventListener('mouseleave', () => {
      btn.style.transform = '';
    });
  });
}

/* ============================================================
   14. HERO CARD TILT (desktop only)
   ============================================================ */
function initHeroCardTilt() {
  if (window.matchMedia('(pointer: coarse)').matches) return;

  document.querySelectorAll('.hero-card').forEach(card => {
    const isScore = card.classList.contains('hero-card--score');
    const baseRot = isScore ? '-4deg' : '5deg';

    card.style.pointerEvents = 'auto';

    card.addEventListener('mousemove', (e) => {
      const r  = card.getBoundingClientRect();
      const dx = ((e.clientX - r.left) / r.width  - 0.5) * 12;
      const dy = ((e.clientY - r.top)  / r.height - 0.5) * -12;
      card.style.transition = 'none';
      card.style.transform  = `translateY(-50%) rotate(${baseRot}) perspective(500px) rotateY(${dx}deg) rotateX(${dy}deg)`;
    });

    card.addEventListener('mouseleave', () => {
      card.style.transition = 'transform 0.6s cubic-bezier(0.22,1,0.36,1)';
      card.style.transform  = `translateY(-50%) rotate(${baseRot})`;
    });
  });
}

/* ============================================================
   INIT — Run everything on DOMContentLoaded
   ============================================================ */
document.addEventListener('DOMContentLoaded', () => {
  initCursorGlow();
  initNavbar();
  initScrollReveal();
  initCounters();
  initWorkFilter();
  initViewMore();
  initFAQ();
  initContactForm();
  initParallax();
  initActiveNav();
  initLazyImages();
  initSmoothScroll();
  initMagneticBtns();
  initHeroCardTilt();
});
