<?php
session_start();
require_once '../../koneksi/koneksi.php';

$id_user = $_SESSION['id_user'] ?? 0;
$role = $_SESSION['role'] ?? '';

if ($id_user <= 0) {
    header("Location: ../../login.php");
    exit();
}

if (!in_array($role, ['orang_tua', 'bos'])) {
    die("Tidak memiliki akses.");
}

/*
========================================
AMBIL DATA DARI FORM
========================================
*/
$id_anak   = $_POST['id_anak'] ?? 0;
$nama_aspek = $_POST['nama_aspek'] ?? [];
$status     = $_POST['sensori_status'] ?? [];
$catatan    = $_POST['sensori_note'] ?? [];

if ($id_anak <= 0) {
    die("ID anak tidak valid.");
}

/*
========================================
VALIDASI ARRAY
========================================
*/
if (empty($nama_aspek)) {
    die("Data tidak lengkap.");
}

/*
========================================
SIMPAN / UPDATE DATA
STRATEGI: DELETE LAMA → INSERT BARU
(lebih aman untuk form array seperti ini)
========================================
*/

// Hapus data lama anak ini
$stmt_del = $conn->prepare("DELETE FROM sensori_halus WHERE id_anak = ?");
$stmt_del->bind_param("i", $id_anak);
$stmt_del->execute();

/*
========================================
INSERT DATA BARU
========================================
*/
$stmt = $conn->prepare("
    INSERT INTO sensori_halus 
    (id_anak, aspek_ke, nama_aspek, status, catatan)
    VALUES (?, ?, ?, ?, ?)
");

foreach ($nama_aspek as $i => $nama) {

    $aspek_ke = $i;
    $st = $status[$i] ?? 'tidak';
    $ct = $catatan[$i] ?? '';

    $stmt->bind_param(
        "iisss",
        $id_anak,
        $aspek_ke,
        $nama,
        $st,
        $ct
    );

    $stmt->execute();
}

/*
========================================
REDIRECT KEMBALI KE INDEX
========================================
*/
header("Location: index.php?id=$id_anak&status=sukses");
exit();
?>