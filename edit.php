<?php

$string=file_get_contents('config.php');


//DB_HOST    localhost

foreach($_POST as $key=>$val){

   //定义正则来查找内容，这里面的key为form表单里面的name
   $yx="/define\('$key','.*?'\);/";

   //将内容匹配成对应的key和修改的值
   $re="define('$key','$val');";

   //替换内容
   $string=preg_replace($yx,$re,$string);
}


//写入成功
file_put_contents('config.php',$string);

echo '修改成功';

?>