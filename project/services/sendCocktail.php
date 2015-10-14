<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>

  </head>
  <body>
		<div class="container">
			<table>	
					<?php
							require_once("inc/DBConnector.php"); 				//Verbindung mit DB herstellen
							
							//zu übergebende Parameter:							
							$cocktailID = 2;
							$user = 'spiech1';
							$eingegebene_Liste = array(1,2,3);

							
							//Vorgabeliste aus der Datenbank auslesen
							$sql_vorgabeliste_holen = $db->prepare("SELECT Z_ID FROM ZUORDNUNG WHERE R_ID = ?");
							$sql_vorgabeliste_holen->bind_param('i', $cocktailID);
							$sql_vorgabeliste_holen->execute();							
							
							//-> Query in Array $vorgabeliste packen
							$vorgabeliste = $sql_vorgabeliste_holen->fetchArray();
							
							
							
							
							//Vergleich der Vorgabeliste mit der eingegebenen Liste
							if(array_diff($vorgabeliste, $eingegebene_Liste) === array_diff($eingegebene_Liste, $$vorgabeliste))
							{
								echo "REZEPT RICHTIG!  ";	//zum Testen
								$richtig = 1;
								$falsch = 0;								
							}
							else
							{
								echo "REZEPT FALSCH!  ";	//zum Testen
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
								echo "KOMBINATION NICHT VORHANDEN!";	//zum Testen
								$sql_kombination_anlegen = $db->prepare("INSERT INTO STATISTIKEN (R_ID, U_ID, RICHTIG, FALSCH) VALUES (?, ?, ?, ?)");
								$sql_kombination_anlegen->bind_param('isii', $cocktailID, $user, $richtig, $falsch);
								$sql_kombination_anlegen->execute();								
							}
							else
							{
								echo "KOMBINATION VORHANDEN!";	//zum Testen
								$sql_kombination_updaten = $db->prepare("UPDATE STATISTIKEN SET RICHTIG = RICHTIG + ?, FALSCH = FALSCH + ? WHERE R_ID = ? AND U_ID = ?");
								$sql_kombination_updaten->bind_param('iiis', $richtig, $falsch, $cocktailID, $user);
								$sql_kombination_updaten->execute();

							}
							
							
					?>
			</table>
		</div>
  </body>
</html>