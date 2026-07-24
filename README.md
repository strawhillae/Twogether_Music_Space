<img width="960" height="600" alt="login" src="https://github.com/user-attachments/assets/030b7d1d-e966-485f-84e9-1dd82de64717" /><div align="center">

# 🎙️ Twogether Hub

### Sistem Booking Studio Recording & Residence Berbasis Web

</div>

---

Twogether Hub adalah aplikasi web berbasis **Laravel 13** untuk manajemen **penyewaan (booking) studio** — mendukung studio bertipe *Recording* dan *Residence*. Aplikasi ini memiliki dua peran pengguna (**Admin** dan **User**), alur pemesanan lengkap (pilih studio → booking → pembayaran → verifikasi → struk), serta REST API sederhana untuk data studio.

## ✨ Fitur Utama

- **Autentikasi** — Register, Login, Logout, Reset/Konfirmasi Password (Laravel Breeze)
- **Verifikasi Email** — Scaffolding verifikasi email bawaan Breeze (lihat catatan pada bagian *Known Issues*)
- **Login Google (Socialite)** — Package `laravel/socialite` sudah terpasang (lihat catatan pada bagian *Known Issues*)
- **Dashboard** berbeda untuk Admin dan User
- **Manajemen Studio (CRUD)** — tambah, lihat, ubah, hapus data studio beserta foto
- **Manajemen Fasilitas (CRUD)**
- **Booking Studio** — pengecekan bentrok jadwal otomatis, status Pending/Disetujui/Ditolak/Selesai
- **Pembayaran & Verifikasi Pembayaran** oleh Admin
- **Export PDF Struk Booking** (menggunakan `barryvdh/laravel-dompdf`)
- **REST API Studio** (`/api/studios`) — CRUD studio via JSON
- **Hak Akses Admin vs User** — middleware `admin` khusus rute `/admin/*`
- **Tampilan Responsive** — Tailwind CSS + Alpine.js

## 👤 Identitas Pengembang

| Item | Keterangan |
|---|---|
| Nama | Deshinta Putri Adilla |
| NIM | 240170099 |
|

---

## 🛠️ Tech Stack

- **Backend**: PHP 8.3, Laravel 13
- **Frontend**: Blade, Tailwind CSS, Alpine.js, Vite
- **Database**: SQLite (default) — bisa diganti ke MySQL
- **Autentikasi**: Laravel Breeze
- **Login Sosial**: Laravel Socialite (Google)
- **PDF**: barryvdh/laravel-dompdf
- **Testing**: Pest PHP

---

## 🚀 Cara Instalasi & Menjalankan Aplikasi

### 1. Prasyarat
- PHP >= 8.3
- Composer
- Node.js & NPM
- Ekstensi PHP: `pdo_sqlite` (atau `pdo_mysql` jika pakai MySQL), `mbstring`, `openssl`, `fileinfo`

### 2. Clone / Extract Project
```bash
git clone <url-repo-anda>.git twogether-hub
cd twogether-hub
```

### 3. Install Dependency PHP & JS
```bash
composer install
npm install
```

### 4. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Buka file `.env` dan sesuaikan konfigurasi berikut:

```env
DB_CONNECTION=sqlite

# Jika ingin memakai MySQL, ubah menjadi:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=twogether_hub
# DB_USERNAME=root
# DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS="hello@twogetherhub.test"
MAIL_FROM_NAME="${APP_NAME}"

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

> Jika menggunakan SQLite, buat dulu file database-nya (biasanya sudah ada di `database/database.sqlite`, jika belum ada jalankan):
> ```bash
> touch database/database.sqlite
> ```

### 5. Migrasi & Seeder Database
```bash
php artisan migrate --seed
```

Untuk membuat **akun Admin**, jalankan Tinker lalu update role user menjadi `admin`:
```bash
php artisan tinker
```
```php
$user = App\Models\User::first();
$user->role = 'admin';
$user->email_verified_at = now();
$user->save();
```

### 6. Build Asset Frontend
```bash
npm run build
# atau untuk mode development:
npm run dev
```

### 7. Jalankan Aplikasi
```bash
php artisan serve
```
Aplikasi dapat diakses melalui: `http://127.0.0.1:8000`

Atau jalankan sekaligus server + queue + vite dengan satu perintah:
```bash
composer run dev
```

### 8. Storage Link (untuk foto studio/profil)
```bash
php artisan storage:link
```

---

## 🔑 Akun Demo

| Role | Email | Password |
|---|---|---|
| User | `whitneyatha@gmail.com` | `yoojimin` |
| Admin | deshintaadilla@gmail.com | leedonghyuck |

> Aplikasi ini belum memiliki seeder khusus untuk akun Admin, sehingga akun Admin perlu dibuat manual seperti pada instruksi instalasi di atas.

---

## 📡 Dokumentasi REST API

Base URL: `http://127.0.0.1:8000/api`

| Method | Endpoint | Deskripsi |
|---|---|---|
| GET | `/api/studios` | Menampilkan seluruh data studio |
| GET | `/api/studios/{id}` | Menampilkan detail 1 studio |
| POST | `/api/studios` | Menambah studio baru |
| PUT | `/api/studios/{id}` | Mengubah data studio |
| DELETE | `/api/studios/{id}` | Menghapus studio |

Contoh body request `POST /api/studios`:
```json
{
  "nama_studio": "Studio A",
  "jenis": "Recording",
  "harga": 150000,
  "kapasitas": 5,
  "deskripsi": "Studio rekaman full peralatan",
  "status": "Tersedia"
}
```

