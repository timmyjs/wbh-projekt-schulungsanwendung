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
						.'"name": "Sahne",'
						.'"xPos": 1,'
						.'"yPos": 1'
					.'}, {'
						.'"id": 2,'
						.'"name": "Rum",'
						.'"xPos": 2,'
						.'"yPos": 1'
					.'}, {'
						.'"id": 3,'
						.'"name": "Cream of Coconut",'
						.'"xPos": 3,'
						.'"yPos": 1'
					.'}, {'
						.'"id": 4,'
						.'"name": "Ananassaft",'
						.'"xPos": 4,'
						.'"yPos": 1'
					.'}, {'
						.'"id": 5,'
						.'"name": "Tequila",'
						.'"xPos": 1,'
						.'"yPos": 2'
					.'}, {'
						.'"id": 6,'
						.'"name": "Orangensaft",'
						.'"xPos": 2,'
						.'"yPos": 2'
					.'}, {'
						.'"id": 7,'
						.'"name": "Zitronensaft",'
						.'"xPos": 3,'
						.'"yPos": 2'
					.'}, {'
						.'"id": 8,'
						.'"name": "Grenadine",'
						.'"xPos": 4,'
						.'"yPos": 2'
					.'}, {'
						.'"id": 9,'
						.'"name": "Kirschsaft",'
						.'"xPos": 1,'
						.'"yPos": 3'
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
		case 'user':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
				.'"users": ['
					.'{'
						.'"id": "tmay",'
						.'"forename": "Thomas",'
						.'"surename": "May",'
						.'"email": "thomas.may@namics.com",'
						.'"isAdmin": true'
					.'}, {'
						.'"id": "pkurkowski",'
						.'"forename": "Peter",'
						.'"surename": "Kurkowski",'
						.'"email": "peter.kurkowski@outlook.com",'
						.'"isAdmin": true'
					.'}, {'
						.'"id": "cspiekermann",'
						.'"forename": "Christian",'
						.'"surename": "Spiekermann",'
						.'"email": "chris.87@freenet.de",'
						.'"isAdmin": true'
					.'}, {'
						.'"id": "mschwabe",'
						.'"forename": "Marco",'
						.'"surename": "Schwabe",'
						.'"email": "mail.schwabe@gmx.de",'
						.'"isAdmin": true'
					.'}, {'
						.'"id": "tuser",'
						.'"forename": "Test",'
						.'"surename": "User",'
						.'"email": "test.user@test.de",'
						.'"isAdmin": false'
					.'}'
				.']'
			.'}';
		break;
	}
?>
