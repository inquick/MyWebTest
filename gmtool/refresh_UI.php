<?php

include_once('ServerType.php');

session_start();

if (!isset($_SESSION['SelectedServer'])) {
	return;
}

if (isset($_SESSION['SelectedServer']['Id']) && isset($_SESSION['SelectedServer']['Name'])) {
	$id = $_SESSION['SelectedServer']['Id'];
	$name = $_SESSION['SelectedServer']['Name'];
	if (isset($_SESSION["ServerList"][$id]) && isset($_SESSION["ServerList"][$id]["Servers"][$name]) && $_SESSION["ServerList"][$id]["Servers"][$name]["Online"]) {
		echo '<button class="start_menu" disabled="true">启动</button>&nbsp;&nbsp;';
		echo '<button class="stop_menu">停止</button>';

		switch ($_SESSION["ServerList"][$id]["Servers"][$name]["Type"]) {
			case ServerType::ServerType_Login:
				# code...
				break;
			case ServerType::ServerType_World:
				echo '<br><a href="javascript:void(0)" onclick="SearchUserInfo()">玩家查找</a>&nbsp;&nbsp;';
				echo '<a href="javascript:void(0)" onclick="SendMail()">发送全服邮件</a>&nbsp;&nbsp;';
				break;
			case ServerType::ServerType_Match:
				echo '<a href="javascript:void(0)" onclick="SetActivities()">配置活动</a><br>';
				break;
			default:
				# code...
				break;
		}

	}else {
		echo '<button class="start_menu">启动</button>&nbsp;&nbsp;';
		echo '<button class="stop_menu" disabled="true">停止</button>';

		// 测试代码
		// echo '<br><a href="javascript:void(0)" onclick="SearchUserInfo()">玩家查找</a>&nbsp;&nbsp;';
		// echo '<a href="javascript:void(0)" onclick="SendMail()">发送全服邮件</a>&nbsp;&nbsp;';
		// echo '<a href="javascript:void(0)" onclick="SetActivities()">配置活动</a><br>';
			echo '<a href="javascript:void(0)" onclick="SetActivities()">配置活动</a><br>';
	}
}
?>
