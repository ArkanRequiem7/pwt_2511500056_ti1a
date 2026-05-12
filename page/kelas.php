<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kelas</h3>
        <div class="card-tools">
            <a href="index.php?page=tambah_kelas" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kelas
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Kelas</th>
                    <th>Nama Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY Id_kelas ASC");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['Id_kelas']; ?></td>
                    <td><?php echo $data['Nm_kelas']; ?></td>
                    <td>
                        <a href="index.php?page=edit_kelas&id=<?php echo $data['Id_kelas']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="page/hapus_kelas.php?id=<?php echo $data['Id_kelas']; ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Yakin ingin menghapus kelas ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>