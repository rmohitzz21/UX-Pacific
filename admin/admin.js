/* ============================================================
   UX Pacific Admin Dashboard — admin.js
   Pure vanilla JS. No backend. Fully interactive UI.
   ============================================================ */

'use strict';

/* ---- Auth guard ---- */
if (!sessionStorage.getItem('uxp_admin_auth')) {
  window.location.href = 'login.html';
}

/* ============================================================
   DEMO DATA STORE
   ============================================================ */
let store = {
  services: [
    { id: 1, name: 'UX Audit',         category: 'Research',  status: 'Active'   },
    { id: 2, name: 'UI/UX Design',      category: 'Design',    status: 'Active'   },
    { id: 3, name: 'User Research',     category: 'Research',  status: 'Active'   },
    { id: 4, name: 'Product Strategy',  category: 'Strategy',  status: 'Active'   },
    { id: 5, name: 'Wireframing',       category: 'Design',    status: 'Active'   },
    { id: 6, name: 'Prototyping',       category: 'Design',    status: 'Active'   },
    { id: 7, name: 'Usability Testing', category: 'Research',  status: 'Inactive' },
    { id: 8, name: 'Design System',     category: 'Design',    status: 'Active'   },
  ],

  projects: [
    { id: 1, title: 'Distinct Buzz',    type: 'UX Audit',    image: '../img/project3.webp', link: 'https://www.behance.net/gallery/226740155/UX-Audit-Distinct-Buzz',   desc: 'Full UX audit uncovering usability gaps.' },
    { id: 2, title: 'CEDAR Himalaya',   type: 'UX Audit',    image: '../img/project2.webp', link: 'https://www.behance.net/gallery/226741471/UX-Audit-CEDAR-Himalaya',  desc: 'Sustainability-focused UX improvements.' },
    { id: 3, title: 'Survey Pacific',   type: 'Case Study',  image: '../img/project1.webp', link: 'https://www.behance.net/gallery/207413041/Case-Study-on-Market-Research-FirmSurvey-Pacific', desc: 'Website UI/UX redesign via competitive benchmarking.' },
    { id: 4, title: 'Milan Pipe',       type: 'Case Study',  image: '../img/milan.webp',    link: 'https://www.behance.net/gallery/235343557/Detailed-UX-Audit-for-Milan-Pipe', desc: 'Detailed UX audit for manufacturing client.' },
    { id: 5, title: 'ICard India',      type: 'UI/UX Design',image: '../img/Icard.webp',    link: 'https://www.behance.net/gallery/233248725/UX-Audit-for-Icard-India',  desc: 'Mobile app UX audit and redesign.' },
    { id: 6, title: 'Radhe Krishna',    type: 'UI/UX Design',image: '../img/Radhe-Krishna.webp', link: 'https://www.behance.net/uxpacific', desc: 'Dashboard web app design.' },
    { id: 7, title: 'God Incorporation',type: 'UI/UX Design',image: '../img/God-Incorporation.webp', link: 'https://www.behance.net/uxpacific', desc: 'Mobile UI/UX design for enterprise app.' },
  ],

  ecosystem: [
    { id: 1, name: 'Survey Pacific',   type: 'Client',       status: 'Active' },
    { id: 2, name: 'CEDAR Himalaya',   type: 'Client',       status: 'Active' },
    { id: 3, name: 'Distinct Buzz',    type: 'Client',       status: 'Active' },
    { id: 4, name: 'Design Community', type: 'Community',    status: 'Active' },
    { id: 5, name: 'UX Mentors Guild', type: 'Mentor',       status: 'Active' },
  ],

  messages: [
    { id: 1, name: 'Rahul Sharma',  email: 'rahul@example.com',   industry: 'E-commerce',    date: '2026-02-24', status: 'Unread', message: 'Hi, I would like to know more about your UX audit services. We have a mid-sized e-commerce platform and are struggling with cart abandonment. Would love a consultation.' },
    { id: 2, name: 'Priya Mehta',   email: 'priya@startup.in',    industry: 'SaaS',          date: '2026-02-23', status: 'Unread', message: 'We are building a B2B SaaS product and need help with the onboarding flow UX. Can you provide a proposal?' },
    { id: 3, name: 'Amit Patel',    email: 'amit@healthtech.com', industry: 'Healthcare',    date: '2026-02-22', status: 'Unread', message: 'Looking for a complete UI/UX overhaul of our patient portal. Please share your process and pricing.' },
    { id: 4, name: 'Sunita Rao',    email: 'sunita@fintech.io',   industry: 'Financial',     date: '2026-02-21', status: 'Read',   message: 'We need help with user research for our mobile banking app. How do you approach research for regulated industries?' },
    { id: 5, name: 'Vikram Joshi',  email: 'vjoshi@edu.org',      industry: 'Education',     date: '2026-02-20', status: 'Read',   message: 'Our eLearning platform needs a full UX review. We have roughly 50,000 active users and seeing drop-off at the course completion stage.' },
    { id: 6, name: 'Meena Kapoor',  email: 'meena@travel.co',     industry: 'Travel',        date: '2026-02-19', status: 'Read',   message: 'Interested in a heuristic evaluation for our booking flow. When can we schedule a call?' },
  ],

  nextId: { services: 9, projects: 8, ecosystem: 6, messages: 7 }
};

