<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "workoo");
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $allusers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $allusers[] = $row;
    }
    ?>
    <div>
        <?php foreach ($allusers as $user) {

        ?>
            <div>
                <a href=<?php echo "/workoo/profile/page.php/?userId=$user[user_id]"; ?>><?php echo $user['username']; ?></a>
            </div>
        <?php } ?>
    </div>
</body>

</html>