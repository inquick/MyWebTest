<?php
   //linux类的读了方式
   //readfile("/home/index.php");
   //windows类的读取方式
   readfile('E:\\phpStudy\\PHPTutorial\\WWW\\index.php');
   
   
   $filename = 'user.php';

   $fp = fopen($filename, 'r');
   
   $contents = fread($fp, 2048);
   
   echo $contents;
   
   $filearray = explode("\n", $contents);
   

   //把切割成的数组，下标赋值给$key,值赋值给$val，每次循环将$key加1。
   while (list($key, $val) = each($filearray)) {
       ++$key;
       $val = trim($val);

       //用的单引号，单引号不解释变量进行了拼接而已
       print 'Line' . $key .':'.  $val.'<br />';
   }
   
   //var_dump()操作一下$fp看看效果，输出的是不是只有类型提示的是resource
   var_dump($fp);
   
   fclose($fp);
   
?>

 <?php
   $data = "在PHP中文网学好PHP，妹子票子不再话下！";

   $numbytes = file_put_contents('binggege.txt', $data);

   if($numbytes){

       echo '写入成功，我们读取看看结果试试：';

       echo file_get_contents('binggege.txt');

   }else{
       echo '写入失败或者没有权限，注意检查';
   }
?>