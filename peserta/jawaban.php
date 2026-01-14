        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                      <!--   <h3 class="page-header"> Peraturan </h3> -->

                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                    
						<div class="container">
                        <div class="card-header bg-danger text-white mt-4">
                           Hasil Tes
                        </div>
                        <div class="card-body">
                          

<?php
 include "../config/koneksi.php";
 include "../config/library.php";

       if(isset($_POST['submit'])){
			$pilihan=$_POST["pilihan"];
			$id_soal=$_POST["id"];
			$jumlah=$_POST['jumlah'];
			
			$score=0;
			$benar=0;
			$salah=0;
			$kosong=0;
			
			for ($i=0;$i<$jumlah;$i++){
				//id nomor soal
				$nomor=$id_soal[$i];
				
				//jika user tidak memilih jawaban
				if (empty($pilihan[$nomor])){
					$kosong++;
				}else{
					//jawaban dari user
					$jawaban=$pilihan[$nomor];
					
					//cocokan jawaban user dengan jawaban di database
					$query=mysqli_query($koneksi, "select * from tbl_soal where id_soal='$nomor' and knc_jawaban='$jawaban'");
					
					$cek=mysqli_num_rows($query);
					
					if($cek){
						//jika jawaban cocok (benar)
						$benar++;
					}else{
						//jika salah
						$salah++;
					}
					
				} 
				/*RUMUS
				Jika anda ingin mendapatkan Nilai 100, berapapun jumlah soal yang ditampilkan 
				hasil= 100 / jumlah soal * jawaban yang benar
				*/
				
				$result=mysqli_query($koneksi, "select * from tbl_soal WHERE aktif='Y'");
				$jumlah_soal=mysqli_num_rows($result);
				$score = 100/$jumlah_soal*$benar;
				$hasil = number_format($score,1);
			}
		}
		//Lakukan Pengecekan  Data  dalam Database
	   $cek=mysqli_num_rows(mysqli_query($koneksi, "SELECT id_user FROM tbl_nilai WHERE id_user='$_SESSION[iduser]'"));
		if ($cek < 1) {
		//Pemberian kondisi lulus/ tidak lulus
		 $qry2=mysqli_query($koneksi, "SELECT nilai_min FROM tbl_pengaturan_tes");
		 $q2=mysqli_fetch_array($qry2);
		 $ceknilai= $q2['nilai_min'];
		 if ($hasil >= $ceknilai) {
		//Lakukan Penyimpanan Kedalam Database
				$iduser= ucwords($_SESSION['iduser']);
				mysqli_query($koneksi, "UPDATE tbl_user SET stat_tes='Sudah' WHERE id_user=$iduser");
				mysqli_query($koneksi, "INSERT INTO tbl_nilai (id_user,benar,salah,kosong,score,tanggal,keterangan) Values ('$iduser','$benar','$salah','$kosong','$hasil','$tgl_sekarang','Lulus')");
		}else {
		//Lakukan Penyimpanan Kedalam Database
				$iduser= ucwords($_SESSION['iduser']);
				mysqli_query($koneksi, "UPDATE tbl_user SET stat_tes='Sudah' WHERE id_user=$iduser");
				mysqli_query($koneksi, "INSERT INTO tbl_nilai (id_user,benar,salah,kosong,score,tanggal,keterangan) Values ('$iduser','$benar','$salah','$kosong','$hasil','$tgl_sekarang','Tidak Lulus')");
		}
	}
		
		// Menampilkan Hasil tes Kompetensi (Versi Hide Hasil)
$username = ucwords($_SESSION['username']);

echo "<div class='text-center mt-5'>";
    // 1. Ucapan Selamat
    echo "<h2 class='mb-4' style='border:0;'>Selamat <b>$username</b> telah menyelesaikan tes</h2>";

    // 2. Instruksi (Kotak Abu-abu)
    echo "
    <div class='d-inline-block p-3 px-4 mb-4' style='border: 1px solid #ddd; color: #666; background-color: #f9f9f9;'>
        Klik tombol di bawah untuk melanjutkan ke tahap berikutnya:
    </div>";

    // 3. Tombol Selanjutnya (Besar & Lonjong)
    echo "
    <div class='mt-2'>
        <a class='btn btn-primary btn-lg shadow-lg' 
           href='http://200.200.0.208/tes-koran/public/index.php' 
           target='_blank' 
           style='border-radius: 50px; padding: 10px 40px; font-weight: bold; font-size: 1.5rem;'>
           Selanjutnya <i class='fas fa-arrow-right ml-2'></i>
        </a>
    </div>";
echo "</div>";
		?>
                        
						</div>
                    </div>
                    </div>    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>		