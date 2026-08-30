# Instalasi SPMB SD Negeri 21 Mataram

Dokumentasi instalasi dan konfigurasi aplikasi **Sistem Penerimaan Murid Baru (SPMB) SD Negeri 21 Mataram**.

Aplikasi dibangun menggunakan:

* Laravel 12
* PHP 8.5+
* PostgreSQL
* Livewire 4
* Filament 5
* Apache
* Docker

---

## 1. Persyaratan Server

### Minimum

Disarankan menggunakan:

* Ubuntu Server 22.04 LTS atau lebih baru
* CPU: 2 Core
* RAM: 4 GB
* Storage: minimal 20 GB
* Docker
* Docker Compose Plugin
* Git

### Software

Pastikan software berikut tersedia:

```bash
docker --version
docker compose version
git --version
```

Contoh:

```text
Docker version 28.x.x
Docker Compose version v2.x.x
git version 2.x.x
```

---

# 2. Clone Repository

Clone repository aplikasi:

```bash
git clone https://github.com/adryfia-sudo/spmb-sdn21-mataram.git
```

Masuk ke direktori aplikasi:

```bash
cd spmb-sdn21-mataram
```

Jika menggunakan branch tertentu:

```bash
git checkout master
```

atau:

```bash
git checkout feature/master-data
```

Sesuaikan dengan branch yang digunakan pada server.

---

# 3. Struktur Direktori

Struktur utama aplikasi:

```text
spmb-sdn21-mataram/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── docker/
├── Dockerfile
├── compose.yaml
├── composer.json
├── package.json
└── .env
```

---

# 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Edit:

```bash
nano .env
```

Contoh konfigurasi:

```env
APP_NAME="SPMB SD Negeri 21 Mataram"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_LEVEL=info

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=spmb
DB_USERNAME=spmb
DB_PASSWORD=GANTI_PASSWORD_DATABASE
```

Sesuaikan:

* `APP_URL`
* `DB_DATABASE`
* `DB_USERNAME`
* `DB_PASSWORD`

dengan konfigurasi server.

> Jangan menyimpan password database atau data rahasia lainnya ke repository Git.

---

# 5. Menjalankan Docker

Jika project menggunakan Docker Compose, jalankan:

```bash
docker compose up -d --build
```

Periksa container:

```bash
docker compose ps
```

atau:

```bash
docker ps
```

Pastikan container aplikasi dan database dalam kondisi `Up`.

Contoh:

```text
spmb-sdn21-mataram
postgres
```

---

# 6. Masuk ke Container Aplikasi

Contoh nama container:

```bash
docker exec -it spmb-sdn21-mataram bash
```

Jika nama container berbeda, gunakan:

```bash
docker ps
```

untuk melihat nama container.

---

# 7. Instalasi Dependency Laravel

Di dalam container:

```bash
composer install --no-dev --optimize-autoloader
```

Jika project development:

```bash
composer install
```

---

# 8. Generate Application Key

Jalankan:

```bash
php artisan key:generate
```

Periksa:

```bash
php artisan about
```

---

# 9. Konfigurasi Database

Pastikan PostgreSQL sudah berjalan:

```bash
docker compose ps
```

Tes koneksi database:

```bash
php artisan migrate:status
```

Jika koneksi berhasil, Laravel akan menampilkan daftar migration.

---

# 10. Menjalankan Migration

Jalankan migration:

```bash
php artisan migrate
```

Untuk instalasi baru yang memang ingin menghapus seluruh database:

```bash
php artisan migrate:fresh
```

**PERINGATAN:**

`migrate:fresh` akan menghapus tabel dan seluruh data yang ada.

Jangan menjalankan perintah tersebut pada server production yang sudah berisi data pendaftar.

---

# 11. Menjalankan Seeder

Setelah migration selesai:

```bash
php artisan db:seed
```

Atau jika instalasi baru:

```bash
php artisan migrate --seed
```

Seeder digunakan untuk memasukkan data awal aplikasi, seperti data master yang diperlukan oleh sistem.

Jika project memiliki seeder tertentu, jalankan sesuai kebutuhan:

```bash
php artisan db:seed --class=DatabaseSeeder
```

---

# 12. Storage Laravel

Buat symbolic link untuk storage:

```bash
php artisan storage:link
```

Jika symbolic link sudah ada, perintah tersebut dapat dilewati.

---

# 13. Permission

Pastikan Laravel dapat menulis ke:

```text
storage/
bootstrap/cache/
```

Jalankan:

```bash
chown -R www-data:www-data storage bootstrap/cache
```

Kemudian:

```bash
chmod -R 775 storage bootstrap/cache
```

Pada server production, hindari memberikan permission `777` jika tidak diperlukan.

---

# 14. Cache Laravel

Setelah konfigurasi selesai:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

