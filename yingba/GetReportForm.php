<?php

include_once 'http-curl.php';

if (empty($_GET['beginedate']) || ( $_GET['beginedate'] == null )) {
  exit('请输入起始时间！！！');
}

if (empty($_GET['enddate']) || ( $_GET['enddate'] == null )) {
  exit('请输入结束时间！！！');
}

session_start();

//echo $_GET['beginedate'] . '  ' . $_GET['enddate'];

$result = http_get($_SESSION['YingBaUrl'] . '?message=getReportForm&begin=' . $_GET['beginedate'] . '&end=' . $_GET['enddate']);

//echo var_dump($result);;

if ($result && strlen($result) > 0)
{
  //var_dump($result);
  echo '<div><h3>查询结果:</h3></div>';
  $js = json_decode($result);
  if ($js->ret == 0)
  {
    //echo var_dump($js->data->lst_data->value);
    //echo '' . count($js->data->lst_data->value);
    for ($i=0; i<count($js->data->lst_data->value); $i++)
    {
      //echo var_dump($js->data->lst_data->value[i]->date);
      //echo '<br><br>';
      //echo var_dump($js->data->lst_data->value[i]->lst_via->value);
      echo $js->data->lst_data->value[i]->date . ' : 记录= ' . $js->data->lst_data->value[i]->lst_via->value . '<br>';
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

?>
