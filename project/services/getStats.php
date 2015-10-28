<?php
	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

	//Zuweisung der INPUT-VARIABLEN aus den Eingabefeldern durch Frontend:
	$user_stat = $_GET["user"];
	//$args = array('{user}' => $user_stat);

	$sql_right = "SELECT RICHTIG FROM STATISTIKEN WHERE U_ID ='$user_stat'";      //SQL Query der RICHTIG-Einträge
	$res_right = mysqli_query($db,$sql_right);                             //SQL Ausführen und Ergebnis in $res_right speichern

	$sql_wrong = "SELECT FALSCH FROM STATISTIKEN WHERE U_ID = '$user_stat'";       //SQL Query der FALSCH-Einträge
	$res_wrong = mysqli_query($db,$sql_wrong);                             //SQL Ausführen und Ergebnis in $res_wrong speichern


	$sum_right=0;
	$sum_wrong=0;

	while($right = mysqli_fetch_array($res_right)) {                         //Addieren aller RICHTIG Einträge
		$sum_right += $right['RICHTIG'];
	}

	while($wrong = mysqli_fetch_array($res_wrong)) {                          //Addieren aller FALSCH Einträge
		$sum_wrong += $wrong['FALSCH'];
	}

	if (($sum_right == 0) && ($sum_wrong == 0)) {
		$hasData = 'false';
	} else {
		$hasData = 'true';
	}

	header('Content-Type: application/json; charset=utf-8');                    //Übergabe der Addierten Einträge an das Frontend
	echo '{'
			.'"hasData": '.$hasData.','
			.'"labels": ["RICHTIG", "FALSCH"],'
			.'"series": ['
				.$sum_right.','
				.$sum_wrong
			.']'
		.'}';
		 ?>
