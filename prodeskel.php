<?php $page = "Potensi Desa"; ?>
<?php include "resource.php" ?>
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><a href="index.php"><i class="fas fa-home"></i></a> / Potensi Desa</h2>
            </div>
        </div>
    </section><!-- End Breadcrumbs Section -->

    <section id="about" class="about" style="padding:20px 0px">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-0 px-lg-2">
                    <div class="alert alert-info" role="alert" style="background: #d9edf7;color: #31708f; border-color: #bce8f1; font-size:14px">
                        <strong>Informasi Potensi Desa</strong><br>
                        Menyajikan Informasi data desa yang bersumber dari prodeskel dan epdeskel. Pengumpulan dan Pengelolaan data dan informasi berada di Direktorat Jenderal Bina Pemerintahan Desa. Fitur integrasi dan validasi data oleh Pemerintah, Pemerintah Provinsi, Pemerintah Kabupaten/Kota dan Desa sesuai ketentuan yang berlaku.
                    </div>

                    <form>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-1 col-form-label">Tahun</label>
                            <div class="col-sm-2">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>2024</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" style="font-weight: bold;">Potensi Desa</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false" style="font-weight: bold;">Potensi Wilayah</button>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0" style="border-bottom: 1px solid #dee2e6;border-left: 1px solid #dee2e6;border-right: 1px solid #dee2e6;">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-lg-4">
                                    <div class="card text-center mt-4 mb-4" style="border-color: #337ab7;">
                                        <div class="card-header" style="background-color: #337ab7; color:#fff; border-bottom:none">
                                            <h5 class="card-title" style="font-size:16px;color: inherit;margin-top: 0;margin-bottom: 0;">Jumlah Penduduk</h5>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">7.437 Jiwa</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card text-center mt-4 mb-4" style="border-color: #bce8f1;">
                                        <div class="card-header" style="background-color: #d9edf7; color:#31708f; border-bottom:none">
                                            <h5 class="card-title" style="font-size:16px;color: inherit;margin-top: 0;margin-bottom: 0;">Laki-Laki</h5>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">3.550 Jiwa</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card text-center mt-4 mb-4" style="border-color: #ebccd1;">
                                        <div class="card-header" style="background-color: #f2dede; color:#a94442; border-bottom:none">
                                            <h5 class="card-title" style="font-size:16px;color: inherit;margin-top: 0;margin-bottom: 0;">Perempuan</h5>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">3.882 Jiwa</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>

                                <div class="col-lg-2"></div>
                                <div class="col-lg-8">
                                    <canvas id="myChart"></canvas>
                                </div>
                                <div class="col-lg-2"></div>

                                <script>
                                    var ctx = document.getElementById("myChart").getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ["Jumlah Penduduk", "Laki-Laki", "Perempuan"],
                                            datasets: [{
                                                label: 'Jumlah Penduduk',
                                                data: [7427, 3550, 3882],
                                                backgroundColor: [
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(255, 99, 132, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(255,99,132,1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                </script>
                                <div class="container valign">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-sm-5 mb-3 mb-sm-0">
                                            <div class="card text-center mt-4 mb-4" style="border-color: #bce8f1;">
                                                <div class="card-header" style="background-color: #dff0d8; color:#3c763d; border-bottom:none">
                                                    <h5 class="card-title" style="font-size:16px;color: inherit;margin-top: 0;margin-bottom: 0;">Jumlah Kepala Keluarga</h5>
                                                </div>
                                                <div class="card-body">
                                                    <h3 class="card-title">-</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="card text-center mt-4 mb-4" style="border-color: #ebccd1;">
                                                <div class="card-header" style="background-color: #dff0d8; color:#3c763d; border-bottom:none">
                                                    <h5 class="card-title" style="font-size:16px;color: inherit;margin-top: 0;margin-bottom: 0;">Kepadatan Penduduk</h5>
                                                </div>
                                                <div class="card-body">
                                                    <h3 class="card-title">-</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0" style="border-bottom: 1px solid #dee2e6;border-left: 1px solid #dee2e6;border-right: 1px solid #dee2e6;">
                            <div class="container valign">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                        <div class="card mt-4 mb-4" style="border-color: #337ab7;">
                                            <div class="card-header" style="background-color: #337ab7; color:#fff; border-bottom:none">
                                                <h5 class="card-title" style="font-size:16px;color: inherit;margin-top: 0;margin-bottom: 0;">Wilayah Desa Tanahbaru</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Dusun Bugis Selatan</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 01-05</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Dusun Bugis Utara</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 06-10</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Dusun Melayu</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 11-13</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Dusun Kamal</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 14-15</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="card mt-4 mb-4" style="border-color: #337ab7;">
                                            <div class="card-header" style="background-color: #337ab7; color:#fff; border-bottom:none">
                                                <h5 class="card-title" style="font-size:16px;color: inherit;margin-top: 0;margin-bottom: 0;">Pulau Nama-nama Gang di Desa Tanah Baru</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang Nurul Yaqin </b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 01</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang Darussalam</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 02</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang Nurul Hayat</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 03</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang Al-Maghfiroh</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 04</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang H. Aman </b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 05</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang Riyadul Jannah</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 06</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang Kober</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 07</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang H. Tahid</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 09</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang Soleh</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 11</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang Ust. Abdilah</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 12</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary"><b>Gang At-Taqwa</b></h6>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="card-subtitle mb-2 text-body-secondary">RT 13</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
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