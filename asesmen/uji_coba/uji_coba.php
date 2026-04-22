<?php include '../../includes/header.php'; ?>

<link rel="stylesheet" href="../../assets/css/sidebar.css">

<?php include '../../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col">

<!-- HEADER -->
<header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 
               flex items-center justify-between px-10 sticky top-0 z-40">
    <div>
        <h2 class="text-xl font-bold text-slate-800">Kemampuan Anak</h2>
        <p class="text-xs text-slate-400 font-medium">Pilih kategori kemampuan anak</p>
    </div>
</header>

<main class="p-10 max-w-[1400px] flex-grow">

<!-- HERO -->
<div class="bg-gradient-to-br from-indigo-700 via-purple-700 to-blue-800
            rounded-[32px] p-12 text-white mb-12 shadow-2xl shadow-indigo-200">

<h2 class="text-4xl font-extrabold mb-3">
Asesmen Kemandirian Anak
</h2>

<p class="text-indigo-100">
Silakan pilih kategori asesmen kemampuan dan aktivitas anak.
</p>

</div>

<!-- CARD MENU -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

<!-- TOILET TRAINING -->
<a href="toilet/index.php"
class="menu-card">

<div class="icon-box bg-blue-100 text-blue-600">
<i data-lucide="bath"></i>
</div>

<h3 class="card-title">Toilet Training</h3>
<p class="card-desc">
Kemampuan anak dalam BAK, BAB, dan kemandirian menggunakan toilet.
</p>

</a>

<!-- PROSESI IBADAH -->
<a href="ibadah/index.php"
class="menu-card">

<div class="icon-box bg-purple-100 text-purple-600">
<i data-lucide="church"></i>
</div>

<h3 class="card-title">Prosesi Ibadah</h3>
<p class="card-desc">
Kemampuan anak mengikuti kegiatan ibadah seperti berdoa dan sikap saat ibadah.
</p>

</a>

<!-- PROSESI MAKAN -->
<a href="prosesi_makan/index.php"
class="menu-card">

<div class="icon-box bg-orange-100 text-orange-600">
<i data-lucide="utensils"></i>
</div>

<h3 class="card-title">Prosesi Makan</h3>
<p class="card-desc">
Kemampuan anak saat makan seperti mengambil makanan dan menggunakan alat makan.
</p>

</a>

<!-- AKADEMIK -->
<a href="akademik/index.php"
class="menu-card">

<div class="icon-box bg-green-100 text-green-600">
<i data-lucide="graduation-cap"></i>
</div>

<h3 class="card-title">Kemampuan Akademik</h3>
<p class="card-desc">
Kemampuan belajar anak seperti membaca, menulis, dan berhitung.
</p>

</a>

</div>

</main>

<?php include '../../includes/footer.php'; ?>

</div>

<script src="../../asset/js/sidebar.js"></script>

<script>
lucide.createIcons();
</script>

<style>

/* CARD MENU */

.menu-card{
background:white;
padding:28px;
border-radius:24px;
border:1px solid #f1f5f9;
box-shadow:0 10px 25px rgba(0,0,0,0.05);
transition:all .25s ease;
display:block;
}

.menu-card:hover{
transform:translateY(-5px);
box-shadow:0 20px 40px rgba(0,0,0,0.08);
border-color:#e2e8f0;
}

/* ICON */

.icon-box{
width:60px;
height:60px;
border-radius:16px;
display:flex;
align-items:center;
justify-content:center;
margin-bottom:16px;
}

.icon-box i{
width:28px;
height:28px;
}

/* TEXT */

.card-title{
font-size:18px;
font-weight:700;
color:#1e293b;
margin-bottom:6px;
}

.card-desc{
font-size:13px;
color:#64748b;
line-height:1.5;
}

</style>