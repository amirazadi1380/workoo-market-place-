<?php
require_once(dirname(__FILE__) . "/users.model.php");
if (isset($_POST['username'])) {

    $username = $_POST['username'];
    $passowrd = md5($_POST['password']);
    $phone = $_POST['phone'];
    $type = $_POST['selectOption'];
    $img_src = $_FILES['uploadImage']['name'];
    createUser($username, $passowrd, $type, $phone,$img_src);
    move_uploaded_file($_FILES['uploadImage']['tmp_name'],"../../upload/".$img_src);
    
  if (checkUsername($username) == false){
    header("Location: ../login.php");

  }
  else{
      header("Location: ../signup.php");
  }
}
