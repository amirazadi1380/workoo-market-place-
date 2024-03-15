<?php
$conn = mysqli_connect("localhost","root","","workoo");
$sql = "SELECT * FROM users";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0){
    $allUsers = [];
    while($row = mysqli_fetch_assoc($result)){
        $allUsers[] = $row;
    }
}
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
<div class="w-screen h-[2000px] bg-slate-800 grid grid-cols-2 place-items-center gap-10 pt-10">
    <?php foreach($allUsers as $user){ ?>
        <div class="border justify-center items-center text-black bg-white/90 cursor-pointer hover:scale-110 md:hover:scale-125 duration-150 rounded-md w-52 h-40  space-y-2 text-center flex flex-col justify-center relative">

           <?php if ($user['img_src'] != ''){ ?> <img src=<?php echo "../upload/$user[img_src]"; ?> alt="avatar" class="w-16 h-16 rounded-full absolute -top-10"> <?php } ?>
            <h1 class="font-bold text-lg text-green-500"><?php echo $user['username']; ?></h1>
            <h1 class="opacity-80 ">password : <?php echo $user['password']; ?></h1>
            <h1 class="text-xs "> phone : <?php echo $user['phone']; ?></h1>
            <p class="opacity-50 font-extrabold "><?php echo $user['type']; ?></p>
        </div>
    <?php } ?>
</div>
</body>
</html>