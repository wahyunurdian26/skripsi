<!--  Header Start -->
<?php
error_reporting(0);
$session = $_SESSION['id_user'];
$cek = mysqli_query($this->koneksi->link, "SELECT *FROM pengguna INNER JOIN user_login on pengguna.id_pengguna = user_login.id_pengguna WHERE id_user = '$session'");
$row = mysqli_fetch_array($cek);
if ($row['role'] == 'ROL001') {
    $akses = 'Administrator';
} elseif ($row['role'] == 'ROL002') {
    $akses = 'Pakar';
}

?>
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link nav-icon" href="">
                    <b>SELAMAT DATANG DI BALAI PENYULUHAN PERTANIAN (BPP)</b>
                </a>
            </li> -->
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block ps-2" style="font-size: 14px; color: rgba(0, 0, 0, .5); font-weight: bold;"><?= $akses ?></span>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">

                            <a href="../../views/pengguna/setting.php?key=<?= $row['username'] ?>" class="d-flex align-items-center gap-2 dropdown-item mt-2 mb-0">
                                <i class="ti ti-settings fs-6"></i>
                                <p class="mb-0 fs-3">Pengaturan Akun</p>
                            </a>

                            <a href="../../views/include/logout.php" id="btn-Logout" class="btn btn-outline-primary mx-3 mt-2 d-block"><i class="ti ti-power fs-6"></i> &nbsp;Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>