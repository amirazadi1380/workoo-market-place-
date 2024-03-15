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
    $conn = mysqli_connect("localhost", "root", "", "workoo");
    global $conn;
    session_start();
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM projects WHERE user_id = $user_id";
    $allProjects = [];
    $result =  mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $allProjects[] = $row;
        }
    } else {
    }

    ?>
    <div class="w-screen h-screen bg-blue-800 flex flex-col justify-center items-center space-y-2">

        <h1 class="font-black text-3xl text-green-400 pt-2"><?php echo $username; ?> پروژه های</h1>
        <div class="w-screen h-screen grid place-items-center grid-cols-1 ">
            <?php
            foreach ($allProjects as $projects) {
            ?>
                <div class="shadow-2xl relative shadow-black/80 bg-black/60 text-white cursor-pointer hover:scale-110 md:hover:scale-125 duration-150 rounded-md w-72 h-48 md:w-[700px] md:h-64 space-y-2 text-center flex flex-col justify-center relative">
                    <h1 class="font-black text-3xl"><?php echo $projects['topic']; ?></h1>
                    <p class="text-red-600"> وضعیت :<?php if ($projects['status'] == 1){ echo ' پروژه تاییده شده ';} else if ($projects['status'] == 0){ echo 'پروژه در حال بررسی  '; }
                            else{ echo 'پروژه رد شد ';} ?></p>
                    <p class="opacity-70"><?php echo $projects['description']; ?></p>
                    <div class="flex flex-col  items-center w-20 absolute left-2 bottom-2">
                        <p class="text-green-500 text-md"> قیمت</p>
                        <div class="flex text-xs font-bold opacity-60">
                            <p><?php echo $projects['lowest_price'] ?></p>
                            <span>-</span>
                            <p><?php echo $projects['highest_price'] ?></p>
                        </div>
                        <button class="bg-green-600 text-black ml-[600px] p-2 rounded-lg hover:bg-green-700 hover:w-52 duration-150 hover:text-white w-40">
                            <a class="font-bold" href=<?php echo "personalRequests.php/?id=$projects[project_id]" ?>>
                                درخواست ها</a></button>
                       
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>