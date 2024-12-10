<?php

include '../koneksi.php';

session_start();

if ($_SESSION['status'] != 'login') {
    session_unset();
    session_destroy();

    header('location:../');
}

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == 'edit') {
        $tampil = mysqli_query(
            $koneksi,
            "SELECT ujian_221053.*, mata_kuliah_221053.kode_221053, mata_kuliah_221053.nama_221053 
                                              FROM ujian_221053
                                              JOIN mata_kuliah_221053 ON ujian_221053.mata_kuliah_id_221053 = mata_kuliah_221053.id_221053
                                              WHERE ujian_221053.id_221053 = '$_GET[id]'",
        );
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $id = $data['id_221053'];
            $nama_ujian = $data['judul_221053'];
            $mata_kuliah_id = $data['mata_kuliah_id_221053'];
            $waktu_mulai = $data['waktu_mulai_221053'];
            $waktu_selesai = $data['waktu_selesai_221053'];
            $status = $data['status_221053'];
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

    // Menyimpan data ke database
    $simpan = mysqli_query(
        $koneksi,
        "UPDATE ujian_221053 SET
                                        judul_221053 = '$nama_ujian',
                                        mata_kuliah_id_221053 = '$mata_kuliah_id',
                                        waktu_mulai_221053 = '$waktu_mulai',
                                        waktu_selesai_221053 = '$waktu_selesai',
                                        status_221053 = '$status'
                                        WHERE id_221053 = '$_GET[id]'",
    );

    if ($simpan) {
        echo "<script>
                alert('Edit data sukses!');
                document.location='lihatujian.php?id_ujian=" .
            $id .
            "';
            </script>";
    } else {
        echo "<script>
                alert('Edit data Gagal!');
                document.location='lihatujian.php?id_ujian=" .
            $id .
            "';
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

    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
    </style>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Dosen</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#matkul"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Mata Kuliah
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="matkul" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
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
                    <h1 class="mt-4">Edit Ujian</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST">
                                <!-- Pilih Ujian -->
                                <input type="hidden" name="mata_kuliah_id_221053" value="<?= $mata_kuliah_id ?>">
                                <div class="mb-3 col-6">
                                    <label for="judul_221053" class="form-label">Mata Kuliah</label>
                                    <input type="text" class="form-control"
                                        value="<?= $data['kode_221053'] ?> - <?= $data['nama_221053'] ?>" readonly>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="judul_221053" class="form-label">Nama Ujian</label>
                                    <input type="text" class="form-control" id="judul_221053"
                                        value="<?= $nama_ujian ?>" name="judul_221053" required>
                                    <div id="namaError" class="error-message">Nama tidak valid</div>
                                </div>


                                <!-- Opsi Jawaban A -->
                                <div class="mb-3 col-6">
                                    <label for="waktu_mulai_221053" class="form-label">Waktu Mulai</label>
                                    <input type="datetime-local" class="form-control" id="waktu_mulai_221053"
                                        value="<?= $waktu_mulai ?>" name="waktu_mulai_221053" required>
                                </div>

                                <!-- Opsi Jawaban B -->
                                <div class="mb-3 col-6">
                                    <label for="waktu_selesai_221053" class="form-label">Waktu Selesai</label>
                                    <input type="datetime-local" class="form-control" id="waktu_selesai_221053"
                                        value="<?= $waktu_selesai ?>" name="waktu_selesai_221053" required>
                                </div>

                                <!-- Opsi Jawaban C -->
                                <div class="mb-3 col-6">
                                    <label for="status_221053" class="form-label">Status</label>
                                    <select class="form-control" id="status_221053" name="status_221053" required>
                                        <option disabled selected>Pilih Status</option>
                                        <option value="aktif" <?= $status == 'aktif' ? 'selected' : '' ?>>Aktif
                                        </option>
                                        <option value="nonaktif" <?= $status == 'nonaktif' ? 'selected' : '' ?>>
                                            Nonaktif</option>
                                    </select>
                                </div>

                                <button type="submit" id="submitButton" name="simpan" class="btn btn-primary">Edit Ujian</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="../assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../assets/js/datatables-simple-demo.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nama = document.getElementById('judul_221053');
            const waktuMulai = document.getElementById('waktu_mulai_221053');
            const waktuSelesai = document.getElementById('waktu_selesai_221053');
            const submitButton = document.getElementById('submitButton');
            const form = document.querySelector('form');

            // Error message elements
            const namaError = document.getElementById('namaError');
            const waktuError = document.createElement('div');
            waktuError.id = 'waktuError';
            waktuError.className = 'error-message';
            waktuSelesai.parentNode.insertBefore(waktuError, waktuSelesai.nextSibling);

            // Validation functions
            function validateNama() {
                if (nama.value.trim() === '') {
                    namaError.textContent = 'Nama Ujian tidak boleh kosong';
                    namaError.style.display = 'block';
                    return false;
                }

                if (nama.value.trim().length < 5) {
                    namaError.textContent = 'Nama Ujian minimal 5 karakter';
                    namaError.style.display = 'block';
                    return false;
                }

                namaError.style.display = 'none';
                return true;
            }

            function validateWaktu() {
                const startTime = new Date(waktuMulai.value);
                const endTime = new Date(waktuSelesai.value);

                if (!waktuMulai.value || !waktuSelesai.value) {
                    waktuError.textContent = 'Waktu mulai dan selesai harus diisi';
                    waktuError.style.display = 'block';
                    return false;
                }

                if (endTime <= startTime) {
                    waktuError.textContent = 'Waktu selesai harus lebih dari waktu mulai';
                    waktuError.style.display = 'block';
                    return false;
                }

                waktuError.style.display = 'none';
                return true;
            }

            function checkFormValidity() {
                const isNamaValid = validateNama();
                const isWaktuValid = validateWaktu();

                // Enable or disable the submit button based on all validations
                if (isNamaValid && isWaktuValid) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            // Real-time validation
            nama.addEventListener('input', checkFormValidity);
            waktuMulai.addEventListener('change', checkFormValidity);
            waktuSelesai.addEventListener('change', checkFormValidity);

            // Form submission validation
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                checkFormValidity();

                if (!submitButton.disabled) {
                    form.submit();
                }
            });
        });
    </script>

</body>

</html>
