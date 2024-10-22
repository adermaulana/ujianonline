<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

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
            <a class="navbar-brand ps-3" href="index.php">Mahasiswa</a>
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
                                Mulai Ujian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="ujian.php">Ujian</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Hasil Ujian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="hasilujian.php">Hasil Ujian</a>
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
                    <h1 class="mt-4">Ujian</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Timer Ujian -->
                            <h4>Sisa Waktu: <span id="timer">60:00</span></h4>

                            <!-- Soal Ujian Statik -->
                            <form action="submit_ujian.php" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">1. Apa ibu kota dari Indonesia?</label>
                                    <div>
                                        <input type="radio" name="soal_1" value="A" required> A. Surabaya<br>
                                        <input type="radio" name="soal_1" value="B" required> B. Medan<br>
                                        <input type="radio" name="soal_1" value="C" required> C. Jakarta<br>
                                        <input type="radio" name="soal_1" value="D" required> D. Bandung<br>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">2. Apa warna langit pada siang hari?</label>
                                    <div>
                                        <input type="radio" name="soal_2" value="A" required> A. Biru<br>
                                        <input type="radio" name="soal_2" value="B" required> B. Merah<br>
                                        <input type="radio" name="soal_2" value="C" required> C. Hitam<br>
                                        <input type="radio" name="soal_2" value="D" required> D. Putih<br>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">3. Apa nama hewan yang memiliki belalai?</label>
                                    <div>
                                        <input type="radio" name="soal_3" value="A" required> A. Singa<br>
                                        <input type="radio" name="soal_3" value="B" required> B. Gajah<br>
                                        <input type="radio" name="soal_3" value="C" required> C. Kucing<br>
                                        <input type="radio" name="soal_3" value="D" required> D. Kuda<br>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
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

    <!-- Script Timer -->
    <script>
        const totalTime = 3600; // Waktu ujian dalam detik (60 menit)
        const timerEl = document.getElementById('timer');
        const ujianKey = 'ujianTime'; // Key untuk menyimpan waktu di localStorage
        let sisaWaktu;

        // Cek apakah ada data di localStorage
        if (localStorage.getItem(ujianKey)) {
            const startTime = parseInt(localStorage.getItem(ujianKey), 10);
            const now = Math.floor(Date.now() / 1000);
            sisaWaktu = totalTime - (now - startTime);

            // Jika waktu habis
            if (sisaWaktu <= 0) {
                alert('Waktu habis! Jawaban akan dikirim otomatis.');
                document.forms[0].submit();
            }
        } else {
            // Simpan waktu mulai ujian jika belum ada di localStorage
            localStorage.setItem(ujianKey, Math.floor(Date.now() / 1000));
            sisaWaktu = totalTime;
        }

        function startTimer() {
            const interval = setInterval(function() {
                if (sisaWaktu <= 0) {
                    clearInterval(interval);
                    alert('Waktu habis! Jawaban akan dikirim otomatis.');
                    document.forms[0].submit();
                }

                // Hitung menit dan detik
                const minutes = Math.floor(sisaWaktu / 60);
                let seconds = sisaWaktu % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                // Tampilkan di HTML
                timerEl.textContent = minutes + ":" + seconds;

                // Kurangi sisa waktu
                sisaWaktu--;

                // Simpan kembali waktu ujian yang tersisa setiap detik
                localStorage.setItem(ujianKey, Math.floor(Date.now() / 1000) - (totalTime - sisaWaktu));
            }, 1000);
        }

        // Mulai timer saat halaman dibuka
        startTimer();
    </script>
    </body>
</html>
