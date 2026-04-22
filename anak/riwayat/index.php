<?php 
session_start(); 
include '../../includes/header.php'; 
require_once '../../koneksi/koneksi.php';

/*
========================================
PROTEKSI LOGIN + ROLE (ORANG TUA & BOS)
========================================
*/
$id_user = $_SESSION['id_user'] ?? 0;
$role = $_SESSION['role'] ?? '';

if ($id_user <= 0) {
    die("Kesalahan: Anda harus login terlebih dahulu.");
}

if (!in_array($role, ['orang_tua', 'bos'])) {
    die("Kesalahan: Anda tidak memiliki akses ke halaman ini.");
}

/**
 * LIST ANAK USER
 */
$stmtList = $conn->prepare("SELECT id_anak, nama_anak FROM anak WHERE id_ortu = ?");
if (!$stmtList) {
    die("Query error: " . $conn->error);
}

$stmtList->bind_param("i", $id_user);
$stmtList->execute();
$resList = $stmtList->get_result();

$anak_list = [];
while ($row = $resList->fetch_assoc()) {
    $anak_list[] = $row;
}

/**
 * CEK ANAK DIPILIH
 */
$id_anak = isset($_GET['id_anak']) ? (int) $_GET['id_anak'] : 0;

/**
 * AMBIL DATA ANAK & RIWAYAT
 */
$data_anak = null;
$data_lama = [];

if ($id_anak > 0) {
    // Ambil info dasar anak
    $stmtAnak = $conn->prepare("SELECT * FROM anak WHERE id_anak = ? AND id_ortu = ?");
    $stmtAnak->bind_param("ii", $id_anak, $id_user);
    $stmtAnak->execute();
    $data_anak = $stmtAnak->get_result()->fetch_assoc();

    if (!$data_anak) {
        die("Data anak tidak valid atau bukan milik Anda.");
    }

    // Ambil data riwayat yang sudah tersimpan
    $check = $conn->prepare("SELECT * FROM riwayat_anak WHERE id_anak = ?");
    $check->bind_param("i", $id_anak);
    $check->execute();
    $data_lama = $check->get_result()->fetch_assoc() ?: [];
}
?>

