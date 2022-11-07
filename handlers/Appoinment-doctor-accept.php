<?php

session_start();
$id_accept=$_GET['id'];
include '../database/database.php';
$sql="SELECT * FROM `appoinment_doctor` WHERE `app_id`='$id_accept'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
if($result){
    $Patient_name=$row['Patient_name'];
    $Patient_date=$row['Patient_date'];
    $Patient_time=$row['Patient_time'];
    $doctor_id=$row['doctor_id'];
    $reg_id=$row['reg_id'];
    if(isset($_SESSION['login']['id_user'])){
        $id_user=$_SESSION['login']['id_user'];
        $sql_doc="SELECT `username` FROM `register_user` WHERE `reg_id`='$id_user'";
        $result_doc=mysqli_query($conn,$sql_doc);
        $row_doc=mysqli_fetch_assoc($result_doc);
        $doc_name=$row_doc['username'];
    }
    $sql="INSERT INTO `appoinment_doctor_accept`(`Patient_name`, `Patient_date`, `Patient_time`,`doctor_id`, `reg_id`) VALUES ('$Patient_name','$Patient_date','$Patient_time','$doctor_id','$reg_id')";
    $sql_patient_requst="INSERT INTO `patient_request`(`doc_lap_name`, `Patient_date`, `Patient_time`, `type_test`, `request_id`, `patient_id`) VALUES ('$doc_name','$Patient_date','$Patient_time',' ','$doctor_id','$reg_id')";
    $result1=mysqli_query($conn,$sql);
    $result2=mysqli_query($conn,$sql_patient_requst);
    if($result1){
        if(isset($_SESSION['login']['id_user'])){
            $id_user=$_SESSION['login']['id_user'];
        }
        $sql="DELETE FROM `appoinment_doctor` WHERE `app_id`='$id_accept' AND `doctor_id`='$id_user'";
        $result=mysqli_query($conn,$sql);
        header('Location:../dashborad-doctor-request.php');
    }
}



?>