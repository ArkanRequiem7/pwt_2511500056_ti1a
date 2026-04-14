<div class="row">
    <div class="col-12">
        <h3 class="mb-3">Data Siswa</h3>
        <a href="index.php?page=tambah_siswa" class="btn btn-primary mb-3">Tambah Siswa</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>L/P</th>
                    <th>HP</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                // Query JOIN untuk mengambil nama kelas dari tabel kelas
                $query = mysqli_query($koneksi, "SELECT siswa.*, kelas.Nm_kelas FROM siswa 
                                                 LEFT JOIN kelas ON siswa.Id_kelas = kelas.Id_kelas");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['Nis']; ?></td>
                    <td><?php echo $data['Nm_siswa']; ?></td>
                    <td><?php echo $data['Jenkel']; ?></td>
                    <td><?php echo $data['Hp']; ?></td>
                    <td><?php echo $data['Nm_kelas']; ?></td>
                    <td>
                        <a href="index.php?page=edit_siswa&id=<?php echo $data['Nis']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?page=siswa&hapus=<?php echo $data['Nis']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM siswa WHERE Nis='$id'");
    mysqli_query($koneksi, "DELETE FROM user WHERE Username='$id'");
    echo "<script>alert('Data Berhasil Dihapus'); window.location.href='index.php?page=siswa';</script>";
}
?>