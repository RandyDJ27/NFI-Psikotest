<?php 
include(__DIR__ . '/../../../config/koneksi.php');
include(__DIR__ . '/../../../config/fungsi_thumb.php');


$module = $_GET['module'];;
$act=$_GET['act'] ?? '';

$sql_nilai_l  = mysqli_query($koneksi, "SELECT count(*) as jum FROM tbl_nilai WHERE keterangan='Lulus'");
$r_nilai_l    = mysqli_fetch_array($sql_nilai_l);
$lulus=$r_nilai_l['jum'];

$sql_nilai_tl  = mysqli_query($koneksi, "SELECT count(*) as jum FROM tbl_nilai WHERE keterangan='Tidak Lulus'");
$r_nilai_tl    = mysqli_fetch_array($sql_nilai_tl);
$tidak_lulus=$r_nilai_tl['jum'];

$sql_user  = mysqli_query($koneksi, "SELECT count(*) as jum FROM tbl_user WHERE statusaktif='Y'");
$r_user    = mysqli_fetch_array($sql_user);
$total_user=$r_user['jum'];

$sql_soal  = mysqli_query($koneksi, "SELECT count(*) as jum FROM tbl_soal WHERE aktif='Y'");
$r_soal    = mysqli_fetch_array($sql_soal);
$total_soal=$r_soal['jum'];

?>
<!-- Sidebar -->
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
            <a href="?module=hasiltes"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
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
            <a href="?module=users"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-users fa-fw mr-3"></span>
                    <span class="menu-collapsed">Daftar Peserta</span>
                </div>
            </a>
            <a href="?module=pengguna"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Pengguna</span>
                </div>
            </a>
            <a href="?module=tentang"
                class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
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
    </div> <!-- Akhir Sidebar -->

    <!-- Header Aplikasi Psikotes Online -->
    <div class="col">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <h3 class="display-4 text-center">Aplikasi Psikotes Online</h3>
                        <hr />
                    </div>
                </div>

                <!-- Waktu Tanggal Selamat Admin -->
                <div class="row">
                    <div class="container text-center mb-2">
                        <?php 
                $tanggal = mktime(date('m'), date("d"), date('Y'));
                echo "<h5 class='ml-4'>Tanggal : <b> " . date("d-m-Y", $tanggal ) . "</b>";
                date_default_timezone_set("Asia/Jakarta");
                $jam = date ("H:i:s");
                echo " | Pukul : <b> " . $jam . " " ." </b> ";
                $a = date ("H");
                if (($a>=6) && ($a<=11)) {
                    echo " <b>, Selamat Pagi $_SESSION[username]  <i class='fas fa-sun'></i></b>";
                }else if(($a>=11) && ($a<=15)){
                    echo " , Selamat  Siang $_SESSION[username] <i class='fas fa-sun'></i>";
                }elseif(($a>15) && ($a<=19)){
                    echo ", Selamat Sore $_SESSION[username] <i class='fas fa-cloud-moon'></i>";
                }else{
                    echo ", <b> Selamat Malam $_SESSION[username] <i class='fas fa-moon'></i></b></h5>";
                }
            ?>
                    </div>
                </div>
                <!-- Header Menu card -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header bg-danger text-white">
                            <span class="fas fa-home fa-fw mr-3"></span>Beranda
                        </div>
                    </div>
                </div>

                <!-- Isi Card -->
                <div class="card-body">
                    <div class="row mt-1">
                        <!-- Kotak Peserta Lulus -->
                        <div class="col-lg-3 col-md-6">
                            <a href="media?module=hasiltes&act=lulus">
                                <div class="card text-white">
                                    <div class="card-header green">
                                        <div class="row">
                                            <div class="col-3">
                                                <i class="fa fa-user-check fa-4x mt-2"></i>
                                            </div>
                                            <div class="col-9 text-right">
                                                <div class="font-weight-bold" style="font-size:38px">
                                                    <?php echo $lulus ?></div>
                                                <div class="font-weight-light pl-3">Peserta Lulus</div>
                                            </div>
                                        </div>
                                    </div>
                            </a>
                        </div>
                    </div>
                    <!-- Kotak Peserta Tidak Lulus -->
                    <div class="col-lg-3 col-md-6">
                        <a href="?module=hasiltes&act=tidaklulus">
                            <div class="card text-white">
                                <div class="card-header light-red">
                                    <div class="row">
                                        <div class="col-3">
                                            <i class="fa fa-user-slash fa-4x mt-2"></i>
                                        </div>
                                        <div class="col-9 text-right">
                                            <div class="font-weight-bold" style="font-size:38px">
                                                <?php echo $tidak_lulus ?></div>
                                            <div class="font-weight-light">Peserta Gagal</div>
                                        </div>
                                    </div>
                                </div>
                        </a>
                    </div>
                </div>
                <!-- Kotak Total Peserta -->
                <div class="col-lg-3 col-md-6">
                    <a href="?module=users">
                        <div class="card text-white ">
                            <div class="card-header bg-info">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-users fa-4x mt-2"></i>
                                    </div>
                                    <div class="col-9 text-right">
                                        <div class="font-weight-bold" style="font-size:38px"><?php echo $total_user ?>
                                        </div>
                                        <div class="font-weight-light">Total Peserta</div>
                                    </div>
                                </div>
                            </div>
                    </a>
                </div>
            </div>
            <!-- Kotak Total Soal Tes -->
            <div class="col-lg-3 col-md-6">
                <a href="?module=soal">
                    <div class="card text-white">
                        <div class="card-header color">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-file-alt fa-4x mt-2"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <div class="font-weight-bold" style="font-size:38px"><?php echo $total_soal ?></div>
                                    <div class="font-weight-light">Total Soal</div>
                                </div>
                            </div>
                        </div>
                </a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>