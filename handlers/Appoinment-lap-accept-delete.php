<?php


session_start();
$id=$_GET['id'];
include '../database/database.php';
if(isset($_SESSION['login']['id_user'])){
$id_user=$_SESSION['login']['id_user'];
if(isset($_GET['id'])&&$_GET['id']!=null){
$sql_del="DELETE FROM `appoinment_lap_accept` WHERE `app_acc_lap_id`='$id' AND `lap_id`='$id_user'";
$result_del=mysqli_query($conn,$sql_del);
header('Location:../dashborad-lap-appoinment.php');
}
}


?>