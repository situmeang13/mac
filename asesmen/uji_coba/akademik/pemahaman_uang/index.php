<?php include '../../../../includes/header.php'; ?>
<link rel="stylesheet" href="../../../../assets/css/sidebar.css">
<?php include '../../../../includes/sidebar.php'; ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    .money-training-body {
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
        border-color: #d97706; /* Amber 600 */
        box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.1);
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
        background: #fbbf24; 
        color: #78350f; 
        box-shadow: 0 10px 15px -3px rgba(251, 191, 36, 0.3); 
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

    .money-badge {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 2px 8px;
        border-radius: 4px;
        margin-bottom: 4px;
        display: inline-block;
    }
    .badge-coin { background: #fef3c7; color: #92400e; }
    .badge-paper { background: #ecfdf5; color: #065f46; }
    .badge-function { background: #eff6ff; color: #1e40af; }
</style>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen money-training-body">

    <!-- HEADER -->
    <header class="h-20 bg-white/90 backdrop-blur-xl border-b border-slate-200 flex items-center justify-between px-10 sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <div class="p-2 bg-amber-50 rounded-xl">
                <i data-lucide="banknote" class="text-amber-600 w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Pemahaman Uang</h2>
                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Functional Numeracy</p>
            </div>
        </div>
    </header>

    <main class="p-8 lg:p-12 flex-grow max-w-[1600px] mx-auto w-full">
        <!-- HERO SECTION -->
        <section class="mb-10">
            <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 to-yellow-600 rounded-[2.5rem] p-10 lg:p-14 text-white shadow-2xl">
                <div class="relative z-10 max-w-2xl">
                    <span class="px-4 py-1.5 bg-white/20 rounded-full text-xs font-bold uppercase">
                        Modul Asesmen
                    </span>
                    <h1 class="text-4xl lg:text-5xl font-black mt-4 mb-4">Literasi Finansial</h1>
                    <p class="text-amber-50 text-lg">
                        Evaluasi kemampuan anak dalam mengidentifikasi nominal mata uang Rupiah (koin & kertas) serta pemahaman fungsi uang dalam kehidupan sehari-hari.
                    </p>
                </div>
                <i data-lucide="coins" class="absolute right-10 top-1/2 -translate-y-1/2 w-48 h-48 text-white/10 rotate-12"></i>
            </div>
        </section>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
            <form class="p-10" id="moneyForm">
                <div class="table-container overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-600 border-b border-slate-200">
                                <th class="p-4 text-left font-bold uppercase tracking-wider">Identifikasi Nominal</th>
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
                            $aspek_uang = [
                                ["label" => "Mengenal uang koin", "cat" => "coin"],
                                ["label" => "Uang koin seratus (100)", "cat" => "coin"],
                                ["label" => "Uang koin dua ratus (200)", "cat" => "coin"],
                                ["label" => "Uang koin lima ratus (500)", "cat" => "coin"],
                                ["label" => "Uang koin seribu (1000)", "cat" => "coin"],
                                ["label" => "Mengenal uang kertas", "cat" => "paper"],
                                ["label" => "Uang seribu rupiah (1000)", "cat" => "paper"],
                                ["label" => "Uang dua ribu rupiah (2000)", "cat" => "paper"],
                                ["label" => "Uang lima ribu rupiah (5000)", "cat" => "paper"],
                                ["label" => "Uang sepuluh ribu rupiah (10.000)", "cat" => "paper"],
                                ["label" => "Uang dua puluh ribu rupiah (20.000)", "cat" => "paper"],
                                ["label" => "Uang lima puluh ribu rupiah (50.000)", "cat" => "paper"],
                                ["label" => "Uang seratus ribu rupiah (100.000)", "cat" => "paper"],
                                ["label" => "Mengetahui fungsi uang", "cat" => "function"]
                            ];
                            
                            $total_rows = count($aspek_uang);

                            foreach($aspek_uang as $index => $item):
                                $cat_class = "badge-" . $item['cat'];
                                $cat_label = [
                                    "coin" => "Koin",
                                    "paper" => "Kertas",
                                    "function" => "Pemahaman"
                                ][$item['cat']];
                            ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-4 font-semibold text-slate-700 whitespace-nowrap">
                                    <span class="money-badge <?= $cat_class ?>"><?= $cat_label ?></span><br>
                                    <?= $item['label'] ?>
                                </td>
                                <td class="p-4 text-center">
                                    <input type="checkbox" name="score_money[]" 
                                           class="row-checkbox w-6 h-6 rounded-lg text-amber-600 focus:ring-amber-500 border-slate-300 cursor-pointer">
                                </td>
                                <td class="p-4">
                                    <select class="bg-white border border-slate-200 rounded-lg p-2 text-xs font-medium outline-none w-28 focus:ring-2 focus:ring-amber-500">
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
                                        <div id="totalConditionMoney" class="current-condition-chip condition-empty">0</div>
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
                        <i data-lucide="wallet" class="w-5 h-5 text-amber-600"></i>
                        <label class="font-bold text-lg">Catatan Observasi Finansial</label>
                    </div>
                    <textarea class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-6 min-h-[120px] focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all"
                              placeholder="Tuliskan catatan mengenai kemampuan anak membedakan warna uang, menghitung kembalian sederhana, atau pemahaman konsep jual-beli..."></textarea>
                </div>

                <div class="flex justify-end mt-12 gap-4">
                    <button type="button" class="px-8 py-4 bg-slate-200 text-slate-700 rounded-2xl font-bold hover:bg-slate-300 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-12 py-4 bg-amber-600 text-white rounded-2xl font-bold hover:bg-amber-700 shadow-lg shadow-amber-200 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        Simpan Data Uang
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

    const formMoney = document.getElementById('moneyForm');
    
    formMoney.addEventListener('change', function(e) {
        if (e.target.classList.contains('row-checkbox')) {
            updateTotalConditionMoney();
        }
    });

    function updateTotalConditionMoney() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const totalDisplay = document.getElementById('totalConditionMoney');
        
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