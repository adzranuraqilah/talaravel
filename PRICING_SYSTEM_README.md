# Sistem Estimasi Harga Konveksi

## Overview
Sistem ini menyediakan database dan interface admin untuk mengelola data harga produk konveksi dengan fitur CRUD lengkap.

## Struktur Database

### Tabel `produks`
- `id` - Primary key
- `nama_produk` - Jenis produk (kaos, hoodie, almamater, kemeja, jaket)
- `jenis_bahan` - Jenis bahan (cotton_combed, polyester, fleece, dll)
- `warna_bahan` - Warna bahan
- `ukuran` - JSON array ukuran yang tersedia
- `sablon` - Jenis sablon
- `jumlah_warna_sablon` - Jumlah warna sablon
- `model_jahitan` - Model jahitan
- `waktu_pengerjaan` - Waktu pengerjaan
- `tambahan_lain` - JSON array tambahan
- `harga` - Harga dasar produk
- `created_at`, `updated_at` - Timestamps

### Tabel `settings` (Pengaturan Harga)
- `sablon_pricing` - JSON harga sablon
- `additional_costs` - JSON biaya tambahan
- `quantity_discounts` - JSON pengaturan diskon kuantitas
- `express_pricing` - JSON pengaturan layanan express
- `working_time_settings` - JSON pengaturan waktu pengerjaan

## Data Harga yang Diimplementasikan

### Daftar Harga Produk
- **Kaos Katun Combed**: Rp 37.000
- **Kaos Polyester**: Rp 27.000
- **Kaos Katun Bamboo**: Rp 42.000
- **Kaos Supima**: Rp 52.000
- **Hoodie Fleece**: Rp 122.000
- **Hoodie Babyterry**: Rp 97.000
- **Hoodie Wol**: Rp 77.000
- **Almamater Drill**: Rp 102.000
- **Almamater Nagata Drill**: Rp 122.000
- **Kemeja Katun**: Rp 57.000
- **Kemeja Linen**: Rp 62.000
- **Kemeja Silk**: Rp 72.000
- **Kemeja Oxford**: Rp 60.000
- **Kemeja Rayon**: Rp 54.000
- **Kemeja Drill**: Rp 59.000
- **Kemeja Polyester**: Rp 52.000
- **Jaket Kanvas**: Rp 157.000
- **Jaket Nilon**: Rp 82.000
- **Jaket Fleece**: Rp 137.000
- **Jaket Lotto**: Rp 122.000
- **Jaket Windbraker**: Rp 157.000

### Jenis Sablon
- **Plastisol**: Rp 20.000
- **Rubber**: Rp 15.000
- **DTG**: Rp 30.000
- **Bordir**: Rp 15.000 (max 3 patch)

### Biaya Tambahan
- **Hangtag**: Rp 500
- **Woven**: Rp 500
- **Label Brand Sablon**: Rp 1.000

### Diskon Kuantitas
- Minimal pembelian: 24 pcs
- Diskon: Rp 5.000 per 100 pcs

### Layanan Express
- Biaya: Rp 10.000 per pcs
- Pengurangan waktu: 1 minggu

### Waktu Pengerjaan
- **Kaos**: 2 minggu
- **Hoodie**: 2 minggu
- **Kemeja**: 3 minggu
- **Almamater**: 3 minggu
- **Jaket**: 2 minggu

## Fitur Admin

### 1. Manajemen Produk (`/admin/produk`)
- **View**: Daftar semua produk dengan filter dan search
- **Create**: Tambah produk baru
- **Update**: Edit produk existing
- **Delete**: Hapus produk

### 2. Pengaturan Harga (`/admin/pricing-settings`)
- **Harga Sablon**: Plastisol, Rubber, DTG, Bordir
- **Biaya Tambahan**: Hangtag, Woven, Label Brand
- **Diskon Kuantitas**: Minimal quantity, discount per 100
- **Layanan Express**: Biaya per pcs, pengurangan waktu
- **Waktu Pengerjaan**: Per jenis produk dan pengaturan kuantitas besar

## Cara Setup

### 1. Jalankan Migrasi
```bash
php artisan migrate
```

### 2. Jalankan Seeder
```bash
php artisan db:seed --class=ProdukPriceSeeder
php artisan db:seed --class=PricingSettingsSeeder
```

### Atau gunakan script otomatis:
```bash
php setup_pricing_database.php
```

## API Endpoints

### Estimasi Harga
- `POST /estimasi-harga` - Hitung estimasi harga
- `GET /jenis-produk` - Daftar jenis produk
- `GET /bahan/{jenisProduk}` - Daftar bahan berdasarkan produk
- `GET /warna/{jenisProduk}/{jenisBahan}` - Daftar warna berdasarkan bahan

### Admin Routes
- `GET /admin/produk` - Daftar produk
- `GET /admin/produk-tambah` - Form tambah produk
- `POST /admin/produk` - Simpan produk baru
- `GET /admin/produk/{id}/edit` - Form edit produk
- `PUT /admin/produk/{id}` - Update produk
- `DELETE /admin/produk/{id}` - Hapus produk
- `GET /admin/pricing-settings` - Pengaturan harga
- `PUT /admin/pricing-settings` - Update pengaturan harga

## Algoritma Perhitungan Harga

1. **Harga Dasar**: Ambil dari database berdasarkan jenis produk dan bahan
2. **Harga Sablon**: Tambahkan sesuai jenis sablon yang dipilih
3. **Jumlah Warna**: 
   - 1-4 warna: Rp 20.000
   - >4 warna: Rp 25.000-30.000 (rata-rata 27.500)
4. **Biaya Tambahan**: Tambahkan sesuai item yang dipilih
5. **Layanan Express**: +Rp 10.000 per pcs jika dipilih
6. **Diskon Kuantitas**: 
   - Jika >24 pcs: Diskon Rp 5.000 per 100 pcs
7. **Total Final**: Harga per item × kuantitas - diskon

## Struktur File

### Controllers
- `EstimasiHargaController.php` - Logika perhitungan estimasi
- `AdminProdukController.php` - CRUD produk
- `AdminPricingController.php` - Pengaturan harga

### Models
- `Produk.php` - Model produk
- `Setting.php` - Model pengaturan

### Views
- `admin/produk.blade.php` - Daftar produk
- `admin/produk-tambah.blade.php` - Form tambah produk
- `admin/produk-edit.blade.php` - Form edit produk
- `admin/pricing-settings.blade.php` - Pengaturan harga

### Seeders
- `ProdukPriceSeeder.php` - Data harga produk
- `PricingSettingsSeeder.php` - Pengaturan sistem harga

## Fitur Tambahan

### Filter dan Search
- Filter berdasarkan jenis produk
- Filter berdasarkan range harga
- Search berdasarkan nama, bahan, warna
- Tampilan jumlah hasil

### Responsive Design
- Mobile-friendly interface
- Grid layout yang adaptif
- Form validation

### Data Validation
- Validasi input harga (numeric)
- Validasi kuantitas (minimal 1)
- Validasi ukuran (array)
- Validasi tambahan (array)

## Keamanan

- CSRF protection pada semua form
- Admin middleware untuk akses admin
- Validasi input server-side
- Sanitasi data sebelum disimpan

## Maintenance

### Backup Data
```bash
php artisan db:backup
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Update Harga
1. Akses `/admin/pricing-settings`
2. Update nilai yang diinginkan
3. Klik "Simpan Pengaturan"

### Tambah Produk Baru
1. Akses `/admin/produk-tambah`
2. Isi form dengan data produk
3. Klik "Simpan Produk" 