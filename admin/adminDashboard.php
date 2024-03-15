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

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conn = mysqli_connect("localhost", "root", "", "workoo");
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND type = 'admin' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_query($conn, $sql);
            $users = mysqli_fetch_all($result);
        } else {
            echo "پسورد یا نام کاربری تطابق ندارد";
        }
    }

    ?>
    <div class="w-screen h-screen bg-blue-800 flex flex-col justify-center items-center "> 
        <div class="w-96 h-96 bg-black/60 text-white flex flex-col justify-center items-center text-center rounded-lg shadow-md space-y-5"> 

            <h1 class="text-5xl font-black mb-10">پنل ادمین</h1>
            <div class="flex space-x-10">
                <button class="bg-green-500 hover:bg-white hover:scale-110 duration-150 w-32 h-16 rounded-3xl text-xl text-black font-black">
                    <a href="allprojects.php">لیست پروژه ها</a>
                </button> 
                <button class="bg-green-500 hover:bg-white hover:scale-110 duration-150 w-32 h-16 rounded-3xl text-xl text-black font-black">
                    <a href="allusers.php">همه کاربران</a>
                </button>
            </div>
        </div>

    </div>
</body>

</html>