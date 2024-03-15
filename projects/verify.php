<?php 
require_once(dirname(__FILE__) . "/project.model.php");
$rquest_id = $_GET['requestid'];
$project_id = $_GET['projectid'];
echo $rquest_id;
echo $project_id;

verifyRequest($rquest_id);
header("Location: /workoo/projects/personalRequests.php/?id=$project_id");