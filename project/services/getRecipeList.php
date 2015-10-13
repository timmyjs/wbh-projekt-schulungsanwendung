<?PHP
	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

	$sql = "SELECT * FROM rezepte";						//SQL Query für alle Rezepte
	$result = $db->query($sql);							//SQL Ausführen und Ergebnis in result speichern

	$rezeptliste = array();								//Rezeptliste initialisieren; Wird mit allen Rezepten und Zutaten befüllt

	while($rezept = $result->fetch())
	{
		echo 'schleife';
		$rezeptID = $rezept['R_ID'];
		$sql2 = $db->prepare("SELECT * FROM zuordnung z, treppe t WHERE z.Z_ID = t.Z_ID AND z.R_ID = ?");
		$sql2->bind_param('i', $rezeptID);
		$sql2->execute();

		$json['id'] = $rezeptID;						//RezeptID speichern
		$json['name'] = $rezept['NAME'];				//dazugehörigen Namen speichern
		$json['ingredients'] = array();					//Zutaten-Array für das Rezept initialisieren

		while($zutaten = $sql2->fetch())
		{
			array_push($json['ingredients'], $zutaten['NAME']);			//Zutaten-Array befüllen
		}

		array_push($rezeptliste, $json); 				//Rezeptliste mit Daten aus dem aktuellen Schleifendurchlauf befüllen
	}

	$rezeptliste = json_encode($rezeptliste);			//Rezeptliste umwandeln

	header('Content-Type: application/json; charset=utf-8');
	echo $rezeptliste;
?>
