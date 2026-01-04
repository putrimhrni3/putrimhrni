<?php
include "koneksi.php";

$isEdit = false;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($kon, "SELECT * FROM booking WHERE id='$id'");
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $isEdit = true;
    } else {
        // Jika id tidak ditemukan, redirect ke laporan
        header("Location: laporan.php");
        exit;
    }
}

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($kon, $_POST['nama']);
    $telepon = mysqli_real_escape_string($kon, $_POST['telepon']);
    $kendaraan = mysqli_real_escape_string($kon, $_POST['kendaraan']);
    $plat = mysqli_real_escape_string($kon, $_POST['plat']);
    $layanan = mysqli_real_escape_string($kon, $_POST['layanan']);
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $metode = mysqli_real_escape_string($kon, $_POST['metode_pembayaran']);
    $status = $isEdit ? mysqli_real_escape_string($kon, $_POST['status']) : 'pending';

    if ($isEdit) {
        // Update booking
        $update = mysqli_query($kon, "UPDATE booking SET 
            nama='$nama', 
            telepon='$telepon', 
            kendaraan='$kendaraan', 
            plat='$plat', 
            layanan='$layanan', 
            tanggal='$tanggal', 
            jam='$jam', 
            metode_pembayaran='$metode', 
            status='$status' 
            WHERE id='$id'");
        if ($update) {
            header("Location: laporan.php");
            exit;
        } else {
            echo "Gagal update data: " . mysqli_error($kon);
        }
    } else {
        // Tambah booking baru
        $insert = mysqli_query($kon, "INSERT INTO booking 
            (nama, telepon, kendaraan, plat, layanan, tanggal, jam, metode_pembayaran, status) 
            VALUES 
            ('$nama','$telepon','$kendaraan','$plat','$layanan','$tanggal','$jam','$metode','$status')");
        if ($insert) {
            header("Location: laporan.php");
            exit;
        } else {
            echo "Gagal tambah booking: " . mysqli_error($kon);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $isEdit ? 'Edit Booking' : 'Booking Baru'; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background:#0b0b0b;
            font-family: 'Poppins', sans-serif;
            color:#fff;
            margin:0;
        }
        .booking-page {
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            padding:40px 20px;
        }
        .form-container {
            max-width:500px;
            width:100%;
            background:#111;
            padding:25px;
            border-radius:10px;
            color:#fff;
            box-shadow:0 0 20px rgba(0,229,255,0.2);
            border:2px solid #00e5ff;
        }
        .form-container h2 {
            text-align:center;
            margin-bottom:20px;
            color:#00e5ff;
        }
        label {
            font-weight:600;
            color:#00e5ff;
            margin-bottom:5px;
            display:block;
        }
        input, select, button {
            width:100%;
            padding:10px;
            margin-bottom:10px;
            border-radius:5px;
            border:none;
            font-size:0.95rem;
        }
        input, select {
            background:#222;
            color:#fff;
        }
        button {
            background:#3498db;
            color:#fff;
            cursor:pointer;
            font-weight:600;
            transition:0.3s;
        }
        button:hover {
            background:#2980b9;
        }
        @media (max-width:768px) {
            .form-container {
                padding:20px;
            }
        }
    </style>
</head>
<body>
<div class="booking-page">
    <div class="form-container">
        <h2><?= $isEdit ? 'Edit Booking' : 'Booking Baru'; ?></h2>
        <form method="post">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $isEdit ? htmlspecialchars($data['nama']) : ''; ?>" required>

            <label>No HP</label>
            <input type="tel" name="telepon" value="<?= $isEdit ? htmlspecialchars($data['telepon']) : ''; ?>" required>

            <label>Kendaraan</label>
            <input type="text" name="kendaraan" value="<?= $isEdit ? htmlspecialchars($data['kendaraan']) : ''; ?>" required>

            <label>Plat</label>
            <input type="text" name="plat" value="<?= $isEdit ? htmlspecialchars($data['plat']) : ''; ?>" required>

            <label>Layanan</label>
            <input type="text" name="layanan" value="<?= $isEdit ? htmlspecialchars($data['layanan']) : ''; ?>" required>

            <label>Tanggal</label>
            <input type="date" name="tanggal" value="<?= $isEdit ? $data['tanggal'] : ''; ?>" required>

            <label>Jam</label>
            <input type="time" name="jam" value="<?= $isEdit ? $data['jam'] : ''; ?>" required>

            <label>Metode Pembayaran</label>
            <select name="metode_pembayaran" required>
                <option value="Cash" <?= $isEdit && $data['metode_pembayaran']=='Cash' ? 'selected' : ''; ?>>Cash</option>
                <option value="QRIS" <?= $isEdit && $data['metode_pembayaran']=='QRIS' ? 'selected' : ''; ?>>QRIS</option>
                <option value="Transfer" <?= $isEdit && $data['metode_pembayaran']=='Transfer' ? 'selected' : ''; ?>>Transfer</option>
            </select>

            <?php if ($isEdit): ?>
                <label>Status</label>
                <select name="status" required>
                    <option value="pending" <?= $data['status']=='pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="selesai" <?= $data['status']=='selesai' ? 'selected' : ''; ?>>Selesai</option>
                    <option value="batal" <?= $data['status']=='batal' ? 'selected' : ''; ?>>Batal</option>
                </select>
            <?php endif; ?>

            <button type="submit" name="submit"><?= $isEdit ? 'Update Booking' : 'Tambah Booking'; ?></button>
        </form>
    </div>
</div>
</body>
</html>
