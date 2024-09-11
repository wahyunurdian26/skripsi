<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Website Desa Tanah Baru</title>
    <link rel="shortcut icon" type="image/png" href="../assets/img/krw.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/libs/pace-progress/themes/blue/pace-theme-flash.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../assets/vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../assets/vendor/toastr/toastr.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

</head>

<?php
session_start();
?>

<body>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/pace-progress/pace.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <script src="../assets/vendor/toastr/toastr.min.js"></script>
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
    require_once "../controllers/login.php";
    $cek_error = new login;
    $cek_error->getError();
    ?>

    <?php
    require_once "../controllers/login.php";
    $tampilSimpanemail = new login;
    $tampilSimpanemail->get_success_email();
    ?>

</body>

</html>