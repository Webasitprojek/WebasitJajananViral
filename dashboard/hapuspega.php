<?php 
session_start();
if(!isset($_SESSION["login"])){
    header("location: dashboard.php");
    exit;
}

require '../conek.php';
$username = $_GET["username"];
if (hapuspega($username) > 0){
    echo "
        <script>
        alert('Data Berhasil Di Hapus');
        document.location.href = 'datapegawai.php';
        </script>
    "; 
}else{
    echo "
        <script>
        alert('Data Gagal Di Hapus');
        document.location.href = 'datapegawai.php';
        </script>
    ";
}
?>