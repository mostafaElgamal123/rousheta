<?php

session_start();
$id_accept=$_GET['id'];
include '../database/database.php';
$sql="SELECT * FROM `appoinment_lap` WHERE `app_lap_id`='$id_accept'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
if($result){
    $Patient_name=$row['Patient_name'];
    $Patient_date=$row['Patient_date'];
    $Patient_time=$row['Patient_time'];
    $type_test=$row['type_test'];
    $lap_id=$row['lap_id'];
    $patient_id=$row['patient_id'];
    if(isset($_SESSION['login']['id_user'])){
        $id_user=$_SESSION['login']['id_user'];
        $sql_lap="SELECT `username` FROM `laps` WHERE `reg_id`='$id_user'";
        $result_lap=mysqli_query($conn,$sql_lap);
        $row_lap=mysqli_fetch_assoc($result_lap);
        $lap_name=$row_lap['username'];
    }
    $sql="INSERT INTO `appoinment_lap_accept`(`Patient_name`, `Patient_date`, `Patient_time`,`type_test`,`lap_id`, `patient_id`) VALUES ('$Patient_name','$Patient_date','$Patient_time','$type_test','$lap_id','$patient_id')";
    $sql_patient_requst="INSERT INTO `patient_request`(`doc_lap_name`, `Patient_date`, `Patient_time`, `type_test`, `request_id`, `patient_id`) VALUES ('$lap_name','$Patient_date','$Patient_time','$type_test','$lap_id','$patient_id')";
    $result1=mysqli_query($conn,$sql);
    $result2=mysqli_query($conn,$sql_patient_requst);
    if($result1){
        if(isset($_SESSION['login']['id_user'])){
            $id_user=$_SESSION['login']['id_user'];
        }
        $sql="DELETE FROM `appoinment_lap` WHERE `app_lap_id`='$id_accept' AND `lap_id`='$id_user'";
        $result=mysqli_query($conn,$sql);
        header('Location:../dashborad-lap-request.php');
    }
}



?>