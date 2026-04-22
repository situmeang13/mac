<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

include '../../koneksi/koneksi.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {

    try {

        $id_anak = (int) $_POST['id_anak_hidden'];

        // ambil data
        $params = [
            $id_anak,

            $_POST['merangkak'],
            $_POST['duduk'],
            $_POST['berdiri'],
            $_POST['berjalan'],
            $_POST['berlari'],
            $_POST['melompat'],
            $_POST['jongkok'],
            $_POST['melempar_bola'],
            $_POST['menangkap_bola'],
            $_POST['naik_turun_tangga'],

            $_POST['frekuensi_tantrum'],
            $_POST['durasi_tantrum'],

            $_POST['pol_geram'], $_POST['pol_berteriak'], $_POST['pol_membentur'], $_POST['pol_mencakar'],
            $_POST['pol_menendang'], $_POST['pol_memukul_telapak'], $_POST['pol_memukul_kepalan'],
            $_POST['pol_menggigit'], $_POST['pol_meludah'], $_POST['pol_kasar'], $_POST['pol_benda_tajam'],
            $_POST['pol_gigi'], $_POST['pol_mengurung'], $_POST['pol_menangis'],

            $_POST['pd_geram'], $_POST['pd_berteriak'], $_POST['pd_membentur'], $_POST['pd_mencakar'],
            $_POST['pd_menendang'], $_POST['pd_memukul_telapak'], $_POST['pd_memukul_kepalan'],
            $_POST['pd_menggigit'], $_POST['pd_meludah'], $_POST['pd_kasar'], $_POST['pd_benda_tajam'],
            $_POST['pd_gigi'], $_POST['pd_mengurung'], $_POST['pd_menangis'],

            $_POST['perilaku_seksual']
        ];

        // cek apakah sudah ada
        $cek = $conn->prepare("SELECT id_kondisi FROM kondisi_terkini_anak WHERE id_anak=?");
        $cek->bind_param("i", $id_anak);
        $cek->execute();
        $exist = $cek->get_result()->fetch_assoc();

        if ($exist) {

            // UPDATE
            $sql = "UPDATE kondisi_terkini_anak SET
                merangkak=?, duduk=?, berdiri=?, berjalan=?, berlari=?, melompat=?, jongkok=?, melempar_bola=?, menangkap_bola=?, naik_turun_tangga=?,
                frekuensi_tantrum=?, durasi_tantrum=?,
                perilaku_orang_lain_geram=?, perilaku_orang_lain_berteriak=?, perilaku_orang_lain_membentur=?, perilaku_orang_lain_mencakar=?, perilaku_orang_lain_menendang=?, perilaku_orang_lain_memukul_telapak=?, perilaku_orang_lain_memukul_kepalan=?, perilaku_orang_lain_menggigit=?, perilaku_orang_lain_meludah=?, perilaku_orang_lain_kasar=?, perilaku_orang_lain_benda_tajam=?, perilaku_orang_lain_gigi=?, perilaku_orang_lain_mengurung=?, perilaku_orang_lain_menangis=?,
                perilaku_diri_geram=?, perilaku_diri_berteriak=?, perilaku_diri_membentur=?, perilaku_diri_mencakar=?, perilaku_diri_menendang=?, perilaku_diri_memukul_telapak=?, perilaku_diri_memukul_kepalan=?, perilaku_diri_menggigit=?, perilaku_diri_meludah=?, perilaku_diri_kasar=?, perilaku_diri_benda_tajam=?, perilaku_diri_gigi=?, perilaku_diri_mengurung=?, perilaku_diri_menangis=?,
                perilaku_seksual=?
            WHERE id_anak=?";

            $params_update = array_slice($params, 1);
            $params_update[] = $id_anak;

            $types = str_repeat("s", count($params_update) - 1) . "i";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params_update);

        } else {

            // INSERT
            $sql = "INSERT INTO kondisi_terkini_anak VALUES (" . implode(',', array_fill(0, count($params), '?')) . ")";
            $types = "i" . str_repeat("s", count($params) - 1);

            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        echo "<script>
            alert('Data berhasil disimpan');
            window.location.href='index.php';
        </script>";

    } catch (Exception $e) {
        echo "<script>
            alert('Error: " . addslashes($e->getMessage()) . "');
        </script>";
    }
}
?>