document.addEventListener("DOMContentLoaded", function () {
    // Logic for responsive logo image
    const mediaQuery = window.matchMedia("(max-width: 900px)");
    const img = document.getElementById("myImage");

    function checkScreenSize(e) {
      if (e.matches) {
        // Screen 900px or less
        img.src = "img/LOGO 3.png";
        img.style.width = "50px";
      } else {
        // Screen larger than 900px
        img.src = "img/LOGO.png";
        img.style.width = "200px";
      }
    }

    // Check on page load
    checkScreenSize(mediaQuery);

    // Check on resize
    mediaQuery.addEventListener("change", checkScreenSize);
});

// Logic for the "Fix It" button animation
const brush = document.getElementById("brush");
const puppetImg = document.querySelector(".puppet img");
const fixitBtn = document.getElementById("fixitBtn");
const emj = document.getElementById("emoj");
const img = document.getElementById("ii1");

if(brush && puppetImg && fixitBtn && emj && img) {
    let animationInterval;
    let removeTimeout;

    function animateBoth() {
      brush.classList.add("up");
      puppetImg.classList.add("up");

      removeTimeout = setTimeout(() => {
        brush.classList.remove("up");
        puppetImg.classList.remove("up");
      }, 3000);
    }

    // Start animation
    animationInterval = setInterval(animateBoth, 4000);

    fixitBtn.addEventListener("click", () => {
      const tags = document.querySelectorAll(".floating-tag:not(.fixit-btn)");

      // Change image & emoji
      img.src = "img/b2.webp";
      emj.src = "img/emoji.png";
      img.style.transform = "rotate(0deg)";
      tags.forEach((tag) => {
        tag.style.transform = "rotate(0deg)";
      });

      // Stop animation completely
      clearInterval(animationInterval);
      clearTimeout(removeTimeout);

      // Force keep "up"
      brush.classList.add("up");
      puppetImg.classList.add("up");
    });
}


// Logic for the services card slider
const slider = document.getElementById("slider");
if (slider) {
    let currentIndex = 1; // default center
    const slides1 = document.querySelectorAll(".service-card1");
    const totalSlides = slides1.length;

    function updateSlides() {
      slides1.forEach((slide, i) => {
        slide.classList.remove("active", "left", "right");

        if (i === currentIndex) {
          slide.classList.add("active");
        } else if (i === (currentIndex - 1 + totalSlides) % totalSlides) {
          slide.classList.add("left");
        } else if (i === (currentIndex + 1) % totalSlides) {
          slide.classList.add("right");
        }
      });
    }

    function moveSlide(direction) {
      currentIndex = (currentIndex + direction + totalSlides) % totalSlides;
      updateSlides();
    }

    // Swipe for Mobile
    let startX = 0;
    slider.addEventListener("touchstart", (e) => {
      startX = e.touches[0].clientX;
    });

    slider.addEventListener("touchend", (e) => {
      let endX = e.changedTouches[0].clientX;
      if (startX - endX > 50) {
        moveSlide(1); // swipe left
      } else if (endX - startX > 50) {
        moveSlide(-1); // swipe right
      }
    });

    // Drag for Desktop
    let isDown = false;
    let mouseStartX = 0;

    slider.addEventListener("mousedown", (e) => {
      isDown = true;
      mouseStartX = e.clientX;
    });

    slider.addEventListener("mouseup", (e) => {
      if (!isDown) return;
      isDown = false;
      let mouseEndX = e.clientX;

      if (mouseStartX - mouseEndX > 50) {
        moveSlide(1); // drag left
      } else if (mouseEndX - mouseStartX > 50) {
        moveSlide(-1); // drag right
      }
    });

    slider.addEventListener("mouseleave", () => {
      isDown = false; // prevent stuck drag
    });

    updateSlides();
}


