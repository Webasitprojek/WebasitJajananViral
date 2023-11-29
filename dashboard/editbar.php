<?php 
session_start();
if(!isset($_SESSION["login"])){
    header("location: dashboard.php");
    exit;
}

require '../conek.php';
$id_barang = $_GET["id_barang"];
$ubah = query("SELECT barang.id_barang, barang.gambar, barang.nama_barang, detail_barang.varian, barang.deskripsi, barang.harga, barang.link
FROM barang
JOIN detail_barang
ON barang.id_barang = detail_barang.id_barang 
WHERE barang.id_barang = '$id_barang'")[0];

if(isset($_POST["edit"])){
    if(edit($_POST) > 0){
        echo "
        <script>
        alert('Data Berhasil Di Edit');
        document.location.href = 'dashboard.php';
        </script>
        ";
    }else{
        echo "
        <script>
        alert('Data Gagal Di Edit');
        document.location.href = 'dashboard.php';
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
    <link rel="shortcut icon" href="../images/5.4.png">
    <title>Cemilan Pedas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- SIDEBAR -->
    <div class="container">
        <div class="navigation">
        <ul>
                <li>
                    <a href="dashboard.php">
                        <span class="icon1">
                            <img src="./imgs/5.4.png" alt="">
                        </span>
                        <span class="title">si<span>CEDAS</span></span>
                    </a>
                </li>

                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="datapegawai.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Akun Admin</span>
                    </a>
                </li>

                <li>
                    <a href="datafranchise.php">
                        <span class="icon">
                           <ion-icon name="storefront-outline"></ion-icon>
                        </span>
                        <span class="title">Franchise</span>
                    </a>
                </li>

                <li>
                    <a href="../logout.php" onclick="return confirm('Anda Yakin Ingin Keluar Dari Dashboard Admin?');">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- SIDEBAR END -->

         <!-- ========================= TOPBAR  ==================== -->

         <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                
                <div class="pro">
                    <a href="#">Profil</a>
                </div>

                <div class="user">
                    <img src="imgs/customer3.jpg" alt="profil">
                </div>
            </div>
           
              
                    
               

            <div class="fom">
            <div class="ima" id="barang-image">
                    <?php
                        $base64Image = base64_encode($ubah["gambar"]);
                        echo '<img src="data:image/jpeg;base64,' . $base64Image . '"  />';
                    ?>
                </div>
                <div class="foo">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Edit Produk</h1>
                <hr>
                
                <input type="text" placeholder="ID Barang" id="idbar" name="idbar" required value="<?= $ubah["id_barang"]; ?>">
              
                <input type="text" placeholder="Nama Barang" id="nbar" name="nbar" required value="<?= $ubah["nama_barang"]; ?>">
                
                <input type="text" placeholder="Varian" id="vari" name="vari" required value="<?= $ubah["varian"]; ?>">
              
                <input type="text" placeholder="Deskripsi" id="des" name="des" required value="<?= $ubah["deskripsi"]; ?>">
               
                <input type="text" placeholder="Harga" id="har" name="har" required value="<?= $ubah["harga"]; ?>">
                
                <input type="text" placeholder="Link" id="li" name="li" required value="<?= $ubah["link"]; ?>">

                <input type="file" placeholder="Upload Image" id="up" name="up">


               
                
                <button type="submit" name="edit">Edit</button>
                
            </form>
            </div>
         </div>
        
            <!-- ========================= TOPBAR END ==================== -->

        <script src="js/main.js"></script>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        var profileImage = document.getElementById('barang-image');
        profileImage.addEventListener('click', function () {
            document.getElementById('up').click();
        });
    });
</script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>