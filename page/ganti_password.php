<?php
if(isset($_POST["tambah"])) {
    $pl = $_POST['pl'];
    $pb = $_POST['pb'];
    $Username = $_SESSION['Username'];
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE Username = '$Username' AND Password = '$pl'");
    
    if(mysqli_num_rows($cek) > 0) {
        $update = mysqli_query($koneksi, "UPDATE users SET Password = '$pb' WHERE Username = '$Username'");
        if($update) {
            echo "<script>
                    alert('Password berhasil diganti. Silakan login kembali.');
                    window.location.href='logout.php';
                  </script>";
        }
    } else {
        echo "<script>alert('Password lama Anda salah!');</script>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ganti Password</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Form Perubahan Password</h3>
                    </div>
                    <form method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" name="pl" class="form-control" placeholder="Masukkan password saat ini" required>
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="pb" class="form-control" placeholder="Masukkan password baru" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="tambah" class="btn btn-primary">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>