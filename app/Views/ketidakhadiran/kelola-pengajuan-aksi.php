<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <form action="<?= base_url('kelola-ketidakhadiran/store') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $data_ketidakhadiran->id ?>">
            <div class="row row-deck row-cards align-items-stretch">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nama Pegawai</th>
                                        <td><?= $data_ketidakhadiran->nama ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tipe Ketidakhadiran</th>
                                        <td><?= $data_ketidakhadiran->tipe_ketidakhadiran ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Mulai</th>
                                        <td><?= date('d F Y', strtotime($data_ketidakhadiran->tanggal_mulai)) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Berakhir</th>
                                        <td><?= date('d F Y', strtotime($data_ketidakhadiran->tanggal_berakhir)) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="status_pengajuan" class="form-label">Status Pengajuan</label>
                                <select name="status_pengajuan" class="form-select <?= validation_show_error('status_pengajuan') ? 'is-invalid' : '' ?>">
                                    <option value="">---Pilih Status Pengajuan---</option>
                                    <option value="PENDING" <?= old('status_pengajuan', $data_ketidakhadiran->status_pengajuan) === 'PENDING' ? 'selected' : '' ?>>PENDING</option>
                                    <option value="APPROVED" <?= old('status_pengajuan', $data_ketidakhadiran->status_pengajuan) === 'APPROVED' ? 'selected' : '' ?>>APPROVED</option>
                                    <option value="REJECTED" <?= old('status_pengajuan', $data_ketidakhadiran->status_pengajuan) === 'REJECTED' ? 'selected' : '' ?>>REJECTED</option>
                                </select>
                                <?php if (validation_show_error('status_pengajuan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('status_pengajuan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="<?= base_url('/kelola-ketidakhadiran') ?>" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary ms-auto">Update Status Pengajuan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>