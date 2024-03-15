<?php
$conn = mysqli_connect("localhost", "root", "", "workoo");

function createUser($username, $password, $type, $phone, $img_src)
{
  global $conn;
  if ($type == "owner") {
    $permission = '1';
  } else {
    $permission = '2';
  }

  if (checkUsername($username)) {
    $sql = "INSERT INTO users (username,password,type,permission,phone,img_src) VALUES ('$username','$password','$type','$permission','$phone','$img_src')";
    mysqli_query($conn, $sql);
  }
}
function checkUsername($username)
{
  global $conn;
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return false;
  } else {
    return true;
  }
}

/////////////////////////////////////////////////////////////////////////////////////
function deleteUser($user_id)
{
  global $conn;
  $sql = "UPDATE users SET isDeleted = 'true' where user_id = $user_id";

  mysqli_query($conn, $sql);
}

function updateUser($user_id, $username, $password, $type, $phone)
{
  global $conn;
  $user = getUser($user_id);
  if ($type == "owner") {
    $permission = '1';
  } else {
    $permission = '2';
  }
  $sql = "UPDATE users set username = '$username', password='$password', type='$type', phone='$phone' WHERE user_id = $user_id ";

  if ($username = "") {
    $username = $user['username'];
  }
  if ($password = "") {
    $password = $user['password'];
  }
  if ($type = "") {
    $type = $user['type'];
  }
  if ($phone = "") {
    $phone = $user['phone'];
  }


  if (mysqli_query($conn, $sql)) {
  } else {
    return false;
  }
}

function getUser($user_id)
{
  global $conn;
  $sql = "SELECT * FROM users WHERE user_id = $user_id";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);
  return $user;
}
