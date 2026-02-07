<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
// Proteksi halaman
if (empty($_SESSION['username'])) {
    echo "<script>alert('Login Dulu'); window.location='/index.php';</script>";
    exit;
}

// Jalur aksi disesuaikan karena file ini diakses dari media.php di folder admin
$aksi = "modul/mod_soal/aksi_soal.php";
$act  = $_GET['act'] ?? '';
?>

<div class="card-body">
<?php
switch ($act) {
    default:
    echo "<button class='btn btn-primary mb-3' onclick=\"window.location.href='?module=soal&act=tambahsoal';\">Tambah Soal</button>
    <table class='table table-bordered'>
    <thead><tr><th>No</th><th>Pertanyaan</th><th>Aksi</th></tr></thead><tbody>";
    $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_soal ORDER BY id_soal DESC");
    $no = 1;
    while ($r = mysqli_fetch_assoc($tampil)) {
        $soal = substr(strip_tags($r['soal']), 0, 50);
        echo "<tr><td>$no</td><td>$soal...</td>
              <td><a href='?module=soal&act=editsoal&id={$r['id_soal']}'>Edit</a> | 
                  <a href='$aksi?module=soal&act=hapus&id={$r['id_soal']}'>Hapus</a></td></tr>";
        $no++;
    }
    echo "</tbody></table>";
    break;

    case "tambahsoal":
    echo "<h4>Tambah Soal</h4><hr>
    <form method='POST' action='$aksi?module=soal&act=input'>
        <div class='form-group'>
            <label>Soal</label>
            <textarea name='soal' id='isi_soal' class='form-control' rows='6'></textarea>
        </div>
        <div class='form-group'><label>Jawaban A</label><input type='text' name='a' class='form-control' required></div>
        <div class='form-group'><label>Jawaban B</label><input type='text' name='b' class='form-control' required></div>
        <div class='form-group'><label>Jawaban C</label><input type='text' name='c' class='form-control' required></div>
        <div class='form-group'><label>Jawaban D</label><input type='text' name='d' class='form-control' required></div>
        <div class='form-group'><label>Kunci</label>
            <select name='knc_jawaban' class='form-control'><option value='a'>A</option><option value='b'>B</option><option value='c'>C</option><option value='d'>D</option></select>
        </div>
        <button type='submit' class='btn btn-primary' onclick=\"nicEditors.findEditor('isi_soal').saveContent();\">Simpan Soal</button>
    </form>";
    break;
}
?>
</div>
