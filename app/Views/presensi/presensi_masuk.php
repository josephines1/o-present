<?= $this->extend('templates/index') ?>

<?= $this->section('pageBody') ?>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row g-3">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card text-center">
                    <div class="card-body m-auto">
                        <div id="my_result"></div>
                        <div class="mt-3" id="my_camera"></div>
                        <div class="mt-3"><?= date('d F Y', strtotime($tanggal_masuk)) . ' - ' . $jam_masuk ?></div>
                        <form action="<?= base_url('/presensi-masuk/simpan') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="username" value="<?= $user_profile->username ?>">
                            <input type="hidden" name="id_pegawai" value="<?= $user_profile->id_pegawai ?>">
                            <input type="hidden" name="tanggal_masuk" value="<?= $tanggal_masuk ?>">
                            <input type="hidden" name="jam_masuk" value="<?= $jam_masuk ?>">
                            <input type="hidden" name="image-cam" class="image-tag">
                            <button class="btn btn-primary mt-3" type="submit" id="ambil-foto">Ambil Gambar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script language="JavaScript">
    Webcam.set({
        width: 320,
        height: 240,
        dest_width: 320,
        dest_height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false
    });

    Webcam.attach('#my_camera');

    document.getElementById('ambil-foto').addEventListener('click', function() {
        Webcam.snap(function(data_uri) {
            $('.image-tag').val(data_uri);

            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
        });
    });

    let latitude_kantor = <?= $latitude_kantor ?>;
    let longitude_kantor = <?= $longitude_kantor ?>;

    let latitude_pegawai = <?= $latitude_pegawai ?>;
    let longitude_pegawai = <?= $longitude_pegawai ?>;

    let radius = <?= $radius ?>;

    var map = L.map('map').setView([latitude_kantor, longitude_kantor], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([latitude_pegawai, longitude_pegawai]).addTo(map).bindPopup("Posisi Anda saat ini.");;

    var circle = L.circle([latitude_kantor, longitude_kantor], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: radius
    }).addTo(map).bindPopup("Radius Presensi");
</script>
<?= $this->endSection() ?>