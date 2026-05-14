<?php // FILE: admin/pages/services.php
$page_title = 'Services';
$active_nav = 'services';
require_once '../includes/layout.php';
?>

<div x-data="{ 
    showModal: false, 
    modalMode: 'add',
    services: [],
    isLoading: true,
    form: { id: null, title: '', slug: '', short_desc: '', what_it_solves: [], how_we_work: [], what_changes: [], deliverables: [], icon_name: '', status: 'published', sort_order: 0 },
    newDeliverable: '',
    newWhatItSolves: '',
    newHowWeWork: '',
    newWhatChanges: '',
    isUploading: false,
    init() { this.fetchServices(); },
    fetchServices() {
        this.isLoading = true;
        uxpAdminFetch('../api/services')
            .then(res => res.json())
            .then(data => { this.services = data; this.isLoading = false; });
    },
    saveService() {
        if (!this.form.title.trim() || !this.form.short_desc.trim()) {
            alert('Title and Short Description are required.');
            return;
        }
        const method = this.modalMode === 'add' ? 'POST' : 'PUT';
        uxpAdminFetch('../api/services', {
            method: method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(this.form)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) { this.showModal = false; this.fetchServices(); }
            else { alert(data.error || 'Something went wrong.'); }
        });
    },
    deleteService(id) {
        if (confirm('Are you sure you want to delete this service?')) {
            uxpAdminFetch('../api/services', {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) { this.fetchServices(); }
                else { alert(data.error || 'Something went wrong.'); }
            });
        }
    },
    openEdit(service) {
        this.form = { 
            ...service, 
            deliverables: service.deliverables || [],
            what_it_solves: service.what_it_solves || [],
            how_we_work: service.how_we_work || [],
            what_changes: service.what_changes || []
        };
        this.modalMode = 'edit';
        this.showModal = true;
    },
    openAdd() {
        this.form = { id: null, title: '', slug: '', short_desc: '', what_it_solves: [], how_we_work: [], what_changes: [], deliverables: [], icon_name: '', status: 'published', sort_order: 0 };
        this.modalMode = 'add';
        this.showModal = true;
    },
    uploadIcon(event) {
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
            if (data.success) { this.form.icon_name = data.url; }
            else { alert(data.error || 'Upload failed.'); }
        })
        .catch(() => { this.isUploading = false; alert('Upload failed due to network error.'); });
    },
    removeIcon() { this.form.icon_name = ''; }
}">

    <!-- HEADER ROW -->
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <button @click="openAdd()"
            class="bg-white text-zinc-900 font-medium hover:bg-zinc-200 rounded-lg px-4 py-2 text-sm transition-colors">
            + Add Service
        </button>
    </div>

    <!-- SERVICES TABLE -->
    <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-white/5 border-b border-white/10 text-white/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-16">Icon</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Title</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Short Desc</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody id="services-tbody" class="divide-y divide-white/10 text-white/80">
                    <tr x-show="isLoading">
                        <td colspan="6" class="px-4 py-8 text-center text-white/50">Loading services...</td>
                    </tr>
                    <tr x-show="!isLoading && services.length === 0" style="display: none;">
                        <td colspan="6" class="px-4 py-8 text-center text-white/50">No services found. Add one to get
                            started.</td>
                    </tr>

                    <template x-for="service in services" :key="service.id">
                        <tr class="hover:bg-white/5 transition group">
                            <td class="px-4 py-3">
                                <span
                                    class="drag-handle text-white/30 text-lg px-2 hover:text-white/60 cursor-grab">&#10240;</span>
                            </td>
                            <td class="px-4 py-3 text-white/50">
                                <template x-if="service.icon_name">
                                    <img :src="service.icon_name" class="w-8 h-8 object-contain" alt="Icon">
                                </template>
                                <template x-if="!service.icon_name">
                                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white/50" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </template>
                            </td>
                            <td class="px-4 py-3 font-medium text-white" x-text="service.title"></td>
                            <td class="px-4 py-3 text-white/60"
                                x-text="service.short_desc && service.short_desc.length > 50 ? service.short_desc.substring(0, 50) + '...' : service.short_desc">
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    :class="service.status === 'published' ? 'bg-green-500/30 text-green-300' : 'bg-white/20 text-white'"
                                    class="text-xs px-2 py-1 rounded-full"
                                    x-text="service.status ? service.status.charAt(0).toUpperCase() + service.status.slice(1) : ''"></span>
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                <button @click="openEdit(service)"
                                    class="border border-white/20 text-white/80 bg-transparent hover:bg-white/10 hover:text-white rounded-lg px-3 py-1.5 text-xs font-medium transition mr-2">Edit</button>
                                <button @click="deleteService(service.id)"
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

            <div class="flex justify-between items-center mb-6">
                <h2 x-text="modalMode==='add' ? 'Add Service' : 'Edit Service'"
                    class="text-lg font-semibold text-white"></h2>
                <button @click="showModal=false" class="text-white/50 hover:text-white p-1 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Title</label>
                    <input type="text" x-model="form.title"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Slug</label>
                    <input type="text" x-model="form.slug" placeholder="auto-generated"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white/50 focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Short Description</label>
                    <textarea rows="2" x-model="form.short_desc"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] resize-none"></textarea>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">What It Solves</label>
                    <div class="flex gap-2 mb-2">
                        <input type="text" x-model="newWhatItSolves"
                            @keydown.enter.prevent="if(newWhatItSolves.trim()){ form.what_it_solves.push(newWhatItSolves.trim()); newWhatItSolves=''; }"
                            placeholder="Add a point"
                            class="flex-1 bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                        <button type="button"
                            @click="if(newWhatItSolves.trim()){ form.what_it_solves.push(newWhatItSolves.trim()); newWhatItSolves=''; }"
                            class="bg-white/10 text-white hover:bg-white/20 border border-white/10 rounded-lg px-4 py-2 text-sm font-medium transition">Add</button>
                    </div>
                    <div class="flex flex-col gap-2 mt-2">
                        <template x-for="(item, index) in form.what_it_solves" :key="index">
                            <div
                                class="flex items-start justify-between bg-white/5 border border-white/10 p-2 rounded-lg">
                                <span class="text-sm text-white/80" x-text="item"></span>
                                <button type="button" @click="form.what_it_solves.splice(index, 1)"
                                    class="text-white/50 hover:text-red-400 font-bold ml-2 transition-colors">&times;</button>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">How We Work</label>
                    <div class="flex gap-2 mb-2">
                        <input type="text" x-model="newHowWeWork"
                            @keydown.enter.prevent="if(newHowWeWork.trim()){ form.how_we_work.push(newHowWeWork.trim()); newHowWeWork=''; }"
                            placeholder="Add a step"
                            class="flex-1 bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                        <button type="button"
                            @click="if(newHowWeWork.trim()){ form.how_we_work.push(newHowWeWork.trim()); newHowWeWork=''; }"
                            class="bg-white/10 text-white hover:bg-white/20 border border-white/10 rounded-lg px-4 py-2 text-sm font-medium transition">Add</button>
                    </div>
                    <div class="flex flex-col gap-2 mt-2">
                        <template x-for="(item, index) in form.how_we_work" :key="index">
                            <div
                                class="flex items-start justify-between bg-white/5 border border-white/10 p-2 rounded-lg">
                                <span class="text-sm text-white/80" x-text="item"></span>
                                <button type="button" @click="form.how_we_work.splice(index, 1)"
                                    class="text-white/50 hover:text-red-400 font-bold ml-2 transition-colors">&times;</button>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">What Changes</label>
                    <div class="flex gap-2 mb-2">
                        <input type="text" x-model="newWhatChanges"
                            @keydown.enter.prevent="if(newWhatChanges.trim()){ form.what_changes.push(newWhatChanges.trim()); newWhatChanges=''; }"
                            placeholder="Add an outcome"
                            class="flex-1 bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                        <button type="button"
                            @click="if(newWhatChanges.trim()){ form.what_changes.push(newWhatChanges.trim()); newWhatChanges=''; }"
                            class="bg-white/10 text-white hover:bg-white/20 border border-white/10 rounded-lg px-4 py-2 text-sm font-medium transition">Add</button>
                    </div>
                    <div class="flex flex-col gap-2 mt-2">
                        <template x-for="(item, index) in form.what_changes" :key="index">
                            <div
                                class="flex items-start justify-between bg-white/5 border border-white/10 p-2 rounded-lg">
                                <span class="text-sm text-white/80" x-text="item"></span>
                                <button type="button" @click="form.what_changes.splice(index, 1)"
                                    class="text-white/50 hover:text-red-400 font-bold ml-2 transition-colors">&times;</button>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Deliverables</label>
                    <div class="flex gap-2 mb-2">
                        <input type="text" x-model="newDeliverable"
                            @keydown.enter.prevent="if(newDeliverable.trim()){ form.deliverables.push(newDeliverable.trim()); newDeliverable=''; }"
                            placeholder="Add a deliverable"
                            class="flex-1 bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                        <button type="button"
                            @click="if(newDeliverable.trim()){ form.deliverables.push(newDeliverable.trim()); newDeliverable=''; }"
                            class="bg-white/10 text-white hover:bg-white/20 border border-white/10 rounded-lg px-4 py-2 text-sm font-medium transition">Add</button>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <template x-for="(item, index) in form.deliverables" :key="index">
                            <span
                                class="inline-flex items-center gap-1.5 bg-white/10 text-white border border-white/10 text-sm px-3 py-1 rounded-full">
                                <span x-text="item"></span>
                                <button type="button" @click="form.deliverables.splice(index, 1)"
                                    class="text-white/50 hover:text-red-400 font-bold ml-1 transition-colors">&times;</button>
                            </span>
                        </template>
                    </div>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Icon Upload</label>
                    <div x-show="!form.icon_name"
                        class="border-2 border-dashed border-white/20 hover:border-[#6147bd] hover:bg-white/5 transition-colors rounded-xl p-4 text-center cursor-pointer relative">
                        <svg class="mx-auto h-8 w-8 text-white/30" stroke="currentColor" fill="none" viewBox="0 0 48 48"
                            aria-hidden="true">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="mt-2 text-xs text-white/50">
                            <span x-show="!isUploading">Drag image here to upload</span>
                            <span x-show="isUploading" class="text-[#6147bd]">Uploading...</span>
                        </div>
                        <input type="file" @change="uploadIcon" accept="image/*" :disabled="isUploading"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer disabled:cursor-wait">
                    </div>

                    <div x-show="form.icon_name" style="display: none;" class="relative inline-block mt-2">
                        <img :src="form.icon_name" class="rounded-lg h-20 object-contain border border-white/10"
                            alt="Preview">
                        <button type="button" @click="removeIcon"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition shadow-lg">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Sort Order</label>
                    <input type="number" x-model="form.sort_order"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                </div>
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Status</label>
                    <select x-model="form.status"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                        <option value="published" class="bg-[#111111]">Published</option>
                        <option value="draft" class="bg-[#111111]">Draft</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                <button @click="showModal=false"
                    class="border border-white/20 text-white bg-transparent hover:bg-white/10 rounded-lg px-4 py-2 text-sm font-medium transition">
                    Cancel
                </button>
                <button @click="saveService()"
                    class="bg-white text-zinc-900 hover:bg-zinc-200 rounded-lg px-4 py-2 text-sm font-medium transition">
                    Save Service
                </button>
            </div>

        </div>
    </div>
</div>