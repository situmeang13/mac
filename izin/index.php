<?php include '../includes/header.php'; ?>

<link rel="stylesheet" href="../assets/css/sidebar.css">

<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col min-h-screen">

    <!-- TOP HEADER -->
    <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-10 sticky top-0 z-40">
        <div>
            <h2 id="page-title" class="text-xl font-bold text-slate-800">Ijin Karyawan</h2>
            <p class="text-xs text-slate-400 font-medium">Informasi pengajuan ijin dan persyaratan dokumen sesuai jenis ijin</p>
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
    <main class="p-10 flex-grow bg-slate-50">

        <!-- HERO SECTION -->
        <section class="relative overflow-hidden bg-gradient-to-br from-purple-700 via-indigo-700 to-blue-800 rounded-[32px] p-16 text-white mb-10 shadow-2xl shadow-indigo-200">
            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between max-w-[1200px] mx-auto">
                <div class="lg:w-2/3">
                    <span class="inline-block px-5 py-2 bg-white/10 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                        Modul Ijin
                    </span>
                    <h2 class="text-5xl font-extrabold mb-6 leading-tight">
                        Pengajuan Ijin
                    </h2>
                    <p class="text-white/90 text-lg mb-8">
                        Pilih jenis ijin: Sakit atau Lainnya. Jika ijin sakit lebih dari 1 hari, upload surat dokter wajib.
                    </p>
                </div>
                <div class="hidden lg:block">
                    <i data-lucide="clipboard" class="text-white/20" size="200"></i>
                </div>
            </div>
        </section>

        <!-- FORM IJIN FULL HERO -->
        <section class="bg-white p-16 rounded-[32px] border border-slate-100 shadow-2xl max-w-[1200px] mx-auto">
            <h3 class="text-3xl font-bold text-slate-800 mb-10 text-center">Ajukan Ijin</h3>
            <form id="formIjin" class="flex flex-col gap-8" enctype="multipart/form-data">

                <label class="text-lg font-medium text-slate-700">
                    Jenis Ijin
                    <select id="jenisIjin" class="border border-slate-300 rounded-[24px] px-6 py-5 mt-3 w-full text-lg">
                        <option value="">-- Pilih Jenis Ijin --</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </label>

                <label class="text-lg font-medium text-slate-700">
                    Alasan Ijin
                    <input type="text" id="alasanIjin" placeholder="Masukkan alasan ijin" class="border border-slate-300 rounded-[24px] px-6 py-5 mt-3 w-full text-lg">
                </label>

                <!-- Upload surat dokter hanya jika ijin sakit dan durasi > 1 -->
                <div id="suratDiv" class="hidden flex flex-col gap-2">
                    <label class="text-lg font-medium text-red-600">Upload Surat Dokter</label>
                    <input type="file" id="suratDokter" class="border border-slate-300 rounded-[24px] px-6 py-3 w-full text-lg" accept=".pdf,.jpg,.png">
                </div>

                <label class="text-lg font-medium text-slate-700">
                    Durasi (hari)
                    <input type="number" id="durasiIjin" min="1" class="border border-slate-300 rounded-[24px] px-6 py-5 mt-3 w-full text-lg">
                </label>

                <button type="submit" class="mt-8 px-10 py-5 bg-green-600 text-white font-bold rounded-[24px] hover:bg-green-700 transition w-full text-lg">
                    Ajukan Ijin
                </button>

            </form>

            <div id="statusIjin" class="mt-8 text-slate-700 font-medium text-center text-lg"></div>
        </section>

    </main>

    <?php include '../includes/footer.php'; ?>
</div>

<script src="../asset/js/sidebar.js"></script>
<script>
    lucide.createIcons();

    const jenisIjin = document.getElementById('jenisIjin');
    const durasi = document.getElementById('durasiIjin');
    const alasan = document.getElementById('alasanIjin');
    const suratDiv = document.getElementById('suratDiv');
    const suratInput = document.getElementById('suratDokter');
    const form = document.getElementById('formIjin');
    const statusDiv = document.getElementById('statusIjin');

    // Cek apakah upload surat muncul
    function checkSurat() {
        if(jenisIjin.value === "Sakit" && parseInt(durasi.value) > 1) {
            suratDiv.classList.remove('hidden');
        } else {
            suratDiv.classList.add('hidden');
            suratInput.value = "";
        }
    }

    jenisIjin.addEventListener('change', checkSurat);
    durasi.addEventListener('input', checkSurat);

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        if(!jenisIjin.value || !alasan.value.trim() || !durasi.value) {
            statusDiv.textContent = "Harap isi semua kolom yang diperlukan.";
            statusDiv.classList.remove('text-green-600');
            statusDiv.classList.add('text-red-600');
            return;
        }

        if(jenisIjin.value === "Sakit" && parseInt(durasi.value) > 1 && !suratInput.files.length) {
            statusDiv.textContent = "Silakan upload surat dokter karena durasi ijin sakit lebih dari 1 hari.";
            statusDiv.classList.remove('text-green-600');
            statusDiv.classList.add('text-red-600');
            return;
        }

        statusDiv.textContent = `Ijin '${alasan.value}' (${jenisIjin.value}) selama ${durasi.value} hari berhasil diajukan.`;
        statusDiv.classList.remove('text-red-600');
        statusDiv.classList.add('text-green-600');

        form.reset();
        suratDiv.classList.add('hidden');
    });
</script>