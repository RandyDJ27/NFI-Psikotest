<?php
// Jangan ada spasi atau baris kosong sebelum tag <?php ini!
ob_start();
session_start();

// Mencegah error 'Headers already sent' yang bikin logout otomatis
error_reporting(0);
ini_set('display_errors', 0);

// Path naik 3 kali karena dari admin/modul/mod_soal/ ke config/
require_once "../../../config/koneksi.php";

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
        // Redirect balik ke media.php yang ada di folder admin
        header("Location: ../../media.php?module=soal");
    } else {
        echo "Gagal: " . mysqli_error($koneksi);
    }
}
ob_end_flush();
?>
