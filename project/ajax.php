<?php
	sleep(2);

	switch ($_REQUEST['api']) {
		case 'example':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
					.'"success": true'
				.'}';
		break;
		case 'user':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
					.'"role": "admin"'
				.'}';
		break;
		case 'recipes':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
					.'"recipes": ['
						.'{'
							.'"id": 1,'
							.'"name": "Pina Colada",'
							.'"ingredients": ['
								.'"Sahne",'
								.'"Rum",'
								.'"Cream of Coconut",'
								.'"Ananassaft"'
							.']'
						.'}, {'
							.'"id": 2,'
							.'"name": "Tequila Sunrise",'
							.'"ingredients": ['
								.'"Tequila",'
								.'"Orangensaft",'
								.'"Zitronensaft",'
								.'"Grenadine"'
							.']'
						.'}'
					.']'
				.'}';

	}
?>
