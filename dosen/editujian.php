<?php

include '../koneksi.php';

session_start();

$id_dosen = $_SESSION['id_dosen'];

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

if(isset($_GET['hal'])){
    if($_GET['hal'] == "edit"){
        $tampil = mysqli_query($koneksi, "SELECT * FROM ujian_221053 WHERE id_221053 = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data){
            $id = $data['id_221053'];
            $nama_ujian = $data['judul_221053'];
            $mata_kuliah_id = $data['mata_kuliah_id_221053'];
            $waktu_mulai = $data['waktu_mulai_221053'];
            $waktu_selesai = $data['waktu_selesai_221053'];
            $status = $data['status_221053'];
            $users_id = $data['users_id_221053'];
        }
    }
}

//Perintah Mengubah Data
if (isset($_POST['simpan'])) {
    // Mengambil data dari form
    $nama_ujian = $_POST['judul_221053'];
    $mata_kuliah_id = $_POST['mata_kuliah_id_221053'];
    $waktu_mulai = $_POST['waktu_mulai_221053'];
    $waktu_selesai = $_POST['waktu_selesai_221053'];
    $status = $_POST['status_221053'];
    $users_id = $_POST['users_id_221053'];

    // Menyimpan data ke database
    $simpan = mysqli_query($koneksi, "UPDATE ujian_221053 SET
                                        judul_221053 = '$nama_ujian',
                                        mata_kuliah_id_221053 = '$mata_kuliah_id',
                                        waktu_mulai_221053 = '$waktu_mulai',
                                        waktu_selesai_221053 = '$waktu_selesai',
                                        status_221053 = '$status',
                                        users_id_221053 = '$users_id' 
                                        WHERE id_221053 = '$_GET[id]'");

    if ($simpan) {
        echo "<script>
                alert('Edit data sukses!');
                document.location='ujian.php';
            </script>";
    } else {
        echo "<script>
                alert('Edit data Gagal!');
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
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mahasiswa" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data Mahasiswa
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="mahasiswa" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="mahasiswa.php">Lihat Mahasiswa</a>
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
                        <h1 class="mt-4">Edit Ujian</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                            <form  method="POST">
                                <!-- Pilih Ujian -->

                                <div class="mb-3 col-6">
                                    <label for="judul_221053" class="form-label">Nama Ujian</label>
                                    <input type="text" class="form-control" id="judul_221053" value="<?= $nama_ujian ?>" name="judul_221053" required>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="mata_kuliah_id_221053" class="form-label">Mata Kuliah</label>
                                    <select class="form-control" id="mata_kuliah_id_221053" name="mata_kuliah_id_221053" required>
                                        <option disabled selected>Pilih Matkul</option>
                                        <?php
                                            $tampil = mysqli_query($koneksi, "SELECT * FROM mata_kuliah_221053");
                                            while ($data = mysqli_fetch_array($tampil)):
                                                // Menandai opsi yang sesuai dengan mata kuliah yang sudah dipilih
                                                $selected = ($data['id_221053'] == $mata_kuliah_id) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $data['id_221053'] ?>" <?= $selected ?>><?= $data['kode_221053'] ?> - <?= $data['nama_221053'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>



                                <!-- Opsi Jawaban A -->
                                <div class="mb-3 col-6">
                                    <label for="waktu_mulai_221053" class="form-label">Waktu Mulai</label>
                                    <input type="time" class="form-control" id="waktu_mulai_221053" value="<?= $waktu_mulai ?>" name="waktu_mulai_221053" required>
                                </div>

                                <!-- Opsi Jawaban B -->
                                <div class="mb-3 col-6">
                                    <label for="waktu_selesai_221053" class="form-label">Waktu Selesai</label>
                                    <input type="time" class="form-control" id="waktu_selesai_221053" value="<?= $waktu_selesai ?>" name="waktu_selesai_221053" required>
                                </div>

                                <!-- Opsi Jawaban C -->
                                <div class="mb-3 col-6">
                                    <label for="status_221053" class="form-label">Status</label>
                                    <select class="form-control" id="status_221053" name="status_221053" required>
                                        <option disabled selected>Pilih Status</option>
                                        <option value="aktif" <?= ($status == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                                        <option value="nonaktif" <?= ($status == 'nonaktif') ? 'selected' : '' ?>>Nonaktif</option>
                                    </select>
                                </div>


                                <div class="mb-3 col-6">
                                    <label for="users_id_221053" class="form-label">Mahasiswa Yang Ikut</label>
                                    <select class="form-control" id="users_id_221053" name="users_id_221053" required>
                                        <option disabled selected>Pilih Mahasiswa</option>
                                        <?php
                                            $tampil = mysqli_query($koneksi, "SELECT * FROM users_221053 WHERE role_221053 = 'mahasiswa'");
                                            while($data = mysqli_fetch_array($tampil)):
                                        ?>
                                        <option value="<?= $data['id_221053'] ?>" <?= ($users_id == $data['id_221053']) ? 'selected' : '' ?>>
                                            <?= $data['nama_221053'] ?>
                                        </option>
                                        <?php
                                            endwhile; 
                                        ?>
                                    </select>
                                </div>



                                <button type="submit" name="simpan" class="btn btn-primary">Edit Ujian</button>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/datatables-simple-demo.js"></script>
    </body>
</html>
