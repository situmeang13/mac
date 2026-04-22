<?php include '../../../includes/header.php'; ?>
<link rel="stylesheet" href="../../../assets/css/sidebar.css">
<?php include '../../../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<!-- HEADER -->
<header class="h-20 bg-white/90 backdrop-blur-xl border-b border-slate-200 
flex items-center justify-between px-10 sticky top-0 z-40">

<div class="flex items-center gap-4">
<div class="p-2 bg-indigo-50 rounded-xl">
<i data-lucide="graduation-cap" class="text-indigo-600 w-6 h-6"></i>
</div>

<div>
<h2 class="text-xl font-bold text-slate-800 tracking-tight">
Kemampuan Akademik
</h2>

<p class="text-xs text-slate-500 uppercase tracking-wider">
Penilaian Kemampuan Belajar Anak
</p>
</div>
</div>

</header>


<!-- MAIN -->
<main class="p-8 lg:p-12 flex-grow max-w-[1400px] mx-auto w-full">

<!-- HERO -->
<section class="mb-10">
<div class="relative overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 
rounded-[2.5rem] p-10 lg:p-14 text-white shadow-2xl">

<div class="max-w-2xl">

<span class="px-4 py-1.5 bg-white/20 rounded-full text-xs font-bold uppercase">
Modul Asesmen
</span>

<h1 class="text-4xl lg:text-5xl font-black mt-4 mb-4">
Kemampuan Akademik
</h1>

<p class="text-indigo-100 text-lg">
Penilaian kemampuan akademik anak meliputi kemampuan mengenal huruf,
angka, membaca, menulis, berhitung, serta pemahaman konsep dasar
seperti warna, uang, dan waktu.
</p>

</div>

<i data-lucide="graduation-cap" class="absolute right-12 top-1/2 -translate-y-1/2 w-40 h-40 opacity-10"></i>

</div>
</section>


<!-- MENU -->
<section>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

<!-- PROSES BELAJAR -->
<a href="proses_belajar/index.php" class="card-menu">
<div class="icon bg-blue-100">
<i data-lucide="book-open"></i>
</div>
<h3>Proses Belajar</h3>
<p>Kemampuan anak dalam mengikuti kegiatan belajar dan memperhatikan instruksi.</p>
</a>

<!-- IDENTIFIKASI WARNA -->
<a href="identifikasi_warna/index.php" class="card-menu">
<div class="icon bg-pink-100">
<i data-lucide="palette"></i>
</div>
<h3>Identifikasi Warna</h3>
<p>Kemampuan anak mengenali dan membedakan berbagai jenis warna.</p>
</a>

<!-- IDENTIFIKASI HURUF -->
<a href="identifikasi_huruf/index.php" class="card-menu">
<div class="icon bg-green-100">
<i data-lucide="type"></i>
</div>
<h3>Identifikasi Huruf</h3>
<p>Kemampuan mengenali huruf alfabet dan membedakan bentuk huruf.</p>
</a>

<!-- IDENTIFIKASI ANGKA -->
<a href="identifikasi_angka/index.php" class="card-menu">
<div class="icon bg-yellow-100">
<i data-lucide="hash"></i>
</div>
<h3>Identifikasi Angka</h3>
<p>Kemampuan anak mengenali angka dan memahami simbol bilangan.</p>
</a>

<!-- MEMBACA -->
<a href="membaca/index.php" class="card-menu">
<div class="icon bg-purple-100">
<i data-lucide="book"></i>
</div>
<h3>Membaca</h3>
<p>Kemampuan membaca huruf, kata, dan kalimat sederhana.</p>
</a>

<!-- MENULIS -->
<a href="menulis/index.php" class="card-menu">
<div class="icon bg-cyan-100">
<i data-lucide="pen-line"></i>
</div>
<h3>Menulis</h3>
<p>Kemampuan anak menulis huruf, kata, dan kalimat sederhana.</p>
</a>

<!-- MENGHITUNG -->
<a href="menghitung/index.php" class="card-menu">
<div class="icon bg-orange-100">
<i data-lucide="calculator"></i>
</div>
<h3>Menghitung</h3>
<p>Kemampuan berhitung seperti penjumlahan, pengurangan, dan konsep bilangan.</p>
</a>

<!-- PEMAHAMAN UANG -->
<a href="pemahaman_uang/index.php" class="card-menu">
<div class="icon bg-emerald-100">
<i data-lucide="banknote"></i>
</div>
<h3>Pemahaman Uang</h3>
<p>Kemampuan anak mengenali nilai uang dan penggunaannya.</p>
</a>

<!-- PEMAHAMAN WAKTU -->
<a href="pemahaman_waktu/index.php" class="card-menu">
<div class="icon bg-slate-100">
<i data-lucide="clock"></i>
</div>
<h3>Pemahaman Waktu</h3>
<p>Kemampuan memahami konsep waktu seperti pagi, siang, malam, dan jam.</p>
</a>

</div>

</section>

</main>

<?php include '../../../includes/footer.php'; ?>

</div>

<script src="../../../assets/js/sidebar.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
lucide.createIcons();
</script>

<style>

.card-menu{
background:white;
padding:30px;
border-radius:25px;
border:1px solid #e2e8f0;
transition:all .3s;
display:flex;
flex-direction:column;
gap:12px;
text-decoration:none;
}

.card-menu:hover{
transform:translateY(-6px);
box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.card-menu h3{
font-size:18px;
font-weight:700;
color:#1e293b;
}

.card-menu p{
font-size:13px;
color:#64748b;
line-height:1.5;
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