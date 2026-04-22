<?php include '../../includes/header.php'; ?>
<link rel="stylesheet" href="../../assets/css/sidebar.css">
<?php include '../../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<!-- HEADER -->
<header class="h-20 bg-white/90 backdrop-blur-xl border-b border-slate-200 
flex items-center justify-between px-10 sticky top-0 z-40">

<div class="flex items-center gap-4">
<div class="p-2 bg-indigo-50 rounded-xl">
<i data-lucide="file-text" class="text-indigo-600 w-6 h-6"></i>
</div>

<div>
<h2 class="text-xl font-bold text-slate-800 tracking-tight">
Laporan Profil Anak
</h2>

<p class="text-xs text-slate-500 uppercase tracking-wider">
Hasil Input Data Asesmen
</p>
</div>
</div>

<div class="flex items-center gap-3">
<button onclick="window.print()" class="icon-btn-secondary">
<i data-lucide="printer"></i>
</button>
</div>

</header>


<!-- MAIN -->
<main class="p-8 lg:p-12 flex-grow max-w-[1100px] mx-auto w-full">


<!-- HERO -->
<section class="mb-10">

<div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 to-violet-700 rounded-[2.5rem] p-10 text-white shadow-2xl">

<div class="relative z-10">

<h1 class="text-4xl font-black mb-4">
Laporan Data Anak ASD
</h1>

<p class="text-indigo-100 text-lg">
Ringkasan informasi identitas anak, kondisi keluarga, dan riwayat diagnosa.
</p>

</div>

<i data-lucide="file-bar-chart" class="absolute right-12 top-1/2 -translate-y-1/2 w-40 h-40 opacity-10"></i>

</div>

</section>



<!-- CARD LAPORAN -->
<div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 p-10 space-y-12">

<!-- DATA ORANG TUA -->

<div class="bg-white rounded-2xl border p-10 mb-10">

<h3 class="text-lg font-bold text-slate-800 mb-6">
Data Orang Tua
</h3>


<!-- DATA AYAH -->

<div class="mb-8">

<h4 class="font-semibold text-indigo-700 mb-4">
Data Ayah
</h4>

<div class="grid grid-cols-2 gap-6 text-sm">

<div>
<p class="text-slate-500">Nama Ayah</p>
<p class="font-bold text-slate-800">Budi Santoso</p>
</div>

<div>
<p class="text-slate-500">Tempat Tanggal Lahir</p>
<p class="font-semibold text-slate-700">Madiun, 12 Mei 1985</p>
</div>

<div>
<p class="text-slate-500">Pekerjaan</p>
<p class="font-semibold text-slate-700">Wiraswasta</p>
</div>

<div>
<p class="text-slate-500">Penghasilan</p>
<p class="font-semibold text-slate-700">15 - 25 Juta</p>
</div>

<div>
<p class="text-slate-500">Nomor Telepon</p>
<p class="font-semibold text-slate-700">08123456789</p>
</div>

<div>
<p class="text-slate-500">Email</p>
<p class="font-semibold text-slate-700">budi@email.com</p>
</div>

</div>

</div>



<!-- DATA IBU -->

<div class="mb-8">

<h4 class="font-semibold text-indigo-700 mb-4">
Data Ibu
</h4>

<div class="grid grid-cols-2 gap-6 text-sm">

<div>
<p class="text-slate-500">Nama Ibu</p>
<p class="font-bold text-slate-800">Siti Rahmawati</p>
</div>

<div>
<p class="text-slate-500">Tempat Tanggal Lahir</p>
<p class="font-semibold text-slate-700">Ngawi, 2 Juli 1987</p>
</div>

<div>
<p class="text-slate-500">Pekerjaan</p>
<p class="font-semibold text-slate-700">Ibu Rumah Tangga</p>
</div>

<div>
<p class="text-slate-500">Penghasilan</p>
<p class="font-semibold text-slate-700">5 - 15 Juta</p>
</div>

<div>
<p class="text-slate-500">Nomor Telepon</p>
<p class="font-semibold text-slate-700">08129876543</p>
</div>

<div>
<p class="text-slate-500">Email</p>
<p class="font-semibold text-slate-700">rahma@email.com</p>
</div>

</div>

</div>



<!-- PERSEPSI ORANG TUA -->

