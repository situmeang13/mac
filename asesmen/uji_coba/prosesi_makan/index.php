<?php include '../../../includes/header.php'; ?>
<link rel="stylesheet" href="../../../assets/css/sidebar.css">
<?php include '../../../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<!-- HEADER -->
<header class="h-20 bg-white/90 backdrop-blur-xl border-b border-slate-200 
flex items-center justify-between px-10 sticky top-0 z-40">

<div class="flex items-center gap-4">
<div class="p-2 bg-orange-50 rounded-xl">
<i data-lucide="utensils" class="text-orange-600 w-6 h-6"></i>
</div>

<div>
<h2 class="text-xl font-bold text-slate-800 tracking-tight">
Prosesi Makan
</h2>

<p class="text-xs text-slate-500 uppercase tracking-wider">
Kemandirian Aktivitas Makan
</p>
</div>
</div>

</header>


<!-- MAIN -->
<main class="p-8 lg:p-12 flex-grow max-w-[1400px] mx-auto w-full">

<!-- HERO -->
<section class="mb-10">
<div class="relative overflow-hidden bg-gradient-to-br from-orange-500 to-amber-600 
rounded-[2.5rem] p-10 lg:p-14 text-white shadow-2xl">

<div class="max-w-2xl">

<span class="px-4 py-1.5 bg-white/20 rounded-full text-xs font-bold uppercase">
Modul Asesmen
</span>

<h1 class="text-4xl lg:text-5xl font-black mt-4 mb-4">
Prosesi Makan
</h1>

<p class="text-orange-100 text-lg">
Penilaian kemampuan anak dalam melakukan proses makan secara mandiri 
mulai dari menyiapkan alat makan, proses makan, hingga kegiatan setelah makan.
</p>

</div>

<i data-lucide="utensils-crossed" class="absolute right-12 top-1/2 -translate-y-1/2 w-40 h-40 opacity-10"></i>

</div>
</section>


<!-- MENU -->
<section>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

<!-- PERSIAPAN ALAT MAKAN -->
<a href="persiapan_makan/index.php" class="card-menu">

<div class="icon bg-blue-100">
<i data-lucide="utensils"></i>
</div>

<h3>Persiapan Alat Makan</h3>

<p>
Kegiatan menyiapkan alat makan seperti piring, sendok, 
gelas, serta menata makanan sebelum mulai makan.
</p>

</a>


<!-- PROSES MAKAN -->
<a href="proses_makan/index.php" class="card-menu">

<div class="icon bg-green-100">
<i data-lucide="utensils-crossed"></i>
</div>

<h3>Proses Makan</h3>

<p>
Aktivitas makan seperti berdoa sebelum makan, 
menggunakan tangan kanan atau sendok, dan makan dengan posisi duduk.
</p>

</a>


<!-- SETELAH MAKAN -->
<a href="setelah_makan/index.php" class="card-menu">

<div class="icon bg-purple-100">
<i data-lucide="smile"></i>
</div>

<h3>Setelah Makan</h3>

<p>
Kegiatan setelah makan seperti berdoa setelah makan, 
membersihkan meja makan, dan mencuci peralatan makan.
</p>

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