<?php

session_start();

if (isset($_GET['SID'])) {
	$_SESSION['SelectedServer']['Id'] = $_GET['SID'];
}

if (isset($_GET['SName'])) {
	$_SESSION['SelectedServer']['Name'] = $_GET['SName'];
}else {
	unset($_SESSION['SelectedServer']['Name']);
}

return var_dump($_GET['SID']);

?>
