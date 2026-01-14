<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";

if (isset($_GET['module'])) {
    $module = $_GET['module'];

    switch ($module) {
        case 'home':
            include "sidebar.php";
            include "modul/mod_home/home.php";
            break;

        case 'soal':
            include "sidebar.php";
            include "modul/mod_soal/soal.php";
            break;

        case 'hasiltes':
            include "sidebar.php";
            include "modul/mod_hasiltes/hasiltes.php";
            break;

        case 'pengaturantes':
            include "sidebar.php";
            include "modul/mod_pengaturantes/pengaturantes.php";
            break;

        case 'users':
            include "sidebar.php";
            include "modul/mod_users/users.php";
            break;

        case 'pengguna':
            include "sidebar.php";
            include "modul/mod_pengguna/pengguna.php";
            break;

        case 'tentang':
            include "sidebar.php";
            include "modul/mod_tentang/tentang.php";
            break;

        default:
            echo "<p>404 Halaman tidak ditemukan.</p>";
            break;
    }
} else {
    header("Location: media.php?module=home");
}
?>
