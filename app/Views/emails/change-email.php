<p>Someone requested a email change on this email address for <?= site_url() ?>.</p>

<p>To change the email use this code or URL and follow the instructions.</p>

<p>Your Code: <?= $token ?></p>

<p>Visit the <a href="<?= url_to('change-email') . '?token=' . $token ?>">Change Email Form</a>.</p>

<br>

<p>If you did not request a email change, you can safely ignore this email.</p>