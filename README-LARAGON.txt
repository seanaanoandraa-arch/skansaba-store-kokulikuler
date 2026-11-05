SKANSABA STORE - PHP + MYSQL (LARAGON)

ISI:
- Halaman pembeli: beranda, katalog, keranjang, daftar, login, checkout, riwayat pesanan, tentang, kontak.
- Admin: melihat pesanan dan mengubah status.
- Produk, stok, akun, dan pesanan tersimpan di MySQL.
- Tampilan memakai CSS dan gambar dari ZIP awal.

CARA MENJALANKAN:
1. Ekstrak folder skansaba_laragon ke D:\laragon\www\
2. Buka Laragon, klik Start All.
3. Buka http://localhost/phpmyadmin (atau HeidiSQL dari Laragon).
4. Import file database.sql.
5. Periksa config/database.php. Default Laragon: user root, password kosong.
6. Buka http://localhost/skansaba_laragon/

MEMBUAT AKUN ADMIN:
1. Daftar akun biasa lewat halaman Daftar.
2. Buka phpMyAdmin > database skansaba_store > tabel users.
3. Edit akun yang akan dijadikan admin, ubah kolom role dari buyer menjadi admin.
4. Login kembali. Link Admin akan muncul di navigasi.

CATATAN:
- Keranjang disimpan dalam session browser.
- Checkout wajib login; stok dicek ulang dan dikurangi saat transaksi disimpan.
- Password disimpan menggunakan password_hash(), bukan teks biasa.
- Ini starter project untuk pengembangan lokal. Sebelum dipakai publik, tambahkan HTTPS, kebijakan privasi, validasi lanjutan, dan pengaturan akun admin yang aman.
- Jika MySQL Laragon memakai password khusus, sesuaikan config/database.php.