Untuk production, cache konfigurasi:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Jika mengubah file `.env`, jalankan kembali:

```bash
php artisan config:clear
php artisan config:cache
```

---

# 15. Instalasi Frontend

Jika asset frontend belum dibuild:

```bash
npm install
```

Untuk production:

```bash
npm run build
```

Pastikan Node.js dan npm tersedia pada environment build.

Jika frontend sudah dibuild dan asset telah tersedia di repository/image Docker, langkah ini tidak diperlukan.

---

# 16. Menjalankan Aplikasi

Jika menggunakan Docker:

```bash
docker compose up -d
```

Periksa:

```bash
docker compose ps
```

Aplikasi dapat diakses melalui:

```text
http://SERVER-IP:8000
```

Contoh:

```text
http://192.168.1.100:8000
```

Jika menggunakan domain:

```text
http://domain-anda/
```

---

# 17. Halaman Pendaftaran

Halaman pendaftaran murid dapat diakses melalui:

```text
/daftar
```

Contoh:

```text
http://SERVER-IP:8000/daftar
```

Pendaftaran dilakukan tanpa akun/login peserta.

---

# 18. Panel Admin

Panel administrasi menggunakan Filament.

URL panel admin mengikuti konfigurasi route/panel Filament pada project.

Secara default, periksa:

```text
/admin
```

Contoh:

```text
http://SERVER-IP:8000/admin
```

Akun administrator harus dibuat sesuai mekanisme user/Seeder yang digunakan oleh project.

Jika belum ada user administrator, dapat dibuat melalui:

```bash
php artisan make:filament-user
```

Ikuti pertanyaan yang muncul di terminal.

---

# 19. Konfigurasi Data Master

Setelah login ke panel admin, lakukan konfigurasi data master sebelum membuka pendaftaran.

Urutan yang disarankan:

### 1. Tahun Akademik

Masukkan tahun akademik yang digunakan.

Contoh:

```text
2026/2027
```

### 2. Periode Pendaftaran

Atur:

* Nama periode
* Tanggal mulai
* Tanggal selesai
* Status aktif

### 3. Jalur Pendaftaran

Konfigurasi jalur yang digunakan.

Contoh:

* Afirmasi
* Domisili
* Mutasi

### 4. Persyaratan

Tambahkan dokumen persyaratan yang diperlukan.

Persyaratan dapat dikonfigurasi sesuai kebutuhan, termasuk:

* Wajib atau opsional
* Ditampilkan pada upload
* Wajib diverifikasi
* Ditampilkan pada bukti pendaftaran
* Ditampilkan pada pengumuman

---

# 20. Persyaratan Dokumen

Pengelolaan persyaratan dilakukan melalui menu **Persyaratan** pada panel admin.

Sistem mendukung konfigurasi persyaratan berdasarkan jalur pendaftaran.

Contoh persyaratan:

```text
Kartu Keluarga
Akta Kelahiran
KTP Orang Tua
KTP Wali
KK Wali
Dokumen pendukung lainnya
```

Persyaratan yang bersifat opsional tetap dapat ditampilkan kepada calon peserta apabila konfigurasi mengaktifkannya.

---

# 21. Bukti Pendaftaran

Bukti pendaftaran dapat dibuat setelah proses pendaftaran selesai.

Bukti pendaftaran dapat memuat:

* Logo Kota Mataram
* Logo sekolah
* Nomor pendaftaran
* Data peserta
* Data pendaftaran
* Data yang diperlukan untuk verifikasi
* Daftar persyaratan asli yang harus dibawa ke sekolah
* Area tanda tangan/verifikasi

Status verifikasi tidak ditampilkan pada bukti pendaftaran.

Bukti pendaftaran yang sudah dibuat tidak digunakan untuk membuat ulang dokumen berdasarkan perubahan status verifikasi.

---

# 22. Upload Logo

Logo yang digunakan pada bukti pendaftaran dikonfigurasi melalui menu template bukti pendaftaran pada panel admin.

Pastikan file logo memiliki format yang didukung, misalnya:

```text
PNG
JPG
JPEG
SVG
```

Setelah upload logo, lakukan pengecekan dengan membuat satu contoh bukti pendaftaran.

---

# 23. Cek Status Pendaftaran

Halaman publik **Cek Status Pendaftaran** digunakan untuk peserta memeriksa status pendaftarannya.

Data yang diperlukan:

```text
Nomor Pendaftaran
NIK
```

Peserta tidak perlu login.

Sistem hanya menampilkan data milik pendaftar yang sesuai dengan kombinasi data tersebut.

---

# 24. Pengumuman

Halaman **Pengumuman** merupakan halaman publik.

Halaman tersebut menampilkan daftar pendaftar sesuai konfigurasi sistem.

Data publik yang ditampilkan:

