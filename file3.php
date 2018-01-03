<?php

$filename = 'user.php';

date_default_timezone_set('Asia/Shanghai');

if (file_exists($filename)) {
   echo "$filename" . '文件的上次访问时间是:'  . date("Y-m-d H:i:s", fileatime($filename)) . '<br />';
   echo "$filename" . '文件的创建时间是: ' . date("Y-m-d H:i:s", filectime($filename)) . '<br />';
    echo "$filename" . '文件的修改时间是: ' . date("Y-m-d H:i:s", filemtime($filename)) . '<br />';
}
?>