/* ============================================================
   UTILITIES
   ============================================================ */
function escHtml(str) {
  const d = document.createElement('div');
  d.textContent = str;
  return d.innerHTML;
}

function formatDate(iso) {
  const d = new Date(iso);
  return d.toLocaleDateString('en-IN', { day: 'numeric', month: 'short', year: 'numeric' });
}

function showToast(message) {
  const toast = document.getElementById('adminToast');
  document.getElementById('toastMessage').textContent = message;
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 3000);
}

// Expose showToast globally (used in inline onclick in HTML)
window.showToast = showToast;

/* ============================================================
   NAVIGATION / PAGE SWITCHING
   ============================================================ */
const breadcrumb = document.getElementById('breadcrumb-page');
const pageNames  = { overview: 'Dashboard', services: 'Manage Services', work: 'Manage Work', ecosystem: 'Manage Ecosystem', messages: 'Messages', seo: 'SEO Settings', settings: 'General Settings' };

function navigateTo(pageId) {
  // Hide all pages
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  // Deactivate sidebar links
  document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));

  // Show target page
  const page = document.getElementById('page-' + pageId);
  if (page) page.classList.add('active');

  // Activate sidebar link
  const link = document.querySelector('.sidebar-link[data-page="' + pageId + '"]');
  if (link) link.classList.add('active');

  // Update breadcrumb
  if (breadcrumb) breadcrumb.textContent = pageNames[pageId] || pageId;

  // Close sidebar on mobile
  closeSidebar();

  // Render page data
  if (pageId === 'overview')  renderOverview();
  if (pageId === 'services')  renderServicesTable();
  if (pageId === 'work')      renderProjectsGrid();
  if (pageId === 'ecosystem') renderEcosystemTable();
  if (pageId === 'messages')  renderMessagesTable(store.messages);
}

// Sidebar link clicks
document.querySelectorAll('.sidebar-link[data-page]').forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault();
    navigateTo(this.dataset.page);
  });
});

// Dashboard "View all" messages link
document.querySelectorAll('.btn-text-link[data-page]').forEach(btn => {
  btn.addEventListener('click', function () {
    navigateTo(this.dataset.page);
  });
});

/* ============================================================
   SIDEBAR TOGGLE (mobile)
   ============================================================ */
const sidebar        = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const sidebarToggle  = document.getElementById('sidebarToggle');
const sidebarClose   = document.getElementById('sidebarClose');

function openSidebar() {
  sidebar.classList.add('open');
  sidebarOverlay.classList.add('show');
  sidebarToggle && sidebarToggle.setAttribute('aria-expanded', 'true');
}

