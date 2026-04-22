<?php
session_start();
include '../../koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // =========================
    // 1. AMBIL DATA & VALIDASI
    // =========================
    $nama       = trim($_POST['nama']);
    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $no_hp      = trim($_POST['no_hp']);
    $password   = $_POST['password'];
    $confirm    = $_POST['confirm_password'];
    $role       = $_POST['role'];

    // Validasi wajib isi
    if (empty($nama) || empty($username) || empty($email) || empty($password) || empty($role)) {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Validasi password sama
    if ($password !== $confirm) {
        echo "<script>alert('Konfirmasi password tidak sama!'); window.history.back();</script>";
        exit;
    }

    // Validasi email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); window.history.back();</script>";
        exit;
    }

    // =========================
    // 2. CEK DUPLIKAT
    // =========================
    $stmt = $conn->prepare("SELECT id_user FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Username atau Email sudah digunakan!'); window.history.back();</script>";
        exit;
    }
    $stmt->close();

    // =========================
    // 3. HASH PASSWORD
    // =========================
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // =========================
    // 4. INSERT DATA
    // =========================
    $stmt = $conn->prepare("INSERT INTO users (nama, username, email, password, no_hp, role) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nama, $username, $email, $password_hashed, $no_hp, $role);

    if ($stmt->execute()) {

        echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location.href = '/mac/auth/login/index.php';
              </script>";

    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menyimpan data!');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: index.php");
    exit();
}
?>