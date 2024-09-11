<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Website Desa Tanah Baru</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/img/krw.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../../assets/libs/pace-progress/themes/blue/pace-theme-flash.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../assets/vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../assets/vendor/toastr/toastr.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

</head>

<?php
session_start();
?>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-xxl-3" style="width: 400px;">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="../../index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../../assets/img/logodesa.png" width="180" alt="">
                                </a>
                                <p class="text-center fs-4">Masukkan username dan password</p>
                                <form method="post" action="cek_login.php">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="username" placeholder="username" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="password" required>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value="" name="remember" value="true" onclick="myFunction()" id="rememberme">
                                            <label class="form-check-label text-dark" for="rememberme">
                                                Show password
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="forgot-password.php">Lupa password?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-2 rounded-2">
                                        Login
                                    </button>

                                    <div class="d-flex align-items-center">
                                        <a href="../../index.php">
                                            <p class="fs-4 mb-0 fw-bold"><i class="bi bi-arrow-left-circle-fill"></i> &nbsp;Kembali </p>
                                        </a>
                                        <!-- <a class="text-primary fw-bold ms-2" href="register.php"> Buat sekarang</a> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/pace-progress/pace.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../../assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/vendor/toastr/toastr.min.js"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("inputPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <?php
    require_once "../../controllers/login.php";
    $cek_error = new login;
    $cek_error->getError();
    ?>

    <?php
    require_once "../../controllers/login.php";
    $tampilSimpanemail = new login;
    $tampilSimpanemail->get_success_email();
    ?>

</body>

</html>