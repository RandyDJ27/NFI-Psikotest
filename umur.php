<?php
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
        // Membersihkan input agar tidak merusak query SQL
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = md5($_POST['password']);
        $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jk       = mysqli_real_escape_string($koneksi, $_POST['jk']);
        $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
        $telp     = mysqli_real_escape_string($koneksi, $_POST['telp']);
        $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);

        $simpan = "INSERT INTO tbl_user (username, password, nama, tgl_lahir, jk, email, telp, alamat) 
                   VALUES ('$username', '$password', '$nama', '$tgl_lahir', '$jk', '$email', '$telp', '$alamat')";
        
        if (mysqli_query($koneksi, $simpan)) {
            echo '<script>alert("Anda Berhasil Melakukan Registrasi"); window.location="index.php";</script>';
        } else {
            // Jika ini muncul, berarti ada yang salah dengan tabel/database kamu
            die("Gagal simpan ke database: " . mysqli_error($koneksi));
        }
    } else {
        echo '<script>alert("Registrasi Gagal! Umur Anda Belum 17 Tahun"); window.location="pendaftaran.php";</script>';
    }
} else {
    header("Location: pendaftaran.php");
}
?>
