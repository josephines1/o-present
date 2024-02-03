# O-Present

## Aplikasi Presensi Online Berbasis Web

[![made-with-codeigniter4](https://img.shields.io/badge/Made%20with-CodeIgniter4-DD4814.svg)](https://www.codeigniter.com/) [![Open Source? Yes!](https://badgen.net/badge/Open%20Source%20%3F/Yes%21/blue?icon=github)](https://josephines1.github.io/o-present)
Presensi online tanpa ribet! Catat kehadiran dengan cepat menggunakan foto dan GPS. Manajemen presensi yang lebih pintar dan praktis!

## Requirements

---

- CodeIgniter 4.1+ or later
- XAMPP 8.2.4 or later
- Geolocation-enabled Browser

## Features

---

Temukan fitur-fitur lengkap pada aplikasi presensi O-Present:

- Presensi Berdasarkan GPS Pegawai
- Presensi Berdasarkan Foto Selfie
- Import Laporan Presensi ke dalam Bentuk Excel
- Temukan Data dengan Filter dan Live Search
- Simpan Data Presensi, Lokasi Presensi, hingga Data Pegawai
- Sistem Otentikasi (Auth) Multiuser untuk Pegawai, Admin, dan Head

## Installation

---

Anda dapat melakukan instalasi O-Present melalui halaman github:

1. Unduh proyek ini dengan satu klik! Pilih "code" di GitHub, lalu download ZIP.
2. Aktifkan server Apache dan MySQL di XAMPP untuk memulai.
3. Ekstrak folder Aplikasi O-Present yang sudah diunduh dan lokasikan folder aplikasi dalam folder htdocs.
4. Buka Folder Aplikasi O-Present dalam Teks Editor, seperti Visual Studio Code.
5. Buka Terminal dan start server dengan mengetikkan:
   `php spark serve`
6. Secara default, aplikasi dalam diakses melalui port 8080
   `http://localhost:8080`.

## Configuration

---

Setelah melakukan instalasi O-Present, Anda perlu melakukan konfigurasi sebagai berikut.

1. Edit file app/Config/Email.php dan pastikan fromName dan fromEmail sudah diatur, karena akan digunakan saat mengirim email untuk reset password, dan sebagainya.
2. Isi nilai SMTPPass dengan kode yang Anda dapatkan dari langkah 2 verifikasi dua langkah pada Akun Google Anda untuk Aplikasi XAMPP.
3. Pastikan basis data Anda sudah diatur dengan benar, lalu jalankan migrasi Auth dengan perintah:
   `php spark migrate`

## First Usage

---

Setelah melakukan instalasi dan konfigurasi O-Present, Anda dapat melakukan login pada aplikasi dengan email dan password sebagai berikut.

#### Head

```
Email: jaya@present.com
Password: 123456
```

#### Admin

```
Email: tamani@present.com
Password: 123456
```

#### Pegawai

```
Email: choland@present.com
Password: 123456
```

Setelah itu, Anda dapat mencoba untuk menambahkan lokasi presensi baru untuk mencoba melakukan presensi masuk dan presensi keluar.

## Services

---

Layanan di bawah ini tersedia pada aplikasi O-Present.

##### Presensi Masuk & Keluar

Pada role Admin dan Pegawai, pengguna dapat melakukan presensi masuk pada lokasi presensi yang sudah diatur. Untuk layanan ini, akses kamera dan lokasi diperlukan untuk melakukan presensi masuk dan keluar. Foto presensi yang sudah ter-capture, akan disimpan dalam folder public\assets\img\foto_presensi.

##### Rekap Presensi

Pada role Admin dan Pegawai, pengguna dapat melihat rekap presensi yang sudah tercatat dalam database, serta mengunduhnya dalam bentuk Microsoft Excel.

##### Laporan Presensi Harian dan Bulanan

Pada role Head dan Admin, pengguna dapat melihat laporan presensi harian dan bulanan milik seluruh pegawai yang sudah tercatat dalam database, serta mengunduhnya dalam bentuk Microsoft Excel.

##### Pengajuan Ketidakhadiran

Pada role Admin dan Pegawai, pengguna dapat mengajukan ketidakhadiran dengan batas H-3 dan durasi ketidakhadiran selama 3 bulan. Pengguna diwajibkan menggunggah file surat keterangan tidak hadir dalam bentuk PDF. File yang sudah terunggah disimpan dalam folder public\assets\file\surat_keterangan_ketidakhadiran. Pengguna dapat mengunduh daftar ketidakhadirannya dalam satu bulan ke dalam bentuk Microsoft Excel.

##### Kelola Ketidakhadiran

Pada role Head, pengguna dapat mengelola ijin ketidakhadiran, yang meliputi PENDING, APPROVED, dan REJECTED. Pengguna dapat mengunduh daftar ketidakhadiran dari seluruh pegawai ke dalam bentuk Micorosoft Excel.

##### Master Data

Pada role Head dan Admin, pengguna dapat mengelola data jabatan, lokasi presensi, dan pegawai. Pengguna dapat menemukan data-data tersebut dengan memanfaatkan fitur filter data dan live search data sehingga data dapat ditemukan dengan cepat dan efisien. Pengguna juga dapat mengunduh data-data tersebut ke dalam bentuk Microsoft Excel.

Untuk data pegawai yang baru ditambahkan, pegawai dapat mengakses aplikasi setelah melakukan aktivasi melalui email, dengan password '123456'.

##### Kelola Profile

Untuk semua role, pengguna dapat mengelola profile nya, yang meliputi ubah foto profile, ubah username, ubah nama dan info profile lainnya.

##### Lupa & Ubah Password

Untuk pengguna yang lupa password, pengguna dapat memilih opsi "Lupa Password" yang tersedia pada halaman Login. Untuk pengguna yang ingin melakukan perubahan password, pengguna dapat memilih opsi "Reset Password" yang tersedia pada halaman profile. Sistem akan mengirimkan email kepada pengguna untuk instruksi reset password.

##### Ubah Email

Untuk pengguna yang ingin melakukan perubahan email, pengguna dapat memilih opsi "Ubah Email" yang tersedia pada halaman profile. Sistem akan mengirimkan token ke alamat email pengguna saat ini, untuk instruksi selanjutnya dalam melakukan perubahan alamat email.

## Tech

---

Teknologi dalam aplikasi ini:

- [CodeIgniter 4](https://www.codeigniter.com/) - a flexible application development framework.
- [Myth/Auth](https://github.com/lonnieezell/myth-auth) - a flexible, Powerful, Secure auth package for CodeIgniter 4.
- [Tabler.io](https://tabler.io/) - a free and open source web application UI kit based on Bootstrap 5.
- [jQuery](https://jquery.com/) - a fast, small, and feature-rich JavaScript library.
- [WebcamJS](https://pixlcore.com/read/WebcamJS) - a small standalone JavaScript library for capturing still images

## Credits

---

> Made by [Josephine](https://josephines1.github.io/)
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
