<?php include '../includes/header.php'; ?>

<!-- ===================== -->
<!-- LINK CSS SIDEBAR -->
<!-- ===================== -->
<link rel="stylesheet" href="../assets/css/sidebar.css">

<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col">

    <!-- TOP HEADER -->
    <header
        class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-10 sticky top-0 z-40">
        <div>
            <h2 id="page-title" class="text-xl font-bold text-slate-800">Beranda</h2>
            <p class="text-xs text-slate-400 font-medium" id="current-date"></p>
        </div>

        <div class="flex items-center gap-5">
            <!-- TOGGLE SIDEBAR (MOBILE) -->
            <button id="sidebarToggle"
                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-blue-600 text-white">
                ☰
            </button>

            <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400">
                <i data-lucide="search" size="20"></i>
            </button>

            <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 relative">
                <i data-lucide="bell" size="20"></i>
                <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full"></span>
            </button>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="p-10 flex-grow max-w-[1400px]">

        <!-- SECTION: BERANDA -->
        <section id="beranda" class="content-section active">

            <!-- HERO -->
            <div class="relative overflow-hidden bg-gradient-to-br 
            from-purple-700 via-indigo-700 to-blue-800 
            rounded-[32px] p-12 text-white mb-10 
            shadow-2xl shadow-indigo-200">
                <div class="relative z-10 lg:flex items-center justify-between">
                    <div class="max-w-xl">
                        <span
                            class="inline-block px-4 py-1.5 bg-white/10 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                            Smart Dashboard v2.0
                        </span>
                        <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                            Halo, Selamat Datang di MACSmart.
                        </h2>
                        <p class="text-blue-100/80 text-lg mb-8">
                            Kelola program intervensi dan pantau perkembangan anak dengan sistem yang lebih cerdas dan
                            terukur.
                        </p>
                        <div class="flex gap-4">
                            <a href="asesmen.php" class="bg-white text-blue-900 px-8 py-4 rounded-2xl font-bold">
                                Mulai Asesmen
                            </a>
                            <button class="bg-blue-600/30 border border-white/20 px-8 py-4 rounded-2xl font-bold">
                                Lihat Statistik
                            </button>
                        </div>
                    </div>

                    <div class="hidden lg:block">
                        <i data-lucide="sparkles" class="text-white/20" size="180"></i>
                    </div>
                </div>
            </div>

        </section>

    </main>

    <?php include '../includes/footer.php'; ?>
</div>

<!-- ===================== -->
<!-- LINK JAVASCRIPT SIDEBAR -->
<!-- ===================== -->
<script src="../asset/js/sidebar.js"></script>

<!-- LUCIDE ICON -->
<script>
lucide.createIcons();
</script>