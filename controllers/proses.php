<?php
// pxzm hhyn xqca hfis
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

require_once "../../controllers/login.php";
require_once "../../views/include/main.php";
require_once "../../models/pengguna.php";
require_once "../../models/kriteria.php";
require_once "../../models/alternatif.php";
require_once "../../models/subkriteria.php";
require_once "../../models/bobot.php";
require_once "../../models/hasil.php";
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);
class proses extends login
{

    public function SimpanDataKriteria()
    {
        $this->Simpan = new kriteria();
        $this->Simpan->Setid_kriteria();
        $this->Simpan->Setnama();
        $this->Simpan->Setbobot();
        $this->Simpan->Getid_kriteria();
        $this->Simpan->Getnama();
        $this->Simpan->Getbobot();
        $status = '0';
    
        $normalisasi_bobot = '0';
        $query = mysqli_query($this->koneksi->link, "SELECT * FROM kriteria WHERE nama = '" . $this->Simpan->nama . "'");
        $sql = mysqli_num_rows($query);
        $query1 = mysqli_query($this->koneksi->link, "SELECT * FROM kriteria");
        $sql1 = mysqli_num_rows($query1);
    
        // Hitung total bobot yang ada
        $query2 = mysqli_query($this->koneksi->link, "SELECT SUM(bobot) as total_bobot FROM kriteria");
        $result = mysqli_fetch_assoc($query2);
        $total_bobot = $result['total_bobot'];
    
        // Tambahkan bobot kriteria baru ke total bobot
        $total_bobot += $this->Simpan->bobot;
    
        if ($sql > 0) {
            $_SESSION["error"] = 'Kriteria sudah ada!';
            // Redirect ke halaman
            echo '<script> location.replace("../kriteria/data_kriteria.php"); </script>';
        } elseif ($sql1 >= 10) {
            $_SESSION["error"] = 'Jumlah data kriteria hanya boleh 10 kriteria!';
            // Redirect ke halaman
            echo '<script> location.replace("../kriteria/data_kriteria.php"); </script>';
        } elseif ($total_bobot > 100) {
            $_SESSION["error"] = 'Total bobot kriteria tidak boleh lebih dari 100!';
            // Redirect ke halaman
            echo '<script> location.replace("../kriteria/data_kriteria.php"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO kriteria (id_kriteria, id_pengguna, nama, bobot, normalisasi_bobot, status) VALUES ('" . $this->Simpan->id_kriteria . "','" . $_SESSION['id_pengguna'] . "','" . $this->Simpan->nama . "','" . $this->Simpan->bobot . "','$normalisasi_bobot','$status')");
            include "../kriteria/normalisasi_bobot_kriteria.php";
            if ($Simpan) {
                // Set session sukses
                $_SESSION["success"] = 'Data kriteria berhasil ditambahkan!';
                // Redirect ke halaman
                echo '<script> location.replace("../kriteria/data_kriteria.php"); </script>';
            } else {
                // Set session gagal
                $_SESSION["error"] = 'Gagal!';
                // Redirect ke halaman
                echo '<script> location.replace("../kriteria/data_kriteria.php"); </script>';
            }
        }
    }
    

    public function SimpanProsesNormalisasi()
    {
        $normalisasi = $this->koneksi->link->query("select * from kriteria");
        while ($data1 = $normalisasi->fetch_assoc()) {
            $jml = $data1['bobot'];
            $total = $total + $jml;
        }

        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K01'");
        $data = mysqli_fetch_array($proses);
        $umurtanaman  = $data['bobot'];
        $K01 = $umurtanaman / $total;

        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K02'");
        $data = mysqli_fetch_array($proses);
        $hasilproduksi  = $data['bobot'];
        $K02 = $hasilproduksi / $total;

        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K03'");
        $data = mysqli_fetch_array($proses);
        $jmlanak    = $data['bobot'];
        $K03 = $jmlanak / $total;

        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K04'");
        $data = mysqli_fetch_array($proses);
        $ketahananhama    = $data['bobot'];
        $K04 = $ketahananhama / $total;

        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K05'");
        $data = mysqli_fetch_array($proses);
        $Var1  = $data['bobot'];
        $K05 = $Var1 / $total;

        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K06'");
        $data = mysqli_fetch_array($proses);
        $Var2     = $data['bobot'];
        $K06 = $Var2 / $total;

        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K07'");
        $data = mysqli_fetch_array($proses);
        $Var3     = $data['bobot'];
        $K07 = $Var3 / $total;


        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K08'");
        $data = mysqli_fetch_array($proses);
        $Var4     = $data['bobot'];
        $K08 = $Var4 / $total;

        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K09'");
        $data = mysqli_fetch_array($proses);
        $Var4     = $data['bobot'];
        $K08 = $Var4 / $total;

        $proses = $this->koneksi->link->query("select bobot from kriteria where id_kriteria ='K10'");
        $data = mysqli_fetch_array($proses);
        $Var4     = $data['bobot'];
        $K08 = $Var4 / $total;


        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K01' where id_kriteria ='K01'");
        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K02' where id_kriteria ='K02'");
        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K03' where id_kriteria ='K03'");
        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K04' where id_kriteria ='K04'");
        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K05' where id_kriteria ='K05'");
        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K06' where id_kriteria ='K06'");
        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K07' where id_kriteria ='K07'");
        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K08' where id_kriteria ='K08'");
        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K07' where id_kriteria ='K09'");
        mysqli_query($this->koneksi->link, "UPDATE kriteria set normalisasi_bobot='$K08' where id_kriteria ='K10'");
    }

