<?php
	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

	//Zuweisung der INPUT-VARIABLEN aus den Eingabefeldern durch Frontend:
	$user = $_GET["user"];

	var_dump($user);
        $args = array('{user}' => $user);
        
	$sql_right = "SELECT RICHTIG FROM STATISTIKEN WHERE U_ID = '{user}'";      //SQL Query der RICHTIG-Einträge
	$res_right = db_query($db, $sql_right, $args);                             //SQL Ausführen und Ergebnis in $res_right speichern

        $sql_wrong = "SELECT FALSCH FROM STATISTIKEN WHERE U_ID = '{user}'";       //SQL Query der FALSCH-Einträge
	$res_wrong = db_query($db, $sql_wrong, $args);                             //SQL Ausführen und Ergebnis in $res_wrong speichern 
        
        var_dump($res_right);
        var_dump($res_wrong);
	
	$catch_right = mysqli_fetch_array($res_right);                            //Die Werte der RICHTIG-Einträge sammeln    
        $catch_wrong = mysqli_fetch_array($res_wrong);                            //Die Werte der FALSCH-Einträge sammeln 
        
        $sum_right=0;
        $sum_wrong=0;
        
        while($right = mysqli_fetch_object($catch_right)) {                         //Addieren aller RICHTIG Einträge
            $right->RICHTIG;
            $sum_right=$sum_right+$right;
        }
		
        while($wrong = mysqli_fetch_object($catch_wrong)) {                          //Addieren aller FALSCH Einträge
            $wrong->FALSCH;
            $sum_wrong=$sum_wrong+$wrong;
        }
							
        
	header('Content-Type: application/json; charset=utf-8');                    //Übergabe der Addierten Einträge an das Frontend
	echo '{'
			.'"labels": ["RICHTIG", "FALSCH"],'
			.'"series": ['
				.$sum_right.','
				.$sum_wrong
			.']'
		.'}';
?>

