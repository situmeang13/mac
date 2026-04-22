<?php 
session_start();
require_once '../../koneksi/koneksi.php';

$id_user = $_SESSION['id_user'] ?? 0;
$role = $_SESSION['role'] ?? '';

if ($id_user <= 0) {
    header("Location: ../../login.php");
    exit();
}

if (!in_array($role, ['orang_tua', 'bos'])) {
    die("Anda tidak memiliki otoritas untuk mengakses halaman ini.");
}

include '../../includes/header.php';

// Ambil daftar anak
$anak_list = [];
$stmt = $conn->prepare("SELECT id_anak, nama_anak FROM anak WHERE id_ortu = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $anak_list[] = $row;
}

$id_anak = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$nama_anak_terpilih = "";
$data_existing = [];

if ($id_anak > 0) {
    // Cari nama anak terpilih
    foreach($anak_list as $a) {
        if($a['id_anak'] == $id_anak) $nama_anak_terpilih = $a['nama_anak'];
    }

    // AMBIL DATA EXISTING JIKA ADA
    // Pastikan nama tabel dan kolom sesuai dengan database Anda
    $stmt_check = $conn->prepare("SELECT aspek_ke, status, catatan FROM sensori_halus WHERE id_anak = ?");
    $stmt_check->bind_param("i", $id_anak);
    $stmt_check->execute();
    $res_check = $stmt_check->get_result();
    while($row = $res_check->fetch_assoc()){
        // Menyimpan data berdasarkan index aspek_ke
        $data_existing[$row['aspek_ke']] = $row;
    }
}

$aspek = [
    ["title"=>"Respon Suara","desc"=>"Reaksi terhadap suara keras.","icon"=>"fa-volume-high"],
    ["title"=>"Sentuhan Tekstur","desc"=>"Reaksi terhadap tekstur.","icon"=>"fa-hand-dots"],
    ["title"=>"Visual & Cahaya","desc"=>"Sensitif cahaya.","icon"=>"fa-sun"],
    ["title"=>"Kepadatan Ruang","desc"=>"Reaksi tempat ramai.","icon"=>"fa-users"]
];
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/sidebar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: #f8fafc;
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
}

@media (max-width: 1024px) {
    .main-content {
        margin-left: 0;
    }
}

.assessment-card {
    padding: 2rem;
    border-radius: 2rem;
    transition: all 0.25s ease;
    background: white;
}

.assessment-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
}

.card-option {
    border: 2px solid #e2e8f0;
    transition: all 0.2s;
    cursor: pointer;
}

.radio-normal:checked+.card-option {
    border-color: #22c55e;
    background: #ecfdf5;
    color: #15803d;
}

.radio-problem:checked+.card-option {
    border-color: #ef4444;
    background: #fef2f2;
    color: #b91c1c;
}

.note-expansion {
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease;
}

.note-expansion.active {
    max-height: 200px;
    margin-top: 12px;
}

.radio-hidden {
    display: none;
}
</style>

