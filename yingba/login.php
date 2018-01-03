<?php

session_start();

if (empty($_GET['username']) || ( $_GET['username'] == null )) {
	exit('请输入帐号');
}

if (empty($_GET['password']) || ( $_GET['password'] == null )) {
	exit('请输入密码');
}

$InputUserName = $_GET['username'];
$InputPassWord = $_GET['password'];

$result = '';

if (is_file('/home/ubuntu/yingba/config/accounts.json'))
{
	// 获取帐号信息
	$fp = fopen('/home/ubuntu/yingba/config/accounts.json', 'r');
	$data = json_decode(fread($fp, filesize('/home/ubuntu/yingba/config/accounts.json')));
	fclose($fp);
	
	$AccArray = array();
	for ($i=0; $i<count($data); $i++)
	{
		$AccArray[$data[$i]->acc] = $data[$i]->psd;
	}
	// 判断帐号信息
	if (isset($AccArray[$InputUserName]))
	{
		if ($AccArray[$InputUserName] == $InputPassWord){
			$_SESSION['login_ok'] = true;
			header('Location: YingbaGame.php');
			exit();
		}else {
			exit('帐号密码不匹配');
		}
	}
	else
	{
		exit('不存在的帐号');
	}
}
else 
{
	exit('不存在的帐号');
}

?>