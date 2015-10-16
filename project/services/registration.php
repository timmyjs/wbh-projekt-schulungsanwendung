	<?PHP
	//Zuweisung der INPUT-VARIABLEN aus den Eingabefeldern durch Frontend:
	$benutzername 	= $_POST['username'];
	$email 			= $_POST['email'];
	$forename 		= $_POST['forename'];
	$surename 		= $_POST['surename'];
	$password 		= $_POST['password'];

	require_once 'DBConnector.php';
	require_once 'DBFunctions.inc';
	//Verbindung mit der Datenbank
	$connector = new DBConnector;
	$db = $connector->connect();

	$sql1 = $db->prepare('SELECT U_ID FROM USER WHERE U_ID = ?');
	$sql1->bind_param('s', $benutzername);
	$sql1->execute(); 												// Query wird ausgeführt
	$vorhandenerUser = $sql1->fetch(); 								// Ergebnis des Query

	if($vorhandenerUser == NULL) 									// Überprüfung, ob dieser Nutzername schon existiert
	{
			$password = md5($password);

			$sql2 = $db->prepare('INSERT INTO USER (U_ID, NAME, VORNAME, EMAIL, PASSWORT) VALUES (?, ?, ?, ?, ?)');
			$sql2->bind_param('sssss', $benutzername, $surename, $forename, $email, $password);
			$sql2->execute();

			$res = true;
	}
	else
	{
		$res = false;												// Nutzername existiert bereits; return wird false
	}

	header('Content-Type: application/json; charset=utf-8');
	echo '{"success":' .$res .'}';
?>
