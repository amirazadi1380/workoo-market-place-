<?php 
require_once(dirname(__FILE__) . "/chat.model.php");
$conn = mysqli_connect("localhost","root","","workoo");
$text = $_POST['message'];
$project_id = $_GET['projectId'];
$sender = $_GET['sender'];
$result = mysqli_query($conn,"SELECT user_id FROM projects WHERE project_id = $project_id");
$recievers = mysqli_fetch_assoc($result)['user_id'];
createMessage($text,$sender,$recievers,$project_id);
header("Location: /workoo/chat/chatRoom.php/?projectId=$project_id");
