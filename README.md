# 📦 Sistem Manajemen Paket Santri – Thursina Test Project

Ini adalah proyek uji coba pengembangan sistem Laravel untuk keperluan pengelolaan paket santri di lembaga pendidikan Thursina. Sistem ini mencakup manajemen data santri, paket masuk dan keluar, laporan, serta otorisasi berbasis role.

Proyek ini dirancang untuk menguji keterampilan saya dalam menggunakan Laravel dalam pengembangan aplikasi berbasis web dengan fitur-fitur seperti manajemen data pengguna, transaksi, laporan dinamis, serta manajemen role dan akses. Sistem ini juga menunjukkan pemahaman saya terhadap pengelolaan database, autentikasi, dan pengolahan data menggunakan Laravel.

---

## 🎯 Fitur Utama

### 1. 📊 Dashboard
- Grafik Paket Masuk (Harian, Mingguan, Bulanan, Tahunan)
- Grafik Kategori Paket (Makanan Basah, Makanan Kering, Non Makanan)
- 5 Daftar Paket Terbaru (tombol *View All*)
- Jumlah Paket Belum Diambil
- Jumlah Paket Disita

### 2. 🗂 Master Management
- CRUD Asrama
- CRUD Kategori Paket

### 3. 📦 Transaksi Paket
- List Paket Masuk (Search + Export Excel)
- List Paket Keluar (Search + Export Excel)
- Edit Data Paket Masuk dan Keluar
- Tambah Data Paket Masuk

### 4. 📑 Laporan Management
- Laporan Paket Masuk dan Keluar (Harian, Mingguan, Bulanan, Tahunan)
- Filter berdasarkan rentang tanggal
- Laporan Kategori Paket Masuk
- Laporan Paket Disita

### 5. 👥 User Management

#### ✅ Santri
- List Santri (Search + Export Excel)
- Detail Santri (PDF)
- Edit Data
- Tambah Santri (opsional: Import Excel)

#### ✅ User
- List User (Search + Export Excel)
- Detail dan Edit User

---

## 🔐 Role & Permission Management

Menggunakan **Spatie Laravel Permission** untuk manajemen Role dan Akses:

- Role: Admin, Petugas, Santri
- Akses menu dan fitur berdasarkan role

---

## 🧭 Menu Management

- Sistem manajemen menu dinamis sesuai hak akses role user

---

## 🛠 Teknologi yang Digunakan

- Laravel Framework
- Laravel Breeze / Fortify
- Spatie Permission
- Laravel Excel (Maatwebsite)
- Chart.js / ApexCharts
- DOMPDF (PDF Export)
- Bootstrap + SB Admin 2 Template

---

## 🚀 Instalasi & Setup

```bash
git clone https://github.com/yourusername/paket-santri.git
cd paket-santri
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install && npm run dev # jika menggunakan Mix/Vite
```

## ⚙️ Konfigurasi .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paket_santri
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=admin@paketsantri.test
MAIL_FROM_NAME="Sistem Paket Santri"
```

## 🛡️ Backup & Restore Sistem
Untuk memastikan data aplikasi tetap aman, Anda dapat menggunakan Spatie Laravel Backup untuk membuat cadangan (backup) database dan file-file penting sistem. Berikut adalah cara untuk mengonfigurasi dan menggunakan fitur backup pada proyek ini:

### Menjalankan Backup Secara Manual
Untuk membuat backup secara manual (baik database dan file), Anda dapat menjalankan perintah artisan berikut:
```
php artisan backup:run
```
Jika Anda hanya ingin membuat backup database saja, Anda dapat menambahkan opsi --only-db pada perintah tersebut:

```
php artisan backup:run --only-db
```
Perintah ini akan membuat backup hanya untuk database, sementara file lainnya (seperti file-file media) tidak akan dicadangkan.

### Restore Backup
Untuk me-restore data dari backup, kamu dapat menjalankan perintah berikut:
```
php artisan backup:restore
```
Perintah ini akan mengembalikan backup yang telah dibuat, baik itu untuk database maupun file yang telah dicadangkan.