<?php // FILE: admin/dashboard.php
$page_title = 'Dashboard';
$active_nav = 'dashboard';
require_once 'includes/layout.php';
?>

<div x-data="{ 
    stats: { published_projects: 0, draft_projects: 0, total_contacts: 0, unread_contacts: 0 },
    recentContacts: [],
    isLoading: true,
    dashError: '',
    async init() {
        await this.loadDashboard();
    },
    async loadDashboard() {
        this.isLoading = true;
        this.dashError = '';
        try {
            const res = await uxpAdminFetch('api/dashboard.php');
            const data = await res.json().catch(() => ({}));
            if (!res.ok || data.error) {
                throw new Error(data.error || 'Request failed');
            }
            if (data.stats) this.stats = data.stats;
            if (data.recent_contacts) this.recentContacts = data.recent_contacts;
        } catch (e) {
            this.dashError = 'Could not load dashboard data. Please try again.';
        } finally {
            this.isLoading = false;
        }
    },
    formatDate(dateStr) {
        if(!dateStr) return '';
        const date = new Date(dateStr);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.round(diffMs / 60000);
        const diffHrs = Math.round(diffMs / 3600000);
        const diffDays = Math.round(diffMs / 86400000);
        
        if (diffMins < 60) return diffMins + ' min ago';
        if (diffHrs < 24) return diffHrs + ' hr' + (diffHrs>1?'s':'') + ' ago';
        if (diffDays === 1) return 'Yesterday';
        if (diffDays < 7) return diffDays + ' days ago';
        
        return date.toLocaleDateString();
    }
}">
    <!-- SECTION 1 — Stat cards -->
    <div x-show="dashError" class="mb-4 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200 flex flex-wrap items-center justify-between gap-2">
        <span x-text="dashError"></span>
        <button type="button" @click="loadDashboard()" class="text-xs font-medium px-3 py-1 rounded-md bg-white/10 hover:bg-white/20 text-white">Retry</button>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Card 1 -->
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div class="w-9 h-9 rounded-lg bg-green-500/20 text-green-400 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                </div>
                <div class="text-2xl font-semibold text-white" x-text="stats.published_projects">0</div>
            </div>
            <div class="text-xs text-white/60 uppercase tracking-wide mt-3">Published Projects</div>
        </div>
        <!-- Card 2 -->
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div class="w-9 h-9 rounded-lg bg-yellow-500/20 text-yellow-400 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </div>
                <div class="text-2xl font-semibold text-white" x-text="stats.draft_projects">0</div>
            </div>
            <div class="text-xs text-white/60 uppercase tracking-wide mt-3">Draft Projects</div>
        </div>
        <!-- Card 3 -->
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div class="w-9 h-9 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <div class="text-2xl font-semibold text-white" x-text="stats.total_contacts">0</div>
            </div>
            <div class="text-xs text-white/60 uppercase tracking-wide mt-3">Total Contacts</div>
        </div>
        <!-- Card 4 -->
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-5">
            <div class="flex items-center justify-between">
                <div class="w-9 h-9 rounded-lg bg-red-500/20 text-red-400 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <div class="text-2xl font-semibold text-white" x-text="stats.unread_contacts">0</div>
            </div>
            <div class="text-xs text-white/60 uppercase tracking-wide mt-3">Unread Contacts</div>
        </div>
    </div>

    <!-- SECTION 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- LEFT -->
        <div class="lg:col-span-2 bg-white/10 backdrop-blur-md border border-white/10 rounded-xl overflow-hidden">
            <div class="px-5 py-4 border-b border-white/10 flex justify-between items-center">
                <h2 class="text-sm font-medium text-white">Recent Enquiries</h2>
                <a href="pages/contacts.php" class="text-xs text-white/50 hover:text-white transition">View all &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left whitespace-nowrap">
                    <thead class="bg-white/5 text-xs text-white/50 uppercase tracking-wide border-b border-white/10">
                        <tr>
                            <th class="px-5 py-3 font-medium">Name</th>
                            <th class="px-5 py-3 font-medium">Email</th>
                            <th class="px-5 py-3 font-medium">Service</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                            <th class="px-5 py-3 font-medium">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10 text-white/80">
                        <tr x-show="isLoading">
                            <td colspan="5" class="px-5 py-6 text-center text-white/40">Loading recent enquiries...</td>
                        </tr>
                        <tr x-show="!isLoading && recentContacts.length === 0" style="display: none;">
                            <td colspan="5" class="px-5 py-6 text-center text-white/40">No recent enquiries found.</td>
                        </tr>
                        <template x-for="contact in recentContacts" :key="contact.id">
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-5 py-3 text-white font-medium" x-text="contact.name"></td>
                                <td class="px-5 py-3 text-white/60" x-text="contact.email"></td>
                                <td class="px-5 py-3 text-white/60" x-text="contact.industry || contact.service_interest || 'General'"></td>
                                <td class="px-5 py-3">
                                    <span x-show="contact.status === 'new'" class="bg-white text-zinc-900 text-xs px-2 py-1 rounded-full font-medium">New</span>
                                    <span x-show="contact.status === 'read'" class="bg-white/20 text-white text-xs px-2 py-1 rounded-full font-medium">Read</span>
                                    <span x-show="contact.status === 'awaiting_reply'" class="bg-yellow-500/30 text-yellow-300 text-xs px-2 py-1 rounded-full font-medium">Awaiting</span>
                                    <span x-show="contact.status === 'replied'" class="bg-green-500/30 text-green-300 text-xs px-2 py-1 rounded-full font-medium">Replied</span>
                                </td>
                                <td class="px-5 py-3 text-white/50 text-xs" x-text="formatDate(contact.submitted_at)"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-5 self-start">
            <h2 class="text-sm font-medium text-white mb-4">Quick Actions</h2>
            <div class="space-y-2">
                <a href="pages/projects.php" class="block w-full text-center bg-white text-zinc-900 font-medium rounded-lg px-4 py-2 text-sm hover:bg-zinc-200 transition">+ Add Project</a>
                <a href="pages/contacts.php" class="block w-full text-center border border-white/20 text-white bg-transparent hover:bg-white/10 rounded-lg px-4 py-2 text-sm transition">View Contacts</a>
                <a href="pages/change-password.php" class="block w-full text-center border border-white/20 text-white bg-transparent hover:bg-white/10 rounded-lg px-4 py-2 text-sm transition">Change Password</a>
                <button class="block w-full text-center border border-white/20 text-white bg-transparent hover:bg-white/10 rounded-lg px-4 py-2 text-sm transition opacity-50 cursor-not-allowed" title="Coming soon">Edit Homepage</button>
            </div>
        </div>
    </div>
</div>