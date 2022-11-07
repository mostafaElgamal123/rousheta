<?php
session_start();
$errors=[];
if(isset($_POST['add_comment'])&&$_SERVER['REQUEST_METHOD']=='POST'){
    
    //get value
    if(isset($_SESSION['login']['id_user'])){
        $id_user=$_SESSION['login']['id_user'];
        include '../database/database.php';
        $sql="SELECT `image`,`username`,`set_loaction` FROM `register_user` WHERE `reg_id`='$id_user'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
    }
    $name=$row['username'];
    $set_loaction=$row['set_loaction'];
    $comment=trim(htmlspecialchars($_POST['comment']));
    $user_rate=trim(htmlspecialchars($_POST['example']));
    $user_image=$row['image'];
    //validation
    include '../functions/functions.php';
    if(empty($comment)){
        $errors[]='must type comment';
    }elseif(!minlength($comment,1)){
        $errors[]='must type comment > 1';
    }elseif(!maxlength($comment,25)){
        $errors[]='must type comment < 25';
    }
    if(empty($errors)){
        include '../database/database.php';
        if(isset($_GET['id'])){
            $get_comment_id=$_GET['id'];
            $sql_insert="INSERT INTO `comments`(`user_name`, `user_comment`, `user_rating`, `user_image`,`user_location`,`user_id`, `get_comment_id`) VALUES ('$name','$comment','$user_rate','$user_image','$set_loaction','$id_user','$get_comment_id')";
            $result_insert=mysqli_query($conn,$sql_insert);
            if(!$result_insert){
                $_SESSION['errors_comment']=['not add comment'];
            }else{
                if(isset($_GET['id'])){
                    $id_doc=$_GET['id'];
                }
                $_SESSION['success_comment']=["successfuly"];
                header("Location:../single-profile-lap.php?id=$id_doc");
            }
        }
        
    }else{
        if(isset($_GET['id'])){
            $id_doc=$_GET['id'];
        }
        $_SESSION['errors_comment']=$errors;
        header("Location:../single-profile-lap.php?id=$id_doc");
    }
}



?>