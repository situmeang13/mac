<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/sidebar.css">
<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<!-- HEADER -->
<header class="h-20 bg-white/90 border-b flex items-center px-10">
    <h2 class="text-xl font-bold text-slate-800">Tambah Karyawan</h2>
</header>

<main class="p-10 max-w-[1200px]">

<!-- HERO -->
<div class="relative overflow-hidden bg-gradient-to-br 
            from-blue-500 to-indigo-600 
            rounded-[32px] p-10 text-white mb-10 shadow-xl">

    <h1 class="text-4xl font-extrabold mb-3">Tambah Data Karyawan</h1>
    <p class="text-blue-100">Masukkan data karyawan baru ke dalam sistem</p>

    <i data-lucide="user-plus" class="absolute right-10 top-1/2 -translate-y-1/2 w-32 h-32 opacity-10"></i>
</div>

<!-- FORM -->
<form action="proses_tambah.php" method="POST" 
      class="bg-white p-8 rounded-2xl shadow space-y-5">

<input type="text" name="nama" placeholder="Nama Lengkap" class="w-full p-3 border rounded-xl">
<input type="text" name="jk" placeholder="Jenis Kelamin" class="w-full p-3 border rounded-xl">
<input type="text" name="asal" placeholder="Asal" class="w-full p-3 border rounded-xl">
<input type="text" name="jabatan" placeholder="Jabatan" class="w-full p-3 border rounded-xl">
<input type="date" name="tgl" class="w-full p-3 border rounded-xl">
<input type="text" name="hp" placeholder="No HP" class="w-full p-3 border rounded-xl">
<input type="number" name="gaji" placeholder="Gaji" class="w-full p-3 border rounded-xl">

<div class="flex gap-3">
<button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl">
Simpan
</button>

<a href="index.php" class="px-6 py-2 bg-slate-200 rounded-xl">
Batal
</a>
</div>

</form>

</main>

<?php include '../includes/footer.php'; ?>
</div>

<script src="../assets/js/sidebar.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>