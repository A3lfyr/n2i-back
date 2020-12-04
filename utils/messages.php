<?php

function showError($code, $msg) {
    http_response_code($code);
    print("{\"error\": \"" . $msg . "\"}");
}

//Error 400
function displayBadRequest() {
    showError(400, "Bad Request");
}

//Error 401
function displayForbidden() {
    showError(401, "Forbidden");
}

//Error 405
function displayMethodNotAllowed() {
    showError(405, "Method not allowed");
}

?>