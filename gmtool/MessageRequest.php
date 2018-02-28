<?php

session_start();

include_once 'http-curl.php';
include_once 'MessageID.php';

class MessageRequest{
	static function GetServerList($url)
	{
		$data = array('Msg_ID' => MessageID::MsgID_GetServerList, );
		$result = http_post($url, json_encode($data));

		if (!$result){
			exit("请求服务器列表失败！");
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
			var_dump($result);
		}else {
			exit($response->Result);
		}
	}

	static function GetServerOnline($url, $servername)
	{
		$data = array('Msg_ID' => MessageID::MsgID_GetServerOnline, 'Server_Name' => $servername, );
		$result = http_post($url, json_encode($data));

		if (!$result){
			exit("获取在线人数失败！");
		}

		$response = json_decode($result);
		if ($response->Result == 'SUCCESS') {
			$_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Servers"][$_SESSION['SelectedServer']['Name']]["OnlineCnt"] = $response->Count;
			return  var_dump($_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Servers"][$_SESSION['SelectedServer']['Name']]);
		}

		return var_dump($result);
	}

	static function GetUserInfo($url, $useracc)
	{
		$data = array('Msg_ID' => MessageID::MsgID_GetUserInfo, 'Account' => $useracc, );
		$result = http_post($url, json_encode($data));

		if (!$result){
			return false;
		}

		return $result;
	}

	static function FreeznUser($url, $userid, $time, $server)
	{
		$data = array('Msg_ID' => MessageID::MsgID_FreeznUser, 'User_ID' => $userid, 'Time' => $time, 'Server_Name' => $server,);
		$result = http_post($url, json_encode($data));

		if (!$result){
			return "请求失败！";
		}

		$response = json_decode($result);
		return $response->Result;
	}

	static function UnFreeznUser($url, $userid, $server)
	{
		$data = array('Msg_ID' => MessageID::MsgID_UnFreeznUser, 'User_ID' => $userid, 'Server_Name' => $server, );
		$result = http_post($url, json_encode($data));

		if (!$result){
			return "请求失败！";
		}

		$response = json_decode($result);
		return $response->Result;
	}

	static function SendMail($url, $userid, $mailtype, $starttime, $endtime, $title, $content, $award, $signature)
	{
		$data = array('Msg_ID' => MessageID::MsgID_SendMail, 'User_ID' => $userid, );
		$result = http_post($url, json_encode($data));

		if (!$result){
			return "请求失败！";
		}

		$response = json_decode($result);
		return $response->Result;
	}
}

?>
