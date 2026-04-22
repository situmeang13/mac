<?php
session_start();
require_once '../../koneksi/koneksi.php';

/**
 * Validasi Sesi dan Role
 */
if (!isset($_SESSION['id_user'], $_SESSION['role'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

$id_user = (int) $_SESSION['id_user'];
$role    = $_SESSION['role'];
$id_anak = (int) ($_POST['id_anak'] ?? 0);

if ($id_anak <= 0) {
    die("ID anak tidak valid.");
}

if (!in_array($role, ['orang_tua', 'bos'])) {
    die("Role Anda tidak diizinkan untuk melakukan aksi ini.");
}

/**
 * Validasi Kepemilikan (Ownership)
 * Memastikan orang tua hanya bisa mengisi data anaknya sendiri.
 */
if ($role === 'orang_tua') {
    $cek = $conn->prepare("SELECT id_anak FROM anak WHERE id_anak = ? AND id_ortu = ?");
    $cek->bind_param("ii", $id_anak, $id_user);
    $cek->execute();
    if ($cek->get_result()->num_rows === 0) {
        die("Akses ditolak: Data anak ini bukan milik akun Anda.");
    }
}

/**
 * Cek apakah data riwayat sudah ada (Insert vs Update)
 */
$cekExist = $conn->prepare("SELECT id_anak FROM riwayat_anak WHERE id_anak = ?");
$cekExist->bind_param("i", $id_anak);
$cekExist->execute();
$exists = $cekExist->get_result()->num_rows > 0;

/**
 * Helper function untuk menangani checkbox/boolean (1 atau 0)
 */
function yn($v) {
    return (isset($v) && ($v == "1" || $v == "on")) ? "1" : "0";
}

/**
 * Persiapan Data dari Form
 */
$data_values = [
    $_POST['kondisi_kesehatan_ibu'] ?? '',
    (int)($_POST['usia_kandungan_minggu'] ?? 0),
    $_POST['konsumsi_fastfood'] ?? 'tidak',
    $_POST['fastfood_detail'] ?? '',
    $_POST['konsumsi_obat'] ?? 'tidak',
    $_POST['obat_detail'] ?? '',
    yn($_POST['risiko_asap_rokok'] ?? null),
    yn($_POST['risiko_polusi'] ?? null),
    yn($_POST['risiko_zat_kimia'] ?? null),
    yn($_POST['risiko_lainnya'] ?? null),
    $_POST['metode_persalinan'] ?? '',
    $_POST['tempat_persalinan'] ?? '',
    $_POST['posisi_bayi'] ?? '',
    yn($_POST['komplikasi_kpd'] ?? null),
    yn($_POST['komplikasi_lilitan_tali_pusat'] ?? null),
    yn($_POST['komplikasi_pendarahan'] ?? null),
    yn($_POST['komplikasi_asfiksia'] ?? null),
    yn($_POST['komplikasi_macet'] ?? null),
    yn($_POST['komplikasi_pre_eklampsia'] ?? null),
    $_POST['komplikasi_detail_lainnya'] ?? '',
    (int)($_POST['berat_lahir_gram'] ?? 0),
    (int)($_POST['panjang_lahir_cm'] ?? 0),
    (int)($_POST['lingkar_kepala_cm'] ?? 0),
    $_POST['skor_apgar'] ?? '',
    $_POST['bayi_menangis'] ?? 'tidak',
    $_POST['warna_kulit'] ?? '',
    $_POST['perawatan_khusus_detail'] ?? ''
];

if (!$exists) {
    /**
     * LOGIKA INSERT
     * Menentukan kolom secara eksplisit agar lebih aman.
     */
    $columns = [
        "id_anak", "kondisi_kesehatan_ibu", "usia_kandungan_minggu", "konsumsi_fastfood", 
        "fastfood_detail", "konsumsi_obat", "obat_detail", "risiko_asap_rokok", 
        "risiko_polusi", "risiko_zat_kimia", "risiko_lainnya", "metode_persalinan", 
        "tempat_persalinan", "posisi_bayi", "komplikasi_kpd", "komplikasi_lilitan_tali_pusat", 
        "komplikasi_pendarahan", "komplikasi_asfiksia", "komplikasi_macet", 
        "komplikasi_pre_eklampsia", "komplikasi_detail_lainnya", "berat_lahir_gram", 
        "panjang_lahir_cm", "lingkar_kepala_cm", "skor_apgar", "bayi_menangis", 
        "warna_kulit", "perawatan_khusus_detail"
    ];

    $placeholders = implode(',', array_fill(0, count($columns), '?'));
    $sql = "INSERT INTO riwayat_anak (" . implode(',', $columns) . ") VALUES ($placeholders)";
    
    // id_anak diletakkan di awal untuk INSERT
    $params = array_merge([$id_anak], $data_values);
    $types = "i" . str_repeat('s', count($data_values));

} else {
    /**
     * LOGIKA UPDATE
     */
    $sql = "UPDATE riwayat_anak SET
        kondisi_kesehatan_ibu=?, usia_kandungan_minggu=?, konsumsi_fastfood=?,
        fastfood_detail=?, konsumsi_obat=?, obat_detail=?, risiko_asap_rokok=?,
        risiko_polusi=?, risiko_zat_kimia=?, risiko_lainnya=?, metode_persalinan=?,
        tempat_persalinan=?, posisi_bayi=?, komplikasi_kpd=?, komplikasi_lilitan_tali_pusat=?,
        komplikasi_pendarahan=?, komplikasi_asfiksia=?, komplikasi_macet=?,
        komplikasi_pre_eklampsia=?, komplikasi_detail_lainnya=?, berat_lahir_gram=?,
        panjang_lahir_cm=?, lingkar_kepala_cm=?, skor_apgar=?, bayi_menangis=?,
        warna_kulit=?, perawatan_khusus_detail=?
        WHERE id_anak=?";

    // id_anak diletakkan di akhir untuk UPDATE (klausa WHERE)
    $params = array_merge($data_values, [$id_anak]);
    $types = str_repeat('s', count($data_values)) . "i";
}

/**
 * Eksekusi Query
 */
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Gagal menyiapkan statement: " . $conn->error);
}

$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    // Redirect kembali ke halaman form dengan status sukses
    header("Location: index.php?id_anak=$id_anak&success=1");
    exit;
} else {
    die("Gagal menyimpan data ke database: " . $stmt->error);
}