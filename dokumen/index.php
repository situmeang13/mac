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
                Dokumen Penting
            </h2>
            <p class="text-xs text-slate-400 font-medium">
                Akses berbagai jenis dokumen termasuk SOP, panduan, dan dokumen lainnya
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
        <!-- HERO -->
            <div class="relative overflow-hidden bg-gradient-to-br 
                        from-purple-700 via-indigo-700 to-blue-800 
                        rounded-[32px] p-12 text-white mb-10 
                        shadow-2xl shadow-indigo-200 ">

            <div class="relative z-10 lg:flex items-center justify-between">
                <div class="max-w-xl">
                    <span class="inline-block px-4 py-1.5 bg-white/10 
                                 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                        Modul Dokumen
                    </span>

                    <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                        Kumpulan Dokumen Malang Autism Center
                    </h2>

                    <p class="text-white/90 text-lg mb-8">
                        Cari dan akses dokumen penting seperti SOP, panduan, laporan, dan dokumen lainnya.
                    </p>
                </div>

                <div class="hidden lg:block">
                    <i data-lucide="file-text" class="text-white/20" size="180"></i>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- FILTER & SEARCH -->
        <!-- ===================== -->
        <div class="flex flex-col md:flex-row gap-4 mb-8 items-center">

            <!-- Dropdown Kategori -->
            <select id="kategoriDokumen" class="border border-slate-300 rounded-xl px-4 py-2 text-slate-700">
                <option value="">-- Semua Kategori --</option>
                <option value="SOP">SOP</option>
                <option value="Panduan">Panduan</option>
                <option value="Laporan">Laporan</option>
                <option value="Formulir">Formulir</option>
                <option value="Dokumen Lainnya">Dokumen Lainnya</option>
            </select>

            <!-- Search Bar -->
            <input type="text" id="searchDokumen" placeholder="Cari dokumen..."
                   class="border border-slate-300 rounded-xl px-4 py-2 flex-1">

        </div>

        <!-- ===================== -->
        <!-- TABLE DOKUMEN -->
        <!-- ===================== -->
        <div class="overflow-x-auto bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">
            <table class="min-w-full divide-y divide-slate-200" id="tabelDokumen">
                <thead>
                    <tr class="text-left text-slate-700">
                        <th class="px-6 py-3 font-bold text-sm">Nama Dokumen</th>
                        <th class="px-6 py-3 font-bold text-sm">Kategori</th>
                        <th class="px-6 py-3 font-bold text-sm">Tanggal</th>
                        <th class="px-6 py-3 font-bold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <!-- Contoh data, bisa digenerate dari database -->
                    <tr>
                        <td class="px-6 py-4">Panduan Pelayanan Anak</td>
                        <td class="px-6 py-4">Panduan</td>
                        <td class="px-6 py-4">2026-01-15</td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-teal-600 font-bold hover:underline">Lihat</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4">SOP Pelayanan Ibadah Minggu</td>
                        <td class="px-6 py-4">SOP</td>
                        <td class="px-6 py-4">2025-12-10</td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-teal-600 font-bold hover:underline">Lihat</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4">Formulir Pendaftaran Jemaat Baru</td>
                        <td class="px-6 py-4">Formulir</td>
                        <td class="px-6 py-4">2025-11-01</td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-teal-600 font-bold hover:underline">Lihat</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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

    // =====================
    // FILTER & SEARCH
    // =====================
    const searchInput = document.getElementById('searchDokumen');
    const kategoriSelect = document.getElementById('kategoriDokumen');
    const table = document.getElementById('tabelDokumen');
    const tbody = table.tBodies[0];

    function filterDokumen() {
        const search = searchInput.value.toLowerCase();
        const kategori = kategoriSelect.value;

        Array.from(tbody.rows).forEach(row => {
            const nama = row.cells[0].textContent.toLowerCase();
            const cat = row.cells[1].textContent;
            const matchSearch = nama.includes(search);
            const matchKategori = kategori === "" || cat === kategori;
            row.style.display = (matchSearch && matchKategori) ? "" : "none";
        });
    }

    searchInput.addEventListener('input', filterDokumen);
    kategoriSelect.addEventListener('change', filterDokumen);
</script>