File koleksi Postman dapat disimpan di `docs/postman/TwogetherHub.postman_collection.json` (export koleksi Anda dari Postman lalu simpan di path tersebut agar terdokumentasi bersama repo).

---

## 📸 Dokumentasi Screenshot

> Bagian ini berisi bukti visual bahwa fitur telah berjalan. **Screenshot di bawah adalah placeholder** — silakan jalankan aplikasi sesuai instruksi di atas, lalu ganti setiap placeholder dengan tangkapan layar asli dari aplikasi Anda (simpan file gambar di folder `docs/screenshots/`, lalu sesuaikan nama filenya jika perlu).

### 1. Halaman Login / Autentikasi
`docs/screenshots/01-login.png`

![Login](dosc/screenshots/login/login.png)

### 2. Verifikasi Email / Google Login
`docs/screenshots/02-verifikasi-email.png`

![Verifikasi Email](docs/screenshots/02-verifikasi-email.png)

> ⚠️ **Catatan penting**: lihat bagian [Known Issues](#-known-issues--catatan-pengembangan) di bawah — fitur ini perlu konfigurasi tambahan sebelum bisa didemokan.

### 3. Dashboard
- Dashboard User: `docs/screenshots/03-dashboard-user.png`
- Dashboard Admin: `docs/screenshots/03-dashboard-admin.png`

![Dashboard User](docs/screenshots/03-dashboard-user.png)
![Dashboard Admin](docs/screenshots/03-dashboard-admin.png)

### 4. CRUD (Studio / Fasilitas / Booking)
- Daftar Studio: `docs/screenshots/04-crud-studio-index.png`
- Form Tambah Studio: `docs/screenshots/04-crud-studio-create.png`
- Form Edit Studio: `docs/screenshots/04-crud-studio-edit.png`
- Daftar Fasilitas: `docs/screenshots/04-crud-fasilitas.png`

![CRUD Studio](docs/screenshots/04-crud-studio-index.png)

### 5. REST API (Pengujian di Postman)
- GET semua studio: `docs/screenshots/05-postman-get-all.png`
- GET satu studio: `docs/screenshots/05-postman-get-one.png`
- POST tambah studio: `docs/screenshots/05-postman-post.png`
- PUT update studio: `docs/screenshots/05-postman-put.png`
- DELETE studio: `docs/screenshots/05-postman-delete.png`

![Postman GET](docs/screenshots/05-postman-get-all.png)

### 6. Pemisahan Hak Akses Admin dan User
- Menu/Sidebar Admin: `docs/screenshots/06-akses-admin.png`
- Menu/Sidebar User: `docs/screenshots/06-akses-user.png`
- Percobaan akses `/admin` oleh User biasa (ditolak): `docs/screenshots/06-akses-ditolak.png`

![Akses Admin vs User](docs/screenshots/06-akses-admin.png)

### 7. Tampilan Responsive
- Desktop: `docs/screenshots/07-responsive-desktop.png`
- Mobile: `docs/screenshots/07-responsive-mobile.png`

![Responsive Desktop](docs/screenshots/07-responsive-desktop.png)
![Responsive Mobile](docs/screenshots/07-responsive-mobile.png)

### 8. Hasil Export PDF Struk Booking
`docs/screenshots/08-export-pdf-struk.png`

![Export PDF](docs/screenshots/08-export-pdf-struk.png)

> Catatan: struk PDF hanya bisa diunduh setelah status booking menjadi **"Selesai"** (pembayaran sudah diverifikasi Admin). Fitur export ini menghasilkan **PDF**; belum ada fitur export ke **Excel** pada versi kode saat ini.

---

## ⚠️ Known Issues / Catatan Pengembangan

Beberapa hal berikut ditemukan saat meninjau kode dan perlu diperhatikan sebelum melakukan demo/dokumentasi, agar screenshot yang dilampirkan benar-benar mencerminkan fitur yang berjalan:

1. **Login Google belum aktif** — package `laravel/socialite` sudah terpasang dan `GoogleController` sudah direferensikan di `routes/web.php`, namun file controller-nya, rute `/auth/google`, serta kredensial di `config/services.php` **belum diimplementasikan**. Perlu ditambahkan terlebih dahulu sebelum fitur ini bisa didemokan.
2. **Verifikasi email belum wajib (belum enforced)** — tampilan dan rute verifikasi email dari Laravel Breeze sudah tersedia, tetapi model `App\Models\User` belum meng-implementasikan interface `Illuminate\Contracts\Auth\MustVerifyEmail`, sehingga middleware `verified` belum benar-benar memaksa user memverifikasi email sebelum masuk dashboard. Tambahkan `implements MustVerifyEmail` pada model `User` bila fitur ini wajib didemokan.
3. **Export Excel** belum tersedia di kode (hanya export PDF struk booking).

---

## 📁 Struktur Direktori Penting

```
app/Http/Controllers/
├── Admin/                # Controller khusus admin (Dashboard, Profile)
├── Api/                  # Controller REST API (StudioApiController)
├── Auth/                 # Controller autentikasi bawaan Breeze
├── BookingController.php
├── StudioController.php
├── FacilityController.php
├── PaymentController.php
└── ReceiptController.php # Export PDF struk

app/Models/
├── User.php
├── Studio.php
├── Facility.php
└── Booking.php

resources/views/
├── admin/                # View untuk role admin
├── user/                 # View untuk role user
├── auth/                 # Login, register, verifikasi email
└── receipt/pdf.blade.php # Template struk PDF
```

---

## 🧪 Menjalankan Test

```bash
php artisan test
```
