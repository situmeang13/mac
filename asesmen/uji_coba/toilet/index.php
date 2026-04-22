<?php include '../../../includes/header.php'; ?>
<link rel="stylesheet" href="../../../assets/css/sidebar.css">
<?php include '../../../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<!-- HEADER -->
<header class="h-20 bg-white/90 backdrop-blur-xl border-b border-slate-200 
flex items-center justify-between px-10 sticky top-0 z-40">

<div class="flex items-center gap-4">
<div class="p-2 bg-indigo-50 rounded-xl">
<i data-lucide="heart-pulse" class="text-indigo-600 w-6 h-6"></i>
</div>

<div>
<h2 class="text-xl font-bold text-slate-800 tracking-tight">
Basic Life Skill
</h2>

<p class="text-xs text-slate-500 uppercase tracking-wider">
Self Care Assessment
</p>
</div>
</div>

</header>


<!-- MAIN CONTENT -->
<main class="p-8 lg:p-12 flex-grow max-w-[1400px] mx-auto w-full">


<!-- HERO -->
<section class="mb-10">
<div class="relative overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 
rounded-[2.5rem] p-10 lg:p-14 text-white shadow-2xl">

<div class="relative z-10 max-w-2xl">

<span class="inline-block px-4 py-1.5 bg-white/20 rounded-full text-xs font-bold uppercase mb-4">
Modul Asesmen
</span>

<h1 class="text-4xl lg:text-5xl font-black mb-4">
Basic Life Skill
</h1>

<p class="text-indigo-100 text-lg">
Penilaian kemampuan anak dalam melakukan aktivitas sehari-hari secara mandiri seperti toilet training, mandi, keramas, sikat gigi, dan perawatan diri lainnya.
</p>

</div>

<i data-lucide="baby" class="absolute right-12 top-1/2 -translate-y-1/2 w-44 h-44 opacity-10"></i>

</div>
</section>


<!-- MENU CARD -->
<section>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

<!-- BAK -->
<a href="bak/index.php" class="card-menu">
<div class="icon bg-blue-100">
<i data-lucide="droplets"></i>
</div>

<h3>BAK</h3>
<p>Toilet Training Buang Air Kecil</p>
</a>


<!-- BAB -->
<a href="bab/index.php" class="card-menu">
<div class="icon bg-yellow-100">
<i data-lucide="circle"></i>
</div>

<h3>BAB</h3>
<p>Toilet Training Buang Air Besar</p>
</a>


<!-- MANDI -->
<a href="mandi/index.php" class="card-menu">
<div class="icon bg-sky-100">
<i data-lucide="shower-head"></i>
</div>

<h3>MANDI</h3>
<p>Kemampuan mandi secara mandiri</p>
</a>


<!-- KERAMAS -->
<a href="keramas/index.php" class="card-menu">
<div class="icon bg-indigo-100">
<i data-lucide="waves"></i>
</div>

<h3>KERAMAS</h3>
<p>Mencuci rambut dengan shampoo</p>
</a>


<!-- SIKAT GIGI -->
<a href="gigi/index.php" class="card-menu">
<div class="icon bg-green-100">
<i data-lucide="smile"></i>
</div>

<h3>SIKAT GIGI</h3>
<p>Kebersihan gigi dan mulut</p>
</a>


<!-- SETELAH MANDI -->
<a href="setelah_mandi/index.php" class="card-menu">
<div class="icon bg-purple-100">
<i data-lucide="shirt"></i>
</div>

<h3>SETELAH MANDI</h3>
<p>Mengeringkan badan dan memakai pakaian</p>
</a>


<!-- GROOMING -->
<a href="grooming/index.php" class="card-menu">
<div class="icon bg-pink-100">
<i data-lucide="sparkles"></i>
</div>

<h3>GROOMING</h3>
<p>Perawatan diri seperti menyisir rambut</p>
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
transform:translateY(-5px);
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