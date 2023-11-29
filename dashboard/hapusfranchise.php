<?php 
session_start();
if(!isset($_SESSION["login"])){
    header("location: dashboard.php");
    exit;
}

require '../conek.php';
$id_franchise = $_GET["id_franchise"];
if (hapusfran($id_franchise) > 0){
    echo "
        <script>
        alert('DATA BERHASIL DI DI HAPUS');
        document.location.href = 'dashboard.php';
        </script>
    "; 
}else{
    echo "
        <script>
        alert('DATA GAGAL DI DI HAPUS');
        document.location.href = 'dashboard.php';
        </script>
    ";
}
?>