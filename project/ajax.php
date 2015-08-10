<?php
	sleep(1);

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
	}
?>
