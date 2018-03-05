<?php

// header('Content-type: text/json');

include_once 'MessageRequest.php';
include_once('ServerType.php');

if (isset($_SESSION['SelectedServer']['Id']) && isset($_SESSION['SelectedServer']['Name'])) {
  if ($_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Servers"][$_SESSION['SelectedServer']['Name']]["Type"] == ServerType::ServerType_Match) {
		$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];
		$result = MessageRequest::GetActivities($url, $_SESSION['SelectedServer']['Name']);

    // header('Content-type: text/json');
    echo $result;
    return;
  }
}

?>
