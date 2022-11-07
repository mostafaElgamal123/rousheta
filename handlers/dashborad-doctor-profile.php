<?php

session_start();
$errors=[];
include '../database/database.php';
if(isset($_SESSION['login']['id_user'])){
    $user_check=$_SESSION['login']['id_user'];
}
$sql_ava="SELECT  `image` from `register_user` WHERE `reg_id`='$user_check'";
$result_ava=mysqli_query($conn,$sql_ava);
$row_ava=mysqli_fetch_assoc($result_ava);
$avatar_image=$row_ava['image'];
echo $avatar_image;
if(isset($_SESSION['login']['type'])){
    $user_type_check=$_SESSION['login']['type'];
}
if($user_type_check=='doctor'){
    if(isset($_SESSION['login']['id_user'])){
        $user_check=$_SESSION['login']['id_user'];
    }
    $sql_check="SELECT * FROM `doctors` WHERE `reg_id`='$user_check'";
    $result_check=mysqli_query($conn,$sql_check);
    $row_check=mysqli_fetch_assoc($result_check);
    if($row_check['reg_id']!=$user_check){
        if(isset($_POST['create_profile'])&&$_SERVER['REQUEST_METHOD']=="POST"){
            //get value
            $name=trim(htmlspecialchars($_POST['name']));
            $location=trim(htmlspecialchars($_POST['location']));
            $phone=trim(htmlspecialchars($_POST['phone']));
            $email=trim(htmlspecialchars($_POST['email']));
            $email_2=trim(htmlspecialchars($_POST['email_2']));
            $Specialization=trim(htmlspecialchars($_POST['Specialization']));
            $about_me=trim(htmlspecialchars($_POST['about_me']));
            $opening_from=trim(htmlspecialchars($_POST['opening_from']));
            $opening_to=trim(htmlspecialchars($_POST['opening_to']));
            $opening_date=trim(htmlspecialchars($_POST['opening_date']));
            $price=trim(htmlspecialchars($_POST['price']));
            $map=trim(htmlspecialchars($_POST['map']));
            $image_1=$_FILES['image_1'];
            $image_2=$_FILES['image_2'];
            $image_3=$_FILES['image_3'];
            $image_4=$_FILES['image_4'];
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
            if(empty($about_me)){
                $errors[]='must type  about me';
            }elseif(!minlength($about_me,3)){
                $errors[]='must type  about me > 3';
            }elseif(!maxlength($about_me,5000)){
                $errors[]='must type  about me < 5000';
            }
            if(empty($Specialization)){
                $errors[]='must type  Specialization';
            }elseif(!minlength($Specialization,3)){
                $errors[]='must type  Specialization > 3';
            }elseif(!maxlength($Specialization,8)){
                $errors[]='must type  Specialization < 8';
            }
            if(empty($email)){
                $errors[]='must type email';
            }elseif(!checkemail($email)){
                $errors[]= 'email valid';
            }
            if(empty($email_2)){
                $errors[]='must type email 2';
            }elseif(!checkemail($email_2)){
                $errors[]= 'email 2 valid';
            }
            if(empty($phone)){
                $errors[]='must type  phone';
            }elseif(!minlength($phone,10)){
                $errors[]='must type  phone > 10';
            }elseif(!maxlength($phone,12)){
                $errors[]='must type  phone < 12';
            }
            if(empty($opening_from)){
                $errors[]='must type  opening from';
            }elseif(!maxlength($opening_from,2)){
                $errors[]='must type  opening from < 2';
            }
            if(empty($opening_to)){
                $errors[]='must type  opening to';
            }elseif(!maxlength($opening_to,2)){
                $errors[]='must type  opening to < 2';
            }
            if(empty($opening_date)){
                $errors[]='must select type opening date';
            }elseif($opening_date=='Open this select menu'){
                $errors[]='must select opening date';
            }
            if(empty($price)){
                $errors[]='must type  price';
            }elseif(!minlength($price,1)){
                $errors[]='must type  price > 1';
            }elseif(!maxlength($price,3)){
                $errors[]='must type  price < 3';
            }
            if(empty($map)){
                $errors[]='must type  map';
            }
            if(empty($errors)){
                include '../database/database.php';
                $errors=uploadImage1($image_1,$errors);
                $errors=uploadImage2($image_2,$errors);
                $errors=uploadImage3($image_3,$errors);
                $errors=uploadImage4($image_4,$errors);
                if(empty($errors)&&isset($_SESSION['login']['id_user'])){
                    uploadImage1($image_1,$errors);
                    uploadImage2($image_2,$errors);
                    uploadImage3($image_3,$errors);
                    uploadImage4($image_4,$errors);
                    if(isset($_SESSION['image_name1'])||isset($_SESSION['image_name2'])||isset($_SESSION['image_name3'])||isset($_SESSION['image_name4'])){
                        $name_iamge1=$_SESSION['image_name1'];
                        $name_iamge2=$_SESSION['image_name2'];
                        $name_iamge3=$_SESSION['image_name3'];
                        $name_iamge4=$_SESSION['image_name4'];
                    }
                    echo $name_iamge1;
                    $user_id=$_SESSION['login']['id_user'];
                    $sql="INSERT INTO `doctors`(`username`, `location`, `phone`, `email`, `gmail`, `Specialization`, `about_me`, `opening_from`, `opening_to`, `opening_date`, `appoiment_price`,`map`, `image_1`, `image_2`, `image_3`, `image_4`,`reg_id`,`ava_image`) VALUES ('$name','$location','$phone','$email','$email_2','$Specialization','$about_me','$opening_from','$opening_to','$opening_date','$price','$map','$name_iamge1','$name_iamge2','$name_iamge3','$name_iamge4','$user_id','$avatar_image')";
                    $result=mysqli_query($conn,$sql);
                    if($result){
                        echo "fff";
                    }else{
                        echo "eee";
                    }
                    $_SESSION['success']=['successfuly'];
                    header('Location:../dashborad-profile.php');
                }else{
                    $_SESSION['errors']=$errors;
                    header('Location:../dashborad-profile.php');
                }
            }else{
                $_SESSION['errors']=$errors;
                header('Location:../dashborad-profile.php');
            }
        }
    }elseif($row_check['reg_id']==$user_check){
        if(isset($_POST['create_profile'])&&$_SERVER['REQUEST_METHOD']=="POST"){
            //get value
            $name=trim(htmlspecialchars($_POST['name']));
            $location=trim(htmlspecialchars($_POST['location']));
            $phone=trim(htmlspecialchars($_POST['phone']));
            $email=trim(htmlspecialchars($_POST['email']));
            $email_2=trim(htmlspecialchars($_POST['email_2']));
            $Specialization=trim(htmlspecialchars($_POST['Specialization']));
            $about_me=trim(htmlspecialchars($_POST['about_me']));
            $opening_from=trim(htmlspecialchars($_POST['opening_from']));
            $opening_to=trim(htmlspecialchars($_POST['opening_to']));
            $opening_date=trim(htmlspecialchars($_POST['opening_date']));
            $price=trim(htmlspecialchars($_POST['price']));
            $map=trim(htmlspecialchars($_POST['map']));
            $image_1=$_FILES['image_1'];
            $image_2=$_FILES['image_2'];
            $image_3=$_FILES['image_3'];
            $image_4=$_FILES['image_4'];
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
            if(empty($about_me)){
                $errors[]='must type  about me';
            }elseif(!minlength($about_me,3)){
                $errors[]='must type  about me > 3';
            }elseif(!maxlength($about_me,5000)){
                $errors[]='must type  about me < 5000';
            }
            if(empty($Specialization)){
                $errors[]='must type  Specialization';
            }elseif(!minlength($Specialization,3)){
                $errors[]='must type  Specialization > 3';
            }elseif(!maxlength($Specialization,8)){
                $errors[]='must type  Specialization < 8';
            }
            if(empty($email)){
                $errors[]='must type email';
            }elseif(!checkemail($email)){
                $errors[]= 'email valid';
            }
            if(empty($email_2)){
                $errors[]='must type email 2';
            }elseif(!checkemail($email_2)){
                $errors[]= 'email 2 valid';
            }
            if(empty($phone)){
                $errors[]='must type  phone';
            }elseif(!minlength($phone,10)){
                $errors[]='must type  phone > 10';
            }elseif(!maxlength($phone,12)){
                $errors[]='must type  phone < 12';
            }
            if(empty($opening_from)){
                $errors[]='must type  opening from';
            }elseif(!maxlength($opening_from,2)){
                $errors[]='must type  opening from < 2';
            }
            if(empty($opening_to)){
                $errors[]='must type  opening to';
            }elseif(!maxlength($opening_to,2)){
                $errors[]='must type  opening to < 2';
            }
            if(empty($opening_date)){
                $errors[]='must select type opening date';
            }elseif($opening_date=='Open this select menu'){
                $errors[]='must select opening date';
            }
            if(empty($price)){
                $errors[]='must type  price';
            }elseif(!minlength($price,1)){
                $errors[]='must type  price > 1';
            }elseif(!maxlength($price,3)){
                $errors[]='must type  price < 3';
            }
            if(empty($map)){
                $errors[]='must type  map';
            }
            if(empty($errors)){
                if($image_1['name']!=''&&$image_2['name']!=''&&$image_3['name']!=''&&$image_4['name']!=''){
                    $directory = "../upload-profile/";
                    $images = glob($directory . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_1']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_2']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_3']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_4']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    include '../database/database.php';
                    $errors=uploadImage1($image_1,$errors);
                    $errors=uploadImage2($image_2,$errors);
                    $errors=uploadImage3($image_3,$errors);
                    $errors=uploadImage4($image_4,$errors);
                    if(empty($errors)&&isset($_SESSION['login']['id_user'])){
                        uploadImage1($image_1,$errors);
                        uploadImage2($image_2,$errors);
                        uploadImage3($image_3,$errors);
                        uploadImage4($image_4,$errors);
                        if(isset($_SESSION['image_name1'])||isset($_SESSION['image_name2'])||isset($_SESSION['image_name3'])||isset($_SESSION['image_name4'])){
                            $name_iamge1=$_SESSION['image_name1'];
                            $name_iamge2=$_SESSION['image_name2'];
                            $name_iamge3=$_SESSION['image_name3'];
                            $name_iamge4=$_SESSION['image_name4'];
                        }
                        $user_id=$_SESSION['login']['id_user'];
                        $sql="UPDATE `doctors` SET `username`='$name',`location`='$location',`phone`='$phone',`email`='$email',`gmail`='$email_2',`Specialization`='$Specialization',`about_me`='$about_me',`opening_from`='$opening_from',`opening_to`='$opening_to',`opening_date`='$opening_date',`appoiment_price`='$price',`map`='$map',`image_1`='$name_iamge1',`image_2`='$name_iamge2',`image_3`='$name_iamge3',`image_4`='$name_iamge4',`ava_image`='$avatar_image' WHERE `reg_id`='$user_id'";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                            echo "fff";
                        }else{
                            echo "eee";
                        }
                        $_SESSION['success']=['successfuly'];
                        header('Location:../dashborad-profile.php');
                    }else{
                        $_SESSION['errors']=$errors;
                        header('Location:../dashborad-profile.php');
                    } 
                }else{
                    $name_iamge1=$row_check['image_1'];
                    $name_iamge2=$row_check['image_2'];
                    $name_iamge3=$row_check['image_3'];
                    $name_iamge4=$row_check['image_4'];
                    if(isset($_SESSION['login']['id_user'])){
                        include '../database/database.php';
                        $user_id=$_SESSION['login']['id_user'];
                        $sql_3="UPDATE `doctors` SET `username`='$name',`location`='$location',`phone`='$phone',`email`='$email',`gmail`='$email_2',`Specialization`='$Specialization',`about_me`='$about_me',`opening_from`='$opening_from',`opening_to`='$opening_to',`opening_date`='$opening_date',`appoiment_price`='$price',`map`='$map',`image_1`='$name_iamge1',`image_2`='$name_iamge2',`image_3`='$name_iamge3',`image_4`='$name_iamge4',`ava_image`='$avatar_image' WHERE `reg_id`='$user_id'";
                        $result3=mysqli_query($conn,$sql_3);
                        if($result3){
                            $_SESSION['success']=['successfly'];
                            header('Location:../dashborad-profile.php');
                        }else{
                            $_SESSION['errors']=['not update profile'];
                            header('Location:../dashborad-profile.php');
                        }
                    }
                }
            }else{
                $_SESSION['errors']=$errors;
                header('Location:../dashborad-profile.php');
            }
        }
    }
}elseif($user_type_check=='lap'){
    if(isset($_SESSION['login']['id_user'])){
        $user_check=$_SESSION['login']['id_user'];
    }
    $sql_check="SELECT * FROM `laps` WHERE `reg_id`='$user_check'";
    $result_check=mysqli_query($conn,$sql_check);
    $row_check=mysqli_fetch_assoc($result_check);
    if($row_check['reg_id']!=$user_check){
        if(isset($_POST['create_profile'])&&$_SERVER['REQUEST_METHOD']=="POST"){
            //get value
            $name=trim(htmlspecialchars($_POST['name']));
            $location=trim(htmlspecialchars($_POST['location']));
            $phone=trim(htmlspecialchars($_POST['phone']));
            $email=trim(htmlspecialchars($_POST['email']));
            $email_2=trim(htmlspecialchars($_POST['email_2']));
            $Specialization=trim(htmlspecialchars($_POST['Specialization']));
            $about_me=trim(htmlspecialchars($_POST['about_me']));
            $opening_from=trim(htmlspecialchars($_POST['opening_from']));
            $opening_to=trim(htmlspecialchars($_POST['opening_to']));
            $opening_date=trim(htmlspecialchars($_POST['opening_date']));
            $price=trim(htmlspecialchars($_POST['price']));
            $map=trim(htmlspecialchars($_POST['map']));
            $image_1=$_FILES['image_1'];
            $image_2=$_FILES['image_2'];
            $image_3=$_FILES['image_3'];
            $image_4=$_FILES['image_4'];
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
            if(empty($about_me)){
                $errors[]='must type  about me';
            }elseif(!minlength($about_me,3)){
                $errors[]='must type  about me > 3';
            }elseif(!maxlength($about_me,5000)){
                $errors[]='must type  about me < 5000';
            }
            if(empty($Specialization)){
                $errors[]='must type  Specialization';
            }elseif(!minlength($Specialization,3)){
                $errors[]='must type  Specialization > 3';
            }elseif(!maxlength($Specialization,8)){
                $errors[]='must type  Specialization < 8';
            }
            if(empty($email)){
                $errors[]='must type email';
            }elseif(!checkemail($email)){
                $errors[]= 'email valid';
            }
            if(empty($email_2)){
                $errors[]='must type email 2';
            }elseif(!checkemail($email_2)){
                $errors[]= 'email 2 valid';
            }
            if(empty($phone)){
                $errors[]='must type  phone';
            }elseif(!minlength($phone,10)){
                $errors[]='must type  phone > 10';
            }elseif(!maxlength($phone,12)){
                $errors[]='must type  phone < 12';
            }
            if(empty($opening_from)){
                $errors[]='must type  opening from';
            }elseif(!maxlength($opening_from,2)){
                $errors[]='must type  opening from < 2';
            }
            if(empty($opening_to)){
                $errors[]='must type  opening to';
            }elseif(!maxlength($opening_to,2)){
                $errors[]='must type  opening to < 2';
            }
            if(empty($opening_date)){
                $errors[]='must select type opening date';
            }elseif($opening_date=='Open this select menu'){
                $errors[]='must select opening date';
            }
            if(empty($price)){
                $errors[]='must type  price';
            }elseif(!minlength($price,1)){
                $errors[]='must type  price > 1';
            }elseif(!maxlength($price,3)){
                $errors[]='must type  price < 3';
            }
            if(empty($map)){
                $errors[]='must type  map';
            }
            if(empty($errors)){
                include '../database/database.php';
                $errors=uploadImage1($image_1,$errors);
                $errors=uploadImage2($image_2,$errors);
                $errors=uploadImage3($image_3,$errors);
                $errors=uploadImage4($image_4,$errors);
                if(empty($errors)&&isset($_SESSION['login']['id_user'])){
                    uploadImage1($image_1,$errors);
                    uploadImage2($image_2,$errors);
                    uploadImage3($image_3,$errors);
                    uploadImage4($image_4,$errors);
                    if(isset($_SESSION['image_name1'])||isset($_SESSION['image_name2'])||isset($_SESSION['image_name3'])||isset($_SESSION['image_name4'])){
                        $name_iamge1=$_SESSION['image_name1'];
                        $name_iamge2=$_SESSION['image_name2'];
                        $name_iamge3=$_SESSION['image_name3'];
                        $name_iamge4=$_SESSION['image_name4'];
                    }
                    echo $name_iamge1;
                    $user_id=$_SESSION['login']['id_user'];
                    $sql="INSERT INTO `laps`(`username`, `location`, `phone`, `email`, `gmail`, `Specialization`, `about_me`, `opening_from`, `opening_to`, `opening_date`, `appoiment_price`,`map`, `image_1`, `image_2`, `image_3`, `image_4`,`reg_id`,`ava_image`) VALUES ('$name','$location','$phone','$email','$email_2','$Specialization','$about_me','$opening_from','$opening_to','$opening_date','$price','$map','$name_iamge1','$name_iamge2','$name_iamge3','$name_iamge4','$user_id','$avatar_image')";
                    $result=mysqli_query($conn,$sql);
                    if($result){
                        echo "fff";
                    }else{
                        echo "eee";
                    }
                    $_SESSION['success']=['successfuly'];
                    header('Location:../dashborad-profile.php');
                }else{
                    $_SESSION['errors']=$errors;
                    header('Location:../dashborad-profile.php');
                }
            }else{
                $_SESSION['errors']=$errors;
                header('Location:../dashborad-profile.php');
            }
        }
    }elseif($row_check['reg_id']==$user_check){
        if(isset($_POST['create_profile'])&&$_SERVER['REQUEST_METHOD']=="POST"){
            //get value
            $name=trim(htmlspecialchars($_POST['name']));
            $location=trim(htmlspecialchars($_POST['location']));
            $phone=trim(htmlspecialchars($_POST['phone']));
            $email=trim(htmlspecialchars($_POST['email']));
            $email_2=trim(htmlspecialchars($_POST['email_2']));
            $Specialization=trim(htmlspecialchars($_POST['Specialization']));
            $about_me=trim(htmlspecialchars($_POST['about_me']));
            $opening_from=trim(htmlspecialchars($_POST['opening_from']));
            $opening_to=trim(htmlspecialchars($_POST['opening_to']));
            $opening_date=trim(htmlspecialchars($_POST['opening_date']));
            $price=trim(htmlspecialchars($_POST['price']));
            $map=trim(htmlspecialchars($_POST['map']));
            $image_1=$_FILES['image_1'];
            $image_2=$_FILES['image_2'];
            $image_3=$_FILES['image_3'];
            $image_4=$_FILES['image_4'];
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
            if(empty($about_me)){
                $errors[]='must type  about me';
            }elseif(!minlength($about_me,3)){
                $errors[]='must type  about me > 3';
            }elseif(!maxlength($about_me,5000)){
                $errors[]='must type  about me < 5000';
            }
            if(empty($Specialization)){
                $errors[]='must type  Specialization';
            }elseif(!minlength($Specialization,3)){
                $errors[]='must type  Specialization > 3';
            }elseif(!maxlength($Specialization,8)){
                $errors[]='must type  Specialization < 8';
            }
            if(empty($email)){
                $errors[]='must type email';
            }elseif(!checkemail($email)){
                $errors[]= 'email valid';
            }
            if(empty($email_2)){
                $errors[]='must type email 2';
            }elseif(!checkemail($email_2)){
                $errors[]= 'email 2 valid';
            }
            if(empty($phone)){
                $errors[]='must type  phone';
            }elseif(!minlength($phone,10)){
                $errors[]='must type  phone > 10';
            }elseif(!maxlength($phone,12)){
                $errors[]='must type  phone < 12';
            }
            if(empty($opening_from)){
                $errors[]='must type  opening from';
            }elseif(!maxlength($opening_from,2)){
                $errors[]='must type  opening from < 2';
            }
            if(empty($opening_to)){
                $errors[]='must type  opening to';
            }elseif(!maxlength($opening_to,2)){
                $errors[]='must type  opening to < 2';
            }
            if(empty($opening_date)){
                $errors[]='must select type opening date';
            }elseif($opening_date=='Open this select menu'){
                $errors[]='must select opening date';
            }
            if(empty($price)){
                $errors[]='must type  price';
            }elseif(!minlength($price,1)){
                $errors[]='must type  price > 1';
            }elseif(!maxlength($price,3)){
                $errors[]='must type  price < 3';
            }
            if(empty($map)){
                $errors[]='must type  map';
            }
            if(empty($errors)){
                if($image_1['name']!=''&&$image_2['name']!=''&&$image_3['name']!=''&&$image_4['name']!=''){
                    $directory = "../upload-profile/";
                    $images = glob($directory . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_1']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_2']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_3']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_4']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    include '../database/database.php';
                    $errors=uploadImage1($image_1,$errors);
                    $errors=uploadImage2($image_2,$errors);
                    $errors=uploadImage3($image_3,$errors);
                    $errors=uploadImage4($image_4,$errors);
                    if(empty($errors)&&isset($_SESSION['login']['id_user'])){
                        uploadImage1($image_1,$errors);
                        uploadImage2($image_2,$errors);
                        uploadImage3($image_3,$errors);
                        uploadImage4($image_4,$errors);
                        if(isset($_SESSION['image_name1'])||isset($_SESSION['image_name2'])||isset($_SESSION['image_name3'])||isset($_SESSION['image_name4'])){
                            $name_iamge1=$_SESSION['image_name1'];
                            $name_iamge2=$_SESSION['image_name2'];
                            $name_iamge3=$_SESSION['image_name3'];
                            $name_iamge4=$_SESSION['image_name4'];
                        }
                        $user_id=$_SESSION['login']['id_user'];
                        $sql="UPDATE `laps` SET `username`='$name',`location`='$location',`phone`='$phone',`email`='$email',`gmail`='$email_2',`Specialization`='$Specialization',`about_me`='$about_me',`opening_from`='$opening_from',`opening_to`='$opening_to',`opening_date`='$opening_date',`appoiment_price`='$price',`map`='$map',`image_1`='$name_iamge1',`image_2`='$name_iamge2',`image_3`='$name_iamge3',`image_4`='$name_iamge4',`ava_image`='$avatar_image' WHERE `reg_id`='$user_id'";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                            echo "fff";
                        }else{
                            echo "eee";
                        }
                        $_SESSION['success']=['successfuly'];
                        header('Location:../dashborad-profile.php');
                    }else{
                        $_SESSION['errors']=$errors;
                        header('Location:../dashborad-profile.php');
                    } 
                }else{
                    $name_iamge1=$row_check['image_1'];
                    $name_iamge2=$row_check['image_2'];
                    $name_iamge3=$row_check['image_3'];
                    $name_iamge4=$row_check['image_4'];
                    if(isset($_SESSION['login']['id_user'])){
                        include '../database/database.php';
                        $user_id=$_SESSION['login']['id_user'];
                        $sql_3="UPDATE `laps` SET `username`='$name',`location`='$location',`phone`='$phone',`email`='$email',`gmail`='$email_2',`Specialization`='$Specialization',`about_me`='$about_me',`opening_from`='$opening_from',`opening_to`='$opening_to',`opening_date`='$opening_date',`appoiment_price`='$price',`map`='$map',`image_1`='$name_iamge1',`image_2`='$name_iamge2',`image_3`='$name_iamge3',`image_4`='$name_iamge4',`ava_image`='$avatar_image' WHERE `reg_id`='$user_id'";
                        $result3=mysqli_query($conn,$sql_3);
                        if($result3){
                            $_SESSION['success']=['successfly'];
                            header('Location:../dashborad-profile.php');
                        }else{
                            $_SESSION['errors']=['not update profile'];
                            header('Location:../dashborad-profile.php');
                        }
                    }
                }
            }else{
                $_SESSION['errors']=$errors;
                header('Location:../dashborad-profile.php');
            }
        }
    }
}elseif($user_type_check=='pharmacy'){
    if(isset($_SESSION['login']['id_user'])){
        $user_check=$_SESSION['login']['id_user'];
    }
    $sql_check="SELECT * FROM `pharmacys` WHERE `reg_id`='$user_check'";
    $result_check=mysqli_query($conn,$sql_check);
    $row_check=mysqli_fetch_assoc($result_check);
    if($row_check['reg_id']!=$user_check){
        if(isset($_POST['create_profile'])&&$_SERVER['REQUEST_METHOD']=="POST"){
            //get value
            $name=trim(htmlspecialchars($_POST['name']));
            $location=trim(htmlspecialchars($_POST['location']));
            $phone=trim(htmlspecialchars($_POST['phone']));
            $email=trim(htmlspecialchars($_POST['email']));
            $email_2=trim(htmlspecialchars($_POST['email_2']));
            $Specialization=trim(htmlspecialchars($_POST['Specialization']));
            $about_me=trim(htmlspecialchars($_POST['about_me']));
            $opening_from=trim(htmlspecialchars($_POST['opening_from']));
            $opening_to=trim(htmlspecialchars($_POST['opening_to']));
            $opening_date=trim(htmlspecialchars($_POST['opening_date']));
            $price=trim(htmlspecialchars($_POST['price']));
            $map=trim(htmlspecialchars($_POST['map']));
            $image_1=$_FILES['image_1'];
            $image_2=$_FILES['image_2'];
            $image_3=$_FILES['image_3'];
            $image_4=$_FILES['image_4'];
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
            if(empty($about_me)){
                $errors[]='must type  about me';
            }elseif(!minlength($about_me,3)){
                $errors[]='must type  about me > 3';
            }elseif(!maxlength($about_me,5000)){
                $errors[]='must type  about me < 5000';
            }
            if(empty($Specialization)){
                $errors[]='must type  Specialization';
            }elseif(!minlength($Specialization,3)){
                $errors[]='must type  Specialization > 3';
            }elseif(!maxlength($Specialization,8)){
                $errors[]='must type  Specialization < 8';
            }
            if(empty($email)){
                $errors[]='must type email';
            }elseif(!checkemail($email)){
                $errors[]= 'email valid';
            }
            if(empty($email_2)){
                $errors[]='must type email 2';
            }elseif(!checkemail($email_2)){
                $errors[]= 'email 2 valid';
            }
            if(empty($phone)){
                $errors[]='must type  phone';
            }elseif(!minlength($phone,10)){
                $errors[]='must type  phone > 10';
            }elseif(!maxlength($phone,12)){
                $errors[]='must type  phone < 12';
            }
            if(empty($opening_from)){
                $errors[]='must type  opening from';
            }elseif(!maxlength($opening_from,2)){
                $errors[]='must type  opening from < 2';
            }
            if(empty($opening_to)){
                $errors[]='must type  opening to';
            }elseif(!maxlength($opening_to,2)){
                $errors[]='must type  opening to < 2';
            }
            if(empty($opening_date)){
                $errors[]='must select type opening date';
            }elseif($opening_date=='Open this select menu'){
                $errors[]='must select opening date';
            }
            if(empty($price)){
                $errors[]='must type  price';
            }elseif(!minlength($price,1)){
                $errors[]='must type  price > 1';
            }elseif(!maxlength($price,3)){
                $errors[]='must type  price < 3';
            }
            if(empty($map)){
                $errors[]='must type  map';
            }
            if(empty($errors)){
                include '../database/database.php';
                $errors=uploadImage1($image_1,$errors);
                $errors=uploadImage2($image_2,$errors);
                $errors=uploadImage3($image_3,$errors);
                $errors=uploadImage4($image_4,$errors);
                if(empty($errors)&&isset($_SESSION['login']['id_user'])){
                    uploadImage1($image_1,$errors);
                    uploadImage2($image_2,$errors);
                    uploadImage3($image_3,$errors);
                    uploadImage4($image_4,$errors);
                    if(isset($_SESSION['image_name1'])||isset($_SESSION['image_name2'])||isset($_SESSION['image_name3'])||isset($_SESSION['image_name4'])){
                        $name_iamge1=$_SESSION['image_name1'];
                        $name_iamge2=$_SESSION['image_name2'];
                        $name_iamge3=$_SESSION['image_name3'];
                        $name_iamge4=$_SESSION['image_name4'];
                    }
                    echo $name_iamge1;
                    $user_id=$_SESSION['login']['id_user'];
                    $sql="INSERT INTO `pharmacys`(`username`, `location`, `phone`, `email`, `gmail`, `Specialization`, `about_me`, `opening_from`, `opening_to`, `opening_date`, `appoiment_price`,`map`, `image_1`, `image_2`, `image_3`, `image_4`,`reg_id`,`ava_image`) VALUES ('$name','$location','$phone','$email','$email_2','$Specialization','$about_me','$opening_from','$opening_to','$opening_date','$price','$map','$name_iamge1','$name_iamge2','$name_iamge3','$name_iamge4','$user_id','$avatar_image')";
                    $result=mysqli_query($conn,$sql);
                    if($result){
                        echo "fff";
                    }else{
                        echo "eee";
                    }
                    $_SESSION['success']=['successfuly'];
                    header('Location:../dashborad-profile.php');
                }else{
                    $_SESSION['errors']=$errors;
                    header('Location:../dashborad-profile.php');
                }
            }else{
                $_SESSION['errors']=$errors;
                header('Location:../dashborad-profile.php');
            }
        }
    }elseif($row_check['reg_id']==$user_check){
        if(isset($_POST['create_profile'])&&$_SERVER['REQUEST_METHOD']=="POST"){
            //get value
            $name=trim(htmlspecialchars($_POST['name']));
            $location=trim(htmlspecialchars($_POST['location']));
            $phone=trim(htmlspecialchars($_POST['phone']));
            $email=trim(htmlspecialchars($_POST['email']));
            $email_2=trim(htmlspecialchars($_POST['email_2']));
            $Specialization=trim(htmlspecialchars($_POST['Specialization']));
            $about_me=trim(htmlspecialchars($_POST['about_me']));
            $opening_from=trim(htmlspecialchars($_POST['opening_from']));
            $opening_to=trim(htmlspecialchars($_POST['opening_to']));
            $opening_date=trim(htmlspecialchars($_POST['opening_date']));
            $price=trim(htmlspecialchars($_POST['price']));
            $map=trim(htmlspecialchars($_POST['map']));
            $image_1=$_FILES['image_1'];
            $image_2=$_FILES['image_2'];
            $image_3=$_FILES['image_3'];
            $image_4=$_FILES['image_4'];
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
            if(empty($about_me)){
                $errors[]='must type  about me';
            }elseif(!minlength($about_me,3)){
                $errors[]='must type  about me > 3';
            }elseif(!maxlength($about_me,5000)){
                $errors[]='must type  about me < 5000';
            }
            if(empty($Specialization)){
                $errors[]='must type  Specialization';
            }elseif(!minlength($Specialization,3)){
                $errors[]='must type  Specialization > 3';
            }elseif(!maxlength($Specialization,8)){
                $errors[]='must type  Specialization < 8';
            }
            if(empty($email)){
                $errors[]='must type email';
            }elseif(!checkemail($email)){
                $errors[]= 'email valid';
            }
            if(empty($email_2)){
                $errors[]='must type email 2';
            }elseif(!checkemail($email_2)){
                $errors[]= 'email 2 valid';
            }
            if(empty($phone)){
                $errors[]='must type  phone';
            }elseif(!minlength($phone,10)){
                $errors[]='must type  phone > 10';
            }elseif(!maxlength($phone,12)){
                $errors[]='must type  phone < 12';
            }
            if(empty($opening_from)){
                $errors[]='must type  opening from';
            }elseif(!maxlength($opening_from,2)){
                $errors[]='must type  opening from < 2';
            }
            if(empty($opening_to)){
                $errors[]='must type  opening to';
            }elseif(!maxlength($opening_to,2)){
                $errors[]='must type  opening to < 2';
            }
            if(empty($opening_date)){
                $errors[]='must select type opening date';
            }elseif($opening_date=='Open this select menu'){
                $errors[]='must select opening date';
            }
            if(empty($price)){
                $errors[]='must type  price';
            }elseif(!minlength($price,1)){
                $errors[]='must type  price > 1';
            }elseif(!maxlength($price,3)){
                $errors[]='must type  price < 3';
            }
            if(empty($map)){
                $errors[]='must type  map';
            }
            if(empty($errors)){
                if($image_1['name']!=''&&$image_2['name']!=''&&$image_3['name']!=''&&$image_4['name']!=''){
                    $directory = "../upload-profile/";
                    $images = glob($directory . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_1']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_2']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_3']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    for($i=0;$i<count($images);$i++){
                        if(".".$row_check['image_4']==$images[$i]){
                            unlink($images[$i]);
                            break;
                        }
                    }
                    include '../database/database.php';
                    $errors=uploadImage1($image_1,$errors);
                    $errors=uploadImage2($image_2,$errors);
                    $errors=uploadImage3($image_3,$errors);
                    $errors=uploadImage4($image_4,$errors);
                    if(empty($errors)&&isset($_SESSION['login']['id_user'])){
                        uploadImage1($image_1,$errors);
                        uploadImage2($image_2,$errors);
                        uploadImage3($image_3,$errors);
                        uploadImage4($image_4,$errors);
                        if(isset($_SESSION['image_name1'])||isset($_SESSION['image_name2'])||isset($_SESSION['image_name3'])||isset($_SESSION['image_name4'])){
                            $name_iamge1=$_SESSION['image_name1'];
                            $name_iamge2=$_SESSION['image_name2'];
                            $name_iamge3=$_SESSION['image_name3'];
                            $name_iamge4=$_SESSION['image_name4'];
                        }
                        $user_id=$_SESSION['login']['id_user'];
                        $sql="UPDATE `pharmacys` SET `username`='$name',`location`='$location',`phone`='$phone',`email`='$email',`gmail`='$email_2',`Specialization`='$Specialization',`about_me`='$about_me',`opening_from`='$opening_from',`opening_to`='$opening_to',`opening_date`='$opening_date',`appoiment_price`='$price',`map`='$map',`image_1`='$name_iamge1',`image_2`='$name_iamge2',`image_3`='$name_iamge3',`image_4`='$name_iamge4',`ava_image`='$avatar_image' WHERE `reg_id`='$user_id'";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                            echo "fff";
                        }else{
                            echo "eee";
                        }
                        $_SESSION['success']=['successfuly'];
                        header('Location:../dashborad-profile.php');
                    }else{
                        $_SESSION['errors']=$errors;
                        header('Location:../dashborad-profile.php');
                    } 
                }else{
                    $name_iamge1=$row_check['image_1'];
                    $name_iamge2=$row_check['image_2'];
                    $name_iamge3=$row_check['image_3'];
                    $name_iamge4=$row_check['image_4'];
                    if(isset($_SESSION['login']['id_user'])){
                        include '../database/database.php';
                        $user_id=$_SESSION['login']['id_user'];
                        $sql_3="UPDATE `pharmacys` SET `username`='$name',`location`='$location',`phone`='$phone',`email`='$email',`gmail`='$email_2',`Specialization`='$Specialization',`about_me`='$about_me',`opening_from`='$opening_from',`opening_to`='$opening_to',`opening_date`='$opening_date',`appoiment_price`='$price',`map`='$map',`image_1`='$name_iamge1',`image_2`='$name_iamge2',`image_3`='$name_iamge3',`image_4`='$name_iamge4' ,`ava_image`='$avatar_image' WHERE `reg_id`='$user_id'";
                        $result3=mysqli_query($conn,$sql_3);
                        if($result3){
                            $_SESSION['success']=['successfly'];
                            header('Location:../dashborad-profile.php');
                        }else{
                            $_SESSION['errors']=['not update profile'];
                            header('Location:../dashborad-profile.php');
                        }
                    }
                }
            }else{
                $_SESSION['errors']=$errors;
                header('Location:../dashborad-profile.php');
            }
        }
    }
    
}



?>