<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

if (isset($_POST['simpan'])) {
    // Check if email already exists
    $username = $_POST['username'];
    $checkUsername = mysqli_query($koneksi, "SELECT * FROM users_221053 WHERE username_221053='$username'");

    if (mysqli_num_rows($checkUsername) > 0) {
        echo "<script>
                alert('User sudah terdaftar!');
                document.location='tambahmahasiswa.php';
              </script>";
    } else {
        // Hash the password using md5
        $hashedPassword = md5($_POST['password']);
        $active = true;
        // Insert new user into the database
        $simpan = mysqli_query($koneksi, "INSERT INTO users_221053 (nama_221053, username_221053, password_221053,active_221053, role_221053) VALUES ('$_POST[name]', '$username', '$hashedPassword','$active','$_POST[role]')");

        if ($simpan) {
            echo "<script>
                    alert('Simpan data sukses!');
                    document.location='mahasiswa.php';
                </script>";
        } else {
            echo "<script>
                    alert('Simpan data Gagal!');
                    document.location='mahasiswa.php';
                </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="../assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Data Soal</span>
                            </a>
                            <ul class="submenu ">

                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Data Ujian</span>
                            </a>
                            <ul class="submenu ">

                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Data Mahasiswa</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="mahasiswa.php">Lihat Mahasiswa</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="tambahmahasiswa.php">Tambah Mahasiswa</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="logout.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Tambah Mahasiswa</h3>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <form  method="POST"> <!-- Update the action URL as needed -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nameInput">Nama</label>
                                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Masukkan nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="usernameInput">Username</label>
                                            <input type="text" class="form-control" id="usernameInput" name="username" placeholder="Masukkan username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="passwordInput">Password</label>
                                            <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Masukkan password" required>
                                        </div>
                                        <input type="hidden" name="role" value="mahasiswa">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </section>

            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../assets/js/pages/dashboard.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>