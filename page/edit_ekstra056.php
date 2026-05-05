<?php
$id_edit = $_GET['id'];
$query_lama = mysqli_query($koneksi, "SELECT * FROM Ekstra_056 WHERE id_ekstra056 = '$id_edit'");
$data = mysqli_fetch_array($query_lama);
if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $ket  = $_POST['ket'];
    $sem  = $_POST['semester'];
    $thn  = $_POST['tahun'];
    $update = mysqli_query($koneksi, "UPDATE Ekstra_056 SET 
                nama_ekstra056 = '$nama', 
                ket056 = '$ket', 
                semester056 = '$sem', 
                thn_ajaran056 = '$thn' 
              WHERE id_ekstra056 = '$id_edit'");

    if($update){
        echo "<script>alert('Data Berhasil Diupdate yahahaha'); window.location.href='index.php?page=ekstra056';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data kasihan');</script>";
    }
}
?>

<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Data Ekstrakurikuler</h3>
    </div>
    <form method="POST">
        <div class="card-body">
            <div class="form-group">
                <label>ID Ekstra (Tidak dapat diubah)</label>
                <input type="text" class="form-control" value="<?= $data['id_ekstra056']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Nama Ekstra</label>
                <input type="text" name="nama" class="form-control" value="<?= $data['nama_ekstra056']; ?>" required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="ket" class="form-control" value="<?= $data['ket056']; ?>">
            </div>
            <div class="form-group">
                <label>Semester</label>
                <select name="semester" class="form-control">
                    <option value="1" <?= ($data['semester056'] == '1') ? 'selected' : ''; ?>>1 (Ganjil)</option>
                    <option value="2" <?= ($data['semester056'] == '2') ? 'selected' : ''; ?>>2 (Genap)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tahun Ajaran</label>
                <select name="tahun" class="form-control">
                    <option value="2025" <?= ($data['thn_ajaran056'] == '2025') ? 'selected' : ''; ?>>2025</option>
                    <option value="2026" <?= ($data['thn_ajaran056'] == '2026') ? 'selected' : ''; ?>>2026</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="update" class="btn btn-warning">Update Data</button>
            <a href="index.php?page=ekstra056" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>