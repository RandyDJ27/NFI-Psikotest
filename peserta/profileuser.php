<div class="row" id="body-row">
  <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
    <ul class="list-group">
      <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
        <small>MENU</small>
      </li>
      <a href="?hal=home" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fas fa-home fa-fw mr-3"></span>
          <span class="menu-collapsed">Beranda</span>
        </div>
      </a>
      <a href="?hal=profiluser" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-user fa-fw mr-3"></span>
          <span class="menu-collapsed">Profil Peserta</span>
        </div>
      </a>
      <!-- <a href="?hal=soal" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-file fa-fw mr-3"></span>
          <span class="menu-collapsed">Soal</span>
        </div>
      </a> -->
      <a href="http://localhost/psikotes/peserta/logout.php"
        class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
          <span class="menu-collapsed">Keluar</span>
        </div>
      </a>
    </ul>
  </div> <!-- End Sidebar -->

  <!-- MAIN -->
  <?php
	include('../config/koneksi.php');
	$qry=mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id_user='$_SESSION[iduser]'");
	$t=mysqli_fetch_array($qry);

  if(isset($_POST['submit'])){
    $update="UPDATE tbl_user set username='".$_POST['username']."',password='".md5($_POST['password'])."',nama='".$_POST['nama']."',tgl_lahir='".$_POST['tgl_lahir']."',jk='".$_POST['jk']."',email='".$_POST['email']."',telp='".$_POST['telp']."',alamat='".$_POST['alamat']."' where id_user='".$_SESSION['iduser']."' ";
    mysqli_query($koneksi, $update);
  
    echo '<script language="javascript">
    alert("Anda Berhasil Merubah data");
    window.location="media.php?hal=profiluser";
    </script>';
    exit();
}
?>
  <div class="col">
    <div id="page-wrapper">
      <div class="container-fluid mt-3">
        <div class="row">
          <div class="col-lg-12">
            <!--   <h3 class="page-header"> Peraturan </h3> -->

          </div>

        </div>

        <div class="row">
          <div class="col-lg-12">

            <div class="card-header bg-danger text-white">
              Profil Peserta
            </div>
            <div class="card-body">
              <h5 align="center">Profil <?= $t['nama'] ?></h5>
              <hr />


              <form name="form1" method="post" action="">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" class="form-control" id="username" name="username"
                      value="<?php echo $t['username'] ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="password">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $t['nama'] ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="tgl_lahir">Tanggal Lahir (DD-MM-YYYY)</label>
                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"
                      value="<?php echo $t['tgl_lahir'] ?>">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <label for="jk">Jenis Kelamin</label>
                    <select id="jk" name="jk" class="form-control">
                      <option>Pria</option>
                      <option>Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $t['email'] ?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="telp">No Telepon</label>
                    <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $t['telp'] ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $t['alamat'] ?>">
                </div>
                <div class="form-row mt-4">
                  <div class="form-group col-md-4">
                    <button class="btn btn-success" type="submit" name="submit"><i
                        class="fa fa-save mr-2"></i>Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
</div>
</div>



<script type="text/javascript">
  var $ = jQuery;
  $('#jk').val('<?php echo $t['
    jk '];?>');
  $('#agama').val('<?php echo $t['
    agama '];?>');
  $('#kwgn').val('<?php echo $t['
    kwgn '];?>');
</script>