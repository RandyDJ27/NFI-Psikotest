<?php
session_start();
// Jika session kosong, tendang ke login
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
    // Jalur absolut agar Azure tidak bingung mencari file
    include_once __DIR__ . "../../config/koneksi.php";
    include_once __DIR__ . "../../config/library.php";
    include_once __DIR__ . "../../config/fungsi_thumb.php";

    // Gunakan tanda kutip untuk index array $_GET
    $module = $_GET['module'];
    $act    = $_GET['act'];

    // Input soal
    if ($module=='soal' && $act=='input'){
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $nama_file      = $_FILES['fupload']['name'];
        $acak           = rand(1,99);
        $nama_file_unik = $acak.$nama_file;
      
        if (!empty($lokasi_file)){
            UploadBanner($nama_file_unik);
            mysqli_query($koneksi, "INSERT INTO tbl_soal(soal, a, b, c, d, knc_jawaban, tanggal, gambar) 
                            VALUES('$_POST[soal]', '$_POST[a]', '$_POST[b]', '$_POST[c]', '$_POST[d]', '$_POST[knc_jawaban]', '$tgl_sekarang', '$nama_file_unik')");
        }
        else {
            mysqli_query($koneksi, "INSERT INTO tbl_soal(soal, a, b, c, d, knc_jawaban, tanggal) 
                            VALUES('$_POST[soal]', '$_POST[a]', '$_POST[b]', '$_POST[c]', '$_POST[d]', '$_POST[knc_jawaban]', '$tgl_sekarang')");
        }
        header('location:../../media.php?module='.$module);
    }

    // Hapus Soal
    elseif ($module=='soal' && $act=='hapus') {
        mysqli_query($koneksi, "DELETE FROM tbl_soal WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
    }

    // Update soal
    elseif ($module=='soal' && $act=='update'){
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $nama_file      = $_FILES['fupload']['name'];
        $acak           = rand(1,99);
        $nama_file_unik = $acak.$nama_file; 

        if (empty($lokasi_file)){
            // FIX: Ganti mysql_query menjadi mysqli_query (pakai 'i')
            mysqli_query($koneksi, "UPDATE tbl_soal SET soal = '$_POST[soal]', a = '$_POST[a]', b = '$_POST[b]', c = '$_POST[c]', d = '$_POST[d]', knc_jawaban = '$_POST[knc_jawaban]' WHERE id_soal = '$_POST[id]'");
        }
        else {
            UploadBanner($nama_file_unik);
            mysqli_query($koneksi, "UPDATE tbl_soal SET soal = '$_POST[soal]', a = '$_POST[a]', b = '$_POST[b]', c = '$_POST[c]', d = '$_POST[d]', knc_jawaban = '$_POST[knc_jawaban]', gambar = '$nama_file_unik' WHERE id_soal = '$_POST[id]'");
        }
        header('location:../../media.php?module='.$module);
    }

    // Aktifkan/Nonaktifkan
    elseif ($module=='soal' && ($act=='nonaktif' || $act=='aktif')){
        $aktif = ($act == 'aktif') ? 'Y' : 'N';
        mysqli_query($koneksi, "UPDATE tbl_soal SET aktif = '$aktif' WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
    }
}
?>

