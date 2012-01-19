<?php
include_once('config/connection.php');
if($_SESSION['login']==true){
unset($_SESSION['login']);
session_destroy();
header("Location: index.php");
exit;
}else{
header("Location: index.php");
exit;
}
?>