1. Nomor Pendaftaran
2. Nama Peserta
3. Jalur Pendaftaran
4. Status

Data pribadi lainnya tidak ditampilkan pada halaman pengumuman.

---

# 25. Status Pendaftaran

Status pendaftaran yang digunakan:

```text
Belum Verifikasi
Verifikasi
Diterima
Tidak Diterima
```

### Belum Verifikasi

Pendaftaran sudah masuk tetapi belum selesai diverifikasi oleh admin/panitia.

### Verifikasi

Data/dokumen pendaftaran sedang atau sudah melalui proses verifikasi sesuai mekanisme aplikasi.

### Diterima

Peserta dinyatakan diterima.

### Tidak Diterima

Peserta dinyatakan tidak diterima.

Jika periode/pengumuman telah melewati batas yang ditentukan dan pendaftaran masih berstatus **Belum Verifikasi**, sistem dapat mengubah status sesuai aturan bisnis aplikasi.

---

# 26. Konfigurasi Production

Untuk production, pastikan:

```env
APP_ENV=production
APP_DEBUG=false
```

Jangan menggunakan:

```env
APP_DEBUG=true
```

pada server yang dapat diakses publik karena dapat menampilkan informasi sensitif aplikasi.

Setelah perubahan `.env`:

```bash
php artisan config:clear
php artisan config:cache
```

---

# 27. Pemeriksaan Setelah Instalasi

Setelah instalasi selesai, lakukan pemeriksaan berikut.

### Aplikasi

```bash
curl -I http://localhost:8000
```

### Laravel

```bash
php artisan about
```

### Database

```bash
php artisan migrate:status
```

### Storage

```bash
php artisan storage:link
```

### Docker

```bash
docker compose ps
```

### Log Laravel

```bash
tail -f storage/logs/laravel.log
```

Jika menggunakan container:

```bash
docker logs -f spmb-sdn21-mataram
```

---

# 28. Troubleshooting

## A. Container tidak berjalan

Periksa:

```bash
docker compose ps
```

Kemudian:

```bash
docker compose logs
```

Atau khusus container aplikasi:

```bash
docker logs spmb-sdn21-mataram
```

---

## B. Database tidak dapat terhubung

Periksa `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=spmb
DB_USERNAME=spmb
DB_PASSWORD=********
```

Kemudian:

```bash
php artisan config:clear
```

Coba:

```bash
php artisan migrate:status
```

---

## C. Error permission

Jalankan:

```bash
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

Kemudian:

```bash
php artisan cache:clear
```

---

## D. Perubahan Blade tidak terlihat

Jalankan:

```bash
php artisan view:clear
php artisan cache:clear
```

Jika menggunakan konfigurasi production:

```bash
php artisan optimize:clear
```

Kemudian refresh browser.

---

## E. Perubahan konfigurasi `.env` tidak terbaca

Jalankan:

```bash
php artisan optimize:clear
```

Kemudian:

```bash
php artisan config:cache
```

---

## F. Livewire mengalami masalah

Bersihkan cache:

```bash
php artisan optimize:clear
```

Pastikan asset Livewire tersedia.

Periksa:

```bash
php artisan about
```

Kemudian periksa log:

```bash
tail -f storage/logs/laravel.log
```

Jika masalah muncul di browser, periksa:

```text
Browser → Developer Tools → Console
```

dan:

```text
Browser → Developer Tools → Network
```

---

# 29. Update Aplikasi

Sebelum melakukan update production, lakukan backup database.

Masuk ke direktori project:

```bash
cd /home/sdn21mataram/spmb-sdn21-mataram
```

Ambil perubahan terbaru:

```bash
git pull
```

Kemudian rebuild container:

```bash
docker compose up -d --build
```

Masuk ke container:

```bash
docker exec -it spmb-sdn21-mataram bash
```

Jalankan:

```bash
composer install --no-dev --optimize-autoloader
```

Kemudian:

```bash
php artisan migrate
```

Bersihkan cache:

```bash
php artisan optimize:clear
```

Kemudian cache production:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Jika terdapat perubahan frontend:

```bash
npm install
npm run build
```

---

# 30. Backup Database

Karena aplikasi menyimpan data pendaftaran murid, backup database harus dilakukan secara berkala.

Contoh PostgreSQL:

```bash
pg_dump -U spmb -d spmb > spmb-backup.sql
```

Jika PostgreSQL berjalan dalam Docker:

```bash
docker exec -t postgres \
pg_dump -U spmb spmb > spmb-backup.sql
```

Nama container database harus disesuaikan dengan konfigurasi Docker.

Simpan backup di lokasi yang aman.

---

# 31. Restore Database

Untuk restore:

```bash
psql -U spmb -d spmb < spmb-backup.sql
```

Jika PostgreSQL berjalan di Docker:

```bash
cat spmb-backup.sql | docker exec -i postgres \
psql -U spmb -d spmb
```

Pastikan database tujuan sudah tersedia.

---

# 32. Keamanan Production

Beberapa hal yang wajib diperhatikan:

* Jangan commit `.env`.
* Jangan membagikan password database.
* Gunakan `APP_DEBUG=false`.
* Gunakan password administrator yang kuat.
* Lakukan backup database secara berkala.
* Batasi akses panel admin.
* Gunakan HTTPS jika aplikasi diakses melalui internet.
* Jangan memberikan permission `777` tanpa alasan.
* Jangan menjalankan `migrate:fresh` pada production.
* Jangan menghapus database production tanpa backup.

---

# 33. Deployment Menggunakan Docker

Deployment yang direkomendasikan:

```text
Internet
   │
   ▼
