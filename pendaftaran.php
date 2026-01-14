<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- BLOGBUGABAGI -->
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
  </style>
  <title>Psikotes Online</title>
</head>

<body>
  <?php
include "config/koneksi.php";
// if(isset($_POST['submit'])){
//     $simpan="INSERT INTO tbl_user SET username='$_POST[username]',
//                                       password='".md5($_POST[password])."',
//                                       nama='$_POST[nama]',
//                                       tgl_lahir='$_POST[tgl_lahir]',
//                                       jk='$_POST[jk]',
//                                       email= '$_POST[email]',
//                                       telp='$_POST[telp]',
//                                       alamat='$_POST[alamat]'";
//     mysqli_query($koneksi, $simpan);
//     echo '<script language="javascript">
//     alert("Anda Berhasil Melakukan Registrasi");
//     window.location="index";
//     </script>';
//     exit();
// }
?>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center"><img src="asset/img/logo-baru.png" alt="" style="height: 50px;"> PENDAFTARAN</h5>
            <hr />
            <form name="form" action="umur.php" id="loginF" method="post">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="username">Nama Pengguna</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Nama Pengguna"
                    Required>
                </div>
                <div class="form-group col-md-6">
                  <label for="password">Kata Sandi</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi"
                    Required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nama">Nama Lengkap</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" Required>
                </div>
                <div class="form-group col-md-6">
                  <label for="tgl_lahir">Tanggal Lahir (YYYY-MM-DD)</label>
                  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="1997-12-03"
                    Required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-2">
                  <label for="jk">Jenis Kelamin</label>
                  <select id="jk" name="jk" class="form-control">
                    <option selected>Pria</option>
                    <option>Perempuan</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="contoh@psikotes.com"
                    Required>
                </div>
                <div class="form-group col-md-4">
                  <label for="telp">No Telepon</label>
                  <input type="text" class="form-control" id="telp" name="telp" placeholder="08xxxxxxxxx">
                </div>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" Required>
              </div>
              <div class="form-group">
                <label class="form-check-label" for="gridCheck">
                  Akun berhak dinonaktifkan oleh admin psikotes online, dan nilai tes tidak dapat diganggu gugat.
                </label>
              </div>
              <button type="submit" class="btn btn-success" name="submit">Daftar</button>
              <a class="btn btn-danger" href="index">Masuk</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="asset/js/bootstrap.bundle.min.js"></script>
  <script src="asset/js/jquery.min.js"></script>
</body>

</html>