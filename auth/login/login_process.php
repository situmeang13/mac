<?php
session_start();
include '../../koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // =========================
    // 1. AMBIL DATA
    // =========================
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password wajib diisi!";
        header("Location: index.php");
        exit();
    }

    // =========================
    // 2. CEK USER
    // =========================
    $stmt = $conn->prepare("SELECT id_user, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        // =========================
        // 3. VERIFIKASI PASSWORD
        // =========================
        if (password_verify($password, $user['password'])) {

            // =========================
            // 4. SET SESSION (FIX DISINI)
            // =========================
            $_SESSION['status']   = "login";
            $_SESSION['id_user']  = $user['id_user']; // ✅ FIX
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            // =========================
            // 5. REDIRECT
            // =========================
            switch ($user['role']) {
                case 'bos':
                    header("Location: ../../beranda/index.php");
                    break;

                case 'manajemen':
                    header("Location: ../../dashboard/manajemen/index.php");
                    break;

                case 'terapis_mac':
                case 'terapis_macplus':
                    header("Location: ../../dashboard/terapis/index.php");
                    break;

                case 'orang_tua':
                    header("Location: ../../beranda_anak/index.php");
                    break;

                default:
                    header("Location: /mac/index.php");
            }
            exit();

        } else {
            $_SESSION['error'] = "Password salah!";
            header("Location: index.php");
            exit();
        }

    } else {
        $_SESSION['error'] = "Username tidak ditemukan!";
        header("Location: index.php");
        exit();
    }

} else {
    header("Location: index.php");
    exit();
}
?>