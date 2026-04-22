<?php
session_start();
include '../koneksi/koneksi.php';

$id = $_POST['id'];

$stmt = $conn->prepare("
UPDATE orang_tua SET
nama_ayah=?, ttl_ayah=?, pekerjaan_ayah=?, telp_ayah=?,
nama_ibu=?, ttl_ibu=?, pekerjaan_ibu=?, telp_ibu=?,
kondisi_anak=?, keluhan=?, harapan=?
WHERE id=?
");

$stmt->bind_param("sssssssssssi",
$_POST['nama_ayah'],
$_POST['ttl_ayah'],
$_POST['pekerjaan_ayah'],
$_POST['telp_ayah'],
$_POST['nama_ibu'],
$_POST['ttl_ibu'],
$_POST['pekerjaan_ibu'],
$_POST['telp_ibu'],
$_POST['kondisi_anak'],
$_POST['keluhan'],
$_POST['harapan'],
$id
);

$stmt->execute();

header("Location: index.php?update=1");