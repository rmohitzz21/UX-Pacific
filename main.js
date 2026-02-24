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


// JavaScript for the seamless review slider loop and hover pause
document.addEventListener("DOMContentLoaded", function () {
    const reviewsGrid = document.querySelector(".reviews-grid");
    if (reviewsGrid) {
        const originalCards = document.getElementById("original-cards");

        // Clone the original set of cards to create the seamless effect
        const clonedCards = originalCards.cloneNode(true);
        clonedCards.removeAttribute("id");
        reviewsGrid.appendChild(clonedCards);

        // Logic to pause animation ONLY on card hover
        const allCards = document.querySelectorAll(".testimonial-card");

        allCards.forEach((card) => {
          card.addEventListener("mouseenter", () => {
            reviewsGrid.style.animationPlayState = "paused";
          });
          card.addEventListener("mouseleave", () => {
            reviewsGrid.style.animationPlayState = "running";
          });
        });
    }
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

  const projectData = [
    {
      title: "Case Study of Survey Pacific",
      desc: "We revamped the website UI/UX through deep heuristic evaluation and competitive benchmarking. The result? A streamlined, user-friendly experience tailored for a global audience.",
      link: "#"
    },
    {
      title: "UX Audit of CEDAR Himalaya",
      desc: "Designing for Change! We audited their digital experience to align with their mission of sustainable mountain development.The recommendations improved content clarity, accessibility, and user trust across the platform.",
      link: "#"
    },
    {
      title: "UX Audit of Distinct Buzz",
      desc: "Audited for Impact! We conducted a full-scale UX audit to uncover usability gaps and friction in the user journey. Our insights led to smoother navigation, better mobile responsiveness, and higher engagement.",
      link: "#"
    }
  ];

  let currentIndex = 0;

  function updateSlide(index) {
    slides.forEach((img, idx) => {
      img.classList.toggle("active", idx === index);
    });
    titleEl.textContent = projectData[index].title;
    descEl.textContent = projectData[index].desc;
    const nextIndex = (index + 1) % slides.length;
    previewImg.src = slides[nextIndex].src;
  }

  if (nextBtn) {
    nextBtn.addEventListener("click", () => {
      currentIndex = (currentIndex + 1) % slides.length;
      updateSlide(currentIndex);
    });
  }

  // Initialize first slide
  updateSlide(currentIndex);
});



// --- START: VIEW MORE/LESS JAVASCRIPT ---
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggle-view-btn');
    const btnText = document.getElementById('btn-text');
    const btnArrow = document.getElementById('btn-arrow');
    const extraCards = document.querySelectorAll('.extra-card');
    const projectGrid = document.getElementById('project-grid');
    
    let isExpanded = false;

    if (toggleBtn && btnText && btnArrow && extraCards.length > 0 && projectGrid) {
        toggleBtn.addEventListener('click', function () {
            isExpanded = !isExpanded;

            if (isExpanded) {
                extraCards.forEach(card => card.classList.add('is-visible'));
                
                btnText.textContent = 'View Less';
                btnArrow.classList.add('arrow-rotated');
                toggleBtn.classList.remove('btn-purple');
                toggleBtn.classList.add('btn-gray');

            } else {
                const firstCard = projectGrid.querySelector('.project-card:first-child');
                extraCards.forEach(card => card.classList.remove('is-visible'));
                
                setTimeout(() => {
                    if (firstCard) {
                        firstCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 500);

                btnText.textContent = 'View More';
                btnArrow.classList.remove('arrow-rotated');
                toggleBtn.classList.remove('btn-gray');
                toggleBtn.classList.add('btn-purple');
            }
        });
    }
});
// --- END: VIEW MORE/LESS JAVASCRIPT ---


// Tilted images click logic
// document.querySelectorAll('.images-row img').forEach(img => {
//   img.addEventListener('click', () => {
//     document.querySelectorAll('.images-row img').forEach(i => i.classList.remove('active'));
//     img.classList.add('active');
//   });
// });



/* ===== CONTACT PAGE FUNCTIONALITY ===== */

