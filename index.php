<?php
include "header.php";

if(!isset($_SESSION['username'])) {
    include 'modules/login.php';
} else {
    $module = null;
    if(isset($_GET['module'])) {
        $module = $_GET['module'];
    }

    switch ($module) {
        case "buttons":
            include 'modules/buttons.php';
            break;
        case "calls":
            include 'modules/calls.php';
            break;
        case "test":
            include 'modules/test.php';
            break;
        case "admin":
            include 'modules/admin.php';
            break;
        case "administrationButtons":
            include 'modules/administrationButtons.php';
            break;
        case "administrationFloors":
            include 'modules/administrationFloors.php';
            break;
        case "administrationRooms":
            include 'modules/administrationRooms.php';
            break;
        case "logout":
            include 'modules/logout.php';
            break;

        default:
            include 'modules/dashboard.php';
    }

}



include "footer.php";
?>
