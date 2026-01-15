<?php
session_start();
include '../config/koneksi.php'; // pastikan path ini benar

// Pastikan form dikirim lewat POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil input dengan validasi sederhana
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? md5(trim($_POST['password'])) : '';

    // Cek apakah koneksi tersedia
    if (!$koneksi) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }

    // Gunakan prepared statement agar lebih aman
    $stmt = mysqli_prepare($koneksi, "SELECT id_admin, username FROM tbl_admin WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Cek hasil query
    if ($result && mysqli_num_rows($result) > 0) {
        $r = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $r['username'];
        $_SESSION['idadmin']  = $r['id_admin'];

        header('Location: media?module=home.php');
        exit();
    } else {
        echo '<script language="javascript">
            alert("Username atau Password salah, atau akun telah diblokir.");
            window.location="index.php";
        </script>';
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    echo '<script language="javascript">
        alert("Akses langsung tidak diperbolehkan!");
        window.location="index.php";
    </script>';
    exit();
}
?>


