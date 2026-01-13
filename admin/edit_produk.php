<?php
error_reporting(0);
ini_set('display_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "../config.php";

$id = $_POST['id'] ?? '';
$nama = $_POST['nama'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$harga = $_POST['harga'] ?? '';
$gambar = $_POST['gambar'] ?? '';

if ($id == '' || $nama == '' || $harga == '') {
    echo json_encode([
        "success" => false,
        "error" => "Data tidak lengkap"
    ]);
    exit;
}

$stmt = $koneksi->prepare(
    "UPDATE produk
     SET nama=?, deskripsi=?, harga=?, gambar=?
     WHERE id=?"
);

$stmt->bind_param("ssisi", $nama, $deskripsi, $harga, $gambar, $id);
$stmt->execute();

echo json_encode([
    "success" => true,
    "message" => "Produk berhasil diupdate"
]);