    public function SimpanEditKriteria()
    {
        $this->Update = new kriteria();
        $this->Update->Setid_kriteria();
        $this->Update->Setnama();
        $this->Update->Setbobot();
        $this->Update->Getid_kriteria();
        $this->Update->Getnama();
        $this->Update->Getbobot();

        $Update = mysqli_query($this->koneksi->link, "UPDATE kriteria set nama = '" . $this->Update->nama . "', bobot = '" . $this->Update->bobot . "' where id_kriteria = '" . $this->Update->id_kriteria . "'");
        include "../kriteria/normalisasi_bobot_kriteria.php";
        if ($Update) {
            //set session sukses
            $_SESSION["success"] = 'Data kriteria berhasil diubah!';
            //redirect ke halaman
            echo '<script> location.replace("../kriteria/data_kriteria.php"); </script>';
        } else {
            //set session gagal
            $_SESSION["error"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../kriteria/data_kriteria.php"); </script>';
        }
    }

    public function HapusKriteria()
    {
        $id_kriteria = $_GET['key'];
        if ($_SESSION['role'] == 'ROL001') {
            $home = '../kriteria/data_kriteria.php';
        } elseif ($_SESSION['role'] == 'ROL002') {
            $home = '../pakar/validasi_data_kriteria.php';
        }
        $detele = mysqli_query($this->koneksi->link, "DELETE FROM kriteria where id_kriteria = '$id_kriteria'");
        include "../kriteria/normalisasi_bobot_kriteria.php";
        if ($detele) {
            $_SESSION["success"] = 'Data berhasil dihapus!';
            echo '<script> location.replace("' . $home . '"); </script>';
        } else {
            $_SESSION["error"] = 'gagal!';
            echo '<script> location.replace("' . $home . '"); </script>';
        }
    }

    public function SimpanValidasiKriteria()
    {
        $key = $_GET['key'];
        $update = mysqli_query($this->koneksi->link, "UPDATE kriteria set status = '1' where id_kriteria = '" . $key . "'");
        if ($update) {
            //set session sukses
            $_SESSION["success"] = 'Data kriteria berhasil divalidasi!';
            //redirect ke halaman
            echo '<script> location.replace("../pakar/validasi_data_kriteria.php"); </script>';
        } else {
            //set session gagal
            $_SESSION["error"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../pakar/validasi_data_kriteria.php"); </script>';
        }
    }

    public function SimpanSubKriteria()
    {
        $this->Simpan = new subkriteria();
        $this->Simpan->Setid_kriteria();
        $this->Simpan->Setparameter();
        $this->Simpan->Setnilai();
        $this->Simpan->Getid_kriteria();
        $this->Simpan->Getparameter();
        $this->Simpan->Getnilai();

        $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO sub_kriteria values('','" . $this->Simpan->id_kriteria . "', '" . $_SESSION['id_pengguna'] . "', '" . $this->Simpan->parameter . "', '" . $this->Simpan->nilai . "')");
        if ($Simpan) {
            $_SESSION["success"] = 'Data berhasil disimpan!';
            echo '<script> location.replace("../subkriteria/data_subkriteria.php"); </script>';
        } else {
            $_SESSION["error"] = 'gagal!';
            echo '<script> location.replace("../subkriteria/data_subkriteria.php"); </script>';
        }
    }

    public function SimpanEditSubKriteria()
    {
        $this->Update = new subkriteria();
        $this->Update->Setid_kriteria();
        $this->Update->Setid_sub_kriteria();
        $this->Update->Setparameter();
        $this->Update->Setnilai();
        $this->Update->Getid_kriteria();
        $this->Update->Getid_sub_kriteria();
        $this->Update->Getparameter();
        $this->Update->Getnilai();

        $Update = mysqli_query($this->koneksi->link, "UPDATE sub_kriteria set id_kriteria = '" . $this->Update->id_kriteria . "', parameter = '" . $this->Update->parameter . "', nilai = '" . $this->Update->nilai . "' where id_sub_kriteria = '" . $this->Update->id_sub_kriteria . "'");
        if ($Update) {
            $_SESSION["success"] = 'Data berhasil diubah!';
            echo '<script> location.replace("../subkriteria/data_subkriteria.php"); </script>';
        } else {
            $_SESSION["error"] = 'gagal!';
            echo '<script> location.replace("../subkriteria/data_subkriteria.php"); </script>';
        }
    }

    public function HapusSubKriteria()
    {
        $key = $_GET['key'];
        $detele = mysqli_query($this->koneksi->link, "DELETE FROM sub_kriteria where id_sub_kriteria = '$key'");
        if ($detele) {
            $_SESSION["success"] = 'Data berhasil dihapus!';
            echo '<script> location.replace("../subkriteria/data_subkriteria.php"); </script>';
        } else {
            $_SESSION["error"] = 'gagal!';
            echo '<script> location.replace("../subkriteria/data_subkriteria.php"); </script>';
        }
    }

    public function SimpanAlternatif()
    {
        $this->Simpan = new alternatif();
        $this->Simpan->Setid_alternatif();
        $this->Simpan->Setnama_alternatif();
        $this->Simpan->Getid_alternatif();
        $this->Simpan->Getnama_alternatif();
        $status = '0';

        $query = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif where nama_alternatif = '" . $this->Simpan->nama_alternatif . "'");
        $sql = mysqli_num_rows($query);

        if ($sql > 0) {
            $_SESSION["error"] = 'Alternatif sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../alternatif/data_alternatif.php"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT into alternatif values ('" . $this->Simpan->id_alternatif . "','" . $_SESSION['id_pengguna'] . "','" . $this->Simpan->nama_alternatif . "', '" . $status . "')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["success"] = 'Data alternatif berhasil ditambahkan!';
                //redirect ke halaman
                echo '<script> location.replace("../alternatif/data_alternatif.php"); </script>';
            } else {
                //set session gagal
                $_SESSION["error"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../alternatif/data_alternatif.php"); </script>';
            }
        }
    }

    public function SimpanEditAlternatif()
    {
        $this->Update = new alternatif();
        $this->Update->Setid_alternatif();
        $this->Update->Setnama_alternatif();
        $this->Update->Getid_alternatif();
        $this->Update->Getnama_alternatif();

        $Update = mysqli_query($this->koneksi->link, "UPDATE alternatif set nama_alternatif = '" . $this->Update->nama_alternatif . "' where id_alternatif = '" . $this->Update->id_alternatif . "'");
        if ($Update) {
            //set session sukses
            $_SESSION["success"] = 'Data alternatif berhasil diubah!';
            //redirect ke halaman
            echo '<script> location.replace("../alternatif/data_alternatif.php"); </script>';
        } else {
            //set session gagal
            $_SESSION["error"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../alternatif/data_alternatif.php"); </script>';
        }
    }

    public function HapusAlternatif()
    {
        $key = $_GET['key'];
        if ($_SESSION['role'] == 'ROL001') {
            $home = '../alternatif/data_alternatif.php';
        } elseif ($_SESSION['role'] == 'ROL002') {
            $home = '../pakar/validasi_data_alternatif.php';
        }
        $detele = mysqli_query($this->koneksi->link, "DELETE FROM alternatif where id_alternatif = '$key'");
        if ($detele) {
            //set session sukses
            $_SESSION["success"] = 'Data alternatif berhasil dihapus!';
            //redirect ke halaman
            echo '<script> location.replace("' . $home . '"); </script>';
        } else {
            //set session gagal
            $_SESSION["error"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("' . $home . '"); </script>';
        }
    }

    public function SimpanValidasi()
    {
        $key = $_GET['key'];
        $update = mysqli_query($this->koneksi->link, "UPDATE alternatif set status = '1' where id_alternatif = '" . $key . "'");
        if ($update) {
            //set session sukses
            $_SESSION["success"] = 'Data alternatif berhasil divalidasi!';
            //redirect ke halaman
            echo '<script> location.replace("../pakar/validasi_data_alternatif.php"); </script>';
        } else {
            //set session gagal
            $_SESSION["error"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../pakar/validasi_data_alternatif.php"); </script>';
        }
    }

    public function SimpanBobot()
    {
        $this->Simpan = new bobot();
        $this->Simpan->Setid_alternatif();
        $this->Simpan->Setnilai();
        $this->Simpan->Getid_alternatif();
        $this->Simpan->Getnilai();
        $val1 = $this->Simpan->nilai[0];
        $val2 = $this->Simpan->nilai[1];
        $val3 = $this->Simpan->nilai[2];
        $val4 = $this->Simpan->nilai[3];
        $val5 = $this->Simpan->nilai[4];
        $val6 = $this->Simpan->nilai[5];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM bobot_alternatif where id_alternatif = '" . $this->Simpan->id_alternatif . "'");
        $jml = mysqli_num_rows($cek);
        $nilai = '0';

        if ($jml > 0) {
            $_SESSION["error"] = 'Alternatif sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../bobot_alternatif/data_bobot.php"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO bobot_alternatif values('','" . $_SESSION['id_pengguna'] . "', '" . $this->Simpan->id_alternatif . "','" . $val1 . "','" . $val2 . "','" . $val3 . "','" . $val4 . "','" . $val5 . "','" . $val6 . "')");
            require_once "../bobot_alternatif/simpan_hasil.php";
            if ($Simpan) {
                //set session sukses
                $_SESSION["success"] = 'Data berhasil ditambahkan!';
                //redirect ke halaman
                echo '<script> location.replace("../bobot_alternatif/data_bobot.php"); </script>';
            } else {
                //set session gagal
                $_SESSION["error"] = 'gagal';
                //redirect ke halaman
                echo '<script> location.replace("../bobot_alternatif/data_bobot.php"); </script>';
            }
        }
    }

    public function HapusBobot()
    {
        $key = $_GET['key'];
        $delete = mysqli_query($this->koneksi->link, "DELETE FROM bobot_alternatif where id_alternatif = '$key'");
        $delete = mysqli_query($this->koneksi->link, "DELETE FROM hasil where id_alternatif = '$key'");
        if ($delete) {
            //set session sukses
            $_SESSION["success"] = 'Data berhasil dihapus!';
            //redirect ke halaman
            echo '<script> location.replace("../bobot_alternatif/data_bobot.php"); </script>';
        } else {
            //set session gagal
            $_SESSION["error"] = 'gagal';
            //redirect ke halaman
            echo '<script> location.replace("../bobot_alternatif/data_bobot.php"); </script>';
        }
    }


    public function ProsesPerhitunganTOPSIS()
    { ?>
        <!-- <?php error_reporting(0); ?> -->
        <?php $activePage = "bobot_alternatif"; ?>

        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <!-- Sidebar Start -->
            <?php require_once "../layout/sidebar.php"; ?>
            <!-- End-Sidebar Start -->
            <!--  Main wrapper -->
            <div class="body-wrapper">
                <!-- Header Start -->
                <?php require_once "../layout/navbar.php"; ?>
                <!-- End-Header Start -->
                <!-- Content Start -->
                <div class="container-fluid">
                    <!--  Row 1 -->
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold mb-4">Proses atau Tahapan Perhitungan metode TOPSIS</h5>
                                    <hr>
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="card-title fw-semibold" style="font-size: 14px;">1. Menentukan Nilai Setiap Alternatif di Setiap Kriteria</h5>
                                        </div>

                                        <div class="col-auto">
                                            <a data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="true" aria-controls="multiCollapseExample1">
                                                <button type="button" class="btn btn-sm"><i class="fas fa-plus" style="font-size: 20px;"></i></button>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="collapse multi-collapse" id="multiCollapseExample1">

                                        <!-- Table Data Pengguna -->
                                        <div class="table-responsive">
                                            <!--Table Responsive-->
                                            <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle text-center" colspan="6">
                                                            <h6 class="fw-semibold mb-0">Kriteria</h6>
                                                        </th>

                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K01</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K02</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K03</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K04</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K05</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K06</h6>
                                                        </td>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif ");

                                                    while ($row = mysqli_fetch_array($data)) {


                                                    ?> <tr>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0"><?= $row['id_alternatif'] ?></h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $row['k01']; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $row['k02']; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $row['k03']; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $row['k04']; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $row['k05']; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $row['k06']; ?></p>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <!--End-Table Responsive-->

                                        </div>
                                        <!-- End-Table Data Pengguna -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold mb-4">2. Membuat matriks keputusan yang ternormalisasi R
                                    </h5>

                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="card-title fw-semibold" style="font-size: 14px;">Tahap pertama adalah mengkuadratkan masing-masing nilai alternatif xij</h5>
                                        </div>

                                        <div class="col-auto">
                                            <a data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="true" aria-controls="multiCollapseExample2">
                                                <button type="button" class="btn btn-sm"><i class="fas fa-plus" style="font-size: 20px;"></i></button>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                                        <!-- Table Data Pengguna -->
                                        <div class="table-responsive">
                                            <!--Table Responsive-->
                                            <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle text-center" colspan="6">
                                                            <h6 class="fw-semibold mb-0">Kriteria</h6>
                                                        </th>

                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K01</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K02</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K03</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K04</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K05</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K06</h6>
                                                        </td>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    //Memanggil Kriteria pada baris Alternatif (K01, K02, K03, K04, K05)
                                                    $K01 = $this->koneksi->link->query("select k01 from bobot_alternatif");
                                                    $K02 = $this->koneksi->link->query("select k02 from bobot_alternatif");
                                                    $K03 = $this->koneksi->link->query("select k03 from bobot_alternatif");
                                                    $K04 = $this->koneksi->link->query("select k04 from bobot_alternatif");
                                                    $K05 = $this->koneksi->link->query("select k05 from bobot_alternatif");
                                                    $K06 = $this->koneksi->link->query("select k06 from bobot_alternatif");

                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif ");

                                                    while ($row = mysqli_fetch_array($data)) {
                                                        $var1 = mysqli_fetch_array($K01);
                                                        $var2 = mysqli_fetch_array($K02);
                                                        $var3 = mysqli_fetch_array($K03);
                                                        $var4 = mysqli_fetch_array($K04);
                                                        $var5 = mysqli_fetch_array($K05);
                                                        $var6 = mysqli_fetch_array($K06);


                                                        $K01A = pow($var1['k01'], 2);
                                                        $jumlah[] = $K01A;
                                                        $total1 = array_sum($jumlah);
                                                        $sqrt1 = sqrt($total1);

                                                        $K02A = pow($var2['k02'], 2);
                                                        $jumlah1[] = $K02A;
                                                        $total2 = array_sum($jumlah1);
                                                        $sqrt2 = sqrt($total2);

                                                        $K03A = pow($var3['k03'], 2);
                                                        $jumlah3[] = $K03A;
                                                        $total3 = array_sum($jumlah3);
                                                        $sqrt3 = sqrt($total3);

                                                        $K04A = pow($var4['k04'], 2);
                                                        $jumlah4[] = $K04A;
                                                        $total4 = array_sum($jumlah4);
                                                        $sqrt4 = sqrt($total4);

                                                        $K05A = pow($var5['k05'], 2);
                                                        $jumlah5[] = $K05A;
                                                        $total5 = array_sum($jumlah5);
                                                        $sqrt5 = sqrt($total5);

                                                        $K06A = pow($var6['k06'], 2);
                                                        $jumlah6[] = $K06A;
                                                        $total6 = array_sum($jumlah6);
                                                        $sqrt6 = sqrt($total6);

                                                    ?> <tr>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0"><?= $row['id_alternatif'] ?></h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $K01A; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $K02A; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $K03A; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $K04A; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $K05A; ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= $K06A; ?></p>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td class="border-bottom-0" colspan="2">
                                                            <p class="mb-0 fw-bold" style="text-align: center;">TOTAL</p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= $total1; ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= $total2; ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= $total3; ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= $total4; ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= $total5; ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= $total6; ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0" colspan="2">
                                                            <p class="mb-0 fw-bold" style="text-align: center;">SQRT</p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= number_format($sqrt1, 3); ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= number_format($sqrt2, 3); ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= number_format($sqrt3, 3); ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= number_format($sqrt4, 3); ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= number_format($sqrt5, 3); ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-bold"><?= number_format($sqrt6, 3); ?></p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--End-Table Responsive-->

                                        </div>
                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="card-title fw-semibold" style="font-size: 14px;">Tahap kedua normalisasi adalah membagi setiap elemen matriks xij dengan hasil tabel di atas.</h5>
                                        </div>

                                        <div class="col-auto">
                                            <a data-bs-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="true" aria-controls="multiCollapseExample3">
                                                <button type="button" class="btn btn-sm"><i class="fas fa-plus" style="font-size: 20px;"></i></button>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="collapse multi-collapse" id="multiCollapseExample3">
                                        <!-- Table Data Pengguna -->
                                        <div class="table-responsive">
                                            <!--Table Responsive-->
                                            <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle text-center" colspan="6">
                                                            <h6 class="fw-semibold mb-0">Kriteria</h6>
                                                        </th>

                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K01</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K02</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K03</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K04</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K05</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K06</h6>
                                                        </td>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    //Memanggil Kriteria pada baris Alternatif (K01, K02, K03, K04, K05)
                                                    $varK01 = $this->koneksi->link->query("select k01 from bobot_alternatif");
                                                    $varK02 = $this->koneksi->link->query("select k02 from bobot_alternatif");
                                                    $varK03 = $this->koneksi->link->query("select k03 from bobot_alternatif");
                                                    $varK04 = $this->koneksi->link->query("select k04 from bobot_alternatif");
                                                    $varK05 = $this->koneksi->link->query("select k05 from bobot_alternatif");
                                                    $varK06 = $this->koneksi->link->query("select k06 from bobot_alternatif");

                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif ");

                                                    while ($row = mysqli_fetch_array($data)) {
                                                        $K01var1 = mysqli_fetch_array($varK01);
                                                        $K01var2 = mysqli_fetch_array($varK02);
                                                        $K01var3 = mysqli_fetch_array($varK03);
                                                        $K01var4 = mysqli_fetch_array($varK04);
                                                        $K01var5 = mysqli_fetch_array($varK05);
                                                        $K01var6 = mysqli_fetch_array($varK06);

                                                        $K01B = pow($K01var1['k01'], 2);
                                                        $A = $K01B / $sqrt1;

                                                        $K02B = pow($K01var2['k02'], 2);
                                                        $B = $K02B / $sqrt2;

                                                        $K03B = pow($K01var3['k03'], 2);
                                                        $C = $K03B / $sqrt3;

                                                        $K04B = pow($K01var4['k04'], 2);
                                                        $D = $K04B / $sqrt4;

                                                        $K05B = pow($K01var5['k05'], 2);
                                                        $E = $K05B / $sqrt5;

                                                        $K06B = pow($K01var6['k06'], 2);
                                                        $F = $K06B / $sqrt6;

                                                    ?> <tr>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0"><?= $row['id_alternatif'] ?></h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($A, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($B, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($C, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($D, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($E, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($F, 3); ?></p>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                            <!--End-Table Responsive-->

                                        </div>
                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold mb-4">3. Membuat matriks keputusan yang ternormalisasi terbobot Y </h5>

                                    <!-- Table Data Pengguna -->
                                    <div class="table-responsive">
                                        <!--Table Responsive-->
                                        <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Kode</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Nama Kriteria</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Bobot</h6>
                                                    </th>

                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Normalisasi</h6>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $data_kriteria = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria");
                                                while ($row = mysqli_fetch_array($data_kriteria)) {

                                                ?>
                                                    <tr>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= $row['id_kriteria'] ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <p class="mb-0 fw-normal"><?= $row['nama'] ?></p>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= $row['bobot'] ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= number_format($row['normalisasi_bobot'], 2) ?></h6>
                                                        </td>
                                                    </tr>

                                                <?php } ?>

                                            </tbody>
                                        </table>
                                        <!--End-Table Responsive-->
                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="card-title fw-semibold" style="font-size: 14px;">Tahap ini adalah mengakalikan matriks normalisasi R dengan normalisasi bobot kriteria di atas</h5>
                                        </div>

                                        <div class="col-auto">
                                            <a data-bs-toggle="collapse" href="#multiCollapseExample4" role="button" aria-expanded="true" aria-controls="multiCollapseExample4">
                                                <button type="button" class="btn btn-sm"><i class="fas fa-plus" style="font-size: 20px;"></i></button>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="collapse multi-collapse" id="multiCollapseExample4">
                                        <!-- Table Data Pengguna -->
                                        <div class="table-responsive">
                                            <!--Table Responsive-->
                                            <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle text-center" colspan="6">
                                                            <h6 class="fw-semibold mb-0">Kriteria</h6>
                                                        </th>

                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K01</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K02</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K03</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K04</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K05</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K06</h6>
                                                        </td>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    //QUERY TABEL KRITERIA 
                                                    $sql1 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K01'");
                                                    $data01 = mysqli_fetch_array($sql1);
                                                    $sql2 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K02'");
                                                    $data02 = mysqli_fetch_array($sql2);
                                                    $sql3 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K03'");
                                                    $data03 = mysqli_fetch_array($sql3);
                                                    $sql4 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K04'");
                                                    $data04 = mysqli_fetch_array($sql4);
                                                    $sql5 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K05'");
                                                    $data05 = mysqli_fetch_array($sql5);
                                                    $sql6 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K06'");
                                                    $data06 = mysqli_fetch_array($sql6);

                                                    //Memanggil Kriteria pada baris Alternatif (K01, K02, K03, K04, K05, K06)
                                                    $var1K01 = $this->koneksi->link->query("select k01 from bobot_alternatif");
                                                    $var2K02 = $this->koneksi->link->query("select k02 from bobot_alternatif");
                                                    $var3K03 = $this->koneksi->link->query("select k03 from bobot_alternatif");
                                                    $var4K04 = $this->koneksi->link->query("select k04 from bobot_alternatif");
                                                    $var5K05 = $this->koneksi->link->query("select k05 from bobot_alternatif");
                                                    $var6K06 = $this->koneksi->link->query("select k06 from bobot_alternatif");

                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif ");

                                                    while ($row = mysqli_fetch_array($data)) {
                                                        //ALTERNATIF
                                                        $K01var11 = mysqli_fetch_array($var1K01);
                                                        $K01var12 = mysqli_fetch_array($var2K02);
                                                        $K01var13 = mysqli_fetch_array($var3K03);
                                                        $K01var14 = mysqli_fetch_array($var4K04);
                                                        $K01var15 = mysqli_fetch_array($var5K05);
                                                        $K01var16 = mysqli_fetch_array($var6K06);

                                                        $K011B = pow($K01var11['k01'], 2);
                                                        $varA = $K011B / $sqrt1;
                                                        $Hasil1   =  $data01['normalisasi_bobot'] * $varA;
                                                        $max1[] = $Hasil1;
                                                        $MaxK01 = max($max1);
                                                        $MinK01 = min($max1);

                                                        $K012B = pow($K01var12['k02'], 2);
                                                        $varB = $K012B / $sqrt2;
                                                        $Hasil2   =  $data02['normalisasi_bobot'] * $varB;
                                                        $max2[] = $Hasil2;
                                                        $MaxK02 = max($max2);
                                                        $MinK02 = min($max2);

                                                        $K013B = pow($K01var13['k03'], 2);
                                                        $varC = $K013B / $sqrt3;
                                                        $Hasil3   =  $data03['normalisasi_bobot'] * $varC;
                                                        $max3[] = $Hasil3;
                                                        $MaxK03 = max($max3);
                                                        $MinK03 = min($max3);

                                                        $K014B = pow($K01var14['k04'], 2);
                                                        $varD = $K014B / $sqrt4;
                                                        $Hasil4   =  $data04['normalisasi_bobot'] * $varD;
                                                        $max4[] = $Hasil4;
                                                        $MaxK04 = max($max4);
                                                        $MinK04 = min($max4);

                                                        $K015B = pow($K01var15['k05'], 2);
                                                        $varE = $K015B / $sqrt5;
                                                        $Hasil5   =  $data05['normalisasi_bobot'] * $varE;
                                                        $max5[] = $Hasil5;
                                                        $MaxK05 = max($max5);
                                                        $MinK05 = min($max5);

                                                        $K016B = pow($K01var16['k06'], 2);
                                                        $varF = $K016B / $sqrt6;
                                                        $Hasil6   =  $data06['normalisasi_bobot'] * $varF;
                                                        $max6[] = $Hasil6;
                                                        $MaxK06 = max($max6);
                                                        $MinK06 = min($max6);

                                                    ?> <tr>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0"><?= $row['id_alternatif'] ?></h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($Hasil1, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($Hasil2, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($Hasil3, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($Hasil4, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($Hasil5, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($Hasil6, 3); ?></p>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                            <!--End-Table Responsive-->

                                        </div>
                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold mb-4">4. Solusi ideal positif A+ dan solusi ideal negatif A- dapat ditentukan berdasarkan rating bobot ternormalisasi (Yij). </h5>

                                    <!-- Table Data Pengguna -->
                                    <div class="table-responsive">
                                        <!--Table Responsive-->
                                        <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" colspan="2">
                                                        <p class="mb-0 fw-bold" style="text-align: center;">MAX</p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MaxK01, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MaxK02, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MaxK03, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MaxK04, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MaxK05, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MaxK06, 3); ?></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-bottom-0" colspan="2">
                                                        <p class="mb-0 fw-bold" style="text-align: center;">MIN</p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MinK01, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MinK02, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MinK03, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MinK04, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MinK05, 3); ?></p>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <p class="mb-0 fw-bold"><?= number_format($MinK06, 3); ?></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--End-Table Responsive-->

                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="card-title fw-semibold" style="font-size: 14px;">5. Jarak antara nilai alternatif Ai dengan solusi ideal positif+</h5>
                                        </div>

                                        <div class="col-auto">
                                            <a data-bs-toggle="collapse" href="#multiCollapseExample5" role="button" aria-expanded="true" aria-controls="multiCollapseExample5">
                                                <button type="button" class="btn btn-sm"><i class="fas fa-plus" style="font-size: 20px;"></i></button>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="collapse multi-collapse" id="multiCollapseExample5">
                                        <!-- Table Data Pengguna -->
                                        <div class="table-responsive">
                                            <!--Table Responsive-->
                                            <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle text-center" colspan="6">
                                                            <h6 class="fw-semibold mb-0">Kriteria</h6>
                                                        </th>

                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K01</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K02</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K03</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K04</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K05</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K06</h6>
                                                        </td>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    //QUERY TABEL KRITERIA 
                                                    $sql1 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K01'");
                                                    $data01 = mysqli_fetch_array($sql1);
                                                    $sql2 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K02'");
                                                    $data02 = mysqli_fetch_array($sql2);
                                                    $sql3 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K03'");
                                                    $data03 = mysqli_fetch_array($sql3);
                                                    $sql4 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K04'");
                                                    $data04 = mysqli_fetch_array($sql4);
                                                    $sql5 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K05'");
                                                    $data05 = mysqli_fetch_array($sql5);
                                                    $sql6 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K06'");
                                                    $data06 = mysqli_fetch_array($sql6);

                                                    //Memanggil Kriteria pada baris Alternatif (K01, K02, K03, K04, K05, K06)
                                                    $var1K01 = $this->koneksi->link->query("select k01 from bobot_alternatif");
                                                    $var2K02 = $this->koneksi->link->query("select k02 from bobot_alternatif");
                                                    $var3K03 = $this->koneksi->link->query("select k03 from bobot_alternatif");
                                                    $var4K04 = $this->koneksi->link->query("select k04 from bobot_alternatif");
                                                    $var5K05 = $this->koneksi->link->query("select k05 from bobot_alternatif");
                                                    $var6K06 = $this->koneksi->link->query("select k06 from bobot_alternatif");

                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif ");

                                                    while ($row = mysqli_fetch_array($data)) {
                                                        //ALTERNATIF
                                                        $K01var11 = mysqli_fetch_array($var1K01);
                                                        $K01var12 = mysqli_fetch_array($var2K02);
                                                        $K01var13 = mysqli_fetch_array($var3K03);
                                                        $K01var14 = mysqli_fetch_array($var4K04);
                                                        $K01var15 = mysqli_fetch_array($var5K05);
                                                        $K01var16 = mysqli_fetch_array($var6K06);

                                                        $K011B = pow($K01var11['k01'], 2);
                                                        $varA = $K011B / $sqrt1;
                                                        $Hasil1   =  $data01['normalisasi_bobot'] * $varA;
                                                        $positif1 = $Hasil1 - $MaxK01;
                                                        $positifK01 = pow($positif1, 2);

                                                        $K012B = pow($K01var12['k02'], 2);
                                                        $varB = $K012B / $sqrt2;
                                                        $Hasil2   =  $data02['normalisasi_bobot'] * $varB;
                                                        $positif2 = $Hasil2 - $MaxK02;
                                                        $positifK02 = pow($positif2, 2);


                                                        $K013B = pow($K01var13['k03'], 2);
                                                        $varC = $K013B / $sqrt3;
                                                        $Hasil3   =  $data03['normalisasi_bobot'] * $varC;
                                                        $positif3 = $Hasil3 - $MaxK03;
                                                        $positifK03 = pow($positif3, 2);


                                                        $K014B = pow($K01var14['k04'], 2);
                                                        $varD = $K014B / $sqrt4;
                                                        $Hasil4   =  $data04['normalisasi_bobot'] * $varD;
                                                        $positif4 = $Hasil4 - $MaxK04;
                                                        $positifK04 = pow($positif4, 2);


                                                        $K015B = pow($K01var15['k05'], 2);
                                                        $varE = $K015B / $sqrt5;
                                                        $Hasil5   =  $data05['normalisasi_bobot'] * $varE;
                                                        $positif5 = $Hasil5 - $MaxK05;
                                                        $positifK05 = pow($positif5, 2);


                                                        $K016B = pow($K01var16['k06'], 2);
                                                        $varF = $K016B / $sqrt6;
                                                        $Hasil6   =  $data06['normalisasi_bobot'] * $varF;
                                                        $positif6 = $Hasil6 - $MaxK06;
                                                        $positifK06 = pow($positif6, 2);


                                                    ?> <tr>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0"><?= $row['id_alternatif'] ?></h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($positifK01, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($positifK02, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($positifK03, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($positifK04, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($positifK05, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($positifK06, 3); ?></p>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                            <!--End-Table Responsive-->

                                        </div>
                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="card-title fw-semibold" style="font-size: 14px;">6. Jarak antara nilai alternatif Ai dengan solusi ideal negatif- </h5>
                                        </div>

                                        <div class="col-auto">
                                            <a data-bs-toggle="collapse" href="#multiCollapseExample6" role="button" aria-expanded="true" aria-controls="multiCollapseExample6">
                                                <button type="button" class="btn btn-sm"><i class="fas fa-plus" style="font-size: 20px;"></i></button>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="collapse multi-collapse" id="multiCollapseExample6">
                                        <!-- Table Data Pengguna -->
                                        <div class="table-responsive">
                                            <!--Table Responsive-->
                                            <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle" rowspan="2">
                                                            <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle text-center" colspan="6">
                                                            <h6 class="fw-semibold mb-0">Kriteria</h6>
                                                        </th>

                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K01</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K02</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K03</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K04</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K05</h6>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">K06</h6>
                                                        </td>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    //QUERY TABEL KRITERIA 
                                                    $sql1 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K01'");
                                                    $data01 = mysqli_fetch_array($sql1);
                                                    $sql2 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K02'");
                                                    $data02 = mysqli_fetch_array($sql2);
                                                    $sql3 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K03'");
                                                    $data03 = mysqli_fetch_array($sql3);
                                                    $sql4 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K04'");
                                                    $data04 = mysqli_fetch_array($sql4);
                                                    $sql5 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K05'");
                                                    $data05 = mysqli_fetch_array($sql5);
                                                    $sql6 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K06'");
                                                    $data06 = mysqli_fetch_array($sql6);

                                                    //Memanggil Kriteria pada baris Alternatif (K01, K02, K03, K04, K05, K06)
                                                    $var1K01 = $this->koneksi->link->query("select k01 from bobot_alternatif");
                                                    $var2K02 = $this->koneksi->link->query("select k02 from bobot_alternatif");
                                                    $var3K03 = $this->koneksi->link->query("select k03 from bobot_alternatif");
                                                    $var4K04 = $this->koneksi->link->query("select k04 from bobot_alternatif");
                                                    $var5K05 = $this->koneksi->link->query("select k05 from bobot_alternatif");
                                                    $var6K06 = $this->koneksi->link->query("select k06 from bobot_alternatif");

                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif ");

                                                    while ($row = mysqli_fetch_array($data)) {
                                                        //ALTERNATIF
                                                        $K01var11 = mysqli_fetch_array($var1K01);
                                                        $K01var12 = mysqli_fetch_array($var2K02);
                                                        $K01var13 = mysqli_fetch_array($var3K03);
                                                        $K01var14 = mysqli_fetch_array($var4K04);
                                                        $K01var15 = mysqli_fetch_array($var5K05);
                                                        $K01var16 = mysqli_fetch_array($var6K06);

                                                        $K011B = pow($K01var11['k01'], 2);
                                                        $varA = $K011B / $sqrt1;
                                                        $Hasil1   =  $data01['normalisasi_bobot'] * $varA;
                                                        $negatif1 = $Hasil1 - $MinK01;
                                                        $negatifK01 = pow($negatif1, 2);

                                                        $K012B = pow($K01var12['k02'], 2);
                                                        $varB = $K012B / $sqrt2;
                                                        $Hasil2   =  $data02['normalisasi_bobot'] * $varB;
                                                        $negatif2 = $Hasil2 - $MinK02;
                                                        $negatifK02 = pow($negatif2, 2);


                                                        $K013B = pow($K01var13['k03'], 2);
                                                        $varC = $K013B / $sqrt3;
                                                        $Hasil3   =  $data03['normalisasi_bobot'] * $varC;
                                                        $negatif3 = $Hasil3 - $MinK03;
                                                        $negatifK03 = pow($negatif3, 2);


                                                        $K014B = pow($K01var14['k04'], 2);
                                                        $varD = $K014B / $sqrt4;
                                                        $Hasil4   =  $data04['normalisasi_bobot'] * $varD;
                                                        $negatif4 = $Hasil4 - $MinK04;
                                                        $negatifK04 = pow($negatif4, 2);


                                                        $K015B = pow($K01var15['k05'], 2);
                                                        $varE = $K015B / $sqrt5;
                                                        $Hasil5   =  $data05['normalisasi_bobot'] * $varE;
                                                        $negatif5 = $Hasil5 - $MinK05;
                                                        $negatifK05 = pow($negatif5, 2);


                                                        $K016B = pow($K01var16['k06'], 2);
                                                        $varF = $K016B / $sqrt6;
                                                        $Hasil6   =  $data06['normalisasi_bobot'] * $varF;
                                                        $negatif6 = $Hasil6 - $MinK06;
                                                        $negatifK06 = pow($negatif6, 2);


                                                    ?> <tr>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0"><?= $row['id_alternatif'] ?></h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($negatifK01, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($negatifK02, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($negatifK03, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($negatifK04, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($negatifK05, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($negatifK06, 3); ?></p>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                            <!--End-Table Responsive-->

                                        </div>
                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                </div>
                            </div>
                        </div>

                        <center>
                            <div class="col-lg-8 d-flex align-items-stretch">
                                <div class="card w-100">
                                    <div class="card-body p-4">
                                        <h5 class="card-title fw-semibold mb-4">Hasil jarak Ai solusi ideal positif dan solusi ideal negatif </h5>

                                        <!-- Table Data Pengguna -->
                                        <div class="table-responsive">
                                            <!--Table Responsive-->
                                            <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th class="border-bottom-0 align-middle">
                                                            <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle">
                                                            <h6 class="fw-semibold mb-0">Ideal Positif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">D+</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">Ideal Negatif</h6>
                                                        </th>
                                                        <th class="border-bottom-0 align-middle text-center">
                                                            <h6 class="fw-semibold mb-0">D-</h6>
                                                        </th>

                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //QUERY TABEL KRITERIA 
                                                    $sql1 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K01'");
                                                    $data01 = mysqli_fetch_array($sql1);
                                                    $sql2 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K02'");
                                                    $data02 = mysqli_fetch_array($sql2);
                                                    $sql3 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K03'");
                                                    $data03 = mysqli_fetch_array($sql3);
                                                    $sql4 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K04'");
                                                    $data04 = mysqli_fetch_array($sql4);
                                                    $sql5 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K05'");
                                                    $data05 = mysqli_fetch_array($sql5);
                                                    $sql6 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K06'");
                                                    $data06 = mysqli_fetch_array($sql6);

                                                    //Memanggil Kriteria pada baris Alternatif (K01, K02, K03, K04, K05, K06)
                                                    $var1K01 = $this->koneksi->link->query("select k01 from bobot_alternatif");
                                                    $var2K02 = $this->koneksi->link->query("select k02 from bobot_alternatif");
                                                    $var3K03 = $this->koneksi->link->query("select k03 from bobot_alternatif");
                                                    $var4K04 = $this->koneksi->link->query("select k04 from bobot_alternatif");
                                                    $var5K05 = $this->koneksi->link->query("select k05 from bobot_alternatif");
                                                    $var6K06 = $this->koneksi->link->query("select k06 from bobot_alternatif");

                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif ");

                                                    while ($row = mysqli_fetch_array($data)) {
                                                        //ALTERNATIF
                                                        $K01var11 = mysqli_fetch_array($var1K01);
                                                        $K01var12 = mysqli_fetch_array($var2K02);
                                                        $K01var13 = mysqli_fetch_array($var3K03);
                                                        $K01var14 = mysqli_fetch_array($var4K04);
                                                        $K01var15 = mysqli_fetch_array($var5K05);
                                                        $K01var16 = mysqli_fetch_array($var6K06);

                                                        $K011B = pow($K01var11['k01'], 2);
                                                        $varA = $K011B / $sqrt1;
                                                        $Hasil1   =  $data01['normalisasi_bobot'] * $varA;
                                                        //MAX
                                                        $positifk1 = $Hasil1 - $MaxK01;
                                                        $positifK01 = pow($positifk1, 2);
                                                        //MIN
                                                        $negatif1 = $Hasil1 - $MinK01;
                                                        $negatifK01 = pow($negatif1, 2);

                                                        $K012B = pow($K01var12['k02'], 2);
                                                        $varB = $K012B / $sqrt2;
                                                        $Hasil2   =  $data02['normalisasi_bobot'] * $varB;
                                                        //MAX
                                                        $positifk2 = $Hasil2 - $MaxK02;
                                                        $positifK02 = pow($positifk2, 2);
                                                        //MIN
                                                        $negatif2 = $Hasil2 - $MinK02;
                                                        $negatifK02 = pow($negatif2, 2);

                                                        $K013B = pow($K01var13['k03'], 2);
                                                        $varC = $K013B / $sqrt3;
                                                        $Hasil3   =  $data03['normalisasi_bobot'] * $varC;
                                                        //MAX
                                                        $positifk3 = $Hasil3 - $MaxK03;
                                                        $positifK03 = pow($positifk3, 2);
                                                        //MIN
                                                        $negatif3 = $Hasil3 - $MinK03;
                                                        $negatifK03 = pow($negatif3, 2);


                                                        $K014B = pow($K01var14['k04'], 2);
                                                        $varD = $K014B / $sqrt4;
                                                        $Hasil4   =  $data04['normalisasi_bobot'] * $varD;
                                                        //MAX
                                                        $positifk4 = $Hasil4 - $MaxK04;
                                                        $positifK04 = pow($positifk4, 2);
                                                        //MIN
                                                        $negatif4 = $Hasil4 - $MinK04;
                                                        $negatifK04 = pow($negatif4, 2);


                                                        $K015B = pow($K01var15['k05'], 2);
                                                        $varE = $K015B / $sqrt5;
                                                        $Hasil5   =  $data05['normalisasi_bobot'] * $varE;
                                                        //MAX
                                                        $positifk5 = $Hasil5 - $MaxK05;
                                                        $positifK05 = pow($positifk5, 2);
                                                        //MIN
                                                        $negatif5 = $Hasil5 - $MinK05;
                                                        $negatifK05 = pow($negatif5, 2);

                                                        $K016B = pow($K01var16['k06'], 2);
                                                        $varF = $K016B / $sqrt6;
                                                        $Hasil6   =  $data06['normalisasi_bobot'] * $varF;
                                                        //MAX
                                                        $positifk6 = $Hasil6 - $MaxK06;
                                                        $positifK06 = pow($positifk6, 2);
                                                        //MIN
                                                        $negatif6 = $Hasil6 - $MinK06;
                                                        $negatifK06 = pow($negatif6, 2);

                                                        $Dpositif = $positifK01 + $positifK02 + $positifK03 + $positifK04 + $positifK05 + $positifK06;
                                                        $Dnegatif = $negatifK01 + $negatifK02 + $negatifK03 + $negatifK04 + $negatifK05 + $negatifK06;


                                                    ?> <tr>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0"><?= $row['id_alternatif']; ?></h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">D+</h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal"><?= number_format($Dpositif, 3); ?></p>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <h6 class="fw-semibold mb-0">D-</h6>
                                                            </td>
                                                            <td class="border-bottom-0 align-middle text-center">
                                                                <p class="mb-0 fw-normal"><?= number_format($Dnegatif, 3); ?></p>
                                                            </td>


                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                            <!--End-Table Responsive-->

                                        </div>
                                        <!-- End-Table Data Pengguna -->
                                    </div>
                                </div>
                            </div>
                        </center>

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold mb-4">7. Menentukan nilai preferensi untuk setiap alternatif (Vi).
                                    </h5>

                                    <!-- Table Data Pengguna -->
                                    <div class="table-responsive">
                                        <!--Table Responsive-->
                                        <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0 align-middle">
                                                        <h6 class="fw-semibold mb-0">No</h6>
                                                    </th>
                                                    <th class="border-bottom-0 align-middle">
                                                        <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                    </th>
                                                    <th class="border-bottom-0 align-middle">
                                                        <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                    </th>
                                                    <th class="border-bottom-0 align-middle">
                                                        <h6 class="fw-semibold mb-0">Nilai Preferensi (Vi)</h6>
                                                    </th>
                                                </tr>

                                            </thead>

                                            <tbody>
                                                <?php
                                                //QUERY TABEL KRITERIA 
                                                $sql1 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K01'");
                                                $data01 = mysqli_fetch_array($sql1);
                                                $sql2 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K02'");
                                                $data02 = mysqli_fetch_array($sql2);
                                                $sql3 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K03'");
                                                $data03 = mysqli_fetch_array($sql3);
                                                $sql4 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K04'");
                                                $data04 = mysqli_fetch_array($sql4);
                                                $sql5 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K05'");
                                                $data05 = mysqli_fetch_array($sql5);
                                                $sql6 = $this->koneksi->link->query("select normalisasi_bobot from kriteria where id_kriteria ='K06'");
                                                $data06 = mysqli_fetch_array($sql6);

                                                //Memanggil Kriteria pada baris Alternatif (K01, K02, K03, K04, K05, K06)
                                                $var1K01 = $this->koneksi->link->query("select k01 from bobot_alternatif");
                                                $var2K02 = $this->koneksi->link->query("select k02 from bobot_alternatif");
                                                $var3K03 = $this->koneksi->link->query("select k03 from bobot_alternatif");
                                                $var4K04 = $this->koneksi->link->query("select k04 from bobot_alternatif");
                                                $var5K05 = $this->koneksi->link->query("select k05 from bobot_alternatif");
                                                $var6K06 = $this->koneksi->link->query("select k06 from bobot_alternatif");

                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif ");
                                                $baris  = mysqli_num_rows($data);

                                                for ($i = 1; $i <= $baris; $i++) {
                                                    $row = mysqli_fetch_array($data);
                                                    //ALTERNATIF
                                                    $K01var11 = mysqli_fetch_array($var1K01);
                                                    $K01var12 = mysqli_fetch_array($var2K02);
                                                    $K01var13 = mysqli_fetch_array($var3K03);
                                                    $K01var14 = mysqli_fetch_array($var4K04);
                                                    $K01var15 = mysqli_fetch_array($var5K05);
                                                    $K01var16 = mysqli_fetch_array($var6K06);

                                                    $K011B = pow($K01var11['k01'], 2);
                                                    $varA = $K011B / $sqrt1;
                                                    $Hasil1   =  $data01['normalisasi_bobot'] * $varA;
                                                    //MAX
                                                    $positifk1 = $Hasil1 - $MaxK01;
                                                    $positifK01 = pow($positifk1, 2);
                                                    //MIN
                                                    $negatif1 = $Hasil1 - $MinK01;
                                                    $negatifK01 = pow($negatif1, 2);

                                                    $K012B = pow($K01var12['k02'], 2);
                                                    $varB = $K012B / $sqrt2;
                                                    $Hasil2   =  $data02['normalisasi_bobot'] * $varB;
                                                    //MAX
                                                    $positifk2 = $Hasil2 - $MaxK02;
                                                    $positifK02 = pow($positifk2, 2);
                                                    //MIN
                                                    $negatif2 = $Hasil2 - $MinK02;
                                                    $negatifK02 = pow($negatif2, 2);

                                                    $K013B = pow($K01var13['k03'], 2);
                                                    $varC = $K013B / $sqrt3;
                                                    $Hasil3   =  $data03['normalisasi_bobot'] * $varC;
                                                    //MAX
                                                    $positifk3 = $Hasil3 - $MaxK03;
                                                    $positifK03 = pow($positifk3, 2);
                                                    //MIN
                                                    $negatif3 = $Hasil3 - $MinK03;
                                                    $negatifK03 = pow($negatif3, 2);


                                                    $K014B = pow($K01var14['k04'], 2);
                                                    $varD = $K014B / $sqrt4;
                                                    $Hasil4   =  $data04['normalisasi_bobot'] * $varD;
                                                    //MAX
                                                    $positifk4 = $Hasil4 - $MaxK04;
                                                    $positifK04 = pow($positifk4, 2);
                                                    //MIN
                                                    $negatif4 = $Hasil4 - $MinK04;
                                                    $negatifK04 = pow($negatif4, 2);


                                                    $K015B = pow($K01var15['k05'], 2);
                                                    $varE = $K015B / $sqrt5;
                                                    $Hasil5   =  $data05['normalisasi_bobot'] * $varE;
                                                    //MAX
                                                    $positifk5 = $Hasil5 - $MaxK05;
                                                    $positifK05 = pow($positifk5, 2);
                                                    //MIN
                                                    $negatif5 = $Hasil5 - $MinK05;
                                                    $negatifK05 = pow($negatif5, 2);

                                                    $K016B = pow($K01var16['k06'], 2);
                                                    $varF = $K016B / $sqrt6;
                                                    $Hasil6   =  $data06['normalisasi_bobot'] * $varF;
                                                    //MAX
                                                    $positifk6 = $Hasil6 - $MaxK06;
                                                    $positifK06 = pow($positifk6, 2);
                                                    //MIN
                                                    $negatif6 = $Hasil6 - $MinK06;
                                                    $negatifK06 = pow($negatif6, 2);

                                                    $Dpositif = $positifK01 + $positifK02 + $positifK03 + $positifK04 + $positifK05 + $positifK06;
                                                    $Dnegatif = $negatifK01 + $negatifK02 + $negatifK03 + $negatifK04 + $negatifK05 + $negatifK06;

                                                    $preferensi = $Dnegatif / ($Dnegatif + $Dpositif);
                                                    $Array   = array($preferensi);
                                                    foreach ($Array as $val) {
                                                        echo "$val";
                                                        echo "<br>";
                                                    }
                                                    $update = mysqli_query($this->koneksi->link, "update hasil set hasil = '$val' where id_alternatif = '" . $row['id_alternatif'] . "'");
                                                    if ($update) {
                                                        //set session sukses
                                                        $_SESSION["success"] = 'Perhitungan metode TOPSIS berhasil diproses!';
                                                        //redirect ke halaman
                                                        echo '<script> location.replace("../proses/hasilPerhitungan.php"); </script>';
                                                    } else {
                                                        //set session gagal
                                                        $_SESSION["error"] = 'gagal!';
                                                        //redirect ke halaman
                                                        echo '<script> location.replace("../proses/hasilPerhitungan.php"); </script>';
                                                    }


                                                ?> <tr>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= $no++ ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= $row['id_alternatif'] ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                        </td>
                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <p class="mb-0 fw-normal"><?= number_format($preferensi, 3); ?></p>
                                                        </td>

                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                        <!--End-Table Responsive-->

                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                </div>
                            </div>
                        </div>


                        <!-- Footer Start -->
                        <?php require_once "../layout/footer.php"; ?>
                        <!-- End-Footer Start -->
                    </div>
                    <!-- End-Content Start -->
                </div>
                <!--  End-Main wrapper -->
            </div>
            <!--  End-Body Wrapper -->
    <?php
    }

    public function SimpanHasilKeputusan()
    {
        $this->Simpan = new hasil();
        $this->Simpan->Setid_alternatif();
        $this->Simpan->Setnilai_hasil();
        $this->Simpan->Getid_alternatif();
        $this->Simpan->Getnilai_hasil();
        $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO hasil values('','" . $this->Simpan->id_alternatif . "','" . $this->Simpan->nilai_hasil . "')");
    }

    public function SimpanDataPengguna()
    {
        $this->Simpan = new Pengguna();
        $this->Simpan->Setid_pengguna();
        $this->Simpan->Setnik();
        $this->Simpan->Setnama_lengkap();
        $this->Simpan->Setgender();
        $this->Simpan->Setno_hp();
        $this->Simpan->Setalamat();
        $this->Simpan->Setemail();
        $this->Simpan->Setpassword();
        $this->Simpan->Setrole();
        $this->Simpan->Getid_pengguna();
        $this->Simpan->Getnik();
        $this->Simpan->Getnama_lengkap();
        $this->Simpan->Getgender();
        $this->Simpan->Getno_hp();
        $this->Simpan->Getalamat();
        $this->Simpan->Getemail();
        $this->Simpan->Getpassword();
        $this->Simpan->Getrole();
        $status_aktivasi = '1';
        $token = rand(100000, 999999);
        $status_active = '0';
        $date_add = date("Y-m-d H:i:s");

        //Cek data user
        $cek = mysqli_query($this->koneksi->link, "SELECT * FROM pengguna where nik = '" . $this->Simpan->nik . "' or email = '" . $this->Simpan->email . "'");
        $data = mysqli_fetch_array($cek);
        if ($this->Simpan->nik == $data['nik']) {
            //set session gagal
            $_SESSION["error"] = 'NIK tidak boleh sama!';
            //redirect ke halaman
            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        } elseif ($this->Simpan->email == $data['email']) {
            //set session gagal
            $_SESSION["error"] = 'Email sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO pengguna values('" . $this->Simpan->id_pengguna . "','" . $this->Simpan->nik . "','" . $this->Simpan->nama_lengkap . "','" . $this->Simpan->gender . "','" . $this->Simpan->email . "' , '" . $this->Simpan->no_hp . "','" . $this->Simpan->alamat . "','$date_add')");
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO user_login values('','" . $this->Simpan->id_pengguna . "','" . $this->Simpan->email . "','" . $this->Simpan->password . "','" . $this->Simpan->role . "','$status_aktivasi' , '$status_active','$status_active','$token','$date_add')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["success"] = 'Data pengguna berhasil ditambahkan!';
                //redirect ke halaman
                echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
            } else {
                //set session gagal
                $_SESSION["error"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
            }
        }
    }

    public function SimpanEditPengguna()
    {
        $this->Update = new Pengguna();
        $this->Update->Setid_user();
        $this->Update->Setid_pengguna();
        $this->Update->Setnik();
        $this->Update->Setnama_lengkap();
        $this->Update->Setgender();
        $this->Update->Setno_hp();
        $this->Update->Setalamat();
        $this->Update->Setemail();
        $this->Update->Setpassword();
        $this->Update->Setrole();
        $this->Update->Getid_user();
        $this->Update->Getid_pengguna();
        $this->Update->Getnik();
        $this->Update->Getnama_lengkap();
        $this->Update->Getgender();
        $this->Update->Getno_hp();
        $this->Update->Getalamat();
        $this->Update->Getemail();
        $this->Update->Getpassword();
        $this->Update->Getrole();

        $Update = mysqli_query($this->koneksi->link, "UPDATE pengguna set nik = '" . $this->Update->nik . "', nama = '" . $this->Update->nama_lengkap . "',
            gender = '" . $this->Update->gender . "', email = '" . $this->Update->email . "', no_hp = '" . $this->Update->no_hp . "', alamat = '" . $this->Update->alamat . "' where id_pengguna = '" . $this->Update->id_pengguna . "'");
        $Update = mysqli_query($this->koneksi->link, "UPDATE user_login set username = '" . $this->Update->email . "', password = '" . $this->Update->password . "', role = '" . $this->Update->role . "' where id_pengguna = '" . $this->Update->id_pengguna . "'");

        if ($Update) {
            //set session sukses
            $_SESSION["success"] = 'Data pengguna berhasil diubah!';
            //redirect ke halaman
            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        } else {
            //set session gagal
            $_SESSION["error"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        }
    }


    public function HapusPengguna()
    {
        $user = $_GET['key'];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM pengguna INNER JOIN user_login on pengguna.id_pengguna = user_login.id_pengguna WHERE email = '$user'");
        $data = mysqli_fetch_array($cek);

        if ($data['status_active'] == '1') {
            $_SESSION["error"] = 'User tidak bisa dihapus karena user sedang login';
            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        } else {
            // $detele = mysqli_query($this->koneksi->link, "DELETE FROM user_login where status_active = '$user'");
            $detele = mysqli_query($this->koneksi->link, "DELETE pengguna, user_login FROM pengguna INNER JOIN user_login ON pengguna.id_pengguna = user_login.id_pengguna where user_login.username = '$user'");
            if ($detele) {
                $_SESSION["success"] = 'Data berhasil dihapus!';
                echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
            } else {
                $_SESSION["error"] = 'gagal!';
                echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
            }
        }
    }

    public function AktivasiPengguna()
    {
        $key = $_GET['key'];
        $token = rand(100000, 999999);
        $aktivasi = mysqli_query($this->koneksi->link, "UPDATE user_login set status_aktivasi = '1', token = '$token' where id_user = '$key'");

        if ($aktivasi) {
            $_SESSION["success"] = 'Akun berhasil diaktivasi!';
            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        } else {
            $_SESSION["error"] = 'gagal!';
            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        }

        $query = mysqli_query($this->koneksi->link, "SELECT *FROM user_login WHERE id_user = '$key'");
        $data = mysqli_fetch_array($query);
        $email_penerima = $data['username'];
        $encode = base64_decode($data['password']);
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
            $mail->Subject = 'Aktivasi Akun Pengguna';
            // $mail->AddEmbeddedImage("../assets/img/qrcode.png", "my-attach", "logo");
            // Atur body
            // <img alt='' src='cid:my-attach' style='width:150px;'>
            $mail->Body = "<p style='font-size:14px;'> Terima kasih akun berhasil diaktivasi oleh Administrator, silahkan login dengan username dan password dibawah ini:</p>
                            <p> username : $email_penerima <br>
                            password : $encode</p>
                            <br>";

            // Kirim email kita
            $mail->send();
            $_SESSION["simpan"] = 'Akun berhasil diaktivasi.';
            header('Location: ../pengguna/data_pengguna.php');
        } catch (Exception $e) {
            $_SESSION["gagal"] = 'gagal!';
            header('Location: ../pengguna/data_pengguna.php');
        }
    }

    public function Suspend()
    {
        $key = $_GET['key'];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM user_login WHERE id_user = '$key'");
        $data = mysqli_fetch_array($cek);

        if ($data['status_active'] == '1') {
            $_SESSION["error"] = 'User tidak bisa di Non Aktifkan karena user sedang login';
            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        } else {
            $token = rand(100000, 999999);
            $aktivasi = mysqli_query($this->koneksi->link, "UPDATE user_login set suspend = '1', token = '$token' where id_user = '$key'");
            if ($aktivasi) {

                $_SESSION["success"] = 'Akun berhasil di Non Aktifkan!';

                echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
            } else {

                $_SESSION["error"] = 'gagal!';

                echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
            }

            $query = mysqli_query($this->koneksi->link, "SELECT *FROM user_login WHERE id_user = '$key'");
            $data1 = mysqli_fetch_array($query);
            $email_penerima = $data1['username'];
            $encode = base64_decode($data1['password']);
            if ($data1['suspend'] == '1') {
                $aktif = 'Suspend';
            }

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
                $mail->Subject = 'Akun Suspend';
                // $mail->AddEmbeddedImage("../assets/img/qrcode.png", "my-attach", "logo");
                // Atur body
                // <img alt='' src='cid:my-attach' style='width:150px;'>
                $mail->Body = "<p style='font-size:14px;'> Terima kasih akun berhasil di Non Aktifkan oleh Administrator</p>
                            <p> 
                            username : $email_penerima <br>
                            password : $encode</p>
                            <p><b>Status Akun : $aktif<b></p>
                            <br>";

                // Kirim email kita
                $mail->send();
                $_SESSION["simpan"] = 'Akun berhasil dinonaktifkan.';
                header('Location: ../pengguna/data_pengguna.php');
            } catch (Exception $e) {
                $_SESSION["gagal"] = 'gagal!';
                header('Location: ../pengguna/data_pengguna.php');
            }
        }
    }

    public function Aktifkan_Akun()
    {
        $key = $_GET['key'];
        $token = rand(100000, 999999);
        $aktivasi = mysqli_query($this->koneksi->link, "UPDATE user_login set suspend = '0', token = '$token' where id_user = '$key'");
        if ($aktivasi) {

            $_SESSION["success"] = 'Akun berhasil di Aktifkan kembali!';

            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        } else {

            $_SESSION["error"] = 'gagal!';

            echo '<script> location.replace("../pengguna/data_pengguna.php"); </script>';
        }

        $query = mysqli_query($this->koneksi->link, "SELECT *FROM user_login WHERE id_user = '$key'");
        $data1 = mysqli_fetch_array($query);
        $email_penerima = $data1['username'];
        $encode = base64_decode($data1['password']);
        if ($data1['suspend'] == '0') {
            $aktif = 'Aktif';
        }

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
            $mail->Subject = 'Akun Aktif';
            // $mail->AddEmbeddedImage("../assets/img/qrcode.png", "my-attach", "logo");
            // Atur body
            // <img alt='' src='cid:my-attach' style='width:150px;'>
            $mail->Body = "<p style='font-size:14px;'> Terima kasih akun berhasil di Aktifkan Kembali oleh Administrator</p>
                            <p> 
                            username : $email_penerima <br>
                            password : $encode</p>
                            <p><b>Status Akun : $aktif<b></p>
                            <br>";

            // Kirim email kita
            $mail->send();
            $_SESSION["simpan"] = 'Akun berhasil diaktifkan.';
            header('Location: ../pengguna/data_pengguna.php');
        } catch (Exception $e) {
            $_SESSION["gagal"] = 'gagal!';
            header('Location: ../pengguna/data_pengguna.php');
        }
    }

    public function SimpanSetting()
    {
        $this->Update = new Pengguna();
        $this->Update->Setid_user();
        $this->Update->Setid_pengguna();
        $this->Update->Setemail();
        $this->Update->Setpassword();
        $this->Update->Getid_user();
        $this->Update->Getid_pengguna();
        $this->Update->Getemail();
        $this->Update->Getpassword();

        if ($_SESSION['role'] == 'ROL001') {
            $home = '../pages/Administrator.php';
        } elseif ($_SESSION['role'] == 'ROL002') {
            $home = '../pages/Pakar.php';
        }


        if (empty($this->Update->password)) {
            $Update = mysqli_query($this->koneksi->link, "UPDATE user_login set username = '" . $this->Update->email . "' where id_user = '" . $this->Update->id_user . "'");
            $Update = mysqli_query($this->koneksi->link, "UPDATE pengguna set email = '" . $this->Update->email . "' where id_pengguna = '" . $this->Update->id_pengguna . "'");
        } else {
            $Update = mysqli_query($this->koneksi->link, "UPDATE user_login set username = '" . $this->Update->email . "', password = '" . $this->Update->password . "' where id_user ='" . $this->Update->id_user . "'");
            $Update = mysqli_query($this->koneksi->link, "UPDATE pengguna set email = '" . $this->Update->email . "' where id_pengguna = '" . $this->Update->id_pengguna . "'");
        }
        if ($Update) {
            //set session sukses
            $_SESSION["success"] = 'Password berhasil diubah!';
            //redirect ke halaman
            echo '<script> location.replace("' . $home . '"); </script>';
        } else {
            //set session gagal
            $_SESSION["error"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("' . $home . '"); </script>';
        }
    }
}
