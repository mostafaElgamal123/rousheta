<?php



session_start();
$errors=[];
include '../database/database.php';
if(isset($_POST['send_test'])&&$_SERVER['REQUEST_METHOD']=='POST'){
    //get val
    $test_url=trim(htmlspecialchars($_POST['test_url']));
    if(isset($_GET['id_patient'])&&isset($_GET['id_lap'])&&isset($_GET['id_lap'])){
        $id_patient=$_GET['id_patient'];
        $id_lap=$_GET['id_lap'];
        $sql_lap="SELECT `username` FROM `laps` WHERE `reg_id`='$id_lap'";
        $result_lap=mysqli_query($conn,$sql_lap);
        $row_lap=mysqli_fetch_assoc($result_lap);
        $lap_name=$row_lap['username'];
    }
    if(empty($test_url)){
        $errors[]='must add url test';
    }
    //check if data is or not
    include '../database/database.php';
    $sql_chec="SELECT `test_url` FROM `list_test_patient_with_lap` WHERE `id_patient`='$id_patient' ";
    $result_chec=mysqli_query($conn,$sql_chec);
    if(mysqli_fetch_assoc($result_chec)){
    foreach($result_chec as $res){
        if($res['test_url']==$test_url){
            $errors[]='url test is exist';
        }
    }
    }
    if(empty($errors)):
        $sql="INSERT INTO `list_test_patient_with_lap`(`lap_name`,`test_url`, `id_patient`, `id_lap`) VALUES ('$lap_name','$test_url','$id_patient','$id_lap')";
        $result=mysqli_query($conn,$sql);
        if($result){
            $_SESSION['success']=['successfuly'];
            header('Location:../dashborad-lap-appoinment.php');
        }else{
            $_SESSION['errors']=['not send test'];
            header('Location:../dashborad-lap-appoinment.php');
        }
    else:
        $_SESSION['errors']=$errors;
        header('Location:../dashborad-lap-appoinment.php');
    endif;
}











?>