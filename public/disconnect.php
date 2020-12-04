<?php

session_start();


if($_SERVER['REQUEST_METHOD'] != "POST") {
    displayMethodNotAllowed();
}
else {
session_destroy();
}
?>