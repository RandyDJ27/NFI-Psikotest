<?php
// 1. Pastikan tag pembuka PHP ada di Baris 1 Kolom 1
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

<?php
session_start();
// Baris untuk ngecek isi session (Hapus kalau sudah normal)
// die(print_r($_SESSION)); 

if (empty($_SESSION['username'])){
    // ... sisa kodingan login ...
else{
    include "../../../config/koneksi.php";
    include "../../../config/library.php";
    include "../../../config/fungsi_thumb.php";

    $module = $_GET['module'];
    $act = $_GET['act'];

    // Input soal
    if ($module=='soal' AND $act=='input'){
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];
        $acak           = rand(1,99);
        $nama_file_unik = $acak.$nama_file;
        
        if (!empty($lokasi_file)){
            UploadBanner($nama_file_unik);
            mysqli_query($koneksi, "INSERT INTO tbl_soal(soal,a,b,c,d,knc_jawaban,tanggal,gambar) 
                            VALUES('$_POST[soal]', '$_POST[a]', '$_POST[b]', '$_POST[c]', '$_POST[d]', '$_POST[knc_jawaban]', '$tgl_sekarang', '$nama_file_unik')");
        }
        else{
            mysqli_query($koneksi, "INSERT INTO tbl_soal(soal,a,b,c,d,knc_jawaban) 
                            VALUES('$_POST[soal]', '$_POST[a]', '$_POST[b]', '$_POST[c]', '$_POST[d]', '$_POST[knc_jawaban]')");
        }
        header('location:../../media.php?module='.$module);
    }
    // Hapus Soal
    elseif ($module=='soal' AND $act=='hapus') {
        mysqli_query($koneksi, "DELETE FROM tbl_soal WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
    }
    // Update soal
    elseif ($module=='soal' AND $act=='update'){
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $nama_file      = $_FILES['fupload']['name'];
        $acak           = rand(1,99);
        $nama_file_unik = $acak.$nama_file; 

        if (empty($lokasi_file)){
            // Catatan: Saya ubah mysql_query menjadi mysqli_query agar sesuai dengan koneksi kamu
            mysqli_query($koneksi, "UPDATE tbl_soal SET soal = '$_POST[soal]', a = '$_POST[a]', b = '$_POST[b]', c = '$_POST[c]', d = '$_POST[d]', knc_jawaban = '$_POST[knc_jawaban]' WHERE id_soal = '$_POST[id]'");
        }
        else{
            UploadBanner($nama_file_unik);
            mysqli_query($koneksi, "UPDATE tbl_soal SET soal = '$_POST[soal]', a = '$_POST[a]', b = '$_POST[b]', c = '$_POST[c]', d = '$_POST[d]', knc_jawaban = '$_POST[knc_jawaban]', gambar = '$nama_file_unik' WHERE id_soal = '$_POST[id]'");
        }
        header('location:../../media.php?module='.$module);
    }
    // Pengaktifan dan Pengnonaktifan
    elseif ($module=='soal' AND $act=='nonaktif'){
        $aktif='N';
        mysqli_query($koneksi, "UPDATE tbl_soal SET aktif = '$aktif' WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
    }
    elseif ($module=='soal' AND $act=='aktif'){
        $aktif='Y';
        mysqli_query($koneksi, "UPDATE tbl_soal SET aktif = '$aktif' WHERE id_soal='$_GET[id]'");
        header('location:../../media.php?module='.$module);
    }
}
// Jangan tambahkan tag penutup ?> di akhir file jika isinya murni PHP untuk menghindari spasi tak sengaja.
