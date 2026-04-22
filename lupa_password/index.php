<?php include '../includes/header.php'; ?>

<!-- CSS SIDEBAR -->
<link rel="stylesheet" href="../assets/css/sidebar.css">

<?php include '../includes/sidebar.php'; ?>

<div class="flex-grow ml-80 flex flex-col">

    <!-- ===================== -->
    <!-- TOP HEADER -->
    <!-- ===================== -->
    <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 
                   flex items-center justify-between px-10 sticky top-0 z-40">

        <div>
            <h2 class="text-xl font-bold text-slate-800">
                Manajemen Akun
            </h2>
            <p class="text-xs text-slate-400 font-medium">
                Pengelolaan akun pengguna dan kontrol akses sistem
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
        <!-- HERO / BANNER -->
        <!-- ===================== -->
        <div class="relative overflow-hidden bg-gradient-to-br 
                    from-blue-700 via-indigo-700 to-purple-800 
                    rounded-[32px] p-12 text-white mb-10 
                    shadow-2xl shadow-indigo-200">

            <div class="relative z-10 lg:flex items-center justify-between">
                <div class="max-w-xl">
                    <span class="inline-block px-4 py-1.5 bg-white/10 
                                 rounded-full text-xs font-bold uppercase mb-6">
                        Modul Akun
                    </span>

                    <h2 class="text-5xl font-extrabold mb-4 leading-tight">
                        Manajemen Akun Pengguna
                    </h2>

                    <p class="text-blue-100/90 text-lg">
                        Kelola role, status akun, dan reset password pengguna.
                    </p>
                </div>

                <div class="hidden lg:block">
                    <i data-lucide="users" class="text-white/20" size="180"></i>
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- SEARCH -->
        <!-- ===================== -->
        <div class="mb-6">
            <input type="text" id="searchUser" placeholder="Cari pengguna..."
                   class="w-full md:w-1/3 border border-slate-300 rounded-xl px-4 py-2">
        </div>

        <!-- ===================== -->
        <!-- TABLE -->
        <!-- ===================== -->
        <div class="overflow-x-auto bg-white rounded-[28px] border border-slate-100 shadow-sm p-6">

            <table class="min-w-full divide-y divide-slate-200" id="tableUser">
                <thead>
                    <tr class="text-left text-slate-700">
                        <th class="px-6 py-3 font-bold text-sm">Nama</th>
                        <th class="px-6 py-3 font-bold text-sm">Email</th>
                        <th class="px-6 py-3 font-bold text-sm">Role</th>
                        <th class="px-6 py-3 font-bold text-sm">Status</th>
                        <th class="px-6 py-3 font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    <!-- USER 1 -->
                    <tr>
                        <td class="px-6 py-4">Denny Agung</td>
                        <td class="px-6 py-4">denny@email.com</td>

                        <td class="px-6 py-4">
                            <select class="border rounded px-2 py-1 text-sm">
                                <option>Bos</option>
                                <option>Manajemen</option>
                                <option selected>Terapis MAC</option>
                                <option>Terapis MACPLUS</option>
                                <option>Orang Tua</option>
                            </select>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-green-600 font-bold status-text">Aktif</span>
                        </td>

                        <td class="px-6 py-4 space-x-2">
                            <button onclick="toggleStatus(this)" 
                                class="text-red-600 font-bold hover:underline">
                                Nonaktifkan
                            </button>

                            <a href="#" class="text-blue-600 font-bold hover:underline">
                                Reset
                            </a>
                        </td>
                    </tr>

                    <!-- USER 2 -->
                    <tr>
                        <td class="px-6 py-4">Maria</td>
                        <td class="px-6 py-4">maria@email.com</td>

                        <td class="px-6 py-4">
                            <select class="border rounded px-2 py-1 text-sm">
                                <option>Bos</option>
                                <option>Manajemen</option>
                                <option>Terapis MAC</option>
                                <option>Terapis MACPLUS</option>
                                <option selected>Orang Tua</option>
                            </select>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-green-600 font-bold status-text">Aktif</span>
                        </td>

                        <td class="px-6 py-4 space-x-2">
                            <button onclick="toggleStatus(this)" 
                                class="text-red-600 font-bold hover:underline">
                                Nonaktifkan
                            </button>

                            <a href="#" class="text-blue-600 font-bold hover:underline">
                                Reset
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>

    </main>

    <!-- FOOTER -->
    <?php include '../includes/footer.php'; ?>
</div>

<!-- JS -->
<script src="../asset/js/sidebar.js"></script>

<script>
lucide.createIcons();

// SEARCH
document.getElementById("searchUser").addEventListener("keyup", function() {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableUser tbody tr");

    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});

// TOGGLE STATUS
function toggleStatus(btn) {
    let row = btn.closest("tr");
    let status = row.querySelector(".status-text");

    if (status.innerText === "Aktif") {
        status.innerText = "Nonaktif";
        status.classList.replace("text-green-600", "text-red-600");
        btn.innerText = "Aktifkan";
        btn.classList.replace("text-red-600", "text-green-600");
    } else {
        status.innerText = "Aktif";
        status.classList.replace("text-red-600", "text-green-600");
        btn.innerText = "Nonaktifkan";
        btn.classList.replace("text-green-600", "text-red-600");
    }
}
</script>