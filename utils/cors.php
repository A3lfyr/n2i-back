<?php
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN'] );

header('Access-Control-Allow-Methods: GET, POST');

header('Access-Control-Allow-Headers: Accept, Accept-Language, Content-Language, Content-Type, Cookie');

header('Access-Control-Allow-Credentials: true');

if($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    http_response_code(200);
    exit(0);
}
?>