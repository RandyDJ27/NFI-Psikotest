<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else {
    $aksi="modul/mod_soal/aksi_soal.php";
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    switch ($act) {
        default:
            echo "<div class='row'><div class='col-lg-6'>
            <input class='btn btn-primary' type=button value='Tambah Soal' 
            onclick=\"window.location.href='?module=soal&act=tambahsoal';\"></div>";

            echo "<div class='col-lg-6'>
            <form class='form-inline' method='POST' action='?module=soal&act=carisoal'>
            <div class='form-group mx-sm-3 mb-2'>
            <input class='form-control' type=text name='cari' placeholder='Masukkan Pertanyaan' list='auto' required/>
            <button class='btn btn-success ml-3' type='submit'><i class='fa fa-search mr-1'></i>Cari</button></div></div>";
            
            echo "<datalist id='auto'>";
            $qry=mysqli_query($koneksi, "SELECT * FROM tbl_soal");
            while ($t=mysqli_fetch_array($qry)) {
                echo "<option value='$t[soal]'>";
            }
            echo "</datalist></form></div>";

            echo "<table class='table table-hover'>
            <thead><tr align='center'><th>No</th><th>Pertanyaan</th><th>Status</th><th>Aksi</th><th>Lihat</th><th>Status</th></tr></thead>"; 
            
            $tampil=mysqli_query($koneksi, "SELECT * FROM tbl_soal ORDER BY id_soal DESC");
            $no=1;
            while ($r=mysqli_fetch_array($tampil)){
                $soal=substr($r['soal'],0,50);
                echo "<tr><td>$no</td>
                <td>$soal..</td>
                <td align='center'>$r[aktif]</td>
                <td>
                <a class='btn btn-outline-primary' href='?module=soal&act=editsoal&id=$r[id_soal]' role='button'><i class='fa fa-edit mr-1'></i>Edit</a> | 
                <a class='btn btn-outline-danger' href='$aksi?module=soal&act=hapus&id=$r[id_soal]' role='button'><i class='fa fa-trash mr-1'></i>Hapus</a></td>
                <td> <a class='btn btn-outline-info' href='?module=soal&act=viewsoal&id=$r[id_soal]'><i class='fa fa-eye mr-1'></i>Lihat</a></td>";
                
                if ($r['aktif']=="Y") {
                    echo "<td><input type=button class='btn btn-outline-dark' value='Non Aktifkan' onclick=\"window.location.href='$aksi?module=soal&act=nonaktif&id=$r[id_soal]';\"></td>";
                } else {
                    echo "<td align='center'><input class='btn btn-outline-success' type=button value='Aktifkan' onclick=\"window.location.href='$aksi?module=soal&act=aktif&id=$r[id_soal]';\"></td>";
                }
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        break;
  
        case "tambahsoal":
            echo "<h2 class='mb-3'><i class='fa fa-plus mr-2'></i>Tambah Soal</h2><hr/>
            <form method=POST class='form-horizontal' action='$aksi?module=soal&act=input' enctype='multipart/form-data'>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Soal</label>
                    <div class='col-sm-10'><textarea name='soal' style='width: 100%; height: 200px;'></textarea></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Gambar</label>
                    <div class='col-sm-10'><input type=file name='fupload' size=40><br><small>JPG/JPEG maks 400px</small></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Jawaban A</label>
                    <div class='col-sm-12'><input type=text name='a' class='form-control' required/></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Jawaban B</label>
                    <div class='col-sm-12'><input type=text name='b' class='form-control' required/></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Jawaban C</label>
                    <div class='col-sm-12'><input type=text name='c' class='form-control' required/></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Jawaban D</label>
                    <div class='col-sm-12'><input type=text name='d' class='form-control' required/></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Kunci</label>
                    <div class='col-sm-4'>
                        <select name='knc_jawaban' class='form-control'>
                            <option value='a'>A</option><option value='b'>B</option><option value='c'>C</option><option value='d'>D</option>
                        </select>
                    </div>
                </div>
                <div class='form-group'>
                    <div class='col-sm-4'>
                        <button class='btn btn-primary' type='submit' name='submit'><i class='fa fa-save mr-1'></i>Simpan</button>
                        <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
                    </div>
                </div>
            </form>";
        break;

        case "editsoal":
            $edit=mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
            $r=mysqli_fetch_array($edit);
            echo "<h2 class='mb-3'><i class='fa fa-edit mr-2'></i>Edit Soal</h2><hr/>
            <form method=POST action='$aksi?module=soal&act=update' class='form-horizontal' enctype='multipart/form-data'>
            <input type=hidden name=id value='$r[id_soal]'>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Pertanyaan</label>
                    <div class='col-lg-10'><textarea name='soal' style='width: 100%; height: 200px;'>$r[soal]</textarea></div>
                </div>";
            if ($r['gambar']!=''){
                echo "<div class='form-group'><div class='col-sm-10'><img src='../foto/$r[gambar]' width='200' class='img-thumbnail'></div></div>";
            }
            echo "<div class='form-group'>
                    <label class='col-sm-2 control-label'>Gambar</label>
                    <div class='col-sm-10'><input type=file name='fupload' size=40></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Jawaban A</label>
                    <div class='col-sm-12'><input type=text name='a' class='form-control' value='$r[a]' required/></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Jawaban B</label>
                    <div class='col-sm-12'><input type=text name='b' class='form-control' value='$r[b]' required/></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Jawaban C</label>
                    <div class='col-sm-12'><input type=text name='c' class='form-control' value='$r[c]' required/></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Jawaban D</label>
                    <div class='col-sm-12'><input type=text name='d' class='form-control' value='$r[d]' required/></div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-2 control-label'>Kunci</label>
                    <div class='col-sm-4'>
                        <select name='knc_jawaban' id='knc_jawaban' class='form-control'>
                            <option value='a' ".($r['knc_jawaban']=='a'?'selected':'').">A</option>
                            <option value='b' ".($r['knc_jawaban']=='b'?'selected':'').">B</option>
                            <option value='c' ".($r['knc_jawaban']=='c'?'selected':'').">C</option>
                            <option value='d' ".($r['knc_jawaban']=='d'?'selected':'').">D</option>
                        </select>
                    </div>
                </div>
                <button class='btn btn-primary' type='submit'><i class='fa fa-save mr-1'></i>Simpan</button>
                <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
            </form>";
        break;

        case "viewsoal":
            $view=mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='$_GET[id]'");
            $t=mysqli_fetch_array($view);
            echo "<h2><i class='fa fa-eye mr-2'></i>Detail</h2><hr>
            <a class='btn btn-success mb-4' href='?module=soal'>Kembali</a>
            <h5>Soal:</h5> $t[soal]<br>";
            if ($t['gambar']!=''){ echo "<img src='../foto/$t[gambar]' class='img-thumbnail mt-2'>"; }
            echo "<h5 class='mt-3'>Jawaban:</h5> A: $t[a]<br>B: $t[b]<br>C: $t[c]<br>D: $t[d]<br>
            <h5>Kunci: ".strtoupper($t['knc_jawaban'])."</h5>";
        break;
    }
}
?>
