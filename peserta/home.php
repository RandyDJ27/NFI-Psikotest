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
            <a href="http://localhost/psikotes/peserta/logout.php" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Keluar</span>
                </div>
            </a>    
        </ul>
    </div> <!-- End Sidebar -->
    <!-- MAIN -->
    <div class="col">
<!-- Page Content -->
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
                           Peraturan
                        </div>
                        <div class="card-body">
                          
<?php
$result=mysqli_query($koneksi, "select * from tbl_soal WHERE aktif='Y'");
$hitung=mysqli_num_rows($result);
		 $qry=mysqli_query($koneksi, "SELECT * FROM tbl_pengaturan_tes");
		 $r=mysqli_fetch_array($qry);
 		 
		echo "
		<h3 align='center'>$r[nama_tes]</h3><hr/><br/>
		<i class='fas fa-clock mr-2'></i>Waktu Pengerjaan : $r[waktu] menit<br/>
		<i class='fas fa-file-alt mr-2'></i>Jumlah Soal : $hitung<br/>
		<p/>
		<h2>PERATURAN</h2><br/>
		$r[peraturan]<br/>
		";
?>
<script>
 function cekForm() {
	if (!document.fValidate.agree.checked) {
				alert("Anda belum menyetujui!");
				return false;
			} else {
				location.href="?hal=soal";
			}
		}
</script>
<form name="fValidate">
<input type="checkbox" name="agree" id="agree" value="1"> Saya Mengerti dan Siap Untuk Mengikuti Tes<br/><br/>
          <div style='text-align:center;'><input type="button" name="button-ok" class="btn btn-primary" value="MULAI TES" onclick="cekForm()"></div>
</form>

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
               


