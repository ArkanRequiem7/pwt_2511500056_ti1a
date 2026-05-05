<a href="index.php?page=tambah_ekstra056" class="btn btn-primary mb-3">Tambah Data</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Ekstrakurikuler</th>
            <th>Keterangan</th>
            <th>Semester</th>
            <th>Tahun Ajaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM Ekstra_056");
        while($d = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?= $d['id_ekstra056']; ?></td>
            <td><?= $d['nama_ekstra056']; ?></td>
            <td><?= $d['ket056']; ?></td>
            <td><?= $d['semester056']; ?></td>
            <td><?= $d['thn_ajaran056']; ?></td>
            <td>
                <a href="index.php?page=edit_ekstra056&id=<?= $d['id_ekstra056']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="page/hapus_ekstra056.php?id=<?= $d['id_ekstra056']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>