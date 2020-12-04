<?php

include("../utils/messages.php");
include("../utils/sendFunctions.php");
include("../utils/db_connect.php");

session_start();

if (!isset($_SESSION['userid'])) {
    displayForbidden();
    exit();
}

if($_SERVER['REQUEST_METHOD'] != "GET") {
    displayMethodNotAllowed();
}
else{
    $bdd = init_db();

    $req=$bdd->prepare('SELECT * FROM spot');
    $req->execute(array());
    $result=$req->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0){
        showError(404, "Aucun resultat pour cette recherche");
    }        
    else{
        deliver_response(200, "Bien recu", $result);
    }
}

?>