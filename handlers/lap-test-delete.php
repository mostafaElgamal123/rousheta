<?php

session_start();
$id=$_GET['id'];
include '../database/database.php';
if(isset($_GET['id'])&&$_GET['id']!=null){
$sql_del="DELETE FROM `list_test_patient_with_lap` WHERE `test_id`='$id'";
$result_del=mysqli_query($conn,$sql_del);
if(!$result_del){
    $_SESSION['errors']=['not delete test'];
}else{
    $_SESSION['success']=["successfuly"];
    header('Location:../dashborad-lap-test-patient.php');
}
}


?>