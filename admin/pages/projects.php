<?php // FILE: admin/pages/projects.php
$page_title = 'Projects';
$active_nav = 'projects';
require_once '../includes/layout.php';
?>

<div x-data="{
    showModal: false, 
    modalMode: 'add',
    projects: [],
    isLoading: true,
    form: { 
        id: null, 
        title: '', 
        slug: '', 
        description: '', 
        thumbnail_url: '', 
        external_link: '', 
        link_label: 'View Details', 
        tags: [],
        filter_group: 'all',
        is_featured: false,
        status: 'published',
        sort_order: 0 
    },
    filterTab: 'all',
    searchQuery: '',
    get filteredProjects() {
        return this.projects.filter(p => {
            if (this.filterTab !== 'all' && p.status !== this.filterTab) return false;
            if (this.searchQuery && !p.title.toLowerCase().includes(this.searchQuery.toLowerCase())) return false;
            return true;
        });
    },
    init() {
        this.fetchProjects();
    },
    fetchProjects() {
        this.isLoading = true;
        uxpAdminFetch('../api/projects')
            .then(async (res) => {
                const data = await res.json().catch(() => ({}));
                if (!res.ok) {
                    console.error('Projects API:', res.status, data);
                    this.projects = [];
                    this.clientLogos = [];
                    this.isLoading = false;
                    if (data.error) alert(data.error);
                    return null;
                }
                return data;
            })
            .then(data => {
                if (data === null) return;
                if (data && Array.isArray(data.projects)) {
                    this.projects = data.projects;
                    this.clientLogos = Array.isArray(data.client_logos) ? data.client_logos : [];
                } else if (Array.isArray(data)) {
                    this.projects = data;
                    this.clientLogos = [];
                } else {
                    this.projects = [];
                    this.clientLogos = [];
                }
                this.isLoading = false;
            })
            .catch(() => {
                this.projects = [];
                this.clientLogos = [];
                this.isLoading = false;
            });
    },
    saveProject() {
        if (!this.form.title.trim()) {
            alert('Please enter a project title.');
            return;
        }
        if (!this.form.description.trim()) {
            alert('Please enter a project description.');
            return;
        }
        if (!this.form.thumbnail_url.trim()) {
            alert('Please upload a thumbnail image.');
            return;
        }

        const method = this.modalMode === 'add' ? 'POST' : 'PUT';
        uxpAdminFetch('../api/projects', {
            method: method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(this.form)
        })
        .then(async (res) => {
            const data = await res.json().catch(() => ({}));
            if (!res.ok) {
                throw new Error(data.error || ('Request failed (' + res.status + ')'));
            }
            return data;
        })
        .then(data => {
            if (data.success) {
                this.showModal = false;
                this.fetchProjects();
            } else {
                alert(data.error || 'Something went wrong.');
            }
        })
        .catch((err) => {
            alert(err.message || 'Network error.');
        });
    },
    deleteProject(id) {
        if (confirm('Are you sure you want to delete this project?')) {
            uxpAdminFetch('../api/projects', {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id })
            })
            .then(async (res) => {
                const data = await res.json().catch(() => ({}));
                if (!res.ok) throw new Error(data.error || ('Request failed (' + res.status + ')'));
                return data;
            })
            .then(data => {
                if (data.success) {
                    this.fetchProjects();
                } else {
                    alert(data.error || 'Something went wrong.');
                }
            })
            .catch((err) => alert(err.message || 'Network error.'));
        }
    },
    openEdit(project) {
        this.form = { 
            ...project,
            tags: project.tags || [],
            is_featured: project.is_featured === 1 || project.is_featured === true
        };
        this.modalMode = 'edit';
        this.showModal = true;
    },
    openAdd() {
        this.form = { 
            id: null, 
            title: '', 
            slug: '', 
            description: '', 
            thumbnail_url: '', 
            external_link: '', 
            link_label: 'View Details', 
            tags: [], 
            filter_group: 'all', 
            is_featured: false, 
            status: 'draft', 
            sort_order: 0 
        };
        this.modalMode = 'add';
        this.showModal = true;
    },
    isUploading: false,
    uploadImage(event) {
        const file = event.target.files[0];
        if (!file) return;
        
        this.isUploading = true;
        const formData = new FormData();
        formData.append('image', file);
        
        uxpAdminFetch('../api/upload', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            this.isUploading = false;
            if (data.success) {
                this.form.thumbnail_url = data.url;
            } else {
                alert(data.error || 'Upload failed.');
            }
        })
        .catch(() => {
            this.isUploading = false;
            alert('Upload failed due to network error.');
        });
    },
    removeImage() {
        this.form.thumbnail_url = '';
    },
    clientLogos: []
}">

    <!-- HEADER ROW -->
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <button @click="openAdd()"
            class="bg-white text-zinc-900 font-medium hover:bg-zinc-200 rounded-lg px-4 py-2 text-sm transition-colors">
            + Add Project
        </button>
    </div>

    <!-- OUR CLIENTS (logos used on homepage & Work page) -->
    <div class="mb-6 bg-white/5 border border-white/10 rounded-xl p-4">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
            <div>
                <h3 class="text-sm font-semibold text-white">Our clients</h3>
                <p class="text-xs text-white/50 mt-0.5">Loaded with projects from the API. Updates when you save projects or change logos under <strong class="text-white/70">Client logos</strong>.</p>
            </div>
            <a href="client-logos.php"
                class="text-xs font-medium text-[#a78bfa] hover:text-white transition shrink-0">Manage client logos →</a>
        </div>
        <div class="flex flex-nowrap items-center gap-6 overflow-x-auto pb-1 min-h-[48px] -mx-1 px-1" style="-webkit-overflow-scrolling:touch;">
            <span x-show="clientLogos.length === 0" class="text-sm text-white/40 shrink-0">No client logos yet — add them from <strong class="text-white/60">Client logos</strong> in the sidebar.</span>
            <template x-for="c in clientLogos" :key="c.id">
                <div class="flex items-center gap-2 rounded-lg px-3 py-2 border border-white/10 bg-black/20 shrink-0"
                    :class="c.is_visible == 1 ? '' : 'opacity-40'" :title="c.name + (c.is_visible == 1 ? '' : ' (hidden)')">
                    <img :src="c.logo_url" :alt="c.name" class="h-9 w-auto max-w-[120px] object-contain">
                    <span class="text-xs text-white/60 max-w-[100px] truncate hidden sm:inline" x-text="c.name"></span>
                </div>
            </template>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="flex items-center gap-3 mb-4 justify-between">
        <div class="flex items-center gap-2">
            <button @click="filterTab = 'all'"
                :class="filterTab === 'all' ? 'bg-white text-zinc-900 border-white' : 'bg-transparent text-white/70 border-white/20 hover:bg-white/10 hover:text-white'"
                class="px-3 py-1.5 rounded-lg text-sm border transition-colors">All</button>
            <button @click="filterTab = 'published'"
                :class="filterTab === 'published' ? 'bg-white text-zinc-900 border-white' : 'bg-transparent text-white/70 border-white/20 hover:bg-white/10 hover:text-white'"
                class="px-3 py-1.5 rounded-lg text-sm border transition-colors">Published</button>
            <button @click="filterTab = 'draft'"
                :class="filterTab === 'draft' ? 'bg-white text-zinc-900 border-white' : 'bg-transparent text-white/70 border-white/20 hover:bg-white/10 hover:text-white'"
                class="px-3 py-1.5 rounded-lg text-sm border transition-colors">Draft</button>
        </div>
        <div class="relative">
            <input type="text" x-model="searchQuery" placeholder="Search projects..."
                class="w-64 bg-white/5 border border-white/10 text-white rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#6147bd] pl-9 placeholder-white/30">
            <svg class="w-4 h-4 text-white/50 absolute left-3 top-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <!-- PROJECTS TABLE -->
    <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left relative">
                <thead class="bg-white/5 border-b border-white/10 text-white/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-20">Thumbnail</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Title & Tags</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Filter Group</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody id="projects-tbody" class="divide-y divide-white/10 text-white/80">
                    <!-- Loading state -->
                    <tr x-show="isLoading">
                        <td colspan="6" class="px-4 py-8 text-center text-white/50">
                            Loading projects...
                        </td>
                    </tr>

                    <!-- Empty state -->
                    <tr x-show="!isLoading && filteredProjects.length === 0" style="display: none;">
                        <td colspan="6" class="px-4 py-8 text-center text-white/50">
                            No projects found matching your criteria.
                        </td>
                    </tr>

                    <!-- Dynamic Rows -->
                    <template x-for="project in filteredProjects" :key="project.id">
                        <tr class="hover:bg-white/5 transition group">
                            <td class="px-4 py-3">
                                <span
                                    class="drag-handle text-white/30 text-lg px-2 hover:text-white/60 cursor-grab">&#10240;</span>
                            </td>
                            <td class="px-4 py-3">
                                <img :src="project.thumbnail_url || 'https://placehold.co/60x40/2e2e3e/ffffff?text=IMG'"
                                    class="rounded w-14 h-10 object-cover border border-white/10" alt="Thumb">
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-white mb-1">
                                    <span x-show="project.is_featured" class="text-amber-400 mr-1"
                                        title="Featured">★</span>
                                    <span x-text="project.title"></span>
                                </div>
                                <div class="flex items-center gap-1 flex-wrap">
                                    <template x-for="tag in project.tags">
                                        <span class="text-xs bg-white/20 text-white px-2 py-0.5 rounded-full"
                                            x-text="tag"></span>
                                    </template>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-white/70" x-text="project.filter_group"></td>
                            <td class="px-4 py-3">
                                <span x-show="project.status === 'published'"
                                    class="bg-green-500/30 text-green-300 text-xs px-2 py-1 rounded-full">Published</span>
                                <span x-show="project.status === 'draft'"
                                    class="bg-white/20 text-white text-xs px-2 py-1 rounded-full">Draft</span>
                                <span x-show="project.status === 'archived'"
                                    class="bg-red-500/30 text-red-300 text-xs px-2 py-1 rounded-full">Archived</span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button @click="openEdit(project)"
                                    class="border border-white/20 text-white/80 bg-transparent hover:bg-white/10 hover:text-white rounded-lg px-3 py-1.5 text-xs font-medium transition mr-2">Edit</button>
                                <button @click="deleteProject(project.id)"
                                    class="border border-red-500/30 text-red-400 bg-transparent hover:bg-red-500/20 hover:text-red-300 rounded-lg px-3 py-1.5 text-xs font-medium transition">Delete</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD/EDIT MODAL -->
    <div x-show="showModal" style="display: none;"
        class="fixed inset-0 bg-[#000000]/80 backdrop-blur-sm z-40 flex items-start justify-center pt-10 overflow-y-auto">
        <div @click.away="showModal=false"
            class="bg-[#111111] border border-white/10 rounded-2xl p-6 w-full max-w-2xl mx-4 mb-10 z-50 shadow-2xl relative">

            <!-- Modal header -->
            <div class="flex justify-between items-center mb-6">
                <h2 x-text="modalMode==='add' ? 'Add Project' : 'Edit Project'"
                    class="text-lg font-semibold text-white"></h2>
                <button @click="showModal=false" class="text-white/50 hover:text-white p-1 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form grid -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Title -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Title</label>
                    <input type="text" x-model="form.title"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                </div>
                <!-- Description -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Description</label>
                    <textarea rows="4" x-model="form.description"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] resize-none"></textarea>
                </div>
                <!-- Slug & Sort -->
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Slug</label>
                    <input type="text" x-model="form.slug" placeholder="auto-generated"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white/50 focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                </div>
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Sort Order</label>
                    <input type="number" x-model="form.sort_order"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                </div>
                <!-- Ext Link -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">External Link</label>
                    <input type="text" x-model="form.external_link" placeholder="https://behance.net/..."
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                </div>
                <!-- Link Label & Filter -->
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Link Label</label>
                    <input type="text" x-model="form.link_label"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                </div>
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Filter Group</label>
                    <select x-model="form.filter_group"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                        <option value="all" class="bg-[#111111]">All Work</option>
                        <option value="selected_work" class="bg-[#111111]">Selected Work</option>
                        <option value="case_studies" class="bg-[#111111]">Case Studies</option>
                        <option value="articles" class="bg-[#111111]">Articles</option>
                    </select>
                </div>
                <!-- Tags -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Tags</label>
                    <div class="flex flex-wrap gap-3 mt-2">
                        <?php
                        $tags = ['UX Audit', 'UI/UX', 'Web', 'Mobile', 'Dashboard', 'Case Study', 'Article', 'Featured'];
                        foreach ($tags as $t): ?>
                            <label class="flex items-center gap-1.5 text-sm text-white/80 cursor-pointer">
                                <input type="checkbox" x-model="form.tags" value="<?= $t ?>"
                                    class="rounded text-[#6147bd] focus:ring-[#6147bd] h-4 w-4 bg-white/5 border-white/20">
                                <?= $t ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Status & Featured -->
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Status</label>
                    <select x-model="form.status"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                        <option value="published" class="bg-[#111111]">Published</option>
                        <option value="draft" class="bg-[#111111]">Draft</option>
                        <option value="archived" class="bg-[#111111]">Archived</option>
                    </select>
                </div>
                <div class="col-span-1 flex flex-col justify-end">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-sm font-medium text-white/80">Featured</label>
                        <button type="button" @click="form.is_featured = !form.is_featured"
                            :class="form.is_featured ? 'bg-[#6147bd]' : 'bg-white/20'"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                            <span aria-hidden="true" :class="form.is_featured ? 'translate-x-5' : 'translate-x-0'"
                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                        </button>
                    </div>
                </div>
                <!-- Thumbnail zone -->
                <div class="col-span-2 mt-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Thumbnail</label>
                    <div x-show="!form.thumbnail_url"
                        class="border-2 border-dashed border-white/20 hover:border-[#6147bd] hover:bg-white/5 transition-colors rounded-xl p-6 text-center cursor-pointer relative">
                        <svg class="mx-auto h-12 w-12 text-white/30" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48" aria-hidden="true">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="mt-2 text-sm text-white/50">
                            <span x-show="!isUploading">Drag image here or click to browse</span>
                            <span x-show="isUploading" class="text-[#6147bd]">Uploading...</span>
                        </div>
                        <input type="file" @change="uploadImage" accept="image/*" :disabled="isUploading"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer disabled:cursor-wait">
                    </div>

                    <div x-show="form.thumbnail_url" style="display: none;" class="relative inline-block mt-2">
                        <img :src="form.thumbnail_url" class="rounded-lg h-32 object-cover border border-white/10"
                            alt="Preview">
                        <button type="button" @click="removeImage"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                <button @click="showModal=false"
                    class="border border-white/20 text-white bg-transparent hover:bg-white/10 rounded-lg px-4 py-2 text-sm font-medium transition">
                    Cancel
                </button>
                <button @click="saveProject()"
                    class="bg-white text-zinc-900 hover:bg-zinc-200 rounded-lg px-4 py-2 text-sm font-medium transition">
                    Save Project
                </button>
            </div>

        </div>
    </div>
</div>