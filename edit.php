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

$id_mhs = $_POST['id_mhs'] ?? null;
$nim = $_POST['nim'] ?? '';
$nama = $_POST['nama'] ?? '';
$jurusan = $_POST['jurusan'] ?? '';
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$alamat = $_POST['alamat'] ?? '';

// Validasi dasar
if (empty($id_mhs) || empty($nim) || empty($nama) || empty($jurusan) || empty($jenis_kelamin)) {
    $_SESSION['message'] = "NIM, Nama, Jurusan, Jenis Kelamin, dan ID Mahasiswa tidak boleh kosong.";
    $_SESSION['message_type'] = "error";
    header("location:form-edit.php?id=" . htmlspecialchars($id_mhs)); // Redirect back to edit form
    exit();
}

// Query UPDATE dengan prepared statement
$query="UPDATE mahasiswa SET nim=?, nama=?, jurusan=?, jenis_kelamin=?, alamat=? WHERE id_mhs=?";

// Persiapkan statement
$stmt = mysqli_prepare($koneksi, $query);

// Bind parameter ke statement
// "sssssi" berarti 5 string dan 1 integer
mysqli_stmt_bind_param($stmt, "sssssi", $nim, $nama, $jurusan, $jenis_kelamin, $alamat, $id_mhs);

// Jalankan statement
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['message'] = "Data mahasiswa berhasil diperbarui.";
    $_SESSION['message_type'] = "success";
    header("location:index.php");
} else {
    $_SESSION['message'] = "Gagal memperbarui data: " . mysqli_error($koneksi) . " (Error Code: " . mysqli_errno($koneksi) . ")";
    $_SESSION['message_type'] = "error";
    header("location:index.php");
}

// Tutup statement dan koneksi
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>