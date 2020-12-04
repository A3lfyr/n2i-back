<?php

session_start();

include("../utils/messages.php");
include("../utils/db_connect.php");
include("../utils/jsonFunctions.php");
include("../utils/cors.php");

if($_SERVER['REQUEST_METHOD'] != "POST") {
    displayMethodNotAllowed();
}
else {
    $DATA = jsonExtractData();
    if(!(isset($DATA['action'])?($DATA['action']=="add"):false)) {
        displayMethodNotAllowed();
    }
    else if(!isset($DATA['username']) || !isset($DATA['password']) || !isset($DATA['remember'])) {
        displayBadRequest();
    }
    else {
        include("../utils/auth.php");
        $authResult = account_auth($DATA['username'], $DATA['password']);
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