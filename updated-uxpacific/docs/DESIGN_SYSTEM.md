# UX Pacific — Design System v2.0
**A premium, designer-loved visual language for the evolved UX Pacific website.**

---

## Overview

This document defines the complete design system for the updated UX Pacific website. It covers design tokens, typography, color, spacing, components, and interaction principles.

**Philosophy:** Every pixel has purpose. No decoration without intention.

---

## 1. Color System

### Core Palette

| Token | Value | Usage |
|-------|-------|-------|
| `--clr-bg` | `#07071a` | Page background |
| `--clr-bg-raised` | `#0b0b1e` | Slightly raised surfaces (alt sections) |
| `--clr-surface` | `#101028` | Cards, panels, form backgrounds |
| `--clr-surface-2` | `#14143a` | Hovered card states |
| `--clr-surface-3` | `#1a1a48` | Deep surfaces |

### Accent System

| Token | Value | Usage |
|-------|-------|-------|
| `--clr-accent` | `#7c5fe6` | Primary interactive accent |
| `--clr-accent-2` | `#a78bfa` | Secondary accent, labels, text highlights |
| `--clr-accent-3` | `#c084fc` | Gradient endpoint, glow effects |
| `--clr-accent-light` | `rgba(124,95,230,0.12)` | Icon backgrounds, chip backgrounds |
| `--clr-accent-glow` | `rgba(124,95,230,0.22)` | Shadow glow on cards |

### Text Colors

| Token | Value | Usage |
|-------|-------|-------|
| `--clr-text` | `#e8e8f4` | Primary body text |
| `--clr-text-muted` | `#8888b0` | Secondary text, descriptions |
| `--clr-text-subtle` | `#55556e` | Placeholder text, metadata |
| `--clr-white` | `#ffffff` | Headings, high-emphasis text |

### Borders

| Token | Value | Usage |
|-------|-------|-------|
| `--clr-border` | `rgba(255,255,255,0.06)` | Default subtle border |
| `--clr-border-strong` | `rgba(255,255,255,0.12)` | Stronger border (form inputs) |
| `--clr-border-hover` | `rgba(124,95,230,0.35)` | Hover state border (accent tint) |

### Gradients

| Token | Value | Usage |
|-------|-------|-------|
| `--grad-accent` | `linear-gradient(135deg, #6147bd, #a78bfa, #c084fc)` | Gradient text, badges |
| `--grad-accent-h` | `linear-gradient(90deg, #6147bd, #a78bfa)` | Buttons, tags |
| `--grad-text` | `linear-gradient(135deg, #e8e8f4, #a78bfa)` | Gradient text utility |
| `--grad-card` | `linear-gradient(135deg, rgba(255,255,255,0.04), transparent)` | Card surface shimmer |

---

## 2. Typography

### Font Families

| Use Case | Font | Weight |
|----------|------|--------|
| Headings, Display, Navigation | Plus Jakarta Sans | 300–800 |
| Body, Inputs, Metadata | Inter | 300–700 |

### Scale (Fluid)

| Token | Value | Computed Size |
|-------|-------|--------------|
| `--fs-display` | `clamp(3.2rem, 7.5vw, 6rem)` | 51px – 96px |
| `--fs-5xl` | `clamp(3rem, 6vw, 4.5rem)` | 48px – 72px |
| `--fs-4xl` | `clamp(2.5rem, 5vw, 3.5rem)` | 40px – 56px |
| `--fs-3xl` | `clamp(2rem, 4vw, 2.75rem)` | 32px – 44px |
| `--fs-2xl` | `clamp(1.6rem, 3vw, 2rem)` | 26px – 32px |
| `--fs-xl` | `1.5rem` | 24px |
| `--fs-lg` | `1.25rem` | 20px |
| `--fs-md` | `1.125rem` | 18px |
| `--fs-base` | `1rem` | 16px |
| `--fs-sm` | `0.875rem` | 14px |
| `--fs-xs` | `0.75rem` | 12px |

### Type Hierarchy

```
Display (hero headline):  Plus Jakarta Sans 800, clamp(3.2rem, 7.5vw, 6rem)
H1 (page titles):         Plus Jakarta Sans 800, clamp(2.5rem, 5vw, 3.5rem)
H2 (section titles):      Plus Jakarta Sans 700, clamp(2rem, 4vw, 2.75rem)
H3 (card titles):         Plus Jakarta Sans 700, 1.25rem–1.5rem
Body:                     Inter 400, 1rem, line-height 1.7
Muted:                    Inter 300, 0.875rem–1rem
Label:                    Plus Jakarta Sans 600, 0.75rem, uppercase, +0.16em tracking
```

---

## 3. Spacing System

8px base unit. All spacing is multiples of 4.

| Token | Value |
|-------|-------|
| `--sp-1` | 4px |
| `--sp-2` | 8px |
| `--sp-3` | 12px |
| `--sp-4` | 16px |
| `--sp-5` | 24px |
| `--sp-6` | 32px |
| `--sp-7` | 48px |
| `--sp-8` | 64px |
| `--sp-9` | 96px |
| `--sp-10` | 128px |
| `--sp-11` | 160px |

