<?php

include '../koneksi.php';

session_start();

if ($_SESSION['status'] != 'login') {
    session_unset();
    session_destroy();

    header('location:../');
}

if (isset($_POST['simpan'])) {
    // Mengambil data dari form
    $nama_ujian = $_POST['judul_221053'];
    $mata_kuliah_id = $_POST['mata_kuliah_id_221053'];
    $waktu_mulai = $_POST['waktu_mulai_221053'];
    $waktu_selesai = $_POST['waktu_selesai_221053'];
    $status = $_POST['status_221053'];
    $users_id = $_POST['users_id_221053'];

    // Menyimpan data ke database
    $simpan = mysqli_query($koneksi, "INSERT INTO ujian_221053 (judul_221053, mata_kuliah_id_221053, waktu_mulai_221053, waktu_selesai_221053, status_221053, users_id_221053) VALUES ('$nama_ujian', '$mata_kuliah_id', '$waktu_mulai', '$waktu_selesai', '$status', '$users_id')");

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
    <title>Dashboard - Admin</title>
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
        <a class="navbar-brand ps-3" href="index.php">Admin</a>
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
                                <a class="nav-link" href="tambahmatakuliah.php">Tambah Mata Kuliah</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#mahasiswa" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Mahasiswa
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="mahasiswa" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="mahasiswa.php">Lihat Mahasiswa</a>
                                <a class="nav-link" href="tambahmahasiswa.php">Tambah Mahasiswa</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#dosen" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Dosen
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="dosen" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="dosen.php">Lihat Dosen</a>
                                <a class="nav-link" href="tambahdosen.php">Tambah Dosen</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Data Laporan Ujian
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
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
                    <h1 class="mt-4">Tambah Ujian</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST">
                                <!-- Pilih Ujian -->

                                <div class="mb-3 col-6">
                                    <label for="judul_221053" class="form-label">Nama Ujian</label>
                                    <input type="text" class="form-control" id="judul_221053" name="judul_221053"
                                        required>
                                    <div id="namaError" class="error-message">Nama tidak valid</div>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="mata_kuliah_id_221053" class="form-label">Mata Kuliah</label>
                                    <select class="form-control" id="mata_kuliah_id_221053"
                                        name="mata_kuliah_id_221053" required>
                                        <option disabled selected>Pilih Matkul</option>
                                        <?php
                                            $no = 1;
                                            $tampil = mysqli_query($koneksi, "SELECT * FROM mata_kuliah_221053");
                                            while($data = mysqli_fetch_array($tampil)):
                                        ?>
                                        <option value="<?= $data['id_221053'] ?>"><?= $data['kode_221053'] ?> -
                                            <?= $data['nama_221053'] ?></option>
                                        <?php
                                            endwhile; 
                                        ?>
                                    </select>
                                </div>


                                <!-- Opsi Jawaban A -->
                                <div class="mb-3 col-6">
                                    <label for="waktu_mulai_221053" class="form-label">Waktu Mulai</label>
                                    <input type="time" class="form-control" id="waktu_mulai_221053"
                                        name="waktu_mulai_221053" required>
                                </div>

                                <!-- Opsi Jawaban B -->
                                <div class="mb-3 col-6">
                                    <label for="waktu_selesai_221053" class="form-label">Waktu Selesai</label>
                                    <input type="time" class="form-control" id="waktu_selesai_221053"
                                        name="waktu_selesai_221053" required>
                                </div>

                                <!-- Opsi Jawaban C -->
                                <div class="mb-3 col-6">
                                    <label for="status_221053" class="form-label">Status</label>
                                    <select class="form-control" id="status_221053" name="status_221053" required>
                                        <option disabled selected>Pilih Status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="users_id_221053" class="form-label">Mahasiswa Yang Ikut</label>
                                    <select class="form-control" id="users_id_221053" name="users_id_221053"
                                        required>
                                        <option disabled selected>Pilih Mahasiswa</option>
                                        <?php
                                            $no = 1;
                                            $tampil = mysqli_query($koneksi, "SELECT * FROM users_221053 WHERE role_221053 = 'mahasiswa'");
                                            while($data = mysqli_fetch_array($tampil)):
                                        ?>
                                        <option value="<?= $data['id_221053'] ?>"><?= $data['nama_221053'] ?></option>
                                        <?php
                                            endwhile; 
                                        ?>
                                    </select>
                                </div>


                                <button type="submit" id="submitButton" name="simpan" class="btn btn-primary">Tambah Ujian</button>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../assets/js/datatables-simple-demo.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nama = document.getElementById('nama_kelas_221047');
            const harga = document.getElementById('harga_221047');
            const submitButton = document.getElementById('submitButton');

            // Error message elements
            const namaError = document.getElementById('namaError');
            const hargaError = document.getElementById('hargaError');

            // Validation functions
            function validateNama() {
                if (nama.value.trim() === '') {
                    namaError.style.display = 'block';
                    return false;
                }
                namaError.style.display = 'none';
                return true;
            }

            function validateHarga() {
                const hargaValue = parseFloat(harga.value); // Mengambil nilai harga dari input
                if (isNaN(hargaValue) || hargaValue < 10000) {
                    // Memastikan harga adalah angka dan minimal 10,000
                    hargaError.textContent = 'Harga harus berupa angka minimal 10,000';
                    hargaError.style.display = 'block';
                    return false;
                }
                hargaError.style.display = 'none';
                return true;
            }

            function checkFormValidity() {
                const isNamaValid = validateNama();
                const isHargaValid = validateHarga();

                // Enable or disable the submit button based on all validations
                if (isNamaValid && isHargaValid) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }

            }


            // Real-time validation
            nama.addEventListener('input', checkFormValidity);
            harga.addEventListener('input', checkFormValidity);

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
