<?php include 'config/koneksi.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="asset/css/all.css">
  <link rel="stylesheet" href="asset/css/bet.css">
  <style>
     body {
            background-image: url("asset/img/pt.png");
            image-resolution: cover;
            background-position: center;
            background-repeat: no-repeat;
        } 

    /* body {
      background: #e03b2f;
      background: linear-gradient(to right, rgb(235, 23, 16), rgb(236, 105, 105)); 
    } */
  </style>
  <title>Masuk Peserta</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center"><img src="asset/img/logo-baru.png" alt="" style="height: 40px;"> APLIKASI
              PSIKOTES ONLINE</h5>
            <form class="form-signin" name="form" action="cek_login.php" id="loginF" method="post">
              <div class="form-label-group">
                <input type="text" id="username" name="username" class="form-control" placeholder="Nama Pengguna"
                  required autofocus>
                <label for="username">Nama Pengguna</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                  required>
                <label for="password">Kata Sandi</label>
              </div>
              <button class="btn btn-lg btn-danger btn-block text-uppercase" type="submit">MASUK</button>
              <hr class="my-4">
              <a class="btn btn-lg btn-success btn-block text-uppercase" href="pendaftaran">Daftar</a>
              <hr class="my-4">
              <p class="text-center">&copy; 2026</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <script src="asset/js/sweetalert2.all.min.js"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="asset/js/bootstrap.min.js"></script>
  <script src="asset/js/jquery-3.3.1.slim.min.js"></script>
  <script src="asset/js/popper.min.js"></script>
</body>


</html>
