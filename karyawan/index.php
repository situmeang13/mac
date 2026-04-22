<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/sidebar.css">
<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<!-- HEADER -->
<header class="h-20 bg-white/90 backdrop-blur-xl border-b border-slate-200 
flex items-center justify-between px-10 sticky top-0 z-40">

<div class="flex items-center gap-4">
<div class="p-2 bg-blue-50 rounded-xl">
<i data-lucide="users" class="text-blue-600 w-6 h-6"></i>
</div>

<div>
<h2 class="text-xl font-bold text-slate-800 tracking-tight">
Data Karyawan
</h2>
<p class="text-xs text-slate-500 uppercase tracking-wider">
Manajemen Karyawan
</p>
</div>
</div>

<a href="tambah.php" 
class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-sm">

<i data-lucide="user-plus" class="w-4 h-4"></i>
Tambah Karyawan

</a>

</header>


<!-- MAIN -->
<main class="p-8 lg:p-12 flex-grow max-w-[1400px] mx-auto w-full">

<!-- HERO -->
<section class="mb-10">

<div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-indigo-600 
rounded-[2.5rem] p-10 lg:p-14 text-white shadow-2xl">

<div class="max-w-2xl">

<span class="px-4 py-1.5 bg-white/20 rounded-full text-xs font-bold uppercase">
Sistem Data
</span>

<h1 class="text-4xl lg:text-5xl font-black mt-4 mb-4">
Manajemen Karyawan
</h1>

<p class="text-blue-100 text-lg">
Halaman ini digunakan untuk mengelola seluruh data karyawan.
</p>

</div>

<i data-lucide="users" class="absolute right-12 top-1/2 -translate-y-1/2 w-40 h-40 opacity-10"></i>

</div>

</section>


<!-- STAT CARD -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

<div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-4">
<div class="p-3 bg-blue-100 rounded-xl">
<i data-lucide="users" class="text-blue-600"></i>
</div>
<div>
<p class="text-sm text-slate-500">Total Karyawan</p>
<h3 class="text-xl font-bold">25</h3>
</div>
</div>

<div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-4">
<div class="p-3 bg-green-100 rounded-xl">
<i data-lucide="user-check" class="text-green-600"></i>
</div>
<div>
<p class="text-sm text-slate-500">Karyawan Aktif</p>
<h3 class="text-xl font-bold">20</h3>
</div>
</div>

<div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-4">
<div class="p-3 bg-yellow-100 rounded-xl">
<i data-lucide="user-clock" class="text-yellow-600"></i>
</div>
<div>
<p class="text-sm text-slate-500">Magang / Kontrak</p>
<h3 class="text-xl font-bold">5</h3>
</div>
</div>

</section>


<!-- SEARCH -->
<section class="mb-6 flex justify-between items-center">

<div class="relative w-80">

<input type="text"
placeholder="Cari karyawan..."
class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400">

<i data-lucide="search" class="absolute left-3 top-2.5 w-5 h-5 text-slate-400"></i>

</div>

</section>


<!-- TABLE -->
<section class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">

<table class="w-full text-sm">

<thead class="bg-slate-100 text-slate-700">

<tr>
<th class="p-4 text-left">Nama</th>
<th class="p-4 text-left">Jenis Kelamin</th>
<th class="p-4 text-left">Asal</th>
<th class="p-4 text-left">Jabatan</th>
<th class="p-4 text-left">Tanggal Bergabung</th>
<th class="p-4 text-left">Status</th>
<th class="p-4 text-left">HP</th>
<th class="p-4 text-left">Gaji</th>
<th class="p-4 text-center">Aksi</th>
</tr>

</thead>

<tbody>

<tr class="border-t hover:bg-slate-50 transition">

<td class="p-4 font-semibold text-slate-800">Andi Pratama</td>
<td class="p-4">Laki-laki</td>
<td class="p-4">Malang</td>
<td class="p-4">Staff Administrasi</td>
<td class="p-4">12 Mei 2023</td>

<td class="p-4">
<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
Aktif
</span>
</td>

<td class="p-4">081234567890</td>
<td class="p-4 font-medium text-slate-700">Rp 4.000.000</td>

<td class="p-4 flex justify-center gap-3">

<a href="edit.php" 
class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">

<i data-lucide="edit"></i>

</a>

<a href="#" 
class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">

<i data-lucide="trash"></i>

</a>

</td>

</tr>

</tbody>

</table>

</section>

</main>

<?php include '../includes/footer.php'; ?>

</div>

<script src="../assets/js/sidebar.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
lucide.createIcons();
</script>