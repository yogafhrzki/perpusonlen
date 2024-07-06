<?php
session_start();
include 'koneksi.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


$role = $_SESSION['role'];
if ($role == 'admin') {
    header("Location: admin_dashboard.php");
    exit;
} elseif ($role == 'member') {
    header("Location: member_dashboard.php");
    exit;
} elseif ($role == 'librarian') {
    header("Location: librarian_dashboard.php");
    exit;
} else {
    echo "Peran tidak dikenal!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Perpustakaan Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="jumbotron text-center">
        <h1>Selamat Datang di Sistem Informasi Perpustakaan Online</h1>
        <p>Sistem informasi perpustakaan yang memudahkan Anda untuk mengelola buku, anggota, dan peminjaman.</p>
    </div>
</body>
</html>
