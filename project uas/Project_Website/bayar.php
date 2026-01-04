<?php
include "koneksi.php";

$id = $_GET['id'];
$booking = mysqli_query($kon, "SELECT * FROM booking WHERE id='$id'");
$b = mysqli_fetch_assoc($booking);

if(isset($_POST['bayar'])){
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $kembalian = $bayar - $total;

    mysqli_query($kon, "INSERT INTO kasir 
        (booking_id, total, bayar, kembalian)
        VALUES ('$id','$total','$bayar','$kembalian')");

    mysqli_query($kon, "UPDATE booking SET status='selesai' WHERE id='$id'");

    header("Location: laporan.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Pembayaran</title>
</head>
<body>

<h3>Pembayaran</h3>
<p>Nama: <?= $b['nama']; ?></p>
<p>Layanan: <?= $b['layanan']; ?></p>

<form method="post">
    Total Bayar <br>
    <input type="number" name="total" required><br><br>

    Uang Bayar <br>
    <input type="number" name="bayar" required><br><br>

    <button name="bayar">Proses</button>
</form>

</body>
</html>
