<?php // FILE: admin/pages/change-password.php
$page_title = 'Change Password';
$active_nav = 'account';
require_once '../includes/layout.php';

$adminEmail = htmlspecialchars((string) ($_SESSION['admin_user']['email'] ?? ''));
?>

<div
    x-data="{
        currentPassword: '',
        newPassword: '',
        confirmPassword: '',
        isSaving: false,
        formError: '',
        formSuccess: '',
        async submitForm() {
            this.formError = '';
            this.formSuccess = '';

            if (!this.currentPassword || !this.newPassword || !this.confirmPassword) {
                this.formError = 'All fields are required.';
                return;
            }
            if (this.newPassword !== this.confirmPassword) {
                this.formError = 'New password and confirmation do not match.';
                return;
            }
            if (this.newPassword.length < 8) {
                this.formError = 'New password must be at least 8 characters.';
                return;
            }

            this.isSaving = true;
            try {
                const res = await uxpAdminFetch('../api/account.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        action: 'change_password',
                        current_password: this.currentPassword,
                        new_password: this.newPassword,
                        confirm_password: this.confirmPassword
                    })
                });
                const data = await res.json().catch(() => ({}));
                if (!res.ok || data.error) {
                    throw new Error(data.error || 'Request failed');
                }
                this.formSuccess = data.message || 'Password updated successfully.';
                this.currentPassword = '';
                this.newPassword = '';
                this.confirmPassword = '';
            } catch (e) {
                this.formError = e.message || 'Could not update password.';
            } finally {
                this.isSaving = false;
            }
        }
    }"
    class="max-w-lg"
>
    <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-6">
        <p class="text-sm text-white/60 mb-6">
            Signed in as <span class="text-white/90 font-medium"><?= $adminEmail ?></span>.
            Enter your current password, then choose a new one.
        </p>

        <form @submit.prevent="submitForm()" class="space-y-5">
            <div x-data="{ show: false }">
                <label class="block text-sm font-medium text-white/80 mb-1.5">Current password</label>
                <div class="relative">
                    <input
                        :type="show ? 'text' : 'password'"
                        x-model="currentPassword"
                        autocomplete="current-password"
                        required
                        class="w-full bg-white/5 border border-white/10 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6147bd] pr-10"
                    >
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white/40 hover:text-white transition-colors" tabindex="-1">
                        <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                </div>
            </div>

            <div x-data="{ show: false }">
                <label class="block text-sm font-medium text-white/80 mb-1.5">New password</label>
                <div class="relative">
                    <input
                        :type="show ? 'text' : 'password'"
                        x-model="newPassword"
                        autocomplete="new-password"
                        required
                        minlength="8"
                        class="w-full bg-white/5 border border-white/10 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6147bd] pr-10"
                    >
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white/40 hover:text-white transition-colors" tabindex="-1">
                        <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                </div>
                <p class="text-xs text-white/40 mt-1">Minimum 8 characters.</p>
            </div>

            <div x-data="{ show: false }">
                <label class="block text-sm font-medium text-white/80 mb-1.5">Confirm new password</label>
                <div class="relative">
                    <input
                        :type="show ? 'text' : 'password'"
                        x-model="confirmPassword"
                        autocomplete="new-password"
                        required
                        minlength="8"
                        class="w-full bg-white/5 border border-white/10 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6147bd] pr-10"
                    >
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white/40 hover:text-white transition-colors" tabindex="-1">
                        <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                </div>
            </div>

            <div x-show="formError" x-cloak class="bg-red-500/20 border border-red-500/30 text-red-300 text-sm rounded-lg px-4 py-3" x-text="formError"></div>
            <div x-show="formSuccess" x-cloak class="bg-green-500/20 border border-green-500/30 text-green-300 text-sm rounded-lg px-4 py-3" x-text="formSuccess"></div>

            <div class="flex items-center gap-3 pt-2">
                <button
                    type="submit"
                    :disabled="isSaving"
                    class="bg-white text-zinc-900 font-medium rounded-lg px-5 py-2 text-sm hover:bg-zinc-200 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    x-text="isSaving ? 'Saving…' : 'Update password'"
                ></button>
                <a href="../dashboard.php" class="text-sm text-white/50 hover:text-white transition-colors">Back to dashboard</a>
            </div>
        </form>
    </div>
</div>
