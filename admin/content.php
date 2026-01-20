<?php
// Gunakan path absolut agar Azure tidak bingung mencari posisi file
$base_path = __DIR__; 

include_once $base_path . "/../config/koneksi.php";
include_once $base_path . "/../config/library.php";
include_once $base_path . "/../config/fungsi_indotgl.php";

if (isset($_GET['module'])) {
    $module = $_GET['module'];

    switch ($module) {
        case 'home':
            // Kita cek satu per satu filenya
            $file_home = $base_path . "/modul/mod_home/home.php";
            if (file_exists($file_home)) {
                include $file_home;
            } else {
                echo "<div style='color:red; padding:20px; background:#fff;'>
                        <h3>Error Log:</h3>
                        File tidak ditemukan di: <b>$file_home</b> <br>
                        Pastikan folder 'modul' dan 'mod_home' ada di dalam folder 'admin'.
                      </div>";
            }
            break;

        case 'soal':
            include $base_path . "/modul/mod_soal/soal.php";
            break;

        case 'hasiltes':
            include $base_path . "/modul/mod_hasiltes/hasiltes.php";
            break;

        case 'pengaturantes':
            include $base_path . "/modul/mod_pengaturantes/pengaturantes.php";
            break;

        case 'users':
            include $base_path . "/modul/mod_users/users.php";
            break;

        case 'pengguna':
            include $base_path . "/modul/mod_pengguna/pengguna.php";
            break;

        case 'tentang':
            include $base_path . "/modul/mod_tentang/tentang.php";
            break;

        default:
            echo "Modul <b>$module</b> tidak terdaftar di sistem.";
            break;
    }
} else {
    // Jika tidak ada module, jangan redirect pakai header (rawan 404 di Azure)
    // Cukup panggil home secara manual
    $file_default = $base_path . "/modul/mod_home/home.php";
    if (file_exists($file_default)) {
        include $file_default;
    } else {
        echo "Selamat Datang. (File home.php tidak ditemukan)";
    }
}
?>
