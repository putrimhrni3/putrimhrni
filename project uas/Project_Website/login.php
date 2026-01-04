<?php
session_start();
include "koneksi.php";

if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
    header("Location: index.php"); // langsung ke home
    exit;
}

// Proses login
if(isset($_POST['username']) && isset($_POST['password'])){
    
    $username = $_POST['username'];      
    $password = md5($_POST['password']); 

    // Query ke tabel user
    $query = mysqli_query($kon, "SELECT * FROM user WHERE username='$username' AND Password='$password'");

    if(!$query){
        die("Query error: " . mysqli_error($kon));
    }

    if(mysqli_num_rows($query) > 0){
        $data = mysqli_fetch_assoc($query);
        $_SESSION['user'] = $data;
        $_SESSION['status'] = "login"; 

        // Redirect langsung ke home
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Black Shine Car Wash</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #0b0b0b;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
        .login-card {
            background: #1a1a1a;
            padding: 30px 25px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 25px rgba(0,229,255,0.3);
            text-align: center;
        }
        .login-card h2 {
            margin-bottom: 20px;
            color: #00e5ff;
        }
        .login-card input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: none;
            background: #222;
            color: #fff;
            box-sizing: border-box; 
        }
        .login-card button {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: none;
            background: linear-gradient(90deg, #00e5ff, #0091a8);
            color: #000;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }
        .login-card button:hover {
            box-shadow: 0 0 20px #00e5ff;
            transform: translateY(-2px);
        }
        .error {
            background-color: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #e74c3c;
            font-size: 0.9rem;
        }
        .register {
            margin-top: 15px;
            font-size: 0.85rem;
        }
        .register a {
            color: #00e5ff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Login Admin</h2>

    <?php 
    if(isset($error)){
        echo '<div class="error">'.$error.'</div>';
    }
    ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        
        <input type="password" name="password" placeholder="Password" required>
        
        <button type="submit">Login</button>
    </form>

    <div class="register">
        Belum punya akun? <a href="#">Hubungi Administrator</a>
    </div>
</div>

</body>
</html>