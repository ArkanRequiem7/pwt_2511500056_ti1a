<?php
if ($_SESSION['role'] != 'admin') {
    echo "<script>
            alert('Akses Ditolak! Anda tidak memiliki izin untuk menghapus jadwal.'); 
            window.location='index.php?page=jadwal';
          </script>";
    exit;
}

if(isset($_GET['aksi'])){
    if($_GET['aksi'] == "hapus_item"){
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_jadwal = '$id'");
    } elseif($_GET['aksi'] == "hapus_grup"){
        $id_k = $_GET['id_kelas'];
        $query = mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_kelas = '$id_k'");
    }

    if($query){
        echo "<script>alert('Data terhapus!'); window.location='index.php?page=jadwal';</script>";
    } else {
        echo "<script>alert('Gagal!'); window.location='index.php?page=jadwal';</script>";
    }
}
?>