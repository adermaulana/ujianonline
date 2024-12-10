<?php
include '../koneksi.php';
include '../tcpdf/tcpdf.php'; // Make sure to download and include TCPDF library

session_start();

if ($_SESSION['status'] != 'login') {
    session_unset();
    session_destroy();
    header('location:../');
    exit();
}

// Initialize filter variables
$filter_mahasiswa = isset($_GET['mahasiswa']) ? $_GET['mahasiswa'] : '';
$filter_ujian = isset($_GET['ujian']) ? $_GET['ujian'] : '';
$filter_from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$filter_to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
$filter_matkul = isset($_GET['matkul']) ? $_GET['matkul'] : '';

// Base SQL query with dynamic filtering
$sql = "SELECT 
    hu.id_221053,
    u.judul_221053,
    hu.nilai_221053,
    usr.nama_221053,
    hu.dikumpulkan_pada_221053,
    mk.nama_221053 AS mata_kuliah
FROM hasil_ujian_221053 hu
JOIN ujian_221053 u ON hu.ujian_id_221053 = u.id_221053
JOIN mata_kuliah_221053 mk ON u.mata_kuliah_id_221053 = mk.id_221053
JOIN users_221053 usr ON hu.mahasiswa_id_221053 = usr.id_221053
WHERE 1=1"; // Starting condition to allow easy filtering

// Add filters
if (!empty($filter_mahasiswa)) {
    $sql .= " AND usr.nama_221053 LIKE '%{$filter_mahasiswa}%'";
}
if (!empty($filter_ujian)) {
    $sql .= " AND u.judul_221053 LIKE '%{$filter_ujian}%'";
}
if (!empty($filter_matkul)) {
    $sql .= " AND mk.nama_221053 LIKE '%{$filter_matkul}%'";
}
if (!empty($filter_from_date)) {
    $sql .= " AND hu.dikumpulkan_pada_221053 >= '{$filter_from_date}'";
}
if (!empty($filter_to_date)) {
    $sql .= " AND hu.dikumpulkan_pada_221053 <= '{$filter_to_date}'";
}

$sql .= ' ORDER BY hu.dikumpulkan_pada_221053 DESC';

$result = $koneksi->query($sql);

// Handle PDF Generation
if (isset($_GET['generate_pdf'])) {
    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Admin');
    $pdf->SetTitle('Laporan Hasil Ujian');
    $pdf->SetSubject('Laporan Detail Hasil Ujian');

    $logo_path = '../assets/img/your_logo.png'; // Adjust the path to your logo
    if (file_exists($logo_path)) {
        $pdf->SetHeaderData($logo_path, 25, 'Laporan Hasil Ujian', 'Universitas XX Makassar');
    } else {
        // Fallback if logo file is not found
        $pdf->SetHeaderData('', 0, 'Laporan Hasil Ujian', 'Universitas XX Makassar');
    }

    // Set header and footer fonts
    $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
    $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

    // Add a page
    $pdf->AddPage();

    // Create table for PDF
    $html = '<table border="1" cellpadding="4">';
    $html .= '<tr style="background-color:#f1f1f1;">
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Nama Mata Kuliah</th>
                <th>Judul Ujian</th>
                <th>Nilai</th>
                <th>Waktu Kumpul</th>
              </tr>';

    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $html .=
            '<tr>
                    <td>' .
            $no++ .
            '</td>
                    <td>' .
            $row['nama_221053'] .
            '</td>
                    <td>' .
            $row['mata_kuliah'] .
            '</td>
                    <td>' .
            $row['judul_221053'] .
            '</td>
                    <td>' .
            $row['nilai_221053'] .
            '</td>
                    <td>' .
            $row['dikumpulkan_pada_221053'] .
            '</td>
                  </tr>';
    }
    $html .= '</table>';

    // Print text using writeHTMLCell()
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('laporan_hasil_ujian.pdf', 'D');
    exit();
}

// Reset result pointer for table display
$result = $koneksi->query($sql);
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
                    <h1 class="mt-4">Laporan Hasil Ujian</h1>

                    <form method="get" action="" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="mahasiswa" class="form-control"
                                    placeholder="Nama Mahasiswa" value="<?php echo htmlspecialchars($filter_mahasiswa); ?>">
                            </div>
                            <div class="col-md-3">
                                <select name="matkul" class="form-control">
                                    <option value="">Pilih Semua Matakuliah</option>
                                    <?php
                                    // Assuming you have a database connection and a table for matkul
                                    $query_matkul = mysqli_query($koneksi, 'SELECT * FROM mata_kuliah_221053');
                                    while ($matkul = mysqli_fetch_array($query_matkul)) {
                                        $selected = $filter_matkul == $matkul['nama_221053'] ? 'selected' : '';
                                        echo "<option value='" . htmlspecialchars($matkul['nama_221053']) . "' $selected>" . htmlspecialchars($matkul['nama_221053']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="ujian" class="form-control" placeholder="Judul Ujian"
                                    value="<?php echo htmlspecialchars($filter_ujian); ?>">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary me-2">Filter</button>
                                <button type="submit" name="generate_pdf" target="_blank" value="1"
                                    class="btn btn-danger">Cetak PDF</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" name="from_date" class="form-control"
                                    value="<?php echo htmlspecialchars($filter_from_date); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" name="to_date" class="form-control"
                                    value="<?php echo htmlspecialchars($filter_to_date); ?>">
                            </div>
                        </div>
                    </form>

                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Nama Matakuliah</th>
                                        <th>Judul Ujian</th>
                                        <th>Nilai</th>
                                        <th>Waktu Kumpul</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Matakuliah</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Judul Ujian</th>
                                        <th>Nilai</th>
                                        <th>Waktu Kumpul</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama_221053']; ?></td>
                                        <td><?php echo $row['mata_kuliah']; ?></td>
                                        <td><?php echo $row['judul_221053']; ?></td>
                                        <td><?php echo $row['nilai_221053']; ?></td>
                                        <td><?php echo $row['dikumpulkan_pada_221053']; ?></td>
                                    </tr>
                                    <?php
                                    }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="../assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../assets/js/datatables-simple-demo.js"></script>
</body>

</html>
