<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<?php

// Zona Waktu
if ($user_lokasi_presensi->zona_waktu === 'WIB') {
    date_default_timezone_set('Asia/Jakarta');
} else if ($user_lokasi_presensi->zona_waktu === 'WITA') {
    date_default_timezone_set('Asia/Makassar');
} else if ($user_lokasi_presensi->zona_waktu === 'WIT') {
    date_default_timezone_set('Asia/Jayapura');
}

?>
<style>
    .parent_date {
        display: grid;
        grid-template-columns: repeat(5, auto);
        font-size: 20px;
        text-align: center;
        justify-content: center;
    }

    .parent_clock {
        display: grid;
        grid-template-columns: repeat(5, auto);
        font-size: 30px;
        font-weight: bold;
        text-align: center;
        justify-content: center;
    }
</style>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row align-items-stretch g-3">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="card text-center" style="height: 100%;">
                    <div class="card-header justify-content-center">
                        <h3 class="mb-0">Presensi Masuk</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($status_ketidakhadiran === 1) : ?>
                            <div class="text-warning text-xxl-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-exclamation-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="height: 96px; width: 96px;">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 9v4" />
                                    <path d="M12 16v.01" />
                                </svg>
                            </div>
                            <h4 class="my-3">
                                Pengajuan ketidakhadiran diterima. <span class="d-block">Anda tidak perlu melakukan Presensi Masuk</span>
                            </h4>
                        <?php elseif ($jumlah_presensi_masuk === 0) : ?>
                            <div class="parent_date">
                                <div id="tanggal_masuk"></div>
                                <div class="ms-2"></div>
                                <div id="bulan_masuk"></div>
                                <div class="ms-2"></div>
                                <div id="tahun_masuk"></div>
                            </div>
                            <div class="parent_clock mt-3">
                                <div id="jam_masuk"></div>
                                <div> : </div>
                                <div id="menit_masuk"></div>
                                <div> : </div>
                                <div id="detik_masuk"></div>
                            </div>
                            <form action="<?= base_url('/presensi-masuk') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="latitude_kantor" value="<?= $user_lokasi_presensi->latitude ?>">
                                <input type="hidden" name="longitude_kantor" value="<?= $user_lokasi_presensi->longitude ?>">
                                <input type="hidden" name="radius" value="<?= $user_lokasi_presensi->radius ?>">
                                <input type="hidden" name="zona_waktu" value="<?= $user_lokasi_presensi->zona_waktu ?>">
                                <input type="hidden" name="latitude_pegawai" id="latitude_pegawai">
                                <input type="hidden" name="longitude_pegawai" id="longitude_pegawai">
                                <input type="hidden" name="tanggal_masuk" value="<?= date('Y-m-d') ?>">
                                <input type="hidden" name="jam_masuk" value="<?= date('H:i:s') ?>">
                                <button type="submit" class="btn btn-primary mt-5">Masuk</button>
                            </form>
                        <?php else : ?>
                            <div class="text-success text-xxl-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="height: 96px; width: 96px;">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M9 12l2 2l4 -4" />
                                </svg>
                            </div>
                            <h4 class="my-3">
                                Anda telah melakukan <span class="d-block">Presensi Masuk</span>
                            </h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="height: 100%;">
                    <div class="card-header justify-content-center">
                        <h3 class="mb-0">Presensi Keluar</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($status_ketidakhadiran === 1) : ?>
                            <div class="text-warning text-xxl-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-exclamation-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="height: 96px; width: 96px;">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 9v4" />
                                    <path d="M12 16v.01" />
                                </svg>
                            </div>
                            <h4 class="my-3">
                                Pengajuan ketidakhadiran diterima. <span class="d-block">Anda tidak perlu melakukan Presensi Keluar</span>
                            </h4>
                        <?php elseif ((strtotime(date('H:i:s')) >= strtotime($jam_pulang)) && ($jumlah_presensi_masuk === 0)) : ?>
                            <div class="text-danger text-xxl-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="height: 96px; width: 96px;">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M10 10l4 4m0 -4l-4 4" />
                                </svg>
                            </div>
                            <h4 class="my-3">
                                Silahkan Melakukan <span class="text-primary">Presensi Masuk</span><span class="d-block">terlebih dahulu</span>
                            </h4>
                        <?php elseif (strtotime(date('H:i:s')) < strtotime($jam_pulang)) : ?>
                            <div class="text-danger text-xxl-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="height: 96px; width: 96px;">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M10 10l4 4m0 -4l-4 4" />
                                </svg>
                            </div>
                            <h4 class="my-3">
                                Belum waktunya melakukan <span class="d-block">Presensi Keluar</span>
                            </h4>
                        <?php elseif ($data_presensi_masuk->tanggal_masuk !== '0000-00-00' && $data_presensi_masuk->tanggal_keluar !== '0000-00-00') : ?>
                            <div class="text-success text-xxl-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="height: 96px; width: 96px;">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M9 12l2 2l4 -4" />
                                </svg>
                            </div>
                            <h4 class="my-3">
                                Anda telah melakukan <span class="d-block">Presensi Keluar</span>
                            </h4>
                        <?php else : ?>
                            <div class="parent_date">
                                <div id="tanggal_keluar"></div>
                                <div class="ms-2"></div>
                                <div id="bulan_keluar"></div>
                                <div class="ms-2"></div>
                                <div id="tahun_keluar"></div>
                            </div>
                            <div class="parent_clock mt-3">
                                <div id="jam_keluar"></div>
                                <div> : </div>
                                <div id="menit_keluar"></div>
                                <div> : </div>
                                <div id="detik_keluar"></div>
                            </div>
                            <form action="<?= base_url('/presensi-keluar') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="latitude_kantor" value="<?= $user_lokasi_presensi->latitude ?>">
                                <input type="hidden" name="longitude_kantor" value="<?= $user_lokasi_presensi->longitude ?>">
                                <input type="hidden" name="radius" value="<?= $user_lokasi_presensi->radius ?>">
                                <input type="hidden" name="zona_waktu" value="<?= $user_lokasi_presensi->zona_waktu ?>">
                                <input type="hidden" name="latitude_pegawai" id="latitude_pegawai">
                                <input type="hidden" name="longitude_pegawai" id="longitude_pegawai">
                                <input type="hidden" name="tanggal_keluar" value="<?= date('Y-m-d') ?>">
                                <input type="hidden" name="jam_keluar" value="<?= date('H:i:s') ?>">
                                <input type="hidden" name="id_presensi" value="<?= $data_presensi_masuk->id ?>">
                                <button class="btn btn-primary mt-5 bg-red" type="submit">Keluar</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>