<div>

<h4 class="font-semibold text-indigo-700 mb-4">
Persepsi & Harapan Orang Tua
</h4>

<div class="space-y-4 text-sm">

<div>
<p class="text-slate-500">Perkiraan Kondisi Anak</p>
<p class="font-semibold text-slate-700">
ASD
</p>
</div>

<div>
<p class="text-slate-500">Keluhan Anak</p>
<p class="font-semibold text-slate-700">
Anak sulit melakukan kontak mata dan sering mengulang kata.
</p>
</div>

<div>
<p class="text-slate-500">Harapan Orang Tua</p>
<p class="font-semibold text-slate-700">
Anak dapat lebih mandiri dan mampu berinteraksi sosial dengan baik.
</p>
</div>

</div>

</div>

</div>



<!-- IDENTITAS ANAK -->

<div>

<h3 class="text-lg font-bold text-slate-800 mb-6">
Identitas Anak
</h3>

<div class="grid md:grid-cols-2 gap-8 text-sm">

<div>
<p class="text-slate-500">Nama Anak</p>
<p class="font-bold text-slate-800 text-lg">
Ahmad Rizki Pratama
</p>
</div>

<div>
<p class="text-slate-500">Tempat, Tanggal Lahir</p>
<p class="font-semibold text-slate-700">
Madiun, 18 Januari 2016
</p>
</div>

<div class="md:col-span-2">
<p class="text-slate-500">Alamat</p>
<p class="font-semibold text-slate-700">
Jl. Mawar No. 12, Kecamatan Kartoharjo, Kota Madiun, Jawa Timur
</p>
</div>

</div>

</div>



<!-- LINGKUNGAN KELUARGA -->

<div>

<h3 class="text-lg font-bold text-slate-800 mb-6">
Lingkungan Keluarga
</h3>

<div class="grid md:grid-cols-4 gap-6 text-sm">

<div class="bg-slate-50 p-5 rounded-xl border">
<p class="text-slate-500 text-xs">
Hubungan Orang Tua & Anak
</p>

<p class="font-bold text-slate-700 mt-2">
Sangat Dekat
</p>
</div>

<div class="bg-slate-50 p-5 rounded-xl border">
<p class="text-slate-500 text-xs">
Orang Tua Serumah
</p>

<p class="font-bold text-slate-700 mt-2">
Ya
</p>
</div>

<div class="bg-slate-50 p-5 rounded-xl border">
<p class="text-slate-500 text-xs">
Diasuh Orang Tua
</p>

<p class="font-bold text-slate-700 mt-2">
Ya
</p>
</div>

<div class="bg-slate-50 p-5 rounded-xl border">
<p class="text-slate-500 text-xs">
Diasuh Wali
</p>

<p class="font-bold text-slate-700 mt-2">
Tidak
</p>
</div>

</div>


<div class="mt-6 bg-indigo-50 border border-indigo-100 p-6 rounded-2xl">

<p class="text-sm text-slate-500">
Urutan Bersaudara
</p>

<p class="text-lg font-bold text-indigo-700">
Anak ke-2 dari 3 bersaudara
</p>

</div>

</div>



<!-- DATA DIAGNOSA -->

<div>

<h3 class="text-lg font-bold text-slate-800 mb-6">
Riwayat Diagnosa
</h3>

<div class="grid md:grid-cols-3 gap-6 text-sm">

<div class="bg-slate-50 p-5 rounded-xl border">
<p class="text-slate-500 text-xs">
Usia Saat Diagnosa
</p>

<p class="font-bold text-slate-700 mt-2">
3 Tahun 2 Bulan
</p>
</div>

<div class="bg-slate-50 p-5 rounded-xl border">
<p class="text-slate-500 text-xs">
Lembaga Diagnosa
</p>

<p class="font-bold text-slate-700 mt-2">
RSUD Tipe A
</p>
</div>

<div class="bg-slate-50 p-5 rounded-xl border">
<p class="text-slate-500 text-xs">
Usia Anak Saat Ini
</p>

<p class="font-bold text-slate-700 mt-2">
8 Tahun
</p>
</div>

</div>

</div>



<!-- DOKUMEN -->

<div>

<h3 class="text-lg font-bold text-slate-800 mb-6">
Dokumen Diagnosa
</h3>

