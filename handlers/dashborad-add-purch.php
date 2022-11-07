<?php

session_start();
$errors=[];
if(isset($_POST['create_medicine'])&&$_SERVER['REQUEST_METHOD']=="POST"){
    //get value
    $name=trim(htmlspecialchars($_POST['name']));
    $location=trim(htmlspecialchars($_POST['location']));
    $med_count=trim(htmlspecialchars($_POST['med_count']));
    $med_price=trim(htmlspecialchars($_POST['med_price']));
    $med_pharmacy=trim(htmlspecialchars($_POST['phar_name']));
    $med_code=trim(htmlspecialchars($_POST['med_code']));
    $med_image=$_FILES['med_image'];
    //validation
    include '../functions/functions.php';
    if(empty($name)){
        $errors[]='must type  name';
    }elseif(!minlength($name,3)){
        $errors[]='must type  name > 3';
    }elseif(!maxlength($name,15)){
        $errors[]='must type  name < 12';
    }
    if(empty($location)){
        $errors[]='must type  location';
    }elseif(!minlength($location,3)){
        $errors[]='must type  location > 3';
    }elseif(!maxlength($location,8)){
        $errors[]='must type  location < 8';
    }
    if(empty($med_count)){
        $errors[]='must type count';
    }
    if(empty($med_price)){
        $errors[]='must type price';
    }
    if(empty($med_pharmacy)){
        $errors[]='must type pharmacy name';
    }
    if(empty($med_code)){
        $errors[]='must type code';
    }
    //check if data is or not
    include '../database/database.php';
    if(isset($_SESSION['login']['id_user'])):
        $user_id=$_SESSION['login']['id_user'];
    endif;
    $sql_chec="SELECT `med_name`,`med_code` FROM `medicine` WHERE `pharm_id`='$user_id' ";
    $result_chec=mysqli_query($conn,$sql_chec);
    foreach($result_chec as $res){
        if($name==$res['med_name']){
            $errors[]=$name.' is exist';
            break;
        }elseif($med_code==$res['med_code']){
            $errors[]=$med_code.' is exist';
            break;
        }
    }
    if(empty($errors)){
        include '../database/database.php';
        $errors=uploadImage_med($med_image,$errors);
        if(empty($errors)&&isset($_SESSION['login']['id_user'])){
            uploadImage_med($med_image,$errors);
            if(isset($_SESSION['med_image'])){
                $med_image1=$_SESSION['med_image'];
            }
            $user_id=$_SESSION['login']['id_user'];
            $sql="INSERT INTO `medicine`(`med_name`, `med_location`, `med_pharmacy`, `med_price`, `med_count`, `med_image`,`med_code`, `pharm_id`) VALUES ('$name','$location','$med_pharmacy','$med_price','$med_count','$med_image1','$med_code','$user_id')";
            $result=mysqli_query($conn,$sql);
            if($result){
                echo "fff";
            }else{
                echo "eee";
            }
            $_SESSION['success']=['successfuly'];
            header('Location:../dashborad-add-purch.php');
        }else{
            $_SESSION['errors']=$errors;
            header('Location:../dashborad-add-purch.php');
        }
    }else{
        $_SESSION['errors']=$errors;
        header('Location:../dashborad-add-purch.php');
    }
}



?>