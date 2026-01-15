<?php
$con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "{path to CA cert}", NULL, NULL);
mysqli_real_connect($conn, "nfi-psikotest-server.mysql.database.azure.com", "ukyhzfyqwy", "{Nfi.600251@#!!!}", "{psikotesonline}", 3306, MYSQLI_CLIENT_SSL);

if (!mysqli_real_connect($conn, "nfi-psikotest-server.mysql.database.azure.com", "ukyhzfyqwy", "Nfi.600251@#!!!", "psikotesonline", 3306, MYSQLI_CLIENT_SSL)) {
    die("Koneksi gagal: " . mysqli_connect_error());
?>


