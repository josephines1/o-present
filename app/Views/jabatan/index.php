<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 justify-content-between">
                    <div class="col-lg-6 col-md-12">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                            </span>
                            <input type="text" value="<?= $keyword ?>" id="keyword" class="form-control" placeholder="Temukan Jabatan..." autofocus>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <form action="<?= base_url('/jabatan/store') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row g-1">
                                <div class="col">
                                    <input type="text" id="tambah-jabatan" name="jabatan" class="form-control <?= validation_show_error('jabatan') ? 'is-invalid' : '' ?>" placeholder="Tambah Jabatan Baru" autocomplete="off" value="<?= old('jabatan') ?>">
                                    <?php if (validation_show_error('jabatan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= validation_show_error('jabatan') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" type="submit">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-deck row-cards align-items-start">
            <div class="col-lg-12">
                <div class="card" id="data-jabatan">
                    <div class="card-body">
                        <h3 class="card-title">Data Jabatan</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr class="text-center">
                                    <th style="min-width: 50px; width: 60px;">No</th>
                                    <th>Nama Jabatan</th>
                                    <th style="min-width: 150px; width: 150px;">Total Pegawai</th>
                                    <th style="min-width: 150px; width: 200px;">Aksi</th>
                                </tr>
                                <?php if (!empty($data_jabatan)) : ?>
                                    <?php $nomor = 1 + ($perPage * ($currentPage - 1)); ?>
                                    <?php foreach ($data_jabatan as $jabatan) : ?>
                                        <tr>
                                            <td class="text-center"><?= $nomor++ ?></td>
                                            <td><?= $jabatan->jabatan; ?></td>
                                            <td class="text-center"><?= $jabatan->total_pegawai; ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('jabatan/' . $jabatan->slug) ?>" class="badge bg-warning">
                                                    Edit
                                                </a>
                                                <a href="#" class="badge bg-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#modal-danger" data-id="<?= $jabatan->id ?>" data-name="<?= $jabatan->jabatan ?>">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr class="text-center">
                                        <td colspan="4">Belum ada data</td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="m-0 text-muted">Showing <span><?= ($perPage * ($currentPage - 1)) + 1 ?></span> to <span><?= min($perPage * $currentPage, $total) ?></span> of <span><?= $total ?></span> entries</p>
                        <?= $pager; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Box - Delete -->
<div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
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
                <h3>Hapus?</h3>
                <div class="text-muted">Apakah Anda yakin ingin menghapus jabatan <strong><span id="modal-name" class="text-danger">ini</span></strong>? Jabatan yang sudah dihapus tidak dapat dikembalikan.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Batal
                            </a></div>
                        <div class="col">
                            <form action="" method="post" class="d-inline" id="form-hapus">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger w-100">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#keyword').on('keyup', function() {
            $.get('cari-jabatan?keyword=' + $('#keyword').val(), function(data) {
                $('#data-jabatan').html(data);
            })
        })

        $('body').on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            var nama = $(this).data('name');
            var id = $(this).data('id');
            $('#modal-name').html(nama);
            $('#modal-danger').modal('show');
            // Setelah tombol hapus diklik, Anda dapat menetapkan action form hapus ke URL yang benar
            $('#form-hapus').attr('action', '/jabatan/' + id);
        });
    })
</script>
<?= $this->endSection() ?>