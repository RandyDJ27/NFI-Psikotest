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
$act  = isset($_GET['act']) ? $_GET['act'] : '';
?>

<div class="card">
  <div class="card-header bg-danger text-white">Kelola Soal</div>
  <div class="card-body">

<?php
switch ($act) {

/* ======================================================
   TAMPIL DATA
====================================================== */
default:
?>
<a href="?module=soal&act=tambahsoal" class="btn btn-primary mb-3">Tambah Soal</a>

<table class="table table-bordered table-hover">
<thead>
<tr align="center">
  <th>No</th>
  <th>Pertanyaan</th>
  <th>Kunci</th>
  <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no = 1;
$q = mysqli_query($koneksi, "SELECT * FROM tbl_soal ORDER BY id_soal DESC");
while ($r = mysqli_fetch_assoc($q)) {
  $soal = substr(strip_tags($r['soal']),0,60);
?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $soal ?>...</td>
  <td align="center"><b><?= strtoupper($r['knc_jawaban']) ?></b></td>
  <td align="center">
    <a class="btn btn-sm btn-warning" href="?module=soal&act=editsoal&id=<?= $r['id_soal'] ?>">Edit</a>
    <a class="btn btn-sm btn-danger" href="<?= $aksi ?>?module=soal&act=hapus&id=<?= $r['id_soal'] ?>" onclick="return confirm('Hapus soal?')">Hapus</a>
  </td>
</tr>
<?php } ?>
</tbody>
</table>
<?php
break;

/* ======================================================
   TAMBAH SOAL
====================================================== */
case "tambahsoal":
?>
<h4>Tambah Soal</h4>
<form method="POST" action="<?= $aksi ?>?module=soal&act=input" enctype="multipart/form-data">

<div class="form-group">
  <label>Soal</label>
  <textarea name="soal" class="form-control" rows="5" required></textarea>
</div>

<div class="form-group">
  <label>Jawaban A</label>
  <input type="text" name="a" class="form-control" required>
</div>

<div class="form-group">
  <label>Jawaban B</label>
  <input type="text" name="b" class="form-control" required>
</div>

<div class="form-group">
  <label>Jawaban C</label>
  <input type="text" name="c" class="form-control" required>
</div>

<div class="form-group">
  <label>Jawaban D</label>
  <input type="text" name="d" class="form-control" required>
</div>

<div class="form-group">
  <label>Kunci Jawaban</label>
  <select name="knc_jawaban" class="form-control" required>
    <option value="">-- Pilih --</option>
    <option value="a">A</option>
    <option value="b">B</option>
    <option value="c">C</option>
    <option value="d">D</option>
  </select>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="?module=soal" class="btn btn-secondary">Batal</a>

</form>
<?php
break;

/* ======================================================
   EDIT SOAL
====================================================== */
case "editsoal":
$edit = mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
$r = mysqli_fetch_assoc($edit);
?>
<h4>Edit Soal</h4>

<form method="POST" action="<?= $aksi ?>?module=soal&act=update">
<input type="hidden" name="id" value="<?= $r['id_soal'] ?>">

<div class="form-group">
  <label>Soal</label>
  <textarea name="soal" class="form-control" rows="5" required><?= $r['soal'] ?></textarea>
</div>

<div class="form-group">
  <label>Jawaban A</label>
  <input type="text" name="a" class="form-control" value="<?= $r['a'] ?>" required>
</div>

<div class="form-group">
  <label>Jawaban B</label>
  <input type="text" name="b" class="form-control" value="<?= $r['b'] ?>" required>
</div>

<div class="form-group">
  <label>Jawaban C</label>
  <input type="text" name="c" class="form-control" value="<?= $r['c'] ?>" required>
</div>

<div class="form-group">
  <label>Jawaban D</label>
  <input type="text" name="d" class="form-control" value="<?= $r['d'] ?>" required>
</div>

<div class="form-group">
  <label>Kunci Jawaban</label>
  <select name="knc_jawaban" class="form-control" required>
    <option value="a" <?= ($r['knc_jawaban']=='a')?'selected':'' ?>>A</option>
    <option value="b" <?= ($r['knc_jawaban']=='b')?'selected':'' ?>>B</option>
    <option value="c" <?= ($r['knc_jawaban']=='c')?'selected':'' ?>>C</option>
    <option value="d" <?= ($r['knc_jawaban']=='d')?'selected':'' ?>>D</option>
  </select>
</div>

<button type="submit" class="btn btn-primary">Update</button>
<a href="?module=soal" class="btn btn-secondary">Batal</a>

</form>
<?php
break;
}
?>

  </div>
</div>
