<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>admin page</title>
</head>

<body>
    <div class="w-screen h-screen bg-blue-800 flex flex-col justify-center items-center">
        <form action="adminDashboard.php" method="post" class="flex flex-col text-center text-2xl space-y-5 bg-black/60 text-white w-96 h-[500px] justify-center items-center rounded-xl">
            <h1 class="text-5xl text-green-400 font-bold pb-5 font-serif">ورود ادمین</h1>
            <label for="username" class="text-lg font-bold">نام کاربری</label>
            <input type="text" name="username" id="username" placeholder="enter username" class="text-black placeholder:color-white bg-gray-400 rounded-md">
            <label for="password" class="text-lg font-bold">رمز عبور</label>
            <input type="password" name="password" id="password" placeholder="enter password" class="text-black placeholder:color-white bg-gray-400 rounded-md">
            <input type="submit" value="login" class="bg-green-500 text-black w-64 hover:scale-125 transition-all duration-200 text-[17px] cursor-pointer p-1 rounded-xl mt-5 hover:bg-white hover:text-black duration-200 font-bold">
        </form>
    </div>
</body>

</html>