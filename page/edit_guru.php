<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE Kd_guru='$id'");
$data = mysqli_fetch_array($query);
?>

<div class="row">
    <div class="col-md-8">
        <h3>Edit Guru</h3>
        <form method="POST">
            <div class="form-group">
                <label>Nama Guru</label>
                <input type="text" name="Nm_guru" class="form-control" value="<?php echo $data['Nm_guru']; ?>" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="Jenkel" class="form-control">
                    <option value="Laki-laki" <?php if($data['Jenkel'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if($data['Jenkel'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
                <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <select name="Pend_terakhir" class="form-control" required>
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="Strata 2">Strata 2</option>
                    <option value="Strata 1">Strata 1</option>
                    <option value="Diploma 3">Diploma 3</option>
                    <option value="SMA Sederajat">SMA Sederajat</option>
                </select>
            </div>
            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="Hp" class="form-control" value="<?php echo $data['Hp']; ?>">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="Alamat" class="form-control" rows="3"><?php echo $data['Alamat']; ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
            <a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $nm = mysqli_real_escape_string($koneksi, $_POST['Nm_guru']);
    $jk = $_POST['Jenkel'];
    $pt = mysqli_real_escape_string($koneksi, $_POST['Pend_terakhir']);
    $hp = mysqli_real_escape_string($koneksi, $_POST['Hp']);
    $al = mysqli_real_escape_string($koneksi, $_POST['Alamat']);

    $update = mysqli_query($koneksi, "UPDATE guru SET Nm_guru='$nm', Jenkel='$jk', Pend_terakhir='$pt', Hp='$hp', Alamat='$al' WHERE Kd_guru='$id'");
    
    if ($update) {
        echo "<script>alert('Data Berhasil Diperbarui'); window.location.href='index.php?page=guru';</script>";
    }
}
?>