<div class="bg-slate-50 border rounded-2xl p-6 flex items-center gap-4">

<i data-lucide="file-text" class="text-indigo-600 w-8 h-8"></i>

<div>
<p class="font-semibold text-slate-700">
diagnosa_asd.pdf
</p>

<p class="text-xs text-slate-500">
Dokumen hasil diagnosa anak
</p>
</div>

</div>

</div>



<!-- VIDEO -->

<div>

<h3 class="text-lg font-bold text-slate-800 mb-6">
Video Aktivitas Anak
</h3>

<div class="rounded-2xl overflow-hidden border">

<video controls class="w-full">

<source src="../../assets/video/contoh.mp4" type="video/mp4">

</video>

</div>

</div>

<!-- RIWAYAT KELAHIRAN -->

<div>

<h3 class="text-lg font-bold text-slate-800 mb-6">
Riwayat Kehamilan & Persalinan
</h3>

<div class="space-y-6 text-sm">

<div class="bg-slate-50 p-6 rounded-xl border">
<p class="text-slate-500 text-xs">
Kondisi Kesehatan & Psikologis Ibu Saat Hamil
</p>

<p class="font-semibold text-slate-700 mt-2">
<?= $riwayat['kondisi_ibu'] ?? '-' ?>
</p>
</div>


<div class="grid md:grid-cols-2 gap-6">

<div class="bg-slate-50 p-5 rounded-xl border">
<p class="text-slate-500 text-xs">
Konsumsi Fast Food
</p>

<p class="font-bold text-slate-700 mt-2">
<?= $riwayat['fastfood'] ?? '-' ?>
</p>

<p class="text-xs text-slate-500 mt-2">
<?= $riwayat['fastfood_comment'] ?? '' ?>
</p>
</div>


<div class="bg-slate-50 p-5 rounded-xl border">
<p class="text-slate-500 text-xs">
Konsumsi Seafood
</p>

<p class="font-bold text-slate-700 mt-2">
<?= $riwayat['seafood'] ?? '-' ?>
</p>
</div>

</div>


<div class="bg-slate-50 p-6 rounded-xl border">
<p class="text-slate-500 text-xs">
Konsumsi Obat / Suplemen Saat Hamil
</p>

<p class="font-semibold text-slate-700 mt-2">
<?= $riwayat['obat'] ?? '-' ?>
</p>

<p class="text-xs text-slate-500 mt-2">
<?= $riwayat['obat_comment'] ?? '' ?>
</p>
</div>


<div class="grid md:grid-cols-2 gap-6">

<div class="bg-slate-50 p-6 rounded-xl border">
<p class="text-slate-500 text-xs">
Proses Persalinan
</p>

<p class="font-semibold text-slate-700 mt-2">
<?= $riwayat['proses_persalinan'] ?? '-' ?>
</p>
</div>


<div class="bg-slate-50 p-6 rounded-xl border">
<p class="text-slate-500 text-xs">
Peran Ayah & Dukungan Keluarga
</p>

<p class="font-semibold text-slate-700 mt-2">
<?= $riwayat['peran_keluarga'] ?? '-' ?>
</p>
</div>

</div>

</div>

</div>

<!-- KESEHATAN ANAK -->

<div>

<h3 class="text-lg font-bold text-slate-800 mb-6">
Kesehatan Anak
</h3>

<div class="space-y-6 text-sm">

<!-- PARAMETER FISIK -->

<div class="grid md:grid-cols-2 gap-6">

<div class="bg-slate-50 p-6 rounded-xl border">
<p class="text-slate-500 text-xs">
Tinggi Badan
</p>

<p class="font-bold text-slate-700 mt-2">
120 cm
</p>
</div>

<div class="bg-slate-50 p-6 rounded-xl border">
<p class="text-slate-500 text-xs">
Berat Badan
</p>

<p class="font-bold text-slate-700 mt-2">
25 kg
</p>
</div>

</div>


<!-- KONDISI PENYERTA -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs">
Kondisi Penyerta
</p>

<p class="font-semibold text-slate-700 mt-2">
Tidak Ada
</p>

</div>


<!-- POLA MAKAN -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs">
Pola Konsumsi 3 Bulan Terakhir
</p>

