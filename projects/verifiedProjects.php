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
    global $conn;
    $sql = "SELECT * from projects";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $allProjects = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $allProjects[] = $row;
        }
    } else {
        echo 'هنوز پروژه ای وجود ندارد';
    }
if (isset($_GET['q'])){
    echo "<script type='text/javascript'>alert('درخواست شما با موفقیت ثبت شد');</script>";
}

    ?>
    <div class="w-screen h-[3000px] bg-blue-800 flex flex-col items-center space-y-2 relative">

        <h1 class="font-black text-3xl text-green-400 pt-2">پروژه های تایید شده </h1>

        <div class="w-screen h-screen grid gap-5 place-items-center grid-cols-1 " id="projectsGrid">
            <?php
            foreach ($allProjects as $projects) {
                if ($projects['status'] == 1) {
                    $username_query = mysqli_query($conn, "SELECT username FROM users where user_id = $projects[user_id]");
                    $username = mysqli_fetch_assoc($username_query);
                    if (isset($_POST['chat'])) {
                        header("Location: ../chat/chatRoom.php/?id=$projects[project_id]");
                        $_SESSION['project_id'] = $projects['project_id'];
                    }

            ?>
                    <div class="border justify-center items-center text-black bg-white/90 cursor-pointer hover:scale-110 md:hover:scale-110 duration-150 rounded-md w-80 h-48 md:w-[700px] md:h-64 space-y-2 text-center flex flex-col justify-center relative">
                        <p class="absolute top-2 opacity-40 text-xs font-bold"><?php echo $projects['created_at'] ?></p>
                        <h1 class="font-black text-3xl"><?php echo $projects['topic']; ?></h1>
                        <p class="opacity-70"><?php echo $projects['description']; ?></p>
                        <p class="absolute right-2 bottom-2 font-bold text-green-500"><?php echo $username['username']; ?> </p>
                        <div class="flex flex-col text-black items-center w-20 absolute left-2 bottom-2">
                            <p class="text-green-500 text-md"> قیمت</p>
                            <div class="flex text-xs font-bold opacity-60">
                                <p><?php echo $projects['lowest_price'] ?></p>
                                <span>-</span>
                                <p><?php echo $projects['highest_price'] ?></p>
                            </div>
                        </div>
                        <?php if ($_SESSION['type'] == 'freelancer'){ ?>  
                        <button class="bg-green-600 text-black p-2 rounded-lg hover:bg-green-700 hover:w-52 duration-150 hover:text-white w-40">
                        <a class="font-bold" href=<?php echo "/workoo/projects/submitRequest.php/?id=$projects[project_id]" ?>>
                                ثبت درخواست </a></button>
                                <?php } ?>
                    </div>
            <?php }
            } ?>
        </div>
        <form id="updateForm" action="" method="post" class="hidden flex-col justify-center items-center absolute left-1/2 -translate-x-1/2 w-96 h-96 bg-black text-white flex items-center text-center">
            <label class="space-y-2 ">
                <h1>new username:</h1>
                <input type="text" name="username" class="text-black bg-gray-400 rounded-md" id="usernameInput" />
            </label>
            <label class="space-y-2">
                <h1>new password:</h1>
                <input type="password" name="password" class="text-black bg-gray-400 rounded-md" id="passwordInput" />
            </label>
            <label class="space-y-1 block p-2">
                <h1>new phone:</h1>
                <input type="text" name="phone" class="text-black bg-gray-400 rounded-md" id="phoneInput" />
            </label>
            <select class="text-black mt-2 bg-gray-400 w-32 text-center p-1 cursor-pointer rounded-md outline-none" name="selectOption">
                <option value="owner">کارفرما</option>
                <option value="freelancer">فریلنسر</option>
            </select>

            <input type="submit" value="ثبت تغییرات" id="submitBtn" class="bg-blue-600 block text-white w-64 hover:scale-125 transition-all duration-200 text-[17px] cursor-not-allowed p-1 rounded-xl mt-5 hover:bg-white hover:text-black duration-200">

        </form>
    </div>
    <script>
        const updateForm = document.getElementById('updateForm');
        const projectsGrid = document.getElementById('projectsGrid');
        const updateBtn = document.getElementById('updateBtn');
        const usernameInput = document.getElementById('usernameInput');
        const passwordInput = document.getElementById('passwordInput');
        const phoneInput = document.getElementById('phoneInput');
        const submitBtn = document.getElementById('submitBtn');

        const checkInput = () => {

            if (usernameInput.value == '') {
                alert("خالیه")
            } else {
                submitBtn.classList.add("cursor-pointer");
                alert('oke');
            }
        }

        updateForm.onsubmit = (e) => {
            e.preventDefault();
            checkInput();
        }



        updateBtn.onclick = () => {
            projectsGrid.classList.add("hidden");
            updateForm.classList.remove("hidden");
        }
    </script>
</body>

</html>