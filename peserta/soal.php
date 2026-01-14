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
				</div> -->
			</a>
			<a href="http://localhost/psikotes/peserta/logout.php"
				class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
				<div class="d-flex w-100 justify-content-start align-items-center">
					<span class="fa fa-sign-out-alt fa-fw mr-3"></span>
					<span class="menu-collapsed">Keluar</span>
				</div>
			</a>
		</ul>
	</div>

	<!-- MAIN -->
	<div class="col">
		<div id="page-wrapper">
			<div class="container-fluid mt-3">
				<div class="row">
					<div class="col-lg-12"></div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="card-header bg-danger text-white">
							Soal
						</div>
						<div class="card-body">

							<?php
							session_start();
							include "../config/koneksi.php";

							if (empty($_SESSION['username']) && empty($_SESSION['passuser'])) {
								echo "<link href='style.css' rel='stylesheet' type='text/css'>
								<center>Untuk mengakses modul, Anda harus login <br>";
								echo "<a href=index.php><b>LOGIN</b></a></center>";
							} else {
								$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_user FROM tbl_nilai WHERE id_user='$_SESSION[iduser]'"));
								if ($cek > 0) {
									$tampil = mysqli_query($koneksi, "SELECT * FROM tbl_nilai WHERE id_user='$_SESSION[iduser]'");
									$t = mysqli_fetch_array($tampil);
									$username = ucwords($_SESSION['username']);

									echo "<h3 align='center' style='border:0;'><b>$username</b> telah menyelesaikan Tes Psikotes Online</h3>";
									echo "<br><div align='center'>
									<table><tr><th colspan=3>Hasil Tes Psikotes Online Anda</th></tr>
									<tr><td>Jumlah Jawaban Benar</td><td> : $t[benar]</td>";
									$qry = mysqli_query($koneksi, "SELECT nilai_min FROM tbl_pengaturan_tes");
									$hasil = mysqli_fetch_array($qry);
									$cek = $hasil['nilai_min'];
									if ($t['score'] >= $cek) {
										echo "<td rowspan='4'><h1 class='ml-5 text-success'>LULUS</h1></td></tr>";
									} else {
										echo "<td rowspan='4'><h1 class='ml-5 text-danger'>TIDAK LULUS</h1></td></tr>";
									}
									echo "
									<tr><td>Jumlah Jawaban Salah</td><td> : $t[salah]</td></tr>
									<tr><td>Jumlah Jawaban Kosong</td><td>: $t[kosong]</td></tr>
									<tr><td><b>Nilai anda</b></td><td>: $t[score]</td></tr></table></div>";
									// --- TOMBOL LANJUT KE TES BERIKUTNYA ---
    								// Ganti '?hal=tes_berikutnya' dengan link tujuan tes kamu selanjutnya
    								echo "
    								<div class='text-center mt-5 mb-3'>
        							<p class='text-muted'>Klik tombol di bawah untuk melanjutkan ke tahap berikutnya:</p>
        							<a href='http://localhost/tes-koran/public/index.php' target='_blank' class='btn btn-primary btn-lg px-5 shadow-lg font-weight-bold' style='border-radius: 30px;'>
            						Selanjutnya <i class='fas fa-arrow-right ml-2'></i>
        							</a>
    								</div>";
								} else {
									echo '<table><tr><th><i class="fas fa-clock"></i> Waktu Tersisa</th></tr>
									<tr><td align=center><span style="font-size:18px"><span id="menit"></span>:<span id="detik"></span></span> </td></tr></table>';
									echo "<div style='width:100%; border: 1px solid #EBEBEB; overflow:scroll;height:700px;'>";
									echo '<table class="table" border="0">';

									$hasil = mysqli_query($koneksi, "select * from tbl_soal WHERE aktif='Y' ORDER BY RAND()");
									$jumlah = mysqli_num_rows($hasil);
									$urut = 0;
							?>

									<form name="form1" id="form1" method="post" action="?hal=jawaban">
										<?php
										while ($row = mysqli_fetch_array($hasil)) {
											$id = $row["id_soal"];
											$pertanyaan = $row["soal"];
											$pilihan_a = $row["a"];
											$pilihan_b = $row["b"];
											$pilihan_c = $row["c"];
											$pilihan_d = $row["d"];
										?>
											<input type="hidden" name="id[]" value="<?php echo $id; ?>">
											<input type="hidden" name="jumlah" value="<?php echo $jumlah; ?>">
											<tr>
												<td width="17">
													<font color="#000000"><?php echo $urut = $urut + 1; ?></font>
												</td>
												<td width="430">
													<font color="#000000"><?php echo "$pertanyaan"; ?></font>
												</td>
											</tr>
											<?php
											if (!empty($row["gambar"])) {
												echo "<tr><td></td><td><img src='../foto/$row[gambar]' width='300' height='300' class='img-thumbnail'></td></tr>";
											}
											?>
											<tr>
												<td></td>
												<td>A. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="A"> <?php echo "$pilihan_a"; ?></td>
											</tr>
											<tr>
												<td></td>
												<td>B. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="B"> <?php echo "$pilihan_b"; ?></td>
											</tr>
											<tr>
												<td></td>
												<td>C. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="C"> <?php echo "$pilihan_c"; ?></td>
											</tr>
											<tr>
												<td></td>
												<td>D. <input name="pilihan[<?php echo $id; ?>]" type="radio" value="D"> <?php echo "$pilihan_d"; ?></td>
											</tr>
										<?php } ?>
										<tr>
											<td>&nbsp;</td>
											<td><input class="btn btn-success" type="submit" name="submit" value="Jawab" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')"></td>
										</tr>
									</form>
									</table>
									</p>
						</div>

						<?php
									$data = mysqli_query($koneksi, "SELECT waktu FROM tbl_pengaturan_tes");
									$waktu = mysqli_fetch_array($data);
						?>
						<script>
							/*
  GANTI dengan output integer dari PHP — pastikan $waktu['waktu'] ada dan berupa angka.
  Kita pakai (int) di sisi PHP untuk memaksa integer.
*/
							let menit = <?php echo isset($waktu['waktu']) ? (int)$waktu['waktu'] : 0; ?>;
							let detik = 0;
							let interval = null;

							// Jika sessionStorage sudah pernah menyimpan, ambil dan validasi
							try {
								const sMenit = sessionStorage.getItem("menit");
								const sDetik = sessionStorage.getItem("detik");
								if (sMenit !== null && sDetik !== null) {
									const parsedMenit = parseInt(sMenit, 10);
									const parsedDetik = parseInt(sDetik, 10);
									if (!isNaN(parsedMenit) && parsedMenit >= 0) menit = parsedMenit;
									if (!isNaN(parsedDetik) && parsedDetik >= 0) detik = parsedDetik;
								} else {
									// inisialisasi storage agar tidak kosong
									sessionStorage.setItem("menit", String(menit));
									sessionStorage.setItem("detik", String(detik));
								}
							} catch (err) {
								// jika sessionStorage diblokir, tetap lanjut dengan nilai default
								console.warn("sessionStorage not available:", err);
							}

							// Pastikan elemen menit/detik ada
							function elsExist() {
								return document.getElementById("menit") && document.getElementById("detik");
							}

							function updateTimerDisplay() {
								if (!elsExist()) return;
								const m = String(Math.max(0, menit)).padStart(2, "0");
								const d = String(Math.max(0, detik)).padStart(2, "0");
								document.getElementById("menit").textContent = m;
								document.getElementById("detik").textContent = d;
							}

							function stopTimer() {
								if (interval) {
									clearInterval(interval);
									interval = null;
								}
							}

							function submitFormSafely() {
								stopTimer();
								try {
									sessionStorage.removeItem("menit");
									sessionStorage.removeItem("detik");
								} catch (e) {}
								const form = document.forms['form1'];
								if (form) {
									// hilangkan konfirmasi klik submit (jika ada) dengan submit() langsung
									form.submit();
								} else {
									console.warn("Form 'form1' tidak ditemukan untuk submit otomatis.");
								}
							}

							function countdown() {
								updateTimerDisplay();
								interval = setInterval(() => {
									// jika menit atau detik bukan angka, hentikan dan bersihkan
									if (isNaN(menit) || isNaN(detik)) {
										stopTimer();
										console.error("Timer error: menit/detik bukan angka", menit, detik);
										return;
									}

									if (menit === 0 && detik === 0) {
										stopTimer();
										try {
											sessionStorage.clear();
										} catch (e) {}
										alert('Waktu habis! Jawaban akan dikirim otomatis.');
										submitFormSafely();
										return;
									}

									if (detik === 0) {
										if (menit > 0) {
											menit--;
											detik = 59;
										} else {
											detik = 0;
										}
									} else {
										detik--;
									}

									// simpan ke sessionStorage (untuk tahan refresh)
									try {
										sessionStorage.setItem("menit", String(menit));
										sessionStorage.setItem("detik", String(detik));
									} catch (e) {
										// ignore jika storage tidak tersedia
									}

									updateTimerDisplay();
								}, 1000);
							}

							// Jalankan setelah DOM siap agar elemen #menit/#detik ada
							if (document.readyState === "loading") {
								document.addEventListener("DOMContentLoaded", () => {
									updateTimerDisplay();
									countdown();
								});
							} else {
								updateTimerDisplay();
								countdown();
							}
						</script>

						</script>

				<?php }
							} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- ======== FITUR TAMBAHAN ======== -->

