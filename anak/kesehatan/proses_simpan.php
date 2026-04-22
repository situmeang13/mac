<?php
session_start();
include '../../koneksi/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_anak = (int) $_POST['id_anak'];

    $tinggi_badan     = (int) $_POST['tinggi_badan_cm'];
    $berat_badan      = (float) $_POST['berat_badan_kg'];

    $makanan_3_bulan  = $_POST['makanan_3_bulan_terakhir'];
    $makanan_favorit  = $_POST['makanan_favorit'];
    $kegiatan_favorit = $_POST['kegiatan_favorit'];

    $konsumsi_obat    = $_POST['konsumsi_obat'];
    $keterangan_obat  = $_POST['keterangan_obat'] ?? '';

    $disabilitas_intelektual = isset($_POST['disabilitas_intelektual']) ? 1 : 0;
    $cerebral_palsy = isset($_POST['cerebral_palsy']) ? 1 : 0;
    $epilepsi = isset($_POST['epilepsi']) ? 1 : 0;
    $skizofrenia = isset($_POST['skizofrenia']) ? 1 : 0;
    $depresi = isset($_POST['depresi']) ? 1 : 0;

    // 🔥 CEK DATA SUDAH ADA ATAU BELUM
    $cek = $conn->prepare("SELECT id FROM kesehatan_anak WHERE id_anak = ?");
    $cek->bind_param("i", $id_anak);
    $cek->execute();
    $result = $cek->get_result();
    $exist = $result->fetch_assoc();

    if ($exist) {

        // 🔥 UPDATE
        $stmt = $conn->prepare("UPDATE kesehatan_anak SET 
            tinggi_badan_cm=?,
            berat_badan_kg=?,
            disabilitas_intelektual=?,
            cerebral_palsy=?,
            epilepsi=?,
            skizofrenia=?,
            depresi=?,
            makanan_3_bulan_terakhir=?,
            makanan_favorit=?,
            kegiatan_favorit=?,
            konsumsi_obat=?,
            keterangan_obat=?
            WHERE id_anak=?
        ");

        $stmt->bind_param(
            "diiiiissssssi",
            $tinggi_badan,
            $berat_badan,
            $disabilitas_intelektual,
            $cerebral_palsy,
            $epilepsi,
            $skizofrenia,
            $depresi,
            $makanan_3_bulan,
            $makanan_favorit,
            $kegiatan_favorit,
            $konsumsi_obat,
            $keterangan_obat,
            $id_anak
        );

        $stmt->execute();

    } else {

        // 🔥 INSERT
        $stmt = $conn->prepare("INSERT INTO kesehatan_anak (
            id_anak, tinggi_badan_cm, berat_badan_kg,
            disabilitas_intelektual, cerebral_palsy, epilepsi, skizofrenia, depresi,
            makanan_3_bulan_terakhir, makanan_favorit, kegiatan_favorit,
            konsumsi_obat, keterangan_obat, created_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

        $stmt->bind_param(
            "iidiiiiisssss",
            $id_anak,
            $tinggi_badan,
            $berat_badan,
            $disabilitas_intelektual,
            $cerebral_palsy,
            $epilepsi,
            $skizofrenia,
            $depresi,
            $makanan_3_bulan,
            $makanan_favorit,
            $kegiatan_favorit,
            $konsumsi_obat,
            $keterangan_obat
        );

        $stmt->execute();
    }

    echo "<script>
        alert('Data berhasil disimpan / diperbarui');
        window.location.href='index.php?id_anak=$id_anak';
    </script>";
}
?>