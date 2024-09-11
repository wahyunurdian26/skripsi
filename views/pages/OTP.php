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

</head>

<?php session_start();

$key = $_GET['email'];
$config = mysqli_connect("localhost", "root", "", "db_tanahbaru");
$cek = mysqli_query($config, "SELECT *FROM user_login where username = '$key'");
$data = mysqli_fetch_array($cek);
?>

<body>
    <!--  Body Wrapper -->
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
                                <p class="text-center">Form Verifikasi Akun dengan kode OTP</p>
                                <form method="post" action="confirm-OTP.php">
                                    <div class="mb-3">
                                        <label for="otp" class="form-label">Kode OTP telah dikirim ke alamat email:<br><?= $key ?></label>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Please Enter the OTP</label>
                                        <input type="hidden" value="<?= $data['id_pengguna'] ?>" class="form-control" name="idp">
                                        <input type="hidden" value="<?= $data['token'] ?>" class="form-control" name="token">
                                        <input type="text" class="form-control" name="otp" required>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">

                                        <a class="text-primary fw-bold" href="login.php">Login</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-2 rounded-2">
                                        Confirm
                                    </button>
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


    <?php
    require_once "../../controllers/login.php";
    $cek_error = new login;
    $cek_error->get_error_email();
    ?>

</body>

</html>