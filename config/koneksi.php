<?php
$server   = "nfi-psikotest-server.mysql.database.azure.com";
$username = "ukyhzfyqwy";
$password = "Nfi.600251@#!!!";
$database = "psikotesonline";

// Buat koneksi
$koneksi = mysqli_connect($server, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
