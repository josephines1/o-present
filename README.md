# O-Present
[![made-with-codeigniter4](https://img.shields.io/badge/Made%20with-CodeIgniter4-DD4814.svg)](https://www.codeigniter.com/) [![Open Source? Yes!](https://badgen.net/badge/Open%20Source%3F/Yes%21/blue?icon=github)](https://github.com/josephines1/o-present)

## Aplikasi Presensi Online Berbasis Web
Presensi online tanpa ribet! Catat kehadiran dengan cepat menggunakan foto dan GPS. Manajemen presensi yang lebih pintar dan praktis!

![O-Present Mockup](https://github.com/josephines1/o-present/blob/main/public/assets/img/readme/mockup_opresent.png "O-Present")

## Requirements

- CodeIgniter 4.1+ or later
- XAMPP 8.2.4 or later
- Geolocation-enabled Browser

## Features

Temukan fitur-fitur lengkap pada aplikasi presensi O-Present:
- Presensi Berdasarkan GPS Pegawai
- Presensi Berdasarkan Foto Selfie
- Import Laporan Presensi ke dalam Bentuk Excel
- Temukan Data dengan Filter dan Live Search
- Simpan Data Presensi, Lokasi Presensi, hingga Data Pegawai
- Sistem Otentikasi (Auth) Multiuser untuk Pegawai, Admin, dan Head

## Getting Started

Anda perlu melakukan sedikit konfigurasi di bawah ini sebelum mulai menjalankan web O-Present:
1. Anda dapat mengunduh kode sumber aplikasi ini dari repositori GitHub dengan tombol "Download ZIP" atau jalankan perintah berikut di terminal Anda:
   ```console
   git clone https://github.com/josephines1/o-present.git
   ```

2. Ekstrak file Zip O-Present yang sudah diunduh dan lokasikan folder aplikasi di dalam folder htdocs.

3. Buka folder project tersebut di Code Editor (seperti Visual Studio Code)

4. Buka terminal, dan pastikan path pada terminal sudah terarah pada directory project website.
   
5. Jalankan perintah berikut ini pada terminal untuk memuat package yang dibutuhkan website.
   ```console
   composer install
   ```
   
6. Copy file `env` dan beri nama file duplikatnya menjadi `.env`
   - Pertama, ubah konfigurasi CI_ENVIROMENT menjadi seperti di bawah ini.
     ```
      CI_ENVIRONMENT = development
      ```
     
   - Lalu, konfigurasikan url utama untuk web Anda.
     ```
      app.baseURL = 'http://localhost:8080/'
      ```
     
   - Kemudian, konfirgurasikan database. Sesuaikan dengan database milik Anda.
     ```
      database.default.hostname = localhost
      database.default.database = o-present
      database.default.username = root
      database.default.password = 
      database.default.DBDriver = MySQLi
      database.default.DBPrefix =
      database.default.port = 3306
      ```
     
7. Buka file `RoleFilter.php` dalam folder `vendor\myth\auth\src\Filters\RoleFilter.php`.
   
8. Modifikasi function before menjadi seperti berikut ini.
   ```
   public function before(RequestInterface $request, $arguments = null)
    {
        // If no user is logged in then send them to the login form.
        if (! $this->authenticate->check()) {
            session()->set('redirect_url', current_url());

            return redirect($this->reservedRoutes['login']);
        }

        if (empty($arguments)) {
            return;
        }

        // Check each requested permission
        foreach ($arguments as $group) {
            if ($this->authorize->inGroup($group, $this->authenticate->id())) {
                return;
            }
        }

        // Check if the user has the 'head' role
        if ($this->authorize->inGroup('head', $this->authenticate->id())) {
            // Check each requested permission for 'head'
            if (!empty($arguments)) {
                foreach ($arguments as $group) {
                    if ($this->authorize->inGroup($group, $this->authenticate->id())) {
                        return;
                    }
                }

                // If 'head' does not have the required permission, redirect to '/admin'
                return redirect()->to('/admin')->with('error', lang('Auth.notEnoughPrivilege'));
            }
        }

        if ($this->authenticate->silent()) {
            $redirectURL = session('redirect_url') ?? route_to($this->landingRoute);
            unset($_SESSION['redirect_url']);

            return redirect()->to($redirectURL)->with('error', lang('Auth.notEnoughPrivilege'));
        }

        // throw new PermissionException(lang('Auth.notEnoughPrivilege'));
        return redirect()->to('/');
    }
   ```

9. Buka file `AuthController.php` dalam folder `vendor\myth\auth\src\Controllers\AuthController.php`.
   - Modifikasi function `attemptForgot` menjadi seperti berikut ini.
     ```
     public function attemptForgot($email = false)
     {
        if ($this->config->activeResetter === null) {
            return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
        }

        if (!$email) {
            $rules = [
                'email' => [
                    'label' => lang('Auth.emailAddress'),
                    'rules' => 'required|valid_email',
                ],
            ];

            if (!$this->validate($rules)) {
                dd($this->validator->getErrors());
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }

        $users = model(UserModel::class);

        if ($email) {
            $user = $users->where('email', $email)->first();
        } else {
            $user = $users->where('email', $this->request->getPost('email'))->first();
        }

        if (null === $user) {
            return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
        }

        // Save the reset hash /
        $user->generateResetHash();
        $users->save($user);

        $resetter = service('resetter');
        $sent     = $resetter->send($user);

        if (!$sent) {
            return redirect()->back()->withInput()->with('error', $resetter->error() ?? lang('Auth.unknownError'));
        }

        return redirect()->route('reset-password')->with('message', lang('Auth.forgotEmailSent'));
     }
     ```

   - Modifikasi function `resendActivateAccount` menjadi seperti berikut ini.
     ```
     public function resendActivateAccount($login = false)
     {
        if ($this->config->requireActivation === null) {
            return redirect()->route('login');
        }

        $throttler = service('throttler');

        if ($login == false) {
            if ($throttler->check(md5($this->request->getIPAddress()), 2, MINUTE) === false) {
                return service('response')->setStatusCode(429)->setBody(lang('Auth.tooManyRequests', [$throttler->getTokentime()]));
            }
            $login = urldecode($this->request->getGet('login'));
        }
        $type  = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $users = model(UserModel::class);

        $user = $users->where($type, $login)
            ->where('active', 0)
            ->first();

        if (null === $user) {
            return redirect()->route('login')->with('error', lang('Auth.activationNoUser'));
        }

        $activator = service('activator');
        $sent      = $activator->send($user);

        if (!$sent) {
            return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
        }

        // Success!
        // return redirect()->route('login')->with('message', lang('Auth.activationSuccess'));
        return redirect()->to('/data-pegawai')->with('berhasil', 'Email aktivasi berhasil terkirim');
     }
     ```
     
10. Buka file `Auth.php` dalam folder `vendor\myth\auth\src\Config\Auth.php`.
    - Konfigurasikan defaultUserGroup.
      ```
      public $defaultUserGroup = ['pegawai'];
      ```
      
    - Konfigurasikan tampilan auth website.
      ```
      public $views = [
        'login'           => 'Auth\login',
        'register'        => 'Myth\Auth\Views\register',
        'forgot'          => 'Auth\forgot',
        'reset'           => 'Auth\reset-password',
        'emailForgot'     => 'Myth\Auth\Views\emails\forgot',
        'emailActivation' => 'Myth\Auth\Views\emails\activation',
      ];
      ```
      
11. Buka file `Email.php` dalam folder `app/Config/Email.php`.
    
12. Isi fromName dan fromEmail untuk digunakan saat mengirim email untuk reset password, dan sebagainya.
    ```
    public string $fromEmail  = 'your email here';
    public string $fromName   = 'O-Present';
    ```
    
13. Isi nilai SMTPPass dengan kode yang Anda dapatkan dari langkah 2 verifikasi dua langkah pada Akun Google Anda untuk Aplikasi XAMPP.
    ```
    public string $SMTPPass = 'your code here';
    ``` 
    
14. Aktifkan server Apache dan MySQL di XAMPP Control Panel Anda untuk memulai server pengembangan lokal.
    
15. Kunjungi `localhost/phpmyadmin` pada browser Anda, lalu buat database baru dengan nama o-present atau sesuaikan dengan nama database yang Anda inginkan

16. Kembali ke terminal, jalankan perintah migrate dan seed
    - Migrate
      ```console
      php spark migrate -2024-02-02-091537_create_opresent_tables
      php spark migrate -2024-02-02-142048_create_auth_tables.php
      ```

    - Seed
      ```console
      php spark db:seed JabatanSeeder
      php spark db:seed LokasiSeeder
      php spark db:seed PegawaiSeeder
      php spark db:seed UsersSeeder
      php spark db:seed AuthGroupsSeeder
      php spark db:seed AuthPermissionsSeeder
      php spark db:seed AuthGroupsPermissionsSeeder
      php spark db:seed AuthGroupsUsersSeeder
      ```

16. Selanjutnya, start server dengan menjalankan perintah berikut ini di terminal.
    ```console
    php spark serve
    ```
      
17. Selesai! Anda dapat mengakses web melalui port 8080 `http://localhost:8080` di server lokal.

## First Usage

Setelah melakukan instalasi dan konfigurasi O-Present, Anda dapat melakukan login pada aplikasi dengan email dan password sebagai berikut.

### Head
```
Email: jaya@present.com
Password: 123456
```

### Admin
```
Email: tamani@present.com
Password: 123456
```

### Pegawai
```
Email: choland@present.com
Password: 123456
```

Setelah berhasil melakukan login, Anda dapat mencoba untuk menambahkan lokasi presensi baru untuk mencoba melakukan presensi masuk dan presensi keluar.

## Services

Layanan di bawah ini tersedia pada aplikasi O-Present.

#### Presensi Masuk & Keluar
Pada role Admin dan Pegawai, pengguna dapat melakukan presensi masuk pada lokasi presensi yang sudah diatur. Untuk layanan ini, akses kamera dan lokasi diperlukan untuk melakukan presensi masuk dan keluar. Foto presensi yang sudah ter-capture, akan disimpan dalam folder public\assets\img\foto_presensi.

#### Rekap Presensi
Pada role Admin dan Pegawai, pengguna dapat melihat rekap presensi yang sudah tercatat dalam database, serta mengunduhnya dalam bentuk Microsoft Excel.

#### Laporan Presensi Harian dan Bulanan
Pada role Head dan Admin, pengguna dapat melihat laporan presensi harian dan bulanan milik seluruh pegawai yang sudah tercatat dalam database, serta mengunduhnya dalam bentuk Microsoft Excel.

#### Pengajuan Ketidakhadiran
Pada role Admin dan Pegawai, pengguna dapat mengajukan ketidakhadiran dengan batas H-3 dan durasi ketidakhadiran selama 3 bulan. Pengguna diwajibkan menggunggah file surat keterangan tidak hadir dalam bentuk PDF. File yang sudah terunggah disimpan dalam folder public\assets\file\surat_keterangan_ketidakhadiran. Pengguna dapat mengunduh daftar ketidakhadirannya dalam satu bulan ke dalam bentuk Microsoft Excel.

#### Kelola Ketidakhadiran
Pada role Head, pengguna dapat mengelola ijin ketidakhadiran, yang meliputi PENDING, APPROVED, dan REJECTED. Pengguna dapat mengunduh daftar ketidakhadiran dari seluruh pegawai ke dalam bentuk Micorosoft Excel.

#### Master Data
Pada role Head dan Admin, pengguna dapat mengelola data jabatan, lokasi presensi, dan pegawai. Pengguna dapat menemukan data-data tersebut dengan memanfaatkan fitur filter data dan live search data sehingga data dapat ditemukan dengan cepat dan efisien. Pengguna juga dapat mengunduh data-data tersebut ke dalam bentuk Microsoft Excel.

Untuk data pegawai yang baru ditambahkan, pegawai dapat mengakses aplikasi setelah melakukan aktivasi melalui email, dengan password '123456'.

#### Kelola Profile
Untuk semua role, pengguna dapat mengelola profile nya, yang meliputi ubah foto profile, ubah username, ubah nama dan info profile lainnya.

#### Lupa & Ubah Password
Untuk pengguna yang lupa password, pengguna dapat memilih opsi "Lupa Password" yang tersedia pada halaman Login. Untuk pengguna yang ingin melakukan perubahan password, pengguna dapat memilih opsi "Reset Password" yang tersedia pada halaman profile. Sistem akan mengirimkan email kepada pengguna untuk instruksi reset password.

#### Ubah Email
Untuk pengguna yang ingin melakukan perubahan email, pengguna dapat memilih opsi "Ubah Email" yang tersedia pada halaman profile. Sistem akan mengirimkan token ke alamat email pengguna saat ini, untuk instruksi selanjutnya dalam melakukan perubahan alamat email.

## Database
Berikut ini adalah struktur table database untuk aplikasi O-Present.
![O-Present Database](https://github.com/josephines1/o-present/blob/main/public/assets/img/readme/db_opresent.png "O-Present")

## Tech

Teknologi dalam aplikasi ini:
- [CodeIgniter 4](https://www.codeigniter.com/) - a flexible application development framework.
- [Myth/Auth](https://github.com/lonnieezell/myth-auth) - a flexible, Powerful, Secure auth package for CodeIgniter 4.
- [Tabler.io](https://tabler.io/) - a free and open source web application UI kit based on Bootstrap 5.
- [jQuery](https://jquery.com/) - a fast, small, and feature-rich JavaScript library.
- [WebcamJS](https://pixlcore.com/read/WebcamJS) - a small standalone JavaScript library for capturing still images

## Credits

> Made by [Josephine. ](https://josephines1.github.io/)
> Template by [tabler.io](tabler.io)

[//]: # "These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax"
[dill]: https://github.com/joemccann/dillinger
[git-repo-url]: https://github.com/joemccann/dillinger.git
[john gruber]: http://daringfireball.net
[df1]: http://daringfireball.net/projects/markdown/
[markdown-it]: https://github.com/markdown-it/markdown-it
[Ace Editor]: http://ace.ajax.org
[node.js]: http://nodejs.org
[Twitter Bootstrap]: http://twitter.github.com/bootstrap/
[jQuery]: http://jquery.com
[@tjholowaychuk]: http://twitter.com/tjholowaychuk
[express]: http://expressjs.com
[AngularJS]: http://angularjs.org
[Gulp]: http://gulpjs.com
[PlDb]: https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md
[PlGh]: https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md
[PlGd]: https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md
[PlOd]: https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md
[PlMe]: https://github.com/joemccann/dillinger/tree/master/plugins/medium/README.md
[PlGa]: https://github.com/RahulHP/dillinger/blob/master/plugins/googleanalytics/README.md
