<?php
if ($_SESSION['role'] != 'admin') {
    echo "<script>
            alert('Akses Ditolak! Anda tidak memiliki izin untuk menambah atau mengubah jadwal.'); 
            window.location='index.php?page=jadwal';
          </script>";
    exit;
}

$id_edit = isset($_GET['id']) ? $_GET['id'] : '';
$data_edit = [];
if ($id_edit != '') {
    $query_ambil = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id_jadwal = '$id_edit'");
    $data_edit = mysqli_fetch_array($query_ambil);
}
?>

<div class="card card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title"><?= ($id_edit != '') ? 'Edit' : 'Tambah'; ?> Jadwal Pelajaran</h3>
    </div>
    <form method="POST">
        <div class="card-body">
            <div class="form-group">
                <label>Kode Jadwal</label>
                <input type="text" class="form-control" value="001" readonly style="max-width: 200px;">
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select name="id_kelas" class="form-control" required>
                    <option value="">--Pilih Kelas--</option>
                    <?php
                    $sql_k = mysqli_query($koneksi, "SELECT * FROM kelas");
                    while($k = mysqli_fetch_array($sql_k)) {
                        $s = ($id_edit != '' && $data_edit['id_kelas'] == $k['Id_kelas']) ? 'selected' : '';
                        echo "<option value='$k[Id_kelas]' $s>$k[Nm_kelas]</option>";
                    } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Semester</label>
                <select name="semester" class="form-control" required>
                    <option value="">--Pilih Semester--</option>
                    <option value="Ganjil" <?= ($id_edit != '' && $data_edit['semester'] == 'Ganjil') ? 'selected' : ''; ?>>Ganjil</option>
                    <option value="Genap" <?= ($id_edit != '' && $data_edit['semester'] == 'Genap') ? 'selected' : ''; ?>>Genap</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tahun Ajaran</label>
                <select name="thn_ajaran" class="form-control" required>
                    <option value="">--Pilih Tahun Ajaran--</option>
                    <?php for($i=2024; $i<=2028; $i++){
                        $v = "$i/".($i+1);
                        $s = ($id_edit != '' && $data_edit['thn_ajaran'] == $v) ? 'selected' : '';
                        echo "<option value='$v' $s>$v</option>";
                    } ?>
                </select>
            </div>

            <hr>
            
            <h5>Detail Jadwal</h5>
            <div id="container-detail">
                
                <div class="row row-jadwal mb-2 align-items-center">
                    <div class="col-md-3 mb-2">
                        <select name="kd_mapel[]" class="form-control" required>
                            <option value="">--Pilih Mapel--</option>
                            <?php
                            $sql_m = mysqli_query($koneksi, "SELECT * FROM mapel");
                            while($m = mysqli_fetch_array($sql_m)) {
                                $s = ($id_edit != '' && $data_edit['kd_mapel'] == $m['kd_mapel']) ? 'selected' : '';
                                echo "<option value='$m[kd_mapel]' $s>$m[nm_mapel]</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="kd_guru[]" class="form-control" required>
                            <option value="">--Pilih Guru--</option>
                            <?php
                            $sql_g = mysqli_query($koneksi, "SELECT * FROM guru");
                            while($g = mysqli_fetch_array($sql_g)) {
                                $s = ($id_edit != '' && $data_edit['kd_guru'] == $g['Kd_guru']) ? 'selected' : '';
                                echo "<option value='$g[Kd_guru]' $s>$g[Nm_guru]</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <select name="hari[]" class="form-control" required>
                            <option value="">--Hari--</option>
                            <?php $days=['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                            foreach($days as $d){
                                $s = ($id_edit != '' && $data_edit['hari'] == $d) ? 'selected' : '';
                                echo "<option value='$d' $s>$d</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-6 mb-2">
                        <input type="time" name="jam_mulai[]" class="form-control" value="<?= $data_edit['jam_mulai'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-1 col-6 mb-2">
                        <input type="time" name="jam_selesai[]" class="form-control" value="<?= $data_edit['jam_selesai'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-1 text-center mb-2">
                        <?php if($id_edit == ''): ?>
                            <button type="button" class="btn btn-danger btn-sm btn-hapus-baris" style="width: 35px;"><i class="fas fa-times"></i></button>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <?php if($id_edit == ''): ?>
                <button type="button" id="btn-tambah-baris" class="btn btn-info btn-sm mt-2">
                    <i class="fas fa-plus"></i> Tambah Mapel
                </button>
            <?php endif; ?>

        </div>
        <div class="card-footer text-left">
            <button type="submit" name="proses" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script>
document.getElementById('btn-tambah-baris')?.addEventListener('click', function() {
    var container = document.getElementById('container-detail');
    var barisBaru = container.querySelector('.row-jadwal').cloneNode(true);

    barisBaru.querySelectorAll('select, input').forEach(function(input) {
        input.value = "";
    });
    
    container.appendChild(barisBaru);
});

document.getElementById('container-detail').addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-hapus-baris') || e.target.closest('.btn-hapus-baris')) {
        var totalBaris = document.querySelectorAll('.row-jadwal').length;
        if (totalBaris > 1) {
            e.target.closest('.row-jadwal').remove();
        } else {
            alert('Minimal harus mengisi satu mata pelajaran!');
        }
    }
});
</script>

<?php
if(isset($_POST['proses'])){
    $id_kelas   = $_POST['id_kelas'];
    $thn_ajaran = $_POST['thn_ajaran'];
    $semester   = $_POST['semester'];
    
    $kd_mapel    = $_POST['kd_mapel'];
    $kd_guru     = $_POST['kd_guru'];
    $hari        = $_POST['hari'];
    $jam_mulai   = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    if ($id_edit != '') {
        $sql = "UPDATE jadwal SET 
                id_kelas = '$id_kelas', 
                kd_mapel = '{$kd_mapel[0]}', 
                kd_guru = '{$kd_guru[0]}', 
                hari = '{$hari[0]}', 
                jam_mulai = '{$jam_mulai[0]}', 
                jam_selesai = '{$jam_selesai[0]}', 
                thn_ajaran = '$thn_ajaran', 
                semester = '$semester' 
                WHERE id_jadwal = '$id_edit'";
        
        if(mysqli_query($koneksi, $sql)){
            echo "<script>alert('Data Berhasil Diperbarui!'); window.location='index.php?page=jadwal';</script>";
        } else {
            echo "<script>alert('Gagal: " . mysqli_error($koneksi) . "');</script>";
        }
    } else {
        $sukses = true;
        $total_data = count($kd_mapel);
        
        for ($i = 0; $i < $total_data; $i++) {
            $m_id = $kd_mapel[$i];
            $g_id = $kd_guru[$i];
            $h_id = $hari[$i];
            $j_mulai = $jam_mulai[$i];
            $j_selesai = $jam_selesai[$i];
            
            $sql = "INSERT INTO jadwal (id_kelas, kd_mapel, kd_guru, hari, jam_mulai, jam_selesai, thn_ajaran, semester) 
                    VALUES ('$id_kelas', '$m_id', '$g_id', '$h_id', '$j_mulai', '$j_selesai', '$thn_ajaran', '$semester')";
            
            if(!mysqli_query($koneksi, $sql)){
                $sukses = false;
                break;
            }
        }

        if($sukses){
            echo "<script>alert('Data Berhasil Disimpan!'); window.location='index.php?page=jadwal';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan sebagian atau seluruh data: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}
?>