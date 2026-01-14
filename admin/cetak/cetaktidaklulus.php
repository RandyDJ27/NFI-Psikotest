<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan Data Peserta Tes Psikotes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
</head>
<body onload="window.print()">
<div class="container">
            <h1 class="text-right">PT. NISSIN FOODS INDONESIA</h1>
            <h3 class="text-right">DAFTAR PESERTA TIDAK LULUS TES PSIKOTES</h3>
            <p class="text-right">Kawasan Industri Jababeka, Jl. Jababeka Raya Blok N-1, Wangunharja, Kec. Cikarang Utara, Kabupaten Bekasi, Jawa Barat 17530 </p>
<hr style="border-block-start-width: 10px;"/>
</div>
<?php 
include '../../config/koneksi.php';
$tampil = mysqli_query($koneksi, "SELECT nama,jk,email,benar,salah,kosong,score,keterangan FROM tbl_user INNER JOIN tbl_nilai ON tbl_user.id_user=tbl_nilai.id_user WHERE keterangan='Tidak Lulus'");
echo"
<div class='container'><table class='table mt-3'>
          <tr align='center'><th>No</th><th>Nama</th><th>Jenis Kelamin</th><th>Email</th><th>Benar</th><th>Salah</th><th>Kosong</th><th>Nilai</th><th>Hasil</th></tr>"; 
    $no=1;
    while ($r=mysqli_fetch_array($tampil)){
       echo "<tr><td align='center'>$no</td>
       <td align='center'>$r[nama]</td>
             <td>$r[jk]</td>
            <td>$r[email]</td>
        <td align='center'>$r[benar]</td>
        <td align='center'>$r[salah]</td>
        <td align='center'>$r[kosong]</td>
        <td align='center'>$r[score]</td>
        <td align='center'>$r[keterangan]</td>
        </tr>";
      $no++;
    } ?>
    </table></div>
    <table class="mt-4" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td align="right">Cikarang, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td align="right">( ........................................... )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</body>
</html>