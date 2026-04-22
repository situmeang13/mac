<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/sidebar.css">
<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<!-- HEADER -->
<header class="h-20 bg-white/90 backdrop-blur-xl border-b border-slate-200 
flex items-center justify-between px-10 sticky top-0 z-40">

<div class="flex items-center gap-4">
<div class="p-2 bg-green-50 rounded-xl">
<i data-lucide="shield-check" class="text-green-600 w-6 h-6"></i>
</div>

<div>
<h2 class="text-xl font-bold text-slate-800 tracking-tight">
Monitoring Lingkungan
</h2>
<p class="text-xs text-slate-500 uppercase tracking-wider">
Keamanan & Kebersihan Area Belajar
</p>
</div>
</div>

<a href="lapor.php" 
class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-sm">

<i data-lucide="alert-triangle" class="w-4 h-4"></i>
Kirim Keluhan

</a>

</header>


<!-- MAIN -->
<main class="p-8 lg:p-12 flex-grow max-w-[1400px] mx-auto w-full">

<!-- HERO -->
<section class="mb-10">

<div class="relative overflow-hidden bg-gradient-to-br from-green-500 to-emerald-600 
rounded-[2.5rem] p-10 lg:p-14 text-white shadow-2xl">

<div class="max-w-2xl">

<span class="px-4 py-1.5 bg-white/20 rounded-full text-xs font-bold uppercase">
Monitoring Sistem
</span>

<h1 class="text-4xl lg:text-5xl font-black mt-4 mb-4">
Monitoring Lingkungan Belajar
</h1>

<p class="text-green-100 text-lg">
Sistem ini digunakan untuk memantau kondisi fasilitas lingkungan belajar
seperti masjid, gerbang, dan kebersihan area sekolah serta mengirimkan laporan
atau keluhan kepada pimpinan jika ditemukan masalah.
</p>

</div>

<i data-lucide="building" class="absolute right-12 top-1/2 -translate-y-1/2 w-40 h-40 opacity-10"></i>

</div>

</section>


<!-- AREA MONITORING -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">

<a href="masjid.php" class="card-monitor">
<div class="icon bg-blue-100">
<i data-lucide="landmark"></i>
</div>
<h3>Monitoring Masjid</h3>
<p>Memantau kondisi kebersihan dan fasilitas masjid.</p>
</a>

<a href="gerbang.php" class="card-monitor">
<div class="icon bg-yellow-100">
<i data-lucide="door-open"></i>
</div>
<h3>Monitoring Gerbang</h3>
<p>Memantau keamanan dan kondisi gerbang sekolah.</p>
</a>

<a href="kebersihan.php" class="card-monitor">
<div class="icon bg-green-100">
<i data-lucide="trash-2"></i>
</div>
<h3>Kebersihan Lingkungan</h3>
<p>Memantau kebersihan area lingkungan belajar.</p>
</a>

</section>


<!-- LAPORAN TERBARU -->
<section class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

<div class="p-6 border-b flex items-center justify-between">

<h3 class="text-lg font-bold text-slate-800">
Laporan Monitoring Terbaru
</h3>

<input type="text" 
placeholder="Cari laporan..."
class="border border-slate-300 px-4 py-2 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-400">

</div>

<table class="w-full text-sm">

<thead class="bg-slate-100 text-slate-700">

<tr>
<th class="p-4 text-left">Tanggal</th>
<th class="p-4 text-left">Lokasi</th>
<th class="p-4 text-left">Deskripsi</th>
<th class="p-4 text-left">Foto</th>
<th class="p-4 text-left">Status</th>
</tr>

</thead>

<tbody>

<tr class="border-t hover:bg-slate-50">

<td class="p-4">10 Juni 2026</td>

<td class="p-4">
<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">
Masjid
</span>
</td>

<td class="p-4">
Karpet masjid terlihat kotor dan perlu dibersihkan.
</td>

<td class="p-4">
<img src="../assets/img/contoh.jpg" class="w-12 h-12 rounded-lg object-cover">
</td>

<td class="p-4">
<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
Diproses
</span>
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

<style>

.card-monitor{
background:white;
padding:28px;
border-radius:22px;
border:1px solid #e2e8f0;
transition:all .3s;
display:flex;
flex-direction:column;
gap:10px;
text-decoration:none;
}

.card-monitor:hover{
transform:translateY(-6px);
box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.card-monitor h3{
font-size:18px;
font-weight:700;
color:#1e293b;
}

.card-monitor p{
font-size:13px;
color:#64748b;
}

.icon{
width:55px;
height:55px;
display:flex;
align-items:center;
justify-content:center;
border-radius:15px;
}

.icon i{
width:26px;
height:26px;
color:#334155;
}

</style>