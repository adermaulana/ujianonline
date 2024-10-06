<?php

    include 'koneksi.php';

    session_start();

    if(isset($_SESSION['status']) == 'login'){

        header("location:admin");
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        $login = mysqli_query($koneksi, "SELECT * FROM `users_221053`
                                    WHERE `username_221053` = '$username'
                                    AND `password_221053` = '$password'
                                    AND `role_221053` = 'dosen'
                                    AND `active_221053` = 1");
        $cek = mysqli_num_rows($login);
    
        if ($cek > 0) {
            // Ambil data user
            $admin_data = mysqli_fetch_assoc($login);
            // Simpan data ke dalam session
            $_SESSION['id_admin'] = $admin_data['id_221053  ']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['nama_admin'] = $admin_data['name_221053']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['username_admin'] = $username;
            $_SESSION['status'] = "login";
            // Redirect ke halaman admin
            header('location:dosen');
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Masukkan Username dan Password Anda.</p>

                    <form method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="username" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>

                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>