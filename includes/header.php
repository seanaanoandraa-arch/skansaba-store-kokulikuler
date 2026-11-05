<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<?php
$pageTitle = $pageTitle ?? 'Skansaba Store';
$activePage = $activePage ?? '';
?>
<!DOCTYPE html>
<html lang="id"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?> - Skansaba Store</title>
<link rel="stylesheet" href="assets/css/style.css">
</head><body>
<header class="site-header"><div class="nav-wrap">
<a class="brand" href="index.php"><img src="assets/images/logo.png" alt="Skansaba Store"></a>
<button class="menu-toggle" id="menuToggle" aria-label="Buka menu">☰</button>
<nav id="mainNav">
<a class="<?= $activePage==='home'?'active':'' ?>" href="index.php">Beranda</a>
<a class="<?= $activePage==='catalog'?'active':'' ?>" href="katalog.php">Katalog Produk</a>
<a class="<?= $activePage==='about'?'active':'' ?>" href="tentang.php">Tentang Kami</a>
<a class="<?= $activePage==='contact'?'active':'' ?>" href="kontak.php">Kontak</a>
</nav>
<div class="nav-actions">
<div class="language-switch" aria-label="Pilih bahasa">
<button type="button" class="lang-btn" data-lang="id" aria-pressed="true">ID</button><span>|</span>
<button type="button" class="lang-btn" data-lang="en" aria-pressed="false">EN</button>
</div>
<a class="cart-link" href="keranjang.php"><img src="assets/images/keranjang.png" alt="Keranjang" class="cart-icon"><span><?= cart_count() ?></span></a>
<?php if (logged_in()): ?>
<a href="pesanan-saya.php" class="account-link">Pesanan</a>
<?php if (is_admin()): ?><a href="admin-pesanan.php" class="account-link">Admin</a><?php endif; ?>
<a href="logout.php" class="account-link">Keluar</a>
<?php else: ?><a href="login.php" class="account-link">Masuk</a><?php endif; ?>
</div></div></header>
<?php if ($message=flash()): ?><div class="container" style="padding-top:12px"><div class="form-message"><?= e($message) ?></div></div><?php endif; ?>
