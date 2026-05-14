<?php // FILE: admin/index.php
require_once __DIR__ . '/includes/auth.php';

if (adminIsAuthenticated()) {
    header('Location: ' . adminUrl('dashboard.php'));
    exit;
}

$loginError = '';
$emailValue = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf = $_POST['csrf_token'] ?? '';
    $emailValue = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if (!adminValidateCsrf($csrf)) {
        $loginError = 'Security token mismatch. Please refresh and try again.';
    } else {
        $result = adminAttemptLogin($emailValue, $password);
        if (!($result['success'] ?? false)) {
            $loginError = $result['error'] ?? 'Login failed.';
        } else {
            header('Location: ' . adminUrl('dashboard.php'));
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — UX Pacific Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/admin.css">
</head>
<body class="h-full bg-gradient-to-br from-[#111111] via-[#1a1133] to-[#6147bd] flex items-center justify-center font-sans">
    <div class="bg-[#111111]/40 backdrop-blur-md border border-white/10 rounded-2xl shadow-2xl p-10 w-full max-w-md mx-4">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white">UX Pacific</h1>
            <p class="text-sm text-white/50 mt-1">Admin Panel</p>
        </div>
        
        <form class="space-y-5" method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(adminCsrfToken()) ?>">
            <div>
                <label class="block text-sm font-medium text-white/80 mb-1.5">Email address</label>
                <input name="email" type="email" placeholder="admin@uxpacific.com" required class="w-full bg-white/5 border border-white/10 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6147bd] placeholder-white/20" value="<?= htmlspecialchars($emailValue) ?>">
            </div>
            
            <div x-data="{ show: false }">
                <label class="block text-sm font-medium text-white/80 mb-1.5">Password</label>
                <div class="relative">
                    <input name="password" :type="show ? 'text' : 'password'" required class="w-full bg-white/5 border border-white/10 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6147bd] pr-10 placeholder-white/20">
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white/40 hover:text-white transition-colors">
                        <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
            </div>

            <?php if ($loginError !== ''): ?>
                <div class="bg-red-500/20 border border-red-500/30 text-red-300 text-sm rounded-lg px-4 py-3">
                    <?= htmlspecialchars($loginError) ?>
                </div>
            <?php endif; ?>
            
            <button type="submit" class="w-full bg-white text-zinc-900 rounded-lg py-2.5 text-sm font-semibold hover:bg-zinc-200 transition-colors">
                Sign in
            </button>
        </form>
        
        <p class="text-center text-xs text-white/30 mt-6">
            Secured admin access — uxpacific.com
        </p>
    </div>
</body>
</html>
