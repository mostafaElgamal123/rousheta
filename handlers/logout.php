<?php


session_start();
if(isset($_SESSION['user_login'])){
    unset($_SESSION['user_login']);
    unset($_SESSION['login']);
    session_unset();
    session_destroy();
    header('Location:../login-page.php');
}