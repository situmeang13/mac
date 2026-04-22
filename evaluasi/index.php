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
                Evaluasi Intervensi
            </h2>
            <p class="text-xs text-slate-400 font-medium">
                Analisis penerapan dan ketidaksesuaian program intervensi
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
        <!-- SECTION: EVALUASI -->
        <!-- ===================== -->
        <section id="evaluasi" class="content-section active">

             <!-- HERO -->
            <div class="relative overflow-hidden bg-gradient-to-br 
                        from-purple-700 via-indigo-700 to-blue-800 
                        rounded-[32px] p-12 text-white mb-10 
                        shadow-2xl shadow-indigo-200">

                <div class="relative z-10 lg:flex items-center justify-between">
                    <div class="max-w-xl">
                        <span class="inline-block px-4 py-1.5 bg-white/10 
                                     rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                            Modul Evaluasi
                        </span>

                        <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                            Evaluasi Intervensi Anak
                        </h2>

                        <p class="text-pink-100/90 text-lg mb-8">
                            Mengidentifikasi bagian intervensi yang tidak dapat diterapkan,
                            tidak sesuai, atau terhambat oleh faktor tertentu.
                        </p>
                    </div>

                    <div class="hidden lg:block">
                        <i data-lucide="clipboard-check" class="text-white/20" size="180"></i>
                    </div>
                </div>
            </div>

            <!-- ===================== -->
            <!-- EVALUASI CARDS -->
            <!-- ===================== -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                <!-- TIDAK DAPAT DITERAPKAN -->
                <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                            shadow-sm hover:shadow-md transition">
                    <div class="bg-rose-50 w-14 h-14 rounded-2xl 
                                flex items-center justify-center text-rose-600 mb-6">
                        <i data-lucide="x-circle" size="28"></i>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Tidak Dapat Diterapkan
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Evaluasi intervensi yang gagal diterapkan karena kondisi anak,
                        lingkungan, atau keterbatasan tertentu.
                    </p>

                    <a href="evaluasi_tidak_diterapkan.php"
                       class="inline-flex items-center mt-6 text-sm font-bold text-rose-600">
                        Mulai Evaluasi
                        <i data-lucide="arrow-right" size="16" class="ml-1"></i>
                    </a>
                </div>

                <!-- TIDAK SESUAI -->
                <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                            shadow-sm hover:shadow-md transition">
                    <div class="bg-amber-50 w-14 h-14 rounded-2xl 
                                flex items-center justify-center text-amber-600 mb-6">
                        <i data-lucide="alert-triangle" size="28"></i>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Ketidaksesuaian Metode
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Menilai metode intervensi yang tidak cocok dengan karakteristik
                        dan kebutuhan anak.
                    </p>

                    <a href="evaluasi_ketidaksesuaian.php"
                       class="inline-flex items-center mt-6 text-sm font-bold text-amber-600">
                        Lihat Detail
                        <i data-lucide="arrow-right" size="16" class="ml-1"></i>
                    </a>
                </div>

                <!-- FAKTOR PENGHAMBAT -->
                <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                            shadow-sm hover:shadow-md transition">
                    <div class="bg-indigo-50 w-14 h-14 rounded-2xl 
                                flex items-center justify-center text-indigo-600 mb-6">
                        <i data-lucide="sliders" size="28"></i>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Faktor keberhasilan dan faktor penghambat
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Analisis faktor sensorik, emosi, keluarga, dan lingkungan
                        yang mempengaruhi efektivitas intervensi.
                    </p>

                    <a href="faktor_penghambat.php"
                       class="inline-flex items-center mt-6 text-sm font-bold text-indigo-600">
                        Analisis Faktor
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