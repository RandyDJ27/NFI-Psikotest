<?php
include "config/koneksi.php";

// fungsi ngitungna
function hitung_umur($tgl) {
    list($year,$month,$day) = explode("-",$tgl);
    $year_diff = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff = date("d") - $day;
    if ($month_diff < 0) $year_diff--;
        elseif (( $month_diff==0 ) && ($day_diff < 0)) $year_diff--;
    return $year_diff;
}
$tgl_lahir = $_POST['tgl_lahir'];
$umur = hitung_umur($tgl_lahir);
// echo $umur;

// logika umur simpan mun umur
if ($umur > 17) {
    $simpan="INSERT INTO tbl_user SET username='$_POST[username]',
                                      password='".md5($_POST['password'])."',
                                      nama='$_POST[nama]',
                                      tgl_lahir='$_POST[tgl_lahir]',
                                      jk='$_POST[jk]',
                                      email= '$_POST[email]',
                                      telp='$_POST[telp]',
                                      alamat='$_POST[alamat]'";
    mysqli_query($koneksi, $simpan);
    echo '<script language="javascript">
    alert("Anda Berhasil Melakukan Registrasi");
    window.location="index";
    </script>';
} elseif ($umur < 17) {
    echo '<script language="javascript">
    alert("Registrasi Pendaftaran Gagal ! Umur Anda Belum 17 Tahun");
    window.location="pendaftaran";
    </script>';
}
// $tgl = $_POST['tgl_lahir'];
// var_dump($tgl);
?>