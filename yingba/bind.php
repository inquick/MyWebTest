<?php

include_once 'http-curl.php';

session_start();

if (!isset($_SESSION['login_ok'])) 
{
	echo "<script language=javascript>alert ('要访问的页面需要先登录。');</script>"; 
	$_SESSION['userurl'] = $_SERVER['REQUEST_URI']; 
	echo '<script language=javascript>window.location.href="index.php"</script>'; 
}

binding();

function binding()
{
	// echo "<script language=javascript>alert ('调用方法binding()。');</script>"; 
	if (empty($_GET['wechatid']) || ( $_GET['wechatid'] == null )) {
		exit('请输入微信公众号id！！！');
	}

	if (empty($_GET['wechatname']) || ( $_GET['wechatname'] == null )) {
		exit('请输入微信公众号名！！！');
	}

	if (empty($_GET['appidlist']) || $_GET['appidlist'] == null)
	{
		exit('请选择需要绑定的APP！！！');
	}

	$result = http_get($_SESSION['YingBaUrl'] . '?message=getAppUrl&wx_id=' . $_GET['wechatid'] . '&wx_name=' . urlencode($_GET['wechatname']) . '&appList=' . $_GET['appidlist']);

	if ($result && strlen($result) > 0)
	{
		// var_dump($_SESSION['appidtoname']);
		echo '<div><h3>绑定结果:</h3></div>';
		$js = json_decode($result);
		if ($js->ret == 0)
		{
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
