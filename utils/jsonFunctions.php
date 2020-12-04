<?php

function jsonExtractData(){
	$postedData = file_get_contents('php://input');
	return json_decode($postedData,true);
}