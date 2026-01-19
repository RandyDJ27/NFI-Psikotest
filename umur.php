<?php
// Tampilkan error biar kelihatan kalau ada masalah lain
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config/koneksi.php";

function hitung_umur($tgl) {
    $lahir = new DateTime($tgl);
    $hari_ini = new DateTime();
    $diff = $hari_ini->diff($lahir);
    return $diff->y;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tgl_lahir'])) {
    $tgl_lahir = $_POST['tgl_lahir'];
    $umur = hitung_umur($tgl_lahir);

    if ($umur >= 17) {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = md5($_POST['password']);
        $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jk       = mysqli_real_escape_string($koneksi, $_POST['jk']);
        $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
        $telp     = mysqli_real_escape_string($koneksi, $_POST['telp']);
        $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);

        // TAMBAHKAN kolom stat_tes di sini, kita kasih nilai default 'Belum'
        $simpan = "INSERT INTO tbl_user (username, password, nama, tgl_lahir, jk, email, telp, alamat, stat_tes) 
                   VALUES ('$username', '$password', '$nama', '$tgl_lahir', '$jk', '$email', '$telp', '$alamat', 'Belum')";
        
        if (mysqli_query($koneksi, $simpan)) {
            echo '<script>alert("Anda Berhasil Melakukan Registrasi"); window.location="index.php";</script>';
        } else {
            die("Gagal simpan: " . mysqli_error($koneksi));
        }
    } else {
        echo '<script>alert("Registrasi Gagal! Umur Anda Belum 17 Tahun"); window.location="pendaftaran.php";</script>';
    }
}
?>
