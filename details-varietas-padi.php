<?php error_reporting(0) ?>
<?php $halaman = "dropdown3"; ?>
<?php $page = "Detail Varietas Padi"; ?>
<?php include "resource.php" ?>
<?php $koneksi = mysqli_connect("localhost", "root", "", "db_tanahbaru");
$key = $_GET['key'];
$query = mysqli_query($koneksi, "SELECT *FROM alternatif INNER JOIN hasil ON alternatif.id_alternatif = hasil.id_alternatif where alternatif.id_alternatif='$key' order by hasil.hasil DESC ");
$row = mysqli_fetch_array($query);
$data_hasil = $row['hasil'];

$normalisasi = $koneksi->query("select * from hasil ORDER BY hasil.hasil DESC LIMIT 4");
while ($data1 = $normalisasi->fetch_assoc()) {
    $jml1[] = $data1['hasil'];
    $max = max($jml1);
    $min = min($jml1);
}

$normalisasi1 = $koneksi->query("select * from hasil ORDER BY hasil.hasil DESC LIMIT 9");
while ($data2 = $normalisasi1->fetch_assoc()) {
    $jml2[] = $data2['hasil'];
    $min1 = min($jml2);
}

$query1 = mysqli_query($koneksi, "SELECT *FROM bobot_alternatif where id_alternatif = '$key'");
$row1 = mysqli_fetch_array($query1);

if ($row1['k01'] == '1') {
    $k01 = '70 – 90 hari';
} elseif ($row1['k01'] == '2') {
    $k01 = '90 – 100 hari';
} elseif ($row1['k01'] == '3') {
    $k01 = '115 – 117 hari';
}

if ($data_hasil > $min) {
    $k02 = '>9,0 ton/ha';
    $k03 = 'Tahan lebih dari 5 penyakit';
    $k06 = 'Tahan';
} elseif ($row['hasil'] >= $min1) {
    $k02 = '<7,0 ton/ha';
    $k03 = 'Tahan terhadap lebih dari 4 penyakit';
    $k06 = 'Sedang';
} elseif ($row['hasil'] <= $min1) {
    $k02 = '<5,0 ton/ha';
    $k03 = 'Tahan kurang dari 2 penyakit';
    $k06 = 'Mudah Rontok';
}


if ($row1['k04'] == '1') {
    $k04 = '<50 cm';
} elseif ($row1['k04'] == '2') {
    $k04 = '70-90 cm';
} elseif ($row1['k04'] == '3') {
    $k04 = '>90 cm';
}

if ($row1['k05'] == '1') {
    $k05 = 'Coklat';
} elseif ($row1['k05'] == '2') {
    $k05 = 'Kuning Muda';
} elseif ($row1['k05'] == '3') {
    $k05 = 'Kuning Tua';
}



?>
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><a href="index.php"><i class="fas fa-home"></i></a> / <a href="varietas-padi.php">Varietas Padi</a> / Detail Varietas Padi</h2>
            </div>
        </div>
    </section><!-- End Breadcrumbs Section -->

    <section id="departments" class="departments">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-0 px-lg-2">
                    <div class="alert alert-info" role="alert" style="background: #d9edf7;color: #31708f; border-color: #bce8f1; font-size:14px">
                        <strong>Informasi Detail Varietas Padi</strong><br>
                        Menyajikan Informasi data padi yang bersumber dari Balai Penyuluhan Pertanian (BPP) dan epdeskel. Pengumpulan dan Pengelolaan data dan informasi berada di Direktorat Jenderal Bina Pemerintahan Desa. Fitur integrasi dan validasi data oleh Pemerintah, Pemerintah Provinsi, Pemerintah Kabupaten/Kota dan Desa sesuai ketentuan yang berlaku.
                    </div>
                    <h3>Detail Varietas Padi</h3><br>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <img src="assets/img/1.jpeg" class="card-img-top" alt="...">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <blockquote>
                            <table class="table" style="border:1px solid white; border-bottom:1px solid #dee2e6">
                                <tbody>
                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px; width:200px">Kode
                                        </td>
                                        <td style="color:#444444; font-size:14px">: <?= $row['id_alternatif']; ?></td>
                                    </tr>

                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px">Nama Varietas Padi
                                        </td>
                                        <td style="color:#444444; font-size:14px">: <?= $row['nama_alternatif']; ?></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px;border-bottom:1px solid #444444">Nilai
                                        </td>
                                        <td style="color:#444444; font-size:14px;border-bottom:1px solid #444444">: <?= number_format($row['hasil'], 3); ?></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px; border-bottom:1px solid #444444">Kriteria
                                        </td>
                                        <td style="color:#444444; font-size:14px;border-bottom:1px solid #444444"></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px">Umur Tanaman
                                        </td>
                                        <td style="color:#444444; font-size:14px">: <?= $k01; ?></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px">Hasil Produksi
                                        </td>
                                        <td style="color:#444444; font-size:14px">: <?= $k02; ?></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px">Ketahanan Hama
                                        </td>
                                        <td style="color:#444444; font-size:14px">: <?= $k03; ?></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px">Tinggi Tanaman
                                        </td>
                                        <td style="color:#444444; font-size:14px">: <?= $k04; ?></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px">Warna Tanaman
                                        </td>
                                        <td style="color:#444444; font-size:14px">: <?= $k05; ?></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td style="color:#444444; font-size:14px">Kerontokan
                                        </td>
                                        <td style="color:#444444; font-size:14px">: <?= $k06; ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </blockquote>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination mt-2 mb-0">
                                <a href="varietas-padi.php" class="btn">Kembali <i class=" fas fa-share"></i></a>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>



        </div>
    </section>

</main><!-- End #main -->

<?php include "footer.php" ?>