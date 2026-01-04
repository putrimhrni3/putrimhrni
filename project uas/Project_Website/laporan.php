<?php
include "koneksi.php";

if (isset($_GET['hapus_id'])) {
    $id = intval($_GET['hapus_id']);
    mysqli_query($kon, "DELETE FROM booking WHERE id='$id'");
    header("Location: laporan.php");
    exit;
}

$query = mysqli_query($kon, "SELECT * FROM booking ORDER BY tanggal DESC, jam DESC");

if (!$query) {
    die("Query error: " . mysqli_error($kon));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kasir</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background:#0b0b0b;
            font-family:'Poppins',sans-serif;
            color:#fff;
            margin:0;
        }
        header {
            background:#111;
            padding:15px 50px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }
        header .logo { font-weight:700; font-size:1.2rem; color:#00e5ff; }
        header nav a {
            color:#fff; text-decoration:none; margin-left:15px; font-weight:600;
        }
        header nav a.active { color:#00e5ff; }

        .kasir-page { padding:40px 20px; max-width:1200px; margin:auto; }
        .kasir-page h1 { text-align:center; margin-bottom:20px; color:#00e5ff; }

        .btn-action {
            padding:4px 8px;
            font-size:0.75rem;
            border-radius:4px;
            border:none;
            cursor:pointer;
            margin:2px;
            text-decoration:none;
            display:inline-block;
        }
        .btn-edit { background:#3498db; color:#fff; }
        .btn-hapus { background:#e74c3c; color:#fff; }
        .btn-tambah { background:#2ecc71; color:#fff; padding:6px 12px; margin-bottom:10px; display:inline-block; }

        table { width:100%; border-collapse:collapse; background:#111; border:2px solid #00e5ff; }
        table th, table td { padding:10px; text-align:center; border:1px solid #00e5ff; }
        table th { background:#222; color:#00e5ff; }
        .kasir-empty { text-align:center; padding:15px; color:#ccc; }

        .status-pending { color:#f1c40f; font-weight:600; }
        .status-selesai { color:#2ecc71; font-weight:600; }
        .status-batal { color:#e74c3c; font-weight:600; }

        @media (max-width:768px){
            table, thead, tbody, th, td, tr { display:block; }
            table th { display:none; }
            table td { display:flex; justify-content:space-between; padding:10px; }
            table td::before { content:attr(data-label); font-weight:600; color:#00e5ff; }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">Black<span>Shine</span></div>
    <nav>
        <a href="index.php">Home</a>
        <a href="layanan.php">Layanan</a>
        <a href="laporan.php" class="active">Kasir</a>
    </nav>
</header>

<section class="kasir-page">
    <h1 class="kasir-title">Laporan Kasir</h1>
    <a class="btn-tambah" href="booking.php">Tambah Booking Baru</a>

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
                    <th>Metode Bayar</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($query) > 0): ?>
                    <?php $no=1; while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['telepon']); ?></td>
                            <td><?= htmlspecialchars($row['kendaraan']); ?></td>
                            <td><?= htmlspecialchars($row['plat']); ?></td>
                            <td><?= htmlspecialchars($row['layanan']); ?></td>
                            <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal']); ?></td>
                            <td><?= htmlspecialchars($row['jam']); ?></td>
                            <td class="status-<?= strtolower($row['status']); ?>"><?= ucfirst($row['status']); ?></td>
                            <td>
                                <a class="btn-action btn-edit" href="booking.php?id=<?= $row['id']; ?>">Edit</a>
                                <a class="btn-action btn-hapus" href="?hapus_id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="kasir-empty">Belum ada data booking</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
