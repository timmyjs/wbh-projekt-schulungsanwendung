<?php
	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

	$sql = "SELECT * FROM USER";
	$res = mysqli_query($db, $sql);

	$i = 1;
	$count = mysqli_num_rows($res);

	header('Content-Type: application/json; charset=utf-8');
	echo '{ "users": [';
	while ($key = mysqli_fetch_array($res)) {
		$admin = empty($key['ADMIN']) ? 'true' : 'false';
		$lastRow = ($i < $count) ? '},' : '}';
		echo '{'
			.'"id": "' .$key['U_ID'] .'",'
			.'"forename": "' .$key['VORNAME'] .'",'
			.'"surename": "' .$key['NAME'] .'",'
			.'"email": "' .$key['EMAIL'] .'",';
		echo '"isAdmin": ' .$admin .'';
		echo $lastRow;
		$i++;
	}
	echo ']}';
?>
