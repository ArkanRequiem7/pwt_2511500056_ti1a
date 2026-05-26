<?php
$role = $_SESSION['role'];
$id_k = $_GET['id_kelas'];
$thn  = $_GET['thn'];
$sem  = $_GET['sem'];
$query_info = mysqli_query($koneksi, "SELECT Nm_kelas FROM kelas WHERE Id_kelas='$id_k'");
$inf = mysqli_fetch_array($query_info);
?>

<div class="content mt-3">
    <div class="container-fluid">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    Detail Jadwal: <strong><?= $inf['Nm_kelas']; ?></strong> 
                    <span class="badge badge-secondary ml-2">TA: <?= $thn; ?></span>
                    <span class="badge badge-primary"><?= $sem; ?></span>
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=jadwal" class="btn btn-tool">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru Pengampu</th>
                            <th class="text-center">Hari</th>
                            <th class="text-center">Waktu (Mulai - Selesai)</th>
                            <?php if ($role == 'admin') : ?>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = "SELECT j.*, m.nm_mapel, g.Nm_guru 
                                FROM jadwal j 
                                JOIN mapel m ON j.kd_mapel = m.kd_mapel 
                                JOIN guru g ON j.kd_guru = g.Kd_guru 
                                WHERE j.id_kelas = '$id_k' 
                                AND j.thn_ajaran = '$thn' 
                                AND j.semester = '$sem'
                                ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'), jam_mulai ASC";
                        
                        $res = mysqli_query($koneksi, $sql);
                        
                        if(mysqli_num_rows($res) > 0) {
                            while($row = mysqli_fetch_array($res)){ 
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td>
                                <strong><?= $row['nm_mapel']; ?></strong><br>
                                <small class="text-muted">Kode: <?= $row['kd_mapel']; ?></small>
                            </td>
                            <td><?= $row['Nm_guru']; ?></td>
                            <td class="text-center">
                                <span class="badge badge-info"><?= $row['hari']; ?></span>
                            </td>
                            <td class="text-center">
                                <i class="far fa-clock"></i> 
                                <?= date('H:i', strtotime($row['jam_mulai'])); ?> - <?= date('H:i', strtotime($row['jam_selesai'])); ?>
                            </td>
                            <?php if ($role == 'admin') : ?>
                                <td class="text-center">
                                    <a href="index.php?page=tambah_jadwal&id=<?= $row['id_jadwal']; ?>" 
                                       class="btn btn-sm btn-warning" title="Edit Data">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=hapus_jadwal&id=<?= $row['id_jadwal']; ?>&aksi=hapus_item" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini dari jadwal?')" 
                                       title="Hapus Data">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php 
                            } 
                        } else {
                            $colspan = ($role == 'admin') ? 6 : 5;
                            echo "<tr><td colspan='$colspan' class='text-center py-4 text-muted'>Belum ada data jadwal untuk kelas ini.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white text-right">
                <p class="text-muted small mb-0">Total: <?= ($no-1); ?> Mata Pelajaran ditemukan</p>
            </div>
        </div>
    </div>
</div>