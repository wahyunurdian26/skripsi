<?php
// error_reporting(0);
session_start();
// pxzm hhyn xqca hfis
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require_once "../../controllers/login.php";
require_once "../../models/pengguna.php";
error_reporting(0);
class sendMail extends login
{

    public function SendForgotPassword()
    {
        $email = htmlspecialchars($_POST['email']);
        //Cek data user
        $cek = mysqli_query($this->koneksi->link, "SELECT * FROM pengguna where email = '$email . '");
        $data = mysqli_fetch_array($cek);
        if ($email == $data['email']) {
            //set session gagal
            $_SESSION["gagal"] = 'Email tidak terdaftar!';
            //redirect ke halaman
            echo '<script> location.replace("register.php"); </script>';
        } else {

            $query = mysqli_query($this->koneksi->link, "SELECT *FROM pengguna INNER JOIN user_login on pengguna.id_pengguna = user_login.id_pengguna WHERE username = '$email'");
            $data = mysqli_fetch_array($query);
            $email_penerima = $data['username'];
            $OTP = rand(100000, 999999);
            $query = mysqli_query($this->koneksi->link, "UPDATE user_login set token = '$OTP' where username = '$email'");

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'wahyunurdian98@gmail.com';
                $mail->Password = 'nmxb ondg ykmt mhvp';
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                // Atur pengirim email
                $mail->setFrom('wahyunurdian98@gmail.com', 'Website Desa Tanah Baru');
                // Atur penerima email
                $mail->addAddress($email_penerima);
                // Atur reply to
                $mail->addReplyTo('wahyunurdian98@gmail.com', 'Informasi lengkap');


                // Isi email
                $mail->isHTML();
                // Atur subjek
                $mail->Subject = 'Kode OTP';
                $mail->Body = "Your OTP code is : $OTP";

                // Kirim email kita
                $mail->send();
                // $_SESSION["simpan"] = 'Email berhasil dikirim, cek email anda lalu login kembali';
                header('Location: OTP.php?email=' . $email . '');
            } catch (Exception $e) {
                $_SESSION["gagal"] = 'Email yang anda masukan tidak terdaftar';
                header('Location: forgot-password.php');
            }
        }
    }

    public function confirmOTP()
    {
        $id_pengguna = $_POST['idp'];
        $token = $_POST['token'];
        $otp = $_POST['otp'];

        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM user_login WHERE id_pengguna = '$id_pengguna' ");
        $data = mysqli_fetch_array($cek);

        if (($otp != $data['token'])) {
            //set session gagal
            $_SESSION["gagal"] = 'OTP Salah!';
            //redirect ke halaman
            echo '<script> location.replace("OTP.php?email=' . $data['username'] . '"); </script>';
        } else {
            echo '<script> location.replace("new_password.php?otp=' . $otp . '"); </script>';
        }
    }

    public function Reset_password()
    {
        $id_pengguna = $_POST['idp'];
        $username = $_POST['username'];

        $new_password = base64_encode($_POST['new-password']);
        $confirm_password = base64_encode($_POST['confirm-password']);

        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM user_login WHERE id_pengguna = '$id_pengguna' ");
        $data = mysqli_fetch_array($cek);

        if (($new_password != $confirm_password)) {
            //set session gagal
            $_SESSION["gagal"] = 'Password tidak sama!';
            //redirect ke halaman
            echo '<script> location.replace("new_password.php?otp=' . $data['token'] . '"); </script>';
        } else {
            $OTP = rand(100000, 999999);
            $query = mysqli_query($this->koneksi->link, "UPDATE user_login set password = '$confirm_password', token = '$OTP' where id_pengguna = '$id_pengguna'");
            $decode = base64_decode($confirm_password);
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'wahyunurdian98@gmail.com';
                $mail->Password = 'nmxb ondg ykmt mhvp';
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                // Atur pengirim email
                $mail->setFrom('wahyunurdian98@gmail.com', 'Website Desa Tanah Baru');
                // Atur penerima email
                $mail->addAddress($username);
                // Atur reply to
                $mail->addReplyTo('wahyunurdian98@gmail.com', 'Informasi lengkap');


                // Isi email
                $mail->isHTML();
                // Atur subjek
                $mail->Subject = 'Password Reset';
                $mail->Body = "<p>Terima kasih Anda sudah melakukan reset password dan silahkan login menggunakan password dibawah ini:</p><br>
                <table class='table'>
                <tbody>
                    <tr>
                        <th style='text-align:left;'>Username</th>
                        <td>:</td>
                        <td>$username</td>
                    </tr>
                    <tr>
                        <th style='text-align:left;'>Password</th>
                        <td>:</td>
                        <td>$decode</td>
                    </tr>
                    
                </tbody>
            </table>";

                // Kirim email kita
                $mail->send();
                $_SESSION["simpan"] = 'Password berhasil direset';
                header('Location: login.php');
            } catch (Exception $e) {
                // $_SESSION["gagal"] = 'gagal';
                header('Location: login.php');
            }
        }
    }
}
