<?php
$page_title = 'Client logos';
$active_nav = 'client_logos';
require_once '../includes/layout.php';
?>

<div x-data="{
    showModal: false,
    modalMode: 'add',
    clients: [],
    isLoading: true,
    isUploading: false,
    form: { id: null, name: '', logo_url: '', website_url: '', sort_order: 0, is_visible: 1 },
    init() { this.fetchClients(); },
    fetchClients() {
        this.isLoading = true;
        uxpAdminFetch('../api/client_logos')
            .then(res => res.json())
            .then(data => { this.clients = Array.isArray(data) ? data : []; this.isLoading = false; })
            .catch(() => { this.clients = []; this.isLoading = false; });
    },
    saveClient() {
        if (!this.form.name.trim() || !this.form.logo_url.trim()) {
            alert('Client name and logo image are required.');
            return;
        }
        const method = this.modalMode === 'add' ? 'POST' : 'PUT';
        uxpAdminFetch('../api/client_logos', {
            method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(this.form)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) { this.showModal = false; this.fetchClients(); }
            else { alert(data.error || 'Something went wrong.'); }
        });
    },
    deleteClient(id) {
        if (!confirm('Remove this client logo?')) return;
        uxpAdminFetch('../api/client_logos', {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) this.fetchClients();
            else alert(data.error || 'Delete failed.');
        });
    },
    toggleVisibility(row) {
        const v = row.is_visible == 1 ? 0 : 1;
        uxpAdminFetch('../api/client_logos', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: row.id, is_visible: v })
        }).then(() => this.fetchClients());
    },
    openEdit(row) {
        this.form = {
            id: row.id,
            name: row.name || '',
            logo_url: row.logo_url || '',
            website_url: row.website_url || '',
            sort_order: row.sort_order ?? 0,
            is_visible: row.is_visible == 1 ? 1 : 0
        };
        this.modalMode = 'edit';
        this.showModal = true;
    },
    openAdd() {
        this.form = { id: null, name: '', logo_url: '', website_url: '', sort_order: 0, is_visible: 1 };
        this.modalMode = 'add';
        this.showModal = true;
    },
    uploadLogo(event) {
        const file = event.target.files[0];
        if (!file) return;
        this.isUploading = true;
        const fd = new FormData();
        fd.append('image', file);
        uxpAdminFetch('../api/upload', { method: 'POST', body: fd })
            .then(res => res.json())
            .then(data => {
                this.isUploading = false;
                if (data.success) this.form.logo_url = data.url;
                else alert(data.error || 'Upload failed.');
            })
            .catch(() => { this.isUploading = false; alert('Upload failed.'); });
    },
    removeLogo() { this.form.logo_url = ''; }
}">
    <div class="flex justify-between items-center mb-6">
        <p class="text-sm text-white/60 max-w-xl">These logos power the &ldquo;Our clients&rdquo; strip on the homepage and work page. Upload a transparent PNG or SVG where possible.</p>
        <button type="button" @click="openAdd()" class="bg-white text-zinc-900 font-medium hover:bg-zinc-200 rounded-lg px-4 py-2 text-sm shrink-0 transition-colors">+ Add client</button>
    </div>

    <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-white/5 border-b border-white/10 text-white/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-24">Logo</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Website</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-24">Order</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-28">Visible</th>
                        <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10 text-white/80">
                    <tr x-show="isLoading">
                        <td colspan="6" class="px-4 py-8 text-center text-white/50">Loading…</td>
                    </tr>
                    <tr x-show="!isLoading && clients.length === 0" style="display: none;">
                        <td colspan="6" class="px-4 py-8 text-center text-white/50">No clients yet. Add a logo to get started.</td>
                    </tr>
                    <template x-for="c in clients" :key="c.id">
                        <tr class="hover:bg-white/5">
                            <td class="px-4 py-3">
                                <img :src="c.logo_url" class="h-10 w-auto max-w-[120px] object-contain bg-white/5 rounded border border-white/10 p-1" alt="">
                            </td>
                            <td class="px-4 py-3 font-medium text-white" x-text="c.name"></td>
                            <td class="px-4 py-3 text-white/50 truncate max-w-[200px]">
                                <a x-show="c.website_url" :href="c.website_url" target="_blank" rel="noopener" class="text-[#a78bfa] hover:underline" x-text="c.website_url"></a>
                                <span x-show="!c.website_url">—</span>
                            </td>
                            <td class="px-4 py-3 text-white/60" x-text="c.sort_order"></td>
                            <td class="px-4 py-3">
                                <button type="button" @click="toggleVisibility(c)"
                                    :class="c.is_visible == 1 ? 'bg-green-500' : 'bg-white/20'"
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors">
                                    <span aria-hidden="true" :class="c.is_visible == 1 ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200"></span>
                                </button>
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                <button type="button" @click="openEdit(c)" class="border border-white/20 text-white/80 hover:bg-white/10 rounded-lg px-3 py-1.5 text-xs mr-2">Edit</button>
                                <button type="button" @click="deleteClient(c.id)" class="border border-red-500/30 text-red-400 hover:bg-red-500/20 rounded-lg px-3 py-1.5 text-xs">Delete</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="showModal" style="display: none;" class="fixed inset-0 bg-[#000000]/80 backdrop-blur-sm z-40 flex items-start justify-center pt-10 overflow-y-auto">
        <div @click.away="showModal=false" class="bg-[#111111] border border-white/10 rounded-2xl p-6 w-full max-w-lg mx-4 mb-10 shadow-2xl relative">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-white" x-text="modalMode === 'add' ? 'Add client logo' : 'Edit client logo'"></h2>
                <button type="button" @click="showModal=false" class="text-white/50 hover:text-white p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Client name *</label>
                    <input type="text" x-model="form.name" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Website (optional)</label>
                    <input type="url" x-model="form.website_url" placeholder="https://…" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                </div>
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Sort order</label>
                    <input type="number" x-model="form.sort_order" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Logo image *</label>
                    <div x-show="form.logo_url" class="relative inline-block border border-white/10 rounded-xl p-2 bg-white/5">
                        <img :src="form.logo_url" class="h-16 max-w-full object-contain" alt="">
                        <button type="button" @click="removeLogo()" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div x-show="!form.logo_url" class="border-2 border-dashed border-white/20 hover:border-[#6147bd] rounded-xl p-4 text-center cursor-pointer relative">
                        <span class="text-sm text-white/50" x-text="isUploading ? 'Uploading…' : 'Click to upload logo'"></span>
                        <input type="file" accept="image/*" @change="uploadLogo" :disabled="isUploading" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-white/80">Visible on site</span>
                    <button type="button" @click="form.is_visible = form.is_visible == 1 ? 0 : 1"
                        :class="form.is_visible == 1 ? 'bg-green-500' : 'bg-white/20'"
                        class="relative inline-flex h-6 w-11 rounded-full border-2 border-transparent transition-colors">
                        <span :class="form.is_visible == 1 ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition"></span>
                    </button>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                <button type="button" @click="showModal=false" class="border border-white/20 text-white rounded-lg px-4 py-2 text-sm hover:bg-white/10">Cancel</button>
                <button type="button" @click="saveClient" class="bg-white text-zinc-900 rounded-lg px-4 py-2 text-sm font-medium hover:bg-zinc-200">Save</button>
            </div>
        </div>
    </div>
</div>
