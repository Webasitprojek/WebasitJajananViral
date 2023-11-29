<?php 
session_start();
require 'conek.php';
$username = isset($_SESSION['valid_username']) ? $_SESSION['valid_username'] : $_GET['user'];
global $salah;
if(isset($_POST["ganti"])){
    if(uppass($_POST) > 0){
        echo "
        <script>
        alert('Password Berhasil Diperbarui');
        document.location.href = 'login.php';
        </script>
        ";
    }else{
        echo "
        <script>
        alert('Password Gagal Diperbarui');
        document.location.href = 'passwordbaru.php';
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
    <title>Password Baru</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<!-- Style -->
<link rel="stylesheet" href="css/pasbar.css">
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar">

<a class="icon1" href="index.php">
    <img src="./img/6.png" alt="logo">
</a>
    
    <div class="navbar-nav">
    
</div>
<div class="navbar-extra">
<a href="lupa.php" id="log-in"> <i data-feather="log-in"></i></a>

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
                <h1>Password Baru</h1>
                <hr>
                <input type="text" placeholder="Username" id="pasb" name="pasb" required value="<?php echo $username ?>" style="visibility: hidden;
    border-bottom: 1px solid rgb(255, 255, 255);">
                
                <input type="text" placeholder="Password Baru" id="konpas" name="konpas" required>
                <hr>
                <input type="text" placeholder="Konfirmasi Password" id="konpas2" name="konpas2" required>
                <p><?php echo $salah; ?></p>
                <hr>
                <button type="submit" name="ganti" id="ganti" class="ganti">Ubah</button>
            </form>
           </div> 

        </div>
    </section>
    <!-- Hero Section End -->
<!-- Icons -->
    <script>
        feather.replace();
      </script>

<!-- Javascript -->
<script src="js/pasbar.js"></script>

</body>
</html>