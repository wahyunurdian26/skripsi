<?php error_reporting(0) ?>
<?php $halaman = "dropdown3"; ?>
<?php $page = "Varietas Padi"; ?>
<?php include "resource.php" ?>
<?php $koneksi = mysqli_connect("localhost", "root", "", "db_tanahbaru"); ?>
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><a href="index.php"><i class="fas fa-home"></i></a> / Varietas Padi</h2>
            </div>
        </div>
    </section><!-- End Breadcrumbs Section -->

    <section id="departments" class="departments">
        <div class="container">
            <h3>Varietas Padi</h3><br>
            <div class="row">
                <div class="col-xl-12 col-lg-12 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-0 px-lg-2">
                    <div class="alert alert-info" role="alert" style="background: #d9edf7;color: #31708f; border-color: #bce8f1; font-size:14px">
                        <strong>Informasi Varietas Padi</strong><br>
                        Menyajikan Informasi data padi yang bersumber dari Balai Penyuluhan Pertanian (BPP) dan epdeskel. Pengumpulan dan Pengelolaan data dan informasi berada di Direktorat Jenderal Bina Pemerintahan Desa. Fitur integrasi dan validasi data oleh Pemerintah, Pemerintah Provinsi, Pemerintah Kabupaten/Kota dan Desa sesuai ketentuan yang berlaku.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">Rekomendasi Bibit Padi Terbaik 2024</h5>
                                </div>
                                <form class="row g-1">
                                    <div class="col-auto">
                                        <a href="views/hasil/cetak_hasil_keputusan.php" target="_blank">
                                            <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Cetak</button>
                                        </a>
                                    </div>

                                </form>
                            </div>
                            <!-- Data -->
                            <!-- Table Data Pengguna -->
                            <div class="table-responsive mt-2">
                                <!--Table Responsive-->
                                <table class="table table-hover table-bordered text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>

                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Kode Varietas</h6>
                                            </th>

                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Nama Varietas</h6>
                                            </th>

                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Nilai Preferensi(Vi)</h6>
                                            </th>

                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Ranking</h6>
                                            </th>

                                            <!-- <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th> -->

                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Opsi</h6>
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
                                            $data = mysqli_query($koneksi, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif order by hasil.hasil DESC ");
                                        } else {
                                            $data = mysqli_query($koneksi, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif");
                                        }

                                        $countdata = mysqli_num_rows($data);
                                        $jumlah_data = mysqli_num_rows($data);
                                        $total_halaman = ceil($jumlah_data / $batas);
                                        $data_alternatif = mysqli_query($koneksi, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif order by hasil.hasil DESC limit $halaman_awal, $batas");
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
                                                    <h6 class="fw-semibold mb-0" style="text-align: center;"><?= number_format($row['hasil'], 3); ?></h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0" style="text-align: center;"><?= $nomor++ ?></h6>
                                                </td>
                                                <!--  -->
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="details-varietas-padi.php?key=<?= $row['id_alternatif'] ?>" id="btn-Hapus">
                                                        <i class="fa fa-eye fa-lg">
                                                        </i>
                                                    </a>
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

                <!-- Grafik -->
                <div class="col-lg-4 ">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">Grafik Varietas Padi</h5>
                                </div>
                            </div>
                            <canvas id="myChart"></canvas>
                            <?php
                            $data_alternatif = mysqli_query($koneksi, "SELECT * FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif ORDER BY hasil.hasil DESC LIMIT 3");
                            $nama_alternatif = array();
                            $hasil = array();

                            while ($row = mysqli_fetch_array($data_alternatif)) {
                                $nama_alternatif[] = $row['nama_alternatif'];
                                $hasil[] = number_format($row['hasil'], 3);
                            }
                            ?>
                            <script>
                                var ctx = document.getElementById('myChart').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: <?php echo json_encode($nama_alternatif); ?>,
                                        datasets: [{
                                            label: 'Nilai Preferensi (Vi)',
                                            data: <?php echo json_encode($hasil); ?>,
                                            backgroundColor: [
                                                <?php
                                                for ($i = 0; $i < count($hasil); $i++) {
                                                    if ($i < 3) {
                                                        echo "'rgba(54, 162, 235, 0.2)',"; // biru
                                                    } elseif ($i < 9) {
                                                        echo "'rgba(255, 159, 64, 0.2)',"; // orange
                                                    } else {
                                                        echo "'rgba(201, 203, 207, 0.2)',"; // abu-abu
                                                    }
                                                }
                                                ?>
                                            ],
                                            borderColor: [
                                                <?php
                                                for ($i = 0; $i < count($hasil); $i++) {
                                                    if ($i < 3) {
                                                        echo "'rgba(54, 162, 235, 1)',"; // biru
                                                    } elseif ($i < 9) {
                                                        echo "'rgba(255, 159, 64, 1)',"; // orange
                                                    } else {
                                                        echo "'rgba(201, 203, 207, 1)',"; // abu-abu
                                                    }
                                                }
                                                ?>
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'bottom'
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(tooltipItem) {
                                                        return 'Nilai: ' + tooltipItem.raw;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <!-- End Grafik -->
            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php include "footer.php" ?>