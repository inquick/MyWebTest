<?php

include_once 'MessageRequest.php';

if (isset($_SESSION['SelectedServer']['Id'])) {
	$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];
	$result = MessageRequest::GetServerList($url);

	return $result;
}

?>