document.addEventListener('DOMContentLoaded', () => {
  // --- FORM AND FIELD SELECTION ---
  const form = document.getElementById('contactForm');
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const phoneInput = document.getElementById('phone');
  const industrySelect = document.getElementById('industry');
  const messageTextarea = document.getElementById('message');
  const termsCheckbox = document.getElementById('terms');
  const submitButton = form.querySelector('.submit-btn');

  // --- MODAL AND CELEBRATION HANDLING ---
  const modalOverlay = document.getElementById('modal-overlay');
  const closeModalButton = document.querySelector('.close-modal');

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

  function showModal() {
      modalOverlay.classList.add('show');
      window.scrollTo(0, 0); // Scroll to top to see modal
      celebrate(); // Trigger the cool celebration effect
  }

  function hideModal() {
      modalOverlay.classList.remove('show');
  }

  if (closeModalButton) {
      closeModalButton.addEventListener('click', hideModal);
  }
  
  // --- VALIDATION AND UI FEEDBACK ---
  const originalBorderStyle = 'linear-gradient(to right, #ffffff 0%, #2e2e3e 100%) border-box';
  const errorBorderStyle = 'linear-gradient(to right, #ff5722, #d32f2f) border-box';

  const setError = (element, message) => {
      element.style.background = `linear-gradient(#121212, #121212) padding-box, ${errorBorderStyle}`;
      const parent = element.closest('.form-group, .form-row');
      // Remove existing error to avoid duplicates
      const oldError = parent.querySelector('.error-message');
      if (oldError) oldError.remove();
      // Add new error message
      const error = document.createElement('div');
      error.className = 'error-message';
      error.textContent = message;
      error.style.color = '#ff8a80';
      error.style.fontSize = '0.9rem';
      error.style.marginTop = '4px';
      parent.appendChild(error);
  };

  const setSuccess = (element) => {
      element.style.background = `linear-gradient(#121212, #121212) padding-box, ${originalBorderStyle}`;
      const parent = element.closest('.form-group, .form-row');
      const error = parent.querySelector('.error-message');
      if (error) {
          error.remove();
      }
  };
  
  const setErrorCheckbox = (checkbox) => {
    const customBox = checkbox.nextElementSibling;
    if (customBox) customBox.style.borderColor = '#ff5722';
  };

  const setSuccessCheckbox = (checkbox) => {
    const customBox = checkbox.nextElementSibling;
    if (customBox) customBox.style.borderColor = '#fff';
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
      submitButton.disabled = true;
      submitButton.textContent = 'Submitting...';

      const formData = {
          name: nameInput.value.trim(),
          email: emailInput.value.trim(),
          phone: phoneInput.value.trim(),
          industry: industrySelect.value,
          message: messageTextarea.value.trim(),
      };

      try {
          const response = await fetch('http://localhost:5000/api/contact', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify(formData)
          });

          if (response.ok) {
              // SUCCESS: Show modal and reset form
              console.log('Form submitted successfully!');
              showModal();
              form.reset();
              // Clear validation styles on reset
              [nameInput, emailInput, phoneInput, industrySelect, messageTextarea].forEach(setSuccess);
              setSuccessCheckbox(termsCheckbox);
          } else if (response.status === 409) {
              // HANDLE DUPLICATE EMAIL
              const errorData = await response.json();
              setError(emailInput, errorData.message || 'This email is already registered.');
          } else {
              // FAIL: Handle other server-side errors
              const errorData = await response.json();
              console.error('Submission failed:', errorData.message || 'Something went wrong on the server.');
              alert('Submission failed. Please try again later.'); 
          }
      } catch (error) {
          // FAIL: Handle network or other client-side errors
          console.error('Error connecting to the server:', error);
          alert('Could not connect to the server. Please check your connection and try again.');
      } finally {
          // Re-enable the button regardless of outcome
          submitButton.disabled = false;
          submitButton.textContent = 'Submit Now';
      }
  });
});


// Logo 

document.addEventListener("DOMContentLoaded", function () {
  const mediaQuery = window.matchMedia("(max-width: 900px)");
  const img = document.getElementById("myImage");

  function checkScreenSize(e) {
    if (e.matches) {
      // Screen 900px or less
      img.src = "img/LOGO 3.png";
      img.style.width="50px"
    } else {
      // Screen larger than 900px
      img.src = "img/LOGO.png";
      img.style.width="200px";
    }
  }

  // Check on page load
  checkScreenSize(mediaQuery);

  // Check on resize
  mediaQuery.addEventListener("change", checkScreenSize);
});



// 👉 Disable animation and show plain black background on mobiles



// Interactive background canvas animation

// const canvas = document.getElementById('interactive-canvas');

// if (canvas) {
  
//     const ctx = canvas.getContext('2d');
//     const cursor = document.querySelector('.custom-cursor');

//     let width, height, grid;
//     let mouse = { x: 0, y: 0, radius: 100 };
//     let targetMouseRadius = 100;

//     const settings = {
//         gridGap: 35,
//         spring: 0.1,
//         friction: 0.8
//     };

//     class Point {
//         constructor(x, y) {
//             this.x = x;
//             this.y = y;
//             this.originalX = x;
//             this.originalY = y;
//             this.vx = 0;
//             this.vy = 0;
//             this.color = 'rgba(255, 255, 255, 0.3)';
//             this.size = 2;
//         }

//         update() {
//             const dx = this.x - mouse.x;
//             const dy = this.y - mouse.y;
//             const dist = Math.sqrt(dx * dx + dy * dy);
            
