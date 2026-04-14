<div class="row">
    <div class="col-md-6">
        <h3>Tambah Data Kelas</h3>
        <form method="POST">
            <div class="form-group">
                <label>Nama Kelas</label>
                <input type="text" name="Nm_kelas" class="form-control" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="index.php?page=kelas" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['Nm_kelas'];
    $insert = mysqli_query($koneksi, "INSERT INTO kelas (Nm_kelas) VALUES ('$nama')");
    if ($insert) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href='index.php?page=kelas';</script>";
    }
}
?>