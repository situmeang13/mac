<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mac";

// ✅ GANTI KE OOP
$conn = new mysqli($host, $user, $pass, $db);

// CEK KONEKSI
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// SET CHARSET
$conn->set_charset("utf8mb4");
?>