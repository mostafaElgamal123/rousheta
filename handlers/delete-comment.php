<?php

session_start();
$id=$_GET['id'];
include '../database/database.php';
if(isset($_GET['id'])&&$_GET['id']!=null){
$sql_del="DELETE FROM `comments` WHERE `comment_id`='$id'";
$result_del=mysqli_query($conn,$sql_del);
if(!$result_del){
    $_SESSION['errors_comment']=['not delete comment'];
}else{
    $_SESSION['success_comment']=["successfuly"];
    header('Location:../profile.php');
}
}


?>