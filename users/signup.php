
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign Up page</title>
</head>

<body>
    <?php
    require_once(dirname(__FILE__) . "/controllers/users.model.php");
    ?>
    <div class="w-full h-screen bg-blue-800 flex justify-center items-center relative">
        <div class="bg-black/50 relative text-white font-mono w-96 h-[580px] rounded-lg sahdow-xl border-5xl p-5 flex flex-col justify-center text-center items-center">
            <h1 class="text-5xl font-bold pb-5 font-serif">عضویت</h1>
            <form id="loginform" action="/workoo/users/controllers/create.php" method="post" enctype="multipart/form-data">
                <label class="space-y-2 ">
                    <h1>نام کاربری</h1>
                    <input type="text" name="username" class="text-black bg-gray-400 rounded-md" />
                </label>
                <label class="space-y-2">
                    <h1>پسورد</h1>
                    <input type="password" id="loginPassword" name="password" class="text-black bg-gray-400 rounded-md" />
                </label>
                <label class="space-y-1">
                    <h1>تایید پسورد</h1>
                    <input type="password" id="confirmPassword" name="password" class="text-black bg-gray-400 rounded-md" />
                </label>
                <p class="text-xs pb-2 text-green-400" id="confirmText"></p>
                <label class="space-y-1 block p-2">
                    <h1>شماره تماس</h1>
                    <input type="text" name="phone" class="text-black bg-gray-400 rounded-md" />
                </label>
                <select class="text-black mt-2 bg-gray-400 w-32 text-center p-1 cursor-pointer rounded-md outline-none" name="selectOption">
                    <option value="owner">کارفرما</option>
                    <option value="freelancer">فریلنسر</option>
                </select>


                <input type="file" name="uploadImage" class=" text-xs p-2">

                <input type="submit" id="submitButton" name="finalsubmit" value="ثبت نهایی" class="bg-blue-600 block text-white w-80 hover:scale-125 transition-all duration-200 text-[17px] cursor-pointer p-1 rounded-xl mt-5 hover:bg-white hover:text-black duration-200">
                <div class="w-full flex justify-center font-bold text-xl p-1 mt-2">
                    <a href="login.php" class="text-xl text-blue-400 hover:text-white cursor-pointer">ورود</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        let loginPassword = document.getElementById('loginPassword');
        let loginform = document.getElementById('loginform');
        let submitButton = document.getElementById('submitButton');
        let confirmPassword = document.getElementById('confirmPassword');
        let confirmText = document.getElementById('confirmText');
        let updateBtn = document.getElementById('updateBtn');
        let updateForm = document.getElementById('updateForm');
        let password = ''
        let confirmPass = ''
        var test = document.getElementById('test')
        loginPassword.addEventListener('change', (e) => {
            password = e.target.value
        })
        confirmPassword.addEventListener('change', (e) => {
            confirmPass = e.target.value
            if (confirmPass == password) {
                confirmText.innerText = "پسورد صحیح است ✔️"
            } else {
                confirmText.innerText = "پسورد مطابقت ندارد ❌ "
            }
        })


        updateBtn.addEventListener('click', () => {
            loginform.style.display = "none";
            updateForm.style.display = "flex";

        })
    </script>
</body>

</html>