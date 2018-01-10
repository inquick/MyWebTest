<?php
session_start();

if (isset($_SESSION['UserName']))
{
	echo $_SESSION["UserName"];
}

?>
