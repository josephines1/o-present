<div class="card" id="data-ketidakhadiran">
    <div class="card-body">
        <h3 class="card-title">Ketidakhadiran Bulan: <strong><?= date('F Y', strtotime($data_bulan)) ?></strong></h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>No</th>
                    <th>Tipe</th>
                    <th style="min-width: 150px; max-width: 180px;">Tanggal Mulai</th>
                    <th style="min-width: 150px; max-width: 180px;">Tanggal Berakhir</th>
                    <th style="min-width: 200px; max-width: 300px;">Deskripsi</th>
                    <th>Surat Ijin</th>
                    <th>Status Pengajuan</th>
                    <th style="min-width: 130px; max-width: 150px;">Aksi</th>
                </tr>
                <?php if (!empty($data_ketidakhadiran)) : ?>
                    <?php $nomor = 1 + ($perPage * ($currentPage - 1)); ?>
                    <?php foreach ($data_ketidakhadiran as $data) : ?>
                        <tr>
                            <td class="text-center"><?= $nomor++ ?></td>
                            <td class="text-center"><span class="badge <?php if ($data->tipe_ketidakhadiran === 'IZIN') {
                                                                            echo 'bg-azure-lt';
                                                                        } else if ($data->tipe_ketidakhadiran === 'SAKIT') {
                                                                            echo 'bg-purple-lt';
                                                                        } else {
                                                                            echo 'bg-orange-lt';
                                                                        } ?>"><?= $data->tipe_ketidakhadiran ?>
                                </span>
                            </td>
                            <td class="text-center"><?= date('d F Y', strtotime($data->tanggal_mulai)) ?></td>
                            <td class="text-center"><?= date('d F Y', strtotime($data->tanggal_berakhir)) ?></td>
                            <td><?= $data->deskripsi ?></td>
                            <td class="text-center"><a href="<?= base_url('assets/file/surat_keterangan_ketidakhadiran/' . $data->file) ?>" target="_blank">Download</a></td>
                            <td class="text-center"><span class="badge <?php if ($data->status_pengajuan === 'PENDING') {
                                                                            echo 'badge-outline text-yellow';
                                                                        } else if ($data->status_pengajuan === 'REJECTED') {
                                                                            echo 'badge-outline text-red';
                                                                        } else {
                                                                            echo 'badge badge-outline text-green';
                                                                        } ?>"><?= $data->status_pengajuan ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if ($data->status_pengajuan === 'PENDING') : ?>
                                    <a href="<?= base_url('ketidakhadiran/edit/' . $data->id) ?>" class="badge bg-warning">Edit</a>
                                    <a href="#" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#modal-danger-<?= $data->id ?>">
                                        Hapus
                                    </a>
                                <?php else : ?>
                                    <p>Tidak bisa ubah data.</p>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <!-- Modal Box - Delete -->
                        <div class="modal modal-blur fade" id="modal-danger-<?= $data->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <div class="text-muted">Apakah Anda yakin ingin menghapus pengajuan ketidakhadiran pada tanggal <strong class="text-danger"><?= date('d F Y', strtotime($data->tanggal_mulai)) . ' - ' . date('d F Y', strtotime($data->tanggal_berakhir)) ?></strong>? Pengajuan yang sudah dihapus tidak dapat dikembalikan.</div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="w-100">
                                            <div class="row">
                                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                                        Batal
                                                    </a></div>
                                                <div class="col">
                                                    <form action="/ketidakhadiran/<?= $data->id ?>" method="post" class="d-inline">
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
                        <td colspan="8">Tidak ada data yang ditemukan.</td>
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