Reverse Proxy / HTTPS
   │
   ▼
SPMB Laravel
   │
   ├── PHP 8.5
   ├── Apache
   └── Livewire
          │
          ▼
      PostgreSQL
```

Port aplikasi dapat dipetakan melalui Docker Compose.

Contoh:

```text
Host : 8000
Container : 80
```

Sehingga:

```text
http://SERVER-IP:8000
```

mengarah ke Apache di dalam container.

---

# 34. Perintah Laravel yang Sering Digunakan

Masuk ke container:

```bash
docker exec -it spmb-sdn21-mataram bash
```

Cek versi Laravel:

```bash
php artisan --version
```

Cek informasi aplikasi:

```bash
php artisan about
```

Cek migration:

```bash
php artisan migrate:status
```

Bersihkan cache:

```bash
php artisan optimize:clear
```

Cache production:

```bash
php artisan optimize
```

Cek route:

```bash
php artisan route:list
```

Cek konfigurasi:

```bash
php artisan config:show database
```

---

# 35. Alur Instalasi Singkat

Untuk instalasi server baru, urutan yang direkomendasikan:

```bash
git clone https://github.com/adryfia-sudo/spmb-sdn21-mataram.git

cd spmb-sdn21-mataram

cp .env.example .env

nano .env

docker compose up -d --build

docker exec -it spmb-sdn21-mataram bash

composer install --no-dev --optimize-autoloader

php artisan key:generate

php artisan migrate --seed

php artisan storage:link

php artisan optimize:clear

exit

docker compose ps
```

Kemudian buka:

```text
http://SERVER-IP:8000
```

dan lakukan konfigurasi awal melalui panel admin.

---

# 36. Checklist Instalasi

Gunakan checklist berikut setelah deployment.

### Server

* [ ] Ubuntu Server siap
* [ ] Docker terpasang
* [ ] Docker Compose tersedia
* [ ] Repository berhasil di-clone

### Laravel

* [ ] `.env` sudah dikonfigurasi
* [ ] `APP_KEY` sudah tersedia
* [ ] `APP_DEBUG=false`
* [ ] Composer dependency terpasang
* [ ] Migration berhasil
* [ ] Seeder berhasil
* [ ] Storage link berhasil
* [ ] Permission storage benar

### Database

* [ ] PostgreSQL berjalan
* [ ] Database berhasil terhubung
* [ ] Migration berhasil
* [ ] Backup database tersedia

### Admin

* [ ] User administrator tersedia
* [ ] Tahun akademik dikonfigurasi
* [ ] Periode pendaftaran dikonfigurasi
* [ ] Jalur pendaftaran dikonfigurasi
* [ ] Persyaratan dikonfigurasi
* [ ] Template bukti pendaftaran dikonfigurasi
* [ ] Logo sekolah tersedia
* [ ] Logo Kota Mataram tersedia

### Pengujian

* [ ] Halaman `/daftar` dapat dibuka
* [ ] Pendaftaran baru berhasil
* [ ] Validasi NIK berjalan
* [ ] Upload dokumen berjalan
* [ ] Bukti pendaftaran dapat dibuat
* [ ] Logo tampil pada bukti pendaftaran
* [ ] Persyaratan yang harus dibawa tampil pada bukti pendaftaran
* [ ] Cek status pendaftaran berjalan
* [ ] Halaman pengumuman berjalan
* [ ] Status pendaftaran tampil sesuai aturan
* [ ] Panel admin dapat digunakan

---

# 37. Catatan

Aplikasi ini dibuat untuk mendukung proses Penerimaan Murid Baru pada:

**SD Negeri 21 Mataram**

Konfigurasi data seperti tahun akademik, periode pendaftaran, jalur pendaftaran, persyaratan, template bukti pendaftaran, dan status pendaftaran sebaiknya dilakukan melalui panel administrasi dan tidak diubah langsung pada source code apabila sudah tersedia pengaturannya di dalam aplikasi.
