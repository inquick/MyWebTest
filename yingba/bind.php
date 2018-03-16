<?php

include_once 'http-curl.php';

session_start();

if (!isset($_SESSION['acc_psd']))
{
	echo "<script language=javascript>alert ('要访问的页面需要先登录。');</script>";
	$_SESSION['userurl'] = $_SERVER['REQUEST_URI'];
	echo '<script language=javascript>window.location.href="index.php"</script>';
}

binding();

function binding()
{
	// echo "<script language=javascript>alert ('调用方法binding()。');</script>";
	$WeChatId = '';
	if($_SESSION['acc_level'] == 9){
		if (empty($_GET['wechatid']) || ( $_GET['wechatid'] == null )) {
			exit('请输入微信公众号id！！！');
		}
		$WeChatId = $_GET['wechatid'];
	}elseif ($_SESSION['acc_level'] == 3) {
		$WeChatId = $_SESSION['acc_wechatid'];
	}

	if (empty($_GET['wechatname']) || ( $_GET['wechatname'] == null )) {
		exit('请输入微信公众号名！！！');
	}

	if (empty($_GET['appidlist']) || $_GET['appidlist'] == null)
	{
		exit('请选择需要绑定的APP！！！');
	}

	// echo '要绑定微信号了';

	$result = http_get($_SESSION['YingBaUrl'] . '?message=getAppUrl&wx_id=' . $WeChatId . '&wx_name=' . urlencode($_GET['wechatname']) . '&appList=' . $_GET['appidlist'] . $_SESSION['acc_psd']);

	if ($result && strlen($result) > 0)
	{
		// var_dump($_SESSION['appidtoname']);
		// var_dump($result);
		echo '<div><h3>绑定结果:</h3></div>';
		$js = json_decode($result);
		// var_dump($js);
		if ($js->ret == 0)
		{
			if ($_SESSION['acc_level'] == 9) {
				echo '子账号：' . $js->account . '<br>';
				echo '子账号密码：' . $js->password . '<br><br>';
			}
			while (list($id, $url) = each($js->data->map_url->value))
			{
				$appname = '';
				if (isset($_SESSION['appidtoname']))
				{
					$appname = $_SESSION['appidtoname'][$id];
				}
				echo $appname . ' : url= ' . $url . '<br>';
			}
		}
		else
		{
			echo $js->msg;
		}
	}
	else
	{
		echo 'http请求未返回结果！！！';
	}
}
?>
