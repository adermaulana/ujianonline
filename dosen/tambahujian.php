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
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Dosen</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Soal
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="soal.php">Lihat Soal</a>
                                    <a class="nav-link" href="tambahsoal.php">Tambah Soal</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data Ujian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="ujian.php">Lihat Ujian</a>
                                    <a class="nav-link" href="tambahujian.php">Tambah Ujian</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mahasiswa" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data Mahasiswa
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="mahasiswa" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="mahasiswa.php">Lihat Mahasiswa</a>
                                    <a class="nav-link" href="tambahmahasiswa.php">Tambah Mahasiswa</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Ujian</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                            <form action="/path/to/submit" method="POST">
                                <!-- Pilih Ujian -->

                                <div class="mb-3 col-6">
                                    <label for="opsi_a_221053" class="form-label">Nama Ujian</label>
                                    <input type="text" class="form-control" id="opsi_a_221053" name="opsi_a_221053" required>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="ujian_id_221053" class="form-label">Mata Kuliah</label>
                                    <select class="form-control" id="ujian_id_221053" name="ujian_id_221053" required>
                                        <option disabled selected>Pilih Matkul</option>
                                        <option value="1">Web Development</option>
                                        <option value="2">Statistika</option>
                                    </select>
                                </div>


                                <!-- Opsi Jawaban A -->
                                <div class="mb-3 col-6">
                                    <label for="opsi_a_221053" class="form-label">Waktu Mulai</label>
                                    <input type="date" class="form-control" id="opsi_a_221053" name="opsi_a_221053" required>
                                </div>

                                <!-- Opsi Jawaban B -->
                                <div class="mb-3 col-6">
                                    <label for="opsi_b_221053" class="form-label">Waktu Selesai</label>
                                    <input type="date" class="form-control" id="opsi_b_221053" name="opsi_b_221053" required>
                                </div>

                                <!-- Opsi Jawaban C -->
                                <div class="mb-3 col-6">
                                    <label for="ujian_id_221053" class="form-label">Status</label>
                                    <select class="form-control" id="ujian_id_221053" name="ujian_id_221053" required>
                                        <option disabled selected>Pilih Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="2">Nonaktif</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="ujian_id_221053" class="form-label">Mahasiswa Yang Ikut</label>
                                    <select class="form-control" id="ujian_id_221053" name="ujian_id_221053" required>
                                        <option disabled selected>Pilih Mahasiswa</option>
                                        <option value="1">Udin</option>
                                        <option value="2">Martin</option>
                                    </select>
                                </div>


                                <button type="submit" class="btn btn-primary">Tambah Ujian</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/datatables-simple-demo.js"></script>
    </body>
</html>