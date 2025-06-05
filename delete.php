<?php
session_start(); // Start session to store messages

include "koneksi.php";

// Pastikan koneksi berhasil
if (!$koneksi) {
    $_SESSION['message'] = "Koneksi database gagal: " . mysqli_connect_error();
    $_SESSION['message_type'] = "error";
    header("location:index.php");
    exit();
}

$id_mhs = $_GET['id_mhs'] ?? null;

if (empty($id_mhs)) {
    $_SESSION['message'] = "ID mahasiswa tidak ditemukan untuk dihapus.";
    $_SESSION['message_type'] = "error";
    header("location:index.php");
    exit();
}

// Query DELETE dengan prepared statement
$query = "DELETE FROM mahasiswa WHERE id_mhs=?";

// Persiapkan statement
$stmt = mysqli_prepare($koneksi, $query);

// Bind parameter ke statement
// "i" berarti integer
mysqli_stmt_bind_param($stmt, "i", $id_mhs);

// Jalankan statement
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['message'] = "Data mahasiswa berhasil dihapus.";
    $_SESSION['message_type'] = "success";
    header("location:index.php");
} else {
    $_SESSION['message'] = "Gagal menghapus data: " . mysqli_error($koneksi) . " (Error Code: " . mysqli_errno($koneksi) . ")";
    $_SESSION['message_type'] = "error";
    header("location:index.php");
}

// Tutup statement dan koneksi
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>