// Home reviews: load visible testimonials from public API, match existing card markup, then marquee + tilt
document.addEventListener("DOMContentLoaded", function () {
  const reviewsGrid = document.querySelector(".reviews-section .reviews-grid");
  if (!reviewsGrid) return;

  const apiUrl = reviewsGrid.getAttribute("data-testimonials-api");
  const originalCards = document.getElementById("original-cards");
  if (!originalCards || !apiUrl) return;

  const QUOTE_ICON_SVG =
    // '<svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">' +
    '<path d="M11 7H7C5.89543 7 5 7.89543 5 9V13C5 14.1046 5.89543 15 7 15H9C9 16.6569 7.65685 18 6 18V20C8.76142 20 11 17.7614 11 15V7Z" fill="rgba(255,255,255,0.15)"/>' +
    '<path d="M21 7H17C15.8954 7 15 7.89543 15 9V13C15 14.1046 15.8954 15 17 15H19C19 16.6569 17.6569 18 16 18V20C18.7614 20 21 17.7614 21 15V7Z" fill="rgba(255,255,255,0.15)"/>' +
    "</svg>";

  const STAR_SVG =
    '<svg fill="#ffd166" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>';

  function escapeHtml(text) {
    if (text == null) return "";
    const d = document.createElement("div");
    d.textContent = String(text);
    return d.innerHTML;
  }

  function escapeAttr(text) {
    return String(text)
      .replace(/&/g, "&amp;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#39;")
      .replace(/</g, "&lt;");
  }

  function buildStars(rating) {
    let n = parseInt(String(rating), 10);
    if (Number.isNaN(n)) n = 5;
    n = Math.max(1, Math.min(5, n));
    return STAR_SVG.repeat(n);
  }

  function buildTestimonialCard(item) {
    const name = item.client_name || "";
    const photo = item.photo_url || "img/Oval.png";
    const alt = escapeAttr(name);
    return (
      '<div class="testimonial-card" data-tilt>' +
      '<div class="card-glow"></div>' +
      '<div class="quote-icon">' +
      QUOTE_ICON_SVG +
      "</div>" +
      '<div class="card-header">' +
      '<div class="stars">' +
      buildStars(item.rating) +
      "</div>" +
      '<div class="pill">' +
      escapeHtml(item.badge_label || "Review") +
      "</div>" +
      "</div>" +
      '<div class="quote">' +
      escapeHtml(item.quote) +
      "</div>" +
      '<div class="author">' +
      '<div class="avatar">' +
      '<img alt="' +
      alt +
      '" src="' +
      escapeAttr(photo) +
      '" loading="lazy" />' +
      '<div class="avatar-ring"></div>' +
      "</div>" +
      '<div class="author-info">' +
      '<div class="name">' +
      escapeHtml(name) +
      "</div>" +
      '<div class="title">' +
      escapeHtml(item.subtitle || "") +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>"
    );
  }

  function removeMarqueeClone() {
    reviewsGrid.querySelectorAll(".review-card-set").forEach((el) => {
      if (el.id !== "original-cards") el.remove();
    });
  }

  function bindTestimonialInteractions() {
    const allCards = reviewsGrid.querySelectorAll(".testimonial-card");
    allCards.forEach((card) => {
      card.addEventListener("mouseenter", () => {
        reviewsGrid.style.animationPlayState = "paused";
      });
      card.addEventListener("mouseleave", () => {
        reviewsGrid.style.animationPlayState = "running";
      });

      card.addEventListener("mousemove", (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = (y - centerY) / 25;
        const rotateY = (centerX - x) / 25;
        card.style.transform =
          "perspective(1000px) rotateX(" +
          rotateX +
          "deg) rotateY(" +
          rotateY +
          "deg) translateY(-8px)";
      });

      card.addEventListener("mouseleave", () => {
        card.style.transform = "translateY(0)";
        card.style.transition = "transform 0.4s ease";
      });

      card.addEventListener("mouseenter", () => {
        card.style.transition = "transform 0.15s ease";
      });
    });
  }

  function setupMarqueeFromOriginal() {
    removeMarqueeClone();
    const clonedCards = originalCards.cloneNode(true);
    clonedCards.removeAttribute("id");
    reviewsGrid.appendChild(clonedCards);
    bindTestimonialInteractions();
  }

  fetch(apiUrl, { credentials: "same-origin" })
    .then((res) => {
      if (!res.ok) throw new Error("Bad response");
      return res.json();
    })
    .then((items) => {
      if (!Array.isArray(items) || items.length === 0) {
        reviewsGrid.classList.add("reviews-grid--empty");
        originalCards.innerHTML = "";
        originalCards.setAttribute("aria-busy", "false");
        return;
      }
      reviewsGrid.classList.remove("reviews-grid--empty");
      originalCards.innerHTML = items.map(buildTestimonialCard).join("");
      originalCards.setAttribute("aria-busy", "false");
      setupMarqueeFromOriginal();
    })
    .catch(() => {
      reviewsGrid.classList.add("reviews-grid--empty");
      originalCards.innerHTML = "";
      originalCards.setAttribute("aria-busy", "false");
    });
});





// Dotted Canvas Script
function drawDots() {
    var canvas = document.getElementById("dots-canvas");
    if (!canvas) return;
    var ctx = canvas.getContext("2d");
    var w = canvas.offsetWidth || 400;
    var h = canvas.offsetHeight || 350;
    canvas.width = w;
    canvas.height = h;
    ctx.clearRect(0, 0, w, h);

    var dotColor = "#FFF";
    var spacing = 18;
    var size = 2.1;
    var rows = Math.floor(h / spacing),
      cols = Math.floor(w / spacing);

    for (var y = 0; y < rows; y++) {
      for (var x = 0; x < cols; x++) {
        ctx.beginPath();
        ctx.arc(
          x * spacing + spacing / 2,
          y * spacing + spacing / 2,
          size,
          0,
          2 * Math.PI
        );
        ctx.fillStyle = dotColor;
        ctx.globalAlpha = 0.17;
        ctx.fill();
      }
    }
}
window.addEventListener("resize", drawDots);
window.addEventListener("DOMContentLoaded", drawDots);

