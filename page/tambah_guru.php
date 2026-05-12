<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Tambah Guru</h3></div>
            <form method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Guru (Username)</label>
                        <input type="text" name="Kd_guru" class="form-control" maxlength="5" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="Nm_guru" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="Jenkel" class="form-control">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select name="Pend_terakhir" class="form-control">
                            <option value="Strata 2">Strata 2</option>
                            <option value="Strata 1">Strata 1</option>
                            <option value="Diploma 3">Diploma 3</option>
                            <option value="SMA Sederajat">SMA Sederajat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="Hp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="Alamat" class="form-control"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                    <a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $kd = $_POST['Kd_guru'];
    $nm = $_POST['Nm_guru'];
    $jk = $_POST['Jenkel'];
    $pt = $_POST['Pend_terakhir'];
    $hp = $_POST['Hp'];
    $al = $_POST['Alamat'];
    $queryGuru = mysqli_query($koneksi, "INSERT INTO guru VALUES ('$kd', '$nm', '$jk', '$pt', '$hp', '$al')");
    $queryUser = mysqli_query($koneksi, "INSERT INTO users (Username, Password, role) VALUES ('$kd', '1234', 'guru')");

    if ($queryGuru && $queryUser) {
        echo "<script>alert('Data Guru & User berhasil disimpan'); window.location.href='index.php?page=guru';</script>";
    }
}
?>