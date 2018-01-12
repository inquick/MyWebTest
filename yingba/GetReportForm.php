<?php

include_once 'http-curl.php';

if (empty($_GET['beginedate']) || ( $_GET['beginedate'] == null )) {
  exit('请输入起始时间！！！');
}

if (empty($_GET['enddate']) || ( $_GET['enddate'] == null )) {
  exit('请输入结束时间！！！');
}

session_start();

$BegineTime = str_replace('-', '', $_GET['beginedate']);
$EndTime = str_replace('-', '', $_GET['enddate']);

// echo $BegineTime . '  ' . $EndTime;
$url = $_SESSION['YingBaUrl'] . '?message=getReportForm&begin=' . $BegineTime . '&end=' . $EndTime;

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
    //echo var_dump($js->data->lst_data->value);
    // echo '' . count($js->data->lst_data->value);
    for ($i=0; $i<count($js->data->lst_data->value); $i++)
    {
      // echo var_dump($js->data->lst_data->value[i]->date);
      //echo '<br><br>';
      //echo var_dump($js->data->lst_data->value[i]->lst_via->value);
      echo $js->data->lst_data->value[$i]->date . ' : 记录= <br>';
      echo var_dump($js->data->lst_data->value[$i]->lst_via->value) . '<br>';
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
exit();

?>
