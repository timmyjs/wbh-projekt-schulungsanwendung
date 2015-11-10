<?php
	//Prüfen, ob Admin-Session vorhanden ist
	//partial('session'); -> "partial" funktioniert nur in Views

	//Verbindung mit der Datenbank
	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';

	$connector = new DBConnector;
	$db = $connector->connect();

	//Zuweisung der INPUT-VARIABLE aus den Eingabefeldern durch Frontend:
	$recipeID = $_POST['recipe'];

	//Löschen vom Rezept in der Rezept-Liste
	$delete_recipe = "DELETE FROM REZEPTE WHERE R_ID = {recipe}";
	//Löschen der Zuordnung: Zutaten zu ausgewähltem Rezept
	//Hier muss das Rezept noch aus der REZEPTE Tabelle und der Statistik entfernt werden
	$delete_ingredient = "DELETE FROM ZUORDNUNG WHERE R_ID = {recipe}";

	$args = array('{recipe}' => $recipeID);

	//Fehlermeldung, wenn die Werte nicht gelöscht werden konnten
	$result = (db_query($db, $delete_ingredient, $args) && db_query($db, $delete_recipe, $args)) ? 'true' : 'false';

	header('Content-Type: application/json; charset=utf-8');
	echo '{ "success": ' .$result .'}';
?>
