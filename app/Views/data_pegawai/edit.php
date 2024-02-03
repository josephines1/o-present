<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards align-items-start g-3">
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body text-center border-bottom">
                        <img src="<?= base_url('./assets/img/user_profile/' . $data_pegawai->foto) ?>" alt="<?= $data_pegawai->nama ?>" class="img-thumbnail" width="150" height="150" class="object-fit-cover">
                    </div>
                    <div class="d-flex">
                        <form class="w-100" action="<?= base_url('/hapus-foto/' . $data_pegawai->username) ?>" method="post">
                            <input type="hidden" name="foto_db" value="<?= $data_pegawai->foto ?>">
                            <button class="card-btn bg-transparent w-100 border-0" name="hapus-foto" type="submit" autocomplete="off">Hapus Foto</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <form action="<?= base_url('/data-pegawai/update') ?>" method="post" class="w-100">
                    <?= csrf_field() ?>
                    <input type="hidden" name="username_db" value="<?= $data_pegawai->username ?>">
                    <input type="hidden" name="id" value="<?= $data_pegawai->id ?>">
                    <input type="hidden" name="nip" value="<?= $data_pegawai->nip ?>">
                    <input type="hidden" name="id_pegawai" value="<?= $data_pegawai->id_pegawai ?>">
                    <input type="hidden" name="id_user" value="<?= $data_pegawai->id_user ?>">
                    <input type="hidden" name="role_db" value="<?= $data_pegawai->role_id ?>">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="mb-3 w-100">
                                <label class="form-label">Nama</label>
                                <input name="nama" type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" placeholder="e.g. Putri Cantika" value="<?= old('nama', $data_pegawai->nama) ?>">
                                <?php if (validation_show_error('nama')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('nama') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Jabatan</label>
                                <select name="jabatan" type="text" class="form-select <?= validation_show_error('jabatan') ? 'is-invalid' : '' ?>" id="select-users">
                                    <option value="">---Pilih Jabatan---</option>
                                    <?php if (!empty($jabatan)) : ?>
                                        <?php foreach ($jabatan as $option) : ?>
                                            <option value="<?= $option->id ?>" <?= old('jabatan', $data_pegawai->id_jabatan) === $option->id ? 'selected' : '' ?>><?= $option->jabatan ?></option>
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
                            <div class="mb-3 w-100">
                                <label class="form-label">Username</label>
                                <input name="username" type="text" class="form-control <?= validation_show_error('username') ? 'is-invalid' : '' ?>" placeholder="e.g. putricantika" value="<?= old('username', $data_pegawai->username) ?>">
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
                                            <option value="<?= $role_option['id'] ?>" <?= old('role', $data_pegawai->role_id) === $role_option['id'] ? 'selected' : '' ?>><?= $role_option['name'] ?></option>
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
                                <label class="form-label">Alamat Email Pegawai</label>
                                <input name="email" type="text" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" placeholder="e.g. putricantika@gmail.com" value="<?= old('email', $data_pegawai->email) ?>">
                                <?php if (validation_show_error('email')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" type="text" class="form-select <?= validation_show_error('jenis_kelamin') ? 'is-invalid' : '' ?>" id="select-users">
                                    <option value="">---Pilih Jenis Kelamin---</option>
                                    <option value="Perempuan" <?= old('jenis_kelamin', $data_pegawai->jenis_kelamin) === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    <option value="Laki-laki" <?= old('jenis_kelamin', $data_pegawai->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                </select>
                                <?php if (validation_show_error('jenis_kelamin')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('jenis_kelamin') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Alamat</label>
                                <input name="alamat" type="text" class="form-control <?= validation_show_error('alamat') ? 'is-invalid' : '' ?>" placeholder="e.g. Jalan Daun Hijau Nomor 2" value="<?= old('alamat', $data_pegawai->alamat) ?>">
                                <?php if (validation_show_error('alamat')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('alamat') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Nomor Handphone</label>
                                <input name="no_handphone" type="text" class="form-control <?= validation_show_error('no_handphone') ? 'is-invalid' : '' ?>" placeholder="e.g. 087890901010" value="<?= old('no_handphone', $data_pegawai->no_handphone) ?>">
                                <?php if (validation_show_error('no_handphone')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('no_handphone') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Lokasi Presensi</label>
                                <select name="lokasi_presensi" type="text" class="form-select <?= validation_show_error('lokasi_presensi') ? 'is-invalid' : '' ?>">
                                    <option value="">---Pilih Lokasi Presensi---</option>
                                    <?php if (!empty($lokasi)) : ?>
                                        <?php foreach ($lokasi as $lokasi_option) : ?>
                                            <option value="<?= $lokasi_option['id'] ?>" <?= old('lokasi_presensi', $data_pegawai->id_lokasi_presensi) === $lokasi_option['id'] ? 'selected' : '' ?>><?= $lokasi_option['nama_lokasi'] ?></option>
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
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="<?= base_url('data-pegawai') ?>" class="btn btn-link">Batal</a>
                                <button type="submit" class="btn btn-primary ms-auto">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>