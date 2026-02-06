<?php
// PASTIKAN BARIS INI ADA DI BARIS NOMOR 1 TANPA ADA SPASI DI ATASNYA
ob_start(); 
session_start();

// Matikan notifikasi warning agar tidak mengganggu redirect headers
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);

// Path disesuaikan dengan struktur folder Azure kamu
require_once "../../../config/koneksi.php";
require_once "../../../config/library.php";
require_once "../../../config/fungsi_thumb.php";

// Cek Login secara ketat
if (empty($_SESSION['username']) || empty($_SESSION['passuser'])) {
    header("Location: /index.php"); 
    exit;
}

$tgl_sekarang = date("Y-m-d");
$module       = $_GET['module'] ?? '';
$act          = $_GET['act'] ?? '';

// ================= INPUT SOAL =================
if ($module === 'soal' && $act === 'input') {
    $lokasi_file    = $_FILES['fupload']['tmp_name'] ?? '';
    $nama_file      = $_FILES['fupload']['name'] ?? '';
    $acak           = rand(1,99);
    $nama_file_unik = $acak . $nama_file;
    $gambar         = '';

    if (!empty($lokasi_file)) {
        UploadBanner($nama_file_unik);
        $gambar = $nama_file_unik;
    }

    $sql = "INSERT INTO tbl_soal (soal, a, b, c, d, knc_jawaban, tanggal, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssss", 
            $_POST['soal'], $_POST['a'], $_POST['b'], $_POST['c'], $_POST['d'], $_POST['knc_jawaban'], $tgl_sekarang, $gambar
        );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: /admin/media.php?module=soal");
    exit;
}

// ================= UPDATE SOAL =================
elseif ($module === 'soal' && $act === 'update') {
    $id             = $_POST['id'];
    $lokasi_file    = $_FILES['fupload']['tmp_name'] ?? '';
    $nama_file      = $_FILES['fupload']['name'] ?? '';
    $acak           = rand(1,99);
    $nama_file_unik = $acak . $nama_file;

    if (empty($lokasi_file)) {
        $sql = "UPDATE tbl_soal SET soal=?, a=?, b=?, c=?, d=?, knc_jawaban=? WHERE id_soal=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $_POST['soal'], $_POST['a'], $_POST['b'], $_POST['c'], $_POST['d'], $_POST['knc_jawaban'], $id);
    } else {
        UploadBanner($nama_file_unik);
        $sql = "UPDATE tbl_soal SET soal=?, a=?, b=?, c=?, d=?, knc_jawaban=?, gambar=? WHERE id_soal=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $_POST['soal'], $_POST['a'], $_POST['b'], $_POST['c'], $_POST['d'], $_POST['knc_jawaban'], $nama_file_unik, $id);
    }

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: /admin/media.php?module=soal");
    exit;
}
ob_end_flush();
?>
