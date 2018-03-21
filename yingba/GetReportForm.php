<?php

include_once 'http-curl.php';

if (empty($_GET['beginedate']) || ( $_GET['beginedate'] == null )) {
  exit('请输入起始时间！！！');
}

if (empty($_GET['enddate']) || ( $_GET['enddate'] == null )) {
  exit('请输入结束时间！！！');
}

session_start();

if (!isset($_SESSION['acc_psd']))
{
	echo "<script language=javascript>alert ('要访问的页面需要先登录。');</script>";
	$_SESSION['userurl'] = $_SERVER['REQUEST_URI'];
	echo '<script language=javascript>window.location.href="index.php"</script>';
}

$BegineTime = str_replace('-', '', $_GET['beginedate']);
$EndTime = str_replace('-', '', $_GET['enddate']);

// echo $BegineTime . '  ' . $EndTime;
$url = $_SESSION['YingBaUrl'] . '?message=getReportForm&begin=' . $BegineTime . '&end=' . $EndTime . $_SESSION['acc_psd'];

// echo $url;

$result = http_get($url);

// echo var_dump($result);

echo '<div><h3>查询结果:</h3></div>';

if ($result && strlen($result) > 0)
{
  //var_dump($result);
  $js = json_decode($result);
  if ($js->ret == 0)
  {
    // echo var_dump($js->data->lst_data->value);
    // echo '' . count($js->data->lst_data->value);
    for ($i=0; $i<count($js->data->lst_data->value); $i++)
    {
      // echo var_dump($js->data->lst_data->value[i]->date);
      //echo '<br><br>';
      //echo var_dump($js->data->lst_data->value[i]->lst_via->value);
      echo $js->data->lst_data->value[$i]->date . ' : 记录<br>';
      for ($j=0; $j < count($js->data->lst_data->value[$i]->lst_via->value); $j++) {
        echo "游戏名：" . $js->data->lst_data->value[$i]->lst_via->value[$j]->name . '<br>';
        echo '<td><table border="1">';
				echo '<td>应用名称</td><td>注册人数</td><td>登录人数</td><td>活跃人数</td><td>付费人数</td><td>付费金额</td><td>付费率</td><td>付费arppu</td><td>总付费额</td><td>次日留存率</td><td>3日留存率</td><td>7日留存率</td><td>14日留存率</td><td>30日留存率</td><td>60日留存率</td>';
        echo '<tr>';
        for ($k=0; $k < count($js->data->lst_data->value[$i]->lst_via->value[$j]->lst_app->value); $k++) {
          while (list($key, $value) = each($js->data->lst_data->value[$i]->lst_via->value[$j]->lst_app->value[$k])) {
            if ($key == 'appid') {
              continue;
            }
            if ($key == '_classname') {
              break;
            }
            echo '<td>' . $value . '</td>';
          }
          echo '<tr>';
        }
        echo '</table></td>';
      }

   	 echo '<br><HR align=center color=#987cb9 SIZE=2><br>';
    }
  }
  else
  {
    echo '错误码:' . $js->ret . '<br>' . $js->msg;
  }
}
else
{
  echo 'http请求未返回结果！！！';
}
exit();

?>
