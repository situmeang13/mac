<?php 
session_start();
include '../koneksi/koneksi.php';

/*
========================================
1. PROTEKSI HALAMAN (ORANG TUA & BOS)
========================================
*/
if (!isset($_SESSION['id_user']) || 
   !in_array($_SESSION['role'], ['orang_tua','bos'])) {

    header("Location: /mac/auth/login/index.php?pesan=belum_login");
    exit;
}

$id_user = (int) $_SESSION['id_user'];

/*
========================================
2. AMBIL DATA ORANG TUA (FIX TANPA UBAH UI)
========================================
*/
$query = "SELECT * FROM orang_tua WHERE id_user = $id_user LIMIT 1";
$result = mysqli_query($conn, $query);

// DEBUG jika error (biar tidak blank)
if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($result);

// Tentukan action (TIDAK MENGUBAH UI)
$action_file = $data ? 'update.php' : 'simpan.php';
?>

<?php include '../includes/header.php'; ?>

<link rel="stylesheet" href="../assets/css/sidebar.css">
<!-- Menggunakan Font Awesome untuk Ikon -->
<link rel="stylesheet" href="[suspicious link removed]">

<style>
:root {
    --primary: #4f46e5;
    --primary-hover: #4338ca;
}

.glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.form-input {
    transition: all 0.3s ease;
    border: 1.5px solid #e5e7eb;
}

.form-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    outline: none;
}

.hero-gradient {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
}

.section-card {
    border-radius: 16px;
    transition: transform 0.2s ease;
}

.section-card:hover {
    transform: translateY(-2px);
}

