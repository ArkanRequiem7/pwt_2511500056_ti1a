<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE Id_kelas='$id'");
$data = mysqli_fetch_array($query);
?>

<div class="row">
    <div class="col-md-6">
        <h3>Edit Data Kelas</h3>
        <form method="POST">
            <div class="form-group">
                <label>Nama Kelas</label>
                <input type="text" name="Nm_kelas" class="form-control" value="<?php echo $data['Nm_kelas']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
            <a href="index.php?page=kelas" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['Nm_kelas'];
    $update = mysqli_query($koneksi, "UPDATE kelas SET Nm_kelas='$nama' WHERE Id_kelas='$id'");
    if ($update) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='index.php?page=kelas';</script>";
    }
}
?>