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
      <a href="?module=pengaturantes" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
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
      <a href="logout.php" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
          <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
          <span class="menu-collapsed">Keluar</span>
        </div>
      </a>
    </ul>
  </div>

  <div class="col">
    <div id="page-wrapper">
      <div class="container-fluid mt-3">
        <div class="row">
          <div class="col-lg-12">
            <div class="card-header bg-danger text-white">Kelola Soal</div>
            <div class="card-body">
              <script language="JavaScript">
                function bukajendela(url) {
                  window.open(url, "window_baru", "width=800,height=500,left=120,top=10,resizable=1,scrollbars=1");
                }
              </script>

<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<center>Anda harus login <br><a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
  // PERBAIKAN 2: Tambahkan .php pada variabel aksi agar tidak 404 Not Found
  $aksi="modul/mod_soal/aksi_soal.php";
  $act = isset($_GET['act']) ? $_GET['act'] : '';

  switch ($act) {
    default:
      echo "<div class='row'><div class='col-lg-6'>
      <input class='btn btn-primary' type=button value='Tambah Soal' 
      onclick=\"window.location.href='?module=soal&act=tambahsoal';\"></div>";

      echo "<div col-lg-6>
            <form class='form-inline' method='POST' action='?module=soal&act=carisoal'>
            <div class='form-group mx-sm-3 mb-2'>
            <input class='form-control' type=text name='cari' placeholder='Masukkan Pertanyaan' list='auto' required/>
            <button class='btn btn-success ml-3' type='submit'><i class='fa fa-search mr-1'></i>Cari</button></div>";
      echo "<datalist id='auto'>";
      $qry=mysqli_query($koneksi, "SELECT * FROM tbl_soal");
      while ($t=mysqli_fetch_array($qry)) { echo "<option value='$t[soal]'>"; }
      echo "</datalist></form></div></div>";

      echo "<table class='table table-hover'>
            <thead><tr align='center'><th>No</th><th>Pertanyaan</th><th>Status</th><th>Aksi</th><th>Lihat</th><th>Status</th></tr></thead>"; 
      
      $tampil=mysqli_query($koneksi, "SELECT * FROM tbl_soal ORDER BY id_soal DESC");
      $no=1;
      while ($r=mysqli_fetch_array($tampil)){
        $soal=substr(strip_tags($r['soal']),0,50);
        echo "<tr><td>$no</td>
              <td>$soal..</td>
              <td align='center'>$r[aktif]</td>
              <td>
                <a class='btn btn-outline-primary' href='?module=soal&act=editsoal&id=$r[id_soal]'><i class='fa fa-edit mr-1'></i>Edit</a> | 
                <a class='btn btn-outline-danger' href='$aksi?module=soal&act=hapus&id=$r[id_soal]'><i class='fa fa-trash mr-1'></i>Hapus</a></td>
              <td><a class='btn btn-outline-info' href='?module=soal&act=viewsoal&id=$r[id_soal]'><i class='fa fa-eye mr-1'></i>Lihat</a></td>";
        
        if ($r['aktif']=="Y") {
          echo"<td><input type=button class='btn btn-outline-dark' value='Non Aktifkan' onclick=\"window.location.href='$aksi?module=soal&act=nonaktif&id=$r[id_soal]';\"></td>";
        } else {
          echo"<td align='center'><input class='btn btn-outline-success' type=button value='Aktifkan' onclick=\"window.location.href='$aksi?module=soal&act=aktif&id=$r[id_soal]';\"></td>";
        }
        echo "</tr>";
        $no++;
      }
      echo "</table>";
    break;
  
    case "tambahsoal":
      echo "<h2 class='mb-3'><i class='fa fa-plus mr-2'></i>Tambah Soal</h2><hr/>
            <form method=POST action='$aksi?module=soal&act=input' enctype='multipart/form-data'>
              <div class='form-group'>
                <label class='col-sm-2'>Soal</label>
                <div class='col-sm-10'><textarea name='soal' style='width: 100%; height: 200px;'></textarea></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Gambar</label>
                <div class='col-sm-10'><input type=file name='fupload'></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Jawaban A</label>
                <div class='col-sm-12'><input type=text name='a' class='form-control' required/></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Jawaban B</label>
                <div class='col-sm-12'><input type=text name='b' class='form-control' required/></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Jawaban C</label>
                <div class='col-sm-12'><input type=text name='c' class='form-control' required/></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Jawaban D</label>
                <div class='col-sm-12'><input type=text name='d' class='form-control' required/></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Kunci</label>
                <div class='col-sm-4'>
                  <select name='knc_jawaban' class='form-control'>
                    <option value='a'>A</option><option value='b'>B</option><option value='c'>C</option><option value='d'>D</option>
                  </select>
                </div>
              </div>
              <div class='form-group'>
                <div class='col-sm-4'>
                  <button class='btn btn-primary' type='submit' name='submit'><i class='fa fa-save mr-1'></i>Simpan</button>
                  <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
                </div>
              </div>
            </form>";
    break;

    case "editsoal":
      $edit=mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
      $r=mysqli_fetch_array($edit);
      echo "<h2 class='mb-3'><i class='fa fa-edit mr-2'></i>Edit Soal</h2><hr/>
            <form method=POST action='$aksi?module=soal&act=update' enctype='multipart/form-data'>
            <input type=hidden name=id value='$r[id_soal]'>
              <div class='form-group'>
                <label class='col-sm-2'>Pertanyaan</label>
                <div class='col-lg-10'><textarea name='soal' style='width: 100%; height: 200px;'>$r[soal]</textarea></div>
              </div>";
      if ($r['gambar']!=''){
        echo "<div class='form-group'><div class='col-sm-10'><img src='../foto/$r[gambar]' class='img-thumbnail'></div></div>";
      }
      echo "<div class='form-group'>
                <label class='col-sm-2'>Ganti Gambar</label>
                <div class='col-sm-10'><input type=file name='fupload'></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Jawaban A</label>
                <div class='col-sm-4'><input type=text name='a' class='form-control' value='$r[a]' required/></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Jawaban B</label>
                <div class='col-sm-4'><input type=text name='b' class='form-control' value='$r[b]' required/></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Jawaban C</label>
                <div class='col-sm-4'><input type=text name='c' class='form-control' value='$r[c]' required/></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Jawaban D</label>
                <div class='col-sm-4'><input type=text name='d' class='form-control' value='$r[d]' required/></div>
              </div>
              <div class='form-group'>
                <label class='col-sm-2'>Kunci</label>
                <div class='col-sm-4'>
                  <select name='knc_jawaban' id='knc_jawaban' class='form-control'>
                    <option value='a' ".($r['knc_jawaban']=='a'?'selected':'').">A</option>
                    <option value='b' ".($r['knc_jawaban']=='b'?'selected':'').">B</option>
                    <option value='c' ".($r['knc_jawaban']=='c'?'selected':'').">C</option>
                    <option value='d' ".($r['knc_jawaban']=='d'?'selected':'').">D</option>
                  </select>
                </div>
              </div>
              <div class='form-group'>
                <div class='col-sm-4'>
                  <button class='btn btn-primary' type='submit'><i class='fa fa-save mr-1'></i>Simpan</button>
                  <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
                </div>
              </div>
            </form>";
    break;

    case "viewsoal":
      $view=mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
      $t=mysqli_fetch_array($view);
      echo "<h2>Detail Soal</h2><hr><div class='container'><a class='btn btn-success mb-4' href='?module=soal'>Kembali</a>
            <h5>Soal:</h5>$t[soal]<br>";
      if ($t['gambar']!=''){ echo "<img src='../foto/$t[gambar]' class='img-thumbnail mt-2 mb-2'>"; }
      echo "<h5>Jawaban :</h5>a. $t[a]<br>b. $t[b]<br>c. $t[c]<br>d. $t[d]<br><h5>Kunci: $t[knc_jawaban]</h5></div>";
    break;
  }
}
?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var $ = jQuery;
  <?php if(isset($r['knc_jawaban'])) { ?>
    $('#knc_jawaban').val('<?php echo $r['knc_jawaban']; ?>');
  <?php } ?>
</script>


