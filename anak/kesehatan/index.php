<?php
session_start();

// 1. PROTEKSI SESI
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['orang_tua', 'bos'])) {
    echo "<script>alert('Akses Ditolak!'); window.history.back();</script>";
    exit;
}

include '../../koneksi/koneksi.php';
// Aktifkan error reporting untuk mysqli agar lebih mudah debugging jika ada query gagal
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$id_user = $_SESSION['id_user'];

$id_anak_terpilih = isset($_GET['id_anak']) ? (int) $_GET['id_anak'] : 0;

// AMBIL DATA KESEHATAN
$data_kesehatan = [];

if ($id_anak_terpilih > 0) {
    $stmt_kesehatan = $conn->prepare("SELECT * FROM kesehatan_anak WHERE id_anak = ?");
    $stmt_kesehatan->bind_param("i", $id_anak_terpilih);
    $stmt_kesehatan->execute();
    $result_kesehatan = $stmt_kesehatan->get_result();
    $data_kesehatan = $result_kesehatan->fetch_assoc() ?? [];
}

// 2. LOGIKA PENYIMPANAN DATA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proses_simpan'])) {
    $id_anak          = $_POST['id_anak'];
    $tinggi_badan     = $_POST['tinggi_badan_cm'];
    $berat_badan      = $_POST['berat_badan_kg'];
    $makanan_3_bulan  = $_POST['makanan_3_bulan_terakhir'];
    $makanan_favorit  = $_POST['makanan_favorit'];
    $kegiatan_favorit = $_POST['kegiatan_favorit'];
    $konsumsi_obat    = $_POST['konsumsi_obat'];
    $keterangan_obat  = $_POST['keterangan_obat'] ?? '';

    $disabilitas_intelektual = isset($_POST['disabilitas_intelektual']) ? 1 : 0;
    $cerebral_palsy         = isset($_POST['cerebral_palsy']) ? 1 : 0;
    $epilepsi               = isset($_POST['epilepsi']) ? 1 : 0;
    $skizofrenia            = isset($_POST['skizofrenia']) ? 1 : 0;
    $depresi                = isset($_POST['depresi']) ? 1 : 0;

    $query = "INSERT INTO kesehatan_anak (
        id_anak, tinggi_badan_cm, berat_badan_kg, disabilitas_intelektual, 
        cerebral_palsy, epilepsi, skizofrenia, depresi, 
        makanan_3_bulan_terakhir, makanan_favorit, kegiatan_favorit, 
        konsumsi_obat, keterangan_obat, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt_save = $conn->prepare($query);
    $stmt_save->bind_param(
        "iddiiiiisssss", 
        $id_anak, $tinggi_badan, $berat_badan, $disabilitas_intelektual,
        $cerebral_palsy, $epilepsi, $skizofrenia, $depresi,
        $makanan_3_bulan, $makanan_favorit, $kegiatan_favorit,
        $konsumsi_obat, $keterangan_obat
    );

    if ($stmt_save->execute()) {
        echo "<script>alert('Data kesehatan berhasil disimpan!'); window.location.href='index.php';</script>";
        exit;
    }
}

// 3. AMBIL DAFTAR ANAK UNTUK PILIHAN
$stmt_list_anak = $conn->prepare("SELECT id_anak, nama_anak, jenis_kelamin FROM anak WHERE id_ortu = ?");
$stmt_list_anak->bind_param("i", $id_user);
$stmt_list_anak->execute();
$result_anak = $stmt_list_anak->get_result();
$daftar_anak = $result_anak->fetch_all(MYSQLI_ASSOC);

if (count($daftar_anak) == 0) {
    echo "<script>alert('Harap registrasi data anak terlebih dahulu!'); window.location.href='../anak/tambah_anak.php';</script>";
    exit;
}

// Cek apakah user sudah memilih anak tertentu melalui parameter GET
$id_anak_terpilih = isset($_GET['id_anak']) ? (int)$_GET['id_anak'] : 0;
$data_anak_aktif = null;

if ($id_anak_terpilih > 0) {
    foreach ($daftar_anak as $a) {
        if ($a['id_anak'] == $id_anak_terpilih) {
            $data_anak_aktif = $a;
            break;
        }
    }
}
?>

<?php include '../../includes/header.php'; ?>

