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