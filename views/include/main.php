<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="refresh" content="120" /> -->
    <title>Desa Tanah Baru | Website Desa Tanah Baru</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/img/krw.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Waves Effect Css -->
    <link href="../../assets/libs/node-waves/waves.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="../../assets/css/adminlte.min.css"> -->

    <!-- Animation Css -->
    <link href="../../assets/libs/animate-css/animate.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/libs/pace-progress/themes/blue/pace-theme-flash.css">
    <link rel="stylesheet" href="../../assets/css/box.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../assets/vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../assets/vendor/toastr/toastr.min.css">
    <!-- <link rel="canonical" href="https://demo-basic.adminkit.io/charts-chartjs.html" /> -->
    <link rel="stylesheet" href="../../assets/css/toggle.css">

</head>
<?php error_reporting(0); ?>
<?php session_start();
if (empty($_SESSION['login'])) {
    $keluar = "../pages/login.php"; // redirect halaman logout
    echo "<script type='text/javascript'>alert('akses ditolak');window.location='$keluar'</script>";
}
$timeout = 60; // setting timeout dalam menit
$logout = "../pages/login.php"; // redirect halaman login

$timeout = $timeout * 60; // menit ke detik
if (isset($_SESSION['start_session'])) {
    $elapsed_time = time() - $_SESSION['start_session'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        include "../pages/include/session.php";
        echo "<script type='text/javascript'>alert('Sesi telah berakhir');window.location='$logout'</script>";
    }
}

$_SESSION['start_session'] = time();
?>

<body>


    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/sidebarmenu.js"></script>
    <script src="../../assets/js/app.min.js"></script>
    <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../../assets/js/dashboard.js"></script>
    <script src="../../assets/libs/pace-progress/pace.min.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../../assets/libs/node-waves/waves.js"></script>
    <!-- SweetAlert2 -->

    <script src="../../assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/vendor/toastr/toastr.min.js"></script>
    <script type="text/javascript" src="../../assets/js/canvasjs.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Hasil"
                },
                legend: {
                    maxWidth: 350,
                    itemWidth: 120
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    legendText: "{indexLabel}",
                    dataPoints: [{
                            y: 3,
                            indexLabel: "Rekomendasi"
                        },
                        {
                            y: 6,
                            indexLabel: "Tidak"
                        },
                        {
                            y: 6,
                            indexLabel: "Kurang"
                        }
                    ]
                }]
            });
            chart.render();
        }
    </script>
    </script>


    <script>
        function hanyaAngka(event) {
            var nik = (event.which) ? event.which : event.keyCode
            if (nik != 1 && nik > 16 && (nik < 48 || nik > 57))
                return false;
            return true;
        }
    </script>


    <?php
    require_once "../../controllers/login.php";
    $tampilsuccess = new login;
    $tampilsuccess->getSuccess();
    ?>

    <!-- Berhasil -->
    <?php if (@$_SESSION['success']) {
        echo "<script>
                toastr.success('$_SESSION[success]');
            </script>";

        unset($_SESSION['success']);
    } ?>

    <!-- Gagal -->
    <?php if (@$_SESSION['error']) {
        echo "<script>
                toastr.error('$_SESSION[error]');
            </script>";

        unset($_SESSION['error']);
    } ?>

    <!-- Notif Logout -->
    <script>
        $(document).on('click', '#btn-Logout', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Ingin keluar dari sistem!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

    <!-- Notif Validasi -->
    <script>
        $(document).on('click', '#btn-validasi', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Data ini valid!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Valid',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

    <!-- Notif Logout -->
    <script>
        $(document).on('click', '#btn-KonfirmProses', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Ingin melakukan proses perhitungan metode TOPSIS',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Proses',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

    <!-- Notif normalisasi -->
    <script>
        $(document).on('click', '#btn-normalisasi', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'ingin melakukan normalisasi bobot kriteria!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, normalisasi',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

    <!-- Notif Reset -->
    <script>
        $(document).on('click', '#btn-reset', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'ingin reset akun <?= $_SESSION['hak_akses'] ?>!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

    <!-- Notif Hapus -->
    <script>
        $(document).on('click', '#btn-Hapus', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Data ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

    <!-- Notif Hapus -->
    <script>
        $(document).on('click', '#btn-HapusMaster', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Data ini terhubung pada tabel transaksi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

    <!-- Notif Aktivasi -->
    <script>
        $(document).on('click', '#btn-aktivasi', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Data ini akan diaktivasi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Aktivasi',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

    <!-- Notif Non-Aktif Akun -->
    <script>
        $(document).on('click', '#btn-non-active', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Data ini akan Non-Aktifkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

    <!-- Notif Aktifkan Akun -->
    <script>
        $(document).on('click', '#btn-aktifkan', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Data ini akan diaktifkan kembali!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;

                }
            })
        })
    </script>

</body>

</html>