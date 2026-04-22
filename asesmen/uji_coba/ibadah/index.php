<?php include '../../../includes/header.php'; ?>
<link rel="stylesheet" href="../../../assets/css/sidebar.css">
<?php include '../../../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col bg-slate-50 min-h-screen">

<header class="h-20 bg-white border-b border-slate-200 flex items-center px-10">
<div class="flex items-center gap-3">
<div class="p-2 bg-emerald-100 rounded-xl">
<i data-lucide="moon-star" class="w-6 h-6 text-emerald-600"></i>
</div>

<div>
<h2 class="text-xl font-bold text-slate-800">Prosesi Ibadah</h2>
<p class="text-xs text-slate-500 uppercase tracking-wider">
Aktivitas Ibadah
</p>
</div>
</div>
</header>


<main class="p-10 max-w-[1300px] mx-auto w-full">

<!-- HERO -->
<section class="mb-10">

<div class="bg-gradient-to-br from-emerald-500 to-teal-600 
rounded-[30px] p-10 text-white">

<h1 class="text-4xl font-black mb-3">
Prosesi Ibadah
</h1>

<p class="text-emerald-100">
Penilaian aktivitas ibadah anak mulai dari wudhu, sholat hingga mengaji.
</p>

</div>

</section>


<!-- MENU -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">


<a href="wudhu/index.php" class="menu-card">

<div class="icon bg-blue-100">
<i data-lucide="droplets"></i>
</div>

<h3>Wudhu</h3>
<p>Proses bersuci sebelum sholat</p>

</a>


<a href="persiapan_sholat/index.php" class="menu-card">

<div class="icon bg-indigo-100">
<i data-lucide="shirt"></i>
</div>

<h3>Persiapan Sholat</h3>
<p>Mempersiapkan pakaian sholat</p>

</a>


<a href="sholat/index.php" class="menu-card">

<div class="icon bg-green-100">
<i data-lucide="person-standing"></i>
</div>

<h3>Sholat</h3>
<p>Gerakan dan bacaan sholat</p>

</a>


<a href="setelah_sholat/index.php" class="menu-card">

<div class="icon bg-purple-100">
<i data-lucide="heart-handshake"></i>
</div>

<h3>Setelah Sholat</h3>
<p>Dzikir dan doa setelah sholat</p>

</a>


<a href="mengaji/index.php" class="menu-card">

<div class="icon bg-orange-100">
<i data-lucide="book-open-text"></i>
</div>

<h3>Mengaji</h3>
<p>Membaca Al-Qur'an</p>

</a>


</div>

</main>

<?php include '../../../includes/footer.php'; ?>

</div>


<script src="../../../assets/js/sidebar.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
lucide.createIcons();
</script>


<style>

.menu-card{
background:white;
padding:30px;
border-radius:24px;
border:1px solid #e2e8f0;
display:flex;
flex-direction:column;
gap:10px;
transition:0.3s;
text-decoration:none;
}

.menu-card:hover{
transform:translateY(-5px);
box-shadow:0 12px 25px rgba(0,0,0,0.08);
}

.menu-card h3{
font-size:18px;
font-weight:700;
color:#1e293b;
}

.menu-card p{
font-size:13px;
color:#64748b;
}

.icon{
width:55px;
height:55px;
display:flex;
align-items:center;
justify-content:center;
border-radius:14px;
}

.icon i{
width:26px;
height:26px;
color:#334155;
}

</style>