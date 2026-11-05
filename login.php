<?php
require_once 'config/functions.php';
check_csrf();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $st = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $st->execute([trim($_POST['username'] ?? '')]);
    $u = $st->fetch();
    if ($u && password_verify($_POST['password'] ?? '', $u['password'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = ['id' => $u['id'], 'name' => $u['name'], 'username' => $u['username'], 'role' => $u['role']];
        $next = $_GET['next'] ?? 'pesanan-saya.php';
        header('Location: ' . ($next === 'admin-pesanan.php' && $u['role'] !== 'admin' ? 'index.php' : $next));
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
$pageTitle = 'Masuk';
include 'includes/header.php';
?>
<main class="container page-main">
    <div class="page-title">
        <h1>Masuk</h1>
        <p>Masuk untuk melihat dan mengelola pesananmu.</p>
    </div>
    <form class="form-card" method="post"><?= csrf_field() ?><?php if ($error): ?>
            <p class="form-message"><?= e($error) ?></p><?php endif; ?>
        <label>Username<input name="username" required></label>
        <label>Password
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="" required>

                <button type="button" onclick="togglePassword('password', this)" aria-label="Lihat password">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>
        </label>
        <button class="btn btn-brown">Masuk</button>
        <p>Belum punya akun? <a href="daftar.php">Daftar sekarang</a></p>
    </form>
</main>
<?php include 'includes/footer.php'; ?>