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
        //Abholen des Adminfeldes  
        $sql_adm = <<<SQL
	SELECT ADMIN FROM USER 
	WHERE U_ID = '{user}' 
SQL;
	
	$user = $_POST['user'];
	$pw = $_POST['password'];
        $sec_pw = md5($pw);

	$args = array('{user}' => $user);
	$res = db_query($db, $sql_tpl, $args);

        //Prüfen ob Adminrechte vorhanden sind, dann die Admin-Session erstellen
        $res2 =db_query($db, $sql_adm, $args);          
            if($res2=1){ 
            $_SESSION['ADMIN'] = true;
            }   
        
        
	if($sec_pw == $res[0]['PASSWORT']){
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