/* Custom style for Select arrow */
select.form-input {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
</style>

<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 bg-gray-50 min-h-screen">

    <!-- HERO SECTION -->
    <div class="hero-gradient px-10 pt-16 pb-32 text-white relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-4xl font-extrabold mb-2">Profil Orang Tua</h1>
            <p class="text-indigo-100 max-w-2xl text-lg">
                Lengkapi data diri Anda dan kondisi buah hati untuk membantu kami memberikan layanan terapi dan
                pendampingan yang paling tepat.
            </p>
        </div>
        <!-- Dekorasi Abstrak -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 opacity-20">
            <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#FFF"
                    d="M44.7,-76.4C58.3,-69.2,70.1,-58.5,78.5,-45.5C86.9,-32.5,91.9,-17.2,90.6,-2.3C89.3,12.6,81.7,27.1,72.1,40.1C62.5,53.1,51,64.6,37.3,71.7C23.6,78.8,7.7,81.5,-8.3,79.9C-24.3,78.2,-40.4,72.3,-53.8,62.8C-67.2,53.3,-78,40.2,-83.4,25.3C-88.8,10.3,-88.8,-6.4,-84.1,-21.9C-79.4,-37.4,-70,-51.7,-57.4,-59.4C-44.8,-67.2,-28.9,-68.5,-14.2,-71.4C0.4,-74.3,15.1,-78.7,31.1,-83.6C47.1,-88.5,64.4,-94,44.7,-76.4Z"
                    transform="translate(100 100)" />
            </svg>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="px-10 -mt-20 pb-20">
        <form method="POST" action="<?= $action_file ?>" class="space-y-8">
            <input type="hidden" name="id" value="<?= $data['id'] ?? '' ?>">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- DATA AYAH -->
                <div class="glass-card p-8 rounded-2xl shadow-xl section-card border-t-4 border-blue-500">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fa-solid fa-person text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Identitas Ayah</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_ayah" placeholder="Masukkan nama lengkap ayah"
                                value="<?= $data['nama_ayah'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Tempat, Tanggal Lahir</label>
                            <input type="text" name="ttl_ayah" placeholder="Contoh: Jakarta, 12-05-1980"
                                value="<?= $data['ttl_ayah'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan_ayah" placeholder="Pekerjaan saat ini"
                                value="<?= $data['pekerjaan_ayah'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Jabatan</label>
                            <input type="text" name="jabatan_ayah" placeholder="Contoh: Manager, Staff"
                                value="<?= $data['jabatan_ayah'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Rata-rata Gaji</label>
                            <select name="gaji_ayah" class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                                <option value="">Pilih Range Gaji</option>
                                <option value="5 - 15 Juta"
                                    <?= ($data['gaji_ayah'] ?? '') == '5 - 15 Juta' ? 'selected' : '' ?>>5 - 15 Juta
                                </option>
                                <option value="15 - 25 Juta"
                                    <?= ($data['gaji_ayah'] ?? '') == '15 - 25 Juta' ? 'selected' : '' ?>>15 - 25 Juta
                                </option>
                                <option value="25 - 50 Juta"
                                    <?= ($data['gaji_ayah'] ?? '') == '25 - 50 Juta' ? 'selected' : '' ?>>25 - 50 Juta
                                </option>
                                <option value="> 50 Juta"
                                    <?= ($data['gaji_ayah'] ?? '') == '> 50 Juta' ? 'selected' : '' ?>> > 50 Juta
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Nomor WhatsApp</label>
                            <input type="text" name="telp_ayah" placeholder="08xxxxxx"
                                value="<?= $data['telp_ayah'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                            <input type="email" name="email_ayah" placeholder="ayah@example.com"
                                value="<?= $data['email_ayah'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Alamat Domisili</label>
                            <textarea name="alamat_ayah" class="form-input w-full p-3 rounded-lg bg-gray-50 h-20"
                                placeholder="Alamat lengkap tempat tinggal..."
                                required><?= $data['alamat_ayah'] ?? '' ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- DATA IBU -->
                <div class="glass-card p-8 rounded-2xl shadow-xl section-card border-t-4 border-pink-500">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center mr-4">
                            <i class="fa-solid fa-person-dress text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Identitas Ibu</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_ibu" placeholder="Masukkan nama lengkap ibu"
                                value="<?= $data['nama_ibu'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Tempat, Tanggal Lahir</label>
                            <input type="text" name="ttl_ibu" placeholder="Contoh: Bandung, 20-08-1985"
                                value="<?= $data['ttl_ibu'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan_ibu" placeholder="Pekerjaan saat ini"
                                value="<?= $data['pekerjaan_ibu'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Jabatan</label>
                            <input type="text" name="jabatan_ibu" placeholder="Contoh: Sekretaris, Pemilik Usaha"
                                value="<?= $data['jabatan_ibu'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Rata-rata Gaji</label>
                            <select name="gaji_ibu" class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                                <option value="">Pilih Range Gaji</option>
                                <option value="5 - 15 Juta"
                                    <?= ($data['gaji_ibu'] ?? '') == '5 - 15 Juta' ? 'selected' : '' ?>>5 - 15 Juta
                                </option>
                                <option value="15 - 25 Juta"
                                    <?= ($data['gaji_ibu'] ?? '') == '15 - 25 Juta' ? 'selected' : '' ?>>15 - 25 Juta
                                </option>
                                <option value="25 - 50 Juta"
                                    <?= ($data['gaji_ibu'] ?? '') == '25 - 50 Juta' ? 'selected' : '' ?>>25 - 50 Juta
                                </option>
                                <option value="> 50 Juta"
                                    <?= ($data['gaji_ibu'] ?? '') == '> 50 Juta' ? 'selected' : '' ?>> > 50 Juta
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Nomor WhatsApp</label>
                            <input type="text" name="telp_ibu" placeholder="08xxxxxx"
                                value="<?= $data['telp_ibu'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                            <input type="email" name="email_ibu" placeholder="ibu@example.com"
                                value="<?= $data['email_ibu'] ?? '' ?>"
                                class="form-input w-full p-3 rounded-lg bg-gray-50" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Alamat Domisili</label>
                            <textarea name="alamat_ibu" class="form-input w-full p-3 rounded-lg bg-gray-50 h-20"
                                placeholder="Alamat lengkap tempat tinggal..."
                                required><?= $data['alamat_ibu'] ?? '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KONDISI ANAK -->
            <div class="glass-card p-8 rounded-2xl shadow-xl section-card border-t-4 border-indigo-600">
                <div class="flex items-center mb-6">
                    <div
                        class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mr-4">
                        <i class="fa-solid fa-child-reaching text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Informasi Kondisi Anak</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Diagnosa Utama</label>
                        <select name="kondisi_anak" class="form-input w-full p-3 rounded-lg bg-gray-50 appearance-none"
                            required>
                            <option value="">Pilih Kondisi</option>
                            <option value="ASD" <?= ($data['kondisi_anak'] ?? '') == 'ASD' ? 'selected':'' ?>>ASD
                                (Autism Spectrum Disorder)</option>
                            <option value="ADHD" <?= ($data['kondisi_anak'] ?? '') == 'ADHD' ? 'selected':'' ?>>ADHD
                            </option>
                            <option value="Lainnya" <?= ($data['kondisi_anak'] ?? '') == 'Lainnya' ? 'selected':'' ?>>
                                Lainnya</option>
                        </select>
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Keluhan Utama</label>
                        <textarea name="keluhan" class="form-input w-full p-3 rounded-lg bg-gray-50 h-32"
                            placeholder="Deskripsikan hambatan yang dialami anak..."
                            required><?= $data['keluhan'] ?? '' ?></textarea>
                    </div>
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Harapan Orang Tua</label>
                        <textarea name="harapan" class="form-input w-full p-3 rounded-lg bg-gray-50 h-32"
                            placeholder="Apa yang Ayah/Ibu harapkan dari program ini?"
                            required><?= $data['harapan'] ?? '' ?></textarea>
                    </div>
                </div>

                <!-- SUBMIT BUTTON -->
                <div class="mt-10 flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-10 rounded-xl transition-all shadow-lg hover:shadow-indigo-200 transform hover:-translate-y-1 flex items-center">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                        <?= $data ? 'Perbarui Profil' : 'Simpan Profil Sekarang' ?>
                    </button>
                </div>
            </div>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>


</div>