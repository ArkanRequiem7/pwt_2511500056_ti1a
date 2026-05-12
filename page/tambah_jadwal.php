<?php
$id_edit = isset($_GET['id']) ? $_GET['id'] : '';
$data_edit = [];

if ($id_edit != '') {
    $query_ambil = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id_jadwal = '$id_edit'");
    $data_edit = mysqli_fetch_array($query_ambil);
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card card-primary mt-3">
            <div class="card-header">
                <h3 class="card-title"><?= ($id_edit != '') ? 'Edit' : 'Input'; ?> Jadwal Baru</h3>
            </div>
            <form method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Kelas</label>
                                <select name="id_kelas" class="form-control" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <?php
                                    $sql_k = mysqli_query($koneksi, "SELECT * FROM kelas");
                                    while($k = mysqli_fetch_array($sql_k)) {
                                        $select = ($id_edit != '' && $data_edit['id_kelas'] == $k['Id_kelas']) ? 'selected' : '';
                                        echo "<option value='$k[Id_kelas]' $select>$k[Nm_kelas]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <select name="kd_mapel" class="form-control" required>
                                    <option value="">-- Pilih Mapel --</option>
                                    <?php
                                    $sql_m = mysqli_query($koneksi, "SELECT * FROM mapel");
                                    while($m = mysqli_fetch_array($sql_m)) {
                                        $select = ($id_edit != '' && $data_edit['kd_mapel'] == $m['kd_mapel']) ? 'selected' : '';
                                        echo "<option value='$m[kd_mapel]' $select>$m[nm_mapel]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Guru Pengampu</label>
                                <select name="kd_guru" class="form-control" required>
                                    <option value="">-- Pilih Guru --</option>
                                    <?php
                                    $sql_g = mysqli_query($koneksi, "SELECT * FROM guru");
                                    while($g = mysqli_fetch_array($sql_g)) {
                                        $select = ($id_edit != '' && $data_edit['kd_guru'] == $g['Kd_guru']) ? 'selected' : '';
                                        echo "<option value='$g[Kd_guru]' $select>$g[Nm_guru]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hari & Jam</label>
                                <div class="row">
                                    <div class="col-6">
                                        <select name="hari" class="form-control" required>
                                            <?php
                                            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                            foreach($days as $d) {
                                                $select = ($id_edit != '' && $data_edit['hari'] == $d) ? 'selected' : '';
                                                echo "<option value='$d' $select>$d</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="jam" class="form-control" placeholder="07:00 - 09:00" value="<?= ($id_edit != '') ? $data_edit['jam'] : ''; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="thn_ajaran" class="form-control" required>
                                    <?php
                                    $start = 2025;
                                    for($i=$start; $i<=$start+3; $i++){
                                        $val = $i."/".($i+1);
                                        $select = ($id_edit != '' && $data_edit['thn_ajaran'] == $val) ? 'selected' : '';
                                        echo "<option value='$val' $select>$val</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select name="semester" class="form-control">
                                    <option value="1" <?= ($id_edit != '' && $data_edit['semester'] == '1') ? 'selected' : ''; ?>>1 (Ganjil)</option>
                                    <option value="2" <?= ($id_edit != '' && $data_edit['semester'] == '2') ? 'selected' : ''; ?>>2 (Genap)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" name="proses" class="btn btn-success">
                        <i class="fas fa-save"></i> <?= ($id_edit != '') ? 'Update' : 'Simpan'; ?> Data
                    </button>
                    <a href="index.php?page=jadwal" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
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
                jam = '$jam', 
                thn_ajaran = '$thn_ajaran', 
                semester = '$semester' 
                WHERE id_jadwal = '$id_edit'";
        $pesan = "Data Berhasil Diperbarui!";
    } else {
        $sql = "INSERT INTO jadwal (id_kelas, kd_mapel, kd_guru, hari, jam, thn_ajaran, semester) 
                VALUES ('$id_kelas', '$kd_mapel', '$kd_guru', '$hari', '$jam', '$thn_ajaran', '$semester')";
        $pesan = "Data Berhasil Disimpan!";
    }

    $q = mysqli_query($koneksi, $sql);
    if($q) {
        echo "<script>alert('$pesan'); window.location='index.php?page=jadwal';</script>";
    } else {
        echo "<script>alert('Gagal! " . mysqli_error($koneksi) . "');</script>";
    }
}
?>