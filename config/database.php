<?php
$host = '127.0.0.1';
$db   = 'skansaba_store';
$user = 'root';
$pass = ''; // Default Laragon biasanya kosong
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try { $pdo = new PDO($dsn, $user, $pass, $options); }
catch (PDOException $e) { exit('Koneksi database gagal. Pastikan MySQL Laragon aktif dan database skansaba_store sudah diimpor.'); }
