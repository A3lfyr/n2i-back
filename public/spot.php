<?php

include("../utils/messages.php");
include("../utils/sendFunctions.php");
include("../utils/db_connect.php");
include("../utils/cors.php");

session_start();


if (!isset($_SESSION['userid']) && false) {
    displayForbidden();
    exit();
}

if($_SERVER['REQUEST_METHOD'] != "GET") {
    displayMethodNotAllowed();
}
else{
    $bdd = init_db();

    if (isset($_GET['longitude']) && isset($_GET['latitude']))
    {
        $req=$bdd->prepare('SELECT * FROM spot WHERE latitude=:latitude AND longitude=:longitude');
        $req->execute(array('latitude' => $_GET['latitude'], 'longitude' => $_GET['longitude']));
        $result=$req->fetchAll(PDO::FETCH_ASSOC);
    
        if (count($result) == 0){
            showError(404, "Aucun resultat pour cette recherche");
        }        
        else{
            deliver_response(200, "Bien recu", $result);
        }
    }
    else{
        displayBadRequest();
    }
}

?>