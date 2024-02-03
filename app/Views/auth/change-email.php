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
    <title>Change Email | O-Present</title>
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

    <!-- Website Icon -->
    <link rel="website icon" type="png" href="<?= base_url('../assets/img/company/logo.png') ?>">
</head>

<body class="d-flex flex-column">
    <script src="<?= base_url('../assets/js/demo-theme.min.js?1684106062') ?>"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="<?= base_url() ?>" class="navbar-brand navbar-brand-autodark align-items-center">
                    <img src="<?= base_url('../assets/img/company/logo.png') ?>" height="36" alt="O-Present">
                    <span>O-Present</span>
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Change Your Email</h2>

                    <?php if (session()->getFlashdata('berhasil')) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div><?= session()->getFlashdata('berhasil') ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div><?= session()->getFlashdata('gagal') ?></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="<?= url_to('update-email') ?>" method="post" autocomplete="off" novalidate>
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label"><?= lang('Auth.token') ?></label>
                            <input name="token" type="text" class="form-control <?php if (validation_show_error('token')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('token') ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?= lang('Auth.email') ?></label>
                            <input name="email" type="email" class="form-control <?php if (validation_show_error('email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= validation_show_error('email') ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Email Address</label>
                            <input name="newEmail" type="text" class="form-control <?php if (validation_show_error('newEmail')) : ?>is-invalid<?php endif ?>" placeholder="New Email Address" autocomplete="off" value="<?= old('newEmail') ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('newEmail') ?>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Change Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?= base_url('../assets/js/tabler.min.js?1684106062') ?>" defer></script>
    <script src="<?= base_url('../assets/js/demo.min.js?1684106062') ?>" defer></script>
</body>

</html>