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
        <div class="card">
          <div class="card-header bg-danger text-white">Kelola Soal</div>
          <div class="card-body">

<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<center>Anda harus login <br><a href=../../index.php><b>LOGIN</b></a></center>";
} else {
    // Pastikan path ke aksi_soal.php benar dan pakai .php
    $aksi = "modul/mod_soal/aksi_soal.php";
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    switch ($act) {
        default:
            echo "<div class='row mb-3'>
                    <div class='col-md-6'>
                        <a href='?module=soal&act=tambahsoal' class='btn btn-primary'>Tambah Soal</a>
                    </div>
                    <div class='col-md-6'>
                        <form class='form-inline float-right' method='POST' action='?module=soal&act=carisoal'>
                            <input class='form-control mr-2' type='text' name='cari' placeholder='Cari soal...' required>
                            <button class='btn btn-success' type='submit'>Cari</button>
                        </form>
                    </div>
                  </div>";

            echo "<table class='table table-bordered table-hover'>
                    <thead class='thead-light'>
                        <tr align='center'>
                            <th>No</th><th>Pertanyaan</th><th>Status</th><th>Aksi</th>
                        </tr>
                    </thead>";
            
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_soal ORDER BY id_soal DESC");
            $no = 1;
            while ($r = mysqli_fetch_array($tampil)){
                $soal_tampil = substr(strip_tags($r['soal']), 0, 80);
                echo "<tr>
                        <td align='center'>$no</td>
                        <td>$soal_tampil...</td>
                        <td align='center'>$r[aktif]</td>
                        <td align='center'>
                            <a href='?module=soal&act=editsoal&id=$r[id_soal]' class='btn btn-sm btn-info'>Edit</a>
                            <a href='$aksi?module=soal&act=hapus&id=$r[id_soal]' class='btn btn-sm btn-danger' onclick=\"return confirm('Hapus soal ini?')\">Hapus</a>
                        </td>
                      </tr>";
                $no++;
            }
            echo "</table>";
        break;

        case "tambahsoal":
            echo "<h4>Tambah Soal</h4><hr>
            <form method='POST' action='$aksi?module=soal&act=input' enctype='multipart/form-data'>
                <div class='form-group'>
                    <label>Pertanyaan</label>
                    <textarea name='soal' class='form-control' rows='5' required></textarea>
                </div>
                <div class='form-group'>
                    <label>Gambar (Opsional)</label>
                    <input type='file' name='fupload' class='form-control'>
                </div>
                <div class='row'>
                    <div class='col-md-6 mb-2'><label>Pilihan A</label><input type='text' name='a' class='form-control' required></div>
                    <div class='col-md-6 mb-2'><label>Pilihan B</label><input type='text' name='b' class='form-control' required></div>
                    <div class='col-md-6 mb-2'><label>Pilihan C</label><input type='text' name='c' class='form-control' required></div>
                    <div class='col-md-6 mb-2'><label>Pilihan D</label><input type='text' name='d' class='form-control' required></div>
                </div>
                <div class='form-group mt-3'>
                    <label>Kunci Jawaban</label>
                    <select name='knc_jawaban' class='form-control' style='width:100px'>
                        <option value='a'>A</option><option value='b'>B</option><option value='c'>C</option><option value='d'>D</option>
                    </select>
                </div>
                <hr>
                <button type='submit' class='btn btn-primary'>Simpan Soal</button>
                <a href='?module=soal' class='btn btn-secondary'>Batal</a>
            </form>";
        break;

        case "editsoal":
            $edit = mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
            $r = mysqli_fetch_array($edit);
            echo "<h4>Edit Soal</h4><hr>
            <form method='POST' action='$aksi?module=soal&act=update' enctype='multipart/form-data'>
                <input type='hidden' name='id' value='$r[id_soal]'>
                <div class='form-group'>
                    <label>Pertanyaan</label>
                    <textarea name='soal' class='form-control' rows='5'>$r[soal]</textarea>
                </div>";
            if ($r['gambar'] != '') {
                echo "<div class='mb-2'><img src='../foto/$r[gambar]' width='150'></div>";
            }
            echo "<div class='form-group'>
                    <label>Ganti Gambar</label>
                    <input type='file' name='fupload' class='form-control'>
                </div>
                <div class='row'>
                    <div class='col-md-6 mb-2'><label>Pilihan A</label><input type='text' name='a' class='form-control' value='$r[a]'></div>
                    <div class='col-md-6 mb-2'><label>Pilihan B</label><input type='text' name='b' class='form-control' value='$r[b]'></div>
                    <div class='col-md-6 mb-2'><label>Pilihan C</label><input type='text' name='c' class='form-control' value='$r[c]'></div>
                    <div class='col-md-6 mb-2'><label>Pilihan D</label><input type='text' name='d' class='form-control' value='$r[d]'></div>
                </div>
                <div class='form-group mt-3'>
                    <label>Kunci Jawaban</label>
                    <select name='knc_jawaban' class='form-control' style='width:100px'>
                        <option value='a' ".($r['knc_jawaban']=='a'?'selected':'').">A</option>
                        <option value='b' ".($r['knc_jawaban']=='b'?'selected':'').">B</option>
                        <option value='c' ".($r['knc_jawaban']=='c'?'selected':'').">C</option>
                        <option value='d' ".($r['knc_jawaban']=='d'?'selected':'').">D</option>
                    </select>
                </div>
                <hr>
                <button type='submit' class='btn btn-primary'>Update Soal</button>
                <a href='?module=soal' class='btn btn-secondary'>Batal</a>
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