**Section padding:** `clamp(4rem, 8vw, 8rem)` vertical

---

## 4. Elevation (Shadow Tiers)

| Level | Token | Value | Use Case |
|-------|-------|-------|----------|
| 1 | `--shadow-xs` | `0 1px 2px rgba(0,0,0,0.4)` | Buttons at rest |
| 2 | `--shadow-sm` | `0 2px 8px rgba(0,0,0,0.5)` | Small cards |
| 3 | `--shadow-md` | `0 4px 16px rgba(0,0,0,0.6)` | Default cards |
| 4 | `--shadow-lg` | `0 8px 32px rgba(0,0,0,0.7)` | Hovered cards |
| 5 | `--shadow-xl` | `0 16px 64px rgba(0,0,0,0.85)` | Modals, overlays |
| Glow | `--shadow-glow` | `0 0 30px rgba(124,95,230,0.25)` | Accent card glow |
| Glow LG | `--shadow-glow-lg` | `0 0 60px rgba(124,95,230,0.35)` | Featured card glow |
| Button | `--shadow-glow-btn` | `0 4px 24px rgba(124,95,230,0.45)` | CTA button hover |

---

## 5. Border Radius

| Token | Value | Use Case |
|-------|-------|----------|
| `--r-xs` | 4px | Small chips, badges |
| `--r-sm` | 8px | Buttons (flat), nav links |
| `--r-md` | 12px | Form inputs, small cards |
| `--r-lg` | 16px | FAQ items, medium cards |
| `--r-xl` | 24px | Primary cards |
| `--r-2xl` | 32px | Large cards, CTA blocks |
| `--r-full` | 9999px | Pills, buttons, tags |

---

## 6. Motion & Animation

### Transition Timing

| Token | Value | Use Case |
|-------|-------|----------|
| `--t-fast` | `150ms ease` | Hover color/background |
| `--t-base` | `250ms ease` | Standard transitions |
| `--t-slow` | `400ms ease` | Cards, panels, drawers |
| `--t-spring` | `400ms cubic-bezier(0.175, 0.885, 0.32, 1.275)` | Modals, overlays |
| `--t-bounce` | `500ms cubic-bezier(0.34, 1.56, 0.64, 1)` | Playful elements |

### Scroll Animations

Add class `reveal` to any element for scroll-triggered fade-in+slide-up.
Add `stagger-1` through `stagger-6` to delay sibling animations.

```html
<div class="reveal stagger-1">...</div>
<div class="reveal stagger-2">...</div>
<div class="reveal stagger-3">...</div>
```

### Direction Variants

```html
<div class="reveal reveal--up">...</div>    <!-- Slide up (default) -->
<div class="reveal reveal--left">...</div>  <!-- Slide from left -->
<div class="reveal reveal--right">...</div> <!-- Slide from right -->
<div class="reveal reveal--scale">...</div> <!-- Scale up -->
```

### Named Animations

| Name | Duration | Use |
|------|----------|-----|
| `orbFloat` | 8–13s | Hero gradient orbs |
| `marquee` | 25s | Services ticker |
| `logoSlide` | 30s | Client logos |
| `pulse` | 2s | Eyebrow dot indicator |
| `scrollLine` | 1.5s | Hero scroll indicator |

### Principles

- **Never animate > 3 elements simultaneously** (visual chaos)
- **Transform + opacity only** (GPU-composited, no layout thrash)
- **Respect prefers-reduced-motion** (use CSS `@media` to disable)
- **Duration sweet spot:** 200–400ms for UI; 800–1400ms for counters

---

## 7. Components

### Buttons

```html
<!-- Primary (filled gradient) -->
<a href="#" class="btn btn--primary">Label →</a>

<!-- Primary Large -->
<a href="#" class="btn btn--primary btn--lg">Label →</a>

<!-- Ghost (outlined) -->
<a href="#" class="btn btn--ghost">Label</a>
```

### Section Header

```html
<div class="section-header--center">
  <span class="section-label">Category</span>
  <h2 class="section-title">Main Heading <em>Gradient</em></h2>
  <p class="section-desc">Supporting description text.</p>
</div>
```

### Cards

- `.service-card` — 6-service grid, numbered
- `.work-card` — portfolio grid with image overlay
- `.eco-card` — ecosystem platform cards with feature list
- `.testimonial-card` — client quote with avatar
- `.value-card` — emoji + title + desc (4-col grid)
- `.mv-card` — image-based mission/vision overlay card

### Navigation

- `.nav` — fixed glassmorphic navbar
- `.nav.scrolled` — auto-adds on scroll (JS)
- `.nav__drawer` — full-screen mobile menu (toggle via JS)

### Stats

- `.stats-grid` — 3-col bordered grid
- `.stat-number[data-counter]` — auto-animates via IntersectionObserver

