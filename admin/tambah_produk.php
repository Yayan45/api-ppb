<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once "../config.php";

$nama = $_POST['nama'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$harga = $_POST['harga'] ?? 0;
$gambar = $_POST['gambar'] ?? '';

if ($nama == '') {
    echo json_encode(["success"=>false,"error"=>"Nama kosong"]);
    exit;
}

mysqli_query($koneksi,
    "INSERT INTO produk (nama, deskripsi, harga, gambar)
     VALUES ('$nama','$deskripsi','$harga','$gambar')"
);

echo json_encode(["success"=>true]);
