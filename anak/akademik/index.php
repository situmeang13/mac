<?php
session_start();
// Pastikan path koneksi dan includes benar sesuai struktur folder Anda
require_once '../../koneksi/koneksi.php';
include '../../includes/header.php';

/*
========================================
PROTECTA LOGIN + ROLE
========================================
*/
$id_user = $_SESSION['id_user'] ?? 0;
$role = $_SESSION['role'] ?? '';

if ($id_user <= 0) {
    die("Kesalahan: Anda harus login terlebih dahulu.");
}

if (!in_array($role, ['orang_tua', 'bos'])) {
    die("Kesalahan: Anda tidak memiliki akses.");
}

/*
========================================
AMBIL DATA ANAK
========================================
*/
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
foreach($anak_list as $a) {
    if($a['id_anak'] == $id_anak) {
        $nama_anak_terpilih = $a['nama_anak'];
        break;
    }
}

/*
========================================
AMBIL DATA ASESMEN (SESUAI STRUKTUR TABEL: asesmen_anak)
========================================
*/
$data_existing = null;
$is_update = false;
$saved_status = [];
$saved_notes = [];

if ($id_anak > 0) {
    // DISESUAIKAN: Nama tabel menjadi asesmen_anak sesuai database Anda
    $sql_check = "SELECT * FROM asesmen_anak WHERE id_anak = ? LIMIT 1";
    $stmt_check = $conn->prepare($sql_check);

    if ($stmt_check === false) {
        die("Kesalahan Database: " . $conn->error);
    }

    $stmt_check->bind_param("i", $id_anak);
    $stmt_check->execute();
    $res_check = $stmt_check->get_result();
    
    if ($res_check && $res_check->num_rows > 0) {
        $data_existing = $res_check->fetch_assoc();
        $is_update = true;
        
        // Dekode data JSON dari kolom longtext
        $saved_status = json_decode($data_existing['akademik_status'], true) ?: [];
        $saved_notes = json_decode($data_existing['akademik_note'], true) ?: [];
    }
}

$pertanyaan = [
    "Apakah anak bisa mengenal angka 0-100?",
    "Apakah anak bisa menggunakan operasi hitung penjumlahan?",
    "Apakah anak bisa menggunakan operasi hitung pengurangan?",
    "Apakah anak bisa menggunakan operasi hitung perkalian?",
    "Apakah anak bisa menggunakan operasi hitung pembagian?",
    "Apakah anak bisa membaca?",
    "Apakah anak bisa menulis dan tulisannya dapat dibaca?"
];
?>

<?php include '../../includes/sidebar.php'; ?>

<!-- Tailwind & Fonts -->
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="../../assets/css/sidebar.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.assessment-banner {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    position: relative;
    overflow: hidden;
}

.matrix-card {
    border: 1px solid #e2e8f0;
    border-radius: 2.5rem;
    overflow: hidden;
    background: white;
}

.matrix-header-custom {
    display: grid;
    grid-template-columns: 1.5fr 200px 1.2fr;
    background: #f8fafc;
    padding: 20px 24px;
    font-weight: 900;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #64748b;
    border-bottom: 1px solid #e2e8f0;
}

.matrix-row-custom {
    display: grid;
    grid-template-columns: 1.5fr 200px 1.2fr;
    padding: 20px 24px;
    border-bottom: 1px solid #f1f5f9;
    align-items: center;
}

.choice-box {
    display: block;
    padding: 10px;
    text-align: center;
    border-radius: 12px;
    font-weight: 800;
    font-size: 12px;
    border: 2px solid #f1f5f9;
    color: #94a3b8;
    transition: all 0.2s;
    background: white;
    cursor: pointer;
}

input:checked+.choice-box.green {
    background: #ecfdf5;
    border-color: #10b981;
    color: #10b981;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
}

input:checked+.choice-box.red {
    background: #fef2f2;
    border-color: #ef4444;
    color: #ef4444;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1);
}

.note-input {
    width: 100%;
    padding: 12px 18px;
    border-radius: 14px;
    border: 2px solid #f1f5f9;
    background: #f1f5f9;
    color: #94a3b8;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s;
}

.note-input.active {
    background: white;
    border-color: #4f46e5;
    color: #1e293b;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.08);
}

