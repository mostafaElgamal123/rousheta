<?php

session_start();
$errors=[];
if(isset($_POST['login_user'])&&$_SERVER['REQUEST_METHOD']=="POST"){
    //get value
    $email=trim(htmlspecialchars($_POST['email']));
    $password=trim(htmlspecialchars($_POST['pass']));
    $type_reg=trim(htmlspecialchars($_POST['type_reg']));
    $confirm_password=trim(htmlspecialchars($_POST['confirm_password']));
    //validation
    include '../functions/functions.php';
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
    if(empty($type_reg)){
        $errors[]='must select type register as';
    }elseif($type_reg=='Open this select menu'){
        $errors[]='must select type register as';
    }
    //check if data is or not
    include '../database/database.php';
    $sql_chec="SELECT `email` FROM `register_user` ";
    $result_chec=mysqli_query($conn,$sql_chec);
    if(mysqli_fetch_assoc($result_chec)){
    foreach($result_chec as $res){
        if($res['email']==$email){
            $sql_chec="SELECT `confirm_pass`,`type_reg` FROM `register_user` WHERE `email`='$email' ";
            $result_chec=mysqli_query($conn,$sql_chec);
            $row=mysqli_fetch_assoc($result_chec);
            if($row['type_reg']==$type_reg){
               if($row['confirm_pass']==$confirm_password){
                    unset($errors[0]);
                    unset($errors[1]);
                    break;
                }else{
                   $errors[2]='password is not exist';
                }
            }else{
                $errors[1]='type is not exist';
            }
        }else{
            $errors[0]='email is not exist';
        }
    }
}else{
    $errors[0]='not found data must register';
}
    if(empty($errors)){
        include '../database/database.php';
        $sql="SELECT `reg_id` FROM `register_user` WHERE `email`='$email' ";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $id_user=$row['reg_id'];
        $_SESSION['login']=[
            'email'=>$email,
            'password'=>$password,
            'type'=>$type_reg,
            'id_user'=>$id_user
        ];
        $_SESSION['user_login']=true;
        $_SESSION['success']=['successfly'];
        if($type_reg!='patient'){
          header('Location:../dashborad-profile.php');
        }else{
            header('Location:../index.php');
        }
    }else{
        $_SESSION['errors']=$errors;
        header('Location:../login-page.php');
    }
}




?>