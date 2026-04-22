<?php include '../../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Malang Autism Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-2">

        <!-- LEFT SIDE -->
        <div class="bg-blue-600 text-white p-10 flex flex-col justify-center items-center text-center">
            <h1 class="text-3xl font-bold mb-6">Malang Autism Center</h1>
            <div class="bg-white p-4 rounded-2xl shadow-md">
                <img src="/mac/assets/logo/mac.png" class="w-40 h-40 object-contain">
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="p-10 flex flex-col justify-center">
            <h2 class="text-xl font-bold mb-4">Register</h2>

            <form method="POST" action="register_process.php" class="space-y-3">

                <!-- NAMA -->
                <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full p-2 border rounded" required>

                <!-- USERNAME -->
                <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded" required>

                <!-- EMAIL -->
                <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required>

                <!-- NO HP -->
                <input type="text" name="no_hp" placeholder="No HP" class="w-full p-2 border rounded">

                <!-- PASSWORD -->
                <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded"
                    required>

                <!-- KONFIRMASI PASSWORD -->
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password"
                    class="w-full p-2 border rounded" required>

                <!-- ROLE -->
                <select name="role" class="w-full p-2 border rounded" required>
                    <option value="">Pilih Hak Akses</option>
                    <option value="bos">Bos / Pimpinan</option>
                    <option value="manajemen">Tim Manajemen</option>
                    <option value="terapis_mac">Terapis MAC</option>
                    <option value="terapis_macplus">Terapis MACPLUS</option>
                    <option value="orang_tua">Orang Tua</option>
                </select>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded font-bold transition">
                    Daftar
                </button>

            </form>

            <!-- FOOTER -->
            <div class="text-xs text-slate-500 text-center mt-4">
                <?php include '../../includes/footer.php'; ?>
            </div>

            <p class="mt-4 text-sm text-center">
                Sudah punya akun?
                <a href="/mac/auth/login/index.php" class="text-purple-600 font-semibold">Login</a>
            </p>
        </div>

    </div>

</body>

</html>