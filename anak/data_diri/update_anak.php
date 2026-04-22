<?php
session_start();
include '../../koneksi/koneksi.php';

// Proteksi akses
if (!isset($_SESSION['id_user'])) {
    exit('Unauthorized');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn->begin_transaction();

    try {

        // 🔥 ambil id anak dari form
        $id_anak = $_POST['id_anak'];

        /**
         * 1. UPDATE DATA TABEL 'anak'
         */
        $sql_anak = "UPDATE anak SET
            nama_anak = ?, 
            tanggal_lahir = ?, 
            jenis_kelamin = ?, 
            alamat = ?, 
            hubungan = ?, 
            ortu_serumah = ?, 
            diasuh_ortu = ?, 
            diasuh_wali = ?, 
            urutan_anak = ?, 
            usia_diagnosa = ?, 
            siapa_diagnosa = ?, 
            usia_sekarang = ?
        WHERE id_anak = ?";

        $stmt = $conn->prepare($sql_anak);

        $stmt->bind_param(
            "ssssssssssssi",
            $_POST['nama_anak'],
            $_POST['tanggal_lahir'],
            $_POST['jenis_kelamin'],
            $_POST['alamat'],
            $_POST['hubungan'],
            $_POST['ortu_serumah'],
            $_POST['diasuh_ortu'],
            $_POST['diasuh_wali'],
            $_POST['urutan_anak'],
            $_POST['usia_diagnosa'],
            $_POST['siapa_diagnosa'],
            $_POST['usia_sekarang'],
            $id_anak
        );

        $stmt->execute();

        /**
         * 2. (OPSIONAL) UPLOAD DOKUMEN BARU
         */
        if (!empty($_FILES['dokumen']['name'][0])) {

            foreach ($_FILES['dokumen']['tmp_name'] as $key => $tmp_name) {

                if ($_FILES['dokumen']['error'][$key] === UPLOAD_ERR_OK) {

                    $original_name = $_FILES['dokumen']['name'][$key];
                    $file_size = $_FILES['dokumen']['size'][$key];
                    $file_type = $_FILES['dokumen']['type'][$key];
                    $file_extension = pathinfo($original_name, PATHINFO_EXTENSION);

                    $new_file_name = "DOC_" . time() . "_" . $key . "." . $file_extension;
                    $relative_path = "uploads/dokumen/" . $new_file_name;
                    $upload_path = "../../" . $relative_path;

                    if (move_uploaded_file($tmp_name, $upload_path)) {

                        $ins_doc = $conn->prepare("
                            INSERT INTO dokumen 
                            (id_anak, nama_file, tipe_file, ukuran_file, path_file) 
                            VALUES (?, ?, ?, ?, ?)
                        ");

                        $ins_doc->bind_param(
                            "issis",
                            $id_anak,
                            $original_name,
                            $file_type,
                            $file_size,
                            $relative_path
                        );

                        $ins_doc->execute();
                    }
                }
            }
        }

        /**
         * 3. (OPSIONAL) UPLOAD VIDEO BARU
         */
        if (!empty($_FILES['video']['name'][0])) {

            foreach ($_FILES['video']['tmp_name'] as $key => $tmp_name) {

                if ($_FILES['video']['error'][$key] === UPLOAD_ERR_OK) {

                    $original_name = $_FILES['video']['name'][$key];
                    $file_extension = pathinfo($original_name, PATHINFO_EXTENSION);

                    $new_file_name = "VID_" . time() . "_" . $key . "." . $file_extension;
                    $relative_path = "uploads/video/" . $new_file_name;
                    $upload_path = "../../" . $relative_path;

                    if (move_uploaded_file($tmp_name, $upload_path)) {

                        $ins_vid = $conn->prepare("
                            INSERT INTO video 
                            (id_anak, nama_file, path_file) 
                            VALUES (?, ?, ?)
                        ");

                        $ins_vid->bind_param(
                            "iss",
                            $id_anak,
                            $original_name,
                            $relative_path
                        );

                        $ins_vid->execute();
                    }
                }
            }
        }

        /**
         * 4. COMMIT
         */
        $conn->commit();

        /**
         * 5. REDIRECT KEMBALI KE FORM EDIT
         */
        echo "<script>
            alert('Data berhasil diperbarui!');
            window.location='index.php?id=$id_anak';
        </script>";

    } catch (Exception $e) {

        $conn->rollback();

        echo "<script>
            alert('Gagal update data: " . $e->getMessage() . "');
            window.history.back();
        </script>";
    }
}