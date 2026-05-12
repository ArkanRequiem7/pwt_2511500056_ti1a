<?php
include "../config/koneksi.php";

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM kelas WHERE Id_kelas = '$id'");

if ($hapus) {
    echo "<script>alert('Data Berhasil Dihapus'); window.location.href='../index.php?page=kelas';</script>";
} else {
    echo "<script>alert('Gagal Menghapus Data'); window.location.href='../index.php?page=kelas';</script>";
}
?>