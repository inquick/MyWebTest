<?php

include_once 'MessageRequest.php';

date_default_timezone_set("Asia/Shanghai");

if (true === empty($_GET["userid"]) || $_GET["userid"] == 0) {
  exit('请输入玩家id！');
}

if (true === empty($_GET["date"])) {
  exit('请输入截止时间！');
}

if (true === empty($_GET["server"])) {
  exit('服务器不能为空');
}

$time = strtotime($_GET["date"]);

if (isset($_SESSION['SelectedServer']['Id'])) {
		$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];
		$result = MessageRequest::FreeznUser($url, (int)$_GET["userid"], $time, $_GET["server"]);

		return $result;
}

?>
