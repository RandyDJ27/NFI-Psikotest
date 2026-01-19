<?php
include "config/koneksi.php";

function hitung_umur($tgl) {
    $lahir = new DateTime($tgl);
    $hari_ini = new DateTime();
    $diff = $hari_ini->diff($lahir);
    return $diff->y;
}

// Cek apakah data dikirim lewat POST (biar gak Access Denied)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tgl_lahir'])) {
    
    $tgl_lahir = $_POST['tgl_lahir'];
    $umur = hitung_umur($tgl_lahir);

    // Gunakan >= 17 agar umur 17 pas bisa daftar
    if ($umur >= 17) {
        // Gunakan mysqli_real_escape_string untuk keamanan dari SQL Injection
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = md5($_POST['password']);
        $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
        // ... (teruskan untuk field lainnya)

        $simpan = "INSERT INTO tbl_user (username, password, nama, tgl_lahir, jk, email, telp, alamat) 
                   VALUES ('$username', '$password', '$nama', '$tgl_lahir', '$_POST[jk]', '$email', '$_POST[telp]', '$_POST[alamat]')";
        
        if(mysqli_query($koneksi, $simpan)) {
            echo '<script>alert("Anda Berhasil Melakukan Registrasi"); window.location="index.php";</script>';
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }

    } else {
        echo '<script>alert("Registrasi Gagal! Umur Anda Belum 17 Tahun"); window.location="pendaftaran.php";</script>';
    }
} else {
    // Jika diakses langsung tanpa form, tendang ke halaman pendaftaran
    header("Location: pendaftaran.php");
    exit();
}
?>
