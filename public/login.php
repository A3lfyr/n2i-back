<?php

session_start();

include("../utils/messages.php");
include("../utils/db_connect.php");

if($_SERVER['REQUEST_METHOD'] != "POST") {
    displayMethodNotAllowed();
}
else {
    if(!(isset($_POST['action'])?($_POST['action']=="add"):false)) {
        displayMethodNotAllowed();
    }
    else if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['remember'])) {
        displayBadRequest();
    }
    else {
        include("../utils/auth.php");
        $authResult = account_auth($_POST['username'], $_POST['password']);
        if($authResult == 0) {
            showError(401, "Wrong credentials");
        }
        else {
            showError(200, "Connected");
            $_SESSION['userid'] = $authResult;
        }
    }
}

?>