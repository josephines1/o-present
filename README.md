![O-Present](https://github.com/josephines1/o-present/blob/main/public/assets/img/readme/mockup_opresent.png "O-Present")

# O-Present
[![made-with-codeigniter4](https://img.shields.io/badge/Made%20with-CodeIgniter4-DD4814.svg)](https://www.codeigniter.com/) [![Open Source? Yes!](https://badgen.net/badge/Open%20Source%3F/Yes%21/blue?icon=github)](https://github.com/josephines1/o-present)

## Aplikasi Presensi Online Berbasis Web
Presensi online tanpa ribet! Catat kehadiran dengan cepat menggunakan foto dan GPS. Manajemen presensi yang lebih pintar dan praktis!

## Requirements

- [CodeIgniter 4](https://codeigniter.com/user_guide/intro/index.html)
- [Composer](https://getcomposer.org/)
- [XAMPP 8.2.4 or later](https://www.apachefriends.org/download.html)
- Geolocation-enabled Browser. Read the location access conditions [here](https://www.chromium.org/Home/chromium-security/prefer-secure-origins-for-powerful-new-features/).

## Features

Temukan fitur-fitur lengkap pada aplikasi presensi O-Present:
- Presensi Berdasarkan GPS Pegawai
- Presensi Berdasarkan Foto Selfie
- Export Laporan Presensi ke dalam Bentuk Microsoft Excel
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
        'login'           => 'App\Views\auth\login',
        'register'        => 'Myth\Auth\Views\register',
        'forgot'          => 'App\Views\auth\forgot',
        'reset'           => 'App\Views\auth\reset-password',
        'emailForgot'     => 'Myth\Auth\Views\emails\forgot',
        'emailActivation' => 'Myth\Auth\Views\emails\activation',
      ];
      ```
    
    - Konfigurasikan agar tidak tampil halaman register mandiri
      ```
      public $allowRegistration = null;
      ```
      
11. Buka file `Email.php` dalam folder `app/Config/Email.php`.
    
12. Isi fromName dan fromEmail untuk digunakan saat mengirim email untuk reset password, dan sebagainya.
    ```
    public string $fromEmail  = 'your email here';
    public string $fromName   = 'O-Present';
    ```
13. Isi nilai SMTPUser dengan email yang sama dengan yang Anda masukkan di $fromEmail.
    ```
    public string $SMTPUser = 'your email here';
    ```
    
14. Isi nilai SMTPPass dengan kode yang Anda dapatkan dari verifikasi dua langkah pada Akun Google Anda untuk Aplikasi XAMPP. Untuk cara lengkap memperoleh kode verifikasi 2 langkah Akun Google dapat dilihat pada link ini https://support.google.com/accounts/answer/185833?hl=en.
    ```
    public string $SMTPPass = 'your code here';
    ``` 
    
15. Aktifkan server Apache dan MySQL di XAMPP Control Panel Anda untuk memulai server pengembangan lokal.
    
16. Kunjungi `localhost/phpmyadmin` pada browser Anda, lalu buat database baru dengan nama o-present atau sesuaikan dengan nama database yang Anda inginkan

17. Kembali ke terminal, jalankan perintah migrate dan seed
    - Migrate
      ```console
      php spark migrate -2024-02-02-091537_create_opresent_tables
      php spark migrate -2024-02-02-142048_create_auth_tables
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

18. Selanjutnya, start server dengan menjalankan perintah berikut ini di terminal.
    ```console
    php spark serve
    ```
      
19. Selesai! Anda dapat mengakses web melalui port 8080 `http://localhost:8080` di server lokal.

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

Detail tipe ketidakhadiran adalah sebagai berikut
**Cuti**
- Pengajuan: Dapat diajukan beberapa hari sebelumnya sesuai kebijakan perusahaan, yang diatur di rules `daysAfter[]` di file `app\Controllers\Ketidakhadiran.php`.
- Status Approval: Memerlukan persetujuan dari atasan. Tidak ada persetujuan otomatis.

**Izin**
- Pengajuan: Dapat diajukan pada hari yang sama atau untuk hari mendatang, tetapi tidak dapat untuk tanggal kemarin atau sebelumnya.
- Status Approval: Memerlukan persetujuan dari atasan. Tidak ada persetujuan otomatis.

**Sakit**
- Pengajuan: Hanya dapat diajukan pada hari ini atau hari esok. Tidak bisa untuk tanggal lebih dari hari esok.
- Status Approval: Otomatis disetujui tanpa perlu persetujuan dari atasan.

#### Kelola Ketidakhadiran
Pada role Head, pengguna dapat mengelola ijin ketidakhadiran, yang meliputi PENDING, APPROVED, dan REJECTED. Pengguna dapat mengunduh daftar ketidakhadiran dari seluruh pegawai ke dalam bentuk Microsoft Excel.

Pada website, batas pengajuan ketidakhadiran dapat dilakukan minimal 3 hari sebelum tanggal mulai cuti untuk pengguna dengan role Head menentukan status pengajuan kehadiran. Untuk memodifikasi batas pengajuan, dapat dilakukan pada rules `daysAfter[]` di file `app\Controllers\Ketidakhadiran.php` pada validasi tanggal mulai (baris ke 287 dan 385) menjadi seperti ini:

```
'tanggal_mulai' => [
                'rules' => 'required|valid_date[Y-m-d]|daysAfter[3]',
                'errors' => [
                    'required' => 'Tanggal mulai ketidakhadiran wajib diisi.',
                    'valid_date' => 'Tanggal harus dalam format YYYY-MM-DD.',
                    'daysAfter' => 'Pengajuan cuti harus minimal 3 hari sebelum tanggal cuti yang diinginkan.'
                ]
            ],
```

#### Master Data
Pada role Head dan Admin, pengguna dapat mengelola data jabatan, lokasi presensi, dan pegawai. Pengguna dapat menemukan data-data tersebut dengan memanfaatkan fitur filter data dan live search data sehingga data dapat ditemukan dengan cepat dan efisien. Pengguna juga dapat mengunduh data-data tersebut ke dalam bentuk Microsoft Excel.

Untuk data beserta akun pegawai yang baru ditambahkan, pegawai dapat mengakses website setelah melewati proses aktivasi, dengan password default '123456'. Pengguna dengan role Head dan Admin dapat menambahkan akun baru untuk pegawai dan menentukan langsung status aktivasi nya (Aktivasi Instan, Aktivasi Melalui Email, atau Aktivasi Nanti).

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
- [Leaflet](https://leafletjs.com/) - a JavaScript library used to build web mapping applications.

## Tips & Troubleshooting
Jika Anda mendapat pesan error saat menjalankan source code O-Present, silahkan melihat solusi-solusi di bawah ini.

### Mengatasi Error "Only secure origins are allowed"

Jika Anda ingin mencoba mengakses web O-Present di device yang berbeda dengan device server menggunakan IP Address dan Port, kemungkinan akan mengalami error ini karena masalah izin akses lokasi menggunakan HTTP. Anda bisa menggunakan ngrok untuk membuat tunneling ke HTTPS.

**Solusi:** Jalankan `ngrok http [port]` untuk mengakses aplikasi Anda melalui HTTPS.

Solusi dari @ikii378.

**Solusi:** Untuk mengatasi masalah ini, tambahkan header berikut pada konfigurasi web server NGINX:

```nginx
add_header Content-Security-Policy "upgrade-insecure-requests";
```

Solusi dari @mrandrian ([GitHub Profile](https://github.com/mrandrian)).

### Mengatasi Error "Origin Does Not Have Permission to use Geolocation Service" pada iOS

Pengguna iOS mungkin mengalami bug di mana mereka tidak bisa menggunakan layanan geolocation dan menerima pesan error "Origin Does Not Have Permission to use Geolocation Service" saat mencoba melakukan absen.

**Solusi:** Untuk mengatasi masalah ini, tambahkan header berikut pada konfigurasi web server NGINX:

```nginx
add_header Content-Security-Policy "upgrade-insecure-requests";
```

Solusi dari @mrandrian ([GitHub Profile](https://github.com/mrandrian)).

## Contribution

Kontribusi untuk penyempurnaan aplikasi ini sangat dihargai. Jika Anda menemukan masalah atau bug, silahkan membuat issue baru dalam repositori ini.

## Support

[![PayPal](https://img.shields.io/badge/PayPal-00457C?style=for-the-badge&logo=paypal&logoColor=white)](https://paypal.me/josephines24)
[![KaryaKarsa](https://image.typedream.com/cdn-cgi/image/width=120,format=auto,fit=scale-down,quality=100/https://api.typedream.com/v0/document/public/07480db4-7b4e-4309-9be2-b4e218db150e/2IGRM5CUZESdabtjezsFTWnWFVR_karyakarsa-logo-white.png?bucket=document)](https://karyakarsa.com/josephines24)

## Credits

> Made by [Josephine](https://josephines1.github.io/).
> Template by [tabler.io](tabler.io)
