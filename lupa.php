<?php
session_start();
require 'conek.php';

if (isset($_POST['bt'])) {
    $username = $_POST['user'];
    $email = $_POST['email'];

    $query = "SELECT email FROM user WHERE username = '$username'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $databaseEmail = $row['email'];

        if ($databaseEmail === $email) {
            $_SESSION['valid_username'] = $username; // Simpan username ke dalam session
            $_SESSION['usernameFromPHP'] = $username;
            $userInputDisabled = 'disabled';
            $emailInputDisabled = 'disabled';
            echo "<style>#bt { display: none; }</style>";
            echo "<style>#isi { display: none; }</style>";
            echo "<script>var usernameFromPHP = '" . $username . "';</script>";
        } else {
            echo "
            <script>
            alert('Email tidak sesuai dengan username yang dimasukkan.');
            document.location.href = 'lupa.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
        alert('Username tidak ditemukan.');
        document.location.href = 'lupa.php';
        </script>
        ";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/5.4.png">
    <title>Lupa Password</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://smtpjs.com/v3/smtp.js"></script>

<!-- Style -->
<link rel="stylesheet" href="css/lupss.css">
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar">

<a class="icon1" href="index.php">
    <img src="./img/6.png" alt="logo">
</a>
    
    <div class="navbar-nav">
    <!-- <a href="#beranda">Beranda</a>
    <a href="#info">Layanan Informasi</a>
    <a href="#produk">Produk</a>
    <a href="#user">Pengguna</a> -->
</div>
<div class="navbar-extra">
<a href="login.php" id="log-in"> <i data-feather="log-in"></i></a>
<!-- <a href="registrasi.php" id="user-plus"> <i data-feather="user-plus"></i></a> -->
<a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
</div>   
</nav>
<!-- Navbar End -->

<!-- Hero Section Start -->
    <section class="hero" id="home">
        <div class="content">
            <div class="heroimg">
                <img src="img/6.1.png" alt="display">
            </div>

           <div class="fom">
            <form action="" method="post" id="myform">
                <h1>Lupa Password</h1>
                <hr>
                <input type="text" placeholder="Username" id="user" name="user" required <?php if(isset($userInputDisabled)) { echo $userInputDisabled; } ?> value="<?php if(isset($_POST['user'])) { echo $_POST['user'];} ?>">
                <hr>
                <input type="email" placeholder="Email" id="email" name="email" required <?php if(isset($emailInputDisabled)) { echo $emailInputDisabled; } ?> value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>">
                <hr>
                <div class="otpverify">
                <input type="text" id="otp_inp" class="btveri" placeholder="Klik Cek Email lalu masukkan kode OTP disini">
                <hr>
                
                </div>
                <button class="bt" name="bt" id="bt">Cek Email</button>
                <p id="isi" class="isi">Klik Cek Email lalu klik Send OTP untuk mendapatkan kode OTP anda</p>
                
            
                
                

    
            </form>
            <button onclick="sendOTP()" class="btn" name="btn" id="btn">Kirim OTP</button>
            <button class="ntb" id="otp-btn">Verify</button>
            
            
            
           </div> 

        </div>
    </section>
    <!-- Hero Section End -->
<!-- Icons -->
    <script>
        feather.replace();
      </script>

<!-- Javascript -->
<script src="lupas.js"></script>
</body>
</html>