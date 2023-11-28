<?php
require '../conek.php';

$nama_barang = $_GET["nama_barang"];

$tampil = mysqli_query($con, "SELECT barang.id_barang, barang.gambar, barang.nama_barang, detail_barang.varian, barang.deskripsi, barang.harga, barang.link
FROM barang
JOIN detail_barang
ON barang.id_barang = detail_barang.id_barang 
WHERE barang.nama_barang = '$nama_barang'");

// Check if the query was successful
if ($tampil) {
    $barang_data = mysqli_fetch_assoc($tampil);
    $barang_nama = $barang_data['nama_barang'];
    $gambar_barang = $barang_data['gambar'];
    $link_barang = $barang_data['link'];
    $varian_barang = $barang_data['varian'];
    $deskripsi_barang = $barang_data['deskripsi'];
    $harga_barang = $barang_data['harga'];

} else {
    // Handle the error, e.g., print an error message or log it
    echo "Error: " . mysqli_error($con);
    // You might want to redirect the user or show a friendly error page
    exit;
}
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
    <link rel="stylesheet" href="css/pro.css">
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar">

<a class="icon1" href="../index.php">
    <img src="./img/6.png" alt="logo">
</a>
    
    <div class="navbar-nav">
        <!-- ... (your navbar links) ... -->
    </div>
    <div class="navbar-extra">
        <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
    </div>   
</nav>
<!-- Navbar End -->

<!-- About section start -->
<section id="about" class="about">
    <div class="row">
        <div class="about-img">
            <?php
            $base64Image = base64_encode($barang_data['gambar']);
            echo '<img src="data:image/jpeg;base64,' . $base64Image . '" class="menu-card-img" />';
            ?>
        </div>

        <div class="content">
            <div class="prod">
                <h3><?php echo $barang_nama ?></h3>
                <h1>Rp. <?php echo $harga_barang ?></h1>
                <h4>Varian : <?php echo $varian_barang ?></h4><br>
                <p class="oo">Deskripsi Produk <br><?php echo $deskripsi_barang ?></p>
                <a href="<?php echo $link_barang ?>" target="_blank">Pesan Sekarang</a>
            </div>
        </div>
    </div>
</section>
<!-- About section end -->

<!-- Icons -->
<script>
    feather.replace();
</script>

<!-- Javascript -->
<script src="js/prof.js"></script>

</body>
</html>
