<div class="row">
    <div class="col-12">
        <h3 class="mb-3">Data Kelas</h3>
        <a href="index.php?page=tambah_kelas" class="btn btn-primary mb-3">Tambah Kelas</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Kelas</th>
                    <th>Nama Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $data['Id_kelas']; ?></td>
                    <td><?php echo $data['Nm_kelas']; ?></td>
                    <td>
                        <a href="index.php?page=edit_kelas&id=<?php echo $data['Id_kelas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?page=kelas&hapus=<?php echo $data['Id_kelas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Logika Hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $delete = mysqli_query($koneksi, "DELETE FROM kelas WHERE Id_kelas='$id'");
    if ($delete) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='index.php?page=kelas';</script>";
    }
}
?>