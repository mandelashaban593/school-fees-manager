<?php 
@session_start();

unset($_SESSION['USER_ID']);
session_unset();
@session_destroy();
header("Location: login.php");
exit();