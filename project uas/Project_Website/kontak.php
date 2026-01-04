<?php
include "koneksi.php";

$response = ['success' => false, 'message' => ''];
if(isset($_POST['ajax_submit'])){
    $nama = mysqli_real_escape_string($kon, $_POST['name']);
    $email = mysqli_real_escape_string($kon, $_POST['email']);
    $pesan = mysqli_real_escape_string($kon, $_POST['message']);
    $tanggal = date("Y-m-d H:i:s");

    $insert = mysqli_query($kon, "INSERT INTO kontak (nama,email,pesan,tanggal) VALUES ('$nama','$email','$pesan','$tanggal')");

    if($insert){
        $response['success'] = true;
        $response['message'] = "Pesan berhasil dikirim! Terima kasih.";
    } else {
        $response['message'] = "Gagal mengirim pesan: ".mysqli_error($kon);
    }
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kontak | Black Shine Car Wash</title>
<link rel="stylesheet" href="css/style.css">
<style>
body { font-family:'Poppins',sans-serif; background:#0b0b0b; color:#fff; margin:0; }
header { background:#111; padding:15px 50px; display:flex; justify-content:space-between; align-items:center; }
header .logo { font-weight:700; font-size:1.2rem; color:#00e5ff; }
header nav a { color:#fff; text-decoration:none; margin-left:15px; font-weight:600; }
header nav a.active { color:#00e5ff; }
.contact-section { max-width:1000px; margin:50px auto; padding:0 20px; }
.main-title { text-align:center; margin-bottom:10px; color:#00e5ff; }
.section-desc { text-align:center; margin-bottom:40px; color:#ccc; }
.contact-container { display:flex; flex-wrap:wrap; gap:30px; justify-content:center; }
.contact-info, .contact-form { background:#111; padding:25px; border-radius:10px; border:2px solid #00e5ff; flex:1; min-width:300px; }
.info-card { margin-bottom:15px; }
.info-card h3 { color:#00e5ff; margin:5px 0; }
label { display:block; margin-bottom:5px; font-weight:600; color:#00e5ff; }
input, textarea, button { width:100%; padding:10px; margin-bottom:10px; border-radius:5px; border:none; font-size:0.95rem; }
input, textarea { background:#222; color:#fff; }
textarea { min-height:120px; }
button { background:#3498db; color:#fff; cursor:pointer; font-weight:600; transition:0.3s; }
button:hover { background:#2980b9; }
footer { text-align:center; padding:20px; color:#ccc; margin-top:40px; }
</style>
</head>
<body>

<header>
    <div class="logo">Black<span>Shine</span></div>
    <nav>
        <a href="index.php">Home</a>
        <a href="layanan.php">Layanan/Produk</a>
        <a href="tentang.php">Tentang Kami</a>
        <a href="kontak.php" class="active">Kontak</a>
        <a href="laporan.php">Laporan</a>
    </nav>
</header>

<section class="contact-section">
    <h1 class="main-title">Kontak Kami</h1>
    <p class="section-desc">
        Hubungi kami untuk pertanyaan, reservasi layanan, atau informasi lebih lanjut. Kami siap membantu!
    </p>

    <div class="contact-container">
        <!-- Info Kontak -->
        <div class="contact-info">
            <div class="info-card">
                <span class="icon">📍</span>
                <h3>Alamat</h3>
                <p>Jl. Bersih No. 21, Jakarta</p>
            </div>
            <div class="info-card">
                <span class="icon">📞</span>
                <h3>Telepon</h3>
                <p>0812-3456-7890</p>
            </div>
            <div class="info-card">
                <span class="icon">✉️</span>
                <h3>Email</h3>
                <p>blackshine@carwash.com</p>
            </div>
        </div>

        <!-- Form Kontak -->
        <div class="contact-form">
            <form id="kontakForm">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" placeholder="Nama lengkap" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email Anda" required>

                <label for="message">Pesan</label>
                <textarea id="message" name="message" placeholder="Tulis pesan Anda" rows="5" required></textarea>

                <button type="submit">Kirim Pesan</button>
            </form>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Black Shine Car Wash</p>
</footer>

<script>
document.getElementById("kontakForm").addEventListener("submit", function(e){
    e.preventDefault(); 

    let formData = new FormData(this);
    formData.append('ajax_submit','1');

    fetch('kontak.php', {
        method:'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if(data.success){
            document.getElementById("kontakForm").reset(); 
        }
    })
    .catch(err => alert("Terjadi error: "+err));
});
</script>

</body>
</html>
