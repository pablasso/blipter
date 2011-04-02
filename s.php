<?php

if (empty($_GET['c']) || !is_numeric($_GET['c']) {
	file_put_contents("/tmp/gitpost", "INVALID CHANNEL", FILE_APPEND);
	file_put_contents("/tmp/gitpost", print_r($_REQUEST, true), FILE_APPEND);
	exit();
}

$channel = $_GET['c'];
$service = null;

if (!empty($_POST['payload'])) {
	$service = "github";
	$github_payload = json_decode($_POST['payload'], true);
}

switch ($service) {
	case 'github':
		$author = $github_payload['commits'][0]['author']['email'];
		$action = "commit on ";
		$subject = $github_payload['repository']['name'];
		$description = $github_payload['commits'][0]['message'];
		break;
	default:
		file_put_contents("/tmp/gitpost", "INVALID SERVICE", FILE_APPEND);
		file_put_contents("/tmp/gitpost", print_r($_REQUEST, true), FILE_APPEND);
		exit();
		break;
}

$to_encode = array(
				'service' => $service,
 				'author' => $author,
 				'action' => $action,
 				'subject' => $subject,
 				'description' => $description);

require_once 'lib/Pusher.php';

define('PUSHER_API_KEY', '1720c383aed9661954fd');
define('PUSHER_API_SECRET', 'af7ad4e26c04840250fa');
define('PUSHER_APP_ID', '4784');

$pusher = new Pusher(PUSHER_API_KEY, PUSHER_API_SECRET, PUSHER_APP_ID);
$pusher->trigger($channel, 'push', json_encode($to_encode));

file_put_contents("/tmp/gitpost", "PUSHED!", FILE_APPEND);
file_put_contents("/tmp/gitpost", print_r($_REQUEST, true), FILE_APPEND);

?>