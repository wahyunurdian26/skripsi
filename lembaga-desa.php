<?php $halaman = "dropdown2"; ?>
<?php $page = "Lembaga Desa"; ?>
<?php include "resource.php" ?>
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><a href="index.php"><i class="fas fa-home"></i></a> / Lembaga Desa</h2>
            </div>
        </div>
    </section><!-- End Breadcrumbs Section -->

    <section id="departments" class="departments">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-10 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-0 px-lg-2">
                    <h3>Lembaga Desa</h3><br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nama Lembaga</th>
                                <th scope="col">Alamat Kantor</th>
                                <th scope="col">Logo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="font-weight: bold;">
                                <td style="color:#444444; font-size:14px"><a href="bpd.php">BADAN PERMUSYAWARATAN DESA </a><br>
                                    <span style="background-color: #0088cc; color:#fff;padding: .2em .6em .3em;border-radius: .25em;font-size: 75%;">BPD</span>
                                </td>
                                <td style="color:#444444; font-size:12px">Jl. Raya Pakisjaya, Desa Tanah Baru, Kabupaten Karawang</td>
                                <td><img src="https://kertamulya-padalarang.desa.id/themes/default/assets/images/no-photo.png" style="height:48px;"></td>
                            </tr>

                            <tr style="font-weight: bold;">
                                <td style="color:#444444; font-size:14px"><a href="bpp.php">Balai Penyuluhan Pertanian</a> <br>
                                    <span style="background-color: #0088cc; color:#fff;padding: .2em .6em .3em;border-radius: .25em;font-size: 75%;">BPP</span>
                                </td>
                                <td style="color:#444444; font-size:12px">Jl. Raya Pakisjaya, Desa Tanah Baru, Kabupaten Karawang</td>
                                <td><img src="assets/img/bpp.png" style="height:48px;"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php include "footer.php" ?>