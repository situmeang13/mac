<?php include '../includes/header.php'; ?>

<link rel="stylesheet" href="../assets/css/sidebar.css">

<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col">

    <!-- ===================== -->
    <!-- TOP HEADER -->
    <!-- ===================== -->
    <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 
                   flex items-center justify-between px-10 sticky top-0 z-40">

        <div>
            <h2 id="page-title" class="text-xl font-bold text-slate-800">
                Presensi Online
            </h2>
            <p class="text-xs text-slate-400 font-medium">
                Presensi hanya dapat dilakukan di lokasi Malang Autism Center
            </p>
        </div>

        <div class="flex items-center gap-5">
            <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400">
                <i data-lucide="search" size="20"></i>
            </button>

            <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 relative">
                <i data-lucide="bell" size="20"></i>
                <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full"></span>
            </button>
        </div>
    </header>

    <!-- ===================== -->
    <!-- MAIN CONTENT -->
    <!-- ===================== -->
    <main class="p-10 flex-grow max-w-[1400px]">

        <!-- ===================== -->
        <!-- HERO SECTION -->
        <!-- ===================== -->
         <!-- HERO -->
            <div class="relative overflow-hidden bg-gradient-to-br 
                        from-purple-700 via-indigo-700 to-blue-800 
                        rounded-[32px] p-12 text-white mb-10 
                        shadow-2xl shadow-indigo-200 ">

            <div class="relative z-10 lg:flex items-center justify-between">
                <div class="max-w-xl">
                    <span class="inline-block px-4 py-1.5 bg-white/10 
                                 rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                        Modul Presensi
                    </span>

                    <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                        Presensi Online
                    </h2>

                    <p class="text-white/90 text-lg mb-8">
                        Pastikan Anda berada di lokasi Malang Autism Center untuk melakukan presensi masuk atau keluar.
                    </p>
                </div>

                <div class="hidden lg:block">
                    <i data-lucide="map-pin" class="text-white/20" size="180"></i>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- PRESENSI BUTTONS -->
        <!-- ===================== -->
        <div class="flex flex-col md:flex-row gap-6 justify-center mb-10">

            <button id="inPresensi" 
                    class="bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg transition">
                Presensi Masuk
            </button>

            <button id="exPresensi" 
                    class="bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg transition">
                Presensi Keluar
            </button>

        </div>

        <!-- ===================== -->
        <!-- STATUS INFO -->
        <!-- ===================== -->
        <div id="statusPresensi" class="text-center text-slate-700 text-lg font-medium"></div>

    </main>

    <?php include '../includes/footer.php'; ?>
</div>

<!-- ===================== -->
<!-- JAVASCRIPT -->
<!-- ===================== -->
<script src="../asset/js/sidebar.js"></script>
<script>
    lucide.createIcons();

    const inBtn = document.getElementById('inPresensi');
    const exBtn = document.getElementById('exPresensi');
    const statusDiv = document.getElementById('statusPresensi');

    // Koordinat Malang Autism Center
    const centerLat = -7.9636; // ganti dengan koordinat asli
    const centerLng = 112.6323; // ganti dengan koordinat asli
    const allowedRadius = 100; // radius dalam meter

    function getDistanceFromLatLonInM(lat1, lon1, lat2, lon2) {
        const R = 6371000; // Radius bumi dalam meter
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(lat1 * Math.PI/180) * Math.cos(lat2 * Math.PI/180) *
                  Math.sin(dLon/2) * Math.sin(dLon/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c;
    }

    function presensi(type) {
        if (!navigator.geolocation) {
            statusDiv.textContent = "Geolocation tidak didukung oleh browser Anda.";
            return;
        }

        navigator.geolocation.getCurrentPosition(position => {
            const distance = getDistanceFromLatLonInM(
                position.coords.latitude,
                position.coords.longitude,
                centerLat,
                centerLng
            );

            if (distance <= allowedRadius) {
                // Kirim data presensi ke server via fetch/ajax jika mau disimpan di DB
                statusDiv.textContent = `Presensi ${type} berhasil dilakukan. Anda berada ${Math.round(distance)} meter dari lokasi.`;
            } else {
                statusDiv.textContent = `Anda terlalu jauh dari lokasi (${Math.round(distance)} meter). Presensi hanya bisa dilakukan di Malang Autism Center.`;
            }
        }, error => {
            statusDiv.textContent = "Tidak dapat memperoleh lokasi Anda. Pastikan GPS aktif dan browser memiliki izin.";
        });
    }

    inBtn.addEventListener('click', () => presensi('Masuk'));
    exBtn.addEventListener('click', () => presensi('Keluar'));
</script>