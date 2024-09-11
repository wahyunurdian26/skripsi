<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Desa Tanah Baru | Website Desa Tana Baru</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/krw.png" rel="icon">
  <link href="assets/img/krw.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
  <?php $page = "home"; ?>
  <?php include "header.php" ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero sticked-header-offset">
    <div class="container position-relative">
      <div class="row gy-5 mt-4 aos-init aos-animate" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h1>Melayani Solusi Pertanian End-to-End Bagi Petani Desa</h1>
          <!-- <h2>Saluran informasi yang edukatif dan inspiratif seputar dunia pertanian desa tanahbaru pakisjaya</h2> -->
          <div class="col-lg-2">
            <a href="#services" class="btn-get-started scrollto">Mulai</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="assets/img/Illustrasi.png" class="img-fluid aos-init aos-animate" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>
  </section>

  <main id="main">
    <!-- End Why Us Section -->

    <section id="services" class="services">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-user-md"></i></div>
              <h4><a href="">Layanan Masyarakat</a></h4>
              <p>Pelayanan desa adalah untuk meningkatkan kesejahteraan masyarakat, memfasilitasi pembangunan di tingkat desa, dan memenuhi kebutuhan dasar penduduk desa</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="far fa-hospital"></i></div>
              <h4><a class="<?php if ($page == "Potensi Desa") {
                              echo "active";
                            } ?> " href="prodeskel.php">Potensi Desa</a></h4>
              <p>Dimana potensi fisik desa adalah semua sumber daya alam yang terdapat di desa dan diharapkan dapat memberikan manfaat bagi keberlangsungan dan perkembangan desa</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-pills"></i></div>
              <h4><a href="varietas-padi.php">Varietas Padi</a></h4>
              <p>Varietas Padi adalah galur hasil pemuliaan yang mempunyai satu atau lebih keunggulan khusus seperti potensi hasil tinggi, tahan terhadap hama, tahan terhadap penyakit atau sifat-sifat lainnya</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="departments" class="departments">
      <div class="container">

        <div class="section-title">
          <h2>Tentang</h2>
        </div>

        <div class="row gy-4">
          <div class="col-lg-12">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row gy-4">
                  <div class="col-lg-4 text-center ">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                      </div>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="assets/img/bibit.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="assets/img/1.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="assets/img/2.jpeg" class="d-block w-100" alt="...">
                        </div>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                  </div>
                  <div class="col-lg-8 details">
                    <h3>Komoditas Padi</h3>
                    <p class="fst-italic">Padi merupakan kebutuhan manusia yang paling mendasar, sehingga ketersediaan pangan khususnya beras bagi masyarakat harus selalu terjamin. Dengan terpenuhinya kebutuhan pangan masyarakat maka, masyarakat akan memperoleh hidup yang tenang</p>
                    <p><b>Visi </b><br>
                      Penyuluhan pertanian profesional untuk mewujudkan sumber daya pertanian yang maju, mandiri dan modern</p>
                    <p><b>Misi </b><br>
                      1. Meningkatkan kualitas sumberdaya penyuluhan <br>
                      2. Meningkatkan kelembagaan petani yang madiri dan modern <br>
                      3. Meningkatkan produktivitas potensi unggulan bidang pertanian <br>
                      4. Mewujudkan kesehjateraan petani</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title">
          <h2>Gallery</h2>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row g-0">
          <div class="col-lg-4 col-md-6">
            <div class="gallery-item">
              <a href="assets/img/1.jpeg" class="galelry-lightbox">
                <img src="assets/img/1.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="gallery-item">
              <a href="assets/img/4.jpeg" class="galelry-lightbox">
                <img src="assets/img/4.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="gallery-item">
              <a href="assets/img/3.jpeg" class="galelry-lightbox">
                <img src="assets/img/3.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="row">
          <div class="section-title">
            <h2>Kontak</h2>
          </div>

          <div class="col-lg-8">
            <div>
              <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126970.45069563763!2d107.01591214809844!3d-6.0185311744149015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a2f11545410e3%3A0xc21a155bba81dc6!2sTanahbaru%2C%20Pakisjaya%2C%20Karawang%2C%20West%20Java%2C%20Indonesia!5e0!3m2!1sen!2ssg!4v1714117886430!5m2!1sen!2ssg" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Jl. Raya Pakisjaya, Desa Tanah Baru, Kabupaten Karawang,
                  Kode Pos 41355</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>aripkrn88@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-whatsapp"></i>
                <h4>WhatsApp:</h4>
                <p>+62 856-9773-0458</p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <?php include "footer.php" ?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>