<p class="font-semibold text-slate-700 mt-2">
Anak mengonsumsi nasi, ayam, telur, susu, dan buah setiap hari.
Minuman favorit adalah susu dan jus jeruk.
</p>

</div>


<!-- MAKANAN FAVORIT -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs">
Makanan Favorit Anak
</p>

<p class="font-semibold text-slate-700 mt-2">
Ayam goreng, mie, nugget, dan pisang.
</p>

</div>


<!-- KEGIATAN FAVORIT -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs">
Kegiatan Favorit Anak
</p>

<p class="font-semibold text-slate-700 mt-2">
Menonton video kartun, bermain puzzle, dan menyusun balok.
</p>

</div>


<!-- MEDIKASI -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs">
Konsumsi Obat Rutin
</p>

<p class="font-semibold text-slate-700 mt-2">
Tidak Mengkonsumsi Obat
</p>

</div>

</div>

</div>

<!-- KONDISI TERKINI ANAK -->

<div>

<h3 class="text-lg font-bold text-slate-800 mb-6">
Kondisi Terkini Anak
</h3>

<div class="space-y-8 text-sm">

<!-- MOTORIK KASAR -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs mb-4">
Kemampuan Motorik Kasar
</p>

<div class="grid md:grid-cols-2 gap-4">

<div class="flex justify-between">
<span>Merangkak</span>
<span class="font-semibold text-green-600">Baik & Lancar</span>
</div>

<div class="flex justify-between">
<span>Duduk</span>
<span class="font-semibold text-green-600">Baik & Lancar</span>
</div>

<div class="flex justify-between">
<span>Berdiri</span>
<span class="font-semibold text-orange-500">Butuh Bantuan</span>
</div>

<div class="flex justify-between">
<span>Berjalan</span>
<span class="font-semibold text-green-600">Baik & Lancar</span>
</div>

<div class="flex justify-between">
<span>Berlari</span>
<span class="font-semibold text-orange-500">Butuh Bantuan</span>
</div>

<div class="flex justify-between">
<span>Melompat</span>
<span class="font-semibold text-red-500">Tidak Bisa</span>
</div>

</div>

</div>


<!-- TANTRUM -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs mb-4">
Stabilitas Emosi (Tantrum)
</p>

<div class="grid md:grid-cols-2 gap-6">

<div>
<p class="text-slate-400 text-xs">Frekuensi Tantrum</p>
<p class="font-semibold text-slate-700">3-5 kali per hari</p>
</div>

<div>
<p class="text-slate-400 text-xs">Durasi Tantrum</p>
<p class="font-semibold text-slate-700">6 - 10 menit</p>
</div>

</div>

<div class="mt-4">
<p class="text-slate-400 text-xs mb-2">Perilaku Marah</p>
<p class="font-semibold text-slate-700">
Berteriak, Menendang, Memukul
</p>
</div>

</div>


<!-- ADL -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs mb-4">
Aktivitas Harian (ADL)
</p>

<div class="grid md:grid-cols-2 gap-4">

<div class="flex justify-between">
<span>Menyiapkan alat makan</span>
<span class="font-semibold text-orange-500">Butuh Bantuan</span>
</div>

<div class="flex justify-between">
<span>Makan sendiri</span>
<span class="font-semibold text-green-600">Bisa</span>
</div>

<div class="flex justify-between">
<span>Sikat gigi</span>
<span class="font-semibold text-orange-500">Butuh Bantuan</span>
</div>

<div class="flex justify-between">
<span>Berpakaian sendiri</span>
<span class="font-semibold text-red-500">Tidak Bisa</span>
</div>

</div>

</div>


<!-- KOMUNIKASI -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs mb-4">
Komunikasi & Interaksi Sosial
</p>

<div class="grid md:grid-cols-2 gap-6">

<div>
<p class="text-slate-400 text-xs">Durasi Kontak Mata</p>
<p class="font-semibold text-slate-700">4 - 6 detik</p>
</div>

<div>
<p class="text-slate-400 text-xs">Senang Bermain Dengan Orang Lain</p>
<p class="font-semibold text-slate-700">Ya</p>
</div>

</div>

<div class="mt-4">
<p class="text-slate-400 text-xs mb-2">Catatan Komunikasi</p>
<p class="font-semibold text-slate-700">
Anak mulai merespon ketika dipanggil namanya dan mulai mencoba meniru beberapa kata sederhana.
</p>
</div>

