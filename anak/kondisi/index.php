<?php
session_start();

// Proteksi Halaman
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

include '../../koneksi/koneksi.php';

$id_user = $_SESSION['id_user'];

// Ambil Semua Data Anak untuk Pilihan
$query_anak = "SELECT id_anak, nama_anak FROM anak WHERE id_ortu = ?";
$stmt_all_anak = $conn->prepare($query_anak);
$stmt_all_anak->bind_param("i", $id_user);
$stmt_all_anak->execute();
$result_anak = $stmt_all_anak->get_result();
$anak_list = $result_anak->fetch_all(MYSQLI_ASSOC);

$id_anak_terpilih = null;
if (isset($_POST['id_anak'])) {
    $id_anak_terpilih = $_POST['id_anak'];
} elseif (isset($_GET['id'])) {
    $id_anak_terpilih = $_GET['id'];
}

$data_anak = null;
if ($id_anak_terpilih) {
    $stmt_detail = $conn->prepare("SELECT id_anak, nama_anak FROM anak WHERE id_anak = ? AND id_ortu = ?");
    $stmt_detail->bind_param("ii", $id_anak_terpilih, $id_user);
    $stmt_detail->execute();
    $data_anak = $stmt_detail->get_result()->fetch_assoc();
}
// AMBIL DATA KONDISI TERKINI (UNTUK EDIT / TAMPILKAN NILAI LAMA)
$data_kondisi = [];

if ($id_anak_terpilih) {
    $stmt_kondisi = $conn->prepare("SELECT * FROM kondisi_terkini_anak WHERE id_anak = ? ORDER BY id_kondisi DESC LIMIT 1");
    $stmt_kondisi->bind_param("i", $id_anak_terpilih);
    $stmt_kondisi->execute();
    $result_kondisi = $stmt_kondisi->get_result();
    $data_kondisi = $result_kondisi->fetch_assoc() ?? [];
}

