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
              else {
                // PERBAIKAN: Tambahkan .php pada variabel aksi
                $aksi = "modul/mod_soal/aksi_soal.php";
                $act = isset($_GET['act']) ? $_GET['act'] : '';

                switch ($act) {
                  default:
                    echo "<div class='row mb-3'><div class='col-lg-6'>
                    <input class='btn btn-primary' type=button value='Tambah Soal' onclick=\"window.location.href='?module=soal&act=tambahsoal';\"></div>
                    <div class='col-lg-6'>
                      <form class='form-inline' method='POST' action='?module=soal&act=carisoal'>
                        <input class='form-control' type=text name='cari' placeholder='Masukkan Pertanyaan' required/>
                        <button class='btn btn-success ml-2' type='submit'><i class='fa fa-search'></i> Cari</button>
                      </form>
                    </div></div>";

                    echo "<table class='table table-hover'>
                    <thead><tr align='center'><th>No</th><th>Pertanyaan</th><th>Status</th><th>Aksi</th><th>Lihat</th><th>Status</th></tr></thead>";
                    
                    $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_soal ORDER BY id_soal DESC");
                    $no = 1;
                    while ($r = mysqli_fetch_array($tampil)){
                      $soal_pendek = substr(strip_tags($r['soal']), 0, 50);
                      echo "<tr>
                        <td>$no</td>
                        <td>$soal_pendek...</td>
                        <td align='center'>$r[aktif]</td>
                        <td>
                          <a class='btn btn-sm btn-outline-primary' href='?module=soal&act=editsoal&id=$r[id_soal]'><i class='fa fa-edit'></i> Edit</a> | 
                          <a class='btn btn-sm btn-outline-danger' href='$aksi?module=soal&act=hapus&id=$r[id_soal]' onclick=\"return confirm('Yakin hapus?')\"><i class='fa fa-trash'></i> Hapus</a>
                        </td>
                        <td><a class='btn btn-sm btn-outline-info' href='?module=soal&act=viewsoal&id=$r[id_soal]'><i class='fa fa-eye'></i> Lihat</a></td>";
                        
                      if ($r['aktif'] == "Y") {
                        echo "<td><input type=button class='btn btn-sm btn-outline-dark' value='Non Aktifkan' onclick=\"window.location.href='$aksi?module=soal&act=nonaktif&id=$r[id_soal]';\"></td>";
                      } else {
                        echo "<td><input type=button class='btn btn-sm btn-outline-success' value='Aktifkan' onclick=\"window.location.href='$aksi?module=soal&act=aktif&id=$r[id_soal]';\"></td>";
                      }
                      echo "</tr>";
                      $no++;
                    }
                    echo "</table>";
                    break;

                  case "tambahsoal":
                    echo "<h2>Tambah Soal</h2><hr/>
                    <form method=POST action='$aksi?module=soal&act=input' enctype='multipart/form-data'>
                      <div class='form-group'>
                        <label>Pertanyaan</label>
                        <textarea name='soal' class='form-control' style='height: 200px;' required></textarea>
                      </div>
                      <div class='form-group'>
                        <label>Gambar (Opsional)</label>
                        <input type=file name='fupload' class='form-control-file'>
                      </div>
                      <div class='row'>
                        <div class='col-md-6'><label>Jawaban A</label><input type=text name='a' class='form-control' required></div>
                        <div class='col-md-6'><label>Jawaban B</label><input type=text name='b' class='form-control' required></div>
                        <div class='col-md-6'><label>Jawaban C</label><input type=text name='c' class='form-control' required></div>
                        <div class='col-md-6'><label>Jawaban D</label><input type=text name='d' class='form-control' required></div>
                      </div>
                      <div class='form-group mt-3'>
                        <label>Kunci Jawaban</label>
                        <select name='knc_jawaban' class='form-control' style='width:100px;'>
                          <option value='a'>A</option><option value='b'>B</option><option value='c'>C</option><option value='d'>D</option>
                        </select>
                      </div>
                      <button class='btn btn-primary' type='submit'>Simpan</button>
                      <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
                    </form>";
                    break;

                  case "editsoal":
                    $edit = mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
                    $r = mysqli_fetch_array($edit);
                    echo "<h2>Edit Soal</h2><hr/>
                    <form method=POST action='$aksi?module=soal&act=update' enctype='multipart/form-data'>
                      <input type=hidden name=id value='$r[id_soal]'>
                      <div class='form-group'>
                        <label>Pertanyaan</label>
                        <textarea name='soal' class='form-control' style='height: 200px;'>$r[soal]</textarea>
                      </div>";
                    if ($r['gambar'] != '') {
                      echo "<div class='mb-2'><img src='../foto/$r[gambar]' width='200' class='img-thumbnail'></div>";
                    }
                    echo "<div class='form-group'>
                        <label>Ganti Gambar</label>
                        <input type=file name='fupload' class='form-control-file'>
                      </div>
                      <div class='row'>
                        <div class='col-md-6'><label>Jawaban A</label><input type=text name='a' value='$r[a]' class='form-control'></div>
                        <div class='col-md-6'><label>Jawaban B</label><input type=text name='b' value='$r[b]' class='form-control'></div>
                        <div class='col-md-6'><label>Jawaban C</label><input type=text name='c' value='$r[c]' class='form-control'></div>
                        <div class='col-md-6'><label>Jawaban D</label><input type=text name='d' value='$r[d]' class='form-control'></div>
                      </div>
                      <div class='form-group mt-3'>
                        <label>Kunci Jawaban</label>
                        <select name='knc_jawaban' id='knc_jawaban' class='form-control' style='width:100px;'>
                          <option value='a' ".($r['knc_jawaban']=='a'?'selected':'').">A</option>
                          <option value='b' ".($r['knc_jawaban']=='b'?'selected':'').">B</option>
                          <option value='c' ".($r['knc_jawaban']=='c'?'selected':'').">C</option>
                          <option value='d' ".($r['knc_jawaban']=='d'?'selected':'').">D</option>
                        </select>
                      </div>
                      <button class='btn btn-primary' type='submit'>Simpan Perubahan</button>
                      <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
                    </form>";
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
