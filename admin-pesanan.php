<?php
require_once 'config/functions.php';
require_admin();
check_csrf();
$allowed = ['Menunggu', 'Diproses', 'Selesai', 'Dibatalkan'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['order_id'] ?? 0);
    $status = $_POST['status'] ?? '';
    if (in_array($status, $allowed, true)) {
        $st = $pdo->prepare("UPDATE orders SET status=? WHERE id=?");
        $st->execute([$status, $id]);
        flash('Status pesanan diperbarui.');
    }
    header('Location: admin-pesanan.php');
    exit;
}
$orders = $pdo->query("SELECT o.*,u.name,u.username,u.phone FROM orders o JOIN users u ON u.id=o.user_id ORDER BY o.created_at DESC")->fetchAll();
$pageTitle = 'Admin Pesanan';
include 'includes/header.php'; ?>
<main class="container page-main">
    <div class="page-title">
        <h1>Kelola Pesanan</h1>
        <p>Daftar pesanan pembeli Skansaba Store.</p>
    </div>
    <?php if (!$orders): ?>
        <div class="empty-state">Belum ada pesanan masuk.</div><?php endif; ?>
    <?php foreach ($orders as $o): ?>
        <article class="info-card" style="margin-bottom:16px">
            <h3>Pesanan #<?= $o['id'] ?> · <?= e($o['name']) ?></h3>
            <p><?= e($o['username']) ?> · <?= e($o['phone']) ?></p>
            <p><?= date('d-m-Y H:i', strtotime($o['created_at'])) ?> · <?= rupiah($o['total']) ?></p>
            <?php $it = $pdo->prepare("SELECT * FROM order_items WHERE order_id=?");
            $it->execute([$o['id']]);
            foreach ($it as $item): ?>
                <p><?= e($item['product_name']) ?> × <?= $item['quantity'] ?> — <?= rupiah($item['price'] * $item['quantity']) ?>
                </p><?php endforeach; ?>
            <form method="post"><?= csrf_field() ?><input type="hidden" name="order_id" value="<?= $o['id'] ?>"><select
                    name="status"><?php foreach ($allowed as $s): ?>
                        <option <?= $o['status'] === $s ? 'selected' : '' ?>><?= e($s) ?></option><?php endforeach; ?>
                </select> <button class="btn btn-brown">Simpan Status</button></form>
        </article><?php endforeach; ?>
</main>
<?php include 'includes/footer.php'; ?>