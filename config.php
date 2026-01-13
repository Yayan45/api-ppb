<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$koneksi = new mysqli(
    getenv("DB_HOST"), // db
    getenv("DB_USER"), // root
    getenv("DB_PASS"), // root
    getenv("DB_NAME")  // blangkis_db
);

if ($koneksi->connect_error) {
    die("DB ERROR: " . $koneksi->connect_error);
}
