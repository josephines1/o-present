<div class="card" id="data-pegawai">
    <div class="card-body">
        <h3 class="card-title">Data Pegawai</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Jabatan</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th style="min-width: 150px;">Aksi</th>
                </tr>
                <?php if (!empty($data_pegawai)) : ?>
                    <?php $nomor = 1 + ($perPage * ($currentPage - 1)); ?>
                    <?php foreach ($data_pegawai as $pegawai) : ?>
                        <tr>
                            <td class="text-center"><?= $nomor++ ?></td>
                            <td><?= $pegawai->nip ?></td>
                            <td><a href="<?= base_url('/data-pegawai/' . $pegawai->username) ?>" class="d-flex align-items-start g-3 flex-wrap" style="gap: 1px;">
                                    <?= $pegawai->nama ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height:12px;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M17 7l-10 10" />
                                        <path d="M8 7l9 0l0 9" />
                                    </svg>
                                </a>
                            </td>
                            <td><?= $pegawai->username ?></td>
                            <td><?= $pegawai->jabatan ?></td>
                            <td><span class="badge 
                                            <?php
                                            if ($pegawai->role === 'admin') {
                                                echo 'bg-green-lt';
                                            } else if ($pegawai->role === 'head') {
                                                echo 'bg-purple-lt';
                                            } else {
                                                echo 'bg-blue-lt';
                                            } ?>">
                                    <?= $pegawai->role; ?></span></td>
                            <td>
                                <?php if ($pegawai->active == 0) : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M10 10l4 4m0 -4l-4 4" />
                                    </svg>
                                    <span class="text-danger">Belum Aktivasi <a href="<?= base_url('resend-activate-account?login=' . $pegawai->email) ?>" class="d-block">(Kirim email aktivasi)</a></span>
                                <?php else : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M9 12l2 2l4 -4" />
                                    </svg>
                                    <span class="text-success">Sudah Aktivasi</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('/data-pegawai/edit/' . $pegawai->username) ?>" class="badge bg-warning">
                                    edit
                                </a>
                                <a href="#" class="badge bg-danger btn-hapus" data-id="<?= $pegawai->id ?>" data-name="<?= $pegawai->nama ?>" data-bs-toggle="modal" data-bs-target="#modal-danger">
                                    hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr class="text-center">
                        <td colspan="8">Belum ada data</td>
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