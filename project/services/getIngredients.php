<?php
	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

	$sql = "SELECT * FROM TREPPE";
	$res = mysqli_query($db, $sql);

	$i = 1;
	$count = mysqli_num_rows($res);

	header('Content-Type: application/json; charset=utf-8');
	echo '{ "ingredients": [';
	while ($key = mysqli_fetch_array($res)) {
		$lastRow = ($i < $count) ? '},' : '}';
		echo '{'
			.'"id": "' .$key['Z_ID'] .'",'
			.'"name": "' .$key['NAME'] .'",'
			.'"xPos": "' .$key['XPOS'] .'",'
			.'"yPos": "' .$key['YPOS'] .'"';
		echo $lastRow;
		$i++;
	}
	echo ']}';
?>
