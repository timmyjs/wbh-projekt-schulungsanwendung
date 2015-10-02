<?php
	sleep(2);

	switch ($_REQUEST['api']) {
		case 'example':
		case 'submit-practice':
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
		case 'registration':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
					.'"success": false'
				.'}';
		break;
		case 'ingredients':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
				.'"ingredients": ['
					.'{'
						.'"id": 1,'
						.'"name": "Sahne"'
					.'}, {'
						.'"id": 2,'
						.'"name": "Rum"'
					.'}, {'
						.'"id": 3,'
						.'"name": "Cream of Coconut"'
					.'}, {'
						.'"id": 4,'
						.'"name": "Ananassaft"'
					.'}'
				.']'
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
		break;
		case 'practice-new-recipe':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
					.'"name": "Pina Colada"'
				.'}';
		break;
	}
?>
