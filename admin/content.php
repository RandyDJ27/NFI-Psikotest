<?php
// Gunakan path absolut agar Azure tidak bingung mencari posisi file
$base_path = __DIR__; 

include_once $base_path . "/../config/koneksi.php";
include_once $base_path . "/../config/library.php";
include_once $base_path . "/../config/fungsi_indotgl.php";

if (isset($_GET['module'])) {
    // FIX: Hapus ".php" jika user/sistem tidak sengaja mengirimkan ekstensi di URL
    $module = str_replace('.php', '', $_GET['module']);

    switch ($module) {
        case 'home':
            $file_home = $base_path . "/modul/mod_home/home.php";
            if (file_exists($file_home)) {
                include $file_home;
            } else {
                echo "<div style='color:red; padding:20px; background:#fff; border:1px solid red;'>
                        <h3>⚠️ Modul Home Tidak Ditemukan</h3>
                        File tidak ada di: <b>$file_home</b> <br>
                        Silakan cek apakah folder <b>modul/mod_home/</b> sudah terupload ke Azure.
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
            echo "<div style='padding:20px;'>Modul <b>$module</b> tidak terdaftar di sistem.</div>";
            break;
    }
} else {
    // Tampilan default jika tidak ada parameter module
    $file_default = $base_path . "/modul/mod_home/home.php";
    if (file_exists($file_default)) {
        include $file_default;
    } else {
        echo "<div style='padding:20px;'>Selamat Datang. (File home.php belum tersedia)</div>";
    }
}
?>
