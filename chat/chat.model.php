<?php 

function createMessage($text,$sender,$recivers,$project_id){
    $conn = mysqli_connect("localhost","root","","workoo");
    $sql = "INSERT INTO chat (text,sender,recievers,project_id) VALUES ('$text',$sender,$recivers,$project_id)";
    mysqli_query($conn,$sql);
}