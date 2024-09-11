<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="../../views/pages/Administrator.php" class="text-nowrap logo-img">
                <img src="../../assets/img/logodesa.png" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <li class="sidebar-item">
                    <a href="../../views/pages/Pakar.php" class="sidebar-link <?php if ($activePage == "Pakar") {
                                                                                    echo "active";
                                                                                } ?>">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MENU VALIDASI</span>
                </li>

                <li class="sidebar-item">
                    <a href="../../views/pakar/validasi_data_kriteria.php" class="sidebar-link <?php if ($activePage == "validasi_kriteria") {
                                                                                                    echo "active";
                                                                                                } ?>">
                        <span>
                            <i class="ti ti-vocabulary"></i>
                        </span>
                        <span class="hide-menu">Data Kriteria</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="../../views/pakar/validasi_data_alternatif.php" class="sidebar-link <?php if ($activePage == "validasi_alternatif") {
                                                                                                        echo "active";
                                                                                                    } ?>">
                        <span>
                            <i class="ti ti-vocabulary"></i>
                        </span>
                        <span class="hide-menu">Data Alternatif</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Proses</span>
                </li>

                <li class="sidebar-item">
                    <a href="../../views/proses/HasilKeputusan.php" class="sidebar-link <?php if ($activePage == "hasil_keputusan") {
                                                                                            echo "active";
                                                                                        } ?>">
                        <span>
                            <i class="ti ti-report-analytics"></i>
                        </span>
                        <span class="hide-menu">Hasil Keputusan</span>
                    </a>
                </li>

                <hr>

                <li class="sidebar-item">
                    <a href="../../views/pages/informasi.php" class="sidebar-link <?php if ($activePage == "informasi") {
                                                                                        echo "active";
                                                                                    } ?>">
                        <span>
                            <i class="fas fa-info"></i>
                        </span>
                        <span class="hide-menu">Informasi Program</span>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->