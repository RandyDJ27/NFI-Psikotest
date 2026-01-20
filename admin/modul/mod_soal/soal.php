<div class="row" id="body-row">
  <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
    <ul class="list-group">
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

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<center>Untuk mengakses modul, Anda harus login <br><a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
    // PERBAIKAN 2: Tambahkan .php di sini. Azure/Linux wajib pakai ekstensi file lengkap.
    $aksi = "modul/mod_soal/aksi_soal.php"; 
    
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    switch ($act) {
        default:
            echo "<div class='row'><div class='col-lg-6'>
            <input class='btn btn-primary' type=button value='Tambah Soal' 
            onclick=\"window.location.href='?module=soal&act=tambahsoal';\"></div>";

            // PERBAIKAN 3: Action Form harus pakai .php atau dikosongkan jika ke halaman sendiri
            echo "<div col-lg-6>
                    <form class='form-inline' method='POST' action='?module=soal&act=carisoal'>
                    <div class='form-group mx-sm-3 mb-2'>
                    <input class='form-control' type=text name='cari' placeholder='Masukkan Pertanyaan' required/>
                    <button class='btn btn-success ml-3' type='submit'><i class='fa fa-search mr-1'></i>Cari</button></div></div>";
            echo "</form></div>";

            echo "<table class='table table-hover'>
                  <thead><tr align='center'><th>No</th><th>Pertanyaan</th><th>Status</th><th>Aksi</th><th>Lihat</th><th>Status</th></tr></thead>"; 
            
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_soal ORDER BY id_soal DESC");
            $no = 1;
            while ($r = mysqli_fetch_array($tampil)){
                $soal = substr(strip_tags($r['soal']), 0, 50);
                echo "<tr><td>$no</td>
                      <td>$soal..</td>
                      <td align='center'>$r[aktif]</td>
                      <td>
                        <a class='btn btn-outline-primary' href='?module=soal&act=editsoal&id=$r[id_soal]'><i class='fa fa-edit'></i> Edit</a> | 
                        <a class='btn btn-outline-danger' href='$aksi?module=soal&act=hapus&id=$r[id_soal]'><i class='fa fa-trash'></i> Hapus</a></td>
                      <td><a class='btn btn-outline-info' href='?module=soal&act=viewsoal&id=$r[id_soal]'><i class='fa fa-eye'></i> Lihat</a></td>";
                
                if ($r['aktif'] == "Y") {
                    echo "<td><input type=button class='btn btn-outline-dark' value='Non Aktifkan' onclick=\"window.location.href='$aksi?module=soal&act=nonaktif&id=$r[id_soal]';\"></td>";
                } else {
                    echo "<td align='center'><input class='btn btn-outline-success' type=button value='Aktifkan' onclick=\"window.location.href='$aksi?module=soal&act=aktif&id=$r[id_soal]';\"></td>";
                }
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        break;

        case "tambahsoal":
            // Form action menggunakan $aksi yang sudah diperbaiki (.php)
            echo "<h2>Tambah Soal</h2><hr/>
                  <form method='POST' action='$aksi?module=soal&act=input' enctype='multipart/form-data'>
                    <div class='form-group'>
                        <label>Soal</label>
                        <textarea name='soal' class='form-control' style='height: 200px;'></textarea>
                    </div>
                    <div class='form-group'>
                        <label>Gambar</label>
                        <input type='file' name='fupload'>
                    </div>
                    <div class='form-group'>
                        <label>Jawaban A</label>
                        <input type='text' name='a' class='form-control' required>
                    </div>
                    <div class='form-group'>
                        <label>Jawaban B</label>
                        <input type='text' name='b' class='form-control' required>
                    </div>
                    <div class='form-group'>
                        <label>Jawaban C</label>
                        <input type='text' name='c' class='form-control' required>
                    </div>
                    <div class='form-group'>
                        <label>Jawaban D</label>
                        <input type='text' name='d' class='form-control' required>
                    </div>
                    <div class='form-group'>
                        <label>Kunci</label>
                        <select name='knc_jawaban' class='form-control' style='width: 100px;'>
                            <option value='a'>A</option><option value='b'>B</option><option value='c'>C</option><option value='d'>D</option>
                        </select>
                    </div>
                    <button type='submit' class='btn btn-primary'>Simpan</button>
                    <input type='button' value='Batal' onclick='self.history.back()' class='btn btn-danger'>
                  </form>";
        break;
        
        // ... (case editsoal dan lainnya tetap sama, pastikan action=$aksi) ...
    }
}
?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    <?php if(isset($r['knc_jawaban'])) { ?>
    document.getElementById('knc_jawaban').value = "<?php echo $r['knc_jawaban']; ?>";
    <?php } ?>
  </script>
</div>
