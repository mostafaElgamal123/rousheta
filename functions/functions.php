<?php

function minlength($input,$length){
    if(strlen($input)<$length){
        return false;
    }
    return true;
}

function maxlength($input,$length){
    if(strlen($input)>$length){
        return false;
    }
    return true;
}
function checkemail($input){
    if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
        return false;
    }
    return true;
}

function uploadImage($file,$errors){
    $f_name=$file['name'];
    $f_type=$file['type'];
    $f_tmp_name=$file['tmp_name'];
    $f_error=$file['error'];
    $f_size=$file['size'];
    if($f_name!=''){
        if($f_error==0){
            if($f_size<500000){
                $f_info=pathinfo($f_name);
                $f_ex=$f_info['extension'];
                $file_name=$f_info['filename'];
                $extension_array=['png','jpg'];
                if(in_array($f_ex,$extension_array)){
                    $new_name=uniqid('img-',true).'.'.$f_ex;
                    $destion='../upload/'.$new_name;
                    $new_dest='./upload/'.$new_name;
                    if(move_uploaded_file($f_tmp_name,$destion)){
                        $_SESSION['image_name']=$new_dest;
                    }
                }else{
                    $errors[]='not alllowed to this extension';
                    unset($_SESSION['image_name']);
                }
            }else{
                $errors[]='size is big';
                unset($_SESSION['image_name']);
            }
        }else{
            $errors[]='there error';
            unset($_SESSION['image_name']);
        }
    }else{
        $errors[]='not found image';
        unset($_SESSION['image_name']);
    }
    return $errors;
}
function uploadImage1($file,$errors){
    $f_name=$file['name'];
    $f_type=$file['type'];
    $f_tmp_name=$file['tmp_name'];
    $f_error=$file['error'];
    $f_size=$file['size'];
    if($f_name!=''){
        if($f_error==0){
            if($f_size<500000){
                $f_info=pathinfo($f_name);
                $f_ex=$f_info['extension'];
                $file_name=$f_info['filename'];
                $extension_array=['png','jpg'];
                if(in_array($f_ex,$extension_array)){
                    $new_name=uniqid('img-',true).'.'.$f_ex;
                    $destion='../upload-profile/'.$new_name;
                    $new_dest='./upload-profile/'.$new_name;
                    if(move_uploaded_file($f_tmp_name,$destion)){
                        $_SESSION['image_name1']=$new_dest;
                    }
                }else{
                    $errors[]='not alllowed to this extension';
                    unset($_SESSION['image_name1']);
                }
            }else{
                $errors[]='size is big';
                unset($_SESSION['image_name1']);
            }
        }else{
            $errors[]='there error';
            unset($_SESSION['image_name1']);
        }
    }else{
        $errors[]='not found image';
        unset($_SESSION['image_name1']);
    }
    return $errors;
}
function uploadImage2($file,$errors){
    $f_name=$file['name'];
    $f_type=$file['type'];
    $f_tmp_name=$file['tmp_name'];
    $f_error=$file['error'];
    $f_size=$file['size'];
    if($f_name!=''){
        if($f_error==0){
            if($f_size<500000){
                $f_info=pathinfo($f_name);
                $f_ex=$f_info['extension'];
                $file_name=$f_info['filename'];
                $extension_array=['png','jpg'];
                if(in_array($f_ex,$extension_array)){
                    $new_name=uniqid('img-',true).'.'.$f_ex;
                    $destion='../upload-profile/'.$new_name;
                    $new_dest='./upload-profile/'.$new_name;
                    if(move_uploaded_file($f_tmp_name,$destion)){
                        $_SESSION['image_name2']=$new_dest;
                    }
                }else{
                    $errors[]='not alllowed to this extension';
                    unset($_SESSION['image_name2']);
                }
            }else{
                $errors[]='size is big';
                unset($_SESSION['image_name2']);
            }
        }else{
            $errors[]='there error';
            unset($_SESSION['image_name2']);
        }
    }else{
        $errors[]='not found image';
        unset($_SESSION['image_name2']);
    }
    return $errors;
}
function uploadImage3($file,$errors){
    $f_name=$file['name'];
    $f_type=$file['type'];
    $f_tmp_name=$file['tmp_name'];
    $f_error=$file['error'];
    $f_size=$file['size'];
    if($f_name!=''){
        if($f_error==0){
            if($f_size<500000){
                $f_info=pathinfo($f_name);
                $f_ex=$f_info['extension'];
                $file_name=$f_info['filename'];
                $extension_array=['png','jpg'];
                if(in_array($f_ex,$extension_array)){
                    $new_name=uniqid('img-',true).'.'.$f_ex;
                    $destion='../upload-profile/'.$new_name;
                    $new_dest='./upload-profile/'.$new_name;
                    if(move_uploaded_file($f_tmp_name,$destion)){
                        $_SESSION['image_name3']=$new_dest;
                    }
                }else{
                    $errors[]='not alllowed to this extension';
                    unset($_SESSION['image_name3']);
                }
            }else{
                $errors[]='size is big';
                unset($_SESSION['image_name3']);
            }
        }else{
            $errors[]='there error';
            unset($_SESSION['image_name3']);
        }
    }else{
        $errors[]='not found image';
        unset($_SESSION['image_name3']);
    }
    return $errors;
}
function uploadImage4($file,$errors){
    $f_name=$file['name'];
    $f_type=$file['type'];
    $f_tmp_name=$file['tmp_name'];
    $f_error=$file['error'];
    $f_size=$file['size'];
    if($f_name!=''){
        if($f_error==0){
            if($f_size<500000){
                $f_info=pathinfo($f_name);
                $f_ex=$f_info['extension'];
                $file_name=$f_info['filename'];
                $extension_array=['png','jpg'];
                if(in_array($f_ex,$extension_array)){
                    $new_name=uniqid('img-',true).'.'.$f_ex;
                    $destion='../upload-profile/'.$new_name;
                    $new_dest='./upload-profile/'.$new_name;
                    if(move_uploaded_file($f_tmp_name,$destion)){
                        $_SESSION['image_name4']=$new_dest;
                    }
                }else{
                    $errors[]='not alllowed to this extension';
                    unset($_SESSION['image_name4']);
                }
            }else{
                $errors[]='size is big';
                unset($_SESSION['image_name4']);
            }
        }else{
            $errors[]='there error';
            unset($_SESSION['image_name4']);
        }
    }else{
        $errors[]='not found image';
        unset($_SESSION['image_name4']);
    }
    return $errors;
}
// function FilterUpload(){
//     include './database/database.php';
//     $sql="SELECT `image` FROM `register_user`";
//     $result=mysqli_query($conn,$sql);
//     $row=mysqli_fetch_assoc($result);
//     $directory = "./upload/";
//     $images = glob($directory . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);
//     for($i=0;$i<count($images);$i++){
//         if(!in_array($row['image'],$images)){
//             unlink($images[$i]);
//             break;
//         }
//     }
// }

