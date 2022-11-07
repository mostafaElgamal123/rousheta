<?php

session_start();
$errors=[];
if(isset($_POST['appoinment_patient'])&&$_SERVER['REQUEST_METHOD']=="POST"){
    //get value
    $pat_name=trim(htmlspecialchars($_POST['pat_name']));
    $pat_date=trim(htmlspecialchars($_POST['pat_date']));
    $pat_time=trim(htmlspecialchars($_POST['pat_time']));
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
    if(empty($errors)){
        if(isset($_SESSION['login']['id_user'])&&isset($_GET['id'])){
            $id_doc=$_GET['id'];
            $id_user=$_SESSION['login']['id_user'];
            include '../database/database.php';
            $sql="INSERT INTO `appoinment_doctor`(`Patient_name`, `Patient_date`, `Patient_time`,`doctor_id`, `reg_id`) VALUES ('$pat_name','$pat_date','$pat_time','$id_doc','$id_user')";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['success']=['successfly'];
                header("Location:../single-profile-doctor.php?id=$id_doc");
            }else{
                $_SESSION['errors']=['not appoinment'];
                header("Location:../single-profile-doctor.php?id=$id_doc");
            }
        }
    }else{
        if(isset($_GET['id'])){
            $id_doc=$_GET['id'];
        }
        $_SESSION['errors']=$errors;
        header("Location:../single-profile-doctor.php?id=$id_doc");
    }
}



?>