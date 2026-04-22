<?php include '../../../../includes/header.php'; ?>
<link rel="stylesheet" href="../../../../assets/css/sidebar.css">
<?php include '../../../../includes/sidebar.php'; ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    .sikat-gigi-body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .week-input {
        width: 100%;
        min-width: 140px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px;
        font-size: 12px;
        transition: all 0.2s;
        height: 70px;
        resize: none;
    }

    .week-input:focus {
        border-color: #0ea5e9; /* Sky Blue */
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        outline: none;
    }

    .current-condition-chip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 20px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 24px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 70px;
    }

    .condition-empty { background: #f1f5f9; color: #94a3b8; }
    .condition-active { 
        background: #0ea5e9; 
        color: white; 
        box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.3); 
    }
    
    .table-container::-webkit-scrollbar {
        height: 8px;
    }
    .table-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .sticky-condition {
        vertical-align: top;
        padding-top: 1.5rem !important;
        text-align: center;
        border-left: 2px solid #f8fafc;
        background-color: #fafafa;
    }
</style>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen sikat-gigi-body">

    <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-10 sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <div class="p-2 bg-sky-50 rounded-xl">
                <i data-lucide="sparkles" class="text-sky-600 w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Sikat Gigi</h2>
                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Self-Care Training</p>
            </div>
        </div>
    </header>

    <main class="p-8 lg:p-12 flex-grow max-w-[1600px] mx-auto w-full">
        <!-- Hero Section -->
        <section class="mb-10">
            <div class="relative overflow-hidden bg-gradient-to-br from-sky-500 to-blue-600 rounded-[2.5rem] p-10 text-white shadow-xl shadow-sky-200">
                <div class="relative z-10">
                    <h1 class="text-4xl font-black mb-3">Sikat Gigi – Kemandirian</h1>
                    <p class="text-sky-50 max-w-2xl text-lg">
                        Penilaian langkah-langkah kemandirian anak dalam menjaga kebersihan gigi dan mulut. Pantau perkembangan deskripsi M1-M5 secara berkala.
                    </p>
                </div>
                <i data-lucide="smile" class="absolute right-[-20px] bottom-[-20px] w-64 h-64 text-white/10 rotate-12"></i>
            </div>
        </section>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
            <form class="p-10" id="sikatGigiForm">
                <div class="table-container overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-600 border-b border-slate-200">
                                <th class="p-4 text-left font-bold uppercase tracking-wider">Langkah Sikat Gigi</th>
                                <th class="p-4 text-center font-bold">Score</th>
                                <th class="p-4 text-left font-bold">Prompt</th>
                                <th class="p-4 text-center font-bold">M1</th>
                                <th class="p-4 text-center font-bold">M2</th>
                                <th class="p-4 text-center font-bold">M3</th>
                                <th class="p-4 text-center font-bold">M4</th>
                                <th class="p-4 text-center font-bold">M5</th>
                                <th class="p-4 text-left font-bold">Status</th>
                                <th class="p-4 text-center font-bold">Current Condition</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php
                            $aspek_sikat_gigi = [
                                "Mengambil sikat gigi",
                                "Mengambil pasta gigi",
                                "Membuka tutup pasta gigi",
                                "Menekan pasta gigi sesuai kebutuhan",
                                "Menutup pasta gigi",
                                "Mengembalikan pasta gigi",
                                "Berkumur sebelum sikat gigi",
                                "Melepeh air",
                                "Menggosok gigi bagian depan",
                                "Menggosok gigi samping kiri (luar)",
                                "Menggosok gigi samping kanan (luar)",
                                "Menggosok gigi samping kanan atas (dalam)",
                                "Menggosok gigi samping kanan bawah (dalam)",
                                "Menggosok gigi samping kiri atas (dalam)",
                                "Menggosok gigi samping kiri bawah (dalam)",
                                "Melepeh residu pasta gigi",
                                "Berkumur sampai bersih",
                                "Melepeh air",
                                "Mencuci sikat gigi",
                                "Meletakkan sikat gigi ditempatnya"
                            ];
                            $total_rows = count($aspek_sikat_gigi);

                            foreach($aspek_sikat_gigi as $index => $a):
                            ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-4 font-semibold text-slate-700 whitespace-nowrap"><?= $a ?></td>
                                <td class="p-4 text-center">
                                    <input type="checkbox" name="score_sikat_gigi[]" 
                                           class="row-checkbox w-6 h-6 rounded-lg text-sky-600 focus:ring-sky-500 border-slate-300 cursor-pointer">
                                </td>
                                <td class="p-4">
                                    <select class="bg-white border border-slate-200 rounded-lg p-2 text-xs font-medium outline-none w-28 focus:ring-2 focus:ring-sky-500">
                                        <option>No Prompt</option>
                                        <option>P. Verbal</option>
                                        <option>P. Fisik</option>
                                        <option>P. Ringan</option>
                                    </select>
                                </td>
                                <td class="p-2"><textarea class="week-input" placeholder="Deskripsi M1..."></textarea></td>
                                <td class="p-2"><textarea class="week-input" placeholder="Deskripsi M2..."></textarea></td>
                                <td class="p-2"><textarea class="week-input" placeholder="Deskripsi M3..."></textarea></td>
                                <td class="p-2"><textarea class="week-input" placeholder="Deskripsi M4..."></textarea></td>
                                <td class="p-2"><textarea class="week-input" placeholder="Deskripsi M5..."></textarea></td>
                                <td class="p-4">
                                    <select class="bg-slate-100 border-none rounded-lg p-2 text-xs font-bold text-slate-700 outline-none w-32">
                                        <option>In Progress</option>
                                        <option>Maintain</option>
                                        <option>Achieve</option>
                                        <option>Not At All</option>
                                    </select>
                                </td>
                                
                                <?php if ($index === 0): ?>
                                <td class="p-4 text-center sticky-condition" rowspan="<?= $total_rows ?>">
                                    <div class="flex flex-col items-center gap-3">
                                        <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest leading-tight">Total<br>Mandiri</span>
                                        <div id="totalConditionSikatGigi" class="current-condition-chip condition-empty">0</div>
                                    </div>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Catatan Akhir -->
                <div class="mt-12">
                    <div class="flex items-center gap-2 mb-4 text-slate-800">
                        <i data-lucide="clipboard-list" class="w-5 h-5 text-sky-600"></i>
                        <label class="font-bold text-lg">Catatan Tambahan (Sikat Gigi)</label>
                    </div>
                    <textarea class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-6 min-h-[120px] focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all"
                              placeholder="Tuliskan catatan khusus atau kendala saat proses menyikat gigi..."></textarea>
                </div>

                <div class="flex justify-end mt-12 gap-4">
                    <button type="button" class="px-8 py-4 bg-slate-200 text-slate-700 rounded-2xl font-bold hover:bg-slate-300 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-12 py-4 bg-sky-600 text-white rounded-2xl font-bold hover:bg-sky-700 shadow-lg shadow-sky-200 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        Simpan Data Sikat Gigi
                    </button>
                </div>
            </form>
        </div>
    </main>

    <?php include '../../../../includes/footer.php'; ?>
</div>

<script src="../../../../assets/js/sidebar.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();

    const formSikatGigi = document.getElementById('sikatGigiForm');
    
    formSikatGigi.addEventListener('change', function(e) {
        if (e.target.classList.contains('row-checkbox')) {
            updateTotalConditionSikatGigi();
        }
    });

    function updateTotalConditionSikatGigi() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const totalDisplay = document.getElementById('totalConditionSikatGigi');
        
        let totalChecked = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) totalChecked++;
        });

        totalDisplay.textContent = totalChecked;
        
        if (totalChecked > 0) {
            totalDisplay.classList.remove('condition-empty');
            totalDisplay.classList.add('condition-active');
        } else {
            totalDisplay.classList.add('condition-empty');
            totalDisplay.classList.remove('condition-active');
        }
    }
</script>