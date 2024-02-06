<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(<?= base_url('/assets/img/user_profile/' . $user_profile->foto) ?>)"></span>
                        <h3 class="m-0 mb-1"><?= $user_profile->nama ?></h3>
                        <div class="text-muted"><?= $user_profile->jabatan ?></div>
                        <div class="mt-3">
                            <span class="badge <?php
                                                if ($user_profile->role === 'admin') {
                                                    echo 'bg-green-lt';
                                                } else if ($user_profile->role === 'head') {
                                                    echo 'bg-purple-lt';
                                                } else {
                                                    echo 'bg-blue-lt';
                                                } ?>">
                                <?= $user_profile->role; ?></span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="<?= base_url('/logout') ?>" class="card-btn text-danger" data-bs-toggle="modal" data-bs-target="#logout-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout me-2 text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M9 12h12l-3 -3" />
                                <path d="M18 15l3 -3" />
                            </svg>
                            Logout</a>
                        <a href="<?= base_url('/profile/edit') ?>" class="card-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                            </svg>
                            Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>NIP</th>
                                    <td><?= $user_profile->nip ?></td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td><?= $user_profile->username ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $user_profile->email ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><?= $user_profile->jenis_kelamin ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?= $user_profile->alamat ?></td>
                                </tr>
                                <tr>
                                    <th>Nomor Handphone</th>
                                    <td><?= $user_profile->no_handphone ?></td>
                                </tr>
                                <tr>
                                    <th>Lokasi Presensi</th>
                                    <td><?= $user_profile->lokasi_presensi ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php if ($user_profile->active == 0) : ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path d="M10 10l4 4m0 -4l-4 4" />
                                            </svg>
                                            <span class="text-danger">Belum Aktivasi <a href="<?= base_url('resend-activate-account?login=' . $data_pegawai->email) ?>" class="d-block">(Kirim email aktivasi)</a></span>
                                        <?php else : ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path d="M9 12l2 2l4 -4" />
                                            </svg>
                                            <span class="text-success">Sudah Aktivasi</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="card-title">Keamanan</div>
                    </div>
                    <div class="d-flex">
                        <a href="" class="card-btn text-warning" data-bs-toggle="modal" data-bs-target="#password-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-password-user me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 17v4" />
                                <path d="M10 20l4 -2" />
                                <path d="M10 18l4 2" />
                                <path d="M5 17v4" />
                                <path d="M3 20l4 -2" />
                                <path d="M3 18l4 2" />
                                <path d="M19 17v4" />
                                <path d="M17 20l4 -2" />
                                <path d="M17 18l4 2" />
                                <path d="M9 6a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                <path d="M7 14a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2" />
                            </svg>
                            Reset Password
                        </a>
                        <a href="" class="card-btn text-primary" data-bs-toggle="modal" data-bs-target="#email-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-cog me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5" />
                                <path d="M3 7l9 6l9 -6" />
                                <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M19.001 15.5v1.5" />
                                <path d="M19.001 21v1.5" />
                                <path d="M22.032 17.25l-1.299 .75" />
                                <path d="M17.27 20l-1.3 .75" />
                                <path d="M15.97 17.25l1.3 .75" />
                                <path d="M20.733 20l1.3 .75" />
                            </svg>
                            Ubah Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="logout-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Pekerjaan selesai! Apakah Anda yakin ingin logout?</div>
                <div>
                    <p class="mb-1">Pastikan kehadiran Anda tercatat. Jika ada yang perlu disesuaikan, beri tahu admin.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                <a href="<?= base_url('logout') ?>" class="btn btn-danger">Ya, logout</a>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="password-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                </svg>
                <h3>Yakin ingin mereset sandi Anda?</h3>
                <div class="text-muted">Lanjutkan untuk melindungi informasi pribadi Anda dengan sandi yang baru. <br><br>Kami akan mengirimkan token konfirmasi ke alamat email Anda untuk menyelesaikan proses reset password.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="<?= base_url('profile') ?>" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a>
                        </div>
                        <div class="col">
                            <form action="<?= base_url('/send-password-token') ?>" method="post" class="d-inline w-100">
                                <?= csrf_field() ?>
                                <input type="hidden" name="email" value="<?= $user_profile->email ?>">
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    Reset Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="email-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                </svg>
                <h3>Yakin ingin mengganti email Anda?</h3>
                <div class="text-muted">Lanjutkan untuk memperbarui email Anda dengan yang terbaru. <br><br>Kami akan mengirimkan token konfirmasi ke alamat email Anda untuk menyelesaikan proses perubahan alamat email.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="<?= base_url('profile') ?>" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </a>
                        </div>
                        <div class="col">
                            <form action="<?= base_url('/send-email-token') ?>" method="post" class="d-inline w-100">
                                <?= csrf_field() ?>
                                <input type="hidden" name="email" value="<?= $user_profile->email ?>">
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    Ubah Email
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>