<?php
// PERBAIKAN: ob_start untuk mencegah 'Headers already sent'
ob_start();
session_start();

// Matikan error ke layar agar redirect lancar
error_reporting(0);
ini_set('display_errors', 0);

require_once "../../../config/koneksi.php";

// Cek Sesi agar tidak logout otomatis
if (empty($_SESSION['username'])) {
    header("Location: /index.php");
    exit;
}

$module = $_GET['module'];
$act    = $_GET['act'];

if ($module=='soal' && $act=='input'){
    $soal = mysqli_real_escape_string($koneksi, $_POST['soal']);
    $a    = mysqli_real_escape_string($koneksi, $_POST['a']);
    $b    = mysqli_real_escape_string($koneksi, $_POST['b']);
    $c    = mysqli_real_escape_string($koneksi, $_POST['c']);
    $d    = mysqli_real_escape_string($koneksi, $_POST['d']);
    $knc  = $_POST['knc_jawaban'];
    $tgl  = date("Y-m-d");

    $query = "INSERT INTO tbl_soal (soal, a, b, c, d, knc_jawaban, tanggal) 
              VALUES ('$soal', '$a', '$b', '$c', '$d', '$knc', '$tgl')";
    
    if(mysqli_query($koneksi, $query)){
        header("Location: /admin/media.php?module=soal");
    } else {
        echo "Gagal Simpan: " . mysqli_error($koneksi);
    }
}
elseif ($module=='soal' && $act=='hapus'){
    mysqli_query($koneksi, "DELETE FROM tbl_soal WHERE id_soal='$_GET[id]'");
    header("Location: /admin/media.php?module=soal");
}
ob_end_flush();
?>
