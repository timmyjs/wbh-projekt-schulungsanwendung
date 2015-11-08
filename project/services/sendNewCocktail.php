<?php
//Zuweisung der INPUT-VARIABLEN aus den Eingabefeldern durch Frontend:
	$recipeName             = $_POST['name'];
	$ingredient_frontend  = $_POST['ingredient'];
	
        
        require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

        $sql_recipe = "SELECT * FROM REZEPTE WHERE NAME ='$recipeName'";         //SQL Query der Überprüfung, ob Cocktail bereits vorhanden ist 
	if (mysqli_query($db,$sql_recipe))                                      //Prüfung, ob Cocktailname bereits vorhanden ist.
        {
             echo '{'
				.'"success": existing'
			.'}';
            }
        else
        {
            $sql_insert_recipe = "INSERT INTO REZEPTE (NAME) VALUES ($recipeName)";     
            if (mysql_query($sql_insert_recipe))                                            //Wenn ein neuer Datensatz mit dem Rezeptnamen angelegt werden kann, führe aus
            {
                mysqli_query($db, "INSERT INTO ZUORDNUNG (R_ID) VALUE (LAST_INSERT_ID())"); //
                
            while($insert_ingredient = mysqli_fetch_array($ingredient_frontend))            //Zuweisen aller Zutaten zu ausgewähltem Rezept   
                    {   
                        $sql_insert_ingr = "INSERT INTO ZUORDNUNG (R_ID, Z_ID)"
                        . "VALUES ((LAST_INSERT_ID(), $insert_ingredient['Z_ID'])";
                        
                        if(mysqli_query($db, $sql_insert_ingr))                         //Erfolgreiche Rückmeldung, wenn die Werte eingefügt wurden
                                
                        {
                             echo '{'
				.'"success": true'
			.'}';
                            
                        }
                                                                                        //Fehlermeldung, wenn keine Werte eingefügt wurden
                        else {
                             echo '{'
				.'"success": false'
			.'}';                         
                        }
                    }
                }
        }
       
        ?>