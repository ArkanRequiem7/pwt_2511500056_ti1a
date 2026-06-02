<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['Nm_kelas'];
    $input = mysqli_query($koneksi, "INSERT INTO kelas (Nm_kelas) VALUES ('$nama')");
    
    if ($input) {
        echo "<script>alert('Data Berhasil Disimpan'); window.location.href='index.php?page=kelas';</script>";
    } else {
        echo "<script>alert('Gagal Menyimpan Data. Error: " . mysqli_error($koneksi) . "');</script>";
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