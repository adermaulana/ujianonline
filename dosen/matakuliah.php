<?php

include '../koneksi.php';

session_start();

$id_dosen = $_SESSION['id_dosen'];

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

$soal = "SELECT COUNT(*) as id_221053 FROM soal_ujian_221053";
$resultsoal = $koneksi->query($soal);
$rowsoal = $resultsoal->fetch_assoc();
$jumlah_soal = $rowsoal["id_221053"];


//get semua dosen
$dosen = "SELECT COUNT(*) as id_221053 FROM users_221053 WHERE role_221053 = 'dosen'";
$resultdosen = $koneksi->query($dosen);
$rowdosen = $resultdosen->fetch_assoc();
$jumlah_dosen = $rowdosen["id_221053"];

//get semua mahasiswa
$mahasiswa = "SELECT COUNT(*) as id_221053 FROM users_221053 WHERE role_221053 = 'mahasiswa'";
$resultmahasiswa = $koneksi->query($mahasiswa);
$rowmahasiswa = $resultmahasiswa->fetch_assoc();
$jumlah_mahasiswa = $rowmahasiswa["id_221053"];

//get semua mata kuliah
$matakuliah = "SELECT COUNT(*) as id_221053 FROM mata_kuliah_221053";
$resultmatakuliah = $koneksi->query($matakuliah);
$rowmatakuliah = $resultmatakuliah->fetch_assoc();
$jumlah_matakuliah = $rowmatakuliah["id_221053"];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Dosen</title>
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
                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data Ujian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="ujian.php">Lihat Ujian</a>
                                    <a class="nav-link" href="tambahujian.php">Tambah Ujian</a>
                                </nav>
                            </div> -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#matkul" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data Mata Kuliah
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="matkul" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="matakuliah.php">Lihat Mata Kuliah</a>
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
                        <h1 class="mt-4">Data Mata Kuliah</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Matakuliah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Matakuliah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        $tampil = mysqli_query($koneksi, "SELECT 
                                            mk.id_221053,
                                            mk.kode_221053, 
                                            mk.nama_221053,
                                            u.nama_221053 as nama_dosen,
                                            uj.id_221053 as id_ujian,
                                            uj.status_221053 as status_ujian
                                        FROM mata_kuliah_221053 mk
                                        JOIN users_221053 u ON mk.id_dosen_221053 = u.id_221053
                                        LEFT JOIN ujian_221053 uj ON mk.id_221053 = uj.mata_kuliah_id_221053
                                        WHERE mk.id_dosen_221053 = '$id_dosen' AND u.role_221053 = 'dosen'
                                        ");
                                        while($data = mysqli_fetch_array($tampil)):
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['kode_221053'] ?></td>
                                        <td><?= $data['nama_221053'] ?></td>
                                        <td>
                                            <a class="btn btn-info" href="lihat_mahasiswa_matkul.php?id_matkul=<?= $data['id_221053'] ?>">Lihat Mahasiswa</a>
                                        <?php if($data['id_ujian']): ?>
                                            <a class="btn btn-primary" href="lihatujian.php?id_ujian=<?= $data['id_ujian'] ?>">Lihat Ujian</a>
                                        <?php else: ?>
                                            <a class="btn btn-success" href="tambahujian.php?id_matkul=<?= $data['id_221053'] ?>">Tambah Ujian</a>
                                        <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php
                                        endwhile; 
                                    ?>
                                </tbody>
                            </table>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/datatables-simple-demo.js"></script>
    </body>
</html>
