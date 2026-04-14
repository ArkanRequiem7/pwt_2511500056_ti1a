<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Tambah Siswa</h3></div>
            <form method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>NIS (Username)</label>
                        <input type="text" name="Nis" class="form-control" maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="Nm_siswa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="Jenkel" class="form-control">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="Hp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="Id_kelas" class="form-control">
                            <?php
                            $kls = mysqli_query($koneksi, "SELECT * FROM kelas");
                            while($k = mysqli_fetch_array($kls)) {
                                echo "<option value='$k[Id_kelas]'>$k[Nm_kelas]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                    <a href="index.php?page=siswa" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $nis = $_POST['Nis'];
    $nm  = $_POST['Nm_siswa'];
    $jk  = $_POST['Jenkel'];
    $hp  = $_POST['Hp'];
    $idk = $_POST['Id_kelas'];
    $querySiswa = mysqli_query($koneksi, "INSERT INTO siswa VALUES ('$nis', '$nm', '$jk', '$hp', '$idk')");
    $queryUser = mysqli_query($koneksi, "INSERT INTO users (Username, Password, role) VALUES ('$nis', '1234', 'siswa')");
    if ($querySiswa && $queryUser) {
        echo "<script>alert('Data Siswa & User berhasil disimpan'); window.location.href='index.php?page=siswa';</script>";
    }
}
?>