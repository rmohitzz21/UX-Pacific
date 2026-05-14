<?php // FILE: admin/pages/contacts.php
$page_title = 'Contacts'; 
$active_nav = 'contacts';
require_once '../includes/layout.php';
?>

<div x-data="{ 
    selectedContact: null,
    contacts: [],
    filterTab: 'all',
    searchQuery: '',
    isLoading: true,
    init() {
        this.fetchContacts();
    },
    fetchContacts() {
        this.isLoading = true;
        uxpAdminFetch('../api/contacts')
            .then(res => res.json())
            .then(data => {
                this.contacts = data;
                this.isLoading = false;
                if(this.contacts.length > 0 && !this.selectedContact) {
                    this.selectedContact = this.contacts[0];
                }
            });
    },
    get filteredContacts() {
        return this.contacts.filter(c => {
            if (this.filterTab !== 'all' && c.status !== this.filterTab) return false;
            if (this.searchQuery) {
                const q = this.searchQuery.toLowerCase();
                const matchesName = c.name && c.name.toLowerCase().includes(q);
                const matchesEmail = c.email && c.email.toLowerCase().includes(q);
                if (!matchesName && !matchesEmail) return false;
            }
            return true;
        });
    },
    updateStatus(id, newStatus) {
        uxpAdminFetch('../api/contacts', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, status: newStatus })
        }).then(() => this.fetchContacts());
    },
    saveNote(contact) {
        uxpAdminFetch('../api/contacts', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: contact.id, admin_note: contact.admin_note })
        }).then(() => {
            alert('Note saved!');
            this.fetchContacts();
        });
    },
    formatDate(dateStr) {
        if(!dateStr) return '';
        return new Date(dateStr).toLocaleString();
    },
    getInitials(name) {
        return name ? name.split(' ').map(n=>n[0]).join('').substring(0,2).toUpperCase() : '??';
    }
}" class="h-[calc(100vh-140px)] flex flex-col">
    <!-- STATS ROW -->
    <div class="grid grid-cols-4 gap-3 mb-5 flex-shrink-0">
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl px-4 py-3">
            <div class="text-xl font-semibold text-white" x-text="contacts.length">0</div>
            <div class="text-xs text-white/60 mt-1">Total</div>
        </div>
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl px-4 py-3">
            <div class="text-xl font-semibold text-white" x-text="contacts.filter(c => c.status === 'new').length">0</div>
            <div class="text-xs text-white/60 mt-1">New</div>
        </div>
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl px-4 py-3">
            <div class="text-xl font-semibold text-white" x-text="contacts.filter(c => c.status === 'awaiting_reply').length">0</div>
            <div class="text-xs text-white/60 mt-1">Awaiting Reply</div>
        </div>
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl px-4 py-3">
            <div class="text-xl font-semibold text-white" x-text="contacts.filter(c => c.status === 'replied').length">0</div>
            <div class="text-xs text-white/60 mt-1">Replied</div>
        </div>
    </div>

    <!-- FILTER + SEARCH -->
    <div class="flex items-center justify-between mb-4 flex-shrink-0">
        <div class="flex items-center gap-2">
            <button @click="filterTab = 'all'" :class="filterTab === 'all' ? 'bg-white text-zinc-900 border-white' : 'bg-transparent border-white/20 text-white/70 hover:bg-white/10 hover:text-white'" class="px-4 py-1.5 text-sm rounded-lg border font-medium transition-colors">All</button>
            <button @click="filterTab = 'new'" :class="filterTab === 'new' ? 'bg-white text-zinc-900 border-white' : 'bg-transparent border-white/20 text-white/70 hover:bg-white/10 hover:text-white'" class="px-4 py-1.5 text-sm rounded-lg border font-medium transition-colors">New</button>
            <button @click="filterTab = 'awaiting_reply'" :class="filterTab === 'awaiting_reply' ? 'bg-white text-zinc-900 border-white' : 'bg-transparent border-white/20 text-white/70 hover:bg-white/10 hover:text-white'" class="px-4 py-1.5 text-sm rounded-lg border font-medium transition-colors">Awaiting Reply</button>
            <button @click="filterTab = 'replied'" :class="filterTab === 'replied' ? 'bg-white text-zinc-900 border-white' : 'bg-transparent border-white/20 text-white/70 hover:bg-white/10 hover:text-white'" class="px-4 py-1.5 text-sm rounded-lg border font-medium transition-colors">Replied</button>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative">
                <input type="text" x-model="searchQuery" placeholder="Search contacts..." class="w-64 bg-white/5 border border-white/10 text-white rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#6147bd] pl-9 placeholder-white/30">
                <svg class="w-4 h-4 text-white/50 absolute left-3 top-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <button class="flex items-center gap-2 border border-white/20 text-white/80 bg-transparent hover:bg-white/10 hover:text-white rounded-lg px-4 py-1.5 text-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Export CSV
            </button>
        </div>
    </div>

    <!-- MAIN AREA -->
    <div class="flex gap-4 flex-1 min-h-0">
        <!-- LEFT COLUMN: Contact list -->
        <div class="w-96 flex-shrink-0 overflow-y-auto custom-scrollbar pr-2 space-y-2">
            <div x-show="isLoading" class="text-center text-white/40 py-10 text-sm">Loading contacts...</div>
            <template x-for="contact in filteredContacts" :key="contact.id">
                <div @click="selectedContact = contact" class="bg-white/5 backdrop-blur-sm border rounded-xl p-4 cursor-pointer transition" :class="selectedContact && selectedContact.id === contact.id ? 'border-[#6147bd] ring-1 ring-[#6147bd] bg-white/10' : 'border-white/10 hover:border-white/30'">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-2">
                            <div class="bg-white/20 text-white rounded-full w-9 h-9 flex items-center justify-center text-sm font-medium" x-text="getInitials(contact.name)"></div>
                            <div class="text-sm font-medium text-white" x-text="contact.name"></div>
                        </div>
                        <span x-show="contact.status === 'new'" class="bg-white text-zinc-900 text-xs px-2 py-0.5 rounded-full font-medium">New</span>
                        <span x-show="contact.status === 'read'" class="bg-white/20 text-white text-xs px-2 py-0.5 rounded-full font-medium">Read</span>
                        <span x-show="contact.status === 'awaiting_reply'" class="bg-yellow-500/30 text-yellow-300 text-xs px-2 py-0.5 rounded-full font-medium">Awaiting</span>
                        <span x-show="contact.status === 'replied'" class="bg-green-500/30 text-green-300 text-xs px-2 py-0.5 rounded-full font-medium">Replied</span>
                    </div>
                    <div class="text-xs text-white/50 mt-2" x-text="contact.email"></div>
                    <div class="text-xs text-white/70 mt-1 truncate" x-text="contact.message"></div>
                    <div class="flex items-center justify-between mt-3">
                        <div class="text-xs text-white/40" x-text="formatDate(contact.submitted_at)"></div>
                        <div class="text-xs bg-white/10 text-white/80 px-2 py-0.5 rounded-full" x-text="contact.industry || contact.service_interest || 'General'"></div>
                    </div>
                </div>
            </template>
            <div x-show="!isLoading && filteredContacts.length === 0" class="text-center text-white/40 py-10 text-sm">
                No contacts found.
            </div>
        </div>

        <!-- RIGHT COLUMN: Detail panel -->
        <div class="flex-1 bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-6 h-full overflow-y-auto custom-scrollbar">
            
            <template x-if="selectedContact">
                <div>
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="bg-white/20 text-white rounded-full w-12 h-12 flex items-center justify-center text-lg font-medium" x-text="getInitials(selectedContact.name)"></div>
                            <div>
                                <div class="text-base font-semibold text-white" x-text="selectedContact.name"></div>
                                <div class="text-sm text-white/50 mt-0.5" x-text="selectedContact.industry || 'No industry specified'"></div>
                            </div>
                        </div>
                        <select x-model="selectedContact.status" @change="updateStatus(selectedContact.id, selectedContact.status)" class="border border-white/10 rounded-lg px-3 py-1.5 text-sm bg-[#111111] text-white focus:outline-none focus:ring-2 focus:ring-[#6147bd]">
                            <option value="new">New</option>
                            <option value="read">Read</option>
                            <option value="awaiting_reply">Awaiting Reply</option>
                            <option value="replied">Replied</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-3 my-6 text-sm">
                        <div>
                            <span class="text-white/40 block mb-1">Email</span>
                            <a :href="'mailto:' + selectedContact.email" class="text-white/80 hover:text-white" x-text="selectedContact.email"></a>
                        </div>
                        <div>
                            <span class="text-white/40 block mb-1">Phone</span>
                            <span class="text-white/80" x-text="selectedContact.phone || 'Not provided'"></span>
                        </div>
                        <div>
                            <span class="text-white/40 block mb-1">Industry</span>
                            <span class="text-xs bg-white/10 text-white/80 px-2 py-0.5 rounded-full inline-block" x-text="selectedContact.industry || 'Not provided'"></span>
                        </div>
                        <div>
                            <span class="text-white/40 block mb-1">Submitted</span>
                            <span class="text-white/80" x-text="formatDate(selectedContact.submitted_at)"></span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-xs text-white/40 uppercase tracking-wide font-medium mb-2">Message</p>
                        <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-sm text-white/80 leading-relaxed whitespace-pre-wrap" x-text="selectedContact.message"></div>
                    </div>

                    <div>
                        <p class="text-xs text-white/40 uppercase tracking-wide font-medium mt-5 mb-2">Internal Note</p>
                        <textarea rows="3" x-model="selectedContact.admin_note" placeholder="Add a private note..." class="w-full bg-white/5 text-white border border-white/10 rounded-lg px-3 py-2 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/30"></textarea>
                        <button @click="saveNote(selectedContact)" class="mt-2 bg-white text-zinc-900 font-medium text-xs px-4 py-2 rounded-lg hover:bg-zinc-200 transition">Save Note</button>
                    </div>

                    <div class="flex gap-2 mt-5 pt-4 border-t border-white/10">
                        <button @click="window.open('https://mail.google.com/mail/?view=cm&fs=1&to=' + selectedContact.email, '_blank')" class="border border-white/20 text-white/80 text-sm px-3 py-1.5 rounded-lg hover:bg-white/10 hover:text-white transition">Reply via Gmail</button>
                        <button x-show="selectedContact.status !== 'replied'" @click="selectedContact.status = 'replied'; updateStatus(selectedContact.id, 'replied');" class="bg-[#6147bd] text-white text-sm px-3 py-1.5 rounded-lg hover:bg-[#7d56e2] transition">Mark as Replied</button>
                    </div>
                </div>
            </template>
            
            <template x-if="!selectedContact && !isLoading">
                <div class="flex flex-col items-center justify-center h-full text-white/40">
                    <svg class="w-12 h-12 mb-4 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <p>Select a contact to view details.</p>
                </div>
            </template>

        </div>
    </div>
</div>
