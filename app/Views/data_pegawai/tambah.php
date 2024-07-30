<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<style>
    .icon-tabler-info-circle {
        transition: transform 0.3s ease-in-out;
        cursor: pointer;
    }

    .icon-tabler-info-circle:hover {
        transform: translateY(-3px);
    }
</style>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <form action="<?= base_url('/data-pegawai/store') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="nip_baru" value="<?= $nip_baru ?>">
            <div class="row row-deck row-cards align-items-stretch">
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 w-100">
                                <label class="form-label">Nama</label>
                                <input name="nama" type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" placeholder="e.g. Putri Cantika" value="<?= old('nama') ?>">
                                <?php if (validation_show_error('nama')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('nama') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" type="text" class="form-select <?= validation_show_error('jenis_kelamin') ? 'is-invalid' : '' ?>" id="select-users">
                                    <option value="">---Pilih Jenis Kelamin---</option>
                                    <option value="Perempuan" <?= old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    <option value="Laki-laki" <?= old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                </select>
                                <?php if (validation_show_error('jenis_kelamin')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('jenis_kelamin') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Alamat</label>
                                <input name="alamat" type="text" class="form-control <?= validation_show_error('alamat') ? 'is-invalid' : '' ?>" placeholder="e.g. Jalan Daun Hijau Nomor 2" value="<?= old('alamat') ?>">
                                <?php if (validation_show_error('alamat')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('alamat') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Nomor Handphone</label>
                                <input name="no_handphone" type="text" class="form-control <?= validation_show_error('no_handphone') ? 'is-invalid' : '' ?>" placeholder="e.g. 087890901010" value="<?= old('no_handphone') ?>">
                                <?php if (validation_show_error('no_handphone')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('no_handphone') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Jabatan</label>
                                <select name="jabatan" type="text" class="form-select <?= validation_show_error('jabatan') ? 'is-invalid' : '' ?>" id="select-users">
                                    <option value="">---Pilih Jabatan---</option>
                                    <?php if (!empty($jabatan)) : ?>
                                        <?php foreach ($jabatan as $option) : ?>
                                            <option value="<?= $option->id ?>" <?= old('jabatan') === $option->id ? 'selected' : '' ?>><?= $option->jabatan ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Tidak ada pilihan jabatan</option>
                                    <?php endif; ?>
                                </select>
                                <?php if (validation_show_error('jabatan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('jabatan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 w-100">
                                <label class="form-label">Lokasi Presensi</label>
                                <select name="lokasi_presensi" type="text" class="form-select <?= validation_show_error('lokasi_presensi') ? 'is-invalid' : '' ?>">
                                    <option value="">---Pilih Lokasi Presensi---</option>
                                    <?php if (!empty($lokasi)) : ?>
                                        <?php foreach ($lokasi as $lokasi_option) : ?>
                                            <option value="<?= $lokasi_option['id'] ?>" <?= old('lokasi_presensi') === $lokasi_option['id'] ? 'selected' : '' ?>><?= $lokasi_option['nama_lokasi'] ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Tidak ada pilihan lokasi presensi</option>
                                    <?php endif; ?>
                                </select>
                                <?php if (validation_show_error('lokasi_presensi')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('lokasi_presensi') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Alamat Email Pegawai</label>
                                <input name="email" type="text" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" placeholder="e.g. putricantika@gmail.com" value="<?= old('email') ?>">
                                <?php if (validation_show_error('email')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Username</label>
                                <input name="username" type="text" class="form-control <?= validation_show_error('username') ? 'is-invalid' : '' ?>" placeholder="e.g. putricantika" value="<?= old('username') ?>">
                                <?php if (validation_show_error('username')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('username') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Role Akun</label>
                                <select name="role" type="text" class="form-select <?= validation_show_error('role') ? 'is-invalid' : '' ?>">
                                    <option value="">---Pilih Role---</option>
                                    <?php if (!empty($role)) : ?>
                                        <?php foreach ($role as $role_option) : ?>
                                            <option value="<?= $role_option['id'] ?>" <?= old('role') === $role_option['id'] ? 'selected' : '' ?>><?= $role_option['name'] ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Tidak ada pilihan role</option>
                                    <?php endif; ?>
                                </select>
                                <?php if (validation_show_error('role')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('role') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label d-flex align-items-center">
                                    Aktivasi
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle ms-2" data-bs-toggle="modal" data-bs-target="#caraAktivasiModal">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                        <path d="M12 9h.01" />
                                        <path d="M11 12h1v4h1" />
                                    </svg>
                                </label>
                                <select name="aktivasi" id="aktivasi" type="text" class="form-select <?= validation_show_error('aktivasi') ? 'is-invalid' : '' ?>">
                                    <option value="1" <?= old('aktivasi') === "1" ? 'selected' : '' ?>>Aktivasi Nanti</option>
                                    <option value="2" <?= old('aktivasi') === "2" ? 'selected' : '' ?>>Aktivasi Instan</option>
                                    <option value="3" <?= old('aktivasi') === "3" ? 'selected' : '' ?>>Aktivasi Melalui Email</option>
                                </select>
                                <?php if (validation_show_error('aktivasi')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('aktivasi') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="<?= base_url('data-pegawai') ?>" class="btn btn-link">Batal</a>
                                <button type="submit" class="btn btn-primary ms-auto">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Cara Aktivasi Modal -->
<div class="modal" id="caraAktivasiModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cara Aktivasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p style="font-size: larger;" class="mb-1 text-primary"><strong>Aktivasi Nanti</strong></p>
                <p class="lh-lg mb-4">Aktivasi akun dapat dilakukan di kemudian hari. Admin mengirimkan email aktivasi saat akun siap untuk diaktifkan.</p>
                <p style="font-size: larger;" class="mb-1 text-primary"><strong>Aktivasi Instan</strong></p>
                <p class="lh-lg mb-4">Akun akan segera diaktifkan tanpa perlu konfirmasi email.</p>
                <p style="font-size: larger;" class="mb-1 text-primary"><strong>Aktivasi Melalui Email</strong></p>
                <p class="lh-lg mb-4">Email aktivasi akan langsung dikirimkan ke alamat email yang diberikan setelah Akun berhasil dibuat.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn ms-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>