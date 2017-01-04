<?php
include "header.php";

$module = null;
if(isset($_GET['module'])) {
	$module = $_GET['module'];
}

switch ($module) {
    case "room":
        include 'modules/room.php';
        break;
    default:
        include 'modules/dashboard.php';
}

include "footer.php";
?>
