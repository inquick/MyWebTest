<?php

session_start();

if (!isset($_SESSION["AccountList"])) {
	LoadAccountsJson();
}

if (empty($_GET['username']) || ( $_GET['username'] == null )) {
	exit('请输入帐号');
}

if (empty($_GET['password']) || ( $_GET['password'] == null )) {
	exit('请输入密码');
}

$InputUserName = $_GET['username'];
$InputPassWord = $_GET['password'];

while (list($acc, $psd) = each($_SESSION["AccountList"]))
{
	if ($InputUserName == $acc) {
		if ($InputPassWord == $psd) {
				$_SESSION['UserName'] = "GM:" . $acc;
				// var_dump($_SESSION);
				header('Location: index.html');
		}
		else
		{
			echo '帐号密码不匹配';
		}
	}
}

echo '不存在的帐号';

function LoadAccountsJson()
{
	$filename = '../../GMTool/accounts.json';
	if (is_file($filename))
	{
		$fp = fopen($filename, 'r');
		$source = fread($fp, filesize($filename));
		$data = json_decode($source);

		$password = trim(fgets($fp));
		fclose($fp);
		$AccountList = array();

		while (list(, $accountinfo) = each($data))
		{
			$AccountList[$accountinfo->acc] = $accountinfo->psd;
		}

		$_SESSION["AccountList"] = $AccountList;
	}
}
?>
