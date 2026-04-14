<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE Nis='$id'");
$data = mysqli_fetch_array($query);
?>
<div class="row">
    <div class="col-md-8">
        <h3>Edit Siswa</h3>
        <form method="POST">
            <div class="form-group">
                <label>Nama Siswa</label>
                <input type="text" name="Nm_siswa" class="form-control" value="<?php echo $data['Nm_siswa']; ?>" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="Jenkel" class="form-control">
                    <option value="Laki-laki" <?php if($data['Jenkel'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if($data['Jenkel'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="Hp" class="form-control" value="<?php echo $data['Hp']; ?>">
            </div>
            <div class="form-group">
                <label>Kelas</label>
                <select name="Id_kelas" class="form-control" required>
                    <?php
                    $kls = mysqli_query($koneksi, "SELECT * FROM kelas");
                    while($k = mysqli_fetch_array($kls)){
                        $select = ($k['Id_kelas'] == $data['Id_kelas']) ? 'selected' : '';
                        echo "<option value='$k[Id_kelas]' $select>$k[Nm_kelas]</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
            <a href="index.php?page=siswa" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $nm  = mysqli_real_escape_string($koneksi, $_POST['Nm_siswa']);
    $jk  = $_POST['Jenkel'];
    $hp  = mysqli_real_escape_string($koneksi, $_POST['Hp']);
    $idk = $_POST['Id_kelas'];

    $update = mysqli_query($koneksi, "UPDATE siswa SET Nm_siswa='$nm', Jenkel='$jk', Hp='$hp', Id_kelas='$idk' WHERE Nis='$id'");
    if ($update) {
        echo "<script>alert('Data Berhasil Diperbarui'); window.location.href='index.php?page=siswa';</script>";
    }
}
?>