<script>
    window.setTimeout('waktuMasuk()', 1000);
    window.setTimeout('waktuKeluar()', 1000);

    function waktuMasuk() {
        const waktu = new Date();

        setTimeout('waktuMasuk()', 1000);

        nama_bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        tanggal_masuk = document.getElementById('tanggal_masuk');
        bulan_masuk = document.getElementById('bulan_masuk');
        tahun_masuk = document.getElementById('tahun_masuk');
        jam_masuk = document.getElementById('jam_masuk');
        menit_masuk = document.getElementById('menit_masuk');
        detik_masuk = document.getElementById('detik_masuk');

        if (tanggal_masuk && bulan_masuk && tahun_masuk && jam_masuk && menit_masuk && detik_masuk) {
            tanggal_masuk.innerHTML = waktu.getDate();
            bulan_masuk.innerHTML = nama_bulan[waktu.getMonth()];
            tahun_masuk.innerHTML = waktu.getFullYear();
            jam_masuk.innerHTML = waktu.getHours();
            menit_masuk.innerHTML = waktu.getMinutes();
            detik_masuk.innerHTML = waktu.getSeconds();
        }
    }

    function waktuKeluar() {
        const waktu = new Date();

        setTimeout('waktuKeluar()', 1000);

        nama_bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        tanggal_keluar = document.getElementById('tanggal_keluar');
        bulan_keluar = document.getElementById('bulan_keluar');
        tahun_keluar = document.getElementById('tahun_keluar');
        jam_keluar = document.getElementById('jam_keluar');
        menit_keluar = document.getElementById('menit_keluar');
        detik_keluar = document.getElementById('detik_keluar');

        if (tanggal_keluar && bulan_keluar && tahun_keluar && jam_keluar && menit_keluar && detik_keluar) {
            tanggal_keluar.innerHTML = waktu.getDate();
            bulan_keluar.innerHTML = nama_bulan[waktu.getMonth()];
            tahun_keluar.innerHTML = waktu.getFullYear();
            jam_keluar.innerHTML = waktu.getHours();
            menit_keluar.innerHTML = waktu.getMinutes();
            detik_keluar.innerHTML = waktu.getSeconds();
        }
    }

    getLocation();

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition,
                function(error) {
                    alert("Error code: " + error.code + " :" + error.message);
                }, {
                    timeout: 30000,
                    maximumAge: 0,
                }
            );
        } else {
            alert('Browser Anda tidak mendukung');
        }
    }

    function showPosition(position) {
        $('#latitude_pegawai').val(position.coords.latitude);
        $('#longitude_pegawai').val(position.coords.longitude);
    }
</script>
<?= $this->endSection() ?>