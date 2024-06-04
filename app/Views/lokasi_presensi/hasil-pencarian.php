<div class="card" id="data-lokasi">
    <div class="card-body">
        <h3 class="card-title">Data Lokasi Presensi</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>No</th>
                    <th style="min-width: 170px;">Nama Lokasi</th>
                    <th style="min-width: 300px;">Alamat Lokasi</th>
                    <th>Zona Waktu</th>
                    <th>Tipe Lokasi</th>
                    <th style="min-width: 130px;">Aksi</th>
                </tr>
                <?php if (!empty($lokasi)) : ?>
                    <?php $nomor = 1 + ($perPage * ($currentPage - 1)); ?>
                    <?php foreach ($lokasi as $l) : ?>
                        <tr>
                            <td class="text-center"><?= $nomor++ ?></td>
                            <td><a href="<?= base_url('/lokasi-presensi/' . $l->slug) ?>" class="d-flex align-items-start g-3" style="gap: 1px;">
                                    <?= $l->nama_lokasi ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height:12px;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M17 7l-10 10" />
                                        <path d="M8 7l9 0l0 9" />
                                    </svg>
                                </a>
                            </td>
                            <td><?= $l->alamat_lokasi ?></td>
                            <td class="text-center"><?= $l->zona_waktu ?></td>
                            <td class="text-center"><?= $l->tipe_lokasi ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('/lokasi-presensi/edit/' . $l->slug) ?>" class="badge bg-warning">
                                    edit
                                </a>
                                <a href="#" class="badge bg-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#modal-danger" data-id="<?= $l->id ?>" data-name="<?= $l->nama_lokasi ?>">
                                    hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr class="text-center">
                        <td colspan="6">Belum ada data</td>
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