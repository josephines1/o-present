<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards align-items-start">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <form action="<?= base_url('/jabatan/update') ?>" method="post">
                        <?= csrf_field() ?>

                        <input type="hidden" name="id" value="<?= $jabatan['id'] ?>">
                        <input type="hidden" name="slug" value="<?= $jabatan['slug'] ?>">
                        <div class="card-body">
                            <label class="form-label">Nama Jabatan</label>
                            <div class="mb-3">
                                <input type="text" name="jabatan" class="form-control <?= validation_show_error('jabatan') ? 'is-invalid' : '' ?>" placeholder="e.g. Staff Finance" autocomplete="off" value="<?= old('jabatan', $jabatan['jabatan']) ?>">
                                <?php if (validation_show_error('jabatan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('jabatan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="<?= base_url('jabatan') ?>" class="btn btn-link">Batal</a>
                                <button class="btn btn-warning ms-auto" type="submit">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>