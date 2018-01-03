<?php
session_start();

if (!isset($_SESSION['login_ok'])) 
{
	echo "<script language=javascript>alert ('请先登录需要先登录。');</script>"; 
	$_SESSION['userurl'] = $_SERVER['REQUEST_URI']; 
	echo '<script language=javascript>window.location.href="index.php"</script>'; 
}

if (is_file('config/serverlist.json'))
{
	$fp = fopen('config/serverlist.json', 'r');
	$json_string = fread($fp, filesize('config/serverlist.json'));
	fclose($fp);
	
	//var_dump($json_string);
// 把JSON字符串转成PHP数组
	$data = json_decode($json_string);
}

?>