<?php // FILE: admin/pages/reviews.php
$page_title = 'Reviews'; 
$active_nav = 'reviews';
require_once '../includes/layout.php';
?>

<div x-data="{ 
    showModal: false, 
    modalMode: 'add', 
    reviews: [],
    isLoading: true,
    isUploading: false,
    form: { id: null, client_name: '', client_company: '', client_role: '', badge_label: '', photo_url: '', quote: '', rating: 5, is_visible: 1, sort_order: 0 },
    init() { this.fetchReviews(); },
    fetchReviews() {
        this.isLoading = true;
        uxpAdminFetch('../api/testimonials')
            .then(res => res.json())
            .then(data => { this.reviews = data; this.isLoading = false; });
    },
    saveReview() {
        if (!this.form.client_name.trim() || !this.form.quote.trim()) {
            alert('Client Name and Quote are required.');
            return;
        }
        const method = this.modalMode === 'add' ? 'POST' : 'PUT';
        uxpAdminFetch('../api/testimonials', {
            method: method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(this.form)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) { this.showModal = false; this.fetchReviews(); }
            else { alert(data.error || 'Something went wrong.'); }
        });
    },
    deleteReview(id) {
        if (confirm('Are you sure you want to delete this review?')) {
            uxpAdminFetch('../api/testimonials', {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) { this.fetchReviews(); }
                else { alert(data.error || 'Something went wrong.'); }
            });
        }
    },
    toggleVisibility(review) {
        const newStatus = review.is_visible == 1 ? 0 : 1;
        uxpAdminFetch('../api/testimonials', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: review.id, is_visible: newStatus })
        }).then(() => this.fetchReviews());
    },
    openEdit(review) {
        this.form = { id: null, client_name: '', client_company: '', client_role: '', badge_label: '', photo_url: '', quote: '', rating: 5, is_visible: 1, sort_order: 0, ...review, badge_label: review.badge_label || '' };
        this.modalMode = 'edit';
        this.showModal = true;
    },
    openAdd() {
        this.form = { id: null, client_name: '', client_company: '', client_role: '', badge_label: '', photo_url: '', quote: '', rating: 5, is_visible: 1, sort_order: 0 };
        this.modalMode = 'add';
        this.showModal = true;
    },
    uploadPhoto(event) {
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
            if (data.success) { this.form.photo_url = data.url; }
            else { alert(data.error || 'Upload failed.'); }
        })
        .catch(() => { this.isUploading = false; alert('Upload failed due to network error.'); });
    },
    removePhoto() { this.form.photo_url = ''; },
    getInitials(name) {
        return name ? name.split(' ').map(n=>n[0]).join('').substring(0,2).toUpperCase() : '??';
    }
}">
    
    <!-- HEADER ROW -->
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <button @click="openAdd()" class="bg-white text-zinc-900 font-medium hover:bg-zinc-200 rounded-lg px-4 py-2 text-sm transition-colors">
            + Add Review
        </button>
    </div>

    <!-- REVIEWS TABLE -->
    <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-white/5 border-b border-white/10 text-white/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-14">Photo</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Client</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Badge</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Quote</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Rating</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Visible</th>
                        <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody id="reviews-tbody" class="divide-y divide-white/10 text-white/80">
                    <tr x-show="isLoading">
                        <td colspan="8" class="px-4 py-8 text-center text-white/50">Loading reviews...</td>
                    </tr>
                    <tr x-show="!isLoading && reviews.length === 0" style="display: none;">
                        <td colspan="8" class="px-4 py-8 text-center text-white/50">No reviews found. Add one to get started.</td>
                    </tr>

                    <template x-for="review in reviews" :key="review.id">
                        <tr class="hover:bg-white/5 transition group">
                            <td class="px-4 py-3">
                                <span class="drag-handle text-white/30 text-lg px-2 hover:text-white/60 cursor-grab">&#10240;</span>
                            </td>
                            <td class="px-4 py-3">
                                <template x-if="review.photo_url">
                                    <img :src="review.photo_url" class="w-8 h-8 rounded-full object-cover" alt="Photo">
                                </template>
                                <template x-if="!review.photo_url">
                                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-xs text-white font-medium" x-text="getInitials(review.client_name)"></div>
                                </template>
                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-white" x-text="review.client_name"></div>
                                <div class="text-xs text-white/50" x-text="(review.client_role || '') + (review.client_role && review.client_company ? ' — ' : '') + (review.client_company || '')"></div>
                            </td>
                            <td class="px-4 py-3 text-white/50 text-xs max-w-[120px] truncate" x-text="review.badge_label || '—'">
                            </td>
                            <td class="px-4 py-3 text-white/60 truncate max-w-[200px]" x-text="'&quot;' + (review.quote.length > 50 ? review.quote.substring(0, 50) + '...' : review.quote) + '&quot;'">
                            </td>
                            <td class="px-4 py-3 text-amber-400 flex gap-0.5 mt-2">
                                <template x-for="i in 5">
                                    <svg class="w-4 h-4" :class="i <= review.rating ? 'fill-current' : 'text-white/20 fill-current'" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </template>
                            </td>
                            <td class="px-4 py-3">
                                <button type="button" @click="toggleVisibility(review)" 
                                        :class="review.is_visible == 1 ? 'bg-green-500' : 'bg-white/20'" 
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                                    <span aria-hidden="true" :class="review.is_visible == 1 ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                <button @click="openEdit(review)" class="border border-white/20 text-white/80 bg-transparent hover:bg-white/10 hover:text-white rounded-lg px-3 py-1.5 text-xs font-medium transition mr-2">Edit</button>
                                <button @click="deleteReview(review.id)" class="border border-red-500/30 text-red-400 bg-transparent hover:bg-red-500/20 hover:text-red-300 rounded-lg px-3 py-1.5 text-xs font-medium transition">Delete</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD/EDIT MODAL -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 bg-[#000000]/80 backdrop-blur-sm z-40 flex items-start justify-center pt-10 overflow-y-auto">
        <div @click.away="showModal=false" class="bg-[#111111] border border-white/10 rounded-2xl p-6 w-full max-w-2xl mx-4 mb-10 z-50 shadow-2xl relative">
            
            <div class="flex justify-between items-center mb-6">
                <h2 x-text="modalMode==='add' ? 'Add Review' : 'Edit Review'" class="text-lg font-semibold text-white"></h2>
                <button @click="showModal=false" class="text-white/50 hover:text-white p-1 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Client Name *</label>
                    <input type="text" x-model="form.client_name" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                </div>
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Client Company</label>
                    <input type="text" x-model="form.client_company" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Client Role</label>
                    <input type="text" x-model="form.client_role" placeholder="CEO / Product Manager / etc." class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                </div>
                
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Badge (homepage pill)</label>
                    <input type="text" x-model="form.badge_label" placeholder="e.g. Project Experience, Workshop Experience" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20">
                </div>
                
                <div class="col-span-2 mt-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Photo</label>
                    
                    <template x-if="form.photo_url">
                        <div class="relative inline-block border border-white/10 rounded-xl overflow-hidden bg-white/5 p-2">
                            <img :src="form.photo_url" class="h-20 w-20 object-cover rounded-lg">
                            <button @click="removePhoto()" type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600 transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </template>
                    
                    <template x-if="!form.photo_url">
                        <div class="border-2 border-dashed border-white/20 hover:border-[#6147bd] hover:bg-white/5 transition-colors rounded-xl p-4 text-center cursor-pointer relative">
                            <div class="text-sm text-white/50 flex flex-col items-center gap-2">
                                <template x-if="isUploading">
                                    <span class="text-[#6147bd]">Uploading...</span>
                                </template>
                                <template x-if="!isUploading">
                                    <>
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span>Upload client photo</span>
                                    </>
                                </template>
                            </div>
                            <input type="file" @change="uploadPhoto" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" :disabled="isUploading">
                        </div>
                    </template>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Quote *</label>
                    <textarea x-model="form.quote" rows="4" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] resize-none"></textarea>
                </div>

                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Rating</label>
                    <div class="flex gap-1 star-rating group cursor-pointer">
                        <template x-for="i in 5">
                            <svg @click="form.rating = i" @mouseenter="$el.parentElement.setAttribute('data-hover', i)" @mouseleave="$el.parentElement.removeAttribute('data-hover')" 
                                 :class="i <= form.rating ? 'text-amber-400 fill-current' : 'text-white/30'" 
                                 class="w-6 h-6 transition-colors duration-150" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </template>
                    </div>
                </div>

                <div class="col-span-1 flex flex-col justify-end">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-sm font-medium text-white/80">Visible</label>
                        <button type="button" @click="form.is_visible = (form.is_visible == 1 ? 0 : 1)" 
                                :class="form.is_visible == 1 ? 'bg-green-500' : 'bg-white/20'" 
                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                            <span aria-hidden="true" :class="form.is_visible == 1 ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                <button @click="showModal=false" class="border border-white/20 text-white bg-transparent hover:bg-white/10 rounded-lg px-4 py-2 text-sm font-medium transition">
                    Cancel
                </button>
                <button @click="saveReview" class="bg-white text-zinc-900 hover:bg-zinc-200 rounded-lg px-4 py-2 text-sm font-medium transition">
                    Save Review
                </button>
            </div>
            
        </div>
    </div>
</div>
