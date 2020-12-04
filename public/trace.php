<?php

include("../utils/messages.php");
include("../utils/sendFunctions.php");
include("../utils/db_connect.php");
include("../utils/cors.php");

session_start();

if (!isset($_SESSION['userid'])) {
    displayForbidden();
    exit();
}

if($_SERVER['REQUEST_METHOD'] != "POST") {
    displayMethodNotAllowed();
}
else{
    $DATA = jsonExtractData();
    
    if(!(isset($DATA['action'])?($DATA['action']=="add"):false)) {
        displayMethodNotAllowed();
    }
    else if(!isset($DATA['idSpot']) || !isset($DATA['idTrace']) || !isset($DATA['traceFoundDate'])) {
        displayBadRequest();
    }
    else {
        $bdd = init_db();

        $insertTrace = $bdd->prepare("INSERT INTO trace values(:autre, :cigarette, :creme, :duree, :engrais,
            :essence, :idSpot, :idTrace, :idUser, :maquillage, :note, :parfum, :peinture, :startTimeSwimming,
            :traceFoundDate");
        $checkResult = $insertTrace->execute(array(
            'autre' => $DATA['autre'],
            'cigarette' => $DATA['cigarette'],
            'creme' => $DATA['creme'],
            'duree' => $DATA['duree'],
            'engrais' => $DATA['engrais'],
            'essence' => $DATA['essence'],
            'idSpot' => intval($DATA['idSpot']),
            'idTrace' => intval($DATA['idTrace']),
            'idUser' => $_SESSION['userid'],
            'maquillage' => $DATA['maquillage'],
            'note' => $DATA['note'],
            'parfum' => $DATA['parfum'],
            'peinture' => $DATA['peinture'],
            'startTimeSwimming' => $DATA['startTimeSwimming'],
            'traceFoundDate' => $DATA['traceFoundDate']));
        if ($checkResult) {
            deliver_response(200, "Bien effectue, lignes ajoutées: ", $checkResult);
        } else {
            showError(520, "SQL error");
        }
    }
}

?>