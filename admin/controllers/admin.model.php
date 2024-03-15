<?php 
$conn = mysqli_connect("localhost","root","","workoo");
function verifyProject ($request,$project_id){
    global $conn;
    if ((isset($request) && $request == 'acc')) {
        $sql = "UPDATE projects SET status = 1 WHERE project_id = $project_id";
        mysqli_query($conn, $sql);  
    }
    else{   
        $sql = "UPDATE projects SET status = -1 WHERE project_id = $project_id";
        mysqli_query($conn, $sql);
    }
}