<?php 
session_start();
require '../conek.php';
if(!isset($_SESSION["login"])){
    header("location: ../login.php");
    exit;
}

// $bukanid = $_COOKIE['bukanid'];
// Tambahkan query untuk mendapatkan username berdasarkan ID
$id = $_GET["id"];
$user_query = mysqli_query($con, "SELECT * FROM user WHERE id = '$id'");
$user_data = mysqli_fetch_assoc($user_query);
$user_fullname = $user_data['username'];
$user_gambar = $user_data['gambar'];
$user_alamat = $user_data['alamat'];
$user_jk = $user_data['jenis_kelamin'];
$nohp = $user_data['no_hp'];
$tgl = $user_data['tgl_lahir'];
$user_email = $user_data['email'];

if(isset($_POST["ubah"])){
    if(editprofil($_POST) > 0){
        echo "
        <script>
        alert('Data Berhasil Di Edit');
        document.location.href = 'datapegawai.php';
        </script>
        ";
    }else{
        echo "
        <script>
        alert('Data Gagal Di Edit');
        document.location.href = 'datapegawai.php';
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
                        $base64Image = base64_encode($user_gambar);
                        echo '<img src="data:image/jpeg;base64,' . $base64Image . '"  />';
                    ?>
                </div>
                <div class="foo">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Edit Pegawai</h1>
                <hr>
                
                <input type="input" placeholder="Username"required name="usern" value="<?php echo $user_fullname ?>">
              
                <input type="input" placeholder="Nama Lengkap" required  name="nam" value="<?php echo $user_email ?>">
                
                <input type="input" placeholder="Alamat" required name="alamat" value="<?php echo $user_alamat ?>">
              
                <select name="jk" id="jk"  >
                    <option><?php echo $user_jk ?></option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                    </select>
               
                <input type="input" placeholder="No.Telp" required name="notel" value="<?php echo $nohp ?>">
                
                <input type="date" placeholder="Tanggal Lahir" required name="ttl" value="<?php echo $tgl ?>">

                <input type="file" placeholder="Unggah Foto" name="ung" id="ung">

                <input type="text" placeholder=" " required name="id" id="ids" value="<?php echo $id ?>" style="visibility: hidden;
    border-bottom: 1px solid rgb(255, 255, 255);">


               
                
                <button type="submit" name="ubah" class="subm">Edit</button>
                
            </form>
            </div>
         </div>
        
            <!-- ========================= TOPBAR END ==================== -->

        <script src="js/main.js"></script>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        var profileImage = document.getElementById('barang-image');
        profileImage.addEventListener('click', function () {
            document.getElementById('ung').click();
        });
    });
</script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>