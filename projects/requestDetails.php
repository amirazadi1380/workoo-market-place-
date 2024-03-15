<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $conn = mysqli_connect("localhost","root","","workoo");
    $sql = "SELECT * FROM requests WHERE request_id = $_GET[id]";
    $result = mysqli_query($conn,$sql);
    $request = mysqli_fetch_assoc($result); 
    
?>
<a href=<?php echo "../../chat/chatRoom.php/?projectId=$request[project_id]";  ?>>
chat
</a>
</body>
</html>