function closeSidebar() {
  sidebar.classList.remove('open');
  sidebarOverlay.classList.remove('show');
  sidebarToggle && sidebarToggle.setAttribute('aria-expanded', 'false');
}

sidebarToggle && sidebarToggle.addEventListener('click', openSidebar);
sidebarClose  && sidebarClose.addEventListener('click', closeSidebar);
sidebarOverlay.addEventListener('click', closeSidebar);

/* ============================================================
   LOGOUT
   ============================================================ */
document.getElementById('logoutBtn').addEventListener('click', function () {
  if (confirm('Are you sure you want to log out?')) {
    sessionStorage.removeItem('uxp_admin_auth');
    window.location.href = 'login.html';
  }
});

/* ============================================================
   DATE
   ============================================================ */
const dateEl = document.getElementById('currentDate');
if (dateEl) {
  dateEl.textContent = new Date().toLocaleDateString('en-IN', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
}

/* ============================================================
   RENDER: OVERVIEW
   ============================================================ */
function renderOverview() {
  const tbody = document.getElementById('recentMsgBody');
  if (!tbody) return;
  const recent = store.messages.slice(0, 5);
  tbody.innerHTML = recent.map((m, i) => `
    <tr>
      <td>${i + 1}</td>
      <td><strong>${escHtml(m.name)}</strong></td>
      <td>${escHtml(m.email)}</td>
      <td>${escHtml(m.industry)}</td>
      <td>${formatDate(m.date)}</td>
      <td><span class="badge-status ${m.status === 'Unread' ? 'badge-unread' : 'badge-read'}">${escHtml(m.status)}</span></td>
      <td>
        <div class="action-btns">
          <button class="action-btn action-btn--view" onclick="viewMessage(${m.id})" aria-label="View message from ${escHtml(m.name)}" title="View">
            <i class="fas fa-eye" aria-hidden="true"></i>
          </button>
        </div>
      </td>
    </tr>
  `).join('');
}

/* ============================================================
   RENDER: SERVICES TABLE
   ============================================================ */
function renderServicesTable() {
  const tbody = document.getElementById('servicesTableBody');
  if (!tbody) return;
  if (store.services.length === 0) {
    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2rem;">No services added yet.</td></tr>';
    return;
  }
  tbody.innerHTML = store.services.map((s, i) => `
    <tr>
      <td>${i + 1}</td>
      <td><strong>${escHtml(s.name)}</strong></td>
      <td>${escHtml(s.category)}</td>
      <td><span class="badge-status ${s.status === 'Active' ? 'badge-active' : 'badge-inactive'}">${escHtml(s.status)}</span></td>
      <td>
        <div class="action-btns">
          <button class="action-btn action-btn--edit" onclick="editService(${s.id})" aria-label="Edit ${escHtml(s.name)}" title="Edit">
            <i class="fas fa-pen" aria-hidden="true"></i>
          </button>
          <button class="action-btn action-btn--del" onclick="deleteItem('service', ${s.id}, '${escHtml(s.name)}')" aria-label="Delete ${escHtml(s.name)}" title="Delete">
            <i class="fas fa-trash" aria-hidden="true"></i>
          </button>
        </div>
      </td>
    </tr>
  `).join('');
}

/* ============================================================
   RENDER: PROJECTS GRID
   ============================================================ */
function renderProjectsGrid() {
  const grid = document.getElementById('projectsGrid');
  if (!grid) return;
  if (store.projects.length === 0) {
    grid.innerHTML = '<p style="color:var(--text-muted);">No projects added yet.</p>';
    return;
  }
  grid.innerHTML = store.projects.map(p => `
    <div class="project-admin-card">
      <img src="${escHtml(p.image)}" alt="${escHtml(p.title)}" class="project-admin-img" loading="lazy" />
      <div class="project-admin-body">
        <p class="project-admin-title">${escHtml(p.title)}</p>
        <p class="project-admin-type">${escHtml(p.type)}</p>
        <div class="project-admin-actions">
          <button class="action-btn action-btn--edit" onclick="editProject(${p.id})" aria-label="Edit ${escHtml(p.title)}" title="Edit">
            <i class="fas fa-pen" aria-hidden="true"></i>
          </button>
          <button class="action-btn action-btn--del" onclick="deleteItem('project', ${p.id}, '${escHtml(p.title)}')" aria-label="Delete ${escHtml(p.title)}" title="Delete">
            <i class="fas fa-trash" aria-hidden="true"></i>
          </button>
          <a href="${escHtml(p.link)}" target="_blank" rel="noopener noreferrer" class="action-btn action-btn--view" aria-label="View ${escHtml(p.title)} on Behance" title="View">
            <i class="fas fa-external-link-alt" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  `).join('');
}

/* ============================================================
   RENDER: ECOSYSTEM TABLE
   ============================================================ */
function renderEcosystemTable() {
  const tbody = document.getElementById('ecosystemTableBody');
  if (!tbody) return;
  if (store.ecosystem.length === 0) {
    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2rem;">No partners added yet.</td></tr>';
    return;
  }
  tbody.innerHTML = store.ecosystem.map((e, i) => `
    <tr>
      <td>${i + 1}</td>
      <td><strong>${escHtml(e.name)}</strong></td>
      <td>${escHtml(e.type)}</td>
      <td><span class="badge-status ${e.status === 'Active' ? 'badge-active' : 'badge-inactive'}">${escHtml(e.status)}</span></td>
      <td>
        <div class="action-btns">
          <button class="action-btn action-btn--del" onclick="deleteItem('ecosystem', ${e.id}, '${escHtml(e.name)}')" aria-label="Delete ${escHtml(e.name)}" title="Delete">
            <i class="fas fa-trash" aria-hidden="true"></i>
          </button>
        </div>
      </td>
    </tr>
  `).join('');
}

/* ============================================================
   RENDER: MESSAGES TABLE
   ============================================================ */
function renderMessagesTable(messages) {
  const tbody = document.getElementById('allMsgBody');
  if (!tbody) return;
  if (messages.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;color:var(--text-muted);padding:2rem;">No messages found.</td></tr>';
    return;
  }
  tbody.innerHTML = messages.map((m, i) => `
    <tr>
      <td>${i + 1}</td>
      <td><strong>${escHtml(m.name)}</strong></td>
      <td>${escHtml(m.email)}</td>
      <td>${escHtml(m.industry)}</td>
      <td>${formatDate(m.date)}</td>
      <td><span class="badge-status ${m.status === 'Unread' ? 'badge-unread' : 'badge-read'}">${escHtml(m.status)}</span></td>
      <td>
        <div class="action-btns">
          <button class="action-btn action-btn--view" onclick="viewMessage(${m.id})" aria-label="View message from ${escHtml(m.name)}" title="View">
            <i class="fas fa-eye" aria-hidden="true"></i>
          </button>
          <button class="action-btn action-btn--del" onclick="deleteItem('message', ${m.id}, '${escHtml(m.name)}')" aria-label="Delete message from ${escHtml(m.name)}" title="Delete">
            <i class="fas fa-trash" aria-hidden="true"></i>
          </button>
        </div>
      </td>
    </tr>
  `).join('');
}

/* ============================================================
   VIEW MESSAGE MODAL
   ============================================================ */
window.viewMessage = function (id) {
  const msg = store.messages.find(m => m.id === id);
  if (!msg) return;

  // Mark as read
  msg.status = 'Read';
  updateMsgBadge();

  const content = document.getElementById('viewMsgContent');
  content.innerHTML = `
    <div class="msg-detail-row"><span class="msg-detail-label">From:</span><span class="msg-detail-value">${escHtml(msg.name)}</span></div>
    <div class="msg-detail-row"><span class="msg-detail-label">Email:</span><span class="msg-detail-value">${escHtml(msg.email)}</span></div>
    <div class="msg-detail-row"><span class="msg-detail-label">Industry:</span><span class="msg-detail-value">${escHtml(msg.industry)}</span></div>
    <div class="msg-detail-row"><span class="msg-detail-label">Date:</span><span class="msg-detail-value">${formatDate(msg.date)}</span></div>
    <div class="msg-detail-row"><span class="msg-detail-label">Status:</span><span class="badge-status badge-read">Read</span></div>
    <p class="msg-detail-label" style="margin-top:0.75rem;">Message:</p>
    <div class="msg-body-text">${escHtml(msg.message)}</div>
  `;

  const replyBtn = document.getElementById('replyBtn');
  if (replyBtn) replyBtn.href = `mailto:${msg.email}?subject=Re: Your enquiry to UX Pacific`;

  new bootstrap.Modal(document.getElementById('viewMsgModal')).show();
};

function updateMsgBadge() {
  const unread = store.messages.filter(m => m.status === 'Unread').length;
  const badge  = document.getElementById('msgBadge');
  if (badge) {
    badge.textContent = unread;
    badge.style.display = unread > 0 ? 'inline-flex' : 'none';
  }
}

/* ============================================================
   MESSAGES FILTER
   ============================================================ */
document.querySelectorAll('.filter-btn[data-filter]').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
    const filter = this.dataset.filter;
    let filtered = store.messages;
    if (filter === 'unread') filtered = store.messages.filter(m => m.status === 'Unread');
    if (filter === 'read')   filtered = store.messages.filter(m => m.status === 'Read');
    renderMessagesTable(filtered);
  });
});

