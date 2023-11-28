<?php 
require '../conek.php';

$barang_query = mysqli_query($con, "SELECT nama_barang, harga, gambar FROM barang");
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
    <link rel="stylesheet" href="css/produk.css">
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar">

<a class="icon1" href="../index.php">
    <img src="./img/6.png" alt="logo">
</a>
    
    <div class="navbar-nav">
        <a href="../index.php">Beranda</a>
        <a href="../franchise/franchise.php">Franchise</a>
        <a href="produk.php">Produk</a>
        <a href="#contact">Kontak</a>
    </div>
    <div class="navbar-extra">
        <!-- <a href="#" id="key"> <i data-feather="key"></i></a> -->
        <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
    </div>   
</nav>
<!-- Navbar End -->

<!-- Menu section start -->
<section id="menu" class="menu">
    <h2><span>Produk</span> Kami</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio mollitia quibusdam</p>
    <div class="row">
        <?php while ($barang_data = mysqli_fetch_assoc($barang_query)): ?>
            <a href="detailproduk.php?nama_barang=<?php echo urlencode($barang_data['nama_barang']); ?>" style="color: white;">
                <div class="menu-card">
                    <?php
                        $base64Image = base64_encode($barang_data['gambar']);
                        echo '<img src="data:image/jpeg;base64,' . $base64Image . '" class="menu-card-img" />';
                    ?>
                    <h3 class="menu-card-title"><?php echo $barang_data['nama_barang']; ?></h3>
                    <p class="menu-card-price">IDR <?php echo $barang_data['harga']; ?></p>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
</section>
<!-- Menu section end -->

<!-- Icons -->
<script>
    feather.replace();
</script>

<!-- Javascript -->
<script src="js/produk.js"></script>

</body>
</html>
