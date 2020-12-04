<?php
	session_start();
	include("../utils/db_connect.php");
	include("../utils/jsonFunctions.php");
	include("../utils/account_mgmt.php");
	include("../utils/sendFunctions.php");
	
	$_SESSION['userid'] = 1;

	$decodedJavaData = jsonExtractData();

	if (!isset($_SESSION['userid']) && ($decodedJavaData['action'] != "post" || $decodedJavaData['table'] != "account")) {
		deliver_response(401, "", "");
		exit();
	}
	$http_method = $_SERVER['REQUEST_METHOD'];

	switch ($http_method){

		case "POST" :
			$bdd=init_db();


			if (!isset($decodedJavaData['table'])) {
				deliver_response(400, "", "");
				exit();
			}

			switch ($decodedJavaData['action']) {
				case 'add':
					if ($decodedJavaData['table'] == "account" && isset($decodedJavaData['userName']) && isset($decodedJavaData['password'])
						&& isset($decodedJavaData['email'])) {
						$checkEmailExists = $bdd->prepare("SELECT email from account where email = ?");
						$checkEmailExists->execute(array($decodedJavaData['email']));
						if (is_bool($checkEmailExists->fetch())) {
							$success = create_account($decodedJavaData['userName'], $decodedJavaData['password'], $decodedJavaData['email']);
							if ($success) {
								deliver_response(200, "", "");
							} else {
								deliver_response(520, "", "");
							}
						} else {
							deliver_response(409, "", "");
						}
						exit();

					}
			}
	}