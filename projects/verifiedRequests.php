<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    $user_id = $_SESSION['user_id'];
    $conn = mysqli_connect("localhost","root","","workoo");
    $sql = "SELECT * FROM requests WHERE user_id = $user_id AND isSubmitted = 'true' ";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0){
        $allRequests = [];
        while ($row = mysqli_fetch_assoc($result)){
            $allRequests[] = $row;
            var_dump($allRequests);
        }
    }
    else{
        echo 'پروژه ای تایید نشده است';
    }
    ?>
    
</body>
</html>