<?php
	require_once 'DBConnector.php';

	$connector = new DBConnector;
	$db = $connector->connect();

	$sql = <<<SQL
		SELECT password FROM user 
		WHERE name='admin' 
SQL;

	$res = mysqli_query($db, $sql);
	$ret = array();
	$pw = $_POST['password'];

	/* fetch associative array */
	while ($row = mysqli_fetch_assoc($res)) {
		$ret[] = $row;
	}

	if($pw == $ret[0]['password']){
		header('Content-Type: application/json; charset=utf-8');
		echo '{'
				.'"success": true'
			.'}';
	}else{
		header('Content-Type: application/json; charset=utf-8');
		echo '{'
				.'"success": false'
			.'}';
	}
?>