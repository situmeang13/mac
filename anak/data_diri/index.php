<?php
session_start();

// PROTEKSI
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['orang_tua', 'bos'])) {
    echo "<script>alert('Akses Ditolak!'); window.history.back();</script>";
    exit;
}

include '../../koneksi/koneksi.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// INIT
$data = null;
$dokumen_list = [];
$video_list = [];
$is_edit_mode = false;

$id_edit = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// AMBIL DATA
if ($id_edit > 0) {

    $stmt = $conn->prepare("SELECT * FROM anak WHERE id_anak = ?");
    $stmt->bind_param("i", $id_edit);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if ($data) {
        $is_edit_mode = true;

        $doc = $conn->prepare("SELECT * FROM dokumen WHERE id_anak = ?");
        $doc->bind_param("i", $id_edit);
        $doc->execute();
        $dokumen_list = $doc->get_result()->fetch_all(MYSQLI_ASSOC);

        $vid = $conn->prepare("SELECT * FROM video WHERE id_anak = ?");
        $vid->bind_param("i", $id_edit);
        $vid->execute();
        $video_list = $vid->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

$form_action = $is_edit_mode ? 'update_anak.php' : 'simpan_anak.php';
?>

<?php include '../../includes/header.php'; ?>

<link rel="stylesheet" href="../../assets/css/sidebar.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Google Fonts (FIX) -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

<style>
:root {
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --secondary: #ec4899;
}

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

:root {
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --secondary: #ec4899;
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
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

.custom-file-upload {
    border: 2px dashed #e2e8f0;
    display: block;
    padding: 20px;
    text-align: center;
    border-radius: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.custom-file-upload:hover {
    border-color: var(--primary);
    background-color: rgba(99, 102, 241, 0.05);
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

select.form-modern-input {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1.2em;
}
</style>

<?php include '../../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 bg-slate-50 min-h-screen">

    <!-- HEADER -->
    <div class="hero-gradient px-10 pt-16 pb-32 text-white">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-3xl font-extrabold flex items-center gap-3">
                <i class="fa-solid fa-child-pulse"></i>
                <?= $is_edit_mode ? 'Edit Data Anak' : 'Registrasi Data Anak' ?>
            </h1>
            <p class="text-indigo-100 mt-2 opacity-90">Harap isi informasi kondisi anak dengan detail untuk mendukung
                proses diagnosa dan terapi.</p>
        </div>
    </div>

    <main class="px-10 -mt-20 pb-20">
        <div class="max-w-5xl mx-auto">
            <form method="POST" enctype="multipart/form-data" action="<?= $form_action ?>" class="space-y-8">

                <?php if ($is_edit_mode): ?>
                <input type="hidden" name="id_anak" value="<?= $data['id_anak'] ?>">
                <?php endif; ?>

                <!-- SECTION 1: DATA DIRI -->
                <div class="glass-card rounded-3xl p-8 shadow-xl border-t-4 border-indigo-500">
                    <div class="flex items-center mb-8">
                        <div class="section-icon bg-indigo-100 text-indigo-600">
                            <i class="fa-solid fa-user-astronaut text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Identitas Anak</h3>
                            <p class="text-sm text-gray-500">Informasi dasar mengenai buah hati Anda.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Anak *</label>
                            <input type="text" name="nama_anak" class="form-modern-input"
                                placeholder="Masukkan nama lengkap anak" value="<?= $data['nama_anak'] ?? '' ?>"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Tanggal Lahir *
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">
                                    <i class="fa-solid fa-calendar-day"></i>
                                </span>

                                <input type="date" name="tanggal_lahir" class="form-modern-input pl-12"
                                    value="<?= $data['tanggal_lahir'] ?? '' ?>" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Urutan Anak *</label>
                            <input type="text" name="urutan_anak" class="form-modern-input"
                                placeholder="Contoh: Anak ke 2 dari 3 bersaudara"
                                value="<?= $data['urutan_anak'] ?? '' ?>" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kelamin *</label>
                            <select name="jenis_kelamin" class="form-modern-input" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" <?= ($data['jenis_kelamin'] ?? '')=='L'?'selected':'' ?>>Laki-laki
                                </option>
                                <option value="P" <?= ($data['jenis_kelamin'] ?? '')=='P'?'selected':'' ?>>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Domisili Anak *</label>
                            <textarea name="alamat" rows="3" class="form-modern-input"
                                placeholder="Alamat lengkap tempat tinggal saat ini..."
                                required><?= $data['alamat'] ?? '' ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: LINGKUNGAN KELUARGA -->
                <div class="glass-card rounded-3xl p-8 shadow-xl border-t-4 border-pink-500">
                    <div class="flex items-center mb-8">
                        <div class="section-icon bg-pink-100 text-pink-600">
                            <i class="fa-solid fa-house-chimney-user text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Lingkungan Keluarga</h3>
                            <p class="text-sm text-gray-500">Kondisi pengasuhan dan interaksi harian.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Hubungan Orang Tua & Anak *</label>
                            <select name="hubungan" class="form-modern-input" required>
                                <option value="">Pilih Kedekatan</option>
                                <option value="Biasa Saja" <?= ($data['hubungan'] ?? '')=='Biasa Saja'?'selected':'' ?>>
                                    Biasa Saja</option>
                                <option value="Cukup Dekat"
                                    <?= ($data['hubungan'] ?? '')=='Cukup Dekat'?'selected':'' ?>>Cukup Dekat / Akrab
                                </option>
                                <option value="Akrab" <?= ($data['hubungan'] ?? '')=='Akrab'?'selected':'' ?>>Akrab
                                </option>
                                <option value="Sangat Dekat"
                                    <?= ($data['hubungan'] ?? '')=='Sangat Dekat'?'selected':'' ?>>Sangat Dekat</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Apakah Orang Tua Satu Rumah? *</label>
                            <div class="flex gap-4 mt-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="ortu_serumah" value="Ya"
                                        <?= ($data['ortu_serumah'] ?? 'Ya')=='Ya'?'checked':'' ?>
                                        class="w-4 h-4 text-pink-600"> Ya
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="ortu_serumah" value="Tidak"
                                        <?= ($data['ortu_serumah'] ?? '')=='Tidak'?'checked':'' ?>
                                        class="w-4 h-4 text-pink-600"> Tidak
                                </label>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <label class="block font-bold text-gray-700 mb-3">Pola Pengasuhan Utaman:</label>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span>Diasuh Orang Tua Langsung?</span>
                                    <select name="diasuh_ortu" class="bg-white border rounded-lg px-2 py-1">
                                        <option value="Ya" <?= ($data['diasuh_ortu'] ?? 'Ya')=='Ya'?'selected':'' ?>>Ya
                                        </option>
                                        <option value="Tidak"
                                            <?= ($data['diasuh_ortu'] ?? '')=='Tidak'?'selected':'' ?>>Tidak</option>
                                    </select>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Diasuh Wali/Saudara?</span>
                                    <select name="diasuh_wali" class="bg-white border rounded-lg px-2 py-1">
                                        <option value="Ya" <?= ($data['diasuh_wali'] ?? '')=='Ya'?'selected':'' ?>>Ya
                                        </option>
                                        <option value="Tidak"
                                            <?= ($data['diasuh_wali'] ?? 'Tidak')=='Tidak'?'selected':'' ?>>Tidak
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: RIWAYAT DIAGNOSA -->
                <div class="glass-card rounded-3xl p-8 shadow-xl border-t-4 border-amber-500">
                    <div class="flex items-center mb-8">
                        <div class="section-icon bg-amber-100 text-amber-600">
                            <i class="fa-solid fa-file-medical text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Riwayat Diagnosa</h3>
                            <p class="text-sm text-gray-500">Detail medis mengenai diagnosa ASD anak.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Usia Saat Diagnosa *</label>
                            <input type="text" name="usia_diagnosa" class="form-modern-input"
                                placeholder="Contoh: 3 Tahun 2 Bulan" value="<?= $data['usia_diagnosa'] ?? '' ?>"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Diagnosa Oleh Siapa? *</label>
                            <select name="siapa_diagnosa" class="form-modern-input" required>
                                <option value="">Pilih Tenaga Medis</option>
                                <option value="Psikiater"
                                    <?= ($data['siapa_diagnosa'] ?? '')=='Psikiater'?'selected':'' ?>>Psikiater</option>
                                <option value="Psikiatri"
                                    <?= ($data['siapa_diagnosa'] ?? '')=='Psikiatri'?'selected':'' ?>>Psikiatri</option>
                                <option value="RSUD Tipe A"
                                    <?= ($data['siapa_diagnosa'] ?? '')=='RSUD Tipe A'?'selected':'' ?>>RSUD Tipe A
                                </option>
                                <option value="Lembaga Psikologi"
                                    <?= ($data['siapa_diagnosa'] ?? '')=='Lembaga Psikologi'?'selected':'' ?>>Lembaga
                                    Psikologi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Usia Saat Ini *</label>
                            <input type="text" name="usia_sekarang" class="form-modern-input"
                                placeholder="Usia anak sekarang" value="<?= $data['usia_sekarang'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: MEDIA PENDUKUNG -->
                <div class="glass-card rounded-3xl p-8 shadow-xl border-t-4 border-emerald-500">
                    <div class="flex items-center mb-8">
                        <div class="section-icon bg-emerald-100 text-emerald-600">
                            <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Dokumen & Video</h3>
                            <p class="text-sm text-gray-500">Lampirkan bukti diagnosa dan perilaku anak.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3 text-center">Dokumen Diagnosis
                                (PDF/Gambar)</label>
                            <?php if ($is_edit_mode && !empty($dokumen_list)): ?>
                            <div class="mt-6">
                                <h4 class="text-sm font-bold text-gray-600 mb-3">Dokumen Tersimpan</h4>

                                <div class="space-y-2">
                                    <?php foreach ($dokumen_list as $doc): ?>
                                    <div class="flex items-center justify-between bg-slate-50 p-3 rounded-xl border">
                                        <a href="../../<?= $doc['path_file'] ?>" target="_blank">
                                            📄 <?= $doc['nama_file'] ?>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <label for="dokumen" class="custom-file-upload group">
                                <div class="text-emerald-500 mb-2 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-file-pdf text-4xl"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Klik untuk pilih beberapa file</span>
                                <input type="file" id="dokumen" name="dokumen[]" multiple class="hidden">
                            </label>
                            <div id="file-list-doc" class="mt-2 text-xs text-gray-500 italic"></div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3 text-center">Video Perilaku/Kondisi
                                Anak</label>
                            <?php if ($is_edit_mode && !empty($video_list)): ?>
                            <div class="mt-6">
                                <h4 class="text-sm font-bold text-gray-600 mb-3">Video Tersimpan</h4>

                                <div class="space-y-3">
                                    <?php foreach ($video_list as $vid): ?>
                                    <div class="bg-slate-50 p-3 rounded-xl border">
                                        <video controls width="100%">
                                            <source src="../../<?= $vid['path_file'] ?>" type="video/mp4">
                                        </video>

                                        <p class="text-xs text-gray-500 mt-2">
                                            <?= $vid['nama_file'] ?>
                                        </p>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <label for="video" class="custom-file-upload group">
                                <div class="text-blue-500 mb-2 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-video text-4xl"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-600">Klik untuk pilih beberapa video</span>
                                <input type="file" id="video" name="video[]" multiple class="hidden">
                            </label>
                            <div id="file-list-vid" class="mt-2 text-xs text-gray-500 italic"></div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER BUTTONS -->
                <div
                    class="flex items-center justify-between bg-white p-6 rounded-2xl shadow-lg border border-slate-200">
                    <button type="button" onclick="history.back()"
                        class="flex items-center gap-2 px-8 py-4 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </button>

                    <button type="submit"
                        class="flex items-center gap-2 px-10 py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transform hover:-translate-y-1 transition-all">
                        <i class="fa-solid fa-save"></i>
                        <?= $is_edit_mode ? 'Perbarui Data Anak' : 'Simpan Data Sekarang' ?>
                    </button>
                </div>

            </form>
        </div>
    </main>

    <?php include '../../includes/footer.php'; ?>

</div>
<script>
document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('dokumen')?.addEventListener('change', function(e) {
        let files = Array.from(e.target.files).map(f => f.name).join(', ');
        document.getElementById('file-list-doc').innerText = files ? "Terpilih: " + files : "";
    });

    document.getElementById('video')?.addEventListener('change', function(e) {
        let files = Array.from(e.target.files).map(f => f.name).join(', ');
        document.getElementById('file-list-vid').innerText = files ? "Terpilih: " + files : "";
    });

});
</script>