</div>

</div>

</div>

<!-- KEMAMPUAN AKADEMIK ANAK -->

<div>

<h3 class="text-lg font-bold text-slate-800 mb-6">
Kemampuan Akademik Anak
</h3>

<div class="space-y-8 text-sm">

<!-- NUMERASI -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs mb-4">
Kemampuan Numerasi (0-100)
</p>

<div class="grid md:grid-cols-2 gap-4">

<div class="flex justify-between">
<span>Mengenal angka 0-10</span>
<span class="font-semibold text-green-600">Dikuasai</span>
</div>

<div class="flex justify-between">
<span>Mengenal angka 11-20</span>
<span class="font-semibold text-green-600">Dikuasai</span>
</div>

<div class="flex justify-between">
<span>Mengenal angka 21-30</span>
<span class="font-semibold text-green-600">Dikuasai</span>
</div>

<div class="flex justify-between">
<span>Mengenal angka 31-40</span>
<span class="font-semibold text-orange-500">Belum</span>
</div>

<div class="flex justify-between">
<span>Mengenal angka 41-50</span>
<span class="font-semibold text-orange-500">Belum</span>
</div>

</div>

</div>


<!-- OPERASI HITUNG -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs mb-4">
Kemampuan Penjumlahan
</p>

<div class="grid md:grid-cols-2 gap-4">

<div class="flex justify-between">
<span>Satuan (2 + 2)</span>
<span class="font-semibold text-green-600">Dikuasai</span>
</div>

<div class="flex justify-between">
<span>Puluhan (10 + 15)</span>
<span class="font-semibold text-orange-500">Belum</span>
</div>

<div class="flex justify-between">
<span>Ribuan</span>
<span class="font-semibold text-red-500">Belum</span>
</div>

<div class="flex justify-between">
<span>Jutaan</span>
<span class="font-semibold text-red-500">Belum</span>
</div>

</div>

</div>


<!-- LITERASI -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs mb-4">
Kemampuan Literasi
</p>

<div class="grid md:grid-cols-2 gap-4">

<div class="flex justify-between">
<span>Mengenal huruf A-Z</span>
<span class="font-semibold text-green-600">Dikuasai</span>
</div>

<div class="flex justify-between">
<span>Membaca 1 suku kata</span>
<span class="font-semibold text-green-600">Dikuasai</span>
</div>

<div class="flex justify-between">
<span>Membaca 2 suku kata</span>
<span class="font-semibold text-orange-500">Belum</span>
</div>

<div class="flex justify-between">
<span>Memahami 3-5 kalimat</span>
<span class="font-semibold text-red-500">Belum</span>
</div>

</div>

</div>


<!-- KESIAPAN BELAJAR -->

<div class="bg-slate-50 p-6 rounded-xl border">

<p class="text-slate-500 text-xs mb-4">
Kesiapan Belajar
</p>

<div class="grid md:grid-cols-2 gap-6">

<div>
<p class="text-slate-400 text-xs">Duduk Tenang</p>
<p class="font-semibold text-slate-700">Ya, Bisa</p>
</div>

<div>
<p class="text-slate-400 text-xs">Durasi Fokus</p>
<p class="font-semibold text-slate-700">6-15 Menit</p>
</div>

</div>

<div class="mt-4">
<p class="text-slate-400 text-xs mb-2">Catatan Observasi</p>
<p class="font-semibold text-slate-700">
Anak mampu mengikuti instruksi sederhana dan mulai fokus saat kegiatan belajar dengan bantuan visual.
</p>
</div>

</div>

</div>

</div>



<!-- FOOTER -->

<div class="border-t pt-6 flex justify-between text-xs text-slate-500">

<p>
Sistem Asesmen Anak ASD
</p>

<p>
Dicetak otomatis oleh sistem
</p>

</div>


</div>

</main>

<?php include '../../includes/footer.php'; ?>

</div>

<script src="../../assets/js/sidebar.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
lucide.createIcons();
</script>

<style>

.icon-btn-secondary{
width:42px;
height:42px;
display:flex;
align-items:center;
justify-content:center;
border-radius:12px;
color:#64748b;
background:#f8fafc;
border:1px solid #f1f5f9;
}

</style>