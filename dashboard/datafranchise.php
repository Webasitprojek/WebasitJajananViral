<?php 
session_start();
require '../conek.php';
if(!isset($_SESSION["login"])){
    header("location: ../login.php");
    exit;
}

$bukanid = $_COOKIE['bukanid'];
// Tambahkan query untuk mendapatkan username berdasarkan ID
$user_query = mysqli_query($con, "SELECT username,gambar FROM user WHERE id = '$bukanid'");
$user_data = mysqli_fetch_assoc($user_query);
$user_fullname = $user_data['username'];
$user_gambar = $user_data['gambar'];
$search = isset($_SESSION["search"]) ? $_SESSION["search"] : "";

$jumlahdataperhalaman = 10;
    $cara = count(query("SELECT * FROM franchise WHERE franchise.nama LIKE '%$search%'"));
    $jumlahalaman = ceil($cara / $jumlahdataperhalaman);
    $halamanaktif = (isset(  $_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
    $caratampil = query("SELECT * FROM franchise WHERE franchise.nama LIKE '%$search%' LIMIT $awaldata , $jumlahdataperhalaman");


if(isset($_POST["cari"])){
    $_SESSION['search'] = $_POST["cari"];
    header("Location: datafranchise.php");
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
    <link rel="stylesheet" href="css/das2.css">
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

                <div class="search">
                    <form action="datafranchise.php" id="formCari" method="post">
                    <label>
                        <input type="text" placeholder="Search here" name="cari" id="cari">
                        <a href="#" onclick=""></a><ion-icon name="search-outline"></ion-icon>
                    </label>
                    </form>
                </div>
                 <!-- jam start -->
                 <div class="jam">
                    <p><span id="tanggalwaktu"></span></p>
                    <script>
                        function updateJam() {
                            var dt = new Date();
                            document.getElementById("tanggalwaktu").innerHTML = dt.toLocaleTimeString();
                        }

                        // Memanggil fungsi updateJam setiap detik
                        setInterval(updateJam, 1000);

                        // Memanggil fungsi updateJam secara langsung saat halaman dimuat
                        updateJam();
                    </script>
                </div>

            <!-- jam end -->
                
                <div class="pro">
                    <a href="../profile/profil.php">
                        <?php echo $user_fullname ?>
                    </a>
                </div>

                <div class="user">
                    <?php
                        $base64Image = base64_encode($user_gambar);
                        echo '<img src="data:image/jpeg;base64,' . $base64Image . '" style="max-width: 52px; max-height: 52px;" />';
                    ?>
                </div>
            
           
            
            </div>
            <h1 class="judul">Data Franchise</h1>
            <div id="cont">
                <table border="3" cellpadding="10" cellspacing="0" class="tab" style="position: center;">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Button Aksi</th>
                    </tr>
                    <?php $y = 1; ?>
                    <?php foreach ($caratampil as $row): ?>
                    <tr>
                        <td><?php echo $row["id_franchise"]; ?></td>
                        <td><?php echo $row["nama"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["no_telp"]; ?></td>
                        <td><?php echo $row["alamat"]; ?> <br> <?php echo $row["lintang"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                        
                        <td>
                            <div class="aksibox">
                                <div class="editbox">
                                    <a href="editfranchise.php?id_franchise=<?php echo $row["id_franchise"]; ?>" >EDIT</a>
                                </div>
                                <div class="hapusbox">
                                    <a href="hapusfranchise.php?id_franchise=<?php echo $row["id_franchise"]; ?>" onclick="return confirm('Yakin Ingin Menghapus Data?');">HAPUS</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </table>
                </div>

                <div id="pag">
                <?php if($halamanaktif > 1): ?>
                    <div id="pagination"><a href="?halaman=1">&laquo F</a></div>
                    <div id="pagination"><a href="?halaman=<?= $halamanaktif - 1; ?>">&laquo;</a></div>
                    
                <?php endif; ?>
                <?php for($f = 1; $f <= $jumlahalaman; $f++) :?>
                    <?php if($f == $halamanaktif): ?>
                    <div id="pagination" style="background-color: darkred;"><a href="?halaman=<?= $f; ?>" style="color: white;" ><?= $f; ?></a></div>
                    <?php else: ?>
                    <div id="pagination"><a href="?halaman=<?= $f; ?>"><?= $f; ?></a></div>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if($halamanaktif < $jumlahalaman): ?>
                    <div id="pagination"><a href="?halaman=<?= $halamanaktif + 1; ?>">&raquo;</a></div>
                    <div id="pagination"><a href="?halaman=<?= $halamanaktif + $jumlahalaman - $halamanaktif; ?>">L &raquo;</a></div>
                <?php endif; ?>
                </div>
                </div>
            </div>



            <!-- ========================= TOPBAR END ==================== -->
            <!-- mulai tabel -->
        

        <script src="js/main.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('cari').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('formCari').submit();
                }
            });
        });
    </script>  
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>