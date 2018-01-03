<?php
//追加方式打开文件
$fp=fopen('message.txt','a');

//设置时间
$time=time();

//得到用户名
$username=trim($_POST['username']);
//得到内容
$content=trim($_POST['content']);


//组合写入的字符串：内容和用户之间分开，使用$#
//行与行之间分开，使用&^
$string=$username.'$#'.$content.'$#'.$time.'&^';

//写入文件
fwrite($fp,$string);

//关闭文件
fclose($fp);


header('location:index.php');

?>