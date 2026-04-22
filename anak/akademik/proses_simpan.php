<?php
session_start();
require_once '../../koneksi/koneksi.php';

/*
========================================
VALIDASI LOGIN
========================================
*/
$id_user = $_SESSION['id_user'] ?? 0;
$role = $_SESSION['role'] ?? '';

if ($id_user <= 0) {
    die("Anda harus login terlebih dahulu.");
}

if (!in_array($role, ['orang_tua', 'bos'])) {
    die("Anda tidak memiliki akses.");
}

/*
========================================
AMBIL DATA FORM
========================================
*/
$id_anak = (int)($_POST['id_anak'] ?? 0);
$duduk = $_POST['duduk'] ?? null;
$durasi_fokus = $_POST['durasi_fokus'] ?? null;
$catatan = $_POST['catatan'] ?? null;

$akademik_status = $_POST['akademik_status'] ?? [];
$akademik_note   = $_POST['akademik_note'] ?? [];

if ($id_anak <= 0) {
    die("ID anak tidak valid.");
}

/*
========================================
NORMALISASI INDEX ARRAY (BIAR RAPI)
========================================
*/
ksort($akademik_status);
ksort($akademik_note);

/*
========================================
JSON ENCODE (STRUKTUR STABIL)
========================================
*/
$akademik_status_json = json_encode(array_values($akademik_status), JSON_UNESCAPED_UNICODE);
$akademik_note_json   = json_encode(array_values($akademik_note), JSON_UNESCAPED_UNICODE);

/*
========================================
CEK DATA (1 ANAK = 1 RECORD)
========================================
*/
$cek = $conn->prepare("SELECT id_asesmen FROM asesmen_anak WHERE id_anak = ? LIMIT 1");
$cek->bind_param("i", $id_anak);
$cek->execute();
$res = $cek->get_result();

/*
========================================
JIKA SUDAH ADA → UPDATE
========================================
*/
if ($res->num_rows > 0) {

    $row = $res->fetch_assoc();
    $id_asesmen = $row['id_asesmen'];

    $stmt = $conn->prepare("
        UPDATE asesmen_anak SET
            id_user = ?,
            duduk = ?,
            durasi_fokus = ?,
            catatan = ?,
            akademik_status = ?,
            akademik_note = ?
        WHERE id_asesmen = ?
    ");

    $stmt->bind_param(
        "isssssi",
        $id_user,
        $duduk,
        $durasi_fokus,
        $catatan,
        $akademik_status_json,
        $akademik_note_json,
        $id_asesmen
    );

/*
========================================
JIKA BELUM ADA → INSERT
========================================
*/
} else {

    $stmt = $conn->prepare("
        INSERT INTO asesmen_anak (
            id_anak,
            id_user,
            duduk,
            durasi_fokus,
            catatan,
            akademik_status,
            akademik_note
        ) VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "iisssss",
        $id_anak,
        $id_user,
        $duduk,
        $durasi_fokus,
        $catatan,
        $akademik_status_json,
        $akademik_note_json
    );
}

/*
========================================
EXECUTE
========================================
*/
if ($stmt->execute()) {
    header("Location: index.php?id=$id_anak&status=success");
    exit;
} else {
    die("Gagal simpan data: " . $stmt->error);
}
?>