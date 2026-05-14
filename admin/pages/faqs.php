<?php // FILE: admin/pages/faqs.php
$page_title = 'FAQs';
$active_nav = 'faqs';
require_once '../includes/layout.php';
?>

<div x-data="{ 
    showModal: false, 
    modalMode: 'add', 
    faqs: [],
    isLoading: true,
    form: { id: null, question: '', answer: '', category: 'General', is_visible: 1, sort_order: 0 },
    init() { this.fetchFaqs(); },
    fetchFaqs() {
        this.isLoading = true;
        uxpAdminFetch('../api/faqs')
            .then(res => res.json())
            .then(data => { this.faqs = data; this.isLoading = false; });
    },
    saveFaq() {
        if (!this.form.question.trim() || !this.form.answer.trim()) {
            alert('Question and Answer are required.');
            return;
        }
        const method = this.modalMode === 'add' ? 'POST' : 'PUT';
        uxpAdminFetch('../api/faqs', {
            method: method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(this.form)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) { this.showModal = false; this.fetchFaqs(); }
            else { alert(data.error || 'Something went wrong.'); }
        });
    },
    deleteFaq(id) {
        if (confirm('Are you sure you want to delete this FAQ?')) {
            uxpAdminFetch('../api/faqs', {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) { this.fetchFaqs(); }
                else { alert(data.error || 'Something went wrong.'); }
            });
        }
    },
    toggleVisibility(faq) {
        const newStatus = faq.is_visible == 1 ? 0 : 1;
        uxpAdminFetch('../api/faqs', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: faq.id, is_visible: newStatus })
        }).then(() => this.fetchFaqs());
    },
    openEdit(faq) {
        this.form = { ...faq };
        this.modalMode = 'edit';
        this.showModal = true;
    },
    openAdd() {
        this.form = { id: null, question: '', answer: '', category: 'General', is_visible: 1, sort_order: 0 };
        this.modalMode = 'add';
        this.showModal = true;
    }
}">

    <!-- HEADER ROW -->
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <button @click="openAdd()"
            class="bg-white text-zinc-900 font-medium hover:bg-zinc-200 rounded-lg px-4 py-2 text-sm transition-colors">
            + Add FAQ
        </button>
    </div>

    <!-- FAQS TABLE -->
    <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-white/5 border-b border-white/10 text-white/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Question</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Answer</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide">Visible</th>
                        <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody id="faqs-tbody" class="divide-y divide-white/10 text-white/80">
                    <tr x-show="isLoading">
                        <td colspan="6" class="px-4 py-8 text-center text-white/50">Loading FAQs...</td>
                    </tr>
                    <tr x-show="!isLoading && faqs.length === 0" style="display: none;">
                        <td colspan="6" class="px-4 py-8 text-center text-white/50">No FAQs found. Add one to get
                            started.</td>
                    </tr>

                    <template x-for="faq in faqs" :key="faq.id">
                        <tr class="hover:bg-white/5 transition group">
                            <td class="px-4 py-3">
                                <span
                                    class="drag-handle text-white/30 text-lg px-2 hover:text-white/60 cursor-grab">&#10240;</span>
                            </td>
                            <td class="px-4 py-3 font-medium text-white truncate max-w-[250px]" x-text="faq.question">
                            </td>
                            <td class="px-4 py-3 text-white/60 truncate max-w-[300px]"
                                x-text="faq.answer.replace(/(<([^>]+)>)/gi, '')"></td>
                            <td class="px-4 py-3">
                                <span class="bg-white/10 text-white/80 px-2 py-0.5 rounded-full text-xs"
                                    x-text="faq.category"></span>
                            </td>
                            <td class="px-4 py-3">
                                <button type="button" @click="toggleVisibility(faq)"
                                    :class="faq.is_visible == 1 ? 'bg-green-500' : 'bg-white/20'"
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                                    <span aria-hidden="true"
                                        :class="faq.is_visible == 1 ? 'translate-x-5' : 'translate-x-0'"
                                        class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                <button @click="openEdit(faq)"
                                    class="border border-white/20 text-white/80 bg-transparent hover:bg-white/10 hover:text-white rounded-lg px-3 py-1.5 text-xs font-medium transition mr-2">Edit</button>
                                <button @click="deleteFaq(faq.id)"
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
                <h2 x-text="modalMode==='add' ? 'Add FAQ' : 'Edit FAQ'" class="text-lg font-semibold text-white"></h2>
                <button @click="showModal=false" class="text-white/50 hover:text-white p-1 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Question *</label>
                    <input type="text" x-model="form.question"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]"
                        placeholder="e.g. How long does a project take?">
                </div>

                <div class="col-span-1">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Category</label>
                    <input type="text" x-model="form.category"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]"
                        placeholder="General">
                </div>

                <div class="col-span-1 flex flex-col justify-end">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-sm font-medium text-white/80">Visible</label>
                        <button type="button" @click="form.is_visible = (form.is_visible == 1 ? 0 : 1)"
                            :class="form.is_visible == 1 ? 'bg-green-500' : 'bg-white/20'"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                            <span aria-hidden="true" :class="form.is_visible == 1 ? 'translate-x-5' : 'translate-x-0'"
                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                        </button>
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white/80 mb-1.5">Answer *</label>
                    <textarea x-model="form.answer" rows="6"
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd] resize-none"
                        placeholder="Provide a detailed answer..."></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-white/10">
                <button @click="showModal=false"
                    class="border border-white/20 text-white bg-transparent hover:bg-white/10 rounded-lg px-4 py-2 text-sm font-medium transition">
                    Cancel
                </button>
                <button @click="saveFaq"
                    class="bg-white text-zinc-900 hover:bg-zinc-200 rounded-lg px-4 py-2 text-sm font-medium transition">
                    Save FAQ
                </button>
            </div>

        </div>
    </div>
</div>