<?php phpinfo(); ?>
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
                    <a href="../../views/pages/Administrator.php" class="sidebar-link <?php if ($activePage == "Administrator") {
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
                    <span class="hide-menu">MENU UTAMA</span>
                </li>
                <li class="sidebar-item">
                    <a href="../../views/kriteria/data_kriteria.php" class="sidebar-link <?php if ($activePage == "kriteria") {
                                                                                                echo "active";
                                                                                            } ?>">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Kriteria</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../views/subkriteria/data_subkriteria.php" class="sidebar-link <?php if ($activePage == "subkriteria") {
                                                                                                    echo "active";
                                                                                                } ?>">
                        <span>
                            <i class="ti ti-subtask"></i>
                        </span>
                        <span class="hide-menu">Sub Kriteria</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../views/alternatif/data_alternatif.php" class="sidebar-link <?php if ($activePage == "alternatif") {
                                                                                                    echo "active";
                                                                                                } ?>">
                        <span>
                            <i class="ti ti-vocabulary"></i>
                        </span>
                        <span class="hide-menu">Data Alternatif</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../views/bobot_alternatif/data_bobot.php" class="sidebar-link <?php if ($activePage == "bobot") {
                                                                                                    echo "active";
                                                                                                } ?>">
                        <span>
                            <i class="ti ti-pencil"></i>
                        </span>
                        <span class="hide-menu">Penilaian</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Proses</span>
                </li>
                <li class="sidebar-item">
                    <a href="../../views/proses/prosesMetodeTOPSIS.php" class="sidebar-link <?php if ($activePage == "bobot_alternatif") {
                                                                                                echo "active";
                                                                                            } ?>" id="btn-KonfirmProses">
                        <span>
                            <i class="ti ti-refresh-alert"></i>
                        </span>
                        <span class="hide-menu">Perhitungan TOPSIS</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../../views/proses/HasilKeputusan.php" class="sidebar-link <?php if ($activePage == "hasil_keputusan") {
                                                                                            echo "active";
                                                                                        } ?>">
                        <span>
                            <i class="ti ti-report-analytics"></i>
                        </span>
                        <span class="hide-menu">Hasil</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Administrator</span>
                </li>
                <li class="sidebar-item">
                    <a href="../../views/pengguna/data_pengguna.php" class="sidebar-link <?php if ($activePage == "user_login") {
                                                                                                echo "active";
                                                                                            } ?>">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Data Pengguna</span>
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