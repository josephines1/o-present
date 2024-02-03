<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <?php if (!in_groups('head')) : ?>
                        <li class="nav-item <?= $title === 'Home' ? 'active' : '' ?>">
                            <a class="nav-link <?= $title === 'Home' ? 'active' : '' ?>" href="<?= base_url() ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Home
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_groups('admin') || in_groups('head')) : ?>
                        <li class="nav-item dropdown <?= ($title === 'Dashboard' || $title === 'Data Pegawai' || $title === 'Data Jabatan' || $title === 'Data Lokasi Presensi' || $title === 'Laporan Presensi Harian' || $title === 'Laporan Presensi Bulanan') ? 'active' : '' ?>">
                            <a class="nav-link dropdown-toggle" href="<?= base_url('/admin') ?>" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                                        <path d="M6.201 18.744a4 4 0 0 1 3.799 -2.744h4a4 4 0 0 1 3.798 2.741" />
                                        <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Admin
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item <?= $title === 'Dashboard' ? 'active' : '' ?>" href="<?= base_url('/admin') ?>">
                                            Dashboard
                                        </a>
                                        <div class="dropend">
                                            <a class="dropdown-item dropdown-toggle <?= $title === 'Data Jabatan' || $title === 'Data Lokasi Presensi' || $title === 'Data Pegawai' ? 'active' : '' ?>" href="<?= base_url('/data-pegawai') ?>" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                                Master Data
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="<?= base_url('/data-pegawai') ?>" class="dropdown-item">
                                                    Data Pegawai
                                                </a>
                                                <a href="<?= base_url('/jabatan') ?>" class="dropdown-item">
                                                    Data Jabatan
                                                </a>
                                                <a href="<?= base_url('/lokasi-presensi') ?>" class="dropdown-item">
                                                    Data Lokasi Presensi
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropend">
                                            <a class="dropdown-item dropdown-toggle <?= $title === 'Laporan Presensi Harian' || $title === 'Laporan Presensi Bulanan' ? 'active' : '' ?>" href="<?= base_url('/laporan-presensi-harian') ?>" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                                Laporan Presensi
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="<?= base_url('/laporan-presensi-harian') ?>" class="dropdown-item">
                                                    Laporan Presensi Harian
                                                </a>
                                                <a href="<?= base_url('/laporan-presensi-bulanan') ?>" class="dropdown-item">
                                                    Laporan Presensi Bulanan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </li>
                    <?php endif; ?>
                    <?php if (!in_groups('head')) : ?>
                        <li class="nav-item <?= $title === 'Rekap Presensi' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= base_url('rekap-presensi') ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                        <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 12l.01 0" />
                                        <path d="M13 12l2 0" />
                                        <path d="M9 16l.01 0" />
                                        <path d="M13 16l2 0" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Rekap Presensi
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item <?= $title === 'Ketidakhadiran' ? 'active' : '' ?>">
                        <?php if (!in_groups('head')) : ?>
                            <a class="nav-link" href="<?= base_url('/ketidakhadiran') ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                        <path d="M22 22l-5 -5" />
                                        <path d="M17 22l5 -5" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Ketidakhadiran
                                </span>
                            </a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item <?= $title === 'Kelola Ketidakhadiran' ? 'active' : '' ?>">
                        <?php if (in_groups('head')) : ?>
                            <a class="nav-link" href="<?= base_url('/kelola-ketidakhadiran') ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                        <path d="M22 22l-5 -5" />
                                        <path d="M17 22l5 -5" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Ketidakhadiran
                                </span>
                            </a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>" data-bs-toggle="modal" data-bs-target="#logout-modal">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M9 12h12l-3 -3" />
                                    <path d="M18 15l3 -3" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Logout
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>