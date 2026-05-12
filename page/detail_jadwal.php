<?php
$id_k = $_GET['id_kelas'];
$thn  = $_GET['thn'];
$sem  = $_GET['sem'];
$inf  = mysqli_fetch_array(mysqli_query($koneksi, "SELECT Nm_kelas FROM kelas WHERE Id_kelas='$id_k'"));
?>

<div class="content mt-3">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title">Detail Jadwal: <?= $inf['Nm_kelas']; ?> (<?= $thn; ?>)</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-light text-center">
                        <tr>
                            <th>Kode</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($koneksi, "SELECT j.*, m.nm_mapel, g.Nm_guru 
                                                       FROM jadwal j 
                                                       JOIN mapel m ON j.kd_mapel=m.kd_mapel 
                                                       JOIN guru g ON j.kd_guru=g.Kd_guru 
                                                       WHERE j.id_kelas='$id_k' AND j.thn_ajaran='$thn' AND j.semester='$sem'");
                        while($row = mysqli_fetch_array($res)){
                        ?>
                        <tr>
                            <td class="text-center"><?= $row['kd_mapel']; ?></td>
                            <td><?= $row['nm_mapel']; ?></td>
                            <td><?= $row['Nm_guru']; ?></td>
                            <td><?= $row['hari']; ?>, <?= $row['jam']; ?></td>
                            <td class="text-center">
                                <a href="index.php?page=tambah_jadwal&id=<?= $row['id_jadwal']; ?>" class="text-warning mr-2" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?page=hapus_jadwal&id=<?= $row['id_jadwal']; ?>&aksi=hapus_item" class="text-danger" onclick="return confirm('Hapus item ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="index.php?page=jadwal" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>
