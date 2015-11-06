			
<?PHP
	require_once("PDODBConnector.php"); 				//Verbindung mit DB herstellen
	$sql = "SELECT * FROM REZEPTE";						//SQL Query für alle Rezepte
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$rezeptliste = array();								//Rezeptliste initialisieren; Wird mit allen Rezepten und Zutaten befüllt
	while($rezept = $sth->fetch())
	{	
		$rezeptID = $rezept['R_ID'];					
		$sql2 = "SELECT * FROM ZUORDNUNG z, TREPPE t WHERE z.Z_ID = t.Z_ID AND z.R_ID = :rezeptID";			//SQL Query für Zutaten
		$sth2 = $dbh->prepare($sql2);
		$sth2->bindValue(':rezeptID', $rezeptID);
		$sth2->execute();
	
		$json['id'] = $rezeptID;						//RezeptID speichern
		$json['name'] = $rezept['NAME'];				//dazugehörigen Namen speichern
	
		$json['ingredients'] = array();					//Zutaten-Array für das Rezept initialisieren
	
		while($zutaten = $sth2->fetch())
		{
			array_push($json['ingredients'], $zutaten['NAME']);			//Zutaten-Array befüllen
		}
		
		array_push($rezeptliste, $json); 				//Rezeptliste mit Daten aus dem aktuellen Schleifendurchlauf befüllen
	}

	header('Content-Type: application/json; charset=utf-8');		
	$rezeptliste = json_encode(array('recipes' => $rezeptliste));			
	echo $rezeptliste;									//Ausgabe
?>