// function FilterUpload_med(){
//     include './database/database.php';
//     $sql="SELECT `med_image` FROM `medicine`";
//     $result=mysqli_query($conn,$sql);
//     $row=mysqli_fetch_assoc($result);
//     $directory = "./upload_med/";
//     $images = glob($directory . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);
//     for($i=0;$i<count($images);$i++){
//         if(!in_array($row['med_image'],$images)){
//             unlink($images[$i]);
//             break;
//         }
//     }
// }

function GetCount($userlogin,$tabnlename){
    $user=$userlogin;
    $table=$tabnlename;
    $count;
    $sql="SELECT count(*) as $count FROM `$table` WHERE `reg_id`='$user'";
    $result=mysqli_query($conn,$sql);
    return $count;
}

function uploadImage_med($file,$errors){
    $f_name=$file['name'];
    $f_type=$file['type'];
    $f_tmp_name=$file['tmp_name'];
    $f_error=$file['error'];
    $f_size=$file['size'];
    if($f_name!=''){
        if($f_error==0){
            if($f_size<500000){
                $f_info=pathinfo($f_name);
                $f_ex=$f_info['extension'];
                $file_name=$f_info['filename'];
                $extension_array=['png','jpg'];
                if(in_array($f_ex,$extension_array)){
                    $new_name=uniqid('img-',true).'.'.$f_ex;
                    $destion='../upload_med/'.$new_name;
                    $new_dest='./upload_med/'.$new_name;
                    if(move_uploaded_file($f_tmp_name,$destion)){
                        $_SESSION['med_image']=$new_dest;
                    }
                }else{
                    $errors[]='not alllowed to this extension';
                    unset($_SESSION['med_image']);
                }
            }else{
                $errors[]='size is big';
                unset($_SESSION['med_image']);
            }
        }else{
            $errors[]='there error';
            unset($_SESSION['med_image']);
        }
    }else{
        $errors[]='not found image';
        unset($_SESSION['med_image']);
    }
    return $errors;
}

?>