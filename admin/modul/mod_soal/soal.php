<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['username']) && empty($_SESSION['passuser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>
          <a href='../../index.php'><b>LOGIN</b></a></center>";
    exit;
}

$aksi = "modul/mod_soal/aksi_soal.php";
$act  = $_GET['act'] ?? '';
?>

<div class="card-header bg-danger text-white">
  Kelola Soal
</div>

<div class="card-body">

<?php
switch ($act) {

/* ===================== DEFAULT ===================== */
default:
echo "
<div class='row mb-3'>
  <div class='col-lg-6'>
    <button class='btn btn-primary' 
      onclick=\"window.location.href='?module=soal&act=tambahsoal';\">
      <i class='fa fa-plus mr-1'></i>Tambah Soal
    </button>
  </div>
</div>

<table class='table table-hover'>
<thead>
<tr align='center'>
  <th>No</th>
  <th>Pertanyaan</th>
  <th>Aktif</th>
  <th>Aksi</th>
  <th>Lihat</th>
  <th>Status</th>
</tr>
</thead>
<tbody>";

$tampil = mysqli_query($koneksi, "SELECT * FROM tbl_soal ORDER BY id_soal DESC");
$no = 1;

while ($r = mysqli_fetch_assoc($tampil)) {
    $soal = substr(strip_tags($r['soal']), 0, 50);

    echo "
    <tr>
      <td>$no</td>
      <td>$soal...</td>
      <td align='center'>{$r['aktif']}</td>
      <td>
        <a class='btn btn-outline-primary btn-sm' 
           href='?module=soal&act=editsoal&id={$r['id_soal']}'>
           <i class='fa fa-edit'></i> Edit
        </a>
        <a class='btn btn-outline-danger btn-sm' 
           href='$aksi?module=soal&act=hapus&id={$r['id_soal']}' 
           onclick=\"return confirm('Hapus soal ini?')\">
           <i class='fa fa-trash'></i> Hapus
        </a>
      </td>
      <td>
        <a class='btn btn-outline-info btn-sm' 
           href='?module=soal&act=viewsoal&id={$r['id_soal']}'>
           <i class='fa fa-eye'></i> Lihat
        </a>
      </td>
      <td>";
      
      if ($r['aktif'] == 'Y') {
          echo "<a class='btn btn-outline-dark btn-sm' 
                href='$aksi?module=soal&act=nonaktif&id={$r['id_soal']}'>
                Non Aktif
                </a>";
      } else {
          echo "<a class='btn btn-outline-success btn-sm' 
                href='$aksi?module=soal&act=aktif&id={$r['id_soal']}'>
                Aktifkan
                </a>";
      }

    echo "</td></tr>";
    $no++;
}

echo "</tbody></table>";
break;

/* ===================== TAMBAH ===================== */
case "tambahsoal":
echo "
<h4>Tambah Soal</h4><hr>
<form method='POST' action='$aksi?module=soal&act=input' enctype='multipart/form-data'>

<div class='form-group'>
<label>Soal</label>
<textarea name='soal' id='isi_soal' class='form-control' rows='6'></textarea>
<small class='text-muted'>*Wajib diisi</small>
</div>

<div class='form-group'><label>Jawaban A</label>
<input type='text' name='a' class='form-control' required></div>

<div class='form-group'><label>Jawaban B</label>
<input type='text' name='b' class='form-control' required></div>

<div class='form-group'><label>Jawaban C</label>
<input type='text' name='c' class='form-control' required></div>

<div class='form-group'><label>Jawaban D</label>
<input type='text' name='d' class='form-control' required></div>

<div class='form-group'>
<label>Kunci Jawaban</label>
<select name='knc_jawaban' class='form-control' required>
<option value='a'>A</option>
<option value='b'>B</option>
<option value='c'>C</option>
<option value='d'>D</option>
</select>
</div>

<button type='submit' class='btn btn-primary' onclick=\"nicEditors.findEditor('isi_soal').saveContent();\">Simpan</button>
<button type='button' class='btn btn-danger' onclick='history.back()'>Batal</button>
</form>";
break;

/* ===================== EDIT ===================== */
case "editsoal":
$edit = mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
$r = mysqli_fetch_assoc($edit);

echo "
<h4>Edit Soal</h4><hr>
<form method='POST' action='$aksi?module=soal&act=update' enctype='multipart/form-data'>
<input type='hidden' name='id' value='{$r['id_soal']}'>

<div class='form-group'>
<label>Soal</label>
<textarea name='soal' id='edit_soal' class='form-control' rows='6'>{$r['soal']}</textarea>
</div>

<div class='form-group'><label>Jawaban A</label>
<input type='text' name='a' value='{$r['a']}' class='form-control' required></div>

<div class='form-group'><label>Jawaban B</label>
<input type='text' name='b' value='{$r['b']}' class='form-control' required></div>

<div class='form-group'><label>Jawaban C</label>
<input type='text' name='c' value='{$r['c']}' class='form-control' required></div>

<div class='form-group'><label>Jawaban D</label>
<input type='text' name='d' value='{$r['d']}' class='form-control' required></div>

<div class='form-group'>
<label>Kunci Jawaban</label>
<select name='knc_jawaban' class='form-control' required>
  <option value='a' ".($r['knc_jawaban']=='a'?'selected':'').">A</option>
  <option value='b' ".($r['knc_jawaban']=='b'?'selected':'').">B</option>
  <option value='c' ".($r['knc_jawaban']=='c'?'selected':'').">C</option>
  <option value='d' ".($r['knc_jawaban']=='d'?'selected':'').">D</option>
</select>
</div>

<button type='submit' class='btn btn-primary' onclick=\"nicEditors.findEditor('edit_soal').saveContent();\">Update</button>
<button type='button' class='btn btn-danger' onclick='history.back()'>Batal</button>
</form>";
break;

/* ===================== VIEW ===================== */
case "viewsoal":
$v = mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
$t = mysqli_fetch_assoc($v);

echo "
<a class='btn btn-success mb-3' href='?module=soal'>Kembali</a>
<h5>Soal:</h5>{$t['soal']}<br><br>
<h5>Jawaban:</h5>
A. {$t['a']}<br>
B. {$t['b']}<br>
C. {$t['c']}<br>
D. {$t['d']}<br><br>
<b>Kunci Jawaban: ".strtoupper($t['knc_jawaban'])."</b>";
break;

}
?>

</div>
