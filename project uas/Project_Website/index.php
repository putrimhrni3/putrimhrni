<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$nama_user = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black Shine Car Wash | Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="logo">Black<span>Shine</span></div>
    <nav>
        <a href="index.php" class="active">Home</a>
        <a href="layanan.php">Layanan</a>
        <a href="tentang.php">Tentang Kami</a>
        <a href="kontak.php">Kontak</a>
        <a href="laporan.php">Laporan</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section class="hero-section">
    <img src="img/logo.jpg" alt="Black Shine Car Wash" class="hero-img">
    
    <div class="hero-text">
        <h1>Car Wash Premium</h1>
        <p>Halo, <strong><?= htmlspecialchars(ucfirst($nama_user)); ?></strong>!</p>
        <p>Kebersihan maksimal, tampilan maksimal untuk kendaraan Anda.</p>
        <a href="layanan.php" class="btn">Lihat Layanan</a>
    </div>
</section>

<section class="section">
    <h2 class="main-title">Layanan Unggulan</h2>
    <p class="section-desc">
        Kami menyediakan layanan terbaik untuk mobil Anda tetap bersih dan mengkilap.
    </p>
    
    <div class="price-list">
        <div class="price-card">
            <div class="price-img">
                <img src="img/gambar1.jpg" alt="Cuci Exterior">
                <a href="booking.php?layanan=Cuci Exterior" class="btn booking-btn">Booking</a>
            </div>
            <h3>Cuci Exterior</h3>
            <p class="price">Rp 50.000</p>
            <p class="desc">Cuci luar mobil lengkap</p>
        </div>

        <div class="price-card">
            <div class="price-img">
                <img src="img/gambar2.jpg" alt="Cuci Interior">
                <a href="booking.php?layanan=Cuci Interior" class="btn booking-btn">Booking</a>
            </div>
            <h3>Cuci Interior</h3>
            <p class="price">Rp 60.000</p>
            <p class="desc">Membersihkan jok, dashboard, dan karpet</p>
        </div>

        <div class="price-card">
            <div class="price-img">
                <img src="img/gambar3.jpg" alt="Cuci Total">
                <a href="booking.php?layanan=Cuci Total" class="btn booking-btn">Booking</a>
            </div>
            <h3>Cuci Total (Interior & Exterior)</h3>
            <p class="price">Rp 100.000</p>
            <p class="desc">Perawatan lengkap mobil Anda</p>
        </div>
    </div>
</section>

<footer>
    <p>&copy; 2026 Black Shine Car Wash</p>
</footer>

<script src="js/script.js"></script>
</body>
</html>