<link rel="stylesheet" href="../../assets/css/sidebar.css">
<?php include '../../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">
    <main class="p-8 lg:p-12 flex-grow max-w-[1400px] mx-auto w-full">

        <?php if ($id_anak <= 0): ?>
        <!-- STEP 1: PILIH ANAK -->
        <div class="min-h-[60vh] flex items-center justify-center p-6">
            <div
                class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 flex flex-col md:flex-row w-full max-w-4xl overflow-hidden">
                <div class="md:w-1/2 bg-indigo-700 p-12 text-white flex flex-col justify-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-child-reaching text-3xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold mb-4">Pilih Profil Anak</h2>
                    <p class="text-indigo-100">Silakan pilih data anak untuk memulai pengisian catatan kesehatan
                        berkala.</p>
                </div>
                <div class="md:w-1/2 p-12">
                    <form method="GET" class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-500 mb-2 uppercase tracking-wide">Data
                                Anak</label>
                            <select name="id_anak" required
                                class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-xl focus:border-indigo-500 outline-none font-medium">
                                <option value="">-- Pilih Nama Anak --</option>
                                <?php foreach($anak_list as $a): ?>
                                <option value="<?= $a['id_anak'] ?>"><?= htmlspecialchars($a['nama_anak']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white p-4 rounded-xl font-bold hover:bg-indigo-700 transition-all flex items-center justify-center gap-2">
                            Lanjutkan <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <?php else: ?>

        <?php if (isset($_GET['success'])): ?>
        <div class="p-4 bg-green-100 text-green-700 rounded-xl mb-6">Data berhasil disimpan / diperbarui</div>
        <?php endif; ?>

        <div class="space-y-6">
            <header
                class="h-20 bg-white/90 backdrop-blur-xl border-b border-slate-200 flex items-center justify-between px-10 sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <div class="p-2 bg-rose-50 rounded-xl">
                        <i data-lucide="heart-pulse" class="text-rose-600 w-6 h-6"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Riwayat Kelahiran</h2>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Asesmen Anak
                                (<?= htmlspecialchars($data_anak['nama_anak']) ?>)</p>
                        </div>
                    </div>
                </div>
            </header>

            <section class="mb-10">
                <div
                    class="relative overflow-hidden bg-gradient-to-br from-rose-500 to-orange-600 rounded-[2.5rem] p-10 lg:p-14 text-white shadow-2xl shadow-rose-200">
                    <div class="relative z-10 max-w-2xl">
                        <span
                            class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold tracking-widest uppercase mb-4">Modul
                            Riwayat Medis</span>
                        <h1 class="text-4xl lg:text-5xl font-black mb-4 leading-tight">Detail Kehamilan & Persalinan
                        </h1>
                        <p class="text-rose-50 text-lg leading-relaxed opacity-90">Informasi prenatal dan proses
                            kelahiran membantu kami memahami profil sensorik dan motorik anak.</p>
                    </div>
                    <i data-lucide="baby"
                        class="absolute right-12 top-1/2 -translate-y-1/2 w-48 h-48 opacity-10 rotate-12"></i>
                </div>
            </section>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                <form class="p-8 lg:p-12 space-y-16" method="POST" action="proses_simpan.php" id="formRiwayat">
                    <input type="hidden" name="id_anak" value="<?= $id_anak ?>">
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">

                    <!-- BAGIAN 1: PRENATAL -->
                    <div class="space-y-10">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-lg font-bold">
                                1</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xl">Masa Kehamilan (Prenatal)</h4>
                                <p class="text-sm text-slate-500">Kondisi kesehatan Ibu selama mengandung</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                            <div class="space-y-4">
                                <label class="text-sm font-bold text-slate-700 block">Kondisi Kesehatan & Psikologis Ibu
                                    <span class="text-rose-500">*</span></label>
                                <textarea name="kondisi_kesehatan_ibu" class="form-modern-input min-h-[120px]"
                                    placeholder="Contoh: Hipertensi, mual berlebih, dll..."
                                    required><?= htmlspecialchars($data_lama['kondisi_kesehatan_ibu'] ?? '') ?></textarea>
                            </div>

                            <div class="space-y-4">
                                <label class="text-sm font-bold text-slate-700 block">Usia Kandungan (Minggu) <span
                                        class="text-rose-500">*</span></label>
                                <div class="flex items-center gap-4">
                                    <input type="number" name="usia_kandungan_minggu" class="form-modern-input"
                                        value="<?= htmlspecialchars($data_lama['usia_kandungan_minggu'] ?? '') ?>"
                                        required>
                                    <span class="text-sm font-medium text-slate-500">Minggu</span>
                                </div>
                            </div>

                            <!-- Konsumsi Obat/Fastfood -->
                            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 space-y-6">
                                <h5 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                                    <i data-lucide="apple" class="w-4 h-4 text-green-500"></i> Konsumsi
                                </h5>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-medium text-slate-600">Fast Food / MSG Tinggi</span>
                                        <select class="select-modern-small" name="konsumsi_fastfood"
                                            onchange="toggleField('fastfood_detail', this.value)">
                                            <option value="tidak"
                                                <?= ($data_lama['konsumsi_fastfood'] ?? '') == 'tidak' ? 'selected' : '' ?>>
                                                Tidak</option>
                                            <option value="ya"
                                                <?= ($data_lama['konsumsi_fastfood'] ?? '') == 'ya' ? 'selected' : '' ?>>
                                                Ya</option>
                                        </select>
                                    </div>
                                    <input type="text" name="fastfood_detail" id="fastfood_detail"
                                        class="form-modern-input text-xs <?= ($data_lama['konsumsi_fastfood'] ?? '') != 'ya' ? 'opacity-60' : '' ?>"
                                        <?= ($data_lama['konsumsi_fastfood'] ?? '') != 'ya' ? 'disabled' : '' ?>
                                        value="<?= htmlspecialchars($data_lama['fastfood_detail'] ?? '') ?>"
                                        placeholder="Sebutkan detail...">

                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-medium text-slate-600">Obat-obatan / Jamu</span>
                                        <select class="select-modern-small" name="konsumsi_obat"
                                            onchange="toggleField('obat_detail', this.value)">
                                            <option value="tidak"
                                                <?= ($data_lama['konsumsi_obat'] ?? '') == 'tidak' ? 'selected' : '' ?>>
                                                Tidak</option>
                                            <option value="ya"
                                                <?= ($data_lama['konsumsi_obat'] ?? '') == 'ya' ? 'selected' : '' ?>>Ya
                                            </option>
                                        </select>
                                    </div>
                                    <input type="text" name="obat_detail" id="obat_detail"
                                        class="form-modern-input text-xs <?= ($data_lama['konsumsi_obat'] ?? '') != 'ya' ? 'opacity-60' : '' ?>"
                                        <?= ($data_lama['konsumsi_obat'] ?? '') != 'ya' ? 'disabled' : '' ?>
                                        value="<?= htmlspecialchars($data_lama['obat_detail'] ?? '') ?>"
                                        placeholder="Sebutkan detail...">
                                </div>
                            </div>

                            <!-- RISIKO LINGKUNGAN (TAMPILKAN YANG DICENTANG) -->
                            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 space-y-6">
                                <h5 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                                    <i data-lucide="alert-triangle" class="w-4 h-4 text-orange-500"></i> Risiko
                                    Lingkungan
                                </h5>
                                <div class="grid grid-cols-2 gap-4">
                                    <?php 
                                    $risiko_list = [
                                        'risiko_asap_rokok' => 'Asap Rokok',
                                        'risiko_polusi' => 'Polusi Berat',
                                        'risiko_zat_kimia' => 'Zat Kimia',
                                        'risiko_lainnya' => 'Lainnya'
                                    ];
                                    foreach($risiko_list as $key => $label): 
                                       $is_checked = !empty($data_lama[$key]) ? 'checked' : '';
                                    ?>
                                    <label
                                        class="flex items-center gap-3 p-3 bg-white rounded-xl border border-slate-200 cursor-pointer hover:border-rose-300 transition-all">
                                        <input type="checkbox" name="<?= $key ?>" value="1" <?= $is_checked ?>
                                            class="w-4 h-4 rounded text-rose-600">
                                        <span class="text-xs font-semibold text-slate-600"><?= $label ?></span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 2: NATAL (PERSALINAN) -->
                    <div class="space-y-10">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg font-bold">
                                2</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xl">Proses Persalinan (Natal)</h4>
                                <p class="text-sm text-slate-500">Detail kejadian saat bayi dilahirkan</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="space-y-4">
                                <label class="text-sm font-bold text-slate-700 block">Metode Persalinan</label>
                                <select name="metode_persalinan" class="form-modern-input">
                                    <option value="Spontan"
                                        <?= ($data_lama['metode_persalinan'] ?? '') == 'Spontan' ? 'selected' : '' ?>>
                                        Spontan (Normal)</option>
                                    <option value="SC"
                                        <?= ($data_lama['metode_persalinan'] ?? '') == 'SC' ? 'selected' : '' ?>>Seksio
                                        Sesarea (SC)</option>
                                    <option value="Vakum"
                                        <?= ($data_lama['metode_persalinan'] ?? '') == 'Vakum' ? 'selected' : '' ?>>
                                        Vakum</option>
                                </select>
                            </div>
                            <div class="space-y-4">
                                <label class="text-sm font-bold text-slate-700 block">Tempat Persalinan</label>
                                <input type="text" name="tempat_persalinan" class="form-modern-input"
                                    value="<?= htmlspecialchars($data_lama['tempat_persalinan'] ?? '') ?>"
                                    placeholder="RS/Bidan">
                            </div>
                            <div class="space-y-4">
                                <label class="text-sm font-bold text-slate-700 block">Posisi Bayi</label>
                                <select name="posisi_bayi" class="form-modern-input">
                                    <option value="Normal"
                                        <?= ($data_lama['posisi_bayi'] ?? '') == 'Normal' ? 'selected' : '' ?>>Kepala di
                                        bawah</option>
                                    <option value="Sungsang"
                                        <?= ($data_lama['posisi_bayi'] ?? '') == 'Sungsang' ? 'selected' : '' ?>>
                                        Sungsang</option>
                                </select>
                            </div>
                        </div>

                        <!-- PENYULIT/KOMPLIKASI (TAMPILKAN YANG DICENTANG) -->
                        <div class="p-8 bg-rose-50/50 rounded-[2rem] border border-rose-100">
                            <label class="text-sm font-bold text-rose-900 block mb-4">Apakah ada penyulit/komplikasi
                                saat persalinan?</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <?php 
                                $komplikasi_list = [
                                    'komplikasi_kpd' => "Ketuban Pecah Dini",
                                    'komplikasi_lilitan_tali_pusat' => "Lilitan Tali Pusat",
                                    'komplikasi_pendarahan' => "Pendarahan",
                                    'komplikasi_asfiksia' => "Asfiksia",
                                    'komplikasi_macet' => "Persalinan Macet",
                                    'komplikasi_pre_eklampsia' => "Pre-eklampsia"
                                ];
                                foreach($komplikasi_list as $key => $label): 
                                    $is_comp_checked = !empty($data_lama[$key]) ? 'checked' : '';
                                ?>
                                <label
                                    class="flex items-center gap-3 px-5 py-4 bg-white rounded-2xl border border-rose-100 cursor-pointer hover:shadow-md">
                                    <input type="checkbox" name="<?= $key ?>" value="1" <?= $is_comp_checked ?>
                                        class="w-5 h-5 rounded text-rose-600">
                                    <span class="text-sm font-medium text-slate-700"><?= $label ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                            <textarea name="komplikasi_detail_lainnya" class="form-modern-input bg-white/80"
                                placeholder="Lainnya..."><?= htmlspecialchars($data_lama['komplikasi_detail_lainnya'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- BAGIAN 3: KONDISI BAYI -->
                    <div class="space-y-10">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-lg font-bold">
                                3</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xl">Kondisi Bayi Baru Lahir</h4>
                                <p class="text-sm text-slate-500">Status fisik bayi saat lahir</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400">Berat (gr)</label>
                                <input type="number" name="berat_lahir_gram" class="form-modern-input"
                                    value="<?= htmlspecialchars($data_lama['berat_lahir_gram'] ?? '') ?>">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400">Panjang (cm)</label>
                                <input type="number" name="panjang_lahir_cm" class="form-modern-input"
                                    value="<?= htmlspecialchars($data_lama['panjang_lahir_cm'] ?? '') ?>">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400">Lingkar Kepala
                                    (cm)</label>
                                <input type="number" name="lingkar_kepala_cm" class="form-modern-input"
                                    value="<?= htmlspecialchars($data_lama['lingkar_kepala_cm'] ?? '') ?>">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400">APGAR</label>
                                <input type="text" name="skor_apgar" class="form-modern-input"
                                    value="<?= htmlspecialchars($data_lama['skor_apgar'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 space-y-4">
                                <label class="text-sm font-bold text-slate-700">Bayi Menangis?</label>
                                <div class="flex gap-4">
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="bayi_menangis" value="ya" class="sr-only"
                                            <?= ($data_lama['bayi_menangis'] ?? 'ya') == 'ya' ? 'checked' : '' ?>>
                                        <div
                                            class="py-3 text-center rounded-xl border border-slate-200 bg-white font-bold text-xs radio-btn">
                                            Ya</div>
                                    </label>
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="bayi_menangis" value="tidak" class="sr-only"
                                            <?= ($data_lama['bayi_menangis'] ?? '') == 'tidak' ? 'checked' : '' ?>>
                                        <div
                                            class="py-3 text-center rounded-xl border border-slate-200 bg-white font-bold text-xs radio-btn">
                                            Tidak</div>
                                    </label>
                                </div>
                            </div>
                            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 space-y-4">
                                <label class="text-sm font-bold text-slate-700">Warna Kulit</label>
                                <select name="warna_kulit" class="form-modern-input">
                                    <option value="Kemerahan"
                                        <?= ($data_lama['warna_kulit'] ?? '') == 'Kemerahan' ? 'selected' : '' ?>>
                                        Kemerahan</option>
                                    <option value="Biru"
                                        <?= ($data_lama['warna_kulit'] ?? '') == 'Biru' ? 'selected' : '' ?>>Biru
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="p-8 bg-blue-50/50 rounded-[2rem] border border-blue-100">
                            <label class="font-bold text-slate-800 mb-2 block">Perawatan Khusus?</label>
                            <textarea name="perawatan_khusus_detail" class="form-modern-input bg-white"
                                placeholder="Sebutkan jika ada (misal: masuk NICU, disinar, dll)..."><?= htmlspecialchars($data_lama['perawatan_khusus_detail'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <div class="pt-10 border-t border-slate-100 flex justify-between items-center">
                        <a href="riwayat_kelahiran.php"
                            class="px-8 py-4 bg-slate-100 text-slate-600 font-bold rounded-2xl hover:bg-slate-200 transition-all">Ganti
                            Anak</a>
                        <button type="submit"
                            class="px-12 py-4 bg-rose-600 text-white font-bold rounded-2xl shadow-lg hover:bg-rose-700 transition-all">Simpan
                            Data Riwayat</button>
                    </div>
                </form>
            </div>
            <?php include '../../includes/footer.php'; ?>
        </div>
        <?php endif; ?>
    </main>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
lucide.createIcons();

function toggleField(targetId, value) {
    const field = document.getElementById(targetId);
    if (!field) return;
    if (value === 'ya') {
        field.disabled = false;
        field.classList.remove('opacity-60');
    } else {
        field.disabled = true;
        field.classList.add('opacity-60');
        field.value = '';
    }
}

// Pastikan field yang disabled tetap terkirim atau diaktifkan saat submit
document.getElementById('formRiwayat')?.addEventListener('submit', function() {
    this.querySelectorAll('[disabled]').forEach(field => field.disabled = false);
});
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.form-modern-input {
    width: 100%;
    padding: 14px 20px;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    font-size: 14px;
    background: white;
    transition: all 0.2s ease;
}

.form-modern-input:focus {
    outline: none;
    border-color: #f43f5e;
    box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.1);
}

input[type="radio"]:checked+.radio-btn {
    background-color: #f43f5e;
    color: white;
    border-color: #f43f5e;
}

.select-modern-small {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 6px 12px;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
}
</style>