// Accordion logic for FAQ
const accordionItems = document.querySelectorAll('.accordion-item');
accordionItems.forEach(item => {
    const header = item.querySelector('.accordion-header');
    const content = item.querySelector('.accordion-content');

    header.addEventListener('click', () => {
        const isActive = item.classList.contains('active');

        // Close all other accordion items
        accordionItems.forEach(otherItem => {
            if (otherItem !== item) {
                otherItem.classList.remove('active');
                otherItem.querySelector('.accordion-content').style.maxHeight = null;
            }
        });
        
        // Toggle the active state of the clicked item
        if (isActive) {
            item.classList.remove('active');
            content.style.maxHeight = null;
        } else {
            item.classList.add('active');
            content.style.maxHeight = content.scrollHeight + 'px';
        }
    });
});

// JavaScript to duplicate the scroller content for a seamless loop
const scroller = document.querySelector(".scroller");
if (scroller) {
    function addAnimation() {
        const scrollerInner = scroller.querySelector(".scroller__inner");
        const scrollerContent = Array.from(scrollerInner.children);

        // Duplicate each item and add it to the list
        scrollerContent.forEach((item) => {
            const duplicatedItem = item.cloneNode(true);
            duplicatedItem.setAttribute("aria-hidden", true);
            scrollerInner.appendChild(duplicatedItem);
        });
    }
    
    addAnimation();
}


// Tilted images click logic
document.querySelectorAll(".images-row img").forEach((img) => {
    img.addEventListener("click", () => {
      if (img.classList.contains("active")) {
        img.classList.remove("active");
      } else {
        document
          .querySelectorAll(".images-row img")
          .forEach((i) => i.classList.remove("active"));
        img.classList.add("active");
      }
    });
});




// ===== HOME PAGE: Projects Section “Next” Button =====
document.addEventListener("DOMContentLoaded", () => {
  const nextBtn = document.querySelector(".next-btn");
  const slides = document.querySelectorAll(".main-slide img");
  const titleEl = document.getElementById("project-title");
  const descEl = document.getElementById("project-desc");
  const previewImg = document.getElementById("preview-img");

  // Project data is now set dynamically from PHP in index.php inline script
  // This code skips if projectData is already handled by the inline script
  if (typeof projectData !== 'undefined' && projectData.length > 0) return;

  // Fallback: just handle basic slide switching without text updates
  if (!nextBtn || !slides.length) return;

  let currentIndex = 0;

  nextBtn.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % slides.length;
    slides.forEach((img, idx) => {
      img.classList.toggle("active", idx === currentIndex);
    });
    if (previewImg && slides.length > 1) {
      const nextIndex = (currentIndex + 1) % slides.length;
      previewImg.src = slides[nextIndex].src;
    }
  });
});



// --- START: VIEW MORE/LESS JAVASCRIPT ---
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggle-view-btn');
    const btnText = document.getElementById('btn-text');
    const btnArrow = document.getElementById('btn-arrow');
    const projectGrid = document.getElementById('project-grid');
    
    if (toggleBtn && projectGrid) {
        const allCards = Array.from(projectGrid.querySelectorAll('.project-card'));
        const btnContainer = toggleBtn.parentElement;
        
        let isExpanded = false;
        let extraCards = [];

        window.applyViewMoreLogic = function() {
            // Reset existing state
            isExpanded = false;
            allCards.forEach(card => card.classList.remove('extra-card', 'is-visible'));

            // Check which cards are actively supposed to be visible (not hidden by filter inline styles)
            const visibleCards = allCards.filter(card => card.style.display !== 'none');

            if (visibleCards.length > 4) {
                // If there are more than 4 visible cards, hide the rest under "View More"
                extraCards = visibleCards.slice(4);
                extraCards.forEach(card => card.classList.add('extra-card'));
                if (btnContainer) btnContainer.style.display = 'block';
            } else {
                extraCards = [];
                if (btnContainer) btnContainer.style.display = 'none';
            }

            // Reset button text
            if (btnText) btnText.textContent = 'View More';
            if (btnArrow) btnArrow.classList.remove('arrow-rotated');
            toggleBtn.classList.remove('btn-gray');
            toggleBtn.classList.add('btn-purple');
        };

        toggleBtn.addEventListener('click', function () {
            if (extraCards.length === 0) return;

            isExpanded = !isExpanded;

            if (isExpanded) {
                extraCards.forEach(card => card.classList.add('is-visible'));
                
                if (btnText) btnText.textContent = 'View Less';
                if (btnArrow) btnArrow.classList.add('arrow-rotated');
                toggleBtn.classList.remove('btn-purple');
                toggleBtn.classList.add('btn-gray');

            } else {
                const firstCard = projectGrid.querySelector('.project-card:not([style*="display: none"])');
                extraCards.forEach(card => card.classList.remove('is-visible'));
                
                setTimeout(() => {
                    if (firstCard) {
                        // Optional scroll-to-top of grid for smoother experience
                        firstCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 400);

                if (btnText) btnText.textContent = 'View More';
                if (btnArrow) btnArrow.classList.remove('arrow-rotated');
                toggleBtn.classList.remove('btn-gray');
                toggleBtn.classList.add('btn-purple');
            }
        });

        // Initialize on load
        window.applyViewMoreLogic();
    }
});
// --- END: VIEW MORE/LESS JAVASCRIPT ---





