<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <?php

    session_start();
    $allMessages = [];
    $conn = mysqli_connect("localhost", "root", "", "workoo");
    $project_id = $_GET['projectId'];
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    $recievers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM projects WHERE project_id = $project_id"))['user_id'];
    $sql = "SELECT * FROM chat WHERE sender = $user_id OR recievers = $recievers";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $allMessages[] = $row;
        }
    } else {
        echo "خالی";
    }

    ?>
    <div class="w-screen h-screen bg-blue-800 flex flex-col justify-center items-center space-y-2">
        <a href="/workoo/projects/verifiedProjects.php">بازگشت</a>
        <h1 class="text-green-400 font-black text-3xl">به صفحه چت با کارفرما خوش آمدید</h1>
        <div class="w-72 h-96 md:w-[500px] bg-black/60 flex flex-col space-y-3 p-2 font-bold text-black md:h-[500px] overflow-y-scroll  border rounded-lg border-black shadow-xl relative">
            <?php
            foreach ($allMessages as $message) {
                $username_sql = "SELECT username FROM users WHERE user_id = $message[sender]";
                $username = mysqli_fetch_assoc(mysqli_query($conn, $username_sql))['username'];
            ?>
                <div>
                    <?php if ($message['sender'] == $message['recievers']) { ?>
                        <div class="flex space-x-2 justify-end">
                            <p class="bg-green-500 px-2 h-7 flex justify-center items-center text-xs rounded-md"><?php echo $message['text']; ?></p>
                            <h1 class="text-white bg-black rounded-full text-xs p-2"><?php echo $username; ?></h1>
                        </div>
                    <?php } else { ?>
                        <div class="flex space-x-2 justify-start flex-reverse">
                            <h1 class="text-black bg-white rounded-full text-xs p-2"><?php echo $username; ?></h1>
                            <p class="bg-green-500 px-2 h-7 flex justify-center items-center text-xs rounded-md"><?php echo $message['text']; ?></p>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            
        </div>
        <form action="<?php echo "/workoo/chat/create.php/?projectId=$_GET[projectId]&sender=$user_id"; ?>" method="post" >
            <input type="text" name="message" class="h-12 w-64 rounded-md bg-black text-white">
            <input type="submit" value="send" name="send" class="bg-black/60 text-white w-20 hover:bg-white/80 duration-150 ease-in hover:text-black h-12 rounded-md cursor-pointer">
        </form>
<form action="/workoo/chat/uploadProject.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="upload">
</form>
    </div>
</body>

</html>