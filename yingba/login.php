<?php
include_once 'http-curl.php';

session_start();

if (empty($_GET['username']) || ( $_GET['username'] == null )) {
	exit('请输入帐号');
}

if (empty($_GET['password']) || ( $_GET['password'] == null )) {
	exit('请输入密码');
}

// 把请求服务器ip和端口取出来存到session中
$ConfigPath = '../../yingba/config/config.json';
if (is_file($ConfigPath))
{
	$fp = fopen($ConfigPath, 'r');
	$data = json_decode(fread($fp, filesize($ConfigPath)));
	fclose($fp);

	$_SESSION['YingBaUrl'] = 'http://' . $data->ip . ':' . $data->port . '/YinbaGame/Block2';
}

$InputUserName = $_GET['username'];
$InputPassWord = $_GET['password'];


$url = $_SESSION['YingBaUrl'] . '?message=logIn&account=' . $InputUserName . '&password=' . $InputPassWord;

$result = http_get($url);

// echo $url . '<br>';
// echo var_dump($result);

if ($result && strlen($result) > 0)
{
  //var_dump($result);
  $js = json_decode($result);
	if ($js->ret != 0) {
		echo $js->msg;
	}else {
		$_SESSION['acc_psd'] = '&account=' . $InputUserName . '&password=' . $InputPassWord;
		$_SESSION['acc_wechatid'] = $InputUserName;
		$_SESSION['acc_level'] = $js->level;
		echo '<script language=javascript>window.location.href="YingbaGame.php"</script>';
	}
}

?>
