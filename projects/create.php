<?php
session_start();
require_once(dirname(__FILE__) . "/project.model.php");
$user_id = $_SESSION['user_id'];$topic = $_POST['topic'];
$description = $_POST['description'];
$lowestPrice = $_POST['lowestPrice'];
$highestPrice = $_POST['highestPrice'];
$category = $_POST['selectCategory'];
createProject($topic, $description, $lowestPrice, $highestPrice,$category,$user_id);
header("Location: ../users/home.php");

