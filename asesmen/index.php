<?php include '../includes/header.php'; ?>

<!-- ===================== -->
<!-- LINK CSS SIDEBAR -->
<!-- ===================== -->
<link rel="stylesheet" href="../assets/css/sidebar.css">

<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col">

    <!-- TOP HEADER -->
    <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 
                   flex items-center justify-between px-10 sticky top-0 z-40">

        <div>
            <h2 id="page-title" class="text-xl font-bold text-slate-800">
                Asesmen
            </h2>
            <p class="text-xs text-slate-400 font-medium">
                Pengelolaan dan perencanaan asesmen anak
            </p>
        </div>

        <div class="flex items-center gap-5">
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

        <!-- ===================== -->
        <!-- SECTION: ASESMENT -->
        <!-- ===================== -->
        <section id="asesmen" class="content-section active">

           <!-- HERO -->
            <div class="relative overflow-hidden bg-gradient-to-br 
                        from-purple-700 via-indigo-700 to-blue-800 
                        rounded-[32px] p-12 text-white mb-10 
                        shadow-2xl shadow-indigo-200 ">

                <div class="relative z-10 lg:flex items-center justify-between">
                    <div class="max-w-xl">
                        <span class="inline-block px-4 py-1.5 bg-white/10 
                                     rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                            Modul Asesmen
                        </span>

                        <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                            Kelola Asesmen Anak
                        </h2>

                        <p class="text-indigo-100/90 text-lg mb-8">
                            Asesmen terstruktur sebagai dasar perencanaan program intervensi anak.
                        </p>
                    </div>

                    <div class="hidden lg:block">
                        <i data-lucide="clipboard-check" class="text-white/20" size="180"></i>
                    </div>
                </div>
            </div>

            <!-- CARD GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                <!-- ASESMENT AWAL -->
                <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                            shadow-sm hover:shadow-md transition">
                    <div class="bg-blue-50 w-14 h-14 rounded-2xl 
                                flex items-center justify-center text-blue-600 mb-6">
                        <i data-lucide="clipboard-list" size="28"></i>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Asesmen Awal
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Pencatatan kondisi awal anak sebagai dasar observasi dan evaluasi.
                    </p>

                    <a href="asesmen_awal/laporan_asesmen.php" class="inline-flex items-center mt-6 
                                      text-sm font-bold text-blue-600">
                        Masuk Modul
                        <i data-lucide="arrow-right" size="16" class="ml-1"></i>
                    </a>
                </div>

                <!-- INTERVENSI UJI COBA -->
                <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                            shadow-sm hover:shadow-md transition">
                    <div class="bg-indigo-50 w-14 h-14 rounded-2xl 
                                flex items-center justify-center text-indigo-600 mb-6">
                        <i data-lucide="brain-circuit" size="28"></i>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Intervensi (Uji Coba)
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Pelaksanaan intervensi awal yang sedang diuji coba untuk menilai efektivitas metode sebelum ditetapkan menjadi program intervensi.
                    </p>

                    <a href="uji_coba/uji_coba.php" class="inline-flex items-center mt-6 
                                      text-sm font-bold text-indigo-600">
                        Masuk Modul
                        <i data-lucide="arrow-right" size="16" class="ml-1"></i>
                    </a>
                </div>

                <!-- LAPORAN HASIL INTERVENSI (UJI COBA) -->
<div class="bg-white p-8 rounded-[28px] border border-slate-100 
            shadow-sm hover:shadow-md transition">

    <div class="bg-emerald-50 w-14 h-14 rounded-2xl 
                flex items-center justify-center text-emerald-600 mb-6">
        <i data-lucide="file-bar-chart-2" size="28"></i>
    </div>

    <h3 class="text-lg font-bold text-slate-800">
        Laporan Hasil Intervensi Uji Coba

    <p class="text-sm text-slate-500 mt-2">
        Dokumentasi dan evaluasi hasil intervensi uji coba untuk menilai
        efektivitas metode sebelum ditetapkan sebagai program intervensi tetap.
    </p>

    <a href="../laporan/intervensi_uji_coba.php"
       class="inline-flex items-center mt-6 
              text-sm font-bold text-emerald-600">
        Lihat Laporan
        <i data-lucide="arrow-right" size="16" class="ml-1"></i>
    </a>
</div>
            </div>

        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>

<!-- ===================== -->
<!-- JAVASCRIPT -->
<!-- ===================== -->
<script src="../asset/js/sidebar.js"></script>

<script>
    lucide.createIcons();
</script>