const msgSearch = document.getElementById('msgSearch');
if (msgSearch) {
  msgSearch.addEventListener('input', function () {
    const q = this.value.toLowerCase();
    const filtered = store.messages.filter(m =>
      m.name.toLowerCase().includes(q) ||
      m.email.toLowerCase().includes(q) ||
      m.industry.toLowerCase().includes(q)
    );
    renderMessagesTable(filtered);
  });
}

/* ============================================================
   ADD / EDIT SERVICE
   ============================================================ */
const serviceModal = new bootstrap.Modal(document.getElementById('serviceModal'));
let editingServiceId = null;

function resetServiceModal() {
  document.getElementById('serviceModalLabel').textContent = 'Add Service';
  document.getElementById('serviceForm').reset();
  document.getElementById('serviceId').value = '';
  editingServiceId = null;
}

document.getElementById('addServiceBtn').addEventListener('click', resetServiceModal);

window.editService = function (id) {
  const svc = store.services.find(s => s.id === id);
  if (!svc) return;
  editingServiceId = id;
  document.getElementById('serviceModalLabel').textContent = 'Edit Service';
  document.getElementById('serviceId').value = id;
  document.getElementById('serviceName').value = svc.name;
  document.getElementById('serviceCategory').value = svc.category;
  document.getElementById('serviceDesc').value = svc.desc || '';
  document.getElementById('serviceStatus').value = svc.status;
  serviceModal.show();
};

