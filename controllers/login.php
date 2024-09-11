<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Tanah Baru | Website Desa Tanah Baru Kecamatan Pakisjaya</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/img/krw.png" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../assets/vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../assets/vendor/toastr/toastr.min.css">

</head>

<body>
    <?php
    error_reporting(0);
    require_once "../../config/database.php";

    class login
    {
        var $username, $password;

        function __construct()
        {
            $this->koneksi = new database;
            $this->koneksi->BukaDB();

            if (isset($_POST['username'])) {
                $this->username = $_POST['username'];
            }

            if (isset($_POST['password'])) {
                $this->password = $_POST['password'];
            }
        }

        function __destruct()
        {
            $this->koneksi = new database;
            $this->koneksi->TutupDB();
        }

        function Dologin()
        {
            $login = mysqli_query($this->koneksi->link, "SELECT *FROM pengguna INNER JOIN user_login on pengguna.id_pengguna = user_login.id_pengguna WHERE username = '$this->username'");
            $data =  mysqli_fetch_array($login);
            date_default_timezone_set('Asia/Jakarta');

            $pass = base64_decode($data['password']);
            if (($this->username != $data['username'])) {
                session_start();
                $_SESSION["error"] = 'Login gagal, username dan password salah!';
                header('Location: login.php');
            } elseif (($this->password != $pass)) {
                session_start();
                $_SESSION["error"] = 'Login gagal, password salah!';
                header('Location: login.php');
            } elseif (($data['status_aktivasi'] != '1')) {
                session_start();
                $_SESSION["error"] = 'Login gagal, akun belum di aktivasi, silahkan cek email yang sudah didaftarkan!';
                header('Location: login.php');
            } elseif (($data['suspend'] != '0')) {
                session_start();
                $_SESSION["error"] = 'Login gagal, akun telah dinon-aktifkan, silahkan hubungi administrator!';
                header('Location: login.php');
            } else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['role'] = $data['role'];
                $_SESSION['status_active'] = $data['status_active'];
                $_SESSION['nik'] = $data['nik'];
                $_SESSION['id_pengguna'] = $data['id_pengguna'];
                $_SESSION['id_user'] = $data['id_user'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['status_active'] = $data['status_active'];
                $_SESSION['email'] = $data['email'];

                $today = date("Y-m-d H:i:s");
                $status_active = '1';
                $last = ("UPDATE user_login SET status_active = '$status_active', log_datetime = '$today' where username = '$this->username'");
                $query = mysqli_query($this->koneksi->link, $last);
                if ($data['role'] == "ROL001") {
                    session_start();

                    $_SESSION["success"] = 'Berhasil Login';

                    header('Location: Administrator.php');
                } elseif ($data['role'] == "ROL002") {
                    session_start();
                    $_SESSION["success"] = 'Behasil Login';
                    header('Location: Pakar.php');
                }
            }
        }

        function logout()
        {
            session_start(); //memeriksa apakah ada yg sudah login
            session_destroy(); //memeriksa apakah ada yg sudah logout
            include "../../views/include/session.php";
        }

        function Update()
        {
            $session = $_SESSION['username'];
            $status_Nonactive = '0';
            $last = ("UPDATE user_login SET status_active = '$status_Nonactive' where username = '$session'");
            $query = mysqli_query($this->koneksi->link, $last);
            echo "<script type='text/javascript'>window.location='../../views/pages/login.php'</script>";
        }

        function getError()
        {
            if (@$_SESSION['error']) {
                echo "<script>
                        toastr.error('$_SESSION[error]');
                    </script>";

                unset($_SESSION['error']);
            }
        }

        function getSuccess()
        {
            if (@$_SESSION['success']) {
                echo "<script>
                        toastr.success('$_SESSION[success]');
                    </script>";

                unset($_SESSION['success']);
            }
        }

        function get_success_email()
        {
            if (@$_SESSION['simpan']) {
                echo "<script>
                        toastr.success('$_SESSION[simpan]');
                    </script>";

                unset($_SESSION['simpan']);
            }
        }

        function get_error_email()
        {
            if (@$_SESSION['gagal']) {
                echo "<script>
                        toastr.error('$_SESSION[gagal]');
                    </script>";

                unset($_SESSION['gagal']);
            }
        }
    }

    ?>

    <!-- SweetAlert2 -->

    <script src="../../assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/vendor/toastr/toastr.min.js"></script>

</body>

</html>