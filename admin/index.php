<?php
include_once('config/connection.php');
if($_SESSION['login']==true){
header("Location: content.php");
exit;
}else{
header("Location: login.php");
exit;
}
?>