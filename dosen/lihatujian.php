<?php

include '../koneksi.php';

session_start();

$id_dosen = $_SESSION['id_dosen'];

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

$id_ujian = $_GET['id_ujian'];
$id_dosen = $_SESSION['id_dosen'];

$query = mysqli_query($koneksi, "SELECT 
        u.*,
        mk.nama_221053 as nama_matkul,
        mk.kode_221053 as kode_matkul
    FROM ujian_221053 u
    JOIN mata_kuliah_221053 mk ON u.mata_kuliah_id_221053 = mk.id_221053
    WHERE u.id_221053 = '$id_ujian' AND mk.id_dosen_221053 = '$id_dosen'
");

$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
    // Mengambil data dari form
    $nama_ujian = $_POST['judul_221053'];
    $mata_kuliah_id = $_POST['mata_kuliah_id_221053'];
    $waktu_mulai = $_POST['waktu_mulai_221053'];
    $waktu_selesai = $_POST['waktu_selesai_221053'];
    $status = $_POST['status_221053'];


    // Menyimpan data ke database
    $simpan = mysqli_query($koneksi, "INSERT INTO ujian_221053 (judul_221053, mata_kuliah_id_221053, waktu_mulai_221053, waktu_selesai_221053, status_221053) VALUES ('$nama_ujian', '$mata_kuliah_id', '$waktu_mulai', '$waktu_selesai', '$status')");

    if ($simpan) {
        echo "<script>
                alert('Simpan data sukses!');
                document.location='ujian.php';
            </script>";
    } else {
        echo "<script>
                alert('Simpan data Gagal!');
                document.location='ujian.php';
            </script>";
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
            <h1 class="mt-4">Detail Ujian</h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-alt me-1"></i>
                    Informasi Ujian
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">Mata Kuliah</div>
                        <div class="col-md-9">: <?= $data['kode_matkul'] ?> - <?= $data['nama_matkul'] ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">Judul Ujian</div>
                        <div class="col-md-9">: <?= $data['judul_221053'] ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">Waktu Mulai</div>
                        <div class="col-md-9">: <?= date('d/m/Y H:i', strtotime($data['waktu_mulai_221053'])) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">Waktu Selesai</div>
                        <div class="col-md-9">: <?= date('d/m/Y H:i', strtotime($data['waktu_selesai_221053'])) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">Status</div>
                        <div class="col-md-9">: 
                            <?php 
                            switch($data['status_221053']) {
                                case 'nonaktif':
                                    echo '<span class="badge bg-warning">Nonaktif</span>';
                                    break;
                                case 'aktif':
                                    echo '<span class="badge bg-success">Aktif</span>';
                                    break;
                                case 'selesai':
                                    echo '<span class="badge bg-secondary">Selesai</span>';
                                    break;
                            }
                            ?>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="editujian.php?hal=edit&id=<?= $id_ujian ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Ujian
                        </a>
                        <a class="btn btn-primary" href="soal.php?ujian_id=<?= $data['id_221053']?>">Lihat Soal</a>
                        <?php if($data['status_221053'] == 'nonaktif'): ?>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#publishModal">
                            <i class="fas fa-check"></i> Publish Ujian
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash"></i> Hapus Ujian
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="publishModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Publish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mempublish ujian ini? Setelah dipublish, ujian tidak dapat diedit lagi.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="proses_ujian.php" method="POST">
                        <input type="hidden" name="action" value="publish">
                        <input type="hidden" name="id_ujian" value="<?= $id_ujian ?>">
                        <button type="submit" class="btn btn-success">Ya, Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus ujian ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="proses_ujian.php" method="POST">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id_ujian" value="<?= $id_ujian ?>">
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
