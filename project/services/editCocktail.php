<?php
//Zuweisung der INPUT-VARIABLEN aus den Eingabefeldern durch Frontend:
	$recipeID 	= $_POST['recipe'];
	$ingredient_frontend  = $_POST['ingredient'];
	
        
        require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

        $sql_recipe = "SELECT Z_ID FROM ZUORDNUNG WHERE R_ID ='$recipeID'";      //SQL Query der RICHTIG-Einträge
	$res_recipe = mysqli_query($db,$sql_recipe);                             //SQL Ausführen und Ergebnis in $res_recipe speichern
        
        $delete_ingredient = "DELETE FROM zuordnung WHERE R_ID = ?";            //Löschen aller Zutaten zu ausgewähltem Rezept
        if (mysqli_query($db, $delete_ingredient))
        {
            while($insert_ingredient = mysqli_fetch_array($ingredient_frontend))     //Zuweisen aller Zutaten zu ausgewähltem Rezept   
                    {   
                        $sql_insert_ingr = "INSERT INTO zuordnung (R_ID, Z_ID) VALUES ($recipeID, $insert_ingredient)";
                        
                        if(mysqli_query($db, $sql_insert_ingr))                     //Erfolgreiche Rückmeldung, wenn die Werte eingefügt wurden
                                
                        {
                             echo '{'
				.'"success": true'
			.'}';
                            
                        }
                                                                                    //Fehlermeldung, wenn die Werte nicht eingefügt werden konnten
                        else {
                             echo '{'
				.'"success": false'
			.'}';
                         
                        }
                    }	
        } 
        else {
            
                        echo '{'
				.'"success": false'
			.'}';
            }
        ?>