<?php
require_once(dirname(__FILE__) . "/users.model.php");
session_start();
$user_id = $_SESSION['user_id'];
deleteUser($user_id);
$_SESSION['username'] = false;
header("Location: ../home.php");