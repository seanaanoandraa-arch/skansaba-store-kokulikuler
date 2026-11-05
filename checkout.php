<?php
require_once 'config/functions.php';
require_login();
check_csrf();
$cart = $_SESSION['cart'] ?? [];
if (!$cart) {
    header('Location: keranjang.php');
    exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = trim($_POST['catatan'] ?? '');
    try {
        $pdo->beginTransaction();
        $total = 0;
        $rows = [];
        foreach ($cart as $id => $qty) {
            $st = $pdo->prepare("SELECT * FROM products WHERE id=? FOR UPDATE");
            $st->execute([(int) $id]);
            $p = $st->fetch();
            if (!$p || (int) $p['stock'] < (int) $qty)
                throw new Exception('Stok ' . $p['name'] . ' tidak mencukupi.');
            $total += $p['price'] * $qty;
            $rows[] = [$p, (int) $qty];
        }
        $st = $pdo->prepare("INSERT INTO orders(user_id,total,status,note) VALUES(?,?, 'Menunggu', ?)");
        $st->execute([$_SESSION['user']['id'], $total, $address]);
        $orderId = $pdo->lastInsertId();
        foreach ($rows as [$p, $qty]) {
            $pdo->prepare("INSERT INTO order_items(order_id,product_id,product_name,price,quantity) VALUES(?,?,?,?,?)")->execute([$orderId, $p['id'], $p['name'], $p['price'], $qty]);
            $pdo->prepare("UPDATE products SET stock=stock-? WHERE id=?")->execute([$qty, $p['id']]);
        }
        $pdo->commit();
        unset($_SESSION['cart']);
        flash('Pesanan berhasil dibuat! Nomor pesanan: #' . $orderId);
        header('Location: pesanan-saya.php');
        exit;
    } catch (Throwable $e) {
        if ($pdo->inTransaction())
            $pdo->rollBack();
        $error = $e->getMessage();
    }
}
$pageTitle = 'Konfirmasi Pesanan';
include 'includes/header.php';
?>
<main class="container page-main">
    <div class="page-title">
        <h1>Konfirmasi Pesanan</h1>
        <p>Pastikan detail pesanan sudah benar.</p>
    </div>
    <form class="form-card" method="post"><?= csrf_field() ?><?php if ($error): ?>
            <p class="form-message"><?= e($error) ?></p><?php endif; ?>
        <?php $total = 0;
        foreach ($cart as $id => $qty):
            $st = $pdo->prepare("SELECT * FROM products WHERE id=?");
            $st->execute([(int) $id]);
            $p = $st->fetch();
            if (!$p)
                continue;
            $sub = $p['price'] * $qty;
            $total += $sub; ?>
            <p><b><?= e($p['name']) ?></b> × <?= (int) $qty ?> — <?= rupiah($sub) ?></p><?php endforeach; ?>
        <hr>
        <h3>Total: <?= rupiah($total) ?></h3><label>Catatan pesanan (opsional)<textarea name="catatan" rows="3"
                placeholder="Contoh: kelas atau waktu pengambilan"></textarea></label><button
            class="btn btn-brown">Konfirmasi Pesanan</button>
    </form>
</main>
<?php include 'includes/footer.php'; ?>