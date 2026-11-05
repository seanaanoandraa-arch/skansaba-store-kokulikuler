<?php
require_once 'config/functions.php';
unset($_SESSION['user']);
session_regenerate_id(true);
flash('Kamu berhasil keluar.');
header('Location: index.php');
exit;
