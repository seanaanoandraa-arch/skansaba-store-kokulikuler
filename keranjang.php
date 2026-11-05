<?php
require_once 'config/functions.php';
check_csrf();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int) ($_POST['product_id'] ?? 0);
  $action = $_POST['action'] ?? '';
  $stmt = $pdo->prepare("SELECT id,stock FROM products WHERE id=?");
  $stmt->execute([$id]);
  $p = $stmt->fetch();
  if ($action === 'add' && $p && $p['stock'] > 0) {
    $_SESSION['cart'][$id] = min(($_SESSION['cart'][$id] ?? 0) + 1, (int) $p['stock']);
    flash('Produk ditambahkan ke keranjang.');
  }
  if ($action === 'change' && $p) {
    $qty = (int) ($_POST['qty'] ?? 1);
    if ($qty <= 0)
      unset($_SESSION['cart'][$id]);
    else
      $_SESSION['cart'][$id] = min($qty, (int) $p['stock']);
  }
  if ($action === 'remove')
    unset($_SESSION['cart'][$id]);
  if ($action === 'checkout') {
    header('Location: checkout.php');
    exit;
  }
  header('Location: keranjang.php');
  exit;
}
$cart = $_SESSION['cart'] ?? [];
$items = [];
$total = 0;
if ($cart) {
  $ids = array_keys($cart);
  $marks = implode(',', array_fill(0, count($ids), '?'));
  $st = $pdo->prepare("SELECT * FROM products WHERE id IN ($marks)");
  $st->execute($ids);
  $items = $st->fetchAll();
}
$pageTitle = 'Keranjang';
include 'includes/header.php';
?>
<main class="container page-main">
  <div class="page-title"><span class="eyebrow">PESANANMU</span>
    <h1>Keranjang Belanja</h1>
    <p>Periksa kembali produk sebelum melakukan pemesanan.</p>
  </div>
  <?php if (!$items): ?>
    <div class="empty-state"><img src="assets/images/keranjang.png" alt="Keranjang kosong" class="empty-cart-img">
      <h2>Keranjang masih kosong</h2>
      <p>Yuk, pilih kebutuhanmu.</p><a class="btn btn-brown" href="katalog.php">Lihat Katalog</a>
    </div>
  <?php else: ?>
    <div class="cart-items">
      <?php foreach ($items as $p):
        $qty = (int) $cart[$p['id']];
        $subtotal = $qty * $p['price'];
        $total += $subtotal; ?>
        <div class="cart-row">
          <div><b><?= e($p['name']) ?></b>
            <div class="product-category"><?= rupiah($p['price']) ?> / Per item</div>
          </div>
          <form method="post" class="qty-form"><?= csrf_field() ?><input type="hidden" name="action" value="change"><input
              type="hidden" name="product_id" value="<?= $p['id'] ?>"><input type="number" min="0" max="<?= $p['stock'] ?>"
              name="qty" value="<?= $qty ?>" style="width:65px"><button class="qty-btn">Ubah</button></form>
          <b><?= rupiah($subtotal) ?></b>
          <form method="post"><?= csrf_field() ?><input type="hidden" name="action" value="remove"><input type="hidden"
              name="product_id" value="<?= $p['id'] ?>"><button class="btn btn-outline">Hapus</button></form>
        </div><?php endforeach; ?>
    </div>
    <div class="cart-total"><span>Total Pembayaran</span><strong><?= rupiah($total) ?></strong><a
        class="btn btn-brown full" href="checkout.php">Buat Pesanan</a></div><?php endif; ?>
</main>
<?php include 'includes/footer.php'; ?>