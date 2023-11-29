<?php 
session_start();
require '../conek.php';


$search = isset($_SESSION["search"]) ? $_SESSION["search"] : "";

if(isset($_POST["tambah"])){
    if(tambahfranchise($_POST) > 0){
        echo "
        <script>
        alert('Data berhasil ditambahkan. Harap menunggu persetujuan dari admin maks 3 hari kedepan. Pemberitahuan persetujuan akan dikirim ke nomor yang anda cantumkan saat mendaftar.');
        document.location.href = 'franchise.php';
        </script>
        ";    
    }else{
        echo "
        <script>
        alert('DATA GAGAL DI TAMBAHKAN');
        document.location.href = 'franchise.php';
        </script>
        ";
    }
}


 $angkaRandom = rand(1, 10000);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/5.4.png">
    <title>Cemilan Pedas</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<!-- Style -->
<link rel="stylesheet" href="css/fran.css">
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar">

<a class="icon1" href="../index.php">
    <img src="./img/6.png" alt="logo">
</a>
    
    <div class="navbar-nav">
    <a href="#home">Franchise</a>
    <a href="#about">Keuntungan</a>
    <a href="#contact">Daftar</a>
</div>
<div class="navbar-extra">
<a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
</div>   
</nav>
<!-- Navbar End -->

<!-- Hero Section Start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Bergabung Dengan <span>Kami</span> </h1>
            <p>Menjadi bagian dari SiCedas untuk menyebarkan rasa pedas dan kegembiraan</p>
            <a href="#contact" class="cta">Daftar Sekarang!</a>
        </main>
        <!-- <div class="video">
            <video autoplay loop src="img/4k.mp4"></video>
        </div> -->
    </section>
    <!-- Hero Section End -->

<!-- About section start -->
    <section id="about" class="about">
        <h2><span>Keuntungan </span>Mendaftar Franchise</h2>
        <div class="row">
            <div class="about-img">
                <img src="img/franss.png" alt="Tentang Kami">
            </div>
            
            <div class="content">
                <h3>Apa saja keuntungan bergabung dengan kami?</h3>
                <p>Buka usaha dengan modal minimal hasil maksimal</p>
                <p>Harga reseller lebih murah dibanding beli eceran</p>
                <p>Foto dan video produk untuk kebutuhan promosi, dan lain-lain</p>
                <p>Untuk informasi lebih lanjut silahkan hubungi kami di WhatsApp. Klik tombol dibawah.</p>
                <a href="https://api.whatsapp.com/send/?phone=6287737001899&text=Hai,%20saya%20tertarik%20dengan%20program%20Franchise%20anda.%20Bagaimana%20cara%20join?%20"class="hub" target="_blank">Hubungi Kami</a>
            </div>
           
            
        </div>
    </section>
<!-- About section end -->

<!-- Contact Section Start -->
    <section id="contact" class="contact">
        <h2>Daftar <span>Franchise</span></h2>
        <div class="row">
             <form action="" method="post">
               
                <div class="input-group">
                    <i data-feather="key"></i>
                    <input type="input" placeholder="ID Franchise (Auto)" required disabled value="<?= $angkaRandom; ?>" name="id">
                </div>
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="input" placeholder="Nama"required name="namaleng">
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="input" placeholder="No.Telp" required name="phone">
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="email" placeholder="Email" required name="mail">
                </div>
                <div class="input-group">
                    <i data-feather="map-pin"></i>
                    <input type="input" placeholder="Alamat" required name="map">
                </div>
                <div class="input-group">
                    <i data-feather="map-pin"></i>
                    <input type="input" placeholder="Bujur Lintang" required name="lin">
                </div>
              
                    <button class="subm" name="tambah">Submit</button>
               
                <!-- <button type="submit" class="btn">Kirim Pesan</button> -->
            </form>
        </div>
    </section>
<!-- Contact Section End -->

<!-- Footer start -->
<footer>
<div class="socials">
    <a href="https://www.adie6809@gmail.com"><i data-feather="mail"></i></a>
    <a href="https://www.facebook.com/"><i data-feather="facebook"></i></a>
    <a href="https://api.whatsapp.com/send/?phone=6287737001899&text=Hai,%20saya%20tertarik%20dengan%20program%20Franchise%20anda.%20Bagaimana%20cara%20join?%20"><i data-feather="phone"></i></a>
</div>
<div class="links">
    <a href="#home">Franchise</a>
    <a href="#about">Keuntungan</a>
    <a href="#contact">Daftar</a>
</div>
<div class="credit"> 
    <p> Created by <a href="https://adieptr.github.io/palikasstudio/">Palikas Studio</a> | &copy;2023.</p>
</div>
</footer>
<!-- Footer end -->




<!-- Icons -->
    <script>
        feather.replace();
      </script>

<!-- Javascript -->
<script src="js/frans.js"></script>

</body>
</html>