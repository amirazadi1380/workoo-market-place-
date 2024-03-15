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
    $sql = "SELECT * FROM projects WHERE status = 0";
    $result = mysqli_query($conn, $sql);
    $allProjects = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $allProjects[] = $row;
        }
    }
    else{
        echo "<p class='absolute left-1/2 top-1/2 -translate-x-1/2 text-red-600 text-5xl font-bold '>پروژه ای موجود نمی باشد</p>"; 
    }
    ?>
    
    <div>
        <div class="w-screen h-[3000px] bg-blue-800 ">

            <h1 class="font-black text-3xl text-green-400 pt-2">همه پروژه ها</h1>

            <div class="w-screen h-screen grid place-items-center grid-cols-1  gap-5">
                <?php
                foreach ($allProjects as $project) {
                ?>
                    <div class="bg-black/60 text-white w-80 md:w-[700px] h-64 rounded-lg flex flex-col justify-center items-center space-y-2">

                        <h1 class="font-black text-3xl"><?php echo $project['topic'] ?></h1>
                        <p class="opacity-70 font-semibold text-xs text-right px-2"><?php echo $project['description'] ?></p>
                        <p class="text-green-600 font-semibold "><?php
                        if ($project['status'] == 1){
                            echo "تایید شده ✔️";
                        }
                        else if ($project['status'] == -1){
                            echo "رد شده ❌";
                        }
                        else{
                            echo "در حال بررسی👀";
                        }
                        ?></p>
                        <div class="flex space-x-2 ">
                            <button class="bg-red-600 hover:scale-110 duration-150 cursor-pointer text-black rounded-3xl w-20 flex justify-center items-center h-8 text-white font-semibold">
                                <a href=<?php echo "controllers/verify.php/?id=$project[project_id]&request=deny" ?>>رد</a>
                            </button>
                            <button class="bg-green-400 hover:scale-110 duration-150 cursor-pointer text-black rounded-3xl w-20 flex justify-center items-center h-8  font-semibold">
                            <a href="<?php echo "controllers/verify.php/?id=$project[project_id]&request=acc" ?>">تایید</a>
                            </button>
                        </div>

                    </div>
                <?php
                }

                ?>
            </div>
        </div>
    </div>

</body>

</html>