<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cek apakah session ada. Kalau kosong, arahkan ke login.
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    // Link login saya perbaiki ke folder utama
    echo "<a href='../../../index.php'><b>LOGIN</b></a></center>";
    exit; // Menghentikan script agar tidak lanjut ke bawah
}
else{
    include "../../../config/koneksi.php";
    include "../../../config/library.php";
    include "../../../config/fungsi_thumb.php";

    $module = isset($_GET['module']) ? $_GET['module'] : '';
    $act    = isset($_GET['act']) ? $_GET['act'] : '';

    // --- PROSES INPUT SOAL ---
    if ($module=='soal' AND $act=='input'){
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $nama_file      = $_FILES['fupload']['name'];
        $acak           = rand(1,99);
        $nama_file_unik = $acak.$nama_file;
        
        if (!empty($lokasi_file)){
            UploadBanner($nama_file_unik);
            mysqli_query($koneksi, "INSERT INTO tbl_soal(soal,a,b,c,d,knc_jawaban,tanggal,gambar) 
                            VALUES('$_POST[soal]', '$_POST[a]', '$_POST[b]', '$_POST[c]', '$_POST[d]', '$_POST[knc_jawaban]', '$tgl_sekarang', '$nama_file_unik')");
        } else {
            mysqli_query($koneksi, "INSERT INTO tbl_soal(soal,a,b,c,d,knc_jawaban) 
                            VALUES('$_POST[soal]', '$_POST[a]', '$_POST[b]', '$_POST[c]', '$_POST[d]', '$_POST[knc_jawaban]')");
        }
        header('location:../../media.php?module='.$module);
    }

    // --- PROSES HAPUS SOAL ---
    elseif ($module=='soal' AND $act=='hapus') {
        mysqli_query($koneksi, "DELETE FROM tbl_soal WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
    }

    // --- PROSES UPDATE SOAL ---
    elseif ($module=='soal' AND $act=='update'){
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $nama_file      = $_FILES['fupload']['name'];
        $acak           = rand(1,99);
        $nama_file_unik = $acak.$nama_file; 

        if (empty($lokasi_file)){
            mysqli_query($koneksi, "UPDATE tbl_soal SET soal = '$_POST[soal]', a = '$_POST[a]', b = '$_POST[b]', c = '$_POST[c]', d = '$_POST[d]', knc_jawaban = '$_POST[knc_jawaban]' WHERE id_soal = '$_POST[id]'");
        } else {
            UploadBanner($nama_file_unik);
            mysqli_query($koneksi, "UPDATE tbl_soal SET soal = '$_POST[soal]', a = '$_POST[a]', b = '$_POST[b]', c = '$_POST[c]', d = '$_POST[d]', knc_jawaban = '$_POST[knc_jawaban]', gambar = '$nama_file_unik' WHERE id_soal = '$_POST[id]'");
        }
        header('location:../../media.php?module='.$module);
    }
}
