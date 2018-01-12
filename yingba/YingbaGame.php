<?php

include_once 'http-curl.php';

session_start();

if (!isset($_SESSION['login_ok']))
{
	echo "<script language=javascript>alert ('要访问的页面需要先登录。');</script>";
	$_SESSION['userurl'] = $_SERVER['REQUEST_URI'];
	echo '<script language=javascript>window.location.href="index.html"</script>';
}

// 把请求服务器ip和端口取出来存到session中
if (is_file('/home/ubuntu/yingba/config/config.json'))
{
	$fp = fopen('/home/ubuntu/yingba/config/config.json', 'r');
	$data = json_decode(fread($fp, filesize('/home/ubuntu/yingba/config/config.json')));
	fclose($fp);

	$_SESSION['YingBaUrl'] = 'http://' . $data->ip . ':' . $data->port . '/YinbaGame/Block2';
}

// $beginetime = microtime(true);

// echo $_SESSION['YingBaUrl'] . '?message=getAppList';

$result = http_get($_SESSION['YingBaUrl'] . '?message=getAppList');

// $elapsed = microtime(true) - $beginetime;
// echo "That took $elapsed seconds.\n";

$js = null;
if ($result && strlen($result) > 0)
{
	$js = json_decode($result);
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<!-- 这里指明页面编码 -->
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title> yingba </title>
<script src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    function BindUrl(){
		// alert('调用BindUrl()！！');
		var form = document.forms['f1'];
		var bindurl = 'bind.php?wechatid=' + form.wechatid.value + '&wechatname=' + form.wechatname.value + '&appidlist=' + $('#appidlist').val();
		$.get( bindurl, function(data) {
			// alert(data);
            $('#txt').html(data);
        });
		// alert('BindUrl()执行完毕！！');
    }
  </script>
	<script type="text/javascript">
		function GetReportForm(){
			var form2 = document.forms['f2'];
			var url = 'GetReportForm.php?beginedate=' + form2.beginedate.value + '&enddate=' + form2.enddate.value;
			$.get( url, function(data2) {
				$('#report').html(data2);
			});
		}
	</script>
</head>
<body>
	<div>
   <form id="f1" name="f1" method="POST">
<?php
		if ($js)
		{
			echo '<h1>选择要代理的APP：</h1>';
			echo '<td><table border="1">';
			$LINE_COUNT = 8;

			$AppListArray = array();

			for ($i=0; $i< count($js->data->app_list->value); $i++)
			{
				if ($i % $LINE_COUNT == 0)
				{
					echo '<tr>';
				}
				echo '<td>';
				echo '<img src=' . $js->data->app_list->value[$i]->icon . '><br/>';
				echo '<center>' . $js->data->app_list->value[$i]->appname . '<input name="appidlist[]" type="checkbox" value=' . $js->data->app_list->value[$i]->appid . '></center>';
				echo '</td>';

				$AppListArray[$js->data->app_list->value[$i]->appid] = $js->data->app_list->value[$i]->appname;

				if ($i % $LINE_COUNT == $LINE_COUNT - 1)
				{
					echo '</tr>';
				}
			}
			$_SESSION['appidtoname'] = $AppListArray;

			echo '</table></td>';
			echo '<input type="hidden" name="appidlist" id="appidlist" value="@Model.appidlist" />';
			echo '<script>';
			echo "$('input[type=checkbox]').change(function(){";
			echo "	$('#appidlist').val($('input[type=checkbox]:checked').map(function(){return this.value}).get().join('_'))";
			echo '})';
			echo '</script>';
			echo '<div>';
			echo '<br>';
			echo '微信公众号ID：<input type="text" name="wechatid" /> 微信公众号名：<input type="text" name="wechatname" /> ';
			echo '<input type="button" value="绑定" onclick="BindUrl()">';

		}else
		{
			echo '获取可绑定应用列表失败';
		}
?>
   </form>
 		</div>
	 <div>
	 <form id="f2" method="post">
		 开始时间：<input type="date" name="beginedate" /> 结束时间：<input type="date" name="enddate" />
	 <input type="button" value="查看记录" onclick="GetReportForm()">

	 </form>
	 <div>
   <div id="txt"></div>
   <div id="report"></div>
</body>
</html>
