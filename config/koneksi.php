<?php
$server   = "localhost";
$username = "root";
$password = "";
$database = "psikotesonline";

// Buat koneksi
$koneksi = mysqli_connect($server, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
