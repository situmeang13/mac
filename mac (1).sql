-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2026 at 02:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mac`
--

-- --------------------------------------------------------

--
-- Table structure for table `akademik`
--

CREATE TABLE `akademik` (
  `id_akademik` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `duduk` enum('ya','tidak') DEFAULT NULL,
  `durasi_fokus` varchar(20) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akademik_literasi`
--

CREATE TABLE `akademik_literasi` (
  `id` int(11) NOT NULL,
  `id_akademik` int(11) DEFAULT NULL,
  `indikator` varchar(100) DEFAULT NULL,
  `status` enum('ya','tidak') DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akademik_numerasi`
--

CREATE TABLE `akademik_numerasi` (
  `id` int(11) NOT NULL,
  `id_akademik` int(11) DEFAULT NULL,
  `range_angka` varchar(20) DEFAULT NULL,
  `status` enum('ya','tidak') DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akademik_penjumlahan`
--

CREATE TABLE `akademik_penjumlahan` (
  `id` int(11) NOT NULL,
  `id_akademik` int(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `status` enum('ya','tidak') DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anak`
--

CREATE TABLE `anak` (
  `id_anak` int(11) NOT NULL,
  `id_ortu` int(11) NOT NULL,
  `nama_anak` varchar(100) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `hubungan` varchar(50) DEFAULT NULL,
  `ortu_serumah` enum('Ya','Tidak') DEFAULT NULL,
  `diasuh_ortu` enum('Ya','Tidak') DEFAULT NULL,
  `diasuh_wali` enum('Ya','Tidak') DEFAULT NULL,
  `urutan_anak` varchar(100) DEFAULT NULL,
  `usia_diagnosa` varchar(50) DEFAULT NULL,
  `siapa_diagnosa` varchar(100) DEFAULT NULL,
  `usia_sekarang` varchar(50) DEFAULT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asesmen_anak`
--

CREATE TABLE `asesmen_anak` (
  `id_asesmen` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `duduk` enum('ya','tidak') DEFAULT NULL,
  `durasi_fokus` varchar(20) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `akademik_status` longtext DEFAULT NULL,
  `akademik_note` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asesmen_detail`
--

CREATE TABLE `asesmen_detail` (
  `id_detail` int(11) NOT NULL,
  `id_asesmen` int(11) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `indikator` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `tipe_file` varchar(50) DEFAULT NULL,
  `ukuran_file` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `path_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kesehatan_anak`
--

CREATE TABLE `kesehatan_anak` (
  `id_kesehatan` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `tinggi_badan_cm` int(11) NOT NULL,
  `berat_badan_kg` decimal(5,2) NOT NULL,
  `disabilitas_intelektual` tinyint(1) DEFAULT 0,
  `cerebral_palsy` tinyint(1) DEFAULT 0,
  `epilepsi` tinyint(1) DEFAULT 0,
  `skizofrenia` tinyint(1) DEFAULT 0,
  `depresi` tinyint(1) DEFAULT 0,
  `makanan_3_bulan_terakhir` text DEFAULT NULL,
  `makanan_favorit` text DEFAULT NULL,
  `kegiatan_favorit` text DEFAULT NULL,
  `konsumsi_obat` enum('Ya','Tidak') DEFAULT 'Tidak',
  `keterangan_obat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_anak`
--

CREATE TABLE `kondisi_anak` (
  `id_kondisi` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `motorik_status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`motorik_status`)),
  `adl_status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`adl_status`)),
  `frek_tantrum` varchar(20) DEFAULT NULL,
  `durasi_tantrum` varchar(20) DEFAULT NULL,
  `marah_org` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`marah_org`)),
  `marah_self` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`marah_self`)),
  `durasi_mata` varchar(20) DEFAULT NULL,
  `play_social` enum('ya','tidak') DEFAULT NULL,
  `catatan_komunikasi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_terkini_anak`
--

CREATE TABLE `kondisi_terkini_anak` (
  `id_kondisi` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `merangkak` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `duduk` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `berdiri` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `berjalan` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `berlari` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `melompat` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `jongkok` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `melempar_bola` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `menangkap_bola` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `naik_turun_tangga` enum('Baik','Bantuan','Tidak Bisa') DEFAULT 'Tidak Bisa',
  `frekuensi_tantrum` varchar(50) NOT NULL,
  `durasi_tantrum` varchar(50) NOT NULL,
  `perilaku_orang_lain_geram` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_berteriak` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_membentur` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_mencakar` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_menendang` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_memukul_telapak` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_memukul_kepalan` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_menggigit` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_meludah` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_kasar` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_benda_tajam` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_gigi` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_mengurung` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_orang_lain_menangis` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_geram` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_berteriak` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_membentur` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_mencakar` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_menendang` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_memukul_telapak` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_memukul_kepalan` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_menggigit` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_meludah` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_kasar` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_benda_tajam` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_gigi` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_mengurung` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_diri_menangis` enum('Keras','Sedang','Pelan','Tidak Ada') DEFAULT 'Tidak Ada',
  `perilaku_seksual` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `ttl_ayah` varchar(100) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `telp_ayah` varchar(20) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `ttl_ibu` varchar(100) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `telp_ibu` varchar(20) NOT NULL,
  `kondisi_anak` varchar(50) NOT NULL,
  `keluhan` text NOT NULL,
  `harapan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `jabatan_ayah` varchar(100) DEFAULT NULL,
  `gaji_ayah` varchar(50) DEFAULT NULL,
  `email_ayah` varchar(100) DEFAULT NULL,
  `alamat_ayah` text DEFAULT NULL,
  `jabatan_ibu` varchar(100) DEFAULT NULL,
  `gaji_ibu` varchar(50) DEFAULT NULL,
  `email_ibu` varchar(100) DEFAULT NULL,
  `alamat_ibu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_anak`
--

CREATE TABLE `riwayat_anak` (
  `id_riwayat` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `kondisi_kesehatan_ibu` text DEFAULT NULL,
  `usia_kandungan_minggu` int(11) DEFAULT NULL,
  `konsumsi_fastfood` enum('ya','tidak') DEFAULT NULL,
  `fastfood_detail` text DEFAULT NULL,
  `konsumsi_obat` enum('ya','tidak') DEFAULT NULL,
  `obat_detail` text DEFAULT NULL,
  `risiko_asap_rokok` enum('ya','tidak') DEFAULT 'tidak',
  `risiko_polusi` enum('ya','tidak') DEFAULT 'tidak',
  `risiko_zat_kimia` enum('ya','tidak') DEFAULT 'tidak',
  `risiko_lainnya` enum('ya','tidak') DEFAULT 'tidak',
  `metode_persalinan` varchar(50) DEFAULT NULL,
  `tempat_persalinan` varchar(100) DEFAULT NULL,
  `posisi_bayi` varchar(50) DEFAULT NULL,
  `komplikasi_kpd` enum('ya','tidak') DEFAULT 'tidak',
  `komplikasi_lilitan_tali_pusat` enum('ya','tidak') DEFAULT 'tidak',
  `komplikasi_pendarahan` enum('ya','tidak') DEFAULT 'tidak',
  `komplikasi_asfiksia` enum('ya','tidak') DEFAULT 'tidak',
  `komplikasi_macet` enum('ya','tidak') DEFAULT 'tidak',
  `komplikasi_pre_eklampsia` enum('ya','tidak') DEFAULT 'tidak',
  `komplikasi_detail_lainnya` text DEFAULT NULL,
  `berat_lahir_gram` int(11) DEFAULT NULL,
  `panjang_lahir_cm` int(11) DEFAULT NULL,
  `lingkar_kepala_cm` int(11) DEFAULT NULL,
  `skor_apgar` varchar(10) DEFAULT NULL,
  `bayi_menangis` enum('ya','tidak') DEFAULT NULL,
  `warna_kulit` varchar(50) DEFAULT NULL,
  `perawatan_khusus_detail` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sensori_halus`
--

CREATE TABLE `sensori_halus` (
  `id` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `aspek_ke` int(11) NOT NULL,
  `nama_aspek` varchar(255) NOT NULL,
  `status` enum('ya','tidak') NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('bos','manajemen','terapis_mac','terapis_macplus','orang_tua') NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akademik`
--
ALTER TABLE `akademik`
  ADD PRIMARY KEY (`id_akademik`),
  ADD KEY `id_anak` (`id_anak`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `akademik_literasi`
--
ALTER TABLE `akademik_literasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akademik` (`id_akademik`);

--
-- Indexes for table `akademik_numerasi`
--
ALTER TABLE `akademik_numerasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akademik` (`id_akademik`);

--
-- Indexes for table `akademik_penjumlahan`
--
ALTER TABLE `akademik_penjumlahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akademik` (`id_akademik`);

--
-- Indexes for table `anak`
--
ALTER TABLE `anak`
  ADD PRIMARY KEY (`id_anak`),
  ADD KEY `id_ortu` (`id_ortu`);

--
-- Indexes for table `asesmen_anak`
--
ALTER TABLE `asesmen_anak`
  ADD PRIMARY KEY (`id_asesmen`),
  ADD KEY `id_anak` (`id_anak`);

--
-- Indexes for table `asesmen_detail`
--
ALTER TABLE `asesmen_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indexes for table `kesehatan_anak`
--
ALTER TABLE `kesehatan_anak`
  ADD PRIMARY KEY (`id_kesehatan`),
  ADD KEY `id_anak` (`id_anak`);

--
-- Indexes for table `kondisi_anak`
--
ALTER TABLE `kondisi_anak`
  ADD PRIMARY KEY (`id_kondisi`),
  ADD KEY `id_anak` (`id_anak`);

--
-- Indexes for table `kondisi_terkini_anak`
--
ALTER TABLE `kondisi_terkini_anak`
  ADD PRIMARY KEY (`id_kondisi`),
  ADD KEY `fk_kondisi_anak` (`id_anak`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `riwayat_anak`
--
ALTER TABLE `riwayat_anak`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_anak` (`id_anak`);

--
-- Indexes for table `sensori_halus`
--
ALTER TABLE `sensori_halus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anak` (`id_anak`),
  ADD KEY `aspek_ke` (`aspek_ke`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username_unique` (`username`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akademik`
--
ALTER TABLE `akademik`
  MODIFY `id_akademik` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `akademik_literasi`
--
ALTER TABLE `akademik_literasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `akademik_numerasi`
--
ALTER TABLE `akademik_numerasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `akademik_penjumlahan`
--
ALTER TABLE `akademik_penjumlahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anak`
--
ALTER TABLE `anak`
  MODIFY `id_anak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `asesmen_anak`
--
ALTER TABLE `asesmen_anak`
  MODIFY `id_asesmen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `asesmen_detail`
--
ALTER TABLE `asesmen_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kesehatan_anak`
--
ALTER TABLE `kesehatan_anak`
  MODIFY `id_kesehatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kondisi_anak`
--
ALTER TABLE `kondisi_anak`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kondisi_terkini_anak`
--
ALTER TABLE `kondisi_terkini_anak`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riwayat_anak`
--
ALTER TABLE `riwayat_anak`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sensori_halus`
--
ALTER TABLE `sensori_halus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akademik`
--
ALTER TABLE `akademik`
  ADD CONSTRAINT `akademik_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id_anak`) ON DELETE CASCADE,
  ADD CONSTRAINT `akademik_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `akademik_literasi`
--
ALTER TABLE `akademik_literasi`
  ADD CONSTRAINT `akademik_literasi_ibfk_1` FOREIGN KEY (`id_akademik`) REFERENCES `akademik` (`id_akademik`) ON DELETE CASCADE;

--
-- Constraints for table `akademik_numerasi`
--
ALTER TABLE `akademik_numerasi`
  ADD CONSTRAINT `akademik_numerasi_ibfk_1` FOREIGN KEY (`id_akademik`) REFERENCES `akademik` (`id_akademik`) ON DELETE CASCADE;

--
-- Constraints for table `akademik_penjumlahan`
--
ALTER TABLE `akademik_penjumlahan`
  ADD CONSTRAINT `akademik_penjumlahan_ibfk_1` FOREIGN KEY (`id_akademik`) REFERENCES `akademik` (`id_akademik`) ON DELETE CASCADE;

--
-- Constraints for table `anak`
--
ALTER TABLE `anak`
  ADD CONSTRAINT `anak_ibfk_1` FOREIGN KEY (`id_ortu`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `asesmen_anak`
--
ALTER TABLE `asesmen_anak`
  ADD CONSTRAINT `asesmen_anak_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id_anak`) ON DELETE CASCADE;

--
-- Constraints for table `kondisi_anak`
--
ALTER TABLE `kondisi_anak`
  ADD CONSTRAINT `kondisi_anak_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id_anak`) ON DELETE CASCADE;

--
-- Constraints for table `kondisi_terkini_anak`
--
ALTER TABLE `kondisi_terkini_anak`
  ADD CONSTRAINT `fk_anak` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id_anak`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_kondisi_anak` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id_anak`) ON DELETE CASCADE;

--
-- Constraints for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD CONSTRAINT `orang_tua_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat_anak`
--
ALTER TABLE `riwayat_anak`
  ADD CONSTRAINT `riwayat_anak_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id_anak`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