<div class="app-container">
    <?php include '../../includes/sidebar.php'; ?>

    <div class="main-content">
        <main class="p-8 lg:p-12 flex-grow">
            <div class="max-w-[1400px] mx-auto w-full">

                <?php if ($id_anak <= 0): ?>
                <!-- PILIH ANAK -->
                <div class="min-h-[70vh] flex items-center justify-center">
                    <div
                        class="bg-white rounded-[2.5rem] shadow-xl border flex flex-col md:flex-row w-full max-w-5xl overflow-hidden">
                        <div class="md:w-1/2 bg-indigo-700 p-16 text-white">
                            <h2 class="text-4xl font-bold mb-4">Pilih Profil Anak</h2>
                            <p class="text-indigo-100 text-lg">Silakan pilih data anak untuk memulai atau memperbarui
                                asesmen.</p>
                        </div>
                        <div class="md:w-1/2 p-16">
                            <form method="GET" class="space-y-6">
                                <select name="id" required class="w-full p-5 text-lg bg-slate-50 border-2 rounded-xl">
                                    <option value="">-- Pilih Nama Anak --</option>
                                    <?php foreach($anak_list as $a): ?>
                                    <option value="<?= $a['id_anak'] ?>"><?= htmlspecialchars($a['nama_anak']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white p-5 text-lg rounded-xl font-bold">Lanjutkan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <?php else: ?>
                <!-- HEADER FORM -->
                <div class="mb-10 bg-white p-10 rounded-[2rem] shadow-sm border flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-extrabold">Asesmen Sensori Halus</h1>
                        <p class="text-slate-500 text-lg">Subjek: <span
                                class="text-indigo-600 font-bold"><?= htmlspecialchars($nama_anak_terpilih) ?></span>
                        </p>
                    </div>
                    <a href="asesmen_sensori_halus.php"
                        class="bg-slate-100 px-6 py-3 rounded-xl font-bold text-slate-600 hover:bg-slate-200">Ganti
                        Anak</a>
                </div>

                <form method="POST" action="proses_sensori.php" class="space-y-10">
                    <input type="hidden" name="id_anak" value="<?= $id_anak ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <?php foreach ($aspek as $i => $item): 
                            // Ambil data dari database jika tersedia
                            $val_status = $data_existing[$i]['status'] ?? '';
                            $val_catatan = $data_existing[$i]['catatan'] ?? '';
                            $is_masalah = ($val_status === 'tidak');
                        ?>
                        <div class="bg-white border assessment-card">
                            <div class="flex gap-5 mb-6">
                                <div class="w-14 h-14 bg-indigo-50 rounded-xl flex items-center justify-center">
                                    <i class="fa-solid <?= $item['icon'] ?> text-xl text-indigo-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold"><?= $item['title'] ?></h3>
                                    <p class="text-sm text-slate-500"><?= $item['desc'] ?></p>
                                    <input type="hidden" name="nama_aspek[<?= $i ?>]" value="<?= $item['title'] ?>">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <label>
                                    <input type="radio" name="sensori_status[<?= $i ?>]" value="ya"
                                        class="radio-hidden radio-normal" onchange="toggleNote(<?= $i ?>, false)"
                                        <?= ($val_status === 'ya') ? 'checked' : '' ?> required>
                                    <div class="card-option p-5 rounded-xl text-center font-bold">Normal</div>
                                </label>

                                <label>
                                    <input type="radio" name="sensori_status[<?= $i ?>]" value="tidak"
                                        class="radio-hidden radio-problem" onchange="toggleNote(<?= $i ?>, true)"
                                        <?= ($val_status === 'tidak') ? 'checked' : '' ?>>
                                    <div class="card-option p-5 rounded-xl text-center font-bold">Masalah</div>
                                </label>
                            </div>

                            <!-- Area Catatan: Muncul otomatis jika status 'tidak' (Masalah) -->
                            <div id="note_wrap_<?= $i ?>" class="note-expansion <?= $is_masalah ? 'active' : '' ?>">
                                <textarea name="sensori_note[<?= $i ?>]" id="note_input_<?= $i ?>"
                                    placeholder="Berikan catatan detail masalah..."
                                    class="w-full mt-3 p-4 border-2 rounded-xl focus:border-indigo-500 outline-none transition-all"
                                    <?= $is_masalah ? '' : 'disabled' ?>><?= htmlspecialchars($val_catatan) ?></textarea>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="flex justify-between items-center bg-white p-8 rounded-2xl shadow-sm border">
                        <a href="index.php" class="font-bold text-slate-400 hover:text-slate-600">Kembali ke
                            Dashboard</a>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-12 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-200 transition-all">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Asesmen
                        </button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </main>
        <?php include '../../includes/footer.php'; ?>
    </div>
</div>

<script>
function toggleNote(i, show) {
    const wrap = document.getElementById('note_wrap_' + i);
    const input = document.getElementById('note_input_' + i);
    if (show) {
        wrap.classList.add('active');
        input.disabled = false;
        input.focus();
    } else {
        wrap.classList.remove('active');
        input.disabled = true;
        input.value = '';
    }
}
</script>