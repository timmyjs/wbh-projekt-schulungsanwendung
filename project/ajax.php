<?php
	sleep(1);

	switch ($_REQUEST['api']) {
		case 'example':
			header('Content-Type: application/json; charset=utf-8');
			echo '{'
					.'"success": true'
				.'}';
		break;
		case 'login':
			header('Content-Type: application/json; charset=utf-8');
			if($_POST['user'] == 'admin' && $_POST['password'] == 'admin'){
				echo '{'
						.'"success": true'
					.'}';
			}else{
				echo '{'
						.'"success": false'
					.'}';
			}
		break;
	}
?>
