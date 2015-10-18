<?php
        //Zuweisung der INPUT-VARIABLEN aus den Eingabefeldern durch Frontend:
	$user= $_GET['U_ID'];
	
        require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

	$sql = "SELECT R_ID, RICHTIG, FALSCH FROM STATISTIKEN WHERE U_ID = '{user}'";			//SQL Query der Statistiken für den ausgewählte User
	$result = $db->query($sql);                                                                     //SQL Ausführen und Ergebnis in result speichern
        
        
        $args = array('{user}' => $user);
	$res = db_query($db, $sql, $args);
        
	
?>

