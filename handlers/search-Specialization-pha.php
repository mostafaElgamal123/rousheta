<?php


session_start();
$search=trim(htmlspecialchars($_GET['search']));
$_SESSION['search']=$search;
header('Location:../pharmacy.php');
