<?php 
session_start();
include '../koneksi/koneksi.php'; 

/*
========================================
1. PROTEKSI HALAMAN
========================================
*/
if (!isset($_SESSION['id_user']) || 
   !in_array($_SESSION['role'], ['orang_tua','bos'])) {

    header("Location: /mac/auth/login/index.php?pesan=belum_login");
    exit;
}

include '../includes/header.php'; 
?>

<style>
/* 1. Perbaikan agar kartu bisa diklik */
.menu-grid-container {
    position: relative;
    z-index: 20;
}

.menu-card {
    display: block !important;
    position: relative;
    z-index: 30;
    cursor: pointer !important;
    text-decoration: none !important;
    background: white;
    padding: 28px;
    border-radius: 24px;
    border: 1px solid #f1f5f9;
    transition: all 0.25s ease;
}

/* Isi tidak ganggu klik */
.menu-card * {
    pointer-events: none;
}

.menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    border-color: #4f46e5;
}

/* 2. FIX SIDEBAR */
.flex-grow.ml-80 {
    margin-left: 20rem;
}

/* 3. ICON */
.icon-box {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

/* 🔥 FIX LAYERING */
header {
    position: relative;
    z-index: 50;
}
</style>

<link rel="stylesheet" href="../assets/css/sidebar.css">
<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col min-h-screen bg-slate-50">

    <header
        class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-10 sticky top-0 z-40">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Asesmen Anak</h2>
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Dashboard Instrumen</p>
        </div>
    </header>

    <main class="p-10 max-w-[1400px] flex-grow relative z-10">

        <div class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-[32px] p-12 text-white mb-12 shadow-xl">
            <h2 class="text-4xl font-extrabold mb-3">Selamat Datang</h2>
            <p class="text-indigo-100">Pilih kategori modul di bawah untuk mulai mengisi instrumen asesmen.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 menu-grid-container">

            <a href="/mac/anak/data_diri/index.php" class="menu-card">
                <div class="icon-box bg-indigo-100 text-indigo-600">
                    <i data-lucide="user"></i>
                </div>
                <h3 class="card-title text-slate-800 font-bold text-lg">Data Diri Anak</h3>
                <p class="card-desc text-slate-500 text-sm mt-2">Informasi dasar mengenai identitas dan kondisi umum
                    anak.</p>
            </a>

            <a href="/mac/anak/riwayat/index.php" class="menu-card">
                <div class="icon-box bg-pink-100 text-pink-600">
                    <i data-lucide="baby"></i>
                </div>
                <h3 class="card-title text-slate-800 font-bold text-lg">Riwayat Kelahiran</h3>
                <p class="card-desc text-slate-500 text-sm mt-2">Riwayat kehamilan dan proses persalinan anak.</p>
            </a>

            <a href="/mac/anak/kesehatan/index.php" class="menu-card">
                <div class="icon-box bg-green-100 text-green-600">
                    <i data-lucide="heart-pulse"></i>
                </div>
                <h3 class="card-title text-slate-800 font-bold text-lg">Kesehatan Anak</h3>
                <p class="card-desc text-slate-500 text-sm mt-2">Informasi kondisi fisik dan kesehatan anak saat ini.
                </p>
            </a>

            <a href="/mac/anak/kondisi/index.php" class="menu-card">
                <div class="icon-box bg-yellow-100 text-yellow-600">
                    <i data-lucide="activity"></i>
                </div>
                <h3 class="card-title text-slate-800 font-bold text-lg">Kondisi Terkini</h3>
                <p class="card-desc text-slate-500 text-sm mt-2">Perilaku, motorik, dan aktivitas harian anak.</p>
            </a>

            <a href="/mac/anak/akademik/index.php" class="menu-card">
                <div class="icon-box bg-blue-100 text-blue-600">
                    <i data-lucide="graduation-cap"></i>
                </div>
                <h3 class="card-title text-slate-800 font-bold text-lg">Kemampuan Akademik</h3>
                <p class="card-desc text-slate-500 text-sm mt-2">Evaluasi kemampuan membaca, menulis, dan berhitung.</p>
            </a>

            <a href="/mac/anak/sensori/index.php" class="menu-card">
                <div class="icon-box bg-purple-100 text-purple-600">
                    <i data-lucide="brain"></i>
                </div>
                <h3 class="card-title text-slate-800 font-bold text-lg">Sensori Halus</h3>
                <p class="card-desc text-slate-500 text-sm mt-2">
                    Evaluasi respon sensorik anak terhadap suara, sentuhan, cahaya, dan lingkungan sekitar.
                </p>
            </a>

        </div>
    </main>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
lucide.createIcons();
</script>