### Counter Attributes

```html
<div class="stat-number" data-counter="50" data-suffix="+">0+</div>
<div class="stat-number" data-counter="4.8" data-suffix="★">0</div>
```

---

## 8. Glassmorphism System

```css
/* Standard glass effect */
.glass {
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: var(--r-xl);
}

/* Glass with hover */
.glass--hover:hover {
  background: rgba(255, 255, 255, 0.05);
  border-color: rgba(124, 95, 230, 0.35);
  box-shadow: 0 0 30px rgba(124, 95, 230, 0.25);
}
```

---

## 9. Layout

### Container

```css
.container       { max-width: 1200px; padding-inline: clamp(1rem, 4vw, 3rem); }
.container--wide { max-width: 1440px; }
```

### Breakpoints (Mobile-first)

| Name | Width |
|------|-------|
| xs | 320px |
| sm | 375px |
| md | 768px |
| lg | 1024px |
| xl | 1440px |

### Responsive Grid Collapse

| Class | Desktop | Tablet (<1024px) | Mobile (<768px) |
|-------|---------|-----------------|----------------|
| `.grid--2` | 2 cols | 2 cols | 1 col |
| `.grid--3` | 3 cols | 2 cols | 1 col |
| `.grid--4` | 4 cols | 2 cols | 1 col |
| `.services-grid` | 3 cols | 2 cols | 1 col |
| `.work-grid` | 2 cols | 2 cols | 1 col |
| `.eco-grid` | 3 cols | 1 col (centered) | 1 col |

---

## 10. Interaction Design

### Cursor Glow (Desktop only)
Auto-initialized on desktop. A large radial gradient follows the mouse at a lag, creating depth. Disabled on touch devices.

### Magnetic Buttons
Primary `.btn--primary` elements have a subtle magnetic pull effect on hover (desktop only).

### Parallax Orbs
Hero gradient orbs respond to mouse movement with depth offset (desktop only).

### FAQ Accordion
Only one item open at a time. Smooth max-height transition. Icon rotates 45° on open.

### Work Filter
Instant filter by category. Cards fade in with `.is-visible` on filter change.

---

## 11. Noise Texture

A subtle SVG fractalNoise filter is applied via `body::before` at `opacity: 0.025`. This adds micro-texture depth to flat dark backgrounds — making them feel richer without being visible to the casual eye.

---

## 12. SEO Structure

All pages include:
- `<title>` with page name + brand
- `<meta name="description">` (unique per page)
- `<link rel="canonical">`
- Open Graph tags (og:title, og:description, og:type, og:url, og:image)
- JSON-LD Organization schema (index.html)
- Semantic HTML5 landmarks: `<header>`, `<nav>`, `<main>`, `<footer>`
- `role` and `aria-label` attributes throughout
- `loading="lazy"` on all non-critical images
- `rel="noopener noreferrer"` on all external links

---

## 13. File Structure

```
updated-uxpacific/
│
├── index.html          ← Homepage
├── about.html          ← About page
├── services.html       ← Services page
├── work.html           ← Portfolio / Work page
├── ecosystem.html      ← Ecosystem platform page
├── contact.html        ← Contact form page
├── faq.html            ← FAQ accordion page
├── 404.html            ← Error page
│
├── assets/
│   ├── css/
│   │   ├── design-system.css   ← Tokens, reset, base utilities
│   │   └── main.css            ← All components and page styles
│   ├── js/
│   │   └── main.js             ← All interaction layer
│   ├── images/                 ← New/future images go here
│   └── icons/                  ← SVG icons (future)
│
├── components/
│   ├── navbar.html    ← Navbar HTML reference
│   ├── footer.html    ← Footer HTML reference
│   └── cards.html     ← All card variants reference
│
└── docs/
    └── DESIGN_SYSTEM.md  ← This file
```

---

## 14. Why This Version Is Stronger

| Aspect | v1 (Original) | v2 (Updated) |
|--------|--------------|-------------|
| Design System | Inline styles, scattered CSS | Centralized CSS custom properties |
| Typography | Single font (Inter) | Plus Jakarta Sans + Inter hierarchy |
| Color depth | Flat purple | Layered purple gradient system |
| Dark theme | Basic dark | Multi-surface depth layering |
| Animations | None / basic | Cursor glow, parallax, counters, marquee |
| Cards | Static boxes | Glassmorphism + glow on hover |
| Navigation | Bootstrap collapse | Custom smooth glass nav + drawer |
| Scroll behavior | None | IntersectionObserver reveal system |
| Mobile | Responsive basic | Mobile-first fluid clamp() system |
| Performance | Bootstrap dependency | Zero framework, custom CSS only |
| Accessibility | Partial | Full ARIA, roles, focus-visible |
| SEO | Good | Excellent (schema, OG, canonical) |
| Code quality | Scattered | BEM-like, organized, documented |

---

*Design System v2.0 — UX Pacific — Est. 2025*
