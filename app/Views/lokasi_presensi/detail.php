<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards align-items-start flex-md-row flex-column-reverse">
            <div class="col-lg-5 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d991.6322708628819!2d<?= $lokasi['longitude'] ?>!3d<?= $lokasi['latitude'] ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1705399482351!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Nama Lokasi</td>
                                    <td><?= $lokasi['nama_lokasi']; ?></td>
                                </tr>
                                <tr>
                                    <td style="min-width: 150px">Alamat Lokasi</td>
                                    <td><?= $lokasi['alamat_lokasi']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tipe Lokasi</td>
                                    <td><?= $lokasi['tipe_lokasi']; ?></td>
                                </tr>
                                <tr>
                                    <td>Latitude</td>
                                    <td><?= $lokasi['latitude']; ?></td>
                                </tr>
                                <tr>
                                    <td>Longitude</td>
                                    <td><?= $lokasi['longitude']; ?></td>
                                </tr>
                                <tr>
                                    <td>Radius</td>
                                    <td><?= $lokasi['radius']; ?> meter</td>
                                </tr>
                                <tr>
                                    <td>Zona Waktu</td>
                                    <td><?= $lokasi['zona_waktu']; ?></td>
                                </tr>
                                <tr>
                                    <td>Jam Masuk</td>
                                    <td><?= $lokasi['jam_masuk']; ?></td>
                                </tr>
                                <tr>
                                    <td>Jam Pulang</td>
                                    <td><?= $lokasi['jam_pulang']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="<?= base_url('lokasi-presensi/edit/' . $lokasi['slug']) ?>" class="btn btn-link text-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-location-cog" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 18l-2 -4l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5l-3.14 8.697" />
                                    <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M19.001 15.5v1.5" />
                                    <path d="M19.001 21v1.5" />
                                    <path d="M22.032 17.25l-1.299 .75" />
                                    <path d="M17.27 20l-1.3 .75" />
                                    <path d="M15.97 17.25l1.3 .75" />
                                    <path d="M20.733 20l1.3 .75" />
                                </svg>Edit Info Lokasi
                            </a>
                            <a href="<?= base_url('lokasi-presensi') ?>" class="btn btn-link ms-auto">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>