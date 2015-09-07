<?php
       #Lesen der Login-Konfiguration
       #require_once('auth_config.php');
        
        #Datenbank-Kommunikation
	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';

	$connector = new DBConnector;
	$db = $connector->connect();
/*
        // Simple Eingabeprüfung des Benutzernamens und des Passwortes:
        if ( ! isset ($_POST['user']) )   { show_login('', 'Benutzername nicht übertragen.'); exit; } 
        if ( '' == trim($_POST['user']) ) { show_login('', 'Benutzername leer.')            ; exit; } 
        if ( ! isset ($_POST['password']) )   { show_login('', 'Passwort nicht übertragen.')    ; exit; } 
        if ( '' == trim($_POST['password']) ) { show_login('', 'Passwort leer.')   
        
        // Weiter wird der Benutzername beim Speichern stets klein geschrieben und man muss absichern,
        // dass keine Leerzeichen am Beginn oder Ende des Strings mitgeliefert wurden:
        $_POST['user']=strtolower(trim($_POST['user']));
        
        
        //Abholen des gehashten Passwort
 */
        
	$sql_tpl = <<<SQL
	SELECT password FROM user 
	WHERE name = '{user}' 
SQL;
	
	$user = $_POST['user'];
	$pw = $_POST['password'];

	$args = array('{user}' => $user);
	$res = db_query($db, $sql_tpl, $args);

	if($pw == $res[0]['password']){
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