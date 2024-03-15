<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "workoo");
    $freelancer_sql = "SELECT * FROM users WHERE isDeleted = 'false' AND type ='freelancer'";
    $result = mysqli_query($conn, $freelancer_sql);
    $freelancer_length = mysqli_num_rows($result);

    $owner_sql = "SELECT * FROM users WHERE isDeleted = 'false' AND type ='owner'";
    $result_two = mysqli_query($conn, $owner_sql);
    $owner_length = mysqli_num_rows($result_two);

    $project_sql = "SELECT * FROM projects WHERE status = '1' ";
    $result_three = mysqli_query($conn, $project_sql);
    $project_length = mysqli_num_rows($result_three);
  
    ?>
    <div class="w-screen h-screen bg-blue-800 overflow-x-hidden">
        <nav class="flex w-screen justify-between relative p-2 md:h-20 bg-blue-600">
            <div class="flex space-x-3 justify-center items-center">
                <?php
                session_start();
                if (isset($_SESSION['user_id'])) {

                    $user_id = $_SESSION['user_id'];
                    $conn = mysqli_connect("localhost", "root", "", "workoo");
                    $sql = "SELECT username FROM users WHERE isDeleted = 'false' AND user_id = $user_id";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {

                        echo "<span class='flex space-x-2 justify-center items-center font-bold text-xl text-red-500 bg-white/80 rounded-2xl p-2 group realtive cursor-pointer'> $_SESSION[username]          
                     <div class='flex  invisible group-hover:opacity-100 group-hover:visible duration-150 ease-in flex-col space-y-5 justify-center items-center bg-white text-white fixed top-16 left-2 curso-pointer rounded-xl w-52 h-64 opacity-0'>
                     <a href='./controllers/delete.php'><button class='bg-red-600 hover:w-32 duration-150 text-xs h-10 z-20 text-white w-28 rounded-lg'>حذف کاربر</button></a>
                     <a href='login.php'><button class='bg-red-600 hover:w-32 duration-150 text-xs h-10 z-20 text-white w-28 rounded-lg'>ورود</button></a>
                     <button class='bg-green-600 hover:w-32 duration-150 text-xs h-10 z-20 text-white w-28 rounded-lg'>تغییر مشخصات</button>
                     <a href='/workoo/users/controllers/logout.php'><button class='bg-red-600 hover:w-32 duration-150 text-xs h-10 z-20 text-white w-28 rounded-lg'>خروج</button></a>
                   
                </div> 
                <button class=' text-xs h-6 z-20  w-16 rounded-lg text-black bg-blue-600/20'>$_SESSION[type]</button>
                
                </span>";
                            
                        if ($_SESSION['src'] != '') {

                            echo "<img src='../upload/$_SESSION[src]' alt='user' class='w-10 h-10 object-cover rounded-full'/>";
                        } else {
                            echo "";
                        }
                    }
                }


                ?>
                <?php
                if (isset($_SESSION['username']) == false){
                 ?>
                <button class="bg-blue-900 space-x-1 text-white w-24 rounded-lg h-8 flex items-center justify-center hover:scale-110 duration-150"><a href="signup.php"> ثبت نام</a><img src="../icons/users.png" alt="user" class="w-5 h-5 object-contain"> </button>
                <button class="bg-blue-900 text-white w-24 rounded-lg h-8 hover:scale-110 duration-150"><a href="login.php">ورود</a></button>
                <?php }?>
                <?php if(isset($_SESSION['type']) && $_SESSION['type'] == 'freelancer'){ ?>
                <div class="relative group cursor-pointer"><img src='../icons/notif.png' class="w-10"/><div class="absolute hidden group-hover:flex flex-col w-72 h-96 bg-white rounded-lg top-10">
                    <?php
                    
                        $allRequests = [];
                    if (isset($user_id)){
                        echo "پروژه های تایید شده";
                        $sql = "SELECT * FROM requests WHERE user_id = $user_id AND isSubmitted = 'true' ";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result) > 0){
                            while ($row = mysqli_fetch_assoc($result)){
                                $allRequests[] = $row;
                            }
                        }
                        else{
                            echo "<span class='ml-12 mt-36 font-bold text-red-600 text-xl'>پروژه ای تایید نشده است</span>";
                        }}
                        foreach($allRequests as $requests){
                            $project_sql = "SELECT topic FROM projects WHERE project_id = $requests[project_id]";
                            $project_result = mysqli_query($conn,$project_sql);
                            $topic = mysqli_fetch_assoc($project_result)['topic'];
                        ?>
                        <h1 class="w-full h-12 font-bold rounded-full hover:bg-black duration-150 ease-in hover:text-white mt-2 bg-green-600 flex justify-center items-center"><a href=<?php echo "../projects/requestDetails.php/?id=$requests[request_id]"; ?>><?php echo $topic; ?></a></h1>

                        <?php } ?>
                        
                </div></div>
                <?php } ?>
            </div>
   
            <div class="md:hidden text-lg z-50 pr-10">
                <button id="bars"><img src="../icons/bars.png" alt="bars" class="w-8 h-10 "></button>
                <button id="close" class="hidden"><img src="../icons/cross.png" alt="close" class="w-8 h-8 object-fill"></button>
            </div>
            <ul id="ulist" class="absolute bg-blue-900 z-40  overflow-hidden text-black/80 right-0 top-0 h-screen w-52 hidden flex-col space-y-28  items-center justify-center rounded-lg font-bold md:flex-row-reverse md:static md:bg-transparent md:pb-5 md:flex md:h-20 md:w-96 md:space-x-10 md:text-black/70 xl:mr-36">
                <?php
                if (isset($_SESSION['type'])) {


                    if ($_SESSION['type'] == 'freelancer') {
                        echo "<li class=' md:ml-8 group hover:text-white duration-150'/><a href=''><span>فریلنسر</span></a>
                    <div class='hidden z-20 group-hover:flex flex-col space-y-5 justify-center items-center bg-blue-900 z-30 text-white fixed top-12  rounded-xl w-36 h-52'>
                    <a href='../projects/verifiedProjects.php'>پروژه ها</a>
                    <h1>درخواست ها</h1>
                    </div>
                </li>";
                    } else {

                        echo "<li class='md:ml-8 group relative hover:text-white duration-150'><a href=''><span>کارفرما</span></a>
                <div class='hidden z-20  group-hover:flex flex-col space-y-5 justify-center items-center bg-blue-900 z-30 text-white fixed top-12 rounded-xl w-36 h-52'>
                <a href='../projects/verifiedProjects.php' class='cursor-pointer'>پروژه ها</a>
                <a href='../projects/form.php' class='cursor-pointer'>ساخت پروژه</a>
                <a href='../projects/userprojects.php' class='cursor-pointer'> پروژه های خودم</a>
                
                </div>
                </li>";
                    }
                }
                ?>
                <!-- <li class="md:pb-28 md:ml-5 hover:text-white duration-150"><a href=''><span>تعرفه ها</span></a></li> -->
                <li></li>
                <li class="md:pb-28 md:ml-5 hover:text-white duration-150"><a href=''><span>تعرفه ها</span></a></li>

                <li class="md:pb-28 hover:text-white duration-150"><a href=""><span>راهنما</span></a></li>
            </ul>
        </nav>


        <div>

            </div>

        <div class="w-full h-[800px] md:h-[500px] overflow-hidden  bg-blue-600 flex flex-col md:flex-row justify-center md:justify-between px-36 text-green-500 items-center h-96 pt-10">
            <img src="../icons/back.jpg" alt="header" class=" w-96 h-96 object-cover  rounded-2xl shadow-xl shadow-black/60">

            <div class="flex flex-col text-white space-y-5 text-right relative mt-16 md:m-0 ">
                <h1 class="font font-bold text-2xl md:text-5xl z-20">انجام با کیفیت پروژه شما</h1>
                <p class=" text-xs md:text-base opacity-70 z-20 font-bold">ورکو به شما کمک می‌کند تا به راحتی با بهترین‌ها پروژه‌های خود را به نتیجه برسانید</p>
                <img src="../icons/back3.png" alt="back" class="absolute right-10 -top-36 z-10 w-96 h-96 object-cover opacity-50">
                <button type="button" class="bg-green-700 ml-28 md:ml-64 font-bold h-12 z-20 text-white w-36 rounded-lg">
                    <?php
                    if (isset($_SESSION['username'])) {
                    ?>
                        <a href=<?php
                                if ($_SESSION['type'] == 'freelancer') {
                                    echo '';
                                } else {
                                    echo '../projects/form.php';
                                }
                                ?>>ایجاد پروژه سریع</a></button>
            <?php } else {
            ?>
                <a href="../users/login.php">ایجاد پروژه سریع</a></button>
            <?php } ?>
            <div class="flex flex-col justify-center items-center z-20 text-slate-800/60  pt-5">
                <div class="flex space-x-20">
                    <h1 class="font-bold text-4xl flex space-x-3">
                        <p>فریلنسر</p>
                        <p><?php echo "$freelancer_length"; ?></p>
                    </h1>
                    <h1 class="font-bold text-4xl flex space-x-3">
                        <p>کارفرما</p>
                        <p><?php echo "$owner_length"; ?></p>
                    </h1>
                    <h1 class="font-bold text-4xl flex space-x-3">
                        <p>پروژه</p>
                        <p><?php echo "$project_length"; ?></p>
                    </h1>
                 
                </div>
            </div>
            </div>
        </div>
        <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'freelancer'){

         ?>
        <div class="w-screen  grid grid-cols-1 md:grid-cols-2 place-items-center gap-5 mt-5 bg-blue-700 justify-center items-center h-screen">
            <?php
            $project_result = mysqli_query($conn, "SELECT * FROM projects WHERE status = '1'");
            $allWorks = [];
            if (mysqli_num_rows($project_result) > 0) {
                while ($row = mysqli_fetch_assoc($project_result)) {
                    $allWorks[] = $row;
                }
            }
            foreach ($allWorks as $work) {
                $user_result = mysqli_query($conn,"SELECT username FROM users WHERE user_id = $work[user_id]");
                $username = mysqli_fetch_assoc($user_result)['username']

            ?>
                <div class="border justify-center items-center text-black bg-white/90 cursor-pointer hover:scale-110 md:hover:scale-110 duration-150 rounded-md w-80 h-48 md:w-[700px] md:h-64 space-y-2 text-center flex flex-col justify-center relative">
                    <p class="absolute top-2 opacity-40 text-xs font-bold"><?php echo $work['created_at'] ?></p>
                    <h1 class="font-black text-3xl"><?php echo $work['topic']; ?></h1>
                    <p class="opacity-70"><?php echo $work['description']; ?></p>
                    <p class="absolute right-2 bottom-2 font-bold text-green-500"><?php echo $username; ?> </p>
                    <div class="flex flex-col text-black items-center w-20 absolute left-2 bottom-2">
                        <p class="text-green-500 text-md"> قیمت</p>
                        <div class="flex text-xs font-bold opacity-60">
                            <p><?php echo $work['lowest_price'] ?></p>
                            <span>-</span>
                            <p><?php echo $work['highest_price'] ?></p>
                        </div>
                    </div>
                    <button class="bg-green-600 text-black p-2 rounded-lg hover:bg-green-700 hover:w-52 duration-150 hover:text-white w-40">
                        <a class="font-bold" href=<?php echo "../projects/submitRequest.php/?id=$work[project_id]" ?>>
                            ثبت درخواست </a></button>
                    
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>

    <script>
        const bars = document.getElementById("bars");
        const close = document.getElementById("close");
        const ulist = document.getElementById("ulist");
        var open = false;
        bars.addEventListener("click", () => {
            bars.classList.add("hidden")
            close.classList.remove("hidden")
            var open = true;
            ulist.classList.add("flex")
            ulist.classList.remove("hidden")
        })
        close.addEventListener("click", () => {
            close.classList.add("hidden")
            bars.classList.remove("hidden")
            var open = false;
            ulist.classList.remove("flex")
            ulist.classList.add("hidden")
        })
    </script>
</body>

</html>