//             if (dist < mouse.radius) {
//                 const angle = Math.atan2(dy, dx);
//                 const force = (mouse.radius - dist) * 0.1;
//                 this.vx += Math.cos(angle) * force;
//                 this.vy += Math.sin(angle) * force;
//             }

//             this.vx += (this.originalX - this.x) * settings.spring;
//             this.vy += (this.originalY - this.y) * settings.spring;
//             this.vx *= settings.friction;
//             this.vy *= settings.friction;
//             this.x += this.vx;
//             this.y += this.vy;
//         }

//         draw() {
//             const dx = this.x - mouse.x;
//             const dy = this.y - mouse.y;
//             const dist = Math.sqrt(dx * dx + dy * dy);

//             let size = this.size;
//             let color = this.color;
            
//             if (dist < mouse.radius) {
//                 const proximity = 1 - (dist / mouse.radius);
//                 size = 2 + proximity * 3;
//                 color = `hsl(253, 50%, ${51 + proximity * 30}%)`;
//             }
            
//             ctx.fillStyle = color;
//             ctx.beginPath();
//             ctx.arc(this.x, this.y, size, 0, Math.PI * 2);
//             ctx.fill();
//         }
//     }

//     function init() {
//         width = canvas.width = window.innerWidth;
//         height = canvas.height = window.innerHeight;
//         grid = [];
//         for (let x = 0; x < width + settings.gridGap; x += settings.gridGap) {
//             for (let y = 0; y < height + settings.gridGap; y += settings.gridGap) {
//                 grid.push(new Point(x, y));
//             }
//         }
//     }

//     function animate() {
//         mouse.radius += (targetMouseRadius - mouse.radius) * 0.1;

//         ctx.clearRect(0, 0, width, height);

//         for (let i = 0; i < grid.length; i++) {
//             for (let j = i + 1; j < grid.length; j++) {
//                 const p1 = grid[i];
//                 const p2 = grid[j];
//                 const dx = p1.x - p2.x;
//                 const dy = p1.y - p2.y;
//                 const dist = Math.sqrt(dx * dx + dy * dy);

//                 if (dist < settings.gridGap * 1.5) {
//                     const mouseDist = Math.sqrt(Math.pow(p1.x - mouse.x, 2) + Math.pow(p1.y - mouse.y, 2));
//                     let opacity = 0.1;
//                     let color = `rgba(255, 255, 255, ${opacity})`;

//                     if (mouseDist < mouse.radius) {
//                        const proximity = 1 - (mouseDist / mouse.radius);
//                        opacity = 0.1 + proximity * 0.5;
//                        color = `hsla(253, 50%, 70%, ${opacity})`;
//                     }
                    
//                     ctx.strokeStyle = color;
//                     ctx.lineWidth = 1;
//                     ctx.beginPath();
//                     ctx.moveTo(p1.x, p1.y);
//                     ctx.lineTo(p2.x, p2.y);
//                     ctx.stroke();
//                 }
//             }
//         }

//         grid.forEach(point => {
//             point.update();
//             point.draw();
//         });

//         requestAnimationFrame(animate);
//     }

//     window.addEventListener('resize', init);
//     window.addEventListener('mousemove', e => {
//         mouse.x = e.clientX;
//         mouse.y = e.clientY;
//         if(cursor) {
//             cursor.style.left = e.clientX + 'px';
//             cursor.style.top = e.clientY + 'px';
//         }
//     });
    
//     window.addEventListener('mousedown', () => {
//          targetMouseRadius = 150;
//          if(cursor) {
//              cursor.style.transform = 'translate(-50%, -50%) scale(0.8)';
//              cursor.style.backgroundColor = 'rgba(97, 71, 189, 0.2)';
//          }
//     });
    
//     window.addEventListener('mouseup', () => {
//         targetMouseRadius = 100;
//         if(cursor) {
//             cursor.style.transform = 'translate(-50%, -50%) scale(1)';
//             cursor.style.backgroundColor = 'transparent';
//         }
//     });
    
//     const interactiveElements = document.querySelectorAll('a, button, .logo-container');
//     interactiveElements.forEach(el => {
//         el.addEventListener('mouseenter', () => {
//             targetMouseRadius = 180; 
//             if(cursor) cursor.style.opacity = '0';
//         });
//         el.addEventListener('mouseleave', () => {
//             targetMouseRadius = 100; 
//             if(cursor) cursor.style.opacity = '1';
//         });
//     });

//     init();
//     animate();
// }


// main.js - updated: robust mobile detection for iPhone 14 Pro Max (<= 430px)

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

  document.addEventListener("DOMContentLoaded", function () {
    const currentPage = window.location.pathname.split("/").pop();

    document.querySelectorAll(".navbar-nav .nav-link").forEach(link => {
      const linkPage = link.getAttribute("href");

      if (linkPage === currentPage) {
        link.classList.add("active");
      } else {
        link.classList.remove("active");
      }
    });
  });

