<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards align-items-start">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(<?= base_url('/assets/img/user_profile/' . $data_pegawai->foto) ?>)"></span>
                        <h3 class="m-0 mb-1"><a href="#"><?= $data_pegawai->nama ?></a></h3>
                        <div class="text-muted"><?= $data_pegawai->jabatan ?></div>
                        <div class="mt-3">
                            <span class="badge <?php
                                                if ($data_pegawai->role === 'admin') {
                                                    echo 'bg-green-lt';
                                                } else if ($data_pegawai->role === 'head') {
                                                    echo 'bg-purple-lt';
                                                } else {
                                                    echo 'bg-blue-lt';
                                                } ?>">
                                <?= $data_pegawai->role; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>NIP</th>
                                    <td><?= $data_pegawai->nip; ?></td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td><?= $data_pegawai->username; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $data_pegawai->email; ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><?= $data_pegawai->jenis_kelamin; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?= $data_pegawai->alamat; ?></td>
                                </tr>
                                <tr>
                                    <th>Nomor Handphone</th>
                                    <td><?= $data_pegawai->no_handphone; ?></td>
                                </tr>
                                <tr>
                                    <th>Lokasi Presensi</th>
                                    <td><?= $data_pegawai->lokasi_presensi; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <?php if ($data_pegawai->active == 0) : ?>
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
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="<?= base_url('data-pegawai/edit/' . $data_pegawai->username) ?>" class="btn btn-link text-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit me-2 text-warning" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                    <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                </svg>Edit Profil Pegawai
                            </a>
                            <a href="<?= base_url('data-pegawai') ?>" class="btn btn-link ms-auto">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>