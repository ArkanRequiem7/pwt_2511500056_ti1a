<?php
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control" required>
                            <?php
                            $sql_k = mysqli_query($koneksi, "SELECT * FROM kelas");
                            while($k = mysqli_fetch_array($sql_k)) {
                                $s = ($id_edit != '' && $data_edit['id_kelas'] == $k['Id_kelas']) ? 'selected' : '';
                                echo "<option value='$k[Id_kelas]' $s>$k[Nm_kelas]</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <select name="kd_mapel" class="form-control" required>
                            <?php
                            $sql_m = mysqli_query($koneksi, "SELECT * FROM mapel");
                            while($m = mysqli_fetch_array($sql_m)) {
                                $s = ($id_edit != '' && $data_edit['kd_mapel'] == $m['kd_mapel']) ? 'selected' : '';
                                echo "<option value='$m[kd_mapel]' $s>$m[nm_mapel]</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Guru Pengampu</label>
                        <select name="kd_guru" class="form-control" required>
                            <?php
                            $sql_g = mysqli_query($koneksi, "SELECT * FROM guru");
                            while($g = mysqli_fetch_array($sql_g)) {
                                $s = ($id_edit != '' && $data_edit['kd_guru'] == $g['Kd_guru']) ? 'selected' : '';
                                echo "<option value='$g[Kd_guru]' $s>$g[Nm_guru]</option>";
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hari & Waktu</label>
                        <div class="row">
                            <div class="col-4">
                                <select name="hari" class="form-control">
                                    <?php $days=['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                                    foreach($days as $d){
                                        $s = ($id_edit != '' && $data_edit['hari'] == $d) ? 'selected' : '';
                                        echo "<option value='$d' $s>$d</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="col-4"><input type="time" name="jam_mulai" class="form-control" value="<?= $data_edit['jam_mulai'] ?? ''; ?>" required></div>
                            <div class="col-4"><input type="time" name="jam_selesai" class="form-control" value="<?= $data_edit['jam_selesai'] ?? ''; ?>" required></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="thn_ajaran" class="form-control">
                            <?php for($i=2024; $i<=2028; $i++){
                                $v = "$i/".($i+1);
                                $s = ($id_edit != '' && $data_edit['thn_ajaran'] == $v) ? 'selected' : '';
                                echo "<option value='$v' $s>$v</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control">
                            <option value="Ganjil" <?= ($id_edit != '' && $data_edit['semester'] == 'Ganjil') ? 'selected' : ''; ?>>Ganjil</option>
                            <option value="Genap" <?= ($id_edit != '' && $data_edit['semester'] == 'Genap') ? 'selected' : ''; ?>>Genap</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" name="proses" class="btn btn-success">
                <i class="fas fa-save"></i> <?= ($id_edit != '') ? 'Simpan Perubahan' : 'Tambah Jadwal'; ?>
            </button>
            <a href="index.php?page=jadwal" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if(isset($_POST['proses'])){
    extract($_POST);
    
    if ($id_edit != '') {
        $sql = "UPDATE jadwal SET 
                id_kelas = '$id_kelas', 
                kd_mapel = '$kd_mapel', 
                kd_guru = '$kd_guru', 
                hari = '$hari', 
                jam_mulai = '$jam_mulai', 
                jam_selesai = '$jam_selesai', 
                thn_ajaran = '$thn_ajaran', 
                semester = '$semester' 
                WHERE id_jadwal = '$id_edit'";
        $pesan = "Data Berhasil Diperbarui!";
    } else {
        $sql = "INSERT INTO jadwal (id_kelas, kd_mapel, kd_guru, hari, jam_mulai, jam_selesai, thn_ajaran, semester) 
                VALUES ('$id_kelas', '$kd_mapel', '$kd_guru', '$hari', '$jam_mulai', '$jam_selesai', '$thn_ajaran', '$semester')";
        $pesan = "Data Berhasil Disimpan!";
    }

    if(mysqli_query($koneksi, $sql)){
        echo "<script>alert('$pesan'); window.location='index.php?page=jadwal';</script>";
    } else {
        echo "<script>alert('Gagal: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>