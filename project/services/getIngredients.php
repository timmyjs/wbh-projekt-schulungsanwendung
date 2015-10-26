<?php

require_once './project/services/DBConnector.php';
require_once './project/services/DBFunctions.inc';

$connector = new DBConnector;
$db = $connector->connect();

         	
$sql_get_ingredient = "SELECT Z_ID, NAME, XPOS, YPOS FROM TREPPE";

$res = db_query($db, $sql_get_ingredient, $args);

echo $res; 




/*

case 'ingredients':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
				.'"ingredients": ['
					.'{'
						.'"id": 1,'
						.'"name": "Sahne",'
						.'"xPos": 1,'
						.'"yPos": 1'
					.'}, {'
						.'"id": 2,'
						.'"name": "Rum",'
						.'"xPos": 2,'
						.'"yPos": 1'
					.'}, {'
						.'"id": 3,'
						.'"name": "Cream of Coconut",'
						.'"xPos": 3,'
						.'"yPos": 1'
					.'}, 
				.']'
			.'}';
		break;
                
                */
                ?>