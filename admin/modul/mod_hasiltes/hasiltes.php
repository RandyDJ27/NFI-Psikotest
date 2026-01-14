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
                        <div class="card-header bg-danger text-white">
                            Hasil Tes
                        </div>
                        <div class="card-body">
<?php
$aksi = "modul/mod_hasiltes/aksi_hasiltes.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Ambil nilai pencarian nama dan tanggal jika ada
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : '';
$tgl_cari = isset($_GET['tgl']) ? mysqli_real_escape_string($koneksi, $_GET['tgl']) : '';

switch ($act) {
    default:
        // Logika Gabungan Filter Pencarian Nama dan Tanggal
        $where_clause = "";
        if ($cari != "") {
            $where_clause .= " AND (tbl_user.nama LIKE '%$cari%' OR tbl_user.username LIKE '%$cari%')";
        }
        if ($tgl_cari != "") {
            $where_clause .= " AND tbl_nilai.tanggal = '$tgl_cari'";
        }

        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_nilai, tbl_user 
                                          WHERE tbl_nilai.id_user = tbl_user.id_user 
                                          $where_clause 
                                          ORDER BY tbl_nilai.id_nilai DESC");
?>
        <div class='row mb-3 align-items-center'>
            <div class='col-lg-5'>
                <a class='btn btn-warning' href='cetak/cetakhasiltes' role='button' target='_blank'><span class='fa fa-print fa-fw mr-2'></span>Cetak</a>
                <a class='btn btn-success' href='?module=hasiltes&act=lulus' role='button'><i class='fa fa-user-check fa-fw mr-2'></i>Lulus</a>
                <a class='btn btn-danger' href='?module=hasiltes&act=tidaklulus' role='button'><i class='fa fa-user-slash fa-fw mr-2'></i>Tidak Lulus</a>  
            </div>

            <div class='col-lg-7'>
                <form method='GET' action='' class='form-inline justify-content-end'>
                    <input type='hidden' name='module' value='hasiltes'>
                    
                    <input type="date" name="tgl" class="form-control form-control-sm mr-2" value="<?php echo $tgl_cari; ?>">
                    
                    <div class='input-group'>
                        <input type='text' name='cari' class='form-control form-control-sm' placeholder='Nama...' value='<?php echo $cari; ?>'>
                        <div class='input-group-append'>
                            <button class='btn btn-success btn-sm' type='submit'><i class='fa fa-search'></i> Filter</button>
                        </div>
                    </div>
                    
                    <?php if($cari != "" || $tgl_cari != ""): ?>
                        <a href='?module=hasiltes' class='btn btn-secondary btn-sm ml-2'>Reset</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <table class='table table-hover mt-3'>
            <thead>
                <tr align='center'>
                    <th>No</th>
                    <th>Nama pengguna</th>
                    <th>Nama</th>
                    <th>Benar</th>
                    <th>Salah</th>
                    <th>Kosong</th>
                    <th>Nilai</th>
                    <th>Tanggal Tes</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
<?php
        $no = 1;
        while ($r = mysqli_fetch_array($tampil)) {
            $tgl = tgl_indo($r['tanggal']);
            echo "<tr>
                    <td align='center'>$no</td>
                    <td>$r[username]</td>
                    <td>$r[nama]</td>
                    <td align='center'>$r[benar]</td>
                    <td align='center'>$r[salah]</td>
                    <td align='center'>$r[kosong]</td>
                    <td align='center'>$r[score]</td>
                    <td>$tgl</td>
                    <td align='center'>$r[keterangan]</td>
                    <td align='center'>
                        <input type='button' value='Hapus' class='btn btn-outline-danger btn-sm' onclick=\"if(confirm('Yakin hapus data ini?')) window.location.href='$aksi?module=hasiltes&act=hapus&id=$r[id_nilai]';\">
                    </td>
                  </tr>";
            $no++;
        }
        if(mysqli_num_rows($tampil) == 0){
            echo "<tr><td colspan='10' align='center' class='text-muted'>Data tidak ditemukan</td></tr>";
        }
?>
            </tbody>
        </table>
<?php
        break;

    case "lulus":
        $tampil = mysqli_query($koneksi, "SELECT nama,jk,email,benar,salah,kosong,score,keterangan,tanggal FROM tbl_user INNER JOIN tbl_nilai ON tbl_user.id_user=tbl_nilai.id_user WHERE keterangan='Lulus' ORDER BY id_nilai DESC");
?>
        <div class='row mb-3'>
            <div class='col-lg-6'>
                <a class='btn btn-warning' href='cetak/cetaklulus' role='button' target='_blank'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
                <a class='btn btn-success' href='?module=hasiltes' role='button'><i class='fa fa-reply fa-fw mr-3'></i>Kembali</a>     
            </div>
        </div>
        <table class='table table-hover mt-3'>
            <thead><tr align='center'><th>No</th><th>Nama</th><th>Email</th><th>Benar</th><th>Salah</th><th>Kosong</th><th>Nilai</th><th>Keterangan</th><th>Tanggal Tes</th></tr></thead>
            <tbody>
<?php
        $no = 1;
        while ($r = mysqli_fetch_array($tampil)) {
            $tgl = tgl_indo($r['tanggal']);
            echo "<tr><td>$no</td><td>$r[nama]</td><td>$r[email]</td><td align='center'>$r[benar]</td><td align='center'>$r[salah]</td><td align='center'>$r[kosong]</td><td align='center'>$r[score]</td><td align='center'>$r[keterangan]</td><td>$tgl</td></tr>";
            $no++;
        }
?>
            </tbody>
        </table>
<?php
        break;

    case "tidaklulus":
        $tampil = mysqli_query($koneksi, "SELECT nama,jk,email,benar,salah,kosong,score,keterangan,tanggal FROM tbl_user INNER JOIN tbl_nilai ON tbl_user.id_user=tbl_nilai.id_user WHERE keterangan='Tidak Lulus' ORDER BY id_nilai DESC");
?>
        <div class='row mb-3'>
            <div class='col-lg-6'>
                <a class='btn btn-warning' href='cetak/cetaktidaklulus' role='button' target='_blank'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
                <a class='btn btn-success' href='?module=hasiltes' role='button'><i class='fa fa-reply fa-fw mr-3'></i>Kembali</a>     
            </div>
        </div>
        <table class='table table-hover mt-3'>
            <thead><tr align='center'><th>No</th><th>Nama</th><th>Email</th><th>Benar</th><th>Salah</th><th>Kosong</th><th>Nilai</th><th>Keterangan</th><th>Tanggal Tes</th></tr></thead>
            <tbody>
<?php
        $no = 1;
        while ($r = mysqli_fetch_array($tampil)) {
            $tgl = tgl_indo($r['tanggal']);
            echo "<tr><td>$no</td><td>$r[nama]</td><td>$r[email]</td><td align='center'>$r[benar]</td><td align='center'>$r[salah]</td><td align='center'>$r[kosong]</td><td align='center'>$r[score]</td><td align='center'>$r[keterangan]</td><td>$tgl</td></tr>";
            $no++;
        }
?>
            </tbody>
        </table>
<?php
        break;
}
?>
                        </div>
                        <div class="card-footer">
                            <?php 
                            $dataavg = mysqli_query($koneksi, "SELECT AVG(score) as ratarata FROM tbl_nilai");
                            $avg = mysqli_fetch_array($dataavg);
                            $datamin = mysqli_query($koneksi, "SELECT MIN(score) as minimal FROM tbl_nilai");
                            $min = mysqli_fetch_array($datamin);
                            $datamaks = mysqli_query($koneksi, "SELECT MAX(score) as maks FROM tbl_nilai");
                            $maks = mysqli_fetch_array($datamaks);
                            $datapsrt = mysqli_query($koneksi, "SELECT COUNT(score) as peserta FROM tbl_nilai");
                            $count = mysqli_fetch_array($datapsrt);
                            ?>
                            <table class="table-sm">
                                <tr>
                                    <td width="150">Nilai Rata-Rata</td>
                                    <td width="50">:</td>
                                    <td><strong><?= round($avg['ratarata'], 2) ?></strong></td>
                                </tr>
                                <tr>
                                    <td>Nilai Tertinggi</td>
                                    <td>:</td>
                                    <td><strong><?= $maks['maks']; ?></strong></td>
                                </tr>
                                <tr>
                                    <td>Nilai Terendah</td>
                                    <td>:</td>
                                    <td><strong><?= $min['minimal'] ?></strong></td>
                                </tr>
                                <tr>
                                    <td>Total Peserta</td>
                                    <td>:</td>
                                    <td><strong><?= $count['peserta'] ?></strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>