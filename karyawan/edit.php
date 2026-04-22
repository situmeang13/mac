<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/sidebar.css">
<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<header class="h-20 bg-white border-b flex items-center px-10">
    <h2 class="text-xl font-bold">Edit Karyawan</h2>
</header>

<main class="p-10 max-w-[1200px]">

<!-- HERO -->
<div class="relative overflow-hidden bg-gradient-to-br 
            from-green-500 to-emerald-600 
            rounded-[32px] p-10 text-white mb-10 shadow-xl">

    <h1 class="text-4xl font-extrabold mb-3">Edit Data Karyawan</h1>
    <p class="text-green-100">Perbarui informasi karyawan</p>

    <i data-lucide="edit" class="absolute right-10 top-1/2 -translate-y-1/2 w-32 h-32 opacity-10"></i>
</div>

<form action="proses_edit.php" method="POST" 
      class="bg-white p-8 rounded-2xl shadow space-y-5">

<input type="hidden" name="id" value="1">

<input type="text" name="nama" value="Andi Pratama" class="w-full p-3 border rounded-xl">
<input type="text" name="jk" value="Laki-laki" class="w-full p-3 border rounded-xl">
<input type="text" name="asal" value="Malang" class="w-full p-3 border rounded-xl">
<input type="text" name="jabatan" value="Staff Administrasi" class="w-full p-3 border rounded-xl">
<input type="date" name="tgl" class="w-full p-3 border rounded-xl">
<input type="text" name="hp" value="081234567890" class="w-full p-3 border rounded-xl">
<input type="number" name="gaji" value="4000000" class="w-full p-3 border rounded-xl">

<div class="flex gap-3">
<button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-xl">
Update
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