<?php
session_start(); // Start session to store messages

include 'koneksi.php';

// Pastikan koneksi berhasil
if (!$koneksi) {
    // Redirection tidak akan terjadi jika die() dipanggil di koneksi.php
    $_SESSION['message'] = "Koneksi database gagal: " . mysqli_connect_error();
    $_SESSION['message_type'] = "error";
    header("location:index.php");
    exit();
}

// Mengambil data dari form dan melakukan sanitasi input (sudah dilakukan oleh mysqli_stmt_bind_param)
$nim = $_POST['nim'] ?? '';
$nama = $_POST['nama'] ?? '';
$jurusan = $_POST['jurusan'] ?? '';
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$alamat = $_POST['alamat'] ?? '';

// Basic server-side validation
if (empty($nim) || empty($nama) || empty($jurusan) || empty($jenis_kelamin)) {
    $_SESSION['message'] = "NIM, Nama, Jurusan, dan Jenis Kelamin tidak boleh kosong.";
    $_SESSION['message_type'] = "error";
    header("location:form-input.php"); // Redirect back to form input if validation fails
    exit();
}

// Query INSERT dengan prepared statement
$query = "INSERT INTO mahasiswa (nim, nama, jurusan, jenis_kelamin, alamat) VALUES (?, ?, ?, ?, ?)";

// Persiapkan statement
$stmt = mysqli_prepare($koneksi, $query);

// Bind parameter ke statement
// "sssss" berarti semua parameter adalah string
mysqli_stmt_bind_param($stmt, "sssss", $nim, $nama, $jurusan, $jenis_kelamin, $alamat);

// Jalankan statement
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['message'] = "Data mahasiswa berhasil disimpan.";
    $_SESSION['message_type'] = "success";
    header("location:index.php");
} else {
    $_SESSION['message'] = "Gagal menyimpan data: " . mysqli_error($koneksi) . " (Error Code: " . mysqli_errno($koneksi) . ")";
    $_SESSION['message_type'] = "error";
    header("location:index.php");
}

// Tutup statement dan koneksi
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>