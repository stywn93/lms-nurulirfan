
# LMS Nurul Irfan Jember

Ini adalah project Learning Management System (LMS) berbasis Moodle yang telah dimodifikasi untuk kebutuhan Nurul Irfan Jember.

## Fitur

- Sistem manajemen pembelajaran daring
- Kustomisasi plugin dan tema sesuai kebutuhan lembaga
- Integrasi modul quiz, ranking, dan fitur tambahan lain

## Instalasi Lokal

1. Pastikan sudah terinstall PHP, MySQL, dan web server (disarankan menggunakan MAMP/XAMPP/LAMP).
2. Clone/copy project ini ke direktori web server Anda.
3. Buat database MySQL baru untuk LMS ini.
4. Salin `config-dist.php` menjadi `config.php` dan sesuaikan pengaturan database serta direktori data.
5. Jalankan instalasi melalui browser: buka `http://localhost/nama-folder-project`.
6. Ikuti instruksi instalasi Moodle hingga selesai.

## Pengembangan

- Untuk menambah plugin, letakkan di folder `mod/`, `blocks/`, atau sesuai struktur Moodle.
- Kustomisasi dapat dilakukan pada folder `theme/` atau dengan menambah file di folder `local/`.
- Untuk development, gunakan branch terpisah dan lakukan pull request jika ingin menggabungkan perubahan ke main.

## Kontak & Bantuan

- Admin: [admin@nurulirfanjember.com](mailto:admin@nurulirfanjember.com)
- Dokumentasi Moodle: https://docs.moodle.org/

## Lisensi

Project ini menggunakan lisensi GNU General Public License v3 (GPLv3). Lihat file COPYING.txt untuk detail.
