<?php
if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $ket = $_POST['ket'];
    $sem = $_POST['semester'];
    $thn = $_POST['tahun'];
    $input = mysqli_query($koneksi, "INSERT INTO Ekstra_056 VALUES('$id', '$nama', '$ket', '$sem', '$thn')");
    if($input){
        echo "<script>alert('Data Tersimpan Gokillll'); window.location.href='index.php?page=ekstra056';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data, Kenapa ya');</script>";
    }
}
?>
<form method="POST">
    <div class="form-group">
        <label>ID Ekstra</label>
        <input type="text" name="id" class="form-control" placeholder="Contoh: E001" required>
    </div>
    <div class="form-group">
        <label>Nama Ekstra</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="ket" class="form-control">
    </div>
    <div class="form-group">
        <label>Semester</label>
        <select name="semester" class="form-control">
            <option value="1">1 (Ganjil)</option>
            <option value="2">2 (Genap)</option>
        </select>
    </div>
    <div class="form-group">
        <label>Tahun Ajaran</label>
        <select name="tahun" class="form-control">
            <option value="2024/2025">2024/2025</option>
            <option value="2025/2026">2025/2026</option>
        </select>
    </div>
    <button type="submit" name="simpan" class="btn btn-success">Simpan Data</button>
    <a href="index.php?page=ekstra056" class="btn btn-secondary">Batal</a>
</form>