<?php
session_start();
include "../../../config/koneksi.php";

$module = $_GET['module'] ?? '';
$act    = $_GET['act'] ?? '';

if ($module == 'pengaturantes' && $act == 'update') {

    $id         = $_POST['id'];
    $nama_tes   = $_POST['nama_tes'];
    $waktu      = $_POST['waktu'];
    $nilai_min  = $_POST['nilai_min'];
    $peraturan  = $_POST['peraturan'];

    $sql = "UPDATE tbl_pengaturan_tes 
            SET nama_tes='$nama_tes',
                waktu='$waktu',
                nilai_min='$nilai_min',
                peraturan='$peraturan'
            WHERE id='$id'";

    $update = mysqli_query($koneksi, $sql);

    if ($update) {
        echo "<script>
                alert('Pengaturan tes berhasil diperbarui!');
                window.location='../../media.php?module=$module';
              </script>";
    } else {
        echo 'Gagal update data: ' . mysqli_error($koneksi);
    }
}
?>
