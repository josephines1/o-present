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
    <title>Login | O-Present</title>
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
                    <h2 class="h2 text-center mb-4"><?= lang('Auth.loginTitle') ?></h2>

                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <form action="<?= url_to('login') ?>" method="post" autocomplete="off" novalidate>
                        <?= csrf_field() ?>

                        <?php if ($config->validFields === ['email']) : ?>
                            <div class="mb-3">
                                <label class="form-label"><?= lang('Auth.email') ?></label>
                                <input name="login" type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="mb-3">
                                <label class="form-label"><?= lang('Auth.emailOrUsername') ?></label>
                                <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="mb-2">
                            <label class="form-label">
                                <?= lang('Auth.password') ?>
                                <?php if ($config->activeResetter) : ?>
                                    <span class="form-label-description">
                                        <a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a>
                                    </span>
                                <?php endif; ?>
                            </label>
                            <div class="input-group input-group-flat">
                                <input name="password" type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>
                        </div>

                        <?php if ($config->allowRemembering) : ?>
                            <div class="mb-2">
                                <label class="form-check">
                                    <input name="remember" type="checkbox" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?> />
                                    <span class="form-check-label"><?= lang('Auth.rememberMe') ?></span>
                                </label>
                            </div>
                        <?php endif; ?>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100"><?= lang('Auth.loginAction') ?></button>
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