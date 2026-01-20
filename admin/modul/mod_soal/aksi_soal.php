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
        mysqli_query($koneksi, "INSERT INTO tbl_soal
            (soal,a,b,c,d,knc_jawaban,tanggal,gambar)
            VALUES (
                '$_POST[soal]',
                '$_POST[a]',
                '$_POST[b]',
                '$_POST[c]',
                '$_POST[d]',
                '$_POST[knc_jawaban]',
                '$tgl_sekarang',
                '$nama_file_unik'
            )");
    } else {
        mysqli_query($koneksi, "INSERT INTO tbl_soal
(soal,a,b,c,d,knc_jawaban,gambar)
VALUES (
  '$_POST[soal]',
  '$_POST[a]',
  '$_POST[b]',
  '$_POST[c]',
  '$_POST[d]',
  '$_POST[knc_jawaban]',
  ''
)");

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
        mysqli_query($koneksi, "UPDATE tbl_soal SET
            soal='$_POST[soal]',
            a='$_POST[a]',
            b='$_POST[b]',
            c='$_POST[c]',
            d='$_POST[d]',
            knc_jawaban='$_POST[knc_jawaban]'
            WHERE id_soal='$_POST[id]'");
    } else {
        UploadBanner($nama_file_unik);
        mysqli_query($koneksi, "UPDATE tbl_soal SET
            soal='$_POST[soal]',
            a='$_POST[a]',
            b='$_POST[b]',
            c='$_POST[c]',
            d='$_POST[d]',
            knc_jawaban='$_POST[knc_jawaban]',
            gambar='$nama_file_unik'
            WHERE id_soal='$_POST[id]'");
    }

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


