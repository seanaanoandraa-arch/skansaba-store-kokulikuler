<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<?php

require_once 'config/functions.php';
check_csrf();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $phone = trim($_POST['no_hp'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($name === '' || $username === '' || $password === '' || strlen($password) < 8) {
        $error = 'Lengkapi semua data. Password minimal 8 karakter.';
    } else {
        try {
            $st = $pdo->prepare("INSERT INTO users(name,username,phone,password) VALUES(?,?,?,?)");
            $st->execute([$name, $username, $phone, password_hash($password, PASSWORD_DEFAULT)]);
            flash('Akun berhasil dibuat. Silakan masuk.');
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $error = 'Username sudah digunakan.';
        }
    }
}
$pageTitle = 'Daftar';
include 'includes/header.php';
?>
<main class="container page-main">
    <div class="page-title">
        <h1>Buat Akun Pembeli</h1>
        <p>Daftar agar pesananmu tersimpan dan bisa dilihat kembali.</p>
    </div>
    <form class="form-card" method="post"><?= csrf_field() ?><?php if ($error): ?>
            <p class="form-message"><?= e($error) ?></p><?php endif; ?>
        <label>Nama Lengkap<input name="nama" required value="<?= e($_POST['nama'] ?? '') ?>"></label>
        <label>Username<input name="username" required value="<?= e($_POST['username'] ?? '') ?>"></label>
        <label>Nomor HP<input name="no_hp" type="tel" required value="<?= e($_POST['no_hp'] ?? '') ?>"></label>
        <label>Password (minimal 8 karakter)
            <div class="password-wrapper">
                <input name="password" type="password" id="password" minlength="8" required>

                <button type="button" onclick="togglePassword('password', this)" aria-label="Lihat password">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>
        </label> <button class="btn btn-brown">Daftar</button>
        <p>Sudah punya akun? <a href="login.php">Masuk</a></p>
    </form>
</main>

<?php include 'includes/footer.php'; ?>