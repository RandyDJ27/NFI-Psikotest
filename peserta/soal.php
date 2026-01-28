<?php
session_start();
include "../config/koneksi.php";
?>

<div class="row" id="body-row">
	<div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
		<ul class="list-group">
			<li class="list-group-item sidebar-separator-title text-muted">
				<small>MENU</small>
			</li>
			<a href="?hal=home" class="bg-dark list-group-item list-group-item-action">
				<span class="fas fa-home mr-3"></span> Beranda
			</a>
			<a href="?hal=profiluser" class="bg-dark list-group-item list-group-item-action">
				<span class="fa fa-user mr-3"></span> Profil Peserta
			</a>
			<a href="logout.php" class="bg-dark list-group-item list-group-item-action">
				<span class="fa fa-sign-out-alt mr-3"></span> Keluar
			</a>
		</ul>
	</div>

	<div class="col">
		<div class="container-fluid mt-3">
			<div class="card">
				<div class="card-header bg-danger text-white">Soal</div>
				<div class="card-body">

<?php
if (empty($_SESSION['username'])) {
	echo "<center>Silakan login kembali</center>";
	exit;
}

$cek = mysqli_num_rows(mysqli_query($koneksi,
	"SELECT id_user FROM tbl_nilai WHERE id_user='$_SESSION[iduser]'"
));

if ($cek > 0) {
	echo "<h3 class='text-center'>Tes sudah selesai</h3>";
	exit;
}

$dataWaktu = mysqli_fetch_array(
	mysqli_query($koneksi, "SELECT waktu FROM tbl_pengaturan_tes")
);
$menitTes = (int)$dataWaktu['waktu'];
?>

<table class="mb-3">
	<tr>
		<th>⏰ Waktu Tersisa</th>
	</tr>
	<tr>
		<td align="center">
			<span id="menit">00</span>:<span id="detik">00</span>
		</td>
	</tr>
</table>

<form id="form1" method="post" action="?hal=jawaban">
<table class="table">

<?php
$hasil = mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE aktif='Y' ORDER BY RAND()");
$jumlah = mysqli_num_rows($hasil);
$no = 1;

while ($row = mysqli_fetch_array($hasil)) {
?>
	<input type="hidden" name="id[]" value="<?= $row['id_soal'] ?>">
	<input type="hidden" name="jumlah" value="<?= $jumlah ?>">

	<tr>
		<td><?= $no++ ?></td>
		<td><?= $row['soal'] ?></td>
	</tr>
	<tr><td></td><td>A <input type="radio" name="pilihan[<?= $row['id_soal'] ?>]" value="A"> <?= $row['a'] ?></td></tr>
	<tr><td></td><td>B <input type="radio" name="pilihan[<?= $row['id_soal'] ?>]" value="B"> <?= $row['b'] ?></td></tr>
	<tr><td></td><td>C <input type="radio" name="pilihan[<?= $row['id_soal'] ?>]" value="C"> <?= $row['c'] ?></td></tr>
	<tr><td></td><td>D <input type="radio" name="pilihan[<?= $row['id_soal'] ?>]" value="D"> <?= $row['d'] ?></td></tr>
<?php } ?>

<tr>
	<td></td>
	<td>
		<button type="submit" class="btn btn-success">Kirim Jawaban</button>
	</td>
</tr>

</table>
</form>

</div>
</div>
</div>
</div>

<!-- ================= TIMER & AUTO SUBMIT ================= -->

<script>
let menit = <?= $menitTes ?>;
let detik = 0;
let interval = null;

function updateJam() {
	document.getElementById("menit").innerText = String(menit).padStart(2,'0');
	document.getElementById("detik").innerText = String(detik).padStart(2,'0');
}

function autoSubmit() {
	if(interval) clearInterval(interval);
	const form = document.getElementById("form1");
	if(form){
		HTMLFormElement.prototype.submit.call(form);
	}
}

interval = setInterval(() => {
	if (menit === 0 && detik === 0) {
		alert("Waktu habis! Jawaban dikirim otomatis.");
		autoSubmit();
		return;
	}
	if (detik === 0) {
		menit--;
		detik = 59;
	} else {
		detik--;
	}
	updateJam();
}, 1000);

updateJam();
</script>

<!-- AUTO SUBMIT PINDAH TAB -->
<script>
document.addEventListener("visibilitychange", () => {
	if (document.hidden) {
		alert("Anda berpindah tab. Jawaban dikirim.");
		autoSubmit();
	}
});
</script>

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

