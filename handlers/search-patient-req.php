<?php


session_start();
$search=trim(htmlspecialchars($_POST['search']));
$_SESSION['search']=$search;
header('Location:../dashborad-patient-request.php');
