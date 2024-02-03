<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card mb-3">
            <div class="card-body">
                <form action="" method="get">
                    <div class="row justify-content-between g-3 flex-column-reverse flex-lg-row">
                        <div class="col-lg-10 col-sm-12">
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
                                        <input type="text" class="form-control" placeholder="Cari data dari nama pegawai atau deskripsi" name="keyword" id="keyword" autocomplete="off" autofocus value="<?= $keyword ?>">
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
                                        <div class="dropdown-menu dropdown-menu-arrow" style="min-width: 300px;">
                                            <h3 class="dropdown-header">Filters</h3>
                                            <div class="m-3 mt-1">
                                                <label for="" class="form-label d-block">Bulan & Tahun</label>
                                                <div class="row g-1 justify-content-evenly w-100">
                                                    <div class="col-md-6">
                                                        <select name="bulan" id="bulan" class="form-select">
                                                            <option value="01" <?= ($filter_bulan == '01') ? 'selected' : '' ?>>Januari</option>
                                                            <option value="02" <?= ($filter_bulan == '02') ? 'selected' : '' ?>>Februari</option>
                                                            <option value="03" <?= ($filter_bulan == '03') ? 'selected' : '' ?>>Maret</option>
                                                            <option value="04" <?= ($filter_bulan == '04') ? 'selected' : '' ?>>April</option>
                                                            <option value="05" <?= ($filter_bulan == '05') ? 'selected' : '' ?>>Mei</option>
                                                            <option value="06" <?= ($filter_bulan == '06') ? 'selected' : '' ?>>Juni</option>
                                                            <option value="07" <?= ($filter_bulan == '07') ? 'selected' : '' ?>>Juli</option>
                                                            <option value="08" <?= ($filter_bulan == '08') ? 'selected' : '' ?>>Agustus</option>
                                                            <option value="09" <?= ($filter_bulan == '09') ? 'selected' : '' ?>>September</option>
                                                            <option value="10" <?= ($filter_bulan == '10') ? 'selected' : '' ?>>Oktober</option>
                                                            <option value="11" <?= ($filter_bulan == '11') ? 'selected' : '' ?>>November</option>
                                                            <option value="12" <?= ($filter_bulan == '12') ? 'selected' : '' ?>>Desember</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="tahun" class="form-select filter_tahun" id="tahun">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-3">
                                                <label for="" class="form-label d-block">Tipe</label>
                                                <div class="row g-1 justify-content-evenly w-100">
                                                    <div class="col-md-12">
                                                        <select name="tipe" id="tipe" class="form-select">
                                                            <option value="" <?= ($filter_tipe == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                                            <option value="IZIN" <?= ($filter_tipe == 'IZIN') ? 'selected' : '' ?>>IZIN</option>
                                                            <option value="SAKIT" <?= ($filter_tipe == 'SAKIT') ? 'selected' : '' ?>>SAKIT</option>
                                                            <option value="CUTI" <?= ($filter_tipe == 'CUTI') ? 'selected' : '' ?>>CUTI</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-3">
                                                <label for="" class="form-label d-block">Status Pengajuan</label>
                                                <div class="row g-1 justify-content-evenly w-100">
                                                    <div class="col-md-12">
                                                        <select name="status" id="status" class="form-select">
                                                            <option value="" <?= ($filter_status == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                                            <option value="PENDING" <?= ($filter_status == 'PENDING') ? 'selected' : '' ?>>PENDING</option>
                                                            <option value="APPROVED" <?= ($filter_status == 'APPROVED') ? 'selected' : '' ?>>APRROVED</option>
                                                            <option value="REJECTED" <?= ($filter_status == 'REJECTED') ? 'selected' : '' ?>>REJECTED</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-3 mt-5">
                                                <div class="d-flex">
                                                    <a href="<?= base_url('kelola-ketidakhadiran') ?>" class="btn btn-link">Hapus Filter</a>
                                                    <button type="submit" class="btn btn-primary ms-auto">Terapkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-12 text-start text-lg-end">
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

        <div class="row">
            <div class="col-12">
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
                                            <td class="text-center"><?= date('d F Y', strtotime($data->tanggal_mulai)) ?></td>
                                            <td class="text-center"><?= date('d F Y', strtotime($data->tanggal_berakhir)) ?></td>
                                            <td><?= $data->deskripsi ?></td>
                                            <td class="text-center"><a href="<?= base_url('assets/file/surat_keterangan_ketidakhadiran/' . $data->file) ?>" target="_blank">Download</a></td>
                                            <td class="text-center">
                                                <?php if ($data->tanggal_mulai <= date('Y-m-d')) : ?>
                                                    <span class="d-inline-flex align-items-center badge <?php if ($data->status_pengajuan === 'PENDING') {
                                                                                                            echo 'badge-outline text-yellow';
                                                                                                        } else if ($data->status_pengajuan === 'REJECTED') {
                                                                                                            echo 'badge-outline text-red';
                                                                                                        } else {
                                                                                                            echo 'badge badge-outline text-green';
                                                                                                        } ?>">
                                                        <?= $data->status_pengajuan ?>
                                                    </span>
                                                <?php else : ?>
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
                                                <?php endif; ?>
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
            </div>
        </div>
    </div>
</div>

<!-- Export Excel Modals -->
<div class="modal" id="exportModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Laporan Ketidakhadiran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('/kelola-ketidakhadiran/excel') ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="filter_bulan">Bulan</label>
                        <select name="bulan" class="form-select" id="filter_bulan">
                            <option value="01" <?= ($filter_bulan == '01') ? 'selected' : '' ?>>Januari</option>
                            <option value="02" <?= ($filter_bulan == '02') ? 'selected' : '' ?>>Februari</option>
                            <option value="03" <?= ($filter_bulan == '03') ? 'selected' : '' ?>>Maret</option>
                            <option value="04" <?= ($filter_bulan == '04') ? 'selected' : '' ?>>April</option>
                            <option value="05" <?= ($filter_bulan == '05') ? 'selected' : '' ?>>Mei</option>
                            <option value="06" <?= ($filter_bulan == '06') ? 'selected' : '' ?>>Juni</option>
                            <option value="07" <?= ($filter_bulan == '07') ? 'selected' : '' ?>>Juli</option>
                            <option value="08" <?= ($filter_bulan == '08') ? 'selected' : '' ?>>Agustus</option>
                            <option value="09" <?= ($filter_bulan == '09') ? 'selected' : '' ?>>September</option>
                            <option value="10" <?= ($filter_bulan == '10') ? 'selected' : '' ?>>Oktober</option>
                            <option value="11" <?= ($filter_bulan == '11') ? 'selected' : '' ?>>November</option>
                            <option value="12" <?= ($filter_bulan == '12') ? 'selected' : '' ?>>Desember</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="filter_tahun">Tahun</label>
                        <select name="tahun" class="form-select filter_tahun" id="filter_tahun">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label d-block">Tipe</label>
                        <div class="row g-1 justify-content-evenly w-100">
                            <div class="col-md-12">
                                <select name="tipe" id="tipe" class="form-select">
                                    <option value="" <?= ($filter_tipe == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                    <option value="IZIN" <?= ($filter_tipe == 'IZIN') ? 'selected' : '' ?>>IZIN</option>
                                    <option value="SAKIT" <?= ($filter_tipe == 'SAKIT') ? 'selected' : '' ?>>SAKIT</option>
                                    <option value="CUTI" <?= ($filter_tipe == 'CUTI') ? 'selected' : '' ?>>CUTI</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label d-block">Status Pengajuan</label>
                        <div class="row g-1 justify-content-evenly w-100">
                            <div class="col-md-12">
                                <select name="status" id="status" class="form-select">
                                    <option value="" <?= ($filter_status == '') ? 'selected' : '' ?>>Tampilkan Semua</option>
                                    <option value="PENDING" <?= ($filter_status == 'PENDING') ? 'selected' : '' ?>>PENDING</option>
                                    <option value="APPROVED" <?= ($filter_status == 'APPROVED') ? 'selected' : '' ?>>APRROVED</option>
                                    <option value="REJECTED" <?= ($filter_status == 'REJECTED') ? 'selected' : '' ?>>REJECTED</option>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen select
        var selectTahuns = document.getElementsByClassName('filter_tahun');

        for (var i = 0; i < selectTahuns.length; i++) {
            var selectTahun = selectTahuns[i];
            var tahunSekarang = new Date().getFullYear();
            for (var tahun = <?= $tahun_mulai ?>; tahun <= tahunSekarang; tahun++) {
                var option = document.createElement('option');
                option.value = tahun;
                option.text = tahun;
                if (tahun == <?= $filter_tahun ?>) {
                    option.selected = true;
                }
                selectTahun.add(option);
            }
        }
    });

    $(document).ready(function() {
        $('#keyword').on('keyup', function() {
            $.get('cari-data-ketidakhadiran?keyword=' + $('#keyword').val() + '&bulan=' + $('#bulan').val() + '&tahun=' + $('#tahun').val() + '&tipe=' + $('#tipe').val() + '&status=' + $('#status').val(), function(data) {
                $('#data-ketidakhadiran').html(data);
            })
        })
    })
</script>
<?= $this->endSection() ?>