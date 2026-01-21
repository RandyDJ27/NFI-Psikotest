<?php
// 1. Definisikan variabel konfigurasi
$host = "nfi-psikotest-server.mysql.database.azure.com";
$user = "ukyhzfyqwy";
$pass = "Nfi.600251@#!!!"; // Ganti dengan password yang benar
$db   = "psikotestonline";

// 2. Inisialisasi objek mysqli (Sangat Penting agar tidak NULL)
$koneksi = mysqli_init();

// 3. Atur SSL (Azure Flexible Server mewajibkan ini secara default)
mysqli_ssl_set($koneksi, NULL, NULL, NULL, NULL, NULL);

// 4. Melakukan koneksi menggunakan mysqli_real_connect
// Parameter: objek_koneksi, host, user, password, database, port, flag
if (!mysqli_real_connect($koneksi, $host, $user, $pass, $db, 3306, MYSQLI_CLIENT_SSL)) {
    die("Gagal menyambung ke MySQL: " . mysqli_connect_error());
}

// 5. set charset utf8mb4
mysqli_set_charset($koneksi, "utf8mb4");
mysqli_query($koneksi, "SET NAMES utf8mb4");
mysqli_query($koneksi, "SET CHARACTER SET utf8mb4");

?>
