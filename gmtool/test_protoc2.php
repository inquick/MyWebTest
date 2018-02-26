<?php

session_start();

$ConfigPath = 'config/config.json';

// 把请求服务器ip和端口取出来存到session中
if (is_file($ConfigPath))
{
	$fp = fopen($ConfigPath, 'r');
	$data = json_decode(fread($fp, filesize($ConfigPath)));
	fclose($fp);

  echo var_dump($data);

	//$_SESSION['GMToolUrl'] = 'http://' + $data->ip + ':' + $data->port + '/Toba/GMServers';
}

?>
