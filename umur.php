<?php
$tgl_lahir = $_POST['tgl_lahir'];
// Fungsi hitung umur sederhana
$umur = date("Y") - date("Y", strtotime($tgl_lahir));

if ($umur >= 17) {
    echo "<h1>Umur kamu $umur. Kamu lolos tapi ini tes tanpa database.</h1>";
    echo "<a href='pendaftaran.php'>Kembali</a>";
} else {
    echo "<h1>Umur kamu $umur. Belum cukup umur.</h1>";
}
?>
