<?php
// 1. Inisialisasi Session & Error Reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Cek Login (Pastikan user sudah login sebelum akses file ini)
if (empty($_SESSION['username']) && empty($_SESSION['passuser'])) {
    // Menggunakan absolute path ke root agar tidak tersesat saat redirect
    header("Location: /index.php"); 
    exit;
}

// 3. Import Konfigurasi (Pastikan path ../../../ sudah benar sesuai folder kamu)
require_once "../../../config/koneksi.php";
require_once "../../../config/library.php";
require_once "../../../config/fungsi_thumb.php";

// 4. Inisialisasi Variabel Pendukung
// Jika library.php tidak menyediakan $tgl_sekarang, baris ini akan mengisinya
$tgl_sekarang = date("Y-m-d");
$module       = $_GET['module'] ?? '';
$act          = $_GET['act'] ?? '';

// ================= INPUT SOAL =================
if ($module === 'soal' && $act === 'input') {

    $lokasi_file    = $_FILES['fupload']['tmp_name'] ?? '';
    $nama_file      = $_FILES['fupload']['name'] ?? '';
    $acak           = rand(1,99);
    $nama_file_unik = $acak . $nama_file;
    $gambar         = '';

    // Proses Upload Gambar jika ada
    if (!empty($lokasi_file)) {
        UploadBanner($nama_file_unik);
        $gambar = $nama_file_unik;
    }

    $sql = "INSERT INTO tbl_soal (soal, a, b, c, d, knc_jawaban, tanggal, gambar) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssss", 
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
    }

    // Redirect kembali ke daftar soal
    header("Location: /admin/media.php?module=soal");
    exit;
}

// ================= UPDATE SOAL =================
elseif ($module === 'soal' && $act === 'update') {

    $id             = $_POST['id']; // ID Soal yang akan diupdate
    $lokasi_file    = $_FILES['fupload']['tmp_name'] ?? '';
    $nama_file      = $_FILES['fupload']['name'] ?? '';
    $acak           = rand(1,99);
    $nama_file_unik = $acak . $nama_file;

    if (empty($lokasi_file)) {
        // Update tanpa ganti gambar
        $sql = "UPDATE tbl_soal SET soal=?, a=?, b=?, c=?, d=?, knc_jawaban=? WHERE id_soal=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", 
            $_POST['soal'], $_POST['a'], $_POST['b'], $_POST['c'], $_POST['d'], $_POST['knc_jawaban'], $id
        );
    } else {
        // Update dengan ganti gambar
        UploadBanner($nama_file_unik);
        $sql = "UPDATE tbl_soal SET soal=?, a=?, b=?, c=?, d=?, knc_jawaban=?, gambar=? WHERE id_soal=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", 
            $_POST['soal'], $_POST['a'], $_POST['b'], $_POST['c'], $_POST['d'], $_POST['knc_jawaban'], $nama_file_unik, $id
        );
    }

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("Location: /admin/media.php?module=soal");
    exit;
}

// ================= HAPUS SOAL =================
elseif ($module === 'soal' && $act === 'hapus') {
    $id_hapus = mysqli_real_escape_string($koneksi, $_GET['id']);
    mysqli_query($koneksi, "DELETE FROM tbl_soal WHERE id_soal='$id_hapus'");
    
    header("Location: /admin/media.php?module=soal");
    exit;
}

// ================= STATUS AKTIF/NONAKTIF =================
elseif ($module === 'soal' && ($act === 'aktif' || $act === 'nonaktif')) {
    $status = ($act === 'aktif') ? 'Y' : 'N';
    $id_stts = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    mysqli_query($koneksi, "UPDATE tbl_soal SET aktif='$status' WHERE id_soal='$id_stts'");
    
    header("Location: /admin/media.php?module=soal");
    exit;
}
?>
