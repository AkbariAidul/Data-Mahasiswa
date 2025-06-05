<?php
// koneksi.php
// Konfigurasi untuk menampilkan semua error (hanya untuk pengembangan)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// konfigurasi database
$host = "localhost";
$user = "root"; // Atau user lokal Anda
$password = ""; // Atau password lokal Anda
$database = "db_mhs";

// perintah koneksi
$koneksi = mysqli_connect($host, $user, $password, $database);

// Pengecekan koneksi
if (mysqli_connect_errno()) {
    // Gunakan die() untuk menghentikan skrip jika koneksi gagal total
    die("Koneksi database gagal: " . mysqli_connect_error());
}
// Pastikan karakter set diatur ke utf8mb4 untuk dukungan emoji dan karakter khusus
mysqli_set_charset($koneksi, "utf8mb4");
?>