<?php
// Initialize the session
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Masukkan Username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Masukkan Password.";
    } else {
        $enc_password = md5($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, nama, level, password FROM pengguna WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $nama, $level, $password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if ($enc_password == $password) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["nama"] = $nama;
                            $_SESSION["username"] = $username;
                            $_SESSION["level"] = $level;

                            header("location: app.php?page=dashboard");
                        } else {
                            $password_err = "Password Salah.";
                        }
                    }
                } else {
                    $username_err = "Username tidak ditemukan.";
                }
            } else {
                echo "Terjadi Kesalahan.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Login | Aplikasi Monitor Produksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Produksi: An advanced, fully responsive admin dashboard template packed with features to streamline your analytics and management needs." />
    <meta name="author" content="StackBros" />
    <meta name="keywords"
        content="Produksi, admin dashboard, responsive template, analytics, modern UI, management tools" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="index, follow" />
    <meta name="theme-color" content="#ffffff">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Google Font Family link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor css -->
    <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config js -->
    <script src="assets/js/config.js"></script>

</head>

<body class="authentication-bg">
    <div class="account-pages py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            <div class="text-center">
                                <div class="mx-auto mb-4 text-center auth-logo">
                                    <a href="index.html" class="logo-dark">
                                        <img src="assets/images/logo-produk-light.png" height="50" alt="logo dark">
                                    </a>

                                    <a href="index.html" class="logo-light">
                                        <img src="assets/images/logo-produk-dark.png" height="50" alt="logo light">
                                    </a>
                                </div>
                                <h4 class="fw-bold text-dark mb-2">Selamat Datang!</h3>
                                    <p class="text-muted">Masuk ke akun Anda untuk melanjutkan</p>
                            </div>
                            <form action="login.php" method="post" class="mt-4">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username"
                                        placeholder="Masukkan Username" name="username">
                                    <span class="text-danger"><?php echo $username_err; ?></span>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="password" class="form-label">Password</label>
                                    </div>
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Masukkan Password" name="password">
                                    <span class="text-danger">
                                        <?php echo $password_err; ?>
                                    </span>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-dark btn-lg fw-medium" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Vendor Javascript -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App Javascript -->
    <script src="assets/js/app.js"></script>


</body>

</html>