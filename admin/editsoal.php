<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}


if(isset($_GET['hal'])){
    if($_GET['hal'] == "edit"){
        $tampil = mysqli_query($koneksi, "SELECT * FROM soal_ujian_221053 WHERE id_221053 = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data){
            $id = $data['id_221053'];
            $ujian_id_221053 = $data['ujian_id_221053'];
            $pertanyaan_221053 = $data['pertanyaan_221053'];
            $opsi_a_221053 = $data['opsi_a_221053'];
            $opsi_b_221053 = $data['opsi_b_221053'];
            $opsi_c_221053 = $data['opsi_c_221053'];
            $opsi_d_221053 = $data['opsi_d_221053'];
            $jawaban_benar_221053 = $data['jawaban_benar_221053'];
        }
    }
}

//Perintah Mengubah Data
if (isset($_POST['simpan'])) {
    // Mengambil data dari form
    $ujian_id_221053 = $_POST['ujian_id_221053'];
    $pertanyaan_221053 = $_POST['pertanyaan_221053'];
    $opsi_a_221053 = $_POST['opsi_a_221053'];
    $opsi_b_221053 = $_POST['opsi_b_221053'];
    $opsi_c_221053 = $_POST['opsi_c_221053'];
    $opsi_d_221053 = $_POST['opsi_d_221053'];
    $jawaban_benar_221053 = $_POST['jawaban_benar_221053'];

    // Menyimpan data ke database
    $simpan = mysqli_query($koneksi, "UPDATE soal_ujian_221053 SET
                                        ujian_id_221053 = '$ujian_id_221053',
                                        pertanyaan_221053 = '$pertanyaan_221053',
                                        opsi_a_221053 = '$opsi_a_221053',
                                        opsi_b_221053 = '$opsi_b_221053',
                                        opsi_c_221053 = '$opsi_c_221053',
                                        opsi_d_221053 = '$opsi_d_221053',
                                        jawaban_benar_221053 = '$jawaban_benar_221053' 
                                        WHERE id_221053 = '$_GET[id]'");

    if ($simpan) {
        echo "<script>
                alert('Edit data sukses!');
                document.location='soal.php';
            </script>";
    } else {
        echo "<script>
                alert('Edit data Gagal!');
                document.location='soal.php';
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
        <title>Dashboard - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Admin</a>
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
                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
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
                            </div> -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#matkul" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data Mata Kuliah
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="matkul" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="matakuliah.php">Lihat Mata Kuliah</a>
                                    <a class="nav-link" href="tambahmatakuliah.php">Tambah Mata Kuliah</a>
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
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#dosen" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data Dosen
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="dosen" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="dosen.php">Lihat Dosen</a>
                                <a class="nav-link" href="tambahdosen.php">Tambah Dosen</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Laporan Ujian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="laporan.php">Lihat Laporan</a>
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
                        <h1 class="mt-4">Edit Soal</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                            <form method="POST">
                                <!-- Pilih Ujian -->
                                <div class="mb-3 col-6">
                                    <label for="ujian_id_221053" class="form-label">Pilih Ujian</label>
                                    <select class="form-control" id="ujian_id_221053" name="ujian_id_221053" required>
                                        <option disabled>Pilih Ujian</option>
                                        <?php
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM ujian_221053");
                                        while($data = mysqli_fetch_array($tampil)):
                                            // Menandai ujian yang sudah ada dalam mode edit
                                            $selected = (isset($ujian_id_221053) && $ujian_id_221053 == $data['id_221053']) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $data['id_221053'] ?>" <?= $selected ?>><?= $data['judul_221053'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>


                                <!-- Input Pertanyaan -->
                                <div class="mb-3 col-6">
                                    <label for="pertanyaan_221053" class="form-label">Pertanyaan</label>
                                    <textarea class="form-control" id="pertanyaan_221053" value="<?= $pertanyaan_221053 ?>" name="pertanyaan_221053" rows="3" required><?= $pertanyaan_221053 ?></textarea>
                                </div>

                                <!-- Opsi Jawaban A -->
                                <div class="mb-3 col-6">
                                    <label for="opsi_a_221053" class="form-label">Opsi A</label>
                                    <input type="text" class="form-control" id="opsi_a_221053" value="<?= $opsi_a_221053 ?>" name="opsi_a_221053" required>
                                </div>

                                <!-- Opsi Jawaban B -->
                                <div class="mb-3 col-6">
                                    <label for="opsi_b_221053" class="form-label">Opsi B</label>
                                    <input type="text" class="form-control" id="opsi_b_221053" value="<?= $opsi_b_221053 ?>" name="opsi_b_221053" required>
                                </div>

                                <!-- Opsi Jawaban C -->
                                <div class="mb-3 col-6">
                                    <label for="opsi_c_221053" class="form-label">Opsi C</label>
                                    <input type="text" class="form-control" id="opsi_c_221053" value="<?= $opsi_c_221053 ?>" name="opsi_c_221053" required>
                                </div>

                                <!-- Opsi Jawaban D -->
                                <div class="mb-3 col-6">
                                    <label for="opsi_d_221053" class="form-label">Opsi D</label>
                                    <input type="text" class="form-control" id="opsi_d_221053" value="<?= $opsi_d_221053 ?>" name="opsi_d_221053" required>
                                </div>

                                <!-- Input Jawaban Benar -->
                                <div class="mb-3 col-6">
                                    <label for="jawaban_benar_221053" class="form-label">Jawaban Benar</label>
                                    <select class="form-control" id="jawaban_benar_221053" name="jawaban_benar_221053" required>
                                        <option disabled>Pilih</option>
                                        <option value="A" <?= (isset($jawaban_benar_221053) && $jawaban_benar_221053 == 'A') ? 'selected' : '' ?>>A</option>
                                        <option value="B" <?= (isset($jawaban_benar_221053) && $jawaban_benar_221053 == 'B') ? 'selected' : '' ?>>B</option>
                                        <option value="C" <?= (isset($jawaban_benar_221053) && $jawaban_benar_221053 == 'C') ? 'selected' : '' ?>>C</option>
                                        <option value="D" <?= (isset($jawaban_benar_221053) && $jawaban_benar_221053 == 'D') ? 'selected' : '' ?>>D</option>
                                    </select>
                                </div>


                                <button type="submit" name="simpan" class="btn btn-primary">Edit Soal</button>
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
