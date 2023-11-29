<?php 
session_start();
if(!isset($_SESSION["login"])){
    header("location: dashboard.php");
    exit;
}

require '../conek.php';
$id_franchise = $_GET["id_franchise"];
$ubah = query("SELECT * FROM franchise WHERE franchise.id_franchise = '$id_franchise'")[0];

if(isset($_POST["edit"])){
    if(editfran($_POST) > 0){
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
    <link rel="stylesheet" href="css/style2.css">
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
                <div class="foo">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Edit Data Franchise</h1>
                <hr>
                
                <input type="text" placeholder="ID Franchise" id="idbar" name="idbar" required value="<?= $ubah["id_franchise"]; ?>">
              
                <input type="text" placeholder="Nama" id="nbar" name="nbar" required value="<?= $ubah["nama"]; ?>">
                
                <input type="text" placeholder="Email" id="vari" name="vari" required value="<?= $ubah["email"]; ?>">
              
                <input type="text" placeholder="No Hp" id="des" name="des" required value="<?= $ubah["no_telp"]; ?>">
               
                <input type="text" placeholder="Alamat" id="har" name="har" required value="<?= $ubah["alamat"]; ?>">

                <input type="text" placeholder="Bujur Lintang" id="lin" name="lin" required value="<?= $ubah["lintang"]; ?>">

                <input type="text" placeholder="Status" id="sta" name="sta" required value="<?= $ubah["status"]; ?>">

                <button type="submit" name="edit">Edit</button>
                
            </form>
            </div>
            </div>
            <!-- ========================= TOPBAR END ==================== -->

        <script src="js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>