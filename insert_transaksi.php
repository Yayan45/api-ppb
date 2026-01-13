<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

include "config.php";

$user_id      = $_POST['user_id'] ?? '';
$total        = $_POST['total'] ?? '';
$paket        = $_POST['paket'] ?? '';
$kota_asal    = $_POST['kota_asal'] ?? '';
$kota_tujuan  = $_POST['kota_tujuan'] ?? '';
$detail       = $_POST['items'] ?? '';
$bukti        = $_POST['bukti'] ?? '';

if ($user_id == '' || $total == '' || $bukti == '') {
  echo json_encode([
    "success" => false,
    "error" => "Data tidak lengkap"
  ]);
  exit;
}

// SIMPAN FILE BUKTI
$folder = "bukti/";
if (!file_exists($folder)) {
  mkdir($folder, 0777, true);
}

$namaFile = "bukti_" . time() . ".png";
$filePath = $folder . $namaFile;
file_put_contents($filePath, base64_decode($bukti));

// INSERT DATABASE
$sql = "INSERT INTO transaksi 
(user_id, total, paket, kota_asal, kota_tujuan, detail, bukti)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);

if (!$stmt) {
  echo json_encode([
    "success" => false,
    "error" => mysqli_error($koneksi)
  ]);
  exit;
}

mysqli_stmt_bind_param(
  $stmt,
  "idsssss",
  $user_id,
  $total,
  $paket,
  $kota_asal,
  $kota_tujuan,
  $detail,
  $filePath
);

if (mysqli_stmt_execute($stmt)) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode([
    "success" => false,
    "error" => mysqli_stmt_error($stmt)
  ]);
}
