<?php 
session_start();
require '../conek.php';
if(!isset($_SESSION["login"])){
    header("location: ../login.php");
    exit;
}

$bukanid = $_COOKIE['bukanid'];
// Tambahkan query untuk mendapatkan username berdasarkan ID
$user_query = mysqli_query($con, "SELECT * FROM user WHERE id = '$bukanid'");
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
        alert('DATA BERHASIL DI EDIT');
        document.location.href = 'profil.php';
        </script>
        ";
    }else{
        // echo "
        // <script>
        // alert('DATA GAGAL DI EDIT');
        // document.location.href = 'profil.php';
        // </script>
        // ";
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

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<!-- Style -->
<link rel="stylesheet" href="css/profi.css">
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar">

<a class="icon1" href="../dashboard/dashboard.php">
    <img src="./img/1.png" alt="logo">
</a>
    
    <div class="navbar-nav">
    <a href="#"><?php echo $user_fullname ?></a>
   
</div>
<div class="navbar-extra">
<a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
</div>   
</nav>
<!-- Navbar End -->

<!-- About section start -->
    <section id="about" class="about">
        <!-- <h2><span>Pro</span>fil</h2> -->
        <div class="row">
            <div class="about-img" id="profile-image">
                    <?php
                        $base64Image = base64_encode($user_gambar);
                        echo '<img src="data:image/jpeg;base64,' . $base64Image . '"  />';
                    ?>
            </div>
            
            <div class="content">
                <form action="" method="post" enctype="multipart/form-data">
               
                    
                    <div class="input-group">
                        <i data-feather="key"></i>
                        <input type="input" placeholder="Username"required name="usern" value="<?php echo $user_fullname ?>">
                    </div>
                    <div class="input-group">
                        <i data-feather="user"></i>
                        <input type="input" placeholder="Nama Lengkap" required  name="nam" value="<?php echo $user_email ?>">
                    </div>
                    <div class="input-group">
                        <i data-feather="map-pin"></i>
                        <input type="input" placeholder="Alamat" required name="alamat" value="<?php echo $user_alamat ?>">
                    </div>
                    <div class="input-group">
                    <p>Jenis Kelamin</p>
                    <select name="jk" id="jk"  >
                    <option><?php echo $user_jk ?></option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                    </div>
                    <div class="input-group">
                        <i data-feather="phone"></i>
                        <input type="input" placeholder="No.Telp" required name="notel" value="<?php echo $nohp ?>">
                    </div>
                    <div class="input-group">
                        <i data-feather="calendar"></i>
                        <input type="date" placeholder="Tanggal Lahir" required name="ttl" value="<?php echo $tgl ?>">
                    </div>
                    <div class="input-group" id="fi">
                        <i data-feather="camera"></i>
                        <input type="file" placeholder="Unggah Foto" name="ung" id="ung">
                    </div>
                    <div class="input" id="hid">
                        
                        <input type="text" placeholder=" " required name="id" id="ids" value="<?php echo $bukanid ?>" style="visibility: hidden;
    border-bottom: 1px solid rgb(255, 255, 255);">
                    </div>
                  
                        <button class="subm" name="ubah">Submit</button>
                </form>
            </div>
            
        </div>
    </section>
<!-- About section end -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var profileImage = document.getElementById('profile-image');
        profileImage.addEventListener('click', function () {
            document.getElementById('ung').click();
        });
    });
</script>

<!-- Icons -->
    <script>
        feather.replace();
      </script>

<!-- Javascript -->
<script src="js/prof.js"></script>

</body>
</html>