<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="http://localhost/psikotes/asset/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-4">
	<h2 class="text-center">Detail Soal</h2><hr/>
	
<?php
  include "../config/koneksi.php";
		$view=mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
		$t=mysqli_fetch_array($view);
		echo "<h5>Soal :</h5>
		$t[soal]</br>";
          if ($t['gambar']!=''){
              echo "<img src='../foto/$t[gambar]'>";  
          }
		echo"<h5>Jawaban :</h5>
		a. $t[a] </br>
		b. $t[b] </br>
		c. $t[c] </br>
		d. $t[d] </br>";
		echo "<h5>Kunci Jawaban : $t[knc_jawaban]</h5>";

?>
	</div>

</body>
</html>