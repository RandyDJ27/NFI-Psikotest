<?php
ob_start();
session_start();
error_reporting(0);

// koneksi database
include('../config/koneksi.php');

// Cek sesi login
$sesi_username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username == NULL || empty($sesi_username)) {
    session_destroy();
    header('Location:../login.php?status=Silahkan Login');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Psikotes Online</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../asset/fontawesome-free-5.7.2-web/css/all.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <!-- Sidebar CSS -->
  <link rel="stylesheet" href="http://localhost/psikotes/admin/assets/css/sidebar.css">

  <!-- NicEdit -->
  <script src="nicEdit.js"></script>
  <script type="text/javascript">
    bkLib.onDomLoaded(function () {
      nicEditors.allTextAreas()
    });
  </script>
</head>

<body>
  <div id="wrapper">
    <!-- Navigasi + Konten -->
    <?php include 'content.php'; ?>
  </div>

  <!-- Script -->
  <script src="http://localhost/psikotes/asset/dist/sweetalert2.all.min.js"></script>
  <script src="../asset/js/jquery-3.3.1.slim.min.js"></script>
  <script src="../asset/js/popper.min.js"></script>
  <script src="../asset/js/bootstrap.min.js"></script>
</body>
</html>
