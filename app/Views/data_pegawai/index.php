<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="card-body">
                <form action="" method="get">
                    <div class="row justify-content-between g-3 flex-column-reverse flex-lg-row">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col">
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                <path d="M21 21l-6 -6" />
                                            </svg>
                                        </span>
                                        <input type="text" id="keyword" name="keyword" value="<?= $filter['keyword'] ?>" class="form-control" placeholder="Temukan pegawai berdasarkan nama atau username" autofocus>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span>
                                        <a href="#" class="btn <?= $isFiltered === true ? 'btn-cyan' : 'btn-outline-cyan' ?>" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" title="Filter Pencarian" data-bs-toggle="tooltip">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter-search m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M11.36 20.213l-2.36 .787v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414" />
                                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                <path d="M20.2 20.2l1.8 1.8" />
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-arrow" style="max-width: 350px;">
                                            <h3 class="dropdown-header">Filters</h3>
                                            <div class="m-3 mt-1">
                                                <div class="row g-1 justify-content-evenly w-100">
                                                    <div class="col-6">
                                                        <label for="jabatan" class="form-label d-block">Jabatan</label>
                                                        <select name="jabatan" id="jabatan" class="form-select">
                                                            <option value="" <?= ($filter['jabatan'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                                            <?php foreach ($data_jabatan as $opsi) : ?>
                                                                <option value="<?= $opsi['jabatan'] ?>" <?= ($filter['jabatan'] == $opsi['jabatan']) ? 'selected' : '' ?>><?= $opsi['jabatan'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="role" class="form-label d-block">Role</label>
                                                        <select name="role" id="role" class="form-select">
                                                            <option value="" <?= ($filter['role'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                                            <?php foreach ($data_role as $opsi) : ?>
                                                                <option value="<?= $opsi['name'] ?>" <?= ($filter['role'] == $opsi['name']) ? 'selected' : '' ?>><?= $opsi['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-3">
                                                <div class="row g-1 justify-content-evenly">
                                                    <div class="col-6">
                                                        <label for="status" class="form-label d-block">Status</label>
                                                        <select name="status" id="status" class="form-select">
                                                            <option value="" <?= ($filter['status'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                                            <option value="1" <?= ($filter['status'] == "1") ? 'selected' : '' ?>>Sudah Aktivasi</option>
                                                            <option value="0" <?= ($filter['status'] == "0") ? 'selected' : '' ?>>Belum Aktivasi</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="jenis-kelamin" class="form-label d-block">Jenis Kelamin</label>
                                                        <select name="jenis-kelamin" id="jenis-kelamin" class="form-select">
                                                            <option value="" <?= ($filter['jenis-kelamin'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                                            <option value="Perempuan" <?= ($filter['jenis-kelamin'] == "Perempuan") ? 'selected' : '' ?>>Perempuan</option>
                                                            <option value="Laki-laki" <?= ($filter['jenis-kelamin'] == "Laki-laki") ? 'selected' : '' ?>>Laki-laki</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-3">
                                                <label for="lokasi-presensi" class="form-label d-block">Lokasi Presensi</label>
                                                <div class="row g-1 justify-content-evenly w-100">
                                                    <div class="col-md-12">
                                                        <select name="lokasi-presensi" id="lokasi-presensi" class="form-select">
                                                            <option value="" <?= ($filter['lokasi-presensi'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                                            <?php foreach ($data_lokasi as $opsi) : ?>
                                                                <option value="<?= $opsi['nama_lokasi'] ?>" <?= ($filter['lokasi-presensi'] == $opsi['nama_lokasi']) ? 'selected' : '' ?>><?= $opsi['nama_lokasi'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-3 mt-5">
                                                <div class="d-flex">
                                                    <a href="<?= base_url('data-pegawai') ?>" class="btn btn-link">Hapus Filter</a>
                                                    <button type="submit" class="btn btn-primary ms-auto">Terapkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 text-start text-lg-end">
                            <a href="<?= base_url('/tambah-data-pegawai') ?>" class="btn btn-primary d-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg><span>Tambah Pegawai</span>
                            </a>
                            <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#exportModal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    <path d="M8 11h8v7h-8z" />
                                    <path d="M8 15h8" />
                                    <path d="M11 11v7" />
                                </svg>
                                <span>Export Excel</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row row-deck row-cards align-items-start">
            <div class="col-lg-12">
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
                                                <a href="#" class="badge bg-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#modal-danger" data-id="<?= $pegawai->id ?>" data-name="<?= $pegawai->nama ?>">
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
                <div class="text-muted">Apakah Anda yakin ingin menghapus data pegawai <strong><span id="modal-name" class="text-danger">ini</span></strong>? Data pegawai yang sudah dihapus tidak dapat dikembalikan.</div>
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

<!-- Export Excel Modals -->
<div class="modal" id="exportModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('/data-pegawai/excel') ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row g-1 justify-content-evenly w-100">
                            <div class="col-6">
                                <label for="jabatan" class="form-label d-block">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-select">
                                    <option value="" <?= ($filter['jabatan'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                    <?php foreach ($data_jabatan as $opsi) : ?>
                                        <option value="<?= $opsi['jabatan'] ?>" <?= ($filter['jabatan'] == $opsi['jabatan']) ? 'selected' : '' ?>><?= $opsi['jabatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="role" class="form-label d-block">Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="" <?= ($filter['role'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                    <?php foreach ($data_role as $opsi) : ?>
                                        <option value="<?= $opsi['name'] ?>" <?= ($filter['role'] == $opsi['name']) ? 'selected' : '' ?>><?= $opsi['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row g-1 justify-content-evenly">
                            <div class="col-6">
                                <label for="status" class="form-label d-block">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="" <?= ($filter['status'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                    <option value="1" <?= ($filter['status'] == "1") ? 'selected' : '' ?>>Sudah Aktivasi</option>
                                    <option value="0" <?= ($filter['status'] == "0") ? 'selected' : '' ?>>Belum Aktivasi</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="jenis-kelamin" class="form-label d-block">Jenis Kelamin</label>
                                <select name="jenis-kelamin" id="jenis-kelamin" class="form-select">
                                    <option value="" <?= ($filter['jenis-kelamin'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                    <option value="Perempuan" <?= ($filter['jenis-kelamin'] == "Perempuan") ? 'selected' : '' ?>>Perempuan</option>
                                    <option value="Laki-laki" <?= ($filter['jenis-kelamin'] == "Laki-laki") ? 'selected' : '' ?>>Laki-laki</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi-presensi" class="form-label d-block">Lokasi Presensi</label>
                        <div class="row g-1 justify-content-evenly w-100">
                            <div class="col-md-12">
                                <select name="lokasi-presensi" id="lokasi-presensi" class="form-select">
                                    <option value="" <?= ($filter['lokasi-presensi'] == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                    <?php foreach ($data_lokasi as $opsi) : ?>
                                        <option value="<?= $opsi['nama_lokasi'] ?>" <?= ($filter['lokasi-presensi'] == $opsi['nama_lokasi']) ? 'selected' : '' ?>><?= $opsi['nama_lokasi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#keyword').on('keyup', function() {
            $.get('cari-pegawai?keyword=' + $('#keyword').val() + '&jabatan=' + $('#jabatan').val() + '&role=' + $('#role').val() + '&status=' + $('#status').val() + '&lokasi-presensi=' + $('#lokasi-presensi').val() + '&jenis-kelamin=' + $('#jenis-kelamin').val(), function(data) {
                $('#data-pegawai').html(data);
            })
        })

        $('body').on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            var nama = $(this).data('name');
            var id = $(this).data('id');
            $('#modal-name').html(nama);
            $('#modal-danger').modal('show');
            // Setelah tombol hapus diklik, Anda dapat menetapkan action form hapus ke URL yang benar
            $('#form-hapus').attr('action', '/data-pegawai/' + id);
        });
    })
</script>
<?= $this->endSection() ?>