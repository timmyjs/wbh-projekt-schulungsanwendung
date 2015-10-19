<?php
        header('Content-Type: application/json; charset=utf-8');               
        //Zuweisung der INPUT-VARIABLEN aus den Eingabefeldern durch Frontend:
	$select_user=$_POST["stats"];
        $select_recipe=$_POST["stats2"];
        
        require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

	$sql_stat = "SELECT R_ID, RICHTIG, FALSCH FROM STATISTIKEN WHERE U_ID = '{user}' AND R_ID = '{recipe}'";      //SQL Query der Statistiken für den ausgewählten Benuter und Rezepte
	//$res_stat = mysqli_($db, $sql_stat);
        $res_stat = db_query($db, $sql_stat, $args);                                                                  //SQL Ausführen und Ergebnis in $res_stat speichern
        $args = array('{user}' => $select_user and '{recipe} => $select_recipe');
     

        $row = mysqli_fetch_array($res_stat);
        
  
			echo '{'
					.'"labels": ["RICHTIG", "FALSCH"],'
					.'"series": [$row["RICHTIG], $row["FALSCH"]'
				.'}';
                              
                           
?>

