<?php

session_start();

include_once 'http-curl.php';
include_once 'MessageID.php';

class MessageRequest{
	static function GetServerList($url)
	{
		$data = array('Msg_ID' => MessageID::MsgID_GetServerList, 'User_ID' => 0, 'Server_Name' => '', );
		$result = http_post($url, json_encode($data));

		if (!$result){
			exit("请求失败！");
		}

		$response = json_decode($result);
		if ($response->Result == 'SUCCESS') {
			$SelectedServer = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']];
			// 先重置在线状态
			while(list($name, $serverinfo['Servers']) = each($SelectedServer)){
				// var_dump($serverinfo);
				// echo '<br><br><br>';
				$serverinfo["Online"] = false;
			}
			// 根据服务器返回信息刷新服务器在线状态
			// var_dump($response->Server_Name);
			if (!$response->Server_Name) {
				exit('服务器列表为空');
			}
			while(list($index, $name) = each($response->Server_Name)){
				if (isset($SelectedServer["Servers"][$name])) {
					$SelectedServer["Servers"][$name]["Online"] = true;
				}
			}
			$_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']] = $SelectedServer;

			// var_dump($_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]);
		}else {
			exit($response->Result);
		}
	}

	static function GetServerOnline($url, $servername)
	{
		$data = array('Msg_ID' => MessageID::MsgID_GetServerOnline, 'User_ID' => 0, 'Server_Name' => $servername, );
		$result = http_post($url, json_encode($data));

	}

	static function GetUserInfo($url, $userid, $servername)
	{
		$data = array('Msg_ID' => MessageID::MsgID_GetUserInfo, 'User_ID' => $userid, 'Server_Name' => $servername, );
		$result = http_post($url, json_encode($data));

	}
}

?>
