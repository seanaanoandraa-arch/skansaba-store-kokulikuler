<?php
require_once 'config/functions.php';
$pageTitle = 'Katalog Produk';
$activePage = 'catalog';
$q = trim($_GET['q'] ?? '');
$cat = $_GET['kategori'] ?? 'Semua';
$sql = "SELECT * FROM products WHERE name LIKE ?";
$params = ['%' . $q . '%'];
if ($cat !== 'Semua') {
    $sql .= " AND category=?";
    $params[] = $cat;
}
$sql .= " ORDER BY name";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
include 'includes/header.php';
?>
<main class="container page-main">
    <div class="page-title"><span class="eyebrow">TEMUKAN KEBUTUHANMU</span>
        <h1>Katalog Produk</h1>
        <p>Pilih produk kebutuhan yang anda butuhkan.</p>
    </div>
    <form class="catalog-tools" method="get"><input name="q" type="search" value="<?= e($q) ?>"
            placeholder="Cari nama produk..."><select name="kategori">
            <option <?= $cat === 'Semua' ? 'selected' : '' ?>>Semua</option>
            <?php foreach (['Makanan', 'Minuman', 'Kebutuhan Rumah Tangga'] as $c): ?>
                <option <?= $cat === $c ? 'selected' : '' ?>><?= e($c) ?></option><?php endforeach; ?>
        </select><button class="btn btn-brown">Cari</button></form>
    <div class="product-grid"><?php if (!$products): ?>
            <div class="empty-state">Produk tidak ditemukan.</div><?php endif; ?>
        <?php foreach ($products as $p): ?>
            <article class="product-card">
                <div class="product-art"><img src="<?= e($p['image']) ?>" alt="<?= e($p['name']) ?>"></div><span
                    class="product-category"><?= e($p['category']) ?></span>
                <h3><?= e($p['name']) ?></h3>
                <div class="price"><?= rupiah($p['price']) ?></div>
                <p>Stok: <?= (int) $p['stock'] ?></p>
                <form method="post" action="keranjang.php"><?= csrf_field() ?><input type="hidden" name="action"
                        value="add"><input type="hidden" name="product_id" value="<?= $p['id'] ?>"><button
                        class="btn btn-mint" <?= $p['stock'] < 1 ? 'disabled' : '' ?>><?= $p['stock'] < 1 ? 'Stok Habis' : 'Pesan Sekarang' ?></button></form>
            </article><?php endforeach; ?>
    </div>
</main>
<?php include 'includes/footer.php'; ?>