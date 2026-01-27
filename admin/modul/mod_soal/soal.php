<?php
if (!defined('BASEPATH')) {
  session_start();
}

include "../../../config/koneksi.php";

$module = $_GET['module'];
$act    = $_GET['act'];

switch ($act) {

/* ==========================
   TAMBAH SOAL
========================== */
case "tambahsoal":
?>
<form class="form-horizontal" method="POST" action="modul/mod_soal/aksi_soal.php?module=soal&act=input">
  <div class="box-body">

    <div class="form-group">
      <label class="col-sm-2 control-label">Soal</label>
      <div class="col-sm-10">
        <textarea name="soal" class="form-control" rows="4" required></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Jawaban A</label>
      <div class="col-sm-10">
        <input type="text" name="a" class="form-control" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Jawaban B</label>
      <div class="col-sm-10">
        <input type="text" name="b" class="form-control" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Jawaban C</label>
      <div class="col-sm-10">
        <input type="text" name="c" class="form-control" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Jawaban D</label>
      <div class="col-sm-10">
        <input type="text" name="d" class="form-control" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Kunci Jawaban</label>
      <div class="col-sm-4">
        <select name="knc_jawaban" class="form-control" required>
          <option value="">- Pilih -</option>
          <option value="a">A</option>
          <option value="b">B</option>
          <option value="c">C</option>
          <option value="d">D</option>
        </select>
      </div>
    </div>

  </div>

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <button type="button" class="btn btn-default" onclick="self.history.back()">Batal</button>
  </div>
</form>
<?php
break;


/* ==========================
   EDIT SOAL
========================== */
case "editsoal":

$id = $_GET['id'];
$q  = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id'");
$r  = mysqli_fetch_array($q);
?>

<form class="form-horizontal" method="POST" action="modul/mod_soal/aksi_soal.php?module=soal&act=update">
<input type="hidden" name="id" value="<?php echo $r['id_soal']; ?>">

  <div class="box-body">

    <div class="form-group">
      <label class="col-sm-2 control-label">Soal</label>
      <div class="col-sm-10">
        <textarea name="soal" class="form-control" rows="4" required><?php echo $r['soal']; ?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Jawaban A</label>
      <div class="col-sm-10">
        <input type="text" name="a" class="form-control" value="<?php echo $r['a']; ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Jawaban B</label>
      <div class="col-sm-10">
        <input type="text" name="b" class="form-control" value="<?php echo $r['b']; ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Jawaban C</label>
      <div class="col-sm-10">
        <input type="text" name="c" class="form-control" value="<?php echo $r['c']; ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Jawaban D</label>
      <div class="col-sm-10">
        <input type="text" name="d" class="form-control" value="<?php echo $r['d']; ?>" required>
      </div>
    </div>

    <!-- INI BAGIAN PENTING (TAMPILAN TETAP ASLI) -->
    <div class="form-group">
      <label class="col-sm-2 control-label">Kunci Jawaban</label>
      <div class="col-sm-4">
        <select name="knc_jawaban" class="form-control" required>
          <option value="a" <?php if($r['knc_jawaban']=='a') echo 'selected'; ?>>A</option>
          <option value="b" <?php if($r['knc_jawaban']=='b') echo 'selected'; ?>>B</option>
          <option value="c" <?php if($r['knc_jawaban']=='c') echo 'selected'; ?>>C</option>
          <option value="d" <?php if($r['knc_jawaban']=='d') echo 'selected'; ?>>D</option>
        </select>
      </div>
    </div>

  </div>

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Update</button>
    <button type="button" class="btn btn-default" onclick="self.history.back()">Batal</button>
  </div>
</form>

<?php
break;
}
?>
