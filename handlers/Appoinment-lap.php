<?php

session_start();
$errors=[];
if(isset($_POST['appoinment_patient'])&&$_SERVER['REQUEST_METHOD']=="POST"){
    //get value
    $pat_name=trim(htmlspecialchars($_POST['pat_name']));
    $pat_date=trim(htmlspecialchars($_POST['pat_date']));
    $pat_time=trim(htmlspecialchars($_POST['pat_time']));
    $type_test=trim(htmlspecialchars($_POST['type_test']));

    //validation
    include '../functions/functions.php';
    if(empty($pat_name)){
        $errors[]='must type name Patient';
    }elseif(!minlength($pat_name,2)){
        $errors[]='must type name Patient > 2';
    }elseif(!maxlength($pat_name,20)){
        $errors[]='must type name Patient < 20';
    }
    if(empty($pat_date)){
        $errors[]='must type date';
    }
    if(empty($pat_time)){
        $errors[]='must type time';
    }
    if(empty($type_test)){
        $errors[]='must type type test';
    }
    if(empty($errors)){
        if(isset($_SESSION['login']['id_user'])&&isset($_GET['id'])){
            $id_lap=$_GET['id'];
            $id_user=$_SESSION['login']['id_user'];
            include '../database/database.php';
            $sql="INSERT INTO `appoinment_lap`(`Patient_name`, `Patient_date`, `Patient_time`,`type_test`,`lap_id`, `patient_id`) VALUES ('$pat_name','$pat_date','$pat_time','$type_test','$id_lap','$id_user')";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['success']=['successfly'];
                header("Location:../single-profile-lap.php?id=$id_lap");
            }else{
                $_SESSION['errors']=['not appoinment'];
                header("Location:../single-profile-lap.php?id=$id_lap");
            }
        }
    }else{
        if(isset($_GET['id'])){
            $id_lap=$_GET['id'];
        }
        $_SESSION['errors']=$errors;
        header("Location:../single-profile-lap.php?id=$id_lap");
    }
}



?>