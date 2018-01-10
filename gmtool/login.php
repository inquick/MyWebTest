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

if (is_file('acc/' . $InputUserName))
{
	$fp = fopen('acc/' . $InputUserName, 'r');

	$password = trim(fgets($fp));
	fclose($fp);

	// var_dump($name);
	// echo '<br/>';
	// var_dump($password);
	// echo '<br/><br/>';

	if ($password == $InputPassWord)
	{
		$_SESSION['UserName'] = "我的角色名";
		// var_dump($_SESSION);
		header('Location: test.html');
	}
	else
	{
		exit('帐号密码不匹配');
	}
}
else
{
	exit('不存在的帐号');
}

?>