// Logika Simpan Data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {

    $id_anak = $_POST['id_anak_hidden'];

    // CEK DATA
    $cek = $conn->prepare("SELECT id_kondisi FROM kondisi_terkini_anak WHERE id_anak = ?");
    $cek->bind_param("i", $id_anak);
    $cek->execute();
    $result_cek = $cek->get_result();
    $data_exist = $result_cek->fetch_assoc();
    $cek->close();

    // =========================
    // ARRAY DATA (WAJIB RAPI)
    // =========================
    $data = [
        $_POST['merangkak'],
        $_POST['duduk'],
        $_POST['berdiri'],
        $_POST['berjalan'],
        $_POST['berlari'],
        $_POST['melompat'],
        $_POST['jongkok'],
        $_POST['melempar_bola'],
        $_POST['menangkap_bola'],
        $_POST['naik_turun_tangga'],

        $_POST['frekuensi_tantrum'],
        $_POST['durasi_tantrum'],

        $_POST['pol_geram'],
        $_POST['pol_berteriak'],
        $_POST['pol_membentur'],
        $_POST['pol_mencakar'],
        $_POST['pol_menendang'],
        $_POST['pol_memukul_telapak'],
        $_POST['pol_memukul_kepalan'],
        $_POST['pol_menggigit'],
        $_POST['pol_meludah'],
        $_POST['pol_kasar'],
        $_POST['pol_benda_tajam'],
        $_POST['pol_gigi'],
        $_POST['pol_mengurung'],
        $_POST['pol_menangis'],

        $_POST['pd_geram'],
        $_POST['pd_berteriak'],
        $_POST['pd_membentur'],
        $_POST['pd_mencakar'],
        $_POST['pd_menendang'],
        $_POST['pd_memukul_telapak'],
        $_POST['pd_memukul_kepalan'],
        $_POST['pd_menggigit'],
        $_POST['pd_meludah'],
        $_POST['pd_kasar'],
        $_POST['pd_benda_tajam'],
        $_POST['pd_gigi'],
        $_POST['pd_mengurung'],
        $_POST['pd_menangis'],

        $_POST['perilaku_seksual'],
        $id_anak
    ];

    // TYPE otomatis (SAFE)
    $types = str_repeat("s", count($data) - 1) . "i";

    if ($data_exist) {

        // ================= UPDATE =================
        $sql = "UPDATE kondisi_terkini_anak SET
            merangkak=?, duduk=?, berdiri=?, berjalan=?, berlari=?, melompat=?, jongkok=?, melempar_bola=?, menangkap_bola=?, naik_turun_tangga=?,
            frekuensi_tantrum=?, durasi_tantrum=?,
            perilaku_orang_lain_geram=?, perilaku_orang_lain_berteriak=?, perilaku_orang_lain_membentur=?, perilaku_orang_lain_mencakar=?, perilaku_orang_lain_menendang=?, perilaku_orang_lain_memukul_telapak=?, perilaku_orang_lain_memukul_kepalan=?, perilaku_orang_lain_menggigit=?, perilaku_orang_lain_meludah=?, perilaku_orang_lain_kasar=?, perilaku_orang_lain_benda_tajam=?, perilaku_orang_lain_gigi=?, perilaku_orang_lain_mengurung=?, perilaku_orang_lain_menangis=?,
            perilaku_diri_geram=?, perilaku_diri_berteriak=?, perilaku_diri_membentur=?, perilaku_diri_mencakar=?, perilaku_diri_menendang=?, perilaku_diri_memukul_telapak=?, perilaku_diri_memukul_kepalan=?, perilaku_diri_menggigit=?, perilaku_diri_meludah=?, perilaku_diri_kasar=?, perilaku_diri_benda_tajam=?, perilaku_diri_gigi=?, perilaku_diri_mengurung=?, perilaku_diri_menangis=?,
            perilaku_seksual=?
        WHERE id_anak=?";

    } else {

        // ================= INSERT =================
        $sql = "INSERT INTO kondisi_terkini_anak (
            merangkak, duduk, berdiri, berjalan, berlari, melompat, jongkok, melempar_bola, menangkap_bola, naik_turun_tangga,
            frekuensi_tantrum, durasi_tantrum,
            perilaku_orang_lain_geram, perilaku_orang_lain_berteriak, perilaku_orang_lain_membentur, perilaku_orang_lain_mencakar, perilaku_orang_lain_menendang, perilaku_orang_lain_memukul_telapak, perilaku_orang_lain_memukul_kepalan, perilaku_orang_lain_menggigit, perilaku_orang_lain_meludah, perilaku_orang_lain_kasar, perilaku_orang_lain_benda_tajam, perilaku_orang_lain_gigi, perilaku_orang_lain_mengurung, perilaku_orang_lain_menangis,
            perilaku_diri_geram, perilaku_diri_berteriak, perilaku_diri_membentur, perilaku_diri_mencakar, perilaku_diri_menendang, perilaku_diri_memukul_telapak, perilaku_diri_memukul_kepalan, perilaku_diri_menggigit, perilaku_diri_meludah, perilaku_diri_kasar, perilaku_diri_benda_tajam, perilaku_diri_gigi, perilaku_diri_mengurung, perilaku_diri_menangis,
            perilaku_seksual, id_anak
        ) VALUES (" . implode(',', array_fill(0, count($data), '?')) . ")";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$data);

    if ($stmt->execute()) {
    echo "<script>
        alert('Berhasil disimpan');
        window.location.href='index.php?id={$id_anak}';
    </script>";
}
}
?>

<?php include '../../includes/header.php'; ?>
<link rel="stylesheet" href="../../assets/css/sidebar.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: #f8fafc;
    margin: 0;
    overflow-x: hidden;
}

.glass-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
}

.form-select-modern {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 0.875rem;
    transition: all 0.2s;
}