/* ===== REUSABLE SWEETALERT SUCCESS/ERROR BOX ===== */
(() => {
  const STYLE_ID = "uxp-sweetalert-success-box-theme";

  function ensureTheme() {
    if (document.getElementById(STYLE_ID)) return;

    const style = document.createElement("style");
    style.id = STYLE_ID;
    style.textContent = `
      .uxp-swal-popup {
        border-radius: 18px !important;
        border: 1px solid rgba(123, 97, 255, 0.28) !important;
        background: linear-gradient(160deg, rgba(20, 20, 38, 0.96), rgba(8, 8, 22, 0.98)) !important;
        color: #eef1ff !important;
        box-shadow: 0 24px 56px rgba(5, 5, 18, 0.55) !important;
        font-family: "Inter", system-ui, -apple-system, sans-serif !important;
        backdrop-filter: blur(10px) !important;
      }

      .uxp-swal-title {
        font-family: "Gabarito", "Inter", system-ui, sans-serif !important;
        letter-spacing: -0.01em;
        color: #ffffff !important;
      }

      .uxp-swal-text {
        color: rgba(229, 234, 255, 0.86) !important;
      }

      .uxp-swal-confirm {
        background: linear-gradient(135deg, #7b61ff, #6147bd) !important;
        border: none !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        box-shadow: 0 10px 22px rgba(97, 71, 189, 0.42) !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
      }

      .uxp-swal-confirm:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 24px rgba(97, 71, 189, 0.5) !important;
      }

      .swal2-container.swal2-backdrop-show {
        background: radial-gradient(circle at top, rgba(65, 41, 180, 0.35), rgba(0, 0, 0, 0.82)) !important;
      }

      .swal2-timer-progress-bar {
        background: linear-gradient(90deg, #9f88ff, #7b61ff) !important;
        transform-origin: right !important;
        animation: none !important;
        transform: scaleX(0);
        height: 0.2rem !important;
      }

      .swal2-popup.swal2-show .swal2-timer-progress-bar {
        animation: uxp-progress-fill linear forwards !important;
      }

      @keyframes uxp-progress-fill {
        from { transform: scaleX(0); }
        to { transform: scaleX(1); }
      }

      @keyframes uxp-popup-in {
        0% { opacity: 0; transform: translateY(14px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
      }

      @keyframes uxp-popup-out {
        0% { opacity: 1; transform: translateY(0) scale(1); }
        100% { opacity: 0; transform: translateY(10px) scale(0.96); }
      }

      .uxp-swal-show {
        animation: uxp-popup-in 0.26s cubic-bezier(0.2, 0.9, 0.22, 1) both !important;
      }

      .uxp-swal-hide {
        animation: uxp-popup-out 0.2s ease both !important;
      }
    `;

    document.head.appendChild(style);
  }

  function hasSwal() {
    return typeof window.Swal !== "undefined";
  }

  function showSuccess(options = {}) {
    const title = options.title || "Submitted Successfully!";
    const text = options.text || "We'll contact you soon.";
    const timer = Number(options.timer || 3000);

    if (!hasSwal()) {
      alert(`${title}\n${text}`);
      return;
    }

    ensureTheme();
    window.Swal.fire({
      icon: options.icon || "success",
      title,
      text,
      customClass: {
        popup: "uxp-swal-popup",
        title: "uxp-swal-title",
        htmlContainer: "uxp-swal-text"
      },
      backdrop: true,
      showConfirmButton: false,
      timer,
      timerProgressBar: true,
      showClass: { popup: "uxp-swal-show" },
      hideClass: { popup: "uxp-swal-hide" },
      didOpen: () => {
        const bar = document.querySelector(".swal2-timer-progress-bar");
        if (bar) bar.style.animationDuration = `${timer}ms`;
      }
    });
  }

  function showError(message = "Something went wrong. Please try again.") {
    if (!hasSwal()) {
      alert(message);
      return;
    }

    ensureTheme();
    window.Swal.fire({
      icon: "error",
      title: "Submission Failed",
      text: message,
      customClass: {
        popup: "uxp-swal-popup",
        title: "uxp-swal-title",
        htmlContainer: "uxp-swal-text",
        confirmButton: "uxp-swal-confirm"
      },
      confirmButtonText: "Try Again",
      showClass: { popup: "uxp-swal-show" },
      hideClass: { popup: "uxp-swal-hide" }
    });
  }

  window.UXPSuccessBox = {
    showSuccess,
    showError
  };
})();

