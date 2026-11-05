<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once __DIR__ . '/database.php';
function e($v)
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}
function rupiah($n)
{
    return 'Rp ' . number_format((float) $n, 0, ',', '.');
}
function logged_in()
{
    return !empty($_SESSION['user']);
}
function is_admin()
{
    return logged_in() && ($_SESSION['user']['role'] ?? '') === 'admin';
}
function require_login()
{
    if (!logged_in()) {
        header('Location: login.php?next=pesanan-saya.php');
        exit;
    }
}
function require_admin()
{
    if (!is_admin()) {
        http_response_code(403);
        exit('Akses khusus admin.');
    }
}
function flash($msg = null)
{
    if ($msg !== null) {
        $_SESSION['flash'] = $msg;
        return;
    }
    $m = $_SESSION['flash'] ?? '';
    unset($_SESSION['flash']);
    return $m;
}
function cart_count()
{
    return array_sum($_SESSION['cart'] ?? []);
}
function csrf_field()
{
    if (empty($_SESSION['csrf']))
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return '<input type="hidden" name="csrf" value="' . e($_SESSION['csrf']) . '">';
}
function check_csrf()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(419);
        exit('Sesi formulir tidak valid. Muat ulang halaman lalu coba lagi.');
    }
}
