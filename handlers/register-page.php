<?php

session_start();
$errors=[];
if(isset($_POST['add_user'])&&$_SERVER['REQUEST_METHOD']=="POST"){
    //get value
    $fist_name=trim(htmlspecialchars($_POST['firstname']));
    $last_name=trim(htmlspecialchars($_POST['lastname']));
    $fullname=$fist_name." ".$last_name;
    $email=trim(htmlspecialchars($_POST['email']));
    $password=trim(htmlspecialchars($_POST['pass']));
    $confirm_password=trim(htmlspecialchars($_POST['confirm_password']));
    $set_loaction=trim(htmlspecialchars($_POST['setlocation']));
    $phone=trim(htmlspecialchars($_POST['phone']));
    $type_reg=trim(htmlspecialchars($_POST['type_reg']));
    $image=$_FILES['image'];
    //validation
    include '../functions/functions.php';
    if(empty($fist_name)){
        $errors[]='must type  firstname';
    }elseif(!minlength($fist_name,3)){
        $errors[]='must type  firstname > 3';
    }elseif(!maxlength($fist_name,10)){
        $errors[]='must type  firstname < 10';
    }
    if(empty($last_name)){
        $errors[]='must type  lastname';
    }elseif(!minlength($last_name,3)){
        $errors[]='must type  lastname > 3';
    }elseif(!maxlength($last_name,10)){
        $errors[]='must type  lastname < 10';
    }
    if(empty($type_reg)){
        $errors[]='must select type register as';
    }elseif($type_reg=='Open this select menu'){
        $errors[]='must select type register as';
    }
    if(empty($email)){
        $errors[]='must type email';
    }elseif(!checkemail($email)){
        $errors[]= 'email valid';
    }
    if(empty($password)){
        $errors[]='must type  password';
    }elseif(!minlength($password,3)){
        $errors[]='must type  password > 3';
    }elseif(!maxlength($password,10)){
        $errors[]='must type  password < 10';
    }
    if(empty($confirm_password)){
        $errors[]='must type  confirm password';
    }elseif($confirm_password!=$password){
        $errors[]='must  confirm password equal password ';
    }
    //check if data is or not
    include '../database/database.php';
    $sql_chec="SELECT `email` FROM `register_user` ";
    $result_chec=mysqli_query($conn,$sql_chec);
    foreach($result_chec as $res){
        if($email==$res['email']){
            $errors[]='email is exist';
            break;
        }
    }
    if(empty($errors)){
        $errors=uploadImage($image,$errors);
        if(empty($errors)){
            uploadImage($image,$errors);
            if(isset($_SESSION['image_name'])){
                $name_iamge=$_SESSION['image_name'];
            }
            $sql="INSERT INTO `register_user`(`username`, `email`, `password`, `confirm_pass`, `set_loaction`, `phone`, `image`, `type_reg`) VALUES ('$fullname','$email','$password','$confirm_password','$set_loaction','$phone','$name_iamge','$type_reg')";
            $result=mysqli_query($conn,$sql);
            if($result){
                   echo "fff";
            }else{
                echo "eee";
            }
            $_SESSION['success']=['successfuly'];
            header('Location:../register-page.php');
        }else{
            $_SESSION['errors']=$errors;
            header('Location:../register-page.php');
        }
    }else{
        $_SESSION['errors']=$errors;
        header('Location:../register-page.php');
    }
}




?>