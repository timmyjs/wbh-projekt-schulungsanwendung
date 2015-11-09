
<?php
		require_once "DBConnector.php"; 				//Verbindung mit DB herstellen
		require_once "DBFunctions.inc";
		require_once("PDODBConnector.php");

		$connector = new DBConnector;
		$db = $connector->connect();

		//zu übergebende Parameter:
		$cocktailID = $_POST['recipe'];
		$user = $_POST['user'];
		$eingegebene_Liste = array();

		foreach ($_POST['ingredient'] as $value) {
			array_push($eingegebene_Liste, $value);
		}

		//Vorgabeliste aus der Datenbank auslesen
		$sql_vorgabeliste_holen = $dbh->prepare("SELECT Z_ID FROM ZUORDNUNG WHERE R_ID = :rid");
		$sql_vorgabeliste_holen->bindparam(':rid', $cocktailID);
		$sql_vorgabeliste_holen->execute();

		$vorgabeliste = array();

		//-> Query in Array $vorgabeliste packen
		while($row = $sql_vorgabeliste_holen->fetch())
		{
			array_push($vorgabeliste, $row['Z_ID']);
		}

		//Vergleich der Vorgabeliste mit der eingegebenen Liste
		if(array_diff($vorgabeliste, $eingegebene_Liste) === array_diff($eingegebene_Liste, $vorgabeliste))
		{
			$richtig = 1;
			$falsch = 0;
		}
		else
		{
			$richtig = 0;
			$falsch = 1;
		}

		//Statistiken Updaten
		$sql_kombination_vorhanden = $db->prepare("SELECT U_ID FROM STATISTIKEN WHERE R_ID = ? AND U_ID = ?");
		$sql_kombination_vorhanden->bind_param('is', $cocktailID, $user);
		$sql_kombination_vorhanden->execute();
		$kombination_vorhanden = $sql_kombination_vorhanden->fetch();
		$sql_kombination_vorhanden->close();

		if($kombination_vorhanden == NULL)
		{
			//KOMBINATION NICHT VORHANDEN -> Insert
			$sql_kombination_anlegen = $db->prepare("INSERT INTO STATISTIKEN (R_ID, U_ID, RICHTIG, FALSCH) VALUES (?, ?, ?, ?)");
			$sql_kombination_anlegen->bind_param('isii', $cocktailID, $user, $richtig, $falsch);
			$sql_kombination_anlegen->execute();
		}
		else
		{
			//KOMBINATION VORHANDEN -> Update
			$sql_kombination_updaten = $db->prepare("UPDATE STATISTIKEN SET RICHTIG = RICHTIG + ?, FALSCH = FALSCH + ? WHERE R_ID = ? AND U_ID = ?");
			$sql_kombination_updaten->bind_param('iiis', $richtig, $falsch, $cocktailID, $user);
			$sql_kombination_updaten->execute();
		}

		$result = ($richtig == 1) ? 'right' : 'wrong';

		header('Content-Type: application/json; charset=utf-8');
		echo '{'
				.'"success": true,'
				.'"result": "'.$result.'"'
			.'}';
?>
