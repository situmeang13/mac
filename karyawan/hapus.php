<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/sidebar.css">
<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<header class="h-20 bg-white border-b flex items-center px-10">
    <h2 class="text-xl font-bold">Hapus Karyawan</h2>
</header>

<main class="p-10 max-w-[900px]">

<!-- HERO -->
<div class="relative overflow-hidden bg-gradient-to-br 
            from-red-500 to-rose-600 
            rounded-[32px] p-10 text-white mb-10 shadow-xl">

    <h1 class="text-4xl font-extrabold mb-3">Konfirmasi Hapus</h1>
    <p class="text-red-100">Pastikan sebelum menghapus data</p>

    <i data-lucide="trash" class="absolute right-10 top-1/2 -translate-y-1/2 w-32 h-32 opacity-10"></i>
</div>

<!-- BOX -->
<div class="bg-white p-8 rounded-2xl shadow text-center">

<p class="text-lg mb-6 text-slate-700">
Apakah Anda yakin ingin menghapus data karyawan ini?
</p>

<div class="flex justify-center gap-4">

<a href="proses_hapus.php?id=1" 
class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-xl">
Ya, Hapus
</a>

<a href="index.php" 
class="bg-slate-200 px-6 py-2 rounded-xl">
Batal
</a>

</div>

</div>

</main>

<?php include '../includes/footer.php'; ?>
</div>

<script src="../assets/js/sidebar.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>