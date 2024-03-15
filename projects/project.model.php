<?php
$conn = mysqli_connect("localhost", "root", "", "workoo");

function createProject($topic, $description, $lowest_price, $highest_price,$category,$user_id)
{
    global $conn;
    $sql = "INSERT INTO projects (topic,description,lowest_price,highest_price,category,user_id) VALUES ('$topic','$description',$lowest_price,$highest_price,'$category',$user_id)";
    mysqli_query($conn, $sql);
}
function verifyRequest ($request_id){

    global $conn;
    $sql = "UPDATE requests SET isSubmitted = 'true' WHERE request_id = $request_id ";
    mysqli_query($conn,$sql);
}