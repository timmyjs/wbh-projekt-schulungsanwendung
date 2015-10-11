<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>

  </head>
  <body>
		<div class="container">
			<table>				
				<?PHP
					//Zuweisung der INPUT-VARIABLEN aus den Eingabefeldern durch Frontend:
					// $forename
					// $surename
					// $email
					// $benutzername
					// $password
					$benutzername = 'test';				//TEST
					$email = 'test@freenet.de';			//TEST
					$forename = 'Michael';					//TEST
					$surename = 'Mustermann';				//TEST
					$password = 'test';						//TEST
					

					require_once("/inc/DBConnector.php"); 											//Verbindung mit der Datenbank
					
					
					$sql1 = $db->prepare("SELECT U_ID FROM USER WHERE U_ID = ?");
					$sql1->bind_param('s', $benutzername);
					$sql1->execute(); 																//Query wird ausgeführt
					$vorhandenerUser = $sql1->fetch(); 												//Ergebnis des Query
	
					$success = 'false';
					
					if($vorhandenerUser == NULL) 													//Überprüfung, ob dieser Nutzername schon existiert
					{

							$password = md5($password);
							
							$sql2 = $db->prepare("INSERT INTO USER (U_ID, NAME, VORNAME, EMAIL, PASSWORT) VALUES (?, ?, ?, ?, ?)");
							$sql2->bind_param('sssss', $benutzername, $surename, $forename, $email, $password);
							$sql2->execute(); 	
							
							$success = 'true';	
					}
					else
					{
						$success = 'false';															//Nutzername existiert bereits; success bleibt false
						echo "USER BEREITS VORHANDEN";
					}
					
					
					
					//$succes kann weiter verwendet werden;
				?>
			</table>
		</div>
  </body>
</html>
