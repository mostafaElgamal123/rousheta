<?php


session_start();
$search=trim(htmlspecialchars($_POST['search']));
$_SESSION['search']=$search;
header('Location:../dashborad-pharmacy-request.php');
