<?php
session_start();
require_once(dirname(__FILE__) . "/project.model.php");
$user_id = $_SESSION['user_id'];
$sql = "SELECT img_src from users where user_id = $user_id";
$img = mysqli_fetch_assoc(mysqli_query($conn,$sql))['img_src'];
// if (isset($_POST['topic'])){
    
//     $topic = $_POST['topic'];
//     $description = $_POST['description'];
//     $lowestPrice = $_POST['lowestPrice'];
//     $highestPrice = $_POST['highestPrice'];
//     createProject($topic,$description,$lowestPrice,$highestPrice,$user_id);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<body>
    <div class="w-screen h-screen bg-blue-800 flex flex-col justify-center items-center text-center">
        <div class="w-96 md:w-[500px] h-[690px] md:p-3 shadow-md shadow-gray-600 font-bold bg-blue-900 text-white flex flex-col justify-center items-center text-xl rounded-lg">
        
      <img src= <?php echo "../upload/$img" ?> alt="profile" class="w-32 h-32 rounded-full object-contain">
        <h1 class="pt-2 text-green-400">
                خوش آمدید
                <?php
                $username = $_SESSION['username'];
                echo "$username";
                ?>
            </h1>
            <p class="text-[10px] pt-3 text-green-200">لطفا پروژه خود را ثبت کنید </p>
 
            <form action="create.php" method="post" class="flex-col justify-center items-center  text-lg items-center flex space-y-1 h-[550px]">
                <label class="space-y-1 ">
                    <h1>عنوان</h1>
                    <input type="text" name="topic" class="text-black bg-gray-400 rounded-md" />
                </label>
                <label class="space-y-1 ">
                    <h1>توضیحات</h1>
                    <textarea name="description" class="text-black bg-gray-400 h-42 rounded-md text-[12px] w-64
                    h-32"></textarea>
                </label>
                <label class="space-y-1">
                    <h1>کمترین قیمت</h1>
                    <input type="number" name="lowestPrice" class="text-black bg-gray-400 rounded-md" />
                </label>
                <p class="text-xs pb-2 text-green-400" id="confirmText"></p>
                <label class="space-y-2">
                    <h1>بیشترین قیمت</h1>
                    <input type="number" name="highestPrice" class="text-black bg-gray-400 rounded-md mb-2" />
                </label>
                <select name="selectCategory" class="bg-black/60 p-2 rounded-md">
                    <option value="programDevelop">توسعه نرم افزار و آیتی</option>
                    <option value="design">طراحی و خلاقیت</option>
                    <option value="architectural">مهندسی معماری</option>
                    <option value="consumer">بازاریابی و فروش</option>
                    <option value="webDevelopment">طراحی سایت</option>
                </select>
                <input type="submit" value="ثبت پروژه" class="bg-green-400 text-black  w-64 pt-1 hover:w-80 duration-200 text-[17px] cursor-pointer p-1 rounded-xl hover:bg-white hover:text-black duration-200">

            </form>
            <div class="w-full flex justify-between p-3 mt-2">
                <a href="userprojects.php" class="text-xs text-green-400 hover:text-white cursor-pointer">لیست پروژه های شخصی</a>
                <a href="requests.php" class="text-xs text-green-400 hover:text-white cursor-pointer">لیست درخواست ها</a>
                <a href="verifiedProjects.php" class="text-xs text-green-400 hover:text-white cursor-pointer">لیست کل پروژه ها</a>
            </div>
        </div>
    </div>
</body>

</html>