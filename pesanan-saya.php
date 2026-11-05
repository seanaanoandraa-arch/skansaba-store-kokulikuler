<?php
require_once 'config/functions.php';
require_login();
$st = $pdo->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY created_at DESC");
$st->execute([$_SESSION['user']['id']]);
$orders = $st->fetchAll();
$pageTitle = 'Pesanan Saya';
include 'includes/header.php'; ?>
<main class="container page-main">
    <div class="page-title">
        <h1>Pesanan Saya</h1>
        <p>Halo, <?= e($_SESSION['user']['name']) ?>. Berikut riwayat pesananmu.</p>
    </div>
    <?php if (!$orders): ?>
        <div class="empty-state">
            <h2>Belum ada pesanan</h2><a class="btn btn-brown" href="katalog.php">Mulai Belanja</a>
        </div><?php endif; ?>
    <?php foreach ($orders as $o): ?>
        <article class="info-card" style="margin-bottom:16px">
            <h3>Pesanan #<?= $o['id'] ?> · <?= e($o['status']) ?></h3>
            <p><?= date('d-m-Y H:i', strtotime($o['created_at'])) ?> · Total <?= rupiah($o['total']) ?></p>
            <?php $it = $pdo->prepare("SELECT * FROM order_items WHERE order_id=?");
            $it->execute([$o['id']]);
            foreach ($it as $item): ?>
                <p><?= e($item['product_name']) ?> × <?= $item['quantity'] ?> — <?= rupiah($item['price'] * $item['quantity']) ?>
                </p><?php endforeach; ?>
            <?php if ($o['note']): ?>
                <p>Catatan: <?= e($o['note']) ?></p><?php endif; ?>
        </article><?php endforeach; ?>
</main>
<?php include 'includes/footer.php'; ?>