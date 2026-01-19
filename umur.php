<?php
// 1. Tampilkan semua error agar tidak muncul 404 palsu
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Sertakan koneksi
include "config/koneksi.php";

// 3. Fungsi hitung umur yang lebih stabil
function hitung_umur($tgl) {
    $lahir = new DateTime($tgl);
    $hari_ini = new DateTime();
    $diff = $hari_ini->diff($lahir);
    return $diff->y;
}

// 4. Proses data hanya jika ada kiriman POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tgl_lahir'])) {
    
    $tgl_lahir = $_POST['tgl_lahir'];
    $umur = hitung_umur($tgl_lahir);

    // Cek kriteria umur (17 tahun ke atas)
    if ($umur >= 17) {
        
        // Bersihkan input agar query tidak rusak/error
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = md5($_POST['password']);
        $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jk       = mysqli_real_escape_string($koneksi, $_POST['jk']);
        $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
        $telp     = mysqli_real_escape_string($koneksi, $_POST['telp']);
        $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);

        // Query INSERT yang lebih standar
        $simpan = "INSERT INTO tbl_user (username, password, nama, tgl_lahir, jk, email, telp, alamat) 
                   VALUES ('$username', '$password', '$nama', '$tgl_lahir', '$jk', '$email', '$telp', '$alamat')";
        
        if (mysqli_query($koneksi, $simpan)) {
            echo '<script>alert("Anda Berhasil Melakukan Registrasi"); window.location="index.php";</script>';
        } else {
            // Jika database error, pesan ini akan muncul (bukan 404 lagi)
            echo "<h3>Gagal Simpan ke Database!</h3>";
            echo "Pesan Error: " . mysqli_error($koneksi);
            echo "<br><br><a href='pendaftaran.php'>Kembali ke Pendaftaran</a>";
        }

    } else {
        // Jika umur di bawah 17
        echo '<script>alert("Registrasi Gagal! Umur Anda Belum 17 Tahun"); window.location="pendaftaran.php";</script>';
    }

} else {
    // Jika file dibuka langsung tanpa isi form, balikkan ke pendaftaran
    header("Location: pendaftaran.php");
    exit();
}
?>