<!-- ASSETS -->
<link rel="stylesheet" href="../../assets/css/sidebar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<style>
:root {
    --primary: #6366f1;
    --primary-dark: #4f46e5;
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: #f8fafc;
}

.hero-gradient {
    background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
}

.glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(226, 232, 240, 0.8);
}

.form-modern-input {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    transition: all 0.3s ease;
    background-color: #f8fafc;
}

.form-modern-input:focus {
    border-color: var(--primary);
    background-color: #fff;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    outline: none;
}

.section-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    margin-right: 15px;
}
</style>

<div class="flex min-h-screen">
    <?php include '../../includes/sidebar.php'; ?>
    <div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen font-['Plus_Jakarta_Sans']">

        <?php if ($id_anak_terpilih <= 0): ?>

        <!-- STEP 1: PILIH ANAK -->
        <div class="min-h-screen flex items-center justify-center p-6">
            <div
                class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 flex flex-col md:flex-row w-full max-w-4xl overflow-hidden">

                <div class="md:w-1/2 bg-indigo-700 p-12 text-white flex flex-col justify-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-child-reaching text-3xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold mb-4">Pilih Profil Anak</h2>
                    <p class="text-indigo-100">
                        Silakan pilih data anak untuk memulai pengisian catatan kesehatan berkala.
                    </p>
                </div>

                <div class="md:w-1/2 p-12">
                    <form method="GET" class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-500 mb-2 uppercase tracking-wide">
                                Data Anak
                            </label>
                            <select name="id_anak" required
                                class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-xl focus:border-indigo-500 outline-none font-medium">
                                <option value="">-- Pilih Nama Anak --</option>
                                <?php foreach($daftar_anak as $a): ?>
                                <option value="<?= $a['id_anak'] ?>">
                                    <?= htmlspecialchars($a['nama_anak']) ?>
                                </option>
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

        <!-- STEP 2: FORM KESEHATAN -->
        <div class="hero-gradient px-10 pt-16 pb-32 text-white">
            <div class="max-w-5xl mx-auto">
                <div class="flex justify-between items-end">
                    <div>
                        <h1 class="text-3xl font-extrabold flex items-center gap-3">
                            <i class="fa-solid fa-notes-medical"></i>
                            Catatan Kesehatan Berkala
                        </h1>
                        <p class="text-indigo-100 mt-2 opacity-90">Memantau perkembangan fisik untuk
                            <span class="bg-white/20 px-2 py-0.5 rounded ml-1 font-bold">
                                <?= htmlspecialchars($data_anak_aktif['nama_anak']) ?>
                            </span>
                        </p>
                    </div>
                    <!-- <a href="tambah_kesehatan.php"
                        class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm font-medium backdrop-blur-sm transition-all">
                        <i class="fa-solid fa-rotate-left mr-2"></i>Ganti Anak
                    </a> -->
                </div>
            </div>
        </div>

        <main class="px-10 -mt-20 pb-20">
            <div class="max-w-5xl mx-auto">
                <form method="POST" action="update_kesehatan.php" class="space-y-8">
                    <input type="hidden" name="id_anak" value="<?= $data_anak_aktif['id_anak'] ?>">
                    <input type="hidden" name="proses_simpan" value="1">

                    <!-- BAGIAN 1: DATA FISIK -->
                    <div class="glass-card rounded-3xl p-8 shadow-xl border-t-4 border-indigo-500">
                        <div class="flex items-center mb-8">
                            <div class="section-icon bg-indigo-100 text-indigo-600">
                                <i class="fa-solid fa-weight-scale text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Informasi Fisik & Obat</h3>
                                <p class="text-sm text-gray-500">Data pertumbuhan dan konsumsi medis harian.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tinggi Badan (CM)</label>
                                <input type="number" step="0.1" name="tinggi_badan_cm"
                                    value="<?= htmlspecialchars($data_kesehatan['tinggi_badan_cm'] ?? '') ?>"
                                    class="form-modern-input" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Berat Badan (KG)</label>
                                <input type="number" step="0.1" name="berat_badan_kg"
                                    value="<?= htmlspecialchars($data_kesehatan['berat_badan_kg'] ?? '') ?>"
                                    class="form-modern-input" required>
                            </div>
                            <div class="md:col-span-2 p-4 bg-indigo-50/50 rounded-2xl border border-indigo-100">
                                <label class="block text-sm font-bold text-gray-700 mb-3">Apakah sedang konsumsi obat
                                    rutin?</label>
                                <div class="flex gap-6 mb-4">
                                    <label class="flex items-center gap-2 cursor-pointer font-medium">
                                        <input type="radio" name="konsumsi_obat" value="Ya"
                                            <?= ($data_kesehatan['konsumsi_obat'] ?? '') == 'Ya' ? 'checked' : '' ?>>
                                        Ya
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer font-medium">
                                        <input type="radio" name="konsumsi_obat" value="Tidak"
                                            <?= ($data_kesehatan['konsumsi_obat'] ?? 'Tidak') == 'Tidak' ? 'checked' : '' ?>>
                                        Tidak
                                    </label>
                                </div>
                                <div id="obat_keterangan_box" class="mt-3">
                                    <textarea name="keterangan_obat" class="form-modern-input"
                                        placeholder="Jika 'Ya', sebutkan nama obat dan dosisnya..."><?= htmlspecialchars($data_kesehatan['keterangan_obat'] ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 2: KONDISI PENYERTA -->
                    <div class="glass-card rounded-3xl p-8 shadow-xl border-t-4 border-amber-500">
                        <div class="flex items-center mb-8">
                            <div class="section-icon bg-amber-100 text-amber-600">
                                <i class="fa-solid fa-hand-holding-medical text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Kondisi Penyerta</h3>
                                <p class="text-sm text-gray-500">Pilih jika anak memiliki kondisi medis tambahan.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php 
$kondisi = [
    'disabilitas_intelektual' => 'Disabilitas Intelektual',
    'cerebral_palsy' => 'Cerebral Palsy',
    'epilepsi' => 'Epilepsi',
    'skizofrenia' => 'Skizofrenia',
    'depresi' => 'Depresi'
];

foreach($kondisi as $key => $label): ?>

                            <label
                                class="flex items-center p-4 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-white hover:border-amber-400 transition-all">

                                <input type="checkbox" name="<?= $key ?>" value="1"
                                    <?= !empty($data_kesehatan[$key]) ? 'checked' : '' ?>
                                    class="w-5 h-5 text-amber-500 rounded border-gray-300">

                                <span class="ml-3 text-sm font-semibold text-gray-700">
                                    <?= $label ?>
                                </span>

                            </label>

                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- BAGIAN 3: KEBIASAAN -->
                    <div class="glass-card rounded-3xl p-8 shadow-xl border-t-4 border-emerald-500">
                        <div class="flex items-center mb-8">
                            <div class="section-icon bg-emerald-100 text-emerald-600">
                                <i class="fa-solid fa-utensils text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Nutrisi & Aktivitas</h3>
                                <p class="text-sm text-gray-500">Informasi mengenai pola makan dan kegemaran anak.</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pola Makan (3 Bulan Terakhir)
                                    *</label>
                                <textarea name="makanan_3_bulan_terakhir" class="form-modern-input"
                                    required><?= htmlspecialchars($data_kesehatan['makanan_3_bulan_terakhir'] ?? '') ?></textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Makanan Favorit *</label>
                                    <input type="text" name="makanan_favorit"
                                        value="<?= htmlspecialchars($data_kesehatan['makanan_favorit'] ?? '') ?>"
                                        class="form-modern-input" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Kegiatan Favorit *</label>
                                    <input type="text" name="kegiatan_favorit"
                                        value="<?= htmlspecialchars($data_kesehatan['kegiatan_favorit'] ?? '') ?>"
                                        class="form-modern-input" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER BUTTONS -->
                    <div
                        class="flex flex-col md:flex-row items-center justify-between bg-white p-6 rounded-2xl shadow-lg border border-slate-200 gap-4">
                        <button type="button" onclick="window.location.href='tambah_kesehatan.php'"
                            class="w-full md:w-auto flex items-center justify-center gap-2 px-8 py-4 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                            <i class="fa-solid fa-arrow-left"></i> Ganti Anak
                        </button>

                        <button type="submit"
                            class="w-full md:w-auto flex items-center justify-center gap-2 px-10 py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transform hover:-translate-y-1 transition-all">
                            <i class="fa-solid fa-save"></i> Simpan Data Kesehatan
                        </button>
                    </div>
                </form>
            </div>
        </main>
        <?php endif; ?>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>