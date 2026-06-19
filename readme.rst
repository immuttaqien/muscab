# Musyawarah Cabang Pemuda Persis Banjaran

Sistem informasi manajemen anggota dan jamaah untuk organisasi tingkat cabang, dibangun dengan CodeIgniter 3.

## Tech Stack

- **Framework**: CodeIgniter 3
- **Language**: PHP 5.3.7+
- **Database**: MySQL
- **Export**: PHPSpreadsheet (Excel), Dompdf (PDF)
- **API**: CodeIgniter REST Server

## Fitur

- Manajemen anggota (pendaftaran, data diri, NPA)
- Manajemen jamaah
- Data pekerjaan, pendidikan, dan pendapatan anggota
- Data tanggungan anggota
- Pencatatan kehadiran
- Riwayat dan histori aktivitas
- Export data ke Excel dan PDF
- REST API
- Autentikasi admin

## Struktur Proyek

```
application/
├── controllers/    # Controller (Admin, Anggota, Jamaah, Kehadiran, dll.)
├── models/         # Model (M_anggota, M_jamaah, M_kehadiran, dll.)
├── views/          # Tampilan
├── config/         # Konfigurasi aplikasi dan database
├── helpers/        # Helper functions
├── libraries/      # Library tambahan
└── core/           # Override core CodeIgniter
system/             # CodeIgniter framework
vendor/             # Composer dependencies
media/              # File media upload
static/             # Aset statis (CSS, JS, gambar)
```

## Instalasi

**Prasyarat**: PHP 5.6+, MySQL, Composer

```bash
# Clone repository
git clone https://github.com/immuttaqien/muscab.git
cd muscab

# Install dependencies
composer install
```

**Setup database:**

1. Buat database baru di MySQL
2. Import file SQL (jika tersedia di folder database atau docs)
3. Konfigurasi koneksi di `application/config/database.php`:

```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'nama_database',
    'dbdriver' => 'mysqli',
    ...
);
```

**Konfigurasi aplikasi:**

Sesuaikan `application/config/config.php`:

```php
$config['base_url'] = 'http://localhost/muscab/';
```

## Menjalankan Aplikasi

Letakkan folder project di direktori web server (misal: `htdocs` untuk XAMPP) dan akses melalui browser:

```
http://localhost/muscab/
```

## Modul

| Modul | Deskripsi |
|-------|-----------|
| Anggota | Pendataan dan manajemen anggota |
| Jamaah | Data jamaah organisasi |
| Kehadiran | Pencatatan kehadiran anggota |
| Pekerjaan | Data pekerjaan anggota |
| Pendidikan | Riwayat pendidikan anggota |
| Pendapatan | Data pendapatan anggota |
| Tanggungan | Data tanggungan/keluarga anggota |
| NPA | Nomor Pokok Anggota |
| Riwayat | Histori aktivitas |
| Formulir | Manajemen formulir pendaftaran |

## Lisensi

[MIT](license.txt)
