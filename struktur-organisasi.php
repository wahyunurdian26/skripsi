<?php $halaman = "dropdown2"; ?>
<?php $page = "Struktur Organisasi"; ?>
<?php include "resource.php" ?>
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><a href="index.php"><i class="fas fa-home"></i></a> / Struktur Organisasi</h2>
            </div>
        </div>
    </section><!-- End Breadcrumbs Section -->

    <section id="departments" class="departments">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1" aria-selected="true" role="tab">Struktur Organisasi</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2" aria-selected="false" tabindex="-1" role="tab">Kepala Desa</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-1" role="tabpanel">
                            <div class="row gy-4">
                                <div class="col-lg-10 details order-2 order-lg-1">
                                    <h3>Struktur Organisasi</h3>
                                    <img src="assets/img/struktur_org_desa.png" alt="" class="img-fluid">
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="tab-2" role="tabpanel">
                            <div class="row gy-4">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                    <h3>Kepala Desa</h3>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 200px;">Jabatan</th>
                                                <td style="width: 30px;">:</td>
                                                <td>Kepala Desa</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nama Pejabat</th>
                                                <td>:</td>
                                                <td>Bapak M.ROSYADI</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">NIP</th>
                                                <td>:</td>
                                                <td>-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p class="fst-italic">Secara eksplisit Pasal 26 ayat (1) mengatur empat tugas utama Kepala Desa yaitu:</p>
                                    <ul>
                                        <li>
                                            Menyelenggarakan pemerintahan desa
                                        </li><br>
                                        <li>
                                            Melaksanakan pembangunan desa
                                        </li><br>
                                        <li>
                                            Melaksanakan pembinaan masyarakat desa
                                        </li><br>
                                        <li>
                                            Memberdayakan masyarakat desa
                                        </li>
                                    </ul>
                                    <p class="fst-italic">Dengan tugas yang diberikan, Kepala Desa diharapkan bisa membawa desa ke arah yang diharapkan oleh UU ini.</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/departments-2.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php include "footer.php" ?>