/* ===== CONTACT PAGE FUNCTIONALITY ===== */

document.addEventListener('DOMContentLoaded', () => {
  // --- FORM AND FIELD SELECTION ---
  const form = document.getElementById('contactForm');
  if (!form) return; // Not on contact page — bail out early

  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const phoneInput = document.getElementById('phone');
  const industrySelect = document.getElementById('industry');
  const messageTextarea = document.getElementById('message');
  const termsCheckbox = document.getElementById('terms');
  const submitButton = form.querySelector('button[type="submit"]');
  const hpField = document.getElementById('company_website');
  const startedField = document.getElementById('form_started_at');
  if (startedField && !startedField.value) {
    startedField.value = String(Date.now());
  }

  if (termsCheckbox) {
    termsCheckbox.addEventListener('change', () => {
      if (termsCheckbox.checked) setSuccessCheckbox(termsCheckbox);
    });
  }

  // --- SUCCESS FEEDBACK HANDLING ---

  function celebrate() {
      if (typeof confetti !== 'function') return;

      const duration = 2 * 1000;
      const animationEnd = Date.now() + duration;
      const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 1051 };

      function randomInRange(min, max) {
          return Math.random() * (max - min) + min;
      }

      const interval = setInterval(function() {
          const timeLeft = animationEnd - Date.now();
          if (timeLeft <= 0) {
              return clearInterval(interval);
          }

          const particleCount = 50 * (timeLeft / duration);
          // Launch confetti from both sides
          confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } });
          confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } });
      }, 250);
      
      // Add a final big burst for extra celebration
      setTimeout(() => {
           confetti({ ...defaults, particleCount: 100, spread: 120, origin: { x: 0.5, y: 0.5 }, colors: ['#a78bfa', '#6366f1', '#ffffff'] });
      }, 500);
  }

  function showSuccessToast() {
      window.scrollTo(0, 0);
      celebrate();
      if (window.UXPSuccessBox && typeof window.UXPSuccessBox.showSuccess === 'function') {
          window.UXPSuccessBox.showSuccess({
              title: 'Message Sent!',
              text: 'Thank you. We will contact you shortly.',
              timer: 3000
          });
      }
  }
  
  // --- VALIDATION AND UI FEEDBACK ---
  const originalBorderStyle = 'linear-gradient(to right, #ffffff 0%, #2e2e3e 100%) border-box';
  const errorBorderStyle = 'linear-gradient(to right, #ff5722, #d32f2f) border-box';

  // Finds the nearest wrapping field container for error injection
  const getFieldParent = (element) =>
      element.closest('.contact-field') ||
      element.closest('.form-group') ||
      element.closest('.contact-row') ||
      element.closest('.form-row') ||
      element.parentElement;

  const setError = (element, message) => {
      if (!element) return;
      if (element.type !== 'hidden') {
          element.style.background = `linear-gradient(#121212, #121212) padding-box, ${errorBorderStyle}`;
      }
      const parent = getFieldParent(element);
      if (!parent) return;
      const oldError = parent.querySelector('.error-message');
      if (oldError) oldError.remove();
      const error = document.createElement('div');
      error.className = 'error-message';
      error.textContent = message;
      error.style.color = '#ff8a80';
      error.style.fontSize = '0.9rem';
      error.style.marginTop = '4px';
      parent.appendChild(error);
  };

  const setSuccess = (element) => {
      if (!element) return;
      if (element.type !== 'hidden') {
          element.style.background = `linear-gradient(#121212, #121212) padding-box, ${originalBorderStyle}`;
      }
      const parent = getFieldParent(element);
      if (!parent) return;
      const error = parent.querySelector('.error-message');
      if (error) error.remove();
  };
  
  const setErrorCheckbox = (checkbox) => {
    checkbox.style.outline = '2px solid #ff5722';
    checkbox.style.outlineOffset = '2px';
  };

  const setSuccessCheckbox = (checkbox) => {
    checkbox.style.outline = '';
    checkbox.style.outlineOffset = '';
  };

  const validateField = (field) => {
      const value = field.value.trim();
      let isValid = true;
      
      switch (field.id) {
          case 'name':
              if (value === '') {
                  setError(field, 'Name is required.');
                  isValid = false;
              } else if (!/^[a-zA-Z\s]{2,50}$/.test(value)) {
                  setError(field, 'Please enter a valid name.');
                  isValid = false;
              } else {
                  setSuccess(field);
              }
              break;
          case 'email':
              if (value === '') {
                  setError(field, 'Email is required.');
                  isValid = false;
              } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                  setError(field, 'Please enter a valid email address.');
                  isValid = false;
              } else {
                  setSuccess(field);
              }
              break;
          case 'phone':
               if (value === '') {
                  setError(field, 'Phone number is required.');
                  isValid = false;
              } else if (!/^[6-9]\d{9}$/.test(value.replace(/[\s\-\+\|]/g, ''))) {
                  setError(field, 'Please enter a valid 10-digit mobile number.');
                  isValid = false;
              } else {
                  setSuccess(field);
              }
              break;
          case 'industry':
              if (value === '') {
                  setError(field, 'Please select an industry.');
                  isValid = false;
              } else {
                  setSuccess(field);
              }
              break;
          case 'message':
              if (value === '') {
                  setError(field, 'Message is required.');
                  isValid = false;
              } else if (value.length < 10) {
                  setError(field, 'Message must be at least 10 characters long.');
                  isValid = false;
              } else {
                  setSuccess(field);
              }
              break;
          case 'terms':
               if (!field.checked) {
                  setErrorCheckbox(field);
                  isValid = false;
              } else {
                  setSuccessCheckbox(field);
              }
              break;
      }
      return isValid;
  };

  // --- FORM SUBMISSION LOGIC ---
  form.addEventListener('submit', async (e) => {
      e.preventDefault(); // Always prevent default submission first

      // Validate all fields and check if the form is valid
      const isNameValid = validateField(nameInput);
      const isEmailValid = validateField(emailInput);
      const isPhoneValid = validateField(phoneInput);
      const isIndustryValid = validateField(industrySelect);
      const isMessageValid = validateField(messageTextarea);
      const isTermsValid = validateField(termsCheckbox);

      const isFormValid = isNameValid && isEmailValid && isPhoneValid && isIndustryValid && isMessageValid && isTermsValid;
      
      if (!isFormValid) {
          console.log('Validation failed. Please check the form.');
          return; // Stop if validation fails
      }
      
      // --- If validation passes, proceed to submit ---
      if (submitButton) { submitButton.disabled = true; submitButton.textContent = 'Sending...'; }

      const formData = {
          form_type: 'contact',
          name: nameInput.value.trim(),
          email: emailInput.value.trim(),
          phone: phoneInput.value.trim(),
          industry: industrySelect.value,
          message: messageTextarea.value.trim(),
          terms: !!(termsCheckbox && termsCheckbox.checked),
          company_website: hpField ? hpField.value.trim() : '',
          form_started_at: startedField ? parseInt(startedField.value, 10) || 0 : 0,
      };

      try {
          const response = await fetch('send', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
              body: JSON.stringify(formData)
          });

          const result = await response.json();

          if (response.ok && result.success) {
              // SUCCESS: Show animated popup and reset form
              showSuccessToast();
              form.reset();
              // Reset dropdown label
              const btnText = document.querySelector('#dropdownBtn span');
              if (btnText) btnText.textContent = 'Select your Industry';
              const dropdownBtn = document.getElementById('dropdownBtn');
              if (dropdownBtn) dropdownBtn.classList.remove('selected');
              // Clear validation styles on reset
              [nameInput, emailInput, phoneInput, industrySelect, messageTextarea].forEach(setSuccess);
              setSuccessCheckbox(termsCheckbox);
          } else {
              // FAIL: Show server error message
              if (window.UXPSuccessBox && typeof window.UXPSuccessBox.showError === 'function') {
                  window.UXPSuccessBox.showError(result.message || 'Submission failed. Please try again later.');
              } else {
                  alert(result.message || 'Submission failed. Please try again later.');
              }
          }
      } catch (error) {
          // FAIL: Handle network or other client-side errors
          console.error('Error connecting to the server:', error);
          if (window.UXPSuccessBox && typeof window.UXPSuccessBox.showError === 'function') {
              window.UXPSuccessBox.showError('Could not connect to the server. Please check your connection and try again.');
          } else {
              alert('Could not connect to the server. Please check your connection and try again.');
          }
      } finally {
          // Re-enable the button regardless of outcome
          if (submitButton) { submitButton.disabled = false; submitButton.textContent = 'Send Message'; }
      }
  });
});