document.getElementById('saveServiceBtn').addEventListener('click', function () {
  const name     = document.getElementById('serviceName').value.trim();
  const category = document.getElementById('serviceCategory').value;
  const status   = document.getElementById('serviceStatus').value;
  const desc     = document.getElementById('serviceDesc').value.trim();

  if (!name) { alert('Service name is required.'); return; }
  if (!category) { alert('Please select a category.'); return; }

  if (editingServiceId) {
    const svc = store.services.find(s => s.id === editingServiceId);
    if (svc) { svc.name = name; svc.category = category; svc.status = status; svc.desc = desc; }
    showToast('Service updated successfully.');
  } else {
    store.services.push({ id: store.nextId.services++, name, category, status, desc });
    showToast('Service added successfully.');
  }

  serviceModal.hide();
  renderServicesTable();
});

/* ============================================================
   ADD / EDIT PROJECT
   ============================================================ */
const projectModal = new bootstrap.Modal(document.getElementById('projectModal'));
let editingProjectId = null;

function resetProjectModal() {
  document.getElementById('projectModalLabel').textContent = 'Add Project';
  document.getElementById('projectForm').reset();
  document.getElementById('projectId').value = '';
  editingProjectId = null;
}

document.getElementById('addProjectBtn').addEventListener('click', resetProjectModal);

