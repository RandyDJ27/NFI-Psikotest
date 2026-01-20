<?php
ob_start();
session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<center>Login diperlukan.<br><a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
    // Gunakan path absolut __DIR__ agar file pasti ketemu
    include_once __DIR__ . "/../../config/koneksi.php";
    include_once __DIR__ . "/../../config/library.php";
    include_once __DIR__ . "/../../config/fungsi_thumb.php";

    $module = $_GET['module'];
    $act    = $_GET['act'];
    $tgl_sekarang = date("Y-m-d");

    // Hapus
    if ($module=='soal' && $act=='hapus') {
        mysqli_query($koneksi, "DELETE FROM tbl_soal WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
    }

    // Input
    elseif ($module=='soal' && $act=='input'){
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $nama_file      = $_FILES['fupload']['name'];
        $nama_file_unik = rand(1,99).$nama_file;
      
        if (!empty($lokasi_file)){
            UploadBanner($nama_file_unik);
            mysqli_query($koneksi, "INSERT INTO tbl_soal(soal, a, b, c, d, knc_jawaban, tanggal, gambar) 
                            VALUES('$_POST[soal]', '$_POST[a]', '$_POST[b]', '$_POST[c]', '$_POST[d]', '$_POST[knc_jawaban]', '$tgl_sekarang', '$nama_file_unik')");
        } else {
            mysqli_query($koneksi, "INSERT INTO tbl_soal(soal, a, b, c, d, knc_jawaban, tanggal) 
                            VALUES('$_POST[soal]', '$_POST[a]', '$_POST[b]', '$_POST[c]', '$_POST[d]', '$_POST[knc_jawaban]', '$tgl_sekarang')");
        }
        header('location:../../media.php?module='.$module);
    }

    // Update
    elseif ($module=='soal' && $act=='update'){
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $nama_file      = $_FILES['fupload']['name'];
        $nama_file_unik = rand(1,99).$nama_file;

        if (empty($lokasi_file)){
            mysqli_query($koneksi, "UPDATE tbl_soal SET soal='$_POST[soal]', a='$_POST[a]', b='$_POST[b]', c='$_POST[c]', d='$_POST[d]', knc_jawaban='$_POST[knc_jawaban]' WHERE id_soal='$_POST[id]'");
        } else {
            UploadBanner($nama_file_unik);
            mysqli_query($koneksi, "UPDATE tbl_soal SET soal='$_POST[soal]', a='$_POST[a]', b='$_POST[b]', c='$_POST[c]', d='$_POST[d]', knc_jawaban='$_POST[knc_jawaban]', gambar='$nama_file_unik' WHERE id_soal='$_POST[id]'");
        }
        header('location:../../media.php?module='.$module);
    }

    // Status
    elseif ($module=='soal' && ($act=='nonaktif' || $act=='aktif')){
        $status = ($act == 'aktif') ? 'Y' : 'N';
        mysqli_query($koneksi, "UPDATE tbl_soal SET aktif = '$status' WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
    }
}
ob_end_flush();
?>
