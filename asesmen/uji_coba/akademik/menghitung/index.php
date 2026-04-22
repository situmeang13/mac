<?php include '../../../../includes/header.php'; ?>
<link rel="stylesheet" href="../../../../assets/css/sidebar.css">
<?php include '../../../../includes/sidebar.php'; ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    .math-training-body {
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
        border-color: #e11d48; /* Rose 600 */
        box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.1);
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
        background: #e11d48; 
        color: white; 
        box-shadow: 0 10px 15px -3px rgba(225, 29, 72, 0.3); 
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

    .math-badge {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 2px 8px;
        border-radius: 4px;
        margin-bottom: 4px;
        display: inline-block;
    }
    .badge-add { background: #fef2f2; color: #b91c1c; }
    .badge-sub { background: #fff7ed; color: #c2410c; }
    .badge-mul { background: #f0fdf4; color: #15803d; }
    .badge-div { background: #eff6ff; color: #1d4ed8; }
    .badge-util { background: #f5f3ff; color: #6d28d9; }

    .operation-example {
        font-family: 'Courier New', Courier, monospace;
        color: #64748b;
        font-size: 0.75rem;
        display: block;
        margin-top: 2px;
    }
</style>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen math-training-body">

    <!-- HEADER -->
    <header class="h-20 bg-white/90 backdrop-blur-xl border-b border-slate-200 flex items-center justify-between px-10 sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <div class="p-2 bg-rose-50 rounded-xl">
                <i data-lucide="calculator" class="text-rose-600 w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Operasi Hitung</h2>
                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Cognitive & Numeracy</p>
            </div>
        </div>
    </header>

    <main class="p-8 lg:p-12 flex-grow max-w-[1600px] mx-auto w-full">
        <!-- HERO SECTION -->
        <section class="mb-10">
            <div class="relative overflow-hidden bg-gradient-to-br from-rose-500 to-amber-600 rounded-[2.5rem] p-10 lg:p-14 text-white shadow-2xl">
                <div class="relative z-10 max-w-2xl">
                    <span class="px-4 py-1.5 bg-white/20 rounded-full text-xs font-bold uppercase">
                        Modul Asesmen
                    </span>
                    <h1 class="text-4xl lg:text-5xl font-black mt-4 mb-4">Kemampuan Berhitung</h1>
                    <p class="text-rose-50 text-lg">
                        Evaluasi kemampuan aritmatika dasar mencakup empat operasi utama dari satuan hingga jutaan, serta fungsionalitas alat hitung.
                    </p>
                </div>
                <i data-lucide="percent" class="absolute right-10 top-1/2 -translate-y-1/2 w-48 h-48 text-white/10 rotate-12"></i>
            </div>
        </section>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
            <form class="p-10" id="menghitungForm">
                <div class="table-container overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-600 border-b border-slate-200">
                                <th class="p-4 text-left font-bold uppercase tracking-wider">Indikator Operasi</th>
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
                            $aspek_hitung = [
                                ["label" => "Penjumlahan satuan", "ex" => "7+7=...", "cat" => "add"],
                                ["label" => "Penjumlahan puluhan", "ex" => "70+70=...", "cat" => "add"],
                                ["label" => "Penjumlahan ratusan", "ex" => "700+700=...", "cat" => "add"],
                                ["label" => "Penjumlahan ribuan", "ex" => "7.000+7.000=...", "cat" => "add"],
                                ["label" => "Penjumlahan puluhan ribu", "ex" => "70.000+70.000=...", "cat" => "add"],
                                ["label" => "Penjumlahan ratusan ribu", "ex" => "700.000+700.000=...", "cat" => "add"],
                                ["label" => "Penjumlahan jutaan", "ex" => "7.000.000+7.000.000=...", "cat" => "add"],
                                
                                ["label" => "Pengurangan satuan", "ex" => "7-7=...", "cat" => "sub"],
                                ["label" => "Pengurangan puluhan", "ex" => "70-70=...", "cat" => "sub"],
                                ["label" => "Pengurangan ratusan", "ex" => "700-700=...", "cat" => "sub"],
                                ["label" => "Pengurangan ribuan", "ex" => "7.000-7.000=...", "cat" => "sub"],
                                ["label" => "Pengurangan puluhan ribu", "ex" => "70.000-70.000=...", "cat" => "sub"],
                                ["label" => "Pengurangan ratusan ribu", "ex" => "700.000-700.000=...", "cat" => "sub"],
                                ["label" => "Pengurangan jutaan", "ex" => "7.000.000-7.000.000=...", "cat" => "sub"],
                                
                                ["label" => "Perkalian satuan", "ex" => "7x7=...", "cat" => "mul"],
                                ["label" => "Perkalian puluhan", "ex" => "70x70=...", "cat" => "mul"],
                                ["label" => "Perkalian ratusan", "ex" => "700x700=...", "cat" => "mul"],
                                ["label" => "Perkalian ribuan", "ex" => "7.000x7.000=...", "cat" => "mul"],
                                ["label" => "Perkalian puluhan ribu", "ex" => "70.000x70.000=...", "cat" => "mul"],
                                ["label" => "Perkalian ratusan ribu", "ex" => "700.000x700.000=...", "cat" => "mul"],
                                ["label" => "Perkalian jutaan", "ex" => "7.000.000x7.000.000=...", "cat" => "mul"],
                                
                                ["label" => "Pembagian satuan", "ex" => "7÷7=...", "cat" => "div"],
                                ["label" => "Pembagian puluhan", "ex" => "70÷70=...", "cat" => "div"],
                                ["label" => "Pembagian ratusan", "ex" => "700÷700=...", "cat" => "div"],
                                ["label" => "Pembagian ribuan", "ex" => "7.000÷7.000=...", "cat" => "div"],
                                ["label" => "Pembagian puluhan ribu", "ex" => "70.000÷70.000=...", "cat" => "div"],
                                ["label" => "Pembagian ratusan ribu", "ex" => "700.000÷700.000=...", "cat" => "div"],
                                ["label" => "Pembagian jutaan", "ex" => "7.000.000÷7.000.000=...", "cat" => "div"],
                                
                                ["label" => "Menggunakan kalkulator", "ex" => "Alat bantu hitung", "cat" => "util"]
                            ];
                            
                            $total_rows = count($aspek_hitung);

                            foreach($aspek_hitung as $index => $item):
                                $cat_class = "badge-" . $item['cat'];
                                $cat_label = [
                                    "add" => "Penjumlahan",
                                    "sub" => "Pengurangan",
                                    "mul" => "Perkalian",
                                    "div" => "Pembagian",
                                    "util" => "Utilitas"
                                ][$item['cat']];
                            ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-4 font-semibold text-slate-700 whitespace-nowrap">
                                    <span class="math-badge <?= $cat_class ?>"><?= $cat_label ?></span><br>
                                    <?= $item['label'] ?>
                                    <span class="operation-example">(<?= $item['ex'] ?>)</span>
                                </td>
                                <td class="p-4 text-center">
                                    <input type="checkbox" name="score_hitung[]" 
                                           class="row-checkbox w-6 h-6 rounded-lg text-rose-600 focus:ring-rose-500 border-slate-300 cursor-pointer">
                                </td>
                                <td class="p-4">
                                    <select class="bg-white border border-slate-200 rounded-lg p-2 text-xs font-medium outline-none w-28 focus:ring-2 focus:ring-rose-500">
                                        <option>No Prompt</option>
                                        <option>P. Verbal</option>
                                        <option>P. Visual</option>
                                        <option>P. Fisik</option>
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
                                        <div id="totalConditionHitung" class="current-condition-chip condition-empty">0</div>
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
                        <i data-lucide="brain-circuit" class="w-5 h-5 text-rose-600"></i>
                        <label class="font-bold text-lg">Catatan Analisis Kognitif</label>
                    </div>
                    <textarea class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-6 min-h-[120px] focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 outline-none transition-all"
                              placeholder="Tuliskan jika anak memiliki kesulitan pada operasi tertentu, pemahaman nilai tempat (ratusan/ribuan), atau ketergantungan pada alat bantu..."></textarea>
                </div>

                <div class="flex justify-end mt-12 gap-4">
                    <button type="button" class="px-8 py-4 bg-slate-200 text-slate-700 rounded-2xl font-bold hover:bg-slate-300 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-12 py-4 bg-rose-600 text-white rounded-2xl font-bold hover:bg-rose-700 shadow-lg shadow-rose-200 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        Simpan Data Hitung
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

    const formHitung = document.getElementById('menghitungForm');
    
    formHitung.addEventListener('change', function(e) {
        if (e.target.classList.contains('row-checkbox')) {
            updateTotalConditionHitung();
        }
    });

    function updateTotalConditionHitung() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const totalDisplay = document.getElementById('totalConditionHitung');
        
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