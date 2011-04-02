<?php

if (empty($_REQUEST['c'])) {
	file_put_contents("/tmp/gitpost", "INVALID CHANNEL", FILE_APPEND);
	file_put_contents("/tmp/gitpost", print_r($_REQUEST, true), FILE_APPEND);
	exit();
}

$channel = "presence-{$_REQUEST['c']}";
$service = null;

if (!empty($_POST['payload'])) {
	$payload = json_decode($_POST['payload'], true);

	if (!empty($payload['base_ref'])) {
		$service = "github";
	}
	else if (!empty($payload['pusher'])) {
		$service = "kiln";
	}
}
else if (!empty($HTTP_RAW_POST_DATA)) {
	$service = "pivotal";
	$pivotal_data = simplexml_load_string($HTTP_RAW_POST_DATA);
}
else if (!empty($_POST['zendesk'])) {
	$service = "zendesk";
}

switch ($service) {
	case 'github':
		$author = $payload['commits'][0]['author']['email'];
		$action = "commit on ";
		$subject = $payload['repository']['name'];
		$content = $payload['commits'][0]['message'];
		break;
	case 'kiln':
		$author = $payload['pusher']['email'];
		$action = "commit on ";
		$subject = $payload['repository']['name'];
		$content = $payload['commits'][0]['message'];
		break;
	case 'pivotal':
		$author = "";
		$action = ucfirst(str_replace("_", " ", $pivotal_data->event_type)) . " on ";
		$subject = "Pivotal";
		$content = current($pivotal_data->description);
		break;
	case 'zendesk':
		$author = "";
		$action = "activity on ";
		$subject = "Zendesk";
		$content = $_POST['zendesk'];
		break;
	default:
		file_put_contents("/tmp/gitpost", "INVALID SERVICE", FILE_APPEND);
		file_put_contents("/tmp/gitpost", print_r($_REQUEST, true), FILE_APPEND);
		file_put_contents("/tmp/gitpost", print_r($HTTP_RAW_POST_DATA, true), FILE_APPEND);
		exit();
		break;
}

$to_encode = array(
				'service' => $service,
 				'author' => $author,
 				'action' => $action,
 				'subject' => $subject,
 				'content' => $content);

require_once 'lib/Pusher.php';

define('PUSHER_API_KEY', '1720c383aed9661954fd');
define('PUSHER_API_SECRET', 'af7ad4e26c04840250fa');
define('PUSHER_APP_ID', '4784');

$pusher = new Pusher(PUSHER_API_KEY, PUSHER_API_SECRET, PUSHER_APP_ID);
$pusher->trigger($channel, 'push', json_encode($to_encode));

file_put_contents("/tmp/gitpost", "PUSHED!", FILE_APPEND);
file_put_contents("/tmp/gitpost", print_r($_REQUEST, true), FILE_APPEND);
file_put_contents("/tmp/gitpost", print_r($to_encode, true), FILE_APPEND);

?>