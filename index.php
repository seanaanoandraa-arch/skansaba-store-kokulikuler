<?php
require_once 'config/functions.php';
$pageTitle = 'Beranda';
$activePage = 'home';
$featured = $pdo->query("SELECT * FROM products ORDER BY id LIMIT 4")->fetchAll();
include 'includes/header.php';
?>
<main>
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-copy"><span class="eyebrow">TOKO RESMI SMKN 1 BANTUL</span>
                <h1>Belanja Kebutuhan Pokok Dan Atribut Sekolah Jadi Lebih Mudah Di Skansaba Store</h1>
                <p>Platform digital resmi unit layanan SMKN 1 Bantul untuk mempermudah akses produk siswa dan sekolah
                    secara cepat dan transparan.</p>
                <div class="hero-buttons"><a class="btn btn-mint" href="katalog.php">Lihat Katalog</a><a
                        class="btn btn-outline" href="kontak.php">Hubungi Kami</a></div>
            </div>
            <div class="hero-art" aria-label="Pilihan produk Skansaba Store">
                <div class="hero-product"><img src="assets/images/chocolatos.jpeg" alt="Produk Chocolatos"></div>
                <div class="hero-product"><img src="assets/images/Indomie.jpeg" alt="Produk Indomie"></div>
                <div class="hero-product"><img src="assets/images/Milku.jpeg" alt="Produk Milku"></div>
                <div class="hero-product"><img src="assets/images/Teh_kotak.jpeg" alt="Produk Teh Kotak"></div>
            </div>
        </div>
    </section>
    <section class="features container">
        <article><span class="feature-icon">01</span>
            <div>
                <h3>Lihat produk lebih mudah</h3>
                <p>Periksa pilihan barang dan harga dalam satu katalog.</p>
            </div>
        </article>
        <article><span class="feature-icon">02</span>
            <div>
                <h3>Pilihan lebih tertata</h3>
                <p>Produk dikelompokkan berdasarkan jenis kebutuhan.</p>
            </div>
        </article>
        <article><span class="feature-icon">03</span>
            <div>
                <h3>Keranjang praktis</h3>
                <p>Atur jumlah barang sebelum membuat pesanan.</p>
            </div>
        </article>
    </section>
    <section class="container featured-section">
        <div class="section-heading"><span class="eyebrow">DARI KATALOG KAMI</span>
            <h2>Produk pilihan</h2>
            <p>Kenali beberapa produk yang tersedia di Skansaba Store.</p>
        </div>
        <div class="product-grid"><?php foreach ($featured as $p): ?>
                <article class="product-card">
                    <div class="product-art"><img src="<?= e($p['image']) ?>" alt="<?= e($p['name']) ?>"></div><span
                        class="product-category"><?= e($p['category']) ?></span>
                    <h3><?= e($p['name']) ?></h3>
                    <div class="price"><?= rupiah($p['price']) ?></div>
                    <form method="post" action="keranjang.php"><?= csrf_field() ?><input type="hidden" name="action"
                            value="add"><input type="hidden" name="product_id" value="<?= $p['id'] ?>"><button
                            class="btn btn-mint" <?= $p['stock'] < 1 ? 'disabled' : '' ?>><?= $p['stock'] < 1 ? 'Stok Habis' : 'Pesan Sekarang' ?></button></form>
                </article><?php endforeach; ?>
        </div>
        <div class="center"><a class="btn btn-brown" href="katalog.php">Lihat Semua Produk</a></div>
    </section>
    <section class="quote-band">
        <div>Belanjakan kebutuhan pokok anda.</div>
    </section>
</main>
<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-school"><img src="assets/images/SMK_Negeri_1_Bantul_logo.png" alt="Logo SMKN 1 Bantul"
                class="crest">
            <div><b>SMKN 1 Bantul</b>
                <p>Jl. Parangtritis No. KM. 11, Dukuh, Sabdodadi, Kec. Bantul, Kabupaten Bantul, Daerah Istimewa
                    Yogyakarta 55715</p>
            </div>
        </div>
        <div><b>Quick Links</b><a href="katalog.php">Layanan Produk</a><a href="kontak.php">Kontak Siswa</a></div>
        <div><b>Informasi</b><a href="tentang.php">Tentang Skansaba Store</a><a href="kontak.php">Informasi kontak</a>
        </div>
        <div><b>Hubungi</b>
            <p>WhatsApp<br><strong>0858 3807 8487</strong></p>
        </div>
    </div>
    <div class="copyright">© 2026 Skansaba Store · Tim Pengembangan Kelas XI RPL 2</div>
</footer>
<script src="assets/js/app.js"></script>
</body>

</html>