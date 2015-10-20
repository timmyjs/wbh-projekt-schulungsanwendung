<?php
	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

	//Zuweisung der INPUT-VARIABLEN aus den Eingabefeldern durch Frontend:
	$user = $_GET["user"];
	$recipe = $_GET["recipe"];

	var_dump($user, $recipe);

	$sql_stat = "SELECT R_ID, RICHTIG, FALSCH FROM STATISTIKEN WHERE U_ID = '{user}' AND R_ID = '{recipe}'";      //SQL Query der Statistiken für den ausgewählten Benuter und Rezepte
	$args = array('{user}' => $user, '{recipe}' => $recipe);
	$res_stat = db_query($db, $sql_stat, $args);                                                                  //SQL Ausführen und Ergebnis in $res_stat speichern

	var_dump($res_stat);

	$row = mysqli_fetch_array($res_stat);

	header('Content-Type: application/json; charset=utf-8');
	echo '{'
			.'"labels": ["RICHTIG", "FALSCH"],'
			.'"series": ['
				.$row["RICHTIG"].','
				.$row["FALSCH"]
			.']'
		.'}';
?>

