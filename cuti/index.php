<?php include '../includes/header.php'; ?>

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
                Cuti Karyawan
            </h2>
            <p class="text-xs text-slate-400 font-medium">
                Informasi pengajuan cuti dan jumlah cuti yang tersedia per bulan
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
                        shadow-2xl shadow-indigo-200 ">

            <div class="relative z-10 lg:flex items-center justify-between">
                <div class="max-w-xl">
                    <span class="inline-block px-4 py-1.5 bg-white/10 
                                 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                        Modul Cuti
                    </span>

                    <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                        Pengajuan Cuti Karyawan
                    </h2>

                    <p class="text-white/90 text-lg mb-8">
                        Setiap karyawan dapat mengajukan cuti maksimal 2 kali dalam satu bulan. Lihat sisa cuti dan ajukan cuti di bawah ini.
                    </p>
                </div>

                <div class="hidden lg:block">
                    <i data-lucide="file-minus" class="text-white/20" size="180"></i>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- INFORMASI CUTI -->
        <!-- ===================== -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">

            <!-- Jumlah Cuti -->
            <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                        shadow-sm hover:shadow-md transition">
                <div class="bg-blue-50 w-14 h-14 rounded-2xl 
                            flex items-center justify-center text-blue-600 mb-6">
                    <i data-lucide="calendar" size="28"></i>
                </div>

                <h3 class="text-lg font-bold text-slate-800">
                    Jumlah Cuti Bulan Ini
                </h3>

                <p class="text-sm text-slate-500 mt-2">
                    Anda telah mengambil <span id="cutiDiambil" class="font-bold">0</span> dari
                    2 cuti yang tersedia bulan ini.
                </p>

                <button id="ajukanCuti" class="mt-6 px-6 py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition">
                    Ajukan Cuti
                </button>
            </div>

            <!-- Status Pengajuan -->
            <div class="bg-white p-8 rounded-[28px] border border-slate-100 
                        shadow-sm hover:shadow-md transition">
                <div class="bg-purple-50 w-14 h-14 rounded-2xl 
                            flex items-center justify-center text-purple-600 mb-6">
                    <i data-lucide="info" size="28"></i>
                </div>

                <h3 class="text-lg font-bold text-slate-800">
                    Status Pengajuan
                </h3>

                <p class="text-sm text-slate-500 mt-2" id="statusCuti">
                    Belum ada pengajuan cuti.
                </p>
            </div>

        </div>

    </main>

    <?php include '../includes/footer.php'; ?>
</div>

<script src="../asset/js/sidebar.js"></script>
<script>
    lucide.createIcons();

    let cutiDiambil = 0;
    const maxCuti = 2;

    const cutiSpan = document.getElementById('cutiDiambil');
    const statusDiv = document.getElementById('statusCuti');
    const ajukanBtn = document.getElementById('ajukanCuti');

    function ajukanCuti() {
        if (cutiDiambil < maxCuti) {
            cutiDiambil++;
            cutiSpan.textContent = cutiDiambil;
            statusDiv.textContent = `Cuti ke-${cutiDiambil} berhasil diajukan.`;
        } else {
            statusDiv.textContent = "Anda telah mencapai batas cuti bulan ini.";
            ajukanBtn.disabled = true;
            ajukanBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    ajukanBtn.addEventListener('click', ajukanCuti);
</script>