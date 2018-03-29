<?php

include_once 'MessageRequest.php';
include_once 'ServerType.php';

date_default_timezone_set("Asia/Shanghai");

if ($_GET["mailtype"] == 1) {
  if (true === empty($_GET["userid"])) {
    echo '个人邮件需要输入玩家id！';
    return;
  }
}

if (true === empty($_GET["beginedate"])) {
  echo '请输入邮件生效时间！';
  return;
}

if (true === empty($_GET["enddate"])) {
  echo '请输入邮件失效时间！';
  return;
}

if ($_GET["beginedate"] == $_GET["enddate"]){
  echo '邮件生效时间和失效时间不能为同一天！';
  return;
}

if ($_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Servers"][$_SESSION['SelectedServer']['Name']]["Type"] != ServerType::ServerType_World) {
  echo '请先选中一个world服';
  return;
}

$beginetime = strtotime($_GET["beginedate"]);
$endtime = strtotime($_GET["enddate"]);

$awards = "";

if (false === empty($_GET["customize_awards"])) {
  $arr = explode("|", $_GET["customize_awards"]);
  while(list($index, $OneAward) = each($arr)){
      $AwardInfo = explode(":", $OneAward);
      if (count($AwardInfo) != 3) {
        echo '邮件奖励格式错误！';
        return;
      }
      while(list($index2, $OneInfo) = each($AwardInfo)){
        if (!is_numeric($OneInfo)) {
          echo '邮件奖励格式错误！';
          return;
        }
      }
  }
  $awards = $_GET["customize_awards"];
}
else {
  if (strlen($_GET["item1_type"]) > 0 && strlen($_GET["item1_id"]) > 0 && strlen($_GET["item1_num"]) > 0) {
    $awards = $awards . $_GET["item1_type"] . ':' . $_GET["item1_id"] . ':' . $_GET["item1_num"];
  }

  if (strlen($_GET["item2_type"]) > 0 && strlen($_GET["item2_id"]) > 0 && strlen($_GET["item2_num"]) > 0) {
    $awards = $awards . '|' . $_GET["item2_type"] . ':' . $_GET["item2_id"] . ':' . $_GET["item2_num"];
  }

  if (strlen($_GET["item3_type"]) > 0 && strlen($_GET["item3_id"]) > 0 && strlen($_GET["item3_num"]) > 0) {
    $awards = $awards . '|' . $_GET["item3_type"] . ':' . $_GET["item3_id"] . ':' . $_GET["item3_num"];
  }

  if (strlen($_GET["item4_type"]) > 0 && strlen($_GET["item4_id"]) > 0 && strlen($_GET["item4_num"]) > 0) {
    $awards = $awards . '|' . $_GET["item4_type"] . ':' . $_GET["item4_id"] . ':' . $_GET["item4_num"];
  }

  if (strlen($_GET["item5_type"]) > 0 && strlen($_GET["item5_id"]) > 0 && strlen($_GET["item5_num"]) > 0) {
    $awards = $awards . '|' . $_GET["item5_type"] . ':' . $_GET["item5_id"] . ':' . $_GET["item5_num"];
  }

  if (strlen($_GET["item6_type"]) > 0 && strlen($_GET["item6_id"]) > 0 && strlen($_GET["item6_num"]) > 0) {
    $awards = $awards . '|' . $_GET["item6_type"] . ':' . $_GET["item6_id"] . ':' . $_GET["item6_num"];
  }

  if (strlen($_GET["item7_type"]) > 0 && strlen($_GET["item7_id"]) > 0 && strlen($_GET["item7_num"]) > 0) {
    $awards = $awards . '|' . $_GET["item7_type"] . ':' . $_GET["item7_id"] . ':' . $_GET["item7_num"];
  }

  if (strlen($_GET["item8_type"]) > 0 && strlen($_GET["item8_id"]) > 0 && strlen($_GET["item8_num"]) > 0) {
    $awards = $awards . '|' . $_GET["item8_type"] . ':' . $_GET["item8_id"] . ':' . $_GET["item8_num"];
  }
}

if (isset($_SESSION['SelectedServer']['Id'])) {
		$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];
		$result = MessageRequest::SendMail($url, (int)$_GET["userid"], $_SESSION['SelectedServer']['Name'], (int)$_GET["mailtype"], $beginetime, $endtime, $_GET["title"], $_GET["content"], $awards, $_GET["signature"]);

		echo $result;
}

?>
