<?php 
require_once(dirname(__FILE__) . "/users.model.php");
session_start();
unset($_SESSION['username']);
unset($_SESSION['user_id']);
unset($_SESSION['src']);
unset($_SESSION['type']);
header("Location: /workoo/users/home.php");