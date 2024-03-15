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
    $conn = mysqli_connect("localhost", "root", "", "workoo");
    $project_id = $_GET['id'];
    $request_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT request_count FROM projects WHERE project_id = $project_id"))['request_count'];
    $user_id = $_SESSION['user_id'];
    if (isset($_POST['submitRequest'])) {
        $sql = "INSERT INTO requests (user_id,project_id) VALUES ($user_id,$project_id)";
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * from requests where user_id = $user_id AND project_id = $project_id"))  == 0) {
            mysqli_query($conn, $sql);
            $request_count += 1;
            $update_request_count = "UPDATE projects SET request_count = $request_count WHERE project_id = $project_id ";
            mysqli_query($conn, $update_request_count);
            header("Location: /workoo/projects/verifiedProjects.php/?q=success");
            
        } else {
        }
    }
    $project_query = "SELECT * FROM projects WHERE project_id = $project_id";
    $project_result = mysqli_query($conn, $project_query);

    if (mysqli_num_rows($project_result) > 0) {
        $project = [];
        while ($row = mysqli_fetch_assoc($project_result)) {
            $project[] = $row;
        }
    }


    ?>
    <div class="w-screen h-screen bg-blue-800 flex flex-col justify-center items-center">
        <?php if ((mysqli_num_rows(mysqli_query($conn, "SELECT * from requests where user_id = $user_id AND project_id = $project_id")) > 0)) {  ?>
            <h1 class="font-bold text-3xl pb-2 text-red-600">شما قبلا به این پروژه درخواست داده اید</h1>
        <?php } ?>
        <?php foreach ($project as $item) { ?>
            <div class="border justify-center items-center text-black bg-white/90 cursor-pointer  rounded-md w-72 h-48 md:w-[700px] md:h-64 space-y-2 text-center flex flex-col justify-center relative">
                <p class="absolute top-2 opacity-40 text-xs font-bold"><?php echo $item['created_at'] ?></p>
                <h1 class="font-black text-3xl"><?php echo $item['topic']; ?></h1>
                <p class="opacity-70"><?php echo $item['description']; ?></p>
                <div class="flex flex-col text-black items-center w-20 absolute left-2 bottom-2">
                    <p class="text-green-500 text-md"> قیمت</p>
                    <div class="flex text-xs font-bold opacity-60">
                        <p><?php echo $item['lowest_price'] ?></p>
                        <span>-</span>
                        <p><?php echo $item['highest_price'] ?></p>
                    </div>
                </div>
            </div>
            <form action="" method="post" class="w-64 bg-green-600 font-black p-2 h-16 mt-1 cursor-pointer hover:bg-blue-500 hover:w-72 duration-150  flex justify-center items-center rounded-xl">
                <input type="submit" value="ثبت درخواست" name="submitRequest" class="cursor-pointer">
            </form>
        <?php } ?>
    </div>
</body>

</html>