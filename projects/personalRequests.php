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
    $project_id = $_GET['id'];
    $conn = mysqli_connect("localhost", "root", "", "workoo");
    $sql = "SELECT * FROM requests WHERE project_id = $project_id AND isSubmitted ='false' ";
    $result = mysqli_query($conn, $sql);
    $allRequesters = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $allRequesters[] = $row;
        }
    } else {
        echo "<h1 class='text-red-600 absolute bg-transparent top-1/2 left-1/2 font-extrabold text-5xl  -translate-x-1/2'> درخواستی ثبت نشده یا پروژه تایید شده است</h1>";
    }
    ?>
    <div class="w-screen h-screen bg-blue-800 grid grid-cols-1 justify-center pt-5 place-items-center ">
        <?php
        foreach ($allRequesters as $requester) {
            $username_sql = "SELECT username FROM users WHERE user_id = $requester[user_id]";
            $username = mysqli_fetch_assoc(mysqli_query($conn, $username_sql))['username'];

            $project_sql = "SELECT topic FROM projects WHERE project_id = $requester[project_id]";
            $topic = mysqli_fetch_assoc(mysqli_query($conn, $project_sql))['topic'];
        ?>
            <div class="w-[700px] h-52 text-white rounded-lg bg-black/60 flex flex-col justify-center items-center space-y-3">
                <h1 class="font-bold text-2xl "><?php echo $topic; ?> :پروژه </h1>
                <h1 class="text-white/50"><?php echo $username; ?>: درخواست کننده</h1>
                <p>
                    <span> وضعیت :</span>
                    <?php if ($requester['isSubmitted'] == "true") {
                        echo "<button class='text-green-500'>تایید شده✔️</button>";
                    } else {
                        echo "تایید نشده";
                    }
                    ?>
                </p>
                <a class="text-black font-bold cursor-pointer hover:scale-110 duration-150 ease-in bg-green-600 p-3 rounded-lg" href=<?php echo "/workoo/projects/verify.php/?requestid=$requester[request_id]&projectid=$project_id"; ?>><button>تایید نهایی درخواست</button></a>
            </div>
        <?php } ?>
    </div>

</body>

</html>