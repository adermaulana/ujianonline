<?php

    include 'koneksi.php';

    session_start();

    if(isset($_SESSION['status']) == 'login'){

        header("location:admin");
    }

    if (isset($_POST['registrasi'])) {
        $password = md5($_POST['password']);
        $username = $_POST['username'];
    
        // Check if the username already exists
        $checkUsername = mysqli_query($koneksi, "SELECT * FROM users_221053 WHERE username_221053='$username'");
        if (mysqli_num_rows($checkUsername) > 0) {
            echo "<script>
                    alert('Username sudah digunakan, pilih username lain.');
                    document.location='registrasi.php';
                </script>";
            exit; // Stop further execution
        }
    
        $role = 'mahasiswa';
        $active = 1;
    
        // If the username is not taken, proceed with the registration
        $simpan = mysqli_query($koneksi, "INSERT INTO users_221053 (nama_221053, username_221053  ,role_221053, password_221053,active_221053) VALUES ('$_POST[nama]','$_POST[username]','$role','$password','$active')");
    
        if ($simpan) {
            echo "<script>
                    alert('Berhasil Registrasi!');
                    document.location='index.php';
                </script>";
        } else {
            echo "<script>
                    alert('Gagal!');
                    document.location='registrasi.php';
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Registrasi</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" type="text" name="nama" placeholder="Nama Lengkap" required />
                                                <label for="nama">Nama Lengkap</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" type="text" name="username" placeholder="Username" required />
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="Password" required/>
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" name="registrasi">Registrasi</button>
                                                <a class="text-decoration-none me-auto ms-2" href="index.php">Login</a>
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

