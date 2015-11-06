<?PHP
$user = "sql286113"; //haben wir gerade angelegt
$pass = "zE9!wU1%"; //mit PSW

try 
{
	$dbh = new PDO('mysql:host=sql2.freesqldatabase.com:3306;dbname=sql286113', $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //ich glaube das kann man hier setzen
} 
catch (PDOException $e) 
{
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
?>