<?php
ob_start(); // Menahan output agar redirect aman
session_start();

// Matikan error reporting di layar agar tidak merusak header redirect
error_reporting(0);
ini_set('display_errors', 0);

require_once "../../../config/koneksi.php";

// Cek login: Jika sesi hilang, jangan langsung redirect pake header kalau ada potensi error
if (empty($_SESSION['username']) || empty($_SESSION['passuser'])) {
    echo "<script>alert('Sesi habis, silakan login ulang'); window.location='/index.php';</script>";
    exit;
}

$module = $_GET['module'] ?? '';
$act    = $_GET['act'] ?? '';
$tgl_sekarang = date("Y-m-d");

if ($module === 'soal' && $act === 'input') {
    $soal = $_POST['soal'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $knc = $_POST['knc_jawaban'];

    // Gunakan query biasa jika prepared statement kamu bermasalah dengan versi PHP di Azure
    $query = "INSERT INTO tbl_soal (soal, a, b, c, d, knc_jawaban, tanggal) 
              VALUES ('$soal', '$a', '$b', '$c', '$d', '$knc', '$tgl_sekarang')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: /admin/media.php?module=soal");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    exit;
}
ob_end_flush();
?>