// Mobile detection for iPhone 14 Pro Max (<= 430px)

(function () {
  // --- Robust mobile test (covers iPhone 14 Pro Max portrait and similar phones) ---
  function isSmallMobile() {
    // CSS width threshold (iPhone 14 Pro Max portrait ~430px)
    const smallWidthMatch = window.matchMedia('(max-width: 430px)').matches;

    // Extra check for iPhone user agent + small physical screen dims (in case CSS width differs)
    const isiPhoneUA = /iPhone/.test(navigator.userAgent);
    const smallScreenDim = Math.min(screen.width, screen.height) <= 430;

    return smallWidthMatch || (isiPhoneUA && smallScreenDim);
  }

  // Force black background and hide canvas for small mobiles
  function enableMobileBlackBackground() {
    const canvas = document.getElementById('interactive-canvas');
    if (canvas) {
      canvas.style.display = 'none';
    }
    // apply to root containers too to ensure visible black bg
    document.documentElement.style.background = '#000';
    document.body.style.background = '#000';
    document.body.style.minHeight = '100vh';
    document.body.style.overflowX = 'hidden';
    // hide custom cursor if present
    const cursor = document.querySelector('.custom-cursor');
    if (cursor) cursor.style.display = 'none';
  }

  // If not mobile, run the full canvas animation and rest of scripts
  function runDesktopCanvasAndScripts() {
    const canvas = document.getElementById('interactive-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const cursor = document.querySelector('.custom-cursor');

    let width, height, grid;
    let mouse = { x: 0, y: 0, radius: 100 };
    let targetMouseRadius = 100;

    const settings = {
      gridGap: 35,
      spring: 0.1,
      friction: 0.8
    };

    class Point {
      constructor(x, y) {
        this.x = x;
        this.y = y;
        this.originalX = x;
        this.originalY = y;
        this.vx = 0;
        this.vy = 0;
        this.color = 'rgba(255, 255, 255, 0.3)';
        this.size = 2;
      }
      update() {
        const dx = this.x - mouse.x;
        const dy = this.y - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < mouse.radius) {
          const angle = Math.atan2(dy, dx);
          const force = (mouse.radius - dist) * 0.1;
          this.vx += Math.cos(angle) * force;
          this.vy += Math.sin(angle) * force;
        }

        this.vx += (this.originalX - this.x) * settings.spring;
        this.vy += (this.originalY - this.y) * settings.spring;
        this.vx *= settings.friction;
        this.vy *= settings.friction;
        this.x += this.vx;
        this.y += this.vy;
      }
      draw() {
        const dx = this.x - mouse.x;
        const dy = this.y - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        let size = this.size;
        let color = this.color;

        if (dist < mouse.radius) {
          const proximity = 1 - (dist / mouse.radius);
          size = 2 + proximity * 3;
          color = `hsl(253, 50%, ${51 + proximity * 30}%)`;
        }

        ctx.fillStyle = color;
        ctx.beginPath();
        ctx.arc(this.x, this.y, size, 0, Math.PI * 2);
        ctx.fill();
      }
    }

    function init() {
      // Use device viewport pixels for canvas size (keeps it crisp)
      width = canvas.width = window.innerWidth;
      height = canvas.height = window.innerHeight;
      grid = [];
      for (let x = 0; x < width + settings.gridGap; x += settings.gridGap) {
        for (let y = 0; y < height + settings.gridGap; y += settings.gridGap) {
          grid.push(new Point(x, y));
        }
      }
    }

    function animate() {
      mouse.radius += (targetMouseRadius - mouse.radius) * 0.1;
      ctx.clearRect(0, 0, width, height);

      for (let i = 0; i < grid.length; i++) {
        for (let j = i + 1; j < grid.length; j++) {
          const p1 = grid[i];
          const p2 = grid[j];
          const dx = p1.x - p2.x;
          const dy = p1.y - p2.y;
          const dist = Math.sqrt(dx * dx + dy * dy);

          if (dist < settings.gridGap * 1.5) {
            const mouseDist = Math.sqrt(Math.pow(p1.x - mouse.x, 2) + Math.pow(p1.y - mouse.y, 2));
            let opacity = 0.1;
            let color = `rgba(255, 255, 255, ${opacity})`;

            if (mouseDist < mouse.radius) {
              const proximity = 1 - (mouseDist / mouse.radius);
              opacity = 0.1 + proximity * 0.5;
              color = `hsla(253, 50%, 70%, ${opacity})`;
            }

            ctx.strokeStyle = color;
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(p1.x, p1.y);
            ctx.lineTo(p2.x, p2.y);
            ctx.stroke();
          }
        }
      }

      grid.forEach(point => {
        point.update();
        point.draw();
      });

      requestAnimationFrame(animate);
    }

    // Events
    window.addEventListener('resize', () => {
      // if viewport becomes small while running, reload to apply mobile mode
      if (isSmallMobile()) {
        window.location.reload();
        return;
      }
      init();
    });

    window.addEventListener('mousemove', e => {
      mouse.x = e.clientX;
      mouse.y = e.clientY;
      if (cursor) {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
      }
      // spawn small trail dot for fun (non-essential)
    });

    window.addEventListener('mousedown', () => {
      targetMouseRadius = 150;
      if (cursor) {
        cursor.style.transform = 'translate(-50%, -50%) scale(0.8)';
        cursor.style.backgroundColor = 'rgba(97, 71, 189, 0.2)';
      }
    });

    window.addEventListener('mouseup', () => {
      targetMouseRadius = 100;
      if (cursor) {
        cursor.style.transform = 'translate(-50%, -50%) scale(1)';
        cursor.style.backgroundColor = 'transparent';
      }
    });

    const interactiveElements = document.querySelectorAll('a, button, .logo-container');
    interactiveElements.forEach(el => {
      el.addEventListener('mouseenter', () => {
        targetMouseRadius = 180;
        if (cursor) cursor.style.opacity = '0';
      });
      el.addEventListener('mouseleave', () => {
        targetMouseRadius = 100;
        if (cursor) cursor.style.opacity = '1';
      });
    });

    // initialize and start
    init();
    animate();
  }

  // --- Decide mode at load ---
  function boot() {
    if (isSmallMobile()) {
      enableMobileBlackBackground();
    } else {
      runDesktopCanvasAndScripts();
    }
  }

  // If orientation changes or window resizes significantly, reload to re-evaluate mode.
  // (Reloading ensures the canvas initialization vs mobile hiding is clean.)
  let resizeTimeout;
  window.addEventListener('orientationchange', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => window.location.reload(), 300);
  });
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      // Only reload if crossing the small-mobile threshold to avoid infinite reload loops
      const nowSmall = isSmallMobile();
      const wasSmall = window.__wasSmallMobileMode || false;
      if (nowSmall !== wasSmall) {
        window.location.reload();
      }
    }, 250);
  });

  // Track initial state so resize logic knows if mode changed
  window.__wasSmallMobileMode = isSmallMobile();

  // Wait for DOM ready then boot
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }

})(); // IIFE end

