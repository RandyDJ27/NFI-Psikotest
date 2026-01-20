<?php
// Gunakan include_once agar tidak terjadi error jika file sudah dipanggil di media.php
include_once "../config/koneksi.php";
include_once "../config/library.php";
include_once "../config/fungsi_indotgl.php";

if (isset($_GET['module'])) {
    $module = $_GET['module'];

    switch ($module) {
        case 'home':
            // Cek apakah file home.php benar-benar ada di folder tersebut
            $file = "modul/mod_home/home.php";
            if (file_exists($file)) {
                include $file;
            } else {
                echo "<p>Error: File <b>$file</b> tidak ditemukan di server Azure.</p>";
            }
            break;

        case 'soal':
            include "modul/mod_soal/soal.php";
            break;

        case 'hasiltes':
            include "modul/mod_hasiltes/hasiltes.php";
            break;

        case 'pengaturantes':
            include "modul/mod_pengaturantes/pengaturantes.php";
            break;

        case 'users':
            include "modul/mod_users/users.php";
            break;

        case 'pengguna':
            include "modul/mod_pengguna/pengguna.php";
            break;

        case 'tentang':
            include "modul/mod_tentang/tentang.php";
            break;

        default:
            echo "<p>404 Halaman modul <b>$module</b> tidak ditemukan.</p>";
            break;
    }
} else {
    // Arahkan ke media.php dengan parameter module
    echo "<script>window.location='media.php?module=home';</script>";
}
?>
