<?php 
require_once(dirname(__FILE__) ."/users.model.php");
session_start();
$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$type = $_POST['selectOption'];
updateUser($user_id,$username,$password,$type,$phone);
header("Location: ../projects/verifiedProjects.php");