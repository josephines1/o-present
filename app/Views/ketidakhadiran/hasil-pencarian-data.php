<div class="card" id="data-ketidakhadiran">
    <div class="card-body">
        <h3 class="card-title">Ketidakhadiran Bulan <strong><?= date('F Y', strtotime($data_bulan)) ?></strong></h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Tipe</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                    <th width=170>Deskripsi</th>
                    <th>File</th>
                    <th>Status Pengajuan</th>
                </tr>
                <?php if (!empty($data_ketidakhadiran)) : ?>
                    <?php $nomor = 1 + ($perPage * ($currentPage - 1)); ?>
                    <?php foreach ($data_ketidakhadiran as $data) : ?>
                        <tr>
                            <td class="text-center"><?= $nomor++ ?></td>
                            <td><?= $data->nama ?></td>
                            <td class="text-center"><span class="badge <?php if ($data->tipe_ketidakhadiran === 'IZIN') {
                                                                            echo 'bg-azure-lt';
                                                                        } else if ($data->tipe_ketidakhadiran === 'SAKIT') {
                                                                            echo 'bg-purple-lt';
                                                                        } else {
                                                                            echo 'bg-orange-lt';
                                                                        } ?>"><?= $data->tipe_ketidakhadiran ?></span>
                            </td>
                            <td><?= date('d F Y', strtotime($data->tanggal_mulai)) ?></td>
                            <td><?= date('d F Y', strtotime($data->tanggal_berakhir)) ?></td>
                            <td><?= $data->deskripsi ?></td>
                            <td class="text-center"><a href="<?= base_url('assets/file/surat_keterangan_ketidakhadiran/' . $data->file) ?>" target="_blank">Download</a></td>
                            <td class="text-center">
                                <a href="<?= base_url('/kelola-ketidakhadiran/' . $data->id) ?>" class="d-inline-flex align-items-center badge <?php if ($data->status_pengajuan === 'PENDING') {
                                                                                                                                                    echo 'badge-outline text-yellow';
                                                                                                                                                } else if ($data->status_pengajuan === 'REJECTED') {
                                                                                                                                                    echo 'badge-outline text-red';
                                                                                                                                                } else {
                                                                                                                                                    echo 'badge badge-outline text-green';
                                                                                                                                                } ?>">
                                    <?= $data->status_pengajuan ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M17 7l-10 10" />
                                        <path d="M8 7l9 0l0 9" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr class="text-center">
                        <td colspan="8">Belum ada data pengajuan.</td>
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