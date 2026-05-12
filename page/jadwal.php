<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal Pelajaran</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm mb-3">
                    <i class="fas fa-plus"></i> Tambah Jadwal Baru
                </a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Query dikelompokkan agar perubahan pada detail langsung merefleksikan grup ini
                        $query = mysqli_query($koneksi, "SELECT j.id_kelas, k.Nm_kelas, j.thn_ajaran, j.semester 
                                                         FROM jadwal j 
                                                         JOIN kelas k ON j.id_kelas = k.Id_kelas 
                                                         GROUP BY j.id_kelas, j.thn_ajaran, j.semester
                                                         ORDER BY j.thn_ajaran DESC, k.Nm_kelas ASC");
                        
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $data['Nm_kelas']; ?></td>
                            <td class="text-center"><?= $data['thn_ajaran']; ?></td>
                            <td class="text-center">
                                <span class="badge badge-info"><?= $data['semester']; ?></span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?page=detail_jadwal&id_kelas=<?= $data['id_kelas']; ?>&thn=<?= $data['thn_ajaran']; ?>&sem=<?= $data['semester']; ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="index.php?page=hapus_jadwal&id_kelas=<?= $data['id_kelas']; ?>&aksi=hapus_grup" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus seluruh jadwal untuk grup ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>