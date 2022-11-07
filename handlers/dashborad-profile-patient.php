<?php
session_start();
$errors=[];
if(isset($_POST['create_profile'])&&$_SERVER['REQUEST_METHOD']=='POST'){
    
    //get value
    $date_of_birth=trim(htmlspecialchars($_POST['date_of_birth']));
    $blood_type=trim(htmlspecialchars($_POST['blood_type']));
    $personal_id=trim(htmlspecialchars($_POST['personal_id']));
    $weight=trim(htmlspecialchars($_POST['weight']));
    $height=trim(htmlspecialchars($_POST['height']));
    $member_since=trim(htmlspecialchars($_POST['member_since']));
    //validation
    include '../functions/functions.php';
    if(empty($date_of_birth)){
        $errors[]='must type date of birth';
    }
    if(empty($blood_type)){
        $errors[]='must type blood type';
    }
    if(empty($personal_id)){
        $errors[]='must type personal id';
    }elseif(!minlength($personal_id,3)){
        $errors[]='must type personal id > 3';
    }elseif(!maxlength($personal_id,12)){
        $errors[]='must type personal id < 12';
    }
    if(empty($weight)){
        $errors[]='must type weight';
    }
    if(empty($height)){
        $errors[]='must type height';
    }
    if(empty($member_since)){
        $errors[]='must type member since';
    }
    if(empty($errors)){
        if(isset($_SESSION['login']['id_user'])){
            $user_id=$_SESSION['login']['id_user'];
            include '../database/database.php';
            $sql_insert="INSERT INTO `patient`(`date_of_birth`, `blood_type`, `personal_id`, `weight`, `height`, `member_since`, `reg_id`) VALUES ('$date_of_birth','$blood_type','$personal_id','$weight','$height','$member_since','$user_id')";
            $result_insert=mysqli_query($conn,$sql_insert);
            if(!$result_insert){
                $_SESSION['errors']=['not add profile'];
            }else{
               header('Location:../dashborad-profile-patient.php');
            }
        }
        
    }else{
        $_SESSION['errors']=$errors;
        header('Location:../dashborad-profile-patient.php');
    }
}



?>