/* ============================================================
  NOTE:
  - Paste this as your entire main.js (or the portion that handles
    canvas + initial DOM boot logic). The rest of your existing
    page scripts (sliders, accordions, etc.) can remain in the file
    below this block or in separate scripts — they will still run.
  - If you keep other code in the same file, ensure it does not
    re-initialize the canvas after mobile mode is enabled.
  ============================================================ */


/* ── Back to Top Button Functionality ── */
document.addEventListener('DOMContentLoaded', () => {
  const backToTopBtn = document.getElementById('backToTopBtn');
  if (!backToTopBtn) return;

  // Show/hide button based on scroll position
  window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
      backToTopBtn.classList.add('show');
    } else {
      backToTopBtn.classList.remove('show');
    }
  });

  // Smooth scroll to top
  backToTopBtn.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
});



// back to top button functionality
document.addEventListener("DOMContentLoaded", function () {
  // Inject styles dynamically to prevent caching issues and ensure z-index is high enough
  const style = document.createElement("style");
  style.innerHTML = `
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: #6147bd;
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      visibility: hidden;
      transform: translateY(20px);
      transition: all 0.3s ease;
      z-index: 99999;
    }
    .back-to-top.show {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    .back-to-top:hover {
      background: #6147bd;
    }
    .back-to-top svg {
      fill: #fff;
      width: 24px;
      height: 24px;
    }
  `;
  document.head.appendChild(style);

  const backToTopBtn = document.createElement("button");
  backToTopBtn.id = "backToTop";
  backToTopBtn.className = "back-to-top";
  backToTopBtn.setAttribute("aria-label", "Back to top");
  backToTopBtn.innerHTML = '<img src="img/back.png" alt="Back to top" height="48" width="48">';
  document.body.appendChild(backToTopBtn);

  let activeScrollContainer = window;

  // Use capturing phase to catch scrolls even if they happen inside a wrapper div
  window.addEventListener("scroll", (e) => {
    let scrollPos = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop || 0;
    
    // Check if another element is acting as the main scrolling container
    if (e.target instanceof Element && e.target.scrollHeight > window.innerHeight) {
      scrollPos = Math.max(scrollPos, e.target.scrollTop);
      activeScrollContainer = e.target;
    }

    if (scrollPos > 200) {
      backToTopBtn.classList.add("show");
    } else {
      backToTopBtn.classList.remove("show");
    }
  }, true);

  backToTopBtn.addEventListener("click", () => {
    // Scroll window
    window.scrollTo({ top: 0, behavior: "smooth" });
    
    // Scroll active container if it's not the window
    if (activeScrollContainer && activeScrollContainer !== window) {
      activeScrollContainer.scrollTo({ top: 0, behavior: "smooth" });
    }
  });
});