<?php

session_start();
$errors=[];
if(isset($_POST['update_medicine'])&&$_SERVER['REQUEST_METHOD']=="POST"){
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
    if(empty($med_image)){
        $errors[]='must select image';
    }
    if(empty($med_code)){
        $errors[]='must type code';
    }
    if($med_image['error']==4){
        $errors[]='must select image';
    }
    if(empty($errors)){
        include '../database/database.php';
        $directory = "../upload_med/";
        $images = glob($directory . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);
        for($i=0;$i<count($images);$i++){
            if(".".$row_check['med_image']==$images[$i]){
                unlink($images[$i]);
                break;
            }
        }
        $errors=uploadImage_med($med_image,$errors);
        if(empty($errors)&&isset($_SESSION['login']['id_user'])&&isset($_GET['id'])){
            uploadImage_med($med_image,$errors);
            if(isset($_SESSION['med_image'])){
                $med_image1=$_SESSION['med_image'];
            }
            $med_id=$_GET['id'];
            $user_id=$_SESSION['login']['id_user'];
            $sql="UPDATE `medicine` SET `med_name`='$name',`med_location`='$location',`med_pharmacy`='$med_pharmacy',`med_price`='$med_price',`med_count`='$med_count',`med_image`='$med_image1',`med_code`='$med_code' WHERE `pharm_id`='$user_id' AND `med_id`='$med_id'";
            $result=mysqli_query($conn,$sql);
            if($result){
                echo "fff";
            }else{
                echo "eee";
            }
            $_SESSION['success']=['successfuly'];
            header("Location:../dashborad-medicine-update.php?id=$med_id");
        }else{
            $_SESSION['errors']=$errors;
            header("Location:../dashborad-medicine-update.php?id=$med_id");
        }
    }else{
        $_SESSION['errors']=$errors;
        if(isset($_GET['id'])):
            $med_id=$_GET['id'];
        endif;
        header("Location:../dashborad-medicine-update.php?id=$med_id");
    }
}



?>