<?php include('../config/koneksi.php');
ob_start();
session_start();

// Tampilkan error agar mudah debug
error_reporting(E_ALL);
ini_set('display_errors', 1);


$sesi_username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username == NULL || empty($sesi_username)) {
    session_destroy();
    header('Location: login.php?status=Silahkan Login');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../asset/fontawesome-free-5.7.2-web/css/all.css">
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="../nicEdit.js"></script>
  <script>
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  </script>
  <title>Psikotes Online</title>
</head>

<body>
  <div id="wrapper">
    <!-- Navigasi -->
    <?php
    if (file_exists('content.php')) {
        include 'content.php';
    } else {
        echo "<p style='color:red;text-align:center;'>⚠️ File content.php tidak ditemukan!</p>";
    }
    ?>
  </div>

  <script src="http://localhost/psikotes/asset/dist/sweetalert2.all.min.js"></script>
  <script src="../asset/js/jquery-3.3.1.slim.min.js"></script>
  <script src="../asset/js/popper.min.js"></script>
  <script src="../asset/js/bootstrap.min.js"></script>
</body>
</html>
