<?php
partial('session');                                                             // Prüfen, ob Admin-Session vorhanden ist

//Zuweisung der INPUT-VARIABLE aus den Eingabefeldern durch Frontend:
	$recipeID 	= $_POST['recipe'];
	
	
        
        require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

        $delete_recipe     = "DELETE FROM REZEPTE WHERE R_ID = '$recipeID'";              //Löschen vom Rezept in der Rezept-Liste
        $delete_ingredient = "DELETE FROM ZUORDNUNG WHERE R_ID = '$recipeID'";            //Löschen der Zuordnung: Zutaten zu ausgewähltem Rezept
        #Hier muss das Rezept noch aus der REZEPTE Tabelle und der Statistik entfernt werden 
        
        if (mysqli_query($db, $delete_ingredient))
        {    
                            echo '{'
                            .'"success": true'
                            .'}';                   
        }                                                                      //Fehlermeldung, wenn die Werte nicht gelöscht werden konnten
        else {
                             echo '{'
				.'"success": false'
                            .'}';
                         
        }
        
        if (mysqli_query($db, $delete_recipe))
        {    
                            echo '{'
                            .'"success": true'
                            .'}';                   
        }                                                                      //Fehlermeldung, wenn die Werte nicht gelöscht werden konnten
        else {
                             echo '{'
				.'"success": false'
                            .'}';
                         
        }
         
        ?>