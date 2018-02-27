<?php

include_once 'MessageRequest.php';
include_once('ServerType.php');

if (isset($_SESSION['SelectedServer']['Id']) && isset($_SESSION['SelectedServer']['Name'])) {
	if ($_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Servers"][$_SESSION['SelectedServer']['Name']]["Type"] == ServerType::ServerType_World) {
		$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];
		$result = MessageRequest::GetServerOnline($url, $_SESSION['SelectedServer']['Name']);

		return $result;
	}
}

?>
