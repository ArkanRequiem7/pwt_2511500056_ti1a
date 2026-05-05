<?php
  session_start();
  require_once("config/koneksi.php");
  $current_page = isset($_GET['page']) ? $_GET['page'] : '';
  
  if(isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    $Username = $_SESSION['Username'];
    $cekUser = mysqli_query($koneksi, "SELECT Password FROM users WHERE Username = '$Username'");
    $dataUser = mysqli_fetch_array($cekUser);
    if ($dataUser['Password'] == '1234' && $current_page != 'ganti_password' && $current_page != 'logout') {
        echo "<script>
                alert('Anda masih menggunakan password default tuh. Silakan ganti password Anda terlebih dahulu yaaa~ ');
                window.location.href='index.php?page=ganti_password';
              </script>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['Username']; ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item <?php echo in_array($current_page, ['guru', 'siswa', 'mapel', 'kelas', 'ekstra056', 'tambah_guru', 'edit_guru', 'tambah_siswa', 'edit_siswa', 'tambah_kelas', 'edit_kelas', 'tambah_ekstra056', 'edit_ekstra056']) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-database"></i>
              <p> Master <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($role == 'admin' || $role == 'guru') : ?>
              <li class="nav-item">
                <a href="index.php?page=guru" class="nav-link <?php echo ($current_page == 'guru' || $current_page == 'tambah_guru' || $current_page == 'edit_guru') ? 'active' : ''; ?>">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>Guru</p>
                </a>
              </li>
              <?php endif; ?>

              <?php if ($role == 'admin' || $role == 'siswa') : ?>
              <li class="nav-item">
                <a href="index.php?page=siswa" class="nav-link <?php echo ($current_page == 'siswa' || $current_page == 'tambah_siswa' || $current_page == 'edit_siswa') ? 'active' : ''; ?>">
                  <i class="fas fa-user-graduate nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              <?php endif; ?>

              <?php if ($role == 'admin') : ?>
              <li class="nav-item">
                <a href="index.php?page=mapel" class="nav-link <?php echo ($current_page == 'mapel') ? 'active' : ''; ?>">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Mata Pelajaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=ekstra056" class="nav-link <?php echo ($current_page == 'ekstra056' || $current_page == 'tambah_ekstra056' || $current_page == 'edit_ekstra056') ? 'active' : ''; ?>">
                  <i class="fas fa-running nav-icon"></i>
                  <p>Ekstrakurikuler</p>
                </a>
              </li>
              <?php endif; ?>

              <?php if ($role == 'admin' || $role == 'guru') : ?>
              <li class="nav-item">
                <a href="index.php?page=kelas" class="nav-link <?php echo ($current_page == 'kelas' || $current_page == 'tambah_kelas' || $current_page == 'edit_kelas') ? 'active' : ''; ?>">
                  <i class="fas fa-school nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>

          <li class="nav-item <?php echo ($current_page == 'jadwal') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p> Transaksi <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=jadwal" class="nav-link <?php echo ($current_page == 'jadwal') ? 'active' : ''; ?>">
                  <i class="fas fa-calendar-alt nav-icon"></i>
                  <p>Jadwal</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="logout.php" class="nav-link text-danger">
              <i class="nav-icon fas fa-power-off"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Halaman Utama</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title mb-3">Konten Dinamis</h5>
                <div class="card-text">
                  <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : "";
                    if ($page == "") {
                      include "page/dashboard.php";
                    } elseif (!file_exists("page/$page.php")) {
                      echo "<div class='alert alert-danger'>File page/$page.php Tidak Ditemukan</div>";
                    } else {
                      include "page/$page.php";
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2026</strong> All rights reserved.
  </footer>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
<?php
  } else {
    echo"<meta http-equiv='refresh' content='0; url=login.php'>";
  }
?>