.form-select-modern:focus {
    border-color: #6366f1;
    outline: none;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.app-container {
    display: flex;
    min-height: 100vh;
}

.main-content {
    flex: 1;
    margin-left: 280px;
    display: flex;
    flex-direction: column;
    transition: 0.3s;
}

@media (max-width: 1024px) {
    .main-content {
        margin-left: 0;
    }
}

.hero-section {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    border-radius: 2rem;
    padding: 3rem 2rem;
    color: white;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.hero-section::after {
    content: '';
    position: absolute;
    right: -10%;
    top: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<div class="app-container">
    <?php include '../../includes/sidebar.php'; ?>

    <div class="main-content">
        <main class="p-6 bg-slate-50 flex-grow">
            <div class="max-w-7xl mx-auto">

                <?php if (!$data_anak): ?>
                <!-- STEP 1: PILIH ANAK -->
                <div class="min-h-[70vh] flex items-center justify-center">
                    <div
                        class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 flex flex-col md:flex-row w-full max-w-5xl overflow-hidden">
                        <div class="md:w-1/2 bg-indigo-700 p-12 text-white flex flex-col justify-center">
                            <h2 class="text-3xl font-bold mb-4">Pilih Profil Anak</h2>
                            <p class="text-indigo-100">Silakan pilih data anak untuk memulai pengisian kondisi terkini.
                            </p>
                        </div>
                        <div class="md:w-1/2 p-12">
                            <form method="GET" class="space-y-6">
                                <div>
                                    <label
                                        class="block text-sm font-bold text-slate-500 mb-2 uppercase tracking-wide">Data
                                        Anak</label>
                                    <select name="id" required
                                        class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-xl focus:border-indigo-500 outline-none font-medium text-slate-700">
                                        <option value="">-- Pilih Nama Anak --</option>
                                        <?php foreach($anak_list as $a): ?>
                                        <option value="<?= $a['id_anak'] ?>"><?= htmlspecialchars($a['nama_anak']) ?>
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

                <!-- HERO SECTION -->
                <div class="hero-section animate-fade-in shadow-lg shadow-indigo-100">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="text-center md:text-left">
                            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Formulir Kondisi Terkini</h1>
                            <p class="text-indigo-100 text-lg">Pantau perkembangan harian, motorik, dan perilaku anak
                                Anda dengan mudah.</p>
                        </div>
                        <div
                            class="bg-white/20 backdrop-blur-md p-6 rounded-2xl border border-white/30 text-center min-w-[200px]">
                            <p class="text-xs uppercase font-bold tracking-widest mb-1 opacity-80">Nama Anak</p>
                            <h2 class="text-2xl font-bold"><?= htmlspecialchars($data_anak['nama_anak']) ?></h2>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: FORM ISIAN -->
                <form method="POST" class="space-y-6 animate-fade-in">
                    <input type="hidden" name="id_anak_hidden" value="<?= $data_anak['id_anak'] ?>">

                    <!-- Header Form & Tombol Kembali -->
                    <div class="flex justify-between items-center mb-6">
                        <a href="form_kondisi.php"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 transition-all text-sm group">
                            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                            Kembali
                        </a>
                        <div
                            class="hidden md:flex items-center gap-2 text-slate-400 text-xs font-semibold uppercase tracking-wider">
                            <i class="fa-solid fa-circle-info"></i> Harap isi data sesuai kondisi saat ini
                        </div>
                    </div>

                    <!-- MOTORIK -->
                    <div class="glass-card">
                        <h3 class="font-bold text-gray-800 mb-6 flex items-center gap-2 border-b pb-3">
                            <i class="fa-solid fa-child text-blue-500"></i> Kemampuan Motorik Kasar
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                            <?php
                            $motorik = [
                                'merangkak' => 'Merangkak', 'duduk' => 'Duduk', 'berdiri' => 'Berdiri', 
                                'berjalan' => 'Berjalan', 'berlari' => 'Berlari', 'melompat' => 'Melompat', 
                                'jongkok' => 'Jongkok', 'melempar_bola' => 'Melempar Bola', 
                                'menangkap_bola' => 'Menangkap Bola', 'naik_turun_tangga' => 'Naik Tangga'
                            ];
                            foreach($motorik as $key => $label): ?>
                            <div>
                                <label
                                    class="text-[10px] uppercase font-bold text-gray-400 block mb-1"><?= $label ?></label>
                                <select name="<?= $key ?>" class="form-select-modern">
                                    <option value="Tidak Bisa"
                                        <?= ($data_kondisi[$key] ?? '') == 'Tidak Bisa' ? 'selected' : '' ?>>Tidak Bisa
                                    </option>
                                    <option value="Bantuan"
                                        <?= ($data_kondisi[$key] ?? '') == 'Bantuan' ? 'selected' : '' ?>>Bantuan
                                    </option>
                                    <option value="Baik" <?= ($data_kondisi[$key] ?? '') == 'Baik' ? 'selected' : '' ?>>
                                        Baik</option>
                                </select>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- 2. KONDISI TANTRUM -->
                    <div class="glass-card">
                        <h3 class="font-bold text-gray-800 mb-6 flex items-center gap-2 border-b pb-3">
                            <i class="fa-solid fa-face-frown text-amber-500"></i> Kondisi Tantrum
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 block">Frekuensi Tantrum Hari Ini</label>
                                <select name="frekuensi_tantrum" class="form-select-modern" required>
                                    <?php
                $frek = $data_kondisi['frekuensi_tantrum'] ?? '';
                $opsi_frek = ["0 - 2 kali","3 - 5 kali","6 - 7 kali","8 - 10 kali","> 10 kali"];
                foreach($opsi_frek as $o): ?>
                                    <option value="<?= $o ?>" <?= ($frek == $o) ? 'selected' : '' ?>>
                                        <?= $o ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 block">Durasi Rata-rata Tantrum</label>
                                <select name="durasi_tantrum" class="form-select-modern" required>
                                    <?php
                $dur = $data_kondisi['durasi_tantrum'] ?? '';
                $opsi_dur = ["0 - 5 menit","6 - 10 menit","10 - 15 menit","> 30 menit"];
                foreach($opsi_dur as $o): ?>
                                    <option value="<?= $o ?>" <?= ($dur == $o) ? 'selected' : '' ?>>
                                        <?= $o ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 3. AGRESI -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- ORANG LAIN -->
                        <div class="glass-card border-l-4 border-red-500">
                            <h3 class="font-bold text-gray-800 mb-4">Terhadap Orang Lain</h3>

                            <div class="space-y-3">
                                <?php
            $agresi = [
                'geram' => 'Menggeram',
                'berteriak' => 'Berteriak',
                'membentur' => 'Membentur Benda',
                'mencakar' => 'Mencakar',
                'menendang' => 'Menendang',
                'memukul_telapak' => 'Pukul Telapak',
                'memukul_kepalan' => 'Pukul Kepalan',
                'menggigit' => 'Menggigit',
                'meludah' => 'Meludah',
                'kasar' => 'Kata Kasar',
                'benda_tajam' => 'Benda Tajam',
                'gigi' => 'Gigi',
                'mengurung' => 'Mengurung',
                'menangis' => 'Menangis'
            ];

            foreach($agresi as $k => $l): 
                $dbKey = "perilaku_orang_lain_$k";
            ?>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-600 font-medium"><?= $l ?></span>
                                    <select name="pol_<?= $k ?>" class="form-select-modern w-32 py-1 text-xs">
                                        <?php
                    $val = $data_kondisi[$dbKey] ?? '';
                    foreach(["Tidak Ada","Pelan","Sedang","Keras"] as $v): ?>
                                        <option value="<?= $v ?>" <?= ($val == $v) ? 'selected' : '' ?>>
                                            <?= $v ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- DIRI SENDIRI (FIX UTAMA) -->
                        <div class="glass-card border-l-4 border-rose-500">
                            <h3 class="font-bold text-gray-800 mb-4">Terhadap Diri Sendiri</h3>

                            <div class="space-y-3">
                                <?php foreach($agresi as $k => $l): 
                $dbKey = "perilaku_diri_$k";
            ?>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-600 font-medium"><?= $l ?></span>

                                    <select name="pd_<?= $k ?>" class="form-select-modern w-32 py-1 text-xs">
                                        <?php
                    $val = $data_kondisi[$dbKey] ?? '';
                    foreach(["Tidak Ada","Pelan","Sedang","Keras"] as $v): ?>
                                        <option value="<?= $v ?>" <?= ($val == $v) ? 'selected' : '' ?>>
                                            <?= $v ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- 4. PERILAKU SEKSUAL -->
                    <div class="glass-card border-t-4 border-purple-500">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-venus-mars text-purple-500"></i> Perilaku Seksual
                        </h3>

                        <textarea name="perilaku_seksual" class="w-full border rounded-xl p-3">
        <?= htmlspecialchars($data_kondisi['perilaku_seksual'] ?? '') ?>
    </textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-4 pb-12">
                        <button type="button" onclick="window.location.href='index.php'"
                            class="px-8 py-3 bg-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-300 transition-colors">Batal</button>
                        <button type="submit" name="simpan"
                            class="px-12 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all active:translate-y-0">
                            Simpan Data Kondisi Terkini
                        </button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>