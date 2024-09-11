<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i>aripkrn88@gmail.com
            <i class="bi bi-whatsapp"></i> +62 856-9773-0458
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            <a href="https://maps.app.goo.gl/1FLyHf4qGdvbj6vK7" target="_blank" class="twitter"><i class="bi bi-globe"></i> Kabupaten Karawang</a>

        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href=""><img src="assets/img/logodesa.png" alt=""></a></h1>
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto <?php if ($page == "home") {
                                                    echo "active";
                                                } ?> " href="index.php">Home</a>
                </li>

                <!-- dropdown1 -->
                <li class="dropdown"><a class="<?php if ($halaman == "dropdown1") {
                                                    echo "active";
                                                } ?> "><span>Profile Desa</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="<?php if ($page == "Tentang") {
                                            echo "active";
                                        } ?> " href="about.php">Tentang Kami</a></li>
                        <li><a class="<?php if ($page == "Visi-Misi") {
                                            echo "active";
                                        } ?> " href="visi-misi.php">Visi dan Misi</a></li>
                        <li><a class="<?php if ($page == "Sejarah") {
                                            echo "active";
                                        } ?> " href="sejarah.php">Sejarah Desa</a></li>
                    </ul>
                </li>

                <!-- dropdown2 -->
                <li class="dropdown"><a class="<?php if ($halaman == "dropdown2") {
                                                    echo "active";
                                                } ?> "><span>Pemerintahan</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="<?php if ($page == "Struktur Organisasi") {
                                            echo "active";
                                        } ?> " href="struktur-organisasi.php">Struktur Organisasi</a></li>
                        <li><a class="<?php if ($page == "Perangkat Desa") {
                                            echo "active";
                                        } ?> " href="perangkat-desa.php">Perangkat Desa</a></li>
                        <li><a class="<?php if ($page == "Lembaga Desa") {
                                            echo "active";
                                        } ?> " href="lembaga-desa.php">Lembaga Desa</a></li>
                    </ul>
                </li>

                <!-- dropdown3 -->
                <li class="dropdown"><a class="<?php if ($halaman == "dropdown3") {
                                                    echo "active";
                                                } ?> "><span>Informasi Publik</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="<?php if ($page == "Berita Desa") {
                                            echo "active";
                                        } ?> " href="berita-desa.php">Berita Desa</a></li>
                        <li><a class="<?php if ($page == "Varietas Padi") {
                                            echo "active";
                                        } ?> " href="varietas-padi.php">Data Varietas Padi</a></li>
                    </ul>
                </li>


                <li><a class="nav-link scrollto <?php if ($page == "Potensi Desa") {
                                                    echo "active";
                                                } ?> " href="prodeskel.php">Potensi Desa</a>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="views/pages/login.php" class="appointment-btn scrollto"><span class="d-none d-md-inline"></span>Login</a>



    </div>
</header><!-- End Header -->