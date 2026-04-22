<?php include '../includes/header.php'; ?>

<!-- ===================== -->
<!-- LINK CSS SIDEBAR -->
<!-- ===================== -->
<link rel="stylesheet" href="../assets/css/sidebar.css">

<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col">

    <!-- ===================== -->
    <!-- TOP HEADER -->
    <!-- ===================== -->
    <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 
                   flex items-center justify-between px-10 sticky top-0 z-40">

        <div>
            <h2 id="page-title" class="text-xl font-bold text-slate-800">
                Koreksi Intervensi
            </h2>
            <p class="text-xs text-slate-400 font-medium">
                Evaluasi intervensi usulan terapis yang berhasil diterapkan
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

    <!-- ===================== -->
    <!-- MAIN CONTENT -->
    <!-- ===================== -->
    <main class="p-10 flex-grow max-w-[1400px]">

        <!-- ===================== -->
        <!-- HERO SECTION -->
        <!-- ===================== -->
        <div class="relative overflow-hidden bg-gradient-to-br 
                    from-purple-700 via-indigo-700 to-blue-800 
                    rounded-[32px] p-12 text-white mb-10 
                    shadow-2xl shadow-indigo-200">

            <div class="relative z-10 lg:flex items-center justify-between">
                <div class="max-w-xl">
                    <span class="inline-block px-4 py-1.5 bg-white/10 
                                 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                        Modul Koreksi
                    </span>

                    <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                        Intervensi Usulan Terapis
                    </h2>

                    <p class="text-pink-100/90 text-lg mb-8">
                        Menampilkan intervensi yang diusulkan oleh terapis setelah metode sebelumnya
                        tidak dapat diterapkan. Fokus pada solusi yang berhasil membantu anak.
                    </p>
                </div>

                <div class="hidden lg:block">
                    <i data-lucide="check-square" class="text-white/20" size="180"></i>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- KOREKSI CARDS -->
        <!-- ===================== -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

            <!-- INTERVENSI BERHASIL -->
            <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                        shadow-sm hover:shadow-md transition">
                <div class="bg-green-50 w-14 h-14 rounded-2xl 
                            flex items-center justify-center text-green-600 mb-6">
                    <i data-lucide="thumbs-up" size="28"></i>
                </div>

                <h3 class="text-lg font-bold text-slate-800">
                    Intervensi Berhasil
                </h3>

                <p class="text-sm text-slate-500 mt-2">
                    Menampilkan daftar intervensi usulan terapis yang berhasil diterapkan
                    dan memberikan hasil positif pada anak.
                </p>

                <a href="detail_koreksi.php"
                   class="inline-flex items-center mt-6 text-sm font-bold text-green-600">
                    Lihat Detail
                    <i data-lucide="arrow-right" size="16" class="ml-1"></i>
                </a>
            </div>

            <!-- CATATAN TERAPIS -->
            <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                        shadow-sm hover:shadow-md transition">
                <div class="bg-blue-50 w-14 h-14 rounded-2xl 
                            flex items-center justify-center text-blue-600 mb-6">
                    <i data-lucide="file-text" size="28"></i>
                </div>

                <h3 class="text-lg font-bold text-slate-800">
                    Catatan Terapis
                </h3>

                <p class="text-sm text-slate-500 mt-2">
                    Berisi catatan, saran, dan alasan mengapa intervensi usulan diterapkan
                    serta dampak positifnya.
                </p>

                <a href="catatan_terapis.php"
                   class="inline-flex items-center mt-6 text-sm font-bold text-blue-600">
                    Lihat Catatan
                    <i data-lucide="arrow-right" size="16" class="ml-1"></i>
                </a>
            </div>

            <!-- MONITORING & FEEDBACK -->
            <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                        shadow-sm hover:shadow-md transition">
                <div class="bg-purple-50 w-14 h-14 rounded-2xl 
                            flex items-center justify-center text-purple-600 mb-6">
                    <i data-lucide="bar-chart-2" size="28"></i>
                </div>

                <h3 class="text-lg font-bold text-slate-800">
                    Monitoring & Feedback
                </h3>

                <p class="text-sm text-slate-500 mt-2">
                    Menampilkan hasil monitoring setelah intervensi diterapkan
                    serta feedback dari terapis dan pengawas.
                </p>

                <a href="monitoring_feedback.php"
                   class="inline-flex items-center mt-6 text-sm font-bold text-purple-600">
                    Lihat Monitoring
                    <i data-lucide="arrow-right" size="16" class="ml-1"></i>
                </a>
            </div>

        </div>

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