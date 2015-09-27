<?php
session_start();
       #Lesen der Login-Konfiguration
       #require_once('auth_config.php');
        
        #Datenbank-Kommunikation
	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';

	$connector = new DBConnector;
	$db = $connector->connect();
        
       
        
        //Abholen des gehashten Passwort
 
        
	$sql_tpl = <<<SQL
	SELECT PASSWORT FROM USER 
	WHERE U_ID = '{user}' 
SQL;
	
	$user = $_POST['user'];
	$pw = $_POST['password'];

	$args = array('{user}' => $user);
	$res = db_query($db, $sql_tpl, $args);

	if($pw == $res[0]['password']){
            //erfolgreiche Anmeldung - Session für den User wird erzeugt    
            $_SESSION['U_ID'] = $_POST['user']; 
                
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