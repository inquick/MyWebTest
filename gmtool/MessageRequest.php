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
		while(list($name, $serverinfo) = each($SelectedServer['Servers'])){
			// var_dump($serverinfo);
			// echo '<br><br><br>';
			$SelectedServer['Servers'][$name]["Online"] = false;

			// ob_start();
			// var_dump($serverinfo);
			// $result = ob_get_clean();
			// file_put_contents("log.txt", $result, FILE_APPEND);
		}

		// ob_start();
		// var_dump($SelectedServer);
		// $result = ob_get_clean();
		// file_put_contents("log.txt", $result, FILE_APPEND);

		if (!$result){
			echo "请求服务器列表失败！<br>";
			return;
		}

		$response = json_decode($result);
		if ($response->Result == 'SUCCESS') {
			// 根据服务器返回信息刷新服务器在线状态
			// var_dump($response->Server_Name);
			if (!$response->Server_Name) {
				echo '服务器列表为空<br>';
				return;
			}
			while(list($index, $name) = each($response->Server_Name)){
				if (isset($SelectedServer["Servers"][$name])) {
					$SelectedServer["Servers"][$name]["Online"] = true;
					echo '服务器' . $name . '在线<br>';
				}
			}

			$_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']] = $SelectedServer;

			// ob_start();
			// var_dump($SelectedServer);
			// $result = ob_get_clean();
			// file_put_contents("log.txt", $result, FILE_APPEND);

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
			echo '请先登录<br>';
			return;
		}
		$data = array('Msg_ID' => MessageID::MsgID_GetServerOnline, 'Server_Name' => $servername, );
		$result = http_post($url, json_encode($data));

		if (!$result){
			echo "获取在线人数失败！<br>";
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
									'mailtype' => $mailtype,
									'starttime' => $starttime,
									'endtime' => $endtime,
									'title' => $title,
									'content' => $content,
									'award' => $award,
									'signature' => $signature,);
		$result = http_post($url, json_encode($data));

		var_dump(json_encode($data));

		if (!$result){
			echo "请求失败！";
			return;
		}

		$response = json_decode($result);
		echo $response->Result;
	}
	/**
	 * 获取活动列表
	 */
	static function GetActivities($url, $server)
	{
		if (!isset($_SESSION['UserName'])){
			echo '请先登录';
			return;
		}
		$data = array('Msg_ID' => MessageID::MsgID_GetActivities, 'Server_Name' => $server, );
		$result = http_post($url, json_encode($data));

		if (!$result){
			echo "请求失败！";
			// $test = array();
			// for ($i=0; $i < 3; $i++) {
			// 	$test[$i] = array();
			// 	$test[$i]['id'] = $i;
			// 	$test[$i]['type'] = 1;
			// 	$test[$i]['starttime'] = 1517414400;
			// 	$test[$i]['endtime'] = 1520179200;
			// 	$test[$i]['stoptime'] = 15203520;
			// 	$test[$i]['name'] = '活动' . $i;
			// 	$test[$i]['des'] = '描述' . $i;
			// 	$test[$i]['params'] = '红方#1#蓝方#2#欢迎加入麦辣鸡翅与香辣鸡翅的庆典对抗#10#0';
			// }
			// echo json_encode($test);
			return;
		}

		$response = json_decode($result);
		if ($response->Result == 'SUCCESS') {
			$ActivityList = array();
			$index = 0;
			while(list($index, $activityInfo) = each($response->ActivityList)){
				$actid = $activityInfo->Activity_ID;
				$ActivityList[$index] = array();
				$ActivityList[$index]['id'] = (int)$actid;
				$ActivityList[$index]['type'] = (int)$activityInfo->Activity_Type;
				$ActivityList[$index]['starttime'] = (int)$activityInfo->Activity_StartTime;
				$ActivityList[$index]['endtime'] = (int)$activityInfo->Activity_EndTime;
				$ActivityList[$index]['stoptime'] = (int)$activityInfo->Activity_StopTime;
				$ActivityList[$index]['name'] = $activityInfo->Activity_Name;
				$ActivityList[$index]['des'] = $activityInfo->Activity_Des;
				$ActivityList[$index]['params'] = $activityInfo->Activity_Params;
				$index += 1;
			}

			$_SESSION["Activities"] = $ActivityList;

		  return json_encode($ActivityList);
		}
		echo $response->Result;
	}
	/**
	 * 设置活动
	 */
	static function SetActivity($url, $server, $activityId, $type, $starttime, $endtime, $stoptime, $name, $des, $params)
	{
		if (!isset($_SESSION['UserName'])){
			echo '请先登录';
			return;
		}
		// 活动通用配置属性
// message ActivityInfo
// {
// 	required uint32 id			= 1; // 活动id
// 	required ACTIVITYTYPE type	= 2; // 活动类型，只能选择已经开发出来的活动类型
// 	required int64 starttime	= 3; // 开始时间
// 	required int64 endtime		= 4; // 结束时间
// 	required int64 stoptime		= 5; // 停留时间
// 	required string name		= 6; // 活动标题
// 	required string des			= 7; // 活动内容
// 	required string params		= 8; // 活动参数（每个活动参数可能都不一样，需要商定参数数量和格式）
// }
		$data = array('Msg_ID' => MessageID::MsgID_SetActivity,
									'Server_Name' => $server,
									'Activity_ID' => $activityId,
									'Activity_Type' => $type,
									'Activity_StartTime' => $starttime,
									'Activity_EndTime' => $endtime,
									'Activity_StopTime' => $stoptime,
									'Activity_Name' => $name,
									'Activity_Des' => $des,
									'Activity_Params' => $params,);
		$result = http_post($url, json_encode($data));

		if (!$result){
			echo "请求失败！";
			return;
		}

		// echo var_dump(json_encode($data));

		$response = json_decode($result);
		echo $response->Result;
	}
	/**
	 * 服务器操作（启动、关闭、更新）
	 */
	static function OperatorServer($url, $server, $cmd)
	{
		if (!isset($_SESSION['UserName'])){
			echo '请先登录';
			return;
		}
		$result = '';
		$msgid = MessageID::MsgID_StartServer;
		switch ($cmd) {
			case 'Start':
				$msgid = MessageID::MsgID_StartServer;
				$result = $server . ' 启动 ';
				break;
			case 'Stop':
				$msgid = MessageID::MsgID_StopServer;
				$result = $server . ' 关闭 ';
				break;
			case 'Update':
				$msgid = MessageID::MsgID_UpdateServer;
				$result = $server . ' 更新 ';
				break;
		}

		$data = array('Msg_ID' => $msgid, 'Server_Name' => $server,);
		$resp = http_post($url, json_encode($data));

		if (!$resp){
			echo "请求失败！";
			return;
		}

		// var_dump(json_encode($data));
		$response = json_decode($resp);
		echo $result . $response->Result . '<br>' . $response->Value;
	}
}

?>
