<?php 
   $_SESSION['project_id'] = $projects['project_id'];
   header("Location: ../chat/chatRoom.php/?id=$projects[project_id]");