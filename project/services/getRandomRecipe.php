<?php
		require_once("DBConnector.php");

		$connector = new DBConnector;
		$db = $connector->connect();

		//zu übergebende Parameter:

		//Höchsten Rezept-Index holen
		$sql_hoechstenIndex_holen = mysqli_prepare($db,"SELECT MAX(R_ID) FROM REZEPTE");
		mysqli_stmt_execute($sql_hoechstenIndex_holen);
		mysqli_stmt_bind_result($sql_hoechstenIndex_holen, $hoechsterIndex);
		mysqli_stmt_fetch($sql_hoechstenIndex_holen);
		mysqli_stmt_close($sql_hoechstenIndex_holen);

		$treffer = 0;	//Benötigt, falls dieser Index keinen Eintrag mehr hat (weil gelöscht worden)
		do
		{
			//Zufallszahl generieren
			$zufallsRezept = rand(0,$hoechsterIndex);//$hoechsterIndex[0]);

			//Rezeptname mit R_ID = Zufallszahl holen
			$sql_zufallsrezeptName_holen = mysqli_prepare($db,"SELECT NAME FROM REZEPTE WHERE R_ID = ?");
			mysqli_stmt_bind_param($sql_zufallsrezeptName_holen,'i', $zufallsRezept);
			mysqli_stmt_execute($sql_zufallsrezeptName_holen);
			mysqli_stmt_bind_result($sql_zufallsrezeptName_holen, $zufallsRezeptName);
			mysqli_stmt_fetch($sql_zufallsrezeptName_holen);
			mysqli_stmt_close($sql_zufallsrezeptName_holen);

			//Prüfung, ob kein gelöschter Index getroffen wurde
			if($zufallsRezeptName != NULL)
			{
				$treffer = 1;
			}
		}
		while($treffer == 0);

		header('Content-Type: application/json; charset=utf-8');
		echo '{'
			.'"name": "'.$zufallsRezeptName.'",'
			.'"id": '.$zufallsRezept
		.'}'
?>
