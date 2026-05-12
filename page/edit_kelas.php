<?php
$id_get = $_GET['id'];
$ambilData = mysqli_query($koneksi, "SELECT * FROM kelas WHERE Id_kelas = '$id_get'");
$data = mysqli_fetch_array($ambilData);

if (isset($_POST['update'])) {
    $nama = $_POST['Nm_kelas'];
    
    $update = mysqli_query($koneksi, "UPDATE kelas SET Nm_kelas = '$nama' WHERE Id_kelas = '$id_get'");
    
    if ($update) {
        echo "<script>alert('Data Berhasil Diperbarui'); window.location.href='index.php?page=kelas';</script>";
    } else {
        echo "<script>alert('Gagal Memperbarui Data');</script>";
    }
}
?>

<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Data Kelas</h3>
    </div>
    <form method="POST">
        <div class="card-body">
            <div class="form-group">
                <label>ID Kelas (Tidak dapat diubah)</label>
                <input type="text" class="form-control" value="<?php echo $data['Id_kelas']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Nama Kelas</label>
                <input type="text" name="Nm_kelas" class="form-control" value="<?php echo $data['Nm_kelas']; ?>" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="update" class="btn btn-warning">Update</button>
            <a href="index.php?page=kelas" class="btn btn-default">Batal</a>
        </div>
    </form>
</div>