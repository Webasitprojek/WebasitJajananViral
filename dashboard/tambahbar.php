<?php 
session_start();
require '../conek.php';
if(!isset($_SESSION["login"])){
    header("location: ../login.php");
    exit;
}

$search = isset($_SESSION["search"]) ? $_SESSION["search"] : "";

if(isset($_POST["tambah"])){
    if(tambah($_POST) > 0){
        echo "
        <script>
        alert('Data Berhasil Ditambahkan');
        document.location.href = 'dashboard.php';
        </script>
        ";    
    }else{
        echo "
        <script>
        alert('Data Gagal Ditambahkan');
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
    <link rel="stylesheet" href="css/tambahbar.css">
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
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Akun Pegawai</span>
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
                    <a href="../logout.php">
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
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Tambah Produk</h1>
                <hr>
                
                <input type="text" placeholder="ID Barang" id="idbar" name="idbar" required>
              
                <input type="text" placeholder="Nama Barang" id="nbar" name="nbar" required>
                
                <input type="text" placeholder="Varian" id="vari" name="vari" required>
              
                <input type="text" placeholder="Deskripsi" id="des" name="des" required>
               
                <input type="text" placeholder="Harga" id="har" name="har" required>
                
                <input type="text" placeholder="Link" id="li" name="li" required>

                <input type="file" placeholder="Upload Image" id="up" name="up" required>


               
                
                <button type="submit" name="tambah">Tambah</button>
                
            </form>

            <!-- ========================= TOPBAR END ==================== -->

        <script src="js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>