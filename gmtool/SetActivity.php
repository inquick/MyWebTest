<?php

include_once 'MessageRequest.php';
include_once('ServerType.php');

date_default_timezone_set("Asia/Shanghai");

if (true === empty($_GET["index"])) {
  echo '活动索引错误！';
  return;
}

if (true === empty($_GET["starttime"])) {
  echo '活动开始时间错误！';
  return;
}

if (true === empty($_GET["endtime"])) {
  echo '活动结束时间错误！';
  return;
}

if (true === empty($_GET["stoptime"])) {
  echo '活动消失时间错误！';
  return;
}

if (true === empty($_GET["name"])) {
  echo '活动名错误！';
  return;
}

if (true === empty($_GET["des"])) {
  echo '活动描述错误！';
  return;
}

if (true === empty($_GET["params"])) {
  echo '活动参数错误！';
  return;
}

$starttime = strtotime($_GET["starttime"]);
$endtime = strtotime($_GET["endtime"]);
$stoptime = strtotime($_GET["stoptime"]);

$params = preg_replace('/_/', '#', $_GET["params"]);
// echo $params . '<br><br>';
// return;

if (isset($_SESSION['SelectedServer']['Id']) && isset($_SESSION['SelectedServer']['Name'])) {
  if ($_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Servers"][$_SESSION['SelectedServer']['Name']]["Type"] == ServerType::ServerType_Match) {
		$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];

    if (!isset($_SESSION["Activities"])) {
      echo '活动列表为空！';
      return;
    }

    // echo $_GET["params"] . '<br><br>';

    $actid = $_SESSION["Activities"][$_GET["index"]]['id'];
    $acttype = $_SESSION["Activities"][$_GET["index"]]['type'];

		$result = MessageRequest::SetActivity($url, $_SESSION['SelectedServer']['Name'], $actid, $acttype, $starttime, $endtime, $stoptime, $_GET["name"], $_GET["des"], $params);

    echo $result;
    return;
  }
}

?>
