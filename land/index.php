<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/5.4.png">
    <title>Cemilan Pedas</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<!-- Style -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar">

<a class="icon1" href="index.php">
    <img src="./img/6.png" alt="logo">
</a>

    <div class="navbar-nav">
    <a href="#home">Beranda</a>
    <a href="#about">Tentang Kami</a>
    <a href="./franchise/franchise.php" target="_self">Franchise</a>
    <a href="#menu">Produk</a>
    <a href="#contact">Kontak</a>
</div>
<div class="navbar-extra">
<a href="login.php" id="key"> <i data-feather="key"></i></a>
<!-- <a href="#" id="user-plus"> <i data-feather="user-plus"></i></a> -->
<a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
</div>   
</nav>
<!-- Navbar End -->

<!-- Hero Section Start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Cemilan Pedas <span>Bikin Nagih</span> </h1>
            <p>Nikmati cemilan dengan cita rasa gurih dan pedas yang bikin kamu pengen lagi dan lagi!</p>
            <a href="./peroduck/produk.php" class="cta">Order Sekarang!</a>
        </main>
        <!-- <div class="video">
            <video autoplay loop src="img/4k.mp4"></video>
        </div> -->
    </section>
    <!-- Hero Section End -->

<!-- About section start -->
<section id="about" class="about">
    <h2><span>Tentang </span> Kami</h2>
    <div class="row">
        <div class="about-img">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="img/aboutus.jpg" alt="Tentang Kami">
                </div>
                <div class="mySlides fade">
                    <img src="img/slide_image_1.png" alt="Tentang Kami">
                </div>
                <div class="mySlides fade">
                    <img src="img/slide_image_2.png" alt="Tentang Kami">
                </div>
                <!-- Tambahkan gambar tambahan dengan class "mySlides fade" -->
            </div>
        </div>

        <div class="content">
            <h3>SiCedas by Jajanan Viral?</h3>
            <p>Mempersembahkan SiCedas (Sistem informasi pemesanan Cemilan Pedas) yang menyajikan camilan pedas dari produsen Jajanan Viral yang siap menemani segala aktivitas anda. Tunggu apalagi? Cus kepoin!</p>
        </div>
    </div>
</section>

<!-- Tambahkan script untuk slideshow -->
<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex-1].style.display = "block";
        setTimeout(showSlides, 2000); // Ubah angka 2000 menjadi interval waktu yang Anda inginkan (dalam milidetik)
    }
</script>

<!-- About section end -->
<!-- Menu section start -->
    <section id="menu" class="menu">
        <h2><span>Produk</span> Kami</h2>
        <p>Pilih snack kesukaan kamu! Klik pada salah satu item atau Lihat Selengkapnya untuk informasi lebih lanjut.</p>
        <div class="row">
            <div class="menu-card">
                <img src="img/men1.gif" alt="Basreng Pedas" class="menu-card-img">
                <h3 class="menu-card-title">Basreng Pedas</h3>
                <p class="menu-card-price"> IDR 20K</p>
            </div>
            <div class="menu-card">
                <img src="img/men2.gif" alt="Basreng Original" class="menu-card-img">
                <h3 class="menu-card-title">Basreng Original</h3>
                <p class="menu-card-price"> IDR 25</p>
            </div>
            <div class="menu-card">
                <img src="img/men3.gif" alt="Keong Pedas" class="menu-card-img">
                <h3 class="menu-card-title">Keong Pedas</h3>
                <p class="menu-card-price"> IDR 23K</p>
            </div>
            <div class="menu-card2">
                <img src="img/men4.gif" alt="Macaroni Original" class="menu-card-img2">
                <h3 class="menu-card-title">Macaroni Original</h3>
                <p class="menu-card-price"> IDR 50K</p>
                 
            </div> 
            <div class="next">
               <a href="./peroduck/produk.php"><img src="img/next2.png" alt="Next" class="next-img"></a>
               <a href="./peroduck/produk.php"><h3 class="next-title">Lihat Selengkapnya</h3></a>
                <!-- <p class="menu-card-price"> IDR 50K</p> -->
            </div>     
        </div>
    </section>
<!-- Menu section end -->

<!-- Contact Section Start -->
    <section id="contact" class="contact">
        <h2>Terhubung Dengan <span>Kami</span></h2>
        <div class="row">
            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.8768809103053!2d113.64735982314045!3d-8.114016704568082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd693fb58ae64b3%3A0xf8b3db9a6c15f8c4!2sTPQ%20AL%20-%20KHOTIB!5e0!3m2!1sid!2sid!4v1692626832666!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe> -->
                <div id="map">
 
                <script src="https://maps.googleapis.com/maps/api/js?key=&callback=GMPStart" async defer></script>
                <script type="text/javascript">   
                    
                    let map;
                    let infoWindow;
                    let mapOptions;
                    let bounds;
                
                    function GMPStart(){
                        infoWindow = new google.maps.InfoWindow;
                        mapOptions = {
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        } 
                        map = new google.maps.Map(document.getElementById('map'), mapOptions);
                        bounds = new google.maps.LatLngBounds();
                        <?php
                            $host     = "localhost";
                            $username = "root";
                            $password = "";
                            $Dbname   = "cedass";
                            $db       = new mysqli($host,$username,$password,$Dbname);
                            
                            $query = $db->query("SELECT alamat,lintang FROM franchise WHERE status = 'Disetujui' ORDER BY alamat ASC");
                            while ($row = $query->fetch_assoc()) {
                                $nama = $row["alamat"];
                                $long = $row["lintang"];
                                echo "addMarker($long, '$nama');\n";
                            }
                        ?>
                        var location;
                        var marker;
                        function addMarker(lat, lng, info){
                            location = new google.maps.LatLng(lat, lng);
                            bounds.extend(location);
                            marker = new google.maps.Marker({
                                map: map,
                                position: location
                            });       
                            map.fitBounds(bounds);
                            bindInfoWindow(marker, map, infoWindow, info);
                        }
                        function bindInfoWindow(marker, map, infoWindow, html){
                            google.maps.event.addListener(marker, 'click', function() {
                            infoWindow.setContent(html);
                            infoWindow.open(map, marker);
                        });
                        }
                    }
                </script>
                </div>
            <form action="">
                <div class="input-group">
                    <i data-feather="map-pin"></i>
                    <input type="input" placeholder="Jl.Letjend Suprapto No.XIX" disabled>
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="text" placeholder="Cedas@gmail.com" disabled>
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="text" placeholder="085707038940" disabled>
                </div>
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
    <a href="#home">Beranda</a>
    <a href="#about">Tentang Kami</a>
    <a href="./franchise/franchise.php" target="_self">Franchise</a>
    <a href="#menu">Produk</a>
    <a href="#contact">Kontak</a>
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
<script src="js/script.js"></script>

</body>
</html>