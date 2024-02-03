<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<style>
    .parent_date {
        display: grid;
        grid-template-columns: repeat(8, auto);
        font-size: 20px;
        text-align: center;
        justify-content: center;
    }

    .parent_clock {
        display: grid;
        grid-template-columns: repeat(5, auto);
        font-size: 60px;
        font-weight: bold;
        text-align: center;
        justify-content: center;
    }
</style>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card text-blue p-3">
                    <div class="card-body">
                        <div class="parent_date">
                            <div id="hari"></div>
                            <div> , </div>
                            <div class="ms-1"></div>
                            <div id="tanggal"></div>
                            <div class="ms-1"></div>
                            <div id="bulan"></div>
                            <div class="ms-1"></div>
                            <div id="tahun"></div>
                        </div>
                        <div class="parent_clock">
                            <div id="jam"></div>
                            <div> : </div>
                            <div id="menit"></div>
                            <div> : </div>
                            <div id="detik"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?= $jumlah_pegawai_aktif ?> orang
                                        </div>
                                        <div class="text-muted">
                                            Pegawai Aktif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                                <path d="M15 19l2 2l4 -4" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?= $jumlah_pegawai_hadir ?> orang
                                        </div>
                                        <div class="text-muted">
                                            Pegawai Masuk
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-yellow text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.348 0 .686 .045 1.009 .128" />
                                                <path d="M16 19h6" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?= $jumlah_pegawai_izin ?> orang
                                        </div>
                                        <div class="text-muted">
                                            Pegawai Izin/Sakit
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                                <path d="M22 22l-5 -5" />
                                                <path d="M17 22l5 -5" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?= $jumlah_pegawai_alpha ?> orang
                                        </div>
                                        <div class="text-muted">
                                            Pegawai Alpha
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.setTimeout('waktuDashboard()', 1000);

    function waktuDashboard() {
        const waktu = new Date();

        setTimeout('waktuDashboard()', 1000);

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

        nama_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];

        hari = document.getElementById('hari');
        tanggal = document.getElementById('tanggal');
        bulan = document.getElementById('bulan');
        tahun = document.getElementById('tahun');
        jam = document.getElementById('jam');
        menit = document.getElementById('menit');
        detik = document.getElementById('detik');

        if (tanggal && bulan && tahun && jam && menit && detik) {
            hari.innerHTML = nama_hari[waktu.getDay()];
            tanggal.innerHTML = waktu.getDate();
            bulan.innerHTML = nama_bulan[waktu.getMonth()];
            tahun.innerHTML = waktu.getFullYear();
            jam.innerHTML = waktu.getHours();
            menit.innerHTML = waktu.getMinutes();
            detik.innerHTML = waktu.getSeconds();
        }
    }
</script>
<?= $this->endSection() ?>