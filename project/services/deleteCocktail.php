<?php

//Verbindung mit der Datenbank
require_once 'DBConnector.php';
require_once 'DBFunctions.inc';

$connector = new DBConnector;
$db = $connector->connect();

//Zuweisung der INPUT-VARIABLE aus den Eingabefeldern durch Frontend:
$recipeID = $_POST['recipe'];

//Löschen vom Rezept in der Rezept-Liste
$delete_recipe = "DELETE FROM REZEPTE WHERE R_ID = $recipeID";

//Löschen der Zuordnung: Zutaten zu ausgewähltem Rezept
//Hier muss das Rezept noch aus der REZEPTE Tabelle und der Statistik entfernt werden
$delete_ingredient = "DELETE FROM ZUORDNUNG WHERE R_ID = $recipeID";

//Fehlermeldung, wenn die Werte nicht gelöscht werden konnten
if (mysqli_query($db, $delete_ingredient) && mysqli_query($db, $delete_recipe)) {
    echo '{' . '"success": true' . '}';
}
 //Fehlermeldung, wenn die Werte nicht gelÃ¶scht werden konnten
else {
    echo '{' . '"success": false' . '}';
}
?>
