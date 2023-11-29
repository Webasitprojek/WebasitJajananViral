<?php
session_start();
require 'conek.php';

if (isset($_COOKIE['bukanid']) && isset($_COOKIE['bukanuser'])) {
    $bukanid = $_COOKIE['bukanid'];
    $bukanuser = $_COOKIE['bukanuser'];
    // Ambil username berdasarkan id
    $cekcokie = mysqli_query($con, "SELECT * FROM user WHERE id = '$bukanid'");
    if ($cekcokie) {
        $rowi = mysqli_fetch_assoc($cekcokie);
        // Cek cookie dan username
        if ($bukanuser === hash('whirlpool', $rowi['username'])) {
            $_SESSION['login'] = true;
        }
    }
}

if (isset($_SESSION["login"])) {
    header("location: dashboard/dashboard.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cekuser = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");

    if ($cekuser) {
        if (mysqli_num_rows($cekuser) === 1) {
            $cekpass = mysqli_fetch_assoc($cekuser);

            if (password_verify($password, $cekpass["password"])) {
                $_SESSION["login"] = true;
                $_SESSION["search"] = null;

                if (isset($_POST["remember"])) {
                    setcookie('bukanid', $cekpass['id'], time() + 604800);
                    setcookie('bukanuser', hash('whirlpool', $cekpass['username']), time() + 604800);
                }

                header("location: dashboard/dashboard.php");
                exit;
            } else {
                echo "
                <script>
                alert('Password yang Anda masukkan salah. Silakan coba lagi.');
                document.location.href = 'login.php';
                </script>
                ";
            }
        } else {
            // Jika username tidak ditemukan
            echo "
            <script>
            alert('Username tidak ditemukan. Silakan cek kembali username Anda.');
            document.location.href = 'login.php';
            </script>
            ";
        }
    } else {
        // Kesalahan saat mengecek username
        echo "
        <script>
        alert('Terjadi kesalahan. Silakan coba lagi nanti.');
        document.location.href = 'login.php';
        </script>
        ";
    }

    $error = true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/5.4.png">
    <title>Login</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<!-- Style -->
<link rel="stylesheet" href="css/login2.css">
</head>
<body>

<!-- Navbar Start -->

<nav class="navbar">

<a class="icon1" href="index.php">
    <img src="./img/6.png" alt="logo">
</a>
    
    <div class="navbar-nav">
    <!-- <a href="index.php">Beranda</a>
    <a href="#info">Layanan Informasi</a>
    <a href="#produk">Produk</a>
    <a href="#user">Pengguna</a> -->
</div>
<div class="navbar-extra">
<!-- <a href="#" target="_self" id="key"> <i data-feather="key"></i></a> -->
<!-- <a href="registrasi.php" target="_self" id="user-plus"> <i data-feather="user-plus"></i></a> -->
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
            <form action="" method="post">
                <h1>Login</h1>
                <hr>
                <input type="text" placeholder="username" id="username" name="username" required>
                <hr>
                <input type="password" placeholder="Password" id="password" name="password" required>
                <div id="toggleButton" class="sh">
                    <img id="icon" src="img/show.png" alt="visibility">
                </div>
                <hr>
                <input type="checkbox" name="remember" id="remember">
                <label  class="cekbox" for="remember">Remember me!</label>
                
                <button type="submit" name="login" id="loginButton">Login</button>
                <a class="as" href="lupa.php">Forgot Password?</a>
                <div class="usa">
                <!-- <p><a href="#">Register</a> Apabila Anda Belum Punya Akun</p> -->
            </div>
            </form>
           </div> 

        </div>
    </section>
    <!-- Hero Section End -->
<!-- Icons -->
    <script>
        feather.replace();
      </script>
<script>
         document.getElementById('loginButton').addEventListener('click', function() {
        document.getElementById('remember').checked = true; // Set checkbox remember to true
        document.getElementById('loginForm').submit(); // Submit the form
    });
</script>

<!-- Javascript -->
<script src="js/logi.js"></script>

</body>
</html>