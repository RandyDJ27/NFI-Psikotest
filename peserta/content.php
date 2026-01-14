<?php
include('../config/koneksi.php');

if (isset($_GET['hal'])) {
    $hal = $_GET['hal'];
} else {
    $hal = 'home';
}

if ($hal == "soal") {
    include "sidebar.php";
    include "soal.php";
}
elseif ($hal == "home") {
    include "sidebar.php";
    include "home.php";
}
elseif ($hal == "register") {
    include "sidebar.php";
    include "register.php";
}
elseif ($hal == "formlogin") {
    include "sidebar.php";
    include "formlogin.php";
}
elseif ($hal == "jawaban") {
    include "sidebar.php";
    include "jawaban.php";
}
elseif ($hal == "profiluser") {
    include "sidebar.php";
    include "profileuser.php";
}
elseif ($hal == "profil") {
    include "sidebar.php";
    $sql  = mysqli_query($koneksi, "SELECT * FROM modul WHERE id_modul='2'");
    $r    = mysqli_fetch_array($sql);
    
    echo "<div style='text-align:center'><img src='foto/$r[gambar]' width='260' height='260' align='center'></div>";
    echo "$r[isi_modul]";
}
elseif ($hal == "panduan") {
    include "sidebar.php";
    $sql  = mysqli_query($koneksi, "SELECT * FROM modul WHERE id_modul='3'");
    $r    = mysqli_fetch_array($sql);
    
    echo "<div align='center'><img src='foto/$r[gambar]' width='160' height='160'></div>";
    echo "$r[isi_modul]";
}
else {
    include "sidebar.php";
    $sql  = mysqli_query($koneksi, "SELECT * FROM modul WHERE id_modul='1'");
    $r    = mysqli_fetch_array($sql);
    
    echo "<img src='foto/$r[gambar]' width='160' height='160' align='left'>";
    echo "$r[isi_modul]";
}
?>
