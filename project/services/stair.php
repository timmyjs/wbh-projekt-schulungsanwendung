<?php
require_once './project/services/DBConnector.php';
require_once './project/services/DBFunctions.inc';

$connector = new DBConnector;
$db = $connector->connect();

$ingredient = $_GET["Z_ID"];                                                    //Zuweisung der INPUT-VARIABLEN "Z_ID"
	
$sql_staircase = <<<SQL
	SELECT XPOS, YPOS FROM TREPPE 
	WHERE Z_ID = '{ingredient}' 
SQL;

$args = array('{ingredient}' => $ingredient);
$res = db_query($db, $sql_staircase, $args);

echo $res;                                                                      //Rückgabe der Koordinaten als Zweidimensionales Array aus XPOS und YPOS

?>