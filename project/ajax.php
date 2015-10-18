<?php
	sleep(2);

	switch ($_REQUEST['api']) {
		case 'example':
		case 'forgot-password':
		case 'submit-practice':
		case 'deleteRecipe':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
					.'"success": true'
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
					.'}, {'
						.'"id": 5,'
						.'"name": "Tequila"'
					.'}, {'
						.'"id": 6,'
						.'"name": "Orangensaft"'
					.'}, {'
						.'"id": 7,'
						.'"name": "Zitronensaft"'
					.'}, {'
						.'"id": 8,'
						.'"name": "Grenadine"'
					.'}, {'
						.'"id": 9,'
						.'"name": "Kirschsaft"'
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
		case 'getStats':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
					.'"labels": ["Banana", "Apples", "Grapes"],'
					.'"series": [20, 20, 60]'
				.'}';
		break;
	}
?>
