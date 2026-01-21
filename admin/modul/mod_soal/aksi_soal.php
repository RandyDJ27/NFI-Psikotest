<?php
// HARUS PALING ATAS
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CEK LOGIN (JANGAN ECHO, LANGSUNG REDIRECT)
if (empty($_SESSION['username']) && empty($_SESSION['passuser'])) {
    header("Location: ../../index.php");
    exit;
}

// INCLUDE FILE
require_once "../../../config/koneksi.php";
require_once "../../../config/library.php";
require_once "../../../config/fungsi_thumb.php";

// AMAN
$module = $_GET['module'] ?? '';
$act    = $_GET['act'] ?? '';

// ================= INPUT SOAL =================
if ($module === 'soal' && $act === 'input') {

    $lokasi_file = $_FILES['fupload']['tmp_name'] ?? '';
    $nama_file   = $_FILES['fupload']['name'] ?? '';
    $acak        = rand(1,99);
    $nama_file_unik = $acak . $nama_file;

    if (!empty($lokasi_file)) {
        UploadBanner($nama_file_unik);
        $gambar = $nama_file_unik;
    } else {
        $gambar = '';
    }

    $sql = "INSERT INTO tbl_soal
        (soal,a,b,c,d,knc_jawaban,tanggal,gambar)
        VALUES (?,?,?,?,?,?,?,?)";

    $stmt = mysqli_prepare($koneksi, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssss",
        $_POST['soal'],
        $_POST['a'],
        $_POST['b'],
        $_POST['c'],
        $_POST['d'],
        $_POST['knc_jawaban'],
        $tgl_sekarang,
        $gambar
    );

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ../../media.php?module=soal");
    exit;
}


// ================= HAPUS SOAL =================
elseif ($module === 'soal' && $act === 'hapus') {

    mysqli_query($koneksi, "DELETE FROM tbl_soal WHERE id_soal='$_GET[id]'");
    header("Location: ../../media.php?module=soal");
    exit;
}

// ================= UPDATE SOAL =================
elseif ($module === 'soal' && $act === 'update') {

    $lokasi_file = $_FILES['fupload']['tmp_name'] ?? '';
    $nama_file   = $_FILES['fupload']['name'] ?? '';
    $acak        = rand(1,99);
    $nama_file_unik = $acak . $nama_file;

    if (empty($lokasi_file)) {

        $sql = "UPDATE tbl_soal SET
            soal=?, a=?, b=?, c=?, d=?, knc_jawaban=?
            WHERE id_soal=?";

        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssi",
            $_POST['soal'],
            $_POST['a'],
            $_POST['b'],
            $_POST['c'],
            $_POST['d'],
            $_POST['knc_jawaban'],
            $_POST['id']
        );

    } else {

        UploadBanner($nama_file_unik);

        $sql = "UPDATE tbl_soal SET
            soal=?, a=?, b=?, c=?, d=?, knc_jawaban=?, gambar=?
            WHERE id_soal=?";

        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sssssssi",
            $_POST['soal'],
            $_POST['a'],
            $_POST['b'],
            $_POST['c'],
            $_POST['d'],
            $_POST['knc_jawaban'],
            $nama_file_unik,
            $_POST['id']
        );
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ../../media.php?module=soal");
    exit;
}

// ================= NONAKTIF =================
elseif ($module === 'soal' && $act === 'nonaktif') {

    mysqli_query($koneksi, "UPDATE tbl_soal SET aktif='N' WHERE id_soal='$_GET[id]'");
    header("Location: ../../media.php?module=soal");
    exit;
}

// ================= AKTIF =================
elseif ($module === 'soal' && $act === 'aktif') {

    mysqli_query($koneksi, "UPDATE tbl_soal SET aktif='Y' WHERE id_soal='$_GET[id]'");
    header("Location: ../../media.php?module=soal");
    exit;
}




