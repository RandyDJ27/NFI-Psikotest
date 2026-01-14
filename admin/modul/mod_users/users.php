<div class="row" id="body-row">
  <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
    <ul class="list-group">
      <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
        <small>MENU</small>
      </li>
      <a href="?module=home" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fas fa-home fa-fw mr-3"></span>
          <span class="menu-collapsed">Beranda</span>
        </div>
      </a>
      <a href="?module=soal" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-tasks fa-fw mr-3"></span>
          <span class="menu-collapsed">Kelola Soal Tes</span>
        </div>
      </a>
      <a href="?module=hasiltes" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-file-alt fa-fw mr-3"></span>
          <span class="menu-collapsed">Hasil Tes</span>
        </div>
      </a>
      <a href="?module=pengaturantes"
        class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-tools fa-fw mr-3"></span>
          <span class="menu-collapsed">Pengaturan Tes</span>
        </div>
      </a>
      <a href="?module=users" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-users fa-fw mr-3"></span>
          <span class="menu-collapsed">Daftar Peserta</span>
        </div>
      </a>
      <a href="?module=pengguna" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-user-alt fa-fw mr-3"></span>
          <span class="menu-collapsed">Pengguna</span>
        </div>
      </a>
      <a href="?module=tentang" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-laptop fa-fw mr-3"></span>
          <span class="menu-collapsed">Tentang</span>
        </div>
      </a>
      <a href="http://localhost/psikotes/admin/logout.php"
        class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
          <span class="menu-collapsed">Keluar</span>
        </div>
      </a>
    </ul>
  </div> <!-- End Sidebar -->

  <!-- MAIN -->
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
              Daftar Peserta
            </div>
            <div class="card-body">



              <?php
$aksi="modul/mod_users/aksi_users.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
//switch($_GET['act']){
  // Tampil User
  default:
// cetak
echo "<div class='row'>
<div class='col-lg-6'>
    <a class='btn btn-warning' href='cetak/cetakpeserta' role='button' target='_blank' rel='noopener noreferrer'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
</div>";
//   Cari
  echo "<div col-lg-6>
<form class='form-inline'method='POST' action=?module=users&act=cariusers>
<div class='form-group mx-sm-3 mb-2'>
<input class='form-control' type=text name='cari'  placeholder='Masukkan Nama' list='auto'  required/>
<button class='btn btn-success ml-3' type='submit'><i class='fa fa-search mr-1'></i>Cari</button></div></div>";
echo"<datalist id='auto'>";
$qry=mysqli_query($koneksi, "SELECT * FROM tbl_user");
while ($t=mysqli_fetch_array($qry)) {
echo "<option value='$t[nama]'>";
}
echo"</datalist></form>
</div>";
      $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_user");
      echo "
      <div class='row'>
      <div class='col-12 col sm-3'></div>
    <table class='table table-hover mt-3'>
          <tr align='center'><th>No</th><th>Username</th><th>Nama</th><th>Jenis Kelamin</th><th>Status Tes</th><th>Status</th><th>Lihat</th><th>Hapus</th><th>Aksi</th></tr>"; 
    $no=1;
    while ($r=mysqli_fetch_array($tampil)){
       echo "<tr><td align='center'>$no</td>
             <td>$r[username]</td>
            <td>$r[nama]</td>
        <td>$r[jk]</td>";
        if ($r['stat_tes']=="Sudah") {
          echo "<td>Selesai Mengerjakan</td>";
        }else{
          echo "<td>Belum Mengerjakan</td>";
        }

        echo  "<td align=center>$r[statusaktif]</td>
        <td align='center'><a class='btn btn-outline-info' href='?module=users&act=lihat&id=$r[id_user]' role='button'><i class='fa fa-eye mr-1'></i>Lihat</a></td>
             <td align='center'><a class='btn btn-outline-danger' href=$aksi?module=users&act=hapus&id=$r[id_user] role='button'><i class='fa fa-trash mr-1'></i>Hapus</a></td>";
        if ($r['statusaktif']=="Y") {
          echo"<td align='center'><input type=button class='btn btn-outline-dark' value='Non Aktifkan' onclick=\"window.location.href='$aksi?module=users&act=nonaktif&id=$r[id_user]';\"></td>";

        }else {
          echo"<td align='center'><input class='btn btn-outline-success' type=button value='Aktifkan' onclick=\"window.location.href='$aksi?module=users&act=aktif&id=$r[id_user]';\"></td>";
        }
        echo"</tr>";
      $no++;
    }
    echo "</table></div>";
    break;

  case "lihat":
       $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id_user='$_GET[id]'");
    $t=mysqli_fetch_array($tampil);
    echo "
  <table width='60%'>
    <tr><th colspan=2 align='center'>DETAIL PESERTA</th></tr>
    <tr><td>Username</td><td>$t[username]</td></tr>
    <tr><td>Nama</td><td>$t[nama]</td></tr>
    <tr><td>Tgl Lahir </td><td>$t[tgl_lahir]</td></tr>
    <tr><td>Jenis Kelamin </td><td>$t[jk]</td> </tr>
    <tr><td>Email </td><td>$t[email]</td></tr>
    <tr> <td>Telp</td><td>$t[telp]</td></tr>
    <tr><td>Alamat</td><td>$t[alamat]</td></tr>
  </table>
  <a class='btn btn-success mt-5' href='?module=users' role='button'><i class='fa fa-sign-out-alt mr-1'></i>Kembali</a>";
  break;

  case "cariusers":
       echo"<h2><i class='fa fa-search mr-3'></i>Hasil Pencarian</h2><hr/>
       <a class='btn btn-success mt-1 mb-1' href='?module=users' role='button'><i class='fa fa-sign-out-alt mr-1'></i>Kembali</a>
     <table class='table table-hover mt-3'>
          <thead><tr align='center'><th>No</th><th>Nama</th><th>Email</th><th>Aksi</th><th>Status</th><th>Lihat</th></tr></thead>"; 
    $tampil=mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE nama LIKE '%$_POST[cari]%'");
    $no=1;
    while ($r=mysqli_fetch_array($tampil)){
       echo "<tr><td align='center'>$no</td>
             <td>$r[nama]</td>
       <td align='center'>$r[email]</td>
             <td align='center'>
        <a class='btn btn-outline-danger' href=$aksi?module=users&act=hapus&id=$r[id_user] role='button'><i class='fa fa-trash mr-1'></i></a></td>";
        if ($r['statusaktif']=="Y") {
          echo"<td align='center'><input class='btn btn-outline-dark' type=button value='Non Aktifkan' onclick=\"window.location.href='$aksi?module=users&act=nonaktif&id=$r[id_user]';\"></td>";

        }else {
          echo"<td align='center'><input class='btn btn-success' type=button value='Aktifkan' onclick=\"window.location.href='$aksi?module=users&act=aktif&id=$r[id_user]';\"></td>";
        }
        
        echo"   </td>
    <td align='center'><a class='btn btn-outline-info' href=?module=users&act=lihat&id=$r[id_user] role='button'><i class='fa fa-eye mr-1'></i></a></td>

    </tr>";
      $no++;
    }
    echo "</table>";
    break;
}
?>

            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->



</div>
</div>