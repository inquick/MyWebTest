<?php

session_start();

if (isset($_SESSION['SelectedServer']['Id']) && isset($_SESSION['SelectedServer']['Name'])) {) {
		$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];

    $result = MessageRequest::OperatorServer($url, $_SESSION['SelectedServer']['Name'], $_GET["cmd"]);

    echo $result;
    return;
}

?>
