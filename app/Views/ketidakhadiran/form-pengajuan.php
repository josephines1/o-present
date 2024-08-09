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
        <form action="<?= base_url('pengajuan-ketidakhadiran/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row row-deck row-cards align-items-stretch">
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="id_pegawai" value="<?= $user_profile->id_pegawai ?>">

                            <div class="mb-3">
                                <label for="tipe_ketidakhadiran" class="form-label d-flex align-items-center">
                                    Tipe Ketidakhadiran
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle ms-2" data-bs-toggle="modal" data-bs-target="#tipeKetidakhadiranModal">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                        <path d="M12 9h.01" />
                                        <path d="M11 12h1v4h1" />
                                    </svg>
                                </label>
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

<!-- Tipe Ketidakhadiran Modal -->
<div class="modal" id="tipeKetidakhadiranModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tipe Ketidakhadiran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p style="font-size: larger;" class="mb-1 text-primary"><strong>Cuti</strong></p>
                <ul>
                    <li class="lh-lg"><strong>Pengajuan</strong>: Dapat diajukan beberapa hari sebelumnya sesuai kebijakan perusahaan.</li>
                    <li class="lh-lg"><strong>Status Approval</strong>: Memerlukan persetujuan dari atasan. Tidak ada persetujuan otomatis.</li>
                </ul>
                <p style="font-size: larger;" class="mb-1 text-primary"><strong>Izin</strong></p>
                <ul>
                    <li class="lh-lg"><strong>Pengajuan</strong>: Dapat diajukan pada hari yang sama atau untuk hari mendatang, tetapi tidak dapat untuk tanggal kemarin atau sebelumnya.</li>
                    <li class="lh-lg"><strong>Status Approval</strong>: Memerlukan persetujuan dari atasan. Tidak ada persetujuan otomatis.</li>
                </ul>
                <p style="font-size: larger;" class="mb-1 text-primary"><strong>Sakit</strong></p>
                <ul>
                    <li class="lh-lg"><strong>Pengajuan</strong>: Hanya dapat diajukan pada hari ini atau hari esok. Tidak bisa untuk tanggal lebih dari hari esok.</li>
                    <li class="lh-lg"><strong>Status Approval</strong>: Otomatis disetujui tanpa perlu persetujuan dari atasan.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn ms-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>