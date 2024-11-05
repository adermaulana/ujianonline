<?php

    include 'koneksi.php';

    session_start();

    if(isset($_SESSION['status']) == 'login'){

        header("location:dosen");
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        $login = mysqli_query($koneksi, "SELECT * FROM `users_221053`
                                    WHERE `username_221053` = '$username'
                                    AND `password_221053` = '$password'
                                    AND `role_221053` = 'admin'
                                    AND `active_221053` = 1");
        $cek = mysqli_num_rows($login);

        $loginDosen = mysqli_query($koneksi, "SELECT * FROM `users_221053`
                                        WHERE `username_221053` = '$username'
                                        AND `password_221053` = '$password'
                                        AND `role_221053` = 'dosen'
                                        AND `active_221053` = 1");
        $cekDosen = mysqli_num_rows($loginDosen);

        $loginMahasiswa = mysqli_query($koneksi, "SELECT * FROM `users_221053`
                                    WHERE `username_221053` = '$username'
                                    AND `password_221053` = '$password'
                                    AND `role_221053` = 'mahasiswa'
                                    AND `active_221053` = 1");
        $cekMahasiswa = mysqli_num_rows($loginMahasiswa);
    
        if ($cek > 0) {
            // Ambil data user
            $admin_data = mysqli_fetch_assoc($login);
            // Simpan data ke dalam session
            $_SESSION['id_admin'] = $admin_data['id_221053']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['nama_admin'] = $admin_data['nama_221053']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['username_admin'] = $username;
            $_SESSION['status'] = "login";
            // Redirect ke halaman admin
            header('location:admin');
        } else if ($cekDosen > 0) {
            // Ambil data user
            $admin_data = mysqli_fetch_assoc($loginDosen);
            // Simpan data ke dalam session
            $_SESSION['id_dosen'] = $admin_data['id_221053']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['nama_dosen'] = $admin_data['nama_221053']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['username_dosen'] = $username;
            $_SESSION['status'] = "login";
            // Redirect ke halaman admin
            header('location:dosen');

        } else if ($cekMahasiswa > 0) {
            // Ambil data user
            $admin_data = mysqli_fetch_assoc($loginMahasiswa);
            // Simpan data ke dalam session
            $_SESSION['id_mahasiswa'] = $admin_data['id_221053']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['nama_mahasiswa'] = $admin_data['nama_221053']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['username_mahasiswa'] = $username;
            $_SESSION['status'] = "login";
            // Redirect ke halaman admin
            header('location:mahasiswa');
        } else {
            echo "<script>
                alert('Login Gagal, Periksa Username dan Password Anda!');
                window.location.href = 'index.php';
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
        <title>Login - SB Admin</title>
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" type="text" name="username" placeholder="Username" />
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="Password" />
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
        <script src="assets/js/scripts.js"></script>
    </body>
</html>

