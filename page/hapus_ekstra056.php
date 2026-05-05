<?php
include "../config/koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM Ekstra_056 WHERE id_ekstra056='$id'");

if($query){
    echo "<script>alert('Data Terhapus, Nice'); window.location.href='../index.php?page=ekstra056';</script>";
} else {
    echo "<script>alert('Gagal menghapus data, Waduh'); window.location.href='../index.php?page=ekstra056';</script>";
}
?>