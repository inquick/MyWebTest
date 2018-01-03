<?php
//设置打开的目录是D盘
$dir = "E:/phpStudy/PHPTutorial/WWW/";

Traversal($dir);

function Traversal($dir)
{
	//判断是否是文件夹，是文件夹
	if (is_dir($dir)) {
	   if ($dh = opendir($dir)) {
		   
		   while($filename = readdir($dh))
		   {
			   // var_dump($filename);
			   
			   echo "文件名为: $filename : 文件的类型是: " . filetype($dir . $filename) . "<br />";
			   
			   if (filetype($dir . $filename) == 'dir')
			   {
				   Traversal($dir . $filename);
			   }
		   }
		  //读取到最后返回false

		  //关闭文件夹资源
		   closedir($dh);
	   }
	}
}

?>