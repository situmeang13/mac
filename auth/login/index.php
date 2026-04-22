<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Malang Autism Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-2">

        <!-- LEFT -->
        <div class="bg-blue-600 text-white p-10 flex flex-col justify-center items-center text-center">
            <h1 class="text-3xl font-bold mb-6">Malang Autism Center</h1>
            <div class="bg-white p-4 rounded-2xl shadow-md">
                <img src="/mac/assets/logo/mac.png" class="w-40 h-40 object-contain">
            </div>
        </div>

        <!-- RIGHT -->
        <div class="p-10 flex flex-col justify-center">
            <h2 class="text-xl font-bold mb-4">Login</h2>

            <!-- ALERT ERROR -->
            <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-3 p-2 bg-red-100 text-red-700 rounded text-sm">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="login_process.php" class="space-y-3">

                <!-- USERNAME -->
                <input type="text" name="username" placeholder="Username" required class="w-full p-2 border rounded">

                <!-- PASSWORD -->
                <input type="password" name="password" placeholder="Password" required
                    class="w-full p-2 border rounded">

                <!-- REMEMBER (opsional) -->
                <div class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="remember">
                    <label>Ingat saya</label>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-bold transition">
                    Masuk
                </button>

            </form>

            <!-- LINK REGISTER -->
            <p class="mt-4 text-sm text-center">
                Belum punya akun?
                <a href="/mac/auth/register/index.php" class="text-blue-600 font-semibold">Daftar</a>
            </p>

            <!-- FOOTER -->
            <div class="text-xs text-slate-500 text-center mt-4">
                <?php include '../../includes/footer.php'; ?>
            </div>

        </div>

    </div>

</body>

</html>