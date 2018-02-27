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
    $htmldoc = '';
    if ($result != false) {
      if ($result->Result == 'SUCCESS') {
        $htmldoc = '<div id="serarced-acc">帐号：' . $result->Account . '</div><br>';
        $htmldoc = $htmldoc + '<div id="serarced-id">ID：' . $result->UserID . '</div><br>';
        $htmldoc = $htmldoc + '<div id="serarced-nick">昵称：' . $result->Nick . '</div><br>';
        $htmldoc = $htmldoc + '<div id="serarced-key">key：' . $result->Key . '</div><br>';
        $htmldoc = $htmldoc + '<div id="serarced-server">最近登录服务器：' . $result->Server . '</div><br>';
        if ($result->IsOnline){
          $htmldoc = $htmldoc + '在线<br>';
        }else {
          $htmldoc = $htmldoc + '离线';
        }
				$htmldoc = $htmldoc + '<button onclick="ReqrestFreezeUser()">封号</button><br>';
				$htmldoc = $htmldoc + '<button onclick="ReqrestUnFreezeUser()">解封</button>';
      }
    }else {
      $htmldoc = '服务器未响应！！！';
    }
    return $htmldoc;
}

?>
