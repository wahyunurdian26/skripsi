<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password | Website Desa Tanah Baru</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/img/krw.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../../assets/libs/pace-progress/themes/blue/pace-theme-flash.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../assets/vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../assets/vendor/toastr/toastr.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/vendor/fontawesome-free/css/all.min.css">

</head>

<?php session_start();
error_reporting(0);
$key = $_GET['otp'];
$config = mysqli_connect("localhost", "root", "", "db_tanahbaru");
$cek = mysqli_query($config, "SELECT *FROM user_login where token = '$key'");
$data = mysqli_fetch_array($cek);
?>

<body>
    <!--  Body Wrapper -->
    <?php
    if ($key == $data['token']) {

    ?>
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="row justify-content-center w-100">
                        <div class="col-md-8 col-xxl-3" style="width: 400px;">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <a href="../index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                        <img src="../assets/img/logodesa.png" width="180" alt="">
                                    </a>
                                    <p class="text-center">Reset Password</p>
                                    <form method="post" action="reset-password.php">
                                        <input type="hidden" value="<?= $data['id_pengguna'] ?>" class="form-control" name="idp">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="username" value="<?= $data['username'] ?>" placeholder="KOSONG" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password Baru</label>
                                            <div class="input-group">
                                                <input type="password" name="new-password" class="form-control" id="password-field">
                                                <button type="button" class="btn" style="border: 1px solid gray;"><span toggle="#password-field" class="fa fa-eye field-icon toggle-password"></span></button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Konfirmasi Password</label>
                                            <div class="input-group">
                                                <input type="password" name="confirm-password" class="form-control" id="password-field2">
                                                <button type="button" class="btn" style="border: 1px solid gray;"><span toggle="#password-field2" class="fa fa-eye field-icon toggle-password"></span></button>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <a class="text-primary fw-bold" href="login.php">Batal</a>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-2 rounded-2">
                                            Reset Password
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } elseif ($key != $data['token']) {
        echo '<script> location.replace("login.php"); </script>';
    }

    ?>
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
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
    <?php
    require_once "../../controllers/login.php";
    $cek_error = new login;
    $cek_error->get_error_email();
    ?>

</body>

</html>