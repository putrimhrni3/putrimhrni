<?php
include "koneksi.php";

// ==========================
// 1. UPDATE STATUS SELESAI
// ==========================
if (isset($_GET['selesai'])) {
    $id = intval($_GET['selesai']);
    mysqli_query($kon, "UPDATE booking SET status='selesai' WHERE id=$id");
    header("Location: kasir.php");
    exit;
}

// ==========================
// 2. HAPUS BOOKING
// ==========================
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($kon, "DELETE FROM booking WHERE id=$id");
    header("Location: kasir.php");
    exit;
}

// ==========================
// 3. AMBIL DATA BOOKING
// ==========================
$query = mysqli_query($kon, "SELECT * FROM booking ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kasir | Black Shine</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo">Black<span>Shine</span></div>
    <nav>
        <a href="index.php">Home</a>
        <a href="layanan.php">Layanan</a>
        <a href="kasir.php" class="active">Kasir</a>
    </nav>
</header>

<section class="kasir-page">
    <h1 class="kasir-title">Laporan Kasir</h1>

    <div class="kasir-table-wrapper">
        <table class="kasir-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Kendaraan</th>
                    <th>Plat</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_assoc($query)){ ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['telepon']); ?></td>
                            <td><?= htmlspecialchars($row['kendaraan']); ?></td>
                            <td><?= htmlspecialchars($row['plat']); ?></td>
                            <td><?= htmlspecialchars($row['layanan']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal']); ?></td>
                            <td><?= htmlspecialchars($row['jam']); ?></td>
                            <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                            <td class="status-<?= $row['status']; ?>"><?= ucfirst($row['status']); ?></td>
                            <td>
                                <?php if($row['status'] != 'selesai'){ ?>
                                    <a href="?selesai=<?= $row['id']; ?>" class="btn-action btn-complete">Selesai</a>
                                <?php } ?>
                                <a href="?hapus=<?= $row['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Hapus booking ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="11" class="kasir-empty">Belum ada data booking</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
