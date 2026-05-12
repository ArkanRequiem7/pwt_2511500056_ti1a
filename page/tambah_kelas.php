<?php
if (isset($_POST['simpan'])) {
    $id = $_POST['Id_kelas'];
    $nama = $_POST['Nm_kelas'];
    
    $input = mysqli_query($koneksi, "INSERT INTO kelas (Id_kelas, Nm_kelas) VALUES ('$id', '$nama')");
    
    if ($input) {
        echo "<script>alert('Data Berhasil Disimpan'); window.location.href='index.php?page=kelas';</script>";
    } else {
        echo "<script>alert('Gagal Menyimpan Data');</script>";
    }
}
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Kelas</h3>
    </div>
    <form method="POST">
        <div class="card-body">
            <div class="form-group">
                <label>ID Kelas</label>
                <input type="text" name="Id_kelas" class="form-control" placeholder="Contoh: 4" required>
            </div>
            <div class="form-group">
                <label>Nama Kelas</label>
                <input type="text" name="Nm_kelas" class="form-control" placeholder="Masukkan Nama Kelas" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=kelas" class="btn btn-default">Kembali</a>
        </div>
    </form>
</div>