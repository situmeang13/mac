<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$role = $_SESSION['role'] ?? '';
?>

<aside class="w-80 sidebar-gradient border-r border-slate-200 flex flex-col fixed h-full z-50">

    <!-- LOGO AREA -->
    <div class="p-6 bg-gray-50 border-b border-gray-200">
        <div class="flex items-center gap-4">
            <div class="bg-white p-2 rounded-xl shadow-lg">
                <img src="/mac/assets/logo/mac.png" class="w-14 h-14 object-contain">
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800">MACSmart</h1>
                <p class="text-sm text-slate-500">Malang Autism Center</p>
            </div>
        </div>
    </div>

    <!-- NAVIGATION -->
    <nav class="flex-grow px-6 overflow-y-auto">

        <!-- ===================== -->
        <!-- MENU UTAMA -->
        <!-- ===================== -->
        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest px-4 mb-3">
            Menu Utama
        </p>

        <div class="space-y-1">

            <?php if ($role == 'bos'): ?>
            <!-- BOS -->
            <a href="/mac/beranda/index.php" class="sidebar-link">
                <i data-lucide="home" class="w-5 h-5"></i>
                <span>Beranda</span>
            </a>
            <?php endif; ?>

            <!-- BERANDA ANAK (BOS & ORANG TUA) -->
            <?php if ($role == 'bos' || $role == 'orang_tua'): ?>
            <a href="/mac/beranda_anak/index.php" class="sidebar-link">
                <i data-lucide="home" class="w-5 h-5"></i>
                <span>Beranda Anak</span>
            </a>
            <?php endif; ?>

            <?php if ($role == 'bos'): ?>
            <a href="/mac/asesmen/index.php" class="sidebar-link">
                <i data-lucide="clipboard-check" class="w-5 h-5"></i>
                <span>Asesmen</span>
            </a>

            <a href="/mac/intervensi/index.php" class="sidebar-link">
                <i data-lucide="puzzle" class="w-5 h-5"></i>
                <span>Intervensi Program</span>
            </a>

            <a href="/mac/evaluasi/index.php" class="sidebar-link">
                <i data-lucide="bar-chart-big" class="w-5 h-5"></i>
                <span>Evaluasi Aktivitas</span>
            </a>

            <a href="/mac/koreksi/index.php" class="sidebar-link">
                <i data-lucide="file-warning" class="w-5 h-5"></i>
                <span>Koreksi Aktivitas</span>
            </a>
            <?php endif; ?>

        </div>

        <!-- ===================== -->
        <!-- MANAJEMEN -->
        <!-- ===================== -->
        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest px-4 mt-6 mb-3">
            Manajemen Operasional
        </p>

        <div class="space-y-1">

            <!-- ORANG TUA & BOS -->
            <?php if ($role == 'bos' || $role == 'orang_tua'): ?>
            <a href="/mac/orang_tua/index.php" class="sidebar-link">
                <i data-lucide="user-check" class="w-5 h-5"></i>
                <span>Data Orang Tua</span>
            </a>

            <a href="/mac/anak/index.php" class="sidebar-link">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span>Data Siswa</span>
            </a>
            <?php endif; ?>

            <!-- KHUSUS BOS -->
            <?php if ($role == 'bos'): ?>
            <a href="/mac/karyawan/index.php" class="sidebar-link">
                <i data-lucide="briefcase" class="w-5 h-5"></i>
                <span>Data Karyawan</span>
            </a>
            <?php endif; ?>

        </div>

        <!-- ===================== -->
        <!-- AKSES AKUN -->
        <!-- ===================== -->
        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest px-4 mt-6 mb-3">
            Akses Akun
        </p>

        <div class="space-y-1">

            <a href="/mac/auth/login/index.php" class="sidebar-link">
                <i data-lucide="log-in" class="w-5 h-5"></i>
                <span>Login</span>
            </a>

            <?php if ($role == 'bos'): ?>
            <a href="/mac/auth/register/index.php" class="sidebar-link">
                <i data-lucide="user-plus" class="w-5 h-5"></i>
                <span>Register</span>
            </a>
            <?php endif; ?>

            <a href="/mac/lupa_password/index.php" class="sidebar-link">
                <i data-lucide="key-round" class="w-5 h-5"></i>
                <span>Lupa Password</span>
            </a>

        </div>

    </nav>

    <!-- PROFILE -->
    <div class="m-6 p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-slate-100 flex items-center justify-center text-blue-600 font-bold">
                <?= strtoupper(substr($_SESSION['nama_user'] ?? 'U', 0, 1)) ?>
            </div>

            <div class="flex-1">
                <p class="text-sm font-bold text-slate-800">
                    <?= htmlspecialchars($_SESSION['nama_user'] ?? 'User') ?>
                </p>
                <p class="text-[10px] text-slate-500">
                    <?= strtoupper($role) ?>
                </p>
            </div>

            <a href="/mac/auth/login/logout.php" class="text-slate-400 hover:text-red-500">
                <i data-lucide="log-out" class="w-5 h-5"></i>
            </a>
        </div>
    </div>

</aside>