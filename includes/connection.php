<?php

session_start();

try {
    $conn = new PDO('mysql:host=localhost;dbname=ebike', 'root', '');
} catch (PDOException $e) {
    die('Tidak berhasil terkoneksi ke database!<br/>Error: ' . $e);
}

include 'ebike.class.php';
include 'EbikeUI.php';

$akun = new akun($conn);
$estation  = new estation($conn);
$ebike = new ebike($conn);
$penyewaan = new penyewaan($conn);
$ebikeui = new ebikeui($conn);
$role = new role($conn);
$detail_penyewaan = new detail_penyewaan($conn);

// $pengiriman = new Products($conn);
// $session_login = isset($_SESSION['login']) ? $_SESSION['login'] : '';

// if (isset($session_login)) {
//     $fetch_admin = "SELECT * FROM admins WHERE id = ?";
//     $fetch_admin = $conn->prepare($fetch_admin);
//     $fetch_admin->execute([$session_login]);
//     $fetch_admin = $fetch_admin->fetch();
// }