<?php 
session_start();
// Proteksi halaman: Memastikan hanya user dengan role 'orang_tua' atau 'bos' yang bisa masuk
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'orang_tua' && $_SESSION['role'] !== 'bos')) {
    header("Location: /mac/auth/login/index.php");
    exit;
}

include '../includes/header.php'; 
?>

<!-- ===================== -->
<!-- LINK CSS SIDEBAR -->
<!-- ===================== -->
<link rel="stylesheet" href="../assets/css/sidebar.css">

<style>
/* Slider Styles */
.slider-container {
    position: relative;
    overflow: hidden;
    border-radius: 40px;
    height: 500px;
    background: #1e1b4b;
}

.slider-wrapper {
    display: flex;
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
}

.slide {
    min-width: 100%;
    height: 100%;
    position: relative;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.6;
}

.slide-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(30, 27, 75, 0.9), rgba(30, 27, 75, 0.1));
    display: flex;
    align-items: center;
    padding: 0 60px;
    color: white;
}

/* Animation for text in slider */
.slide-content h1,
.slide-content p,
.slide-content div {
    animation: fadeInUp 0.8s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.menu-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.menu-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
}

.status-pill {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
}
</style>

<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col min-h-screen bg-[#F8FAFC]">

    <!-- TOP HEADER -->
    <header
        class="h-20 bg-white/90 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-10 sticky top-0 z-40">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Beranda Orang Tua</h2>
            <p class="text-xs text-slate-400 font-medium" id="current-date"></p>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-sm font-bold text-slate-700"><?php echo $_SESSION['username']; ?></p>
                <p class="text-[10px] text-indigo-600 font-bold uppercase tracking-widest">Orang Tua Murid</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-500 to-purple-500 p-[2px]">
                <div class="w-full h-full bg-white rounded-[14px] flex items-center justify-center text-indigo-600">
                    <i data-lucide="user" size="24"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="p-10 flex-grow max-w-[1400px] mx-auto w-full">

        <!-- SECTION: SLIDER (Paling Atas) -->
        <div class="slider-container shadow-2xl shadow-indigo-100 mb-10">
            <div class="slider-wrapper" id="sliderWrapper">
                <!-- Slide 1 -->
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?auto=format&fit=crop&q=80&w=1400"
                        alt="Slider 1">
                    <div class="slide-overlay">
                        <div class="max-w-2xl slide-content">
                            <span
                                class="inline-block px-4 py-1 bg-indigo-500 rounded-full text-[10px] font-bold tracking-widest uppercase mb-4">Update
                                Terbaru</span>
                            <h1 class="text-4xl font-black mb-3">Halo, Ayah & Bunda! ✨</h1>
                            <p class="text-indigo-100 text-lg leading-relaxed mb-6">
                                Pantau perkembangan buah hati Anda secara real-time. Mari kita berkolaborasi untuk
                                memberikan yang terbaik bagi ananda.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <div
                                    class="status-pill px-5 py-2.5 rounded-2xl flex items-center gap-2 border border-white/10">
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    <span class="text-xs font-bold text-white">Terapi Berjalan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=1400"
                        alt="Slider 2">
                    <div class="slide-overlay">
                        <div class="max-w-2xl slide-content">
                            <span
                                class="inline-block px-4 py-1 bg-purple-500 rounded-full text-[10px] font-bold tracking-widest uppercase mb-4">Informasi
                                Sesi</span>
                            <h1 class="text-4xl font-black mb-3">Jadwal Sesi Teratur</h1>
                            <p class="text-indigo-100 text-lg leading-relaxed mb-6">
                                Pastikan ananda mengikuti setiap sesi terapi sesuai jadwal untuk hasil yang maksimal dan
                                konsisten.
                            </p>
                            <a href="/mac/jadwal/anak.php"
                                class="bg-white text-indigo-900 px-6 py-3 rounded-2xl font-bold flex items-center gap-2 w-fit">
                                Lihat Jadwal <i data-lucide="calendar" size="18"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Indikator Slider -->
            <div class="absolute bottom-8 right-12 flex gap-2 z-20">
                <div class="w-10 h-1.5 bg-white rounded-full transition-all duration-300" id="dot0"></div>
                <div class="w-10 h-1.5 bg-white opacity-30 rounded-full transition-all duration-300" id="dot1"></div>
            </div>
        </div>

        <!-- GRID MENU UTAMA -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Menu 1: Progress -->
            <div class="bg-white p-8 rounded-[32px] border border-slate-100 menu-card">
                <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center mb-6">
                    <i data-lucide="bar-chart-3" size="32"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Laporan Progress</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">Analisis grafik perkembangan kognitif, motorik,
                    dan sosial ananda.</p>
                <a href="/mac/laporan/progress.php"
                    class="inline-flex items-center gap-2 text-rose-500 font-bold hover:gap-4 transition-all">
                    Lihat Grafik <i data-lucide="chevron-right" size="18"></i>
                </a>
            </div>

            <!-- Menu 2: Catatan Harian -->
            <div class="bg-white p-8 rounded-[32px] border border-slate-100 menu-card">
                <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-6">
                    <i data-lucide="book-open" size="32"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Buku Penghubung</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">Baca catatan harian dari terapis mengenai
                    aktivitas ananda hari ini.</p>
                <a href="/mac/catatan/harian.php"
                    class="inline-flex items-center gap-2 text-blue-500 font-bold hover:gap-4 transition-all">
                    Baca Catatan <i data-lucide="chevron-right" size="18"></i>
                </a>
            </div>

            <!-- Menu 3: Jadwal -->
            <div class="bg-white p-8 rounded-[32px] border border-slate-100 menu-card">
                <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-6">
                    <i data-lucide="calendar-days" size="32"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Jadwal Sesi</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">Pantau jadwal terapi mingguan agar tidak ada sesi
                    yang terlewatkan.</p>
                <a href="/mac/jadwal/anak.php"
                    class="inline-flex items-center gap-2 text-amber-500 font-bold hover:gap-4 transition-all">
                    Cek Jadwal <i data-lucide="chevron-right" size="18"></i>
                </a>
            </div>
        </div>

        <!-- AKTIVITAS TERBARU & INFORMASI -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-[32px] p-8 border border-slate-100 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <i data-lucide="activity" class="text-indigo-600"></i> Log Aktivitas Terbaru
                </h3>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-green-100 flex-shrink-0 flex items-center justify-center text-green-600">
                            <i data-lucide="check-circle" size="20"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-700">Laporan Maret Telah Siap</p>
                            <p class="text-xs text-slate-500">Terapis utama telah mengunggah hasil asesmen.</p>
                            <span class="text-[10px] text-slate-400">10 Menit yang lalu</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-indigo-900 rounded-[32px] p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-lg font-bold mb-2">Butuh Bantuan?</h3>
                    <p class="text-indigo-200 text-sm mb-6">Hubungi Admin jika memiliki pertanyaan terkait layanan kami.
                    </p>
                    <button
                        class="bg-white text-indigo-900 px-6 py-3 rounded-2xl font-bold flex items-center gap-2 hover:bg-indigo-50 transition-colors">
                        <i data-lucide="phone-call" size="18"></i> WhatsApp Admin
                    </button>
                </div>
                <i data-lucide="help-circle" class="absolute -right-4 -bottom-4 text-white/10" size="150"></i>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</div>

<script src="../asset/js/sidebar.js"></script>
<script>
lucide.createIcons();

// Logika Slider
const wrapper = document.getElementById('sliderWrapper');
const dots = [document.getElementById('dot0'), document.getElementById('dot1')];
let index = 0;

function updateSlider() {
    index = (index + 1) % 2;
    wrapper.style.transform = `translateX(-${index * 100}%)`;
    dots.forEach((dot, i) => {
        dot.style.opacity = (i === index) ? "1" : "0.3";
    });
}
setInterval(updateSlider, 5000);

const options = {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
};
document.getElementById('current-date').innerText = new Date().toLocaleDateString('id-ID', options);
</script>