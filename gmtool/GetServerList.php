<?php

include_once 'MessageRequest.php';

if (isset($_SESSION['SelectedServer']['Id'])) {
	$url = $_SESSION["ServerList"][$_SESSION['SelectedServer']['Id']]["Url"];
	$result = MessageRequest::GetServerList($url);

	echo $result;
}else {
	echo '请先选择一个服务器！';
}

?>
