<?php

include_once 'MessageRequest.php';

date_default_timezone_set("Asia/Shanghai");

if (true === empty($_GET["useracc"])) {
  exit('请输入玩家帐号！');
}

if (isset($_SESSION['SelectedServer']['Id'])) {
		$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];
		$result = MessageRequest::GetUserInfo($url, $_GET["useracc"]);

		// type FindUserRespone struct {
		// 	Result  string `json:"Result"`
		// 	Account string `json:"Account"`
		// 	UserID  uint32 `json:"UserID"`
		// 	Nick    string `json:"Nick"`
		// 	Key     string `json:"Key"`
		// 	Server  string `json:"Server"`
		// }
    // var_dump($result);


    // if ($result) {
    //   $response = json_decode($result);
    //   if ($response->Result == 'SUCCESS') {
    //     echo '<div id="serarced-acc">帐号：' . $response->Account . '</div>';
    //     echo '<div id="serarced-id">ID：' . $response->UserID . '</div>';
    //     echo '<div id="serarced-nick">昵称：' . $response->Nick . '</div>';
    //     echo '<div id="serarced-key">key：' . $response->Key . '</div>';
    //     echo '<div id="serarced-server">最近登录服务器：' . $response->Server . '</div>';
    //     if ($response->IsOnline){
    //       echo '在线<br>';
    //     }else {
    //       echo '离线';
    //     }
        echo '<br>截止时间：<input type="datetime-local" id="freeze_date" />&nbsp;';
				echo '<button onclick="ReqrestFreezeUser()">封号</button><br><hr />';
				echo '<button onclick="ReqrestUnFreezeUser()">解封</button><br><hr />';
				echo '<button onclick="SendPrivateMail()">给他发邮件</button>';
    //   }
    // }else {
    //   echo '服务器未响应！！！';
    // }
}

?>
