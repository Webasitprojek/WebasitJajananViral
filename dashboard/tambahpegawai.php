<?php 
session_start();
require '../conek.php';
if(!isset($_SESSION["login"])){
    header("location: ../login.php");
    exit;
}

if(isset($_POST["ubah"])){
    if(registrasi($_POST) > 0){
        echo "
        <script>
        alert('Data Berhasil Ditambahkan');
        document.location.href = 'datapegawai.php';
        </script>
        ";
    }else{
        echo "
        <script>
        alert('Data Gagal Ditambahkan');
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
            <img id="preview-image" src="./imgs/customer01.jpg" alt="Preview Image">
                </div>
                <div class="foo">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Tambah Pegawai</h1>
                <hr>
                
                <input type="text" placeholder="Username" id="user" name="user" required>
              
                <input type="email" placeholder="Email" id="email" name="email" required>
                
                <input type="text" placeholder="Alamat" id="alam" name="alam" required>
              
                
                <select name="jk" id="jk">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
               
                <input type="text" placeholder="No.Hp" id="hp" name="hp" required>
                
                <input type="date" placeholder="Tanggal Lahir" id="ttl" name="ttl" required>

                <input type="text" placeholder="Password" id="password" name="password" required>
               

                <input type="file" placeholder="Unggah Foto" name="ung" id="ung" onchange="previewImage()">

                <button type="submit" name="ubah" class="subm">Tambah</button>
                
            </form>
            </div>
         </div>

         <script>
        function previewImage() {
            console.log('Fungsi dipanggil');

            var fileInput = document.getElementById('ung');
            var barangImage = document.getElementById('barang-image');
            
            fileInput.addEventListener('change', function () {
                console.log('File dipilih');

                var file = fileInput.files[0];
                var reader = new FileReader();

                reader.onload = function (e) {
                    console.log('Gambar dimuat');

                    var img = document.createElement('img');
                    img.src = e.target.result;

                    barangImage.innerHTML = '';
                    barangImage.appendChild(img);
                };

                // Membaca data URL dari file gambar
                reader.readAsDataURL(file);
            });
        }
    </script>
        
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