<?php

session_start();

include_once 'http-curl.php';
include_once 'MessageID.php';

class MessageRequest{
	/**
	 * 获取服务器列表
	 */
	static function GetServerList($url)
	{
		if (!isset($_SESSION['UserName'])){
			echo '请先登录';
			return;
		}
		$data = array('Msg_ID' => MessageID::MsgID_GetServerList, );
		$result = http_post($url, json_encode($data));

		$SelectedServer = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']];
		// 先重置在线状态
		while(list($name, $serverinfo['Servers']) = each($SelectedServer)){
			// var_dump($serverinfo);
			// echo '<br><br><br>';
			$serverinfo["Online"] = false;
		}

		if (!$result){
			echo "请求服务器列表失败！";
			return;
		}

		$response = json_decode($result);
		if ($response->Result == 'SUCCESS') {
			// 根据服务器返回信息刷新服务器在线状态
			// var_dump($response->Server_Name);
			if (!$response->Server_Name) {
				echo '服务器列表为空';
				return;
			}
			while(list($index, $name) = each($response->Server_Name)){
				if (isset($SelectedServer["Servers"][$name])) {
					$SelectedServer["Servers"][$name]["Online"] = true;
				}
			}

			$_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']] = $SelectedServer;

			// var_dump($_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]);
			// var_dump($result);
			return;
		}else {
			echo $response->Result;
		}
	}
	/**
	 * 获取在线人数
	 */
	static function GetServerOnline($url, $servername)
	{
		if (!isset($_SESSION['UserName'])){
			echo '请先登录';
			return;
		}
		$data = array('Msg_ID' => MessageID::MsgID_GetServerOnline, 'Server_Name' => $servername, );
		$result = http_post($url, json_encode($data));

		if (!$result){
			echo "获取在线人数失败！";
			return;
		}

		$response = json_decode($result);
		if ($response->Result == 'SUCCESS') {
			$_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Servers"][$_SESSION['SelectedServer']['Name']]["OnlineCnt"] = $response->Count;
			echo  $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Servers"][$_SESSION['SelectedServer']['Name']];
			return;
		}

		echo $result;
	}
	/**
	 * 获取玩家信息
	 */
	static function GetUserInfo($url, $useracc)
	{
		if (!isset($_SESSION['UserName'])){
			echo '请先登录';
			return;
		}
		$data = array('Msg_ID' => MessageID::MsgID_GetUserInfo, 'Account' => $useracc,);
		$result = http_post($url, json_encode($data));

		if (!$result){
			return false;
		}

		return $result;
	}
	/**
	 * 封号处理
	 */
	static function FreeznUser($url, $userid, $time, $server)
	{
		if (!isset($_SESSION['UserName'])){
			echo '请先登录';
			return;
		}
		$data = array('Msg_ID' => MessageID::MsgID_FreeznUser, 'User_ID' => $userid, 'Time' => $time, 'Server_Name' => $server,);
		$result = http_post($url, json_encode($data));

		if (!$result){
			echo "请求失败！";
			return;
		}

		// var_dump(json_encode($data));
		$response = json_decode($result);
		echo $response->Result;
	}
	/**
	 * 解封
	 */
	static function UnFreeznUser($url, $userid, $server)
	{
		if (!isset($_SESSION['UserName'])){
			echo '请先登录';
			return;
		}
		$data = array('Msg_ID' => MessageID::MsgID_UnFreeznUser, 'User_ID' => $userid, 'Server_Name' => $server, );
		$result = http_post($url, json_encode($data));

		if (!$result){
			echo "请求失败！";
			return;
		}

		$response = json_decode($result);
		echo $response->Result;
	}
	/**
	 * 发送邮件
	 */
	static function SendMail($url, $userid, $server, $mailtype, $starttime, $endtime, $title, $content, $award, $signature)
	{
		if (!isset($_SESSION['UserName'])){
			echo '请先登录';
			return;
		}
// type ClientRequest struct {
// 	Msg_ID         int    `json:"Msg_ID"`
// 	User_ID        uint32 `json:"User_ID"`
// 	Server_Name    string `json:"Server_Name"`
// 	Time           string `json:"Time"`
// 	Mail_type      uint32 `json:"mailtype"`
// 	Mail_user      uint32 `json:"userid"`
// 	Mail_start     int64  `json:"starttime"`
// 	Mail_end       int64  `json:"endtime"`
// 	Mail_title     string `json:"title"`
// 	Mail_content   string `json:"content"`
// 	Mail_award     string `json:"award"`
// 	Mail_signature string `json:"signature"`
// }
		$data = array('Msg_ID' => MessageID::MsgID_SendMail,
									'User_ID' => $userid,
									'Server_Name' => $server,
									'Mail_type' => $mailtype,
									'Mail_start' => $starttime,
									'Mail_end' => $endtime,
									'Mail_title' => $title,
									'Mail_content' => $content,
									'Mail_award' => $award,
									'Mail_signature' => $signature,);
		$result = http_post($url, json_encode($data));

		// var_dump(json_encode($data));

		if (!$result){
			echo "请求失败！";
			return;
		}

		$response = json_decode($result);
		echo $response->Result;
	}
}

?>
