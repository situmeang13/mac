<?php 
session_start();
include '../../koneksi/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    // ======================
    // AMBIL DATA FORM
    // ======================
    $id_anak = (int) $_POST['id_anak'];

    $tinggi_badan     = (float) $_POST['tinggi_badan_cm'];
    $berat_badan      = (float) $_POST['berat_badan_kg'];

    $makanan_3_bulan  = $_POST['makanan_3_bulan_terakhir'];
    $makanan_favorit  = $_POST['makanan_favorit'];
    $kegiatan_favorit = $_POST['kegiatan_favorit'];

    $konsumsi_obat    = $_POST['konsumsi_obat'];
    $keterangan_obat  = $_POST['keterangan_obat'] ?? '';

    // ======================
    // CHECKBOX KONDISI
    // ======================
    $disabilitas_intelektual = isset($_POST['disabilitas_intelektual']) ? 1 : 0;
    $cerebral_palsy = isset($_POST['cerebral_palsy']) ? 1 : 0;
    $epilepsi = isset($_POST['epilepsi']) ? 1 : 0;
    $skizofrenia = isset($_POST['skizofrenia']) ? 1 : 0;
    $depresi = isset($_POST['depresi']) ? 1 : 0;

    // ======================
    // VALIDASI
    // ======================
    if ($id_anak <= 0) {
        throw new Exception("ID anak tidak valid");
    }

    // ======================
    // CEK DATA EXIST
    // ======================
    $cek = $conn->prepare("SELECT id_kesehatan FROM kesehatan_anak WHERE id_anak = ?");
    $cek->bind_param("i", $id_anak);
    $cek->execute();
    $result = $cek->get_result();
    $data = $result->fetch_assoc();

    // ======================
    // JIKA ADA → UPDATE
    // ======================
    if ($data) {

        $id_kesehatan = $data['id_kesehatan'];

        $sql = "UPDATE kesehatan_anak SET 
            tinggi_badan_cm = ?,
            berat_badan_kg = ?,
            disabilitas_intelektual = ?,
            cerebral_palsy = ?,
            epilepsi = ?,
            skizofrenia = ?,
            depresi = ?,
            makanan_3_bulan_terakhir = ?,
            makanan_favorit = ?,
            kegiatan_favorit = ?,
            konsumsi_obat = ?,
            keterangan_obat = ?
            WHERE id_kesehatan = ?
        ";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ddiiiiisssssi",
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
            $id_kesehatan
        );

        $stmt->execute();
    }

    // ======================
    // JIKA BELUM ADA → INSERT
    // ======================
    else {

        $sql = "INSERT INTO kesehatan_anak (
            id_anak,
            tinggi_badan_cm,
            berat_badan_kg,
            disabilitas_intelektual,
            cerebral_palsy,
            epilepsi,
            skizofrenia,
            depresi,
            makanan_3_bulan_terakhir,
            makanan_favorit,
            kegiatan_favorit,
            konsumsi_obat,
            keterangan_obat,
            created_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "iddiiiiisssss",
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

    // ======================
    // SUCCESS RESPONSE
    // ======================
    echo "<script>
        alert('Data kesehatan berhasil disimpan / diperbarui!');
        window.location.href = 'index.php?id_anak=$id_anak';
    </script>";

} catch (Throwable $e) {

    echo "<pre style='color:red; font-size:14px'>";
    echo "ERROR: " . $e->getMessage();
    echo "</pre>";
}
?>