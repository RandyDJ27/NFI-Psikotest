<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
    include_once "../../config/koneksi.php";
    include_once "../../config/library.php";
    include_once "../../config/fungsi_thumb.php";

    $module = isset($_GET['module']) ? $_GET['module'] : '';
    $act    = isset($_GET['act']) ? $_GET['act'] : '';
    $tgl_sekarang = date("Y-m-d");

    // INPUT SOAL
    if ($module=='soal' && $act=='input'){
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
        exit();
    }

    // HAPUS SOAL
    elseif ($module=='soal' && $act=='hapus') {
        mysqli_query($koneksi, "DELETE FROM tbl_soal WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
        exit();
    }

    // UPDATE SOAL
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
        exit();
    }

    // STATUS
    elseif ($module=='soal' && ($act=='nonaktif' || $act=='aktif')){
        $status = ($act == 'aktif') ? 'Y' : 'N';
        mysqli_query($koneksi, "UPDATE tbl_soal SET aktif = '$status' WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
        exit();
    }
}
ob_end_flush();
?>
