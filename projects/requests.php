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
    $sql = "SELECT user_id,project_id FROM requests";
    $result = mysqli_query($conn, $sql);
    $request = mysqli_fetch_array($result);
    $user_id =  $request[0];
    $project_id = $request[1];

    $project_query = mysqli_query($conn, "SELECT topic from projects WHERE project_id = $project_id");
    $project_name = mysqli_fetch_array($project_query)[0];
    $user_query = mysqli_query($conn, "SELECT username from users WHERE user_id = $user_id");
    $user_name = mysqli_fetch_array($user_query)[0];
    

    ?>
    <div class="w-screen h-screen flex flex-col justify-center items-center bg-blue-800">
        <div class="shadow-2xl shadow-black/80 bg-black/60 text-white cursor-pointer hover:scale-110 md:hover:scale-125 duration-150 rounded-md w-72 h-48 md:w-[700px] md:h-64 space-y-2 text-center flex flex-col justify-center relative">
            <h1 class="font-black text-3xl"><?php echo $user_name; ?></h1>
            <p class="opacity-70"><?php echo $project_name; ?></p>
        </div>
</body>

</html>