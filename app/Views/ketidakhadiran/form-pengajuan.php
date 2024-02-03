<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <form action="<?= base_url('pengajuan-ketidakhadiran/store') ?>" method="post" enctype="multipart/form-data">
            <div class="row row-deck row-cards align-items-stretch">
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="id_pegawai" value="<?= $user_profile->id_pegawai ?>">

                            <div class="mb-3">
                                <label for="tipe_ketidakhadiran" class="form-label">Tipe Ketidakhadiran</label>
                                <select name="tipe_ketidakhadiran" class="form-select <?= validation_show_error('tipe_ketidakhadiran') ? 'is-invalid' : '' ?>">
                                    <option value="">---Pilih Tipe Ketidakhadiran---</option>
                                    <option value="CUTI" <?= old('tipe_ketidakhadiran') === 'CUTI' ? 'selected' : '' ?>>CUTI</option>
                                    <option value="IZIN" <?= old('tipe_ketidakhadiran') === 'IZIN' ? 'selected' : '' ?>>IZIN</option>
                                    <option value="SAKIT" <?= old('tipe_ketidakhadiran') === 'SAKIT' ? 'selected' : '' ?>>SAKIT</option>
                                </select>
                                <?php if (validation_show_error('tipe_ketidakhadiran')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('tipe_ketidakhadiran') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control <?= validation_show_error('deskripsi') ? 'is-invalid' : '' ?>" name="deskripsi" rows="8" placeholder="Deskripsi Ketidakhadiran"><?= old('deskripsi') ?></textarea>
                                <?php if (validation_show_error('deskripsi')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('deskripsi') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input class="form-control <?= validation_show_error('tanggal_mulai') ? 'is-invalid' : '' ?>" type="date" name="tanggal_mulai" id="tanggal_mulai" value="<?= old('tanggal_mulai') ?>">
                                <?php if (validation_show_error('tanggal_mulai')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('tanggal_mulai') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                                <input class="form-control <?= validation_show_error('tanggal_berakhir') ? 'is-invalid' : '' ?>" type="date" name="tanggal_berakhir" id="tanggal_berakhir" value="<?= old('tanggal_berakhir') ?>">
                                <?php if (validation_show_error('tanggal_berakhir')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('tanggal_berakhir') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="form-label">Surat Keterangan (PDF)</div>
                                <input type="file" class="form-control <?= validation_show_error('file') ? 'is-invalid' : '' ?>" name="file" />
                                <?php if (validation_show_error('file')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('file') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="<?= base_url('ketidakhadiran') ?>" class="btn btn-link">Batal</a>
                                <button type="submit" class="btn btn-primary ms-auto">Buat Pengajuan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>