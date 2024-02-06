<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row g-3">
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body text-center border-bottom">
                        <img src="<?= base_url('./assets/img/user_profile/' . $user_profile->foto) ?>" alt="<?= $user_profile->nama ?>" class="img-thumbnail" id="img-preview" width="150" height="150" class="object-fit-cover">
                    </div>
                    <div class="d-flex">
                        <form class="w-100" action="<?= base_url('/profile/hapus-foto') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="foto_db" value="<?= $user_profile->foto ?>">
                            <button class="card-btn w-100 border-0 bg-transparent" name="hapus-foto" type="submit" autocomplete="off">Hapus Foto</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $user_profile->id_pegawai ?>">
                        <input type="hidden" name="foto_lama" value="<?= $user_profile->foto ?>">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="foto" class="form-label">Upload Foto Profile Baru</label>
                                <input onchange="inputImgPreview()" type="file" class="form-control <?= validation_show_error('foto') ? 'is-invalid' : '' ?>" name="foto" id="input-foto-profile-baru">
                                <?php if (validation_show_error('foto')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('foto') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= old('nama', $user_profile->nama) ?>">
                                <?php if (validation_show_error('nama')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('nama') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control <?= validation_show_error('username') ? 'is-invalid' : '' ?>" name="username" id="username" value="<?= old('username', $user_profile->username) ?>">
                                <?php if (validation_show_error('username')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('username') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" type="text" class="form-select <?= validation_show_error('jenis_kelamin') ? 'is-invalid' : '' ?>" id="select-users">
                                    <option value="">---Pilih Jenis Kelamin---</option>
                                    <option value="Perempuan" <?= old('jenis_kelamin', $user_profile->jenis_kelamin) === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    <option value="Laki-laki" <?= old('jenis_kelamin', $user_profile->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                </select>
                                <?php if (validation_show_error('jenis_kelamin')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('jenis_kelamin') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Alamat</label>
                                <input name="alamat" type="text" class="form-control <?= validation_show_error('alamat') ? 'is-invalid' : '' ?>" placeholder="e.g. Jalan Daun Hijau Nomor 2" value="<?= old('alamat', $user_profile->alamat) ?>">
                                <?php if (validation_show_error('alamat')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('alamat') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3 w-100">
                                <label class="form-label">Nomor Handphone</label>
                                <input name="no_handphone" type="text" class="form-control <?= validation_show_error('no_handphone') ? 'is-invalid' : '' ?>" placeholder="e.g. 087890901010" value="<?= old('no_handphone', $user_profile->no_handphone) ?>">
                                <?php if (validation_show_error('no_handphone')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('no_handphone') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="<?= base_url('profile') ?>" class="btn btn-link">Batal</a>
                                <button type="submit" class="btn btn-primary ms-auto">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="logout-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Anda yakin ingin Logout?</div>
                <div>Silahkan kembali lagi kapanpun yang Anda inginkan.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                <a href="<?= base_url('logout') ?>" class="btn btn-danger">Ya, logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    function inputImgPreview() {
        const inputFotoProfileBaru = document.getElementById('input-foto-profile-baru');
        const imgPreview = document.getElementById('img-preview');

        const $fileFoto = new FileReader();
        $fileFoto.readAsDataURL(inputFotoProfileBaru.files[0]);
        $fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection() ?>