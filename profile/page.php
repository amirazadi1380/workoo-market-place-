<?php 
$user_id = $_GET['userId'];
$conn = mysqli_connect("localhost","root","","workoo");
$sql = "SELECT * from users WHERE user_id = $user_id";
$user = mysqli_fetch_assoc(mysqli_query($conn,$sql));
var_dump($user);