<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?= $title ?> | O-Present</title>
    <!-- CSS files -->
    <link href="<?= base_url('../assets/css/tabler.min.css?1684106062') ?>" rel="stylesheet" />
    <link href="<?= base_url('../assets/css/tabler-flags.min.css?1684106062') ?>" rel="stylesheet" />
    <link href="<?= base_url('../assets/css/tabler-payments.min.css?1684106062') ?>" rel="stylesheet" />
    <link href="<?= base_url('../assets/css/tabler-vendors.min.css?1684106062') ?>" rel="stylesheet" />
    <link href="<?= base_url('../assets/css/demo.min.css?1684106062') ?>" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    <!-- WebcamJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- CSS leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- JavaScript leaflet.js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        #map {
            height: 350px;
        }
    </style>

    <!-- Website Icon -->
    <link rel="website icon" type="png" href="<?= base_url('../assets/img/company/logo.png') ?>">

    <!-- jQuery -->
    <script src="<?= base_url('js/code.jquery.com_jquery-3.7.0.min.js') ?>"></script>
</head>

<body>
    <script src="<?= base_url('../assets/js/demo-theme.min.js?1684106062') ?>"></script>
    <div class="page">
        <!-- Header -->
        <?= $this->include('partials/header') ?>

        <!-- Navbar -->
        <?= $this->include('partials/navbar') ?>

        <div class="page-wrapper">
            <!-- Page header -->
            <?= $this->include('partials/page-header') ?>

            <!-- Page body -->
            <?= $this->renderSection('pageBody'); ?>

            <!-- Footer -->
            <?= $this->include('partials/footer') ?>
        </div>
    </div>
    <!-- Libs JS -->
    <script src="<?= base_url('../assets/libs/apexcharts/dist/apexcharts.min.js?1684106062') ?>" defer></script>
    <script src="<?= base_url('../assets/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062') ?>" defer></script>
    <script src="<?= base_url('../assets/libs/jsvectormap/dist/maps/world.js?1684106062') ?>" defer></script>
    <script src="<?= base_url('../assets/libs/jsvectormap/dist/maps/world-merc.js?1684106062') ?>" defer></script>
    <!-- Tabler Core -->
    <script src="<?= base_url('../assets/js/tabler.min.js?1684106062') ?>" defer></script>
    <script src="<?= base_url('../assets/js/demo.min.js?1684106062') ?>" defer></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (session()->getFlashdata('berhasil')) : ?>
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "<?= session()->getFlashdata('berhasil') ?>",
                icon: "success"
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('gagal')) : ?>
        <script>
            Swal.fire({
                title: "Gagal",
                text: "<?= session()->getFlashdata('gagal') ?>",
                icon: "error"
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')) : ?>
        <script>
            Swal.fire({
                title: "Kesalahan Teknis",
                text: "<?= session()->getFlashdata('warning') ?>",
                icon: "warning"
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('info')) : ?>
        <script>
            Swal.fire({
                title: "Info",
                text: "<?= session()->getFlashdata('info') ?>",
                icon: "info"
            });
        </script>
    <?php endif; ?>
</body>

</html>