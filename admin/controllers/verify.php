<?php 
require_once(dirname(__FILE__) . "/admin.model.php");
$request = $_GET['request'];
$project_id = $_GET['id'];
verifyProject($request,$project_id);
echo "done";
header('Location:../../allProjects.php');