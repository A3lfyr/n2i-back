<?php


function checkSpotExist($bdd, $idSpot)
{
	$req = $bdd->prepare('SELECT idSpot from spot where idSpot='.intval($idSpot));
	$req->execute();
	return !is_bool($req->fetch());
}

function checkDateFormat($date){
	$arr = explode("-", $date); 
	return checkdate($arr[1], $arr[2], $arr[0]);
}

function checkTimeFormat($time){
	return preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/", $time);
}

