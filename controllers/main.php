<?php
require_once "../../controllers/login.php";
require_once "../../views/include/main.php";
require_once "../../models/pengguna.php";
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
class Main extends login
{
    public function HalamanUtamaAdministrator()
    { ?>
        <?php $activePage = "Administrator";
        $user_login = mysqli_query($this->koneksi->link, "SELECT *FROM pengguna INNER JOIN user_login on pengguna.id_pengguna = user_login.id_pengguna ");
        $data_pengguna = mysqli_num_rows($user_login);
        $kriteria = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria");
        $data_kriteria = mysqli_num_rows($kriteria);
        $alternatif = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif");
        $data_alternatif = mysqli_num_rows($alternatif);
        $hasil = mysqli_query($this->koneksi->link, "SELECT *FROM hasil");
        $hasil_keputusan = mysqli_num_rows($hasil);
        ?>
        <!--  Body Wrapper -->

        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <!-- Sidebar Start -->
            <?php require_once "../../views/layout/sidebar.php"; ?>
            <!-- End-Sidebar Start -->

            <!--  Main wrapper -->
            <div class="body-wrapper">
                <!-- Header Start -->
                <?php require_once "../../views/layout/navbar.php"; ?>
                <!-- End-Header Start -->

                <!-- Content Start -->

                <div class="container-fluid">
                    <!--  Row 1 -->
                    <div class="row mt-2">
                        <!-- <div class="row clearfix"> -->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box hover-expand-effect">
                                <div class="icon bg-light-blue">
                                    <a href="../kriteria/data_kriteria.php"><i class="material-icons">playlist_add_check</i></a>
                                </div>
                                <div class="content">
                                    <div class="text" style="color: #2a3547; font-weight: 600;">DATA KRITERIA</div>
                                    <div class="number" style="font-size: 20px; color: #2a3547; font-weight: 600;"><?= $data_kriteria ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box hover-expand-effect">
                                <div class="icon bg-light-blue">
                                    <a href="../alternatif/data_alternatif.php"><i class="material-icons">list</i></a>
                                </div>
                                <div class="content">
                                    <div class="text" style="color: #2a3547; font-weight: 600;">DATA ALTERNATIF</div>
                                    <div class="number" style="font-size: 20px; color: #2a3547; font-weight: 600;"><?= $data_alternatif ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box hover-expand-effect">
                                <div class="icon bg-light-blue">
                                    <a href="../proses/HasilKeputusan.php"><i class="material-icons">bookmark</i></a>
                                </div>
                                <div class="content">
                                    <div class="text" style="color: #2a3547; font-weight: 600;">HASIL KEPUTUSAN</div>
                                    <div class="number" style="font-size: 20px; color: #2a3547; font-weight: 600;"><?= $hasil_keputusan; ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box hover-expand-effect">
                                <div class="icon bg-light-blue">
                                    <a href="../pengguna/data_pengguna.php"><i class="material-icons">people</i></a>
                                </div>
                                <div class="content">
                                    <div class="text" style="color: #2a3547; font-weight: 600;">DATA PENGGUNA</div>
                                    <div class="number" style="font-size: 20px; color: #2a3547; font-weight: 600;"><?= $data_pengguna ?></div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->

                        <div class="col-lg-8 d-flex align-items-strech">
                            <div class="card w-100">
                                <div class="card-body">
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="card-title fw-semibold">Rekomendasi Bibit Padi Terbaik 2024</h5>
                                        </div>

                                    </div>
                                    <!-- Data -->
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
                                                        <h6 class="fw-semibold mb-0">Nama Varietas</h6>
                                                    </th>

                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Nilai Preferensi</h6>
                                                    </th>

                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0" style="text-align: center;">Ranking</h6>
                                                    </th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $batas = 20;
                                                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                                $previous = $halaman - 1;
                                                $next = $halaman + 1;

                                                if (isset($_GET['cari'])) {
                                                    $cari = $_GET['cari'];
                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif order by hasil.hasil DESC ");
                                                } else {
                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif");
                                                }

                                                $countdata = mysqli_num_rows($data);
                                                $jumlah_data = mysqli_num_rows($data);
                                                $total_halaman = ceil($jumlah_data / $batas);
                                                $data_alternatif = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif order by hasil.hasil DESC limit $halaman_awal, $batas");
                                                $nomor = $halaman_awal + 1;

                                                $sql = mysqli_num_rows($data_alternatif);
                                                for ($i = 1; $i <= $sql; $i++) {
                                                    $row = mysqli_fetch_array($data_alternatif);
                                                    if ($i == '1') {
                                                        $Rekomendasi = '<span class="text-primary fw-normal">Rekomendasi</span>';
                                                    } elseif ($i == '2') {
                                                        $Rekomendasi = '<span class="text-primary fw-normal">Rekomendasi</span>';
                                                    } elseif ($i == '3') {
                                                        $Rekomendasi = '<span class="text-primary fw-normal">Rekomendasi</span>';
                                                    } elseif ($i == '4') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '5') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '6') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '7') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '8') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '9') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } else {
                                                        $Rekomendasi = 'Tidak';
                                                    }

                                                ?>
                                                    <tr>

                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0" style="text-align: center;"><?= $row['id_alternatif'] ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= $row['nama_alternatif'] ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= number_format($row['hasil'], 3); ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0" style="text-align: center;"><?= $nomor++ ?></h6>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <!--End-Table Responsive-->

                                        <!--Tidak ditemukan-->
                                        <?php
                                        if ($countdata < 1) {
                                        ?>
                                            <h4 class="text-center" style="height:50px; margin-top:30px">pencarian data "<b><?= $cari ?></b>" tidak ditemukan &nbsp;<a href="data_alternatif.php"><i class="fa fa-search"></i></a></h4>
                                        <?php
                                        }
                                        ?>
                                        <!--End-Tidak ditemukan-->

                                        <!-- Pagenation -->
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination mt-2 mb-0">
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                                echo "href='?halaman=$previous'";
                                                                            } ?>><span aria-hidden="true">&laquo;</span></a>
                                                </li>
                                                <?php
                                                for ($x = 1; $x <= $total_halaman; $x++) {
                                                ?>
                                                    <li class="page-item <?php if ($halaman == "$x") {
                                                                                echo "active";
                                                                            } ?>" aria-current="page">
                                                        <a class="page-link" href="?halaman=<?php echo $x ?>">
                                                            <?php echo $x; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                echo "href='?halaman=$next'";
                                                                            } ?>><span aria-hidden="true">&raquo;</span></a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <!-- End-Pagenation -->
                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                    <!-- End-Data -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Yearly Breakup -->
                                    <div class="card overflow-hidden">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-9 fw-semibold">Grafik Varietas Terbaik</h5>
                                            <div class="row align-items-center">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-center">
                                                        <canvas id="chartContainer" style="height: 300px; width: 100%;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Script Chart.js -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var ctx = document.getElementById('chartContainer').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: [<?php
                                                    $data_alternatif = mysqli_query($this->koneksi->link, "SELECT * FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil.hasil DESC LIMIT 15");
                                                    while ($row = mysqli_fetch_array($data_alternatif)) {
                                                        echo '"' . $row['nama_alternatif'] . '",';
                                                    }
                                                    ?>],
                                        datasets: [{
                                            label: 'Nilai Preferensi (Vi)',
                                            data: [<?php
                                                    $data_alternatif = mysqli_query($this->koneksi->link, "SELECT * FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil.hasil DESC LIMIT 15");
                                                    while ($row = mysqli_fetch_array($data_alternatif)) {
                                                        echo '"' . number_format($row['hasil'], 3) . '",';
                                                    }
                                                    ?>],
                                            backgroundColor: [<?php
                                                                $data_alternatif = mysqli_query($this->koneksi->link, "SELECT * FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil.hasil DESC LIMIT 15");
                                                                $nomor = 1;
                                                                while ($row = mysqli_fetch_array($data_alternatif)) {
                                                                    if ($nomor <= 3) {
                                                                        echo "'rgba(75, 192, 192, 0.2)',"; // hijau muda
                                                                    } elseif ($nomor >= 4 && $nomor <= 9) {
                                                                        echo "'rgba(34, 139, 34, 0.2)',"; // hijau sedang
                                                                    } else {
                                                                        echo "'rgba(0, 100, 0, 0.2)',"; // hijau tua
                                                                    }
                                                                    $nomor++;
                                                                }
                                                                ?>],
                                            borderColor: [<?php
                                                            $data_alternatif = mysqli_query($this->koneksi->link, "SELECT * FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil.hasil DESC LIMIT 15");
                                                            $nomor = 1;
                                                            while ($row = mysqli_fetch_array($data_alternatif)) {
                                                                if ($nomor <= 3) {
                                                                    echo "'rgba(75, 192, 192, 1)',"; // hijau muda
                                                                } elseif ($nomor >= 4 && $nomor <= 9) {
                                                                    echo "'rgba(34, 139, 34, 1)',"; // hijau sedang
                                                                } else {
                                                                    echo "'rgba(0, 100, 0, 1)',"; // hijau tua
                                                                }
                                                                $nomor++;
                                                            }
                                                            ?>],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
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
    <?php   }

    public function HalamanUtamaPakar()
    {
    ?>
        <?php $activePage = "Pakar";
        $kriteria = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria");
        $data_kriteria = mysqli_num_rows($kriteria);
        $alternatif = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif");
        $data_alternatif = mysqli_num_rows($alternatif);
        $hasil = mysqli_query($this->koneksi->link, "SELECT *FROM hasil");
        $hasil_keputusan = mysqli_num_rows($hasil);
        ?>
        <!--  Body Wrapper -->

        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <!-- Sidebar Start -->
            <?php require_once "../../views/layout/sidebarPakar.php"; ?>
            <!-- End-Sidebar Start -->

            <!--  Main wrapper -->
            <div class="body-wrapper">
                <!-- Header Start -->
                <?php require_once "../../views/layout/navbar.php"; ?>
                <!-- End-Header Start -->

                <!-- Content Start -->

                <div class="container-fluid">
                    <!--  Row 1 -->
                    <div class="row mt-2">
                        <!-- <div class="row clearfix"> -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box hover-expand-effect">
                                <div class="icon bg-light-blue">
                                    <a href=""><i class="material-icons">playlist_add_check</i></a>
                                </div>
                                <div class="content">
                                    <div class="text" style="color: #2a3547; font-weight: 600;">DATA KRITERIA</div>
                                    <div class="number" style="font-size: 20px; color: #2a3547; font-weight: 600;"><?= $data_kriteria ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box hover-expand-effect">
                                <div class="icon bg-light-blue">
                                    <a href="../pakar/validasi_data_alternatif.php"><i class="material-icons">list</i></a>
                                </div>
                                <div class="content">
                                    <div class="text" style="color: #2a3547; font-weight: 600;">VALIDASI DATA ALTERNATIF</div>
                                    <div class="number" style="font-size: 20px; color: #2a3547; font-weight: 600;"><?= $data_alternatif ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box hover-expand-effect">
                                <div class="icon bg-light-blue">
                                    <a href=""><i class="material-icons">bookmark</i></a>
                                </div>
                                <div class="content">
                                    <div class="text" style="color: #2a3547; font-weight: 600;">HASIL KEPUTUSAN</div>
                                    <div class="number" style="font-size: 20px; color: #2a3547; font-weight: 600;"><?= $hasil_keputusan; ?></div>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-8 d-flex align-items-strech">
                            <div class="card w-100">
                                <div class="card-body">
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                        <div class="mb-3 mb-sm-0">
                                            <h5 class="card-title fw-semibold">Rekomendasi Bibit Padi Terbaik 2024</h5>
                                        </div>

                                    </div>
                                    <!-- Data -->
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
                                                        <h6 class="fw-semibold mb-0">Nama Varietas</h6>
                                                    </th>

                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Nilai Preferensi</h6>
                                                    </th>

                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0" style="text-align: center;">Ranking</h6>
                                                    </th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $batas = 20;
                                                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                                $previous = $halaman - 1;
                                                $next = $halaman + 1;

                                                if (isset($_GET['cari'])) {
                                                    $cari = $_GET['cari'];
                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif order by hasil.hasil DESC ");
                                                } else {
                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif");
                                                }

                                                $countdata = mysqli_num_rows($data);
                                                $jumlah_data = mysqli_num_rows($data);
                                                $total_halaman = ceil($jumlah_data / $batas);
                                                $data_alternatif = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif order by hasil.hasil DESC limit $halaman_awal, $batas");
                                                $nomor = $halaman_awal + 1;

                                                $sql = mysqli_num_rows($data_alternatif);
                                                for ($i = 1; $i <= $sql; $i++) {
                                                    $row = mysqli_fetch_array($data_alternatif);
                                                    if ($i == '1') {
                                                        $Rekomendasi = '<span class="text-primary fw-normal">Rekomendasi</span>';
                                                    } elseif ($i == '2') {
                                                        $Rekomendasi = '<span class="text-primary fw-normal">Rekomendasi</span>';
                                                    } elseif ($i == '3') {
                                                        $Rekomendasi = '<span class="text-primary fw-normal">Rekomendasi</span>';
                                                    } elseif ($i == '4') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '5') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '6') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '7') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '8') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } elseif ($i == '9') {
                                                        $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                    } else {
                                                        $Rekomendasi = 'Tidak';
                                                    }

                                                ?>
                                                    <tr>

                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0" style="text-align: center;"><?= $row['id_alternatif'] ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= $row['nama_alternatif'] ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= number_format($row['hasil'], 3); ?></h6>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0" style="text-align: center;"><?= $nomor++ ?></h6>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <!--End-Table Responsive-->

                                        <!--Tidak ditemukan-->
                                        <?php
                                        if ($countdata < 1) {
                                        ?>
                                            <h4 class="text-center" style="height:50px; margin-top:30px">pencarian data "<b><?= $cari ?></b>" tidak ditemukan &nbsp;<a href="data_alternatif.php"><i class="fa fa-search"></i></a></h4>
                                        <?php
                                        }
                                        ?>
                                        <!--End-Tidak ditemukan-->

                                        <!-- Pagenation -->
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination mt-2 mb-0">
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                                echo "href='?halaman=$previous'";
                                                                            } ?>><span aria-hidden="true">&laquo;</span></a>
                                                </li>
                                                <?php
                                                for ($x = 1; $x <= $total_halaman; $x++) {
                                                ?>
                                                    <li class="page-item <?php if ($halaman == "$x") {
                                                                                echo "active";
                                                                            } ?>" aria-current="page">
                                                        <a class="page-link" href="?halaman=<?php echo $x ?>">
                                                            <?php echo $x; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                echo "href='?halaman=$next'";
                                                                            } ?>><span aria-hidden="true">&raquo;</span></a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <!-- End-Pagenation -->
                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                    <!-- End-Data -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Yearly Breakup -->
                                    <div class="card overflow-hidden">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-9 fw-semibold">Grafik Varietas Terbaik</h5>
                                            <div class="row align-items-center">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-center">
                                                        <canvas id="chartContainer" style="height: 300px; width: 100%;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Script Chart.js -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var ctx = document.getElementById('chartContainer').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: [<?php
                                                    $data_alternatif = mysqli_query($this->koneksi->link, "SELECT * FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil.hasil DESC LIMIT 15");
                                                    while ($row = mysqli_fetch_array($data_alternatif)) {
                                                        echo '"' . $row['nama_alternatif'] . '",';
                                                    }
                                                    ?>],
                                        datasets: [{
                                            label: 'Nilai Preferensi (Vi)',
                                            data: [<?php
                                                    $data_alternatif = mysqli_query($this->koneksi->link, "SELECT * FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil.hasil DESC LIMIT 15");
                                                    while ($row = mysqli_fetch_array($data_alternatif)) {
                                                        echo '"' . number_format($row['hasil'], 3) . '",';
                                                    }
                                                    ?>],
                                            backgroundColor: [<?php
                                                                $data_alternatif = mysqli_query($this->koneksi->link, "SELECT * FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil.hasil DESC LIMIT 15");
                                                                $nomor = 1;
                                                                while ($row = mysqli_fetch_array($data_alternatif)) {
                                                                    if ($nomor <= 3) {
                                                                        echo "'rgba(75, 192, 192, 0.2)',"; // hijau muda
                                                                    } elseif ($nomor >= 4 && $nomor <= 9) {
                                                                        echo "'rgba(34, 139, 34, 0.2)',"; // hijau sedang
                                                                    } else {
                                                                        echo "'rgba(0, 100, 0, 0.2)',"; // hijau tua
                                                                    }
                                                                    $nomor++;
                                                                }
                                                                ?>],
                                            borderColor: [<?php
                                                            $data_alternatif = mysqli_query($this->koneksi->link, "SELECT * FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil.hasil DESC LIMIT 15");
                                                            $nomor = 1;
                                                            while ($row = mysqli_fetch_array($data_alternatif)) {
                                                                if ($nomor <= 3) {
                                                                    echo "'rgba(75, 192, 192, 1)',"; // hijau muda
                                                                } elseif ($nomor >= 4 && $nomor <= 9) {
                                                                    echo "'rgba(34, 139, 34, 1)',"; // hijau sedang
                                                                } else {
                                                                    echo "'rgba(0, 100, 0, 1)',"; // hijau tua
                                                                }
                                                                $nomor++;
                                                            }
                                                            ?>],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
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

    public function DataKriteria()
    { ?>
        <!-- <?php error_reporting(0); ?> -->
        <?php $activePage = "kriteria";
        // mengambil data barang dengan kode paling besar
        $carikode = mysqli_query($this->koneksi->link, "select max(id_kriteria) from kriteria");
        $datakode = mysqli_fetch_array($carikode);
        if ($datakode) {
            $nilaikode = substr($datakode[0], 1);
            $kode = (int) $nilaikode;
            $kode = $kode + 1;
            $kode_otomatis = "K" . str_pad($kode, 2, "0", STR_PAD_LEFT);
        } else {
            //$kode_otomatis = "K01";
        }
        ?>

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
                                    <h5 class="card-title fw-semibold mb-4">Data Kriteria</h5>
                                    <!-- Button trigger modal -->
                                    <form action="simpan_data_kriteria.php" method="post">
                                        <div class="row mb-3">
                                            <label for="kode_kriteria" class="col-sm-2 col-form-label">Kode Kriteria</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="kode_kriteria" name="id_kriteria" value="<?= $kode_otomatis ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nama_kriteria" class="col-sm-2 col-form-label">Nama Kriteria</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="nama_kriteria" name="nama" placeholder="Nama Kriteria" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" id="bobot" name="bobot" min="1" max="100" placeholder="Bobot Kriteria" required>
                                            </div>
                                        </div>

                                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
                                    </form>

                                    <!-- Form pencarian-->
                                    <div>
                                        <form action="data_kriteria.php" method="get">
                                            <div class="input-group">
                                                <input type="text" name="cari" class="form-control" placeholder="Cari data...." aria-describedby="basic-addon1">
                                                <button class="btn btn-primary" value="Cari" type="sumbit" id="button-addon1">Cari</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End-Form pencarian-->
                                </div>
                                <!-- End-Button trigger modal -->

                                <!-- Table Data Pengguna -->
                                <div class="table-responsive">
                                    <!--Table Responsive-->
                                    <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">No</h6>
                                                </th>
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

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Status</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $batas = 10;
                                            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                            $previous = $halaman - 1;
                                            $next = $halaman + 1;

                                            if (isset($_GET['cari'])) {
                                                $cari = $_GET['cari'];
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria WHERE id_kriteria like '%" . $cari . "%' or nama like '%" . $cari . "%'");
                                            } else {
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria");
                                            }

                                            $countdata = mysqli_num_rows($data);
                                            $jumlah_data = mysqli_num_rows($data);
                                            $total_halaman = ceil($jumlah_data / $batas);
                                            $data_kriteria = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria WHERE id_kriteria like '%" . $cari . "%' or nama like '%" . $cari . "%' limit $halaman_awal, $batas");
                                            $nomor = $halaman_awal + 1;

                                            while ($row = mysqli_fetch_array($data_kriteria)) {
                                                if ($row['status'] == 1) {
                                                    $status = '<p class="mb-0 fw-normal"><span class="badge bg-success rounded-3 fw-semibold" style="font-size:12px;">Valid</span></p>';
                                                    $edit = '<button class="btn btn-primary btn-sm" disabled>
                                                                <i class="fa fa-edit fa-lg">
                                                                </i>
                                                            </button>';
                                                    $hapus = '<button class="btn btn-danger btn-sm" disabled>
                                                                <i class="fa fa-trash fa-lg">
                                                                </i>
                                                            </button>';
                                                } elseif ($row['status'] == 0) {
                                                    $status = '<p class="mb-0 fw-normal"><span class="badge bg-danger rounded-3 fw-semibold" style="font-size:12px;">Menunggu</span></p>';
                                                    $edit = '<a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#id_kriteria' . $row['id_kriteria'] . '">
                                                                <i class="fa fa-edit fa-lg">
                                                                </i>
                                                            </a>
                                                            <div class="modal fade" id="id_kriteria' . $row['id_kriteria'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kriteria</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" action="simpan_edit_kriteria.php">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Kode Kriteria</label>
                                                                                    <input type="text" class="form-control" name="id_kriteria" value="' . $row['id_kriteria'] . '" readonly>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="nama" class="form-label">Nama Kriteria</label>
                                                                                    <input type="text" class="form-control" id="nama" name="nama" value="' . $row['nama'] . '" required>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="bobot" class="form-label">Bobot Kriteria</label>
                                                                                    <input type="number" class="form-control" id="bobot" name="bobot" value="' . $row['bobot'] . '" required>
                                                                                </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>';
                                                    $hapus = '<a class="btn btn-danger btn-sm" href="../kriteria/hapus_kriteria.php?key=' . $row['id_kriteria'] . '" id="btn-HapusMaster">
                                                                <i class="fa fa-trash fa-lg">
                                                                </i>
                                                            </a>';
                                                }

                                            ?>
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0"><?= $nomor++ ?></h6>
                                                    </td>
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

                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0"><?= $status; ?></h6>
                                                    </td>

                                                    <td class="border-bottom-0">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <!-- Button trigger modal Edit-->
                                                            <?= $edit; ?>

                                                            <!-- Button Delete-->
                                                            <?= $hapus; ?>
                                                            <!-- Edn-Button Delete-->
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                            <?php
                                            $qry = mysqli_query($this->koneksi->link, "select SUM(bobot) as jumlah from kriteria");
                                            $data = mysqli_fetch_array($qry);
                                            ?>
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"></h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"></h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"></h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Total : <?= $data['jumlah'] ?></h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"></h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0"></h6>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--End-Table Responsive-->

                                    <!--Tidak ditemukan-->
                                    <?php
                                    if ($countdata < 1) {
                                    ?>
                                        <h4 class="text-center" style="height:50px; margin-top:30px">pencarian data "<b><?= $cari ?></b>" tidak ditemukan &nbsp;<a href="data_alternatif.php"><i class="fa fa-search"></i></a></h4>
                                    <?php
                                    }
                                    ?>
                                    <!--End-Tidak ditemukan-->

                                    <!-- Pagenation -->
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of <b><?= $jumlah_data ?></b> entries
                                        </div>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination mt-2 mb-0">
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                                echo "href='?halaman=$previous'";
                                                                            } ?>><span aria-hidden="true">&laquo;</span></a>
                                                </li>
                                                <?php
                                                for ($x = 1; $x <= $total_halaman; $x++) {
                                                ?>
                                                    <li class="page-item <?php if ($halaman == "$x") {
                                                                                echo "active";
                                                                            } ?>" aria-current="page">
                                                        <a class="page-link" href="?halaman=<?php echo $x ?>">
                                                            <?php echo $x; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                echo "href='?halaman=$next'";
                                                                            } ?>><span aria-hidden="true">&raquo;</span></a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- End-Pagenation -->
                                </div>
                                <!-- End-Table Data Pengguna -->
                            </div>
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

    public function DataSubKriteria()
    { ?>
        <!-- <?php error_reporting(0); ?> -->
        <?php $activePage = "subkriteria"; ?>
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
                                    <h5 class="card-title fw-semibold mb-4">Data SubKriteria</h5>
                                    <!-- Button trigger modal -->
                                    <form action="simpan_data_subkriteria.php" method="post">
                                        <div class="mb-2 row">
                                            <label class="col-sm-2 col-form-label">Kriteria</label>
                                            <div class="col-sm-4">
                                                <select class="form-select" aria-label="Default select example" name="id_kriteria" required>
                                                    <option selected disabled value="">--Pilih Kriteria--</option>
                                                    <?php
                                                    $query    = mysqli_query($this->koneksi->link, "SELECT * FROM kriteria");
                                                    while ($nama_kriteria = mysqli_fetch_array($query)) {
                                                    ?>
                                                        <option value="<?= $nama_kriteria['id_kriteria']; ?>">(<b><?= $nama_kriteria['id_kriteria']; ?></b>) <?= $nama_kriteria['nama']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nama_subkriteria" class="col-sm-2 col-form-label">Subkriteria</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="nama_subkriteria" name="parameter" placeholder="Subkriteria" required>
                                                    <input type="number" min="1" max="3" class="form-control" id="nama_subkriteria" name="nilai" placeholder="Nilai parameter" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
                                    </form>

                                    <!-- Form pencarian-->
                                    <div>
                                        <form action="" method="" id="form_id" class="row g-1">
                                            <div class="col-auto">
                                                <select class="form-select" id="cari" name="cari" onChange="document.getElementById('form_id').submit();">
                                                    <option value="">--Pilih Kriteria--</option>
                                                    <?php
                                                    $query1  = mysqli_query($this->koneksi->link, "SELECT * FROM kriteria");
                                                    while ($search_nama_kriteria = mysqli_fetch_array($query1)) {

                                                        $nama = strip_tags($search_nama_kriteria['nama']);
                                                    ?>
                                                        <option value="<?= $nama ?>"><?= $nama ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <a href="../subkriteria/data_subkriteria.php">
                                                    <button type="button" class="btn btn-warning"><i class="fas fa-refresh fa-spin"></i></button>
                                                </a>
                                            </div>

                                        </form>

                                    </div>
                                    <!-- End-Form pencarian-->
                                </div>
                                <!-- End-Button trigger modal -->

                                <!-- Table Data Pengguna -->
                                <?php
                                $batas = 10;
                                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                $previous = $halaman - 1;
                                $next = $halaman + 1;

                                if (isset($_GET['cari'])) {
                                    $cari = $_GET['cari'];
                                    $data_query = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria INNER JOIN sub_kriteria on kriteria.id_kriteria = sub_kriteria.id_kriteria WHERE kriteria.nama like '%" . $cari . "%' or sub_kriteria.parameter like '%" . $cari . "%' GROUP BY kriteria.id_kriteria");
                                    $rows = mysqli_num_rows($data_query);
                                } else {
                                    $data_query = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria INNER JOIN sub_kriteria on kriteria.id_kriteria = sub_kriteria.id_kriteria GROUP BY kriteria.id_kriteria");
                                    $rows = mysqli_num_rows($data_query);
                                }

                                $jumlah_data = mysqli_num_rows($data_query);
                                $total_halaman = ceil($jumlah_data / $batas);
                                $data_query = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria INNER JOIN sub_kriteria on kriteria.id_kriteria = sub_kriteria.id_kriteria WHERE kriteria.nama like '%" . $cari . "%' or sub_kriteria.parameter like '%" . $cari . "%' GROUP BY kriteria.id_kriteria limit $halaman_awal, $batas ");

                                ?>
                                <div class="table-responsive">
                                    <!--Table Responsive-->
                                    <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">No</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Kriteria</h6>
                                                </th>

                                                <th class="border-bottom-0" style="text-align: center;">
                                                    <h6 class="fw-semibold mb-0">Bobot</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Sub Kriteria</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nilai Parameter</h6>
                                                </th>

                                                <th class="border-bottom-0" style="text-align: center; width:20px;">
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            </tr>
                                        </thead>

                                        <?php
                                        for ($i = 1; $i <= $rows; $i++) {
                                            $data = mysqli_fetch_array($data_query);
                                            $kriteria = $data['id_kriteria'];
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" style="width: 50px;">
                                                        <h6 class="fw-semibold mb-0" style="text-align: center;"><?= $i ?></h6>
                                                    </td>
                                                    <td class="border-bottom-0" style="width: 250px;">
                                                        <p class="mb-0 fw-normal"><?= $data['nama'] ?></p>
                                                    </td>
                                                    <td class="border-bottom-0" style="width: 150px;text-align: center;">
                                                        <p class="mb-0" style="font-size: 16px; font-weight:bold"><?= $data['bobot'] ?></p>
                                                    </td>

                                                    <?php
                                                    $data_query1 = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria INNER JOIN sub_kriteria on kriteria.id_kriteria = sub_kriteria.id_kriteria WHERE sub_kriteria.id_kriteria = '$kriteria' GROUP BY sub_kriteria.parameter ORDER BY kriteria.id_kriteria, sub_kriteria.nilai ASC");
                                                    $data_query2 = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria INNER JOIN sub_kriteria on kriteria.id_kriteria = sub_kriteria.id_kriteria WHERE sub_kriteria.id_kriteria = '$kriteria' GROUP BY sub_kriteria.parameter ORDER BY kriteria.id_kriteria, sub_kriteria.nilai ASC");
                                                    $data_query3 = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria INNER JOIN sub_kriteria on kriteria.id_kriteria = sub_kriteria.id_kriteria WHERE sub_kriteria.id_kriteria = '$kriteria' GROUP BY sub_kriteria.parameter ORDER BY kriteria.id_kriteria, sub_kriteria.nilai ASC");
                                                    ?>

                                                    <td class="border-bottom-0" style="width: 300px;">
                                                        <?php
                                                        while ($parameter = mysqli_fetch_array($data_query1)) {
                                                        ?>
                                                            <p class="mb-0" style="padding:5px; font-size:14px;"><a href="../subkriteria/hapus_subkriteria.php?key=<?= $parameter['id_sub_kriteria'] ?>" style="color:red" id="btn-Hapus"><?= $parameter['parameter'] ?></a></p>
                                                        <?php } ?>
                                                    </td>

                                                    <td class="border-bottom-0" style="width: 140px; text-align:center; ">
                                                        <?php
                                                        while ($nilai = mysqli_fetch_array($data_query2)) {
                                                        ?>
                                                            <p class="mb-0" style="padding:5px; font-weight:bold"><?= $nilai['nilai'] ?></p>
                                                        <?php } ?>
                                                    </td>

                                                    <td class="border-bottom-0 " style="width: 100px;">
                                                        <?php
                                                        while ($id = mysqli_fetch_array($data_query3)) {
                                                        ?><p class="mb-0" style="text-align:center;">
                                                                <!-- Button trigger modal Edit-->
                                                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#id_kriteria<?= $id['id_sub_kriteria'] ?>">
                                                                    <i class="fa fa-edit fa-lg">
                                                                    </i>
                                                                </a>

                                                                <!-- Button trigger modal Edit-->
                                                            <div class="modal fade" id="id_kriteria<?= $id['id_sub_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data SubKriteria</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" action="simpan_edit_subkriteria.php">

                                                                                <input type="hidden" class="form-control" name="id_sub_kriteria" value="<?= $id['id_sub_kriteria'] ?>" readonly>

                                                                                <div class="mb-3">
                                                                                    <label for="jk" class="form-label">Kriteria</label>
                                                                                    <select class="form-select" aria-label="Default select example" name="id_kriteria">
                                                                                        <option value="<?= $id['id_kriteria'] ?>">Pilih Kriteria</option>
                                                                                        <?php
                                                                                        $newdata_query = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria");
                                                                                        while ($id_kriteria = mysqli_fetch_array($newdata_query)) {
                                                                                        ?>
                                                                                            <option value="<?= $id_kriteria['id_kriteria'] ?>"><?= $id_kriteria['nama'] ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="parameter" class="form-label">Nama SubKriteria</label>
                                                                                    <input type="text" class="form-control" id="parameter" name="parameter" value="<?= $id['parameter'] ?>" required>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="nilai" class="form-label">Bobot Kriteria</label>
                                                                                    <input type="number" class="form-control" id="nilai" min="1" max="3" name="nilai" value="<?= $id['nilai'] ?>" required>
                                                                                </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </p>
                                                        <?php } ?>

                                                        <!-- End-Button trigger modal Edit-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                    <!--End-Table Responsive-->

                                    <!-- Pagenation -->
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of <b><?= $jumlah_data ?></b> entries
                                        </div>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination mt-2 mb-0">
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                                echo "href='?halaman=$previous'";
                                                                            } ?>><span aria-hidden="true">&laquo;</span></a>
                                                </li>
                                                <?php
                                                for ($x = 1; $x <= $total_halaman; $x++) {
                                                ?>
                                                    <li class="page-item <?php if ($halaman == "$x") {
                                                                                echo "active";
                                                                            } ?>" aria-current="page">
                                                        <a class="page-link" href="?halaman=<?php echo $x ?>">
                                                            <?php echo $x; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                echo "href='?halaman=$next'";
                                                                            } ?>><span aria-hidden="true">&raquo;</span></a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>
                                    <!-- End-Pagenation -->
                                </div>
                                <!-- End-Table Data Pengguna -->
                            </div>
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

    public function DataAlternatif()
    { ?>
        <?php $activePage = "alternatif";
        // mengambil data barang dengan kode paling besar
        $carikode = mysqli_query($this->koneksi->link, "select max(id_alternatif) from alternatif");
        $datakode = mysqli_fetch_array($carikode);
        if ($datakode) {
            $nilaikode = substr($datakode[0], 1);
            $kode = (int) $nilaikode;
            $kode = $kode + 1;
            $kode_otomatis = "A" . str_pad($kode, 2, "0", STR_PAD_LEFT);
        } else {
            //$kode_otomatis = "A01";
        }
        ?>

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
                                    <h5 class="card-title fw-semibold mb-4">Data Alternatif</h5>
                                    <!-- Button trigger modal -->
                                    <form action="simpan_data_alternatif.php" method="post">
                                        <div class="row mb-3">
                                            <label for="kode_alternatif" class="col-sm-2 col-form-label">Kode Alternatif</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="kode_alternatif" name="id_alternatif" value="<?= $kode_otomatis ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nama_alternatif" class="col-sm-2 col-form-label">Nama Alternatif</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" placeholder="Nama Alternatif" required>
                                            </div>
                                        </div>

                                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
                                    </form>

                                    <!-- Form pencarian-->
                                    <div>
                                        <form action="data_alternatif.php" method="get">
                                            <div class="input-group">
                                                <input type="text" name="cari" class="form-control" placeholder="Cari data...." aria-describedby="basic-addon1">
                                                <button class="btn btn-primary" value="Cari" type="sumbit" id="button-addon1">Cari</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End-Form pencarian-->
                                </div>
                                <!-- End-Button trigger modal -->

                                <!-- Table Data Pengguna -->
                                <div class="table-responsive">
                                    <!--Table Responsive-->
                                    <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">No</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Status</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $batas = 10;
                                            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                            $previous = $halaman - 1;
                                            $next = $halaman + 1;

                                            if (isset($_GET['cari'])) {
                                                $cari = $_GET['cari'];
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif WHERE id_alternatif like '%" . $cari . "%' or nama_alternatif like '%" . $cari . "%'");
                                            } else {
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif");
                                            }

                                            $countdata = mysqli_num_rows($data);
                                            $jumlah_data = mysqli_num_rows($data);
                                            $total_halaman = ceil($jumlah_data / $batas);
                                            $data_kriteria = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif WHERE id_alternatif like '%" . $cari . "%' or nama_alternatif like '%" . $cari . "%' limit $halaman_awal, $batas");
                                            $nomor = $halaman_awal + 1;

                                            while ($row = mysqli_fetch_array($data_kriteria)) {
                                                if ($row['status'] == 1) {
                                                    $status = '<p class="mb-0 fw-normal"><span class="badge bg-success rounded-3 fw-semibold" style="font-size:12px;">Valid</span></p>';
                                                    $edit = '<button class="btn btn-primary btn-sm" disabled>
                                                                <i class="fa fa-edit fa-lg">
                                                                </i>
                                                            </button>';
                                                    $hapus = '<button class="btn btn-danger btn-sm" disabled>
                                                                <i class="fa fa-trash fa-lg">
                                                                </i>
                                                            </button>';
                                                } elseif ($row['status'] == 0) {
                                                    $status = '<p class="mb-0 fw-normal"><span class="badge bg-danger rounded-3 fw-semibold" style="font-size:12px;">Menunggu</span></p>';
                                                    $edit = '<a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#id_kriteria' . $row['id_alternatif'] . '">
                                                                <i class="fa fa-edit fa-lg">
                                                                </i>
                                                            </a>
                                                            <div class="modal fade" id="id_kriteria' . $row['id_alternatif'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Alternatif</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" action="simpan_edit_alternatif.php">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Kode Alternatif</label>
                                                                                    <input type="text" class="form-control" name="id_alternatif" value="' . $row['id_alternatif'] . '" readonly>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="nama_alternatif" class="form-label">Nama Alternatif</label>
                                                                                    <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" value="' . $row['nama_alternatif'] . '" required>
                                                                                </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>';
                                                    $hapus = '<a class="btn btn-danger btn-sm" href="../alternatif/hapus_alternatif.php?key=' . $row['id_alternatif'] . '" id="btn-HapusMaster">
                                                                <i class="fa fa-trash fa-lg">
                                                                </i>
                                                            </a>';
                                                }

                                            ?>
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0"><?= $nomor++ ?></h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0"><?= $row['id_alternatif'] ?></h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <?= $status; ?>
                                                    </td>

                                                    <td class="border-bottom-0">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <!-- Button trigger modal Edit-->
                                                            <?= $edit ?>

                                                            <!-- Button Delete-->
                                                            <?= $hapus; ?>
                                                            <!-- Edn-Button Delete-->
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <!--End-Table Responsive-->

                                    <!--Tidak ditemukan-->
                                    <?php
                                    if ($countdata < 1) {
                                    ?>
                                        <h4 class="text-center" style="height:50px; margin-top:30px">pencarian data "<b><?= $cari ?></b>" tidak ditemukan &nbsp;<a href="data_alternatif.php"><i class="fa fa-search"></i></a></h4>
                                    <?php
                                    }
                                    ?>
                                    <!--End-Tidak ditemukan-->

                                    <!-- Pagenation -->
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of <b><?= $jumlah_data ?></b> entries
                                        </div>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination mt-2 mb-0">
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                                echo "href='?halaman=$previous'";
                                                                            } ?>><span aria-hidden="true">&laquo;</span></a>
                                                </li>
                                                <?php
                                                for ($x = 1; $x <= $total_halaman; $x++) {
                                                ?>
                                                    <li class="page-item <?php if ($halaman == "$x") {
                                                                                echo "active";
                                                                            } ?>" aria-current="page">
                                                        <a class="page-link" href="?halaman=<?php echo $x ?>">
                                                            <?php echo $x; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                echo "href='?halaman=$next'";
                                                                            } ?>><span aria-hidden="true">&raquo;</span></a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>
                                    <!-- End-Pagenation -->
                                </div>
                                <!-- End-Table Data Pengguna -->
                            </div>
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

    public function ValidasiKriteria()
    { ?>
        <?php $activePage = "validasi_kriteria";

        ?>

        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <!-- Sidebar Start -->
            <?php require_once "../layout/sidebarPakar.php"; ?>
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
                                <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                    <div class="mb-sm-0">
                                    </div>
                                    <!-- End-Modal Tambah Data-->

                                    <!-- Form pencarian-->
                                    <div>
                                        <form action="validasi_data_kriteria.php" method="get">
                                            <div class="input-group">
                                                <input type="text" name="cari" class="form-control" placeholder="Cari data...." aria-describedby="basic-addon1">
                                                <button class="btn btn-primary" value="Cari" type="sumbit" id="button-addon1">Cari</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End-Form pencarian-->
                                </div>
                                <!-- End-Button trigger modal -->

                                <!-- Table Data Pengguna -->
                                <div class="table-responsive">
                                    <!--Table Responsive-->
                                    <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">No</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Kode Kriteria</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nama Kriteria</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Bobot</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Normalisasi Bobot</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Status</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $batas = 10;
                                            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                            $previous = $halaman - 1;
                                            $next = $halaman + 1;

                                            if (isset($_GET['cari'])) {
                                                $cari = $_GET['cari'];
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria WHERE id_kriteria like '%" . $cari . "%' or nama like '%" . $cari . "%'");
                                            } else {
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria");
                                            }

                                            $countdata = mysqli_num_rows($data);
                                            $jumlah_data = mysqli_num_rows($data);
                                            $total_halaman = ceil($jumlah_data / $batas);
                                            $data_alternatif = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria WHERE id_kriteria like '%" . $cari . "%' or nama like '%" . $cari . "%'limit $halaman_awal, $batas");
                                            $nomor = $halaman_awal + 1;

                                            while ($row = mysqli_fetch_array($data_alternatif)) {
                                                if ($row['status'] == 1) {
                                                    $status = '<p class="mb-0 fw-normal"><span class="badge bg-success rounded-3 fw-semibold" style="font-size:12px;">Valid</span></p>';
                                                    $button = '<button class="btn btn-primary btn-sm" disabled>
                                                                <i class="fa fa-edit fa-lg">
                                                                </i>
                                                            </button>';
                                                } elseif ($row['status'] == 0) {
                                                    $status = '<p class="mb-0 fw-normal"><span class="badge bg-danger rounded-3 fw-semibold" style="font-size:12px;">Menunggu</span></p>';
                                                    $button = '<a href="../pakar/simpan_validasi_kriteria.php?key=' . $row['id_kriteria'] . '" id="btn-validasi" class="btn btn-primary btn-sm">
                                                                <i class="fa fa-edit fa-lg">
                                                                </i>
                                                            </a>';
                                                }

                                            ?>
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0"><?= $nomor++ ?></h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0"><?= $row['id_kriteria'] ?></h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"><?= $row['nama'] ?></p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"><?= $row['bobot'] ?></p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"><?= number_format($row['normalisasi_bobot'], 2) ?></p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <?= $status; ?>
                                                    </td>

                                                    <td class="border-bottom-0">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <!-- Button trigger modal Edit-->
                                                            <?= $button; ?>
                                                        </div>
                                                        <!-- Button Delete-->
                                                        <a class="btn btn-danger btn-sm" href="../kriteria/hapus_kriteria.php?key=<?= $row['id_kriteria'] ?>" id="btn-HapusMaster">
                                                            <i class="fa fa-trash fa-lg">
                                                            </i>
                                                        </a>
                                                        <!-- Edn-Button Delete-->
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <!--End-Table Responsive-->

                                    <!--Tidak ditemukan-->
                                    <?php
                                    if ($countdata < 1) {
                                    ?>
                                        <h4 class="text-center" style="height:50px; margin-top:30px">pencarian data "<b><?= $cari ?></b>" tidak ditemukan &nbsp;<a href="validasi_data_kriteria.php"><i class="fa fa-search"></i></a></h4>
                                    <?php
                                    }
                                    ?>
                                    <!--End-Tidak ditemukan-->

                                    <!-- Pagenation -->
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of <b><?= $jumlah_data ?></b> entries
                                        </div>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination mt-2 mb-0">
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                                echo "href='?halaman=$previous'";
                                                                            } ?>><span aria-hidden="true">&laquo;</span></a>
                                                </li>
                                                <?php
                                                for ($x = 1; $x <= $total_halaman; $x++) {
                                                ?>
                                                    <li class="page-item <?php if ($halaman == "$x") {
                                                                                echo "active";
                                                                            } ?>" aria-current="page">
                                                        <a class="page-link" href="?halaman=<?php echo $x ?>">
                                                            <?php echo $x; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                echo "href='?halaman=$next'";
                                                                            } ?>><span aria-hidden="true">&raquo;</span></a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>
                                    <!-- End-Pagenation -->
                                </div>
                                <!-- End-Table Data Pengguna -->
                            </div>
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

    public function ValidasiAlternatif()
    { ?>
        <?php $activePage = "validasi_alternatif";

        ?>

        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <!-- Sidebar Start -->
            <?php require_once "../layout/sidebarPakar.php"; ?>
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
                                <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                    <div class="mb-sm-0">
                                    </div>
                                    <!-- End-Modal Tambah Data-->

                                    <!-- Form pencarian-->
                                    <div>
                                        <form action="validasi_data_alternatif.php" method="get">
                                            <div class="input-group">
                                                <input type="text" name="cari" class="form-control" placeholder="Cari data...." aria-describedby="basic-addon1">
                                                <button class="btn btn-primary" value="Cari" type="sumbit" id="button-addon1">Cari</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End-Form pencarian-->
                                </div>
                                <!-- End-Button trigger modal -->

                                <!-- Table Data Pengguna -->
                                <div class="table-responsive">
                                    <!--Table Responsive-->
                                    <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">No</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Status</h6>
                                                </th>

                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Action</h6>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $batas = 10;
                                            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                            $previous = $halaman - 1;
                                            $next = $halaman + 1;

                                            if (isset($_GET['cari'])) {
                                                $cari = $_GET['cari'];
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif WHERE id_alternatif like '%" . $cari . "%' or nama_alternatif like '%" . $cari . "%'");
                                            } else {
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif");
                                            }

                                            $countdata = mysqli_num_rows($data);
                                            $jumlah_data = mysqli_num_rows($data);
                                            $total_halaman = ceil($jumlah_data / $batas);
                                            $data_alternatif = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif WHERE id_alternatif like '%" . $cari . "%' or nama_alternatif like '%" . $cari . "%' limit $halaman_awal, $batas");
                                            $nomor = $halaman_awal + 1;

                                            while ($row = mysqli_fetch_array($data_alternatif)) {
                                                if ($row['status'] == 1) {
                                                    $status = '<p class="mb-0 fw-normal"><span class="badge bg-success rounded-3 fw-semibold" style="font-size:12px;">Valid</span></p>';
                                                    $button = '<button class="btn btn-primary btn-sm" disabled>
                                                                <i class="fa fa-edit fa-lg">
                                                                </i>
                                                            </button>';
                                                } elseif ($row['status'] == 0) {
                                                    $status = '<p class="mb-0 fw-normal"><span class="badge bg-danger rounded-3 fw-semibold" style="font-size:12px;">Menunggu</span></p>';
                                                    $button = '<a href="../pakar/simpan_validasi_data.php?key=' . $row['id_alternatif'] . '" id="btn-validasi" class="btn btn-primary btn-sm">
                                                                <i class="fa fa-edit fa-lg">
                                                                </i>
                                                            </a>';
                                                }

                                            ?>
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0"><?= $nomor++ ?></h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0"><?= $row['id_alternatif'] ?></h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <?= $status; ?>
                                                    </td>

                                                    <td class="border-bottom-0">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <!-- Button trigger modal Edit-->
                                                            <?= $button; ?>
                                                        </div>
                                                        <!-- Button Delete-->
                                                        <a class="btn btn-danger btn-sm" href="../alternatif/hapus_alternatif.php?key=<?= $row['id_alternatif'] ?>" id="btn-HapusMaster">
                                                            <i class="fa fa-trash fa-lg">
                                                            </i>
                                                        </a>
                                                        <!-- Edn-Button Delete-->
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <!--End-Table Responsive-->

                                    <!--Tidak ditemukan-->
                                    <?php
                                    if ($countdata < 1) {
                                    ?>
                                        <h4 class="text-center" style="height:50px; margin-top:30px">pencarian data "<b><?= $cari ?></b>" tidak ditemukan &nbsp;<a href="validasi_data_alternatif.php"><i class="fa fa-search"></i></a></h4>
                                    <?php
                                    }
                                    ?>
                                    <!--End-Tidak ditemukan-->

                                    <!-- Pagenation -->
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of <b><?= $jumlah_data ?></b> entries
                                        </div>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination mt-2 mb-0">
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                                echo "href='?halaman=$previous'";
                                                                            } ?>><span aria-hidden="true">&laquo;</span></a>
                                                </li>
                                                <?php
                                                for ($x = 1; $x <= $total_halaman; $x++) {
                                                ?>
                                                    <li class="page-item <?php if ($halaman == "$x") {
                                                                                echo "active";
                                                                            } ?>" aria-current="page">
                                                        <a class="page-link" href="?halaman=<?php echo $x ?>">
                                                            <?php echo $x; ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                echo "href='?halaman=$next'";
                                                                            } ?>><span aria-hidden="true">&raquo;</span></a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>
                                    <!-- End-Pagenation -->
                                </div>
                                <!-- End-Table Data Pengguna -->
                            </div>
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


    public function Penilaian()
    { ?>
        <!-- <?php error_reporting(0); ?> -->
        <?php $activePage = "bobot"; ?>

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
                                    <h5 class="card-title fw-semibold mb-4">Bobot Alternatif</h5>
                                    <!-- Button trigger modal -->


                                    <!-- Button trigger modal -->
                                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                        <div class="mb-sm-0">
                                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                                                <i class="fa fa-plus">
                                                </i>
                                                Tambah
                                            </a>
                                            <!-- Modal Tambah Data-->
                                            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Bobot Alternatif</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form method="post" action="simpan_bobot.php">
                                                                <div class="mb-3">
                                                                    <label for="jk" class="form-label">Nama Alternatif</label>
                                                                    <select class="form-select" aria-label="Default select example" name="id_alternatif" required>
                                                                        <option selected disabled value="">Pilih</option>
                                                                        <?php
                                                                        $cek_alternatif = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif where status = '1'");
                                                                        while ($row_data = mysqli_fetch_array($cek_alternatif)) {
                                                                        ?>
                                                                            <option value="<?= $row_data['id_alternatif'] ?>"><b><?= $row_data['id_alternatif']  ?></b> (<?= $row_data['nama_alternatif']; ?>)</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <?php
                                                             $cek = mysqli_query($this->koneksi->link, "SELECT kriteria.*, sub_kriteria.*
                                                             FROM kriteria
                                                             INNER JOIN sub_kriteria ON kriteria.id_kriteria = sub_kriteria.id_kriteria
                                                             WHERE kriteria.status='1'
                                                             GROUP BY kriteria.id_kriteria");
                                                         
                                                                 while ($data = mysqli_fetch_array($cek)) {
                                                                    $kriteria = $data['id_kriteria'];

                                                                ?>
                                                                    <div class="mb-3">
                                                                        <label for="jk" class="form-label"><?= $data['nama']; ?></label>
                                                                        <select class="form-select" aria-label="Default select example" name="nilai[]" required>
                                                                            <option selected disabled value="">Pilih</option>
                                                                            <?php
                                                                            $data_query2 = mysqli_query($this->koneksi->link, "SELECT *FROM kriteria INNER JOIN sub_kriteria on kriteria.id_kriteria = sub_kriteria.id_kriteria WHERE sub_kriteria.id_kriteria = '$kriteria' GROUP BY sub_kriteria.parameter ORDER BY kriteria.id_kriteria, sub_kriteria.nilai DESC");
                                                                            while ($data2 = mysqli_fetch_array($data_query2)) {
                                                                            ?>
                                                                                <option value="<?= $data2['nilai'] ?>"><?= $data2['parameter']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                <?php } ?>
                                                                <input type="hidden" name="nilai_hasil" value="0">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End-Modal Tambah Data-->

                                        <!-- Form pencarian-->
                                        <div>
                                            <form action="data_bobot.php" method="get">
                                                <div class="input-group">
                                                    <input type="text" name="cari" class="form-control" placeholder="Cari data...." aria-describedby="basic-addon1">
                                                    <button class="btn btn-primary" value="Cari" type="sumbit" id="button-addon1">Cari</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End-Form pencarian-->
                                    </div>
                                    <!-- End-Button trigger modal -->

                                    <!-- Table Data Pengguna -->
                                    <div class="table-responsive">
                                        <!--Table Responsive-->
                                        <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0 align-middle" rowspan="2">
                                                        <h6 class="fw-semibold mb-0">Kode</h6>
                                                    </th>
                                                    <th class="border-bottom-0 align-middle" rowspan="2">
                                                        <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                    </th>
                                                    <th class="border-bottom-0 align-middle text-center" colspan="6">
                                                        <h6 class="fw-semibold mb-0">Kriteria</h6>
                                                    </th>
                                                    <th class="border-bottom-0 align-middle text-center" rowspan="2">
                                                        <h6 class="fw-semibold mb-0">Action</h6>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <h6 class="fw-semibold mb-0">Umur Tanaman</h6>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <h6 class="fw-semibold mb-0">Hasil Produksi</h6>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <h6 class="fw-semibold mb-0">Ketahanan Hama</h6>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <h6 class="fw-semibold mb-0">Tinggi Tanaman</h6>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <h6 class="fw-semibold mb-0">Warna Tanaman</h6>
                                                    </td>
                                                    <td class="border-bottom-0 align-middle text-center">
                                                        <h6 class="fw-semibold mb-0">Kerontokan</h6>
                                                    </td>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $batas = 10;
                                                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                                $previous = $halaman - 1;
                                                $next = $halaman + 1;

                                                if (isset($_GET['cari'])) {
                                                    $cari = $_GET['cari'];
                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif WHERE alternatif.nama_alternatif like '%" . $cari . "%' or bobot_alternatif.id_alternatif like '%" . $cari . "%'");
                                                } else {
                                                    $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif ");
                                                }

                                                $countdata = mysqli_num_rows($data);
                                                $jumlah_data = mysqli_num_rows($data);
                                                $total_halaman = ceil($jumlah_data / $batas);
                                                $data_kriteria = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN bobot_alternatif on alternatif.id_alternatif = bobot_alternatif.id_alternatif WHERE alternatif.nama_alternatif like '%" . $cari . "%' or bobot_alternatif.id_alternatif like '%" . $cari . "%' limit $halaman_awal, $batas");
                                                $nomor = $halaman_awal + 1;

                                                while ($row = mysqli_fetch_array($data_kriteria)) {

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

                                                        <td class="border-bottom-0 align-middle text-center">
                                                            <!-- Button Delete-->
                                                            <a class=" btn btn-danger btn-sm" href="../bobot_alternatif/hapus_bobot.php?key=<?= $row['id_alternatif'] ?>" id="btn-Hapus">
                                                                <i class="fa fa-trash fa-lg">
                                                                </i>
                                                            </a>
                                                            <!-- Edn-Button Delete-->
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <!--End-Table Responsive-->

                                        <!--Tidak ditemukan-->
                                        <?php
                                        if ($countdata < 1) {
                                        ?>
                                            <h4 class="text-center" style="height:50px; margin-top:30px">pencarian data "<b><?= $cari ?></b>" tidak ditemukan &nbsp;<a href="data_alternatif.php"><i class="fa fa-search"></i></a></h4>
                                        <?php
                                        }
                                        ?>
                                        <!--End-Tidak ditemukan-->

                                        <!-- Pagenation -->
                                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                                Showing 1 to 10 of <b><?= $jumlah_data ?></b> entries
                                            </div>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination mt-2 mb-0">
                                                    <li class="page-item">
                                                        <a class="page-link" <?php if ($halaman > 1) {
                                                                                    echo "href='?halaman=$previous'";
                                                                                } ?>><span aria-hidden="true">&laquo;</span></a>
                                                    </li>
                                                    <?php
                                                    for ($x = 1; $x <= $total_halaman; $x++) {
                                                    ?>
                                                        <li class="page-item <?php if ($halaman == "$x") {
                                                                                    echo "active";
                                                                                } ?>" aria-current="page">
                                                            <a class="page-link" href="?halaman=<?php echo $x ?>">
                                                                <?php echo $x; ?>
                                                            </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <li class="page-item">
                                                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                    echo "href='?halaman=$next'";
                                                                                } ?>><span aria-hidden="true">&raquo;</span></a>
                                                    </li>
                                                </ul>
                                            </nav>

                                        </div>
                                        <!-- End-Pagenation -->
                                    </div>
                                    <!-- End-Table Data Pengguna -->
                                </div>
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

    public function DataPerhitunganTOPSIS()
    {
    ?>
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
                                                    $Array[] = $preferensi;
                                                    $Array1[] = $preferensi;
                                                    $Array2[] = $preferensi;
                                                    $Array3[] = $preferensi;
                                                    $Array4[] = $preferensi;
                                                    $Array5[] = $preferensi;
                                                    $Array6[] = $preferensi;
                                                    $Array7[] = $preferensi;
                                                    $Array8[] = $preferensi;
                                                    $Array9[] = $preferensi;
                                                    $Array10[] = $preferensi;
                                                    $Array11[] = $preferensi;
                                                    $Array12[] = $preferensi;
                                                    $Array13[] = $preferensi;
                                                    $Array14[] = $preferensi;
                                                    $Array15[] = $preferensi;
                                                    $Array16[] = $preferensi;
                                                    $Array17[] = $preferensi;
                                                    $Array18[] = $preferensi;
                                                    $Array19[] = $preferensi;
                                                    $Array20[] = $preferensi;


                                                ?> <tr>
                                                        <td class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0"><?= $i ?></h6>
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

    public function HasilKeputusan()
    { ?>
            <!-- <?php error_reporting(0); ?> -->
            <?php $activePage = "hasil_keputusan"; ?>

            <!--  Body Wrapper -->
            <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
                <!-- Sidebar Start -->
                <?php
                if ($_SESSION['role'] == 'ROL001') {
                    $sidebar = require_once "../layout/sidebar.php";
                } elseif ($_SESSION['role'] == 'ROL002') {
                    $sidebar = require_once "../layout/sidebarPakar.php";
                }
                ?>

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
                                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                            <div class="mb-3 mb-sm-0">
                                                <h5 class="card-title fw-semibold mb-4">Hasil Keputusan Perhitungan metode TOPSIS</h5>
                                            </div>

                                            <div class="col-auto">
                                                <a data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="true" aria-controls="multiCollapseExample1">
                                                    <button type="button" class="btn btn-sm"><i class="fas fa-plus" style="font-size: 20px;"></i></button>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="collapse multi-collapse show" id="multiCollapseExample1">
                                            <div class=" mb-2">
                                                <a href="../hasil/cetak_hasil_keputusan.php" class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="fa fa-print">
                                                    </i>
                                                    Cetak
                                                </a>
                                            </div>
                                            <!-- Table Data Pengguna -->
                                            <div class="table-responsive">
                                                <!--Table Responsive-->
                                                <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                                    <thead class="text-dark fs-4">
                                                        <tr>
                                                            <th class="border-bottom-0 align-middle text-center">
                                                                <h6 class="fw-semibold mb-0">Kode Alternatif</h6>
                                                            </th>
                                                            <th class="border-bottom-0 align-middle text-center">
                                                                <h6 class="fw-semibold mb-0">Nama Alternatif</h6>
                                                            </th>
                                                            <th class="border-bottom-0 align-middle text-center">
                                                                <h6 class="fw-semibold mb-0">Nilai Preferensi (Vi)</h6>
                                                            </th>
                                                            <th class="border-bottom-0 align-middle text-center">
                                                                <h6 class="fw-semibold mb-0">Ranking</h6>
                                                            </th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $data = mysqli_query($this->koneksi->link, "SELECT *FROM alternatif INNER JOIN hasil on alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil DESC");
                                                        $sql = mysqli_num_rows($data);
                                                        for ($i = 1; $i <= $sql; $i++) {
                                                            $row = mysqli_fetch_array($data);

                                                            if ($i == '1') {
                                                                $Rekomendasi = '<span class="text-primary fw-normal">Rekomendasi</span>';
                                                            } elseif ($i == '2') {
                                                                $Rekomendasi = '<span class="text-primary fw-normal">Rekomendasi</span>';
                                                            } elseif ($i == '3') {
                                                                $Rekomendasi = '<span class="text-primary fw-normal">Rekomendasi</span>';
                                                            } elseif ($i == '4') {
                                                                $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                            } elseif ($i == '5') {
                                                                $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                            } elseif ($i == '6') {
                                                                $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                            } elseif ($i == '7') {
                                                                $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                            } elseif ($i == '8') {
                                                                $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                            } elseif ($i == '9') {
                                                                $Rekomendasi = '<span class="text-warning fw-normal">Kurang </span>';
                                                            } else {
                                                                $Rekomendasi = 'Tidak ';
                                                            }


                                                        ?> <tr>
                                                                <td class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0" style="text-align: center;"><?= $row['id_alternatif'] ?></h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-normal"><?= $row['nama_alternatif'] ?></p>
                                                                </td>
                                                                <td class="border-bottom-0 align-middle text-center">
                                                                    <p class="mb-0 fw-normal"><?= number_format($row['hasil'], 3); ?></p>
                                                                </td>
                                                                <td class="border-bottom-0 align-middle text-center">
                                                                    <p class="mb-0 fw-normal"><?= $i; ?></p>
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


                            <!-- Footer Start -->
                            <?php require_once "../layout/footer.php"; ?>
                            <!-- End-Footer Start -->
                        </div>
                        <!-- End-Content Start -->
                    </div>
                    <!--  End-Main wrapper -->
                </div>
                <!--  End-Body Wrapper -->
            <?php }

        public function DataPengguna()
        { ?>
                <?php $activePage = "user_login"; ?>
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
                                            <h5 class="card-title fw-semibold mb-4">Data Pengguna</h5>
                                            <!-- Button trigger modal -->
                                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                                <div class="mb-sm-0">
                                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                                                        <i class="fa fa-plus">
                                                        </i>
                                                        Tambah
                                                    </a>

                                                    <?php
                                                    // mengambil data barang dengan kode paling besar
                                                    $query = mysqli_query($this->koneksi->link, "SELECT max(id_pengguna) as kodeTerbesar FROM pengguna");
                                                    $data = mysqli_fetch_array($query);
                                                    $IDP = $data['kodeTerbesar'];
                                                    $urutan = (int) substr($IDP, 3, 3);
                                                    $urutan++;

                                                    $huruf = "IDP";
                                                    $IDP = $huruf . sprintf("%03s", $urutan);
                                                    // echo $IDP;
                                                    ?>
                                                    <!-- Modal Tambah Data-->
                                                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Pengguna</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form method="post" action="simpan_data_pengguna.php">
                                                                        <input type="hidden" class="form-control" name="idp" value="<?= $IDP ?>">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">NIK (Nomor induk Keluarga)</label>
                                                                            <input type="text" class="form-control" name="angka" placeholder="Masukan NIK" onkeypress="return hanyaAngka(event)" minlength="16" maxlength="16" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                                                            <input type="text" class="form-control" id="nama" name="nama_lengkap" placeholder="Nama Lengkap" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="jk" class="form-label">Jenis Kelamin</label>
                                                                            <select class="form-select" aria-label="Default select example" name="jk" required>
                                                                                <option selected disabled value="">Pilih</option>
                                                                                <option value="L">Laki-Laki</option>
                                                                                <option value="P">Perempuan</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-0">
                                                                            <label for="no" class="form-label">No HP</label>
                                                                        </div>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">+62</span>
                                                                            <input type="number" class="form-control" id="no" name="no_hp" placeholder="No HP" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                                                                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat Lengkap" required></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="email" class="form-label">Email</label>
                                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Username" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="password" class="form-label">Password</label>
                                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="jk" class="form-label">Hak Akses</label>
                                                                            <select class="form-select" aria-label="Default select example" name="role" required>
                                                                                <option selected disabled value="">Pilih</option>
                                                                                <option value="ROL001">Administrator</option>
                                                                                <option value="ROL002">Pakar</option>
                                                                            </select>
                                                                        </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End-Modal Tambah Data-->

                                                <!-- Form pencarian-->
                                                <div>
                                                    <form action="data_pengguna.php" method="get">
                                                        <div class="input-group">
                                                            <input type="text" name="cari" class="form-control" placeholder="Cari data...." aria-describedby="basic-addon1">
                                                            <button class="btn btn-primary" value="Cari" type="sumbit" id="button-addon1">Cari</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- End-Form pencarian-->
                                            </div>
                                            <!-- End-Button trigger modal -->

                                            <!-- Table Data Pengguna -->
                                            <div class="table-responsive">
                                                <!--Table Responsive-->
                                                <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                                    <thead class="text-dark fs-4">
                                                        <tr>
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">No</h6>
                                                            </th>
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">ID Pengguna</h6>
                                                            </th>
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">NIK</h6>
                                                            </th>
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">Nama Lengkap</h6>
                                                            </th>

                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">Username</h6>
                                                            </th>
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">Status</h6>
                                                            </th>
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">Action</h6>
                                                            </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $batas = 5;
                                                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                                        $previous = $halaman - 1;
                                                        $next = $halaman + 1;

                                                        if (isset($_GET['cari'])) {
                                                            $cari = $_GET['cari'];
                                                            $data = mysqli_query($this->koneksi->link, "SELECT *FROM pengguna INNER JOIN user_login on pengguna.id_pengguna = user_login.id_pengguna WHERE pengguna.nama like '%" . $cari . "%' or pengguna.nik like '%" . $cari . "%' or user_login.username like '%" . $cari . "%' or user_login.role like '%" . $cari . "%'");
                                                        } else {
                                                            $data = mysqli_query($this->koneksi->link, "SELECT *FROM pengguna INNER JOIN user_login on pengguna.id_pengguna = user_login.id_pengguna");
                                                        }

                                                        $countdata = mysqli_num_rows($data);
                                                        $jumlah_data = mysqli_num_rows($data);
                                                        $total_halaman = ceil($jumlah_data / $batas);
                                                        $data_user = mysqli_query($this->koneksi->link, "SELECT *FROM pengguna INNER JOIN user_login on pengguna.id_pengguna = user_login.id_pengguna WHERE pengguna.nama like '%" . $cari . "%' or pengguna.nik like '%" . $cari . "%' or user_login.username like '%" . $cari . "%' or user_login.role like '%" . $cari . "%' limit $halaman_awal, $batas");
                                                        $nomor = $halaman_awal + 1;

                                                        while ($row = mysqli_fetch_array($data_user)) {
                                                            $pass = base64_decode($row['password']);
                                                            $date = $row['log_datetime'];
                                                            // Convert Hak_akses
                                                            if ($row['role'] == "ROL001") {
                                                                $role = 'Administrator';
                                                                $tampil = '<h6 class="fw-semibold mb-1">' . $row['nama'] . '</h6>
                                                        <span class="text-primary fw-normal">' . $role . '</span>';
                                                            } elseif ($row['role'] == "ROL002") {
                                                                $role = 'Pakar';
                                                                $tampil = '<h6 class="fw-semibold mb-1">' . $row['nama'] . '</h6>
                                                        <span class="fw-normal">' . $role . '</span>';
                                                            }
                                                            // End-Convert Hak_akses

                                                            // Convert Status Aktivasi
                                                            if ($row['suspend'] == '1') {
                                                                $sts_aktivasi = 'Sudah Aktivasi';
                                                                $alert_aktivasi = '<span class="badge bg-secondary rounded-3 fw-semibold" style="font-size: 10px;">' . $sts_aktivasi . '</span>';
                                                            } elseif ($row['status_aktivasi'] == '0') {
                                                                $sts_aktivasi = 'Belum Aktivasi';
                                                                $alert_aktivasi = '<a href="../pengguna/aktivasi_pengguna.php?key=' . $row['id_user'] . '" id="btn-aktivasi"><span class="badge bg-danger rounded-3 fw-semibold" style="font-size: 10px;">' . $sts_aktivasi . '</span></a>';
                                                            } elseif ($row['status_aktivasi'] == '1') {
                                                                $sts_aktivasi = 'Sudah Aktivasi';
                                                                $alert_aktivasi = '<a href="../pengguna/non-active_pengguna.php?key=' . $row['id_user'] . '" id="btn-non-active"><span class="badge bg-secondary rounded-3 fw-semibold" style="font-size: 10px;">' . $sts_aktivasi . '</span></a>';
                                                            }
                                                            // End-Convert Status Aktivasi

                                                            // Convert Status Aktif akun
                                                            if ($row['suspend'] == '1') {
                                                                $sts_active = '<a href="../pengguna/aktifkan_akun.php?key=' . $row['id_user'] . '" id="btn-aktifkan"><span class="badge bg-danger rounded-3 fw-semibold" style="font-size:12px;">Suspend</span></a>';
                                                                $alert = '<span class="badge bg-danger rounded-3 fw-semibold" style="font-size: 10px;">' . $sts_active . '</span>';
                                                            } elseif ($row['status_active'] == '1') {
                                                                $sts_active = '<span class="badge bg-success rounded-3 fw-semibold" style="font-size:12px;">Online</span>';
                                                                $alert = '<span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">' . $sts_active . '</span>';
                                                            } elseif ($row['status_active'] == '0') {
                                                                $sts_active = '<span class="badge bg-danger rounded-3 fw-semibold" style="font-size:12px;">Offline</span>';
                                                                $alert = '<span class="badge bg-danger rounded-3 fw-semibold" style="font-size: 10px;">' . $sts_active . '</span>';
                                                            }
                                                            // End-Convert Status Aktif akun

                                                            //Convert Gender
                                                            if ($row['gender'] == 'L') {
                                                                $gender = 'Laki-Laki';
                                                            } elseif ($row['gender'] == 'P') {
                                                                $gender = 'Perempuan';
                                                            }

                                                            // $last_login = date('l', strtotime($date_datetime));
                                                            if (($row['status_aktivasi'] == '0') || ($row['status_active'] == $last_login)) {
                                                                $log_status = '- <br>(Belum Aktivasi)';
                                                            } elseif (($row['status_aktivasi'] == '1') || ($row['status_active'] == $last_login)) {
                                                                $awal  = strtotime($date); //waktu awal
                                                                $akhir = strtotime(date('Y-m-d H:i:s')); //waktu akhir
                                                                $diff  = $akhir - $awal;
                                                                $hari = floor($diff / (60 * 60 * 24));

                                                                $jam   = floor($diff / (60 * 60));

                                                                $menit = $diff - $jam * (60 * 60);
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0" style="text-align: center;"><?= $nomor++ ?></h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0" style="text-align: center;"><?= $row['id_pengguna'] ?></h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-normal"><?= $row['nik'] ?></p>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <?= $tampil ?>
                                                                </td>

                                                                <td class="border-bottom-0">
                                                                    <p class="mb-0 fw-normal"><?= $row['username'] ?></p>
                                                                    <div class="input-group">
                                                                        <button style="border:none; background:transparent" type="button"><span toggle="#password-field<?= $row['id_user'] ?>" class="fa fa-eye field-icon toggle-password<?= $row['id_user'] ?>"></span></button>
                                                                        <input type="password" class="form-control" style="background: transparent; border:none; box-shadow:none;" id="password-field<?= $row['id_user'] ?>" value="<?= $pass ?>" disabled>
                                                                    </div>
                                                                    <!-- JSShow Password Toggle-->
                                                                    <script>
                                                                        $(".toggle-password<?= $row['id_user'] ?>").click(function() {
                                                                            $(this).toggleClass("fa-eye fa-eye-slash");
                                                                            var input = $($(this).attr("toggle"));
                                                                            if (input.attr("type") == "password") {
                                                                                input.attr("type", "<?= $row['id_user'] ?>");
                                                                            } else {
                                                                                input.attr("type", "password");
                                                                            }
                                                                        });
                                                                    </script>
                                                                    <!-- End-JSShow Password Toggle-->
                                                                </td>

                                                                <td class="border-bottom-0">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <?= $sts_active ?>
                                                                    </div>
                                                                    <span class="fw-normal" style="font-size: 10px;">last login: <br> <i class="far fa-clock mr-1"></i> &nbsp;<?= $jam ?> Hours Ago</span>
                                                                </td>

                                                                <td class="border-bottom-0">
                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                        <a class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#details<?= $row['nik'] ?>">
                                                                            <i class="fa fa-info-circle fa-lg">
                                                                            </i>
                                                                        </a>
                                                                        <!-- Button trigger modal Details-->
                                                                        <div class="modal fade" id="details<?= $row['nik'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel1">Info Lengkap Pengguna</h1>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <table class="table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th scope="row">NIK</th>
                                                                                                    <td>:</td>
                                                                                                    <td><?= $row['nik'] ?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">Nama Lengkap</th>
                                                                                                    <td>:</td>
                                                                                                    <td><?= $row['nama'] ?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">Jenis Kelamin</th>
                                                                                                    <td>:</td>
                                                                                                    <td><?= $gender ?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">Alamat Lengkap</th>
                                                                                                    <td>:</td>
                                                                                                    <td><textarea rows="2" style="border: none; width:250px" readonly><?= $row['alamat'] ?></textarea></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">Username</th>
                                                                                                    <td>:</td>
                                                                                                    <td><?= $row['email'] ?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">Password</th>
                                                                                                    <td>:</td>
                                                                                                    <td><?= $pass ?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">Role</th>
                                                                                                    <td>:</td>
                                                                                                    <td><?= $row['role'] ?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">Status</th>
                                                                                                    <td>:</td>
                                                                                                    <td>
                                                                                                        <div class="d-flex align-items-center gap-2">
                                                                                                            <?= $alert ?>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">Status Registrasi</th>
                                                                                                    <td>:</td>
                                                                                                    <td>
                                                                                                        <div class="d-flex align-items-center gap-2">
                                                                                                            <?= $alert_aktivasi ?>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th scope="row">Log Status</th>
                                                                                                    <td>:</td>
                                                                                                    <td><?= $jam ?> Hours Ago</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><!-- End-Button trigger modal Details-->

                                                                        <!-- Button trigger modal Edit-->
                                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#user_id<?= $row['id_pengguna'] ?>">
                                                                            <i class="fa fa-edit fa-lg">
                                                                            </i>
                                                                        </a>

                                                                        <!-- Button trigger modal Edit-->
                                                                        <div class="modal fade" id="user_id<?= $row['id_pengguna'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pengguna</h1>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form method="post" action="simpan_edit_pengguna.php">
                                                                                            <input type="hidden" class="form-control" name="idp" value="<?= $row['id_pengguna'] ?>">
                                                                                            <!-- <input type="hidden" class="form-control" name="id_user" value="<?= $row['id_user'] ?>"> -->
                                                                                            <div class="mb-3">
                                                                                                <label class="form-label">NIK (Nomor induk Keluarga)</label>
                                                                                                <input type="text" class="form-control" name="angka" value="<?= $row['nik'] ?>" onkeypress="return hanyaAngka(event)" minlength="16" maxlength="16" required>
                                                                                            </div>

                                                                                            <div class="mb-3">
                                                                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                                                                <input type="text" class="form-control" id="nama" name="nama_lengkap" value="<?= $row['nama'] ?>" required>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                                                                                <select class="form-select" aria-label="Default select example" name="jk">
                                                                                                    <option value="<?= $row['gender'] ?>">Pilih</option>
                                                                                                    <option value="L">Laki-Laki</option>
                                                                                                    <option value="P">Perempuan</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="mb-0">
                                                                                                <label for="no" class="form-label">No HP</label>
                                                                                            </div>
                                                                                            <div class="input-group mb-3">
                                                                                                <span class="input-group-text" id="basic-addon1">+62</span>
                                                                                                <input type="number" class="form-control" id="no" name="no_hp" value="<?= $row['no_hp'] ?>" required>
                                                                                            </div>

                                                                                            <div class="mb-3">
                                                                                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                                                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $row['alamat'] ?></textarea>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="email" class="form-label">Email</label>
                                                                                                <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>" required>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="password" class="form-label">Password</label>
                                                                                                <input type="text" class="form-control" id="password" name="password" value="<?= $pass ?>" required>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label class="form-label">Hak Akses</label>
                                                                                                <select class="form-select" aria-label="Default select example" name="role">
                                                                                                    <option value="<?= $row['role'] ?>">Pilih</option>
                                                                                                    <option value="ROL001">Administrator</option>
                                                                                                    <option value="ROL002">Pakar</option>
                                                                                                </select>
                                                                                            </div>

                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                                                    </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- End-Button trigger modal Edit-->

                                                                        <!-- Button Delete-->
                                                                        <a class="btn btn-danger btn-sm" href="../pengguna/hapus_pengguna.php?key=<?= $row['email'] ?>" id="btn-Hapus">
                                                                            <i class="fa fa-trash fa-lg">
                                                                            </i>
                                                                        </a>
                                                                        <!-- Edn-Button Delete-->
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <!--End-Table Responsive-->

                                                <!--Tidak ditemukan-->
                                                <?php
                                                if ($countdata < 1) {
                                                ?>
                                                    <h4 class="text-center" style="height:50px; margin-top:30px">pencarian data "<b><?= $cari ?></b>" tidak ditemukan &nbsp;<a href="data_alternatif.php"><i class="fa fa-search"></i></a></h4>
                                                <?php
                                                }
                                                ?>
                                                <!--End-Tidak ditemukan-->

                                                <!-- Pagenation -->
                                                <div class="d-sm-flex d-block align-items-center justify-content-between mb-2">
                                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                                        Showing 1 to 10 of <b><?= $jumlah_data ?></b> entries
                                                    </div>
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination mt-2 mb-0">
                                                            <li class="page-item">
                                                                <a class="page-link" <?php if ($halaman > 1) {
                                                                                            echo "href='?halaman=$previous'";
                                                                                        } ?>><span aria-hidden="true">&laquo;</span></a>
                                                            </li>
                                                            <?php
                                                            for ($x = 1; $x <= $total_halaman; $x++) {
                                                            ?>
                                                                <li class="page-item <?php if ($halaman == "$x") {
                                                                                            echo "active";
                                                                                        } ?>" aria-current="page">
                                                                    <a class="page-link" href="?halaman=<?php echo $x ?>">
                                                                        <?php echo $x; ?>
                                                                    </a>
                                                                </li>
                                                            <?php
                                                            }
                                                            ?>
                                                            <li class="page-item">
                                                                <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                            echo "href='?halaman=$next'";
                                                                                        } ?>><span aria-hidden="true">&raquo;</span></a>
                                                            </li>
                                                        </ul>
                                                    </nav>

                                                </div>
                                                <!-- End-Pagenation -->
                                            </div>
                                            <!-- End-Table Data Pengguna -->
                                        </div>
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
            <?php }

        public function Setting()
        { ?>
                <?php
                if ($_SESSION['role'] == 'ROL001') {
                    $activePage = "Administrator";
                } elseif ($_SESSION['role'] == 'ROL002') {
                    $activePage = "Pakar";
                }
                ?>

                <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
                    <!-- Sidebar Start -->
                    <?php
                    if ($_SESSION['role'] == 'ROL001') {
                        $sidebar = require_once "../layout/sidebar.php";
                        $home = '../pages/Administrator.php';
                    } elseif ($_SESSION['role'] == 'ROL002') {
                        $sidebar = require_once "../layout/sidebarPakar.php";
                        $home = '../pages/Pakar.php';
                    }

                    ?>

                    <!--  Main wrapper -->
                    <div class="body-wrapper">
                        <!-- Header Start -->
                        <?php require_once "../layout/navbar.php"; ?>
                        <!-- End-Header Start -->
                        <?php
                        $key = $_GET['key'];
                        $query = mysqli_query($this->koneksi->link, "SELECT *FROM pengguna INNER JOIN user_login on pengguna.id_pengguna = user_login.id_pengguna WHERE email = '$key'");
                        $row = mysqli_fetch_array($query);
                        $pass = base64_decode($row['password']);
                        ?>
                        <!-- Content Start -->
                        <div class="container-fluid">
                            <div class="card col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title fw-semibold mb-4">Setting akun</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form method="post" action="simpan_setting.php" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label class="form-label" style="font-size: 13px;">* Silahkan ubah username atau password untuk <?= $activePage ?></label>
                                                </div>
                                                <input type="hidden" value="<?= $row['id_user'] ?>" name="id_user">
                                                <input type="hidden" value="<?= $row['id_pengguna'] ?>" name="idp">
                                                <div class="col-md-11">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?= $row['username'] ?>" placeholder="username">
                                                    </div>
                                                </div>
                                                <div class="col-md-11">
                                                    <div class="mb-3">
                                                        <label for="inputPassword" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="password" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input primary" type="checkbox" value="" name="remember" value="true" onclick="myFunction()" id="rememberme">
                                                            <label class="form-check-label text-dark" for="rememberme">
                                                                Show password
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="d-grid gap-1 d-md-flex mt-0 mb-0">
                                                        <button class="btn btn-primary btn-sm" type="submit">Ubah</button>
                                                        <!-- <a href="" id="btn-reset">
                                                    <button class="btn btn-danger btn-sm me-md-0" type="button">Reset Akun</button>
                                                </a> -->
                                                        <a href="<?= $home ?>">
                                                            <button class="btn btn-danger btn-sm me-md-0" type="button">Batal</button>
                                                        </a>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
            <?php }

        public function InformasiProgram()
        { ?>
                <?php $activePage = "informasi"; ?>
                <!--  Body Wrapper -->
                <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
                    <!-- Sidebar Start -->
                    <?php
                    if ($_SESSION['role'] == 'ROL001') {
                        $sidebar = require_once "../layout/sidebar.php";
                    } elseif ($_SESSION['role'] == 'ROL002') {
                        $sidebar = require_once "../layout/sidebarPakar.php";
                    }
                    ?>

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
                                <div class="col-lg-12">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <center>
                                                <img src="../../assets/img/horizon.png" class="card-img-middle" alt="...">
                                            </center>
                                            <div class="card-body text-center" style="font-weight: bold;">
                                                <p class="card-text">FAKULTAS TEKNOLOGI INFORMASI DAN KOMPUTER<br>PROGRAM STUDI INFORMATIKA</p>
                                                <h5 class="card-title" style="line-height: 0px; font-weight:bold">UNIVERSITAS HORIZON INDONESIA</h5>
                                                <p class="card-text" style="line-height:40px">2024</p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <h5 class="card-title">Biodata Mahasiswa</h5>
                                                <table class="table" style="border: 1px solid white;">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" style="width: 150px;">NPM</th>
                                                            <td>: &nbsp;43E57006195041</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Nama Lengkap</th>
                                                            <td>: &nbsp;Wahyu Nurdian</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Program Studi</th>
                                                            <td>: &nbsp;Informatika</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Judul Penelitian</th>
                                                            <td>: &nbsp;Sistem Pendukung Keputusan Menentukan Bibit Padi Terbaik </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"></th>
                                                            <td> &nbsp;&nbsp;&nbsp;&nbsp;Menggunakan Metode TOPSIS Berbasis Web</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Studi Kasus</th>
                                                            <td>: &nbsp;UPTD Pengelolaan Pertanian Desa Tanah Baru, Kecamatan</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"></th>
                                                            <td> &nbsp;&nbsp;&nbsp;&nbsp;Pakisjaya, Kabupaten Karawang 41355</td>
                                                        </tr>
                                                    </tbody>

                                                </table>
                                                <hr>
                                                <h5 class="card-title">Dosen Pembimbing</h5>
                                                <table class="table" style="border: 1px solid white;">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" style="width: 150px;">NIDN</th>
                                                            <td>: &nbsp;</td>
                                                            <th scope="row" style="width: 150px;">NIDN</th>
                                                            <td>: &nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Nama Lengkap</th>
                                                            <td>: &nbsp;Wawan Kusdiawan., M.Kom</td>
                                                            <th scope="row">Nama Lengkap</th>
                                                            <td>: &nbsp;Tiawan., M.Kom</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Pembimbing</th>
                                                            <td>: &nbsp;I</td>
                                                            <th scope="row">Pembimbing</th>
                                                            <td>: &nbsp;II</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                <hr>
                                                <h5 class="card-title">Ketua Program Studi Informatika</h5>
                                                <table class="table" style="border: 1px solid white;">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" style="width: 150px;">NIDN</th>
                                                            <td>: &nbsp;0428046904</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Nama Lengkap</th>
                                                            <td>: &nbsp;Wahyudi., S.Kom., M.M</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </ul>
                                        </div>
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
    }