@media (max-width: 768px) {

    .matrix-header-custom,
    .matrix-row-custom {
        grid-template-columns: 1fr;
        gap: 12px;
    }
}
</style>

<div class="flex-grow lg:ml-80 flex flex-col bg-slate-50 min-h-screen">

    <?php if ($id_anak <= 0): ?>
    <div class="min-h-screen flex items-center justify-center p-6">
        <div
            class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 flex flex-col md:flex-row w-full max-w-4xl overflow-hidden">
            <div class="md:w-1/2 bg-indigo-700 p-12 text-white flex flex-col justify-center relative">
                <h2 class="text-3xl font-bold mb-4">Pilih Profil Anak</h2>
                <p class="text-indigo-100">Pilih data anak untuk melihat atau memperbarui hasil asesmen.</p>
            </div>
            <div class="md:w-1/2 p-12">
                <form method="GET" class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-500 mb-2 uppercase tracking-wide">Data
                            Anak</label>
                        <select name="id" required
                            class="w-full p-4 bg-slate-50 border-2 border-slate-100 rounded-xl focus:border-indigo-500 outline-none font-medium">
                            <option value="">-- Pilih Nama Anak --</option>
                            <?php foreach($anak_list as $a): ?>
                            <option value="<?= $a['id_anak'] ?>"><?= htmlspecialchars($a['nama_anak']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white p-4 rounded-xl font-bold hover:bg-indigo-700 transition-all">Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>

    <?php else: ?>
    <header
        class="h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200 flex items-center justify-between px-10 sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <div class="p-2.5 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200">
                <i data-lucide="graduation-cap" class="text-white w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Portal Akademik</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">
                    <?= $is_update ? 'Update Data' : 'Input Data' ?></p>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        <div class="px-8 lg:px-12 pt-8">
            <div class="assessment-banner rounded-[2.5rem] p-10 lg:p-14 shadow-2xl shadow-indigo-200 text-white">
                <h1 class="text-4xl lg:text-6xl font-black mb-4 leading-tight">Evaluasi Belajar <br><span
                        class="text-yellow-300"><?= htmlspecialchars($nama_anak_terpilih) ?></span></h1>
            </div>
        </div>

        <div class="max-w-[1400px] mx-auto p-8 lg:p-12">
            <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-200 overflow-hidden">
                <form class="p-8 lg:p-12" action="proses_simpan.php" method="POST">
                    <input type="hidden" name="id_anak" value="<?= $id_anak ?>">
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <input type="hidden" name="action" value="<?= $is_update ? 'update' : 'insert' ?>">

                    <div class="space-y-16">
                        <!-- BAGIAN 01 -->
                        <div class="section-container">
                            <div class="flex items-center gap-4 mb-8">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black">
                                    01</div>
                                <h3 class="text-xl font-bold text-slate-800 uppercase">Literasi & Numerasi</h3>
                            </div>

                            <div class="matrix-card">
                                <div class="matrix-header-custom">
                                    <div class="pl-4">Indikator Pertanyaan</div>
                                    <div class="text-center">Respon</div>
                                    <div class="pl-4">Penjelasan (Jika Ya)</div>
                                </div>
                                <?php foreach($pertanyaan as $i => $q): 
                                    $val_status = $saved_status[$i] ?? '';
                                    $val_note = $saved_notes[$i] ?? '';
                                ?>
                                <div class="matrix-row-custom">
                                    <div class="font-bold text-slate-700"><?= $q ?></div>
                                    <div class="flex justify-center gap-3">
                                        <label class="w-20">
                                            <input type="radio" name="akademik_status[<?= $i ?>]" value="ya"
                                                class="sr-only" onchange="toggleNote(this, 'note_<?= $i ?>')"
                                                <?= $val_status == 'ya' ? 'checked' : '' ?> required>
                                            <span class="choice-box green">Ya</span>
                                        </label>
                                        <label class="w-20">
                                            <input type="radio" name="akademik_status[<?= $i ?>]" value="tidak"
                                                class="sr-only" onchange="toggleNote(this, 'note_<?= $i ?>')"
                                                <?= $val_status == 'tidak' ? 'checked' : '' ?>>
                                            <span class="choice-box red">Tidak</span>
                                        </label>
                                    </div>
                                    <div class="px-2">
                                        <input type="text" id="note_<?= $i ?>" name="akademik_note[<?= $i ?>]"
                                            value="<?= htmlspecialchars($val_note) ?>"
                                            class="note-input <?= $val_status == 'ya' ? 'active' : '' ?>"
                                            <?= $val_status != 'ya' ? 'disabled readonly' : '' ?>>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- BAGIAN 02 -->
                        <div class="section-container">
                            <div class="flex items-center gap-4 mb-8">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center font-black">
                                    02</div>
                                <h3 class="text-xl font-bold text-slate-800 uppercase">Kesiapan Belajar</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-slate-50 p-10 rounded-[2.5rem]">
                                <div class="space-y-4">
                                    <label class="text-sm font-black text-slate-700">Duduk Tenang *</label>
                                    <div class="flex gap-4 p-3 bg-white rounded-2xl border border-slate-200">
                                        <label
                                            class="flex-1 text-center py-4 cursor-pointer rounded-xl has-[:checked]:bg-indigo-50 has-[:checked]:text-indigo-700">
                                            <input type="radio" name="duduk" value="ya" class="sr-only"
                                                onchange="handleDudukChange(this)" required
                                                <?= ($data_existing['duduk'] ?? '') == 'ya' ? 'checked' : '' ?>>
                                            <span>Mampu</span>
                                        </label>
                                        <label
                                            class="flex-1 text-center py-4 cursor-pointer rounded-xl has-[:checked]:bg-rose-50 has-[:checked]:text-rose-700">
                                            <input type="radio" name="duduk" value="tidak" class="sr-only"
                                                onchange="handleDudukChange(this)"
                                                <?= ($data_existing['duduk'] ?? '') == 'tidak' ? 'checked' : '' ?>>
                                            <span>Belum</span>
                                        </label>
                                    </div>
                                </div>

                                <div id="wrapper-durasi"
                                    class="space-y-4 <?= ($data_existing['duduk'] ?? '') == 'ya' ? '' : 'opacity-0 pointer-events-none' ?>">
                                    <label class="text-sm font-black text-slate-700">Durasi Fokus</label>
                                    <select name="durasi_fokus" id="durasi_fokus"
                                        class="w-full h-14 bg-white border border-slate-200 rounded-xl px-4">
                                        <option value="">Pilih...</option>
                                        <?php 
                                        $opts = ["0-5" => "0-5 Menit", "6-15" => "6-15 Menit", "16-30" => "16-30 Menit", ">60" => ">1 Jam"];
                                        foreach($opts as $k => $v): ?>
                                        <option value="<?= $k ?>"
                                            <?= ($data_existing['durasi_fokus'] ?? '') == $k ? 'selected' : '' ?>>
                                            <?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="text-sm font-black text-slate-700">Catatan Observasi</label>
                                    <textarea name="catatan"
                                        class="w-full min-h-[120px] bg-white border border-slate-200 rounded-2xl p-4"><?= htmlspecialchars($data_existing['catatan'] ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-10 border-t flex justify-end gap-4">
                            <button type="button" onclick="window.history.back()"
                                class="px-8 py-4 border rounded-xl">Batal</button>
                            <button type="submit"
                                class="px-10 py-4 bg-indigo-600 text-white font-bold rounded-xl"><?= $is_update ? 'Perbarui Data' : 'Simpan Data' ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php endif; ?>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
lucide.createIcons();

function toggleNote(radio, id) {
    const inp = document.getElementById(id);
    if (radio.value === 'ya') {
        inp.disabled = false;
        inp.readOnly = false;
        inp.classList.add('active');
        inp.required = true;
        inp.focus();
    } else {
        inp.disabled = true;
        inp.readOnly = true;
        inp.value = '';
        inp.classList.remove('active');
        inp.required = false;
    }
}

function handleDudukChange(radio) {
    const w = document.getElementById('wrapper-durasi');
    const s = document.getElementById('durasi_fokus');
    if (radio.value === 'ya') {
        w.classList.remove('opacity-0', 'pointer-events-none');
        s.required = true;
    } else {
        w.classList.add('opacity-0', 'pointer-events-none');
        s.required = false;
        s.value = "";
    }
}
</script>