<!-- Watermark nama peserta -->
<?php if (!empty($_SESSION['username'])): ?>
	<style>
		#watermark {
			position: fixed;
			top: 30%;
			left: 0;
			width: 100%;
			height: 10%;
			pointer-events: none;
			opacity: 0.50;
			font-size: 8rem;
			color: gray;
			text-align: center;
			transform: rotate(0deg);
			z-index: 9999;
			user-select: none;
		}
	</style>
	<div id="watermark"><?= htmlspecialchars($_SESSION['username']) ?></div>
<?php endif; ?>

<!-- Auto submit ketika pindah tab -->
<!-- Auto submit ketika pindah tab -->
<script>
window.addEventListener("load", function() {
  document.addEventListener("visibilitychange", function() {
    if (document.hidden) {
      alert("Anda berpindah tab! Jawaban akan otomatis dikirim.");

      const form = document.forms["form1"] || document.getElementById("form1");

      if (form) {
        console.log("Form ditemukan, melakukan submit otomatis...");
        setTimeout(() => {
          // gunakan prototype agar tidak bentrok dengan input name="submit"
          HTMLFormElement.prototype.submit.call(form);
        }, 500);
      } else {
        console.warn("Form dengan name='form1' atau id='form1' tidak ditemukan.");
      }
    }
  });
});
</script>


<!-- Proteksi Screenshot -->
<script>
	document.addEventListener('keydown', function(e) {
		if (e.key === 'PrintScreen') {
			alert('Fitur screenshot dinonaktifkan untuk menjaga kerahasiaan tes.');
			navigator.clipboard.writeText('');
		}
	});
	document.addEventListener('keyup', function(e) {
		if (e.key === 'PrintScreen' || (e.ctrlKey && e.key === 'p')) {
			alert('Screenshot / Print tidak diizinkan selama ujian!');
			e.preventDefault();
		}
	});
	document.addEventListener('contextmenu', function(e) {
		e.preventDefault();
	});
	document.addEventListener('selectstart', function(e) {
		e.preventDefault();
	});
</script>