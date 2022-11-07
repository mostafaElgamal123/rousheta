<?php


$servername='localhost';
$username='root';
$password='';
$db_name='rousheta';

$conn=mysqli_connect($servername,$username,$password,$db_name);

if(!$conn){
   // $_SESSION['errors']=['not connect database'];
}else{
   // $_SESSION['success']=['successfly connect database'];
   mysqli_select_db($conn, 'pagination');  
}



?>