window.editProject = function (id) {
  const proj = store.projects.find(p => p.id === id);
  if (!proj) return;
  editingProjectId = id;
  document.getElementById('projectModalLabel').textContent = 'Edit Project';
  document.getElementById('projectId').value = id;
  document.getElementById('projectTitle').value = proj.title;
  document.getElementById('projectType').value  = proj.type;
  document.getElementById('projectDesc').value  = proj.desc || '';
  document.getElementById('projectLink').value  = proj.link || '';
  document.getElementById('projectImage').value = proj.image || '';
  projectModal.show();
};

document.getElementById('saveProjectBtn').addEventListener('click', function () {
  const title = document.getElementById('projectTitle').value.trim();
  const type  = document.getElementById('projectType').value;
  const desc  = document.getElementById('projectDesc').value.trim();
  const link  = document.getElementById('projectLink').value.trim();
  const image = document.getElementById('projectImage').value.trim();

  if (!title) { alert('Project title is required.'); return; }

  if (editingProjectId) {
    const proj = store.projects.find(p => p.id === editingProjectId);
    if (proj) { proj.title = title; proj.type = type; proj.desc = desc; proj.link = link; if (image) proj.image = image; }
    showToast('Project updated successfully.');
  } else {
    store.projects.push({ id: store.nextId.projects++, title, type, desc, link, image: image || '../img/LOGO.png' });
    showToast('Project added successfully.');
  }

  projectModal.hide();
  renderProjectsGrid();
});

/* ============================================================
   ADD ECOSYSTEM PARTNER
   ============================================================ */
document.getElementById('saveEcosystemBtn').addEventListener('click', function () {
  const name = document.getElementById('partnerName').value.trim();
  const type = document.getElementById('partnerType').value;

  if (!name) { alert('Partner name is required.'); return; }

  store.ecosystem.push({ id: store.nextId.ecosystem++, name, type, status: 'Active' });
  bootstrap.Modal.getInstance(document.getElementById('ecosystemModal')).hide();
  showToast('Partner added successfully.');
  renderEcosystemTable();
});

/* ============================================================
   DELETE ITEM
   ============================================================ */
let deletePending = null;

window.deleteItem = function (type, id, name) {
  deletePending = { type, id };
  document.getElementById('deleteItemName').textContent = name;
  new bootstrap.Modal(document.getElementById('deleteModal')).show();
};

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
  if (!deletePending) return;
  const { type, id } = deletePending;

  if (type === 'service')   store.services   = store.services.filter(s => s.id !== id);
  if (type === 'project')   store.projects   = store.projects.filter(p => p.id !== id);
  if (type === 'ecosystem') store.ecosystem  = store.ecosystem.filter(e => e.id !== id);
  if (type === 'message')   store.messages   = store.messages.filter(m => m.id !== id);

  bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
  showToast('Item deleted.');
  deletePending = null;

  if (type === 'service')   renderServicesTable();
  if (type === 'project')   renderProjectsGrid();
  if (type === 'ecosystem') renderEcosystemTable();
  if (type === 'message')   renderMessagesTable(store.messages);
  updateMsgBadge();
});

/* ============================================================
   LOGO PREVIEW
   ============================================================ */
const logoUpload = document.getElementById('logoUpload');
if (logoUpload) {
  logoUpload.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
      const preview = document.getElementById('logoPreview');
      if (preview) preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
  });
}

/* ============================================================
   INITIALISE
   ============================================================ */
function init() {
  navigateTo('overview');
  updateMsgBadge();
}

init();
