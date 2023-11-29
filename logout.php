<?php 
session_start();
$_SESSION = [];
session_unset();
session_destroy();
setcookie('bukanid', '', time()-180);
setcookie('bukanuser', '', time()-180);
header("location: login.php");
exit;
?>