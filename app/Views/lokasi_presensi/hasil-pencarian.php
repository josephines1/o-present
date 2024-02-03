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
                                <a href="#" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#modal-danger-<?= $l->id ?>">
                                    hapus
                                </a>
                            </td>
                        </tr>

                        <!-- Modal Box - Delete -->
                        <div class="modal modal-blur fade" id="modal-danger-<?= $l->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <div class="text-muted">Apakah Anda yakin ingin menghapus lokasi <strong class="text-danger"><?= $l->nama_lokasi ?></strong>? Data lokasi yang sudah dihapus tidak dapat dikembalikan.</div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="w-100">
                                            <div class="row">
                                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                                        Batal
                                                    </a></div>
                                                <div class="col">
                                                    <form action="/lokasi-presensi/<?= $l->id ?>" method="post" class="d-inline">
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
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr class="text-center">
                        <td colspan="6">Tidak ada data yang ditemukan.</td>
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