<?php


session_start();
$id=$_GET['id'];
include '../database/database.php';
if(isset($_SESSION['login']['id_user'])){
$id_user=$_SESSION['login']['id_user'];
if(isset($_GET['id'])&&$_GET['id']!=null){
$sql_del="DELETE FROM `medicine` WHERE `med_id`='$id' AND `pharm_id`='$id_user'";
$result_del=mysqli_query($conn,$sql_del);
header('Location:../dashborad-medicine.php');
}
}


?>