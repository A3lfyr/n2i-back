<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

if($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    http_response_code(200);
    exit(0);
}
?>