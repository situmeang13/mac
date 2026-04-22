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
                Intervensi Program
            </h2>
            <p class="text-xs text-slate-400 font-medium">
                Perencanaan dan pelaksanaan program intervensi anak
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
        <!-- SECTION: INTERVENSI -->
        <!-- ===================== -->
        <section id="intervensi" class="content-section active">

            <!-- HERO -->
            <div class="relative overflow-hidden bg-gradient-to-br 
                        from-purple-700 via-indigo-700 to-blue-800 
                        rounded-[32px] p-12 text-white mb-10 
                        shadow-2xl shadow-indigo-200">

                <div class="relative z-10 lg:flex items-center justify-between">
                    <div class="max-w-xl">
                        <span class="inline-block px-4 py-1.5 bg-white/10 
                                     rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                            Modul Intervensi
                        </span>

                        <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                            Program Intervensi Anak
                        </h2>

                        <p class="text-indigo-100/90 text-lg mb-8">
                            Menyusun, menjalankan, dan memantau intervensi berdasarkan hasil asesmen.
                        </p>
                    </div>

                    <div class="hidden lg:block">
                        <i data-lucide="layers" class="text-white/20" size="180"></i>
                    </div>
                </div>
            </div>

            <!-- INTERVENSI CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                <!-- INTERVENSI AKTIF -->
                <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                            shadow-sm hover:shadow-md transition">
                    <div class="bg-blue-50 w-14 h-14 rounded-2xl 
                                flex items-center justify-center text-blue-600 mb-6">
                        <i data-lucide="play-circle" size="28"></i>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Intervensi Usulan
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Program intervensi yang sedang berjalan dan dipantau secara rutin.
                    </p>

                    <a href="#" class="inline-flex items-center mt-6 
                                      text-sm font-bold text-blue-600">
                        Lihat Program
                        <i data-lucide="arrow-right" size="16" class="ml-1"></i>
                    </a>
                </div>

                <!-- RIWAYAT INTERVENSI -->
                <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                            shadow-sm hover:shadow-md transition">
                    <div class="bg-emerald-50 w-14 h-14 rounded-2xl 
                                flex items-center justify-center text-emerald-600 mb-6">
                        <i data-lucide="history" size="28"></i>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Riwayat Intervensi
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Arsip program intervensi yang telah diselesaikan sebelumnya.
                    </p>

                    <a href="#" class="inline-flex items-center mt-6 
                                      text-sm font-bold text-emerald-600">
                        Lihat Riwayat
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