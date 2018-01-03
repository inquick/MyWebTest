<?php
$path_parts = pathinfo('demo.txt');

var_dump($path_parts);

echo '<br />文件目录名：'.$path_parts['dirname']."<br />";
echo '文件全名：'.$path_parts['basename']."<br />";
echo '文件扩展名：'.$path_parts['extension']."<br />";
echo '不包含扩展的文件名：'.$path_parts['filename']."<br />"; 

echo "1: ".basename("d:/www/index.d", ".d").PHP_EOL;
echo "2: ".basename("d:/www/index.php").PHP_EOL;
echo "3: ".basename("d:/www/passwd").PHP_EOL;

// echo dirname(__FILE__);

$url = 'http://username:password@hostname:9090/path?arg=value#anchor';

var_dump(parse_url($url));

?>