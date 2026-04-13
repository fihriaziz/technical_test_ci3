# PT Sentosa Invoice App

Aplikasi CodeIgniter 3 untuk memenuhi requirement pada gambar soal:

- Database MySQL berdasarkan data faktur
- Dashboard admin dengan login
- CRUD master data
- CRUD transaksi faktur header-detail
- Halaman detail faktur menyerupai invoice pada soal

## Fitur

- Login admin
- Dashboard ringkas jumlah data dan daftar faktur terbaru
- CRUD master user
- CRUD master supplier
- CRUD master customer
- CRUD master satuan
- CRUD master produk
- CRUD transaksi faktur dengan item dinamis
- Tampilan detail invoice

## Struktur Database

File SQL tersedia di [database/pt_sentosa.sql](database/pt_sentosa.sql).

Tabel utama:

- users
- suppliers
- customers
- units
- products
- invoices
- invoice_items

## Cara Menjalankan

1. Buat database MySQL lalu import file [database/pt_sentosa.sql](database/pt_sentosa.sql).
2. Sesuaikan koneksi database di [application/config/database.php](application/config/database.php) bila username atau password MySQL berbeda.
3. Jalankan PHP built-in server dari root project:

```bash
php -S localhost:8080
```

4. Buka `http://localhost:8080` di browser.

## Login Default

- Username: `admin`
- Password: `admin123`

## Catatan

- CSRF protection sudah diaktifkan.
- Base URL dibuat dinamis agar mudah dijalankan di local.
- Session disimpan ke temporary directory sistem.
