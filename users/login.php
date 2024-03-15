<?php

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $conn = mysqli_connect("localhost", "root", "", "workoo");
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND isDeleted = 'false' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['src'] = $user['img_src'];
        $_SESSION['type'] = $user['type'];

        if ($user['permission'] == 2) {

            header("Location: ../users/");
        } else {
            header("Location: ../users/");
        }
    } else {
        echo "<h1 class='text-red-600 mb-2 font-bold text-2xl bg-slate-800 text-center h-14 shadow-black shadow-2xl flex items-center justify-center'>نام کاربری و رمز عبور را به صورت صحیح وارد کنید </h1>  
         ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login page</title>
</head>

<body>
    <div class="w-screen h-screen bg-blue-800 flex flex-col justify-center items-center relative">
        <a href="../admin/adminLogin.php" class="text-xl font-bold absolute right-2 top-2 text-green-400 hover:text-white cursor-pointer">ورود ادمین</a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="flex flex-col text-center text-2xl space-y-5 bg-black/50 text-white w-96 h-[500px] justify-center items-center rounded-xl">
            <h1 class="text-5xl font-bold pb-5 font-serif">ورود</h1>
            <label for="username">نام کاربری</label>
            <input type="text" name="username" id="username" placeholder="enter username" class="text-black placeholder:color-white bg-gray-400 rounded-md">
            <label for="password">رمز عبور</label>
            <input type="password" name="password" id="password" placeholder="enter password" class="text-black placeholder:color-white bg-gray-400 rounded-md">
            <input type="submit" value="login" class="bg-blue-600 block text-white w-64 hover:scale-125 transition-all duration-200 text-[17px] cursor-pointer p-1 rounded-xl mt-5 hover:bg-white hover:text-black duration-200">
        </form>

    </div>
</body>

</html>