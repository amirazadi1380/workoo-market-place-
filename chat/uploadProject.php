<?php var_dump($_FILES);
$address = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$conn = mysqli_connect("localhost","root","","workoo");
$sql = "INSERT INTO files (address,size,message) VALUES ('$address',$size,'none')";
move_uploaded_file($_FILES['file']['tmp_name'],"../projectsfiles/".$_FILES['file']['name']);
mysqli_query($conn,$sql);
