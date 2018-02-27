<?php

include_once 'MessageRequest.php';

date_default_timezone_set("Asia/Shanghai");

if (true === empty($_GET["userid"]) || $_GET["userid"] == 0) {
  exit('请输入玩家id！');
}

if (isset($_SESSION['SelectedServer']['Id'])) {
		$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];
		$result = MessageRequest::UnFreeznUser($url, (int)$_GET["userid"]);

		return $result;
}

?>
